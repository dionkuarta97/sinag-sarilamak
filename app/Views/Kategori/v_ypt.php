<a type="button" class="btn btn-primary" href="/Ypt/tambah"><i class="fas fa-plus"></i></a>
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
                <th>Anak</th>
                <th>Umur</th>



            </tr>
        </thead>
        <tbody>
            <tr>
                <?php $no = 1;
                foreach ($db_kk as $key => $value) { ?>

                    <td> <?= $no++; ?> </td>
                    <td>
                        <a href="/Datamaster/detail/<?= $value['id_mstr']; ?>" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>
                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalEdit<?= $value['id_mstr']; ?>"><i class="fas fa-edit fa-xs"></i></i></button>
                    </td>

                    <td><?= $value['nik']; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= $value['anak']; ?></td>
                    <td><?= hitung_umur($value['tgl_lahir']); ?></td>


            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- /.card-body -->
<?php foreach ($db_kk as $key => $value) { ?>
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
                        <?= form_open_multipart('Ypt/ubah/' . $value['id_mstr']) ?>
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
                            <label for="anak">ANAK</label>
                            <select class="form-control" name="anak" id="anak">
                                <option selected>---<?= $value['anak']; ?>---</option>
                                <option value="Lengkap">Lengkap</option>
                                <option value="Yatim">Yatim</option>
                                <option value="Piatu">Piatu</option>
                                <option value="Yatim Piatu">Yatim Piatu</option>
                            </select>
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