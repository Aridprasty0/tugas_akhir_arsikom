<div class="row">
    <div class="col-sm-12">
        <h4 class="header-title m-t-0 m-b-20">Data Kontak
        </h4>

    </div>
</div> <!-- end row -->

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive m-b-20">

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama </th>
                        <th>Email </th>
                        <th>Pesan </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query="SELECT * from kontak";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        while ($data=mysqli_fetch_assoc($result)) {
                            extract($data);
                            ?>
                            <tr>
                                <td><?php echo $nama; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $pesan; ?></td>
                                <td>
                                    <a class="btn btn-danger" title="Hapus Data" href="kontak_proses.php?hapus=<?php echo $idkontak;?>" 
                                        onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"> <i class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>