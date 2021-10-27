<div class="container-fluid p-2">
  <!-- sds -->
  <?php echo $this->session->flashdata('message'); ?>
  <a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modaltambahAkun"><i class="fas fa-plus-circle"></i> Tambah akun</a>


  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="col-2">
        <input hidden type="date" id="minDate" name="minDate" class="form-control form-control-sm">
      </div>
      <!-- <span> - </span> -->
      <div class="col-2">
        <input hidden type="date" id="maxDate" name="maxDate" class="form-control form-control-sm">
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>

              <th>Foto</th>
              <th>nama</th>
              <th>email</th>
              <th width="15%">hak akses</th>
              <th width="13%">status akun</th>
              <th width="11%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($user_account as $us) : ?>
              <tr>
                <td class="text-center"><img height="50" src="<?= base_url('assets/img/profile/') . $us['image'] ?>" alt=""></td>
                <td><?= $us['name'] ?></td>
                <td><?= $us['email'] ?></td>
                <td><?php if ($us['role_id'] == 1) {
                      echo "pengawas";
                    } elseif ($us['role_id'] == 2) {
                      echo "pengurus umum";
                    } elseif ($us['role_id'] == 3) {
                      echo "pengurus kebendaharaan";
                    }
                    ?></td>
                <td>
                <?php
                if($us['is_active'] > 0){
                  echo "<a class='btn btn-sm text-info swal-activation' id='".$us['email']."' title='non-aktifkan?'><i class='fas fa-edit'></i> aktif</a>";
                }else{
                  echo "<a class='btn btn-sm text-danger swal-activation' id='".$us['email']."' title='aktifkan?'><i class='fas fa-edit'></i> non-aktif</a>";
                }
                ?>  
                </td>
                <td>
                  <a id="<?= $us['email'] ?>" class="btn btn-sm text-info edit-button2" data-toggle="modal" data-target="#modalEditAkun"><i class="fas fa-edit"></i> edit</a>
                  <a id="<?= $us['email'] ?>" class="btn btn-sm text-danger swal-delete"><i class="fas fa-trash"></i> delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>

<div class="modal fade" id="modaltambahAkun" tabindex="-1" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalsubmenulabel">Tambah Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= base_url('ManageAccount/AddAccount') ?>">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="nama user">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="email_user" name="email_user" placeholder="email user">
          </div>
          <div class="form-group">
            <select type="text" class="form-control" id="hak_akses" name="hak_akses" placeholder="hak akses">
              <option value='2'>pengurus kegiatan</option>
              <option value='3'>pengurus kebendaharaan</option>
            </select>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password1" name="password1" placeholder="password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password2" name="password2" placeholder="verifikasi password">
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

<div class="modal fade" id="modalEditAkun" tabindex="-1" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalsubmenulabel">Edit Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= base_url('ManageAccount/EditAccount') ?>">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="edit_email_user" name="email_user" placeholder="email user" title="isi dengan email yang aktif">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="edit_email_user2" name="email_user_old" placeholder="email user old" title="isi dengan email yang aktif" readonly>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="edit_nama_user" name="nama_user" placeholder="nama user">
          </div>
          <div class="form-group">
            <select type="text" class="form-control" id="edit_hak_akses" name="hak_akses" placeholder="hak akses" value="" title="anda tidak bisa memilih pengawas" disabled>
              <option disabled value='1'>pengawas</option>
              <option value='2'>pengurus kegiatan</option>
              <option value='3'>pengurus kebendaharaan</option>
            </select>
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
    var email = this.id
    console.log(email);

    $.ajax({
      type: "POST",
      data: {
        email: email
      },
      url: '<?= base_url('ManageAccount/showEditAccount') ?>',
      success: function(data) {
        var objectResult = JSON.parse(data)
        console.log(objectResult)
        $("#edit_email_user").val(objectResult.email);
        $("#edit_email_user2").val(objectResult.email);
        $("#edit_nama_user").val(objectResult.name);
        if ((objectResult.role_id) == 1) {
          $("#edit_hak_akses").prop("disabled", true);
        } else {
          $("#edit_hak_akses").removeAttr("disabled");
        }
        $("#edit_hak_akses").val(objectResult.role_id);
        $("#edit_foto_user").next('.custom-file-label').addClass("selected").html(objectResult.image);
      }
    })
  });

  //alert confirm delete
  $(document).on("click", ".swal-delete", function(id) {
    var email = this.id;
    console.log(email)
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
        $.ajax({
          type: "POST",
          data: {
            email: email
          },
          url: '<?= base_url('ManageAccount/DeleteAccount') ?>',
          success: function(data) {
            // console.log(data)
            var status = JSON.parse(data)
            if((status.status) == "success"){
              window.location = '<?php echo base_url('ManageAccount') ?>';
              // alert('berhasil di hapus');
            
            }else{
              Swal.fire({
                icon:'info',
                title:'akun anda tidak bisa di hapus!'
              });
            }
      }
    })
      }
    })
  })

  $(document).on("click", ".swal-activation", function(id) {
    var email = this.id;
    console.log(email)
    Swal.fire({
      icon: 'question',
      title: 'aktifkan / non-aktifkan?',
      width: 400,
      showCancelButton: true,
      confirmButtonColor: '#922c2c',
      cancelButtonColor: '#858796',
      confirmButtonText: 'Ok',
      // closeOnCancel: false
    }).then((result) => {


      if (result.value == true) {
        $.ajax({
          type: "POST",
          data: {
            email: email
          },
          url: '<?= base_url('ManageAccount/AccountActivation') ?>',
          success: function(data) {
            // console.log(data)
            var status = JSON.parse(data)
            if((status.status) == "success"){

              window.location = '<?php echo base_url('ManageAccount') ?>';
            }else{
              Swal.fire({
                icon:'info',
                title:'akun anda tidak bisa di non aktifkan'
              });
            }
      }
    })
      }
    })
  })
</script>