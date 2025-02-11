@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Main /</span> News
</h4>

<!-- Hoverable Table rows -->
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h5>All News</h5>
    <a href="{{ route('add-news') }}">
        <button type="button" class="btn btn-icon btn-success" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-plus bx-xs' ></i> <span>Add news</span>">
            <span class="tf-icons bx bx-plus"></span>
        </button>
    </a>
  </div>
    @if(session('status'))
        <div class="alert alert-success">
            <span><i class='bx bx-check'></i></span>{{ session('status') }}
        </div>
    @endif
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>cover</th>
                <th>Title</th>
                <th>Type</th>
                <th>update</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($blogs as $index => $blog)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><img src="/uploads/news/{{ $blog->cover }}" width="60" alt=""></td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ ($blog->type == 0) ? 'News' : 'Activity' }}</td>
                    <td>{{ $blog->updated_at }}</td>
                    <td>
                        <a href="{{ route('edit-news', ['bid' => $blog->id]) }}">
                            <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-cog bx-xs' ></i> <span>Edit news</span>">
                                <span class="tf-icons bx bx-cog"></span>
                            </button>
                        </a>
                        <button type="button" class="btn btn-icon btn-danger delnews" bid="{{ $blog->id }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-trash bx-xs' ></i> <span>Delete news</span>">
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
        $('.delnews').click(function(){
            const pid = $(this).attr('bid');
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
                        url: '/admin/news/del/' + pid, // URL where the POST request is sent
                        type: 'GET',
                        success: function(response) {
                            // Handle success. For example, showing a success message
                            console.log(response.data);
                            Swal.fire('Saved!', 'News has been deleted.', 'success')
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
