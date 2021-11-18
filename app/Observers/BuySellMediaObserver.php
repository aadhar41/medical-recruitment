<?php

namespace App\Observers;

use App\Models\BuySellMedia;

class BuySellMediaObserver
{
    /**
     * Handle the BuySellMedia "created" event.
     *
     * @param  \App\Models\BuySellMedia  $buySellMedia
     * @return void
     */
    public function created(BuySellMedia $buySellMedia)
    {
        $str = "BYSLMD";
        $buySellMedia->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $buySellMedia->id;
        $buySellMedia->save();
    }

    /**
     * Handle the BuySellMedia "updated" event.
     *
     * @param  \App\Models\BuySellMedia  $buySellMedia
     * @return void
     */
    public function updated(BuySellMedia $buySellMedia)
    {
        //
    }

    /**
     * Handle the BuySellMedia "deleted" event.
     *
     * @param  \App\Models\BuySellMedia  $buySellMedia
     * @return void
     */
    public function deleted(BuySellMedia $buySellMedia)
    {
        //
    }

    /**
     * Handle the BuySellMedia "restored" event.
     *
     * @param  \App\Models\BuySellMedia  $buySellMedia
     * @return void
     */
    public function restored(BuySellMedia $buySellMedia)
    {
        //
    }

    /**
     * Handle the BuySellMedia "force deleted" event.
     *
     * @param  \App\Models\BuySellMedia  $buySellMedia
     * @return void
     */
    public function forceDeleted(BuySellMedia $buySellMedia)
    {
        //
    }
}
