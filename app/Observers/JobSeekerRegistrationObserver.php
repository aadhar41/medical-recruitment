<?php

namespace App\Observers;

use App\Models\JobSeekerRegistration;

class JobSeekerRegistrationObserver
{
    /**
     * Handle the JobSeekerRegistration "created" event.
     *
     * @param  \App\Models\JobSeekerRegistration  $jobSeekerRegistration
     * @return void
     */
    public function created(JobSeekerRegistration $jobSeekerRegistration)
    {
        $str = "JBSKRG";
        $jobSeekerRegistration->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $jobSeekerRegistration->id;
        $jobSeekerRegistration->save();
    }

    /**
     * Handle the JobSeekerRegistration "updated" event.
     *
     * @param  \App\Models\JobSeekerRegistration  $jobSeekerRegistration
     * @return void
     */
    public function updated(JobSeekerRegistration $jobSeekerRegistration)
    {
        //
    }

    /**
     * Handle the JobSeekerRegistration "deleted" event.
     *
     * @param  \App\Models\JobSeekerRegistration  $jobSeekerRegistration
     * @return void
     */
    public function deleted(JobSeekerRegistration $jobSeekerRegistration)
    {
        //
    }

    /**
     * Handle the JobSeekerRegistration "restored" event.
     *
     * @param  \App\Models\JobSeekerRegistration  $jobSeekerRegistration
     * @return void
     */
    public function restored(JobSeekerRegistration $jobSeekerRegistration)
    {
        //
    }

    /**
     * Handle the JobSeekerRegistration "force deleted" event.
     *
     * @param  \App\Models\JobSeekerRegistration  $jobSeekerRegistration
     * @return void
     */
    public function forceDeleted(JobSeekerRegistration $jobSeekerRegistration)
    {
        //
    }
}
