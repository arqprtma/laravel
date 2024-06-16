<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use App\Models\User;
use App\Models\Share;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class TaskController extends Controller
{
    //
    public function store(Request $request){

        $data_request = [
            'user_id' => Auth::user()->id,
            'categories_id' => $request->categories_id,
            'task_name' => $request->task_name,
            'task_description' => $request->task_description,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
            'status' => $request->status
        ];
        try {
            Task::create($data_request);
            return redirect()->back()->with('success', 'data berhasil ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'data gagal ditambahkan');

        }
    }

    public function update_view(Request $request, $id){
        $data = [
            'title' => 'Update Task',
            'taskUpdate' => Task::find($id),
        ];

        return view('auth.view_task', $data);
    }

    public function update_task (Request $request, $id){
       $task = Task::where('id', $id)->first();

       $request->validate([
        'task_name' => 'required',
        'task_description' => 'required',
        'start_date' => 'required',
        'due_date' => 'required',
       ]);
       if ($task) {
            try {
               $data = Task::findOrFail($id);
               $data->task_name = $request->task_name;
               $data->categories_id = $request->categories_id;
               $data->task_description = $request->task_description;
               $data->start_date = $request->start_date;
               $data->due_date = $request->due_date;
               $data->save();

               return redirect()->back()->with('success', 'data berhasil diubah!');
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('errors', 'data berhasil diubah!');

            }
       }
    }

    public function delete_task($id){
        $task = Task::where('id', $id)->first();
        
        if ($task) {
            try {
                Task::where('id', $id)->delete();
                return redirect()->route('task')->with('success', 'data berhasil dihapus!');

            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->route('task')->with('success', 'data gagal dihapus!');

            }
        }
    }

    public function enable_status(Request $request, $id){
        try {
            $task = Task::findOrFail($id);
            $task->status = $request->status;
            $task->save();

            return redirect()->back()->with('success', 'yey kamu telah menyelesaikan task !');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'gagal');

        }
    }

    public function task_category(Request $request){
        try {
            $data_request = [
                'category_name' => $request->category_name
            ];
            Category::create($data_request);
            return redirect()->back()->with('success', 'yey kamu telah menyelesaikan task !');

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'gagal');

        }
    }

    
    
}
