title = "Editează profil profesor"
url = "/specialist/profile-edit"
layout = "web-app"
description = "Profile page"
is_hidden = 0

[session]
security = "user"
allowedUserGroups[] = "registered"
allowedUserTypes[] = "specialist"

[addresses]
counties = 1

[profileStaticData]
schools = 1

[specialist]

[account]
==
<div class="container-fluid px-lg-4 mb-5">
    <div class="row">

        <!-- Back link -->
        <div class="col-12 my-3">
            <div class="d-flex align-items-center justify-content-end">
                <div class="d-none">
                    <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/arrow-black.svg'|theme }}">
                    <a class="ml-3 text-black" href="{{ 'spacialist/dashboard'|page }}">{{'page.specialist.dashboard.profile.back.link.text'|_}}</a>
                </div>
                <div>
                    <a role="button" data-toggle="modal" data-target="#changePasswodTeacherModal" class="btn btn-sm btn-secondary d-flex align-items-center justify-content-around py-1 px-2" style="width:140px;">
                        <i class="fas fa-lock"></i>
                        {{'page.specialist.dashboard.edit.profile.change.password.btn'|_}}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="shadow-lg rounded bg-white  p-3 p-md-5">

                        <!-- Teacher avatar -->
                        <form method="POST" data-request="onAvatarUpdate" data-request-validate data-request-flash data-request-files>
                            <div class="row">
                                <div class="col-12">
                                    <p class="display-2 text-medium-dark form-styles p-0 m-0 mb-3">{{'page.specialist.dashboard.profile.avatar.text'|_}}</p>
                                    <div class="d-flex align-items-center mt-3 mb-4">
                                        <button role="button" type="submit" class="btn btn-sm btn-secondary d-flex align-items-center justify-content-around py-1 px-2" style="width:140px;">
                                            <i class="fas fa-user"></i>
                                            {{'page.specialist.dashboard.edit.profile.btn.text'|_}}
                                        </button>
                                        {% if user.avatar %}
                                            <img id="add-avatar" class="img-fluid img-avatar rounded-circle add-custom-avatar ml-3" src="{{user.avatar.getThumb(80,80, { mode : 'crop' } )}}" alt="avatar" style="cursor: pointer;">
                                        {% else %}
                                            <div class="add-avatar">
                                                <img id="add-avatar" class="img-fluid add-custom-avatar ml-3" src="{{ 'assets/img/svg/dashboard/add-student-gray.svg'|theme }}" style="cursor: pointer;">
                                            </div>
                                        {% endif %}

                                        <!-- Input for adding custom avatar -->
                                        <input name="avatar" id="avatar" class="d-none custom-avatar onChangeValue" onchange="previewFile(this)" accept="image/*" type="file"/>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Edit profile form -->
                        <form id="form" method="POST" data-request='onSpecialistProfileUpdate'>
                            <div class="shadow rounded p-3 py-4">
                                <p class="display-2 text-medium-dark form-styles p-0 m-0 mb-3">{{'page.specialist.dashboard.edit.profile.title'|_}}</p>
                                <div class="row">

                                    <!-- Last name input -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="surname" class="form-control" id="surname" aria-describedby="surnameHelp" placeholder="{{'page.specialist.dashboard.input.last.name.placeholder'|_}}" style="font-style: italic;" value="{{ user.surname }}">
                                        </div>
                                    </div>

                                    <!-- First name input -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="{{'page.specialist.dashboard.input.first.name.placeholder'|_}}" style="font-style: italic;" value="{{ user.name }}">
                                        </div>
                                    </div>

                                    <!-- Phone number input -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <input type="number" name="phone" class="form-control" id="phone" aria-describedby="phoneHelp" placeholder="{{'page.specialist.dashboard.input.phone.placeholder'|_}}" style="font-style: italic;" value="{{ user.profile.phone }}">
                                        </div>
                                    </div>

                                    <!-- Email input -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="{{'page.specialist.dashboard.input.email.placeholder'|_}}" style="font-style: italic;" value="{{ user.email }}">
                                        </div>
                                    </div>

                                    <!-- County select -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group register-select">
                                            <select name="county" id="specialistCounty" class="form-control border outline-none selectpicker" data-live-search="true" data-none-results-text="{{'page.specialist.dashboard.edit.select.noresult'|_}}" data-style="btn-white">
                                                {% for key, county in counties %}
                                                    <option value="{{ key }}" {% if key == user.profile.county_id %} selected {% endif %}>{{ county }}</option>
                                                {% endfor %}
                                            </select>
                                        </div>
                                    </div>

                                    <!-- City select -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group register-select">
                                            <select name="city" id="specialistCity" class="form-control border outline-none selectpicker" data-none-results-text="{{'page.specialist.dashboard.edit.select.noresult'|_}}" data-live-search="true" data-style="btn-white" disabled></select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Description input -->
                            <div class="shadow rounded p-3 py-4 mt-5">
                                <p class="display-2 text-medium-dark form-styles pl-lg-3">{{'page.specialist.dashboard.form.title_2'|_}}</p>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="description" id="description" rows="5">
                                            {{ user.profile.description|raw }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="col-12 mt-5 mb-5 mb-lg-0">
                                <div class="d-flex justify-content-end">
                                    <button role="button" type="submit" class="btn btn-sm btn-secondary px-5">{{'page.specialist.dashboard.edit.profile.save.btn'|_}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{% partial 'web-app/general/password-change' %}

<script type="text/javascript" src="{{ ['assets/js/file-preview.js']|theme }}"></script>

{% put scripts %}
    <script type="text/javascript">
        $(document).ready(function () {

            /** WYSWYG Editor. */
            $('#description').richText();

            /** Add file input functionlity for plus-icon img. */
            $(".add-custom-avatar").click(function () {
                $(".custom-avatar").trigger('click');
            });

            /**
             * Extracts the initial cities.
             */
            $.request('onGetCities', {
                data: {
                    countyId: {{ user.profile.county_id }}
                },
                success: function(data) {
                    /* Reset the city select content. */
                    $('#specialistCity').html('');

                    /* Parse all received citied and add them. */
                    for (const city in data) {
                        if( data[city] == {{ user.profile.city_id }} ) {
                            $('#specialistCity').append(`<option value="${data[city]}" selected>${city}</option>`);
                        } else {
                            $('#specialistCity').append(`<option value="${data[city]}">${city}</option>`);
                        }

                    }

                    /* Activate the select. */
                    $('#specialistCity').prop("disabled", false);
                    $("#specialistCity").selectpicker("refresh");
                }
            });

            /**
             * Function that extracts the cities of a county.
             */
            $('#specialistCounty').on('change', function() {
                $.request('onGetCities', {
                    data: {
                        countyId: this.value
                    },
                    success: function(data) {
                        /* Reset the city select content. */
                        $('#specialistCity').html('');

                        /* Parse all received citied and add them. */
                        for (const city in data) {
                            if( data[city] == {{ user.profile.city_id }} ) {
                                $('#specialistCity').append(`<option value="${data[city]}" selected>${city}</option>`);
                            } else {
                                $('#specialistCity').append(`<option value="${data[city]}">${city}</option>`);
                            }
                        }

                        /* Activate the select. */
                        $('#specialistCity').prop("disabled", false);
                        $("#specialistCity").selectpicker("refresh");
                    }
                })
            });
        });
    </script>
{% endput %}
