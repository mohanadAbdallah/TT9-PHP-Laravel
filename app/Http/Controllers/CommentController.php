<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'comment' => ['required', 'string'],
            'id' => ['required', 'int'],
            'type' => ['required', 'in:classwork,post']
        ]);
        Auth::user()->comments()->create([
            //hidden table in classroom blade for commentable id and commentable type

            'commentable_id' => $request->input('id'),
            'commentable_type' => $request->input('type'),
            'comment' => $request->input('comment'),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Comment sent Successfully');
    }
}
