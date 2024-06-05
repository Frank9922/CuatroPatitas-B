<?php

namespace App\Jobs;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendRegistrationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Model $model
    )
    {
        $this->model = $model;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {    

        $token = Str::random(40);
        $this->model->token_verificacion = $token;
        $this->model->save();

        Mail::to($this->model->email)->send(new VerifyEmail($this->model, $token));

    }
}
