<?php
$fm = count($_FILES['card']['name']); //上傳檔案數

if ($fm >= 1){
  $k1 = $data2['MA001']; $k2 = $data2['MA002']; //代號
  $y1 = $data2['MA004']; $y2 = $data2['MA005']; //年
  $m1 = $data2['MA006']; $m2 = $data2['MA007']; //月
  $d1 = $data2['MA008']; $d2 = $data2['MA009']; //日
  $h1 = $data2['MA010']; $h2 = $data2['MA011']; //時
  $n1 = $data2['MA012']; $n2 = $data2['MA013']; //分
  $ck1 = $data2['MA014']; $ck2 = $data2['MA015']; //功能碼

  $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/files/'; //檔案路徑
  
  set_time_limit(0); //延長時間
 
  include('dbs.php');
  
  for ($i=0; $i<$fm; $i++){
	
	$fo = explode('.',basename($_FILES['card']['name'][$i])); //分割. 
	$typ = strtolower($fo[count($fo)-1]); //取副檔名
	if ($typ == 'txt'){ //僅txt可上傳
       $uploadfile = $uploaddir.date('YmdHis').$i.'.'.$typ; //檔案路徑+檔名
	   move_uploaded_file($_FILES['card']['tmp_name'][$i], $uploadfile); //複製檔案
		   
	   $vwcon = fopen($uploadfile,'r'); //讀取檔案內容
       while($str=fgets($vwcon))
       { 
	       flush();
	       ob_flush();
		   
		   $md = trim(substr($str,$k1-1,$k2-$k1+1));
		   $dt = trim(substr($str,$y1-1,$y2-$y1+1).substr($str,$m1-1,$m2-$m1+1).substr($str,$d1-1,$d2-$d1+1));
		   $tm = trim(substr($str,$h1-1,$h2-$h1+1).substr($str,$n1-1,$n2-$n1+1));
		   $fn = trim(substr($str,$ck1-1,$ck2-$ck1+1));
		   
		   //各項資料都不為空
		   if (!empty($md) && !empty($dt) && !empty($tm) && !empty($fn)){
			   //資料不重複
			   $query = "SELECT COMPANY FROM AMSMC WHERE (COMPANY='".$COMPANY."') AND (MC001='".$md."') AND (MC002='".$dt."') AND (MC003='".$tm."')";
			   $result = $db->query($query);
			   if ($result->num_rows<=0){ //插入資料
			        $q++;
					$query2 = "INSERT INTO AMSMC (COMPANY,MC001,MC002,MC003,MC004,MC005,MC006,MC007) VALUES ('$COMPANY','$md','$dt','$tm','$md','N','$dt','$fn')";	                      
			        $result2 = $db->query($query2);
			   }else{
				    $r++; //紀錄更新次數
					$query2 = "UPDATE AMSMC SET MC007 = '".$fn."'WHERE (COMPANY='".$COMPANY."') AND (MC001='".$md."') AND (MC002='".$dt."') AND (MC003='".$tm."')";
			        $result2 = $db->query($query2);
			   }
			   
			   $mid[$q] = $md;
			   $dat[$q] = $dt;
			   $tim[$q] = $tm;
			   $fun[$q] = $fn;
		   }
       }
    }
  }
}
?>