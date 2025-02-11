@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Main / Activity /</span> Edit Activity
</h4>

<!-- Hoverable Table rows -->
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Edit Activity</h5>
    </div>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('update-activity', ['aid' => $activity->id]) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Title</label>
                <input type="text" name="ac_title" value="{{ $activity->title }}" required maxlength="500" class="form-control" id="defaultFormControlInput" placeholder="Activity title" aria-describedby="defaultFormControlHelp" />
            </div>

            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Description</label>
                <input type="text" class="form-control" value="{{ $activity->desc }}" name="ac_desc" maxlength="1000" id="defaultFormControlInput" placeholder="Activity description" aria-describedby="defaultFormControlHelp" />
            </div>

            <div class="mb-5">
                <label for="prodetail" class="form-label">Media</label>
                <div class="container border">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 gap-2 p-2">
                        @foreach ($activity->media as $key => $media)
                            @if ($key !== 'by')
                                <div class="position-relative p-0">
                                    <div class="p-0 overflow-hidden rounded">
                                        <img class="object-fit-cover" src="{{asset('uploads/activity/'. $media)}}" width="350" height="150" alt="">
                                    </div>
                                    <button type="button" aid="{{ $activity->id }}" media="{{ $media }}" class="btn btn-sm rounded-pill btn-icon btn-danger position-absolute top-0 end-0 delBtn" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-x bx-xs' ></i> <span>Delete</span>">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <label for="prodetail" class="form-label">Upload <span class="text-secondary" style="font-size: 10px">( Allowed jpeg,png or jpg. Max size of 10Mb. )</span></label>
                <div class="input-images"></div>
            </div>

            <input type="text" name="oldMedia" value="{{ json_encode($activity->media) }}" hidden>

            <div>
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-outline-danger">Cancel</button>
            </div>
        </div>
    </form>
</div>
<!--/ Hoverable Table rows -->
<script>
    tinymce.init({
        selector: 'textarea#prodetail',
        plugins: 'print preview  importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars linkchecker emoticons',
        menubar: 'file edit view insert format tools table tc help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
        autosave_ask_before_unload: true,
        autosave_interval: '10s',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        importcss_append: true,
    });

    $(document).ready(function(){
        $('.input-images').imageUploader();

        $('.delBtn').click(function() {
            const actid = $(this).attr('aid');
            const delmedia = $(this).attr('media');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    console.log(delmedia);
                    $.ajax({
                        url: '/admin/activity/' + actid + '/delete/media/' + delmedia, // URL where the POST request is sent
                        type: 'GET',
                        success: function(response) {
                            // Handle success. For example, showing a success message
                            console.log(response.data);
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload()
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            Swal.fire('Error', 'There was a problem deleting the news.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
