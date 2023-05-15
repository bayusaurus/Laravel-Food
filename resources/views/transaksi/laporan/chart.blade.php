@extends('layouts.admin')

@section('styles')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.j') }}s"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#tanggal').hide();

            $('#filter').on('click', function() {
                $('#tanggal').toggle();
            });
        });

        let backgroundColor = [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ];

        let hoverBackgroundColor = [
                        'rgba(255, 99, 132, 0.9)',
                        'rgba(255, 159, 64, 0.9)',
                        'rgba(255, 205, 86, 0.9)',
                        'rgba(75, 192, 192, 0.9)',
                        'rgba(54, 162, 235, 0.9)',
                        'rgba(153, 102, 255, 0.9)',
                        'rgba(201, 203, 207, 0.9)'
                    ];
        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        }

        new Chart(document.getElementById("transaksi-sukses-gagal"), {
            type: 'pie',
            data: {
            labels: ['Sukses', 'Batal'],
            datasets: [{
                    backgroundColor:['rgb(75, 192, 192)', 'rgb(255, 99, 132)'],
                    hoverBackgroundColor: ['rgba(75, 192, 192, 0.9)', 'rgba(255, 99, 132, 0.9)'] ,
                    hoverBorderColor: "rgba(0, 0, 0, 0.2)",
                data: [{!! $transaksiSukses !!}, {!! $transaksiGagal !!}]
            }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Total Transaksi Sukses dan Batal'
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
                
                responsive: true,
                maintainAspectRatio: false,
            }
        });
        
        new Chart(document.getElementById("transaksi-hari"), {
            type: 'doughnut',
            data: {
            labels: {!! $transaksiHariNama !!},
            datasets: [{
                backgroundColor: backgroundColor,
                    hoverBackgroundColor: hoverBackgroundColor,
                    hoverBorderColor: "rgba(0, 0, 0, 0.2)",
                data: {!! $transaksiHariTotal !!}
            }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Total Transaksi Berdasarkan Hari'
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
                
                responsive: true,
                maintainAspectRatio: false,
            }
        });


        new Chart(document.getElementById("transaksi-tanggal").getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! $transaksiTanggalNama !!},
                datasets: [{
                    data: {!! $transaksiTanggalTotal !!},
                    label: "Total Transaksi",
                    borderColor: "#3cba9f",
                    hoverBorderColor: "rgba(0, 0, 0, 0.2)",
                }],
            },
            options: {
                title: {
                    display: true,
                    text: 'Statistik Transaksi Berdasarkan Tanggal',
                },
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    displayColors: true,
                    caretPadding: 10,
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
                elements: {
                    line: {
                        tension: 0
                    }
                }
            },
        });


        new Chart(document.getElementById("transaksi-pelayan-item").getContext('2d'), {
            type: 'pie',
            data: {
                labels: {!! $namaPelayan !!},
                datasets: [{
                    data: {!! $transaksiPelayan !!},
                    backgroundColor: backgroundColor,
                    hoverBackgroundColor: hoverBackgroundColor,
                    hoverBorderColor: "rgba(0, 0, 0, 0.2)",
                }],
            },
            options: {
                title: {
                    display: true,
                    text: 'Total Item Unik yang di-Handle Pelayan dalam Transaksi',
                },
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    displayColors: true,
                    caretPadding: 10,
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
                cutoutPercentage: 80,
            },
        });

        new Chart(document.getElementById("transaksi-pelayan-kuantitas").getContext('2d'), {
            type: 'pie',
            data: {
                labels: {!! $namaPelayan !!},
                datasets: [{
                    data: {!! $kuantitasPelayan !!},
                    backgroundColor: backgroundColor,
                    hoverBackgroundColor: hoverBackgroundColor,
                    hoverBorderColor: "rgba(0, 0, 0, 0.2)",
                }],
            },
            options: {
                title: {
                    display: true,
                    text: 'Total Kuantitas Item yang di-Handle Pelayan dalam Transaksi',
                },
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    displayColors: true,
                    caretPadding: 10,
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
            },
        });

        new Chart(document.getElementById("transaksi-pelayan-harga").getContext('2d'), {
            type: 'polarArea',
            data: {
                labels: {!! $namaPelayan !!},
                datasets: [{
                    data: {!! $hargaPelayan !!},
                    backgroundColor: backgroundColor,
                    hoverBackgroundColor: hoverBackgroundColor,
                    hoverBorderColor: "rgba(0, 0, 0, 0.2)",
                }],
            },
            options: {
                title: {
                    display: true,
                    text: 'Total Harga Item yang di-Handle Pelayan dalam Transaksi',
                },
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    displayColors: true,
                    caretPadding: 10,
                    callbacks: {
                            label: function(tooltipItem, data) {
                            let label = data.labels[tooltipItem.index];
                            let datasetLabel = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            let formattedNumber = new Intl.NumberFormat('id').format(datasetLabel);
                            return label + ': Rp. ' + formattedNumber;
                            },
                        },
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
            },
        });

        // Bar chart
        new Chart(document.getElementById("transaksi-kasir-performa"), {
            type: 'bar',
            data: {
            labels: {!! $namaKasir !!},
            datasets: [
                {
                label: "Total Transaksi",
                backgroundColor: "#3e95cd",
                data: {!! $transaksiKasir !!}
                },
                {
                label: "Transaksi Sukses",
                backgroundColor: 'rgb(75, 192, 192)',
                data: {!! $transaksiKasirSukses !!}
                },
                {
                label: "Transaksi Batal",
                backgroundColor: 'rgb(255, 99, 132)',
                data: {!! $transaksiKasirBatal !!}
                }
            ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Statistik Transaksi Kasir'
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        new Chart(document.getElementById("transaksi-kasir-harga"), {
            type: 'horizontalBar',
            data: {
            labels: {!! $namaKasir !!},
            datasets: [
                    {
                    // label: "Population (millions)",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: {!! $transaksiKasirHarga !!}
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Total Harga yang di-Handle Kasir'
                },
                tooltips: {
                    callbacks: {
                            label: function(tooltipItem, data) {
                            let label = data.labels[tooltipItem.index];
                            let datasetLabel = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            let formattedNumber = new Intl.NumberFormat('id').format(datasetLabel);
                            return label + ': Rp. ' + formattedNumber;
                            },
                        },
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        
        let menu = {!! $transaksiMenuNama !!};
        var menuColor = [];
        menu.forEach(element => {
            menuColor.push(dynamicColors());
        });
        new Chart(document.getElementById("transaksi-menu"), {
            type: 'horizontalBar',
            data: {
            labels: menu,
            datasets: [
                    {
                    label: "Total (Porsi)",
                    backgroundColor: menuColor,
                    data: {!! $transaksiMenuKuantitas !!}
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Menu Terlaris'
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    </script>

@endsection

@section('sidebar')
    @include('layouts.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')
    <div class="container">

        <div class="text-center mt-2 mb-4 text-decoration-none">
            <h3 class="d-inline">{{ $title }}</h3>
            <button class="btn btn-sm btn-primary d-inline float-right mx-1" id="filter">Filter</button>
        </div>
        <div class="container" id="tanggal">
            <form action="{{ route('transaksi.laporan.chart') }}" method="get" id="form-filter">
                <div class="row d-flex justify-content-end mb-3">
                    <div class="form-group-row mr-3">
                        <label>Tanggal awal</label>
                        <input type="date" name="start_date" id="start-date" max="3000-12-31" min="2020-01-01"
                            class="form-control" required>
                    </div>
                    <div class="form-group-row">
                        <label>Tanggal akhir</label>
                        <input type="date" name="end_date" id="end-date" min="2020-01-01" max="3000-12-31"
                            class="form-control" required>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3"><button type="submit" id="submit-filter"
                        class="btn btn-primary">Terapkan</button>
                </div>
            </form>
        </div>

        <div class="card mb-5">
            <div class="text-center py-3"><h3>Statistik Penjualan</h3><hr></div>
            <div class="row d-flex justify-content-center">
                <div class="py-3 px-2 col-md-10 mb-3">
                    <div class="table-responsive"><canvas id="transaksi-tanggal" style="height: 300px;"></canvas></div>
                </div>
                <div class="py-3 px-2 col-md-6">
                    <div class="table-responsive"><canvas id="transaksi-sukses-gagal" style="height: 300px;"></canvas></div>
                </div>
                <div class="py-3 px-2 col-md-6">
                    <div class="table-responsive"><canvas id="transaksi-hari" style="height: 300px;"></canvas></div>
                </div>
                <div class="py-3 px-2 col-md-10">
                    <div class="table-responsive"><canvas id="transaksi-menu" style="height: 300px;"></canvas></div>
                </div>
            </div>
        </div>
        <div class="card mb-5">
            <div class="text-center py-3"><h3>Statistik Performa Pelayan</h3><hr></div>
            <div class="row d-flex justify-content-center">
                <div class="py-3 col-md-6">
                    <canvas id="transaksi-pelayan-item" style="height: 300px;"></canvas>
                </div>
                <div class="py-3 col-md-6">
                    <canvas id="transaksi-pelayan-kuantitas" style="height: 300px;"></canvas>
                </div>
                <div class="py-3 col-md-6">
                    <canvas id="transaksi-pelayan-harga" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="card mb-5">
            <div class="text-center py-3"><h3>Statistik Performa Kasir</h3><hr></div>
            <div class="row d-flex justify-content-center">
                <div class="py-3 col-md-10">
                    <canvas id="transaksi-kasir-performa" class="" style="height: 300px;"></canvas>
                </div>
                <div class="py-3 col-md-10">
                    <canvas id="transaksi-kasir-harga" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('footer')
    @include('layouts.components.footer')
@endsection
