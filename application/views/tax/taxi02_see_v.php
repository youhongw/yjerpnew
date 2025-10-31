<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 發票號碼設定作業 - 查看　　　</h1>
	<div style="float:left;padding-top: 5px; ">
	<a accesskey="x" tabIndex="100" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi02/'.$this->session->userdata('invi02_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   
	   <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('tax/taxi02/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('tax/taxi02/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
	</div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/tax/taxi02/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
        <?php   $mb001=$row->mb001;?>
		  <?php   $cmsi11disp=$row->mb001disp;?>
		  <?php   $mb200=$row->mb200;?> 
          <?php   $mb201=$row->mb201;?>	
          <?php   $mb202=$row->mb202;?>	
          <?php   $mb203=$row->mb203;?>
          <?php   $mb204=$row->mb204;?>
          <?php   $mb205=$row->mb205;?>	
          <?php   $mb206=$row->mb206;?>	
          <?php   $mb207=$row->mb207;?>	
          <?php   $mb208=$row->mb208;?>
          <?php   $mb209=$row->mb209;?>
          <?php   $mb210=$row->mb210;?>	
          <?php   $mb211=$row->mb211;?>	
          <?php   $mb212=$row->mb212;?>	
          <?php   $mb213=$row->mb213;?>
	<?php  }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	   <td class="normal14y"  width="11%"><span class="required">申報公司：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="39%"><input tabIndex="1" id="cmsi11"    onKeyPress="keyFunction()"   name="cmsi11"  onchange="check_cmsi11(this);check_title_no();"  value="<?php echo $mb001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcmsi11disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi11disp"> <?php    echo $cmsi11disp; ?> </span></td>
	    <td class="normal14y" width="11%" >申報期別： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="39%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mb200" onKeyPress="keyFunction()"  onchange="dateformat_ym(this);check_title_no();" name="mb200"  value="<?php echo $mb200; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
	  </tr>
		  
	   <tr>
	    <td class="normal14z">發票類別：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mb201" onKeyPress="keyFunction()"  name="mb201" >
             <option <?php if($mb201 == '手開發票') echo 'selected="selected"';?> value='手開發票'>手開發票</option>                                                                      
		     <option <?php if($mb201 == '收銀機') echo 'selected="selected"';?> value='收銀機'>收銀機</option>
			 <option <?php if($mb201 == '其他') echo 'selected="selected"';?> value='其他'>其他</option>
		  </select></td>
		 <td class="normal14z">發票型態：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mb202" onKeyPress="keyFunction()"  name="mb202" >
             <option <?php if($mb202 == '電子發票') echo 'selected="selected"';?> value='電子發票'>電子發票</option>                                                                      
		     <option <?php if($mb202 == '其他') echo 'selected="selected"';?> value='其他'>其他</option>
		  </select></td>
	   
	  </tr>
	   <tr>
	    <td class="normal14z">聯數：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mb201" onKeyPress="keyFunction()"  name="mb201" >
             <option <?php if($mb201 == '二聯式') echo 'selected="selected"';?> value='二聯式'>二聯式</option>                                                                      
		     <option <?php if($mb201 == '三聯式') echo 'selected="selected"';?> value='三聯式'>三聯式</option>
		     <option <?php if($mb201 == '二聯式收銀機發票') echo 'selected="selected"';?> value='二聯式收銀機發票'>二聯式收銀機發票</option>
		     <option <?php if($mb201 == '三聯式收銀機發票') echo 'selected="selected"';?> value='三聯式收銀機發票'>三聯式</option>
		     <option <?php if($mb201 == '電子計算機發票') echo 'selected="selected"';?> value='電子計算機發票'>電子計算機發票</option>
		  </select></td>
		 <td class="normal14z">字軌：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb206" onKeyPress="keyFunction()" name="mb206"   value="<?php echo strtoupper($mb206); ?>"  size="8"  /></td>	
	   
	  </tr>
	  <tr>
		 <td class="normal14z">發票號碼起：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb207" onchange="check_addno(this);" onKeyPress="keyFunction()" name="mb207"   value="<?php echo $mb207; ?>"  size="12"  /></td>	
	     <td class="normal14z">發票號碼迄：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb208" onKeyPress="keyFunction()" name="mb208"   value="<?php echo $mb208; ?>"  size="12"  /></td>
	  </tr>
	  <tr>
		 <td class="normal14z">發票起日：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb204"  ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);" onKeyPress="keyFunction()" name="mb204"   value="<?php echo $mb204; ?>"  size="12"  /></td>	
	     <td class="normal14z">發票迄日：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb205" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);" onKeyPress="keyFunction()" name="mb205"   value="<?php echo $mb205; ?>"  size="12"  /></td>
	  </tr>	
	  <tr>
		 <td class="normal14z">張數：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb209" onKeyPress="keyFunction()" name="mb209"   value="<?php echo $mb209; ?>"  size="12"  /></td>	
	     <td class="normal14z">已開立號碼：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb210" onKeyPress="keyFunction()" name="mb210"   value="<?php echo $mb210; ?>"  size="12"  /></td>
	  </tr>	
	  <tr>
		 <td class="normal14z">作廢張數：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb211" onKeyPress="keyFunction()" name="mb211"   value="<?php echo $mb211; ?>"  size="12" style="background-color:#F0F0F0" size="22" /></td>	
	     <td class="normal14z">上傳類別：</td>
         <td  class="normal14"  ><select  tabIndex="3" id="mb213" onKeyPress="keyFunction()"  name="mb213" >
             <option <?php if($mb213 == '1') echo 'selected="selected"';?> value='1'>1:自動上傳</option>                                                                      
		     <option <?php if($mb213 == '2') echo 'selected="selected"';?> value='2'>2:手動上傳</option>
		  </select>
	  </tr>	
	</table>
	    
    <!--    <div class="buttons">
	    <a accesskey="x" tabIndex="100" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi02/'.$this->session->userdata('invi02_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   
	   <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('tax/taxi02/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('tax/taxi02/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
		
	  </div>  -->
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
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?> 