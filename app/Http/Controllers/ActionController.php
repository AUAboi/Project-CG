<?php

namespace App\Http\Controllers;

use App\Events\Actions\ActionWasUsed;
use Illuminate\Cache\RedisStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ActionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $playerState = Redis::hGetAll("playerState" . $user->id);
        if ($playerState != []) {

            broadcast(new ActionWasUsed($user, $request->name, $playerState));
            return;
        }

        Redis::hmSet("playerState" . $user->id, [
            "playerHp" => "2",
            "skillACooldown" => "0",
            "skillBCooldown" => "0",

        ]);


        $playerState = Redis::hGetAll("playerState" . $user->id);


        broadcast(new ActionWasUsed($user, $request->name, $playerState));
    }


    protected function processAction()
    {
    }
}
