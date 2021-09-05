<?php

namespace App\Events\Actions;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActionWasUsed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $action;
    protected $user;
    protected $gameState;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $action, $gameState)
    {
        $this->action = $action;
        $this->user = $user;
        $this->gameState = $gameState;
    }

    public function broadcastAs()
    {
        return 'ActionWasUsed';
    }

    public function broadcastWith()
    {
        return [
            'action' => $this->action,
            'user' => $this->user,
            'gameState' => $this->gameState
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return User::all()->map(function ($user) {
            return new PrivateChannel('game.' . $user->id);
        })
            ->toArray();
    }
}
