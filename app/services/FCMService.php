<?php

namespace app\Services;

class FCMService
{
    public static function send($userDeviceDetail, $notification)
    {
        $serverApiKey = env('FCM_SERVER_KEY');
        $payload = [
            "notification" => [
                "title" => $notification['title'],
                "body" => $notification['body']['description'],
            ],
            "data" => [
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                "body" => $notification['body'],

            ],
            "android" => [
                "priority" => 'high',
            ],
            "registration_ids" => $userDeviceDetail->pluck('fcmToken')->all(),
        ];
        $dataString = json_encode($payload);
        $headers = [
            'Authorization: key=' . $serverApiKey,
            'Content-Type: application/json',
        ];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        return curl_exec($ch);
        
    }
}
