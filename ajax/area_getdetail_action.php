<script type="text/javascript">
	function editArea(){
		var form_data = new FormData();
		var id = $("#id").val();
		var lokasi = $("#lokasi").val();
		var area_name = $("#area_name").val();
		var deskripsi = $("#deskripsi").val();
		var ins = document.getElementById('multiSHP').files.length;
		for (var x = 0; x < ins; x++) {
			form_data.append("shp[]", document.getElementById('multiSHP').files[x]);
		}
		form_data.append("id", id);
		form_data.append("lokasi", lokasi);
		form_data.append("area_name", area_name);
		form_data.append("deskripsi", deskripsi);
		$.ajax({
			url: 'area_edit_action.php', // point to server-side PHP script 
			dataType: 'text', // what to expect back from the PHP script
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function (response) {
				$('#hasil_edit_area').html(response); // display success response from the PHP script
			},
			error: function (response) {
				$('#hasil_edit_area').html(response); // display error response from the PHP script
			}
		});
	}
</script>
<?php
include "../config.php";

$id = $_POST['id'];
$sql_area = pg_query($db_conn, "SELECT * FROM pkt_area where kode_area=".$id."");
$data = pg_fetch_assoc($sql_area);
?>
<form class="form-horizontal">
	<div class="modal-body">
			<div class="row clearfix" style="display:none;">
				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
					<label for="area">ID Area</label>
				</div>
				<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
					<div class="form-group">
						<div class="form-line">
							<input type="text" class="form-control" id="id" value="<?php echo $id; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
					<label for="area">Nama Area</label>
				</div>
				<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
					<div class="form-group">
						<div class="form-line">
							<input type="text" class="form-control" id="area_name" value="<?php echo $data['nama']?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
					<label for="area">Lokasi</label>
				</div>
				<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
					<div class="form-group">
						<div class="form-line">
							<input type="text" class="form-control" id="lokasi" value="<?php echo $data['lokasi']?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
					<label for="area">Deskripsi</label>
				</div>
				<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
					<div class="form-group">
						<div class="form-line">
							<textarea class="form-control docs-date" id="deskripsi"><?php echo $data['deskripsi']?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
					<label for="area">Area (*.shp, *.shx, and *.dbf file)</label>
				</div>
				<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
					<div class="form-group">
						<div class="form-line">
							<input name="shp[]" id="multiSHP" type="file" multiple class="file" data-show-preview="false" data-show-upload="false">
							<script>
								$("#multiSHP").fileinput({
									showUpload: false,
									allowedFileExtensions: ['shp', 'dbf', 'shx'],
									theme: "fa",
								});
							</script>
						</div>
						<span style="color:red;">Mengupload file baru akan menghapus file lama!</span><br/>
						<span>Kosongkan jika anda tidak ingin mengupload file baru</span>
					</div>
				</div>
			</div>
	</div>
</form>
	<div class="modal-footer">
				<button type="button" onclick="editArea()" class="btn btn-link waves-effect">SIMPAN</button>
				<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
	</div>
<div id="hasil_edit_area">
</div>