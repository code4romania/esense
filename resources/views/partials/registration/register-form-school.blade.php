description = "Register form for school"

[viewBag]
==
<section class="my-5">
    <div class="container">
        <!-- Register form -->
        <form method="POST" data-request="onRegister" data-request-success="$('#schoolForm').addClass('d-none'); $('#successMessage').removeClass('d-none');">
            <div class="row">
                <div class="col-12">
                    <div class="shadow-lg rounded bg-white p-0 p-md-5">
                        <div class="shadow rounded p-3 py-4">
                            <p class="display-2 text-medium-dark p-0 m-0 mb-3 form-styles">{{'partial.register.school.form.title'|_}}</p>

                            <div class="row">
                                <!-- Last name input -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" name="school_name" class="form-control" id="school_name" aria-describedby="school_nameHelp" placeholder="{{'partial.register.school.form.name.placeholder'|_}}" style="font-style:italic;">
                                    </div>
                                </div>

                                <!-- County select -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group register-select">
                                        <select name="county" id="schoolCounty" class="form-control border outline-none selectpicker" data-live-search="true" data-none-results-text="{{'partial.register.school.form.county.no_option'|_}}" data-style="btn-white">
                                            {% for key, county in counties %}
                                            <option value="{{ key }}">{{ county }}</option>
                                            {% endfor %}
                                        </select>
                                    </div>
                                </div>

                                <!-- City select -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group register-select">
                                        <select name="city" id="schoolCity" class="form-control border outline-none selectpicker" data-none-results-text="{{'partial.register.school.form.city.no_option'|_}}" data-live-search="true" data-style="btn-white" disabled></select>
                                    </div>
                                </div>

                                <!-- Contact person last name input -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="surname" class="form-control" id="surname" aria-describedby="surnameHelp" placeholder="{{'partial.register.school.form.contact.surname.placeholder'|_}}" style="font-style: italic;">
                                    </div>
                                </div>

                                <!-- Contact person first name input -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="{{'partial.register.school.form.contact.name.placeholder'|_}}" style="font-style: italic;">
                                    </div>
                                </div>

                                <!-- Contact person phone number input -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="number" name="phone" class="form-control" id="phone" aria-describedby="phoneHelp" placeholder="{{'partial.register.school.form.contact.phone.placeholder'|_}}" style="font-style: italic;">
                                    </div>
                                </div>

                                <!-- Contact person email input -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="{{'partial.register.school.form.contact.email.placeholder'|_}}" style="font-style: italic;">
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="{{'partial.register.school.form.contact.password.placeholder'|_}}" style="font-style: italic;">
                                    </div>
                                </div>

                                <!-- Password confirmation -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" aria-describedby="passwordConfirmationHelp" placeholder="{{'partial.register.school.form.contact.password.confirmation.placeholder'|_}}" style="font-style: italic;">
                                    </div>
                                </div>

                                <input name="type" type="text" id="type" class="d-none" value="school">
                            </div>
                        </div>

                        <!-- Description input -->
                        <div class="shadow rounded p-3 py-4 mt-5">
                            <p class="display-2 text-medium-dark form-styles pl-3">{{'partial.register.school.form.description.label'|_}}</p>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Submit button -->
                <div class="col-12 mt-5 mb-5 mb-lg-0">
                    <div class="d-flex justify-content-end">
                        <button role="button" type="submit" class="btn btn-sm btn-primary px-5">{{'partial.register.school.form.submit.button'|_}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

{% put scripts %}
<script type="text/javascript">
    $(document).ready(function () {
        /**
         * Extracts the initial cities.
         */
        $.request('onGetCities', {
            data: {
                countyId: 1
            },
            success: function(data) {
                /* Reset the city select content. */
                $('#schoolCity').html('');

                /* Parse all received citied and add them. */
                for (const city in data) {
                    $('#schoolCity').append(`<option value="${data[city]}">${city}</option>`);
                }

                /* Activate the select. */
                $('#schoolCity').prop("disabled", false);
                $("#schoolCity").selectpicker("refresh");
            }
        });

        /**
         * Function that extracts the cities of a county.
         */
        $('#schoolCounty').on('change', function() {
            $.request('onGetCities', {
                data: {
                    countyId: this.value
                },
                success: function(data) {
                    /* Reset the city select content. */
                    $('#schoolCity').html('');

                    /* Parse all received citied and add them. */
                    for (const city in data) {
                        $('#schoolCity').append(`<option value="${data[city]}">${city}</option>`);
                    }

                    /* Activate the select. */
                    $('#schoolCity').prop("disabled", false);
                    $("#schoolCity").selectpicker("refresh");
                }
            });
        });
    });
</script>
{% endput %}
