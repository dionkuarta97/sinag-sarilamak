<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit">
    Edit Data
</button>
<br><br>
<?php if (!empty(session()->getFlashdata('success'))) { ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php } ?>
<br>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle; ?></h3>
    </div>

    <!-- /.card-header -->
    <div class="card-body">

        <strong> NIK</strong>

        <p class="text-muted">
            <?= $db_mstr['nik']; ?>
        </p>

        <hr>

        <strong>NKK</strong>

        <p class="text-muted"><?= $db_mstr['nkk']; ?>
            <hr><span><a href="/Datakk/detail/<?= $db_mstr['nkk']; ?>" class="btn btn-info">KELUARGA</a></span></p>

        <hr>

        <strong>Nama</strong>

        <p class="text-muted">
            <?= $db_mstr['nama']; ?>
        </p>



        <hr>

        <strong>Jenis Kelamin</strong>

        <p class="text-muted">
            <?= $db_mstr['jekel']; ?>
        </p>

        <strong>Tempat Lahir</strong>

        <p class="text-muted">
            <?= $db_mstr['tmp_lahir']; ?>
        </p>


        <hr>
        <strong>Tanggal Lahir</strong>
        <p class="text-muted"><?= tanggal_indo($db_mstr['tgl_lahir']); ?></p>
        <hr>

        <strong>Umur</strong>
        <p class="text-muted"><?= hitung_umur($db_mstr['tgl_lahir']); ?></p>
        <hr>
        <strong>Kenagarian</strong>
        <p class="text-muted"><?= $db_mstr['kenagarian']; ?></p>
        <hr>
        <strong>Jorong</strong>
        <p class="text-muted"><?= $db_mstr['jorong']; ?></p>
        <hr>
        <strong>Agama</strong>
        <p class="text-muted">
            <?= $db_mstr['agama']; ?>
        </p>
        <hr>

        <strong>Pekerjaan</strong>
        <p class="text-muted">
            <?= $db_mstr['pekerjaan']; ?>

        </p>
        <hr>
        <strong>Status Perkawinan</strong>
        <p class="text-muted"> <?= $db_mstr['stts_kwn']; ?></p>

        <hr>
        <strong>Hubungan Keluarga</strong>
        <p class="text-muted"> <?= $db_mstr['id_hub']; ?></p>

        <hr>
        <strong>Nama Ayah</strong>
        <p class="text-muted"> <?= $db_mstr['nama_ayah']; ?></p>

        <hr>
        <strong>Nama Ibu</strong>
        <p class="text-muted"> <?= $db_mstr['nama_ibu']; ?></p>









    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="<?= base_url('Datamaster/update/' . $db_mstr['id_mstr']) ?>" method="post">

                        <input type="hidden" name="id_mstr" value="<?= $db_mstr['id_mstr']; ?> ">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input value="<?= $db_mstr['nik']; ?>" type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK">

                        </div>
                        <div class="form-group">
                            <label for="nkk">NKK</label>
                            <input value=<?= $db_mstr['nkk']; ?> type="text" name="nkk" id="nkk" class="form-control" placeholder="Masukkan NKK">

                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $db_mstr['nama']; ?>">

                        </div>
                        <div class="form-group">
                            <label for="tmp_lahir">Tempat Lahir</label>
                            <input value="<?= $db_mstr['tmp_lahir']; ?>" type="text" name="tmp_lahir" id="tmp_lahir" class="form-control" placeholder="Masukkan Tempat Lahir">

                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input value="<?= $db_mstr['tgl_lahir']; ?>" type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir (YYYY-MM-DD)">

                        </div>
                        <div class="form-group">
                            <label for="kenagarian">Kenagarian</label>
                            <input value="<?= $db_mstr['kenagarian']; ?>" type="text" name="kenagarian" id="kenagarian" class="form-control" placeholder="Masukkan Kenagarian">

                        </div>
                        <div class="form-group">
                            <label for="jorong">Jorong</label>
                            <input value="<?= $db_mstr['jorong']; ?>" type="text" name="jorong" id="jorong" class="form-control" placeholder="Masukkan Jorong">

                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select class="form-control" name="agama" id="agama">
                                <option selected><?= $db_mstr['agama']; ?></option>
                                <option value="Islam">Islam</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Kong hu cu">Kong hu cu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input value="<?= $db_mstr['pekerjaan']; ?>" type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Masukkan Pekerjaan">

                        </div>
                        <div class="form-group">
                            <label for="id_hub">Hubungan Keluarga</label>
                            <input value="<?= $db_mstr['id_hub']; ?>" type="text" name="id_hub" id="id_hub" class="form-control" placeholder="Masukkan Hubungan Keluarga">

                        </div>
                        <div class="form-group">
                            <label for="stts_kwn">Status Perkawinan</label>
                            <select class="form-control" name="stts_kwn" id="stts_kwn">
                                <option selected><?= $db_mstr['stts_kwn']; ?></option>
                                <option value="Belum">Belum</option>
                                <option value="Sudah">Sudah</option>
                                <option value="Cera Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jekel">Jenis Kelamin</label>
                            <select class="form-control" name="jekel" id="jekel">
                                <option selected><?= $db_mstr['jekel']; ?></option>
                                <option value="LK">LK</option>
                                <option value="PR">PR</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input value="<?= $db_mstr['nama_ayah']; ?>" type="text" name="nama_ayah" id="nama_ayah" class="form-control" placeholder="Masukkan Hubungan Keluarga">

                        </div>

                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input value="<?= $db_mstr['nama_ibu']; ?>" type="text" name="nama_ibu" id="nama_ibu" class="form-control" placeholder="Masukkan Hubungan Keluarga">

                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </div>
        </form>
    </div>
</div>