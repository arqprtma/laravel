<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $taskId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $task = Task::findOrFail($taskId);

        Comment::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}

