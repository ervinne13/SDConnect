(function () {

    let taskListView;

    $(document).ready(function () {

        taskListView = new TaskItemListView();
        taskListView.bindElementAsContainer('#task-item-editor-container');

        initializeEvents();

    });

    function initializeEvents() {
        $('#action-add-task-item').click(addTaskItem);
    }

    function addTaskItem() {
        taskListView.addBlankTaskItem();
        taskListView.displayLatestTaskItem();
    }

})();