<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
////////////////////////////////////////View-open For Post//////////////////////////////////
Route::get('/forgot-password', function () {
    return view('forgot_password');
})->name('forgot');
Route::get('/clear-session', function () {
    Session::flush();
    return response()->json(['status' => 'success', 'message' => 'Session cleared successfully.']);
})->name('clear.session');
Route::get('/loader', function () {
    return view('AddStudent');
})->name('loader');
Route::get('/dev_mood', function () {
    return view('layouts.your_baseUrl');
})->name('dev.mood');
Route::get('/upload/timetable', function () {
    return view('upload');
})->name('show.timetable');
Route::get('/upload/student', function () {
    return view('excel.excel_student');
})->name('show.student_upload');
Route::get('/upload/teacher', function () {
    return view('excel.excel_teacher');
})->name('show.excel_teacher');
Route::get('/upload/junior', function () {
    return view('excel.excel_junior');
})->name('show.excel_junior');
Route::get('/upload/venue', function () {
    return view('excel.excel_venue');
})->name('show.excel_venue');
Route::get('/upload/course', function () {
    return view('excel.excel_course');
})->name('show.excel_course');

Route::get('/upload/session', function () {
    return view('excel.excel_Session');
})->name('show.excel_session');
Route::get('/upload/excludeddays', function () {
    return view('excel.excel_excludeddays');
})->name('show.excel_excludedDays');

Route::get('/upload/section', function () {
    return view('excel.excel_section');
})->name('show.excel_sections');


Route::get('/full/time', function () {
    return view('test');
})->name('full.time');


Route::get('/send/notification', function () {
    return view('Notification.notification_sending');
})->name('send.notification');

Route::get('/student/details', function (Request $request) {
    // Retrieve 'student' parameter safely
    $studentEncoded = $request->query('student'); 

    if (!$studentEncoded) {
        return redirect()->back()->with('error', 'Invalid student data');
    }

    // Decode the Base64-encoded JSON
    $student = json_decode(base64_decode($studentEncoded), true);

    return view('student_details', compact('student'));
})->name('student.details');



/////////////////////////////////////////////////////VIEW OPEN WITH INTIAL DATA////////////////////////////
Route::get('/datacell/dashboard', function () {
    $userData = session('userData');
    if (!empty($userData['user_id'])) {
        session(['user_id' => $userData['user_id']]);
    }
    return view('datacell_Home', compact('userData'));
})->name('datacell.dashboard');
Route::get('/courses', function () {
    $courses=session('courses');
    return view('allcourses', compact('courses'));
})->name('datacell.courses');
Route::get('/students', function () {
    $students=session('students');
    return view('all_student', compact('students'));
})->name('datacell.student');
Route::get('/admin/dashboard', function () {
    $userData = session('userData'); 
    if (!empty($userData['user_id'])) {
        session(['user_id' => $userData['user_id']]);
    }
    return view('Admin_Home', compact('userData'));
})->name('admin.dashboard');
Route::get('/full/timetable', function () {
    $timetable = session('timetable'); 
    return view('full_timetable', compact('timetable'));
})->name('full');












///////////////////////////////////////////////////////////////////VIEW OPEINING/////////////////////////////////////////


Route::post('/handel/timetable', [AuthController::class, 'handletimetable'])->name('handletimetable');
Route::get('/allstudent', [AuthController::class, 'AllStudent'])->name('allstudents');
Route::get('/allcourses', [AuthController::class, 'AllCourse'])->name('allcourses');
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('handleLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/timetable', [AuthController::class, 'FullTimetable'])->name('full.timetable');




////////////////////////////////////////////////////////////////API-HANDLING.............................................

Route::get('/get-api-url', [ApiController::class, 'getApiUrl']);


Route::get('/update-api', [ApiController::class, 'updateApiUrl']);


//////////////////////////////////////////////////////////////Under-Trail///////////////////////////////
Route::get('/student/transcript', function () {
    return view('single_student_info.transcript');
})->name('student.transcript');
Route::get('/add/teacher', function () {
    return view('form_insertion.teacher');
})->name('add.teacher');
Route::get('/add/junior', function () {
    return view('form_insertion.junior');
})->name('add.junior');
Route::get('/section/attendance', function () {
    return view('section_info.section_attendance');
})->name('section.attendance');

Route::get('/add/datacell', function () {
    return view('form_insertion.datacell');
})->name('add.datacell');
Route::get('/add/admin', function () {
    return view('form_insertion.admin');
})->name('add.admin');