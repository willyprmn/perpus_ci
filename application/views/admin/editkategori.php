<div class="page-header">
	<h3>Edit Kategori</h3>
</div>
<?php foreach($kategori as $k) { ?>
<form action="<?php echo base_url().'admin/update_kategori' ?>" method="post">
	<div class="form-group">
		<label>Nama Kategori</label>
		<input type="hidden" name="id" value="<?php echo $k->id_kategori; ?>">
		<input class="form-control" type="text" name="nama_kategori" value="<?php echo $k->nama_kategori; ?>">
		<?php echo form_error('nama_kategori'); ?>
	</div>

	<div class="form-group">
		<input type="submit" value="Update" class="btn btn-primary">
	</div>
</form>
<?php } ?>