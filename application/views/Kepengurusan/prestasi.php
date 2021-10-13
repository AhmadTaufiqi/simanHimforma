<div class="container-fluid p-2">
  <!-- sds -->
  <?php echo $this->session->flashdata('message'); ?>
  <a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modaltambahPrestasi"><i class="fas fa-plus-circle"></i> Tambah prestasi</a>


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
              <th aria-label="-" width="12%"><span>YYYY/</span><span>MM </span></th>
              <th width="20%">keterangan</th>
              <th width="10%">Aksi</th>
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
                <td>
                  <a id="<?= $pr['id_prestasi'] ?>" class="btn btn-sm text-info edit-button2" data-toggle="modal" data-target="#modalEditPrestasi"><i class="fas fa-edit"></i> edit</a>
                  <a id="<?= $pr['id_prestasi'] ?>" class="btn btn-sm text-danger swal-delete"><i class="fas fa-trash"></i> delete</a>
                </td>
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


<!-- form edit modal -->

<div class="modal fade" id="modalEditPrestasi" tabindex="-1" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalsubmenulabel">Edit prestasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('Prestasi/editPrestasi'); ?>
      <div class="modal-body">

        <input type="text" class="form-control" id="edit_id_prestasi" name="id_prestasi" placeholder="id prestasi" hidden>
        <div class="custom-file mb-3">
          <input type="file" class="custom-file-input" id="edit_foto_prestasi" name="foto_prestasi">
          <label class="custom-file-label" for="file">choose photo</label>
        </div>
        
        <div class="form-group">
          <input type="text" class="form-control" id="edit_nama_prestasi" name="nama_prestasi" placeholder="nama prestasi">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="edit_nama_peraih" name="nama_peraih" placeholder="nama peraih prestasi">
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="edit_npm" name="npm" placeholder="NPM">
        </div>
        <div class="form-group">
          <input type="date" class="form-control" id="edit_tanggal_prestasi" name="tanggal_prestasi" placeholder="tanggal prestasi">
        </div>
        <div class="form-group">
          <input type="textarea" class="form-control" id="edit_keterangan" name="keterangan" placeholder="keterangan">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

</div>
<script>
  
$(document).on("click", ".edit-button2", function(id) {
		var id_prest = this.id
		// console.log(prest);

		$.ajax({
			type: "POST",
			data: {
				id_prest: id_prest
			},
			url: '<?= base_url('Prestasi/showEditPrestasi') ?>',
			success: function(data) {
				var objectResult = JSON.parse(data)
				console.log(objectResult)
				$("#edit_id_prestasi").val(objectResult.id_prestasi);
				$("#edit_foto_prestasi").next('.custom-file-label').addClass("selected").html(objectResult.foto_prestasi);
				$("#edit_nama_prestasi").val(objectResult.nama_prestasi);
				$("#edit_nama_peraih").val(objectResult.nama_peraih);
				$("#edit_npm").val(objectResult.npm);
				$("#edit_tanggal_prestasi").val(objectResult.tanggal_prestasi);
				$("#edit_keterangan").val(objectResult.keterangan);
			}
	  })
});

  //alert confirm delete
  $(document).on("click", ".swal-delete", function(id) {
    var id_del = this.id;
    console.log(id_del)
    Swal.fire({			
      icon: 'question',
			title: 'Are you sure?',
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