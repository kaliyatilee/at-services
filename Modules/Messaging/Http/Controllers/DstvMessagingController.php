<?php

namespace Modules\Messaging\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller;
use App\Models\DSTVTransaction;
use Illuminate\Support\Facades\Log;

class DstvMessagingController extends Controller
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

    public function sendDstvExpiryReminders()
    {
        try{
             // Get only dates with the same day of the month as the current date plus 30 and 29 days before, but in the next month.
            $subscriptionNearExpiry = DSTVTransaction::whereRaw("DATEDIFF(CURDATE(), transaction_date) >= 29 AND DATEDIFF(CURDATE(), transaction_date) <= 30")
            ->get();

            foreach ($subscriptionNearExpiry as $dstvsubscription) {
                 // Send message reminder for each dstvsubscription after 29 and 30 days
                return $this->sendSmsReminder($dstvsubscription);
            }
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

    // generate unique reference
    private function MessageReference()
    {
        $prefix = 'R'; // Set the prefix for the message reference
        $randomNumber = str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT); // Generate a 5-digit random number, padding with zeros if necessary
        $suffix = chr(rand(65, 90)); // Generate a random uppercase letter
        return $prefix . $randomNumber . $suffix; // Concatenate the prefix, random number, and suffix to form the message reference
    }

    private function sendSmsReminder(DSTVTransaction $dstvsubscription)
    {
        $message = "Reminder: Your DSTV subscription for " . \Carbon\Carbon::parse($dstvsubscription->transaction_date)->format('F j, Y') . " is about to expire. Please top up to continue watching.";

        // SMS API to send the reminder message
        try {
            $sendMsg = Http::post('https://2waychat.com/2wc/single-sms/v1/api', [
                'token'             => env('SMS_TOKEN'),
                'destination'       => $dstvsubscription->phone,
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
