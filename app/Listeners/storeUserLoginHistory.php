<?php

namespace App\Listeners;

use App\Events\LoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class storeUserLoginHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LoginHistory  $event
     * @return void
     */
    public function handle(LoginHistory $event)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();

        $userinfo = $event->user;
        if (isset($userinfo)) {
            $today = date("Y-m-d");
            $main = DB::table('login_histories')->where(['name' => $userinfo->name, 'user_id' => $userinfo->id, 'server_name' => $_SERVER['SERVER_NAME'], 'http_user_agent' => $_SERVER['HTTP_USER_AGENT'], 'email' => $userinfo->email, 'role' => $userinfo->role])->where("created_at", "like", '%' . $today . '%')->get();
            $users = DB::table('login_histories')->where(['name' => $userinfo->name, 'user_id' => $userinfo->id, 'server_name' => $_SERVER['SERVER_NAME'], 'http_referer' => $_SERVER['HTTP_REFERER'], 'http_user_agent' => $_SERVER['HTTP_USER_AGENT'], 'email' => $userinfo->email, 'role' => $userinfo->role])->where("created_at", "like", '%' . $today . '%')->get();

            if (count($main) == 0) {
                $saveHistory = DB::table('login_histories')->insert(
                    ['name' => $userinfo->name, 'user_id' => $userinfo->id, 'server_name' => $_SERVER['SERVER_NAME'], 'http_referer' => $_SERVER['HTTP_REFERER'], 'http_user_agent' => $_SERVER['HTTP_USER_AGENT'], 'email' => $userinfo->email, 'role' => $userinfo->role, 'created_at' => $current_timestamp, 'updated_at' => $current_timestamp]
                );
                return $saveHistory;
            } else {
                if (count($users) <= env("LOGIN_HISTORY_ROW", 2)) {
                    $row = DB::table('login_histories')->where(['name' => $userinfo->name, 'user_id' => $userinfo->id, 'server_name' => $_SERVER['SERVER_NAME'], 'http_referer' => $_SERVER['HTTP_REFERER'], 'http_user_agent' => $_SERVER['HTTP_USER_AGENT'], 'email' => $userinfo->email, 'role' => $userinfo->role])->where("created_at", "like", '%' . $today . '%')->first();
                    if (!empty($row->http_referer)) {
                        if ((strpos($row->http_referer, 'admin/dashboard') !== false) || (strpos($row->http_referer, 'login') !== false)) {
                            $saveHistory = DB::table('login_histories')->insert(
                                ['name' => $userinfo->name, 'user_id' => $userinfo->id, 'server_name' => $_SERVER['SERVER_NAME'], 'http_referer' => $_SERVER['HTTP_REFERER'], 'http_user_agent' => $_SERVER['HTTP_USER_AGENT'], 'email' => $userinfo->email, 'role' => $userinfo->role, 'created_at' => $current_timestamp, 'updated_at' => $current_timestamp]
                            );
                            return $saveHistory;
                        }
                    }
                } else {
                    return "";
                }
            }
        }
        return "";
    }
}
