@extends('backend.master')

@section('title')
    {{ config('app.name') }} || User Management
@endsection

@section('content')
    <!--begin: Page Header Wrapper-->
    <div class="w-11/12 mx-auto flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <!--begin: Page Title Area-->
        <div>
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-gray-400 dark:text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Dashboard</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-gray-600 dark:text-gray-300 font-medium">Users</span>
            </nav>
            <!-- Page Description-->
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-2">
                User Management: View, search, and manage all users in the system.
            </p>
        </div>
        <!--end: Page Title Area-->

        <!--begin: Page Actions-->
        <div class="flex items-center gap-2">
            <a href="{{ route('users.create') }}"
                class="flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-xl text-sm font-medium transition-all shadow-lg shadow-primary-600/20">
                <i class="fa-solid fa-plus"></i>
                <span>Add New User</span>
            </a>
        </div>
        <!--end: Page Actions-->
    </div>
    <!--end: Page Header Wrapper-->

    <!--begin: Users Table Card-->
    <div
        class="w-11/12 mx-auto bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-card p-6">
        <!--begin: Table Wrapper-->
        <table id="users-table" class="w-full !border-b-0 divide-y divide-gray-100 dark:divide-gray-800 whitespace-nowrap">
            <!--begin: Table Head-->
            <thead>
                <tr
                    class="text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider px-4 py-3.5">
                    <th> Avatar</th>
                    <th> Name</th>
                    <th> Email</th>
                    <th> Phone</th>
                    <th> Status</th>
                    <th> Joined</th>
                    <th> Actions</th>
                </tr>
            </thead>
            <!--end: Table Head-->
            <!--begin: Table Body-->
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            </tbody>
            <!--end: Table Body-->
        </table>
        <!--end: Table Wrapper-->
    </div>
    <!--end: Users Table Card-->
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
