<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
    Tambah Data
</button>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalUpload">Upload <i class="fa fa-file-excel"></i></button>

<a class="btn btn-danger float-right" href="Datamaster/excel">Download <i class="fa fa-file-excel"></i></a>
<br><br>
<?php if (!empty(session()->getFlashdata('success'))) { ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php } ?>

<?php if (!empty(session()->getFlashdata('sukses'))) { ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('sukses'); ?>
    </div>
<?php } ?>



<div class="card-body">
    <table id="tabelmaster" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>NIK</th>
                <th>NKK</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Umur</th>
                <th>Agama</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan</th>



            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>



<!-- Modal -->
<div class="modal fade" id="modalTambah">
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
                    <form action="<?= base_url('Datamaster/save') ?>" method="post">
                        <div class="form-group nb-0">
                            <label for="nik"></label>
                            <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK">

                        </div>
                        <div class="form-group nb-0">
                            <label for="nkk"></label>
                            <input type="text" name="nkk" id="nkk" class="form-control" placeholder="Masukkan NKK">

                        </div>
                        <div class="form-group nb-0">
                            <label for="nama"></label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama">

                        </div>
                        <div class="form-group nb-0">
                            <label for="tmp_lahir"></label>
                            <input type="text" name="tmp_lahir" id="tmp_lahir" class="form-control" placeholder="Masukkan Tempat Lahir">

                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir"></label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" data-target="#reservationdate" data-date-format='yy-mm-dd' />
                                <div class="input-group-prepend" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group nb-0">
                            <label for="kenagarian"></label>
                            <input type="text" name="kenagarian" id="kenagarian" class="form-control" placeholder="Masukkan Kenagarian">

                        </div>
                        <div class="form-group nb-0">
                            <label for="jorong"></label>
                            <input type="text" name="jorong" id="jorong" class="form-control" placeholder="Masukkan Jorong">

                        </div>
                        <div class="form-group">
                            <label for="agama"></label>
                            <select class="form-control" name="agama" id="agama">
                                <option selected>--Agama--</option>
                                <option value="Islam">Islam</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Kong hu cu">Kong hu cu</option>
                            </select>
                        </div>
                        <div class="form-group nb-0">
                            <label for="pekerjaan"></label>
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Masukkan Pekerjaan">

                        </div>
                        <div class="form-group nb-0">
                            <label for="id_hub"></label>
                            <input type="text" name="id_hub" id="id_hub" class="form-control" placeholder="Masukkan Hubungan Keluarga">

                        </div>
                        <div class="form-group">
                            <label for="stts_kwn"></label>
                            <select class="form-control" name="stts_kwn" id="stts_kwn">
                                <option selected>--Status Perkawinan--</option>
                                <option value="Belum">Belum</option>
                                <option value="Sudah">Sudah</option>
                                <option value="Cera Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jekel"></label>
                            <select class="form-control" name="jekel" id="jekel">
                                <option selected>--Jenis Kelamin--</option>
                                <option value="LK">LK</option>
                                <option value="PR">PR</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama_ayah"></label>
                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control" placeholder="Masukkan Nama Ayah">

                        </div>

                        <div class="form-group">
                            <label for="nama_ibu"></label>
                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control" placeholder="Masukkan Nama Ibu">

                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalUpload">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">upload Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?= form_open_multipart('Datamaster/upload') ?>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Upload</label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" name="uploadexcel">
                        </div>
                    </div>



                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">upload</button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>