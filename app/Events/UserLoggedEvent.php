<?php

namespace nuta\Events;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use nuta\Models\User;

class UserLoggedEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $broadcastQueue = 'node';

    /**
     * @var User
     */
    public $user;

    /**
     * UserLoggedEvent constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return PresenceChannel
     */
    public function broadcastOn()
    {
        return new PresenceChannel('global');
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return ['user' => $this->user];
    }
}
