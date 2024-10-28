<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Volunteer;
use App\Models\Event;
use App\Models\Notification;
use Helper;
use Log;
class SendUpcomingEventNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled notifications';

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
        // Get the users you want to notify
        $tomorrow = now()->addDay()->format('Y-m-d');

        // Get the events that are happening tomorrow
        $events = Event::whereDate('event_date', $tomorrow)->select('volunteer_id')->get();

        Log::info('Upcoming events for tomorrow:', ['events' => json_encode($events, JSON_PRETTY_PRINT)]);

        if ($events->isEmpty()) {
            Log::info('No upcoming events for tomorrow.');
            return;
        }

        $title = 'Upcoming Event Coming Soon';
        $description = 'You have been alerted to an upcoming event.';
        $type = '0';

        foreach ($events as $event) {
            // Assuming each event has a 'volunteer_id' field with comma-separated values
            $volunteerIds = explode(',', $event->volunteer_id); // Convert to array

            // Fetch the assigned volunteers
            $assignedVolunteers = Volunteer::whereIn('id', $volunteerIds)->get();
            Log::info('Upcoming assigned Team for tomorrow:', ['assignedVolunteers' => json_encode($assignedVolunteers, JSON_PRETTY_PRINT)]);

            foreach ($assignedVolunteers as $volunteer) {
                $notification = [
                    'user_id' => $volunteer->id, // Store the ID of each volunteer being notified
                    'title' => $title,
                    'description' => $description,
                    'type' => $type,
                ];
                Log::info('Upcoming user_id for event:', ['user_id' =>  $volunteer->id]);

                // Create the notification record
                Notification::create($notification);

                // Fetch the volunteer's FCM token
                $fcmToken = $volunteer->fcm_token;
                // Send push notification if a valid token exists
                if ($fcmToken) {
                    Helper::sendPushNotification($fcmToken, $title, $description);
                }
            }
        }

        $this->info('Notifications sent successfully for tomorrow\'s events!');
    }
}
