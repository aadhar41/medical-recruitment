<?php

namespace App\Observers;

use App\Models\JobApplication;

class JobApplicationObserver
{
    /**
     * Handle the JobApplication "created" event.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return void
     */
    public function created(JobApplication $jobApplication)
    {
        $str = "JOBALTN";
        $jobApplication->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $jobApplication->id;
        $jobApplication->save();
    }

    /**
     * Handle the JobApplication "updated" event.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return void
     */
    public function updated(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Handle the JobApplication "deleted" event.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return void
     */
    public function deleted(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Handle the JobApplication "restored" event.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return void
     */
    public function restored(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Handle the JobApplication "force deleted" event.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return void
     */
    public function forceDeleted(JobApplication $jobApplication)
    {
        //
    }
}
