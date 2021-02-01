description = "Partial for add specialist form"

[viewBag]
==
<div class="row specialist-form {% if not display %} d-none {% else %} d-flex {% endif %}" id="specialist-{{index}}">

    <div class="col-12 d-flex align-items-baseline justify-content-between">
        <p class="text-muted mt-3 mb-3">{{'partial.school.add.specialist.title'|_}}&nbsp;{{index}}</p>

        <div id='delete-specialist-{{index}}' class="mr-2 {% if not displayDeleteButton %} d-none {% endif %}">
            <i class="fas fa-times-circle text-secondary display-1" style="cursor:pointer"></i>
        </div>
    </div>

    <div class="col-12 col-md-6 mb-3 input-type">
        <div class="form-group d-flex">
            <input name="specialist_{{index}}_surname" type="text" class="form-control onChangeValue" id="specialist_{{index}}_surname_id" placeholder="{{'partial.school.add.specialist.last.name'|_}}">
        </div>
    </div>

    <div class="col-12 col-md-6 mb-3 input-type">
        <div class="form-group d-flex">
            <input name="specialist_{{index}}_name" type="text" class="form-control onChangeValue" id="specialist_{{index}}_name_id" placeholder="{{'partial.school.add.specialist.first.name'|_}}">
        </div>
    </div>

    <div class="col-12 col-md-6 mb-3 input-type">
        <div class="form-group d-flex">
            <input name="specialist_{{index}}_phone" type="number" class="form-control onChangeValue" id="specialist_{{index}}_phone_id" placeholder="{{'partial.school.add.specialist.phone'|_}}">
        </div>
    </div>

    <div class="col-12 col-md-6 mb-3 input-type">
        <div class="form-group">
            <input name="specialist_{{index}}_email" type="email" class="form-control onChangeValue" id="specialist_{{index}}_email_id" placeholder="{{'partial.school.add.specialist.email'|_}}">
        </div>
    </div>

    <input name="specialist_{{index}}_type" type="text" class="d-none" id="specialist_{{index}}_type_id" value="specialist">

    <div class="col-12 my-3 {% if hideAddPerson %} d-none {% endif %}" id="hide-{{index}}">
        <div class="d-flex align-items-center justify-content-center">
            <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/add-gray.svg'|theme }}">
            <span class="ml-2 display-4 text-secondary2">{{'partial.school.add.specialist.link'|_}}</span>
        </div>
    </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {

    /** Function that show/hide specialists delete button. */
    function checkIfHideDeleteButton() {
        if($('.specialist-form.d-flex').length > 1) {
            $('.specialist-form.d-flex > div:first-child > div').removeClass('d-none');
        } else {
            $('.specialist-form.d-flex > div:first-child > div').addClass('d-none');
        }
    }

    /** Display button to add another specialists. */
    $('#hide-{{index}}').on('click', function() {
        $('#specialist-{{index + 1}}').removeClass('d-none').addClass('d-flex');
        $(this).addClass('d-none');

        /** Call to function that show/hide specialists delete button. */
        checkIfHideDeleteButton();
    });

    /** Delete specialists form. */
    $("#delete-specialist-{{index}}").click(function() {
        {% for i in index..5 %}
            {% if 5 == i %}
                $('#specialist_{{i}}_surname_id').val('');
                $('#specialist_{{i}}_name_id').val('');
                $('#specialist_{{i}}_email_id').val('');
                $('#specialist_{{i}}_phone_id').val('');
            {% else %}
                $('#specialist_{{i}}_surname_id').val($('#specialist_{{i + 1}}_surname_id').val());
                $('#specialist_{{i}}_name_id').val($('#specialist_{{i + 1}}_name_id').val());
                $('#specialist_{{i}}_email_id').val($('#specialist_{{i + 1}}_email_id').val());
                $('#specialist_{{i}}_phone_id').val($('#specialist_{{i + 1}}_phone_id').val());
            {% endif %}
        {% endfor %}

        /** Hide the last visible form. */
        $('#add_specialists_wrapper').each(function(){
            /** Hide the last specialist that has the 'd-flex' class. */
            $(this).find('.specialist-form.d-flex').last().removeClass('d-flex').addClass('d-none');
            /** Display the last new specialist button. */
            $('.specialist-form.d-flex > div').last().removeClass('d-none');

            /** Check if last input has value if it has trigger keyup to activate button. */
            if(0 !== $(this).find('.specialist-form.d-flex .input-type input').last().val().length) {
                $(this).find('.specialist-form.d-flex .input-type input').last().trigger('keyup');
            }
        });

        /** Call to function that show/hide specialists delete button. */
        checkIfHideDeleteButton();
    });
});
</script>
