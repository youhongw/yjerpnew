 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'mc002' ){
		$$key = stringtodate("Y/m/d",$val);   //自訂函數 main_head_v
	}
	
}
//$body_data = $result['body_data'];
//$data_count = count($body_data);
/*echo "<pre>";
//var_dump($col_array);
//var_dump($body_data);
var_dump($usecol_array);
echo "</pre>";*/

?>
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

<div id="content"> <!-- div-3 --> 
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 產品成本建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cst/csti05/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="11%"><span class="required">產品品號：</span></td>   
        <td class="normal14a"  width="39%"><input tabIndex="1" id="mv001"    onKeyPress="keyFunction()"   name="mv001" onfocus="" onchange=""  value="<?php echo $mv001; ?>"  type="text" required />

	    <td class="normal14a" width="11%" >品名： </td>  
        <td class="normal14a"  width="39%" ><input tabIndex="2"  ondblclick="" id="mv001disp" onKeyPress="keyFunction()"  onchange="" name="mv001disp"  value="<?php echo $mv001disp; ?>"   type="text" style="background-color:#F0F0F0"/></td>
	  </tr>
	  <tr>	    
		<td class="normal14a">規格：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv001disp1" onKeyPress="keyFunction()" name="mv001disp1"   value="<?php echo $mv001disp1; ?>"  readonly="readonly" style="background-color:#F0F0F0"    />		
		</td>
		<td class="normal14a">單位：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv001disp2" onKeyPress="keyFunction()" name="mv001disp2"   value="<?php echo $mv001disp2; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">年月：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv002" onKeyPress="keyFunction()" name="mv002"   value="<?php echo $mv002; ?>"     />		
		</td>
		<td class="normal14a"></td>
        <td class="normal14"  >
				
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">生產入庫：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv003" onKeyPress="keyFunction()" name="mv003"   value="<?php echo $mv003; ?>"      />		
		</td>
		<td class="normal14a">下階人工成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv011" onKeyPress="keyFunction()" name="mv011"   value="<?php echo $mv011; ?>"   />		
		</td>
	  </tr>
	   <tr>	    
		<td class="normal14a">託外進貨：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv004" onKeyPress="keyFunction()" name="mv004"   value="<?php echo $mv004; ?>"      />		
		</td>
		<td class="normal14a">下階製造費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv012" onKeyPress="keyFunction()" name="mv012"   value="<?php echo $mv012; ?>"   />		
		</td>
	  </tr>
	  <tr>	    
		<td class="normal14a">材料在製約量：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv005" onKeyPress="keyFunction()" name="mv005"   value="<?php echo $mv005; ?>"      />		
		</td>
		<td class="normal14a">下階加工費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv013" onKeyPress="keyFunction()" name="mv013"   value="<?php echo $mv013; ?>"   />		
		</td>
	  </tr>
	   <tr>	    
		<td class="normal14a">人工製費在製約量：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv006" onKeyPress="keyFunction()" name="mv006"   value="<?php echo $mv006; ?>"      />		
		</td>
		<td class="normal14a"></td>
        <td class="normal14"  >
				
		</td>
	  </tr>
	   <tr>	    
		<td class="normal14a">加工費用在製約量：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv006" onKeyPress="keyFunction()" name="mv006"   value="<?php echo $mv006; ?>"      />		
		</td>
		<td class="normal14a"></td>
        <td class="normal14"  >
				
		</td>
	  </tr>
	   <tr>	    
		<td class="normal14a">材料成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv007" onKeyPress="keyFunction()" name="mv007"   value="<?php echo $mv007; ?>"      />		
		</td>
		<td class="normal14a">單位材料成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv015" onKeyPress="keyFunction()" name="mv015"   value="<?php echo $mv015; ?>" readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
	  </tr>
	  <tr>	    
		<td class="normal14a">人工成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv008" onKeyPress="keyFunction()" name="mv008"   value="<?php echo $mv008; ?>"      />		
		</td>
		<td class="normal14a">單位人工成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv016" onKeyPress="keyFunction()" name="mv016"   value="<?php echo $mv016; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">製造費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv009" onKeyPress="keyFunction()" name="mv009"   value="<?php echo $mv009; ?>"      />		
		</td>
		<td class="normal14a">單位製造費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv017" onKeyPress="keyFunction()" name="mv017"   value="<?php echo $mv017; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	   <tr>	    
		<td class="normal14a">加工費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv010" onKeyPress="keyFunction()" name="mv010"   value="<?php echo $mv010; ?>"      />		
		</td>
		<td class="normal14a">單位加工費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv018" onKeyPress="keyFunction()" name="mv018"   value="<?php echo $mv018; ?>"   readonly="readonly" style="background-color:#F0F0F0"  />		
		</td>
		
	  </tr>
	    <tr>	    
		<td class="normal14a">生產成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv020" onKeyPress="keyFunction()" name="mv020"   value="<?php echo $mv020; ?>"   readonly="readonly" style="background-color:#F0F0F0"    />		
		</td>
		<td class="normal14a">單位生產成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv019" onKeyPress="keyFunction()" name="mv019"   value="<?php echo $mv019; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	</table>
	
	<?php $current_product_count = 0; ?>

	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s </span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cst/csti05/display'); ?>" class="button" ><span>返 回Alt+x </span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('cst/csti05/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+< </span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('cst/csti05/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+> </span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>	
	  </div> 
	  </div> <!-- div-加 -->
    </form>  <!-- end 表單 -->
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,欄位淡黃色按2下開視窗查詢,圖示1客戶商品計價查詢,Alt+y跳到明細資料, Alt+w新增一筆明細. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div> <!-- div-3 --> 
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/cst/csti05/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
		

<?php // include_once("./application/views/funnew/acti03b_funmjs_v.php"); ?>  <!-- 票據科目 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->