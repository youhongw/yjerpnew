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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> BOM用料建立作業 - 修改　　　</h1>
    　<div style="float:left;padding-top: 5px; ">
	　<button style= "cursor:pointer" form="commentForm" onfocus="$('#mc001').focus();"　type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  　
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/bom/bomi02/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
	 
          <?php   $invq02a=$row->mc001;?>
		  <?php   $invq02adisp=$row->mc001disp;?>
		  <?php   $mc001disp=$row->mc001disp;?>
		  <?php   $mc001disp1=$row->mc001disp1;?>
		  <?php   $mc001disp2=$row->mc001disp2;?>
		  <?php   $mc001disp3=$row->mc001disp3;?>
		  <?php   $mc001disp4=$row->mc001disp4;?>
          <?php   $mc002=$row->mc002;?>
          <?php   $mc003=$row->mc003;?>
		  <?php   $mc004=$row->mc004;?>
         
          <?php   $mocq01a51=$row->mc005;?>
		  <?php   $mocq01a51disp=$row->mc005disp;?>
          <?php   $mc006=$row->mc006;?>
		  <?php   $mc007=$row->mc007;?>
		  <?php   $mc008=$row->mc008;?>
		  <?php   $mc009=$row->mc009;?>
          <?php   $mc010=$row->mc010;?>
		  <?php   $create_date=$row->create_date;?>
		  <?php   $modi_date=$row->modi_date;?>
         <?php   $flag=$row->flag;?>	
		 <!-- 明細 -->
		   
		   <?php   $md001[]=$row->md001;?>
		   <?php   $md002[]=$row->md002;?>
		   <?php   $md003[]=$row->md003;?>
		   <?php   $md003disp[]=$row->md003disp;?>
		   <?php   $md003disp1[]=$row->md003disp1;?>
		   <?php   $md003disp2[]=$row->md003disp2;?>
		   <?php   $md006[]=$row->md006;?>
		   <?php   $md007[]=$row->md007;?>
		   <?php   $md008[]=round($row->md008,2);?>
		   <?php  if ($row->md011>'0') {$md011[]=substr($row->md011,0,4).'/'.substr($row->md011,4,2).'/'.substr($row->md011,6,2);}
              else {$md011[]='';} ?>
		   <?php  if ($row->md012>'0') {$md012[]=substr($row->md012,0,4).'/'.substr($row->md012,4,2).'/'.substr($row->md012,6,2);}
              else {$md012[]='';} ?>
		  <?php   $md014[]=$row->md014;?>
		  <?php   $md016[]=$row->md016;?>
		  <?php   $md017[]=$row->md017;?>  
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="normal14y"  width="10%"><span class="required">主件品號：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="mc001"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startinvq02a(this)"  name="invq02a" value="<?php echo strtoupper($invq02a); ?>"  type="text" required /><a href="javascript:;"><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invq02adisp"> <?php    echo $invq02adisp; ?> </span></td>
	    <td class="normal14y" width="10%" >品名： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"   id="mc001disp" onKeyPress="keyFunction()"   name="mc001disp"  value="<?php echo $mc001disp; ?>"  size="12" type="text" style="background-color:#F5F5F5"  /></td>
		<td class="normal14y" width="10%" >規格：</td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="mc001disp1" onKeyPress="keyFunction()"  name="mc001disp1" value="<?php echo $mc001disp1; ?>" size="20" type="text" style="background-color:#F5F5F5"  /></td>
	  </tr>		
		  
	  <tr>
		<td class="normal14z">單位：</td>
        <td  class="normal14"  ><input tabIndex="4" id="mc001disp2" onKeyPress="keyFunction()"  name="mc001disp2" value="<?php echo $mc001disp2; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>    
	    <td class="normal14z" >小單位：</td>
        <td class="normal14a" ><input tabIndex="5" id="mc001disp3" onKeyPress="keyFunction()"  name="mc001disp3" value="<?php echo $mc001disp3; ?>"  type="text"  style="background-color:#F5F5F5" /></td>
		<td class="normal14z" >屬性：</td>
        <td class="normal14a" ><input tabIndex="6" id="mc001disp4" onKeyPress="keyFunction()"  name="mc001disp4" value="<?php echo $mc001disp4; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
	  
	  </tr>
	   <tr>
		<td class="normal14z">標準批量：</td>
        <td  class="normal14"  ><input  tabIndex="7" id="mc004" onKeyPress="keyFunction()" name="mc004"   value="<?php echo  $mc004; ?>"    size="12" type="text"  /></td>    
	    <td class="normal14z" >製令單別：</td>
        <td class="normal14a" ><input tabIndex="8" id="mc005" onKeyPress="keyFunction()" name="mocq01a51" onchange="startmocq01a51(this)"  value="<?php echo $mocq01a51; ?>"  type="text"   /><a href="javascript:;"><img id="Showmocq01a51" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="mocq01a51disp"> <?php    echo $mocq01a51disp; ?> </span></td>
		<td class="normal14z" >備註：</td>
        <td class="normal14a" ><input  tabIndex="9"  id="mc010" onKeyPress="keyFunction()"   name="mc010"   value="<?php echo  $mc010; ?>" type="text"     /></td>
	  
	  </tr>
	  <tr>
		<td class="normal14z">變更單別：</td>
        <td  class="normal14"  ><input tabIndex="10" id="mc006" onKeyPress="keyFunction()"  name="mc006" value="<?php echo $mc006; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>    
	    <td class="normal14z" >變更單號：</td>
        <td class="normal14a" ><input tabIndex="11" id="mc007" onKeyPress="keyFunction()"  name="mc007" value="<?php echo $mc007; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
		<td class="normal14z" >變更序號：</td>
        <td class="normal14a" ><input tabIndex="12" id="mc008" onKeyPress="keyFunction()"  name="mc008" value="<?php echo $mc008; ?>"  type="text"  style="background-color:#F5F5F5" /></td>
	  
	  </tr>
	  <tr>
		<td class="normal14z">建立日期：</td>
        <td  class="normal14"  ><input tabIndex="13" id="create_date" onKeyPress="keyFunction()"  name="create_date" value="<?php echo $create_date; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>    
	    <td class="normal14z" >修改日期：</td>
        <td class="normal14a" ><input tabIndex="14" id="modi_date" onKeyPress="keyFunction()"  name="modi_date" value="<?php echo $modi_date; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
		<td class="normal14z" >版次：</td>
        <td class="normal14a" ><input tabIndex="15" id="mc009" onKeyPress="keyFunction()"  name="mc009" value="<?php echo $mc009; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
	  
	  </tr>
	</table>
	
	  <div>
          <table id="order_product" class="list1">
            <thead>
               <tr>
              <td width="5%"></td>			
		      <td width="8%" class="center">品號</td>
              <td width="13%" class="left">品名</td>
			  <td width="13%" class="left">規格</td>
			  <td width="6%" class="left">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="left">生效日期</td>
              <td width="6%" class="center">失效日期</td>
              <td width="6%" class="right">組成用量</td>
			  <td width="6%" class="right">底數</td>
			  <td width="6%" class="right">損耗率</td>
			  <td width="6%" class="center">標準成本</td>
			  <td width="6%" class="right">材料型態</td>
			  <td width="10%" class="center">備註</td>				
            </tr>
            </thead>
      
    <!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
		    <input id="row_count" name="row_count" value="0" style="display:none;" />
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		
	     <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="刪除資料" onclick="del_detail('<?php echo strtoupper($invq02a);?>','<?php echo $md002[$i]; ?>','<?php echo $md003[$i]; ?>');" /></td><!--$(\'#product-row0\').remove();原始方法-->
          	    
		<input type="hidden"  name="order_product[<?php echo $i ?>][md001]" value="<?php echo $md001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][md014]" value="<?php echo $md014[$i]; ?>" />		 
	     <td class="left"><input type="text"  tabIndex="14" <?php echo 'id='.'md003'.$i ?>   name="order_product[<?php echo $i ?>][md003]" value="<?php echo $md003[$i]; ?>" size="20" style="background-color:#E7EFEF"  /></td>
	     <td class="left"><input  type="text" tabIndex="15" onKeyPress="keyFunction()"  id="md003disp"  name="order_product[<?php echo $i ?>][md003disp]" value="<?php echo $md003disp[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text" tabIndex="16" onKeyPress="keyFunction()"  id="md003disp1"   name="order_product[<?php echo $i ?>][md003disp1]" value="<?php echo $md003disp1[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text" tabIndex="17" onKeyPress="keyFunction()"    id="md003disp2"   name="order_product[<?php echo $i ?>][md003disp2]" value="<?php echo $md003disp2[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"   readonly="value" tabIndex="18" id="order_product[<?php echo $i?>][md002]" name="order_product[<?php echo $i?>][md002]" value="<?php echo $md002[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
		 <td class="left"><input type="text" tabIndex="19"  onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  id="md011[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][md011]" value="<?php echo  $md011[$i]; ?>" size="10"  class="date" style="background-color:#E7EFEF" /></td>
		 <td class="left"><input type="text" tabIndex="20"  onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  id="md012[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][md012]" value="<?php echo  $md012[$i]; ?>" size="10"  class="date" style="background-color:#E7EFEF" /></td>
	     <td class="right"><input type="text"  tabIndex="21"id="md006"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][md006]" value="<?php echo $md006[$i]; ?>" size="10" style="text-align:right;"  /></td>
         <td class="right"><input type="text"  tabIndex="22" id="md007" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][md007]" value="<?php echo $md007[$i]; ?>" size="10" style="text-align:right;"  /></td>	
         <td class="right"><input type="text"  tabIndex="23" id="md008" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][md008]" value="<?php echo $md008[$i]; ?>" size="10" style="text-align:right;"  /></td>	        
		 <td class="left"><input type="text"  tabIndex="24"id="md014"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][md014]" value="<?php echo $md014[$i]; ?>" size="10"  /></td>
         <td class="left"><input type="text"  tabIndex="25"id="md017"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][md017]" value="<?php echo $md017[$i]; ?>" size="10"  /></td>
         <td class="left"><input type="text"  tabIndex="26"id="md016"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][md016]" value="<?php echo $md016[$i]; ?>" size="20"  /></td>	    
		</tr>	    
        </tbody>
		<script>
		function del_detail(del_md001,del_md002,del_md003){
			if(confirm('是否刪除此筆資料，主件品號:'+del_md001+'品號:'+del_md002+'序號:'+del_md003))
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
	 
	<?php include_once("./application/views/fun/bomi02_funjsupdjs_v.php"); ?> 
		 
		   <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			 <td class="left" colspan="11"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	 <!-- <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
		<form action="<?php echo base_url()?>index.php/bom/bomi02/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
 <?php include_once("./application/views/fun/bomi02_funjsupd_v.php"); ?>