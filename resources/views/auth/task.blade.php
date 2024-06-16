<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container lg:w-[80%] py-12 rounded-lg mx-auto">
        <div class="flex justify-between">
            <div class="navbar ">
                <h1 class="text-[18px]">Hi, <span class="font-bold">{{$nama}}</span></h1>
            </div>
            <div class="hidden lg:flex gap-10">
                <a href="{{route('dashboard')}}">Dashboard</a>
                <a href="#">Task</a>
            </div>
            <div class="flex gap-10">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Settings
                    </button>
                    <div class="dropdown-menu"aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item block lg:hidden" href="{{route('dashboard')}}">Dashboard</a>
                      <a class="dropdown-item block lg:hidden" href="{{route('task')}}">Taks</a>
                      <a class="dropdown-item" href="{{route('detail_profile')}}">Profile</a>
                      <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                    </div>
                  </div>
            </div>
        </div>
        @if (session('error'))
                    <div class="bg-red-500 text-white p-2 mt-10 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                    @elseif (session('success'))
                    <div class="bg-blue-500 text-white p-2 mt-10 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                    @endif 
        <div class="todo py-10">
            {{-- {{$category}}
            {{$task}} --}}
            <div class="lg:flex gap-10">
                <div class="category bg-white p-8 rounded-lg shadow-lg w-full lg:max-w-md my-10 rounded-lg ">
                    <h1 class="font-bold text-[24px]">Add Tasks Category</h1>
                    <form action="{{ route('task_category')}}" method="post" class="py-10">
                        @csrf
                        <div class="">
                            <label for="">Task Name</label>
                            <input type="text" placeholder="Task Name" class="border-2 p-2 my-1 ring-1 rounded-sm w-full block mt-1" name="category_name">
                        </div>
                        <div class="mt-5">
                            <button class="bg-blue-500 py-2 px-10 rounded-md text-white" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="tasks bg-white p-8 rounded-lg shadow-lg w-full lg:max-w-md my-10 rounded-lg ">
                    <h1 class="font-bold text-[24px]">Add Tasks</h1> 
                    <form action="{{ route('task.proses')}}" method="post" class="py-10">
                        @csrf
                        <div class="">
                            <label for="">Task Name</label>
                            <input type="text" placeholder="Task Name" class="border-2 p-2 my-1 ring-1 rounded-sm w-full block mt-1" name="task_name">
                            <input type="hidden" name="status" value="pending">
                        </div>
                        <div>
                            <label for="">Description Task</label>
                            <input type="text" placeholder="Task Description" class="border-2 p-2 my-1 ring-1 rounded-sm w-full block mt-1" name="task_description">
                        </div>
                            <label for="categories_id">Category</label>
                            <select class="form-control" id="categories_id" name="categories_id" required>
                                <option name="categories_id" value="" class="border-2 p-2 my-1 ring-1 rounded-sm w-full block mt-1">Select a category</option>
                                @foreach ($category as $c)
                                    <option class="categories_id"  class="border-2 p-2 my-1 ring-1 rounded-sm w-full block mt-1" value="{{ $c->id }}">{{ $c->category_name }}</option>
                                @endforeach
                            </select>
                        <div>
                            <label for="">Start Date</label>
                            <input type="date" placeholder="task" class="border-2 p-2 my-1 ring-1 rounded-sm w-full block mt-1" name="start_date">
                        </div>
                        <div>
                            <label for="">Due Date</label>
                            <input type="date" placeholder="task" class="border-2 p-2 my-1 ring-1 rounded-sm w-full block mt-1" name="due_date">
                        </div>
                        <div class="mt-5">
                            <button class="bg-blue-500 py-2 px-10 rounded-md text-white" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <h1 class="font-bold text-[24px]">Your Tasks</h1>
            <div class="text-sm lg:pt-4 pt-2">
            <button class="filter-button bg-blue-500 py-2 mb-2 px-10 rounded-md text-white" data-filter="all" type="button">All</button>
            <button class="filter-button bg-yellow-500 py-2 px-10 rounded-md text-white"  data-filter="pending" type="button">Pending</button>
            <button class="filter-button bg-green-500 py-2 px-10 rounded-md text-white"  data-filter="complete" type="button">Complete</button>
            <button class="filter-button bg-red-500 py-2 px-10 rounded-md text-white"  data-filter="due_date" type="button">Due Date</button>    
            </div>
            @foreach ($task as $t)
            <div class="task-item w-[100%] my-2 lg:w-[80%] rounded-lg bg-blue-500 text-white" data-status="{{$t->status}}" data-due_date="{{$t->due_date}}">
            <div class="lg:px-10 lg:py-2 py-3 px-3 lg:flex lg:justify-between">
            <div class="task">
                <h1 class="uppercase font-bold lg:text-lg">{{$t->task_name}}</h1>
                <p class="capitalize">{{$t->task_description}}</p>
                <p class="">{{$t->due_date}}</p>
            </div>
            <div class="block">
                <div class="flex mt-4 gap-2">
                    <div class="actions">
                        <form action="{{ route('update.view', ['id' => $t->id]) }}" method="get">
                            @csrf
                            <input type="hidden" name="status">
                            <button type="submit" class="bg-white text-black lg:w-[100px] px-2 py-1 rounded-md">View</button>
                        </form>
                    </div>
                    <div class="actions">
                        <form action="{{ route('enable_status', ['id' => $t->id] )}}" method="post">
                            @csrf
                            <input type="hidden" name="status" value="{{ $t->status === 'pending' ? 'complete' : 'complete' }}">
                            @if ($t->status === 'pending')
                                <button type="submit" class="bg-white text-black px-2 py-1 rounded-md">
                                    {{ $t->status === 'pending' ? 'Complete' : 'Pending' }}
                                </button>
                            @elseif($t->status === 'complete')
                                <button disabled type="submit" class="bg-slate-400 text-black px-2 py-1 rounded-md">
                                    {{ $t->status === 'complete' ? 'Complete' : 'Pending' }}
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="status mt-3 text-center">
                    {{$t->status}}
                    @php
                        $dueDate = new DateTime($t->due_date);
                        $now = new DateTime();
                        $interval = $dueDate->diff($now);
                        if ($interval->invert == 1) {
                            echo "(Due in " . $interval->days . " days)";
                        } else {
                            echo "(Overdue by " . $interval->days . " days)";
                        }
                    @endphp
                </div>
            </div>
        </div>
        
        <!-- Display comments -->
        <div class="comments bg-white text-black p-4 rounded-lg  border-2 border-blue-500">
            <h3 class="pb-2">Comments</h3>
            @foreach ($t->comments as $comment)
                <div class="comment mb-2">
                    <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                </div>
            @endforeach

            <!-- Add new comment -->
            <form action="{{ route('comments.store', $t->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <textarea name="comment" class="form-control" placeholder="Add a comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </div>
@endforeach

        <!-- Pagination links -->
        <div class="pagination-links">
            {{ $task->links() }}
        </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.filter-button');
            const tasks = document.querySelectorAll('.task-item'); 
    
            buttons.forEach(button => {
                button.addEventListener('click', function(){
                    const filter = this.getAttribute('data-filter');
                    tasks.forEach(task => {
                        if (filter === 'all') {
                            task.style.display = 'block';
                        } else if (filter === 'due_date') {
                            const dueDate = new Date(task.getAttribute('data-due_date'));
                            const today = new Date();
                            if (dueDate < today) {
                                task.style.display = 'block';
                            } else {
                                task.style.display = 'none';
                            }
                        } else {
                            if (task.getAttribute('data-status') === filter) {
                                task.style.display = 'block';
                            } else {
                                task.style.display = 'none';
                            }
                        }
                    });
                });
            });
        });
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>
