<!-- Content Wrapper -->


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card" style="max-width:400px;">
        <div class="row mx-3">
            <div class="col-lg-12">
                <form action="<?php echo base_url('user/editpassword'); ?>" method="post">
                    <div class="form-group mt-3">
                        <label for="current_password">current password</label>
                        <input class="form-control" type="password" name="current_password" id="current_password">
                        <?php echo form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="current_password">current password</label>
                        <input class="form-control" type="password" name="new_password1" id="new_password1">
                        <?php echo form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="current_password">current password</label>
                        <input class="form-control" type="password" name="new_password2" id="new_password2">
                        <?php echo form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->