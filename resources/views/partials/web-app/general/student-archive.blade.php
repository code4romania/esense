description = "Partial pentru a arhiva un elev"

[viewBag]
==
<!-- Modal -->
<form>
    <div class="modal fade" id="archiveStudentModal" tabindex="-1" role="dialog" aria-labelledby="archiveStudentModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 0; top:0;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid img-avatar rounded-circle" width="40" height="40" id="studentAvatar" alt="avatar"/>
                        <p id="studentName" class="p-0 m-0 display-4 text-dark ml-2"></p>
                    </div>
                    <p class="text-center my-3 displa-1 text-dark">{{'partial.general.archive.student.title'|_}}</p>
                    <div class="d-flex align-items-center justify-content-center mt-5 mb-3">
                        <a role="button" class="mr-3 text-gray-2 display-4" data-dismiss="modal">{{'partial.general.archive.student.cancel'|_}}</a>
                        <button id="studentArchiveSubmit" type="submit" class="btn btn-sm px-5 btn-secondary">{{'partial.general.archive.student.archive'|_}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    /** Populate the modal after opening. */
    $('#archiveStudentModal').on('show.bs.modal', function (event) {
        /** Update the student name. */
        $(this).find('#studentName').text($(event.relatedTarget).data('name'));

        /** Update the student avatar. */
        $(this).find('#studentAvatar').attr("src", $(event.relatedTarget).data('avatar'));

        /** Save the student ID. */
        $(this).find('#studentArchiveSubmit').data('id', $(event.relatedTarget).data('id'));
    });

    /** Submit archive request for student. */
    $("#studentArchiveSubmit").on('click', function () {
        /** Extract data from input. */
        var $id = $('#studentArchiveSubmit').data('id');

        /** Send the student archive request. */
        $.request(
            'onStudentArchive', {
                data: {
                    id: $id,
                },
            }
        );
    });
</script>
