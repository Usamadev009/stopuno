<form action="{{(!empty($role)) ? route('admin.role.update') : route('admin.role.save')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" id="roleTitle" placeholder="Enter Role Title" value="{{!empty($role) ? $role->title : ''}}" required {{(!empty($role->title) && $role->title == 'Admin') ? 'disabled' : ''}}>
                </div>
            </div>
        </div>
        @foreach($permissions as $permission)
        <div class="row pb-0">
            <div class="col-3">
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                    <input class="custom-control-input module" type="checkbox" id="permissionCheck{{$permission->title}}" {{ (isset($role->assignedPermission) && !empty($role->assignedPermission[$permission->id]) && count($role->assignedPermission[$permission->id]) == 4) ? 'checked' : '' }} data-module="{{$permission->module}}">
                    <label for="permissionCheck{{$permission->title}}" class="custom-control-label">{{$permission->title}}</label>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label>{{$permission->title}}</label>
                </div> --}}
            </div>
        </div>

        <div class="row mt-0 module-{{$permission->module}}">
            @foreach(config('default-data.privileges') as $type => $priv)
                <div class="col-3">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="permissionCheck{{$permission->title}}{{$type}}" name="privs[{{$permission->id}}][]" value="{{$type}}" {{ (isset($role->assignedPermission) && !empty($role->assignedPermission)) ? (isset($role->assignedPermission[$permission->id][$type]) ? 'checked' : '') : '' }}>
                        <label for="permissionCheck{{$permission->title}}{{$type}}" class="custom-control-label font-weight-normal">{{$priv}}</label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr/>
        @endforeach
    </div>

    <!-- /.card-body -->
    @if(!empty($role) && $role->title == 'Admin')
    @else
    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                
                <input type="submit" value="Save" class="btn btn-primary float-right">
            </div>
        </div>
    </div>
    @endif
</form>

@push('custom_scripts')
<script>
    $(document).ready(function(){
        $(".module").on('click', function(){
            if($(this).is(':checked')){
                $(".module-"+$(this).data('module')).find('input').prop('checked', true)
            }else{
                $(".module-"+$(this).data('module')).find('input').prop('checked', false)
            }
        });
    });
</script>
@endpush