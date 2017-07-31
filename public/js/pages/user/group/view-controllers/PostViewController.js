
/* global app, group */

class PostViewController {

    constructor(group) {

        this.$postListContainer = null;
        this.$postListActionsContainer = null;
        this.postsNextPageUrl = null;
        this.pageSize = 10;
        this.currentListViewPage = 0;
        this.group = group;
        this.moduleBaseUrl = app.baseUrl + "/group/" + group.code;

        //  templates
        this.template = {
            postContainer: _.template($('#post-container-template').html()),
            post: _.template($('#group-note-template').html()),
//            event: _.template($('#group-event-template').html()),
//            assigment: _.template($('#group-assigment-template').html()),
//            quiz: _.template($('#group-quiz-template').html())           
        };

    }

    createPost(postText, includeInCalendar) {

        let url = app.baseUrl + "/post";
        let params = {
            group: group,
            module: 'Post',
            includeInCalendar: includeInCalendar || true,
            content: postText
        };

        return $.post(url, params);

    }

    createEvent(eventText, dateTimeFrom, dateTimeTo) {
        let url = app.baseUrl + "/post";
        let params = {
            group: group,
            module: 'Event',
            includeInCalendar: includeInCalendar || true,
            dateTimeFrom: dateTimeFrom,
            dateTimeTo: dateTimeTo,
            content: eventText
        };

        return $.post(url, params);
    }

    loadPosts() {
        this.currentListViewPage++;

        let url = app.baseUrl + "/post/group/" + group.code;
        let params = {
            pageSize: this.pageSize,
            page: this.currentListViewPage
        };

        return $.get(url, params);
    }

    loadAndDisplayPosts() {
        let _this = this;

        let dfd = $.Deferred();

        this.loadPosts()
                .success(posts => {
                    let html = "";
                    posts.data.forEach(post => {
                        let contentTemplate = _this.getTemplateFromPost(post);

                        html += _this.template.postContainer({
                            postTitle: post.module,
                            postBody: contentTemplate(post)
                        });
                    });

                    _this.$postListContainer.append(html);

                    if (_this.$postListActionsContainer) {

                        if (posts.next_page_url) {
                            _this.$postListActionsContainer.show();
                        } else {
                            _this.$postListActionsContainer.hide();
                        }
                    }

                    dfd.resolve(posts);
                })
                .fail(xhr => {
                    swal("Error", xhr.responseText, "error");
                    dfd.reject(xhr.responseText);
                });

        return dfd.promise();
    }

    bindPostListToContainerElement($el, $postListActionsContainer) {
        this.$postListContainer = $el;
        this.$postListActionsContainer = $postListActionsContainer;
        this.loadAndDisplayPosts();

    }

    getTemplateFromPost(post) {
        switch (post.module) {
            case'Post':
                return this.template.post;
        }
    }

}
