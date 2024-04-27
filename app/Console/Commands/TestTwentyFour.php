<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use App\Services\TwentyFourService;

class TestTwentyFour extends Command
{
    protected $signature = 'twentyFour:test';
 
    protected $description = '24시 화물 배차';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // $data = (new TwentyFourService)->getCarTon();
        // $data = (new TwentyFourService)->getCarType();
        $data = (new TwentyFourService)->getAddr();
        Log::debug($data);
    }
}
