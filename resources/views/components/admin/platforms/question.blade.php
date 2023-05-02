<div class="card-header">
    <h3 class="card-title">Request Information</h3>
</div>
@php $countQ = 0; @endphp

<div class="card-body">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Note!</h5>
        To show multiple options for <b>Checklist</b> and <b>Choose</b>. Add it with ";" Separated.<br/><strong>For Example:</strong> Startup Business; Settled Business
    </div>

    <div id="questions-div">
    @if(!empty($platform->question) && count(json_decode($platform->question, true)) > 0)
    @foreach (json_decode($platform->question, true) as $q => $question)
        @php $countQ = count(json_decode($platform->question, true)); @endphp
        <div class="row question-clone-exist-{{$q}}">
            <div class="col-8">
                <div class="form-group">
                    <label for="question-desc">Description</label>
                    <input type="text" name="questions[{{$q}}][description]" class="form-control" value="{{$question['description']}}">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="question-type">Type</label>
                    <select class="form-control" name="questions[{{$q}}][type]">
                        <option value="">Please Select</option>
                        @foreach (config('default-data.question_types') as $type => $display)
                            <option value="{{$type}}" {{ $type == $question['type'] ? 'selected' : '' }}>{{$display}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-1">
                <i class="fas fa-times-circle text-danger float-right pt-5 delete-clone" role="button" data-delete-clone="question-clone-exist-{{$q}}"></i>
            </div>
        </div>
        @endforeach
    @endif
    </div>
    <div class="row">
        <div class="col-3">
            <button type="button" class="btn btn-block btn-outline-secondary" id="add-new-question-btn">
                <i class="fas fa-plus-circle"></i> Add Questions
            </button>
        </div>
    </div>
</div>


@once
    @push('custom_scripts')
        <script>
            $(document).ready(function(){
                let questions = "{{$countQ}}";
                $('#add-new-question-btn').on('click', function(){
                    $("#questions-div").append(`
                        <div class="row question-clone-`+questions+`">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="quest-desc">Description</label>
                                    <input type="text" name="questions[`+questions+`][description]" class="form-control" placeholder="Question">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="quest-type">Type</label>
                                    <select class="form-control" name="questions[`+questions+`][type]">
                                        <option value="">Please Select</option>
                                        @foreach (config('default-data.question_types') as $type => $display)
                                            <option value="{{$type}}">{{$display}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-1">
                                <i class="fas fa-times-circle text-danger float-right pt-5 delete-clone" role="button" data-delete-clone="question-clone-`+questions+`"></i>
                            </div>
                        </div>
                    `);
                    questions++;
                });
                $(document).on('click', '.delete-clone', function(){
                    $("."+$(this).data('delete-clone')).remove();
                });
            });

        </script>
    @endpush
@endonce