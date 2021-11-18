<?php

namespace App\Traits;

trait RoleTrait
{
    public function scopeSuperadmin($query)
    {
        return $query->where("role", "0");
    }

    public function scopeAdmin($query)
    {
        return $query->where("role", "1");
    }

    public function scopeJobseeker($query)
    {
        return $query->where("role", "2");
    }

    public function scopeMedicalcenter($query)
    {
        return $query->where("role", "3");
    }

    public function scopeDoctor($query)
    {
        return $query->where("role", "4");
    }
}
