@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Main /</span> Organization
</h4>

<!-- Hoverable Table rows -->
<div class="card mb-5">
  <div class="card-header d-flex justify-content-between">
    <h5>Agency</h5>
        <button type="button" class="btn btn-icon btn-success addagn" addtype="agn" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-plus bx-xs' ></i> <span>Add agency</span>">
            <span class="tf-icons bx bx-plus"></span>
        </button>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($agns as $index => $agn)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $agn->name }}</td>
                    <td>
                        <button type="button" class="btn btn-icon btn-primary editagn" editid="{{ $agn->id }}" editval="{{ $agn->name }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-cog bx-xs' ></i> <span>Edit</span>">
                            <span class="tf-icons bx bx-cog"></span>
                        </button>
                        <button type="button" class="btn btn-icon btn-danger deldata" delid="{{ $agn->id }}" deltype="agn" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-trash bx-xs' ></i> <span>Delete </span>">
                            <span class="tf-icons bx bx-trash"></span>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
<!--/ Agency Table rows -->


<div class="card mb-5">
    <div class="card-header d-flex justify-content-between">
      <h5>Branch</h5>
        <button type="button" class="btn btn-icon btn-success addbrn" addtype="brn" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-plus bx-xs' ></i> <span>Add branch</span>">
            <span class="tf-icons bx bx-plus"></span>
        </button>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Agn</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($brns as $index => $brn)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $brn->name }}</td>
                            <td>{{ optional($brn->getAgn)->name }}</td>
                            <td>
                                <button type="button" class="btn btn-icon btn-primary editbrn" editid="{{ $brn->id }}" editval="{{ $brn->name }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-cog bx-xs' ></i> <span>Edit</span>">
                                    <span class="tf-icons bx bx-cog"></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-danger deldata" delid="{{ $brn->id }}" deltype="brn" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-trash bx-xs' ></i> <span>Delete </span>">
                                    <span class="tf-icons bx bx-trash"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>
<!-- Branch Table rows -->

<div class="card mb-5">
    <div class="card-header d-flex justify-content-between">
      <h5>Department</h5>
        <button type="button" class="btn btn-icon btn-success adddpm" addtype="dpm" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-plus bx-xs' ></i> <span>Add department</span>">
            <span class="tf-icons bx bx-plus"></span>
        </button>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Brn</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($dpms as $index => $dpm)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dpm->name }}</td>
                            <td>{{ optional($dpm->getBrn)->name }}</td>
                            <td>
                                <button type="button" class="btn btn-icon btn-primary editdpm" editid="{{ $dpm->id }}" editval="{{ $dpm->name }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-cog bx-xs' ></i> <span>Edit</span>">
                                    <span class="tf-icons bx bx-cog"></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-danger deldata" delid="{{ $dpm->id }}" deltype="dpm" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-trash bx-xs' ></i> <span>Delete</span>">
                                    <span class="tf-icons bx bx-trash"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>
