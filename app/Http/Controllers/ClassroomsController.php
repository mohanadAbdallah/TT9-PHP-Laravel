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
        Classroom::create($validatedData);

        return redirect()->route('classrooms.index');
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
        $classroom->delete();
        return redirect()->route('classrooms.index');
    }
}
