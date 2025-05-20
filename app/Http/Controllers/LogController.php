<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LogController extends Controller
{
   public function index() {
    $logs = DB::table('user_logs')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($log) {
            $log->created_at = \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Tokyo')->format('H:i:s');
            return $log;
        });
    return view('logs.index', compact('logs'));
    }
    public function userIndex(Request $request) {
    $userlogs = DB::table('users')
        ->select('name', 'email', 'created_at', 'updated_at', 'avatar', 'phone')
        ->get()
        ->map(function ($user) {
            $user->created_at = $user->created_at ? \Carbon\Carbon::parse($user->created_at)->setTimezone('Asia/Tokyo')->format('Y-m-d H:i:s') : null;
            $user->updated_at = $user->updated_at ? \Carbon\Carbon::parse($user->updated_at)->setTimezone('Asia/Tokyo')->format('Y-m-d H:i:s') : null;
            return $user;
        });

    return view('logs.userIndex', compact('userlogs'));   
}
}