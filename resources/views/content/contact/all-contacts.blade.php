@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Main /</span> Contacts
</h4>

<!-- Hoverable Table rows -->
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h5>Contacts</h5>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Social</th>
                <th>Message</th>
                <th>Agency</th>
                <th>Ip</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($contacts ?? [] as $index => $contact)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->social }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>{{ $contact->agn }}</td>
                    <td>{{ $contact->ip_addr }}</td>
                    <td>{{ $contact->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection
