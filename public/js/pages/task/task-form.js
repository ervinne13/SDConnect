/* global toastr */

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
            taskItemEditor.displayTaskItem(taskItem);
        });

        taskItemEditor.onTaskItemSaveCommand(function (taskItem) {
            taskItemListView.saveTaskItem(taskItem);
            toastr.info('Task item saved locally, click "Save" to save all', 'Heads Up!');
        });

        taskItemEditor.onTaskItemSaveAndNewCommand(function (taskItem) {
            taskItemListView.saveTaskItem(taskItem);
            addTaskItem();
            toastr.info('Task item saved locally, click "Save" to save all', 'Heads Up!');
        });

        taskItemEditor.onTaskItemDeleteCommand(function (taskItemId) {
            taskItemListView.deleteTaskItem(taskItemId);
            let remainingTaskItems = taskItemListView.getTaskItemsByOrder();

            if (remainingTaskItems.length > 0) {
                $('#task-item-editor-container').html('Select a task item to display');
            } else {
                $('#task-item-editor-container').html('No task items left.');
            }
        });
    }

    function initEvents() {
        $(document).on('click', '#action-add-task-item', function () {
            addTaskItem();
        });

        $('#action-save-post').click(function () {
            getSaveTaskRequest()
                    .done(response => {
                        console.log(response);
                        swal('Success', 'Task Saved', 'success');
                    })
                    .fail(xhr => {
                        console.error(xhr);
                        swal('Error', xhr.responseText, 'error');
                    });
        });

    }

    function addTaskItem() {

        if (taskItemListView.isEmpty()) {
            moveAddTaskItemAction(2);
        }

        let taskItem = taskItemListView.addBlankTaskItem();
        taskItemListView.displayTaskItem(taskItem);
        taskItemEditor.displayTaskItem(taskItem);
    }

    function moveAddTaskItemAction(containerNumber) {

        let text = containerNumber === 1 ? 'Add a new Task Item Now' : "Add";

        $('#action-add-task-item span').text(text);

        $('#action-add-task-item').appendTo(`#add-task-item-container-${containerNumber}`);
    }

    function getTaskData() {
        return {
            task_items: taskItemListView.getTaskItemsByOrder(),
        };
    }

    function getSaveTaskRequest() {
        let url = app.baseUrl + '/task';
        let task = getTaskData();

        console.log(task);

        return $.post(url, task);
    }

    let dummyTasks = [
        {id: 1, type_code: "MC", points: 1, task_item_text: "Test MC 01", choices_json: ["1", "2"], correct_answer_free_field: "2"},
        {id: 2, type_code: "MC", points: 1, task_item_text: "Test MC 02", choices_json: ["5", "6", "7"], correct_answer_free_field: "6"},
        {id: 3, type_code: "TF", points: 1, task_item_text: "Test TF 01", choices_json: [], correct_answer_free_field: "true"},
        {id: 4, type_code: "TF", points: 1, task_item_text: "Test TF 02", choices_json: [], correct_answer_free_field: "false"},
    ];


})();