<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class JoinClassroomController extends Controller
{
    public function create($id): View
    {
        $classrooms = Classroom::active()->findOrFail($id);
        $exists = DB::table('classroom_user')
            ->where('classroom_id',$id)
            ->where('user_id',auth()->id())
            ->exists();
        if ($exists) {
            return redirect('classrooms.show',$id);
        }
        return view('classrooms.join',compact('classrooms'));
    }

    public function store()
    {

    }
}
