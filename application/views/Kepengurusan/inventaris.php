<div class="container-fluid p-2">


    <?php echo $this->session->flashdata('message'); ?>

    <a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modaltambahinventaris"><i class="fas fa-plus-circle"></i>Tambah inventaris</a>

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

                            <th>Nama barang</th>
                            <th width="22%">Jumlah barang</th>
                            <th width="22%">kondisi barang</th>
                            <th width="10%">aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($this->db->get_where('inventaris')->result_array() as $ivt) : ?>
                            <tr>
                                <td><?php echo $ivt['nama_barang']; ?></td>
                                <td><?php echo $ivt['jumlah_barang']; ?></td>
                                <td><?php echo $ivt['kondisi']; ?></td>
                                <td>
                                    <a id="<?= $ivt['id_ivt'] ?>" class="btn btn-sm text-info edit-button2" data-toggle="modal" data-target="#modalEditIvt"><i class="fas fa-sm fa-edit"></i> update</a>
                                    <a id="<?= $ivt['id_ivt']?>" class="btn btn-sm text-danger swal-delete"><i class="fas fa-sm fa-trash"></i> delete</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>





</div>
<div class="modal fade" id="modalEditIvt" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit">edit data kegiatan terlaksana</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('Inventaris/editInventaris'); ?>" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="ROW_ID" name="ROW_ID" placeholder="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="edit_nama_barang" name="nama_barang" placeholder="nama barang">
                    </div>

                    <div class="form-group">

                        <input type="text" class="form-control" id="edit_jumlah_barang" name="jumlah_barang" placeholder="jumlah barang">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="edit_kondisi" name="kondisi" placeholder="kondisi barang">
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

<div class="modal fade" id="modaltambahinventaris" tabindex="-1" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalsubmenulabel">Tambah inventaris</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('Inventaris/addInventaris'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="nama barang">
                    </div>

                    <div class="form-group">

                        <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="jumlah barang">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kondisi" name="kondisi" placeholder="kondisi">
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
        window.location = '<?php echo base_url('Inventaris/delInventaris/') ?>' + id_del;
        // console.log(id_del)
      }
    })
  })
</script>
<script>
    $(document).on("click", ".edit-button2", function(id) {
        var id_inventaris = this.id
        console.log(id_inventaris);
        $.ajax({
            type: "POST",
            data: {
                id_inventaris: id_inventaris
            },
            url: '<?= base_url('Inventaris/showDataEditIvt') ?>',
            success: function(data) {
                var objectResult = JSON.parse(data)
                console.log(objectResult);
                $("#ROW_ID").val(objectResult.id_ivt);
                $("#edit_jumlah_barang").val(objectResult.jumlah_barang);
                $("#edit_nama_barang").val(objectResult.nama_barang);
                $("#edit_kondisi").val(objectResult.kondisi);
            }
        })
    });
</script>

</div>