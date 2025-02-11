@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Main /</span> Gallery
</h4>

<!-- Hoverable Table rows -->
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h5>Gallery</h5>
    <a href="{{ route('add-activity') }}">
        <button type="button" class="btn btn-icon btn-success" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-plus bx-xs' ></i> <span>Add Activity</span>">
            <span class="tf-icons bx bx-plus"></span>
        </button>
    </a>
  </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
            <th>Title</th>
            <th>Media</th>
            <th>update</th>
            <th>By</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($activities as $index => $activity)
                <tr>
                    <td><span class="fw-medium">{{ $activity->title }}</span></td>
                    <td>
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            @foreach ($activity->media as $key => $media)
                                @if ($key !== 'by')
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-md pull-up" title="{{ $key + 1 }}">
                                        <img src="{{asset('uploads/activity/'. $media)}}" alt="Avatar" class="rounded">
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $activity->updated_at }}</td>
                    <td>{{ App\Models\User::find($activity->media['by'])->name }}</td>
                    <td>
                        <a href="{{ route('edit-activity', ['aid' => $activity->id]) }}">
                            <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-cog bx-xs' ></i> <span>Edit</span>">
                                <span class="tf-icons bx bx-cog"></span>
                            </button>
                        </a>
                        <button type="button" class="btn btn-icon btn-danger delact" aid="{{ $activity->id }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-trash bx-xs' ></i> <span>Delete</span>">
                            <span class="tf-icons bx bx-trash"></span>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
<!--/ Hoverable Table rows -->
<script>
    $(document).ready(function() {
        $('.delact').click(function(){
            const aid = $(this).attr('aid');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    $.ajax({
                        url: '/admin/activity/del/' + aid, // URL where the POST request is sent
                        type: 'GET',
                        success: function(response) {
                            // Handle success. For example, showing a success message
                            console.log(response.data);
                            Swal.fire('Saved!', 'Activity has been deleted.', 'success')
                            .then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload()
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            Swal.fire('Error', 'There was a problem deleting the activity.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
