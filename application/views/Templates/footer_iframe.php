</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<!-- <script src="<?php echo base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

<!-- Core plugin JavaScript-->
<!-- <script src="<?php echo base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script> -->

<!-- Custom scripts for all pages-->
<!-- <script src="<?php echo base_url('assets/'); ?>js/sb-admin-2.min.js"></script> -->
<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
</script>

<script src="<?php echo base_url('assets/') ?>kalender/tanggalan/jquery.min.js"></script>
<script src="<?php echo base_url('assets/') ?>kalender/tanggalan/moment.js"></script>
<script src="<?php echo base_url('assets/') ?>kalender/tanggalan/fullcalendar/fullcalendar.min.js"></script>
<!-- <script src="<?php echo base_url('assets/') ?>kalender/tanggalan/script.js"></script> -->
<script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            selectable: true,
            selctHelper: true,
            header: {
                title:'tesss',
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek'
            },
            buttonText: {
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            events: "<?php echo base_url('Kalender/load'); ?>",
        });
    });
</script>

<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script> -->
<!-- <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->

<!-- <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script> -->
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<!-- <script src="<?php echo base_url('assets/') ?>vendor/jquery/jquery.min.js"></script> -->
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/') ?>js/demo/datatables-demo.js"></script>

</body>

</html>