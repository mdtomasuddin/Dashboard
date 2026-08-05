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
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('assets/backend/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/summernote/summernote-lite.min.js') }}"></script>
<!--end: Vendor JS -->

<script>
    // Global Lenis Smooth Scroll Initialization
    document.addEventListener('DOMContentLoaded', () => {
        const mainScrollEl = document.querySelector('main');
        if (mainScrollEl && typeof Lenis !== 'undefined') {
            window.lenis = new Lenis({
                wrapper: mainScrollEl,
                content: mainScrollEl.firstElementChild,
                smoothWheel: true,
                duration: 1.2,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            });

            function raf(time) {
                window.lenis.raf(time);
                requestAnimationFrame(raf);
            }

            requestAnimationFrame(raf);
        }
    });

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
