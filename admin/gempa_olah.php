<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"gempa","idgempa='$kode'"));

}else{
    $tanggal="";
    $jam="";
    $detail="";
    $lat="";
    $longi="";
    $kedalaman="";
    $kekuatan="";
    $idkabupaten="";
    $detail="";
}
?>

<div class="row" style="width: 100%;">
    <div class="col-lg-12">
            <h4 class="header-title m-t-0">Olah Data Gempa</h4>

            <div class="p-20 m-b-20">
                <form role="form" class="form-validation" action="gempa_proses.php" method="post" enctype="multipart/form-data">     
                    
                    <input type="hidden" name="kode" value="<?php echo $idgempa ?>">

                    <div class="form-group row">
                        <label for="hori-pass1" class="col-sm-4 form-control-label">Tanggal / Jam</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tanggal" placeholder="Tanggal Gempa" value="<?php echo $tanggal; ?>"  required>
                        </div>
                        <div class="col-sm-4">
                            <input type="time" class="form-control" name="jam" placeholder="Jam Gempa" value="<?php echo $jam; ?>"  required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="hori-pass1" class="col-sm-4 form-control-label">Keterangan</label>
                        <div class="col-sm-8">
                           <textarea class="form-control" name="keterangan" placeholder="keterangan informasi gempa"><?php echo $detail; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="hori-pass1" class="col-sm-4 form-control-label">Lokasi</label>
                        <div class="col-sm-8">
                           <select class="form-control select2" name="kabupaten" required="" style="width: 100%;">
                            <?php 
                            $query="SELECT idkabupaten, namakabupaten from kabupaten";
                            $result=$mysqli->query($query);
                            $num_result=$result->num_rows;
                            if ($num_result > 0 ) { 
                                while ($data=mysqli_fetch_assoc($result)) {
                                extract($data);
                            ?>
                            <option value="<?php echo $idkabupaten ?>"><?php  echo $namakabupaten; ?></option>

                            <?php }} ?>
                           </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="hori-pass1" class="col-sm-4 form-control-label">Titik Gempa (Latitude/Longitude)</label>

                         <div class="col-sm-4">
                                <input type="number" step="0.01" class="form-control" name="lat" placeholder="Latitude" value="<?php echo $lat; ?>" required>
                        </div>

                        <div class="col-sm-4">
                            <input type="number" step="0.01" class="form-control" name="longi" placeholder="longiitude" value="<?php echo $longi; ?>"  required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="hori-pass1" class="col-sm-4 form-control-label">Kedalaman / Kekuatan</label>
                        <div class="col-sm-4">
                            <input type="text" step="0.01" class="form-control" name="kedalaman" placeholder="Kedalaman Gempa" value="<?php echo $kedalaman; ?>"  required>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" step="0.01" class="form-control" name="kekuatan" placeholder="Kekuatan Gempa" value="<?php echo $kekuatan; ?>"  required>
                        </div>

                    </div>

                     
                    <div class="form-group row">
                        <div class="col-sm-8 col-sm-offset-4">
                            <input type="submit" class="btn btn-primary" 
                            name="<?php echo  isset($_GET['id']) ? 'ubah' : 'tambah'; ?>" value="Simpan">
                            <a href="?hal=gempa" class="btn btn-default waves-effect m-l-5">Batal</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
</div>