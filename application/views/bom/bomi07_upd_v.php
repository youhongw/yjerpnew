 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<div style="float:left;padding-top: 5px; ">
    </div>

<div id="content"> <!-- div-3 --> 
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 產品途程資料建立作業 - 修改　　　</h1>
      <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/bom/bomi07/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $invq02a=$row->me001;?>
		  <?php   $invq02adisp=$row->me001disp;?>
		  <?php   $me001disp=$row->me001disp;?>
		  <?php   $me001disp1=$row->me001disp1;?>
		  <?php   $me001disp2=$row->me001disp2;?>
		  
          <?php   $me002=$row->me002;?>
		  <?php   $me003=$row->me003;?>
          <?php   $me004=$row->me004;?>
		  		
		 <!-- 明細 -->
		   <?php   $mf001[]=$row->mf001;?>
		   <?php   $mf002[]=$row->mf002;?>
		   <?php   $mf003[]=$row->mf003;?>
		   <?php   $mf004[]=$row->mf004;?>
		   <?php   $mf004disp[]=$row->mf004disp;?>
		   <?php   $mf005[]=$row->mf005;?>
		   <?php   $mf006[]=$row->mf006;?>
		   <?php   $mf007[]=$row->mf007;?>
		   <?php   $mf008[]=$row->mf008;?>
		   <?php   $mf009[]=$row->mf009;?>
		   <?php   $mf010[]=$row->mf010;?>
		   <?php   $mf011[]=$row->mf011;?>
		   <?php   $mf012[]=$row->mf012;?>
		   <?php   $mf013[]=$row->mf013;?>
		   <?php   $mf014[]=$row->mf014;?>
		   <?php   $mf015[]=$row->mf015;?>
		   <?php   $mf016[]=$row->mf016;?>
		   <?php   $mf017[]=$row->mf017;?>
		   <?php   $mf018[]=round($row->mf018,2);?>
		   <?php   $mf019[]=$row->mf019;?>
		   <?php   $mf020[]=$row->mf020;?>
		   <?php   $mf021[]=$row->mf021;?>
		   <?php   $mf022[]=$row->mf022;?>
		   <?php   $mf023[]=$row->mf023;?>
		   <?php   $mf024[]=$row->mf024;?>
		   <?php   $mf025[]=$row->mf025;?>
		   <?php   $mf026[]=$row->mf026;?>
		   <?php   $mf027[]=$row->mf027;?>
		   
		    <?php   $flag=$row->flag;?>
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="8%" ><span class="required">途程品號：</span> </td>
        <td class="normal14a" width="42%" ><input tabIndex="1" id="me001" onKeyPress="keyFunction()"  onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>"  type="text"  /><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
        <span id="invq02adisp"> <?php   echo $invq02adisp; ?> </span></td>
		<td class="normal14y" width="8%" >品名：</td>
        <td class="normal14a" width="42%" ><input type="text" tabIndex="2" readonly="value"  onKeyPress="keyFunction()"  id="me001disp" name="me001disp" value="<?php echo $me001disp; ?>"  style="background-color:#EBEBE4"  /></td>
	  </tr>
	 
	 <tr>
	    <td class="normal14z" >規格： </td>
        <td class="normal14" ><input type="text" tabIndex="3" readonly="value" onKeyPress="keyFunction()"   id="me001disp1" name="me001disp1" value="<?php echo $me001disp1; ?>"  style="background-color:#EBEBE4"  /></td>
		<td class="normal14z">單位：</td>
        <td class="normal14"><input type="text" tabIndex="4" readonly="value" onKeyPress="keyFunction()"   id="me001disp2" name="me001disp2" value="<?php echo $me001disp2; ?>"  style="background-color:#EBEBE4"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >途程代號： </td>
        <td class="normal14" ><input   tabIndex="5" id="me002" onKeyPress="keyFunction()" onchange="startkey(this)" name="me002" value="<?php echo $me002; ?>" size="10" type="text" required />
	     <span id="keydisp" ></span></td>
		<td class="normal14z">途程名稱：</td>
        <td class="normal14"><input type="text" tabIndex="6"  onKeyPress="keyFunction()" size="50"  id="me003" name="me003" value="<?php echo $me003; ?>"   /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z">備註：</td>
        <td class="normal14"><input type="text" tabIndex="7"  onKeyPress="keyFunction()" size="50"  id="me004" name="me004" value="<?php echo $me004; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>	
	
	
	  <div>
          <table id="order_product" class="list1">
            <thead>
               <tr>
              <td width="5%"></td>			
		      <td width="5%" class="left">製程代號</td>
              <td width="5%" class="left">製程名稱</td>
			  <td width="5%" class="left">加工順序</td>
			  <td width="5%" class="left">性質</td>
              <td width="5%" class="left">線別/廠商代號</td>
			  <td width="5%" class="left">線別/廠商名稱</td>
			   <td width="5%" class="left">製程敘述</td>
              <td width="5%" class="right">工時批量</td>
			  <td width="5%" class="right">固定人時</td>
			   <td width="5%" class="right">變動人時</td>
			   <td width="5%" class="right">固定機時</td>
              <td width="5%" class="right">變動機時</td>
			  <td width="5%" class="right">移轉批量</td>
			   <td width="5%" class="right">固定天數</td>
			   <td width="5%" class="right">變動天數</td>
			   <td width="5%" class="left">幣別</td>
			    <td width="5%" class="left">加工單位</td>
              <td width="5%" class="right">加工單價</td>
			  <td width="5%" class="left">檢驗方式</td>
			  <td width="5%" class="right">檢驗天數</td>
			  <td width="5%" class="left">備註</td>
            </tr>
            </thead>
      
    <!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
		<input id="row_count" name="row_count" value="0" style="display:none;" />	 	
			 
		<?php while ($i<$ii) { ?>
		<tbody  <?php echo 'id='.'product-row'.$product_row ?> >		
	     <tr>
	 <!--    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td> -->
            <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="刪除資料" onclick="del_detail('<?php echo $invq02a;?>','<?php echo $mf002[$i]; ?>','<?php echo $mf004[$i]; ?>');" /></td>    	    
		<input type="hidden"  name="order_product[<?php echo $i ?>][mf001]" value="<?php echo $mf001[$i]; ?>" />
		 <input type="hidden"  name="order_product[<?php echo $i ?>][mf002]" value="<?php echo $mf002[$i]; ?>" />
		 <td class="left"><input type="text"  tabIndex="5" <?php echo 'id='.'mf004'.$i ?>   name="order_product[<?php echo $i ?>][mf004]" value="<?php echo $mf004[$i]; ?>" size="10" style="background-color:#E7EFEF"  /></td>
		
	     <td class="left"><input type="text"  tabIndex="6" id="mf004disp" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf004disp]" value="<?php echo $mf004disp[$i]; ?>" size="10" style="text-align:left;"  /></td>
		 <td class="left"><input type="text"  tabIndex="7" id="mf003" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf003]" value="<?php echo $mf003[$i]; ?>" size="10" style="text-align:left;"  /></td>
		 <td class="left"><input type="text"  tabIndex="8" id="mf005" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf005]" value="<?php echo $mf005[$i]; ?>" size="10" style="text-align:left;"  /></td>
		
		 <td class="left"><input type="text"  tabIndex="9" id="mf006" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf006]" value="<?php echo $mf006[$i]; ?>" size="13" style="text-align:left;"  /></td>
		 <td class="left"><input type="text"  tabIndex="10" id="mf007" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf007]" value="<?php echo $mf007[$i]; ?>" size="13" style="text-align:left;"  /></td>
		 <td class="left"><input type="text"  tabIndex="11" id="mf008" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf008]" value="<?php echo $mf008[$i]; ?>" size="20" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="12" id="mf019" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf019]" value="<?php echo $mf019[$i]; ?>" size="10" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="13" id="mf009" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf009]" value="<?php echo $mf009[$i]; ?>" size="10" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="14" id="mf010" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf010]" value="<?php echo $mf010[$i]; ?>" size="10" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="15" id="mf024" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf024]" value="<?php echo $mf024[$i]; ?>" size="10" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="16" id="mf025" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf025]" value="<?php echo $mf025[$i]; ?>" size="10" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="17" id="mf011" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf011]" value="<?php echo $mf011[$i]; ?>" size="10" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="mf012" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf012]" value="<?php echo $mf012[$i]; ?>" size="10" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="19" id="mf013" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf013]" value="<?php echo $mf013[$i]; ?>" size="10" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="20" id="mf015" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf015]" value="<?php echo $mf015[$i]; ?>" size="10" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="21" id="mf017" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf017]" value="<?php echo $mf017[$i]; ?>" size="10" style="text-align:left;"  /></td>
		 <td class="left"><input type="text"  tabIndex="22" id="mf018" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf018]" value="<?php echo $mf018[$i]; ?>" size="10" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="23" id="mf022" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf022]" value="<?php echo $mf022[$i]; ?>" size="10" style="text-align:left;"  /></td>
		 <td class="left"><input type="text"  tabIndex="24" id="mf026" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf026]" value="<?php echo $mf026[$i]; ?>" size="10" style="text-align:right;"  /></td>
		 <td class="left"><input type="text"  tabIndex="25" id="mf023" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf023]" value="<?php echo $mf023[$i]; ?>" size="10" style="text-align:left;"  /></td>
		 
	     </tr>	    
        </tbody>
		<script>
		function del_detail(del_md001,del_md002,del_md003){
			if(confirm('是否刪除此筆資料，單別:'+del_md001+'單號:'+del_md002+'序號:'+del_md003))
			{
				$('#del_md001').val(del_md001);
				$('#del_md002').val(del_md002);
				$('#del_md003').val(del_md003);
				$('#del_form').submit();
			}
		}
		</script>
       <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;
		echo "<script>$('#row_count').val(".$product_row.")</script>";
		?>						
 <?php } ?>		
    <!-- javascrit 0 -->
	 
	<?php include("./application/views/fun/bomi07_funjsupdjs_v.php"); ?> 
		 
		   <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			 <td class="left" colspan="21"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	 </div>
	 <!-- 合計     -->
		     <tr>
				<!-- enter 鍵不會跳下一列       -->
				<td ><input type='text' readonly="value" name='ta999'   value=""  style="display:none" /></td>	
              </tr>
			  <br><span>&nbsp;</span>
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	 <!-- <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div> <!-- div-3 --> 
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/bom/bomi07/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
 <?php include("./application/views/fun/bomi07_funjsupd_v.php"); ?>