<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApartmentNotiController extends Controller
{
    /**
     * Make notification for app
     *
     * @param Request $request
     * @return void
     */
    public function sendNotification(Request $request)
    {
        $firebaseToken = User::whereNotNull('device_key')->pluck('device_key')->toArray();
        $SERVER_API_KEY = 'AAAADaO0RLk:APA91bGyIkqpVdV5HmJ3IzP2ltyqmPrQqJSEzLULdLs4VAhfRmUZ5hxct9sLk8d6CiQBpyX6ipKoDgIfeaIHUOC3-gLmEFH3z7FPnr_Y6vngyufbWzfB0PQvOQ7PhgGkiUnz3ZMIxzbb';
        $data = [
            "registration_ids" => $firebaseToken,
            "notification"     => [
                "title"             => 'hello',
                "body"              => 'hello',
                "priority"          => "high",
                "content_available" => true,
            ],
        ];
        $dataString = json_encode($data);
        $headers = [
            "Authorization: key=" . $SERVER_API_KEY,
            "Content-Type: application/json",
        ];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd($response);
    }

}
