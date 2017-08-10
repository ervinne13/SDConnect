
class TaskView {

    constructor() {
        this.typeCode = null;
        this.typeName = null;
    }

    setTypeCode(typeCode) {
        if (TaskView.TYPE_CODES.indexOf(typeCode) < 0) {
            throw new Error("Cannot set type code " + typeCode);
        }

        this.typeCode = typeCode;
        this.typeName = TaskView.TYPE_CODES[typeCode];
    }

}

TaskView.TYPE_CODES = {
    A: "Assignment",
    Q: "Quiz",
    E: "Exam"
};