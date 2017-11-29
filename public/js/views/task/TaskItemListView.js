
class TaskItemListView {

    constructor() {
        this.elContainer = null;
    }

    bindElementAsContainer(elSelector) {
        this.elContainer = document.querySelector(elSelector);

        this.initEvents();
    }

    initEvents() {

    }

    updateListWithMap(taskItemMap) {
        console.log(taskItemMap);
    }

}