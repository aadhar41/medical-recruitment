<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\StatusTrait;
use App\Traits\JobModelTrait;
use Illuminate\Pipeline\Pipeline;
use Session;
use Auth;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;
    use StatusTrait;
    use JobModelTrait;

    protected $table = 'jobs';

    protected $guarded = [];

    const EXCERPT_LENGTH = 250;

    protected $fillable = [
        'job_type', 'job_category', 'medical_center',
        'profession', 'speciality', 'state', 'city',
        'suburb', 'rate', 'work_days', 'title', 'from_date', 'to_date',
        'address', 'practice_offer', 'essential_criteria', 'description',
        'user_id', 'created_at', 'updated_at'
    ];

    /**
     * Function for return excerpt of given text.
     * 
     * @return "returns excerpt for given text"
     */
    public function excerpt()
    {
        return Str::limit($this->description, env('EXCERPT_LENGTH', 250));
        // return Str::limit($this->description, BuySell::EXCERPT_LENGTH);
    }

    /**
     * Search function that implement QueryFilter on Query..
     * 
     * @return "returns search result based according to various query filter defined."
     */
    public static function searchResult()
    {
        $jobs = app(Pipeline::class)
            ->send(\App\Models\Job::query()->active()->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng"))
            ->through([
                \App\QueryFilters\JobType::class,
                \App\QueryFilters\Profession::class,
                \App\QueryFilters\Specialty::class,
                \App\QueryFilters\State::class,
                \App\QueryFilters\City::class,
                \App\QueryFilters\Suburb::class,
            ])
            ->thenReturn()
            ->simplePaginate(5);
        // ->get();

        return $jobs;
    }
}
