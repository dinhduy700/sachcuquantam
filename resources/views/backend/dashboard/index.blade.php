@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid dashboard-content-wrapper">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">{{ __('app.layouts.dashboard') }}</li>
        </ol>
      </nav>
    </div>

    <div class="col-12 d-inline-flex justify-content-between align-items-center mb-4">
      <div class="content-title">
        <h3>{{ __('app.welcome-back') }}</h3>
        <!-- <p class="mb-0">{{ __('app.welcome-quote') }}</p> -->
      </div>

      <div class="content-date d-flex align-items-center">
        <div class="date d-flex align-items-start">
          <div class="date-body text-end">
            <label>Hôm nay</label>
            <h6>{{date('d-m-Y')}}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <p class="card-title">Tổng đơn hàng đã giao</p>
              <h4 class="card-value fw-bold">{{count($countOrder)}}</h4>
              <!-- <small class="card-desc">đơn hàng</small> -->
            </div>

            <div class="col-sm-6 col-md-3">
              <p class="card-title">Tổng sản phẩm</p>
              <h4 class="card-value fw-bold">{{count($countProduct)}}</h4>
              <!-- <small class="card-desc">are represented as fairly standardized skills in a relatively constant environment.</small> -->
            </div>

            <div class="col-sm-6 col-md-3">
              <p class="card-title">Tổng doanh thu</p>
              <h4 class="card-value fw-bold">{{number_format($countRevenue)}}</h4>
              <!-- <small class="card-desc">represents the total amount of time users interact with a specific dimension item.</small> -->
            </div>

            <div class="col-sm-6 col-md-3">
              <p class="card-title">Khách hàng</p>
              <h4 class="card-value fw-bold">{{count($countCustomer)}}</h4>
              <!-- <small class="card-desc">the total amount of time users interact with a specific dimension item.</small> -->
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-12 mb-3">
      <div class="row">
        <div class="col-mb-12 col-xl-6 mb-3">
          <div class="card">
            <div class="card-header d-flex d-block border-0 align-items-center justify-content-between py-3">
              <div class="mr-auto pr-3 mb-sm-0 mb-3">
                <h6 class="card-title m-0">Đánh giá mới nhất</h6>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                   <table class="table table-hover mb-0">
                      <thead>
                        <tr>
                          <th scope="col">Sản phẩm</th>
                          <th scope="col" class="text-end">Điểm</th>
                          <th scope="col" class="text-end">Nội dung</th>
                        </tr>
                      </thead>

                      <tbody>
                        @if(count($comments) > 0 )
                         @foreach($comments as $row)
                        <tr>
                          <td>
                            <p>{{$row->product->product_name}}</p>
                          </td>
                          <td class="text-end">{{$row->score}}</td>
                          <td class="text-end">{{$row->review_content}}</td>
                        </tr>
                         @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>

            <!-- <div class="card-body">
              <div class="row">
                <div class="col-sm-8 col-md-8">
                  <div class="flot-chart-wrapper">
                    <canvas id="jsChartLine" class="flot-chart"></canvas>
                  </div>
                </div>

                <div class="col-sm-4 col-md-4">

                </div>
              </div>
            </div> -->
            <!-- <div class="card-body-footer d-flex justify-content-around text-center">
              <div>
                <label class="m-0 fs-10px text-uppercase font-weight-bold tx-spacing-1">Orders</label>
                <h4>$33.50</h4>
              </div>
              <div>
                <label class="m-0 fs-10px text-uppercase font-weight-bold tx-spacing-1">Returns</label>
                <h4>-$0</h4>
              </div>
              <div>
                <label class="m-0 fs-10px text-uppercase font-weight-bold tx-spacing-1">Total sales</label>
                <h4>$33.50</h4>
              </div>
            </div> -->
          </div>
        </div>

        <div class="col-mb-12 col-xl-6">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header border-0 py-3">
                  <div class="mr-auto pr-3 mb-sm-0 mb-3">
                    <h6 class="card-title m-0">Top 6 Sản phẩm bán chạy</h6>
                  </div>
                </div>

                <div class="card-body">
                <div class="table-responsive">
                   <table class="table table-hover mb-0">
                      <thead>
                        <tr>
                          <th scope="col">Sản phẩm</th>
                          <th scope="col" class="text-end">Số lượng đã bán</th>
                        </tr>
                      </thead>

                      <tbody>
                        @if(count($topProducts) > 0 )
                         @foreach($topProducts as $row)
                        <tr>
                          <td>
                            <p>{{$row->product_name}}</p>
                          </td>
                          <td class="text-end">{{$row->quantity}}</td>
                        </tr>
                         @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
          </div>
        </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 mb-3">
      <div class="card">
        <div class="card-header border-0 py-3">
          <div class="mr-auto pr-3 mb-sm-0 mb-3">
            <h6 class="card-title m-0">Đơn hàng mới nhất</h6>
          </div>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover mg-b-0">
              <thead>
                <tr>
                  <th>Đơn hàng</th>
                  <th>Khách hàng</th>
                  <th>Ngày đặt</th>
                  <th>Tổng thanh toán</th>
                  <th>Trạng thái</th>
                  <th>Chi tiết</th>
                </tr>
              </thead>

              <tbody>
              @if(count($orders) > 0 )
               @foreach($orders as $row)
                  <tr>
                    <td>
                      <a href="javascript: void(0);" class="text-body font-weight-bold">#{{$row->order_code}}</a>
                    </td>
                    <td>{{$row->buyer_name}}</td>
                    <td>{{$row->created_at}}</td>
                    <td>{{number_format($row->total_amount)}}</td>
                    <td>
                      {!!getStatusOrder($row->order_status)!!}
                    </td>
                    <td>
                      <a href="{{ route('admin.orders.edit', $row->id) }}" class="btn btn-primary btn-sm btn-rounded">
                        Xem chi tiết
                      </a>
                    </td>
                  </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $(document).ready(function () {
    initChart();
  });

  // Line
  function initChart() {
    var chartLine = document.getElementById('jsChartLine');

    if (!chartLine) {
      return
    }
    var chartLine2D = chartLine.getContext('2d');

    new Chart(chartLine2D, {
      type: 'line',
      fill: false,
      data: {
        labels: ['00:00', '08:00', '11:00', '15:00', '19:00', '23:00'],
        datasets: [{
          data: [0, 15, 18, 40, 50, 90],
          borderColor: '#f10075',
          borderWidth: 1,
        }]
      },
      options: {
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });
  }
</script>
@endpush