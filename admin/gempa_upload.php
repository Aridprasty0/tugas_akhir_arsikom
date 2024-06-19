<div class="row">
    <div class="col-lg-12">
        <h4 class="header-title m-t-0">Unggah Data Gempa</h4>

        <div class="p-20 m-b-20">
            <form role="form" class="form-validation" action="gempa_proses_upload.php" method="post" enctype="multipart/form-data">     
                <div class="form-group row">
                    <label class="form-control-label">Pilih Berkas</label>
                    <input type="file" name="berkas_gempa" style="margin-top: 8px;" required>
                </div>

                <div class="form-group row">
                    <div class="col-sm-8 col-sm-offset-5">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>