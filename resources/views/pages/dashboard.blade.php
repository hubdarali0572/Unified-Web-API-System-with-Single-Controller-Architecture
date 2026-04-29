@extends('layouts.master')
@section('title', 'Dashboard')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />

@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h5 class="mb-3 mb-md-0">Dashboard</h5>
  </div>
</div>
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0 text-secondary">Users</h6>
            </div>
            <div class="row d-flex justify-content-between">
              <div class="col-6 col-md-12 col-xl-5 mt-3">
                <h6 class="mb-2">{{ $userCount }}</h6>
              </div>
              <div class="col-6 col-md-12 col-xl-7 rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;background-color:rgba(4, 41, 84, 0.2)">
                <img src="{{ asset('assets/images/sidbr-icon/dashbord-student.png') }}" alt="Dashboard Icon" class="link-icon" style="color: #FFA201;">

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0 text-secondary">Student</h6>
            </div>
            <div class="row d-flex justify-content-between">
              <div class="col-6 col-md-12 col-xl-5 mt-3">
                <h6 class="mb-2">{{ $studentCount }}</h6>
              </div>
              <div class="col-6 col-md-12 col-xl-7 rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;background-color:rgba(255, 162, 1, 0.2)">
                <img src="{{ asset('assets/images/sidbr-icon/teacher.png') }}" alt="Dashboard Icon" class="link-icon" style="color: #FFA201;">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0 text-secondary">Class</h6>
            </div>
            <div class="row d-flex justify-content-between">
              <div class="col-6 col-md-12 col-xl-5 mt-3">
                <h6 class="mb-2">{{ $totalClasses }}</h6>
              </div>
              <div class="col-6 col-md-12 col-xl-7 rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;background-color:rgba(23, 176, 10, 0.2)">
                <img src="{{ asset('assets/images/sidbr-icon/dashbord-fee.png') }}" alt="Dashboard Icon" class="link-icon" style="color: #FFA201;" width="130">
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0 text-secondary">Collections</h6>
            </div>
            <div class="row d-flex justify-content-between">
              <div class="col-6 col-md-12 col-xl-5 mt-3">
                <h6 class="mb-2">90</h6>
              </div>
              <div class="col-6 col-md-12 col-xl-7 rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;background-color:rgba(229, 9, 9, 0.2)">
                <img src="{{ asset('assets/images/sidbr-icon/dashbord-feeC.png') }}" alt="Dashboard Icon" class="link-icon" style="color: #FFA201;" width="130">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/dashboard.js') }}"></script>

@endpush