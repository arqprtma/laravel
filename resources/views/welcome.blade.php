<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="">
    <div class="navbar flex justify-between w-[80%] mx-auto py-10">
        <div>
            <h1 class="text-xl font-bold">Task App</h1>
        </div>
        <div class="flex gap-10">
            <a href="{{route('login')}}">Login</a>
            <a href="{{route('register')}}">Register</a>
        </div>
    </div>
    <div class="container w-[80%] mx-auto gap-10 flex">
        <img src="{{ asset('images/welcome.png') }}" alt="" class="lg:w-[500px] lg:h-[500px]">
        <div class=" flex flex-col justify-center items-start">
            <h1 class="font-bold text-3xl">Task Management & To-Do List</h1>
            <p class="text-sm">This Productive tool is designed to help you better manage your task project-wise convenienty!</p>
        </div>
    </div>
</body>
</html>