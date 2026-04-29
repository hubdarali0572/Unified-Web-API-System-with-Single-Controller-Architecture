@extends('layouts.master')
@section('title', 'Add User')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
@include('pages.includes.messages')

<p class="addText">Add New User</p>

<div class="row mt-2">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form id="signupForm" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            <label for="name" class="form-label"><strong>Name</strong> <span class="spanMandatory">*</span></label>
                            <input id="name" class="form-control border border-dark" name="name" value="{{old('name')}}" type="text" placeholder="Enter User name">
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            <label for="email" class="form-label"><strong>Email</strong> <span class="spanMandatory">*</span></label>
                            <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="Enter email" class="form-control border border-dark">
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
        $('#school_id').on('change', function() {
            var schoolId = $(this).val();
            if (schoolId) {
                $.ajax({
                    url: '/get-school-addresses-instivio/' + schoolId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); // should log the array
                        $('#addressDiv').show();
                        $('#school_address_id')
                            .empty()
                            .append('<option value="" disabled selected>- Please Select -</option>');

                        $.each(data, function(key, value) {
                            $('#school_address_id').append(
                                '<option value="' + value.id + '">' + value.address_line1 + ' ' + value.address_line2 + '</option>'
                            );
                        });
                    },
                    error: function() {
                        alert('Error fetching school addresses.');
                    }
                });
            } else {
                $('#addressDiv').hide();
                $('#school_address_id').empty();
            }
        });
    });
</script>


@endpush