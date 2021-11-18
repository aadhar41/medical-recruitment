<?php

namespace App\Observers;

use App\Models\JobCategory;

class JobCategoryObserver
{
    /**
     * Handle the JobCategory "created" event.
     *
     * @param  \App\Models\JobCategory  $jobCategory
     * @return void
     */
    public function created(JobCategory $jobCategory)
    {
        $str = "JBCAT";
        $jobCategory->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $jobCategory->id;
        $jobCategory->save();
    }

    /**
     * Handle the JobCategory "updated" event.
     *
     * @param  \App\Models\JobCategory  $jobCategory
     * @return void
     */
    public function updated(JobCategory $jobCategory)
    {
        //
    }

    /**
     * Handle the JobCategory "deleted" event.
     *
     * @param  \App\Models\JobCategory  $jobCategory
     * @return void
     */
    public function deleted(JobCategory $jobCategory)
    {
        //
    }

    /**
     * Handle the JobCategory "restored" event.
     *
     * @param  \App\Models\JobCategory  $jobCategory
     * @return void
     */
    public function restored(JobCategory $jobCategory)
    {
        //
    }

    /**
     * Handle the JobCategory "force deleted" event.
     *
     * @param  \App\Models\JobCategory  $jobCategory
     * @return void
     */
    public function forceDeleted(JobCategory $jobCategory)
    {
        //
    }
}
