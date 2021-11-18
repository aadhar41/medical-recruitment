<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class QueryHelper
{
    /**
     * https://stackoverflow.com/questions/28290332/best-practices-for-custom-helpers-in-laravel-5
     * Usage in blade :
     * {!! QueryHelper::logquery('this is how to use autoloading correctly!!') !!}
     * Usage in controller :
     * use QueryHelper;
     * QueryHelper::shout('now i\'m using my helper class in a controller!!');
     */
    public static function logquery($query)
    {

        // \DB::connection()->enableQueryLog();
        \DB::enableQueryLog();
        $query;
        $data = \DB::getQueryLog();
        return dd($data);
    }
}
