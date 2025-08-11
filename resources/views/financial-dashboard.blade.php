<x-backend.layouts.master>
    <x-slot name="page_title">
        Financial Dashboard
    </x-slot>

    <div class="dashboard-container">
        <div class="header">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <!-- Title -->
            <h1 class="mb-2 mb-md-0">Financial</h1>

            <!-- Right Section: Filters -->
            <div class="d-flex align-items-center mt-3">
                <!-- Segmented Filters -->
                <div class="btn-group btn-group-toggle border rounded-pill overflow-hidden mr-3 mb-2" data-toggle="buttons">
                    <label class="btn m-0 active" id="btn-year">
                        <input type="radio" name="options" checked autocomplete="off" data-range="year"> Year-to-date
                    </label>
                    <label class="btn m-0" id="btn-quarter">
                        <input type="radio" name="options" autocomplete="off" data-range="quarter"> Past Quarter
                    </label>
                    <label class="btn m-0" id="btn-month">
                        <input type="radio" name="options" autocomplete="off" data-range="month"> Past Month
                    </label>
                </div>

                <!-- Date Range & Filter -->
                <div class="d-flex align-items-center">
                    <!-- Date Picker -->
                    <div class="input-group mr-2 mb-2" style="min-width: 240px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0">
                                <i class="fas fa-calendar-alt text-secondary"></i>
                            </span>
                        </div>
                        <input
                            type="text"
                            id="dateRange"
                            class="form-control border-left-0"
                            style="
                                background: #fff !important; border: 1px solid #ddd !important;"
                            readonly
                        />
                    </div>

                    <!-- Filter Button -->
                    <button
                        type="button"
                        class="btn btn-outline-secondary mb-2 d-flex align-items-center" style="border: 1px solid #D0D5DD; border-radius: 8px; width: 134px;">
                        <img src="{{ asset('image/icon/layer.png') }}" alt="" class="mr-2" style="width: 16px;">
                        Filters
                    </button>
                </div>
            </div>
        </div>



        </div>

    <div class="py-5">
        <!-- Financial Cards -->
        <div class="row mb-4" id="financials"></div>

        <!-- Subscriber Stats -->
        <div class="row mb-4" id="subscribers"></div>

        <!-- Revenue Chart -->
        <div class="card">
            <div class="card-header">
                <h5><strong>Revenue</strong></h5>
            </div>
            <div class="card-body">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    @push('css')
        <style>
            .btn-filter {
                @apply px-4 py-2 text-sm text-gray-600 hover:bg-purple-800 transition;
            }
            .active {
                @apply bg-purple-800 text-white font-semibold;
            }
        </style>

        <style>
            .card {
                border: 1px solid #D0D5DD;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            .card-body h6{
                font-size: 1.2 rem;
                font-weight: bold;
                color: #6B7280;
            }
            .card-body h5{
                font-size: 1.2 rem;
                font-weight: bold;
            }

            .card-body h3{
                font-weight: bold;
            }
            .daterangepicker {
                z-index: 1600 !important;
            }

            #dateRange {
                outline: none !important;
                transition: none !important;
                cursor: pointer; /* readonly input cursor দেখানোর জন্য */
            }

            /* input-group এর border clash এড়াতে */
            .input-group .form-control {
                background-color: white;
                border-left: none;
            }

            /* input-group-prepend এর icon styling */
            .input-group-prepend .input-group-text {
                background-color: white;
                border-right: none;
            }

            .daterangepicker  {
                display: none;
            }

            .daterangepicker  {
                background: #fff;
                z-index: 50000 !important;
                box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
            }

            .drp-buttons {
                display: flex;
                padding: 10px;
            }

            .dashboard-container .active {
                background-color: #3F1239;
                color: #fff;
            }
        </style>
    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script>
            $(function () {
                // Initialize date picker
                $('#dateRange').daterangepicker({
                    startDate: moment('2025-01-01'),
                    endDate: moment('2025-06-18'),
                    locale: {
                        format: 'DD/MM/YYYY'
                    }
                });

                $("#dateRange").on('click', function() {
                    $(".daterangepicker").css('display', 'block');
                });


                // Handle filter button clicks
                $('.filter-btn').on('click', function () {
                    $('.filter-btn').removeClass('active-filter');
                    $(this).addClass('active-filter');
                    let selected = $(this).data('range');
                    console.log("Filter selected:", selected);
                    // Optionally fetch chart/data based on selected filter
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // Fetch Financials
                $.get('/api/dashboard/financials', function(data) {
                    const cardMap = {
                        'monthly_subscribers': 'Monthly Subscribers',
                        'quarterly_subscribers': 'Quarterly Subscribers',
                        'half_year_subscribers': '6 Month Subscribers',
                        'yearly_subscribers': 'Yearly Subscribers'
                    };
                    let html = '';
                    $.each(data, function(key, value) {
                        html += `
                            <div class="col-md-3">
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body">
                                        <h6>${cardMap[key]}</h6>
                                        <h3>${value.count}</h3>
                                        <p style="font-size: 1rem; font-weight:500">SAR ${value.revenue.toLocaleString()}</p>
                                    </div>
                                </div>
                            </div>`;
                    });
                    $('#financials').html(html);
                });

                // Fetch Subscriber Activity
                $.get('/api/dashboard/subscribers', function(data) {
                    let html = `
                        <div class="col-md-4">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <h5 class="m-0">Total Subscribers</h5>
                                    <p style="color: #6B7280; font-size: 1rem; ">(within selected timeframe above)</p>
                                    <h3>${data.total}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <h5 class="m-0">Active Subscribers</h5>
                                    <p style="color: #6B7280; font-size: 1rem; ">(logged in within selected timeframe above)</p>
                                    <h3>${data.active}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <h5 class="m-0">Inactive Subscribers</h5>
                                    <p style="color: #6B7280; font-size: 1rem; ">(not logged in within selected timeframe)</p>

                                    <h3>${data.inactive}</h3>
                                </div>
                            </div>
                        </div>`;
                    $('#subscribers').html(html);
                });

                // Fetch Revenue Data for Chart
                // $.get('/api/dashboard/revenue', function(data) {
                //     const labels = Object.keys(data);
                //     const values = Object.values(data);

                //     new Chart(document.getElementById('revenueChart'), {
                //         type: 'bar',
                //         data: {
                //             labels: labels,
                //             datasets: [{
                //                 label: 'Revenue (SAR)',
                //                 data: values,
                //                 backgroundColor: '#4e73df'
                //             }]
                //         },
                //         options: {
                //             scales: {
                //                 y: {
                //                     beginAtZero: true,
                //                     ticks: {
                //                         callback: value => 'SAR ' + value.toLocaleString()
                //                     }
                //                 }
                //             }
                //         }
                //     });
                // });
                $.get('/api/dashboard/revenue', function(data) {
                    const labels = Object.keys(data);
                    const values = Object.values(data);

                    const ctx = document.getElementById('revenueChart').getContext('2d');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Revenue (SAR)',
                                data: values,
                                backgroundColor: '#3B82F6', // Tailwind Blue-500
                                borderRadius: 8,
                                barPercentage: 0.6,
                                categoryPercentage: 0.5
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const value = context.raw;
                                            return 'SAR ' + value.toLocaleString();
                                        }
                                    }
                                },
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            if (value >= 1000000) return 'SAR ' + (value / 1000000) + 'M';
                                            if (value >= 1000) return 'SAR ' + (value / 1000) + 'k';
                                            return 'SAR ' + value;
                                        },
                                        stepSize: 200000,
                                        color: '#6b7280'
                                    },
                                    grid: {
                                        color: '#e5e7eb'
                                    }
                                },
                                x: {
                                    ticks: {
                                        color: '#374151'
                                    },
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                });

            });
        </script>
    @endpush
</x-backend.layouts.master>
