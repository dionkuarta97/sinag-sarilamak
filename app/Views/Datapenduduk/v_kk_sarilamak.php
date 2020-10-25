<a class="btn btn-danger" href="excel_kk_sarilamak">Download <i class="fa fa-file-excel"></i></a>
<br><br>
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
                        <a href="/Datakk/detail/<?= $value['nkk']; ?>" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>

                    </td>

                    <td><?= $value['nkk']; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= $value['hubungan']; ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>