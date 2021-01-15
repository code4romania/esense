/** Function that show a preview of uploaded student avatar */
function previewFile(input){
    let file = $('input[type=file]').get(0).files[0];

    if (file) {
        let reader = new FileReader();
        reader.onload = function() {
            $('#add-avatar').attr('width', 70).attr('src', reader.result);
            $('#add-avatar2').attr('width', 70).attr('src', reader.result);
        }
        reader.readAsDataURL(file);
    }
}
