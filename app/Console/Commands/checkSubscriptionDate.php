<?php

namespace App\Console\Commands;

use App\Models\PackageSubscription;
use Illuminate\Console\Command;

class checkSubscriptionDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will update status when next billing date is over';

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
        PackageSubscription::where('next_billing_date', '<', now())->update(['status' => 'expired']);
    }
}
