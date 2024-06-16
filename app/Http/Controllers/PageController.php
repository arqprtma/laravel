<?php

namespace App\Http\Controllers;
use App\Models\Task;    
use App\Models\Category;    
use App\Models\User;
use App\Models\TaskShare;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    public function login(Request $request){
        $data = [
            'title' => 'Login'
        ];
        return view('login', $data);
    }
    public function register(Request $request){
        $data = [
            'title' => 'Register'
            
        ];
        return view('Register', $data);
    }
    
    public function dashboard() {
        $user = Auth::user();
    
        // Retrieve categories and their tasks for the authenticated user
        $categories = Category::with(['tasks' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get();
    
        $data = [
            'title' => 'Dashboard',
            'user' => $user,
            'categories' => $categories
        ];
    
        return view('auth.dashboard', $data);
    }
    
    public function task(Request $request){
        $userId = Auth::user()->id;
        $tasks = Task::where('user_id', $userId)->with('comments.user')->paginate(2);
        $category = Category::all();
        $notUser = User::where('id', '!=', $userId)->get();
        // $sharedTasks = TaskShare::where('user_id', $userId)->with('task')->get();
        // $allTasks = $tasks->merge($sharedTasks->pluck('task'));

        $data = [
            'title' => 'task',
            'nama' => Auth::user()->name,
            'task' => $tasks,
            'category' => $category,
            'notUser' => $notUser
        ];
        return view('auth.task', $data);
    }
    
    public function view_task_category($id) {
        $userId = Auth::user()->id;
    
        // Retrieve the category with its tasks for the authenticated user
        $category = Category::with(['tasks' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->find($id);
    
        $data = [
            'title' => 'task',
            'nama' => Auth::user()->name,
            'category' => $category,
        ];
    
        return view('auth.view_task_category', $data);
    }

   
    
   
}
