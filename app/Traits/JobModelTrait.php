<?php

namespace App\Traits;

use App\Models\User;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\Specialty;
use App\Models\Profession;
use App\Models\State;
use App\Models\City;
use App\Models\Suburb;
use App\Models\MedicalCenterRegistration;
use App\Models\JobSeekerRegistration;

trait JobModelTrait
{
    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function createdby()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->select("name", "email", "id");
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function associatedJobtype()
    {
        return $this->belongsTo('App\Models\JobType', 'job_type')->select("id", "jobtype");
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function jobcategory()
    {
        return $this->belongsTo('App\Models\JobCategory', 'job_category')->select("id", "name");
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function medicalcenter()
    {
        return $this->belongsTo('App\Models\User', 'medical_center')->select("id", "name", "email");
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function associatedProfession()
    {
        return $this->belongsTo('App\Models\Profession', 'profession')->select("id", "profession");
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function associatedSpeciality()
    {
        return $this->belongsTo('App\Models\Specialty', 'speciality')->select("id", "specialty");
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function associatedState()
    {
        return $this->belongsTo('App\Models\State', 'state')->select("id", "name", "iso2", "latitude", "longitude");
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function associatedCity()
    {
        return $this->belongsTo('App\Models\City', 'city')->select("id", "name", "latitude", "longitude");
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function associatedSuburb()
    {
        return $this->belongsTo('App\Models\Suburb', 'suburb')->select("id", "suburb", "lat", "lng");
    }
}
