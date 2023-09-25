<?php

namespace App\Listeners;

use App\Events\ClassroomCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClassroomCreate
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassroomCreated $event): void
    {
        //
    }
}
