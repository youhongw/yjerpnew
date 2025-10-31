 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tc003' || $key == 'tc027'){
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產類別建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ast/asti01/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="13%"><span class="required">資產類別代號：</span></td>   <!--onchange="startcopi03(this);check_title_no();" style="background-color:#F0F0F0"   -->
        <td class="normal14a"  width="37%"><input tabIndex="1" id="ma001"    onKeyPress="keyFunction()"   name="ma001" onfocus="" onchange=""  value="<?php echo $ma001; ?>"  type="text" required readonly="readonly" />

	    <td class="normal14a" width="13%" >資產類別名稱： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="37%" ><input tabIndex="2"  ondblclick="" id="ma002" onKeyPress="keyFunction()"  onchange="" name="ma002"  value="<?php echo $ma002; ?>"   type="text"/></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">資產科目代號：</td>
        <td class="normal14"  >
			<input tabIndex="3" id="acti03" onKeyPress="keyFunction()" name="acti03" onblur="check_acti03(this);"  value="<?php echo $ma003; ?>"  type="text"    />
			<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
			<span id="acti03disp"> <?php echo $acti03disp; ?> </span>
		</td>
		
		<td class="normal14">累計折舊科目代號：</td>
        <td class="normal14"  >
			<input tabIndex="4" id="acti03a" onKeyPress="keyFunction()" name="acti03a" onblur="check_acti03a(this);"  value="<?php echo $ma004; ?>"  type="text"    />
			<a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
			<span id="acti03adisp"> <?php echo $acti03adisp; ?> </span>
		</td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">折舊科目代號：</td>
        <td class="normal14"  >
			<input tabIndex="5" id="acti03b" onKeyPress="keyFunction()" name="acti03b" onblur="check_acti03b(this);"  value="<?php echo $ma005; ?>"  type="text"    />
			<a href="javascript:;"><img id="Showacti03bdisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
			<span id="acti03bdisp"> <?php echo $acti03bdisp; ?> </span>
		</td>
        
		<td class="normal14">耐用月數：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" onKeyPress="keyFunction()" id="ma007" name="ma007"   value="<?php echo $ma007; ?>"  /></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">折舊續提：</td>
        <td class="normal14a">
			<input tabIndex="7" id="ma008" name="ma008" value="Y" onKeyPress="keyFunction()" onclick='turn_ma009(this);' type="checkbox" />
			
			<script>
				var ma008 = "<?php echo $ma008;?>";
				
				if(ma008 == "Y"){
					$('#ma008').attr('checked','checked');
				}else{
					$('#ma008').attr('checked','');
				}
			</script>
		</td>
		
		<td class="normal14">折舊方法：</td>
        <td class="normal14"  ><select id="ma006" tabIndex="8" onKeyPress="keyFunction()" name="ma006">                                                                     
		    <option <?php if($ma006 == '0') echo 'selected="selected"';?> value='0'>0.不提折舊</option>
            <option <?php if($ma006 == '1') echo 'selected="selected"';?> value='1'>1.平均法</option>
		    <option <?php if($ma006 == '2') echo 'selected="selected"';?> value='2'>2.定率遞減法</option>			
		  </select></td>		
	  </tr>
	  
	  <tr>
	   	<td class="normal14">折畢續提耐用月數：</td>
        <td class="normal14" ><input type="text" readonly="readonly" tabIndex="9" onKeyPress="keyFunction()" id="ma009" name="ma009"   value="<?php echo $ma009; ?>"    style="background-color:#F0F0F0" /></td>
	    <td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	</table>
	
	<?php $current_product_count = 0; ?>

	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s </span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti01/display'); ?>" class="button" ><span>返 回Alt+x </span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('ast/asti01/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+< </span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('ast/asti01/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+> </span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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
<form action="<?php echo base_url()?>index.php/ast/asti01/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
		
<?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?>  <!-- 票據科目 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?>  <!-- 票據科目 -->
<?php  include_once("./application/views/funnew/acti03b_funmjs_v.php"); ?>  <!-- 票據科目 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti01_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 

<script>
$(document).ready(function(){ 	   
	if($('#ma008').attr('checked') == 'checked'){
		$('#ma009').removeAttr('readonly','');
		$('#ma009').removeAttr('style','');
	}
})

function turn_ma009(ma008){
	var temp = <?php echo $ma009; ?>;
	if(ma008.checked){
		$('#ma009').removeAttr('readonly','');
		$('#ma009').removeAttr('style','');
	}else{
		$('#ma009').attr('readonly','readonly');
		$('#ma009').attr('style','background-color:#F0F0F0');
		$('#ma009').val(temp);
	}
}
</script>
