<!-- Content Wrapper -->


<!-- Begin Page Content -->
<div class="container-fluid p-2">


    <?php echo $this->session->flashdata('message'); ?>
    <?php
    // echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); 
    //  echo form_error('tujuan', '<small class="text-danger pl-3">', '</small>'); 
    ?>

    <a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modaltambahdokumen"><i class="fas fa-plus-circle"></i> tambah data</a>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>nama program</th>
                            <th>deskripsi</th>
                            <th width="19%">tujuan</th>
                            <th width="19%">sasaran</th>
                            <th width="12%">estimasi bulan</th>
                            <th width="10%">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->db->get_where('program')->result_array() as $ar) : ?>
                            <tr>
                                <td><?php echo $ar['nama_prog'] ?></td>
                                <td><?php echo $ar['deskripsi'] ?></td>
                                <td><?php echo $ar['tujuan'] ?>
                                </td>
                                <td><?php echo $ar['sasaran'] ?></td>
                                <td><?php echo substr($ar['id_agenda'], 0, 7) ?></td>
                                <td>
                                    <a href="edit" class="btn btn-sm text-info"><i class="fas fa-sm fa-edit"></i> update</a>
                                    <a id="<?= $ar['id']; ?>" class="btn btn-sm text-danger swal-delete"><i class="fas fa-sm fa-trash"></i> delete</a>
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
                    <h5 class="modal-title" id="modaldokumen">Tambah Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('crudKegiatan/addProgram') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama program">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="tujuan">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="sasaran" name="sasaran" placeholder="sasaran">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="deskripsi">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="bulan" id="bulan">
                                <option value="januari">januari</option>
                                <option value="februari">februari</option>
                                <option value="maret">maret</option>
                                <option value="april">april</option>
                                <option value="mei">mei</option>
                                <option value="juni">juni</option>
                                <option value="juli">juli</option>
                                <option value="agustus">agustus</option>
                                <option value="september">september</option>
                                <option value="oktober">oktober</option>
                                <option value="november">november</option>
                                <option value="desember">desember</option>
                            </select>
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
<script>
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
                window.location = '<?php echo base_url('crudKegiatan/deletePerencanaan/') ?>' + id_del;
            }
        })
    })
</script>
<!-- End of Main Content -->