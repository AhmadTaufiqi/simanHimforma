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
              <th width="20%">file proposal</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pelaksanaan as $ar) : ?>
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
                              <li class="list-group-item p-1"><span class="text-primary">Nama File : </span><?= $ar['file_proposal'] ?></li>
                              <li class="list-group-item p-1 "><span class="text-primary">tanggal pelaksanaan : </span><?= $ar['tgl_pelaksanaan'] ?> </li>
                              <li class="list-group-item px-1"><span class="text-primary">Status :</span> TERLAKSANA</li>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="delete-pelaksanaan">

                        <a class="btn btn-sm edit-button2" id="<?= $ar['id'] ?>" style="text-align:left;" data-toggle="modal" data-target="#modalEditProg">
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
                  <a href="<?= base_url('assets/files/proposal_terlaksana/') . $ar['file_proposal'] ?>" class="btn shadow2" target="blank" style="height:150px; display: flex; flex-direction: column;align-items:center; overflow:hidden;">
                    <img width="100" src="<?= base_url('assets/img/book_icon.png') ?>" alt="">
                    <span><?= $ar['nama_kegiatan'] ?></span>
                  </a>
                </td>
              </tr>

            <?php endforeach; ?>
          </tbody>

        </table>
      </div>
    </div>
  </div>



  <div class="modal fade" id="modaltambahdokumen" tabindex="-1" role="dialog" aria-labelledby="modaldokumen" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modaldokumen">input kegiatan terlaksana</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php echo form_open_multipart('crudKegiatan/addPelaksanaan'); ?>
        <div class="modal-body">
          <div class="form-group">
            <select class="form-control option_kegiatan" name="option_kegiatan">
              <option selected="true" disabled="true">pilih program</option>
              <?php foreach ($program->result_array() as $pr) : ?>
                <option class="option_prog" value="<?= $data["value"] = $pr['id'] ?>"><?= $pr['nama_prog'] ?></option>

              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="date" class="form-control" id="date-control" name="tgl_pelaksanaan">
            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan">

          </div>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="file" name="file">
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
  <div class="modal fade" id="modalEditProg" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEdit">edit data kegiatan terlaksana</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php echo form_open_multipart('crudKegiatan/editPelaksanaan'); ?>
        <div class="modal-body">
          <input type="text" class="form-control" id="ROW_ID" name="ROW_ID" placeholder="" hidden>
          <div class="form-group">
            <input type="text" class="form-control" id="NAMA_KEGIATAN" name="nama" readonly>
          </div>
          <!-- <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="deskripsi">
                    </div> -->

          <div class="custom-file">
            <input type="file" class="custom-file-input" id="FILE" name="file">
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
    var id_program = this.id
    console.log(id_program);

    $.ajax({
      type: "POST",
      data: {
        id_program: id_program
      },
      url: '<?= base_url('crudKegiatan/showDataEditPelaksanaan') ?>',
      success: function(data) {
        var objectResult = JSON.parse(data)
        $("#ROW_ID").val(objectResult.id);
        $("#NAMA_KEGIATAN").val(objectResult.nama_kegiatan);
        $("#FILE").next('.custom-file-label').addClass("selected").html(objectResult.file_proposal);
      }
    })
  });


  $(document).on("change", ".option_kegiatan", function(id) {

    var id_keg = this.value;
    $.ajax({
      type: "POST",
      data: {
        id_keg: id_keg
      },
      url: '<?php echo base_url('crudKegiatan/showDataTglComboKeg') ?>',
      success: function(data) {
        var result = JSON.parse(data)
        // console.log(result)
        $("#date-control").val(result.id_agenda);
        $("#nama_kegiatan").val(result.nama_prog);
      }
    })
  })


  //alert confirm delete
  $(document).on("click", ".swal-delete", function(id) {
    var id_del = this.id;
    // console.log("mantappps")
    Swal.fire({
      icon:'question',
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
        window.location = '<?php echo base_url('crudKegiatan/deletePelaksanaan/') ?>' + id_del;
        console.log(id_del)
      }
    })
  })
</script>
<!-- End of Main Content -->