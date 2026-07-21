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
{{-- ckeditor5 --}}
<script src="{{ asset('assets/backend/vendor/ckeditor5/ckeditor.js') }}"></script>
<!--end: Vendor JS -->

<script>
    // Starting Global Toastr options
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
    };
    @if (Session::has('t-success'))
        toastr.success("{{ Session::get('t-success') }}");
    @endif
    @if (Session::has('t-error'))
        toastr.error("{{ Session::get('t-error') }}");
    @endif
    @if (Session::has('t-info'))
        toastr.info("{{ Session::get('t-info') }}");
    @endif
    @if (Session::has('t-warning'))
        toastr.warning("{{ Session::get('t-warning') }}");
    @endif
    //Ending Toastr options

    // Global dark mode check
    window.isDark = document.documentElement.classList.contains('dark');

    // Global DataTables configuration defaults
    $.extend(true, $.fn.dataTable.defaults, {
        autoWidth: false,
        responsive: false,
        scrollX: false,
        dom: "<'flex flex-col sm:flex-row justify-between items-center mb-4 gap-4'lf>" +
            "<'overflow-x-auto overflow-y-hidden w-full'tr>" +
            "<'flex flex-col sm:flex-row justify-between items-center mt-4 gap-4'ip>",
        language: {
            lengthMenu: "Show _MENU_ entries",
            search: "",
            searchPlaceholder: "Search..."
        }
    });
</script>

@stack('scripts')
