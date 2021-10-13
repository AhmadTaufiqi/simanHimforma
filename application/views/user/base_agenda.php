<div class="container-fluid p-2">


    <?php echo $this->session->flashdata('message'); ?>


    <div class="right text-primary" title="kalender perencanaan">

        <a href="" class="button-fixed" data-toggle="modal" data-target="#modalShowCalendar"><i class="fas fa-calendar"></i></a>
    </div>

    <!-- <iframe src="<?php echo base_url('calendar/tb_calendar') ?>" frameborder="1" height="600px"></iframe> -->
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
                            <th class="p-2">Nama Kegiatan</th>
                            <th width="24%" class="p-2">bulan rencana</th>
                            <th width="24%" class="p-2">bulan pelaksanaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tb_agenda as $tb) : ?>
                            <tr>
                                <td><?= $tb['nama_kegiatan'] ?></td>
                                <td><?= $tb['tgl_perencanaan'] ?></td>
                                <td><?= $tb['tgl_pelaksanaan'] ?></td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>


</div>

<div class="modal fade" id="modalShowCalendar" role="dialog" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 550px !important;" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    kalender kegiatan pelaksanaan
                </div>
                <div class="card-body">
                    <embed src="<?php echo base_url('Kalender/calendar') ?>" frameborder="1" width="100%" height="500"></embed>
                </div>
            </div>
        </div>
    </div>
</div>


</div>