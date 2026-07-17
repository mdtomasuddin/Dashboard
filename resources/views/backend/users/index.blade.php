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
            <!-- Page Description (Optional) -->
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
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                {{-- top margin-4 --}}
                <table id="users-table" class="min-w-full divide-y divide-gray-100 dark:divide-gray-800">
                    <!--begin: Table Head-->
                    <thead class="mt-[-5px]">
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
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    </tbody>
                </table>
            </div>
        </div>
        <!--end: Table Wrapper-->
    </div>
    <!--end: Users Table Card-->
@endsection

@push('scripts')
    <!--begin: DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css">

    <!--begin: SweetAlert2 & Toastr -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!--begin: DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>

    <style>
        .dt-length select {
            border: 1px solid #e5e7eb !important;
            border-radius: 0.375rem !important;
            padding: 0.25rem 1.5rem 0.25rem 0.5rem !important;
            background-color: transparent !important;
        }

        .dt-search input {
            border: 1px solid #e5e7eb !important;
            border-radius: 0.375rem !important;
            padding: 0.25rem 0.5rem !important;
            background-color: transparent !important;
        }

        .dark .dt-length select,
        .dark .dt-search input {
            border-color: #374151 !important;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Toastr options
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
            };

            const isDark = document.documentElement.classList.contains('dark');

            // Initialize DataTable
            const table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                language: {
                    lengthMenu: "Show _MENU_ entries",
                    search: "",
                    searchPlaceholder: "Search..."
                },
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'avatar',
                        name: 'avatar',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
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
                        className: 'text-center',
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
                        className: 'text-center',
                    }
                ],
                order: [],
            });
        });

        /**
         * Change User Status (Toggle active/inactive)
         */
        function changeStatus(event, id) {
            event.preventDefault();

            Swal.fire({
                title: 'Update Status?',
                text: 'Are you sure you want to change the status of this user?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#4e73df',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/user/status/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            toastr.success(res.message || 'Status updated successfully');
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

        /**
         * Delete User with SweetAlert confirmation
         */
        function deleteRecord(event, id) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'All associated data will be lost forever!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/users/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            toastr.success(res.message || 'User deleted successfully');
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
