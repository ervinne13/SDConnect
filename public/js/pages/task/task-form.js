(function () {

    let taskItemEditor, taskItemListView;

    $(document).ready(function () {

        taskItemListView = new TaskItemListView();
        taskItemListView.bindElementAsContainer('#task-item-list-container');

        taskItemEditor = new TaskItemEditorView();
        taskItemEditor.bindElementAsContainer('#task-item-editor-container');

        //  inter-component bindings
        taskItemEditor.onTaskItemMapUpdated(taskItemListView.updateListWithMap);

        initializeEvents();

    });

    function initializeEvents() {
        $('#action-add-task-item').click(addTaskItem);
    }

    function addTaskItem() {       
        taskItemEditor.displayTaskItem(taskItemEditor.addBlankTaskItem());
    }

})();