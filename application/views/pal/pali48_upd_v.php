 <div id="container">  <!-- div-1 -->
  <div id="header">    <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content">  <!-- div-3 -->
 <div class="box">  <!-- div-4 --> 
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 核定金額流覽輸入作業 - 修改</h1>
    </div>
	
    <div class="content">  <!-- div-5 --> 
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali48/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>--> 
	<div id="tab-general">  <!-- div-6 --> 
	<?php foreach($result as $row) { ?>
          <?php   $yh001=$row->yh001;?>
          <?php   $palq01a=$row->yh002;?>
		  <?php   $palq01adisp=$row->yh002disp;?>
          <?php   $yh003=$row->yh003;?>
		  <?php   $yh004=$row->yh004;?>
		  <?php   $yh005=$row->yh005;?>
		  <?php   $yh006=$row->yh006;?>
		  <?php   $yh007=$row->yh007;?>
		  <?php   $yh008=$row->yh008;?>
		  <?php   $yh009=$row->yh009;?>
		  <?php   $yh010=$row->yh010;?>
		  <?php   $yh011=$row->yh011;?>
		  <?php   $yh012=$row->yh012;?>
		  <?php   $yh013=$row->yh013;?>
		  <?php   $yh014=$row->yh014;?>
		  <?php   $yh015=$row->yh015;?>
		  <?php   $yh016=$row->yh016;?>
		  <?php   $yh017=$row->yh017;?>
		  <?php   $yh018=$row->yh018;?>
		  <?php   $yh019=$row->yh019;?>
		  <?php   $yh020=$row->yh020;?>
		  <?php   $yh021=$row->yh021;?>
		  <?php   $yh022=$row->yh022;?>
		  <?php   $yh023=$row->yh023;?>
		  <?php   $yh024=$row->yh024;?>
		  <?php   $yh025=$row->yh025;?>
		  <?php   $yh026=$row->yh026;?>
		  <?php   $yh027=$row->yh027;?>
		  <?php   $yh028=$row->yh028;?>
		  <?php   $yh029=$row->yh029;?>
		  <?php   $yh030=$row->yh030;?>
		  <?php   $yh031=$row->yh031;?>
		  <?php   $yh032=$row->yh032;?>
		  <?php   $yh033=$row->yh033;?>
		  <?php   $yh034=$row->yh034;?>
		  <?php   $yh035=$row->yh035;?>
		  <?php   $yh036=$row->yh036;?>
		  <?php   $yh037=$row->yh037;?>
		  <?php   $yh038=$row->yh038;?>
		  <?php   $yh039=$row->yh039;?>
		  <?php   $yh040=$row->yh040;?>
		  <?php   $yh041=$row->yh041;?>
		  <?php   $yh042=$row->yh042;?>
		  <?php   $yh043=$row->yh043;?>
		  <?php   $yh044=$row->yh044;?>
		  <?php   $yh045=$row->yh045;?>
		  <?php   $yh046=$row->yh046;?>
		  <?php   $yh047=$row->yh047;?>
		  <?php   $yh048=$row->yh048;?>
		  
		  <?php   $yh049=$row->yh049;?>
		  <?php   $yh050=$row->yh050;?>
		  <?php   $yh051=$row->yh051;?>
		  <?php   $yh052=$row->yh052;?>
		  <?php   $yh053=$row->yh053;?>
		  <?php   $yh054=$row->yh054;?>
		  <?php   $yh055=$row->yh055;?>
		  <?php   $yh056=$row->yh056;?>
		  <?php   $yh057=$row->yh057;?>
		  
		  
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
        
	 <tr>
	    <td class="start14a"  width="11%" ><span class="required">發薪年度：</span> </td>
        <td class="normal14"  width="39%"><input   tabIndex="1" id="yh001" onKeyPress="keyFunction()" onchange="startkey(this)" name="yh001" value="<?php echo $yh001; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		 <td class="normal14" width="11%" >員工代號：</td>
		<td class="normal14" width="39%" ><input   tabIndex="2" id="yh002" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?>  </span></td>
	  </tr>
	  <tr>
	    <td class="normal14" >部門代號：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="yh003" onKeyPress="keyFunction()" name="yh003"   value="<?php echo  $yh003; ?>"   /></td>
		<td class="normal14" >職稱代號：</td>
		<td class="normal14"  ><input type="text" tabIndex="4" id="yh004" onKeyPress="keyFunction()" name="yh004"   value="<?php echo  $yh004; ?>"   /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >部門名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="yh005" onKeyPress="keyFunction()" name="yh005"   value="<?php echo  $yh005; ?>"   /></td>
		<td class="normal14" >職稱名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="4" id="yh006" onKeyPress="keyFunction()" name="yh006"   value="<?php echo  $yh006; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >年資：</td>
		<td class="normal14"  ><input type="text" tabIndex="8" id="yh008" onKeyPress="keyFunction()" name="yh008"   value="<?php echo  $yh008; ?>"   /></td>
		<td class="normal14" >換算基數：</td>
		<td class="normal14"  ><input type="text" tabIndex="9" id="yh009" onKeyPress="keyFunction()" name="yh009"   value="<?php echo  $yh009; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >發放天數1：</td>
		<td class="normal14"  ><input type="text" tabIndex="10" id="yh010" onKeyPress="keyFunction()" name="yh010"   value="<?php echo  $yh010; ?>"   /></td>
		<td class="normal14" >發放天數2：</td>
		<td class="normal14"  ><input type="text" tabIndex="11" id="yh011" onKeyPress="keyFunction()" name="yh011"   value="<?php echo  $yh011; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >發放天數3：</td>
		<td class="normal14"  ><input type="text" tabIndex="12" id="yh012" onKeyPress="keyFunction()" name="yh012"   value="<?php echo  $yh012; ?>"   /></td>
		<td class="normal14" >發放天數4：</td>
		<td class="normal14"  ><input type="text" tabIndex="13" id="yh013" onKeyPress="keyFunction()" name="yh013"   value="<?php echo  $yh013; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >發放天數5：</td>
		<td class="normal14"  ><input type="text" tabIndex="14" id="yh014" onKeyPress="keyFunction()" name="yh014"   value="<?php echo  $yh014; ?>"   /></td>
		<td class="normal14" >遲到次：</td>
		<td class="normal14"  ><input type="text" tabIndex="15" id="yh015" onKeyPress="keyFunction()" name="yh015"   value="<?php echo  $yh015; ?>"   /></td>
	  </tr>
	    <tr>
	    <td class="normal14" >病假天：</td>
		<td class="normal14"  ><input type="text" tabIndex="16" id="yh016" onKeyPress="keyFunction()" name="yh016"   value="<?php echo  $yh016; ?>"   /></td>
		<td class="normal14" >事假天：</td>
		<td class="normal14"  ><input type="text" tabIndex="17" id="yh017" onKeyPress="keyFunction()" name="yh017"   value="<?php echo  $yh017; ?>"   /></td>
	  </tr>
	    <tr>
	    <td class="normal14" >功過加減：</td>
		<td class="normal14"  ><input type="text" tabIndex="18" id="yh018" onKeyPress="keyFunction()" name="yh018"   value="<?php echo  $yh018; ?>"   /></td>
		<td class="normal14" >全勤加發：</td>
		<td class="normal14"  ><input type="text" tabIndex="19" id="yh019" onKeyPress="keyFunction()" name="yh019"   value="<?php echo  $yh019; ?>"   /></td>
	  </tr>
	    <tr>
	    <td class="normal14" >可發日1：</td>
		<td class="normal14"  ><input type="text" tabIndex="20" id="yh020" onKeyPress="keyFunction()" name="yh020"   value="<?php echo  $yh020; ?>"   /></td>
		<td class="normal14" >可發日2：</td>
		<td class="normal14"  ><input type="text" tabIndex="21" id="yh021" onKeyPress="keyFunction()" name="yh021"   value="<?php echo  $yh021; ?>"   /></td>
	  </tr>
	    <tr>
	    <td class="normal14" >可發日3：</td>
		<td class="normal14"  ><input type="text" tabIndex="22" id="yh022" onKeyPress="keyFunction()" name="yh022"   value="<?php echo  $yh022; ?>"   /></td>
		<td class="normal14" >可發日4：</td>
		<td class="normal14"  ><input type="text" tabIndex="23" id="yh023" onKeyPress="keyFunction()" name="yh023"   value="<?php echo  $yh023; ?>"   /></td>
	  </tr>
	    <tr>
	    <td class="normal14" >可發日5：</td>
		<td class="normal14"  ><input type="text" tabIndex="24" id="yh024" onKeyPress="keyFunction()" name="yh024"   value="<?php echo  $yh024; ?>"   /></td>
		<td class="normal14" >日薪：</td>
		<td class="normal14"  ><input type="text" tabIndex="25" id="yh025" onKeyPress="keyFunction()" name="yh025"   value="<?php echo  $yh025; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >可發金額1：</td>
		<td class="normal14"  ><input type="text" tabIndex="26" id="yh026" onKeyPress="keyFunction()" name="yh026"   value="<?php echo  $yh026; ?>"   /></td>
		<td class="normal14" >可發金額2：</td>
		<td class="normal14"  ><input type="text" tabIndex="27" id="yh027" onKeyPress="keyFunction()" name="yh027"   value="<?php echo  $yh027; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >可發金額3：</td>
		<td class="normal14"  ><input type="text" tabIndex="28" id="yh028" onKeyPress="keyFunction()" name="yh028"   value="<?php echo  $yh028; ?>"   /></td>
		<td class="normal14" >可發金額4：</td>
		<td class="normal14"  ><input type="text" tabIndex="29" id="yh029" onKeyPress="keyFunction()" name="yh029"   value="<?php echo  $yh029; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >可發金額5：</td>
		<td class="normal14"  ><input type="text" tabIndex="30" id="yh030" onKeyPress="keyFunction()" name="yh030"   value="<?php echo  $yh030; ?>"   /></td>
		<td class="normal14" >實發金額1(應稅獎金)：</td>
		<td class="normal14"  ><input type="text" tabIndex="31" id="yh031" onKeyPress="keyFunction()" name="yh031"   value="<?php echo  $yh031; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >實發金額2(-遲-事+功-過+全)：</td>
		<td class="normal14"  ><input type="text" tabIndex="32" id="yh032" onKeyPress="keyFunction()" name="yh032"   value="<?php echo  $yh032; ?>"   /></td>
		<td class="normal14" >實發金額3(金額小計)：</td>
		<td class="normal14"  ><input type="text" tabIndex="33" id="yh033" onKeyPress="keyFunction()" name="yh033"   value="<?php echo  $yh033; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >實發金額4(免稅獎金)：</td>
		<td class="normal14"  ><input type="text" tabIndex="34" id="yh034" onKeyPress="keyFunction()" name="yh034"   value="<?php echo  $yh034; ?>"   /></td>
		<td class="normal14" >實發金額5(總獎金合計)：</td>
		<td class="normal14"  ><input type="text" tabIndex="35" id="yh035" onKeyPress="keyFunction()" name="yh035"   value="<?php echo  $yh035; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >核定金額：</td>
		<td class="normal14"  ><input type="text" tabIndex="36" id="yh036" onKeyPress="keyFunction()" name="yh036"   value="<?php echo  $yh036; ?>"   /></td>
		<td class="normal14" >核定天數：</td>
		<td class="normal14"  ><input type="text" tabIndex="37" id="yh037" onKeyPress="keyFunction()" name="yh037"   value="<?php echo  $yh037; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >保留金額3：</td>
		<td class="normal14"  ><input type="text" tabIndex="38" id="yh038" onKeyPress="keyFunction()" name="yh038"   value="<?php echo  $yh038; ?>"   /></td>
		<td class="normal14" >保留金額4：</td>
		<td class="normal14"  ><input type="text" tabIndex="39" id="yh039" onKeyPress="keyFunction()" name="yh039"   value="<?php echo  $yh039; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >保留金額5：</td>
		<td class="normal14"  ><input type="text" tabIndex="40" id="yh040" onKeyPress="keyFunction()" name="yh040"   value="<?php echo  $yh040; ?>"   /></td>
		<td class="normal14" >年度考績：</td>
		<td class="normal14"  ><input type="text" tabIndex="41" id="yh041" onKeyPress="keyFunction()" name="yh041"   value="<?php echo  $yh041; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >年度總分：</td>
		<td class="normal14"  ><input type="text" tabIndex="42" id="yh042" onKeyPress="keyFunction()" name="yh042"   value="<?php echo  $yh042; ?>"   /></td>
		<td class="normal14" >期初金額：</td>
		<td class="normal14"  ><input type="text" tabIndex="43" id="yh043" onKeyPress="keyFunction()" name="yh043"   value="<?php echo  $yh043; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >備註：</td>
		<td class="normal14"  ><input type="text" tabIndex="44" id="yh044" onKeyPress="keyFunction()" name="yh044"   value="<?php echo  $yh044; ?>"  size="60" /></td>
		<td class="normal14" >公司別：</td>
		<td class="normal14"  ><input type="text" tabIndex="45" id="yh045" onKeyPress="keyFunction()" name="yh045"   value="<?php echo  $yh045; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >年終發放：</td>
		<td class="normal14"  ><input type="text" tabIndex="46" id="yh046" onKeyPress="keyFunction()" name="yh046"   value="<?php echo  $yh046; ?>"   /></td>
		<td class="normal14" >年終類別：</td>
		<td class="normal14"  ><input type="text" tabIndex="47" id="yh047" onKeyPress="keyFunction()" name="yh047"   value="<?php echo  $yh047; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >列印名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="48" id="yh048" onKeyPress="keyFunction()" name="yh048"   value="<?php echo  $yh048; ?>"   /></td>
		<td class="normal14" >現金轉帳代號</td>
		<td class="normal14"  ><input type="text" tabIndex="49" id="yh049" onKeyPress="keyFunction()" name="yh049"   value="<?php echo  $yh049; ?>"   /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >投保金額：</td>
		<td class="normal14"  ><input type="text" tabIndex="50" id="yh050" onKeyPress="keyFunction()" name="yh050"   value="<?php echo  $yh050; ?>"   /></td>
		<td class="normal14" >應發總額</td>
		<td class="normal14"  ><input type="text" tabIndex="51" id="yh051" onKeyPress="keyFunction()" name="yh051"   value="<?php echo  $yh051; ?>"   /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >扣繳稅率：</td>
		<td class="normal14"  ><input type="text" tabIndex="52" id="yh052" onKeyPress="keyFunction()" name="yh052"   value="<?php echo  $yh052; ?>"   /></td>
		<td class="normal14" >扣繳稅額</td>
		<td class="normal14"  ><input type="text" tabIndex="53" id="yh053" onKeyPress="keyFunction()" name="yh053"   value="<?php echo  $yh053; ?>"   /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >扣健保2%</td>
		<td class="normal14"  ><input type="text" tabIndex="54" id="yh054" onKeyPress="keyFunction()" name="yh054"   value="<?php echo  $yh054; ?>"   /></td>
		<td class="normal14" >實領金額</td>
		<td class="normal14"  ><input type="text" tabIndex="55" id="yh055" onKeyPress="keyFunction()" name="yh055"   value="<?php echo  $yh055; ?>"   /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >現金發放</td>
		<td class="normal14"  ><input type="text" tabIndex="56" id="yh056" onKeyPress="keyFunction()" name="yh056"   value="<?php echo  $yh056; ?>"   /></td>
		<td class="normal14" >轉帳金額</td>
		<td class="normal14"  ><input type="text" tabIndex="57" id="yh057" onKeyPress="keyFunction()" name="yh057"   value="<?php echo  $yh057; ?>"   /></td>
	  </tr>
    </table>
		
	<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	<div class="buttons">
	   <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('pal/pali48/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	   
    </form>
    </div>  <!-- div-6 -->
  </div>   <!-- div-5 -->
</div>     <!-- div-4 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>  <!-- div-3 -->
  </div>   <!-- div-2 -->
</div>   <!-- div-1 -->