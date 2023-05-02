<div class="col-md-3">
    @if (!empty($user))
        <input type="hidden" name="id" value="{{ $user->id }}" id="user-id" />
    @endif
    <!-- Profile Image -->
    <div class="card card-danger card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle cursor-pointer"
                    src="{{ !empty($user) ? asset($user->image) : '' }}" alt="User profile picture"
                    style="cursor:pointer; min-height: 80px" id="user-profile-image">
                <input type="file" name="image" id="upload-img" accept="image/*" class="d-none">
            </div>
            <h3 class="profile-username text-center">{{ $user->name }}</h3>

            {{-- <p class="text-muted text-center">Software Engineer</p> --}}

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                </li>
                <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                </li>
                <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                </li>
            </ul>
            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- About Me Box -->
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"> About Me </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Education</strong>

            <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

            <p class="text-muted">Malibu, California</p>

            <hr>

            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

            <p class="text-muted">
                <span class="tag tag-danger">UI Design</span>
                <span class="tag tag-success">Coding</span>
                <span class="tag tag-info">Javascript</span>
                <span class="tag tag-warning">PHP</span>
                <span class="tag tag-primary">Node.js</span>
            </p>

            <hr>

            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim
                neque.</p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@once
    @push('custom_scripts')
        <script>
            $(document).ready(function() {
                $("#user-profile-image").on('click', function() {
                    $("#upload-img").click();
                });

                $("#upload-img").on('change', function(e) {
                    $("#user-profile-image").attr('src', URL.createObjectURL(e.target.files[0]))

                    var fd = new FormData();
                    var files = e.target.files[0];

                    fd.append('file', files);
                    fd.append('user_id', $("#user-id").val());
                    fd.append('_token', $('meta[name="csrf-token"]').attr('content'));

                    let profileUrl = "{{ route('admin.user.profile.image') }}";
                    $.ajax({
                        type: 'POST',
                        url: profileUrl,
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: (response) => {
                            if (response) {
                                this.reset();
                                alert('Image has been uploaded successfully');
                            }
                        },
                        error: function(response) {
                            console.log(response);
                            $('#image-input-error').text(response.responseJSON.errors.file);
                        }
                    });
                });

            });
        </script>
    @endpush
@endonce
