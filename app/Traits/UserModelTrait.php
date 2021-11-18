<?php

namespace App\Traits;

use App\Models\Job;
use App\Models\JobType;
use App\Models\BuySell;
use App\Models\BuySellMedia;
use App\Models\JobCategory;
use App\Models\Specialty;
use App\Models\Profession;
use App\Models\MedicalCenterRegistration;
use App\Models\JobSeekerRegistration;

trait UserModelTrait
{
    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function jobseekerregistration()
    {
        return $this->hasOne('App\Models\JobSeekerRegistration', 'user_id');
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function jobtype()
    {
        return $this->hasMany(JobType::class);
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function jobcategory()
    {
        return $this->hasMany(JobCategory::class);
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function profession()
    {
        return $this->hasMany(Profession::class);
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function specialty()
    {
        return $this->hasMany(Specialty::class);
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function job()
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function profile()
    {
        return $this->hasOne('App\Models\MedicalCenterRegistration', 'user_id');
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function jobseekerprofile()
    {
        return $this->hasOne('App\Models\JobSeekerRegistration', 'user_id');
    }


    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function buysell()
    {
        return $this->hasMany(BuySell::class);
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function buysellmedia()
    {
        return $this->hasMany(BuySellMedia::class);
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    // public function buysells()
    // {
    //     return $this->hasMany('App\Models\BuySell', 'user_id');
    // }
}
