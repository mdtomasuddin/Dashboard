<!--begin: Tailwind Config Script-->
<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    primary: {
                        '50': '#fff7ed',
                        '100': '#ffedd5',
                        '200': '#fed7aa',
                        '300': '#fdba74',
                        '400': '#fb923c',
                        '500': '#f97316',
                        '600': '#ea580c',
                        '700': '#c2410c',
                        '800': '#9a3412',
                        '900': '#7c2d12',
                        '950': '#431407'
                    },
                    sidebar: {
                        light: '#ffffff',
                        dark: '#0f172a'
                    }
                },
                fontFamily: {
                    sans: ['Figtree', 'Inter', 'system-ui', '-apple-system', 'sans-serif']
                },
                boxShadow: {
                    'card': '0 1px 3px 0 rgba(0,0,0,0.04), 0 1px 2px -1px rgba(0,0,0,0.06)',
                    'card-hover': '0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.04)',
                    'nav': '0 1px 3px 0 rgba(0,0,0,0.05)',
                    'dropdown': '0 10px 40px rgba(0,0,0,0.12)'
                },
                animation: {
                    'fade-in': 'fadeIn 0.2s ease-out',
                    'slide-in': 'slideIn 0.3s ease-out',
                    'slide-down': 'slideDown 0.2s ease-out',
                    'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    'bounce-slow': 'bounce 2s infinite'
                },
                keyframes: {
                    fadeIn: {
                        '0%': {
                            opacity: '0',
                            transform: 'translateY(-10px)'
                        },
                        '100%': {
                            opacity: '1',
                            transform: 'translateY(0)'
                        }
                    },
                    slideIn: {
                        '0%': {
                            opacity: '0',
                            transform: 'translateX(-20px)'
                        },
                        '100%': {
                            opacity: '1',
                            transform: 'translateX(0)'
                        }
                    },
                    slideDown: {
                        '0%': {
                            opacity: '0',
                            transform: 'translateY(-10px) scaleY(0.95)'
                        },
                        '100%': {
                            opacity: '1',
                            transform: 'translateY(0) scaleY(1)'
                        }
                    }
                }
            }
        }
    }
</script>
<!--end: Tailwind Config Script-->

