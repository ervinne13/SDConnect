class TaskListView {

    constructor() {
        this.elContainer = null;
        this.currentlyActiveTaskItem = null;
        this.taskItems = [];

    }

    addBlankTask() {
        //  TODO
        this.taskItems.push(new TaskView());
    }

    displayLatest() {
        let taskView = this.taskItems[this.taskItems.length - 1];        
        this.elContainer.innerHTML = taskView.createView();
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