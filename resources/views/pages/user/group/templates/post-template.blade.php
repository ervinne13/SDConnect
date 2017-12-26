<script id="group-note-template" type="text/html">    
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
            </div>
        </div>
    </div>
</script>
