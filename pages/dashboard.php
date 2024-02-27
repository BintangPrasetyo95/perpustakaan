<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card bg-gradient-success">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase text-white font-weight-bold">Total Akun Pengunjung</p>
                            <?php
                            $user = query("SELECT * FROM user WHERE role='tamu' ");

                            $pinjam = query("SELECT * FROM peminjaman WHERE status='terpinjam' OR status='hilang'");
                            ?>
                            <h5 class="font-weight-bolder text-white">
                                <?= rows($user) ?>
                            </h5>
                            <p class="mb-0">
                                <span class="text-dark font-weight-bolder"><?= rows($pinjam) ?></span>
                                <span class="text-white text-sm">Buku sedang terpinjam</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-light shadow-light text-center rounded-circle">
                            <i class="ni ni-single-02 text-success text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card bg-gradient-info">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold text-white">Total Pengunjung Login</p>
                            <?php
                            $pengunjung = query("SELECT * FROM log_login");
                            $tanggal_awal = date("Y-m-1");
                            $current_pengunjung = query("SELECT * FROM log_login WHERE YEARWEEK(waktu_login)=YEARWEEK(NOW()) ");
                            ?>
                            <h5 class="font-weight-bolder text-white">
                                <?= rows($pengunjung) ?>
                            </h5>
                            <p class="mb-0">
                                <span class="text-dark text-sm font-weight-bolder">+<?= rows($current_pengunjung) ?></span>
                                <span class="text-secondary text-sm text-white">User Login minggu ini</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-light shadow-light text-center rounded-circle">
                            <i class="ni ni-mobile-button text-primary text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card bg-gradient-danger">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <?php
                            $trend_query = query("SELECT id_buku, COUNT(*) AS top FROM koleksi GROUP BY id_buku ORDER BY top DESC LIMIT 1");
                            $trend = fetch($trend_query);
                            $id_buku = $trend['id_buku'];

                            $trend_buku_query = query("SELECT * FROM buku WHERE id_buku='$id_buku'");
                            $trend_buku = fetch($trend_buku_query);
                            ?>
                            <p class="text-sm text-white mb-0 text-uppercase font-weight-bold">Buku Trending</p>
                            <h5 class="font-weight-bolder text-light">
                                <?= $trend_buku['judul'] ?>
                            </h5>
                            <p class="mb-0">
                                <span class="text-dark text-sm font-weight-bolder"><?= $trend['top'] ?></span>
                                <span class="text-white text-sm">User Menyukai Buku ini</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-light shadow-light text-center rounded-circle">
                            <i class="ni ni-paper-diploma text-danger text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0">
        <div class="card bg-gradient-warning">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold text-white">Total Buku</p>
                            <?php
                            $buku = query("SELECT * FROM buku");
                            $kategori = query("SELECT * FROM kategori");
                            ?>
                            <h5 class="font-weight-bolder text-white">
                                <?= rows($buku) ?>
                            </h5>
                            <p class="mb-0">
                                <span class="text-dark text-sm font-weight-bolder"><?= rows($kategori) ?></span>
                                <span class="text-white text-sm">Total Kategori</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-light shadow-light text-center rounded-circle">
                            <i class="ni ni-books text-warning text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">User Login</h6>
            </div>
            <div class="card-body p-3">
                <div class="chart">
                    <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card card-carousel overflow-hidden h-100 p-0">
            <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                <div class="carousel-inner border-radius-lg h-100">
                    <div class="carousel-item h-100 active" style="background-image: url('./assets/img/Ukuran_Buku.jpg'); background-size: cover;">
      <span class="mask bg-gradient-info opacity-7"></span>
                        <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                            <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                <i class="ni ni-paper-diploma text-dark opacity-10"></i>
                            </div>
                            <h5 class="text-white mb-1">Trending!</h5>
                            <p><?= $trend_buku['judul'] ?>, dari penulis <?= $trend_buku['penulis'] ?>.</p>
                        </div>
                    </div>
                    <div class="carousel-item h-100" style="background-image: url('./assets/img/7aeb76f2-5669-46ec-9882-90552bef85ff_169.jpg'); background-size: cover;">
      <span class="mask bg-gradient-primary opacity-7"></span>
                        <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                            <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                <i class="ni ni-books text-dark opacity-10"></i>
                            </div>
                            <h5 class="text-white mb-1">Total Buku di perpustakaan</h5>
                            <p>Perpustakaan ini mempunyai total sebanyak <?= rows($buku) ?> buku, dengan <?= rows($kategori) ?> kategori.</p>
                        </div>
                    </div>
                    <div class="carousel-item h-100" style="background-image: url('./assets/img/ManfaatBuku.jpg'); background-size: cover;">
      <span class="mask bg-gradient-warning opacity-7"></span>
                        <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                            <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                <i class="ni ni-mobile-button text-dark opacity-10"></i>
                            </div>
                            <h5 class="text-white mb-1">Pengunjung Perpustakaan</h5>
                            <p>Perpustakaan ini mempunyai <?= rows($user) ?> akun pengunjung, dengan total <?= rows($pengunjung) ?>-kali login.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="./assets/js/plugins/chartjs.min.js"></script>
