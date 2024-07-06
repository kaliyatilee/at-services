<?php

namespace Modules\Messaging\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsLetterMessagingController extends Controller
{
    /**
     * Display the broadcast messaging view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Return the broadcast messaging view
        return view('messaging.broadcast');
    }

    public function sendBulkSms(Request $request)
    {
        $validatedData = $request->validate(["message" => "string|max:160"]); // Validate message length: Maximum 60 characters
        $messageText = $validatedData['message']; // Get the validated message
        $clients = Client::get(); // Fetch all clients
        $destinations = []; // Initialize an empty array to store phone numbers

        /**
         * Generates a unique message reference string.
         *
         * The message reference consists of a prefix, a 5-digit random number, and a random uppercase letter.
         *
         * @return string The generated message reference string.
         */
        function MessageReference()
        {
            $prefix = 'R'; // Set the prefix for the message reference
            $randomNumber = str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT); // Generate a 5-digit random number, padding with zeros if necessary
            $suffix = chr(rand(65, 90)); // Generate a random uppercase letter
            return $prefix . $randomNumber . $suffix; // Concatenate the prefix, random number, and suffix to form the message reference
        }

        /**
         * Generates a unique batch number.
         *
         * The batch number is a combination of random uppercase letters and numbers,
         * formatted as XXXYYZZZWWW, where:
         * - XXX are 3 random uppercase letters
         * - YY are 2 random digits, padded with zeros if necessary
         * - ZZZ are 3 random uppercase letters
         * - WWW are 3 random digits, padded with zeros if necessary
         *
         * @return string The generated batch number
         */
        function BatchNumber()
        {
            $batchNumber = strtoupper(Str::random(3)) . str_pad(rand(10, 99), 2, '0', STR_PAD_LEFT) . strtoupper(Str::random(3)) . str_pad(rand(100, 999), 3, '0', STR_PAD_LEFT) . strtoupper(Str::random(2));
            return $batchNumber;
        }

        // Iterate over each client in the $clients array
        foreach ($clients as $client) {
            // Extract the phone number from the current client object
            $phoneNumber = $client->phone1;

            // Create a new array element for the destination, with the phone number, message text, and a unique message reference
            $destinations[] = [
                'destination'       => $phoneNumber, // The phone number to send the message to
                'messageText'       => $messageText, // The text of the message to send
                'messageReference'  => MessageReference(), // Generate a unique message reference for this message
            ];
        }

        /**
         * Prepare the API request data.
         */
        $data = [
            // Authentication details
            'auth' => [
                'token'         => env('SMS_TOKEN'), // Use an environment variable for the SMS token
                'senderID'      => env('SMS_SENDER_ID'), // Use an environment variable for the SMS sender ID
            ],
            // Payload data
            'payload' => [
                'batchNumber'   => BatchNumber(), // Generate a unique batch number
                'messages'      => $destinations, // Use the prepared destinations array
            ],
        ];

        // Send the API request to the 2waychat API
        $response = Http::post('https://2waychat.com/2wc/multiple-sms/v1/api', $data);

        // Check the response status code to determine if the API request was successful
        if ($response->successful()) {
            // SMS sent successfully, return a JSON response with a success message
            return response()->json([
                'message' => "Message sent successfully",
                'success' => true,
                're'
            ]);
        } else {
            // Error sending SMS, return a JSON response with an error message
            return response()->json([
                'message' => "Something happened! Please try again later",
                'success' => false
            ]);
        }
    }

}
