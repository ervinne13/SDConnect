class TaskItemListView {

    constructor() {
        this.elContainer = null;
        this.currentlyActiveTaskItem = null;
        this.taskItems = [];
        this.taskItemIndexMap = {};

        this._taskItemViewTemplate = _.template(document.querySelector('#task-item-view-template').innerHTML);
        this._mcOptionTemplate = _.template(document.querySelector('#multiple-choice-option-template').innerHTML);

        this._specialFieldsTemplates = {
            MC: _.template(document.querySelector('#multiple-choice-task-special-fields-template').innerHTML),
            TF: _.template(document.querySelector('#true-or-false-task-special-fields-template').innerHTML),
        };

        this.currentlyDisplayingTaskId = null;
    }

    addBlankTaskItem() {
        let latestTask = this.getLatestTask();
        let latestId = latestTask ? latestTask.id + 1 : 1;

        this.addTaskItem({
            id: latestId,
            type_code: 'MC',
            points: 1,
            task_item_text: '',
            choices_json: [],
            correct_answer_free_field: ''
        });
    }

    addTaskItem(taskItem) {
        this.taskItems.push(taskItem);

        //  use map for linear lookup
        this.taskItemIndexMap[taskItem.id] = this.taskItems.length - 1;

        //  add display on left nav
    }

    getTaskItemById(taskId) {
        let index = this.taskItemIndexMap[taskId];

        if (index) {
            return this.taskItems[index];
        } else {
            return null;
        }
    }

    getLatestTask() {
        return this.taskItems.length > 0 ? this.taskItems[this.taskItems.length - 1] : null;
    }

    displayLatestTaskItem() {
        let task = this.getLatestTask();

        this.currentlyDisplayingTaskId = task.id;
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

        $(document).on('change', '#input-type', function () {
            this.updatedSpecialFields();
        }.bind(this));

        $(document).on('click', '#action-save-task-item', function () {
            let taskItem = this.getTaskItemDataFromFields();
            saveTaskItem(taskItem);
        }.bind(this));

    }

    updatedSpecialFields() {
        let taskItemType = document.querySelector('#input-type').value;
        let container = document.querySelector('#special-fields-container');

        container.innerHTML = this._specialFieldsTemplates[taskItemType]();
    }

    addOption() {
        $('ul#choices-container').append(this._mcOptionTemplate());
    }

    saveTaskItem(taskItem) {
        let existingTaskItem = this.getTaskItemById(taskItem.id);
        
        
        
    }

    getTaskItemDataFromFields() {

        let typeCode = $('[name=type_code]').val();
        let choices = this.getChoicesJson(typeCode);
        let answer = this.getAnswer(typeCode);

        return {
            id: $('.task-item-container').data('id'),
            type_code: typeCode,
            points: $('[name=points]').val(),
            task_item_text: $('[name=task_item_text]').val(),
            choices_json: choices,
            correct_answer_free_field: answer
        };
    }

    getChoicesJson(typeCode) {
        if (typeCode === 'MC') {

            if ($('.mc-option').length <= 1) {
                let message = 'Multiple choice options must be at least 2';
                swal('Error', message, 'error');
                throw message;
            }

            let choices = [];

            $('.mc-option').each(function () {
                let option = ('' + $(this).find('.mc-option-text').val()).trim();

                if (!option) {
                    swal('Error', 'Please fill out all options or remove blanks', 'error');
                }

                choices.push(option);
            });

            return choices;
        } else {
            return [];
        }
    }

    getAnswer(typeCode) {
        let answer = null;
        let required = false;
        if (typeCode === 'TF') {
            required = true;
            answer = $('[name=correct_answer_free_field]').val();
        } else if (typeCode === 'MC') {
            required = true;
            answer = $('[name=correct_answer_free_field]:checked').parent().next('.mc-option-text').val();
        }

        if (required && !answer) {
            let message = 'An answer is required';
            swal('Error', message, 'error');
            throw message;
        } else {
            return answer;
        }
    }

    static get TaskItemTypes() {
        return {
            'MC': 'Multiple Choice',
            'TF': 'True or False',
            'FB': 'Fill in the Blanks'
        };
    }
}