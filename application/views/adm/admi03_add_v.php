<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 檔案資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mc001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('adm/admi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/adm/admi03/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($mc001)) { $mc001=$this->input->post('mc001'); }
	  if(!isset($mc002)) { $mc002=$this->input->post('mc002'); }
	  if(!isset($mc003)) { $mc003=$this->input->post('mc003'); }
	  if(!isset($admi01)) { $admi01=$this->input->post('admi01'); }
	  if(!isset($admi01disp)) { $admi01disp=$this->input->post('admi01disp'); }
	  if(!isset($mc005)) { $mc005=$this->input->post('mc005'); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y"  width="9%"><span class="required">檔案代號：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="mc001"    onKeyPress="keyFunction()"   name="mc001" onchange=""  value="<?php echo $mc001; ?>" size="12" type="text" required />
		
	    <td class="normal14y" width="8%" >檔案名稱： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick=""  id="mc002" onKeyPress="keyFunction()"  onchange="" name="mc002"  value="<?php echo $mc002; ?>"  size="12" type="text" /></td>
	  </tr>	
	  <tr>	    
		<td class="normal14z">類型：</td>
		<td  class="normal14"  >
			<select id="mc003" tabIndex="3"  onKeyPress="keyFunction()" name="mc003">
				<option value='1'>1.主檔單頭</option>                                                                        
				<option value='2'>2.主檔單身</option>
				<option value='3'>3.交易單頭</option>
				<option value='4'>4.交易單身</option>
				<option value='5'>5.交易記錄檔</option>	
				<option value='6'>6.月檔或統計檔</option>	
				<option value='7'>7.系統檔案</option>	
				<option value='8'>8.其他</option>				
			</select>
		</td>
	    <td class="normal14z">系統代號：</td>
        <td class="normal14" >
		<input   tabIndex="4" id="admi01" onKeyPress="keyFunction()" onchange="check_admi01(this)" name="admi01" value="<?php echo $admi01; ?>"  type="text" />
		<a href="javascript:;"><img id="Showadmi01disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
		<span id="admi01disp"><?php echo $admi01disp; ?></span>
		</td>
	  </tr>
	  <tr>
		<td class="normal14z">備註：</td>
		<td class="normal14"><input type="text" tabIndex="5" onKeyPress="keyfunction()" id="mc005" name="mc005" value="<?php echo $mc005; ?>" size="25" /> </td>
	  </tr>
	</table>
	
	 
	 <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;"  id="order_product" class="list1">
        <thead>
            <tr>
              <td width="3%"></td>			
		     <?php foreach($usecol_array as $key => $val){
					echo "<td ";
					if(isset($val['width'])){
						echo "width='".$val['width']."' ";}
					if(isset($val['title_class'])){
						echo "class='".$val['title_class']."' ";}
					//if(isset($val['style'])){
					//	echo "style='".$val['style']."' ";}
					echo " >";
					echo $val['name'];
					echo "</td>";
				}?>
            </tr>
        </thead>
		     <?php $current_product_count = 0;//依照資料庫紀錄的明細先列一遍 ?>
          <tfoot>
		 
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('adm/admi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> -->	
	</div> <!-- div-6 -->	 
	
    </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,按鈕可品號資料查詢,按Enter鍵或Tab鍵跳下一個欄位,Alt+y跳到明細資料, Alt+w新增一筆明細. ] ' ?> </div>  <?php } ?>
	
    
	
  </div> <!-- div-5 -->
 
</div> <!-- div-4 -->

 
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->


<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/admi01_funmjs_v.php"); ?>   <!-- 系統代號 -->
<?php  include_once("./application/views/funnew/admi03_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 