<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    @vite('resources/css/app.css')

</head>
<body>
    @if (session('errors'))
    <div class="bg-red-500 text-white p-2 rounded-lg mb-4">
        {{ session('errors') }}
    </div>
    @elseif (session('success'))
    <div class="bg-blue-500 text-white p-2 rounded-lg mb-4">
        {{ session('success') }}
    </div>
    @endif 
    <div class="h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <a href="{{route('task')}}" class="font-bold text-[24px]"><</a>
        <form action="{{ route('update_task', ['id' => $taskUpdate->id])}}" method="post" class="py-10">
            @csrf
            <div class="">
                <label for="">Task Name</label>
                <input type="hidden" value="{{$taskUpdate->id}}" name="id">
                <input type="text" class="p-2 my-1 ring-1 rounded-sm w-full block mt-1" name="task_name" placeholder="{{ $taskUpdate->task_name }}" value="{{ $taskUpdate->task_name }}">
            </div>
            <div>
                <label for="">Description Task</label>
                <input type="text" class="p-2 my-1 ring-1 rounded-sm w-full block mt-1" name="task_description" placeholder="{{ $taskUpdate->task_description }}" value="{{ $taskUpdate->task_description }}">
            </div>
            <div>
                <label for="">Start Date</label>
                <input type="date" class="p-2 my-1 ring-1 rounded-sm w-full block mt-1" name="start_date" value="{{$taskUpdate->start_date}}">
            </div>
            <div>
                <label for="">Due Date</label>
                <input type="date" class="p-2 my-1 ring-1 rounded-sm w-full block mt-1" name="due_date" value="{{$taskUpdate->due_date}}">
            </div>
            <div class="mt-5">
                <button class="w-full bg-blue-500 py-2 px-10 rounded-md text-white hover:bg-blue-700" type="submit">save</button>
            </div>
        </form>
        <form action="{{route('delete_task', ['id' => $taskUpdate->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full py-2 bg-red-500 text-white px-10 rounded-md hover:bg-red-700">delete</button>
        </form>
    </div>
    </div>
</body>
</html>