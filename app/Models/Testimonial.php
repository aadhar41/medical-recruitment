<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\User;
use App\Traits\StatusTrait;

class Testimonial extends Model
{
    use HasFactory;
    use SoftDeletes;
    use StatusTrait;

    protected $table = 'testimonials';

    protected $fillable = ['slug', 'user_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Mutator function for creating slug from title.
     * 
     * @return "returns slug for given title."
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $slug = Str::slug($value, '-');
        $this->attributes['slug'] = strtolower($slug) . "-" . time();
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function userdetails()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->select("id", "name", "email");
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function usermoredetails()
    {
        return $this->belongsTo('App\Models\JobSeekerRegistration', 'user_id');
    }
}
