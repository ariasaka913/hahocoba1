<?php echo'';?>
<!DOCTYPE html>
<html>
<head>
	<title>coba</title>
	<link rel="stylesheet" type="text/css" href="aset/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="aset/datatable.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
	<style>
		body,table { font-size: 12px; background-color:#EDECEC;}
		.panel{background-color: #DCD9D9;}
		.panel-body{padding: 4px 4px;}
		.input-xs {height: 22px;font-size: 12px;}
		.table>tbody>tr>th,.table>tbody>tr>td{padding: 2px;}
		.boxShadow{box-shadow: 5px 0px 15px rgba(0,0,0,0.2);}
	</style>
</head>
<body>
	<div class="container-fluid">
		<h2 id="nToken">token</h2>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-xs-12">
						<label class="btn btn-default btn-xs btn-block" data-toggle="collapse" data-target="#collapse-datatable">datatable with parameter</label>
					</div>
				</div>
				<div class="panel panel-default collapse boxShadow" id="collapse-datatable">
					<div class="panel-body">
						<form id="form-datatable">
							<div class="row">
								<div class="col-xs-4">
									<input type="text" class="form-control input-xs" name="tableHistory" placeholder="tableHistory">
								</div>
								<div class="col-xs-4">
									<input type="text" class="form-control input-xs" name="even" placeholder="even">
								</div>
								<div class="col-xs-4">
									<input type="text" class="form-control input-xs" name="id" placeholder="id">
								</div>
							</div><div style="padding:2px"></div>
							<div class="row">
								<div class="col-xs-6 text-center"><span id="msg-datatable"></span></div>
								<div class="col-xs-6 text-right">
									<div class="input-group">
										<input type="text" name="iHistory" style="display: none;">
										<span id="id-datatable"></span>
										<div class="input-group-btn">
											<label class="btn btn-default btn-xs" id="clear-datatable">clear</label>
											<label class="btn btn-default btn-xs" id="find-datatable">find</label>
											<label class="btn btn-default btn-xs" id="save-datatable">save</label>
										</div>
									</div>
								</div>
							</div><div style="padding:2px"></div>
							<div class="table-datatable" style=" display: none;">
								<table class="table" id="table-datatable" style="width: 100%;">
									<thead>
										<tr>
											<th>aksi</th>
											<th>iHistory</th>
											<th>iUser</th>
											<th>tableHistory</th>
											<th>even</th>
											<th>id</th>
											<th>tglAdd</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="loader" style="display: none;">
		<h3><i class="fa fa-spinner fa-spin"></i></h3> prosesing execution
	</div>
	<script type="text/javascript" src="aset/jquery.js"></script>
	<script type="text/javascript" src="aset/bootstrap.js"></script>
	<script type="text/javascript" src="aset/datatable.js"></script>
	<script type="text/javascript" src="aset/block.ui.js"></script>
	<script type="text/javascript">
		var loader = $('#loader');
		$(document).ajaxStart(function () {
			$.blockUI({baseZ: 1500,message: loader})
		}).ajaxStop($.unblockUI);
		$(document).ajaxStop($.unblockUI);

		$(document).ready(function(){

			var link='https://cjdwapiandroit.000webhostapp.com/';
			function sss(){
				$.ajax({
					url:link+'apiPortoFolio.php?even=token',data:{},type:'post',dataType:'json',cache:false,
					success: function(output){
						if(output.valid==true){$('#msg-transaksi').text('add success');transaksiData();transaksiClear();}
					}
				});
			}
			

			$.getJSON(link+'apiPortoFolio.php?even=token', function(output) {
				console.log(output);var row='';
				$.each(output.data,function(i,b){
					$('#nToken').text(b.nToken);
				});
			},'json');
			$('#find-datatable').click(function(){
				$('#table-datatable').DataTable().clear().draw();
				$.ajax({
					url:link+'apiPortoFolio.php?even=Like',data:$('#form-datatable').serialize(),type:'post',cache:false,dataType:'json',
					success:function(output){
						var row=[];$('.table-datatable').show();
						if(output.valid==true){
							$.each(output.data,function(i,b){
								var even=`
								<div class="input-group-btn">
									<label class="btn btn-default btn-xs btn-edit" title="edit" 
									iHistory="`+b.iHistory+`" iUser="`+b.iUser+`" tableHistory="`+b.tableHistory+`" even="`+b.even+`"
									id="`+b.id+`" tglHistory="`+b.tglHistory+`"
									>e</label>
									<label class="btn btn-default btn-xs btn-delet" title="delet"  iHistory="`+b.iHistory+`">d</label>
								</div>
								`;
								row.push([
									even,b.iHistory,b.iUser,b.tableHistory,b.even,b.id,b.tglHistory
									]);
							});
						}
						$('#table-datatable').DataTable().rows.add(row).draw();
					}
				});return false;
			});
			function clearDatatable(){
				$('#table-datatable').DataTable().clear().draw();$('.table-datatable').hide();
				$('#form-datatable #id-datatable').text('');$('#form-datatable')[0].reset();
			}
			$('#clear-datatable').click(function(){
				clearDatatable();
			});
			$('#save-datatable').click(function(){
				if($('#id-datatable').text()==''){
					$.ajax({
						url:link+'apiPortoFolio.php?even=Add',data:$('#form-datatable').serialize(),type:'post',cache:false,dataType:'json',
						success:function(output){
							if(output.valid==true){
								$('#msg-datatable').text('add success');clearDatatable();
							}else{
								$('#msg-datatable').text('add error');clearDatatable();
							}
						}
					});return false;
				}else{
					$.ajax({
						url:link+'apiPortoFolio.php?even=Edit',data:$('#form-datatable').serialize(),type:'post',cache:false,dataType:'json',
						success:function(output){
							if(output.valid==true){
								$('#msg-datatable').text('edit success');clearDatatable();
							}else{
								$('#msg-datatable').text('edit error');clearDatatable();
							}
						}
					});return false;
				}
			});
			$('#table-datatable').on('click','.btn-edit',function(){
				$('#form-datatable #id-datatable').text('id:'+$(this).attr('iHistory'));
				$('#form-datatable [name="iHistory"]').val($(this).attr('iHistory'));
				$('#form-datatable [name="tableHistory"]').val($(this).attr('tableHistory'));
				$('#form-datatable [name="even"]').val($(this).attr('even'));
				$('#form-datatable [name="id"]').val($(this).attr('id'));
			});
			$('#table-datatable').on('click','.btn-delet',function(){
				$.post(link+'apiPortoFolio.php?even=Delet',{iHistory:$(this).attr('iHistory')},function(output){
					if(output.valid==true){$('#msg-datatable').text('delet success');clearDatatable();}
				},'json');
			});
		});
	</script>
</body>
</html>