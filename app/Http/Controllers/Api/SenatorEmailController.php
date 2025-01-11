<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Senator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class SenatorEmailController extends Controller
{

    public function sendEmail(Request $request)
    {
        $data=[
            'success' => true,
            'message' => null,
            'errors' => null
        ];
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'senator_id' => 'required|integer',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string|max:5000|regex:/^[^<>]*$/', // Prevent HTML/JavaScript injection
            ]);

            //Sanitize the message
            $validated['message'] = htmlspecialchars($validated['message']);

            // Find the senator by ID
            $senator = Senator::find($validated['senator_id']);
            if(!$senator){
                $data['message'] = 'Senator not found.';
                $data['success'] = false;

                return response()->json($data, 404);
            }

            // Attempt to send the email
            Mail::raw($validated['message'], function ($mail) use ($senator, $validated) {
                $mail->to($senator->email)
                    ->from($validated['email'], $validated['last_name'])
                    ->subject('Message to Senator');
            });

            $data['message'] = 'Email sent successfully.';
            return response()->json($data, 200);

        } catch (ValidationException $e) {
            // Log validation errors
            Log::error('Validation failed: ', $e->errors());

            $data['message'] = 'Validation failed';
            $data['success'] = false;
            $data['errors'] = $e->errors();
            // Return validation error response
            return response()->json($data, 422);

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error("Email sending failed: {$e->getMessage()}");
            
            $data['message'] = 'Failed to send email';
            $data['success'] = false;
            return response()->json($data, 500);
        }
    }
}
