<!-- Content Wrapper -->


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div id="carouselExampleSlidesOnly" class="carousel slide mb-3" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-custom-jumbotron carousel-item active" style="background-image:url('<?= base_url('assets/img/carousel/carousel5.jpg'); ?>')">
            </div>
            <div class="carousel-custom-jumbotron carousel-item" style=" background-image:url('<?= base_url('assets/img/carousel/carousel1.jpg'); ?>')">
            </div>
            <div class="carousel-custom-jumbotron carousel-item" style="background-image:url('<?= base_url('assets/img/carousel/carousel2.JPG'); ?>')">
            </div>
            <div class="carousel-custom-jumbotron carousel-item" style="background-image:url('<?= base_url('assets/img/carousel/carousel4.jpg'); ?>')">
            </div>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="col-5" style="text-align:center;">
            <div class="card mr-2  p-3">
                <!-- <div class="chart-area"> -->
                <canvas id="myChart" width="100" height="75"></canvas>
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
                                if(strlen('Minggu, 25 Oktober 2020 ITU TECH mengadakan acara yaitu MEET UP ITU TECH dengan Tema IDEMU KARYA – IN #1. Dalam acara ini ITU TECH membahas tentang “Video Editing For Beginners Using Adobe Premiere”...') >90){
                                    echo (substr("Minggu, 25 Oktober 2020 ITU TECH mengadakan acara yaitu MEET UP ITU TECH dengan Tema IDEMU KARYA – IN #1. Dalam acara ini ITU TECH membahas tentang “Video Editing For Beginners Using Adobe Premiere”...",0,97).".. <br>") ;
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
                                <h5 class="card-title mb-0">MEET UP ITU-TECH </h5>
                                <p class="card-text">tanggal<br>
                                    <?php
                                    if ( strlen("Open House Program Studi Informatika 2020 adalah sebuah kegiatan yang diperuntukkan untuk mahasiswa baru Informatika tahun 2020. Tujuan dari kegiatan ini adalah untuk menyambut mahasiswa baru sekaligus memberikan informasi terkait perkuliahan yang akan diampu oleh mahasiswa baru di program studi informatika. Selain informasi terkait perkuliahan") > 90 ){
                                        echo (substr("Open House Program Studi Informatika 2020 adalah sebuah kegiatan yang diperuntukkan untuk mahasiswa baru Informatika tahun 2020. Tujuan dari kegiatan ini adalah untuk menyambut mahasiswa baru sekaligus memberikan informasi terkait perkuliahan yang akan diampu oleh mahasiswa baru di program studi informatika. Selain informasi terkait perkuliahan",0,99).".. <br>") ;

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
<!-- /.container-fluid -->

</div>

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
<!-- End of Main Content -->