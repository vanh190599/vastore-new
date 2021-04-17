@extends('admin.layout.main')
@section('title')
    Danh sách quản trị viên
@endsection
@push('scripts')

@endpush
@inject('CGlobal', 'App\Library\CGlobal' )
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom" style="min-height: 1000px; margin-top: -51px">
                    <div class="card-body p-0">
                        <!--begin::Wizard-->
                        <div class="wizard wizard-1" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="false">
                            <div class="wizard-nav">
                                <div class="wizard-steps p-8 p-lg-10">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Từ ngày</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg" name="name">
                                                <div class="fv-plugins-message-container"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Đến ngày</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg" name="name">
                                                <div class="fv-plugins-message-container"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Đến ngày</label>
                                                <select name="" id="" class="form-control form-control-solid form-control-lg" >
                                                    <option value="">Ngày</option>
                                                    <option value="">Tháng</option>
                                                    <option value="">Năm</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 d-flex align-items-center ">
                                            <button type="submit" class="btn btn-lg btn-primary btn-primary--icon">
                                                Thống kê
                                            </button>
                                        </div>
                                    </div>


                                </div>

                                <div>
                                    <div id="chartByDay"></div>
                                </div>

                                <div>
                                    <div id="chartByMonth"></div>
                                </div>

                            </div>

                        </div>
                        <!--end::Wizard-->
                    </div>
                    <!--end::Wizard-->
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function (){
            chartByDay()
            chartByMonth()

            function chartByDay(){
                let type = "day"
                $.ajax({
                    url: BASE_URL + '/admin/dashboard/chart',
                    method: 'get',
                    data: { type },
                    success: function (res) {
                        if (res.success === 1) {
                            let data = res.data.data
                            let cate = res.data.cate
                            let title = "Tổng số lượng đã bán theo ngày"
                            renderChart(data, cate, title, 'chartByDay')
                        } else {
                            //
                        }
                    },
                    error: function (res) {

                    },
                });
            }
            function chartByMonth(){
                let type = "month"
                $.ajax({
                    url: BASE_URL + '/admin/dashboard/chart',
                    method: 'get',
                    data: { type },
                    success: function (res) {
                        if (res.success === 1) {
                            let data = res.data.data
                            let cate = res.data.cate
                            let title = 'Tổng số lượng sản phẩm đã bán theo tháng'
                            renderChart(data, cate, title, 'chartByMonth')
                        } else {
                            //
                        }
                    },
                    error: function (res) {

                    },
                });
            }
        })

        function renderChart(data, cate, title, type) {
            var max = Math.max(...data) > 0 ? Math.max(...data) + 3 : 0
            var options = {
                series: [{
                    name: "Tổng số lượng",
                    data: data
                }],
                chart: {
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    height: 400
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight',
                    width: 1,
                    curve: 'smooth',
                },
                title: {
                    text: title,
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: cate,
                },
                yaxis: {
                    max: max
                }
            };

            var chart = new ApexCharts(document.querySelector("#"+type), options);
            chart.render();
        }
    </script>

@endpush
