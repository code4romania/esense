title = "Adaugă elev"
url = "/school/student-add"
layout = "web-app"
description = "Used for adding a new student"
is_hidden = 0

[session]
security = "user"
allowedUserGroups[] = "registered"
allowedUserTypes[] = "school"

[student]
throwBeforeStudentCreateStart = 1
==
<div class="container-fluid px-lg-4">
    <div class="row">

        <!-- Back link -->
        <div class="col-12 my-3">
            <div class="d-flex align-itmes-center">
                <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/arrow-black.svg'|theme }}">
                <a class="ml-3 text-black" href="{{ 'school/students'|page }}">{{'page.school.dashboard.student.profile.back.link.text'|_}}</a>
            </div>
        </div>

        <div class="col-12">
            <div class="rounded shadow bg-white p-lg-4">

                <div class="border-bottom">
                    <p class="text-muted">{{'page.school.dashboard.student.add.profile.title'|_}}</p>
                </div>

                <form method="POST" data-request="onCreateStudent" data-request-validate data-request-flash data-request-files>
                    <div class="row mt-2">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <p class="py-3 text-muted">{{'page.school.dashboard.student.add.profile.gen.title'|_}}</p>
                                    <div class="d-flex">
                                        <div class="nav flex-row nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active btn btn-sm btn-outline border-dark px-5" id="v-pills-female-tab" data-gender="female" data-toggle="pill" href="#v-pills-female" role="tab" aria-controls="v-pills-female" aria-selected="true">{{'page.school.dashboard.student.add.gen.fata'|_}}</a>
                                            <a class="nav-link ml-4 btn btn-sm btn-outline border-dark px-5" id="v-pills-male-tab" data-gender="male" data-toggle="pill" href="#v-pills-male" role="tab" aria-controls="v-pills-male" aria-selected="false">{{'page.school.dashboard.student.add.gen.baiat'|_}}</a>
                                        </div>
                                        <span class="text-danger ml-2">*</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <p class="p-0 m-0 pt-3 text-muted">{{'page.school.dashboard.student.add.profile.avatar'|_}}</p>

                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-female" role="tabpanel" aria-labelledby="v-pills-female-tab">
                                            <div class="d-flex">
                                                <div class="avatars d-none">
                                                    <div class="predifined-avatar active-avatar d-block">
                                                        <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/girl-avatar-1.svg'|theme }}">
                                                    </div>
                                                    <div class="predifined-avatar d-block ml-4">
                                                        <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/girl-avatar-2.svg'|theme }}">
                                                    </div>
                                                </div>

                                                <div class="add-avatar">
                                                    <img id="add-avatar" class="img-fluid rounded-circle add-custom-avatar mt-2" src="{{ 'assets/img/svg/dashboard/add-student-gray.svg'|theme }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-male" role="tabpanel" aria-labelledby="v-pills-male-tab">
                                            <div class="d-flex">
                                                <div class="avatars1 d-none">
                                                    <div class="predifined-avatar1 active-avatar1 d-block">
                                                        <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/baiat-avatar-1.svg'|theme }}">
                                                    </div>
                                                    <div class="predifined-avatar1 d-block ml-4">
                                                        <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/baiat-avatar-2.svg'|theme }}">
                                                    </div>
                                                </div>

                                                <div class="add-avatar">
                                                    <img id="add-avatar2" class="img-fluid rounded-circle add-custom-avatar mt-2" src="{{ 'assets/img/svg/dashboard/add-student-gray.svg'|theme }}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Input for adding custom avatar -->
                                        <input name="avatar" id="avatar" class="d-none custom-avatar onChangeValue" onchange="previewFile(this)" accept="image/*" type="file"/>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Input for gender -->
                        <input name="gender" id="gender" class="d-none" type="text" value="female" />

                        <div class="col-12">
                            <p class="text-muted mt-5">{{'page.school.dashboard.student.add.profile.personal.data'|_}}</p>
                            <p class="display-4 text-gray-light">{{'page.school.dashboard.student.add.profile.dob.label'|_}}</p>
                            <div class="row">

                                <!-- Select date -->
                                <div class="col-12 col-md-4 col-lg-5 pr-lg-0 mr-lg-0">
                                    <div class="form-group d-flex">
                                        <input autocomplete="off" type="text" name="birthdate" id="birthdate" class="form-control onChangeValue">
                                        <span class="text-danger ml-2">*</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Input last name -->
                        <div class="col-12 col-md-6">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control onChangeValue" name="surname" id="surname" placeholder="{{'page.school.dashboard.student.add.profile.input.last.name'|_}}">
                                <span class="text-danger ml-2">*</span>
                            </div>
                        </div>

                        <!-- Input first name -->
                        <div class="col-12 col-md-6">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control onChangeValue" name="name" id="name" placeholder="{{'page.school.dashboard.student.add.profile.input.first.name'|_}}">
                                <span class="text-danger ml-2">*</span>
                            </div>
                        </div>

                        <!-- Teacher select -->
                        <div class="col-12">
                            <div class="form-group register-select mr-3">
                                <select name="owner" id="specialist" class="form-control border outline-none selectpicker" data-live-search="true" data-none-results-text="{{'page.school.dashboard.student.add.specialist.select.no.result'|_}}" data-style="btn-white">
                                    {% for key, specialist in user.profile.active_specialists %}
                                        <option value="{{ specialist.id }}">{{ specialist.full_name }}</option>
                                    {% endfor %}
                                </select>
                            </div>
                        </div>

                    </div>

                        <!-- Input diagnostic description -->
                        <div class="col-12">
                            <label class="small text-gray-light">{{'page.school.dashboard.student.add.profile.textarea.diagnostic'|_}}</label>
                            <div class="form-group d-flex">
                                <textarea class="form-control onChangeValue" name="description" id="description" rows="3"></textarea>
                                <span class="text-danger ml-2">*</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <!-- Select disability y/n -->
                                <div class="col-12 col-md-6 ml-lg-0 pl-lg-0">
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <label class="form-check-label display-4 text-gray-light" for="hearing_impairment">{{'page.school.dashboard.student.add.profile.checkbox1.label'|_}}</label>
                                            <input class="onChangeValue" name="hearing_impairment" id="hearing_impairment" type="checkbox" data-toggle="toggle" data-onstyle="secondary" data-offstyle="gray-medium" data-size="xs" data-on="{{'page.school.dashboard.student.toggle.yes'|_}}" data-off="{{'page.school.dashboard.student.toggle.no'|_}}" data-style="ios">
                                        </div>
                                        <span class="text-danger ml-2">*</span>
                                    </div>
                                </div>

                                <!-- Select disability y/n -->
                                <div class="col-12 col-md-6">
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <label class="form-check-label display-4 text-gray-light" for="visual_impairment">{{'page.school.dashboard.student.add.profile.checkbox2.label'|_}}</label>
                                            <input class="onChangeValue" name="visual_impairment" id="visual_impairment" type="checkbox" data-toggle="toggle" data-onstyle="secondary" data-offstyle="gray-medium" data-size="xs" data-on="{{'page.school.dashboard.student.toggle.yes'|_}}" data-off="{{'page.school.dashboard.student.toggle.no'|_}}" data-style="ios">
                                        </div>
                                        <span class="text-danger ml-2">*</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="contact_persons_wrapper" class="pl-lg-3 pr-lg-4">
                            <!-- First contact person -->
                            <div id="person-1" class="student-add-contact px-3 px-lg-2 my-4 rounded shadow-sm">
                                {% 
                                    partial 'web-app/general/student-contact-person' 
                                    
                                    index = 1 
                                    nextIndex = 2 
                                    display = true
                                    displayDeleteButton = false
                                    hideAddPerson = false
                                %}
                            </div>

                            <!-- Second contact person -->
                            <div id="person-2" class="student-add-contact px-3 px-lg-2 my-4 rounded shadow-sm">
                                {% 
                                    partial 'web-app/general/student-contact-person' 
                                    
                                    index = 2 
                                    nextIndex = 3
                                    display = false
                                    displayDeleteButton = true
                                    hideAddPerson = false
                                %}
                            </div>

                            <!-- Third contact person -->
                            <div id="person-3" class="student-add-contact px-3 px-lg-2 my-4 rounded shadow-sm">
                                {% 
                                    partial 'web-app/general/student-contact-person' 
                                    
                                    index = 3 
                                    nextIndex = 4 
                                    display = false
                                    displayDeleteButton = true
                                    hideAddPerson = false
                                %}
                            </div>

                            <!-- Forth contact person -->
                            <div id="person-4" class="student-add-contact px-3 px-lg-2 my-4 rounded shadow-sm">
                                {% 
                                    partial 'web-app/general/student-contact-person' 
                                    
                                    index = 4 
                                    nextIndex = 5 
                                    display = false
                                    displayDeleteButton = true
                                    hideAddPerson = false
                                %}
                            </div>

                            <!-- Fifth contact person -->
                            <div id="person-5" class="student-add-contact px-3 px-lg-2 my-4 rounded shadow-sm">
                                {% 
                                    partial 'web-app/general/student-contact-person' 
                                    
                                    index = 5 
                                    hideAddPerson = true
                                    display = false
                                    displayDeleteButton = true
                                %}
                            </div>
                        </div>

                         <!-- Submit button -->
                        <div class="col-12 mb-5 mt-3">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="add-student btn btn-sm text-white btn-gray-light px-5" disabled>{{'page.school.dashboard.student.add.profile.submit.btn.text'|_}}</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ro.min.js" integrity="sha512-OyKt3ZoVnoGpHGx10TMtzQTSDHKyGzHIXdOoOiaHcMJMGOR/ev9Y6ocEGd64HVPqGEwkg29xVVbavNjDPeg9GA==" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ ['assets/js/file-preview.js']|theme }}"></script>

