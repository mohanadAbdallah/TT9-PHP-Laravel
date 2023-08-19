<?php

namespace App\Observers;

use App\Models\Classroom;
use Illuminate\Support\Str;

class ClassroomObserver
{
    /**
     * Handle the Classroom "created" event.
     */
    public function created(Classroom $classroom): void
    {
        //
    }

    public function creating(Classroom $classroom)
    {
        $classroom->code = Str::random(8);
        $classroom->user_id = \auth()->user()->id;
    }

    /**
     * Handle the Classroom "updated" event.
     */
    public function updated(Classroom $classroom): void
    {
        //
    }

    /**
     * Handle the Classroom "deleted" event.
     */
    public function deleted(Classroom $classroom): void
    {
        if ($classroom->isForceDeleting()){
            return;
        }
        $classroom->status = 'deleted';
        $classroom->save();
    }

    /**
     * Handle the Classroom "restored" event.
     */
    public function restored(Classroom $classroom): void
    {
        //
    }

    /**
     * Handle the Classroom "force deleted" event.
     */
    public function forceDeleted(Classroom $classroom): void
    {
        //
    }
}
