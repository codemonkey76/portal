<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use App\Models\ServiceAgreement;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceAgreementInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service-agreement:invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!ServiceAgreement::active()->count())
        {
            $this->info('No active service agreements found.');
            return 0;
        }

        $sa = ServiceAgreement::active()->first();

        $startOfPeriod = 'startOf' . Str::of($sa->frequencyString)->remove('ly')->toString();
        $endOfPeriod = 'endOf' . Str::of($sa->frequencyString)->remove('ly');

        $invoiceRangeStart = now()->$startOfPeriod();
        $invoiceRangeEnd = now()->$endOfPeriod();

        if ($sa->invoices()->whereBetween('transaction_date', [$invoiceRangeStart, $invoiceRangeEnd])->count())
        {
            $this->info("Service Agreement: {$sa->id}, already invoiced this period.");
            return 0;
        }

        DB::transaction(function() use ($sa) {

            $i = Invoice::create([
                'transaction_date' => now(),
                'customer_id' => $sa->customer_id,
                'service_agreement_id' => $sa->id
            ]);

            $this->info("Created invoice #: {$i->id}");
        });

        return 0;
    }
}
