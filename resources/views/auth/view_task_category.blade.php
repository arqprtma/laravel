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
    <div class="container w-[80%] py-12 rounded-lg mx-auto">
        <div class="todo py-10">
            <a href="{{route('dashboard')}}">< Back</a>
            <h1 class="font-bold text-[24px]"></h1>
            <h1 class="font-bold text-[24px] lg:py-10 ">Your {{ $category->category_name }} Tasks</h1>
            <button class="filter-button bg-blue-500 py-2 mb-2 px-10 rounded-md text-white" data-filter="all" type="button">All</button>
            <button class="filter-button bg-yellow-500 py-2 px-10 rounded-md text-white" data-filter="pending" type="button">Pending</button>
            <button class="filter-button bg-green-500 py-2 px-10 rounded-md text-white" data-filter="complete" type="button">Complete</button>
            <button class="filter-button bg-red-500 py-2 px-10 rounded-md text-white" data-filter="due_date" type="button">Due Date</button>    
            @foreach ($category->tasks as $task)
            <div class="task-item w-[100%] my-2 lg:w-[80%] lg:h-[100px] rounded-lg bg-blue-500 text-white" data-status="{{$task->status}}" data-due_date="{{$task->due_date}}">
                <div class="lg:px-10 lg:py-2 py-3 px-5 flex justify-between">
                    <div class="task">
                        {{-- {{$task}} --}}
                        <h1 class="uppercase font-bold lg:text-lg">{{$task->task_name}}</h1>
                        <p class="capitalize">{{$task->task_description}}</p>
                        <p>{{$task->due_date}}</p>
                    </div>
                   <div class="block">
                    <div class="flex gap-2">
                        <div class="actions">
                            <form action="{{ route('update.view', ['id' => $task->id]) }}" method="get">
                                @csrf
                                <input type="hidden" name="status">
                                <button type="submit" class="bg-white text-black lg:w-[100px] px-2 py-1 rounded-md">
                                View
                                </button>
                            </form>
                        </div>
                        <div class="actions">
                            <form action="{{ route('enable_status', ['id' => $task->id] )}}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="{{ $task->status === 'pending' ? 'complete' : 'complete' }}">
                                @if ($task->status === 'pending')
                                <button type="submit" class="bg-white text-black px-2 py-1 rounded-md">
                                    Mark as {{ $task->status === 'pending' ? 'Complete' : 'Pending' }}
                                </button>
                                @elseif($task->status === 'complete')
                                <button disabled type="submit" class="bg-slate-400 text-black px-2 py-1 rounded-md">
                                    Mark as {{ $task->status === 'complete' ? 'Complete' : 'Pending' }}
                                </button>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="status mt-2 text-center">
                        {{$task->status}}
                        @php
                            $dueDate = new DateTime($task->due_date);
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
            </div>
            @endforeach
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
