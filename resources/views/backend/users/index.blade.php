@extends('backend.master')

@section('title')
    {{ config('app.name') }} || User Management
@endsection

@section('content')
    <!--begin: Page Header-->
    <div class="page-header">
        <!--begin: Page Title Area-->
        <div class="page-title-box">
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-active">Users</span>
            </nav>
            <p class="page-description">
                User Management: View, search, and manage all users in the system.
            </p>
        </div>
        <!--end: Page Title Area-->
        <!--begin: Actions-->
        <div class="page-actions">
            <a href="{{ route('users.create') }}" class="btn-primary">
                <i class="fa-solid fa-plus"></i>
                <span>Add New User</span>
            </a>
        </div>
        <!--end: Actions-->
    </div>
    <!--end: Page Header-->

    <!--begin:Table Card-->
    <div class="card">
        <table id="users-table" class="table">
            <thead>
                <tr>
                    <th> Avatar</th>
                    <th> Name</th>
                    <th> Email</th>
                    <th> Phone</th>
                    <th> Status</th>
                    <th> Joined</th>
                    <th> Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- The table body will be populated by DataTables via AJAX --}}
            </tbody>
        </table>
    </div>
    <!--end: Table Card-->
@endsection

@push('scripts')
    <script>
        // Initialize DataTable with server-side processing
        $(document).ready(function() {
            const table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'avatar',
                        name: 'avatar',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
                order: [],
            });
        });

        //Change User Status (Toggle active/inactive)
        function changeStatus(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Change status?',
                text: 'Are you sure you want to toggle the status?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/user/status/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            toastr.success(res.message);
                            $('#users-table').DataTable().ajax.reload(null, false);
                        },
                        error: function() {
                            toastr.error('Failed to update status. Please try again.');
                            $('#users-table').DataTable().ajax.reload(null, false);
                        }
                    });
                } else {
                    // Reload to reset the toggle switch if cancelled
                    $('#users-table').DataTable().ajax.reload(null, false);
                }
            });
        }

        //Delete User with SweetAlert confirmation
        function deleteRecord(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/users/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            toastr.success(res.message);
                            $('#users-table').DataTable().ajax.reload(null, false);
                        },
                        error: function() {
                            toastr.error('Deletion failed. The record might be in use.');
                            $('#users-table').DataTable().ajax.reload(null, false);
                        }
                    });
                }
            });
        }
    </script>
@endpush
