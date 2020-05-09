<?php
$c=mysqli_connect('localhost','id12221888_cjdw','jeliteng97R','id12221888_notes');

// login __________________________________
if($_GET['even']=='login'){
	$response['valid']=false;
	$iUser=$_POST['iUser'];
	$pasUser=$_POST['pasUser'];
	$versi=$_POST['versi'];	
	if($iUser==''){
		$response['message']='iUser masih kosong';echo json_encode($response);return false;
	}
	if($pasUser==''){
		$response['message']='pasUser masih kosong';echo json_encode($response);return false;
	}
	if($versi!=10){
		$response['message']='versi salah';echo json_encode($response);return false;
	}
	$q=mysqli_query($c,"SELECT *from aUser where iUser='$iUser' and pasUser='$pasUser' ");
	if(mysqli_num_rows($q)>0){
		$response['data']=array();
		while($b=mysqli_fetch_array($q)){
			$data['iUser']=$b['iUser'];
			$data['nUser']=$b['nUser'];
			array_push($response['data'], $data);
		}
		$response['message']='Success';
		$response['valid']=true;
	}else{
		$response['message']='Error';
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}

// user ____________________________________
if($_GET['even']=='userData'){
	$q=mysqli_query($c,"SELECT*from aUser");
	if(mysqli_num_rows($q)>0){
		while($b=mysqli_fetch_array($q)){
			$data['iUser']=$b['iUser'];
			$data['nUser']=$b['nUser'];
			$data['pasUser']=$b['pasUser'];
			$data['typeUser']=$b['typeUser'];
			$data['tglAdd']=$b['tglAdd'];
			$response[]=$data;
		}
	}else{
		$data['iUser']='';
		$data['nUser']='';
		$data['pasUser']='';
		$data['typeUser']='';
		$data['tglAdd']='';
		$response[]=$data;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='userLike'){
	$iUser=$_POST['iUser'];
	$nUser=$_POST['nUser'];
	$typeUser=$_POST['typeUser'];
	$q="SELECT*from aUser where 1";	
	if($iUser!=''){
		$q.=" and iUser like '%$iUser%' ";
	}
	if($nUser!=''){
		$q.=" and nUser like '%$nUser%' ";
	}
	if($typeUser!=''){
		$q.=" and typeUser like '%$typeUser%' ";
	}
	$q1=mysqli_query($c,$q);
	if(mysqli_num_rows($q1)>0){
		while ($b=mysqli_fetch_array($q1)){
			$data['iUser']=$b['iUser'];
			$data['nUser']=$b['nUser'];
			$data['pasUser']=$b['pasUser'];
			$data['typeUser']=$b['typeUser'];
			$data['tglAdd']=$b['tglAdd'];
			$response[]=$data;
		}
	}else{
		$data['iUser']='';
		$data['nUser']='';
		$data['pasUser']='';
		$data['typeUser']='';
		$data['tglAdd']='';
		$response[]=$data;
		//$response=[];
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='userMenu'){
	$response['valid']=false;
	$iUser=$_POST['iUser'];
	$menu=$_POST['menu'];
	if($iUser=='2' && $menu=='user'){
		$response['valid']=true;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='userType'){
	$response['valid']=false;
	if($_POST['iUser']==''){
		$response['message']='tidak boleh kosong';echo json_encode($response);return false;
	}
	$iUser=$_POST['iUser'];
	$q=mysqli_query($c,"SELECT*from aUser where iUser='$iUser' ");
	if(mysqli_num_rows($q)>0){
		$q=mysqli_query($c,"SELECT DISTINCT typeUser from aUser");
		$response['data']=array();
		$response['data'][]=array('typeUser'=>'','typeUser1'=>'kosong');
		while($b=mysqli_fetch_array($q)){
			$typeUser='lain';if($b['typeUser']=='1'){$typeUser='satu';}if($b['typeUser']=='2'){$typeUser='dua';}
			$response['data'][]=array(
				'typeUser'=>$b['typeUser'],
				'typeUser1'=>$typeUser,
				);
		}
		$response['valid']=true;
	}else{
		$response['data']='kosong';
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='userSelect'){
	$response['valid']=false;
	if($_POST['typeUser']==''){
		$response['message']='tidak boleh kosong';echo json_encode($response);return false;
	}
	$typeUser=$_POST['typeUser'];
	$q=mysqli_query($c,"SELECT*from aUser where typeUser='$typeUser' ");
	if(mysqli_num_rows($q)>0){
		$response['data']=array();
		while($b=mysqli_fetch_array($q)){
			$data['iUser']=$b['iUser'];
			$data['nUser']=$b['nUser'];
			array_push($response['data'], $data);
		}
		$response['valid']=true;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='userAdd'){
	$response['valid']=false;
	if($_POST['nUser']==''){
		$response['message']='tidak boleh kosong';echo json_encode($response);return false;
	}
	if($_POST['typeUser']==''){
		$response['message']='tidak boleh kosong';echo json_encode($response);return false;
	}
	$nUser=$_POST['nUser'];
	$typeUser=$_POST['typeUser'];
	$tgl=gmdate('Y-m-d H:i:s',time()+(60*60*7));
	$q=mysqli_query($c,"INSERT into aUser values(null,'$nUser','1234','$typeUser','$tgl') ");
	$response['valid']=true;
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='userEdit'){
	$response['valid']=false;
	if($_POST['nUser']==''){
		$response['message']='tidak boleh kosong';echo json_encode($response);return false;
	}
	if($_POST['pasUser']==''){
		$response['message']='tidak boleh kosong';echo json_encode($response);return false;
	}
	if($_POST['typeUser']==''){
		$response['message']='tidak boleh kosong';echo json_encode($response);return false;
	}
	$iUser=$_POST['iUser'];
	$nUser=$_POST['nUser'];
	$pasUser=$_POST['pasUser'];
	$typeUser=$_POST['typeUser'];
	$tgl=gmdate('Y-m-d H:i:s',time()+(60*60*7));
	$q=mysqli_query($c,"UPDATE aUser set nUser='$nUser',pasUser='$pasUser',typeUser='$typeUser',tglAdd='$tgl' where iUser='$iUser' ");
	$response['valid']=true;
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='userDelet'){
	$response['valid']=false;
	$iUser=$_POST['iUser'];
	$q=mysqli_query($c,"DELETE from aUser where iUser='$iUser' ");
	$response['valid']=true;
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='barangAdd'){
	$response['valid']=false;
	$barcode=$_POST['barcode'];
	$nBarang=$_POST['nBarang'];
	$stockBarang=$_POST['stockBarang'];
	$hargaBarang=$_POST['hargaBarang'];
	$tgl=gmdate('Y-m-d H:i:s',time()+(60*60*7));
	$q=mysqli_query($c,"INSERT into aBarang values(null,'$barcode','$nBarang','$stockBarang','$hargaBarang') ");
	$response['valid']=true;
	echo json_encode($response,JSON_PRETTY_PRINT);
}

// barang __________________________________
if($_GET['even']=='barangWhere'){
	$response['valid']=false;
	$barcode=$_POST['barcode'];
	$q=mysqli_query($c,"SELECT*from aBarang where barcode='$barcode' ");
	if(mysqli_num_rows($q)>0){
		$response['data']=array();
		while($b=mysqli_fetch_array($q)){
			$response['data'][]=array(
				'nBarang'=>$b['nBarang'],
				'stockBarang'=>$b['stockBarang'],
				'hargaBarang'=>$b['hargaBarang'],
				);
		}
		$response['valid']=true;
	}else{
		$response['data']='kosong';
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='barangWhereNoObject'){
	$response=array();
	$barcode=$_POST['barcode'];
	$q=mysqli_query($c,"SELECT*from aBarang where barcode='$barcode' ");
	if(mysqli_num_rows($q)>0){
		while($b=mysqli_fetch_array($q)){
			$response[]=array(
				'nBarang'=>$b['nBarang'],
				'stockBarang'=>$b['stockBarang'],
				'hargaBarang'=>$b['hargaBarang'],
				);
		}
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='barangLike'){
	$iBarang=$_POST['iBarang'];
	$barcode=$_POST['barcode'];
	$nBarang=$_POST['nBarang'];
	$q="SELECT*from aBarang where 1";	
	if($iBarang!=''){
		$q.=" and iBarang like '%$iBarang%' ";
	}
	if($barcode!=''){
		$q.=" and barcode like '%$barcode%' ";
	}
	if($nBarang!=''){
		$q.=" and nBarang like '%$nBarang%' ";
	}
	$q1=mysqli_query($c,$q);
	if(mysqli_num_rows($q1)>0){
		while ($b=mysqli_fetch_array($q1)){
			$data['iBarang']=$b['iBarang'];
			$data['barcode']=$b['barcode'];
			$data['nBarang']=$b['nBarang'];
			$data['stockBarang']=$b['stockBarang'];
			$data['hargaBarang']=$b['hargaBarang'];
			$response[]=$data;
		}
	}else{
		$data['iBarang']='';
		$data['barcode']='';
		$data['nBarang']='';
		$data['stockBarang']='';
		$data['hargaBarang']='';
		$response[]=$data;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}

// transaksi _______________________
if($_GET['even']=='transaksiLike'){
	$iTransaksi=$_POST['iTransaksi'];
	$iUser=$_POST['iUser'];
	$q="SELECT*from aTransaksi where 1";	
	if($iTransaksi!=''){
		$q.=" and iTransaksi like '%$iTransaksi%' ";
	}
	if($iUser!=''){
		$q.=" and iUser like '%$iUser%' ";
	}
	$q1=mysqli_query($c,$q);
	if(mysqli_num_rows($q1)>0){
		while ($b=mysqli_fetch_array($q1)){
			$data['iTransaksi']=$b['iTransaksi'];
			$data['iUser']=$b['iUser'];
			$data['tglAdd']=$b['tglAdd'];
			$response[]=$data;
		}
	}else{
		$data['iTransaksi']='';
		$data['iUser']='';
		$data['tglAdd']='';
		$response[]=$data;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
?>