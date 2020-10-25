<a class="btn btn-danger" href="excel_sarilamak">Download <i class="fa fa-file-excel"></i></a>
<br><br>
<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
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
            <tr>
                <?php $no = 1;
                foreach ($db_mstr as $key => $value) { ?>


                    <td> <?= $no++; ?> </td>

                    <td><?= $value['nik']; ?></td>
                    <td><?= $value['nkk']; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= tanggal_indo($value['tgl_lahir']); ?></td>
                    <td><?= hitung_umur($value['tgl_lahir']); ?></td>
                    <td><?= $value['agama']; ?></td>
                    <td><?= $value['jekel']; ?></td>
                    <td><?= $value['pekerjaan']; ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>