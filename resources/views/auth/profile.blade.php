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
    <div class="h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-center font-bold mb-5 text-xl">Edit profile {{$user->name}}</h1>
            <div>
                <form action="{{route('edit_profile')}}" method="post">
                    @csrf
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="name" value="{{$user->name}}" class="border-2 p-2 my-1 ring-1 rounded-sm w-full block mt-1">
                    @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{$user->email}}" class="border-2 p-2 my-1 ring-1 rounded-sm w-full block mt-1"> 
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{$user->username}}" class="border-2 p-2 my-1 ring-1 rounded-sm w-full block mt-1">
                    @error('username')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="py-2 flex justify-between">
                    <button type="submit" class="py-2 bg-blue-500 text-white px-4 rounded-md hover:bg-blue-700">save</button>
                    <a href="{{route('task')}}" type="submit" class="py-2 bg-red-500 text-white px-4 rounded-md hover:bg-red-700">batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>