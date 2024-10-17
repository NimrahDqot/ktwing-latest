<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;
use App\Models\Event;
use Log;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:update-status';
    protected $description = 'Update event statuses to Completed, Ongoing, or Upcoming';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('H:i:s');

        // Get max time (current time + 15 minutes)
        $maxTime = Carbon::now()->addMinutes(15)->format('H:i:s');

        // Perform the update directly
       $events = Event::where('event_date', '=', $currentDate)
            ->where('event_time', '>=', $currentTime)
            ->where('event_time', '<=', $maxTime)
            ->where('event_status', 'Upcoming')
            ->update(['event_status' => 'Ongoing']);
            Log::info('Event statuses updated:', $events);
            $this->info('Event statuses updated successfully.');

    }
}
