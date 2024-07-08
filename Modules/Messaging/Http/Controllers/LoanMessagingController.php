<?php

namespace Modules\Messaging\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use App\Models\LoanDisbursed;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LoanMessagingController extends Controller
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

    public function sendLoanExpiryReminders()
    {
        try{
            // Get all loans that are near expiry (e.g. within 1 day)
            $loanRepayments = LoanDisbursed::whereRaw("DATE(repayment_date) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)")->get();
            $loanRepaymentstoday = LoanDisbursed::whereRaw("DATE(repayment_date) = CURDATE()")->get();

            // Initialize an empty array to store the responses
            $responses = [];

            foreach ($loanRepayments as $loanRepayment) {
                // Send reminders for loans that are near expiry
                $response = $this->sendSmsReminder($loanRepayment, 'about_to_expire');
                $responses[] = $response;
            }

            foreach ($loanRepaymentstoday as $loanRepaymentToday) {
                // Send reminders for loans that have expired
                $response = $this->sendSmsReminder($loanRepaymentToday, 'expired');
                $responses[] = $response;
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

    private function sendSmsReminder(LoanDisbursed $loanRepayment, $type)
    {
        // Check if the loan is about to expire
        if ($type == 'about_to_expire') {
            // Create a message to notify the user that their loan is about to expire
            $message = sprintf(
                '%s, your loan is due on %s. Please pay your loan of %s.',
                $loanRepayment->name,
                $loanRepayment->repayment_date,
                $loanRepayment->amount
            );
        }
        // Check if the loan has already expired
        elseif ($type == 'expired') {
            // Create a message to notify the user that their loan has expired
            $message = sprintf(
                '%s, your loan was due today on %s and has expired. Please pay your loan before it accumulates interest.',
                $loanRepayment->name,
                $loanRepayment->repayment_date
            );
        }

        // Send the reminder message using the SMS API
        try {
            $sendMsg = Http::post('https://2waychat.com/2wc/single-sms/v1/api', [
                'token' => env('SMS_TOKEN'),
                'destination' => $loanRepayment->phone,
                'messageText' => $message,
                'messageReference' => $this->MessageReference(),
                'messageDate' => Carbon::now()->format('YmdHis'),
                'messageValidity' => '03:00',
                'sendDateTime' => '',
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
