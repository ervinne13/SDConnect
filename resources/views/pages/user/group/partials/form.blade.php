<form id="group-form" class="fields-container">

    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="input-type">Group Type</label>
                <select name="type" id="input-type" required class="form-control select2-input">
                    @foreach($groupTypes AS $groupType)
                    <?php $selected = $groupType == $group->getType() ? "selected" : "" ?>
                    <option {{$selected}} value="{{$groupType}}">{{$groupType}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="input-code">Code</label>
                <input name="code" value="{{$group->getCode()}}" id="input-code" required placeholder="Ex. IT-2017-204" type="text" class="form-control">
            </div>

            <div class="form-group">
                <label class="control-label" for="input-name">Display Name</label>
                <input name="display-name" value="{{$group->getDisplayName()}}" id="input-name" required placeholder="How should the system display this group?" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="input-group colorpicker-component">
                    <input type="text" value="{{$group->getColor()}}" name='color' class="form-control" />
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label" for="input-description">Description</label>
                <textarea name="description" class="form-control full-width" placeholder="Describe your group.">{{$group->getDescription()}}</textarea>                
            </div>
        </div>
    </div>

</form>