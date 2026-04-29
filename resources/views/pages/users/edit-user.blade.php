@extends('layouts.master')
@section('title', 'Edit User')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
@include('pages.includes.messages')

<p class="addText">Edit The School</p>


<div class="row mt-2">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form id="signupForm" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="user_id" value="{{ $user->id }}">

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            <label for="name" class="form-label"><strong>Name</strong> <span class="spanMandatory">*</span></label>
                            <input id="name" class="form-control border border-dark" name="name" type="text" value="{{ old('name', $user->name) }}" placeholder="Enter school name">
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            <label for="email" class="form-label"><strong>Email</strong><span class="spanMandatory">*</span></label>
                            <input type="email" name="email" id="email" class="form-control border border-dark" value="{{ old('email', $user->email) }}">
                        </div>
                       
                    </div>

                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <div class="me-2 mb-3">
                            <a href="javascript:void(0);"
                                onclick="confirmCancel('{{ route('users.index') }}')"
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
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script>
$(document).ready(function() {

    function loadSchoolAddresses(schoolId, selectedAddressId = null) {
        if (!schoolId) {
            $('#addressDiv').hide();
            $('#school_address_id').empty();
            return;
        }

        $.ajax({
            // url: '/get-school-addresses/' + schoolId,
             url: '/get-school-addresses-instivio/' + schoolId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#addressDiv').show();
                $('#school_address_id').empty().append('<option value="" disabled selected>- Please Select -</option>');

                if (data.length === 0) {
                    $('#school_address_id').append('<option value="" disabled>No Branches Found</option>');
                }

                $.each(data, function(key, value) {
                    const selected = (value.id == selectedAddressId) ? 'selected' : '';
                    $('#school_address_id').append(
                        '<option value="' + value.id + '" ' + selected + '>' +
                        value.address_line1 + ' ' + value.address_line2 +
                        '</option>'
                    );
                });
            },
            error: function(xhr) {
                console.error(xhr.responseJSON);
                alert('Error fetching school addresses.');
            }
        });
    }

    // On school change
    $('#school_id').on('change', function() {
        const schoolId = $(this).val();
        loadSchoolAddresses(schoolId);
    });

    // Preload addresses for edit page
    const existingSchoolId = "{{ $user->school_id ?? '' }}";
    const existingAddressId = "{{ $user->school_address_id ?? '' }}";

    if (existingSchoolId) {
        loadSchoolAddresses(existingSchoolId, existingAddressId);
    }

});
</script>




@endpush