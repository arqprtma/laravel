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
                <h1 class="text-[18px]">Hi, <span class="font-bold">{{$user->name}}</span></h1>
            </div>
            <div class="hidden lg:flex gap-10">
                <a href="#">Dashboard</a>
                <a href="{{route('task')}}">Task</a>
            </div>
            <div class="flex gap-10">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Settings
                    </button>
                    <div class="dropdown-menu"aria-labelledby="dropdownMenuButton">
                      {{-- <a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a> --}}
                      <a class="dropdown-item block lg:hidden" href="{{route('dashboard')}}">Dashboard</a>
                      <a class="dropdown-item block lg:hidden" href="{{route('task')}}">Taks</a>
                      <a class="dropdown-item" href="{{route('detail_profile')}}">Profile</a>
                      <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                    </div>
                  </div>
            </div>
        </div>
        <div class="justify-center mx-auto gap-10 lg:mb-[10px]  lg:flex">
            <img src="{{ asset('images/welcome.png') }}" alt="" class="w-[100%] h-[300px] lg:w-[200px] lg:h-[200px]">
            <div class="flex flex-col justify-center items-start">
                <h1 class="mb-2 font-bold text-sm lg:text-3xl">Task Management & To-Do List</h1>
                <p class="mb-2 text-sm">Lakukan task sekarang !</p>
                <a href="{{route('task')}}" class="no-underline	py-2 bg-blue-500 text-white px-4 rounded-md hover:bg-blue-700">Tambah Task</a>
            </div>
        </div>
        <div class="mt-5">
            <h1 class="font-bold text-[24px] mb-2">Task Category</h1>
            @foreach ($categories as $category)
            <div class="border-2 mb-3 shadow-lg  rounded-lg">
                <div class="py-4 px-3">
                    <h2 class="font-bold text-[24px] mb-3">{{ $category->category_name }} ({{ $category->tasks->count() }} tasks)</h2>
                    <ul class="">
                        @foreach ($category->tasks as $task)
                            <li>{{ $task->title }}</li>
                        @endforeach
                    </ul>
                    <a href="{{route('view_task_category', ['id' => $category->id])}}" class="py-2 bg-blue-500 text-white px-4 rounded-md hover:bg-blue-700">View</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
