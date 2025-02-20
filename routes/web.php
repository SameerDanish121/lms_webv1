<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


////////////////////////////////////////View-open For Post//////////////////////////////////
Route::get('/forgot-password', function () {
    return view('forgot_password');
})->name('forgot');
Route::get('/clear-session', function () {
    Session::flush();
    return response()->json(['status' => 'success', 'message' => 'Session cleared successfully.']);
})->name('clear.session');
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
Route::get('/loader', function () {
    return view('AddStudent');
})->name('loader');





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













///////////////////////////////////////////////////////////////////VIEW OPEINING/////////////////////////////////////////


Route::post('/handel/timetable', [AuthController::class, 'handletimetable'])->name('handletimetable');
Route::get('/allstudent', [AuthController::class, 'AllStudent'])->name('allstudents');
Route::get('/allcourses', [AuthController::class, 'AllCourse'])->name('allcourses');
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('handleLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');