
let PostTaskModal = (function() {

    "use strict";

    function show(task) {
        $('#post-task-modal').modal('show');
        loadTasks(task);        
    }

    function loadTasks(task) {
        getTasksRequest()
            .done(tasks => {
                console.log(tasks);
                displayTasks(tasks);

                if (task && task.id) {            
                    $('#post-task-modal [name=task_id]').val(task.id);
                }
            })
            .fail(xhr => {
                console.error(xhr);
                swal('Error', xhr.responseText, 'error');
            });

        //  clear so user can't select until tasks are loaded
        $('#post-task-modal [name=task_id]').html('');
    }

    function getTasksRequest() {
        let url = baseUrl + '/task/json';
        return $.get(url);
    }

    function displayTasks(tasks) {        
        $('#post-task-modal [name=task_id]').html('');

        tasks.forEach(task => {
            let taskOption = $('<option/>', {
                'value': task.id,
                'text': task.display_name
            });

            $('#post-task-modal [name=task_id]').append(taskOption);
        });

    }

    return {        
        show
    }

})();