<div class="container-fluid p-2">


  <?php echo $this->session->flashdata('message'); ?>


  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>

              <th colspan="2" width="34%">perencanaan</th>
              <th colspan="2" width="33%">pelaksanaan</th>
              <th colspan="2" width="33%">pertanggungjawaban</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($lapProgram as $pr) : ?>
              <tr>
                <td><?= $pr['nama_prog'] ?></td>
                <td><?= $pr['id'] ?></td>
                <td><?php
                    $pelaksanaan = $this->db->get_where('pelaksanaan', ['id_prog' => $pr['id']])->row_array();
                    if ($pelaksanaan) {
                      echo ($pelaksanaan['nama_kegiatan']);
                    ?></td>

              <?= "<td width='12%'><a class='btn text-info' title='file selain PDF akan otomatis ter-download' target='blank' href=" . base_url('assets/files/proposal_terlaksana/') . $pelaksanaan['file_proposal'] . ">buka file</a><a title='pengawas mengkonfirmasi PROPOSAL yang di kirim' id=" . $pelaksanaan['id'] . " class='swal-konfirm-pelaksanaan btn text-danger'  href='#'>konfirmasi</a></td>";
                    } else {
                      echo "<td></td>";
                    }
              ?>
              <td><?php
                  $pertanggungjwb = $this->db->get_where('pertanggungjwb', ['id_prog' => $pr['id']])->row_array();
                  if ($pertanggungjwb) {
                    echo ($pertanggungjwb['nama_kegiatan']);

                  ?></td>
            <?= "<td width='12%'><a class='btn text-info' title='file selain PDF akan otomatis ter-download' target='blank' href=" . base_url('assets/files/proposal_terlaksana/') . $pertanggungjwb['lpj'] . ">buka file</a><a title='pengawas mengkonfirmasi LAPORAN yang di kirim' id=" . $pertanggungjwb['id'] . " class='swal-konfirm-pertanggungjwb btn text-danger'  href='#'>konfirmasi</a></td>";
                  } else {
                    echo "<td></td>";
                  }
            ?>
              </tr>

            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalkonfirmasi" tabindex="-1" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalsubmenulabel">konfimasi proposal pelaksanaan</h5>
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


</div>
<script>
  //alert confirm delete
  $(document).on("click", ".swal-konfirm-pelaksanaan", function(id) {
    var id_pel = this.id;
    Swal.fire({
      icon:'question',
      title: 'Are you sure?',
      width: 600,
      showCancelButton: true,
      showDenyButton: true,
      confirmButtonColor: '.btn-success',
      cancelButtonColor: '#858796',
      confirmButtonText: 'Konfirmasi !',
      denyButtonText: 'Tolak  proposal !',
      closeOnCancel: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = '<?= base_url('Pengawas/konfirmPelaksanaan?id_pel=') ?>' + id_pel + '&&konfirm=1';
        console.log("1")
      } else if (result.isDenied) {
        window.location = '<?= base_url('Pengawas/konfirmPelaksanaan?id_pel=') ?>' + id_pel + '&&konfirm=0';
        // console.log("0")
      }
    })
  })
  $(document).on("click", ".swal-konfirm-pertanggungjwb", function(id) {
    var id_lpj = this.id;
    // console.log(id_lpj)
    Swal.fire({
      icon:'question',
      title: 'konfirmasi laporan pertanggungjawaban',
      width:600,
      buttonWidth:200,
      showCancelButton: true,
      showDenyButton: true,
      confirmButtonColor: '.btn-success',
      cancelButtonColor: '#858796',
      confirmButtonText: 'Konfirmasi !',
      denyButtonText: 'tolak  Laporan !',
      closeOnCancel: false
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = '<?= base_url('Pengawas/konfirmPertanggunjwb?id_lpj=') ?>' + id_pel + '&&konfirm=1';
        console.log("1")
      } else if (result.isDenied) {
        window.location = '<?= base_url('Pengawas/konfirmPertanggungjwb?id_lpj=') ?>' + id_pel + '&&konfirm=0';
        // console.log("0")
      }
    })
  })
</script>