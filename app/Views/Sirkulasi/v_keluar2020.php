<a type="button" class="btn btn-primary" href="/Keluar/tambah"><i class="fas fa-plus"></i></a>
<br><br>
<?php if (!empty(session()->getFlashdata('success'))) { ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php } ?>
<?php if (!empty(session()->getFlashdata('ubah'))) { ?>
    <div class="alert alert-warning">
        <?= session()->getFlashdata('ubah'); ?>
    </div>
<?php } ?>
<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Tempat Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Keluar</th>
                <th>Alamat Tujuan</th>
                <th>Keg/Kel Tujuan</th>
                <th>Pelapor</th>



            </tr>
        </thead>
        <tbody>
            <tr>
                <?php $no = 1;
                foreach ($db_mstr as $key => $value) { ?>


                    <td> <?= $no++; ?> </td>
                    <td>
                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalEdit<?= $value['id_mstr']; ?>"><i class="fas fa-edit fa-xs"></i></i></button>
                        <a href="/Datamaster/detail/<?= $value['id_mstr']; ?>" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>

                    </td>

                    <td><?= $value['nik']; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= tanggal_indo($value['tgl_lahir']); ?></td>
                    <td><?= $value['tmp_lahir']; ?></td>
                    <td><?= $value['jekel']; ?></td>
                    <td><?= tanggal_indo($value['tgl_mmp']); ?></td>
                    <td><?= $value['alamat_astj']; ?></td>
                    <td><?= $value['keg_astj']; ?></td>
                    <td><?= $value['pelapor']; ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div><?php foreach ($db_mstr as $key => $value) { ?>
    <div class="modal fade" id="modalEdit<?= $value['id_mstr']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?= form_open_multipart('Keluar/ubah/' . $value['id_mstr']) ?>
                        <input type="hidden" name="id_mstr" value="<?= $value['id_mstr']; ?>">

                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input value="<?= $value['nik']; ?>" type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan Tempat Lahir">

                        </div>
                        <div class="form-group">
                            <label for="nama">NAMA</label>
                            <input value="<?= $value['nama']; ?>" type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Tempat Lahir">

                        </div>
                        <div class="form-group">
                            <label for="tgl_mmp">Tanggal Masuk</label>
                            <input value="<?= $value['tgl_mmp']; ?>" type="text" name="tgl_mmp" id="tgl_mmp" class="form-control" placeholder="">

                        </div>
                        <div class="form-group">
                            <label for="alamat_astj">Alamat Tujuan</label>
                            <input value="<?= $value['alamat_astj']; ?>" type="text" name="alamat_astj" id="alamat_astj" class="form-control" placeholder="">

                        </div>
                        <div class="form-group">
                            <label for="keg_astj">Keg/Kel Tujuan</label>
                            <input value="<?= $value['keg_astj']; ?>" type="text" name="keg_astj" id="keg_astj" class="form-control" placeholder="">

                        </div>
                        <div class="form-group">
                            <label for="pelapor">Pelapor</label>
                            <input value="<?= $value['pelapor']; ?>" type="text" name="pelapor" id="pelapor" class="form-control" placeholder="">

                        </div>

                        <div class="form-group">

                            <input value="Ada" type="hidden" name="stts_hidup" id="stts_hidup" class="form-control" placeholder="Masukkan Tempat Lahir">

                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
<?php } ?>