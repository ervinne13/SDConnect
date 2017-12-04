
class TaskItemListView {

    constructor() {
        this.elContainer = null;
        this.taskItemMap = {};
        this.lastTaskId = 0;
        this.lastOrder = 0;

        this._taskItemListItemTemplate = _.template(document.querySelector('#task-item-list-item-template').innerHTML);
    }

    bindElementAsContainer(elSelector) {
        this.elContainer = document.querySelector(elSelector);        
        this.initEvents();
    }

    initEvents() {

    }

    addBlankTaskItem() {
        let latestId = this.lastTaskId + 1;

        let taskItem = {
            id: latestId,
            type_code: 'MC',
            points: 1,
            task_item_text: '',
            choices_json: [],
            correct_answer_free_field: ''
        };

        this.addTaskItem(taskItem);

        return taskItem;
    }

    addTaskItem(taskItem) {
        //  use map for linear lookup
        this.taskItemMap[taskItem.id] = taskItem;
        this.taskItemMap[taskItem.id].order = ++this.lastOrder;

        this.lastTaskId++;        

        this.elContainer.innerHTML += this._taskItemListItemTemplate(taskItem);
    }

    getTaskItemById(taskId) {
        return this.taskItemMap[taskId];
    }

    updateListWithMap(taskItemMap) {
        console.log(taskItemMap);
    }

    saveTaskItem(taskItem) {
        this.taskItemMap[taskItem.id] = taskItem;

        console.log(this.taskItemMap);
    }

}