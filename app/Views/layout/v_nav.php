<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview <?= ($tittle == 'Halaman Utama' ? 'menu-open' : '') ?>">
            <a href="<?= base_url('home') ?>" class="nav-link <?= ($tittle == 'Halaman Utama' ? 'active' : '') ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Halaman Utama

                </p>
            </a>
        </li>

        <li class="nav-item has-treeview <?= ($tittle == 'Data Master' || $tittle == 'Kartu Keluarga' ? 'menu-open' : '') ?>">
            <a href="#" class="nav-link <?= ($tittle == 'Data Master' || $tittle == 'Kartu Keluarga' ? 'active' : '') ?> ">
                <i class="nav-icon fas fa-database"></i>
                <p>
                    Data Penduduk
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('Datamaster') ?>" class="nav-link <?= ($tittle == 'Data Master' ? 'active' : '') ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Master</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Datakk/') ?>" class="nav-link <?= ($tittle == 'Kartu Keluarga' ? 'active' : '') ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kartu Keluarga</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview <?= ($tittle == 'Tidak Mampu' || $tittle == 'Keluarga Harapan' || $tittle == 'RUTILAHU' || $tittle == 'Yatim Piatu' ? 'menu-open' : '') ?>">
            <a href="#" class="nav-link <?= ($tittle == 'Tidak Mampu' || $tittle == 'Keluarga Harapan' || $tittle == 'RUTILAHU' || $tittle == 'Yatim Piatu' ? 'active' : '') ?>">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Kategori
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('Tmmp') ?>" class="nav-link <?= ($tittle == 'Tidak Mampu' ? 'active' : '') ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tidak Mampu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Pkh') ?>" class="nav-link <?= ($tittle == 'Keluarga Harapan' ? 'active' : '') ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Keluarga Harapan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Rutilahu') ?>" class="nav-link <?= ($tittle == 'RUTILAHU' ? 'active' : '') ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>RUTILAHU</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Ypt') ?>" class="nav-link <?= ($tittle == 'Yatim Piatu' ? 'active' : '') ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Yatim Piatu</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview <?= ($tittle == 'Kelahiran' || $tittle == 'Meninggal' || $tittle == 'Masuk' || $tittle == 'Keluar' ? 'menu-open' : '') ?>">
            <a href="#" class="nav-link <?= ($tittle == 'Kelahiran' || $tittle == 'Meninggal' || $tittle == 'Masuk' || $tittle == 'Keluar' ? 'active' : '') ?>">
                <i class="nav-icon fas fa-heartbeat"></i>
                <p>
                    Sirkulasi
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('Datalahir') ?>" class="nav-link <?= ($tittle == 'Kelahiran' ? 'active' : '') ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kelahiran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Meninggal') ?>" class="nav-link <?= ($tittle == 'Meninggal' ? 'active' : '') ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Meninggal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Masuk') ?>" class="nav-link <?= ($tittle == 'Masuk' ? 'active' : '') ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Masuk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Keluar') ?>" class="nav-link <?= ($tittle == 'Keluar' ? 'active' : '') ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Keluar</p>
                    </a>

            </ul>
        </li>


        <li class="nav-header">Lainya</li>
        <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
                <i class="nav-icon far fa-sign-out"></i>
                <p>
                    Logout

                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
                <i class="nav-icon far fa-user-circle-o"></i>
                <p>
                    Kelola User
                </p>
            </a>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $tittle; ?></h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->