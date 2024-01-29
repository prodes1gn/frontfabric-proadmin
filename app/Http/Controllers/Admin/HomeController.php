<?php

namespace App\Http\Controllers\Admin;
use App\Models\ActivityLog;

class HomeController extends AdminController {

    // #SET TITLE
    protected $title = 'dashboard';
    
    // #DASHBOARD
    public function index() {

        // #TITLES
        $title = trans('global.dashboard');
        $task = null;
        
        // #LAST USER ACTIVITY
        $activity_log = ActivityLog::with('user')->orderBy('created_at', 'desc')->take(100)->get();

        // #VIEW
        return view('admin.dashboard.index', compact('title', 'task', 'activity_log'));
    }

}
