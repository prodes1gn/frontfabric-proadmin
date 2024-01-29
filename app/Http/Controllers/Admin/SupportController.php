<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Support\SupportRequest;
use Illuminate\Http\Request;
use App\Models\Support;
use Notification;
use App\Notifications\SupportNotification;
use Symfony\Component\HttpFoundation\Response;

class SupportController extends AdminController {
    
    // #SET TITLE
    protected $title = 'support'; 
    
    // #EDIT
    public function edit() {

        // #CHECK PERMISSIONS
        abort_if(!config('cms.support'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // #TITLES
        $title = trans('global.customer_support_title');

        // #DATA
        $support = [];

        // #VIEW
        return view('admin.support.edit', compact('support', 'title'));
    }

    // #UPDATE
    public function update(SupportRequest $request) {

        // #SAVE DATA
        Support::create($request->all());

        $data = [
            'number' => $request->get('number'),
            'title' => $request->get('title'),
            'text' => $request->get('text'),
        ];

        Notification::route('mail', config('cms.support'))->notify(new SupportNotification($data));
        
        // #REDIRECT
        return redirect()->route('admin.support.edit')->with('message', trans('global.customer_support_sent'));
    }

}
