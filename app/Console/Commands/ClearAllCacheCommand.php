<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ClearAllCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear cache all application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        echo "Clear cache all application";
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
    }
}