{% put scripts %}
    <script type="text/javascript">
        $(document).ready(function () {

            /** WYSWYG Editor. */
            $('#description').richText({
                id:'diagnostic',
                class: 'onChangeValue',
                useParagraph:true
            });

            /** Initiate the datepicker plugin. */
            $('#birthdate').datepicker({
                format: "dd-mm-yyyy",
                weekStart: 1,
                clearBtn: true,
                language: "ro",
                orientation: "bottom auto",
                autoclose: true
            });

            /** Function that handles gender switch on active tab toggle */
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                /* Set the gender value. */
                $('#gender').val($(e.target).data('gender'));
            });

            /** Add file input functionlity for plus-icon img. */
            $(".add-custom-avatar").click(function () {
                $(".custom-avatar").trigger('click');
            });

            /**
             * Function for activating the finish button when
             * values from all fields are selected
             */
            function activateFinishBtn() {
                $('.add-student').removeAttr('disabled');
                $('.add-student').removeClass('btn-gray-light');
                $('.add-student').removeClass('text-white');
                $('.add-student').addClass('btn-secondary');
            }

            /**
             * Function for deactivating the finish button when
             * values from all fields are selected
             */
            function deactivateFinishBtn() {
                $('.add-student').attr('disabled');
                $('.add-student').addClass('btn-gray-light');
                $('.add-student').addClass('text-white');
                $('.add-student').removeClass('btn-secondary');
            }

           /** Validation for activeting the finish button. */
            $(document.body).on('change keyup', '.onChangeValue', function(){
                if(
                    (
                        ((0 !== $("#birthdate").val().length)  && ((0 == $("#surname").val().length) || (0 == $("#name").val().length) || (0 == $("#diagnostic .richText-editor").text().length)  || (0 == $("#contact_1_surname_id").val().length) || (0 == $("#contact_1_name_id").val().length) || (0 == $("#contact_1_phone_id").val().length) )) ||
                        ((0 !== $("#surname").val().length)  && ((0 == $("#birthdate").val().length) || (0 == $("#name").val().length) || (0 == $("#diagnostic .richText-editor").text().length)  || (0 == $("#contact_1_surname_id").val().length) || (0 == $("#contact_1_name_id").val().length) || (0 == $("#contact_1_phone_id").val().length) )) ||
                        ((0 !== $("#name").val().length)  && ((0 == $("#surname").val().length) || (0 == $("#birthdate").val().length) || (0 == $("#diagnostic .richText-editor").text().length)  || (0 == $("#contact_1_surname_id").val().length) || (0 == $("#contact_1_name_id").val().length) || (0 == $("#contact_1_phone_id").val().length) )) ||
                        ((0 !== $("#diagnostic .richText-editor").text().length) && ((0 == $("#surname").val().length) || (0 == $("#name").val().length) || (0 == $("#birthdate").val().length) || (0 == $("#contact_1_surname_id").val().length) || (0 == $("#contact_1_name_id").val().length) || (0 == $("#contact_1_phone_id").val().length) )) ||
                        ((0 !== $("#contact_1_surname_id").val().length) && ((0 == $("#contact_1_name_id").val().length) || (0 == $("#contact_1_phone_id").val().length) || (0 == $("#birthdate").val().length) || (0 == $("#surname").val().length) || (0 == $("#name").val().length) || (0 == $("#diagnostic .richText-editor").text().length)  )) ||
                        ((0 !== $("#contact_1_name_id").val().length) && ((0 == $("#contact_1_surname_id").val().length) || (0 == $("#contact_1_phone_id").val().length) || (0 == $("#birthdate").val().length) || (0 == $("#surname").val().length) || (0 == $("#name").val().length) || (0 == $("#diagnostic .richText-editor").text().length)  )) ||
                        ((0 !== $("#contact_1_phone_id").val().length) && ((0 == $("#contact_1_surname_id").val().length) || (0 == $("#contact_1_name_id").val().length) || (0 == $("#birthdate").val().length) || (0 == $("#surname").val().length) || (0 == $("#name").val().length) || (0 == $("#diagnostic .richText-editor").text().length)  ))
                    ) ||
                    (
                        ((0 !== $("#contact_2_surname_id").val().length) && ((0 == $("#contact_2_name_id").val().length) || (0 == $("#contact_2_phone_id").val().length) )) ||
                        ((0 !== $("#contact_2_name_id").val().length) && ((0 == $("#contact_2_surname_id").val().length) || (0 == $("#contact_2_phone_id").val().length) )) ||
                        ((0 !== $("#contact_2_phone_id").val().length) && ((0 == $("#contact_2_surname_id").val().length) ||(0 == $("#contact_2_name_id").val().length) ))
                    ) ||
                    (
                        ((0 !== $("#contact_3_surname_id").val().length) && ((0 == $("#contact_3_name_id").val().length) || (0 == $("#contact_3_phone_id").val().length) )) ||
                        ((0 !== $("#contact_3_name_id").val().length) && ((0 == $("#contact_3_surname_id").val().length) || (0 == $("#contact_3_phone_id").val().length) )) ||
                        ((0 !== $("#contact_3_phone_id").val().length) && ((0 == $("#contact_3_surname_id").val().length) ||(0 == $("#contact_3_name_id").val().length) ))
                    ) ||
                    (
                        ((0 !== $("#contact_4_surname_id").val().length) && ((0 == $("#contact_4_name_id").val().length) || (0 == $("#contact_4_phone_id").val().length) )) ||
                        ((0 !== $("#contact_4_name_id").val().length) && ((0 == $("#contact_4_surname_id").val().length) || (0 == $("#contact_4_phone_id").val().length) )) ||
                        ((0 !== $("#contact_4_phone_id").val().length) && ((0 == $("#contact_4_surname_id").val().length) ||(0 == $("#contact_4_name_id").val().length) ))
                    ) ||
                    (
                        ((0 !== $("#contact_5_surname_id").val().length) && ((0 == $("#contact_5_name_id").val().length) || (0 == $("#contact_5_phone_id").val().length) )) ||
                        ((0 !== $("#contact_5_name_id").val().length) && ((0 == $("#contact_5_surname_id").val().length) || (0 == $("#contact_5_phone_id").val().length) )) ||
                        ((0 !== $("#contact_5_phone_id").val().length) && ((0 == $("#contact_5_surname_id").val().length) ||(0 == $("#contact_5_name_id").val().length) ))
                    )
                ) {
                    deactivateFinishBtn()
                } else {
                    activateFinishBtn()
                }
            });
        });
    </script>
{% endput %}