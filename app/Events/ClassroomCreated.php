<?php

namespace App\Events;

use App\Models\ClassWork;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClassroomCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public ClassWork $classWork)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('classroom' . $this->classwork->classroom_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'classwork-created';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->classWork->id,
            'title' => $this->classWork->title,
            'user' => $this->classWork->user,
            'description'=>$this->classWork->description,
        ];
    }
}
