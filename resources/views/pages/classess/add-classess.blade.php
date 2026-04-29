@extends('layouts.master')
@section('title', 'Add Class')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
@include('pages.includes.messages')

<p class="addText">Add Class</p>

<div class="row mt-2">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form id="signupForm" action="{{ route('class.store') }}" method="POST">
                    @csrf
                    <div class="row mb-5">
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            <label for="class_name" class="form-label"> <strong>Class Name</strong> <span class="spanMandatory">*</span></label>
                            <input id="class_name" class="form-control border border-dark" name="class_name" value="{{ old('class_name') }}" type="text" placeholder="Enter the Class Name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            <label for="section" class="form-label"> <strong>Section Name</strong> <span class="spanMandatory">*</span></label>
                            <input id="section" class="form-control border border-dark" name="section" value="{{ old('section') }}" type="text" placeholder="Enter the Section Name">
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-3 ">
                            <label for="shift" class="form-label"><strong>Shift</strong> <span class="spanMandatory">*</span></label>
                            <select class="form-select  border border-dark" id="shift" value="{{old('shift')}}" name="shift">
                                <option value="" selected disabled>- Please Select -</option>
                                <option value="morning" {{ old('shift') == 'morning' ? 'selected' : ''}}>Morning</option>
                                <option value="evening" {{ old('shift') == 'evening' ? 'selected' : ''}}>Evening</option>
                                <option value="online" {{ old('shift') == 'online' ? 'selected' : ''}}>Online</option>
                            </select>
                        </div>

                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <div class="me-2 mb-3">
                            <a href="javascript:void(0);"
                                onclick="confirmCancel('{{ route('class.index') }}')"
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
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>

@endpush