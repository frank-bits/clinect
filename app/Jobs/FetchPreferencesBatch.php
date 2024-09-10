<?php

namespace App\Jobs;

use App\Models\Preference;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchPreferencesBatch implements ShouldQueue
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
            $response = Http::get('http://127.0.0.1:8000/api/preferences?page=' . $this->page);
            $preferences= $response->json();
            if ($preferences) {
                foreach ($preferences['data'] as $preference) {
                    Preference::updateOrCreate(
                        ['preference_id' => $preference['id']],
                        [
                            'attendee_id' => $preference['attendee_id'],
                           // 'event_id' => $preference['event_id'],
                            'preferences' => $preference['preferences'],
                        ]
                    );
                }
            }
        }
    }
}
