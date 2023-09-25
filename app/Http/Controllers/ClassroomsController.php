<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClassroomsController extends Controller
{

    public function index(): View
    {
        //return Collection of data
        $classrooms = Classroom::status()
            ->recent()
            ->get();

        return view('classrooms.index', compact('classrooms'));

    }

    public function create(): View
    {
        return view('classrooms.create',[
            'classroom'=>new Classroom()
        ]);
    }

    public function store(ClassroomRequest $request): RedirectResponse
    {

        $validatedData = $request->validated();

        if ($request->hasFile('cover_image')){

            $file = $request->file('cover_image');
            $path = $file->store('images','public');

            $validatedData['cover_image_path'] = $path;
        }
        Classroom::create($validatedData);

        return redirect()->route('classrooms.index')
            ->with('success','Class  room Created Successfully');
    }

    public function show($id): View
    {
        $classroom = Classroom::withTrashed()->findOrFail($id);
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

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return redirect()->route('classrooms.index')->with('success','Classroom Deleted successfully');
    }

    public function trashed(): View
    {

        $classrooms = Classroom::onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return view('classrooms.trashed',compact('classrooms'));
    }

    public function restore($id): RedirectResponse
    {
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        $classroom->restore();

        return redirect()->route('classrooms.index')->with('status',"Classroom {{ $classroom->name }} Restored Successfully");
    }

    public function forceDelete($id): RedirectResponse
    {
        $classroom = Classroom::withTrashed()->findOrFail($id);
        $classroom->forceDelete();


        return redirect()
            ->route('classrooms.index')
            ->with('status',"Classroom {{$classroom->name}} Permanently Deleted");
    }
}
