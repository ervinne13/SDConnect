(function () {

    let taskItemEditor, taskItemListView;

    $(document).ready(function () {

        taskItemListView = new TaskItemListView();
        taskItemListView.bindElementAsContainer('#task-item-list-container');

        taskItemEditor = new TaskItemEditorView();
        taskItemEditor.bindElementAsContainer('#task-item-editor-container');

        initInterComponentEvents();
        initEvents();

    });

    function initInterComponentEvents() {

        taskItemListView.onTaskItemListItemClicked(function (taskItem) {
            console.log(taskItem);
            taskItemEditor.displayTaskItem(taskItem);
        });

        taskItemEditor.onTaskItemSaveCommand(function (taskItem) {
            taskItemListView.saveTaskItem(taskItem);
        });

        taskItemEditor.onTaskItemSaveAndNewCommand(function (taskItem) {
            console.log('save new ', taskItem);
            taskItemListView.saveTaskItem(taskItem);
            addTaskItem();
        });

        taskItemEditor.onTaskItemDeleteCommand(function (taskItem) {
            taskItemListView.deleteTaskItem(taskItem);
            let remainingTaskItems = taskItemListView.getTaskItemsByOrder();

            if (remainingTaskItems.length > 0) {
                let lastTaskItem = remainingTaskItems[remainingTaskItems.length - 1];
                taskItemEditor.displayTaskItem(lastTaskItem);
            } else {
                $('#task-item-editor-container').html('No task items left.');
            }
        });
    }

    function initEvents() {
        $(document).on('click', '#action-add-task-item', function () {
            addTaskItem();
        });
    }

    function addTaskItem() {

        if (taskItemListView.isEmpty()) {
            moveAddTaskItemAction(2);
        }

        let taskItem = taskItemListView.addBlankTaskItem();
        taskItemEditor.displayTaskItem(taskItem);
    }

    function moveAddTaskItemAction(containerNumber) {

        let text = containerNumber === 1 ? 'Add a new Task Item Now' : "Add";

        $('#action-add-task-item span').text(text);

        $('#action-add-task-item').appendTo(`#add-task-item-container-${containerNumber}`);
    }

})();