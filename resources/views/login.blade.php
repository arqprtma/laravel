<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-center font-bold mb-5 text-xl">Login | Task App</h1>
            @if (session('errors.email'))
            <div class="bg-red-500 text-white p-2 rounded-lg mb-4">
                {{ session('errors.email') }}
            </div>
            @endif
            <div>
                <form action="{{ route('login.proses') }}" method="post">
                    @csrf
                    <div class="py-2">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="p-2 my-1 ring-1 rounded-sm w-full block mt-1">
                        @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="p-2 my-1 ring-1 rounded-sm w-full block">
                        @error('password')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="justify-between flex items-center py-2">
                        <button type="submit" class="py-2 bg-blue-500 text-white px-4 rounded-md hover:bg-blue-700">Submit</button>
                        <a href="{{route('register')}}" class="underline">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>