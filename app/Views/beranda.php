<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js pdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ht ml2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Grafik Transaksi Penjualan
                        <div class="col-sm 2 mt-3">
                            <input type="number" value="<?= date('Y') ?>" id="tahun_transaksi" class="form-control" onchange="getTransaksi()">
                        </div>
                    </div>
                    <div class="card-body"><canvas id="chartTransaksi" width="100%" height="40"></canvas></div>
                    <div class="m-3 justify-content-md-end d-md-flex gap-2">
                        <a id="download-transaksi" download="chart-transaksi.png">
                            <button class="btn btn-outline-secondary btn-sm" onclick="downloadChartTransaksi('PNG')">Unduh PNG</button>
                        </a>
                        <button class="btn btn-outline-primary btn-sm" onclick="downloadChartTransaksi('PDF')">Unduh
                            PDF</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Grafik Customer
                        <div class="col-sm 2 mt-3">
                            <input type="number" value="<?= date('Y') ?>" id="tahun_customer" class="form-control" onchange="getCustomer()">
                        </div>
                    </div>
                    <div class="card-body"><canvas id="chartCustomer" width="100%" height="40"></canvas></div>
                    <div class="m-3 justify-content-md-end d-md-flex gap-2">
                        <a id="download-customer" download="chart-customer.png">
                            <button class="btn btn-outline-secondary btn-sm" onclick="downloadChartCustomer('PNG')">Unduh PNG</button>
                        </a>
                        <button class="btn btn-outline-primary btn-sm" onclick="downloadChartCustomer('PDF')">Unduh
                            PDF</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Grafik Transaksi Pembelian
                        <div class="col-sm 2 mt-3">
                            <input type="number" value="<?= date('Y') ?>" id="tahun_transaksipembelian" class="form-control" onchange="getTransaksiPembelian()">
                        </div>
                    </div>
                    <div class="card-body"><canvas id="chartTransaksiPembelian" width="100%" height="40"></canvas></div>
                    <div class="m-3 justify-content-md-end d-md-flex gap-2">
                        <a id="download-transaksipembelian" download="chart-transaksipembelian.png">
                            <button class="btn btn-outline-secondary btn-sm" onclick="downloadChartTransaksiPembelian('PNG')">Unduh PNG</button>
                        </a>
                        <button class="btn btn-outline-primary btn-sm" onclick="downloadChartTransaksiPembelian('PDF')">Unduh
                            PDF</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Grafik Supplier
                        <div class="col-sm 2 mt-3">
                            <input type="number" value="<?= date('Y') ?>" id="tahun_supplier" class="form-control" onchange="getSupplier()">
                        </div>
                    </div>
                    <div class="card-body"><canvas id="chartSupplier" width="100%" height="40"></canvas></div>
                    <div class="m-3 justify-content-md-end d-md-flex gap-2">
                        <a id="download-supplier" download="chart-supplier.png">
                            <button class="btn btn-outline-secondary btn-sm" onclick="downloadChartSupplier('PNG')">Unduh PNG</button>
                        </a>
                        <button class="btn btn-outline-primary btn-sm" onclick="downloadChartSupplier('PDF')">Unduh
                            PDF</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<script>
    $(document).ready(function() {
        getTransaksi()
        getTransaksiPembelian()
        getCustomer()
        getSupplier()
    })
    //=======================Chart Transaksi==================
    function chartTransaksi(dataset) {
        // Area Chart Example
        var ctx = document.getElementById("chartTransaksi");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Juli", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Total",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: dataset,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    }

    function getTransaksi() {
        var tahun = $('#tahun_transaksi').val()
        $.ajax({
            url: "/chart-transaksi",
            method: "POST",
            data: {
                tahun: tahun
            },
            success: function(response) {
                var result = JSON.parse(response);
                var dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                $.each(result.data, function(i, item) {
                    dataset[item.bulan - 1] = item.total
                });
                console.log(dataset)
                chartTransaksi(dataset)
            }
        })
    }

    //=======================Chart Transaksi Pembelian==================
    function chartTransaksiPembelian(dataset) {
        // Area Chart Example
        var ctx = document.getElementById("chartTransaksiPembelian");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Juli", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Total",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: dataset,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    }

    function getTransaksiPembelian() {
        var tahun = $('#tahun_transaksipembelian').val()
        $.ajax({
            url: "/chart-transaksipembelian",
            method: "POST",
            data: {
                tahun: tahun
            },
            success: function(response) {
                var result = JSON.parse(response);
                var dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                $.each(result.data, function(i, item) {
                    dataset[item.bulan - 1] = item.total
                });
                console.log(dataset)
                chartTransaksiPembelian(dataset)
            }
        })
    }

    //==========================Chart Customer========================
    function chartCustomer(dataset) {
        // Bar Chart Example
        var ctx = document.getElementById("chartCustomer");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Juli", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Jumlah",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: dataset,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    }

    function getCustomer() {
        var tahun = $('#tahun_customer').val()
        $.ajax({
            url: "/chart-customer",
            method: "POST",
            data: {
                tahun: tahun
            },
            success: function(response) {
                var result = JSON.parse(response);
                var dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                $.each(result.data, function(i, item) {
                    //console.log(item);
                    dataset[item.bulan - 1] = item.total
                });
                console.log(dataset)
                chartCustomer(dataset)
            }
        })
    }

    //==========================Chart Supplier========================
    function chartSupplier(dataset) {
        // Pie Chart Example
        var ctx = document.getElementById("chartSupplier");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Juli", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    data: dataset,
                    backgroundColor: ['#FF0000', '#FF4500', '#FFD700', '#00FF00', '##0000CD', '#800080', '#FF6347', '#F4A460', '#F0E68C', '#90EE90', '#87CEFA', '#BA55D3'],
                    //backgroundColor: "rgba(2,117,216,1)",
                }],
            },
        });
    }

    function getSupplier() {
        var tahun = $('#tahun_supplier').val()
        $.ajax({
            url: "/chart-supplier",
            method: "POST",
            data: {
                tahun: tahun
            },
            success: function(response) {
                var result = JSON.parse(response);
                var dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                $.each(result.data, function(i, item) {
                    //console.log(item);
                    dataset[item.bulan - 1] = item.total
                });
                console.log(dataset)
                chartSupplier(dataset)
            }
        })
    }


    //=== === === === === === === == Chart Supplier === === === === === === === ===
    // function chartSupplier(dataset) {
    //Bar Chart Example
    //     var ctx = document.getElementById("chartSupplier");
    //     var myLineChart = new Chart(ctx, {
    //         type: 'bar',
    //         data: {
    //             labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Juli", "Aug", "Sep", "Oct", "Nov", "Dec"],
    //             datasets: [{
    //                 label: "Jumlah",
    //                 backgroundColor: "rgba(2,117,216,1)",
    //                 borderColor: "rgba(2,117,216,1)",
    //                 data: dataset,
    //             }],
    //         },
    //         options: {
    //             scales: {
    //                 xAxes: [{
    //                     time: {
    //                         unit: 'month'
    //                     },
    //                     gridLines: {
    //                         display: false
    //                     },
    //                     ticks: {
    //                         maxTicksLimit: 6
    //                     }
    //                 }],
    //                 yAxes: [{
    //                     ticks: {
    //                         maxTicksLimit: 5
    //                     },
    //                     gridLines: {
    //                         display: true
    //                     }
    //                 }],
    //             },
    //             legend: {
    //                 display: false
    //             }
    //         }
    //     });
    // }

    // function getSupplier() {
    //     var tahun = $('#tahun_supplier').val()
    //     $.ajax({
    //         url: "/chart-supplier",
    //         method: "POST",
    //         data: {
    //             tahun: tahun
    //         },
    //         success: function(response) {
    //             var result = JSON.parse(response);
    //             var dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    //             $.each(result.data, function(i, item) {
    //                 //console.log(item);
    //                 dataset[item.bulan - 1] = item.total
    //             });
    //             console.log(dataset)
    //             chartSupplier(dataset)
    //         }
    //     })
    // }



    function downloadChartTransaksi(type) {
        var download = document.getElementById('download-transaksi')
        var chart = document.getElementById('chartTransaksi')
        if (type == "PNG") {
            convertChartImg(download, chart)
        } else {
            convertChartPDF(chart, "chart-transaksi.pdf", "Grafik Transaksi Penjualan")
        }
    }

    function downloadChartCustomer(type) {
        var download = document.getElementById('download-customer')
        var chart = document.getElementById('chartCustomer')
        if (type == "PNG") {
            convertChartImg(download, chart)
        } else {
            convertChartPDF(chart, "chart-customer.pdf", "Grafik Customer ")
        }
    }

    function downloadChartTransaksiPembelian(type) {
        var download = document.getElementById('download-transaksipembelian')
        var chart = document.getElementById('chartTransaksiPembelian')
        if (type == "PNG") {
            convertChartImg(download, chart)
        } else {
            convertChartPDF(chart, "chart-transaksipembelian.pdf", "Grafik Transaksi Pembelian")
        }
    }

    function downloadChartSupplier(type) {
        var download = document.getElementById('download-supplier')
        var chart = document.getElementById('chartSupplier')
        if (type == "PNG") {
            convertChartImg(download, chart)
        } else {
            convertChartPDF(chart, "chart-supplier.pdf", "Grafik Supplier")
        }
    }

    function convertChartImg(download, chart) {
        var img = chart.toDataURL('image/jpg', 1.0).replace('image/jpg', 'image/octet-stream');
        download.setAttribute('href', img)
    }

    function convertChartPDF(chart, filename, title) {
        var img = chart.toDataURL('image/jpg', 1.0).replace('image/jpg', 'image/octet-stream');
        window.jsPDF = window.jspdf.jsPDF
        var doc = new jsPDF('p', 'mm', 'A4') // Default Setting 'p', 'mm','A4'
        doc.addImage(img, 'PNG', 10, 15, 150, 0)
        doc.text(10, 10, title)
        doc.save(filename)
    }
</script>

<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Agatha Cindy Destiani</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<?= $this->endSection() ?>