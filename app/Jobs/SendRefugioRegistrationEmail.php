<?php

namespace App\Jobs;

use App\Models\Refugio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;


class SendRefugioRegistrationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Refugio $refugio)
    {
        $this->refugio = $refugio;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $token = Str::random(40);
        $this->refugio->token_verification = $token;
        $this->refugio->save();


    }
}
