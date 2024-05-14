<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Reservation;

class RemoveHasNoticeReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:remove-has-notice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove reservations with notice period past 3 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::now();

        $reservationsToDelete = Reservation::where('has_notice', true)
            ->whereDate('updated_at', '<=', $currentDate->subDays(3))
            ->pluck('id');

        Reservation::whereIn('id', $reservationsToDelete)->delete();

        $this->info('Reservations with notice removed successfully.');
    }
}
