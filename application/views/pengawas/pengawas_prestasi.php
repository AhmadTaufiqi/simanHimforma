<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/himforma.png') ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="<?php echo base_url('assets/'); ?>css/style.css" rel="stylesheet" type="text/css">

</head>
<body>
  
  
  
  <div class="sticky-button-home">
    <a href="dashboard" class="btn btn-sm btn-secondary"><i class="fas fa-home"></i></a>
  </div>
  <div class="container-fluid p-2">
    <?php echo $this->session->flashdata('message'); ?>
    
    <button type="button" aria-label="print" id="print_prestasi" class="btn btn-info btn-sm button-fixed btm-right-end"><i class="fas fa-print"></i> cetak prestasi</button>

  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="row text-align-center mb-2 filter_tanggal">
        <div class="col "> </div>
        <span>rentang tanggal : </span>
        <div class="col-2">
          <input type="date" id="minDate" name="minDate" class="form-control form-control-sm">
        </div>
        <!-- <span> - </span> -->
        <div class="col-2">
          <input type="date" id="maxDate" name="maxDate" class="form-control form-control-sm">
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>

              <th>Foto</th>
              <th>Prestasi</th>
              <th>peraih prestasi</th>
              <th width="10%">NPM</th>
              <th width="12%">tanggal</th>
              <th width="20%">keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($prestasi as $pr) : ?>
              <tr>
                <td><img height="50" src="<?= base_url('assets/img/foto_prestasi/') . $pr['foto_prestasi'] ?>" alt=""></td>
                <td><?= $pr['nama_prestasi'] ?></td>
                <td><?= $pr['nama_peraih'] ?></td>
                <td><?= $pr['npm'] ?></td>
                <td><?= $pr['tanggal_prestasi'] ?></td>
                <td><?= $pr['keterangan'] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>


<script src="<?php echo base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<!-- <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script> -->
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script>
    var minDate;
    var maxDate;
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = data[4];
            if (
                (min == "" && max == "") ||
                (min == "" && date <= max) ||
                (min <= date && max == "") ||
                (min <= date && date <= max)
            ) {
                return true;
            } else {
                return false;
            }
        });

    $(document).ready(function() {
        minDate = $('#minDate');
        maxDate = $('#maxDate');
        var table = $('#dataTable').DataTable();

        // Refilter the table
        $('#minDate, #maxDate').on('change', function() {
            table.draw();
        });
    });
</script>


<script>
  $('#print_prestasi').click(function () {
    window.print();
  })
</script>
</body>
</html>