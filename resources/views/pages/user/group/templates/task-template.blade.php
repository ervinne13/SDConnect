<script id="group-task-template" type="text/html">    
    <div class="v-a-m">
        <div class="media media-auto">
            <div class="media-left">
                <div class="avatar avatar-image <%= author.image_url ? 'loaded' : '' %>">
                    <img class="media-object img-circle" src="<%= author.image_url %>" alt="Avatar">                           
                </div>
            </div>
            <div class="media-body">
                <span class="media-heading text-gray-darker"><%= author.display_name %></span>
                <br>
                <span class="media-heading">
                    <%= content %>
                </span>
                <span class="media-body">
                    Deadline: <%= SGFormatter.displayDate(date_time_to) %>
                    <p>
                        <a href="<%= relative_url %>">View This Task</a>
                    </p>
                    <p>
                        <!-- <a href="{{url('group/group.code/tasks')}}">View All Tasks</a> -->
                    </p>                    
                </span>
            </div>
        </div>
    </div>
</script>
