title = "Arhivă"
url = "/specialist/archive"
layout = "web-app"
description = "Displays archived students list"
is_hidden = 0

[session]
security = "user"
allowedUserGroups[] = "registered"
allowedUserTypes[] = "specialist"

[student]
==
<?php
    use Genuineq\User\Helpers\RedirectHelper;

    function onStart()
    {
        if (Auth::user() && ('specialist' == Auth::user()->type) && Auth::user()->profile->affiliated) {
            return Redirect::to(RedirectHelper::accessDenied());
        }
    }
?>
==
<div class="container-fluid px-lg-4">
    <div class="row">

        <!-- Dashboard title -->
        <div class="col-12">
            <h4 class="text-gray-dark font-weight-light mb-4">{{ 'page.specialist.dashboard.archive.title'|_ }}</h4>
        </div>

        <!-- Students table -->
        <div class="col-12 my-5">
            <div class="table-responsive rounded p-3" style="overflow-x: hidden; background: linear-gradient(0deg, #FFFFFF, #FFFFFF);">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="font-weight-bold text-dark">{{ 'page.specialist.dashboard.archive.students.number'|_ }}<span class="text-gray-medium font-weight-normal">({{ user.profile.archivedStudents.count }})</span></p>
                </div>
                <table id="archived-students-table" class="table table-striped table-sm pt-3 px-3 m-0" cellspacing="0">
                    <thead>
                        <tr>
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.specialist.dashboard.archive.students.table.column_1'|_}}</p></th>
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.specialist.dashboard.archive.students.table.column_2'|_}}</p></th>
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.specialist.dashboard.archive.students.table.column_4'|_}}</p></th>
                            <th class="no-sort d-none d-md-block"></th>
                            <th class="no-sort d-block d-md-none"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for student in user.profile.archived_students %}
                            <tr>
                                <td class="d-block d-md-none">
                                    <div class="pl-2 py-3 d-flex align-items-center justify-content-start justify-content-lg-end">

                                        <a class="d-none" href="{{ 'specialist/student'|page({studentId: student.id }) }}">
                                            <img class="img-fluid pt-2" src="{{ 'assets/img/svg/dashboard/eye.svg'|theme }}">
                                        </a>

                                        <a role="button" data-toggle="modal" data-target="#unzipStudentModal" data-name='{{ student.full_name }}' data-id='{{ student.id }}'>
                                            <img class="img-fluid pt-2" src="{{ 'assets/img/svg/dashboard/eye.svg'|theme }}">
                                        </a>

                                        <a role="button" data-toggle="modal" data-target="#deleteStudentModal" data-name='{{ student.full_name }}' data-id='{{ student.id }}' data-avatar='{% if student.avatar %}{{student.avatar.getThumb(40,40, { mode : 'crop' } )}}{% elseif student.gender == 'female' %}{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}{% else %}{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}{% endif %}'>
                                            <img class="img-fluid pt-2 ml-4" src="{{ 'assets/img/svg/dashboard/trash-bin.svg'|theme }}">
                                        </a>

                                        <div class="dropdown pt-2">
                                            <button class="btn shadow-none" type="button" id="studentsTableOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/options.svg'|theme }}">
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="studentsTableOptions">
                                                <a class="dropdown-item display-4" href="{{ 'specialist/student-edit'|page({studentId: student.id}) }}" style="color: #1A212C;">
                                                    {{ 'page.specialist.dashboard.student.options.edit'|_ }}
                                                </a>

                                                <a class="dropdown-item display-4" role="button" data-toggle="modal" data-target="#unzipStudentModal" data-name='{{ student.full_name }}' data-id='{{ student.id }}' data-avatar='{% if student.avatar %}{{student.avatar.getThumb(40,40, { mode : 'crop' } )}}{% elseif student.gender == 'female' %}{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}{% else %}{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}{% endif %}' style="color: #1A212C;">
                                                    {{'page.specialist.dashboard.students.table.options.unzip'|_}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
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
                                            <a class="display-4 font-weight-light" href="{{ 'specialist/student'|page({studentId: student.id }) }}" style="letter-spacing: 0.2px; line-height:20px; color:#252733;">{{ student.full_name }}</a>
                                            <h6 class="p-0 m-0 font-weight-normal text-gray">{{ student.birthdate|date("d/m/Y") }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="pl-2 py-3">
                                        <div class="d-flex flex-column">
                                            {% if student.hearing_impairment %}
                                                <p class="p-0 m-0 display-4 text-gray font-weight-light pt-2" style="letter-spacing: 0.2px; line-height:20px;">{{'page.specialist.dashboard.archive.disability.hearing'|_}}</p>
                                            {% endif %}
                                            {% if student.visual_impairment %}
                                                <p class="p-0 m-0 display-4 text-gray font-weight-light pt-2" style="letter-spacing: 0.2px; line-height:20px;">{{'page.specialist.dashboard.archive.disability.seeing'|_}}</p>
                                            {% endif %}
                                            {% if (not student.hearing_impairment) and (not student.visual_impairment) %}
                                                <p class="p-0 m-0 display-4 text-gray font-weight-light pt-2" style="letter-spacing: 0.2px; line-height:20px;">{{'page.specialist.dashboard.archive.disability.none'|_}}</p>
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
                                <td class="d-none d-md-block">
                                    <div class="pl-2 py-3 d-flex align-items-center">

                                        <a href="{{ 'specialist/student'|page({studentId: student.id }) }}">
                                            <img class="img-fluid pt-2" src="{{ 'assets/img/svg/dashboard/eye.svg'|theme }}">
                                        </a>

                                        <a role="button" data-toggle="modal" data-target="#deleteStudentModal" data-name='{{ student.full_name }}' data-id='{{ student.id }}' data-avatar='{% if student.avatar %}{{student.avatar.getThumb(40,40, { mode : 'crop' } )}}{% elseif student.gender == 'female' %}{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}{% else %}{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}{% endif %}'>
                                            <img class="img-fluid pt-2 ml-4" src="{{ 'assets/img/svg/dashboard/trash-bin.svg'|theme }}">
                                        </a>

                                        <div class="dropdown pt-2">
                                            <button class="btn shadow-none" type="button" id="studentsTableOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/options.svg'|theme }}">
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="studentsTableOptions">
                                                <a class="dropdown-item display-4" href="{{ 'specialist/student-edit'|page({studentId: student.id}) }}" style="color: #1A212C;">
                                                    {{ 'page.specialist.dashboard.student.options.edit'|_ }}
                                                </a>

                                                <a class="dropdown-item display-4" role="button" data-toggle="modal" data-target="#unzipStudentModal" data-name='{{ student.full_name }}' data-id='{{ student.id }}' data-avatar='{% if student.avatar %}{{student.avatar.getThumb(40,40, { mode : 'crop' } )}}{% elseif student.gender == 'female' %}{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}{% else %}{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}{% endif %}' style="color: #1A212C;">
                                                    {{'page.specialist.dashboard.students.table.options.unzip'|_}}
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

<!-- Partial for delete a student -->
{% partial 'web-app/general/student-delete' %}
<!-- Partial for unzip a student -->
{% partial 'web-app/general/student-unzip' %}

{% put scripts %}
    <!-- Scripts for datatables -->
    <script type="text/javascript">
        $(document).ready(function () {

            /***********************************************
            ************** Students datatable *************
            ***********************************************/

            $('#archived-students-table').DataTable({
                dom: '<"row"<"col-12"t>><"row bg-white p-3 rounded-bottom"<"col-12 col-md-6 d-flex align-items-center"l><"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-lg-end"ip>>',
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100]
                ],
                responsive: true,
                processing: true,
                pagingType: 'simple',
                language: {
                    "info": "_PAGE_ - _PAGE_ of _PAGES_",
                    'zeroRecords': "{{'general.datatable.zeroRecords'|_}}",
                    'emptyPanes': "{{'general.datatable.emptyPanes'|_}}",
                    'emptyTable': "{{'general.datatable.emptyTable'|_}}",
                    'search': '',
                    'searchPlaceholder': "Cauta un elev dupa nume",
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
