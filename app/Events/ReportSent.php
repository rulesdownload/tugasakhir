<?php

namespace App\Events;

use app\Models\post_raw;
use App\Models\city;
use App\Models\district;
use App\Models\User;
use App\Models\drainaseTypes;
use App\Models\drainseProblems;
use App\Models\Status;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReportSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

public $post_raw;
public $city;
public $district;
public $user;
public $status;
public $drainaseProblems;
public $drainaseTypes;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post_raw $post_raw, city $city, district $district, User $user, Status $status, drainaseProblems $drainaseProblems, drainaseTypes $drainaseTypes)
    {
        $this->User = $user;
        $this->post_raw = $post_raw;
        $this->district = $district;
        $this->city = $city;
        $this->Status = $status;
        $this->drainaseProblems = $drainaseProblems;
        $this->drainaseTypes = $drainaseTypes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastWith()
    {
     return [
        $this->post_raw = $post_raw->id,
        $this->district = $districtid->id,
        $this->city = $city->id,
        $this->Status = $status->id,
        $this->drainaseProblems = $drainaseProblems->id,
        $this->drainaseTypes = $drainaseTypes->id,
        ];
    }

    public function broadcastOn()
    {
        return new Channel('ReportChannel');
    }

}
