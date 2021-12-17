<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SampleBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:sample';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is the batch of testing cron.';

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
     * @return int
     */
    public function handle()
    {
        echo "==================[Sample]=============\n";
        echo "こんにちは\n";
        echo "==================[/Sample]=============\n";
        return 0;
    }
}