<?php
$dashboard_data_query = query("SELECT 
    generated_months.year,
    generated_months.month,
    IFNULL(COUNT(log_login.id_login), 0) AS login_count
FROM 
    (
        SELECT 
            YEAR(NOW()) AS year, MONTH(NOW()) AS month
        UNION
        SELECT 
            YEAR(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AS month
        UNION
        SELECT 
            YEAR(DATE_SUB(NOW(), INTERVAL 2 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 2 MONTH)) AS month
        UNION
        SELECT 
            YEAR(DATE_SUB(NOW(), INTERVAL 3 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 3 MONTH)) AS month
        UNION
        SELECT 
            YEAR(DATE_SUB(NOW(), INTERVAL 4 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 4 MONTH)) AS month
        UNION
        SELECT 
            YEAR(DATE_SUB(NOW(), INTERVAL 5 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 5 MONTH)) AS month
        UNION
        SELECT 
            YEAR(DATE_SUB(NOW(), INTERVAL 6 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 6 MONTH)) AS month
        UNION
        SELECT 
            YEAR(DATE_SUB(NOW(), INTERVAL 7 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 7 MONTH)) AS month
        UNION
        SELECT 
            YEAR(DATE_SUB(NOW(), INTERVAL 8 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 8 MONTH)) AS month
    ) AS generated_months
LEFT JOIN 
    log_login ON generated_months.year = YEAR(log_login.waktu_login) AND generated_months.month = MONTH(log_login.waktu_login)
GROUP BY 
    generated_months.year, generated_months.month
ORDER BY 
    generated_months.year, generated_months.month;");

$dashboard_data_query2 = query("SELECT 
generated_months.year,
generated_months.month,
IFNULL(COUNT(log_login.id_login), 0) AS login_count
FROM 
(
    SELECT 
        YEAR(NOW()) AS year, MONTH(NOW()) AS month
    UNION
    SELECT 
        YEAR(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AS month
    UNION
    SELECT 
        YEAR(DATE_SUB(NOW(), INTERVAL 2 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 2 MONTH)) AS month
    UNION
    SELECT 
        YEAR(DATE_SUB(NOW(), INTERVAL 3 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 3 MONTH)) AS month
    UNION
    SELECT 
        YEAR(DATE_SUB(NOW(), INTERVAL 4 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 4 MONTH)) AS month
    UNION
    SELECT 
        YEAR(DATE_SUB(NOW(), INTERVAL 5 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 5 MONTH)) AS month
    UNION
    SELECT 
        YEAR(DATE_SUB(NOW(), INTERVAL 6 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 6 MONTH)) AS month
    UNION
    SELECT 
        YEAR(DATE_SUB(NOW(), INTERVAL 7 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 7 MONTH)) AS month
    UNION
    SELECT 
        YEAR(DATE_SUB(NOW(), INTERVAL 8 MONTH)) AS year, MONTH(DATE_SUB(NOW(), INTERVAL 8 MONTH)) AS month
) AS generated_months
LEFT JOIN 
log_login ON generated_months.year = YEAR(log_login.waktu_login) AND generated_months.month = MONTH(log_login.waktu_login)
GROUP BY 
generated_months.year, generated_months.month
ORDER BY 
generated_months.year, generated_months.month;");
?>
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
        type: "line",
        data: {
            labels: [
                <?php
                $index = 1;
                $dashboard_data_rows = rows($dashboard_data_query);
                while ($dashboard_data = fetch($dashboard_data_query)) {
                    $index++;
                    $monthNum  = intval($dashboard_data['month']);
                    $monthName = date('M', mktime(0, 0, 0, $monthNum, 10));
                    echo '"'.$monthName.'"';
                    if ($index - 1 != $dashboard_data_rows) {
                        echo ",";
                    }
                }
                ?>
            ],
            datasets: [{
                label: "Pengunjung Login",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#00AAFF",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [
                    <?php
                    while ($dashboard_data2 = fetch($dashboard_data_query2)) {
                        echo $dashboard_data2['login_count'] . ',';
                    }
                    ?>
                ],
                maxBarThickness: 6

            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#fbfbfb',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#ccc',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>