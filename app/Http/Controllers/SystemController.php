<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Systems\Generator;
use Auth;

class SystemController extends Controller
{
    public function getOutputs(Generator $generator)
    {
        return response()->json($generator);
    }

    public function setInputs(Request $request, Generator $generator)
    {
        $generator->fuel_in = $request->fuel_in;
        $generator->coolant_in = $request->coolant_in;
        $generator->save();

        return response()->json($generator->updatedOutputs());
    }
}
