<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\api\UserController;


class getData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fech data from apy for the every 5 munets';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new UserController();
        $user->Getdata();

        $this->info('Command executed successfully.');
    }
}
