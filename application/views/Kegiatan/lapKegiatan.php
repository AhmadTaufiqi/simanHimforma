<div class="container-fluid p-2">


  <?php echo $this->session->flashdata('message'); ?>


  <div class="card shadow mb-4">
    <div class="card-body">
      <input type="date" id="minDate" name="minDate" class="form-control form-control-sm" hidden>
      <input type="date" id="maxDate" name="maxDate" class="form-control form-control-sm" hidden>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              
              <th>perencanaan</th>
              <th width="30%">pelaksanaan</th>
              <th width="30%">pertanggungjawaban</th>
              
            </tr>
          </thead>
          <tbody>
            <?php foreach($lapPerencanaan as $rencana):?>
            <tr>
              <td class="p-1">
                <div class="row p-2">

                  <div class="col px-1 d-flex flex-column">
                    <h4 class="mb-1 font-weight-bold"><?= $rencana['nama_kegiatan']?></h4>
                    <p class="mb-2"><?= $rencana['deskripsi']?></p>
                    <div class="row mt-auto">
                      <div class="col-5 pr-0">
                        <p class=" mb-0">tanggal: </p>
                      </div>
                      <div class="col pl-0">
                        <p class="mb-0"><?= $rencana['tgl_perencanaan']?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-5 px-1">
                    <h5 class="mb-1 font-weight-bold">Tujuan</h5>
                    <p class="mb-2"><?= $rencana['tujuan']?></p>
                    <h5 class="mb-1 font-weight-bold">Sasasran</h5>
                    <p class="mb-2"><?= $rencana['sasaran']?></p>
                  </div>
                </div>
              </td>

              <?php 
              $pelaksanaan = $this->db->get_where('pelaksanaan',['id_perencanaan' => $rencana['id_perencanaan']])->row_array();
              if(!$pelaksanaan){
                $pelaksanaan['nama_kegiatan'] = "-";
                $pelaksanaan['tgl_pelaksanaan'] = "-";
                $pelaksanaan['file_proposal'] = "-";
              }
                ?>
              <td class="p-1">
                <div class=" p-2">
                  <div class="row px-2">
                    <div class="col px-1 d-flex flex-column">
                      <h4 class="mb-1 font-weight-bold"><?= $pelaksanaan['nama_kegiatan']?></h4>
                      <div class="row mt-auto">
                        <div class="col-5 pr-0">
                          <p class=" mb-0">tanggal: </p>
                        </div>
                        <div class="col pl-0">
                          <p class="mb-0"><?= $pelaksanaan['tgl_pelaksanaan']?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col px-1">
                      <a href="<?= base_url('assets/files/proposal_terlaksana/') . $pelaksanaan['file_proposal'] ?>" class="btn p-2 shadow2" target="blank" style="height:140px; display: flex; flex-direction: column;align-items:center; overflow:hidden;">
                        <img width="100" src="<?= base_url('assets/img/book_icon.png') ?>" alt="">
                        <span><?= $pelaksanaan['nama_kegiatan'] ?></span>
                      </a>
                    </div>
                  </div>
                </div>
              </td>
              <?php
              $pertanggungjwb = $this->db->get_where('pertanggungjwb',['id_perencanaan' => $rencana['id_perencanaan']])->row_array();
              if(!$pertanggungjwb){
                $pertanggungjwb['nama_kegiatan'] = "-";
                $pertanggungjwb['link_dokumentasi'] = "-";
                $pertanggungjwb['catatan'] = "-";
                $pertanggungjwb['file_lpj'] = "-";
              }
              ?>
              <td class="p-1">
                <div class=" p-2">
                  <div class="row px-2">
                    <div class="col-5 px-1 d-flex flex-column">
                      <h4 class="mb-1 font-weight-bold"><?= $pertanggungjwb['nama_kegiatan']?></h4>
                      <span><?= $pertanggungjwb['catatan']?></span>
                      <a class=" text-info" href="<?= $pertanggungjwb['link_dokumentasi']?>" title="(jika ada)" target="_blank">buka link</a>
                    </div>
                    <div class="col px-1">
                      <a href="<?= base_url('assets/files/LPJ/') . $pertanggungjwb['file_lpj'] ?>" class="btn p-2 shadow2" target="blank" style="height:140px; display: flex; flex-direction: column;align-items:center; overflow:hidden;">
                        <img width="100" src="<?= base_url('assets/img/book_icon.png') ?>" alt="">
                        <span><?= $pertanggungjwb['nama_kegiatan'] ?></span>
                      </a>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalkonfirmasi" tabindex="-1" role="dialog" aria-labelledby="modalsubmenulabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalsubmenulabel">konfimasi proposal pelaksanaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php echo form_open_multipart('Prestasi/addPrestasi'); ?>
        <div class="modal-body">

          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="foto_prestasi" name="foto_prestasi">
            <label class="custom-file-label" for="file">choose photo</label>
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


</div>