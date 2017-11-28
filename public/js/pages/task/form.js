(function () {

    let taskListView;

    $(document).ready(function () {

        taskListView = new TaskListView();
        taskListView.bindElementAsContainer('#task-item-editor-container');

        initializeEvents();

    });

    function initializeEvents() {
        $('#action-add-task-item').click(addTaskItem);
    }

    function addTaskItem() {
        taskListView.addBlankTask();
        taskListView.displayLatest();
    }

})();