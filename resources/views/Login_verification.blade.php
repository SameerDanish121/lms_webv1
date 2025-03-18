
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">OTP Verification</h2>
        <div class="text-center mb-4 text-gray-600">
            Verifying OTP for: <span class="font-semibold text-blue-600">{{ session('username') }}</span>
        </div>
        <form action="{{ route('verify.otp') }}" method="POST" class="space-y-4">
            @csrf
            <label class="block">
                <span class="text-gray-700">Enter OTP Code</span>
                <input type="text" name="otp" required placeholder="Enter OTP"
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </label>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700 transition duration-200">Verify OTP</button>
        </form>

        @if(session('error'))
            <p class="mt-4 text-red-600 text-center">{{ session('errors') }}</p>
        @endif
    </div>
</body>
</html>
