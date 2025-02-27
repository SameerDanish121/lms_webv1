<?php

namespace App\Http\Controllers;
use App\Services\ApiConfig;
use Illuminate\Http\Request;
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
        return view('login');
    }
    public function handleLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $response = Http::get($this->baseUrl.'api/Login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);
        $data = $response->json();
        if ($response->successful() && isset($data['Type'])) {
            
            if ($data['Type'] == 'Admin') {
                session([
                    'userType' => 'Admin',
                    'userId' => $data['AdminInfo']['id'],
                    'username' => $data['AdminInfo']['name'],
                    'phoneNumber' => $data['AdminInfo']['phone_number'],
                    'designation' => $data['AdminInfo']['Designation'],
                    'usernames' => $data['AdminInfo']['Username'],
                    'currentSession' => $data['AdminInfo']['Current Session'],
                    'startDate' => $data['AdminInfo']['Start Date'],
                    'endDate' => $data['AdminInfo']['End Date'],
                    'profileImage' => $data['AdminInfo']['image'] ?? asset('images/male.png'),
                ]);
                return redirect()->route('admin.dashboard')->with('userData', $data);
            } elseif ($data['Type'] == 'Datacell') {
                session([
                    'userType' => 'Datacell',
                    'userId' => $data['DatacellInfo']['id'],
                    'username' => $data['DatacellInfo']['name'],
                    'phoneNumber' => $data['DatacellInfo']['phone_number'],
                    'designation' => $data['DatacellInfo']['Designation'],
                    'usernames' => $data['DatacellInfo']['Username'],
                    'currentSession' => $data['DatacellInfo']['Current Session'],
                    'startDate' => $data['DatacellInfo']['Start Date'],
                    'endDate' => $data['DatacellInfo']['End Date'],
                    'profileImage' => $data['DatacellInfo']['image'] ?? asset('images/male.png'),
                ]);
                return redirect()->route('datacell.dashboard')->with('userData', $data);
            } else {
                Session::put('error', 'Unauthorized role.');
                return back()->withErrors(['error' => 'Unauthorized role.']);
            }
        }
        Session::put('error', 'Unauthorized role.');
        return back()->withErrors(['error' => 'Invalid credentials.']);
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
    public function handletimetable(Request $request){

    }
    public function logout()
    {
        Session::forget('user');
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
