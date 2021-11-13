<!-- Content Wrapper -->


<!-- Begin Page Content -->
<div class="container-fluid p-2">


	<?php echo $this->session->flashdata('message'); ?>
	<?php
	// echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); 
	//  echo form_error('tujuan', '<small class="text-danger pl-3">', '</small>'); 
	?>

	<a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modaltambahprog"><i class="fas fa-plus-circle"></i> tambah data</a>
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
				<table class="table  table-bordered" id="dataTable" width="100%" cellspacing="">
					<thead>
						<tr>
							<th class="p-2">nama program</th>
							<th class="p-2" width="25%">deskripsi</th>
							<th class="p-2" width="13%">tujuan</th>
							<th class="p-2" width="13%">sasaran</th>
							<th class="p-2 text-center">estimasi bulan</th>
							<th class="p-2 text-center">estimasi biaya</th>
							<th class="p-2" width="6%">aksi</th>
						</tr>
						<!-- <tr>
							<th class="p-1">dana DKM</th>
							<th class="p-1">dana LKM</th>
							<th class="p-1">dana Sponsor</th>
							<th class="p-1">dana Lain</th>
							<th class="p-1">total dana</th>
						</tr> -->
					</thead>
					<tbody>
						<?php
						error_reporting(0);
						 foreach ($perencanaan as $ar) : ?>
							<tr>
								<td class="p-1"><?php echo $ar['nama_kegiatan'] ?></td>
								<td class="p-1"><?php echo $ar['deskripsi'] ?></td>
								<td class="p-1"><?php echo $ar['tujuan'] ?></td>
								<td class="p-1"><?php echo $ar['sasaran'] ?></td>
								<td class="p-1"><?php echo substr($ar['tgl_perencanaan'], 0, 7) ?></td>

								<td class="text-right p-1">
									<div class="dropdown">
										<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?= number_format($ar['dana_keseluruhan'], 0, ',', '.') ?>
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item" href="#">dana DKM : <?= number_format($ar['dana_DKM'], 0, ',', '.') ?></a>
											<a class="dropdown-item" href="#">dana LKM : <?= number_format($ar['dana_LKM'], 0, ',', '.') ?></a>
											<a class="dropdown-item" href="#">dana Sponsor : <?= number_format($ar['dana_sponsor'], 0, ',', '.') ?></a>
											<a class="dropdown-item" href="#">dana lain : <?= number_format($ar['dana_lain'], 0, ',', '.') ?></a>
										</div>
									</div>
								</td>

								<!-- <td class="p-1"><?= number_format($ar['dana_DKM'], 0, ',', '.') ?></td>
								<td class="p-1"><?= number_format($ar['dana_LKM'], 0, ',', '.') ?></td>
								<td class="p-1"><?= number_format($ar['dana_sponsor'], 0, ',', '.') ?></td>
								<td class="p-1"><?= number_format($ar['dana_lain'], 0, ',', '.') ?></td> -->
								<!-- <td class="p-1"><?= number_format($ar['dana_keseluruhan'], 0, ',', '.') ?></td> -->

								<td class="p-1 text-center">
									<ul class="p-2">

										<a data-toggle="modal" data-target="#modalEditProg" title="edit" href="#" id="<?= $ar['id_perencanaan'] ?>" class=" edit-button2 btn p-1 text-info"><i class="fas fa-sm fa-edit"></i></a>
										<a title="hapus" id="<?= $ar['id_perencanaan']; ?>" class="btn p-1 text-danger swal-delete"><i class="fas fa-sm fa-trash"></i></a>
									</ul>
								</td>
							</tr>

						<?php endforeach; ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>



	<div class="modal fade" id="modaltambahprog" tabindex="-1" role="dialog" aria-labelledby="modaldokumen" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modaldokumen">Tambah Program Perencanaan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('Perencanaan/addPerencanaan') ?>" method="post">
					<div class="modal-body">
						<div class="form-group">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="nama program" maxlength="50">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="tujuan" maxlength="50">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="sasaran" name="sasaran" placeholder="sasaran" maxlength="50">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="deskripsi" maxlength="100">
						</div>
						<div class="form-group">
							<input class="form-control" type="date" name="bulan" title="pilih estimasi bulan pelaksanaan" id="bulan">
						</div>
						<div class="form-group">
							<input class="form-control" type="number" name="add_DKM" placeholder="dana DKM" title="dana DKM" id="add_DKM">
						</div>
						<div class="form-group">
							<input class="form-control" type="number" name="add_LKM" placeholder="dana LKM" title="dana LKM" id="add_LKM">
						</div>
						<div class="form-group">
							<input class="form-control" type="number" name="add_sponsor" placeholder="dana sponsor" title="dana sponsor" id="add_sponsor">
						</div>
						<div class="form-group">
							<input class="form-control" type="number" name="add_dana_lain" placeholder="dana lain" title="dana lain" id="add_dana_lain">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalEditProg" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalEdit">Edit Program Perencanaan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?php echo base_url('Perencanaan/editPerencanaan') ?>" method="post">
					<div class="modal-body">
						<input type="text" class="form-control" id="ROW_ID" name="ROW_ID" placeholder="" hidden>
						<div class="form-group">
							<label>Program</label>
							<input type="text" class="form-control" id="NAMA_KEGIATAN" name="nama" readonly>
						</div>
						<div class="form-group">
							<label>Deskripsi</label>
							<textarea class="form-control" id="edit_deskripsi" name="deskripsi"></textarea>
						</div>
						<div class="form-group">
							<label>Tujuan</label>
							<textarea class="form-control" id="edit_tujuan" name="tujuan"></textarea>
						</div>
						<div class="form-group">
							<label>Sasaran</label>
							<textarea class="form-control" id="edit_sasaran" name="sasaran"></textarea>
						</div>
						<div class="form-group">
							<label>estimasi bulan</label>
							<input type="date" class="form-control" id="edit_bulan" name="bulan">
						</div>
						<div class="form-group">
							<label>dana DKM</label>
							<input type="number" class="form-control" id="edit_DKM" name="dana_DKM">
						</div>
						<div class="form-group">
							<label>dana LKM</label>
							<input type="text" class="form-control" id="edit_LKM" name="dana_LKM">
						</div>
						<div class="form-group">
							<label>dana sponsor</label>
							<input type="text" class="form-control" id="edit_sponsor" name="dana_sponsor">
						</div>
						<div class="form-group">
							<label>dana lain</label>
							<input type="text" class="form-control" id="edit_lain" name="dana_lain">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<script>
	// edit data
	$(document).on("click", ".edit-button2", function(id) {
		var id_program = this.id
		console.log(id_program);

		$.ajax({
			type: "POST",
			data: {
				id_program: id_program
			},
			url: '<?= base_url('Perencanaan/showDataEditPerencanaan') ?>',
			success: function(data) {
				var objectResult = JSON.parse(data)
				console.log(objectResult);
				$("#ROW_ID").val(objectResult.id_perencanaan);
				$("#NAMA_KEGIATAN").val(objectResult.nama_kegiatan);
				$("#edit_deskripsi").val(objectResult.deskripsi);
				$("#edit_tujuan").val(objectResult.tujuan);
				$("#edit_sasaran").val(objectResult.sasaran);
				$("#edit_bulan").val(objectResult.tgl_perencanaan);
				$("#edit_DKM").val(objectResult.dana_DKM);
				$("#edit_LKM").val(objectResult.dana_LKM);
				$("#edit_sponsor").val(objectResult.dana_sponsor);
				$("#edit_lain").val(objectResult.dana_lain);
			}
		})
	});

	//delete data
	$(document).on("click", ".swal-delete", function(id) {
		var id_del = this.id;
		// console.log("mantappps")
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
				window.location = '<?php echo base_url('Perencanaan/deletePerencanaan/') ?>' + id_del;
			}
		})
	})

	$(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );
</script>
<!-- End of Main Content -->