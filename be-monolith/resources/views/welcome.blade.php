<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <!-- Include Tailwind CSS -->
    @vite('resources/css/app.css')
</head>
<body>
    <!-- Include the navbar -->
    @include('_navbar')

    <!-- Your content for the welcome page goes here -->
    <h1>Hi there!</h1>
</body>
</html>
