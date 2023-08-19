<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Classroom;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TopicController extends Controller
{

    public function index(): View
    {
        $topics = Topic::all();
        return view('topics.index',compact('topics'));
    }

    public function create(): View
    {
        return view('topics.create');
    }

    public function store(TopicRequest $request): RedirectResponse
    {
        Topic::create($request->validated());
        return redirect()->route('topics.index')->with('status','Topic Created Successfully');
    }

    public function show($id): View
    {
        $topic = Topic::withTrashed()->findOrFail($id);
        return \view('topics.show',compact('topic'));
    }

    public function edit(Topic $topic): View
    {
        return \view('topics.edit',compact('topic'));
    }

    public function update(TopicRequest $request, Topic $topic): RedirectResponse
    {
        $topic->update($request->validated());
        return redirect()->route('topics.index');
    }

    public function destroy(Topic $topic): RedirectResponse
    {
        $topic->delete();
        return redirect()->route('topics.index');
    }
    public function trashed(): View
    {

        $topics = Topic::onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return view('topics.trashed',compact('topics'));
    }

    public function restore($id): RedirectResponse
    {
        $topic = Topic::onlyTrashed()->findOrFail($id);
        $topic->restore();

        return redirect()
            ->route('topics.index')
            ->with('status',"Classroom {{ $topic->name }} Restored Successfully");
    }

    public function forceDelete($id): RedirectResponse
    {
        $topic = Topic::onlyTrashed()->findOrFail($id);
        $topic->forceDelete();

        return redirect()
            ->route('topics.index')
            ->with('status',"Classroom {{ $topic->name }} Permanently Deleted");
    }
}
