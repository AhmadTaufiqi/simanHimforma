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

<div class="modal fade" id="modaltambahPrestasi" tabindex="-1" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalsubmenulabel">Tambah prestasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('Prestasi/addPrestasi'); ?>
      <div class="modal-body">

        <div class="custom-file mb-3">
          <input type="file" class="custom-file-input" id="foto_prestasi" name="foto_prestasi">
          <label class="custom-file-label" for="file">choose photo</label>
        </div>

        <div class="form-group">
          <input type="text" class="form-control" id="nama_prestasi" name="nama_prestasi" placeholder="nama prestasi">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="nama_peraih" name="nama_peraih" placeholder="nama peraih prestasi">
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="npm" name="npm" placeholder="NPM">
        </div>
        <div class="form-group">
          <input type="date" class="form-control" id="tanggal_prestasi" name="tanggal_prestasi" placeholder="tanggal prestasi">
        </div>
        <div class="form-group">
          <input type="textarea" class="form-control" id="keterangan" name="keterangan" placeholder="keterangan">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

</div>
<script>
  //alert confirm delete
  $(document).on("click", ".swal-delete", function(id) {
    var id_del = this.id;
    console.log(id_del)
    Swal.fire({
      title: 'Are you sure?',
      type: 'warning',
      width: 400,
      showCancelButton: true,
      confirmButtonColor: '#922c2c',
      cancelButtonColor: '#858796',
      confirmButtonText: 'Yes, delete it!',
      // closeOnCancel: false
    }).then((result) => {


      if (result.value == true) {
        window.location = '<?php echo base_url('prestasi/deletePrestasi/') ?>' + id_del;
        console.log(id_del)
      }
    })
  })
</script>

<script>
  $('#print_prestasi').click(function () {
    // console.log("mantap")
    // var printme = document.getElementById('dataTable');
    window.print();
    // var wme = window.open("","","width=900","height=700");
    // wme.document.print(printme);
    // wme.document.close();
    // wme.focus();
    // wme.print();
    // wme.close();
  })
</script>