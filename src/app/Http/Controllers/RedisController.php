<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis as Redis;

class RedisController extends Controller
{
    public function simple() {
        // Set data
        Redis::set('test_key', 'Hello Redis!');
    
        // Get data
        $value = Redis::get('test_key');
    
        return response()->json([
            'message' => $value,
        ]);
    }
}
