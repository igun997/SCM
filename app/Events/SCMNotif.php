<?php
namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SCMNotif implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $message;
  public $type;
  public $link;

  public function __construct($message,$type,$link)
  {
    $this->message = $message;
    $this->type = $type;
    $this->link = $link;
  }

  public function broadcastOn()
  {
      return ['bell'];
  }

  public function broadcastAs()
  {
      return 'notif';
  }
}
