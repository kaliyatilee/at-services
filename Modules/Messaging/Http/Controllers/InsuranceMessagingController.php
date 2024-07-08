<?php

namespace Modules\Messaging\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller;
use App\Models\InsuranceTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InsuranceMessagingController extends Controller
{
    /**
     * Display the messaging index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('messaging::index');
    }

    public function sendInsuranceExpiryReminders()
    {
        try{
            // Get all insurance policies that are near expiry (e.g. within 15 days)

            $policiesNearExpiry = InsuranceTransaction::where('expiry_date', '<=', now()->addDays(15))->get();

            $responses = [];

            foreach ($policiesNearExpiry as $policy) {
                $daysUntilExpiry = now()->diffInDays($policy->expiry_date);

                $message = null;

                if ($daysUntilExpiry == 14) {
                    // Send a message 14 days before expiry
                    $message = sprintf(
                        'Your insurance policy for %s is approaching its expiry date in 14 days. To avoid lapse in coverage, please renew your policy as soon as possible.',
                        $policy->reg_no,
                    );
                } elseif ($daysUntilExpiry == 7) {
                    // Send a message 7 days before expiry
                    $message = sprintf(
                        'Your insurance policy for %s is approaching its expiry date in 7 days. To avoid lapse in coverage, please renew your policy as soon as possible.',
                        $policy->reg_no,
                    );
                } elseif ($daysUntilExpiry == 1) {
                    // Send a message 1 day before expiry
                    $message = sprintf(
                        'Your insurance policy for %s is approaching its expiry date tomorrow. To avoid lapse in coverage, please renew your policy as soon as possible.',
                        $policy->reg_no,
                    );
                } elseif ($daysUntilExpiry == 0) {
                    // Send a message if the policy is expiring today
                    $message = sprintf(
                        'Your insurance policy for %s is expiring today. Please renew your policy as soon as possible.',
                        $policy->reg_no,
                    );
                } elseif ($daysUntilExpiry < 0 && $daysUntilExpiry >= -2) {
                    // Send a message if the policy is overdue, but only up to 2 days
                    $message = sprintf(
                        'Your insurance policy for %s has expired. Please renew as soon as possible to avoid lapse!',
                        $policy->reg_no,
                    );
                }

                // If a reminder type has been determined, send the reminder and store the response
                if ($message) {
                    $response = $this->sendSmsReminder($policy, $message);
                    $responses[] = $response;
                }
            }

            return response()->json([
                'status'    => true,
                'responses' => $responses,
            ]);

        } catch (\Throwable $th) {
            Log::error('Uncaught throwable: ' . $th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'description' => $th->getMessage()
            ], 500);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Model not found',
                'description' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            Log::error('Internal Server error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
                'description' => $e->getMessage()
            ], 500);
        }
    }

    private function MessageReference()
    {
        $prefix = 'R'; // Set the prefix for the message reference
        $randomNumber = str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT); // Generate a 5-digit random number, padding with zeros if necessary
        $suffix = chr(rand(65, 90)); // Generate a random uppercase letter
        return $prefix . $randomNumber . $suffix; // Concatenate the prefix, random number, and suffix to form the message reference
    }

    private function sendSmsReminder(InsuranceTransaction $policy, $message)
    {

        // Send the reminder message using the SMS API
        try {
            $sendMsg = Http::post('https://2waychat.com/2wc/single-sms/v1/api', [
                        'token'             => env('SMS_TOKEN'),
                        'destination'       => $policy->phone,
                        'messageText'       => $message,
                        'messageReference'  => $this->MessageReference(),
                        'messageDate'       => Carbon::now()->format('YmdHis'),
                        'messageValidity'   => '03:00',
                        'sendDateTime'      => '',
                    ]);

            // Return the response from the SMS API
            return $sendMsg;
        } catch (\Throwable $th) {
            Log::error('Uncaught throwable: ' . $th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'description' => $th->getMessage()
            ], 500);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Model not found',
                'description' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            Log::error('Internal Server error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
                'description' => $e->getMessage()
            ], 500);
        }
    }
}
