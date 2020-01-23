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
    Route::get('permission_user/{user}', 'Admin\UsersController@userPermission')->name('users.permission');
    Route::post('permissionUser', 'Admin\UsersController@permissionsAssignment')->name('users.process_permission');
    Route::get('addadminrole/{user}', 'Admin\UsersController@addAdminRole')->name('users.ad_adminrole')->middleware(['auth']);
    Route::get('removedadminrole/{user}', 'Admin\UsersController@removeAdminRole')->name('users.remove_adminrole')->middleware(['auth']);
    //Route::post('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
    Route::resource('log', 'Admin\LogController');
    Route::get('logsdata', 'Admin\LogController@data')->name('logs.data');
    Route::get('activitylogs', 'Admin\LogController@activityIndex')->name('activitylogs.index');
    Route::get('activitylogsdata', 'Admin\LogController@dataActivityLogs')->name('activitylogs.data');
    Route::resource('staff', 'Admin\StaffController');
    Route::get('staff/copy/{staff}', 'Admin\StaffController@copyToUser')->name('staff.copy');
    Route::get('/relatives/{staff}', 'Admin\StaffController@studentRelatives')->name('staff.relatives');
    Route::get('/registration/{staff}','Admin\StaffController@studentRegistrations')->name('staff.registration');
    Route::get('/attachment/{staff}','Admin\StaffController@studentAttachments')->name('staff.attachment');
    Route::post('disabilitydata','Admin\StaffController@disabilityData');
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
    Route::resource('gradecurricular', 'Academic\GradecurricularController');
    Route::resource('event', 'Academic\EventController');
    Route::resource('fees', 'Academic\FeesController');
    Route::resource('feesamount', 'Academic\FeesamountController');
    Route::resource('feesstructure', 'Academic\FeesstructureController');
    Route::resource('almanac', 'Academic\AlmanacController');
    Route::resource('classroom', 'Academic\ClassroomController');
    Route::resource('curricular', 'Academic\CurricularController');
    Route::resource('classsection', 'Academic\ClasssectionController');
    Route::resource('classsetup', 'Academic\ClasssetupController');
    Route::get('classetup/download/{classsetup}','Academic\ClasssetupController@downloadCurriculum')->name('classsetup.curriculumn');
    Route::resource('subject', 'Academic\SubjectController');
    Route::resource('examinationtype','Academic\ExaminationtypeController');
    Route::resource('examinationcurricular','Academic\ExaminationcurricularController');
    Route::resource('examinationmarks','Academic\ExaminationmarksController');
    Route::resource('examinationnature','Academic\ExaminationnatureController');
    Route::resource('gparange','Academic\GparangeController');
    Route::resource('gpacurricular','Academic\GpacurricularController');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'examination', 'as' => 'examination.'], function () {
      Route::resource('examinationresult','Examination\ExaminationresultController');
      Route::get('individualresult','Examination\ExaminationresultController@individualResult')->name('examinationresult.result');
      Route::get('classdetails/{classid}/{curriculumid}/{yearid}','Examination\ExaminationresultController@classDetails')->name('examinationresult.classdetails');
      Route::get('export_student/{classid}/{yearid}','Examination\ExaminationresultController@studentsExports')->name('examinationresult.export');
      Route::post('import_result','Examination\ExaminationresultController@resultImport')->name('examinationresult.import');
      Route::get('examlist/{id}','Examination\ExaminationresultController@getExaminations');
      Route::get('subjlist/{id}','Examination\ExaminationresultController@getSubjects');
      Route::resource('classreports','Examination\ClassreportController');
      Route::get('class_student/{classid}/{yearid}','Examination\ClassreportController@studentsLists')->name('classreports.class_list');
      Route::get('class_sheet/{studentid}/{year_id}/{classsetup_id}','Examination\ClassreportController@resultSheets')->name('classreports.details');
      Route::resource('individualreport','Examination\IndividualreportController');
      Route::get('list_student/{classid}/{yearid}','Examination\IndividualreportController@studentsLists')->name('individualreport.student_list');
      Route::get('result_sheet/{studentid}/{year_id}/{classsetup_id}','Examination\IndividualreportController@resultSheets')->name('individualreport.details');
      Route::get('dependantdata/{semester}/{setup}','Examination\ExaminationresultController@dependantData');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::resource('studentstatus', 'Student\StudentstatusController');
    Route::resource('student', 'Student\StudentController');
    Route::get('/copy/{student}', 'Student\StudentController@copyToUser')->name('student.copy');
    Route::get('/relatives/{student}', 'Student\StudentController@studentRelatives')->name('student.relatives');
    Route::get('/registration/{student}','Student\StudentController@studentRegistrations')->name('student.registration');
    Route::get('/attachment/{student}','Student\StudentController@studentAttachments')->name('student.attachment');
    
    Route::resource('studentstudy', 'Student\StudentstudyController');
    Route::resource('level', 'Student\LevelController');
    Route::resource('course', 'Student\CourseController');
    Route::resource('durationunit', 'Student\DurationunitController');
    Route::resource('academicyearStudent', 'Student\AcademicyearStudentController');
    Route::resource('promotion','Student\PromotionController');   
    Route::resource('studentAccount','Student\StudentAccount');        
});


Route::group(['middleware' => ['auth'], 'prefix' => 'applicant', 'as' => 'applicant.'], function () {
    
    
});

Route::group(['middleware' => ['auth'], 'prefix' => 'general', 'as' => 'general.'], function () {
     Route::resource('familymember', 'General\FamilymemberController');
     Route::resource('attachment', 'General\AttachmentController');
     Route::resource('attachmenttype', 'General\AttachmenttypeController');
     Route::resource('category', 'General\CategoryController');
     Route::get('lists', 'General\CategoryController@getCats');
     Route::resource('forum', 'General\ForumController');
     Route::get('init', 'General\ForumController@init')->name('forum.init');
     Route::get('/forumdashboard', 'General\ForumController@indexForum')->name('forum.indexforum');
     Route::resource('/thread', 'General\ThreadController');
     Route::get('/search/{searchQuery}', 'General\ThreadController@search')->name('thread.search');
     Route::post('/createpost', 'General\ThreadController@createPost')->name('thread.createpost');
     Route::get('/currentthread/{id}', 'General\ThreadController@getThreadById')->name('thread.currentthread');
     Route::resource('post', 'General\PostController');    
});

Route::resource('sample', 'SampleController');
Route::get('graph_load','SampleController@loadData')->name('sample.graph');
 Route::get('chart-line-ajax', 'HomeController@chartLineAjax');
Route::post('sample/update', 'SampleController@update')->name('sample.update');

Route::get('sample/destroy/{id}', 'SampleController@destroy');
   
