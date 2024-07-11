<?php

namespace Modules\Messaging\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class DigitalReceiptsMessagingController extends Controller
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

    public function sendDigitalReceipt($phone ,$amount, $message)
    {
       //$sendMsg = 'Your transaction for '. $message .' was successful. Thank you.';
       $sendMsg = $message.' Thank you.';
        // generate unique reference
        function MessageReference()
        {
            $prefix = 'R'; // Set the prefix for the message reference
            $randomNumber = str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT); // Generate a 5-digit random number, padding with zeros if necessary
            $suffix = chr(rand(65, 90)); // Generate a random uppercase letter
            return $prefix . $randomNumber . $suffix; // Concatenate the prefix, random number, and suffix to form the message reference
        }

        try {
            //code..
            $sendMsg = Http::post('https://2waychat.com/2wc/single-sms/v1/api', [
                'token'             => env('SMS_TOKEN'),
                'destination'       => $phone,
                'messageText'       => $sendMsg,
                'messageReference'  => messageReference(),
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
