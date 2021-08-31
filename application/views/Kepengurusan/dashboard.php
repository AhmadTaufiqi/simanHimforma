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


    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col">
                <img src="<?php echo base_url('assets/') ?>img/berita/1-1.png" class="card-img" alt="...">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">MEET UP ITU-TECH </h5>
                    <p class="card-text">himforma<br>
                        Minggu, 25 Oktober 2020 ITU TECH mengadakan acara yaitu MEET UP ITU TECH dengan Tema IDEMU KARYA – IN #1. Dalam acara ini ITU TECH membahas tentang “Video Editing For Beginners Using Adobe Premiere”...
                    </p>
                    <!-- Acara ini dibuka oleh Ketua Program Studi Informatika yaitu Bapak Bambang Agus Herlambang, S.Kom., M.Kom. Yang menjadi pemateri dalam acara ini adalah Hamida Sonia (Lead ITU TECH at Bintang Multimedia Semarang). Dalam acara ini membahas seputar videografi dan bagaimana cara mengedit video menggunakan adobe premiere bagi pemula. Acara ini diikuti oleh mahasiswa Univesitas PGRI Semarang maupun luar Universitas PGRI Semarang. -->
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col">
                <img src="<?php echo base_url('assets/') ?>img/berita/2-2.png" class="card-img" alt="...">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">MEET UP ITU-TECH </h5>
                    <p class="card-text">himforma<br>
                        Open House Program Studi Informatika 2020 adalah sebuah kegiatan yang diperuntukkan untuk mahasiswa baru Informatika tahun 2020. Tujuan dari kegiatan ini adalah untuk menyambut mahasiswa baru sekaligus memberikan informasi terkait perkuliahan yang akan diampu oleh mahasiswa baru di program studi informatika. Selain informasi terkait perkuliahan ...
                    </p>
                    <!-- mahasiswa baru juga mendapatkan informasi tentang komunitas – komunitas di lingkup prodi Informatika dan juga Ormawa (Himpunan Mahasiswa Informatika) dan juga Organisasi luar (Permikomnas Jateng).Acara ini diikuti oleh seluruh mahasiswa baru Program Studi Informatika 2020. -->
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col" style="text-align:center;">
                <img src="<?php echo base_url('assets/') ?>img/untitled_diagram.png" style="width: 50%; " class="card-img" alt="...">
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col" style="text-align:center;">
                <!-- <div class="chart-area"> -->
                <canvas id="myChart" width="200" height="100"></canvas>
                <!-- </div> -->
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
            <?= $data_chart?>,
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

</script>
<!-- End of Main Content -->