<!-- Department Table rows -->
<script>
    $(document).ready(function() {
        $('.addagn').click(function(){
            const addtype = $(this).attr('addtype');
            Swal.fire({
                title: "Add Agency",
                input: "text",
                inputPlaceholder: "Enter agency name",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    $.ajax({
                        url: '/admin/organization/add', // URL where the POST request is sent
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            addName: result.value,
                            addtype: addtype,
                            selected: '',
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

        $('.addbrn').click(function(){
            const addtype = $(this).attr('addtype');
            Swal.fire({
                title: "Add Branch",
                html: ` <input class="form-control mb-2" type="text" name="" id="branchName" placeholder="Enter branch name">
                        <select class="form-select" aria-label="Default select example" id='branchSelect'>
                            @foreach ($agns as $agn)
                                <option value="{{ $agn->id }}">{{ $agn->name }}</option>
                            @endforeach
                        </select>
                `,
                inputPlaceholder: "Enter branch name",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const name = document.getElementById('branchName').value;
                    const selectedOption = document.getElementById('branchSelect').value;
                    return { bname: name, bselect: selectedOption };
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    $.ajax({
                        url: '/admin/organization/add', // URL where the POST request is sent
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            addName: result.value.bname,
                            selected: result.value.bselect,
                            addtype: addtype,
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

        $('.adddpm').click(function(){
            const addtype = $(this).attr('addtype');
            Swal.fire({
                title: "Add Dpm",
                html: ` <input class="form-control mb-2" type="text" name="" id="dpmName" placeholder="Enter department name">
                        <select class="form-select" aria-label="Default select example" id='dpmSelect'>
                            @foreach ($brns as $brn)
                                <option value="{{ $brn->id }}">{{ $brn->name }}</option>
                            @endforeach
                        </select>
                `,
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const name = document.getElementById('dpmName').value;
                    const selectedOption = document.getElementById('dpmSelect').value;
                    return { dname: name, dselect: selectedOption };
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    $.ajax({
                        url: '/admin/organization/add', // URL where the POST request is sent
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            addName: result.value.dname,
                            selected: result.value.dselect,
                            addtype: addtype,
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

        // $('.editagn').click(function(){
        //     const editid = $(this).attr('editid');
        //     const editval = $(this).attr('editval');
        //     Swal.fire({
        //         title: "Edit Agency",
        //         input: "text",
        //         inputPlaceholder: "Enter agency name",
        //         inputValue: editval,
        //         showCancelButton: true,
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Save',
        //         showLoaderOnConfirm: true,
        //     }).then((result) => {
        //         if (result.isConfirmed && result.value) {
        //             $.ajax({
        //                 url: '/admin/organization/edit/' editid, // URL where the POST request is sent
        //                 type: 'POST',
        //                 dataType: 'json',
        //                 data: {
        //                     addName: result.value,
        //                     addtype: 'agn',
        //                     selected: '',
        //                 },
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
        //                 },
        //                 success: function(response) {
        //                     // Handle success. For example, showing a success message
        //                     console.log(response.data);
        //                     Swal.fire('Saved!', 'Agency has been added.', 'success')
        //                     .then((result) => {
        //                         if (result.isConfirmed) {
        //                             window.location.reload()
        //                         }
        //                     });
        //                 },
        //                 error: function(xhr, status, error) {
        //                     // Handle errors
        //                     Swal.fire('Error', 'There was a problem adding the agency.', 'error');
        //                 }
        //             });
        //         }
        //     });
        // });

        // $('.editbrn').click(function(){
        //     const editid = $(this).attr('editid');
        //     const editval = $(this).attr('editval');
        //     Swal.fire({
        //         title: "Add Branch",
        //         html: ` <input class="form-control mb-2" value="${editval}" type="text" name="" id="branchName" placeholder="Enter branch name">
        //                 <select class="form-select" aria-label="Default select example" id='branchSelect'>
        //                     @foreach ($agns as $agn)
        //                         <option value="{{ $agn->id }}">{{ $agn->name }}</option>
        //                     @endforeach
        //                 </select>
        //         `,
        //         inputPlaceholder: "Enter branch name",
        //         showCancelButton: true,
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Save',
        //         showLoaderOnConfirm: true,
        //         preConfirm: () => {
        //             const name = document.getElementById('branchName').value;
        //             const selectedOption = document.getElementById('branchSelect').value;
        //             return { bname: name, bselect: selectedOption };
        //         }
        //     }).then((result) => {
        //         if (result.isConfirmed && result.value) {
        //             $.ajax({
        //                 url: '/admin/organization/add', // URL where the POST request is sent
        //                 type: 'POST',
        //                 dataType: 'json',
        //                 data: {
        //                     addName: result.value.bname,
        //                     selected: result.value.bselect,
        //                     addtype: addtype,
        //                 },
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
        //                 },
        //                 success: function(response) {
        //                     // Handle success. For example, showing a success message
        //                     console.log(response.data);
        //                     Swal.fire('Saved!', 'Agency has been added.', 'success')
        //                     .then((result) => {
        //                         if (result.isConfirmed) {
        //                             window.location.reload()
        //                         }
        //                     });
        //                 },
        //                 error: function(xhr, status, error) {
        //                     // Handle errors
        //                     Swal.fire('Error', 'There was a problem adding the agency.', 'error');
        //                 }
        //             });
        //         }
        //     });
        // });

        // $('.editdpm').click(function(){
        //     const editid = $(this).attr('editid');
        //     const editval = $(this).attr('editval');
        //     Swal.fire({
        //         title: "Add Dpm",
        //         html: ` <input class="form-control mb-2" type="text" name="" id="dpmName" placeholder="Enter department name">
        //                 <select class="form-select" aria-label="Default select example" id='dpmSelect'>
        //                     @foreach ($brns as $brn)
        //                         <option value="{{ $brn->id }}">{{ $brn->name }}</option>
        //                     @endforeach
        //                 </select>
        //         `,
        //         showCancelButton: true,
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Save',
        //         showLoaderOnConfirm: true,
        //         preConfirm: () => {
        //             const name = document.getElementById('dpmName').value;
        //             const selectedOption = document.getElementById('dpmSelect').value;
        //             return { dname: name, dselect: selectedOption };
        //         }
        //     }).then((result) => {
        //         if (result.isConfirmed && result.value) {
        //             $.ajax({
        //                 url: '/admin/organization/add', // URL where the POST request is sent
        //                 type: 'POST',
        //                 dataType: 'json',
        //                 data: {
        //                     addName: result.value.dname,
        //                     selected: result.value.dselect,
        //                     addtype: addtype,
        //                 },
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
        //                 },
        //                 success: function(response) {
        //                     // Handle success. For example, showing a success message
        //                     console.log(response.data);
        //                     Swal.fire('Saved!', 'Agency has been added.', 'success')
        //                     .then((result) => {
        //                         if (result.isConfirmed) {
        //                             window.location.reload()
        //                         }
        //                     });
        //                 },
        //                 error: function(xhr, status, error) {
        //                     // Handle errors
        //                     Swal.fire('Error', 'There was a problem adding the agency.', 'error');
        //                 }
        //             });
        //         }
        //     });
        // });

        $('.deldata').click(function(){
            const deltype = $(this).attr('deltype');
            const delid = $(this).attr('delid');
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
                    $.ajax({
                        url: '/admin/organization/delete', // URL where the POST request is sent
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            delType: deltype,
                            delId: delid,
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
