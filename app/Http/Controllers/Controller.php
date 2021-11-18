<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return a sanitizing a string.
     *
     * @param  $string
     * @return  $string
     */
    public function sanitizeString($string)
    {
        $str = trim($string);
        $str = strtolower($str);
        $str = preg_replace("![^a-z0-9]+!i", " ", $str);
        $str = filter_var($str, FILTER_SANITIZE_STRING);
        return $str;
    }

    /**
     * Return a slug from a string.
     *
     * @param  $string
     * @return  $string
     */
    public function generateSlug($string)
    {
        $slug = Str::slug($string, '-');
        $slug = strtolower($slug);
        return $slug;
    }
}
