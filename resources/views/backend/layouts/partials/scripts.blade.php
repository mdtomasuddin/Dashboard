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
    // ─── Lenis Smooth Scroll ───────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('main-content');
        const content = document.getElementById('main-inner');
        const progressBar = document.getElementById('scroll-progress');
        const scrollTopBtn = document.getElementById('scroll-to-top');

        if (wrapper && content && typeof Lenis !== 'undefined') {
            window.lenis = new Lenis({
                wrapper: wrapper,
                content: content,
                smoothWheel: true,
                duration: 1.2,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                touchMultiplier: 1.5,
                infinite: false,
            });

            window.lenis.on('scroll', ({ scroll, limit }) => {
                const progress = limit > 0 ? (scroll / limit) * 100 : 0;
                if (progressBar) progressBar.style.width = progress + '%';
                if (scrollTopBtn) {
                    const visible = scroll > 200;
                    scrollTopBtn.style.opacity = visible ? '1' : '0';
                    scrollTopBtn.style.pointerEvents = visible ? 'auto' : 'none';
                }
            });

            function raf(time) {
                window.lenis.raf(time);
                requestAnimationFrame(raf);
            }
            requestAnimationFrame(raf);
        }
    });

    // ─── Toastr Options ────────────────────────────────────────────────────────
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

    // ─── Global Dark Mode ─────────────────────────────────────────────────────
    window.isDark = document.documentElement.classList.contains('dark');

    // ─── Custom Table Scrollbar (under the table) ─────────────────────────────
    /**
     * Injects a branded custom scrollbar BELOW the DataTable card.
     * Syncs with horizontal scroll — mouse drag + touch drag + click-to-jump.
     */
    function setupTableScrollbar(tableId) {
        const wrapper = document.getElementById(tableId + '_wrapper');
        if (!wrapper) return;

        const card = wrapper.closest('.card');
        const scrollEl = wrapper.querySelector('.dt-scroll-inner');
        if (!scrollEl || !card) return;

        // Don't double-init
        if (wrapper.querySelector('.dt-scrollbar-track')) return;

        // Build track + thumb
        const track = document.createElement('div');
        track.className = 'dt-scrollbar-track';
        track.setAttribute('role', 'scrollbar');
        track.setAttribute('aria-orientation', 'horizontal');
        track.innerHTML = '<div class="dt-scrollbar-thumb"></div>';
        scrollEl.insertAdjacentElement('afterend', track);

        const thumb = track.querySelector('.dt-scrollbar-thumb');

        function syncThumb() {
            const sw = scrollEl.scrollWidth;
            const cw = scrollEl.clientWidth;

            if (sw <= cw + 2) {
                track.style.display = 'none';
                return;
            }

            track.style.display = 'block';
            const thumbPct = Math.max((cw / sw) * 100, 12);
            const maxLeft  = 100 - thumbPct;
            const leftPct  = ((scrollEl.scrollLeft / (sw - cw)) * maxLeft);

            thumb.style.width = thumbPct + '%';
            thumb.style.left  = leftPct + '%';
        }

        scrollEl.addEventListener('scroll', syncThumb, { passive: true });
        window.addEventListener('resize', syncThumb);

        // ── Mouse drag ──────────────────────────────────────────────────────
        let drag = false, startX = 0, startScroll = 0;

        thumb.addEventListener('mousedown', e => {
            drag = true; startX = e.clientX; startScroll = scrollEl.scrollLeft;
            thumb.classList.add('dragging');
            e.preventDefault();
        });
        document.addEventListener('mousemove', e => {
            if (!drag) return;
            const dx       = e.clientX - startX;
            const movable  = track.clientWidth - thumb.clientWidth;
            const range    = scrollEl.scrollWidth - scrollEl.clientWidth;
            scrollEl.scrollLeft = startScroll + (dx / movable) * range;
        });
        document.addEventListener('mouseup', () => {
            drag = false;
            thumb.classList.remove('dragging');
        });

        // ── Touch drag ──────────────────────────────────────────────────────
        thumb.addEventListener('touchstart', e => {
            drag = true; startX = e.touches[0].clientX; startScroll = scrollEl.scrollLeft;
        }, { passive: true });
        document.addEventListener('touchmove', e => {
            if (!drag) return;
            const dx      = e.touches[0].clientX - startX;
            const movable = track.clientWidth - thumb.clientWidth;
            const range   = scrollEl.scrollWidth - scrollEl.clientWidth;
            scrollEl.scrollLeft = startScroll + (dx / movable) * range;
        }, { passive: true });
        document.addEventListener('touchend', () => { drag = false; });

        // ── Click on track to jump ──────────────────────────────────────────
        track.addEventListener('click', e => {
            if (e.target === thumb) return;
            const rect  = track.getBoundingClientRect();
            const ratio = (e.clientX - rect.left) / rect.width;
            scrollEl.scrollLeft = (scrollEl.scrollWidth - scrollEl.clientWidth) * ratio;
        });

        syncThumb();
    }

    // ─── Global DataTables Defaults ───────────────────────────────────────────
    $.extend(true, $.fn.dataTable.defaults, {
        autoWidth:  false,
        responsive: false,
        scrollX:    false,
        dom: "<'flex flex-col sm:flex-row justify-between items-center mb-4 gap-4'lf>" +
             "<'w-full overflow-x-auto dt-scroll-inner' t>" +
             "<'flex flex-col sm:flex-row justify-between items-center mt-4 gap-4'ip>",
        language: {
            lengthMenu:        "Show _MENU_ entries",
            search:            "",
            searchPlaceholder: "Search..."
        },
        initComplete: function(settings) {
            // Auto-init custom scrollbar for every DataTable
            const tableId = settings.nTable.id;
            if (tableId) {
                // Wrap the scroll container (DataTables wraps in .dataTables_wrapper)
                setTimeout(() => setupTableScrollbar(tableId), 50);
            }
        }
    });

    // Re-sync scrollbar on every draw (search / pagination / sort)
    $(document).on('draw.dt', function(e, settings) {
        const wrapper   = document.getElementById(settings.nTable.id + '_wrapper');
        if (!wrapper) return;
        const scrollEl  = wrapper.querySelector('.dt-scroll-inner');
        const track     = wrapper.querySelector('.dt-scrollbar-track');
        if (scrollEl && track) {
            scrollEl.scrollLeft = 0;
            scrollEl.dispatchEvent(new Event('scroll'));
        }
    });
</script>

@stack('scripts')
