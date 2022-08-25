description = "Partial for confirming a specialist archivation."

[viewBag]
==
<!-- Modal -->
<form>
    <div class="modal fade" id="arhiveTeacherModal" tabindex="-1" role="dialog" aria-labelledby="arhiveTeacherModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 0; top:0;">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid img-avatar rounded-circle" width="40" height="40" id="specialistAvatar" alt="avatar"/>
                        <p id="specialistName" class="p-0 m-0 display-4 text-dark ml-2"></p>
                    </div>

                    <p class="text-center my-3 displa-1 text-dark">{{'partial.school.specialist.archive.question'|_}}</p>

                    <div class="d-flex align-items-center justify-content-center mt-5 mb-3">
                        <a role="button" class="mr-3 text-gray-2 display-4" data-dismiss="modal">{{'partial.school.specialist.archive.button.cancel'|_}}</a>

                        <a role="button" data-dismiss="modal" href="" id="specialistArchiveSubmit" class="btn btn-sm px-5 btn-secondary">
                            {{'partial.school.specialist.archive.button.archive'|_}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    /** Populate the modal after opening. */
    $('#arhiveTeacherModal').on('show.bs.modal', function (event) {
        /** Update the specialist name. */
        $(this).find('#specialistName').text($(event.relatedTarget).data('name'));

        /** Update the specialist avatar. */
        $(this).find('#specialistAvatar').attr("src", $(event.relatedTarget).data('avatar'));

        /** Save the specialist ID. */
        $(this).find('#specialistArchiveSubmit').data('id', $(event.relatedTarget).data('id'));
    });

    /** Submit archive request for specialist. */
    $("#specialistArchiveSubmit").on('click', function () {
        /** Extract data from input. */
        var $id = $('#specialistArchiveSubmit').data('id');

        /** Send the specialist archive request. */
        $.request(
            'onSpecialistArchive', {
                data: {
                    id: $id,
                },
            }
        );
    });
</script>
