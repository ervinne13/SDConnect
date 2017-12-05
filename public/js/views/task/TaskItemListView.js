
class TaskItemListView {

    constructor() {
        this.elContainer = null;
        this.taskItemMap = {};
        this.lastTaskId = 0;
        this.lastOrder = 0;

        this.taskItemsByOrder = [];

        this._taskItemListItemTemplate = _.template(document.querySelector('#task-item-list-item-template').innerHTML);

        this.onTaskItemListItemClickedCallback = null;
    }

    bindElementAsContainer(elSelector) {
        this.elContainer = $(elSelector);
        this.initEvents();
    }

    initEvents() {
        let self = this;
        $(document).on('click', '.task-item-list-item', function () {
            let id = $(this).data('id');
            let taskItem = self.taskItemMap[id];
            
            if (self.onTaskItemListItemClickedCallback) {
                self.onTaskItemListItemClickedCallback(taskItem);
            } else {
                console.warn('TaskItemListView', 'onTaskItemListItemClicked is triggered but no handler is specified');
            }
        });
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

        this.taskItemsByOrder.push(taskItem);

        this.lastTaskId++;

        this.elContainer.append(this._taskItemListItemTemplate(taskItem));
        console.log(taskItem);
    }

    getTaskItemById(taskId) {
        return this.taskItemMap[taskId];
    }

    getTaskItemsByOrder() {
        return this.taskItemsByOrder;
    }

    updateListWithMap(taskItemMap) {
        console.log(taskItemMap);
    }

    saveTaskItem(taskItem) {
        this.taskItemMap[taskItem.id] = taskItem;

        console.log(this.taskItemMap);
    }

    deleteTaskItem(taskItem) {
        $(`.task-item-list-item[data-id=${taskItem.id}]`).remove();
        delete this.taskItemMap[taskItem.id];

        for (let i = 0; i < this.taskItemsByOrder.length; i++) {
            if (this.taskItemsByOrder[i].id == taskItem.id) {
                delete this.taskItemsByOrder[i];
            }
        }

    }

    isEmpty() {
        return vanilla.isObjectEmpty(this.taskItemMap);
    }

    onTaskItemListItemClicked(callback) {       
        this.onTaskItemListItemClickedCallback = callback;
    }

}