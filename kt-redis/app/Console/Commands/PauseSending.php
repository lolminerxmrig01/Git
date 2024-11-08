<?php

namespace App\Console\Commands;

use App\Campaign;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use League\Csv\Writer;

class PauseSending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaing-sending:pause';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        if (date("H") > "18" || date("H") < "07") {
			$campaigns = Campaign::where('status', 'sending')->get();

			foreach ($campaigns as $campaign) {
				$campaign->update(['status' => 'paused']);
			}
        }
    }
}