<!--begin::exam-->
<!--begin: Custom Styles-->
<style>
    ::-webkit-scrollbar {
        width: 5px;
        height: 6px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .dark ::-webkit-scrollbar-thumb {
        background: #334155;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .dark ::-webkit-scrollbar-thumb:hover {
        background: #475569;
    }

    .sidebar-transition {
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card:hover {
        transform: translateY(-4px);
    }

    .table-row-hover:hover {
        background-color: rgba(249, 115, 22, 0.04);
    }

    .dark .table-row-hover:hover {
        background-color: rgba(249, 115, 22, 0.08);
    }

    .badge-pulse {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    .progress-fill {
        transition: width 1s ease-in-out;
    }

    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }

    .dark .skeleton {
        background: linear-gradient(90deg, #1e293b 25%, #334155 50%, #1e293b 75%);
        background-size: 200% 100%;
    }

    @keyframes shimmer {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }

    [x-cloak] {
        display: none !important;
    }

    /* Sidebar Navigation Styles */
    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.15s ease;
        color: #64748b;
        text-decoration: none;
    }

    .dark .nav-link {
        color: #94a3b8;
    }

    .nav-link:hover {
        background-color: rgba(241, 245, 249, 0.6);
        color: #1e293b;
    }

    .dark .nav-link:hover {
        background-color: rgba(30, 41, 59, 0.6);
        color: #e2e8f0;
    }

    .nav-link.active {
        background-color: #fff7ed;
        color: #c2410c;
    }

    .dark .nav-link.active {
        background-color: rgba(249, 115, 22, 0.1);
        color: #fb923c;
    }

    .nav-link.active .nav-icon {
        background-color: #ffedd5;
        color: #ea580c;
    }

    .dark .nav-link.active .nav-icon {
        background-color: rgba(249, 115, 22, 0.2);
        color: #fb923c;
    }

    .nav-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        flex-shrink: 0;
        color: #94a3b8;
        transition: all 0.15s ease;
    }

    .dark .nav-icon {
        color: #64748b;
    }

    .nav-link:hover .nav-icon {
        color: #475569;
    }

    .dark .nav-link:hover .nav-icon {
        color: #cbd5e1;
    }

    .nav-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.125rem 0.5rem;
        font-size: 0.7rem;
        font-weight: 700;
        border-radius: 9999px;
        background-color: #fff7ed;
        color: #c2410c;
        margin-left: auto;
    }

    .dark .nav-badge {
        background-color: rgba(249, 115, 22, 0.15);
        color: #fb923c;
    }

    .nav-badge.badge-new {
        background-color: #f0fdf4;
        color: #16a34a;
    }

    .dark .nav-badge.badge-new {
        background-color: rgba(22, 163, 74, 0.15);
        color: #4ade80;
    }

    .nav-toggle {
        cursor: pointer;
        background: none;
        border: none;
        font-family: inherit;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.15s ease;
        color: #64748b;
        width: 100%;
    }

    .dark .nav-toggle {
        color: #94a3b8;
    }

    .nav-toggle:hover {
        background-color: rgba(241, 245, 249, 0.6);
        color: #1e293b;
    }

    .dark .nav-toggle:hover {
        background-color: rgba(30, 41, 59, 0.6);
        color: #e2e8f0;
    }

    .nav-toggle.active {
        background-color: #fff7ed;
        color: #c2410c;
    }

    .dark .nav-toggle.active {
        background-color: rgba(249, 115, 22, 0.1);
        color: #fb923c;
    }

    .nav-toggle.active .nav-icon {
        background-color: #ffedd5;
        color: #ea580c;
    }

    .dark .nav-toggle.active .nav-icon {
        background-color: rgba(249, 115, 22, 0.2);
        color: #fb923c;
    }

    .nav-arrow {
        font-size: 0.7rem;
        transition: transform 0.2s ease;
        color: #94a3b8;
    }

    .nav-arrow.rotated {
        transform: rotate(0deg);
    }

    .nav-arrow:not(.rotated) {
        transform: rotate(-90deg);
    }

    .nav-submenu {
        margin-top: 0.25rem;
        margin-left: 1rem;
        padding-left: 1rem;
        border-left: 2px solid #e2e8f0;
    }

    .dark .nav-submenu {
        border-left-color: #334155;
    }

    .nav-sub-link {
        padding: 0.375rem 0.75rem;
        font-size: 0.8125rem;
        border-radius: 0.5rem;
        color: #64748b;
    }

    .dark .nav-sub-link {
        color: #94a3b8;
    }

    .nav-sub-link:hover {
        background-color: rgba(241, 245, 249, 0.6);
        color: #1e293b;
    }

    .dark .nav-sub-link:hover {
        background-color: rgba(30, 41, 59, 0.6);
        color: #e2e8f0;
    }

    .sub-icon {
        width: 1.25rem;
        text-align: center;
        font-size: 0.7rem;
        color: #94a3b8;
        flex-shrink: 0;
        transition: color 0.15s ease;
    }

    .nav-sub-link:hover .sub-icon {
        color: #f97316;
    }

    .dark .sub-icon {
        color: #64748b;
    }

    .dark .nav-sub-link:hover .sub-icon {
        color: #fb923c;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        .print-only {
            display: block !important;
        }
    }

    /* DataTable Custom Styles */
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
        color: #f3f4f6 !important;
    }

    .dark .dt-length select option {
        background-color: #1f2937 !important;
        color: #f3f4f6 !important;
    }

    table.dataTable.no-footer {
        border-bottom: none !important;
    }

    /* DataTable Custom Styles */
</style>
<!--end: Custom Styles-->
<!--end::exam-->

<!--begin: Vendor CSS -->
<link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendor/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendor/toastr/toastr.min.css') }}" />
<!--end: Vendor CSS -->
