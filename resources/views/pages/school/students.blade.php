title = "Elevi"
url = "/school/students"
layout = "web-app"
description = "Displays the list of school students"
is_hidden = 0

[session]
security = "user"
allowedUserGroups[] = "registered"
allowedUserTypes[] = "school"

[student]
==
<div class="container-fluid px-lg-4 mb-5">
    <div class="row">
        <div class="col-12">
            <h4>{{'page.school.dashboard.students.title'|_}}</h4>
        </div>
        <div class="col-12">
            <div class="table-responsive" style="overflow-x: hidden;">
                <table id="students-datatable" class="table table-striped table-sm pt-3 px-3 m-0" cellspacing="0" style="background: linear-gradient(0deg, #FFFFFF, #FFFFFF);">
                    <thead>
                        <tr>
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.students.table.column_1'|_}}</p></th>
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.students.table.column_2'|_}}</p></th>
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.students.table.column_3'|_}}</p></th>
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.students.table.column_4'|_}}</p></th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for student in user.profile.unarchived_students %}
                            <tr>
                                <td>
                                   <div class="d-flex align-items-center justify-content-between">
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
                                                <a class="display-4 font-weight-light" href="{{ 'school/student'|page({studentId: student.id }) }}" style="letter-spacing: 0.2px; line-height:20px; color:#252733;">{{ student.full_name }}</a>
                                                <h6 class="p-0 m-0 font-weight-normal text-gray">{{ student.birthdate|date("d/m/Y") }}</h6>
                                            </div>
                                        </div>
                                        <div class="d-block d-lg-none">
                                            <div class="pl-2 py-3 d-flex align-items-center">
                                                <a role="button" data-toggle="modal" data-target="#archiveStudentModal" data-name='{{ student.full_name }}' data-id='{{ student.id }}' data-avatar='{% if student.avatar %}{{student.avatar.getThumb(40,40, { mode : 'crop' } )}}{% elseif student.gender == 'female' %}{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}{% else %}{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}{% endif %}'>
                                                    <img class="img-fluid pt-2 ml-4" src="{{ 'assets/img/svg/dashboard/file-container.svg'|theme }}">
                                                </a>
                                                <div class="dropdown pt-2">
                                                    <button class="btn shadow-none" type="button" id="studentsTableOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/options.svg'|theme }}">
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="studentsTableOptions">
                                                        <a class="dropdown-item display-4" href="{{ 'school/student-edit'|page({studentId: student.id }) }}" style="color: #1A212C;">{{'page.school.dashboard.students.table.options.link_1'|_}}</a>
                                                        <a class="dropdown-item display-4" href="#" style="color: #1A212C;">{{'page.school.dashboard.students.table.options.link_2'|_}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                </td>
                                <td>
                                    <div class="pl-2 py-3">
                                        <div class="d-flex flex-column">
                                            {% if student.hearing_impairment %}
                                                <p class="p-0 m-0 display-4 text-gray font-weight-light" style="letter-spacing: 0.2px; line-height:20px;">{{'page.school.dashboard.student.table.disability.hearing'|_}}</p>
                                            {% endif %}
                                            {% if student.visual_impairment %}
                                                <p class="p-0 m-0 display-4 text-gray font-weight-light" style="letter-spacing: 0.2px; line-height:20px;">{{'page.school.dashboard.student.table.disability.seeing'|_}}</p>
                                            {% endif %}
                                            {% if (not student.hearing_impairment) and (not student.visual_impairment) %}
                                                <p class="p-0 m-0 display-4 text-gray font-weight-light" style="letter-spacing: 0.2px; line-height:20px;">{{'page.school.dashboard.student.table.disability.none'|_}}</p>
                                            {% endif %}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="pl-2 py-3">
                                        <p class="p-0 m-0 pt-2 font-weight-light display-4" style="letter-spacing: 0.2px; line-height:20px; color:#252733;">{{ student.age }}&nbsp;{{'page.school.dashboard.student.table.years'|_}}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="pl-2 py-3">
                                        <div class="d-flex align-items-center pt-2">
                                            <p class="p-0 m-0 font-weight-light display-4" style="letter-spacing: 0.2px; line-height:20px; color:#252733;">{{ student.owner.user.full_name }}</p>
                                            <img class="img-fluid ml-2" src="{{ 'assets/img/svg/dashboard/users.svg'|theme }}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-none d-lg-block">
                                        <div class="pl-2 py-3 d-flex align-items-center">
                                            <a role="button" data-toggle="modal" data-target="#archiveStudentModal" data-name='{{ student.full_name }}' data-id='{{ student.id }}' data-avatar='{% if student.avatar %}{{student.avatar.getThumb(40,40, { mode : 'crop' } )}}{% elseif student.gender == 'female' %}{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}{% else %}{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}{% endif %}'>
                                                <img class="img-fluid pt-2 ml-4" src="{{ 'assets/img/svg/dashboard/file-container.svg'|theme }}">
                                            </a>
                                            <div class="dropdown pt-2">
                                                <button class="btn shadow-none" type="button" id="studentsTableOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/options.svg'|theme }}">
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="studentsTableOptions">
                                                    <a class="dropdown-item display-4" href="{{ 'school/student-edit'|page({studentId: student.id }) }}" style="color: #1A212C;">{{'page.school.dashboard.students.table.options.link_1'|_}}</a>
                                                </div>
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

<!-- Partial for archiving a teacher -->
{% partial 'web-app/general/student-archive' %}

{% put scripts %}
    <!-- Scripts for datatables -->
    <script type="text/javascript">
        $(document).ready(function () {

            /***********************************************
            ************* Students datatable ***************
            ***********************************************/

            $('#students-datatable').DataTable({
                dom: '<"row"<"col-12 added-content">><"row"<"col-12"t>><"row bg-white p-3 rounded-bottom"<"col-6 d-flex align-items-center"l><"col-6 d-flex align-items-center justify-content-end"ip>>',
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
            $('.added-content').html('\
            <div class="row pb-3 px-3 pt-4 rounded-top" style="background: linear-gradient(0deg, #FFFFFF, #FFFFFF);"> \
                <div class="col-12 col-lg-7">\
                    <p class="text-medium-dark font-weight-bold">\
                        {{"page.school.dashboard.students.table.text"|_}} ({{ user.profile.students.count }})\
                    </p>\
                </div>\
                <div class="col-12 col-lg-5">\
                    <div class="d-flex align-items-center justify-content-start justify-content-lg-end">\
                        <a href="{{ "school/student-add"|page }}" class="btn btn-sm btn-primary-light d-flex align-items-center justify-content-around py-1 px-2" style="width:140px;">\
                            <i class="fas fa-user-edit mr-2"></i> {{"page.school.dashboard.students.table.add.btn.text"|_}}\
                        </a>\
                    </div>\
                </div>\
            </div>');
        });

    </script>
{% endput %}
