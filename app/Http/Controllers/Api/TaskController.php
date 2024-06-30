<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Middleware for API key authentication.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($request->header('API_KEY') !== 'helloatg') {
                return response()->json(['status' => 0, 'message' => 'Invalid API key'], 401);
            }
            return $next($request);
        });
    }

    /**
     * Add a new task.
     */
    public function addTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => ['required', 'string'],
            'user_id' => ['required', 'exists:users,id']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $task = Task::create([
            'task' => $request->task,
            'user_id' => $request->user_id
        ]);

        return response()->json(['task' => $task, 'status' => 1, 'message' => 'Successfully created a task'], 201);
    }

    /**
     * Change the status of a task.
     */
    public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_id' => ['required', 'exists:tasks,id'],
            'status' => ['required', 'in:pending,done']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $task = Task::find($request->task_id);
        $task->status = $request->status;
        $task->save();

        $message = $request->status === 'done' ? 'Marked task as done' : 'Marked task as pending';

        return response()->json(['task' => $task, 'status' => 1, 'message' => $message], 200);
    }

    /**
     * Fetch all tasks from the database.
     */
    public function getTasks()
    {
        try {
            $tasks = Task::all(); // Retrieve all tasks from the database
            return response()->json(['status' => 1, 'data' => $tasks]);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => $e->getMessage()], 500);
        }
    }
    public function getUserTasks($user_id)
    {
        try {
            $tasks = Task::where('user_id', $user_id)->get();

            // Check if tasks exist for the given user_id
            if ($tasks->isEmpty()) {
                return response()->json(['status' => 0, 'message' => 'Sorry, user ID is not registered'], 404);
            }

            return response()->json(['status' => 1, 'data' => $tasks]);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => $e->getMessage()], 500);
        }
    }
    public function dashboard()
    {
        // Fetch tasks for the authenticated user
        $tasks = Task::where('user_id', Auth::id())->get();

        // Return the dashboard view with tasks
        return view('dashboard', ['tasks' => $tasks]);
    }
}
