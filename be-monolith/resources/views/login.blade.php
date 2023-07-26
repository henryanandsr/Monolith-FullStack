<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    @include('_navbar')
    <div class="container mx-auto mt-5 p-4">
        <h1 class="text-3xl font-bold mb-5">Login</h1>

        <form action="{{ route('login.submit') }}" method="post">
            @csrf
            <div class="mb-5">
                <label for="email" class="block text-gray-700 font-bold">Email:</label>
                <input type="email" class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500" id="email" name="email" required>
            </div>
            <div class="mb-5">
                <label for="password" class="block text-gray-700 font-bold">Password:</label>
                <input type="password" class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500" id="password" name="password" required>
            </div>
            <div class="flex justify-between">
                <div class="mb-5">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</button>
                </div>
                <div>
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
