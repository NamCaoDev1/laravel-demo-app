<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendMailRegister implements ShouldQueue
{
    use Queueable;
    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        echo "Gui mai den account {$this->user->username}";
        sleep(10);
    }
}
