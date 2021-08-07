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


    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?php echo base_url('assets/img/profile/') . $user['image']; ?> " class="card-img">
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $user['name']; ?></h5>
                <p class="card-text"><?php echo $user['email']; ?> </p>
                <p class="card-text"><small class="text-muted">member since <?php echo date('d F Y', $user['date_created']); ?></small></p>
                <a class="btn btn-sm btn-info float-right" href="<?php echo base_url('user/edit_profile'); ?>"><i class="fas fa-edit"></i> Edit Profile</a>
            </div>
        </div>

    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->