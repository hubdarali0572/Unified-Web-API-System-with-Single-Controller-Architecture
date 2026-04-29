@extends('layouts.master')
@section('title', 'Add Student')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

@include('pages.includes.messages')

<div class="d-flex justify-content-between align-items-center mb-1">
  <div>
    <p class="heading-title">Admission Form</p>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <!-- Tab Content -->
        <form id="signupForm" action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row mb-3">
            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
              <label for="first_name" class="form-label"><strong>First Name</strong> <span style="color: red;">*</span></label>
              <input id="first_name" class="form-control border border-dark" value="{{ old('first_name') }}" name="first_name" type="text" placeholder="Enter first name" required>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
              <label for="last_name" class="form-label"><strong>Last Name</strong> <span style="color: red;">*</span></label>
              <input id="last_name" class="form-control border border-dark" name="last_name" value="{{ old('last_name') }}" type="text" placeholder="Enter last name" required>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
              <label for="father_name" class="form-label"><strong>Father Name</strong> <span style="color: red;">*</span></label>
              <input id="father_name" class="form-control border border-dark" name="father_name" type="text" value="{{old('father_name')}}" placeholder="Enter father's name" required>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
              <label for="email" class="form-label"><strong>Email</strong> <span style="color: red;">*</span></label>
              <input id="email" class="form-control border border-dark" name="email" type="text" value="{{old('email')}}" placeholder="Enter email" required>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
              <label for="age" class="form-label"><strong>Age</strong> <span style="color: red;">*</span></label>
              <input id="age" class="form-control border border-dark" name="age" type="text" value="{{old('age')}}" placeholder="Enter age" required>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
              <label for="phone" class="form-label"><strong>Phone</strong> <span style="color: red;">*</span></label>
              <input id="phone" class="form-control border border-dark" name="phone" type="text" value="{{old('age')}}" placeholder="Enter phone" required>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
              <label for="dob" class="form-label"><strong>Date of Birth</strong><span style="color:red;">*</span></label>
              <div class="input-group border border-dark rounded">
                <input type="text" class="form-control flatpickr" name="dob" id="dob" placeholder="Enter date of birth" data-input value="{{ old('dob') }}">
                <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-center align-items-center mb-3">
            <div class="me-2 mb-3">
              <a href="javascript:void(0);"
                onclick="confirmCancel('{{ route('students.index') }}')"
                class="buttonBase cancelButton"
                title="Cancel">
                Cancel
              </a>
            </div>
            <div class="me-2 mb-3">
              <button type="submit"
                class="buttonBase submitButton"
                title="Submit">
                Submit
              </button>
            </div>
          </div>
      </div>
    </div>
  </div>
  </form>
</div>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/form-validation.js') }}"></script>

<script src="{{ asset('assets/js/flatpickr.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endpush