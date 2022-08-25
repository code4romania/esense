title = "Profil elev"
url = "/school/student/:studentId"
layout = "web-app"
description = "Used for viewing a student"
is_hidden = 0

[session]
security = "user"
allowedUserGroups[] = "registered"
allowedUserTypes[] = "school"

[student]

[lessonsActions]
==
<div class="container-fluid px-lg-4 mb-5">
    <div class="row">
        <!-- Back link -->
        <div class="col-12 my-3">
            <div class="d-flex align-itmes-center">
                <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/arrow-black.svg'|theme }}">
                <a class="ml-3 text-black" href="{{ 'school/students'|page }}">{{ 'page.school.dashboard.back.students.link'|_ }}</a>
            </div>
        </div>

        <div class="col-12">
            <div class="bg-white rounded" style="box-shadow: 0px 0px 32px rgba(136, 152, 170, 0.15)">
                <div class="row">

                    <!-- Student details and actions -->
                    <div class="col-12 mb-5">
                        <div class="p-3 d-flex align-items-start justify-content-between">
                            <div class="d-flex flex-column flex-md-row">
                                {% if student.avatar %}
                                    <img class="img-profile rounded-circle mb-2 mb-md-0" src="{{ student.avatar.getThumb(80, 80, { mode : 'crop' } ) }}" alt="avatar">
                                {% elseif student.gender == 'female' %}
                                    <img class="img-profile rounded-circle mb-2 mb-md-0" width="80" height="80" src="{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}" alt="avatar">
                                {% else %}
                                    <img class="img-profile rounded-circle mb-2 mb-md-0" width="80" height="80" src="{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}" alt="avatar">
                                {% endif %}

                                <div class="ml-3">
                                    <p class="p-0 m-0 font-weight-bold text-dark" style="line-height: 25px;">{{ student.full_name }}</p>
                                    <p class="p-0 m-0 small text-dark" style="line-height: 22px;">{{ 'page.school.dashboard.student.age.label'|_ }} {{ student.age }}&nbsp;{{ 'page.school.dashboard.student.years.text'|_ }}</p>
                                    <p class="p-0 m-0 small text-dark" style="line-height: 22px;">{{ 'page.school.dashboard.student.specialist.name'|_ }}
                                        {% for specialist in student.specialists %}
                                            {% if loop.last %}
                                                {{ specialist.full_name }}
                                            {% else %}
                                                {{ specialist.full_name }},&nbsp;
                                            {% endif %}
                                        {% endfor %}
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <p class="p-0 m-0 mr-2 d-none d-md-block" style="line-height: 25px; color: #313131;">{{ 'page.school.dashboard.student.actions'|_ }}</p>
                                <div class="dropdown">
                                    <button class="btn shadow-none p-0 m-0" type="button" id="studentsTableOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="" src="{{ 'assets/img/svg/dashboard/options.svg'|theme }}">
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="studentsTableOptions">

                                        <a class="dropdown-item display-4" href="{{ 'school/student-edit'|page({studentId: student.id}) }}" style="color: #1A212C;">
                                            {{ 'page.school.dashboard.student.options.edit'|_ }}
                                        </a>

                                        <a class="dropdown-item display-4" style="color: #1A212C;" role="button" data-toggle="modal" data-target="#archiveStudentModal" data-name='{{ student.full_name }}' data-id='{{ student.id }}' data-avatar='{% if student.avatar %}{{student.avatar.getThumb(40,40, { mode : 'crop' } )}}{% elseif student.gender == 'female' %}{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}{% else %}{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}{% endif %}'>
                                            {{ 'page.school.dashboard.student.options.archive'|_ }}
                                        </a>

                                        {% if user.profile.affiliated %}
                                            <a class="dropdown-item display-4" href="#" style="color: #1A212C;">
                                                {{ 'page.school.dashboard.student.options.invite_specialist'|_ }}
                                            </a>
                                        {% endif %}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity schedule -->
                    <div class="col-12 col-lg-6" id="schedule-timeline">
                        {% partial 'web-app/general/schedule-timeline' title='page.school.dashboard.student.profile.schedule_timeline'|_ lessons=student.today_lessons allow_edit=false %}
                    </div>

                    <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="calendar-wrapper"></div>
                    </div>

                    <!-- Student profile table -->
                    <div class="col-12 mt-5">
                        <p class="text-gray-dark font-weight-bold px-3">{{ 'page.school.dashboard.student.profile.exercises'|_ }}</p>

                        <div id="student-lessons-datatable-container">
                        <!-- Partial for school student lessons  -->
                            {%
                                partial 'web-app/school/student-lessons'

                                month = 'now'|date('n')
                                year = 'now'|date('Y')

                                years = student.lessons_years
                                lessons = student.getLessonsFromMonth()

                            %}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Partial for archiving a student -->
{% partial 'web-app/general/student-archive' %}

{% put scripts %}
    <script type="text/javascript">

        $(document).ready(function () {
            /** Function that extarcts the schedule for a date and updates the page. */
            function selectDate(date) {
                /** Update the calendar. */
                $('.calendar-wrapper').updateCalendarOptions({date: date});

                /** Extract the formated date. */
                var $_date = new Date(date);
                var $formatedDate = $_date.getFullYear() + '-' + ((2 > ($_date.getMonth() + 1).length) ? ('0' + ($_date.getMonth() + 1)) : ($_date.getMonth() + 1)) + '-' + ((2 > $_date.getDate().length) ? ('0' + $_date.getDate()) : ($_date.getDate()))

                $.request('onGetStudentDateLessons', {
                    data: {
                        student: {{ student.id }},
                        date: $formatedDate
                    },
                    update: {
                        'web-app/general/schedule-timeline': '#schedule-timeline'
                    }
                });
            }

            /** Intialize the calendar. */
            $('.calendar-wrapper').calendar({
                weekDayLength: 1,
                date: new Date(),
                onClickDate: selectDate,
                showYearDropdown: true,
                prevButton: '<',
                nextButton: '>',
                todayButtonContent: '',
                showTodayButton: false,
                min: "{{ student.created_at.format('m/d/Y') }}",
                highlightedDays: {{ (student.lessons.pluck('day').toJson())|raw }},
                max: new Date(),
            });
        });

    </script>
{% endput %}
