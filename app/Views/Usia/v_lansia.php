<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
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
            <tr>
                <?php $no = 1;
                foreach ($db_mstr as $key => $value) { ?>


                    <td> <?= $no++; ?> </td>
                    <td>
                        <a href="/Datamaster/delete/<?= $value['id_mstr']; ?>" onclick="return confirm('Yakin....?')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
                        <a href="/Datamaster/detail/<?= $value['id_mstr']; ?>" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>

                    </td>
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