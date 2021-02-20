<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallEvent implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $conversation_id;
    private $user_id;
    public $caller;
    public $data;

    public function __construct($data,$caller){
        $this->data = $data;
        $this->caller = $caller;
    }

    public function broadcastOn(){
        return new Channel('call.'.$this->data['conversation_id']);
    }

}
