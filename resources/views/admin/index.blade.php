@extends('admin.layouts.main')
@section('content')
    <x-flash-message />

    <div class="card mb-3 mt-3">
        <div class="card-body">
            <div class="row">
                <x-dashboardfinance-card bg_color_class='bg-primary-subtle' icon_class='bi bi-check2-circle'
                    text_color_class='text-primary' risk_label='Total Application' :left_value="$status_counts['total'] ?? 0" />
                <x-dashboardfinance-card bg_color_class='bg-success-subtle' icon_class='bi bi-patch-check'
                    text_color_class='text-success' risk_label='Total Approved' :left_value="$status_counts['approved'] ?? 0" />

                <x-dashboardfinance-card bg_color_class='bg-warning-subtle' icon_class='bi bi-exclamation-circle'
                    text_color_class='text-warning' risk_label='Total Verifying' :left_value="$status_counts['pending'] ?? 0" />
                <x-dashboardfinance-card bg_color_class='bg-danger-subtle' icon_class='bi bi-x-circle'
                    text_color_class='text-danger' risk_label='Total Reject' :left_value="$status_counts['rejected'] ?? 0" />

            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-12 col-md-12 mt-3">
            <div class="card">
                <div class="card-header d-flex flex-between-center py-2 border-bottom">
                    <h6 class="mb-0">Total Medicine</h6>
                    <div class="dropdown font-sans-serif btn-reveal-trigger"><button
                            class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal"
                            type="button" id="dropdown-most-leads" data-bs-toggle="dropdown" data-boundary="viewport"
                            aria-haspopup="true" aria-expanded="false"><span
                                class="fas fa-ellipsis-h fs-11"></span></button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-most-leads"><a
                                class="dropdown-item" href="#!">View</a><a class="dropdown-item"
                                href="#!">Export</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger"
                                href="#!">Remove</a>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="row align-items-center">
                        <div class="col-md-5 col-xxl-12 mb-xxl-1">
                            <div class="position-relative">

                                <div class="echart-most-leads my-2" data-echart-responsive="true"
                                    _echarts_instance_="ec_1758729441830"
                                    style="user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); position: relative;">
                                    <div
                                        style="position: relative; width: 568px; height: 202px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                                        <canvas data-zr-dom-id="zr_0" width="710" height="252"
                                            style="position: absolute; left: 0px; top: 0px; width: 568px; height: 202px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                                    </div>
                                    <div class=""
                                        style="position: absolute; display: block; border-style: solid; white-space: nowrap; z-index: 9999999; box-shadow: rgba(0, 0, 0, 0.2) 1px 2px 10px; background-color: rgb(249, 250, 253); border-width: 1px; border-radius: 4px; color: rgb(11, 23, 39); font: 14px / 21px &quot;Microsoft YaHei&quot;; padding: 7px 10px; top: 0px; left: 0px; transform: translate3d(241px, 122px, 0px); border-color: rgb(216, 226, 239); pointer-events: none; visibility: hidden; opacity: 0;">
                                        <strong>Other:</strong> 13.64%
                                    </div>
                                </div>
                                <div class="position-absolute top-50 start-50 translate-middle text-center">
                                    <p class="fs-10 mb-0 text-400 font-sans-serif fw-medium">Total</p>
                                    <p class="fs-6 mb-0 font-sans-serif fw-medium mt-n2">15k</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-md-7">
                            <hr class="mx-nx1 mb-0 d-md-none d-xxl-block">
                            <div class="d-flex flex-between-center border-bottom py-3 pt-md-0 pt-xxl-3">
                                <div class="d-flex"><img class="me-2" src="/assets/images/fabicon.ico" width="16"
                                        height="16" alt="...">
                                    <h6 class="text-700 mb-0">Project - 1 </h6>
                                </div>
                                <p class="fs-10 text-500 mb-0 fw-semi-bold">5200 vs 1052</p>
                                <h6 class="text-700 mb-0">54%</h6>
                            </div>
                            <div class="d-flex flex-between-center border-bottom py-3">
                                <div class="d-flex"><img class="me-2" src="/assets/images/fabicon.ico" width="16"
                                        height="16" alt="...">
                                    <h6 class="text-700 mb-0">Project - 2 </h6>
                                </div>
                                <p class="fs-10 text-500 mb-0 fw-semi-bold">5623 vs 4929</p>
                                <h6 class="text-700 mb-0">27%</h6>
                            </div>
                            <div class="d-flex flex-between-center border-bottom py-3">
                                <div class="d-flex"><img class="me-2" src="/assets/images/fabicon.ico" width="16"
                                        height="16" alt="...">
                                    <h6 class="text-700 mb-0">Project - 3 </h6>
                                </div>
                                <p class="fs-10 text-500 mb-0 fw-semi-bold">2535 vs 1486</p>
                                <h6 class="text-700 mb-0">4%</h6>
                            </div>
                            <div class="d-flex flex-between-center border-bottom py-3 border-bottom-0 pb-0">
                                <div class="d-flex"><img class="me-2" src="/assets/images/fabicon.ico" width="16"
                                        height="16" alt="...">
                                    <h6 class="text-700 mb-0">Project - 4 </h6>
                                </div>
                                <p class="fs-10 text-500 mb-0 fw-semi-bold">256 vs 189</p>
                                <h6 class="text-700 mb-0">13%</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 mt-3">
            <div class="card h-100">
                <div class="card-header d-flex flex-between-center border-bottom border-200 py-2">
                    <h5 class="mb-0">Month Bases Earning</h5>
                </div>
                <div class="card-body pt-0">
                    <canvas class="max-w-100" id="chartjs-bar-chart" style="width:100%; height:400px;"></canvas>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="col-12 col-md-12 mt-3">
        <div class="card h-100">
            <div class="card-header d-flex flex-between-center border-bottom border-200 py-2">
                <h5 class="mb-0">Month Bases Application</h5>
            </div>
            <div class="card-body pt-0">
                <canvas class="max-w-100" id="chartjs-bar-chart" style="width:100%; height:400px;"></canvas>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        document.addEventListener("livewire:init", () => {
            let divisionChart = null;

            Livewire.on("divisionWiseRiskChartUpdated", (chartData) => {
                console.log("Raw ChartData from Livewire:", chartData);

                setTimeout(() => {
                    const canvas = document.getElementById("divisionWiseRiskChartV2");
                    if (!canvas) {
                        console.error("Canvas element not found");
                        return;
                    }

                    const ctx = canvas.getContext("2d");

                    if (divisionChart) {
                        divisionChart.destroy();
                    }

                    const dataObj = Array.isArray(chartData) ? chartData[0] : chartData;

                    const labels = dataObj.labels || [];
                    const values = (dataObj.data || []).map(v => parseInt(v, 10));

                    console.log("Final Labels:", labels);
                    console.log("Final Values:", values);

                    divisionChart = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Risk',
                                data: values,
                                backgroundColor: [
                                    "rgba(255, 162, 162, 0.7)",
                                    "rgba(255, 184, 106, 0.7)",
                                    "rgba(187, 244, 81, 0.7)",
                                    "rgba(83, 234, 253, 0.7)",
                                    "rgba(218, 178, 255, 0.7)",
                                    "rgba(255, 223, 32, 0.7)",
                                    "rgba(94, 233, 181, 0.7)"
                                ],
                                borderColor: "rgba(0,0,0,0.1)",
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                }, 300);
            });
        });
    </script>

    <script>
        const chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const chartData = @json($chart_data);
        const chartConfig = {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: '',
                    data: chartData,
                    backgroundColor: [
                        utils.getSubtleColors().secondary, utils.getSubtleColors().warning, utils
                        .getSubtleColors().info,
                        utils.getSubtleColors().success, utils.getSubtleColors().info, utils
                        .getSubtleColors().primary,
                        utils.getSubtleColors().secondary, utils.getSubtleColors().warning, utils
                        .getSubtleColors().info,
                        utils.getSubtleColors().success, utils.getSubtleColors().info, utils
                        .getSubtleColors().primary
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    tooltip: chartJsDefaultTooltip(),
                    // legend: {
                    //     labels: {
                    //         // color: utils.getGrays()['500']
                    //     }
                    //     display: false
                    // }
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: utils.getGrays()['500']
                        },
                        grid: {
                            color: utils.getGrays()['300'],
                            drawBorder: false
                        }
                    },
                    y: {
                        ticks: {
                            color: utils.getGrays()['500']
                        },
                        grid: {
                            color: utils.getGrays()['300'],
                            drawBorder: false
                        }
                    }
                }
            }
        };
        barChartInit(chartConfig);
    </script>
@endsection
@endsection
