@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    <div class="d-flex gap-3 flex-wrap mb-4">
        @php
            $last_visitor = \App\Models\Visitor::orderBy('id', 'desc')->first();
        @endphp
        <div class="card flex-fill">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        {{-- ยินดีต้อนรับเข้าสู่แดชบอร์ดของโรงเรียนไอดีสอนทักษะอาชีพ สำหรับจัดการข้อมูลหลักสูตร ข้อมูลบทความข่าวสาร และข้อมูลผู้เข้าชมเว็บไซต์ --}}
                        <h5 class="card-title text-primary">สวัสดี {{ auth()->user()->name }}</h5>
                        <p class="mb-4">ยินดีต้อนรับเข้าสู่แดชบอร์ดของ <span class="fw-medium">โรงเรียนไอดีสอนทักษะอาชีพ</span> <br>
                            สำหรับจัดการข้อมูลหลักสูตร ข้อมูลบทความข่าวสาร และข้อมูลผู้เข้าชมเว็บไซต์
                        </p>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                            alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="card flex-fill">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success"
                            class="rounded">
                    </div>
                </div>
                @php
                    // count visitor in this month
                    $visitor_this_month = \App\Models\Visitor::whereMonth('created_at', date('m'))->count();
                @endphp
                <span class="fw-semibold d-block mb-1">ผู้เข้าชมเดือนนี้</span>
                <h3 class="card-title mb-2">{{ number_format($visitor_this_month, 0, ',', ',') }}</h3>
                <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i>{{ round($visitor_this_month * 100 / $last_visitor->id, 2) }}%</small>
            </div>
        </div>
        <div class="card flex-fill">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                            class="rounded">
                    </div>
                </div>
                <span>ผู้เข้าชมทั้งหมด</span>
                <h3 class="card-title text-nowrap mb-1">{{ number_format($last_visitor->id, 0, ',', ',') }}</h3>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h5>ประวัติการเข้าชม</h5>
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
              <thead class="table-primary">
                  <tr>
                      <th>#</th>
                      <th>IP Address</th>
                      <th>Agent</th>
                      <th>Date</th>
                  </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  @foreach ($visitors ?? [] as $index => $visitor)
                      <tr>
                          <td>{{ $index + 1 + (10 * ($visitors->currentPage() - 1) ) }}</td>
                          <td>{{ $visitor->ip_address }}</td>
                          <td>{{ $visitor->user_agent }}</td>
                          <td>{{ $visitor->created_at }}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
          {{-- laravel paginate --}}
            {{ $visitors->links() }}
        </div>
      </div>
@endsection
