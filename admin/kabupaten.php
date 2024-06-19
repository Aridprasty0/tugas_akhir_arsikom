<div class="row">
    <div class="col-sm-12">
        <h4 class="header-title m-t-0 m-b-20">Data Kabupaten
             <a href="?hal=kabupaten_olah" class="btn btn-primary btn-sm" style="float:right;margin-top:0px;">Tambah Data</a>
        </h4>

    </div>
</div> <!-- end row -->

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive m-b-20">

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Kabupaten</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query="SELECT * from kabupaten";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        while ($data=mysqli_fetch_assoc($result)) {
                        extract($data);
                    ?>
                        <tr>
                        <td><?php echo $namakabupaten; ?></td>
                        <td>
                             <a href="?hal=kabupaten_olah&id=<?php echo $idkabupaten; ?>" 
                                class="btn btn-icon btn-primary" title="Edit Data"><i class="fa fa-pencil"></i> </a>

                            <a class="btn btn-danger" title="Hapus Data" href="Kabupaten_proses.php?hapus=<?php echo $idkabupaten;?>" 
                            onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"> <i class="fa fa-trash"></i></a>

                        </td>
                        </tr>
                <?php }} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>