<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Business;
use App\Http\Entities;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendEmails';

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
        $invoiceBL = new Business\InvoiceBL();

        // (1) get all the invoices

        $invoices= $invoiceBL->all();

        foreach ($invoices as $invoice) {

        }
    }
}
