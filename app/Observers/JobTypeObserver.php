<?php

namespace App\Observers;

use App\Models\JobType;
use Auth;

class JobTypeObserver
{

    /**
     * Handle the JobType "created" event.
     *
     * @param  \App\Models\JobType  $jobType
     * @return void
     */
    public function created(JobType $jobType)
    {
        $str = "JBTP";
        $jobType->unique_id = str_pad($str, 10, "0", STR_PAD_RIGHT) . $jobType->id;
        $jobType->save();
    }

    /**
     * Handle the JobType "updated" event.
     *
     * @param  \App\Models\JobType  $jobType
     * @return void
     */
    public function updated(JobType $jobType)
    {
        //
    }

    /**
     * Handle the JobType "deleted" event.
     *
     * @param  \App\Models\JobType  $jobType
     * @return void
     */
    public function deleted(JobType $jobType)
    {
        //
    }

    /**
     * Handle the JobType "restored" event.
     *
     * @param  \App\Models\JobType  $jobType
     * @return void
     */
    public function restored(JobType $jobType)
    {
        //
    }

    /**
     * Handle the JobType "force deleted" event.
     *
     * @param  \App\Models\JobType  $jobType
     * @return void
     */
    public function forceDeleted(JobType $jobType)
    {
        //
    }
}
