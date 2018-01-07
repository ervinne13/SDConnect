
/* global group, app, PostTaskModal */

(function () {

    let postViewController = new PostViewController(group);

    $(document).ready(function () {
        initializeUI();
        initializeEvents();

        postViewController.bindPostListToContainerElement($('.posts-container'), $('.posts-action-container'));
    });

    function initializeUI() {
        $('body div.content')[0].style.backgroundColor = group.color;
    }

    function initializeEvents() {
        $('#action-load-more-posts').click(loadMorePosts);

        $('#action-create-post').click(createPost);

        $('#action-delete-group').click(deleteGroup);
        
        $('#action-reuse-task').click(PostTaskModal.show);
    }

    function deleteGroup() {

        let url = app.baseUrl + "/group/" + group.code;

        return $.ajax({
            url: url,
            type: 'DELETE'
        });

    }

    function loadMorePosts() {
        postViewController.loadAndDisplayPosts()
                .then(posts => {
                    console.log(posts);
                    $('#action-load-more-posts').enable();
                });
        $('#action-load-more-posts').disable();
    }

    function createPost() {
        let content = $('#new-post-textarea').val();
        let includeInCalendar = $('#show-in-calendar').is(":checked");

        postViewController.createPost(content, includeInCalendar)
                .success(response => {
                    console.log(response);

                    let message = "A new post has been added";

                    if (includeInCalendar) {
                        message += " and is included in the calendar";
                    }

                    swal("New Post", message, "success");
                    delayedRefresh();
                })
                .fail(handleXhr);
    }

    function deleteGroup() {
        swal({
            title: "Are you sure?",
            text: "You will not be able to this group, all it's posts, and members",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false},
                function () {
                    swal("Loading", "Please wait");
                    deleteGroup()
                            .success(() => {
                                swal("Deleted!", "Group Deleted", "success");
                                setTimeout(() => {
                                    window.location.href = app.baseUrl + "/home";
                                }, 2000);
                            })
                            .fail(xhr => {
                                swal("Delete failed", xhr.responseText, "error");
                            });
                });
    }

    function delayedRefresh() {
        setTimeout(() => {
            window.location.reload();
        }, 2000);
    }

    function handleXhr(xhr) {
        swal("Error", xhr.responseText, "error");
    }

})();
