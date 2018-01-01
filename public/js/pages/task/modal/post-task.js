
let PostTaskModal = (function() {

    "use strict";

    function show(task) {
        $('#post-task-modal').modal('show');
        loadTasks(task);  
        initEvents();

        var elems = Array.prototype.slice.call(document.querySelectorAll('#show-in-calendar'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
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

    function savePost() {
        //  TODO: Validate post
        getSavePostRequest()
            .done(response => {
                console.log(response);
                swal('Success', 'Task Posted', 'success');

                setTimeout(function() {
                    window.location.href = baseUrl + '/group/' + group.code;
                });
            }).fail(xhr => {
                console.error(xhr);
                swal('Error', xhr.responseText, 'error');
            }).always(() => {
                showLoading(false);
            });

        showLoading();
    }

    function initEvents() {        
        $('#action-post').click(savePost);
    }

    function getTasksRequest() {
        let url = baseUrl + '/task/json';
        return $.get(url);
    }

    function getSavePostRequest() {
        let url = baseUrl + '/post';
        let post = getPostFromFields();

        return $.post(url, post);
    }

    function getPostFromFields() {
        let relativeUrl = baseUrl + '/task/' + $('#task-post-form [name=task_id]').val();

        return {
            group: group,
            module: 'Task',
            relativeUrl: relativeUrl,
            includeInCalendar: $('#show-in-calendar').is(":checked"),
            content: $('#new-post-textarea').val(),
            dateTimeTo: $('[name=date_time_to]').val()
        };
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