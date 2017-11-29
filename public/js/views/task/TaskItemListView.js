class TaskItemListView {

    constructor() {
        this.elContainer = null;
        this.currentlyActiveTaskItem = null;
        this.taskItems = [];

        this._taskItemViewTemplate = _.template(document.querySelector('#task-item-view-template').innerHTML);
        this._mcOptionTemplate = _.template(document.querySelector('#multiple-choice-option-template').innerHTML);
        
        this._specialFieldsTemplates = {
            MC: _.template(document.querySelector('#multiple-choice-task-special-fields-template').innerHTML),
            TF: _.template(document.querySelector('#true-or-false-task-special-fields-template').innerHTML),
        };
    }

    addBlankTask() {
        let latestTask = this.getLatestTask();
        let latestId = latestTask ? latestTask.id + 1 : 1;

        this.taskItems.push({
            id: latestId,
            type_code: 'MC',
            points: 1,
            task_item_text: '',
            correct_answer_free_field: '',
        });
    }

    getLatestTask() {
        return this.taskItems.length > 0 ? this.taskItems[this.taskItems.length - 1] : null;
    }

    displayLatest() {
        let task = this.getLatestTask();
        this.elContainer.innerHTML = this._taskItemViewTemplate(task);
        
        this.updatedSpecialFields();
    }

    bindElementAsContainer(elSelector) {
        this.elContainer = document.querySelector(elSelector);

        this.initEvents();
    }

    initEvents() {

        //  fall back to jQuery for complex event handling
        $(document).on('click', '#action-add-option', function () {
            this.addOption();
        }.bind(this));

        $(document).on('click', '.action-remove-mc-option', function () {
            $(this).closest('li.mc-option').remove();
        });

        $(document).on('change', '#input-type', function() {
            this.updatedSpecialFields();
        }.bind(this));

    }
    
    updatedSpecialFields() {
        let taskItemType = document.querySelector('#input-type').value;
        let container = document.querySelector('#special-fields-container');
        
        container.innerHTML = this._specialFieldsTemplates[taskItemType]();
    }

    addOption() {
        let choicesContainer = document.querySelector('ul#choices-container');
        choicesContainer.innerHTML += this._mcOptionTemplate();
    }

    addTaskItem(taskItem, isActive) {
        if (isActive === true) {
            this.currentlyActiveTaskItem = taskItem;
        }

        this.taskItems.push(taskItem);
    }

    static get TaskItemTypes() {
        return {
            'MC': 'Multiple Choice',
            'TF': 'True or False',
            'FB': 'Fill in the Blanks'
        };
    }
}