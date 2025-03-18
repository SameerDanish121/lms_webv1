<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director Dashboard</title>
    @vite('resources/css/app.css') 
</head>
<body class="bg-gray-100 text-gray-800">
    @include('components.navbar')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Director Dashboard</h1>
        <p class="text-lg">Welcome to the Director Dashboard. Manage your tasks and view reports here.</p>
    </div>
    @include('components.footer')
</body>
</html>