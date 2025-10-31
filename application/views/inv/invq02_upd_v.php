 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content"> <!-- div-3 --> 
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 請購單資料建立作業</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pur/puri05/updsave" method="post" enctype="multipart/form-data" >
	<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $purq04a31=$row->ta001;?>
          <?php   $ta002=$row->ta002;?>
          <?php   $ta003=substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?>
          <?php   $cmsq05a=$row->ta004;?>
          <?php   $ta005=$row->ta005;?>
          <?php   $ta006=$row->ta006;?>
		  <?php   $ta007=$row->ta007;?>
		  <?php   $ta008=$row->ta008;?>
		  <?php   $ta009=$row->ta009;?>
		  <?php   $cmsq02a=$row->ta010;?>
		  <?php   $ta011=$row->ta011;?>
          <?php   $palq01a=$row->ta012;?>
          <?php   $ta013=substr($row->ta013,0,4).'/'.substr($row->ta013,4,2).'/'.substr($row->ta013,6,2);?>
          <?php   $ta014=$row->ta014;?>
          <?php   $ta015=$row->ta015;?>
          <?php   $ta016=$row->ta016;?>
		   <?php   $flag=$row->flag;?>	
		  <?php   $purq04a31disp=$row->ta001disp;?>
		  <?php   $cmsq05adisp=$row->ta004disp;?>
		  <?php   $cmsq02adisp=$row->ta010disp;?>	
		  <?php   $palq01adisp=$row->ta012disp;?>		
		 <!-- 明細 -->
		   <?php   $tb001[]=$row->tb001;?>
		   <?php   $tb002[]=$row->tb002;?>
		   <?php   $tb003[]=$row->tb003;?>
		   <?php   $tb004[]=$row->tb004;?>
		   <?php   $tb005[]=$row->tb005;?>
		   <?php   $tb006[]=$row->tb006;?>
		   <?php   $tb007[]=$row->tb007;?>
		   <?php   $tb009[]=round($row->tb009,2);?>
		   <?php   $tb011[]=$row->tb011;?>
		   <?php   $tb017[]=round($row->tb017,2);?>
		   <?php   $tb018[]=round($row->tb018,0);?>
		   <?php   $tb012[]=$row->tb012;?>
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="8%"><span class="required">請購單別：</span> </td>
        <td class="normal14a"  width="42%"><input tabIndex="1" id="ta001"  readonly="value"  onKeyPress="keyFunction()"  onchange="startpurq04a31(this)"  name="purq04a31" value="<?php echo strtoupper($purq04a31); ?>"  type="text" required /><a href="javascript:;"><img id="Showpurq04a31" src="<?php echo base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		 <span id="purq04a31disp"> <?php   echo $purq04a31disp; ?> </span></td>
	    <td class="normal14a" width="6%" > </td>
        <td class="normal14a"  width="44%" >&nbsp;&nbsp;</td>
	  </tr>	
		  
	  <tr>
	    <td class="start14a" ><span class="required">講購單號：</span> </td>
        <td class="normal14a" ><input tabIndex="2" id="ta002" onKeyPress="keyFunction()" readonly="value" name="ta002" value="<?php echo $ta002; ?>" size="30" type="text" required /><span id="ta002disp" ></span></td>
		<td class="normal14a">&nbsp;&nbsp;</td>
        <td class="normal14a"></td>
	  </tr>
	  <tr>
	    <td  class="normal14" >單據日期：</td>
        <td  class="normal14"  ><input tabIndex="3" onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  class="date" id="ta013" onKeyPress="keyFunction()"   name="ta013"  value="<?php echo $ta013; ?>"  size="10" type="text"   /></td>
		<td class="normal14">確認碼</td>
        <td class="normal14"><select id="ta007" onKeyPress="keyFunction()" name="ta007" " tabIndex="4">
            <option <?php if($ta007 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta007 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
		  </select><?php if ($ta007=='Y' ){ ?><img id="approved" src="<?php echo base_url()?>assets/image/png/approved.png" alt="" align="top"/> <?PHP } ?></td>
	  </tr>
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
			<li><a href="#tab1">基本資料</a></li>			
		</ul>

    <div class="tab_container"> <!-- div-8 -->
	
	<!--   基本資料 -->	
	<div id="tab1" class="tab_content">
      <table class="form14">     <!-- 表格 -->
	   <tr>
		 <td class="start14a"  width="10%">請購部門：</td>
         <td class="normal14a"  width="40%" ><input type="text" tabIndex="4" onKeyPress="keyFunction()"  id="ta004" onchange="startcmsq05a(this);" name="cmsq05a"   value="<?php echo  $cmsq05a; ?>"     /><a href="javascript:;"><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		 <span id="cmsq05adisp"> <?php   echo $cmsq05adisp; ?> </span></td>
		 <td class="start14a"  width="10%" > 廠別：</td>
         <td class="normal14a"  width="40%" ><input type="text" tabIndex="5" onKeyPress="keyFunction()" id="ta010"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
	     <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
	   </tr>	
		  
	  <tr>
	    <td class="start14a"  >請購人員：</td>
        <td class="normal14" ><input type="text" tabIndex="6" id="ta012" onKeyPress="keyFunction()"   onchange="startpalq01a(this)" name="palq01a"   value="<?php echo  $palq01a; ?>"    size="6"  /><a href="javascript:;"><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
	    <td class="normal14b" >請購日期：</td>
        <td class="normal14b"  ><input type="text"   tabIndex="7"  readonly="value" onKeyPress="keyFunction()"   name="ta003" value="<?php echo $ta003; ?>" style="background-color:#EBEBE4"  /></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8"  onKeyPress="keyFunction()" id="ta006" name="ta006" value="<?php echo $ta006; ?>"   /></td>		   
	    <td  class="start14b">簽核狀態：</td>		
        <td  class="start14b"  ><input  type="text" tabIndex="9" readonly="value" onKeyPress="keyFunction()"   name="ta016" value="<?php echo $ta016; ?>" style="background-color:#EBEBE4"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14b">來源別：</td>						
        <td  class="normal14b"  ><input type="text" tabIndex="10" readonly="value"  onKeyPress="keyFunction()" id="ta009" name="ta009"   value="<?php echo $ta009; ?>"  style="background-color:#EBEBE4"  /></td>
		<td class="normal14b" >列印：</td>						
        <td  class="normal14b"  ><input type="text" tabIndex="11" readonly="value"  onKeyPress="keyFunction()" id="ta008" name="ta008"   value="<?php echo $ta008; ?>"  style="background-color:#EBEBE4"  /></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14b" >來源單別：</td>
        <td class="normal14b"><input type="text" tabIndex="12" readonly="value"  onKeyPress="keyFunction()"  id="ta005" name="ta005" value="<?php echo $ta005; ?>" style="background-color:#EBEBE4"  /></td>
	    <td class="start14b">確認者：</td>
        <td  class="normal14b"  ><input type="text" tabIndex="13" readonly="value"  onKeyPress="keyFunction()" id="ta014" name="ta014"   value="<?php echo $ta014; ?>"  style="background-color:#EBEBE4"  /></td>
	  </tr>
	  <tr>
		<td class="normal14"></td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
	
	  <div>
          <table id="order_product" class="list">
            <thead>
              <tr>
                <td width="5%"></td>			
				<td width="11%" class="center">品號</td>
                <td width="15%" class="left">品名</td>
				<td width="15%" class="left">規格</td>
				<td width="6%" class="left">單位</td>
				<td width="6%" class="center">序號</td>
				<td width="10%" class="left">需求日期</td>
                <td width="6%" class="center">數量</td>
                <td width="6%" class="right">單價</td>
                <td width="6%" class="right">小計</td>
				<td width="14%" class="center">備註</td>				
              </tr>
            </thead>
      
    <!--   明細0  --> 
		<?php $i=0; $product_row='0'; ?>  
			 
		<?php while ($i<$ii) { ?>
		<tbody  <?php echo 'id='.'product-row'.$product_row ?> >		
	     <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][tb001]" value="<?php echo $tb001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][tb002]" value="<?php echo $tb002[$i]; ?>" />
	     <td class="left"><input type="text"  tabIndex="14" <?php echo 'id='.'tb004'.$i ?>   name="order_product[<?php echo $i ?>][tb004]" value="<?php echo $tb004[$i]; ?>" size="20"   /></td>
	     <td class="left"><input  type="text" tabIndex="15" onKeyPress="keyFunction()"  id="tb005"  name="order_product[<?php echo $i ?>][tb005]" value="<?php echo $tb005[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text" tabIndex="16" onKeyPress="keyFunction()"  id="tb006"   name="order_product[<?php echo $i ?>][tb006]" value="<?php echo $tb006[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text" tabIndex="17" onKeyPress="keyFunction()"    id="tb007"   name="order_product[<?php echo $i ?>][tb007]" value="<?php echo $tb007[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"   readonly="value" tabIndex="18"  name="order_product[$i][tb003]" value="<?php echo $tb003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
		 <td class="left"><input type="text" tabIndex="19"  onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  id="tb011[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb011]" value="<?php echo  substr($tb011[$i],0,4).'/'.substr($tb011[$i],4,2).'/'.substr($tb011[$i],6,2); ?>" size="10"  class="date"  /></td>
	     <td class="center"><input type="text" tabIndex="20" id="tb009" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb009]" value="<?php echo $tb009[$i]; ?>" size="3" style="text-align:right;" /></td>
         <td class="center"><input type="text"  tabIndex="21" id="tb017" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb017]" value="<?php echo $tb017[$i]; ?>" size="6" style="text-align:right;"  /></td>	
         <td class="right"><input readonly="value" type="text" tabIndex="22" name="order_product[<?php echo $i ?>][tb018]" value="<?php echo $tb018[$i]; ?>" size="10" style="text-align:right;" /></td>
	     <td class="left"><input type="text"  tabIndex="23"id="tb012"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb012]" value="<?php echo $tb012[$i]; ?>" size="20"  /></td>
	     </tr>	    
        </tbody>
        <?php $i++; ?>		
 <?php } ?>		
    <!-- javascrit 0 -->
	 
	<?php include("./application/views/fun/puri05_funjsupdjs_v.php"); ?> 
		 
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
	 </div>
	 
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div> 
	  
    </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 --> 
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->

 <?php include("./application/views/fun/puri05_funjsupd_v.php"); ?>