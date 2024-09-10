<?php

namespace App\Jobs;

use App\Models\Attendee;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchAttendeesBatch implements ShouldQueue
{
    use Queueable;

    public $page;
    /**
     * Create a new job instance.
     */
    public function __construct($page)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->page > 0) {
            $response = Http::get('http://127.0.0.1:8000/api/attendees?page=' . $this->page);
            $attendees = $response->json();
            if ($attendees) {
                foreach ($attendees['data'] as $attendee) {
                    Attendee::updateOrCreate(
                        ['attendee_id' => $attendee['id']],
                        [
                            'name' => $attendee['name'],
                            'email' => $attendee['email'],
                        ]
                    );
                }
            }
        }
    }
}
