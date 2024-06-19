<div class="row">
    <div class="col-sm-12">
        <h4 class="header-title m-t-0 m-b-20">Data Gempa
             <a href="?hal=gempa_olah" class="btn btn-primary btn-sm" style="float:right;margin-top:0px;">Tambah Data</a>
             <a href="?hal=gempa_upload" class="btn btn-primary btn-sm" style="float:right;margin-top:0px;margin-right: 16px;">Unggah Data</a>
        </h4>
    </div>
</div> <!-- end row -->

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive m-b-20">

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Kabupaten</th>
                        <th>Keterangan</th>
                        <th>Kedalaman</th>
                        <th>Kekuatan</th>
                        <th>Lat</th>
                        <th>Long</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query="SELECT g.idgempa, g.tanggal, g.jam, k.namakabupaten, g.detail, g.kedalaman, g.kekuatan, g.lat, g.longi from gempa g join kabupaten k on k.idkabupaten=g.idkabupaten";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        while ($data=mysqli_fetch_assoc($result)) {
                        extract($data);
                    ?>
                        <tr>
                        <td><?php echo $tanggal; ?></td>
                        <td><?php echo $jam; ?></td>
                        <td><?php echo $namakabupaten; ?></td>
                        <td><?php echo $detail; ?></td>
                        <td><?php echo $kedalaman; ?></td>
                        <td><?php echo $kekuatan; ?></td>
                        <td><?php echo $lat; ?></td>
                        <td><?php echo $longi; ?></td>

                        <td>
                             <a href="?hal=gempa_olah&id=<?php echo $idgempa; ?>" 
                                class="btn btn-icon btn-primary" title="Edit Data"><i class="fa fa-pencil"></i> </a>

                            <a class="btn btn-danger" title="Hapus Data" href="gempa_proses.php?hapus=<?php echo $idgempa;?>" 
                            onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"> <i class="fa fa-trash"></i></a>

                        </td>
                        </tr>
                <?php }} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>