<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FireBaseController extends Controller
{
    /**
     * @var string $to device's registration token fcmToken
    * @var string  $messageBody  
    * @var string $title 
    * @var string $sound 
    * @var string $mobileType ios or android
    */
    public $to;
    public $messageBody;
    public $title;
    public $sound;

    public function getFieldsToSend() 
    { 
        return [
            "priority" => "high",
            "notification" => [
                "title"=> $this->title,
                "body" => $this->messageBody,
            ],
            "data"=> $this,
            "to"  => $this->to, //in single case
            // "reqisteration_ids"=> $this->fcmList //in list case
        ];
    }

    public function send()
    {
        $curl = curl_init("https://fcm.googleapis.com/fcm/send");
        curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization:key=AAAAnn7sQtI:APA91bFyMITrS9VBQrVE_-LRhFo0IiOv8l1t7M_Sg5NZNVfnRv9NeLLH33WbBTK_XZcLi0ZKYlvju3bsXiBG-SHlXEDhRMm5o-cJzbn1eCLmKC1gDGbxcn8pcMX73p2iYe5XL4Od6ZdJ'));
        curl_setopt( $curl,CURLOPT_POST, true );
        //curl_setopt( $curl,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $curl,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $curl,CURLOPT_POSTFIELDS, json_encode( $this->getFieldsToSend() ) );
        $ret = curl_exec($curl);
        curl_close($curl);
        return $ret;
    }

    public function updateUserFCM(Request $request)
    { 
        User::where('id', auth()->user()->id)->update(['fcm_token' => $request->fcm_token]);

        return response()->json( ['status'=>200] );
    }

    # CURL
    //curl -X POST -H "Authorization: key=AAAAnn7sQtI:APA91bFyMITrS9VBQrVE_-LRhFo0IiOv8l1t7M_Sg5NZNVfnRv9NeLLH33WbBTK_XZcLi0ZKYlvju3bsXiBG-SHlXEDhRMm5o-cJzbn1eCLmKC1gDGbxcn8pcMX73p2iYe5XL4Od6ZdJ" -H "Content-Type: application/json" -d "{\"to\": \"epxBJqkZ-8-z8ny9x9-lje:APA91bEfhZOffdFZKzy_ohn76UhXf9d7HW7xqvxdTrgOyBvHCogQgH7j-16r-NPbwU0LRP8bhzKfB9Fs70AVl9c3rz1g3TrigPEz29t423dBhSC0OHiFY3cvQNcioHFOS0Y6G9DoQeTj\", \"notification\": { \"title\": \"Drugly\", \"body\": \"You have a new notification to see!\", \"icon\": \"/firebase_logo.png\" }, \"data\":{\"link\" : \"firebase.com\", \"flag\": \"test\"} }" "https://fcm.googleapis.com/fcm/send"

}
