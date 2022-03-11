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
    /**
     * @throws ConfigurationException
     */
    public function createFireNotification(Request $request): JsonResponse
    {
        try {
            $account_sid = 'AC9c74cd63bd797ebde76dd392b43a701b';
            $auth_token = '7bbfdf8bf7021de7416cf7971aeb69d6';
            $twilio_number = "+16812461465";

            $client = new Client($account_sid, $auth_token);
            $notification = new Notification();
            $request->validate([
                'title'   => 'required',
                'content' => 'required',
            ]);
            $data = $request->all();
            $status = $notification->fill($data)->save();
            if ($status){
                $receivers = User::where('status', Notification::ACTIVE_USER)->get();
                foreach ($receivers->chunk(10) as $receiver) {
                    $phoneNumber = substr($receiver->phone, 1);
                    $receiverNumber = '+84' . $phoneNumber;
                    $client->messages->create($receiverNumber, [
                        'from' => $twilio_number,
                        'body' => [
                            'BÁO CHÁY: ' . $notification->content . '.',
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
