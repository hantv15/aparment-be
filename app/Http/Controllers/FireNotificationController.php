<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;

class FireNotificationController extends Controller
{
    public function formFireNotification(){
        return view('notification.form');
    }

    /**
     * @throws ConfigurationException
     */
    public function createFireNotification(Request $request): JsonResponse
    {
        try {
            $client = new Client(config('services.twilio.key'), config('services.twilio.auth'));
            $notification = new Notification();
            $request->validate([
                'title'   => 'required',
                'content' => 'required',
            ]);
            $data = $request->all();
            $status = $notification->fill($data)->save();
            if ($status){
                $receivers = User::where('status', Notification::ACTIVE_USER)->whereNotNull('phone_number')->get();
                foreach ($receivers as $receiver) {
                    $phoneNumber = substr($receiver->phone_number, 1);
                    $receiverNumber = '+84' . $phoneNumber;
                    $client->messages->create($receiverNumber, [
                        'from' => config('services.twilio.phone'),
                        'body' => [
                            'Fire notification:'. $notification->title . '.' . $notification->content . '.',
                        ]]);
                }
            }
            return $this->success('Create fire notification to pop');
        } catch (\Exception $message) {
            Log::error($message->getMessage());
            return $this->failed('Have some wrong! Please contact with administator');
        }
    }
}
