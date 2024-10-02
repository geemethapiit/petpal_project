<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slots;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // Get available slots
    public function availableSlots(Request $request)
    {
        try {
            // Step 1: Validate inputs
            $request->validate([
                'service_provider_id' => 'required|exists:service_providers,provider_id',
                'service_type_id' => 'required|exists:servicetypes,service_type_id',
                'date' => 'required|date',
            ]);
            
            // Step 2: Fetch slot information (start time, end time, duration, slot count)
            $slotInfo = Slots::where('service_provider_id', $request->service_provider_id)
                ->where('service_type_id', $request->service_type_id)
                ->first();

            if (!$slotInfo) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No slot information found for the selected service provider and service type.'
                ], 404);
            }

            // Step 3: Generate time slots based on start_time, end_time, and duration
            $startTime = \Carbon\Carbon::parse($slotInfo->start_time);
            $endTime = \Carbon\Carbon::parse($slotInfo->end_time);
            $slotDuration = $slotInfo->slot_duration; // Slot duration in minutes
            $maxSlotCount = $slotInfo->slot_count; // Max number of bookings per time slot

            $timeSlots = [];
            while ($startTime->lte($endTime)) {
                $timeSlots[$startTime->format('H:i')] = $maxSlotCount; // Initialize available count to max
                $startTime->addMinutes($slotDuration);
            }

            // Step 4: Fetch appointments for the specified date, service provider, and service type
            $appointments = Appointment::where('service_provider_id', $request->service_provider_id)
                ->where('service_type_id', $request->service_type_id)
                ->where('date', $request->date)
                ->where('status', 'pending') // Only consider pending appointments
                ->get();

            // Step 5: Count bookings for each time slot, taking into account cancellations
            foreach ($appointments as $appointment) {
                $startTime = \Carbon\Carbon::parse($appointment->start_time)->format('H:i');

                // Reduce the available count for that time slot only if it's not canceled
                if (isset($timeSlots[$startTime])) {
                    $timeSlots[$startTime]--;
                }

                // Remove fully booked slots from available slots
                if ($timeSlots[$startTime] <= 0) {
                    unset($timeSlots[$startTime]); // Fully booked
                }
            }

            // Step 6: Return available time slots without counts
            $availableSlots = array_keys($timeSlots); // Only return the times without count
            
            if (empty($availableSlots)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No available slots.'
                ], 404);
            }

            return response()->json($availableSlots);

        } 
            catch (\Throwable $th) 
            {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
            }
    }



    // Book a slot
    public function bookAppointment(Request $request)
    {
        try {
            
            $request->validate([
                'service_provider_id' => 'required|exists:service_providers,provider_id',
                'service_type_id' => 'required|exists:servicetypes,service_type_id',
                'start_time' => 'required', 
                'pet_id' => 'required|exists:pets,pet_id',
                'date' => 'required|date',
            ]);

            $petownerId = Auth::user()->petowner_id;

           
            $slot = Slots::where('service_provider_id', $request->service_provider_id)
                        ->where('service_type_id', $request->service_type_id)
                        ->firstOrFail();

           
            $bookedCount = Appointment::where('service_provider_id', $request->service_provider_id)
                ->where('service_type_id', $request->service_type_id)
                ->where('start_time', $request->start_time) 
                ->where('date', $request->date)
                ->where('status', 'pending') 
                ->count();

         
            if ($bookedCount >= $slot->slot_count) {
                return response()->json(['message' => 'This time slot is fully booked'], 400);
            }

          
            $appointment = Appointment::create([
                'service_provider_id' => $request->service_provider_id,
                'service_type_id' => $request->service_type_id,
                'start_time' => $request->start_time, 
                'petowner_id' => $petownerId,
                'pet_id' => $request->pet_id,
                'date' => $request->date,
                'status' => 'pending',
            ]);

            return response()->json($appointment, 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }



    // Cancel an appointment
    public function cancelAppointment($id)
    {
        try {
          
            $appointment = Appointment::findOrFail($id);

      
            if ($appointment->petowner_id !== Auth::user()->petowner_id) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            if ($appointment->status === 'cancelled') {
                return response()->json(['message' => 'This appointment is already canceled'], 400);
            }

         
            $appointment->update(['status' => 'cancelled']);

            return response()->json(['message' => 'Appointment canceled successfully'], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }



    // view upcoming appointments
    public function upcomingAppointments()
    {
        try {
            $petownerId = Auth::user()->petowner_id;

          
            $appointments = Appointment::where('petowner_id', $petownerId)
                ->where('date', '>=', now()->toDateString())
                ->where('status', 'pending') 
                ->orderBy('date')
                ->orderBy('start_time')
                ->get();

            return response()->json($appointments);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }



    // view past appointments
    public function pastAppointments()
    {
        try {
            $petownerId = Auth::user()->petowner_id;

            $appointments = Appointment::where('petowner_id', $petownerId)
            ->whereIn('status', ['completed', 'cancelled', 'not show up']) 
            ->orderBy('date', 'desc') 
            ->orderBy('start_time', 'desc') 
            ->get();

            return response()->json($appointments);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    
}
