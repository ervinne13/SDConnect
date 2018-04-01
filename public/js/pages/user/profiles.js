
let Profiles = (function () {

    let profileCardTemplate;

    function init() {
        profileCardTemplate = _.template($('#profile-card-template').html());
        initEvents();
        
        console.log(app.session);
    }

    function initEvents() {
        $('.filter-trigger').click(function () {
            let filterCode = $(this).data('filter-code');
            let filterText = $(`.filter-field[data-filter-code=${filterCode}]`).val();

            filter(filterCode, filterText);
        });

        $('.filter-field').keyup(function () {
            let filterCode = $(this).data('filter-code');
            let filterText = $(this).val();

            debounce(function () {
                filter(filterCode, filterText);
            }, 750)();
        });

        $('.action-show-profile').click(function () {
            let username = $(this).data('username');
            loadProfile(username);
        });

        $(document).on('click', '#action-show-give-badge-modal', function () {
            $('#give-badge-modal').modal('show');
        });

        $('#action-give-badge').click(function () {
            let selectedBadge = $('#badge-select').val();
            let activeUsername = $('#profile-card-data').data('username');

            giveBadge(activeUsername, selectedBadge);
        });
    }

    function filter(filterCode, filterText) {
        $(`.filterable-container[data-filter-code=${filterCode}] .filterable-item`).show();

        if (!filterText) {
            return;
        }

        $(`.filterable-container[data-filter-code=${filterCode}] .filterable-item`).each(function () {
            let filterableValue = $(this).data('filter-value');

            if (filterableValue.toLowerCase().indexOf(filterText.toLowerCase()) < 0) {
                $(`.filterable-container[data-filter-code=${filterCode}] .filterable-item[data-filter-value="${filterableValue}"]`).hide();
            }
        });
    }

    function loadProfile(username) {
        let url = baseURL + '/profiles/' + username;

        $.get(url, userData => {
            let profileCardHtml = profileCardTemplate(userData);
            $('#profile-card-container').html(profileCardHtml);
        });
    }

    function giveBadge(username, badgeId) {
        let url = `${baseURL}/user/${username}/give-badge`;
        let data = {badge_id: badgeId};

        $.post(url, data, response => {
            console.log(response);

            $('#give-badge-modal').modal('hide');

            loadProfile(username);
        });

    }

    // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.
    function debounce(func, wait, immediate) {
        var timeout;
        return function () {
            var context = this, args = arguments;
            var later = function () {
                timeout = null;
                if (!immediate) {
                    func.apply(context, args);
                }
            };

            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);

            if (callNow) {
                func.apply(context, args);
            }
        };
    }


    return {init};

})();

