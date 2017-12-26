
/* global form_utilities, baseUrl, group, app */

(function () {

    $(document).ready(function () {
        initializeComponents();
        initializeForm();      

        updateBackgroundColor(group.color);

    });

    function initializeComponents() {
        $('.colorpicker-component').colorpicker().on('changeColor', e => {
            updateBackgroundColor(e.color.toString('rgba'));
        });
    }

    function initializeForm() {
        form_utilities.moduleUrl = baseUrl + "/group";
        form_utilities.updateObjectId = group.code;
        form_utilities.validate = true;
        form_utilities.initializeDefaultProcessing($('.fields-container'));
    }

    function updateBackgroundColor(color) {
        $('body div.content')[0].style.backgroundColor = color;
    }

})();
