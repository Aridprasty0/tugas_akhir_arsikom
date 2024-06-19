<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h6 class="text-muted m-t-0 text-uppercase">Selamat datang admin.....</h6>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="card-box">
			<a href="?hal=kabupaten" class="btn btn-sm btn-default pull-right">View</a>
			<h6 class="text-muted m-t-0 text-uppercase">Data Kabupaten</h6>
			<h2 class="m-b-20"><span><?php echo jumlahdata($mysqli,"kabupaten"); ?></span></h2>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="card-box">
			<a href="?hal=gempa" class="btn btn-sm btn-default pull-right">View</a>
			<h6 class="text-muted m-t-0 text-uppercase">Data Gempa</h6>
			<h2 class="m-b-20"><span><?php echo jumlahdata($mysqli,"gempa"); ?></span></h2>
		</div>
	</div>

</div>

