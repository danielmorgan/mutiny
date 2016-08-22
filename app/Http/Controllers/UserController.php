<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePushNotificationSetting(Request $request, User $user)
    {
        if (! is_bool($request->push_notifications_enabled)) {
            throw new \InvalidArgumentException;
        }

        if (! $user) {
            throw new UnauthorizedException;
        }

        $user->push_notifications_enabled = $request->push_notifications_enabled;
        $user->save();

        return response()->json(['push_notifications_enabled' => $user->push_notifications_enabled]);
    }
}
