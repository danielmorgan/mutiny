<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests;
use App\User;

class WalletController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function transfer(Request $request)
    {
        $amount = (int) $request->amount;
        $from = $request->user();
        $to = User::where('name', $request->targetUser)
            ->orWhere('email', $request->targetUser)
            ->first();

        if ($amount <= 0) {
            return response()->json('Invalid amount.', 400);
        }

        if (! $to) {
            return response()->json($request->get('targetUser') . ' could not be found.', 404);
        }

        if ($from->id === $to->id) {
            return response()->json('You cannot transfer money to yourself.', 400);
        }

        $from->withdraw($amount);
        $to->deposit($amount);

        return response()->json([
            'updatedBalance' => $from->balance
        ], 200);
    }
}
