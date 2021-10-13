<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/himforma.png') ?>" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/landing_style.css') ?>">
    <script src="<?php echo base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="jumbotron jumbotron-fluid py-4">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <img class="image-jumbotron" src="<?php echo base_url('assets/img/teamwork.png') ?>" alt="">
                </div>
                <div class="text-right col-7">
                    <a class="btn btn-sm text-white" href="<?= base_url('auth') ?>">MASUK</a>
                    <h1 class="font-weight-bold custom-serif my-4">Sistem Manajemen Himpunan mahasiswa Informatika UPGRIS</h1>
                    <p class="lead">sistem pencatatan program kerja, kebendaharaan & kepengurusan himpunan mahasiswa Informatika</p>
                    <!-- <a href="#" class="btn btn-primary">masuk</a> -->
                </div>
            </div>
        </div>
    </div>
    <section id="about" class="about">

        <div class="container-fluid">
            <img class="image-illust" src="<?php echo base_url('assets/img/teamwork.png') ?>" alt="">
            <div class="row my-5">
                <div class="col text-center">
                    <h2 class="display-5">Informasi</h2>
                </div>
            </div>


            <div class="row no-gutters">
                <div class="col-5" style="text-align:center;">
                    <div class="card mr-2  p-3">
                        <!-- <div class="chart-area"> -->
                        <canvas id="myChart" width="100" height="70"></canvas>
                        <!-- </div> -->
                    </div>
                </div>
                <div class="col px-3">
                    <div class="row">
                        <div class="card mb-2">
                            <div class="row no-gutters">
                                <div class="col">
                                    <img src="<?php echo base_url('assets/') ?>img/berita/1-1.png" class="card-img" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title">MEET UP ITU-TECH </h5>
                                        <p class="card-text">himforma<br>
                                            <?php
                                            if (strlen('Minggu, 25 Oktober 2020 ITU TECH mengadakan acara yaitu MEET UP ITU TECH dengan Tema IDEMU KARYA – IN #1. Dalam acara ini ITU TECH membahas tentang “Video Editing For Beginners Using Adobe Premiere”...') > 90) {
                                                echo (substr("Minggu, 25 Oktober 2020 ITU TECH mengadakan acara yaitu MEET UP ITU TECH dengan Tema IDEMU KARYA – IN #1. Dalam acara ini ITU TECH membahas tentang “Video Editing For Beginners Using Adobe Premiere”...", 0, 97) . ".. <br>");
                                            }
                                            ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row-2">s</div> -->
                    <div class="row">
                        <div class="card mb-2">
                            <div class="row no-gutters">
                                <div class="col">
                                    <img src="<?php echo base_url('assets/') ?>img/berita/2-2.png" class="card-img" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body p-2">
                                        <h5 class="card-title mb-0">NGOBRAL 3</h5>
                                        <p class="card-text">tanggal<br>
                                            <?php
                                            if (strlen("Open House Program Studi Informatika 2020 adalah sebuah kegiatan yang diperuntukkan untuk mahasiswa baru Informatika tahun 2020. Tujuan dari kegiatan ini adalah untuk menyambut mahasiswa baru sekaligus memberikan informasi terkait perkuliahan yang akan diampu oleh mahasiswa baru di program studi informatika. Selain informasi terkait perkuliahan") > 90) {
                                                echo (substr("Open House Program Studi Informatika 2020 adalah sebuah kegiatan yang diperuntukkan untuk mahasiswa baru Informatika tahun 2020. Tujuan dari kegiatan ini adalah untuk menyambut mahasiswa baru sekaligus memberikan informasi terkait perkuliahan yang akan diampu oleh mahasiswa baru di program studi informatika. Selain informasi terkait perkuliahan", 0, 99) . ".. <br>");
                                            } else {
                                                echo "isi tulisan artikel";
                                            }
                                            $awal = ('2000-04-01');
                                            // $akhir = date('Y-m-d');
                                            $akhir = date_create();
                                            // $selisih = date_diff($awal,$akhir);
                                            // var_dump( $selisih);
                                            echo date('Y-m-d', strtotime('-3 days', strtotime($awal)));

                                            ?>
                                        </p>
                                        <!-- mahasiswa baru juga mendapatkan informasi tentang komunitas – komunitas di lingkup prodi Informatika dan juga Ormawa (Himpunan Mahasiswa Informatika) dan juga Organisasi luar (Permikomnas Jateng).Acara ini diikuti oleh seluruh mahasiswa baru Program Studi Informatika 2020. -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        // var linechart = document.getElementById("myLineChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                <?= $data_chart ?>,
            },
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        beginAtZero: true,
                        stacked: true
                    }
                }
            }
        });
    </script>