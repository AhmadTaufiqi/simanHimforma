<div class="container-fluid p-2">


  <?php echo $this->session->flashdata('message'); ?>
  <a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modaltambahinventaris"><i class="fas fa-plus-circle"></i> Tambah pengurus</a>


  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>

              <th width="10%">Foto</th>
              <th>Nama</th>
              <th width="15%">Semester</th>
              <th width="15%">Periode 1</th>
              <th width="15%">Periode 2</th>
              <th width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pengurus as $dt) : ?>
              <tr>
                <th><img height="50" src="<?= base_url('assets/img/profile/' . $dt['foto_pengurus']) ?>" alt=""></th>
                <td><?php echo $dt['nama']; ?></td>
                <td><?php echo $dt['semester']; ?></td>
                <td><?php echo $dt['periode1']; ?></td>
                <td><?php echo $dt['periode2']; ?></td>
                <td>
                  <a href="<?php echo base_url('user/edit_pengurus/') . $dt['id']; ?>" class="btn btn-sm text-info"><i class="fas fa-sm fa-edit"></i> update</a>
                  <a href="<?php echo base_url('Kepengurusan/delete_pengurus/') . $dt['id']; ?>" class="btn btn-sm text-danger"><i class="fas fa-sm fa-trash"></i> delete</a>
                </td>
              </tr>

            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>

<div class="modal fade" id="modaltambahinventaris" tabindex="-1" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalsubmenulabel">Tambah Pengurus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('user/pengurus'); ?>" method="post">
        <div class="modal-body">

          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="foto-pengurus" name="foto-pengurus">
            <label class="custom-file-label" for="file">choose photo</label>
          </div>

          <div class="form-group">

            <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="nama lengkap">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" id="kondisi" name="kondisi" placeholder="semester">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="kondisi" name="kondisi" placeholder="periode">
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