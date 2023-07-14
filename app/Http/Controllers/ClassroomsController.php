<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ClassroomsController extends Controller
{

    public function index(): View
    {
        //return Collection of data
        $classrooms = Classroom::orderBy('name', 'DESC')->get();
        return view('classrooms.index', compact('classrooms'));

    }

    public function create(): View
    {
        return view('classrooms.create');
    }

    public function store(ClassroomRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['code'] = Str::random(8);
        if ($request->hasFile('cover_image')){
            //return object from UploadedFile
            $file = $request->file('cover_image');
            $path = $file->store('/','public');
            $validatedData['cover_image_path'] = $path;
        }
        Classroom::create($validatedData);

        return redirect()->route('classrooms.index')->with('status','Class  room Created Successfully');
    }

    public function show(Classroom $classroom): View
    {
        return view('classrooms.show', compact('classroom'));
    }

    public function edit(Classroom $classroom): View
    {
        return view('classrooms.edit', compact('classroom'));
    }

    public function update(ClassroomRequest $request, Classroom $classroom): RedirectResponse
    {
        $validatedData = $request->validated();
        $classroom->update($validatedData);
        return redirect()->route('classrooms.index');
    }

    public function destroy(Classroom $classroom): RedirectResponse
    {
        $image_path = public_path("storage/".$classroom->cover_image_path);

        if(file_exists($image_path)){
            unlink($image_path);
        }
        $classroom->delete();
        return redirect()->route('classrooms.index')
            ->with('status','Classroom deleted');
    }
}
