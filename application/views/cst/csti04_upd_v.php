 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content">  <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 製令成本建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5   $uploadfile  -->
	 <?php   $uploadfile='';?>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cst/csti04/updsave/<?php echo $result[0]->me001;?>" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $me001=$row->me001;?>
		  <?php   $me001disp=$row->me001disp;?>
		  <?php   $me001disp1=$row->me001disp1;?>
		  <?php   $me001disp2=$row->me001disp2;?>
          <?php   $me002=$row->me002;?>
          <?php   $me003=$row->me003;?>
          <?php   $me004=$row->me004;?>
		  <?php   $me005=$row->me005;?>
          <?php   $me006=$row->me006;?>
          <?php   $me007=$row->me007;?>
          <?php   $me008=$row->me008;?>
		  <?php   $me009=$row->me009;?>
		  <?php   $me010=$row->me010;?>    
		  <?php   $me011=$row->me011;?>
          <?php   $me012=$row->me012;?>
          <?php   $me013=$row->me013;?>
          <?php   $me014=$row->me014;?>
          <?php   $me015=$row->me015;?>
          <?php   $me016=$row->me016;?>
		  <?php   $me017=$row->me017;?>
          <?php   $me018=$row->me018;?>
		  <?php   $me019=$row->me019;?>
		  <?php   $me020=$row->me020;?>		
		  <?php   $me021=$row->me021;?>
          <?php   $me022=$row->me022;?>
          <?php   $me023=$row->me023;?>
          <?php   $me024=$row->me024;?>
          <?php   $me025=$row->me025;?>
          <?php   $me026=$row->me026;?>
		  <?php   $me027=$row->me027;?>
		  <?php   $me028=$row->me028;?>
		  <?php   $me029=$row->me029;?>
		  <?php   $me030=$row->me030;?>
		  <?php   $me031=$row->me031;?>
          <?php   $me032=$row->me032;?>  
          <?php   $me033=$row->me033;?>
          <?php   $me034=$row->me034;?>
          <?php   $me035=$row->me035;?>
		  <?php   $flag=$row->flag;?>
       	  
	<?php  }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="start14a"  width="10%"><span class="required">製令單別：</span> </td>
        <td class="normal14a"  width="23%"><input type="text" tabIndex="1" id="me034"  onKeyPress="keyFunction()"  onchange="startkey(this)"  name="me034" value="<?php echo $me034; ?>" size="20"  required />
		 </td>
	    <td class="normal14a"  width="10">製令單號：</td>
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="3"  id="me035"  onKeyPress="keyFunction()" name="me035"   value="<?php echo  $me035; ?>"    size="12"    /></td>
		<td class="normal14a" width="10%">年月：</td>
        <td class="normal14a" width="24%" ><input type="text" tabIndex="4"  id="me002" onKeyPress="keyFunction()" name="me002"   value="<?php echo  $me002; ?>"    size="12"    /></td>	
         </tr>	
		  
	  <tr>
	    <td class="normal14" >品號： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me001" onKeyPress="keyFunction()"  name="me001" value="<?php echo $me001; ?>" size="30"  required /></td>
		<td  class="normal14" >品名：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me001disp" onKeyPress="keyFunction()" name="me001disp"  value="<?php echo $me001disp; ?>"  size="20"  style="background-color:#F5F5F5" /></td>
		<td class="normal14" >規格：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8" readonly="value" id="me001disp1" onKeyPress="keyFunction()" name="me001disp1"   value="<?php echo $me001disp1; ?>"  size="20"  style="background-color:#F5F5F5"  /></td>
	    
	  </tr>
		
	  <tr>
	    <td  class="normal14" >單位：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10" id="me001disp2" onKeyPress="keyFunction()" name="me001disp2"  value="<?php echo $me001disp2; ?>"  size="10"  style="background-color:#F5F5F5" /></td>
	    </tr>
	  
	  
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
			<li><a href="#tab1"  accesskey="a" >詳細欄位a</a></li>
		</ul>
		
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  基本資料1 -->
	<div id="tab1" class="tab_content">
	
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	    <tr>
	    <td class="normal14a"  width="16%">期初在製約量-材料：</td>
        <td class="normal14a"  width="17%"><input type="text" tabIndex="1" id="me005"  onKeyPress="keyFunction()"    name="me005" value="<?php echo $me005; ?>"  />
		 </td>
	    <td class="normal14a"  width="10">本期生產入庫：</td>
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="3" readonly="value" id="me003"  onKeyPress="keyFunction()" name="me003"   value="<?php echo  $me003; ?>"      /></td>
		<td class="normal14a" width="16%">期未在製約量鎖定：</td>
        <td class="normal14a" width="18%" ><input type="text" tabIndex="4" readonly="value" id="me023" onKeyPress="keyFunction()" name="me023"   value="<?php echo  $me023; ?>"  size="2"   /></td>	
         </tr>	
		<tr>
	    <td class="normal14" >期初在製約量-人工製費： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me006" onKeyPress="keyFunction()"  name="me006" value="<?php echo $me006; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >託外進貨：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me004" onKeyPress="keyFunction()" name="me004"  value="<?php echo $me004; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未在製約量-材料：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8" id="me024" onKeyPress="keyFunction()" name="me024"   value="<?php echo $me024; ?>"   /></td>
	     </tr>  
	   <tr>
	    <td class="normal14" >期初在製約量-加工費用： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me014" onKeyPress="keyFunction()"  name="me014" value="<?php echo $me014; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >報廢數量：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me015" onKeyPress="keyFunction()" name="me015"  value="<?php echo $me015; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未在製約量-人工製費：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me025" onKeyPress="keyFunction()" name="me025"   value="<?php echo $me025; ?>"   /></td>
	     </tr>  
		<tr>
	    <td class="normal14" >期初材料成本： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me007" onKeyPress="keyFunction()"  name="me007" value="<?php echo $me007; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期材料成本：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me016" onKeyPress="keyFunction()" name="me016"  value="<?php echo $me016; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未在製約量-加工費用：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me026" onKeyPress="keyFunction()" name="me026"   value="<?php echo $me026; ?>"   /></td>
	     </tr>  
		 <tr>
	    <td class="normal14" >期初人工成本： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me008" onKeyPress="keyFunction()"  name="me008" value="<?php echo $me008; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期人工成本：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me017" onKeyPress="keyFunction()" name="me017"  value="<?php echo $me017; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未材料成本：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me027" onKeyPress="keyFunction()" name="me027"   value="<?php echo $me027; ?>"   /></td>
	     </tr>  
		  <tr>
	    <td class="normal14" >期初製造費用： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me009" onKeyPress="keyFunction()"  name="me009" value="<?php echo $me009; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期製造費用：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me018" onKeyPress="keyFunction()" name="me018"  value="<?php echo $me018; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未人工成本：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me028" onKeyPress="keyFunction()" name="me028"   value="<?php echo $me028; ?>"   /></td>
	     </tr> 
		  <tr>
	    <td class="normal14" >期初加工費用： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me010" onKeyPress="keyFunction()"  name="me010" value="<?php echo $me010; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期加工費用：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me019" onKeyPress="keyFunction()" name="me019"  value="<?php echo $me019; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未製造費用：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me029" onKeyPress="keyFunction()" name="me029"   value="<?php echo $me029; ?>"   /></td>
	     </tr> 
		  <tr>
	    <td class="normal14" >期初在製合計： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me010tot" onKeyPress="keyFunction()"  name="me010tot" value="<?php echo $me007+$me008+$me009+$me010; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期投入合計：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me019tot" onKeyPress="keyFunction()" name="me019tot"  value="<?php echo $me016+$me017+$me018+$me019; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未加工費用：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me030" onKeyPress="keyFunction()" name="me030"   value="<?php echo $me030; ?>"   /></td>
	     </tr> 
		   <tr>
	    <td class="normal14" >本期下階人工成本： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me020" onKeyPress="keyFunction()"  name="me020" value="<?php echo $me020; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期下階製造費用：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me021" onKeyPress="keyFunction()" name="me021"  value="<?php echo $me021; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >本期下階加工費用：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me022" onKeyPress="keyFunction()" name="me022"   value="<?php echo $me022; ?>" style="background-color:#F5F5F5"  /></td>
	     </tr> 
		    <tr>
	    <td class="normal14" >期未下階人工成本： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me031" onKeyPress="keyFunction()"  name="me031" value="<?php echo $me031; ?>"  /></td>
		<td  class="normal14" >期未下階製造費用：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me032" onKeyPress="keyFunction()" name="me032"  value="<?php echo $me032; ?>"  /></td>
		<td class="normal14" >期未下階加工費用：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me033" onKeyPress="keyFunction()" name="me033"   value="<?php echo $me033; ?>"  /></td>
	     </tr> 
		   <tr>
	    <td class="normal14" >期未在製合計： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me030tot" onKeyPress="keyFunction()"  name="me030tot" value="<?php echo $me027+$me028+$me029+$me030; ?>"  /></td>
		 </tr> 
	</table>
	</div>
	
	
		
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  
        </form>
    </div> <!-- div-5 -->
  </div> <!-- div-4 -->
        <div class="buttons">
	    <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a accesskey="x" onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('cst/csti04/'.$this->session->userdata('csti04_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
         <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('cst/csti04/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('cst/csti04/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>	  
	  </div>
</div> <!-- div-3 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-2 -->
  </div> <!-- div-1 -->
</div> <!-- div-0 -->

 <?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>     <!-- 共用函數 -->
 <?php // include_once("./application/views/funnew/cmsi03_funmjs_v.php"); ?> <!-- 庫別 -->