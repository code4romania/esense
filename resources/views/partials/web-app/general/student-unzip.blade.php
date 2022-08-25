description = "Partial for confirming a student dearchivation."

[viewBag]
==
<!-- Modal -->
<form>
    <div class="modal fade" id="unzipStudentModal" tabindex="-1" role="dialog" aria-labelledby="unzipStudentModal" aria-hidden="true">
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

                    <p class="text-center my-3 displa-1 text-dark">{{'partial.general.unzip.student.title'|_}}</p>

                    <div class="d-flex align-items-center justify-content-center mt-5 mb-3">
                        <a role="button" class="mr-3 text-gray-2 display-4" data-dismiss="modal">{{'partial.general.unzip.student.cancel'|_}}</a>

                        <a role="button" data-dismiss="modal" href="" id="unzipStudentSubmit" class="btn btn-sm px-5 btn-secondary">
                            {{'partial.general.unzip.student.archive'|_}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    /** Populate the modal after opening. */
    $('#unzipStudentModal').on('show.bs.modal', function (event) {
        /** Update the student name. */
        $(this).find('#studentName').text($(event.relatedTarget).data('name'));

        /** Update the student avatar. */
        $(this).find('#studentAvatar').attr("src", $(event.relatedTarget).data('avatar'));

        /** Save the student ID. */
        $(this).find('#unzipStudentSubmit').data('id', $(event.relatedTarget).data('id'));
    });

    /** Submit unzip request for student. */
    $("#unzipStudentSubmit").on('click', function () {
        /** Extract data from input. */
        var $id = $('#unzipStudentSubmit').data('id');

        /** Send the student unzip request. */
        $.request(
            'onStudentUnzip', {
                data: {
                    id: $id,
                },
            }
        );
    });
</script>
