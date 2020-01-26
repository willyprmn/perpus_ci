<div class="page-header">
	<h3>Data Kategori</h3>
</div>
<a href="<?php echo base_url().'admin/tambah_kategori'; ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> Kategori Baru</a>
<br/><br/>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover" id="table-datatable">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Kategori</th>
				<th>Pilihan</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no = 1;
				foreach($kategori as $k) {
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $k->nama_kategori ?></td>
				<td nowrap="nowrap" align="center">
					<a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/edit_kategori/'.$k->id_kategori; ?>"><span class="glyphicon glyphicon-zoom-in"> </span></a>
					<a class="btn btn-warning btn-sm" href="<?php echo base_url().'admin/hapus_kategori/'.$k->id_kategori; ?>"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>