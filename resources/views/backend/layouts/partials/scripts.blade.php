<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    function toggleFullscreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }
</script>

<!--begin: Vendor JS -->
<script src="{{ asset('assets/backend/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/datatables/responsive.dataTables.min.js') }}"></script>
<!--end: Vendor JS -->

<script>
    // Global Toastr options
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
    };

    // Global dark mode check
    window.isDark = document.documentElement.classList.contains('dark');

    // Global DataTables configuration defaults
    $.extend(true, $.fn.dataTable.defaults, {
        autoWidth: false,
        responsive: false,
        scrollX: true,
        language: {
            lengthMenu: "Show _MENU_ entries",
            search: "",
            searchPlaceholder: "Search..."
        }
    });
</script>

@stack('scripts')
