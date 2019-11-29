<?php
Route::redirect('/', '/admin/home');

Auth::routes(['register' => false]);
Route::get('login/applicant', 'Auth\LoginController@showApplicantLoginForm')->name('application.login');
Route::post('applicant/login', 'Auth\LoginController@applicantLogin');
 Route::resource('applicantdashboard','Applicant\ApplicantDashboard');

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
    Route::resource('log', 'Admin\LogController');
    Route::get('logsdata', 'Admin\LogController@data')->name('logs.data');
    Route::get('activitylogs', 'Admin\LogController@activityIndex')->name('activitylogs.index');
    Route::get('activitylogsdata', 'Admin\LogController@dataActivityLogs')->name('activitylogs.data');
    Route::get('permissionUser/{user}', 'Admin\UsersController@userPermission')->name('permission.user');
    Route::patch('permissionUser/{user}', 'Admin\UsersController@userPermissionsAssignment')->name('permission.userprocess');
    Route::resource('staff', 'Admin\StaffController');
  });
Route::group(['middleware' => ['auth'], 'prefix' => 'staff', 'as' => 'staff.'], function () {
  
  });

Route::group(['middleware' => ['auth'], 'prefix' => 'setting', 'as' => 'setting.'], function () {
    Route::resource('academicyear', 'Setting\AcademicYearController');
    Route::resource('department', 'Setting\DepartmentController');
    Route::resource('disability', 'Setting\DisabilityController');
    Route::resource('designation', 'Setting\DesignationController');
    Route::resource('familyrelationship', 'Setting\FamilyrelationshipController');
    Route::resource('marital', 'Setting\MaritalController');
    Route::resource('salaryscale', 'Setting\SalaryscaleController');
    Route::resource('section', 'Setting\SectionController');
    Route::resource('semester', 'Setting\SemesterController');
    Route::resource('termsofservice', 'Setting\TermsofserviceController');
    Route::resource('country', 'Setting\CountryController');
    Route::resource('center', 'Setting\CenterController');
    Route::resource('educationlevel', 'Setting\EducationlevelController');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'academic', 'as' => 'academic.'], function () {
    Route::resource('grade', 'Academic\GradeController');
    Route::resource('grademark', 'Academic\GrademarkController');
    Route::resource('event', 'Academic\EventController');
    Route::resource('gradecurricular', 'Academic\GradecurricularController');
    Route::resource('almanac', 'Academic\AlmanacController');
    Route::resource('classroom', 'Academic\ClassroomController');
    Route::resource('curricular', 'Academic\CurricularController');
    Route::resource('classsection', 'Academic\ClasssectionController');
    Route::resource('classsetup', 'Academic\ClasssetupController');
    Route::resource('subject', 'Academic\SubjectController');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'examination', 'as' => 'examination.'], function () {
   
});
Route::group(['middleware' => ['auth'], 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::resource('studentstatus', 'Student\StudentstatusController');
    Route::resource('student', 'Student\StudentController');
    Route::resource('studentstudy', 'Student\StudentstudyController');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'applicant', 'as' => 'applicant.'], function () {
    
    
});
   
