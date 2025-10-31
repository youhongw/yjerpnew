<div id="container">
  <div id="header">
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	</div>
    </div>

<div id="content">
 <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 請購單資料建立作業</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/pur/puri05/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content">
	<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>
	<div id="tab-general">
	<?php $i=0; ?>
	<?php foreach($result as $row) { ?>
          <?  $ta001=$row->ta001;?>
          <?  $ta002=$row->ta002;?>
          <?  $ta003=$row->ta003;?>
          <?  $ta004=$row->ta004;?>
          <?  $ta005=$row->ta005;?>
          <?  $ta006=$row->ta006;?>
		  <?  $ta007=$row->ta007;?>
		  <?  $ta008=$row->ta008;?>
		  <?  $ta009=$row->ta009;?>
		  <?  $ta010=$row->ta010;?>
		  <?  $ta011=$row->ta011;?>
          <?  $ta012=$row->ta012;?>
          <?  $ta013=$row->ta013;?>
          <?  $ta014=$row->ta014;?>
          <?  $ta015=$row->ta015;?>
          <?  $ta016=$row->ta016;?>
		  
		  <?  $ta001disp=$row->ta001disp;?>
		  <?  $ta004disp=$row->ta004disp;?>
		  <?  $ta010disp=$row->ta010disp;?>	
		  <?  $ta012disp=$row->ta012disp;?>		
		 <!-- 明細 -->
		   <?  $tb001[]=$row->tb001;?>
		   <?  $tb002[]=$row->tb002;?>
		   <?  $tb003[]=$row->tb003;?>
		   <?  $tb004[]=$row->tb004;?>
		   <?  $tb005[]=$row->tb005;?>
		   <?  $tb006[]=$row->tb006;?>
		   <?  $tb007[]=$row->tb007;?>
		   <?  $tb009[]=round($row->tb009,2);?>
		   <?  $tb011[]=$row->tb011;?>
		   <?  $tb017[]=round($row->tb017,2);?>
		   <?  $tb018[]=round($row->tb018,0);?>
		   <?  $tb012[]=$row->tb012;?>	   
		  
		 
		  <?  $mb991=' ';?>
		  <?  $mb992=' ';?>
		  <?  $mb999=' ';?>
		 
	<?php $i = $i + 1 ; }?>
      
	<table class="form12"  >     <!-- 頭部表格 -->
	   <tr>
	     
	     <td class="start12a"  width="10%"><span class="required">請購單別：</span> </td>
            <td class="normal12a"  width="50%"><input type="text" tabIndex="1" id="ta001"    onKeyPress="keyFunction()"  onchange="startdata1(this)"  name="ta001" value="<?php echo strtoupper($ta001); ?>" disabled="disabled"  required  /><a href="javascript:;"><img id="Showpurq04a31" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		    <span id="ta001disp"> <?php  echo $this->session->userdata('ta001disp');  ?><?php  if (!$this->session->userdata('ta001disp'))  echo $ta001disp; ?> </span></td>
			
	    <td class="normal12a" width="10%" > </td>
            <td class="normal12a"  width="50%" >&nbsp;&nbsp;</td>
	 </tr>	
		  
	  <tr>
	    <td class="start12a" ><span class="required">講購單號：</span> </td>
            <td class="normal12a" ><input tabIndex="2" id="ta002" onKeyPress="keyFunction()" onKeyUp="chkno1(this)" name="ta002" value="<?php echo $ta002; ?>" size="30" type="text" required disabled /><span id="ta002disp" ></span></td>
		   <td class="normal12a">&nbsp;&nbsp;</td>
            <td class="normal12a"></td>
		
	  </tr>
		
	  <tr>
	    <td  class="normal12" >單據日期：</td>
            <td  class="normal12"  ><input tabIndex="3"  class="date" id="ta013" onKeyPress="keyFunction()"  onKeyUp="chkno1(this)" name="ta013"  value="<?php echo $ta013; ?>"  size="12" type="text"  disabled /></td>
			 <td class="normal12">&nbsp;&nbsp;</td>
            <td class="normal12"></td>
	  </tr>
		
	</table>
	
	<div class="abgne_tab">
		<ul class="tabs">
			<li><a href="#tab1">基本資料</a></li>
			
		</ul>
	
	 
