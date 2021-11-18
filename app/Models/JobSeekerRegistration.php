<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StatusTrait;

class JobSeekerRegistration extends Model
{
    use HasFactory;
    use SoftDeletes;
    use StatusTrait;

    protected $table = 'job_seeker_registrations';

    protected $fillable = ['user_id', 'created_at', 'updated_at'];

    /**
     * Accessor function 
     * 
     * @return "returns applied ucwords function text"
     */
    public function getFullnameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Get the user that owns the record.
     */
    public function user()
    {
        return $this->belongsTo("App\Models\User", "id");
    }

    /**
     * Get the profession details.
     */
    public function professiondetails()
    {
        return $this->belongsTo("App\Models\Profession", "profession", "id")->select("id", "unique_code", "profession");
    }

    /**
     * Get the speciality details.
     */
    public function specialitydetails()
    {
        return $this->belongsTo("App\Models\Specialty", "specialty", "id")->select("id", "unique_code", "specialty");
    }

    /**
     * Get the state details.
     */
    public function statedetails()
    {
        return $this->belongsTo('App\Models\State', 'location')->select("id", "name", "iso2", "latitude", "longitude", "timezone");
    }


    /**
     * Get the city details.
     */
    public function citydetails()
    {
        return $this->belongsTo('App\Models\City', 'city')->select("id", "name", "postcode", "latitude", "longitude");
    }

    /**
     * Get the suburb details.
     */
    public function suburbdetails()
    {
        return $this->belongsTo('App\Models\Suburb', 'suburb')->select("id", "suburb", "postcode", "state", "lat", "lng", "timezone");
    }
}
