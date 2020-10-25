<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
    Tambah Data
</button>

<br><br>

<?php if (!empty(session()->getFlashdata('success'))) { ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php } ?>
<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>NKK</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Tempat Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>



            </tr>
        </thead>
        <tbody>
            <tr>
                <?php $no = 1;
                foreach ($db_mstr as $key => $value) { ?>


                    <td> <?= $no++; ?> </td>
                    <td>
                        <a href="/Datalahir/delete/<?= $value['id_mstr']; ?>" onclick="return confirm('Yakin....?')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
                        <a href="/Datamaster/detail/<?= $value['id_mstr']; ?>" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>

                    </td>

                    <td><?= $value['nkk']; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= tanggal_indo($value['tgl_lahir']); ?></td>
                    <td><?= $value['tmp_lahir']; ?></td>
                    <td><?= $value['jekel']; ?></td>
                    <td><?= $value['nama_ayah']; ?></td>
                    <td><?= $value['nama_ibu']; ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


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
                    <form action="<?= base_url('Datalahir/save') ?>" method="post">
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


                        <input value="Lahir" type="hidden" name="stts_hidup" id="stts_hidup" class="form-control" placeholder="Masukkan Tempat Lahir">


                        <div class="form-group nb-0">
                            <label for="tgl_lahir"></label>
                            <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir (YYYY-MM-DD)">

                        </div>
                        <div class="form-group nb-0">
                            <label for="kenagarian"></label>
                            <input type="text" name="kenagarian" id="kenagarian" class="form-control" placeholder="Masukkan Kenagarian">

                        </div>
                        <div class="form-group nb-0">
                            <label for="jorong"></label>
                            <input type="text" name="jorong" id="jorong" class="form-control" placeholder="Masukkan Jorong">

                        </div>
                        <div class="form-group nb-0">
                            <label for="pekerjaan"></label>
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Masukkan Pekerjaan">

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