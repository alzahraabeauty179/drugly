<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\Notification;
use App\Notifications\Announcement;
use App\Http\Controllers\FireBaseController;
use Carbon\Carbon;

class NotificationController extends BackEndController
{

    /**
     * Constructor.
     */
    protected $model;
    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows =  $this->model->where('is_announcement', 1)->where('created_by', auth()->user()->id)->get();

        $module_name_plural = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();

        return view('dashboard.' . $module_name_plural . '.index', compact('rows','module_name_singular', 'module_name_plural'));
    }

   /**
     * Mark all user notifications as read.
     *
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request)
    {
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json( ['status'=>200] );
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $module_name_plural   = 'announcements';
        $module_name_singular = 'announcement';
        
        $users  = User::where('type', '!=', 'super_admin')->get();
        $append = ['users'=>$users];

        return view('dashboard.' . $this->getClassNameFromModel() . '.create', compact('module_name_singular', 'module_name_plural'))->with($append);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
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

        $message = ['en'=>'Welcome To Drugly App!', 'ar'=>'مرحبا بك في تطبيق Drugly!'];
        auth()->user()->notify(new Announcement($message));
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
    public function destroy($id, Request $request)
    {
        //
    }
}
