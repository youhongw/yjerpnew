<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 營業稅申報資料 - 查看　　　</h1>
	 <div style="float:left;padding-top: 5px; ">
	 <a accesskey="x" tabIndex="100" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi04/'.$this->session->userdata('invi02_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   
	   <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('tax/taxi04/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('tax/taxi04/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
	</div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/tax/taxi04/display/<?php echo $result[0]->me001.'/'.$result[0]->me002;?>" method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
         <?php   $me001=$row->me001;?>
		  <?php   $cmsi11disp=$row->me001disp;?>
           <?php   $me002=substr($row->me002,0,4).'/'.substr($row->me002,4,2);?>
          <?php   $me003=substr($row->me003,0,4).'/'.substr($row->me003,4,2);?>
          <?php   $me004=$row->me004;?>
          <?php   $me005=$row->me005;?>    
          <?php   $me006=$row->me006;?>   
		  <?php   $me007=$row->me007;?>   
		  <?php   $me008=$row->me008;?>   
		  <?php   $me009=$row->me009;?>
		  <?php   $me010=$row->me010;?>   
		  <?php   $me011=$row->me011;?>
          <?php   $me012=$row->me012;?>
          <?php   $me013=$row->me013;?>
          <?php   $me014=$row->me014;?>
          <?php   $me015=$row->me015;?>
          <?php   $me016=$row->me016;?>
		
		  <?php   $me017=$row->me017;?>     
		  <?php   $me018=$row->me018;?>    
		  <?php   $me019=$row->me019;?>
		  <?php   $me020=$row->me020;?>		
		  <?php   $me021=$row->me021;?>
          <?php   $me022=$row->me022;?>
          <?php   $me023=$row->me023;?>
          <?php   $me024=$row->me024;?>
          <?php   $me025=$row->me025;?>
          <?php   $me026=$row->me026;?>
		  <?php   $me027=$row->me027;?>
		  <?php   $me028=$row->me028;?>
		  <?php   $me029=$row->me029;?>
		  <?php   $me030=$row->me030;?>
		  <?php   $me031=$row->me031;?>
          <?php   $me032=$row->me032;?>  
          <?php   $me033=$row->me033;?>
          <?php   $me034=$row->me034;?>
          <?php   $me035=$row->me035;?>
          <?php   $me036=$row->me036;?>
		  <?php   $me037=$row->me037;?>
		  <?php   $me038=$row->me038;?>
		  <?php   $me039=$row->me039;?>
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
		  <?php   $flag=$row->flag;?>
	<?php  }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y"  width="12%"><span class="required">申報公司：</span> </td>
        <td class="normal14a"  width="38%"><input tabIndex="1" id="cmsi11"    onKeyPress="keyFunction()"   name="cmsi11"  onchange="check_cmsi11(this);check_title_no();"  value="<?php echo $me001; ?>"  type="text" required />
		  <a href="javascript:;"><img id="Showcmsi11disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi11disp"> <?php    echo $cmsi11disp; ?> </span></td>
	    <td class="normal14y" width="12%" >起始年月： </td>
        <td class="normal14a"  width="38%" ><input tabIndex="3" id="me002" class="date-picker" onChange="dateformat_ym(this)" onKeyPress="keyFunction()"    type="text" name="me002"  value="<?php echo $me002; ?>"   style="background-color:#FFFFE4" />
        
           </td>
	    </tr>	
		  
	  <tr>
	    <td class="normal14z" >截止年月： </td>
        <td class="normal14" ><input tabIndex="3" id="me003"  class="date-picker" onChange="dateformat_ym(this)" onKeyPress="keyFunction()"    type="text" name="me003"  value="<?php echo $me003; ?>"   style="background-color:#FFFFE4" />
      <!--   <img  onclick="fPopCalendar(event,me003,me003);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> -->
           </td>
		<td  class="normal14z" >發票份數：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me004" onKeyPress="keyFunction()" name="me004"  value="<?php echo $me004; ?>"    /></td>
		
	  </tr>
	  
	  <tr>
	    <td  class="normal14z" >退稅方式：</td>
        <td  class="normal14" ><input type="radio" name="me007" <?php if (isset($me007) && $me007=="1") echo "checked";?> value="1" />1.利用存款帳戶劃撥　 
               <input type="radio" name="me007" <?php if (isset($me007) && $me007=="2") echo "checked";?> value="2" />2.領取退稅支票
        </td>
        <td class="normal14"  ></td>
		<td class="normal14"  ></td>
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
			<li><a href="#tab1"  accesskey="a" >基本資料a</a></li>
			<li><a href="#tab2"  accesskey="b">403資料b</a></li>
		</ul>
    <div class="tab_container"> <!-- div-8 -->
	
	<!-- 基本資料1 -->
	<div id="tab1" class="tab_content">
	<table class="form14">     <!-- 表格 -->
	   <tr>
	    <td class="normal14y" width="12%" >銷售固定資產金額：</td>
        <td class="normal14a"  width="38%" ><input type="text"  tabIndex="7" id="me013" onKeyPress="keyFunction()" name="me013"  value="<?php echo $me013; ?>"    /></td>	
		<td class="normal14y"  width="12%">發票明細表(分)：</td>
        <td class="normal14a"  width="38%" ><input type="text"  tabIndex="8" id="me008" onKeyPress="keyFunction()" name="me008"  value="<?php echo $me008; ?>"    /></td>
		</tr>	
		  
	   <tr>
	    <td class="normal14z" >不得扣抵憑證費用：</td>
        <td class="normal14"  ><input type="text"  tabIndex="9" id="me014" onKeyPress="keyFunction()" name="me014"  value="<?php echo $me014; ?>"    /></td>	
		<td class="normal14z" >進項憑證(冊)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="10" id="me009" onKeyPress="keyFunction()" name="me009"  value="<?php echo $me009; ?>"    /></td>	    
		</tr>
		
		<tr>
	    <td class="normal14z" >不得扣抵憑證資產：</td>
        <td class="normal14"  ><input type="text"  tabIndex="11" id="me015" onKeyPress="keyFunction()" name="me015"  value="<?php echo $me015; ?>"    /></td>	
		<td class="normal14z" >進項憑證(分)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="12" id="me010" onKeyPress="keyFunction()" name="me010"  value="<?php echo $me010; ?>"    /></td>	    
		</tr>
	    <tr>
	    <td class="normal14z" >進口免稅貨物：</td>
        <td class="normal14"  ><input type="text"  tabIndex="13" id="me017" onKeyPress="keyFunction()" name="me017"  value="<?php echo $me017; ?>"    /></td>	
		<td class="normal14z" >証明單(分)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="14" id="me011" onKeyPress="keyFunction()" name="me011"  value="<?php echo $me011; ?>"    /></td>	    
		</tr>
		<tr>
	    <td class="normal14z" >購買國外勞務：</td>
        <td class="normal14"  ><input type="text"  tabIndex="15" id="me018" onKeyPress="keyFunction()" name="me018"  value="<?php echo $me018; ?>"    /></td>	
		<td class="normal14z" >申報聯(分)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="16" id="me012" onKeyPress="keyFunction()" name="me012"  value="<?php echo $me012; ?>"    /></td>	    
		</tr>
		<tr>
	    <td class="normal14z" >本期積留底稅額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="17" id="me019" onKeyPress="keyFunction()" name="me019"  value="<?php echo $me019; ?>"    /></td>	
		<td class="normal14z" >海關代徵營業稅繳納證(分)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="18" id="me038" onKeyPress="keyFunction()" name="me038"  value="<?php echo $me038; ?>"    /></td>	    
		</tr>
		<tr>
	    <td class="normal14z" >備註：</td>
        <td class="normal14"  ><input type="text"  tabIndex="19" id="me024" onKeyPress="keyFunction()" name="me024"  value="<?php echo $me024; ?>"    /></td>	
		<td class="normal14z" >零稅率銷貨額清單(分)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="20" id="me039" onKeyPress="keyFunction()" name="me039"  value="<?php echo $me039; ?>"    /></td>	    
		</tr>
		
		
	</table>
	</div>
	
	<!--  基本資料2 -->
	<div id="tab2" class="tab_content">
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="12%" >特種飲食業25%金額：</td>
        <td class="normal14a"  width="38%" ><input type="text"  tabIndex="21" id="me025" onKeyPress="keyFunction()" name="me025"  value="<?php echo $me025; ?>"    /></td>	
		<td class="normal14y"  width="12%">稅額：</td>
        <td class="normal14a"  width="38%" ><input type="text"  tabIndex="22" id="me026" onKeyPress="keyFunction()" name="me026"  value="<?php echo $me026; ?>"    /></td>
		</tr>	
		  
	   <tr>
	    <td class="normal14z" >特種飲食業15%金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="23" id="me027" onKeyPress="keyFunction()" name="me027"  value="<?php echo $me027; ?>"    /></td>	
		<td class="normal14z" >稅額：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="24" id="me028" onKeyPress="keyFunction()" name="me028"  value="<?php echo $me028; ?>"    /></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >金融本業收入金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="25" id="me029" onKeyPress="keyFunction()" name="me029"  value="<?php echo $me029; ?>"    /></td>	
		<td class="normal14z" >稅額：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="26" id="me030" onKeyPress="keyFunction()" name="me030"  value="<?php echo $me030; ?>"    /></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >再保收入金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="27" id="me033" onKeyPress="keyFunction()" name="me033"  value="<?php echo $me033; ?>"    /></td>	
		<td class="normal14z" >稅額：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="28" id="me034" onKeyPress="keyFunction()" name="me034"  value="<?php echo $me034; ?>"    /></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >免稅收入金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="29" id="me035" onKeyPress="keyFunction()" name="me035"  value="<?php echo $me035; ?>"    /></td>	
		<td class="normal14a" ></td>             
		 <td class="normal14"  ></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >退回及折讓金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="30" id="me036" onKeyPress="keyFunction()" name="me036"  value="<?php echo $me036; ?>"    /></td>	
		<td class="normal14z" >稅額：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="31" id="me037" onKeyPress="keyFunction()" name="me037"  value="<?php echo $me037; ?>"    /></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >銷售土地金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="32" id="me020" onKeyPress="keyFunction()" name="me020"  value="<?php echo $me020; ?>"    /></td>	
		<td class="normal14z" >中途歇業補徵應繳稅額：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="33" id="me022" onKeyPress="keyFunction()" name="me022"  value="<?php echo $me022; ?>"    /></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >中途歇業應退稅額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="34" id="me023" onKeyPress="keyFunction()" name="me023"  value="<?php echo $me023; ?>"    /></td>	
		<td class="normal14a" ></td>             
		 <td class="normal14"  ></td>	    
		</tr>
		
		
	</table>
	</div>

	
	  
     </form>
	  </div> <!-- div-6 -->
  </div> <!-- div-5 -->
     <!--  <div class="buttons">
	    <a accesskey="x" tabIndex="100" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi04/'.$this->session->userdata('invi02_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   
	   <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('tax/taxi04/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('tax/taxi04/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
		
	  </div> -->
</div> <!-- div-4 -->
   <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
