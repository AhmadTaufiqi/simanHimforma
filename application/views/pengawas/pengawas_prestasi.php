
  <div class="container-fluid p-2">
    <?php echo $this->session->flashdata('message'); ?>
    

  <div class="card shadow mb-4">
    <div class="card-body">
    <div class="row text-align-center mb-2">
				<div class="col"> </div>
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
</div>
<!-- 
<script>

    $(document).ready(function() {
       
        
    });
   
</script> -->

<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span> <span style="color: #bebebe;">Copyright &copy;</span> Ahmad Taufiqi Muhsinin (sebagai syarat kelulusan) <?php echo date('Y') ?></>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script>
  
    var minDate;
    var maxDate;
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            // if ((minDate == "") && (maxDate) == "") {
            var min = minDate.val();
            var max = maxDate.val();
            // }else{
            //     var min = minDate;
            //     var max = maxDate;
            // }
            var date = data[4];
            if (
                // (min === null && max === null) ||
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

        $('#dataTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                 'pdf', 'print'
            ]
        } );
        // DataTables initialisation
        var table = $('#dataTable').DataTable();

        // Refilter the table
        $('#minDate, #maxDate').on('change', function() {
            table.draw();
        });
    });
    
</script>

<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
</body>

</html>
