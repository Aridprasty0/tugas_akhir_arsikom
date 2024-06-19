<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"kabupaten","idkabupaten='$kode'"));

}else{
    $idkabupaten="";
    $namakabupaten="";
}
?>

<div class="row">
    <div class="col-lg-12">
            <h4 class="header-title m-t-0">Olah Data Kabupaten</h4>

            <div class="p-20 m-b-20">
                <form role="form" class="form-validation" action="kabupaten_proses.php" method="post" enctype="multipart/form-data">     
                
                    <input type="hidden" name="idkabupaten" value="<?php echo $idkabupaten ?>">

                    <div class="form-group row">
                        <label for="hori-pass1" class="col-sm-4 form-control-label">Nama Kabupaten</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="namakabupaten" placeholder="Nama" value="<?php echo $namakabupaten; ?>"  required>
                        </div>
                    </div>
                     
                    <div class="form-group row">
                        <div class="col-sm-8 col-sm-offset-4">
                            <input type="submit" class="btn btn-primary" 
                            name="<?php echo  isset($_GET['id']) ? 'ubah' : 'tambah'; ?>" value="Simpan">
                            <a href="?hal=kabupaten" class="btn btn-default waves-effect m-l-5">Batal</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
</div>