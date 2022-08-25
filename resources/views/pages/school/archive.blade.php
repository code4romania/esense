title = "Arhivă"
url = "/school/archive"
layout = "web-app"
description = "Displays archived students and specialists"
is_hidden = 0

[session]
security = "user"
allowedUserGroups[] = "registered"
allowedUserTypes[] = "school"

[specialist]

[student]
==
<div class="container-fluid px-lg-4">
    <div class="row">

        <!-- Dashboard title -->
        <div class="col-12">
            <h4 class="text-gray-dark font-weight-light mb-4">{{ 'page.school.dashboard.archive.title'|_ }}</h4>
        </div>

        <!-- Students table -->
        <div class="col-12 my-5">
            <div class="table-responsive rounded p-3" style="overflow-x: hidden; background: linear-gradient(0deg, #FFFFFF, #FFFFFF);">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="font-weight-bold text-dark">{{ 'page.school.dashboard.archive.students.title'|_ }} <span class="text-gray-medium font-weight-normal">({{ user.profile.archivedStudents.count }})</span></p>
                </div>
                <table id="teachers-invitation-datatable" class="table table-striped table-sm pt-3 px-3 m-0" cellspacing="0">
                    <thead>
                        <tr>
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.students.table.column_1'|_}}</p></th>
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.students.table.column_2'|_}}</p></th>
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.students.table.column_4'|_}}</p></th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for student in user.profile.archivedStudents %}
                            <tr>
                                <td>
                                    <div class="pl-2 py-3 d-flex align-items-center">
                                        <div>
                                            {% if student.avatar %}
                                                <img class="img-fluid img-avatar rounded-circle" src="{{student.avatar.getThumb(40,40, { mode : 'crop' } )}}" alt="avatar">
                                            {% elseif student.gender == 'female' %}
                                                <img class="img-fluid img-avatar rounded-circle" width="40" height="40" src="{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}" alt="avatar">
                                            {% else %}
                                            <img class="img-fluid img-avatar rounded-circle" width="40" height="40" src="{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}" alt="avatar">
                                            {% endif %}
                                        </div>
                                        <div class="d-flex flex-column ml-2">
                                            <a class="display-4 font-weight-light" href="{{ 'school/student'|page({studentId: student.id}) }}" style="letter-spacing: 0.2px; line-height:20px; color:#252733;">{{ student.full_name }}</a>
                                            <h6 class="p-0 m-0 font-weight-normal text-gray">{{ student.birthdate|date("d/m/Y") }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="pl-2 py-3">
                                        <div class="d-flex flex-column">
                                            {% if student.hearing_impairment %}
                                                <p class="p-0 m-0 display-4 text-gray font-weight-light" style="letter-spacing: 0.2px; line-height:20px;">
                                                    {{'page.school.dashboard.student.table.disability.hearing'|_}}
                                                </p>
                                            {% endif %}
                                            {% if student.visual_impairment %}
                                                <p class="p-0 m-0 display-4 text-gray font-weight-light" style="letter-spacing: 0.2px; line-height:20px;">
                                                    {{'page.school.dashboard.student.table.disability.seeing'|_}}
                                                </p>
                                            {% endif %}
                                            {% if (not student.hearing_impairment) and (not student.visual_impairment) %}
                                                <p class="p-0 m-0 display-4 text-gray font-weight-light" style="letter-spacing: 0.2px; line-height:20px;">
                                                    {{'page.school.dashboard.student.table.disability.none'|_}}
                                                </p>
                                            {% endif %}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="pl-2 py-3">
                                        <div class="d-flex align-items-center pt-2">
                                            <p class="p-0 m-0 font-weight-light display-4" style="letter-spacing: 0.2px; line-height:20px; color:#252733;">{{ student.owner.full_name }}</p>
                                            <img class="img-fluid ml-2" src="{{ 'assets/img/svg/dashboard/users.svg'|theme }}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="pl-2 py-3 d-flex align-items-center">
                                        <a class="display-4 font-weight-light" href="{{ 'school/student'|page({studentId: student.id}) }}">
                                            <img class="img-fluid pt-2" src="{{ 'assets/img/svg/dashboard/eye.svg'|theme }}">
                                        </a>

                                        <a role="button" data-toggle="modal" data-target="#deleteStudentModal" data-name='{{ student.full_name }}' data-id='{{ student.id }}' data-name='{{ student.full_name }}' data-id='{{ student.id }}' data-avatar='{% if student.avatar %}{{student.avatar.getThumb(40,40, { mode : 'crop' } )}}{% elseif student.gender == 'female' %}{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}{% else %}{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}{% endif %}'>
                                            <img class="img-fluid pt-2 ml-4" src="{{ 'assets/img/svg/dashboard/trash-bin.svg'|theme }}">
                                        </a>

                                        <div class="dropdown pt-2">
                                            <button class="btn shadow-none" type="button" id="studentsTableOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/options.svg'|theme }}">
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="studentsTableOptions">
                                                <a class="dropdown-item display-4" role="button" data-toggle="modal" data-target="#unzipStudentModal" data-name='{{ student.full_name }}' data-id='{{ student.id }}' data-avatar='{% if student.avatar %}{{student.avatar.getThumb(40,40, { mode : 'crop' } )}}{% elseif student.gender == 'female' %}{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}{% else %}{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}{% endif %}' style="color: #1A212C;">{{'page.school.dashboard.archive.students.table.options.unzip'|_}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Teachers table -->
        <div class="col-12 my-5">
            <div class="table-responsive rounded p-3" style="overflow-x: hidden; background: linear-gradient(0deg, #FFFFFF, #FFFFFF);">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="font-weight-bold text-dark">{{'page.school.dashboard.school.table.title'|_}} <span class="text-gray-medium font-weight-normal">({{ user.profile.archivedSpecialists.count }})</span></p>
                </div>
                <table id="teachers-datatable" class="table table-striped table-sm pt-3 px-3 m-0" cellspacing="0">
                    <thead>
                        <tr>
                            <!-- Teacher name column -->
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.teachers.table.column_1'|_}}</p></th>
                            <!-- Number of students column -->
                            <!-- Registration date column -->
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.teachers.table.column_3'|_}}</p></th>
                            <!-- Email column -->
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.teachers.table.column_4'|_}}</p></th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for specialist in user.profile.archivedSpecialists %}
                            <tr>
                            <!-- Teacher avatar and name -->
                                <td>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="pl-2 py-3 d-flex align-items-center">
                                            {% if specialist.user.avatar %}
                                                <img class="img-fluid img-avatar rounded-circle add-custom-avatar" src="{{specialist.user.avatar.getThumb(40,40, { mode : 'crop' } )}}" alt="avatar">
                                            {% else %}
                                                <img class="img-fluid add-custom-avatar" width="40px" height="40px" src="{{ 'assets/img/svg/dashboard/user-bordered.svg'|theme }}">
                                            {% endif %}

                                            <div class="d-flex flex-column ml-2">
                                                <a class="display-4 font-weight-light" href="{{ 'school/specialist'|page({specialistId: specialist.id}) }}" style="letter-spacing: 0.2px; line-height:20px; color:#252733;">{{ specialist.full_name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Registration date row -->
                                <td>
                                    <div class="pl-2 py-3 d-flex align-items-center">
                                        <p class="p-0 m-0 pt-2 font-weight-light display-4 text-gray-light" style="letter-spacing: 0.2px; line-height:20px;">{{ specialist.created_at|date("d/m/Y") }}</p>
                                    </div>
                                </td>

                                <!-- Email row -->
                                <td>
                                    <div class="pl-2 py-3 d-flex align-items-center">
                                        <p class="p-0 m-0 pt-2 font-weight-light display-4 text-gray-light" style="letter-spacing: 0.2px; line-height:20px;">{{ specialist.email }}</p>
                                    </div>
                                </td>

                                <td>
                                    <div class="pl-2 py-3 d-flex align-items-center">
                                        <a class="display-4 font-weight-light" href="{{ 'school/specialist'|page({specialistId: specialist.id}) }}">
                                            <img class="img-fluid pt-2" src="{{ 'assets/img/svg/dashboard/eye.svg'|theme }}">
                                        </a>

                                        <a role="button" data-toggle="modal" data-target="#deleteTeacherModal" data-name='{{ specialist.full_name }}' data-id='{{ specialist.id }}' data-avatar='{% if specialist.user.avatar %}{{specialist.user.avatar.getThumb(40,40, { mode : 'crop' } )}}{% else %}{{ 'assets/img/svg/dashboard/user-bordered.svg'|theme }}{% endif %}'>
                                            <img class="img-fluid pt-2 ml-4" src="{{ 'assets/img/svg/dashboard/trash-bin.svg'|theme }}">
                                        </a>

                                        <div class="dropdown pt-2">
                                            <button class="btn shadow-none" type="button" id="studentsTableOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/options.svg'|theme }}">
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="studentsTableOptions">
                                                <a class="dropdown-item display-4" href="#" style="color: #1A212C;" data-toggle="modal" data-target="#unzipSpecialistModal" data-name='{{ specialist.full_name }}' data-id='{{ specialist.id }}' data-avatar='{% if specialist.user.avatar %}{{specialist.user.avatar.getThumb(40,40, { mode : 'crop' } )}}{% else %}{{ 'assets/img/svg/dashboard/user-bordered.svg'|theme }}{% endif %}'>
                                                    {{'page.school.dashboard.archive.specialists.table.options.unzip'|_}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Partial for unziping a specialist -->
{% partial 'web-app/school/specialist-unzip' %}
<!-- Partial for deleting a specialist -->
{% partial 'web-app/school/specialist-delete' %}

<!-- Partial for unziping a student -->
{% partial 'web-app/general/student-unzip' %}
<!-- Partial for deleting a student -->
{% partial 'web-app/general/student-delete' %}


{% put scripts %}
    <!-- Scripts for datatables -->
    <script type="text/javascript">
        $(document).ready(function () {

            /***********************************************
            ************** Students datatable **************
            ***********************************************/

            $('#teachers-invitation-datatable').DataTable({
                dom: '<"row"<"col-12"t>><"row bg-white p-3 rounded-bottom"<"col-6 d-flex align-items-center"l><"col-6 d-flex align-items-center justify-content-end"ip>>',
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100]
                ],
                bSort: true,
                responsive: true,
                processing: true,
                pagingType: 'simple',
                language: {
                    "info": "_PAGE_ - _PAGE_ of _PAGES_",
                    'zeroRecords': "{{'general.datatable.zeroRecords'|_}}",
                    'emptyPanes': "{{'general.datatable.emptyPanes'|_}}",
                    'emptyTable': "{{'general.datatable.emptyTable'|_}}",
                    'search': '',
                    'searchPlaceholder': "{{'page.school.dashboard.specilists.table.search.placeholder'|_}}",
                    'lengthMenu': "{{'general.datatable.lengthMenu'|_}}: _MENU_",
                    'paginate': {
                        'first': '«',
                        'previous': '‹',
                        'next': '›',
                        'last': '»',
                    },
                    'aria': {
                        'paginate': {
                            'first': "{{'general.datatable.first'|_}}",
                            'previous': "{{'general.datatable.previous'|_}}",
                            'next': "{{'general.datatable.next'|_}}",
                            'last': "{{'general.datatable.last'|_}}"
                        }
                    }
                }
            });

            /***********************************************
            *********** Teacher datatable ******************
            ***********************************************/

            $('#teachers-datatable').DataTable({
                dom: '<"row"<"col-12"t>><"row bg-white p-3 rounded-bottom"<"col-6 d-flex align-items-center"l><"col-6 d-flex align-items-center justify-content-end"ip>>',
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100]
                ],
                bSort: true,
                responsive: true,
                processing: true,
                pagingType: 'simple',
                language: {
                    "info": "_PAGE_ - _PAGE_ of _PAGES_",
                    'zeroRecords': "{{'general.datatable.zeroRecords'|_}}",
                    'emptyPanes': "{{'general.datatable.emptyPanes'|_}}",
                    'emptyTable': "{{'general.datatable.emptyTable'|_}}",
                    'search': '',
                    'searchPlaceholder': "{{'page.school.dashboard.specilists.table.search.placeholder'|_}}",
                    'lengthMenu': "{{'general.datatable.lengthMenu'|_}}: _MENU_",
                    'paginate': {
                        'first': '«',
                        'previous': '‹',
                        'next': '›',
                        'last': '»',
                    },
                    'aria': {
                        'paginate': {
                            'first': "{{'general.datatable.first'|_}}",
                            'previous': "{{'general.datatable.previous'|_}}",
                            'next': "{{'general.datatable.next'|_}}",
                            'last': "{{'general.datatable.last'|_}}"
                        }
                    }
                }
            });
        });
    </script>
{% endput %}
