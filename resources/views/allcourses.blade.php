
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course List</title>
    @vite('resources/css/app.css')

    <style>
        /* Laptop view: Larger table & text */
        @media (min-width: 1024px) {
            table {
                font-size: 18px;
                width: 98%;
            }
            th, td {
                padding: 12px;
            }
        }

        /* Mobile view: Fixed width, prevent content overflow */
        @media (max-width: 768px) {
            .table-container {
                width: 100%;
                overflow-x: auto;
            }
            table {
                width: 100%;
                font-size: 14px;
                min-width: 600px;
            }
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body class="bg-gray-100">

    @include('components.navbar', [
        'username' => session('username', 'Guest'),
        'profileImage' => session('profileImage', asset('images/male.png')),
        'designation' => session('designation', 'N/A'),
        'type' => session('type', 'User')
    ])

    <!-- Course List -->
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-blue-700 text-center mb-4">Course List</h2>

        @if(Session::has('error'))
            <div class="text-red-600 text-center mb-4">{{ Session::get('error') }}</div>
        @endif

        <div class="table-container mx-auto">
            <table class="border border-gray-300 shadow-lg bg-white">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left italic">Id</th>
                        <th class="px-4 py-2 text-left italic">Course Name</th>
                        <th class="px-4 py-2 text-left italic">Course Code</th>
                        <th class="px-4 py-2 text-left italic">Pre Req</th>
                        <th class="px-4 py-2 text-left italic">Credit Hour</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($courses))
                        @foreach ($courses as $course)
                            <tr class="border-b border-gray-300">
                                <td class="px-4 py-2">{{ $course['id'] }}</td>
                                <td class="px-4 py-2">{{ $course['name'] }}</td>
                                <td class="px-4 py-2">{{ $course['code'] }}</td>
                                <td class="px-4 py-2">{{ $course['pre_req_main'] }}</td>
                                <td class="px-4 py-2">{{ $course['credit_hours'] }} ({{ $course['lab'] == 1 ? 'Lab' : 'No Lab' }})</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">No courses available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
