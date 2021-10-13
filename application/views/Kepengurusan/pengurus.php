<div class="container-fluid p-2">


  <?php echo $this->session->flashdata('message'); ?>
  <a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modaltambahPengurus"><i class="fas fa-plus-circle"></i> Tambah pengurus</a>


  <div class="card shadow mb-4">
    <div class="card-body">

      <div hidden class="row text-align-center mb-2 filter_tanggal">
        <input type="date" id="minDate" name="minDate" class="form-control form-control-sm">
        <input type="date" id="maxDate" name="maxDate" class="form-control form-control-sm">
      </div>

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
                  <a  class="btn btn-sm text-info edit-button2" id="<?= $dt['npm'] ?>"  data-toggle="modal" data-target="#modalEdit"><i class="fas fa-sm fa-edit"></i> update</a>
                  <a class="btn btn-sm text-danger swal-delete" id="<?= $dt['npm'] ?>"><i class="fas fa-sm fa-trash"></i> delete</a>
                </td>
              </tr>

            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalsubmenulabel">Edit Pengurus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('Pengurus/editPengurus'); ?>
        <div class="modal-body">

          <div class="form-group">
            <input type="text" class="form-control" id="edit_npm" name="npm" placeholder="NPM" readonly>
          </div>

          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="edit-foto-pengurus" name="foto_pengurus">
            <label class="custom-file-label" for="file">choose photo</label>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="edit-nama" name="nama" placeholder="nama lengkap">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" id="edit-semester" name="semester" placeholder="semester">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="edit-periode1" name="periode1" placeholder="tahun periode pertama">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="edit-periode2" name="periode2" placeholder="tahun periode kedua">
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

<div class="modal fade" id="modaltambahPengurus" tabindex="-1" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalsubmenulabel">Tambah Pengurus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- <form action="<?php echo base_url('Pengurus/addpengurus'); ?>" method="post"> -->
      <?php echo form_open_multipart('Pengurus/addpengurus'); ?>
        <div class="modal-body">
          
        <div class="form-group">
            <input type="number" class="form-control" id="npm" name="npm" placeholder="NPM">
          </div>
        
          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="foto-pengurus" name="foto-pengurus">
            <label class="custom-file-label" for="file">choose photo</label>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama lengkap">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" id="semester" name="semester" placeholder="semester masuk">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="periode1" name="periode1" placeholder="tahun periode pertama">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="periode2" name="periode2" placeholder="tahun periode kedua">
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


<script>

$(document).on("click", ".edit-button2", function(id) {
		var npm = this.id
		// console.log(npm);

		$.ajax({
			type: "POST",
			data: {
				npm: npm
			},
			url: '<?= base_url('Pengurus/showEditPengurus') ?>',
			success: function(data) {
				var objectResult = JSON.parse(data)
				// console.log(objectResult)
				$("#edit_npm").val(objectResult.npm);
				// $("#edit-foto-pengurus").val(objectResult.foto_pengurus);
				$("#edit-nama").val(objectResult.nama);
				$("#edit-semester").val(objectResult.semester);
				$("#edit-periode1").val(objectResult.periode1);
				$("#edit-periode2").val(objectResult.periode2);
				$("#edit-foto-pengurus").next('.custom-file-label').addClass("selected").html(objectResult.foto_pengurus);
			}
	  })
});


  $(document).on("click", ".swal-delete", function(id) {
		var id_del = this.id;
		// console.log("mantappps")
		// console.log(id_del)
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
				window.location = '<?php echo base_url('Pengurus/delPengurus/') ?>' + id_del;
			}
		})
	})
</script>

</div>