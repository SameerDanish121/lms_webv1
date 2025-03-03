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
//--------------------------------------------------------SINGLE INSERTION WITH FORM (ADD)----------------------------------------
Route::get('/add/datacell', function () {return view('form_insertion.datacell');})->name('add.datacell');
Route::get('/add/admin', function () {return view('form_insertion.admin');})->name('add.admin');
Route::get('/add/student', function () {return view('form_insertion.student');})->name('add.student');
Route::get('/add/teacher', function () {return view('form_insertion.teacher');})->name('add.teacher');
Route::get('/add/junior', function () {return view('form_insertion.junior');})->name('add.junior');
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

//--------------------------------------------------------WORKING ON IT----------------------------------------
Route::get('/student/content', function () {
    return view('junk.CourseContent');
});
Route::get('/student/enroll', function () {
    return view('junk.StudentEnroll');
});
Route::get('/student/teacher_course', function () {
    return view('junk.teacher_course');
});
Route::get('/student/teacher_course', function () {
    return view('junk.teacher_course');
});
Route::get('/student/temp', function () {
    return view('junk.temp');
});
Route::get('/student/transcript', function () {
    return view('single_student_info.transcript');
})->name('student.transcript');
Route::get('/section/attendance', function () {
    return view('section_info.section_attendance');
})->name('section.attendance');

