<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
//--------------------------------------------------------ADMIN-DATACELL (AUTHENTICATION + DASHBOARD  HANDLING)----------------------------------------
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('handleLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 
Route::get('/forgot-password', function () {return view('forgot_password');})->name('forgot');
Route::get('/datacell/dashboard', function () {$userData = session('userData');if (!empty($userData['user_id'])) {session(['user_id' => $userData['user_id']]);}return view('datacell_Home', compact('userData'));})->name('datacell.dashboard');
Route::get('/admin/dashboard', function () {$userData = session('userData'); if (!empty($userData['user_id'])) {session(['user_id' => $userData['user_id']]);}return view('Admin_Home', compact('userData'));})->name('admin.dashboard');
Route::get('/hod/dashboard', function () {return view('hod_dashboard');})->name('hod.dashboard');
Route::get('/director/dashboard', function () {return view('director_dashboard');})->name('director.dashboard');
Route::get('/OOps', function () {return view('un_authorized');})->name('caught.it');
Route::get('/verify-otp-show', [AuthController::class, 'showOTPForm'])->name('otp.form');
Route::post('/verify-otp-ver', [AuthController::class, 'verifyOTP'])->name('verify.otp');
//--------------------------------------------------------ADMIN-DATACELL(DASHBOARD PROFILE HANDLING)----------------------------------------
Route::get('/profile', function () {return view('components.profile');})->name('profile');
Route::get('/profile/edit', function () {return view('components.edit_profile');})->name('profile.edit');
Route::post('/update/profile', [AuthController::class, 'updateProfile'])->name('change.log');
//--------------------------------------------------------SERVER BASE URL (UPDATE/GET)----------------------------------------
Route::get('/get-api-url', [ApiController::class, 'getApiUrl']);
Route::get('/update-api', [ApiController::class, 'updateApiUrl']);
Route::get('/dev_mood', function () {return view('layouts.your_baseUrl');})->name('dev.mood');
//--------------------------------------------------------SESSION MANAGEMENT (CLEAR)----------------------------------------
Route::get('/clear-session', function () {Session::flush();return response()->json(['status' => 'success', 'message' => 'Session cleared successfully.']);})->name('clear.session');
//--------------------------------------------------------EXCEL MANAGEMENT (UPLOAD)----------------------------------------
Route::get('/upload/timetable', function () {return view('upload');})->name('show.timetable');
Route::get('/upload/student', function () {return view('excel.excel_student');})->name('show.student_upload');
Route::get('/upload/teacher', function () {return view('excel.excel_teacher');})->name('show.excel_teacher');
Route::get('/upload/junior', function () {return view('excel.excel_junior');})->name('show.excel_junior');
Route::get('/upload/venue', function () {return view('excel.excel_venue');})->name('show.excel_venue');
Route::get('/upload/course', function () {return view('excel.excel_course');})->name('show.excel_course');
Route::get('/upload/session', function () {return view('excel.excel_Session');})->name('show.excel_session');
Route::get('/upload/excludeddays', function () {return view('excel.excel_excludeddays');})->name('show.excel_excludedDays');
Route::get('/upload/section', function () {return view('excel.excel_section');})->name('show.excel_sections');
Route::get('/excel/offered_course', function () {return view('excel.excel_offered&teacherAllocation');})->name('show.offered_Course');
Route::get('/excel/enrollments', function () {return view('excel.excel_enrollments');})->name('show.enrollments');
Route::get('/excel/grader_assign', function () {return view('excel.excel_graderList');})->name('show.grader');
Route::get('/excel/junior_assign', function () {return view('excel.excel_JuniorCourseAllocation');})->name('show.junior_courseAllocation');
Route::get('/excel/course_topic', function () {return view('excel.excel_TopicOfSubjectPerWeek');})->name('show.topic_coursePerWeek');
Route::get('/excel/subject_result', function () {return view('excel.excel_fullSubjectResult');})->name('show.subject_result');
Route::get('/excel/exam_marks', function () {return view('excel.excel_examMarks');})->name('show.exam_marks');
//--------------------------------------------------------SINGLE INSERTION WITH FORM (ADD)----------------------------------------
Route::get('/add/datacell', function () {return view('form_insertion.datacell');})->name('add.datacell');
Route::get('/add/admin', function () {return view('form_insertion.admin');})->name('add.admin');
Route::get('/add/student', function () {return view('form_insertion.student');})->name('add.student');
Route::get('/add/teacher', function () {return view('form_insertion.teacher');})->name('add.teacher');
Route::get('/add/junior', function () {return view('form_insertion.junior');})->name('add.junior');
Route::get('/add/exam', function () {return view('form_insertion.exam');})->name('add.exam');
Route::get('/add/course_content', function () {return view('form_insertion.course_content');})->name('add.course_content');
//--------------------------------------------------------MANUAL PUSH NOTIFICATION (ADD)----------------------------------------
Route::get('/send/notification', function () {return view('Notification.notification_sending');})->name('send.notification');
//--------------------------------------------------------Student Flow (List to Single View)----------------------------------------
Route::get('/allstudent', [AuthController::class, 'AllStudent'])->name('allstudents');
Route::get('/students', function () {$students=session('students');return view('all_student', compact('students'));})->name('datacell.student');
Route::get('/student/details', function (Request $request) {
    $studentEncoded = $request->query('student'); 
    if (!$studentEncoded) {
        return redirect()->back()->with('error', 'Invalid student data');
    }
    $student = json_decode(base64_decode($studentEncoded), true);
    
    return view('student_details', compact('student'));
})->name('student.details');
Route::get('/transcript/{student_id}', [AuthController::class, 'Transcript'])->name('transcript.view');
Route::get('/grader/info', function (Request $request) {
    $studentEncoded = $request->query('student_id'); 
    if (!$studentEncoded) {
        return redirect()->back()->with('error', 'Invalid student data');
    }
    $student_id = json_decode(base64_decode($studentEncoded), true);
    
    return view('profile_views.grader_info', compact('student_id'));
})->name('grader.details');
//--------------------------------------------------------Courses Flow (List to Single View)----------------------------------------
Route::get('/allcourses', [AuthController::class, 'AllCourse'])->name('allcourses');
Route::get('/courses', function () {
    $courses=session('courses');
    return view('allcourses', compact('courses'));
})->name('datacell.courses');
//--------------------------------------------------------Timetable Flow (As Per University Format)----------------------------------------
Route::get('/timetable', [AuthController::class, 'FullTimetable'])->name('full.timetable');
Route::get('/full/timetable', function () {
    $timetable = session('timetable'); 
    return view('full_timetable', compact('timetable'));
})->name('full');
//--------------------------------------------------------TEMPORARY ENROLLMENTS----------------------------------------
Route::get('/all_temp_enrollments', function () {return view('temporary_enrollments.temp');})->name('temp.enroll');
//--------------------------------------------------------TEACHER VIEW----------------------------------------
Route::get('/teacher/details', function (Request $request) {
    $studentEncoded = $request->query('teacher'); 
    $roleEncoded = $request->query('role'); 
    if (!$studentEncoded || !$roleEncoded) {
        return redirect()->back()->with('error', 'Invalid teacher data');
    }
    $teacher = json_decode(base64_decode($studentEncoded), true);
    $role = base64_decode($roleEncoded);
    return view('profile_views.teacher_profile', compact('teacher', 'role'));
})->name('teacher.details');
//--------------------------------------------------------FULL VIEW----------------------------------------
Route::get('/all_students', function () {return view('All.all_student');})->name('all.student');
Route::get('/all_course', function () {return view('All.all_course');})->name('all.course');
Route::get('/all_teacher', function () {return view('All.all_teacher');})->name('all.teacher');
Route::get('/all_junior', function () {return view('All.all_junior');})->name('all.junior');
Route::get('/all_grader', function () {return view('All.all_grader');})->name('all.grader');
Route::get('/all_session', function () {return view('All.all_sessions');})->name('all.session');
Route::get('/all_archives', function () {return view('archives.archives_home');})->name('all.archives');
Route::get('/all_content', function () {return view('All.all_course_content');})->name('all.course_content');
Route::get('/all_course_allocation', function () {return view('All.all_course_allocation');})->name('all.course_allocation');
Route::get('/course-details', function (Request $request) {
    $studentEncoded = $request->query('course'); 
    if (!$studentEncoded) {
        return redirect()->back()->with('error', 'Invalid course data');
    }
    $course = json_decode(base64_decode($studentEncoded), true);
    
    return view('section_info.course_section_info', compact('course'));
})->name('course.details');


//--------------------------------------------------------WORKING ON IT----------------------------------------
Route::get('/student/enroll', function () {
    return view('junk.StudentEnroll');
});
Route::get('/student/teacher_course', function () {
    return view('junk.teacher_course');
});
Route::get('/section/attendance', function () {
    return view('section_info.section_attendance');
})->name('section.attendance');
Route::get('/all_test', function () {return view('junk.test');})->name('all.test');
