<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassWork;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClassworkController extends Controller
{

    public function index(Classroom $classroom): View
    {
        $classworks = $classroom->classworks()
            ->orderBy('published_at')
            ->get();

        return view('classworks.index', compact('classworks', 'classroom'));
    }


    public function create(Request $request, Classroom $classroom): View
    {
        $type = $request->query('type');
        $allowedTypes = [
            ClassWork::TYPE_ASSIGNMENT, ClassWork::TYPE_MATERIAL, ClassWork::TYPE_QUESTION
        ];
        if (!in_array($type, $allowedTypes)){
            $type = ClassWork::TYPE_ASSIGNMENT;
        }
            return view('classworks.create', compact('classroom'));
    }

    public function store(Request $request, Classroom $classroom): RedirectResponse
    {
        $type = $request->query('type');
        $allowedTypes = [
            ClassWork::TYPE_ASSIGNMENT, ClassWork::TYPE_MATERIAL, ClassWork::TYPE_QUESTION
        ];
        if (!in_array($type, $allowedTypes)){
            $type = ClassWork::TYPE_ASSIGNMENT;
        }

        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'instructions' => ['nullable', 'string'],
            'topic_id' => ['nullable', 'int', 'exists:topics,id'],
        ]);

        $validatedData['id'] = Auth::id();

        $classroom->classworks()->create($validatedData);

        return redirect()->route('classrooms.classworks.index', $classroom->id)
            ->with('success', 'Classwork Created Successfully.');
    }

    public function show(Classroom $classroom, ClassWork $classWork): View
    {
        //
    }

    public function edit(Classroom $classroom, ClassWork $classWork): View
    {
        //
    }


    public function update(Request $request, Classroom $classroom, ClassWork $classWork): RedirectResponse
    {
        //
    }


    public function destroy(Classroom $classroom, ClassWork $classWork): RedirectResponse
    {
        //
    }
}
