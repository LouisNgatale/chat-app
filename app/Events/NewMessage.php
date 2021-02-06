<?php

namespace App\Events;

use App\Models\Conversations;
use App\Models\Messages;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $conversation_id;
    public $receiver_id;

    /**
     * Create a new event instance.
     *
     * @param  $message
     * @param  $conversation_id
     */
    public function __construct($message,$receiver_id,$conversation_id) {
        //
        $this->message = $message;
        $this->conversation_id = $conversation_id;
        $this->receiver_id = $receiver_id;
    }


    public function broadcastOn(){
        return new Channel('messages.'.$this->conversation_id);
    }

}
