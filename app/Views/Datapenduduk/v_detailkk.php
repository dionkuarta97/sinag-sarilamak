<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Aksi</th>

                <th>NKK</th>
                <th>Nama</th>
                <th>Hubungan</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>


            </tr>
        </thead>
        <tbody>
            <tr>
                <?php $no = 1;
                foreach ($db_kk as $key => $value) { ?>

                    <td> <?= $no++; ?> </td>
                    <td>

                        <a href="/Datamaster/detail/<?= $value['id_mstr']; ?>" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>

                    </td>

                    <td><?= $value['nkk']; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= $value['hubungan']; ?></td>
                    <td><?= $value['nama_ayah']; ?></td>
                    <td><?= $value['nama_ibu']; ?></td>


            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>