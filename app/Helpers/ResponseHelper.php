<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResponseHelper
{
    public static function handleException(\Throwable $e, Request $request)
    {
        DB::rollBack();

        Log::error('Error: ' . $e->getMessage());

        if ($request->expectsJson()) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try again later.'], 500);
        }

        return redirect()->back()->with('error', 'Unable to load courses at the moment.');
    }
}
