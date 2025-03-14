<?php

namespace App\Observers;

use App\Models\BalanceTransaction;
use Illuminate\Support\Facades\Log;

class BalanceTransactionObserver
{
    /**
     * Handle the BalanceTransaction "created" event.
     */
    public function created(BalanceTransaction $balanceTransaction): void
    {
        //
    }

    /**
     * Handle the BalanceTransaction "updated" event.
     */
    public function updated(BalanceTransaction $transaction)
    {
        if ($transaction->isDirty('status') && $transaction->status === 'approved') {
            $transaction->user->updateTotalSpent($transaction->total_price);
            $transaction->user->processReferralBonus($transaction->total_price);
        }

        Log::info($transaction->user);
    }

    /**
     * Handle the BalanceTransaction "deleted" event.
     */
    public function deleted(BalanceTransaction $balanceTransaction): void
    {
        //
    }

    /**
     * Handle the BalanceTransaction "restored" event.
     */
    public function restored(BalanceTransaction $balanceTransaction): void
    {
        //
    }

    /**
     * Handle the BalanceTransaction "force deleted" event.
     */
    public function forceDeleted(BalanceTransaction $balanceTransaction): void
    {
        //
    }
}
