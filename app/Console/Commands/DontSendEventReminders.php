<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class DontSendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dont-send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends notifications to all the event attendees that the event starts soon.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = \App\Models\Event::with('attendees.user')
            ->whereBetween('start_time', [now(), now()->addDays(7)])
            ->get();

        $eventCount = $events->count();
        $eventLabel = Str::plural('event', $eventCount);

        $this->info("Found $eventCount $eventLabel starting in the next week.");

        $events->each(
            fn($event)=>$event->attendees->each(
                fn($attendee)=>$this->info("Notifying the user $attendee->user->id")
            )
        );

//        $events->each(
//            fn($event) => $event->attendees->each(
//                fn($attendee) => $attendee->user->id->notify("Notifying")
//            )
//        );

        $this->info('Reminder notifications sent successfully!');
    }
}
