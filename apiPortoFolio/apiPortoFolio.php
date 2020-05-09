<?php
$c=mysqli_connect('localhost','id12221888_cjdw','jeliteng97R','id12221888_notes');
//$c=mysqli_connect('localhost','root','','portofolio');

if($_GET['even']=='token'){
	$response=array();$data=array();
	$q=mysqli_query($c,"SELECT*from token");
	if(mysqli_num_rows($q)>0){
		while($b=mysqli_fetch_array($q)){
			$row=array(
				'nToken'=>$b['nToken'],
				);
			array_push($data, $row);
		}
		$response['valid']=true;$response['data']=$data;
	}else{
		$response['valid']=false;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}

if($_GET['even']=='Data'){
	$response=array();$data=array();
	$q=mysqli_query($c,"SELECT*from history");
	if(mysqli_num_rows($q)>0){
		while($b=mysqli_fetch_array($q)){
			$row=array(
				'iHistory'=>$b['iHistory'],
				'iUser'=>$b['iUser'],
				'tableHistory'=>$b['tableHistory'],
				'even'=>$b['even'],
				'id'=>$b['id'],
				'tglHistory'=>$b['tglHistory'],
				);
			array_push($data, $row);
		}
		$response['valid']=true;$response['data']=$data;
	}else{
		$response['valid']=false;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
// user ______________________
if($_GET['even']=='Data'){
	$response=array();$data=array();
	$q=mysqli_query($c,"SELECT*from history");
	if(mysqli_num_rows($q)>0){
		while($b=mysqli_fetch_array($q)){
			$row=array(
				'iHistory'=>$b['iHistory'],
				'iUser'=>$b['iUser'],
				'tableHistory'=>$b['tableHistory'],
				'even'=>$b['even'],
				'id'=>$b['id'],
				'tglHistory'=>$b['tglHistory'],
				);
			array_push($data, $row);
		}
		$response['valid']=true;$response['data']=$data;
	}else{
		$response['valid']=false;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='Like'){
	$response=array();$data=array();
	$tableHistory=$_POST['tableHistory'];
	$even=$_POST['even'];
	$id=$_POST['id'];
	$q="SELECT*from history where 1";
	if($tableHistory!=''){
		$q.=" and tableHistory like '%".$tableHistory."%' ";
	}
	if($even!=''){
		$q.=" and even like '%".$even."%' ";
	}
	if($id!=''){
		$q.=" and id like '%".$id."%' ";
	}
	$q0=mysqli_query($c,$q);
	if(mysqli_num_rows($q0)>0){
		while($b=mysqli_fetch_array($q0)){
			$row=array(
				'iHistory'=>$b['iHistory'],
				'iUser'=>$b['iUser'],
				'tableHistory'=>$b['tableHistory'],
				'even'=>$b['even'],
				'id'=>$b['id'],
				'tglHistory'=>$b['tglHistory'],
				);
			array_push($data, $row);
		}
		$response['valid']=true;$response['data']=$data;
	}else{
		$response['valid']=false;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='Add'){
	$response=array();$tglAdd=gmdate('Y-m-d H:i:s',time()+(60*60*7));
	$tableHistory=$_POST['tableHistory'];
	$even=$_POST['even'];
	$id=$_POST['id'];
	$q=mysqli_query($c,"INSERT into history values(null,'1','$tableHistory','$even','$id','$tglAdd')");
	if($q){
		$response['valid']=true;
	}else{
		$response['valid']=false;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='Edit'){
	$response=array();$tglAdd=gmdate('Y-m-d H:i:s',time()+(60*60*7));
	$iHistory=$_POST['iHistory'];
	$tableHistory=$_POST['tableHistory'];
	$even=$_POST['even'];
	$id=$_POST['id'];
	$q=mysqli_query($c,"UPDATE history set tableHistory='$tableHistory',even='$even',id='$id' where iHistory='$iHistory' ");
	if($q){
		$response['valid']=true;
	}else{
		$response['valid']=false;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
if($_GET['even']=='Delet'){
	$response=array();$tglAdd=gmdate('Y-m-d H:i:s',time()+(60*60*7));
	$iHistory=$_POST['iHistory'];
	$q=mysqli_query($c,"DELETE from history where iHistory='$iHistory' ");
	if($q){
		$response['valid']=true;
	}else{
		$response['valid']=false;
	}
	echo json_encode($response,JSON_PRETTY_PRINT);
}
?>