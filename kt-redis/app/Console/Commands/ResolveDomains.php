<?php

namespace App\Console\Commands;

use App\Domain;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use League\Csv\Writer;

class ResolveDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resolve-domains:generate';
    
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
        $domains = Domain::where('status', '!=', 'deleted')->get();
//echo"<pre/>";print_r($domains);
        foreach ($domains as $domain) {
            $host = gethostbyname($domain['domain']);

            if ($host === env('REDIRECT_IP')) {
                Domain::where('domain', $domain['domain'])->update(['status'=>'active']);
            }

            
        }
    }
}
