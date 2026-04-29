@extends('layouts.master')
@section('title', 'List of Users')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
@include('pages.includes.messages')

<div class="row align-items-center g-2 import-export">

    <div class="col-12 col-md-5">
        <p class="List-of-record">List of Users ({{ $totalUsers }})</p>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row align-items-center mb-3 g-2">

                    <div class="col-12 col-md-4 col-lg-5">
                        <div id="dataTableExample_length" class="d-flex align-items-center"></div>
                    </div>

                    <div class="col-12 col-md-8 col-lg-7">
                        <div class="d-flex justify-content-md-end align-items-center flex-wrap gap-2">

                            <a href="{{ route('users.create') }}">
                                <button type="button" class="custom-btn">
                                    <strong>+</strong>
                                </button>
                            </a>

                            <div id="dataTableExample_filter" class="d-flex align-items-center"></div>

                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="text-small align-middle">
                                <td class="py-1 px-3">{{ ucfirst($user->name) }}</td>

                                <td class="py-1 px-3">{{ $user->email }}</td>
                                <td class="py-1 px-3">{{ $user->user_type ?? 'User' }}</td>
                                <td class="py-1 px-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('users.edit', $user) }}"
                                            class="custom-action-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('users.destroy', $user->id) }}"
                                            method="POST" class="d-inline m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $user->id }})"
                                                class="custom-delete-btn" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>

@endpush

@push('plugin-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

@endpush