<?php

namespace nuta\Events;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $broadcastQueue = 'node';

    /**
     * @var
     */
    public $channel;

    /**
     * @var
     */
    public $message;

    /**
     * MessageEvent constructor.
     * @param $channel
     * @param $message
     */
    public function __construct($channel, $message)
    {
        $this->channel = $channel;
        $this->message = $message;
    }

    /**
     * @return PresenceChannel
     */
    public function broadcastOn()
    {
        return new PresenceChannel($this->channel);
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return ['message' => $this->message];
    }
}
