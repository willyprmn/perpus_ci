<div class="page-header">
	<h3>Kategori Baru</h3>
</div>
<?= validation_errors('<p style="color:red;">','</p>'); ?>
<?php 
	if($this->session->flashdata()){
		echo "<div class='alert alert-danger alert-message'>";
		echo $this->session->flashdata('alert');
		echo "</div>";
	}
?>
<form action="<?php echo base_url().'admin/tambah_kategori_act' ?>" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Kategori</label>
		<input class="form-control" type="text" name="nama_kategori">
		<?php echo form_error('nama_kategori'); ?>
	</div>
	

	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btn-primary">
	</div>
</form>