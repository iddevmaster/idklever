@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Main / Products /</span> Add Products
</h4>

<!-- Hoverable Table rows -->
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Add Products</h5>
        @if(session('error'))
            <div class="alert alert-success">
                <span><i class='bx bx-x'></i></span>{{ session('error') }}
            </div>
        @endif
    </div>
    <div class="card-body">
        <div class="divider">
            <div class="divider-text">Products Page</div>
        </div>

        <form action="{{ route('store-product') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex flex-wrap align-items-start align-items-sm-center gap-4 mb-4">
                <div id="exampleImageContainer" class="mb-4" style="display: none;">
                    <img id="exampleImage" src="#" alt="Example Image" style="width: 374px; height: 374px; object-fit:cover">
                </div>
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" name="uploadImg" class="account-file-input" hidden accept="image/png, image/jpeg" />
                    </label>
                    <!-- Your existing buttons -->
                    <p class="text-muted mb-0">Allowed JPG or PNG. Max size of 20Mb. Recommend size is 374x374 or more</p>
                </div>
            </div>

            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Name</label>
                <input type="text" class="form-control" required maxlength="200" name="pname" id="defaultFormControlInput" placeholder="Product Name" aria-describedby="defaultFormControlHelp" />
            </div>

            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Description</label>
                <input type="text" class="form-control" required maxlength="1000" name="pdesc" id="defaultFormControlInput" placeholder="Product Description" aria-describedby="defaultFormControlHelp" />
            </div>
            <div class="mb-3 d-flex flex-wrap gap-4">
                {{-- <div>
                    <label for="exampleFormControlSelect1" class="form-label">category</label>
                    <div class="input-group">
                        <select class="form-select" required name="pcategory" id="exampleFormControlSelect1" aria-label="Example select with button addon">
                            <option selected disabled>Choosing category</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-sm btn-outline-primary addcate" type="button"><i class='bx bx-plus'></i></button>
                    </div>
                </div> --}}

                <div>
                    <label for="defaultFormControlInput" class="form-label">Price</label>
                    <div class="d-flex align-items-center">
                        <input type="number" max="9999999" required name="pprice" class="form-control" id="defaultFormControlInput" placeholder="Product Price" aria-describedby="defaultFormControlHelp" />
                        <span class="ms-2">บาท</span>
                    </div>
                </div>
            </div>

            <div class="divider my-5">
                <div class="divider-text">Product Detail Page</div>
            </div>

            <div class="mb-5">
                <label for="prodetail" class="form-label">Detail</label>
                <textarea id="prodetail" name="pdetail" placeholder="Product Detail"></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-outline-danger">Cancel</button>
            </div>
        </form>
    </div>
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

    // Get the file input element
    const fileInput = document.getElementById('upload');

    // Add an event listener to detect when a file is selected
    fileInput.addEventListener('change', handleFileSelect);

    function handleFileSelect(event) {
        const file = event.target.files[0];

        // Check if a file is selected
        if (file) {
            // Display the example image container
            document.getElementById('exampleImageContainer').style.display = 'block';

            // Read the selected file as a data URL
            const reader = new FileReader();
            reader.onload = function (e) {
                // Set the source of the example image
                document.getElementById('exampleImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };

    $(document).ready(function() {
        $('.addcate').click(function(){
            const addtype = $(this).attr('addtype');
            Swal.fire({
                title: "Add Dpm",
                html: ` <input class="form-control mb-2" type="text" name="" id="category" placeholder="Enter category">
                        <input class="form-control mb-2" type="text" name="" id="prefix" placeholder="Enter prefix">
                `,
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const category = document.getElementById('category').value;
                    const prefix = document.getElementById('prefix').value;
                    return { category: category, prefix: prefix };
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    $.ajax({
                        url: '/admin/products/category/add', // URL where the POST request is sent
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            cate: result.value.category,
                            prefix: result.value.prefix,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
                        },
                        success: function(response) {
                            // Handle success. For example, showing a success message
                            console.log(response.data);
                            Swal.fire('Saved!', 'Agency has been added.', 'success')
                            .then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload()
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            Swal.fire('Error', 'There was a problem adding the agency.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
