<!-- Content Wrapper -->


<!-- Begin Page Content -->
<div class="container-fluid p-2">


  <?php echo $this->session->flashdata('message'); ?>

  <a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modalAngsuranKas"><i class="fas fa-plus-circle"></i> tambah data</a>

  <div class="card shadow mb-4">
    <div class="card-body">

      <div hidden class="row text-align-center mb-2 filter_tanggal">
        <input type="date" id="minDate" name="minDate" class="form-control form-control-sm">
        <input type="date" id="maxDate" name="maxDate" class="form-control form-control-sm">
      </div>

      <div class="row">
          <div class="col">

            <b class=" mr-3">Total kas keseluruhan  : </b>
            <span><?= "Rp.". number_format($uang, 0, ",", ".") ?></span>
          </div>
          <div class="col d-flex justify-content-end">
            <b class="mr-2">Iuran / minggu</b>
            <span class="mr-3"><?= "Rp. ". number_format($iuran, 0, ",", ".")?></span>
            <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalTapIuran">tetapkan iuran</a>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col">
            <b>mulai tanggal :</b>
            <span><?= date('Y-m-d',strtotime($start_date))?></span>
          </div>
          <div class="col"></div>
        </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="p-2">nama</th>
              <th class="p-2" width="22%">tanggal & nominal</th>
              <th class="p-2" width="20%">total</th>
              <th class="p-2" width="18%">kekurangan / <br> <span class="font-weight-light"> tanggal <?= date('Y-m-d')?></span></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($pengurus as $ar) : ?>
              <tr>
                <td class="p-2"><?= $ar['nama'] ?></td>
                <td class="p-2">
                  <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      tanggal & nominal
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <?php foreach ($this->db->get_where('kas_pengurus', ['npm' => $ar['npm']])->result_array() as $kas) : ?>
                        <li class="dropdown-item" href="#"><?= $kas['tanggal'] . " | " . "Rp. " . number_format($kas['nominal'], 0, ",", ".") ?> <a class="btn btn-sm swal-delete" id="<?= $kas['id_kas']?>"> <i class="fas fa-trash text-danger"></i></a></li>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </td>

                <td class="p-2">
                  <?php
                  $this->db->select_sum('nominal');
                  $query = $this->db->get_where('kas_pengurus', ['npm' => $ar['npm']])->row_array();
                  echo "Rp. " . (number_format($query['nominal'], 0, ",", "."));
                  ?>
                </td>
                <td><?= "Rp. ".number_format($tagihan - $query['nominal'],0, ",", ".") ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>



  <div class="modal fade" id="modalAngsuranKas" tabindex="-1" role="dialog" aria-labelledby="modaldokumen" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modaldokumen">input kas pengurus</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo base_url('KasPengurus/addKeuangan') ?>" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <select type="text" class="form-control" id="npm" name="npm" placeholder="nama">
                <?php
                foreach ($pengurus as $kas) : ?>
                  <option value="<?= $kas['npm'] ?>"><?= $kas['nama'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal">
            </div>
            <div class="form-group">
              <input type="number" class="form-control" id="nominal" name="nominal" pattern="^\d+(\.|\,)\d{2}$" placeholder="Rp.">
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

  <div class="modal fade" id="modalTapIuran" tabindex="-1" role="dialog" aria-labelledby="modaldokumen" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modaldokumen">Tetapkan Iuran Mingguan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo base_url('KasPengurus/TapIuran') ?>" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label for="">tetapkan iuran</label>
              <input type="number" class="form-control" id="tap_iuran" name="tap_iuran" value="<?= $iuran?>">
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
<!-- /.container-fluid -->


<script>
  $(document).on("click", ".swal-delete", function(id) {
    var id_del = this.id;
    // console.log(id_del)
    Swal.fire({
      icon: 'question',
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
        window.location = '<?php echo base_url('KasPengurus/delKeuangan/') ?>' + id_del;
        // console.log(id_del)
      }
    })
  })
</script>
</div>

<!-- End of Main Content -->