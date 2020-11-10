description = "Partial for confirming a specialist deletion."

[viewBag]
==
<!-- Modal -->
<form>
    <div class="modal fade" id="deleteTeacherModal" tabindex="-1" role="dialog" aria-labelledby="deleteTeacherModal" aria-hidden="true">
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
                    <p class="text-center my-3 displa-1 text-dark">{{'partial.profile.delete.teacher.title'|_}}</p>
                    <div class="d-flex align-items-center justify-content-center mt-5 mb-3">
                        <a role="button" class="mr-3 text-gray-2 display-4" data-dismiss="modal">{{'partial.profile.delete.teacher.cancel'|_}}</a>
                        <button id="deleteSpecialistSubmit" type="submit" class="btn btn-sm px-5 btn-secondary">{{'partial.profile.delete.teacher.delete'|_}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    /** Populate the modal after opening. */
    $('#deleteTeacherModal').on('show.bs.modal', function (event) {
        /** Update the specialist name. */
        $(this).find('#specialistName').text($(event.relatedTarget).data('name'));

        /** Update the specialist avatar. */
        $(this).find('#specialistAvatar').attr("src", $(event.relatedTarget).data('avatar'));

        /** Save the specialist ID. */
        $(this).find('#deleteSpecialistSubmit').data('id', $(event.relatedTarget).data('id'));
    });

    /** Submit unzip request for specialist. */
    $("#deleteSpecialistSubmit").on('click', function () {
        /** Extract data from input. */
        var $id = $('#deleteSpecialistSubmit').data('id');

        /** Send the specialist unzip request. */
        $.request(
            'onSpecialistDelete', {
                data: {
                    id: $id,
                },
            }
        );
    });
</script>