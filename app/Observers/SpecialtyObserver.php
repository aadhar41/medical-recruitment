<?php

namespace App\Observers;

use App\Models\Specialty;

class SpecialtyObserver
{
    /**
     * Handle the Specialty "created" event.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return void
     */
    public function created(Specialty $specialty)
    {
        $str = "SPETY";
        $specialty->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $specialty->id;
        $specialty->save();
    }

    /**
     * Handle the Specialty "updated" event.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return void
     */
    public function updated(Specialty $specialty)
    {
        //
    }

    /**
     * Handle the Specialty "deleted" event.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return void
     */
    public function deleted(Specialty $specialty)
    {
        //
    }

    /**
     * Handle the Specialty "restored" event.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return void
     */
    public function restored(Specialty $specialty)
    {
        //
    }

    /**
     * Handle the Specialty "force deleted" event.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return void
     */
    public function forceDeleted(Specialty $specialty)
    {
        //
    }
}
