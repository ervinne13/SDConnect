
/* global swal, app, task */

(function () {

    "use strict";

    $(document).ready(function () {
        if (task.student_number) {
            swal('Restricted', 'You already answered this task. You may not edit this anymore', 'error');
            redirect();
        } else {
            confirmTaskOpen();
        }
    });

    function confirmTaskOpen() {
        swal({
            title: "Task Completion Confirmation",
            text: "Once you open this task, you will not be able to open it again and edit it! You must be sure that you have stable connection and the time to complete the task",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, proceed to the task",
            cancelButtonText: "No, I'll do the task later!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (willAnswer) {
            if (willAnswer) {
                swal('Good luck', 'Be sure to click "Submit my answers" after answering otherwise your answers wont be saved', 'success');
                $('#task-form').show();

                lockTask();
            } else {
                swal("Cancelled", "You will be redirected shortly", "success");
                redirect();
            }
        });
    }

    function redirect() {
        setTimeout(function () {
            window.location.href = app.baseUrl + '/task';
        }, 2000);
    }

    function lockTask() {
        let url = app.baseUrl + '/task/' + task.id + '/submit-answers';
        let data = {
            _token: app.csrf
        };
        $.post(url, data)
                .done(response => {
                    console.log(response);
                });
    }

})();