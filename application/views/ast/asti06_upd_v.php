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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產改良建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ast/asti06/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="9%"><span class="required">單別：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="24%"><input tabIndex="1" id="asti03_asti06"    onKeyPress="keyFunction()"   name="asti03_asti06"  onchange="check_asti03_asti06(this);"  value="<?php echo $tc001; ?>" size="12" type="text" style="background-color:#F0F0F0" readonly="value" required />
		  <a href="javascript:;"><img id="Showasti03_asti06disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="asti03_asti06disp"> <?php    echo $tc001disp; ?> </span></td>
	    <td class="normal14a" width="10%" >單據日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="23%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc027" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tc027"  value="<?php echo $tc027; ?>"  size="12" type="text" style="background-color:#FFFFE4"/>
		<img  onclick="scwShow(tc027,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/></td>
	    <td class="start14a" width="10%"><span class="required">單號：</span></td>
        <td class="normal14a" width="23%"><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" style="background-color:#F0F0F0" readonly="value" name="tc002" onfocus="" value="<?php echo $tc002; ?>" size="12" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a"><span class="required">資產編號：</span></td>
        <td  class="normal14"  ><input tabIndex="4" id="asti02" onKeyPress="keyFunction()"  onchange="check_asti02(this)" name="asti02" value="<?php echo $tc004; ?>" size="12" type="text" />
		  <a href="javascript:;"><img id="Showasti02disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="asti02disp"> <?php   echo $tc004disp; ?> </span></td>
	    <td class="normal14">資產規格：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" onKeyPress="keyFunction()" id="asti02disp2" name="asti02disp2"   value="<?php echo $tc004disp2; ?>" style="background-color:#F0F0F0" readonly="value" size="12" /></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">改良成本：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" onKeyPress="keyFunction()" id="tc007" name="tc007"   value="<?php echo $tc007; ?>"  size="12"/></td>
        <td class="normal14">增減未攤月數：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" onKeyPress="keyFunction()" id="tc009" name="tc009"   value="<?php echo $tc009; ?>"  size="12"/></td>
        <td class="normal14">增減預留殘值：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="tc010" name="tc010"   value="<?php echo $tc010; ?>"  size="12"/></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">異動日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" readonly="value"  onKeyPress="keyFunction()" id="tc003" name="tc003"   value="<?php echo $tc003; ?>" style="background-color:#F0F0F0" size="12" /></td>
        <td class="normal14">列印次數：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10" readonly="value"  onKeyPress="keyFunction()" id="tc016" name="tc016"   value="<?php echo $tc016; ?>" style="background-color:#F0F0F0" size="12" /></td>
        <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" readonly="value"  onKeyPress="keyFunction()" id="tc028" name="tc028"   value="<?php echo $tc028; ?>" style="background-color:#F0F0F0" size="12" /></td>
	  </tr>
	  
	   <tr>
	   	<td class="normal14">產生分錄：</td>
        <td  class="normal14"  ><input type="hidden" name="tc031" value="N" />	
		  <input  type='checkbox' tabIndex="12" id="tc031" onKeyPress="keyFunction()" name="tc031" <?php if($tc031 == 'Y' ) echo 'checked'; ?>  <?php if($tc031 != 'Y' ) echo 'check'; ?> value="Y" size="1"/>
        </td>
        <td class="normal14">簽核狀態：</td>
         <td class="normal14"  ><select id="tc032" tabIndex="13" readonly="value" onKeyPress="keyFunction()" name="tc032"   style="background-color:#F0F0F0" >
            <option <?php if($tc032 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc032 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($tc032 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc032 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc032 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc032 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc032 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc032 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>		
        <td class="normal14">備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="14" onKeyPress="keyFunction()" id="tc013" name="tc013"   value="<?php echo $tc013; ?>" size="12"/></td>
	  </tr>
	</table>
	
	<?php $current_product_count = 0; ?>

	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('ast/asti06/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('ast/asti06/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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
<form action="<?php echo base_url()?>index.php/ast/asti06/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
		
<?php  include_once("./application/views/funnew/asti03_funmjs_v.php"); ?> <!-- 單別 -->
<?php  include_once("./application/views/funnew/asti02_funmjs_v.php"); ?>  <!-- 資產編號 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti06_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
