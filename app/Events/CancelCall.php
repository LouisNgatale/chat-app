<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CancelCall implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $conversation_id;
    private $user_id;
    public $message = "cancel";

    public function __construct($conversation_id,$sender){
        $this->conversation_id = $conversation_id;
    }


    public function broadcastOn()
    {
        return new Channel('call.'.$this->conversation_id);
    }
}
