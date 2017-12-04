(function () {

    let taskItemEditor, taskItemListView;

    $(document).ready(function () {

        taskItemListView = new TaskItemListView();
        taskItemListView.bindElementAsContainer('#task-item-list-container');

        taskItemEditor = new TaskItemEditorView();
        taskItemEditor.bindElementAsContainer('#task-item-editor-container');

        //  inter-component bindings
        taskItemEditor.onTaskItemSaveCommand(function(taskItem) {
            taskItemListView.saveTaskItem(taskItem)
        });

        initializeEvents();

    });

    function initializeEvents() {
        $('#action-add-task-item').click(addTaskItem);
    }

    function addTaskItem() {
        let taskItem = taskItemListView.addBlankTaskItem();
        taskItemEditor.displayTaskItem(taskItem);
    }

})();