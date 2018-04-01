<script id="profile-card-template" type="text/html">
    <div id="profile-card-data" data-username="<%= username %>"></div>
    <div class="panel panel-default b-a-0 shadow-box">
        <div class="panel-body">

            <!-- START Avatar with Name -->
            <div class="media m-l-1">
                <div class="media-left">
                    <div class="center-block">
                        <div class="avatar avatar-image avatar-lg center-block">
                            <img class="img-circle center-block m-t-1 m-b-2" src="<%= image_url %>" alt="Avatar">                                            
                        </div>
                    </div>
                </div>
                <div class="media-body ">
                    <h4 class="m-b-0">
                        <span><%= display_name %></span>                                       
                    </h4>
                    <p class="m-t-0">
                        <span>
                            <% if (student) { %>
                            Student
                            <% } else { %>
                            Teacher
                            <% } %>
                        </span>
                    </p>
                    <button id="action-show-give-badge-modal" type="button" class="btn btn-success">
                        <i class="fa fa-star-o"></i>
                        Give Badge
                    </button>
                </div>
            </div>
            <!-- END Avatar with Name -->

            <div class="hr-text hr-text-left">
                <h6 class="text-gray-darker bg-white-i">
                    <strong>Groups</strong>
                </h6>
            </div>

            <% groups.forEach(group => { %>
            <%= group.display_name %>
            <% }) %>

            <div class="hr-text hr-text-left m-t-2">
                <h6 class="text-gray-darker bg-white-i">
                    <strong>Badges</strong>
                </h6>
            </div>

            <% if (badges.length <= 0) { %>
            <span>This user is not given any badges yet.</span>            
            <% } %>

            <% badges.forEach(badge => { %>
            <span class="badge badge-gray-dark badge-outline">
                <span>
                    <i class="fa fa-fw fa-star text-lighting-yellow fa-lg"></i>
                    <%= badge.display_name %>
                </span>
            </span>
            <% }) %>

        </div>
    </div>
</script>