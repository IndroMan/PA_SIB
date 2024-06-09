@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
<div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <!--  Divclass 1 -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-6 mb-2 pb-2">
                            <span class="round-48 d-flex align-items-center justify-content-center rounded bg-danger-subtle">
                                <iconify-icon icon="solar:temperature-outline" class="fs-6 text-danger"></iconify-icon>
                            </span>
                            <h6 class="mb-0 fs-4">Temperature</h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-left mb-2">
                            <h4 class="mb-0 fw-medium">{{ $dataSensor->first()->temperature ?? 0 }} °C</h4>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100" style="height: 7px;">
                            <div class="progress-bar bg-danger"
                                style="width: {{ $dataSensor->first()->temperature ?? 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Divclass 2 -->
            <div class="col-lg-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-6 mb-2 pb-2">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-secondary-subtle">
                                    <iconify-icon icon="solar:football-outline" class="fs-6 text-secondary">
                                    </iconify-icon>
                                </span>
                                <h6 class="mb-0 fs-4">Humidity</h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-left mb-2">
                                <h4 class="mb-0 fw-medium">{{ $dataSensor->first()->humidity ?? 0 }} %</h4>
                            </div>
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="height: 7px;">
                                <div class="progress-bar bg-success"
                                    style="width: {{ $dataSensor->first()->humidity ?? 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Divclass 3 -->
            <div class="col-lg-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-6 mb-2 pb-2">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-secondary-subtle">
                                    <iconify-icon icon="solar:football-outline" class="fs-6 text-secondary">
                                    </iconify-icon>
                                </span>
                                <h6 class="mb-0 fs-4">Light Intensity</h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-left mb-2">
                                <h4 class="mb-0 fw-medium">{{ $dataSensor->first()->light_intensity ?? 0 }} Lux</h4>
                            </div>
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="height: 7px;">
                                <div class="progress-bar bg-warning"
                                    style="width: {{ $dataSensor->first()->light_intensity ?? 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Divclass 4 -->
            <div class="col-lg-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center gap-6 mb-0 pb-0">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-primary-subtle">
                                    <span class="fs-6 text-primary">ON</span>
                                    </span>
                                    <span class="mx-2"></span>
                                <h6 class="mb-0 fs-3">Heater Status</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center gap-6 mb-0 pb-0">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-primary-subtle">
                                    <span class="fs-6 text-primary">OFF</span>
                                </span>
                                <span class="mx-2"></span>
                                <h6 class="mb-0 fs-3">Lamp Status</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
            <div class="col-lg-12 d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Sensor Statistik</h5>
                            </div>
                            <div>
                                <select class="form-select">
                                    <option value="1">March 2024</option>
                                    <option value="2">April 2024</option>
                                    <option value="3">May 2024</option>
                                    <option value="4">June 2024</option>
                                </select>
                            </div>
                        </div>
                        <div id="revenue-forecast"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Row 3 -->
        <div class="row">
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold">Heater Activity Log</h5>
                        </div>
                        <ul class="timeline-widget mb-0 position-relative mb-n5">
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n1 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-primary flex-shrink-0 mt-2"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John
                                    Doe of $385.90</div>
                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-warning flex-shrink-0"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n6 fw-semibold">New sale
                                    recorded <a href="javascript:void(0)"
                                        class="text-primary d-block fw-normal ">#ML-3467</a>
                                </div>
                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-warning flex-shrink-0"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n6">Payment was made of $64.95
                                    to Michael</div>
                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-secondary flex-shrink-0"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n6 fw-semibold">New sale
                                    recorded <a href="javascript:void(0)"
                                        class="text-primary d-block fw-normal ">#ML-3467</a>
                                </div>
                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-danger flex-shrink-0"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n6 fw-semibold">Project meeting
                                </div>
                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-primary flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n6">Payment received from John
                                    Doe of $385.90</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold">Lamp Activity Log</h5>
                        </div>
                        <ul class="timeline-widget mb-0 position-relative mb-n5">
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n1 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-primary flex-shrink-0 mt-2"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John
                                    Doe of $385.90</div>
                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-warning flex-shrink-0"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n6 fw-semibold">New sale
                                    recorded <a href="javascript:void(0)"
                                        class="text-primary d-block fw-normal ">#ML-3467</a>
                                </div>
                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-warning flex-shrink-0"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n6">Payment was made of $64.95
                                    to Michael</div>
                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-secondary flex-shrink-0"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n6 fw-semibold">New sale
                                    recorded <a href="javascript:void(0)"
                                        class="text-primary d-block fw-normal ">#ML-3467</a>
                                </div>
                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-danger flex-shrink-0"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n6 fw-semibold">Project meeting
                                </div>
                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-primary flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n6">Payment received from John
                                    Doe of $385.90</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        $(function() {
            var chart = {
                series: [{
                        name: "Temperature",
                        data: [
                            @foreach ($dataSensor as $item)
                                {{ $item->temperature . ',' }}
                            @endforeach
                        ],
                    },
                    {
                        name: "Humidity",
                        data: [
                            @foreach ($dataSensor as $item)
                                {{ $item->humidity . ',' }}
                            @endforeach
                        ],
                    },
                    {
                        name: "Light Intensity",
                        data: [
                            @foreach ($dataSensor as $item)
                                {{ $item->light_intensity . ',' }}
                            @endforeach
                        ],
                    },
                ],
                chart: {
                    toolbar: {
                        show: false
                    },
                    type: "bar", // Change to "line" for a line chart
                    fontFamily: "inherit",
                    foreColor: "#AF47D2",
                    height: 270,
                    stacked: false, // Set to false for separate lines
                    offsetX: -15
                },

                colors: ["#D10363", "#3AA6B9", "#FFDB00"],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        barHeight: "60%",
                        columnWidth: "15%",
                        borderRadius: [6],
                        borderRadiusApplication: "end",
                        borderRadiusWhenStacked: "all",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: false,
                },
                grid: {
                    show: true,
                    padding: {
                        top: 0,
                        bottom: 0,
                        right: 0,
                    },
                    borderColor: "rgba(0,20,200,0.05)",
                    xaxis: {
                        lines: {
                            show: true,
                        },
                    },
                    yaxis: {
                        lines: {
                            show: true,
                        },
                    },
                },
                yaxis: {
                    min: -5,
                    max: 5,
                },
                xaxis: {
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "July",
                        "Aug",
                        "Sep",
                        "Okt",
                        "Nov",
                    ],
                    labels: {
                        style: {
                            fontSize: "13px",
                            colors: "#adb0bb",
                            fontWeight: "400"
                        },
                    },
                },
                yaxis: {
                    tickAmount: 4,
                },
                tooltip: {
                    theme: "white",
                },
            };

            var chart = new ApexCharts(
                document.querySelector("#revenue-forecast"),
                chart
            );
            chart.render();

            // -----------------------------------------------------------------------
            // Total Income
            // -----------------------------------------------------------------------
            var customers = {
                chart: {
                    id: "sparkline3",
                    type: "line",
                    fontFamily: "inherit",
                    foreColor: "#adb0bb",
                    height: 60,
                    sparkline: {
                        enabled: true,
                    },
                    group: "sparklines",
                },
                series: [{
                    name: "Income",
                    color: "var(--bs-danger)",
                    data: [30, 25, 35, 20, 30, 40],
                }, ],
                stroke: {
                    curve: "smooth",
                    width: 2,
                },
                markers: {
                    size: 0,
                },
                tooltip: {
                    theme: "dark",
                    fixed: {
                        enabled: true,
                        position: "right",
                    },
                    x: {
                        show: false,
                    },
                },
            };
            new ApexCharts(document.querySelector("#total-income"), customers).render();
            window.setInterval(inicallbackfunction, 5000)
        })
    </script>
    <script>
        window.addEventListener('load', function() {
            const url = 'wss://sa201a17.ala.asia-southeast1.emqxsl.com:8084/mqtt'
            const options = {
                clean: true,
                connectTimeout: 4000,
                clientId: 'mqtt-panel-iot',
                username: 'nicky',
                password: 'nicky',
                ca: `-----BEGIN CERTIFICATE-----
            MIIDrzCCApegAwIBAgIQCDvgVpBCRrGhdWrJWZHHSjANBgkqhkiG9w0BAQUFADBh
            MQswCQYDVQQGEwJVUzEVMBMGA1UEChMMRGlnaUNlcnQgSW5jMRkwFwYDVQQLExB3
            d3cuZGlnaWNlcnQuY29tMSAwHgYDVQQDExdEaWdpQ2VydCBHbG9iYWwgUm9vdCBD
            QTAeFw0wNjExMTAwMDAwMDBaFw0zMTExMTAwMDAwMDBaMGExCzAJBgNVBAYTAlVT
            MRUwEwYDVQQKEwxEaWdpQ2VydCBJbmMxGTAXBgNVBAsTEHd3dy5kaWdpY2VydC5j
            b20xIDAeBgNVBAMTF0RpZ2lDZXJ0IEdsb2JhbCBSb290IENBMIIBIjANBgkqhkiG
            9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4jvhEXLeqKTTo1eqUKKPC3eQyaKl7hLOllsB
            CSDMAZOnTjC3U/dDxGkAV53ijSLdhwZAAIEJzs4bg7/fzTtxRuLWZscFs3YnFo97
            nh6Vfe63SKMI2tavegw5BmV/Sl0fvBf4q77uKNd0f3p4mVmFaG5cIzJLv07A6Fpt
            43C/dxC//AH2hdmoRBBYMql1GNXRor5H4idq9Joz+EkIYIvUX7Q6hL+hqkpMfT7P
            T19sdl6gSzeRntwi5m3OFBqOasv+zbMUZBfHWymeMr/y7vrTC0LUq7dBMtoM1O/4
            gdW7jVg/tRvoSSiicNoxBN33shbyTApOB6jtSj1etX+jkMOvJwIDAQABo2MwYTAO
            BgNVHQ8BAf8EBAMCAYYwDwYDVR0TAQH/BAUwAwEB/zAdBgNVHQ4EFgQUA95QNVbR
            TLtm8KPiGxvDl7I90VUwHwYDVR0jBBgwFoAUA95QNVbRTLtm8KPiGxvDl7I90VUw
            DQYJKoZIhvcNAQEFBQADggEBAMucN6pIExIK+t1EnE9SsPTfrgT1eXkIoyQY/Esr
            hMAtudXH/vTBH1jLuG2cenTnmCmrEbXjcKChzUyImZOMkXDiqw8cvpOp/2PV5Adg
            06O/nVsJ8dWO41P0jmP6P6fbtGbfYmbW0W5BjfIttep3Sp+dWOIrWcBAI+0tKIJF
            PnlUkiaY4IBIqDfv8NZ5YBberOgOzW6sRBc4L0na4UU+Krk2U886UAb3LujEV0ls
            YSEY1QSteDwsOoBrp+uvFRTp2InBuThs4pFsiv9kuXclVzDAGySj4dzp30d8tbQk
            CAUw7C29C79Fv1C5qfPrmAESrciIxpg0X40KPMbp1ZWVbd4=
            -----END CERTIFICATE-----`
            }
            const client = mqtt.connect(url, options)
            client.on('connect', function() {
                console.log('Connected')
                client.subscribe('/temperature', function(err) {
                    if (!err) {
                        client.publish('/temperature', 'Hello mqtt')
                    }
                })
            })

            // Untuk mengambil pesan / message dari topic temperature
            client.on('message', async function(topic, message) {
                if (topic == '/temperature') {
                    if (typeof message == 'object') {
                        console.log(message.toString())
                        const data = JSON.parse(message);
                        $('#temp-value').html(data.temperature)
                        $('#humi-value').html(data.humidity)
                        $('#light-value').html(data.light_intensity)
                    }
                }
            })
        })
    </script>
@endpush()
