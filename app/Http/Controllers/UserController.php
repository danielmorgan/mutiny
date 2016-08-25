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
        if (! is_bool($request->push_enabled)) {
            throw new \InvalidArgumentException;
        }

        if (! $request->user()) {
            throw new AuthenticationException;
        }

        $request->user()->push_enabled = $request->push_enabled;
        $request->user()->push_endpoint = $request->push_endpoint;
        $request->user()->push_key_auth = $request->push_key_auth;
        $request->user()->push_key_p256dh = $request->push_key_p256dh;
        $request->user()->save();

        return response()->json([
            'push_enabled' => $request->user()->push_enabled,
            'push_endpoint' => $request->user()->push_endpoint,
            'push_key_auth' => $request->user()->push_key_auth,
            'push_key_p256dh' => $request->user()->push_key_p256dh,
        ]);
    }

}
