<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Aksi</th>

                <th>NKK</th>
                <th>Nama</th>
                <th>Hubungan</th>


            </tr>
        </thead>
        <tbody>
            <tr>
                <?php $no = 1;
                foreach ($db_kk as $key => $value) { ?>

                    <td> <?= $no++; ?> </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah<?= $value['id_mstr']; ?>">
                            Tambah
                        </button>

                    </td>

                    <td><?= $value['nkk']; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= $value['hubungan']; ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php foreach ($db_kk as $key => $value) { ?>
    <div class="modal fade" id="modalTambah<?= $value['id_mstr']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?= form_open_multipart('Tmmp/edit/' . $value['id_mstr']) ?>
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
                            <label for="kategori">Kategori</label>
                            <input value="Tidak Mampu" type="text" name="kategori" id="kategori" class="form-control" placeholder="Masukkan Tempat Lahir">

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
<?php } ?>