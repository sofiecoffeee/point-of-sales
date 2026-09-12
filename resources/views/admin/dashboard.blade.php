@extends('layout.app')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center justify-content-end w-100">
                <button class="btn-date-picker" type="button" id="date-picker-trigger">
                <i class="bi bi-calendar4-event"></i>
                <span id="selected-date-range">
                  {{ \Carbon\Carbon::parse($startDate)->format('F d, Y')}}
                  {{ \Carbon\Carbon::parse($endDate)->format('F d, Y')}}<span>
                <i class="bi bi-chevron-down ms-1"></i>
      </button>
        </div>

    <!-- TOP AREA: Quick Info Stat Cards Row (Full Width) -->
      <div class="col-12">
        <div class="row g-4">
          <!-- Stat Card 1: Green Alert Banner -->
          <div class="col-md-4">
            <div class="card alert-green-card">
              <div class="position-relative z-index-2">
                <span class="alert-green-badge">Update</span>
                <div class="alert-green-date">Feb 14th 2026</div>
                <div class="alert-green-text">Sales revenue increased 40% in 1 week</div>
              </div>
              <a href="#" class="alert-green-link z-index-2" id="alert-link-statistics">
                <span>See Statistics</span>
                <i class="bi bi-arrow-right"></i>
              </a>

              <!-- Inline SVG geometric decoration (Lime green 6-pointed star/asterisk with rounded caps) -->
              <svg class="alert-green-bg-shape" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g transform="translate(50,50)">
                  <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" />
                  <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" transform="rotate(60)" />
                  <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" transform="rotate(120)" />
                </g>
              </svg>
            </div>
          </div>

          <!-- Stat Card 2: Net Income -->
          <div class="col-md-4">
            <div class="card card-stat d-flex flex-column justify-content-between">
              <div>
                <div class="card-header">
                  <span class="stat-label">Net Income</span>
                  <div class="dropdown">
                    <button class="card-more-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                      aria-label="More Options" id="btn-more-income">
                      <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                      <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-repeat"></i> Refresh</a></li>
                      <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-arrow-down"></i> Export
                          Report</a></li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-eye-slash"></i> Hide Details</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="stat-value">{{ $netIncome }}</div>
                <div class="trend-badge trend-up">
                  <i class="bi bi-arrow-up-right"></i>
                  <span>+35% from last month</span>
                </div>
              </div>
              <div class="sparkline-container sparkline-card-footer">
                <div id="income-sparkline"></div>
              </div>
            </div>
          </div>

          <!-- Stat Card 3: Transaction -->
          <div class="col-md-4">
            <div class="card card-stat d-flex flex-column justify-content-between">
              <div>
                <div class="card-header">
                  <span class="stat-label">Transaction</span>
                  <div class="dropdown">
                    <button class="card-more-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                      aria-label="More Options" id="btn-more-return">
                      <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                      <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-repeat"></i> Refresh</a></li>
                      <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-arrow-down"></i> Export
                          Report</a></li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-eye-slash"></i> Hide Details</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="stat-value">{{ $transaction }}</div>
                <div class="trend-badge trend-down">
                  <i class="bi bi-arrow-down-left"></i>
                  <span>-24% from last month</span>
                </div>
              </div>
              <div class="sparkline-container sparkline-card-footer">
                <div id="return-sparkline"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END: TOP AREA -->

         <!-- START: Details Area (Transactions + Performance Charts) -->
        <div class="row g-4">
          <!-- Column: Revenue Chart (Full Width / Wider) -->
          <div class="col-12">
            <div class="card mb-0">
              <div class="card-header mb-2">
                <h2 class="card-title">Revenue</h2>
                <!-- Custom Static Legends -->
                <div class="d-flex gap-3 align-items-center">
                  <div class="chart-legend-item">
                    <span class="legend-dot bg-forest-medium"></span>
                    <span class="chart-legend-label">Income</span>
                  </div>
                  <div class="chart-legend-item">
                    <span class="legend-dot bg-lime-accent"></span>
                    <span class="chart-legend-label">Expenses</span>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-baseline gap-2 mb-3">
                <span class="stat-value-amount"></span>
                <span class="trend-badge trend-up fs-xs">+35% from last month</span>
              </div>
              <div id="revenue-chart"></div>
            </div>
          </div>

          <!-- Column: Transaction List -->
          <div class="col-md-7 d-flex flex-column">
            <div class="card h-100 flex-grow-1">
              <div class="card-header">
                <h2 class="card-title">Transaction</h2>
                <div class="dropdown">
                  <button class="card-more-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                    aria-label="More Options" id="btn-more-transaction">
                    <i class="bi bi-three-dots"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-funnel"></i> Filter Status</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-arrow-down"></i> Export CSV</a>
                    </li>
                  </ul>
                </div>
              </div>

              <!-- Transaction Items List -->
              <div class="transaction-list">
                <div class="transaction-item">
                  <div class="transaction-icon bg-forest-light text-lime">
                    <i class="bi bi-spotify"></i>
                  </div>
                  <div class="transaction-info">
                    <div class="transaction-name">Spotify Subscription</div>
                    <div class="transaction-date">Feb 14, 2026 • 12:40 PM</div>
                  </div>
                  <div class="transaction-amount text-main">-$15.00</div>
                </div>

                <div class="transaction-item">
                  <div class="transaction-icon bg-forest-light text-lime">
                    <i class="bi bi-paypal"></i>
                  </div>
                  <div class="transaction-info">
                    <div class="transaction-name">Paypal Transfer</div>
                    <div class="transaction-date">Feb 13, 2026 • 08:15 AM</div>
                  </div>
                  <div class="transaction-amount text-success">+$1,250.00</div>
                </div>

                <div class="transaction-item">
                  <div class="transaction-icon bg-forest-light text-lime">
                    <i class="bi bi-stripe"></i>
                  </div>
                  <div class="transaction-info">
                    <div class="transaction-name">Stripe Payout</div>
                    <div class="transaction-date">Feb 11, 2026 • 04:30 PM</div>
                  </div>
                  <div class="transaction-amount text-success">+$3,400.00</div>
                </div>

                <div class="transaction-item">
                  <div class="transaction-icon bg-forest-light text-lime">
                    <i class="bi bi-slack"></i>
                  </div>
                  <div class="transaction-info">
                    <div class="transaction-name">Slack Pro Workspace</div>
                    <div class="transaction-date">Feb 09, 2026 • 09:20 AM</div>
                  </div>
                  <div class="transaction-amount text-main">-$45.00</div>
                </div>
              </div>

            </div>
          </div>

          <!-- Column: Product Overview Progress -->
          <div class="col-md-5 d-flex flex-column">
            <div class="card h-100 flex-grow-1">
              <div class="card-header">
                <h2 class="card-title">Product Overview</h2>
                <div class="dropdown">
                  <button class="card-more-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                    aria-label="More Options" id="btn-more-products">
                    <i class="bi bi-three-dots"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-plus-lg"></i> Add Product</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Manage</a></li>
                  </ul>
                </div>
              </div>

              <div class="progress-container">
                <div class="progress-label-row">
                  <span class="progress-label">Product Launched</span>
                  <span class="progress-value">233</span>
                </div>
                <div class="progress" role="progressbar" aria-label="Product Launched Progress" aria-valuenow="65"
                  aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar bg-lime-accent w-65"></div>
                </div>
              </div>

              <div class="progress-container">
                <div class="progress-label-row">
                  <span class="progress-label">Ongoing Product</span>
                  <span class="progress-value">23</span>
                </div>
                <div class="progress" role="progressbar" aria-label="Ongoing Product Progress" aria-valuenow="20"
                  aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar bg-lime-accent opacity-50 w-50"></div>
                </div>
              </div>

              <div class="progress-container">
                <div class="progress-label-row">
                  <span class="progress-label">Product Sold</span>
                  <span class="progress-value">482</span>
                </div>
                <div class="progress" role="progressbar" aria-label="Product Sold Progress" aria-valuenow="85"
                  aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar bg-lime-accent w-85"></div>
                </div>
              </div>

              <div class="progress-container">
                <div class="progress-label-row">
                  <span class="progress-label">Product Returned</span>
                  <span class="progress-value">8</span>
                </div>
                <div class="progress" role="progressbar" aria-label="Product Returned Progress" aria-valuenow="10"
                  aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar bg-brand-orange w-38"></div>
                </div>
              </div>

              <div class="progress-container">
                <div class="progress-label-row">
                  <span class="progress-label">Product In Stock</span>
                  <span class="progress-value">1,420</span>
                </div>
                <div class="progress" role="progressbar" aria-label="Product In Stock Progress" aria-valuenow="75"
                  aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar bg-lime-accent w-75"></div>
                </div>
              </div>

              <div class="progress-container">
                <div class="progress-label-row">
                  <span class="progress-label">Pending Shipment</span>
                  <span class="progress-value">64</span>
                </div>
                <div class="progress" role="progressbar" aria-label="Pending Shipment Progress" aria-valuenow="45"
                  aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar bg-lime-accent opacity-50 w-45"></div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- END: Details Area -->
    </div>

    <script>

    const startDate = @json($startDate);
    const endDate = @json($endDate);

    document.getElementById('date-picker-trigger').addEventListener('click', function () {
    applyDateFilter(startDate, endDate);
    });

    function applyDateFilter(startDate, endDate) {
    const url = new URL(window.location.href);

    url.searchParams.set('start_date', startDate);
    url.searchParams.set('end_date', endDate);

    window.location.href = url.toString();
    }
    
    </script>
    
@endsection
