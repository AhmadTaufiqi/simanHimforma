<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <img class="img-icon" src="<?php echo base_url('assets/img/navbar_logo.svg') ?>" alt="">
        <div class="sidebar-brand-text">
            <p class="pt-3" style="font-size: small ;">Sistem Informasi Himforma</p>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Divider -->

    <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = "SELECT user_menu. id,menu,icon
                        FROM user_menu JOIN user_access_menu
                        ON user_menu. id=user_access_menu. menu_id
                        WHERE user_access_menu. role_id=$role_id
                        ORDER BY user_access_menu. menu_id ASC
                        ";
        $menu = $this->db->query($queryMenu)->result_array();
    ?>
    
    <?php foreach ($menu as $m) : ?>
        <li class="nav-item <?= ($this->uri->segment(1) == $m['menu']) ? 'active' : '' ?>">
        <a data-toggle="collapse" data-target="#<?= $m['menu']?>" class="nav-link collapsed" href="<?php echo base_url('user/agenda') ?>">
            <i class="<?php echo $m['icon']; ?>"></i>
            <span><?= $m["menu"]?></span></a>
            <div id="<?= $m['menu']?>" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

        <?php

        $menuid = $m['id'];
        $querySubmenu = "SELECT * FROM user_sub_menu 
                        WHERE menu_id=$menuid
                        AND is_active =1";
        $subMenu = $this->db->query($querySubmenu)->result_array();
        ?>

        <?php foreach ($subMenu as $sm) : ?>
            <a class="collapse-item" href="<?php echo base_url($sm['url']) ?>">
            <span><?php echo $sm['title']; ?></span></a>
        <?php endforeach; ?>

        </div>
        </div>
    </li>
        <hr class="sidebar-divider my-2">
    <?php endforeach ?>



    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>sign out</span></a>
    </li>

</ul>
<!-- End of Sidebar -->