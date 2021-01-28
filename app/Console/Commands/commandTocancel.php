<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class commandTocancel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commandes:canceled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'canceled succ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('commandes')
        ->whereRaw("DATEDIFF('" . Carbon::now() . "' , created_at)  = 0")
        ->update(['day1' => 0,'day2' => 0,'day3' => 0,'status' => 1]);
       
    }
}
