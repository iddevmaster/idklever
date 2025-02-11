@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Main / Activity /</span> Add Activity
</h4>

<!-- Hoverable Table rows -->
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Add Activity</h5>
    </div>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('store-activity') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Title</label>
                <input type="text" name="ac_title" required maxlength="500" class="form-control" id="defaultFormControlInput" placeholder="Activity title" aria-describedby="defaultFormControlHelp" />
            </div>

            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Description</label>
                <input type="text" class="form-control" name="ac_desc" maxlength="1000" id="defaultFormControlInput" placeholder="Activity description Name" aria-describedby="defaultFormControlHelp" />
            </div>

            <div class="mb-5">
                <label for="prodetail" class="form-label">Media <span class="text-secondary" style="font-size: 10px">( Allowed jpeg,png or jpg. Max size of 10Mb. )</span></label>
                <div class="input-images"></div>
            </div>


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
    });
</script>
@endsection
