<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // create feedback
    public function create(Request $request)
    {
        try
        {
            $request->validate([
                'feedback' => 'required',
                'rating' => 'required|integer|min:1|max:5',
                'appointment_id' => 'required|exists:appointment,appointment_id'  // Correct table name
            ]);

            $authPetOwnerId = auth()->user()->pet_owner_id;  // Get the actual pet owner ID

            $appointment = Appointment::where('appointment_id', $request->appointment_id)->first();

            if($appointment->pet_owner_id != $authPetOwnerId)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized to provide feedback for this appointment'
                ], 403);
            }

            $feedback = new Feedback();
            $feedback->feedback = $request->feedback;
            $feedback->rating = $request->rating;
            $feedback->appointment_id = $request->appointment_id;
            $feedback->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Feedback created successfully'
            ], 201);
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
