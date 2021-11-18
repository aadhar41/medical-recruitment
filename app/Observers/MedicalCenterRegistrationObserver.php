<?php

namespace App\Observers;

use App\Models\MedicalCenterRegistration;

class MedicalCenterRegistrationObserver
{
    /**
     * Handle the MedicalCenterRegistration "created" event.
     *
     * @param  \App\Models\MedicalCenterRegistration  $medicalCenterRegistration
     * @return void
     */
    public function created(MedicalCenterRegistration $medicalCenterRegistration)
    {
        $str = "MDCNTR";
        $medicalCenterRegistration->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $medicalCenterRegistration->id;
        $medicalCenterRegistration->save();
    }

    /**
     * Handle the MedicalCenterRegistration "updated" event.
     *
     * @param  \App\Models\MedicalCenterRegistration  $medicalCenterRegistration
     * @return void
     */
    public function updated(MedicalCenterRegistration $medicalCenterRegistration)
    {
        //
    }

    /**
     * Handle the MedicalCenterRegistration "deleted" event.
     *
     * @param  \App\Models\MedicalCenterRegistration  $medicalCenterRegistration
     * @return void
     */
    public function deleted(MedicalCenterRegistration $medicalCenterRegistration)
    {
        //
    }

    /**
     * Handle the MedicalCenterRegistration "restored" event.
     *
     * @param  \App\Models\MedicalCenterRegistration  $medicalCenterRegistration
     * @return void
     */
    public function restored(MedicalCenterRegistration $medicalCenterRegistration)
    {
        //
    }

    /**
     * Handle the MedicalCenterRegistration "force deleted" event.
     *
     * @param  \App\Models\MedicalCenterRegistration  $medicalCenterRegistration
     * @return void
     */
    public function forceDeleted(MedicalCenterRegistration $medicalCenterRegistration)
    {
        //
    }
}
