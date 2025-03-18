<?php

namespace App\Http\Controllers;
use App\Services\ApiConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    protected $baseUrl;
    public function __construct()
    {
        ApiConfig::init();
        $this->baseUrl = ApiConfig::getApiBaseUrl();
    }
    public function login()
    {
        // session()->flush();
        return view('login');
    }
    public function handleLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $response = Http::get($this->baseUrl . 'api/Login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);
        $data = $response->json();
        if ($response->successful() && isset($data['Type'])) {
            if ($data['Type'] == 'Admin') {
                session([
                    'userType' => 'Admin',
                    'Id' => $data['AdminInfo']['id'],
                    'userId' => $data['AdminInfo']['user_id'],
                    'username' => $data['AdminInfo']['name'],
                    'phoneNumber' => $data['AdminInfo']['phone_number'],
                    'designation' => $data['AdminInfo']['Designation'],
                    'usernames' => $data['AdminInfo']['Username'],
                    'currentSession' => $data['AdminInfo']['Current Session'],
                    'startDate' => $data['AdminInfo']['Start Date'],
                    'endDate' => $data['AdminInfo']['End Date'],
                    'profileImage' => $data['AdminInfo']['image'] ?? asset('images/male.png'),
                    'course_count' => $data['AdminInfo']['course_count'],
                    'student_count' => $data['AdminInfo']['student_count'],
                    'faculty_count' => $data['AdminInfo']['faculty_count'],
                    'offer_count' => $data['AdminInfo']['offered_course_count'],
                ]);
                return redirect()->route('otp.form');
            } else if ($data['Type'] == 'Datacell') {
                session([
                    'userType' => 'Datacell',
                    'userId' => $data['DatacellInfo']['user_id'],
                    'Id' => $data['DatacellInfo']['id'],
                    'username' => $data['DatacellInfo']['name'],
                    'phoneNumber' => $data['DatacellInfo']['phone_number'],
                    'designation' => $data['DatacellInfo']['Designation'],
                    'usernames' => $data['DatacellInfo']['Username'],
                    'currentSession' => $data['DatacellInfo']['Current Session'],
                    'startDate' => $data['DatacellInfo']['Start Date'],
                    'endDate' => $data['DatacellInfo']['End Date'],
                    'profileImage' => $data['DatacellInfo']['image'] ?? asset('images/male.png'),
                    'course_count' => $data['DatacellInfo']['course_count'],
                    'student_count' => $data['DatacellInfo']['student_count'],
                    'faculty_count' => $data['DatacellInfo']['faculty_count'],
                    'offer_count' => $data['DatacellInfo']['offered_course_count'],
                
                ]);
                return redirect()->route('otp.form');
            }else if ($data['Type'] == 'HOD') {
                session([
                    'userType' => 'HOD',
                    'userId' => $data['HODInfo']['user_id'],
                    'Id' => $data['HODInfo']['id'],
                    'username' => $data['HODInfo']['name'],
                    'designation' => $data['HODInfo']['Designation'],
                    'department' => $data['HODInfo']['Department'],
                    'usernames' => $data['HODInfo']['Username'],
                    'currentSession' => $data['HODInfo']['Current Session'],
                    'startDate' => $data['HODInfo']['Start Date'],
                    'endDate' => $data['HODInfo']['End Date'],
                    'profileImage' => $data['HODInfo']['image'] ?? asset('images/male.png'),
                    'course_count' => $data['HODInfo']['course_count'],
                    'student_count' => $data['HODInfo']['student_count'],
                    'faculty_count' => $data['HODInfo']['faculty_count'],
                    'offer_count' => $data['HODInfo']['offered_course_count'],
                
                ]);
                return redirect()->route('otp.form');
            }else if ($data['Type'] == 'Director') {
                session([
                    'userType' => 'Director',
                    'userId' => $data['DirectorInfo']['user_id'],
                    'Id' => $data['DirectorInfo']['id'],
                    'username' => $data['DirectorInfo']['name'],
                    'designation' => $data['DirectorInfo']['Designation'],
                    'usernames' => $data['DirectorInfo']['Username'],
                    'currentSession' => $data['DirectorInfo']['Current Session'],
                    'startDate' => $data['DirectorInfo']['Start Date'],
                    'endDate' => $data['DirectorInfo']['End Date'],
                    'profileImage' => $data['DirectorInfo']['image'] ?? asset('images/male.png'),
                    'course_count' => $data['DirectorInfo']['course_count'],
                    'student_count' => $data['DirectorInfo']['student_count'],
                    'faculty_count' => $data['DirectorInfo']['faculty_count'],
                    'offer_count' => $data['DirectorInfo']['offered_course_count'],
                
                ]);
                return redirect()->route('otp.form');
            } else {
                // Session::put('error', 'Unauthorized role.');
                // return back()->withErrors(['error' => 'Unauthorized role.']);
                return redirect()->route('caught.it');
            }

        }
        return redirect()->route('caught.it');
    }
    public function AllStudent(Request $request)
    {
        $response = Http::get($this->baseUrl . 'api/Admin/AllStudent');
        if ($response->successful()) {
            $data = $response->json(); // Decode JSON
            $students = $data['Student'] ?? [];
        } else {
            $students = [];
        }
        return redirect()->route('datacell.student')->with('students', $students);
    }
    public function Transcript(Request $request)
    {
        $studentID=$request->student_id;
        $response = Http::get($this->baseUrl . 'api/Admin/viewTranscript', [
            'student_id' => $studentID
        ]);
        if ($response->successful()) {
            $data = $response->json(); // Decode JSON response
            $student = $data['student'] ?? [];
            $program = $data['program'] ?? [];
            $sessionResults = $data['sessionResults'] ?? [];

            return view('single_student_info.view_transcript', [ // Replace 'your_view_name' with the actual Blade view file name
                'student' => $student,
                'sessionResults' => $sessionResults,
                'program' => $program
            ]);
        }

        return abort(404, 'Transcript not found'); // Handle errors
    }

    public function AllCourse(Request $request)
    {
        $response = Http::get($this->baseUrl . 'api/Admin/courses');
        if ($response->successful()) {
            $data = $response->json(); // Decode JSON
            $courses = $data['Courses'] ?? [];
        } else {
            $courses = [];
        }
        return redirect()->route('datacell.courses')->with('courses', $courses);
    }
    public function FullTimetable(Request $request)
    {
        $response = Http::post($this->baseUrl . 'api/Uploading/timetable/section');
        if ($response->successful()) {
            $data = $response->json(); // Decode JSON
            $timetable = $data['timetable'] ?? [];
        } else {
            $courses = [];
        }
        return redirect()->route('full')->with('timetable', $timetable);
    }
    public function logout()
    {
        Session::forget('user');
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'Designation' => 'required|string',
            'email' => 'nullable|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Get logged-in user ID
        $userId = session('userId');

        if (!$userId) {
            return back()->withErrors(['error' => 'User not authenticated.']);
        }

        // Prepare data for API request
        $formData = [
            'role' => session('userType'),
            'name' => trim($request->input('name')),
            'phone_number' => $request->input('phone_number'),
            'Designation' => $request->input('Designation'),
            'email' => $request->input('email')
        ];

        // Check if image is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $formData['image'] = fopen($image->path(), 'r');
        }

        // Send request to API
        $response = Http::attach(
            'image',
            $request->file('image') ? fopen($request->file('image')->path(), 'r') : null,
            $request->file('image') ? $request->file('image')->getClientOriginalName() : null
        )->post($this->baseUrl . "api/Insertion/update-single-user/{$userId}", $formData);

        $data = $response->json();

        if ($response->successful() && $data['status'] === 'success') {
            session([
                'username' => $formData['name'],
                'phoneNumber' => $formData['phone_number'],
                'designation' => $formData['Designation'],
                'profileImage' => $data['image'] ?? session('profileImage'),
            ]);
            return back()->with('success', 'Profile updated successfully.');
        }

        return back()->withErrors(['error' => $data['message'] ?? 'Failed to update profile.']);
    }
    public function showOTPForm()
    {
        // Assuming session has 'username'
        return view('Login_verification');
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);
        $userId = session('userId');
        $userType=session('userType');
       
        try {
            $apiResponse = Http::post($this->baseUrl .'api/verify/login', [
                'user_id' => $userId,
                'otp'     => $request->otp
            ]);

            $responseData = $apiResponse->json();
    
            if ($apiResponse->successful() && $responseData['status'] === 'success') {
                if ($userType == 'Director') {
                    return redirect()->route('director.dashboard');
                } elseif ($userType == 'Admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($userType == 'Datacell') {
                    return redirect()->route('datacell.dashboard');
                } elseif ($userType == 'HOD') {
                    return redirect()->route('hod.dashboard');
                } else {
                    return redirect()->route('login')->with('error', 'User role undefined.');
                }
            } else {
                Session::put('error',$responseData['message'] ?? 'Invalid OTP. Please try again.');
                return back();
            }
        } catch (\Exception $e) {
            Session::put('error',$e->getMessage());
            return back();
        }
    }
}
