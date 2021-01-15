/*****************************************************
 ********** jQuery selectors for static pages ********
 ****************************************************/

/** jQuery selector for removing 'add' and 'delete' buttons, 'checkboxes' and 'Add subpage' in Rainlab\Pages. */
$(document).ready(function () {
    $('.btn-group').parent('.toolbar-item').remove();
    $('.checkbox.nolabel').remove();
    $('.submenu').remove();
});

/** Maintain items as removed after form submit and ajax success. */
$(document).ajaxSuccess(function () {
    $('.checkbox.nolabel').remove();
    $('.submenu').remove();
});
