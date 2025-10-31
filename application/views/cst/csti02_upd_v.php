 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'mb002' ){
		$$key = stringtodate("Y/m/d",$val);   //自訂函數 main_head_v
	}
	
}
$body_data = $result['body_data'];
$data_count = count($body_data);
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 製令工時建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cst/csti02/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="start14a"  width="12%"><span class="required">生產線別：</span></td>   
        <td class="normal14a"  width="38%"><input tabIndex="1" id="mb001"    onKeyPress="keyFunction()"   name="mb001" onfocus="" onchange=""  value="<?php echo $mb001; ?>"  type="text" required />

	    <td class="normal14a" width="12%" >產品品號： </td>  
        <td class="normal14a"  width="38%" ><input tabIndex="2"  ondblclick="" id="mb002" onKeyPress="keyFunction()"  onchange="" name="mb002"  value="<?php echo $mb002; ?>"   type="text" style="background-color:#F0F0F0"/></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">線別名稱：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb001disp" onKeyPress="keyFunction()" name="mb001disp"   value="<?php echo $mb001disp; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		<td class="normal14a">品名：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb007disp" onKeyPress="keyFunction()" name="mb007disp"   value="<?php echo $mb007disp; ?>"  readonly="readonly" style="background-color:#F0F0F0"    />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">日期：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb002" onKeyPress="keyFunction()" name="mb002"   value="<?php echo $mb002; ?>"      />		
		</td>
		<td class="normal14a">規格：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb007disp1" onKeyPress="keyFunction()" name="mb007disp1"   value="<?php echo $mb007disp1; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">製令單別：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb003" onKeyPress="keyFunction()" name="mb003"   value="<?php echo $mb003; ?>"      />		
		</td>
		<td class="normal14a">單位：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb007disp2" onKeyPress="keyFunction()" name="mb007disp2"   value="<?php echo $mb007disp2; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">製令單號：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb004" onKeyPress="keyFunction()" name="mb004"   value="<?php echo $mb004; ?>"      />		
		</td>
		<td class="normal14a">預計產量：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb004disp" onKeyPress="keyFunction()" name="mb004disp"   value="<?php echo $mb004disp; ?>"  readonly="readonly"  style="background-color:#F0F0F0"  />		
		</td>
	  </tr>
	  <tr>	    
		<td class="normal14a">使用人時：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb005" onKeyPress="keyFunction()" name="mb005"   value="<?php echo $mb005; ?>"      />		
		</td>
		<td class="normal14a">已計產量：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb004disp1" onKeyPress="keyFunction()" name="mb004disp1"   value="<?php echo $mb004disp1; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
	  </tr>
	   <tr>	    
		<td class="normal14a">使用機時：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb006" onKeyPress="keyFunction()" name="mb006"   value="<?php echo $mb006; ?>"      />		
		</td>
		<td class="normal14a"></td>
        <td class="normal14"  >
					
		</td>
	  </tr>
	</table>
	
	<?php $current_product_count = 0; ?>

	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s </span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cst/csti02/display'); ?>" class="button" ><span>返 回Alt+x </span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('cst/csti02/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+< </span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('cst/csti02/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+> </span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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
<form action="<?php echo base_url()?>index.php/cst/csti02/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
		

<?php // include_once("./application/views/funnew/acti03b_funmjs_v.php"); ?>  <!-- 票據科目 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->