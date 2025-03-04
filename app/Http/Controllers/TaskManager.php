<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskDueNotification;
use Carbon\Carbon;

class TaskManager extends Controller
{
    // Show Add Task Page
    function addTask(Request $request) {
        return view('tasks.add');
    }

    // Add New Task
    function addTaskPost(Request $request) {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date|after:now',
            'priority' => 'required|in:high,medium,low' //Validate Priority
        ]);

        $task = new Tasks();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->user_id = auth()->user()->id;
        $task->status = 'pending'; // Default status
        $task->priority = $request->priority; 

        if ($task->save()) {
            return redirect(route("home"))->with("success", "Task added successfully");
        }
        return redirect(route("task.add"))->with("error", "Task not added");
    }

    // List Tasks with Filtering & Sorting

    function listTask(Request $request) {
        $showCompleted = $request->has('showCompleted') && $request->showCompleted == 1; // Ensure it's explicitly checked
    
        $query = Tasks::where("user_id", auth()->user()->id);
    
        // *Filter by status based on checkbox state*
        if ($showCompleted) {
            $query->where("status", "completed"); // Show only completed tasks
        } else {
            $query->where("status", "pending"); // Show only pending tasks
        }
    
        // *Search by Title or Description*
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }
    
        // *Filter by Priority*
        if ($request->has('priority') && in_array(strtolower($request->priority), ['high', 'medium', 'low'])) {
            $query->where("priority", ucfirst(strtolower($request->priority)));
        }
    
        // *Sorting: Priority or Deadline*
        if ($request->sort == 'priority') {
            $query->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')");
        } else {
            $query->orderBy('deadline', 'asc'); // Default Sorting: Earliest Deadline First
        }
    
        $tasks = $query->paginate(3);
    
        return view("welcome", compact('tasks', 'showCompleted'));
    }

    // Undo Task Completion (Move back to Pending)
    function undoTaskStatus($id) {
        if (Tasks::where("user_id", auth()->user()->id)->where('id', $id)->update(['status' => "pending"])) {
            return redirect(route('home'))->with("success", "Task moved back to Pending");
        }
        return redirect(route('home'))->with("error", "Error occurred while undoing task, try again");
    }

    // Mark Task as Completed
    function updateTaskStatus($id) {
        if (Tasks::where("user_id", auth()->user()->id)->where('id', $id)->update(['status' => "completed"])) {
            return redirect(route('home'))->with("success", "Task Completed");
        }
        return redirect(route('home'))->with("error", "Error occurred while updating, try again");
    }

    // Delete Task
    function deleteTask($id) {
        if (Tasks::where('id', $id)->delete()) {
            return redirect(route('home'))->with("success", "Task deleted");
        }
        return redirect(route('home'))->with("error", "Error occurred while deleting, try again");
    }

    // Send Due Task Notifications (Run this in a scheduled command)
    function sendDueNotifications() {
        $tasks = Tasks::where('status', 'pending')
                      ->whereBetween('deadline', [now(), now()->addHour()])
                      ->get();

        foreach ($tasks as $task) {
            $user = User::find($task->user_id);
            if ($user) {
                Notification::send($user, new TaskDueNotification($task));
            }
 }
}

// Show Edit Task Page
function editTask($id) {
    $task = Tasks::where("id", $id)->where("user_id", auth()->user()->id)->first();
    
    if (!$task) {
        return redirect(route("home"))->with("error", "Task not found");
    }

    return view('tasks.edit', compact('task'));
}

// Update Task
public function updateTask(Request $request, $id)
{
    // Debugging Step 1: Check if request is received
    // if ($request->isMethod('post')) {
    //     \Log::info('Update method hit', $request->all());
    // }

    // Validate Data
    $request->validate([
        'title' => 'required|string|max:255',
        'deadline' => 'required|date',
        'priority' => 'required|in:high,medium,low',
        'description' => 'required|string'
    ]);

    // Debugging Step 2: Check if Task Exists
    $task = Tasks::find($id);
    if (!$task) {
        return redirect()->back()->with('error', 'Task not found!');
    }

    // Update Task
    $task->update([
        'title' => $request->title,
        'deadline' => $request->deadline,
        'priority' => $request->priority,
        'description' => $request->description,
    ]);

    // Debugging Step 3: Check if Task was updated
    // \Log::info('Task updated successfully', $task->toArray());

    return redirect()->route('home')->with('success', 'Task updated successfully!');
}
}