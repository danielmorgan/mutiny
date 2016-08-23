<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function updatePushNotificationsSetting(Request $request)
    {
        if (! is_bool($request->push_notifications_enabled)) {
            throw new \InvalidArgumentException;
        }

        if (! $request->user()) {
            throw new AuthenticationException;
        }

        $request->user()->push_notifications_enabled = $request->push_notifications_enabled;
        $request->user()->push_notifications_endpoint = $request->push_notifications_endpoint;
        $request->user()->save();

        return response()->json([
            'push_notifications_enabled' => $request->user()->push_notifications_enabled,
            'push_notifications_endpoint' => $request->user()->push_notifications_endpoint,
        ]);
    }

}