<!--	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/pur/puri01/addsave" >	 -->
<!--	<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>    -->
    <div class="tab_container">
			<div id="tab1" class="tab_content">
	<!--  <div id="tab-general">     基本資料1 -->
	
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    
		<td class="start14a"  width="10%">請購部門：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="4" onKeyPress="keyFunction()"  id="ta004" onchange="startcmsq05a(this);" name="ta004"   value="<?php echo  $ta004; ?>"  disabled    /><a href="javascript:;"><img id="Showcmsq05a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="ta004disp"> <?php  echo $this->session->userdata('ta004disp');  ?><?php  if (!$this->session->userdata('ta004disp'))  echo $ta004disp; ?> </span></td>	
			
		<td class="start14a"  width="10%" > 廠別：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="5" onKeyPress="keyFunction()" id="ta010"  onchange="startcmsq02a(this)" name="ta010"   value="<?php echo  $ta010; ?>"  disabled    /><a href="javascript:;"><img id="Showcmsq02a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
	    <span id="ta010disp"> <?php  echo $this->session->userdata('ta010disp');  ?><?php  if (!$this->session->userdata('ta010disp'))  echo $ta010disp; ?> </span></td>
       
	</tr>	
		  
	  <tr>
	   <td class="start14a"  >請購人員：</td>
        <td class="normal14" ><input type="text" tabIndex="6" id="ta012" onKeyPress="keyFunction()"   onchange="startpalq01a(this)" name="ta012"   value="<?php echo  $ta012; ?>"    size="6" disabled  /><a href="javascript:;"><img id="Showpalq01a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="ta012disp"> <?php  echo $this->session->userdata('ta012disp');  ?><?php  if (!$this->session->userdata('ta012disp'))  echo $ta012disp; ?> </span></td>
	    <td class="normal14b" >請購日期：</td>
        <td class="normal14b"  ><input type="text"   tabIndex="7"  readonly="value" onKeyPress="keyFunction()"   name="ta003" value="<?php echo $ta003; ?>" style="background-color:#EBEBE4" disabled="disabled" /></td>
				
	  </tr>
		
	  <tr>
	    <td  class="normal14" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8"  onKeyPress="keyFunction()" id="ta006" name="ta006" value="<?php echo $ta006; ?>"  disabled   /></td>		   
	   <td  class="start14b">簽核狀態：</td>		
        <td  class="start14b"  ><input  type="text" tabIndex="9" readonly="value" onKeyPress="keyFunction()"   name="ta016" value="<?php echo $ta016; ?>" style="background-color:#EBEBE4" disabled="disabled" /></td>
	    
	  </tr>
	    <tr>
	    
	    <td class="normal14b">來源別：</td>						
            <td  class="normal14b"  ><input type="text" tabIndex="10" readonly="value"  onKeyPress="keyFunction()" id="ta009" name="ta009"   value="<?php echo $ta009; ?>"  style="background-color:#EBEBE4" disabled="disabled" /></td>
			 <td class="normal14b" >列印：</td>						
            <td  class="normal14b"  ><input type="text" tabIndex="11" readonly="value"  onKeyPress="keyFunction()" id="ta008" name="ta008"   value="<?php echo $ta008; ?>"  style="background-color:#EBEBE4" disabled="disabled" /></td>
		
	  </tr>	
		
	  <tr>
	     <td  class="normal14b" >來源單別：</td>
             <td class="normal14b"><input type="text" tabIndex="12" readonly="value"  onKeyPress="keyFunction()"  id="ta005" name="ta005" value="<?php echo $ta005; ?>" style="background-color:#EBEBE4" disabled="disabled" /></td>
	    <td class="start14b">確認者：</td>
            <td  class="normal14b"  ><input type="text" tabIndex="13" readonly="value"  onKeyPress="keyFunction()" id="ta014" name="ta014"   value="<?php echo $ta014; ?>"  style="background-color:#EBEBE4" disabled="disabled" /></td>
	
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
                <td width="18%" class="center">品名</td>
				<td width="18%" class="center">規格</td>
				<td width="6%" class="center">單位</td>
				<td width="6%" class="center">序號</td>
				<td width="10%" class="center">需求日期</td>
                <td width="6%" class="right">數量</td>
                <td width="6%" class="right">單價</td>
                <td width="6%" class="right">小計</td>
				<td width="14%" class="center">備註</td>				
              </tr>
            </thead>
                        			  <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
              <tr>
                <td class="center" valign="top"><img src="<?=base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				<td class="left" colspan="12"></td>
              </tr>
		<!--   明細  -->
		
		 
		 <tbody id="product-row' + product_row + '">
	     <?php $i=0; ?>
		<?php foreach($result as $row) { ?>		
	     <tr>
	     <td class="center"><img src="<?=base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>
  	     <input type="hidden"  name="order_product[' + product_row + '][tb001]" value="<?php echo $tb001[$i]; ?>" />
	     <input type="hidden" name="order_product[' + product_row + '][tb002]" value="<?php echo $tb002[$i]; ?>" />	
	     <td class="left"><input type="text" readonly="value" tabIndex="14" id="tb004'+ product_row+'"   name="order_product[' + product_row + '][tb004]" value="<?php echo $tb004[$i]; ?>" size="20" style="background-color:#EBEBE4" disabled="disabled" /></td>
	     <td class="left"><input readonly="value"  tabIndex="15" onKeyPress="keyFunction()" type="text" id="tb005"  name="order_product[' + product_row + '][tb005]" value="<?php echo $tb005[$i]; ?>" style="background-color:#EBEBE4" disabled="disabled" /></td>
	     <td class="left"><input readonly="value" tabIndex="16" onKeyPress="keyFunction()" type="text" id="tb006"   name="order_product[' + product_row + '][tb006]" value="<?php echo $tb006[$i]; ?>"  size="30" style="background-color:#EBEBE4" disabled="disabled"/></td>
	   	 <td class="left"><input readonly="value" tabIndex="17"  onKeyPress="keyFunction()"   type="text" id="tb007"   name="order_product[' + product_row + '][tb007]" value="<?php echo $tb007[$i]; ?>" size="6" style="background-color:#EBEBE4" disabled="disabled"/></td>
	     <td class="left"><input type="text"   readonly="value" tabIndex="18"  name="order_product[' + product_row + '][tb003]" value="<?php echo $tb003[$i]; ?>" size="6" style="background-color:#EBEBE4" disabled="disabled" /></td>
		 <td class="left"><input type="text" readonly="value" tabIndex="19" id="tb011['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb011]" value="<?php echo $tb011[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /></td>
	     <td class="center"><input type="text" readonly="value" tabIndex="20" id="tb009" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb009]" value="<?php echo $tb009[$i]; ?>" size="3" style="text-align:right;background-color:#EBEBE4" disabled="disabled"/></td>
         <td class="center"><input type="text" readonly="value" tabIndex="21" id="tb017" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb017]" value="<?php echo $tb017[$i]; ?>" size="6" style="text-align:right;background-color:#EBEBE4" disabled="disabled" /></td>	
         <td class="right"><input readonly="value" type="text" tabIndex="22" name="order_product[' + product_row + '][tb018]" value="<?php echo $tb018[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4" disabled="disabled"/></td>
	     <td class="left"><input type="text" readonly="value" id="tb012" tabIndex="23"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb012]" value="<?php echo $tb012[$i]; ?>" size="20" style="background-color:#EBEBE4" disabled="disabled"/></td>
	     </tr>
	     <?php $i=$i+1;  }?>
        </tbody>	   
	   
			  
			  
              </tfoot>
          </table>
        </div>
	
	 </div>
	</div>
	<div class="buttons">
	<!-- <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;  -->
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri05/display'); ?>" class="button" ><span>返 回&nbsp;F9</span></a>
	</div> 
	  
    </form>
    </div> 
	
  </div>
</div>

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div>
 </div>
</div>
