<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Notifications\Announcement;
use App\Http\Controllers\FireBaseController;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        // $user = User::findOrFail();

        $fire = new FireBaseController;
        # Set FireBase 
        $fire->to       = auth()->user()->fcm_token;
        $fire->title    = __('site.app_manager');
        $fire->body     = __('site.welcome_to_drugly');

        $fire->type     = 'announcement';
        $fire->link     = 'javascript:void(0)';
        $fire->date     = Carbon::now();

        $fire->sound    = true;
        $fire->send();

        auth()->user()->notify(new Announcement());
    }

   /**
     * Mark all user notification as read.
     *
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request)
    {
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json( ['status'=>200] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
