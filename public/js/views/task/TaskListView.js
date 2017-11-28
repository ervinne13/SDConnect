class TaskListView {

    constructor() {
        this.elContainer = null;
        this.currentlyActiveTaskItem = null;
        this.taskItems = [];

    }

    displayTask(taskView) {

    }

    bindElementAsContainer(elSelector) {
        this.elContainer = document.querySelector(elSelector);
    }

    addTaskItem(taskItem, isActive) {
        if (isActive === true) {
            this.currentlyActiveTaskItem = taskItem;
        }



        this.taskItems.push(taskItem);
    }
}