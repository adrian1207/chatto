<?php

namespace chatto\Events;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UpdateProfileEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $broadcastQueue = 'node';

    /**
     * @var
     */
    public $id;

    /**
     * @var
     */
    public $data;

    /**
     * UpdateProfileEvent constructor.
     * @param $id
     * @param $data
     */
    public function __construct($id, $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    /**
     * @return PresenceChannel
     */
    public function broadcastOn()
    {
        return new PresenceChannel('presence');
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return ['id' => $this->id, 'data' => $this->data];
    }
}
