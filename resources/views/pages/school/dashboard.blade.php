title = "Panou de administrare"
url = "/school/dashboard"
layout = "web-app"
description = "Dashboard"
is_hidden = 0

[session]
security = "user"
allowedUserGroups[] = "registered"
allowedUserTypes[] = "school"

[specialist]

[chartsActions]

[lessonsActions]
==
<div class="container-fluid px-lg-4">
    <div class="row">

        <!-- Dashboard title -->
        <div class="col-12">
            <h4 class="text-gray-dark font-weight-light mb-4">{{'page.school.dashboard.title'|_}}</h4>
        </div>

          <!-- Students card -->
          <div class="col-12 col-md-6">
            <div class="bg-white rounded shadow py-3 px-4 d-flex justify-content-between">
                <div>
                    <h6 class="text-gray-light">{{'page.school.dashboard.students.card.title'|_}}</h6>
                    <h5 class="text-gray-dark">{{ user.profile.students.count }}</h5>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/arrow-right.svg'|theme }}">
                        <a class="ml-2 display-4 text-gray-light" href="{{ 'school/students'|page }}">{{'page.school.dashboard.students.card.link'|_}}</a>
                    </div>
                </div>
                <div>
                    <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/user-bordered.svg'|theme }}">
                </div>
            </div>
        </div>

        <!-- Specialists card -->
        <div class="col-12 col-md-6 mt-4 mt-md-0">
            <div class="bg-white rounded shadow py-3 px-4 d-flex justify-content-between">
                <div>
                    <h6 class="text-gray-light">{{'page.school.dashboard.specialists.card.title'|_}}</h6>
                    <h5 class="text-gray-dark">{{ user.profile.active_specialists.count }}</h5>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/arrow-right.svg'|theme }}">
                        <a class="ml-2 display-4 text-gray-light" href="{{ 'school/specialists'|page }}">{{'page.school.dashboard.specialists.card.link'|_}}</a>
                    </div>
                </div>
                <div>
                    <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/rounded-users.svg'|theme }}">
                </div>
            </div>
        </div>

        <!-- Teachers activity chart -->
        <div id="activity-chart-container" class="col-12 mt-5">

            {% set durations = user.profile.getYearLessonsDurations() %}
            <!-- Partial for teachers activity chart -->
            {%
                partial 'web-app/school/activity-chart'

                year = 'now'|date('Y')
                years = user.profile.lessons_years
                values = durations['values']
                tooltips = durations['tooltips']
            %}
        </div>

        <!-- Specialists table -->
        <div class="col-12 my-5">
            <div class="table-responsive rounded p-3" style="overflow-x: hidden; background: linear-gradient(0deg, #FFFFFF, #FFFFFF);">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="font-weight-bold text-dark">{{'page.school.dashboard.specilists.table.title'|_}} <span class="text-gray-medium font-weight-normal">({{ user.profile.active_specialists.count }})</span></p>
                    <a href="{{"school/specialist-add"|page}}" class="btn btn-sm btn-primary-light d-flex align-items-center justify-content-around px-2" style="width:160px;">
                        <i class="fas fa-user-edit mr-2"></i>
                        {{'page.school.dashboard.specilists.table.add.specilist'|_}}
                    </a>
                </div>
                <table id="specialists-datatable" class="table table-striped table-sm pt-3 px-3 m-0" cellspacing="0">
                    <thead>
                        <tr>
                            <!-- Specialist name column -->
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.specialists.table.column.name'|_}}</p></th>
                            <!-- Number of students column -->
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.specialists.table.column.students_number'|_}}</p></th>
                            <!-- Registration date column -->
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.specialists.table.column.created_at'|_}}</p></th>
                            <!-- Email column -->
                            <th><p class="p-0 m-0 py-2 pl-2 display-4" style="line-height: 18px; letter-spacing:0.2px">{{'page.school.dashboard.specialists.table.column.email'|_}}</p></th>
                            <!-- Actions column -->
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for specialist in user.profile.active_specialists %}
                            <tr>
                            <!-- Specialist avatar and name -->
                                <td>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="pl-2 py-3 d-flex align-items-center">
                                            {% if specialist.user.avatar %}
                                                <img class="img-fluid img-avatar rounded-circle add-custom-avatar" src="{{specialist.user.avatar.getThumb(40,40, { mode : 'crop' } )}}" alt="avatar">
                                            {% else %}
                                                <img class="img-fluid add-custom-avatar" width="40px" height="40px" src="{{ 'assets/img/svg/dashboard/user-bordered.svg'|theme }}">
                                            {% endif %}
                                            <div class="d-flex flex-column ml-2">
                                                <a class="display-4 font-weight-light" href="{{ 'school/specialist'|page({specialistId: specialist.id }) }}" style="letter-spacing: 0.2px; line-height:20px; color:#252733;">{{ specialist.full_name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Number of students column -->
                                <td>
                                    <div class="pl-2 py-3 d-flex align-items-center">
                                        <p class="p-0 m-0 pt-2 font-weight-light display-4 text-gray-light" style="letter-spacing: 0.2px; line-height:20px;">{{ specialist.students.count }}</p>
                                    </div>
                                </td>

                                <!-- Registration date column -->
                                <td>
                                    <div class="pl-2 py-3 d-flex align-items-center">
                                        <p class="p-0 m-0 pt-2 font-weight-light display-4 text-gray-light" style="letter-spacing: 0.2px; line-height:20px;">{{ specialist.created_at|date("d/m/Y") }}</p>
                                    </div>
                                </td>

                                <!-- Email column -->
                                <td>
                                    <div class="pl-2 py-3 d-flex align-items-center">
                                        <p class="p-0 m-0 pt-2 font-weight-light display-4 text-gray-light" style="letter-spacing: 0.2px; line-height:20px;">{{ specialist.email }}</p>
                                    </div>
                                </td>

                                <!-- Actions column -->
                                <td>
                                    <div class="pl-2 py-3 d-flex align-items-center">
                                        <a role="button" data-toggle="modal" data-target="#arhiveTeacherModal" data-name='{{ specialist.full_name }}' data-id='{{ specialist.id }}' data-avatar='{% if specialist.user.avatar %}{{specialist.user.avatar.getThumb(40,40, { mode : 'crop' } )}}{% else %}{{ 'assets/img/svg/dashboard/user-bordered.svg'|theme }}{% endif %}'>
                                            <img class="img-fluid pt-2" src="{{ 'assets/img/svg/dashboard/file-container.svg'|theme }}">
                                        </a>
                                        <div class="dropdown pt-2">
                                            <button class="btn shadow-none" type="button" id="studentsTableOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/options.svg'|theme }}">
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="studentsTableOptions">
                                                <a class="dropdown-item display-4" href="{{ 'school/specialist-edit'|page({specialistId: specialist.id }) }}" style="color: #1A212C;">{{'page.school.dashboard.students.table.options.link_1'|_}}</a>
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

<!-- Partial for archiving a specialist -->
{% partial 'web-app/school/specialist-archive' %}

{% put scripts %}
    <!-- Scripts for datatables -->
    <script type="text/javascript">
        $(document).ready(function () {

            /***********************************************
            *********** Teacher datatable ******************
            ***********************************************/

            $('#specialists-datatable').DataTable({
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
