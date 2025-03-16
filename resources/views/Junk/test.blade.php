<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporary Enrolments</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100 min-h-screen flex flex-col justify-between">
    @include('components.navbar', [
    'username' => session('username', 'Guest'),
    'profileImage' => session('profileImage', asset('images/male.png')),
    'designation' => session('designation', 'N/A'),
    'type' => session('userType', 'User')
    ])
 @include('components.alert')
    <div class="max-w-6xl mx-auto py-8 px-4">
        <button onclick="showAlert('Sameer Danish is my Name'); ">Accept</button>
        <button onclick="hideLoader(); ">Reject</button>
        
    </div>

   
    @include('components.loader')
    @include('components.footer')
</body>
</html>
