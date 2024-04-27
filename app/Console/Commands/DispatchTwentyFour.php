<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DispatchTwentyFour extends Command
{
    protected $signature = 'twentyFour:dispatch';
 
    protected $description = '24시 화물 배차';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::debug('schedule');
    }
}
