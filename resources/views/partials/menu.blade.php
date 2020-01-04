<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('users_manage')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon"></i>
                       Settings
                    </a>
                <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route('setting.department.index') }}" class="nav-link {{ request()->is('setting/department') || request()->is('setting/department/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Departments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.academicyear.index') }}" class="nav-link {{ request()->is('setting/academicyear') || request()->is('setting/academicyear/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                              Academic Year
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.semester.index') }}" class="nav-link {{ request()->is('setting/semester') || request()->is('setting/semester/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Semester
                            </a>
                        </li>
   
                        <li class="nav-item">
                            <a href="{{ route('setting.center.index') }}" class="nav-link {{ request()->is('setting/center') || request()->is('setting/center/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">
                                </i>
                              Centers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.disability.index') }}" class="nav-link {{ request()->is('setting/disability') || request()->is('setting/disability/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Disability
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.marital.index') }}" class="nav-link {{ request()->is('setting/marital') || request()->is('setting/marital/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                              Marital Status
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.designation.index') }}" class="nav-link {{ request()->is('setting/designation') || request()->is('setting/designation/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">
                                </i>
                              Designation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.familyrelationship.index') }}" class="nav-link {{ request()->is('setting/familyrelationship') || request()->is('setting/familyrelationship/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Family Relationships
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.salaryscale.index') }}" class="nav-link {{ request()->is('setting/salaryscale') || request()->is('setting/salaryscale/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                              Salary Scale
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.section.index') }}" class="nav-link {{ request()->is('setting/section') || request()->is('setting/section/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">
                                </i>
                              Section
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.termsofservice.index') }}" class="nav-link {{ request()->is('setting/termsofservice') || request()->is('setting/termsofservice/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">
                                </i>
                              Terms of Service
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.educationlevel.index') }}" class="nav-link {{ request()->is('setting/educationlevel') || request()->is('setting/educationlevel/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">
                                </i>
                              Education level
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.country.index') }}" class="nav-link {{ request()->is('setting/country') || request()->is('setting/country/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">
                                </i>
                              Country
                            </a>
                        </li>
                    </ul>
            </li>

            <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon"></i>
                       Academics
                    </a>
                <ul class="nav-dropdown-items">
                <li class="nav-item">
                            <a href="{{ route('academic.subject.index') }}" class="nav-link {{ request()->is('academic/subject') || request()->is('academic/subject/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">
                                </i>
                              Subject
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.grade.index') }}" class="nav-link {{ request()->is('academic/grade') || request()->is('academic/grade/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              grades
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.grademark.index') }}" class="nav-link {{ request()->is('academic/grademark') || request()->is('academic/grademark/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Grade Marks
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.gradecurricular.index') }}" class="nav-link {{ request()->is('academic/gradecurricular') || request()->is('academic/gradecurricular/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Grade Curricular
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="{{ route('academic.gparange.index') }}" class="nav-link {{ request()->is('academic/gparange') || request()->is('academic/gparange/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Gpa Classes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.gpacurricular.index') }}" class="nav-link {{ request()->is('academic/gpacurricular') || request()->is('academic/gpacurricular/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Gpa Curricular
                            </a>
                        </li>
                     <li class="nav-item">
                            <a href="{{ route('academic.fees.index') }}" class="nav-link {{ request()->is('academic/fees') || request()->is('academic/fees/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Fees
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.feesamount.index') }}" class="nav-link {{ request()->is('academic/feesamount') || request()->is('academic/feesamount/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">
                                </i>
                              Fees Amount
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.feesstructure.index') }}" class="nav-link {{ request()->is('academic/feesstructure') || request()->is('academic/feesstructure/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                               Fees Structure
                            </a>
                        </li>

                          <li class="nav-item">
                            <a href="{{ route('academic.examinationtype.index') }}" class="nav-link {{ request()->is('academic/examinationtype') || request()->is('academic/examinationtype/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Examination types
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="{{ route('academic.examinationnature.index') }}" class="nav-link {{ request()->is('academic/examinationnature') || request()->is('academic/examinationnature/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Examination nature
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('academic.examinationmarks.index') }}" class="nav-link {{ request()->is('academic/examinationmarks') || request()->is('academic/examinationmarks/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">
                                </i>
                             Examination marks
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.examinationcurricular.index') }}" class="nav-link {{ request()->is('academic/examinationcurricular') || request()->is('academic/examinationcurricular/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                               Examination curricular
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('academic.event.index') }}" class="nav-link {{ request()->is('academic/event') || request()->is('academic/event/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">
                                </i>
                            Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.almanac.index') }}" class="nav-link {{ request()->is('academic/almanac') || request()->is('academic/almanac/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                                Almanac   
                          </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.curricular.index') }}" class="nav-link {{ request()->is('academic/curricular') || request()->is('academic/curricular/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                              Subject Curriculum 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.classroom.index') }}" class="nav-link {{ request()->is('academic/classroom') || request()->is('academic/classroom/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                               Classes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.classsection.index') }}" class="nav-link {{ request()->is('academic/classsection') || request()->is('academic/classsection/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                               Class Section
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academic.classsetup.index') }}" class="nav-link {{ request()->is('academic/classsetup') || request()->is('academic/classsetup/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                               Class Setup
                            </a>
                        </li>
                        
                    </ul>
            </li>
            <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon"></i>
                      Student Manager 
                    </a>
                <ul class="nav-dropdown-items">
                  <li class="nav-item">
                            <a href="{{ route('student.student.index') }}" class="nav-link {{ request()->is('student/student') || request()->is('student/student/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-users nav-icon">

                                </i>
                              Student Dashboard
                            </a>
                        </li>
                <li class="nav-item">
                            <a href="{{ route('student.student.index') }}" class="nav-link {{ request()->is('student/student') || request()->is('student/student/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-users nav-icon">

                                </i>
                              Student
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student.studentAccount.index') }}" class="nav-link {{ request()->is('student/studentAccount') || request()->is('student/studentAccount/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-lock nav-icon">

                                </i>
                              Students Accounts
                            </a>
                        </li>
                          <li class="nav-item">
                            <a href="{{ route('student.student.index') }}" class="nav-link {{ request()->is('student/student') || request()->is('student/student/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-lock nav-icon">

                                </i>
                              Student levels
                            </a>
                        </li>
                     <li class="nav-item">
                            <a href="{{ route('student.level.index') }}" class="nav-link {{ request()->is('student/level') || request()->is('student/level/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-users nav-icon">
                                </i>
                              Studies Level
                            </a>
                        </li>
                          <li class="nav-item">
                            <a href="{{ route('student.durationunit.index') }}" class="nav-link {{ request()->is('student/durationunit') || request()->is('student/durationunit/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-book nav-icon">
                                </i>
                             Duration Units
                            </a>
                        </li>
                           <li class="nav-item">
                            <a href="{{ route('student.academicyearStudent.index') }}" class="nav-link {{ request()->is('student/academicyearStudent') || request()->is('student/academicyearStudent/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-book nav-icon">
                                </i>
                            Students Registration
                            </a>
                        </li>
                          <li class="nav-item">
                            <a href="{{ route('student.promotion.index') }}" class="nav-link {{ request()->is('student/promotion') || request()->is('student/promotion/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-book nav-icon">
                                </i>
                            Students Promotion
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('student.course.index') }}" class="nav-link {{ request()->is('student/course') || request()->is('student/course/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-book nav-icon">
                                </i>
                             Student Course
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student.studentstatus.index') }}" class="nav-link {{ request()->is('student/studentstatus') || request()->is('student/studentstatus/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                               Status
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student.studentstudy.index') }}" class="nav-link {{ request()->is('student/studentstudy') || request()->is('setting/studentstudy/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Studies
                            </a>
                        </li>      
                    </ul>
            </li>
            <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon"></i>
                       Examinations 
                    </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                            <a href="{{ route('examination.examinationresult.result') }}" class="nav-link {{ request()->is('examination/examinationresult') || request()->is('examination/examinationresult/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                            Examination Dashboard
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="{{ route('examination.examinationresult.result') }}" class="nav-link {{ request()->is('examination/examinationresult') || request()->is('examination/examinationresult/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                            Post Result
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('examination.individualreport.index') }}" class="nav-link {{ request()->is('examination/individualreports') || request()->is('examination/individualreports/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                            Individual Reports
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{ route('examination.classreports.index') }}" class="nav-link {{ request()->is('examination/classreports') || request()->is('examination/classreports/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                            Class   Reports
                            </a>
                        </li>  
                          <li class="nav-item">
                            <a href="{{ route('examination.examinationresult.index') }}" class="nav-link {{ request()->is('examination/examinationresult') || request()->is('examination/examinationresult/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                               Result upload
                            </a>
                        </li>     
                    </ul>
            </li>

            <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon"></i>
                       General 
                    </a>
                <ul class="nav-dropdown-items">
                  <li class="nav-item">
                            <a href="{{ route('general.attachmenttype.index') }}" class="nav-link {{ request()->is('general/attachmenttype') || request()->is('general/attachmenttype/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">
                                </i>
                              Attachment Type
                            </a>
                        </li>
                  <li class="nav-item">
                            <a href="{{ route('general.attachment.index') }}" class="nav-link {{ request()->is('general/attachment') || request()->is('general/attachment/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">
                                </i>
                              Attachment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('general.familymember.index') }}" class="nav-link {{ request()->is('general/familymember') || request()->is('general/familymember/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">
                                </i>
                              Familly Member
                            </a>
                        </li>
                    </ul>
            </li>
           

            <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon"></i>
                        Forum 
                    </a>
                <ul class="nav-dropdown-items">
                  <li class="nav-item">
                            <a href="{{ route('general.attachmenttype.index') }}" class="nav-link {{ request()->is('general/attachmenttype') || request()->is('general/attachmenttype/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">
                                </i>
                              Attachment Type
                            </a>
                        </li>
                  <li class="nav-item">
                            <a href="{{ route('general.attachment.index') }}" class="nav-link {{ request()->is('general/attachment') || request()->is('general/attachment/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">
                                </i>
                              Attachment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('general.familymember.index') }}" class="nav-link {{ request()->is('general/familymember') || request()->is('general/familymember/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">
                                </i>
                              Familly Member
                            </a>
                        </li>
                    </ul>
            </li>
           
             <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon"></i>
                       User Management
                    </a>
                <ul class="nav-dropdown-items">
                     <li class="nav-item">
                            <a href="{{ route('admin.staff.index') }}" class="nav-link {{ request()->is('admin/staff') || request()->is('admin/staff/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                            User Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.staff.index') }}" class="nav-link {{ request()->is('admin/staff') || request()->is('admin/staff/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Staff
                            </a>
                        </li>
                     
                        <li class="nav-item">
                            <a href="{{ route('admin.log.index') }}" class="nav-link {{ request()->is('setting/log') || request()->is('setting/log/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">
                                </i>
                              Logs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.activitylogs.index') }}" class="nav-link {{ request()->is('setting/activitylogs') || request()->is('setting/activitylogs/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                              Activity Logs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                              Roles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                               Users
                            </a>
                        </li>
                    </ul>
            </li>
           
            <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">

                    </i>
                    Change password
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>