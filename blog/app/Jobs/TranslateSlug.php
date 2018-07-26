<?php

namespace App\Jobs;

use App\Http\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $topic;
    public function __construct($topic)
    {
        //
        $this->topic = $topic;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('task:'.$this->topic);
        User::where('Code','0000H')->update(['Description'=>$this->topic]);
        User::where('Code','admin')->update(['Description'=>'liao']);
        //$slug = app(SlugTranslateHandler::class)->translate($this->topic);
        //
    }
}
