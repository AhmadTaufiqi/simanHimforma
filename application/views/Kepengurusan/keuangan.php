<!-- Content Wrapper -->


<!-- Begin Page Content -->
<div class="container-fluid p-2">


  <?php echo $this->session->flashdata('message'); ?>

  <a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modalAngsuranKas"><i class="fas fa-plus-circle"></i> tambah data</a>
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>nama</th>
              <th width="22%">tanggal & nominal</th>
              <th width="20%">total</>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($pengurus as $ar) : ?>
              <tr>
                <td><?= $ar['nama'] ?></td>
                <td>
                  <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      tanggal & nominal
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <?php foreach ($this->db->get_where('kas_pengurus', ['id_pengurus' => $ar['id']])->result_array() as $kas) : ?>
                        <li class="dropdown-item" href="#"><?= $kas['tanggal'] . " | " . "Rp. " . number_format($kas['nominal'], 0, ",", ".") ?> <a class="btn btn-sm " href="<?= base_url('Kepengurusan/delKeuangan/' . $kas['id']) ?>"> <i class="fas fa-trash text-danger"></i></a></li>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </td>

                <td>
                  <?php
                  $this->db->select_sum('nominal');
                  $query = $this->db->get_where('kas_pengurus', ['id_pengurus' => $ar['id']])->row_array();
                  echo "Rp. " . (number_format($query['nominal'], 0, ",", "."));
                  ?>
                </td>
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
        <form action="<?php echo base_url('Kepengurusan/addKeuangan') ?>" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <select type="text" class="form-control" id="id_pengurus" name="id_pengurus" placeholder="nama">
                <?php
                foreach ($pengurus as $kas) : ?>
                  <option value="<?= $kas['id'] ?>"><?= $kas['nama'] ?></option>
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


</div>
<!-- /.container-fluid -->

</div>

<!-- End of Main Content -->