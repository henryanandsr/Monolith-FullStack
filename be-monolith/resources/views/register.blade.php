<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Register</title>
</head>
<body>
    @include('_navbar')
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-5 px-4">Register Form</h1>

        @if (session('success'))
            <p class="mb-3">{{ session('success') }}</p>
        @endif

        <form action="{{ route('register.store') }}" method="post" class="p-4">
            @csrf
            <div class="mb-5">
                <label for="username" class="block text-gray-700 font-bold">Username:</label>
                <input type="text" class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500" id="username" name="username" required>
            </div>
            <div class="mb-5">
                <label for="email" class="block text-gray-700 font-bold">Email:</label>
                <input type="email" class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500" id="email" name="email" required>
            </div>
            <div class="mb-5">
                <label for="password" class="block text-gray-700 font-bold">Password:</label>
                <input type="password" class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500" id="password" name="password" required>
            </div>
            <div class="mb-5">
                <label for="first_name" class="block text-gray-700 font-bold">First Name:</label>
                <input type="text" class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500" id="first_name" name="first_name" required>
            </div>
            <div class="mb-5">
                <label for="last_name" class="block text-gray-700 font-bold">Last Name:</label>
                <input type="text" class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500" id="last_name" name="last_name" required>
            </div>
            <div class="flex justify-between">
                <div class="mb-5">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Register</button>
                </div>
                <div>
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
