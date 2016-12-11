<?php

namespace chatto\Events;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InvitationEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $broadcastQueue = 'node';

    /**
     * @var
     */
    public $sender;

    /**
     * @var
     */
    public $recipient;

    /**
     * InvitationEvent constructor.
     * @param $sender
     * @param $recipient
     */
    public function __construct($sender, $recipient)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
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
        return ['sender' => $this->sender, 'recipient' => $this->recipient];
    }
}
