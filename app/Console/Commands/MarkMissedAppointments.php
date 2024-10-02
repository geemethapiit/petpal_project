<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use Carbon\Carbon;

class MarkMissedAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:mark-missed';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark appointments as "not show up" if they have passed and are still pending';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        
        // Find all pending appointments that are in the past
        $appointments = Appointment::where('status', 'pending')
            ->where('date', '<=', $now->toDateString())
            ->where('start_time', '<', $now->toTimeString())
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->update(['status' => 'not show up']);
        }

        $this->info('Missed appointments marked as "not show up".');
    }
}
