<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-center font-bold mb-5 text-xl">Register | Task App</h1>
    <form action="{{ route('register.proses') }}" method="post">
        @csrf
        @if (session('error'))
            <div class="bg-red-500 text-white p-2 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="name" class="p-2 my-1 ring-1 rounded-sm w-full block mt-1">
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="p-2 my-1 ring-1 rounded-sm w-full block mt-1"> 
                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="p-2 my-1 ring-1 rounded-sm w-full block mt-1">
                @error('username')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="p-2 my-1 ring-1 rounded-sm w-full block mt-1">
                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="justify-between flex items-center py-2 mt-3">
                <button type="submit" class="py-2 bg-blue-500 text-white px-4 rounded-md hover:bg-blue-700">Submit</button>
                <a href="{{route('login')}}" class="underline">Login</a>

            </div>
           
        </form>
    </div>
    </div>
</body>
</html>