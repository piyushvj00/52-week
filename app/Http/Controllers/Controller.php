<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function createNotification($title, $user_id, $receiver_id)
    {
        Notification::create([
            'title' => $title,
            'user_id' => $user_id,
            'receiver_id' => $receiver_id,
            'is_read' => false
        ]);
    }
}
