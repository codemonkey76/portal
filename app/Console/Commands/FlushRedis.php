<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class FlushRedis extends Command
{
    protected $signature = 'redis:flush';

    protected $description = 'Flush Redis Cache';

    public function handle()
    {
        Redis::command('flushdb');
    }
}
