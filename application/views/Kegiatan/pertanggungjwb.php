<!-- Content Wrapper -->


<!-- Begin Page Content -->
<div class="container-fluid p-2">


	<?php echo $this->session->flashdata('message'); ?>

	<a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modaltambahdokumen"><i class="fas fa-plus-circle"></i> tambah data</a>
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>program</th>
							<th>file laporan</th>
						</tr>
					</thead>

					<?php foreach ($pertanggung_jwb as $ar) : ?>
						<tr>
							<td>


								<div class="card shadow2" style="height:150px;">
									<div>
										<div class="card-body p-3">
											<div class="row">
												<div class="col-3 px-3">
													<h5 class="font-weight-bold text-uppercase"><?= $ar['nama_kegiatan'] ?></h5>
													<p><?= $ar['deskripsi'] ?></p>
												</div>
												<div class="col">
													<div class="list-group list-group-flush">
														<li class="list-group-item p-1"><span class="text-primary">Nama File : </span><?= $ar['lpj'] ?></li>
														<li class="list-group-item p-1 "><span class="text-primary">link drive : </span><a href="<?= $ar['link_dokumentasi'] ?>" class="text-info" target="_tab" rel="noopener noreferrer">kunjungi link</a></li>
														<li class="list-group-item px-1"><span class="text-primary">Status : </span><?= $ar['hasil'] ?></li>
													</div>
												</div>
											</div>

										</div>
										<div class="delete-pelaksanaan">

											<a href="edit" class="btn btn-sm edit-button2" id="<?= $ar['id'] ?>" style="text-align:left;" data-toggle="modal" data-target="#modalEditLPJ">
												<i class="fas fa-edit text-info"></i>
											</a>
											<a class="btn btn-sm swal-delete" id="<?= $ar['id'] ?>">
												<i class="fas fa-trash text-danger"></i>
											</a>
											<!-- <a href="btn btn-sm">
                          <i class="fas fa-trash text-danger"></i>
                        </a> -->
										</div>
									</div>
								</div>
							</td>
							<td>
								<a href="<?= base_url('assets/files/LPJ/') . $ar['lpj'] ?>" class="btn shadow2" target="blank" style="height:150px; display: flex; flex-direction: column;align-items:center; overflow:hidden;">
									<img width="100" src="<?= base_url('assets/img/book_icon.png') ?>" alt="">
									<span><?= $ar['nama_kegiatan'] ?></span>
								</a>
							</td>
						</tr>

					<?php endforeach; ?>

				</table>
			</div>
		</div>
	</div>


	<!-- modal toggle tambah pertanggungjawaban -->
	<div class="modal fade" id="modaltambahdokumen" tabindex="-1" role="dialog" aria-labelledby="modaldokumen" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modaldokumen">Tambah dokumen</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php echo form_open_multipart('crudKegiatan/addPertanggungjawaban'); ?>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control" hidden>
						<!-- <label for="">id prog</label> -->
						<input type="text" id="id_prog" name="id_prog" class="form-control" hidden>
						<select class="form-control option_kegiatan" name="option_kegiatan" title="pilih kegiatan yang belum tersedia">

							<option selected="true" disabled="true">pilih program</option>
							<?php foreach ($prog_terlaksana as $pr) : ?>
								<option class="option_prog" value="<?= $data["value"] = $pr['id'] ?>"><?= $pr['nama_kegiatan'] ?></option>

							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="link_doc" name="link_doc" placeholder="link dokumentasi" title="anda dapat mengirim link folder dokumentasi dari drive">
					</div>

					<div class="custom-file">
						<input type="file" class="custom-file-input" id="add_file" name="file">
						<label class="custom-file-label" for="file">choose file</label>
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

	<!-- modal edit pertanggungjawaban -->
	<div class="modal fade" id="modalEditLPJ" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalEdit">edit data pertanggungjawaban</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php echo form_open_multipart('crudKegiatan/editPertanggungjwb'); ?>
				<div class="modal-body">
					<input type="" class="form-control" name="ROW_ID" id="ROW_ID" hidden>
					<div class="form-group">
						<input type="" class="form-control" name="NAMA_KEGIATAN" id="NAMA_KEGIATAN" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="LINK_DOKUMENTASI" name="LINK_DOKUMENTASI" placeholder="link dokumentasi">
					</div>

					<div class="custom-file">
						<input type="file" class="custom-file-input" id="edit_file" name="file">
						<label class="custom-file-label" for="file">choose file</label>
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
<script type="text/javascript">
	$(document).on("click", ".edit-button2", function(id) {
		var id_lpj = this.id
		console.log(id_lpj);

		$.ajax({
			type: "POST",
			data: {
				id_lpj: id_lpj
			},
			url: '<?= base_url('crudKegiatan/showEditLPJ') ?>',
			success: function(data) {
				var objectResult = JSON.parse(data)
				console.log(objectResult)
				$("#ROW_ID").val(objectResult.id);
				$("#NAMA_KEGIATAN").val(objectResult.nama_kegiatan);
				$("#LINK_DOKUMENTASI").val(objectResult.link_dokumentasi);
				$("#edit_file").next('.custom-file-label').addClass("selected").html(objectResult.lpj);
			}
		})
	});

	$(document).on("change", ".option_kegiatan", function(id) {
		var id_keg = this.value;
		console.log(id_keg)
		$.ajax({
			type: "POST",
			data: {
				id_keg: id_keg
			},
			url: '<?php echo base_url('crudKegiatan/showDataComboLPJ') ?>',
			success: function(data) {
				var result = JSON.parse(data)
				// console.log(result)
				$("#id_pelaksanaan").val(result.id);
				$("#id_prog").val(result.id_prog);
				$("#nama_kegiatan").val(result.nama_kegiatan);
			}
		})
	})

	//alert confirm delete
	$(document).on("click", ".swal-delete", function(id) {
		var id_del = this.id;
		// console.log("mantappps")
		console.log(id_del)
		Swal.fire({
			icon:'question',
			title: 'Are you sure?',
			width: 400,
			showCancelButton: true,
			confirmButtonColor: '#922c2c',
			cancelButtonColor: '#858796',
			confirmButtonText: 'Yes, delete it!',
			// closeOnCancel: false
		}).then((result) => {

			if (result.value == true) {
				window.location = '<?php echo base_url('crudKegiatan/deletePertanggungjwb/') ?>' + id_del;
			}
		})
	})
</script>
<!-- End of Main Content -->