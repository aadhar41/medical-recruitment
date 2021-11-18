<?php

namespace App\Observers;

use App\Models\BuySell;
use Illuminate\Support\Str;

class BuySellObserver
{
    /**
     * Handle the BuySell "created" event.
     *
     * @param  \App\Models\BuySell  $buySell
     * @return void
     */
    public function created(BuySell $buySell)
    {
        $buySell->slug = Str::slug($buySell->title) . "-" . time();
        $str = "BYSLL";
        $buySell->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $buySell->id;
        $buySell->save();
    }

    /**
     * Handle the BuySell "updated" event.
     *
     * @param  \App\Models\BuySell  $buySell
     * @return void
     */
    public function updated(BuySell $buySell)
    {
        //
    }

    /**
     * Handle the BuySell "deleted" event.
     *
     * @param  \App\Models\BuySell  $buySell
     * @return void
     */
    public function deleted(BuySell $buySell)
    {
        //
    }

    /**
     * Handle the BuySell "restored" event.
     *
     * @param  \App\Models\BuySell  $buySell
     * @return void
     */
    public function restored(BuySell $buySell)
    {
        //
    }

    /**
     * Handle the BuySell "force deleted" event.
     *
     * @param  \App\Models\BuySell  $buySell
     * @return void
     */
    public function forceDeleted(BuySell $buySell)
    {
        //
    }
}
