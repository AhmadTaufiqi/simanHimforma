<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span> <span style="color: #bebebe;">Copyright &copy;</span> Ahmad Taufiqi Muhsinin (sebagai syarat kelulusan) <?php echo date('Y') ?></>
        </div>
    </div>
</footer>
<!-- End of Footer -->

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

<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url('assets/') ?>kalender/tanggalan/jquery.min.js"></script>
<script src="<?php echo base_url('assets/') ?>kalender/tanggalan/moment.js"></script>
<script src="<?php echo base_url('assets/') ?>kalender/tanggalan/fullcalendar/fullcalendar.min.js"></script>
<script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            selectable: true,
            selctHelper: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
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
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);
</script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script>
    var minDate;
    var maxDate;
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            // if ((minDate == "") && (maxDate) == "") {
            var min = minDate.val();
            var max = maxDate.val();
            // }else{
            //     var min = minDate;
            //     var max = maxDate;
            // }
            var date = data[4];
            if (
                // (min === null && max === null) ||
                (min == "" && max == "") ||
                (min == "" && date <= max) ||
                (min <= date && max == "") ||
                (min <= date && date <= max)
            ) {
                return true;
            } else {
                return false;
            }
        });

    $(document).ready(function() {
        minDate = $('#minDate');
        maxDate = $('#maxDate');

        // DataTables initialisation
        var table = $('#dataTable').DataTable();

        // Refilter the table
        $('#minDate, #maxDate').on('change', function() {
            table.draw();
        });
    });
    
</script>

<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
</body>

</html>