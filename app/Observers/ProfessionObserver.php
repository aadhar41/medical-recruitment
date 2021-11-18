<?php

namespace App\Observers;

use App\Models\Profession;

class ProfessionObserver
{
    /**
     * Handle the Profession "created" event.
     *
     * @param  \App\Models\Profession  $profession
     * @return void
     */
    public function created(Profession $profession)
    {
        $str = "PROFS";
        $profession->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $profession->id;
        $profession->save();
    }

    /**
     * Handle the Profession "updated" event.
     *
     * @param  \App\Models\Profession  $profession
     * @return void
     */
    public function updated(Profession $profession)
    {
        //
    }

    /**
     * Handle the Profession "deleted" event.
     *
     * @param  \App\Models\Profession  $profession
     * @return void
     */
    public function deleted(Profession $profession)
    {
        //
    }

    /**
     * Handle the Profession "restored" event.
     *
     * @param  \App\Models\Profession  $profession
     * @return void
     */
    public function restored(Profession $profession)
    {
        //
    }

    /**
     * Handle the Profession "force deleted" event.
     *
     * @param  \App\Models\Profession  $profession
     * @return void
     */
    public function forceDeleted(Profession $profession)
    {
        //
    }
}
