<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 分錄底稿維護作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ajs/ajsi20/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ajs/ajsi20/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
		<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
         <?php  $actq02a=$row->ta001;?> 
		  <?php // $actq02adisp=$row->ta001disp;?> 
		  <?php   $ta002=$row->ta002;?>    
          <?php   $ta003=$row->ta003;?> 
		  <?php   $actq03a=$row->ta004;?> 
		  <?php   $actq03adisp=$row->ta004disp;?>
          <?php   $ta005=$row->ta005;?>
		 
		  <?php   $ta006=$row->ta006;?>    
		  <?php   $ta007=$row->ta007;?> 
		  <?php   $ta008=$row->ta008;?>
          <?php   $ta009=$row->ta009;?>
	      <?php   $ta010=$row->ta010;?>
		  <?php   $ta011=$row->ta011;?>
          <?php   $ta012=substr($row->ta012,0,4).'/'.substr($row->ta012,4,2).'/'.substr($row->ta012,6,2);?>
		  <?php   $ta013=$row->ta013;?>
		  <?php   $ta014=$row->ta014;?>
          <?php   $ta015=$row->ta015;?>
          <?php   $ta016=$row->ta016;?>  
		
	       <?php   $creator=$row->creator;?>
		   <?php   $create_date=$row->create_date;?>
		   <?php   $flag=$row->flag;?>	
		
		 <!-- 明細 -->
		   <?php   $tb001[]=$row->tb001;?>
		   <?php  $tb002[]=$row->tb002;?>
		   <?php   $tb003[]=$row->tb003;?>
		   <?php   $tb004[]=$row->tb004;?> 
		   <?php   $tb005[]=$row->tb005;?>
		   <?php   $tb005disp[]=$row->tb005disp;?>
		   <?php   $tb006[]=$row->tb006;?>
		   <?php   $tb006disp[]=$row->tb006disp;?>
		  <?php  // $tb007[]=number_format($row->tb007, 2, '.' ,',');?>  
		     <?php   $tb007[]=$row->tb007;?>		 
		   <?php   $tb008[]=$row->tb008;?>
		
		   <?php   $tb010[]=$row->tb010;?> 
		   <?php   $tb011[]=$row->tb011;?> 
           <?php   $tb012[]=$row->tb012;?>
           <?php   $tb013[]=$row->tb013;?>		   
          <?php   //$tb014[]=number_format($row->tb014, 2, '.' ,',');?>  
		   <?php //  $tb015[]=number_format($row->tb015, 2, '.' ,',');?>  
		    <?php   $tb014[]=$row->tb014;?> 
           <?php   $tb015[]=$row->tb015;?> 		
           <?php   $tb016[]=$row->tb016;?> 		   
		   <?php   $tb017[]=$row->tb017;?> 
		   <?php   $tb018[]=$row->tb018;?> 	
		   <?php   IF ($row->tb004=='1') {$tb0071[]=$row->tb007;$tb0072[]=0;} else  {$tb0072[]=$row->tb007;$tb0071[]=0;} ?> 
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
		
	<?php $ii = $ii + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="start14a"  width="10%"><span class="required">底稿批號：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="ta001"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startactq02a(this)"  name="actq02a" value="<?php echo strtoupper($actq02a); ?>"  type="text" required disabled="disabled"/>
		 </td>
	    <td class="normal14a" width="10%" >產生時間：</td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"   id="ta003" onKeyPress="keyFunction()"   name="ta003"  value="<?php echo $ta003; ?>"  size="12" type="text" style="background-color:#E7EFEF" disabled="disabled" /></td>
		<td class="start14a" width="10%" ><span class="required">底稿序號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="ta002" value="<?php echo $ta002; ?>" size="20" type="text" required disabled="disabled"/><span id="ta002disp" ></span></td>
	  </tr>	
	  <tr>
		 <td class="normal14">傳票單別：</td>
        <td  class="normal14"  ><input tabIndex="4" id="ta004" readonly="value" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startactq03a(this)" name="actq03a" value="<?php echo $actq03a; ?>" size="10" type="text"  style="background-color:#EBEBE4" disabled="disabled"/><a href="javascript:;"><img id="Showactq03a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="actq03adisp"> <?php echo $actq03adisp; ?> </span></td>
	     <td class="normal14" >傳票單號：</td>
        <td class="normal14a" ><input tabIndex="5" id="ta005"   onKeyPress="keyFunction()"  name="ta005" value="<?php echo $ta005; ?>" size="16" type="text"  disabled="disabled" /></td>
		 <td class="normal14" >抛轉時間：</td>
        <td class="normal14a" ><input tabIndex="6" id="ta013"   onKeyPress="keyFunction()"  name="ta013" value="<?php echo $ta013; ?>" size="10" type="text" disabled="disabled"  /></td>
		
	  </tr>
	  <tr>
		 <td class="normal14">備註：</td>
        <td  class="normal14"  ><input tabIndex="7" id="ta010"   onKeyPress="keyFunction()"  name="ta010" value="<?php echo $ta010; ?>" size="30" type="text"  disabled="disabled" /></td>
	     <td class="normal14" >抛轉人員：</td>
        <td class="normal14a" ><input tabIndex="8" id="ta011"  readonly="value" onKeyPress="keyFunction()"  name="ta011" value="<?php echo $ta011; ?>" size="12" type="text"   style="background-color:#EBEBE4" /></td>
		 <td class="normal14" >抛轉日期：</td>
        <td class="normal14a" ><input tabIndex="9" id="ta012"  readonly="value" onKeyPress="keyFunction()"  name="ta012" value="<?php echo $ta012; ?>" size="12" type="text"   style="background-color:#EBEBE4" /></td>
		
	  </tr>
	   <tr>
		 <td class="normal14">傳票日期：</td>
        <td  class="normal14"  ><input tabIndex="10" id="ta006"  readonly="value" onKeyPress="keyFunction()"  name="ta006" value="<?php echo $ta006; ?>" size="10" type="text"  style="background-color:#EBEBE4" /></td>
	     <td class="normal14" >抛轉碼：</td>
        <td class="normal14a" ><input type="hidden" name="ta014" value="N" />
		<input type='checkbox' tabIndex="11" id="ta014"  readonly="value" onKeyPress="keyFunction()" name="ta014" <?php if($ta014 == 'Y' ) echo 'checked'; ?>  <?php if($ta014 !== 'Y' ) echo 'check'; ?> value="Y" size="1" style="background-color:#EBEBE4" /></td> 
		 <td class="normal14" >單據性質：</td>
        <td class="normal14a" ><input tabIndex="12" id="ta015"  readonly="value" onKeyPress="keyFunction()"  name="ta015" value="<?php echo $ta015; ?>" size="10" type="text"   style="background-color:#EBEBE4" /></td>
		
	  </tr>
		
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		
	
	  <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;"  id="order_product" class="list1">
        <thead>
            <tr>
              <td width="3%"></td>			
		      <td width="11%" class="center">借貸</td>
			  <td width="6%" class="left">科目編號</td>  
			  <td width="6%" class="center">科目名稱</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="center">部門代號</td>
              <td width="6%" class="right">部門名稱</td>
			   <td width="6%" class="center">幣別</td>
              <td width="6%" class="right">匯率</td>
			  <td width="6%" class="center">原幣金額</td>
			  <td width="6%" class="center">本幣金額</td>
			  <td width="6%" class="right">摘要</td>
			  <td width="6%" class="center">專案代號</td>
			  <td width="14%" class="center">備註</td>
			  <td width="6%" class="right">單別</td>
			  <td width="6%" class="center">單號</td>
			  
            </tr>
        </thead>
      
   	<!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			 
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		  		
	     <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][tb001]" value="<?php echo $tb001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][tb002]" value="<?php echo $tb002[$i]; ?>" />
	      <input type="hidden"   name="order_product[<?php echo $i ?>][tb016]" value="<?php echo $tb016[$i]; ?>"  />
	     <td class="left"><select  id="tb004"  class="total_dc" name="order_product[<?php echo $i ?>][tb004]" ><option <?php if($tb004[$i] == '1') echo 'selected="selected"'; ?> value='1'>借</option><option <?php if($tb004[$i] == '-1') echo 'selected="selected"'; ?> value='-1'>貸</option></select></td> 
		 
		 <td class="left"><input type="text"  <?php echo 'id='.'tb005'.$i ?>   name="order_product[<?php echo $i ?>][tb005]" value="<?php echo $tb005[$i]; ?>" size="12" style="text-align:right;background-color:#E7EFEF;"   /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="tb005disp"   name="order_product[<?php echo $i ?>][tb005disp]" value="<?php echo $tb005disp[$i]; ?>" size="12" style="background-color:#EBEBE4" /></td>
		 <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="tb003"   name="order_product[<?php echo $i ?>][tb003]" value="<?php echo $tb003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	 
	     <td class="left"><input type="text"  <?php echo 'id='.'tb006'.$i ?>   name="order_product[<?php echo $i ?>][tb006]" value="<?php echo $tb006[$i]; ?>" size="12"  style="text-align:right;background-color:#E7EFEF;"  /></td>
		 <td class="center"><input type="text"   id="tb006disp" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb006disp]" value="<?php echo $tb006disp[$i]; ?>" size="8" style="text-align:right;;background-color:#EBEBE4;" /></td>
        
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][tb015]" value="<?php echo $tb015[$i]; ?>" size="10" style="text-align:right;" disabled="disabled"/></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][tb016]" value="<?php echo $tb016[$i]; ?>" size="10" style="text-align:right;" disabled="disabled"/></td>
		 <td class="right"><input  type="text" class="total_price" name="order_product[<?php echo $i ?>][tb015]" value="<?php echo $tb015[$i]; ?>" size="10" style="text-align:right;" disabled="disabled"/></td>
		 <td class="right"><input  type="text" class="total_price1" name="order_product[<?php echo $i ?>][tb007]" value="<?php echo $tb007[$i]; ?>" size="10" style="text-align:right;" disabled="disabled"/></td>
		
	    <td class="left"><input type="text" id="tb010"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb010]" value="<?php echo $tb010[$i]; ?>" size="30" disabled="disabled" /></td>
		<td class="left"><input type="text" id="tb011"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb011]" value="<?php echo $tb011[$i]; ?>" size="10" disabled="disabled" /></td>
		<td class="left"><input type="text" id="tb012"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb012]" value="<?php echo $tb012[$i]; ?>" size="20" disabled="disabled" /></td>
		<td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][tb013]" value="<?php echo $tb013[$i]; ?>" size="10" style="text-align:right;" disabled="disabled"/></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][tb014]" value="<?php echo $tb014[$i]; ?>" size="14" style="text-align:right;" disabled="disabled"/></td>
		 
	     </tr>	      
        </tbody>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;?>
 
 <?php } ?>		 
    <!-- javascrit 0 -->
	 
	<?php include("./application/views/fun/ajsi20_funjsupdjs_v.php"); ?> 
		
                  <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
              <tr>
                <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				<td class="left" colspan="16"></td>
              </tr>
			  
		
            </tfoot>
          </table>
        </div>
	
	 </div>
	</div>
	<!-- 合計     -->
		    <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　本幣借方金額：</b></td>
				<td ><input type='text' readonly="value" name='ta008' id="ta008" size="8" value="<?php echo $ta008; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　本幣貸方金額：</b></td>
				<td ><input type='text' readonly="value" name='ta009' id="ta009" size="8" value="<?php echo $ta009; ?>"  style="background-color:#EBEBE4" /></td>
				
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->
	<!-- <div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ajs/ajsi20/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	</div> -->
	  
      </form>
	  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  
  
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
