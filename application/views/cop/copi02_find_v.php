<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	  <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
        </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶商品計價建立作業 - 設定查詢條件　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	   <button style= "cursor:pointer" form="commentForm" onfocus="$('#find003').focus();" tabIndex="7" type='submit' accesskey="k"  name='submit'  class="button" value='&nbsp;確定F8&nbsp;'><span>查詢Alt+k</span><img src="<?php echo base_url()?>assets/image/png/find.png" /></button>&nbsp;&nbsp;
	    <a accesskey="x" tabIndex="8" id='cancel' name='cancel' href="<?php echo site_url('cop/copi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form"  action="<?php echo base_url()?>index.php/cop/copi02/findsql" method="post" enctype="multipart/form-data" >
    </div>
    
    <div class="content"> <!-- div-5 -->
    <!-- <div id="htabs" class="htabs14"><span>進階資料-設定查詢條件</span></div>-->
    <div id="tab-general"> <!-- div-6 -->
	<?php
      $date=date("Ymd");
	  $find001=$this->input->post('find001');
	  $find002=$this->input->post('find002');
	  $find003=$this->input->post('find003');
	  $find004=$this->input->post('find004');
	  $find005=$this->input->post('find005');
	  $find006=$this->input->post('find006');
	  $find007=$this->input->post('find007');
	  $find008=$this->input->post('find008');
	  $find009=$this->input->post('find009');
	?>
	<table class="form14"> <!-- 表格 -->
      <tr>
	    <td class="start14a" width="18">
	      <select name="find001" id="find001" tabIndex="1" >
                <option <?php if($find001 == '1') echo 'selected="selected"';?> value='MB001'> MB001 客戶代號 </option>                                                                        
		        <option <?php if($find001 == '2') echo 'selected="selected"';?> value='MB002'> MB002 品名代號 </option>
                <option <?php if($find001 == '3') echo 'selected="selected"';?> value='MB004'> MB004 幣別代號 </option>
                <option <?php if($find001 == '4') echo 'selected="selected"';?> value='MB014'> MB014 初次交易 </option>
		        <option <?php if($find001 == '5') echo 'selected="selected"';?> value='MB009'> MB009 核價日期 </option>
		        <option <?php if($find001 == '6') echo 'selected="selected"';?> value='MB014'> MB017 生效日期 </option>
		        <option <?php if($find001 == '7') echo 'selected="selected"';?> value='CREATE_DATE'> CREATE_DATE 建立日期 </option>
	      </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 
	      <select name="find002" id="find002" tabIndex="2" >
                <option <?php if($find002 == '1') echo 'selected="selected"';?> value=' = '> = </option>                                                                        
		        <option <?php if($find002 == '2') echo 'selected="selected"';?> value=' >= '> >= </option>
                <option <?php if($find002 == '3') echo 'selected="selected"';?> value=' <= '> <= </option>
                <option <?php if($find002 == '4') echo 'selected="selected"';?> value=' > '> > </option>
		        <option <?php if($find002 == '5') echo 'selected="selected"';?> value=' < '> < </option>
		        <option <?php if($find002 == '6') echo 'selected="selected"';?> value=' != '> != </option>
		        <option <?php if($find002 == '7') echo 'selected="selected"';?> value=' like '> like </option>
	      </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	      <input tabIndex="3" type="text" name="find003" onKeyPress="keyFunction()" id="find003" value=""  size="20"  />
        </td>
	  </tr>
			
	  <tr>
	    <td class="start14" width="06">&nbsp;&nbsp;條件關係：
	      <select name="find004" id="find004" tabIndex="4">
               <option value=" AND " selected="selected">AND</option>
               <option value="OR">OR</option>				
          </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <a onclick="OnBlur1();"  class="button" tabIndex="-1">清除</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a onclick="OnBlur();"   class="button" tabIndex="-1" >加入</a>
	    </td>							  
	</tr>
		
	<tr>
	  <td class="normal14"><textarea  tabIndex="-1" rows="6" cols="40" name="find005" id="find005" Wrap="Physical" minlength="1" required></textarea></td>
	</tr>
		
	<tr>
	  <td class="start14" width="04">&nbsp;&nbsp;排序欄位：
	     <select name="find006" id="find006" " tabIndex="5" >
            	<option <?php if($find006 == '1') echo 'selected="selected"';?> value='MB001'> MB001 品別代號 </option>                                                                        
		        <option <?php if($find006 == '2') echo 'selected="selected"';?> value='MB002'> MB002 廠商代號 </option>
                <option <?php if($find006 == '3') echo 'selected="selected"';?> value='MB004'> MB004 幣別代號 </option>
                <option <?php if($find006 == '4') echo 'selected="selected"';?> value='MB014'> MB014 初次交易 </option>
		        <option <?php if($find006 == '5') echo 'selected="selected"';?> value='MB009'> MB009 核價日期 </option>
			    <option <?php if($find006 == '6') echo 'selected="selected"';?> value='MB017'> MB017 生效日期 </option>
		        <option <?php if($find006 == '7') echo 'selected="selected"';?> value='CREATE_DATE'> CREATE_DATE 建立日期 </option>
	     </select>&nbsp;&nbsp;&nbsp;&nbsp;
	     <select name="find008" id="find008" " tabIndex="6" >
               	<option <?php if($find008 == 'asc') echo 'selected="selected"';?> value=' asc'> 由小到大 </option>                                                                        
		        <option <?php if($find008 == 'desc') echo 'selected="selected"';?> value=' desc'> 由大到小 </option>
	     </select>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a onclick="OnBlur3();"   class="button" tabIndex="-1">清除</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a onclick="OnBlur2();"   class="button" tabIndex="-1" >加入</a>
	  </td>
	</tr>
		
	<tr>
	  <td class="normal14"><textarea  tabIndex="-1" rows="6" cols="40" name="find007" id="find007" Wrap="Physical"></textarea></td>
	</tr>
		
	<tr>
	</tr>
    </table>
	<!--  <div class="buttons">
	    <button tabIndex="7" type='submit' accesskey="k"  name='submit'  class="button" value='&nbsp;確定F8&nbsp;'><span>查詢Alt+k</span><img src="<?php echo base_url()?>assets/image/png/find.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <a accesskey="x" tabIndex="8" id='cancel' name='cancel' href="<?php echo site_url('cop/copi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>-->
		
      </form>
	  <?php	 if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>

    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<script language="javascript">
   function trim(strvalue) {
     ptntrim = /(^\s*)|(\s*$)/g;
     return strvalue.replace(ptntrim,"");
    }

    function OnBlur()
      {
	var str1 = '(',  str2 = ')', str3 = '"', str4 = '"',str22='';
	if (trim(find002.value) == 'like') {str22='%'; } 
	if ( trim(find005.value) != '') {
          find005.value = trim(find005.value) + find004.value + str1 + find001.value + find002.value + str3 + find003.value +str22 + str4  + str2  ;
	}
	else
	{
	 find005.value = str1  + find001.value + find002.value + str3 + find003.value + str22 + str4  + str2  ;
	}
      }
      
    function OnBlur1()
      {
         find005.value = '';
      }
	
   function OnBlur2()
     {
        var str5 = ','; 
        if ( trim(find007.value) != '') {
        find007.value = trim(find007.value) + str5 + find006.value + find008.value   ;
	}
	else
	{
	find007.value = trim(find007.value) + find006.value + find008.value   ;
	}
     }
     
    function OnBlur3()
     {
       find007.value = '';
     }
	
    function OnBlur9()
     {
	url = '<?php echo base_url()?>index.php/cop/copi02/findsql/' + find005.value +'/'+ find007.value ; 
        location = url;
     }
	
</script>
<?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 共用函數 -->