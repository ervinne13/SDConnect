
(function () {

    let templates = {};

    $(document).ready(function () {

        initializeTemplates();

        initializeCalendar();
        initializeEvents();

    });

    function initializeTemplates() {
        templates.post = _.template($('#group-note-template').html());
//        templates.event = _.template($('#group-event-template').html());         
//        templates.assigment = _.template($('#group-assigment-template').html());         
//        templates.quiz = _.template($('#group-quiz-template').html());
        console.log(templates);
    }

    function initializeCalendar() {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next,today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listDay'
            },
            editable: false,
            droppable: false,
            events: loadEvents,
            eventClick: onEventClicked
        });
    }

    function initializeEvents() {
        $('.action-filter-calendar').click(function () {
            $('.action-filter-calendar').removeClass('active');
            $(this).addClass('active');

            loadCalendarEvents();
        });
    }

    function loadCalendarEvents() {
        //  TODO
    }

    function loadEvents(start, end, timezone, callback) {
        let url = app.baseUrl + "/calendar/posts/";
        let params = {
            start: start.format("YYYY-MM-DD"),
            end: end.format("YYYY-MM-DD")
        };

        let groupCode = $('.action-filter-calendar.active').data('group-code');

        if (groupCode) {
            params.groupCode = groupCode;
        }

        $.get(url, params, posts => {
            console.log(posts);
            callback(posts);
        }).fail(xhr => {
            swal("Error", xhr.responseText, "error");
        });

    }

    function onEventClicked(e) {
        showPost(e.post);
    }

    function showPost(post) {

        post.noHeaders = true;

        let template = getTemplateFromPost(post);

        $('#calendar-event-title').text("Calendar Event: " + post.module);
        $('#calendar-event-body').html(template(post));

        $('#calendar-event-modal').modal('show');

    }

    function getTemplateFromPost(post) {
        switch (post.module) {
            case 'Post':
                return templates.post;
        }
    }

})();
