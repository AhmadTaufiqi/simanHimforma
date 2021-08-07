<div class="container-fluid p-2">


    <?php echo $this->session->flashdata('message'); ?>

    <a href="" class="btn btn-primary btn-sm button-fixed btm-right-end" data-toggle="modal" data-target="#modaltambahagenda"><i class="fas fa-plus-circle"></i> Tambah agenda</a>
    <div class="right text-primary">

        <a href="" class="button-fixed" data-toggle="modal" data-target="#modalShowCalendar"><i class="fas fa-calendar"></i></a>
    </div>

    <!-- <iframe src="<?php echo base_url('calendar/tb_calendar') ?>" frameborder="1" height="600px"></iframe> -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>tanggal</th>
                            <th>uraian</th>
                            <th>debit</th>
                            <th>kredit</th>
                            <th>saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->db->get_where('arsip')->result_array() as $ar) : ?>


                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>


</div>

<div class="modal fade" id="modalShowCalendar" role="dialog" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <embed src="<?php echo base_url('Kalender/calendar') ?>" frameborder="1" height="520px" width="600px"></embed>
        </div>
    </div>
</div>

<div class="modal fade" id="modaltambahagenda" tabindex="-1" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalsubmenulabel">Tambah Agenda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('Kalender/tambahAgenda'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="form-field-select-3">Status:</label>
                        <div>
                            <select class="form-control" name="agenda" id="agenda">
                                <option value="acara">acara</option>
                                <option value="rapat">rapat</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <span>keterangan</span>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="keterangan">
                    </div>
                    <div class="form-group">
                        <span>tanggal mulai</span>
                        <input type="date" class="form-control" id="start" name="start" placeholder="tanggal">
                    </div>
                    <div class="form-group">
                        <span>tanggal berakhir</span>
                        <input type="date" class="form-control" id="end" name="end" placeholder="tanggal">
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