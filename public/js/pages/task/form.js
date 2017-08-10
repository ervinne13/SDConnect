(function () {

    $(document).ready(function () {

        initializeEvents();

    });

    function initializeEvents() {
        $('#action-add-task-item').click(addTaskItem);
    }

    function addTaskItem() {

        $('#task-item-editor-container').html('');

    }

})();