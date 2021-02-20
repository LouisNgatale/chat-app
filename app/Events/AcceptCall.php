<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AcceptCall implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $conversation_id;
    public $user_id;
    public $message = "accept";
    public $data;

    public function __construct($data,$sender){
        $this->data = $data;
    }


    public function broadcastOn()
    {
        return new PresenceChannel('presence-video-channel');
    }
}
