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
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業</h1>
	  <form  class="cmxform" id="commentForm"  name="form"  action="<?=base_url()?>index.php/inv/invi03/findsql" method="post" enctype="multipart/form-data" >
	</div>
    <div class="content">
	<div id="htabs" class="htabs14"><span>進階資料-設定查詢條件</span></div>
    <div id="tab-general">
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
               <option <?php if($find001 == '1') echo 'selected="selected"';?> value='MA001'> MA001 分類方式 </option>                                                                        
			   <option <?php if($find001 == '2') echo 'selected="selected"';?> value='MA002'> MA002 品號類別代號 </option>
               <option <?php if($find001 == '3') echo 'selected="selected"';?> value='MA003'> MA003 品號類別名稱 </option>
               <option <?php if($find001 == '4') echo 'selected="selected"';?> value='MA004'> MA004 存貨會計科目 </option>
			   <option <?php if($find001 == '5') echo 'selected="selected"';?> value='MA005'> MA005 銷貨收入科目 </option>
			   <option <?php if($find001 == '6') echo 'selected="selected"';?> value='MA006'> MA006 銷貨退回科目 </option>
			   <option <?php if($find001 == '7') echo 'selected="selected"';?> value='CREATE_DATE'> CREATE_DATE 建立日期 </option>
			</select>
			   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
            	<option <?php if($find006 == '1') echo 'selected="selected"';?> value='MA001'> MA001 分類方式 </option>                                                                        
				<option <?php if($find006 == '2') echo 'selected="selected"';?> value='MA002'> MA002 品號類別代號 </option>
                <option <?php if($find006 == '3') echo 'selected="selected"';?> value='MA003'> MA003 品號類別名稱 </option>
                <option <?php if($find006 == '4') echo 'selected="selected"';?> value='MA004'> MA004 存貨會計科目 </option>
				<option <?php if($find006 == '5') echo 'selected="selected"';?> value='MA005'> MA005 銷貨收入科目 </option>
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
		<input type='hidden' name='company' id='company' value='DERSHENG' />
		<input type='hidden' name='creator' id='creator' value='89044' />
		<input type='hidden' name='usr_group' id='usr_group' value='test' />
		<input type='hidden' name='create_date' id='create_date' value="<?php $date; ?>" />
		<input type='hidden' name='modifier' id='modifier' value='' />
		<input type='hidden' name='modi_date' id='modi_date' value='' />
		<input type='hidden' name='flag' id='flag' value=0 />
		
		<div class="buttons">
	    <button tabIndex="7" type='submit'  name='submit'  class="button" value='&nbsp;確定F8&nbsp;'><span>&nbsp;確定 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <a tabIndex="8" id='cancel' name='cancel' href="<?php echo site_url('inv/invi03/display'); ?>" class="button" ><span>取 消&nbsp;F9</span></a>
	    </div>
		
      </form>
      
	</div>
  </div>
</div>
<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>

</div>
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
	
</script>

  </div> 
 </div>
</div> 