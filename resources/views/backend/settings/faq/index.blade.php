@extends('backend.master')

@section('title')
    {{ config('app.name') }} || FAQ Management
@endsection

@section('content')
    <!--begin: Page Header-->
    <div class="page-header">
        <!--begin: Page Title-->
        <div class="page-title">
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-active">FAQs</span>
            </nav>
            <p class="page-description">
                FAQ Management: View, search, and manage all FAQs in the system.
            </p>
        </div>
        <!--end: Page Title-->
        <!--begin: Actions-->
        <div class="page-actions">
            <a href="{{ route('faqs.create') }}" class="btn-primary">
                <i class="fa-solid fa-plus"></i>
                <span>Add New FAQ</span>
            </a>
        </div>
        <!--end: Actions-->
    </div>
    <!--end: Page Header-->

    <!--begin:Table Card-->
    <div class="card">
        <table id="faqs-table" class="table">
            <thead>
                <tr>
                    <th> Question</th>
                    <th> Answer</th>
                    <th> Status</th>
                    <th> Created At</th>
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
            const table = $('#faqs-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('faqs.index') }}",
                columns: [{
                        data: 'question',
                        name: 'question',
                    },
                    {
                        data: 'answer',
                        name: 'answer',
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

        // Change FAQ Status (Toggle active/inactive)
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
                        url: '/faq/status/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            toastr.success(res.message);
                            $('#faqs-table').DataTable().ajax.reload(null, false);
                        },
                        error: function() {
                            toastr.error('Failed to update status. Please try again.');
                            $('#faqs-table').DataTable().ajax.reload(null, false);
                        }
                    });
                } else {
                    // Reload to reset the toggle switch if cancelled
                    $('#faqs-table').DataTable().ajax.reload(null, false);
                }
            });
        }

        // Delete FAQ with SweetAlert confirmation
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
                        url: '/faqs/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            toastr.success(res.message);
                            $('#faqs-table').DataTable().ajax.reload(null, false);
                        },
                        error: function() {
                            toastr.error('Deletion failed. The record might be in use.');
                            $('#faqs-table').DataTable().ajax.reload(null, false);
                        }
                    });
                }
            });
        }
    </script>
@endpush

