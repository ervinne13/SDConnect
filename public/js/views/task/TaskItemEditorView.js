class TaskItemEditorView {

    constructor() {
        this.elContainer = null;

        this._taskItemViewTemplate = _.template(document.querySelector('#task-item-view-template').innerHTML);
        this._mcOptionTemplate = _.template(document.querySelector('#multiple-choice-option-template').innerHTML);

        this._specialFieldsTemplates = {
            MC: _.template(document.querySelector('#multiple-choice-task-special-fields-template').innerHTML),
            TF: _.template(document.querySelector('#true-or-false-task-special-fields-template').innerHTML),
        };

        this.currentlyDisplayingTaskId = null;

        //  callbacks
        this.onTaskItemSaveCommandCallback = null;
        this.onTaskItemSaveAndNewCommandCallback = null;
        this.onTaskItemDeleteCommandCallback = null;
    }

    displayTaskItem(taskItem) {
        this.currentlyDisplayingTaskId = taskItem.id;
        this.elContainer.innerHTML = this._taskItemViewTemplate(taskItem);

        this.updateSpecialFields();

        if (taskItem.choices_json.length) {
            for (let i in taskItem.choices_json) {
                this.addOption({
                    option_text: taskItem.choices_json[i]
                });
            }
        }

        this.setAnswer(taskItem);
    }

    bindElementAsContainer(elSelector) {
        this.elContainer = document.querySelector(elSelector);

        this.initEvents();
    }

    initEvents() {

        //  fall back to jQuery for complex event handling
        $(document).on('click', '#action-add-option', function () {
            this.addOption({
                option_text: ''
            });
        }.bind(this));

        $(document).on('click', '.action-remove-mc-option', function () {
            $(this).closest('li.mc-option').remove();
        });

        $(document).on('change', '#input-type', function () {
            this.updateSpecialFields();
        }.bind(this));

        //  external callback events

        $(document).on('click', '#action-save-task-item', function () {
            let taskItem = this.getTaskItemDataFromFields();

            if (this.onTaskItemSaveCommandCallback) {
                this.onTaskItemSaveCommandCallback(taskItem);
            }

        }.bind(this));

        $(document).on('click', '#action-save-new-task-item', function () {
            let taskItem = this.getTaskItemDataFromFields();

            if (this.onTaskItemSaveAndNewCommandCallback) {
                this.onTaskItemSaveAndNewCommandCallback(taskItem);
            }

        }.bind(this));

        $(document).on('click', '#action-delete-task-item', function () {
            let taskItem = this.getTaskItemDataFromFields();

            if (this.onTaskItemDeleteCommandCallback) {
                this.onTaskItemDeleteCommandCallback(taskItem);
            }

        }.bind(this));

    }

    updateSpecialFields() {
        let taskItemType = document.querySelector('#input-type').value;
        let container = document.querySelector('#special-fields-container');

        container.innerHTML = this._specialFieldsTemplates[taskItemType]();
    }

    addOption(option) {
        $('ul#choices-container').append(this._mcOptionTemplate(option));
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

    setAnswer(taskItem) {
        if (taskItem.type_code === 'TF') {
            $('[name=correct_answer_free_field]').val(taskItem.correct_answer_free_field);
        } else if (taskItem.type_code === 'MC') {
            $(`[name=correct_answer_free_field][value="${taskItem.correct_answer_free_field}"]`).prop('checked', true);
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

    onTaskItemSaveCommand(callback) {
        this.onTaskItemSaveCommandCallback = callback;
    }

    onTaskItemSaveAndNewCommand(callback) {
        this.onTaskItemSaveAndNewCommandCallback = callback;
    }

    onTaskItemDeleteCommand(callback) {
        this.onTaskItemDeleteCommandCallback = callback;
    }

    static get TaskItemTypes() {
        return {
            'MC': 'Multiple Choice',
            'TF': 'True or False',
            'FB': 'Fill in the Blanks'
        };
    }
}