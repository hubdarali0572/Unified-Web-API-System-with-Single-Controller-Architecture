@extends('layouts.master')
@section('title', 'Add Staff')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
@include('pages.includes.messages')


<div class="row mt-2">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 text-center">
                        <label for="profileImageInput" style="cursor: pointer;">
                            <img id="profileImagePreview"
                                src="{{ isset($related) && $related->image ? asset($related->image) : asset('assets/images/others/download.png') }}"
                                class="rounded-circle shadow"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        </label>
                        @if ($related instanceof \App\Models\Student || $related instanceof \App\Models\Teacher)
                        <input type="file" name="image" id="profileImageInput" class="d-none" accept="image/*">
                        @endif
                    </div>

                    <div class="row mb-3">

                        @if ($user->user_type === 'superadmin')

                        <div class="col-md-6 mb-3">
                            <label class="mb-1"><strong>Name</strong></label>
                            <input type="text" name="name"
                                value="{{ old('name', $user->name) }}"
                                placeholder="Name"
                                class="form-control mb-2 border border-dark">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-1"><strong>Email</strong></label>
                            <input type="email" name="email" class="form-control border border-dark"
                                value="{{ old('email', $user->email ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-1"><strong>Old Password</strong></label>
                            <input type="password" name="password" maxlength="8"
                                placeholder="********" class="form-control mb-2 border border-dark">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-1"><strong>New Password</strong></label>
                            <input type="password" name="new_password" maxlength="8"
                                placeholder="New Password" class="form-control mb-2 border border-dark">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-1"><strong>Confirm Password</strong></label>
                            <input type="password" name="password_confirmation" maxlength="8"
                                placeholder="Confirm Password" class="form-control mb-2 border border-dark">
                        </div>

                        @else
                        <div class="col-md-6 mb-3">
                            <label class="mb-1"><strong>First Name</strong></label>
                            <input type="text" name="first_name" value="{{ old('first_name', $related->first_name ?? '') }}"
                                placeholder="First Name" class="form-control mb-2 border border-dark">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-1"><strong>Last Name</strong></label>
                            <input type="text" name="last_name" value="{{ old('last_name', $related->last_name ?? '') }}"
                                placeholder="Last Name" class="form-control mb-2 border border-dark">
                        </div>

                        {{-- ==== EMAIL ==== --}}
                        <div class="col-md-6 mb-3">
                            <label class="mb-1"><strong>Email</strong></label>
                            <input type="email" name="email" class="form-control border border-dark"
                                value="{{ old('email', $related->email ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3 phone-wrapper">
                            <label for="phone" class="form-label">
                                <strong>Phone No</strong> <span style="color: red;">*</span>
                            </label>
                            <div class="border border-dark d-flex" style="border-radius: 4px; overflow: hidden;">
                                <div class="d-flex align-items-center px-2 bg-white border-end" style="border-right: 1px solid #ccc;">
                                    <img src="{{ asset('assets/images/others/pakistan.png') }}" alt="Pakistan"
                                        style="width: 24px; height: 25px; margin-right: 4px;">
                                    <span style="color: #333; font-size: 14px;">+92</span>
                                    <input type="hidden" name="country_code" value="+92">
                                </div>
                                <div style="position: relative; flex-grow: 1;">
                                    <input id="phone" name="phone" type="text" maxlength="10"
                                        class="form-control border-0"
                                        placeholder="xxx xxxxxxx"
                                        value="{{ old('phone', $related->phone ?? '') }}"
                                        style="box-shadow: none; padding-left: 10px;">
                                </div>
                            </div>
                            <input type="hidden" id="fullPhoneNumber" name="full_phone" value="{{ old('full_phone', '+92') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-1"><strong>Address</strong></label>
                            <input type="text" name="address" value="{{ old('address', $related->address ?? '') }}"
                                placeholder="Address" class="form-control mb-2 border border-dark">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-1"><strong>Old Password</strong></label>
                            <input type="password" name="password" maxlength="8"
                                placeholder="********" class="form-control mb-2 border border-dark">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-1"><strong>New Password</strong></label>
                            <input type="password" name="new_password" maxlength="8"
                                placeholder="New Password" class="form-control mb-2 border border-dark">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-1"><strong>Confirm Password</strong></label>
                            <input type="password" name="password_confirmation" maxlength="8"
                                placeholder="Confirm Password" class="form-control mb-2 border border-dark">
                        </div>
                        @endif
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn text-white" style="background-color: #22C55E;">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('plugin-scripts')
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pickr/pickr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script src="{{ asset('assets/js/pickr.js') }}"></script>
<script src="{{ asset('assets/js/flatpickr.js') }}"></script>
<script>
    document.getElementById('profileImageInput').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('profileImagePreview').src = reader.result;
        }
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>

@endpush