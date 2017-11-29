(function () {

    let taskItemEditor, taskItemListView;

    $(document).ready(function () {

        taskItemListView = new TaskItemListView();
        taskItemListView.bindElementAsContainer('#task-item-list-container');

        taskItemEditor = new TaskItemEditorView();
        taskItemEditor.bindElementAsContainer('#task-item-editor-container');

        initializeEvents();

    });

    function initializeEvents() {
        $('#action-add-task-item').click(addTaskItem);
    }

    function addTaskItem() {
        taskItemEditor.addBlankTaskItem();
        taskItemEditor.displayLatestTaskItem();
    }

})();