<div class="container-fluid p-2">


    <?php echo $this->session->flashdata('message'); ?>

    <a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modaltambahinventaris"><i class="fas fa-plus-circle"></i>Tambah inventaris</a>

    <div class="card shadow mb-4">
        <div class="card-body">
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
                                    <a href="#" class="btn btn-sm text-info"><i class="fas fa-sm fa-edit"></i> update</a>
                                    <a href="<?php echo base_url('Kepengurusan/delete_inventaris/') . $ivt['id']; ?>" class="btn btn-sm text-danger"><i class="fas fa-sm fa-trash"></i> delete</a>
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
                <h5 class="modal-title" id="modalsubmenulabel">Tambah inventaris</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('kepengurusan/addInventaris'); ?>" method="post">
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



</div>