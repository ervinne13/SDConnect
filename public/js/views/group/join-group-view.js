
/* global rainbow */

(function () {

    $(document).ready(function () {
        initializeEvents();
    });

    function initializeEvents() {

        $('.action-trigger-join-group').click(function () {
            $('#join-group-modal').modal('show');
        });

        $('#action-join-group').click(function () {
            let group = $('#input-group-code').val();

            if (!group) {
                swal("Error", "Enter the group code to join", "error");
                return;
            }

            joinGroup(group);

        });

    }

    function joinGroup(group) {

        let url = app.baseUrl + "/group/" + group + "/join";
        let params = {};

        $.post(url, params).done(response => {
            console.log(response);
            swal("Success", "You joined the group.", "success");
            setTimeout(function () {
                window.location.reload();
            }, 2000);
        }).fail(xhr => {
            swal("Error", xhr.responseText, "error");
        }).always(() => {
            showLoading(false);
        });

        showLoading(true);
    }

    function showLoading(show) {
        let affectedElements = [
            $('#input-group-code'),
            $('#action-join-group')
        ];
        rainbow.showLoading(show, affectedElements);
    }

})();
