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
    </div>
	
    <div class="content">
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/pur/puri05/updsave" method="post" enctype="multipart/form-data" >
	<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>
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
		   <?  $flag=$row->flag;?>	
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
	<?php 
	  $ta001disp=$this->input->post('ta001');
	  $ta004disp=$this->input->post('ta004');
	  $ta010disp=$this->input->post('ta010');
	  $ta012disp=$this->input->post('ta012');
	 

	  //開視窗及不更新網頁直接輸入出現中文	 
	  if($this->uri->segment(4) && $this->uri->segment(6)==0) { $ta001=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta001', $ta001);$ta001 = $this->session->userdata('ta001'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==0) { $ta001disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta001disp', $ta001disp); $ta001disp = $this->session->userdata('ta001disp');} 
	  
      if($this->uri->segment(4) && $this->uri->segment(6)==1) { $ta004=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta004', $ta004);$ta004 = $this->session->userdata('ta004'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==1) { $ta004disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta004disp', $ta004disp); $ta004disp = $this->session->userdata('ta004disp');} 
	   
	  
      if($this->uri->segment(4) && $this->uri->segment(6)==2) { $ta010=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta010', $ta010);$ta010 = $this->session->userdata('ta010'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==2) { $ta010disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta010disp', $ta010disp); $ta010disp = $this->session->userdata('ta010disp');} 
	  
	   
      if($this->uri->segment(4) && $this->uri->segment(6)==3) { $ta012=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta012', $ta012);$ta012 = $this->session->userdata('ta012'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==3) { $ta012disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta012disp', $ta012disp); $ta012disp = $this->session->userdata('ta012disp');} 
	  
	 
      if ($this->session->userdata('ta004')) { $ta004= $this->session->userdata('ta004'); }
	  if ($this->session->userdata('ta010')) { $ta010= $this->session->userdata('ta010'); }
	  if ($this->session->userdata('ta012')) { $ta012= $this->session->userdata('ta012'); }
	  if ($this->session->userdata('ta001')) { $ta001 = $this->session->userdata('ta001'); } else { $ta001=$this->input->post('ta001'); }
	
   
	  
	?>
	 <table class="form12"  >     <!-- 頭部表格 -->
	  <tr>
	     
	     <td class="start12a"  width="10%"><span class="required">請購單別：</span> </td>
            <td class="normal12a"  width="50%"><input tabIndex="1" id="ta001"    onKeyPress="keyFunction()"  onchange="startdata1(this)"  name="ta001" value="<?php echo strtoupper($ta001); ?>"  type="text" required /><a href="javascript:;"><img id="Showpurq04a31" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		    <span id="ta001disp"> <?php  echo $this->session->userdata('ta001disp');  ?><?php  if (!$this->session->userdata('ta001disp'))  echo $ta001disp; ?> </span></td>
			
	    <td class="normal12a" width="10%" > </td>
            <td class="normal12a"  width="50%" >&nbsp;&nbsp;</td>
	 </tr>	
		  
	  <tr>
	    <td class="start12a" ><span class="required">講購單號：</span> </td>
            <td class="normal12a" ><input tabIndex="2" id="ta002" onKeyPress="keyFunction()" onKeyUp="chkno1(this)" name="ta002" value="<?php echo $ta002; ?>" size="30" type="text" required /><span id="ta002disp" ></span></td>
		   <td class="normal12a">&nbsp;&nbsp;</td>
            <td class="normal12a"></td>
		
	  </tr>
		
	  <tr>
	    <td  class="normal12" >單據日期：</td>
            <td  class="normal12"  ><input tabIndex="3"  class="date" id="ta013" onKeyPress="keyFunction()"  onKeyUp="chkno1(this)" name="ta013"  value="<?php echo substr($ta013,0,4).'/'.substr($ta013,4,2).'/'.substr($ta013,6,2); ?>"  size="10" type="text"   /></td>
			 <td class="normal12">&nbsp;&nbsp;</td>
            <td class="normal12"></td>
	  </tr>
		
	</table>
	
	
	
	<div class="abgne_tab">
		<ul class="tabs">
			<li><a href="#tab1">基本資料</a></li>			
		</ul>

    <div class="tab_container">
			<div id="tab1" class="tab_content">
		<!--  <div id="tab-general">     基本資料 -->	
       <table class="form14">     <!-- 表格 -->
	 <tr>
	    
		<td class="start14a"  width="10%">請購部門：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="4" onKeyPress="keyFunction()"  id="ta004" onchange="startcmsq05a(this);" name="ta004"   value="<?php echo  $ta004; ?>"     /><a href="javascript:;"><img id="Showcmsq05a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="ta004disp"> <?php  echo $this->session->userdata('ta004disp');  ?><?php  if (!$this->session->userdata('ta004disp'))  echo $ta004disp; ?> </span></td>	
			
		<td class="start14a"  width="10%" > 廠別：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="5" onKeyPress="keyFunction()" id="ta010"  onchange="startcmsq02a(this)" name="ta010"   value="<?php echo  $ta010; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
	    <span id="ta010disp"> <?php  echo $this->session->userdata('ta010disp');  ?><?php  if (!$this->session->userdata('ta010disp'))  echo $ta010disp; ?> </span></td>
       
	</tr>	
		  
	  <tr>
	   <td class="start14a"  >請購人員：</td>
        <td class="normal14" ><input type="text" tabIndex="6" id="ta012" onKeyPress="keyFunction()"   onchange="startpalq01a(this)" name="ta012"   value="<?php echo  $ta012; ?>"    size="6"  /><a href="javascript:;"><img id="Showpalq01a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="ta012disp"> <?php  echo $this->session->userdata('ta012disp');  ?><?php  if (!$this->session->userdata('ta012disp'))  echo $ta012disp; ?> </span></td>
	    <td class="normal14b" >請購日期：</td>
        <td class="normal14b"  ><input type="text"   tabIndex="7"  readonly="value" onKeyPress="keyFunction()"   name="ta003" value="<?php echo $ta003; ?>" style="background-color:#EBEBE4"  /></td>
				
	  </tr>
		
	  <tr>
	    <td  class="normal14" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8"  onKeyPress="keyFunction()" id="ta008" name="ta008" value="<?php echo $ta008; ?>"   /></td>		   
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
                <td width="18%" class="left">品名</td>
				<td width="18%" class="left">規格</td>
				<td width="6%" class="left">單位</td>
				<td width="10%" class="left">需求日期</td>
                <td width="6%" class="center">數量</td>
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
				<td class="left" colspan="11"></td>
              </tr>
			  <!--   明細0  -->
			  <?php $i=0; $product_row='0'; ?>
		<tbody id="product-row0">		
	     <tr>
	     <td class="center"><img src="<?=base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
  	     <input type="hidden"  name="order_product[0][tb001]" value="<?php echo $tb001[$i]; ?>" />
	     <input type="hidden" name="order_product[0][tb002]" value="<?php echo $tb002[$i]; ?>" />	
	     <input type="hidden"  name="order_product[0][tb003]" value="<?php echo $tb003[$i]; ?>"  />
	     <td class="left"><input type="text"  tabIndex="14" id="tb0040"   name="order_product[0][tb004]" value="<?php echo $tb004[$i]; ?>" size="20"   /></td>
	     <td class="left"><input  type="text" tabIndex="15" onKeyPress="keyFunction()"  id="tb005"  name="order_product[0][tb005]" value="<?php echo $tb005[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text" tabIndex="16" onKeyPress="keyFunction()"  id="tb006"   name="order_product[0][tb006]" value="<?php echo $tb006[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text" tabIndex="17" onKeyPress="keyFunction()"    id="tb007"   name="order_product[0][tb007]" value="<?php echo $tb007[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text" tabIndex="18"   id="tb011[0]" onKeyPress="keyFunction()" name="order_product[0][tb011]" value="<?php echo  substr($tb011[$i],0,4).'/'.substr($tb011[$i],4,2).'/'.substr($tb011[$i],6,2); ?>" size="10"  class="date"  /></td>
	     <td class="center"><input type="text" tabIndex="19" id="tb009" onKeyPress="keyFunction()" name="order_product[0][tb009]" value="<?php echo $tb009[$i]; ?>" size="3" style="text-align:right;" /></td>
         <td class="center"><input type="text"  tabIndex="20" id="tb017" onKeyPress="keyFunction()" name="order_product[0][tb017]" value="<?php echo $tb017[$i]; ?>" size="6" style="text-align:right;"  /></td>	
         <td class="right"><input readonly="value" type="text" tabIndex="21" name="order_product[0][tb018]" value="<?php echo $tb018[$i]; ?>" size="10" style="text-align:right;" /></td>
	     <td class="left"><input type="text"  tabIndex="22"id="tb012"  onKeyPress="keyFunction()" name="order_product[0][tb012]" value="<?php echo $tb012[$i]; ?>" size="20"  /></td>
	     </tr>	    
        </tbody>	
     <script type="text/javascript"><!--	
	   var product_row = "1"; 
         $.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
						
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
								
				currentCategory = item.category;
			}
							
			self._renderItem(ul, item);
		});
	}
});		 
		 $('input[name=\'order_product[0][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tb0040').val();
			 alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[0][tb009]\'],input[name=\'order_product[0][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
		//流水號
		var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][tb003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*10)+num_1; 
	    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
		
		//alert(num_2);
		
	});
	   //數量
	$('input[name=\'order_product[0][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[0][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[0][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
			$(this).val('');
	});
            
	$('input[name=\'order_product[0][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
		  
		  	  <!--   明細1  -->
			   <?php $i=1; ?>
		<tbody id="product-row1">		
	     <tr>
	     <td class="center"><img src="<?=base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row1\').remove();" /></td>
  	     <input type="hidden"  name="order_product[1][tb001]" value="<?php echo $tb001[$i]; ?>" />
	     <input type="hidden" name="order_product[1][tb002]" value="<?php echo $tb002[$i]; ?>" />	
	     <input type="hidden"  name="order_product[1][tb003]" value="<?php echo $tb003[$i]; ?>"  />
	     <td class="left"><input type="text"  tabIndex="14" id="tb0041"   name="order_product[1][tb004]" value="<?php echo $tb004[$i]; ?>" size="20"   /></td>
	     <td class="left"><input  type="text" tabIndex="15" onKeyPress="keyFunction()"  id="tb005"  name="order_product[1][tb005]" value="<?php echo $tb005[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text" tabIndex="16" onKeyPress="keyFunction()"  id="tb006"   name="order_product[1][tb006]" value="<?php echo $tb006[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text" tabIndex="17" onKeyPress="keyFunction()"    id="tb007"   name="order_product[1][tb007]" value="<?php echo $tb007[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text" tabIndex="18"   id="tb011[1]" onKeyPress="keyFunction()" name="order_product[1][tb011]" value="<?php echo substr($tb011[$i],0,4).'/'.substr($tb011[$i],4,2).'/'.substr($tb011[$i],6,2); ?>" size="10" class="date"   /></td>
	     <td class="center"><input type="text" tabIndex="19" id="tb009" onKeyPress="keyFunction()" name="order_product[1][tb009]" value="<?php echo $tb009[$i]; ?>" size="3" style="text-align:right;" /></td>
         <td class="center"><input type="text"  tabIndex="20" id="tb017" onKeyPress="keyFunction()" name="order_product[1][tb017]" value="<?php echo $tb017[$i]; ?>" size="6" style="text-align:right;"  /></td>	
         <td class="right"><input readonly="value" type="text" tabIndex="21" name="order_product[1][tb018]" value="<?php echo $tb018[$i]; ?>" size="10" style="text-align:right;" /></td>
	     <td class="left"><input type="text"  tabIndex="22"id="tb012"  onKeyPress="keyFunction()" name="order_product[1][tb012]" value="<?php echo $tb012[$i]; ?>" size="20"  /></td>
	     </tr>	    
        </tbody>	
     <script type="text/javascript"><!--
         var product_row = "2"; 	 
        $.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
						
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
								
				currentCategory = item.category;
			}
							
			self._renderItem(ul, item);
		});
	}
});	
	 
		 $('input[name=\'order_product[1][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0041').val();
			alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[1][tb009]\'],input[name=\'order_product[1][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
		//流水號
		var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][tb003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*10)+num_1; 
	    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
		
		//alert(num_2);
		
	});
	   //數量
	$('input[name=\'order_product[1][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[1][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
			$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
	<!--     <?php $i=0;$product_row = 0;  ?>
		<?php foreach($result as $row) { ?>	
         <tbody id="product-row' + product_row + '">		
	     <tr>
	     <td class="center"><img src="<?=base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>
  	     <input type="hidden"  name="order_product[' + product_row + '][tb001]" value="<?php echo $tb001[$i]; ?>" />
	     <input type="hidden" name="order_product[' + product_row + '][tb002]" value="<?php echo $tb002[$i]; ?>" />	
	     <input type="hidden"  name="order_product[' + product_row + '][tb003]" value="<?php echo $tb003[$i]; ?>"  />
	     <td class="left"><input type="text"  tabIndex="14" id="tb004' + product_row + '"   name="order_product[$product_row][tb004]" value="<?php echo $tb004[$i]; ?>" size="20"   /></td>
	     <td class="left"><input  type="text" tabIndex="15" onKeyPress="keyFunction()"  id="tb005"  name="order_product[' + product_row + '][tb005]" value="<?php echo $tb005[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text" tabIndex="16" onKeyPress="keyFunction()"  id="tb006"   name="order_product[' + product_row + '][tb006]" value="<?php echo $tb006[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text" tabIndex="17" onKeyPress="keyFunction()"    id="tb007"   name="order_product[' + product_row + '][tb007]" value="<?php echo $tb007[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text" tabIndex="18"   id="tb011['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb011]" value="<?php echo $tb011[$i]; ?>" size="10"   /></td>
	     <td class="center"><input type="text" tabIndex="19" id="tb009" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb009]" value="<?php echo $tb009[$i]; ?>" size="3" style="text-align:right;" /></td>
         <td class="center"><input type="text"  tabIndex="20" id="tb017" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb017]" value="<?php echo $tb017[$i]; ?>" size="6" style="text-align:right;"  /></td>	
         <td class="right"><input readonly="value" type="text" tabIndex="21" name="order_product[' + product_row + '][tb018]" value="<?php echo $tb018[$i]; ?>" size="10" style="text-align:right;" /></td>
	     <td class="left"><input type="text"  tabIndex="22"id="tb012"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb012]" value="<?php echo $tb012[$i]; ?>" size="20"  /></td>
	     </tr>	    
        </tbody>	   
		 <?php $i=$i+1;$product_row = $product_row+1; }?>	 --> 
			  
              </tfoot>
          </table>
        </div>
	
	 </div>
	</div>
	<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	<div class="buttons">
	<button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri05/display'); ?>" class="button" ><span>返 回&nbsp;F9</span></a>
	</div> 
	  
    </form>
    </div> 
	
  </div>
</div>

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> 
  </div> 
   </div> 

<script type="text/javascript"> 	   //開視窗 一定要寫 31 單別ta001
	$(document).ready(function(){
	$("#Showpurq04a31").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%',   
	left: '25%',    
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm31'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divForm31" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/pur/purq04a/display31" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addpurq04a31(sta001,sta002) {	
	form.ta001.value=sta001;
	var oSpan = document.getElementById("ta001disp");
		oSpan.innerHTML = sta002;
	document.form.ta001.focus();    
	return ta001;	
}
//--></script>
	
	
<script type="text/javascript"> 	   //開視窗 一定要寫 10 廠別ta010
	$(document).ready(function(){ 	   
	$("#Showcmsq02a").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm10'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm10" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq02a/display" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq02a(sta001,sta002) {
	  	  form.ta010.value=sta001;
	var oSpan = document.getElementById("ta010disp");
		oSpan.innerHTML = sta002;
	document.form.ta010.focus();    
	return ta010;
	
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 04 請購部門ta004
	$(document).ready(function(){ 	   
	$("#Showcmsq05a").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm4'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm4" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq05a/display" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq05a(sta001,sta002) {
	  	  form.ta004.value=sta001;
	var oSpan = document.getElementById("ta004disp");
		oSpan.innerHTML = sta002;
	document.form.ta004.focus();    
	return ta004;
	
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 12 請購人員ta012
	$(document).ready(function(){ 	   
	$("#Showpalq01a").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm12'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm12" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/pal/palq01a/display" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpalq01a(sta001,sta002) {
	  form.ta012.value=sta001;
	var oSpan = document.getElementById("ta012disp");
		oSpan.innerHTML = sta002;
	document.form.ta012.focus();    
	return ta012;
	
}
//--></script>

<script language="javascript"  >   //不更新網頁, 帶出資料 31  請購單別 ta001
 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}


function showdata1(sText){                 //不更新網頁 31  請購單別 ta001
	var oSpan = document.getElementById("ta001disp");
      //   chkno1();
     //   alert('test');		
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

         
function startdata1(oInput){            //不更新網頁 31  請購單別 ta001
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta001disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   
   	var sUrl = "<?=base_url()?>index.php/pur/puri05/datapurq04a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showdata1(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq05a(sText){   //不更新網頁 ta004 請購部門
	var oSpan = document.getElementById("ta004disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startcmsq05a(oInput){         //不更新網頁 ta004 請購部門
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta004disp").html("此欄位不可空白.");	
	//	return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri05/datacmsq05a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq05a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq02a(sText){   //不更新網頁 ta010 廠別
	var oSpan = document.getElementById("ta010disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startcmsq02a(oInput){         //不更新網頁 ta010 廠別
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta010disp").html("不可空白.");	
	//	return;
	//}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri05/datacmsq02a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq02a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}


function showpalq01a(sText){   //不更新網頁 ta012  請購人員
	var oSpan = document.getElementById("ta012disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startpalq01a(oInput){         //不更新網頁 ta012 請購人員
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri05/datapalq01a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpalq01a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showchkno1(sText){   //不更新網頁 ta002  請購單號
    
       if  (!sText) { sText=$('input[name=\'ta013\']').attr('value');   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	   
	   var zno=zno1+zno2;
	  // alert(zno1);
	   var zno3=parseInt(zno)+1;
	   document.getElementById("ta002").value=zno3;
	//	alert(zno3);
	//var oSpan = document.getElementById("ta002");	 
	// oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	 //   oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	

function chkno1(oInput){         //不更新網頁 ta002 請購單號
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	
	 var zno=$('input[name=\'ta001\']').attr('value');
	 var zstr=$('input[name=\'ta013\']').attr('value');
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
   //   alert(zstr);
	  
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri05/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showchkno1(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
//--></script> 	
<script type="text/javascript"><!--       //檢查欄位空白
 function checkspace2(oInput){         //不更新網頁 2 請購單號
  
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#ta002disp").html("<span style='color:red'>不可空白.</span>");	
		return ;
	}
	 
}

//--></script> 	
<script type="text/javascript"> 
$(function () { 
var i = 0;//索引 
//以上的表单位置和上下文之间的关系就是label 后面总会有一个input 标签type 可能是Password 可能是text 或者是其他的 
//可以按照个人需求修改，这里只定位到type="text" 的表单如果是又有表单的话改成 $("label+ input") $("label+ :text")即可按个人需求 
$("class+ input").each(function () { 
$(this).keydown(function (e) { 
if (e.keyCode == 13) { 
i++;//下一个定位的索引 
try { 
$("class+ input")[i].focus(); 
} catch (e) {//到了最后一个的下一个可能找不到元素会出现异常通过try 捕捉不至于程序出现异常 
return false;//必须要写以免错误信息被提交 
} 
return false;//必须要写以免错误信息被提交 
} 
}); 
}); 
}); 
</script> 

<script type="text/javascript"><!--
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
						
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
								
				currentCategory = item.category;
			}
							
			self._renderItem(ul, item);
		});
	}
});	


$('input[name=\'order_product[' + product_row + '][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tb004').value;
		       
			 if (product_row == "1" ) { smb001= $('#tb0040').val(); }
			 if (product_row == "2" ) { smb001= $('#tb0041').val(); }
			 if (product_row == "3" ) { smb001= $('#tb0042').val(); }
		     if (product_row == "4" ) { smb001= $('#tb0043').val(); }
			 if (product_row == "5" ) { smb001= $('#tb0044').val(); }
			 if (product_row == "6" ) { smb001= $('#tb0045').val(); }
			 if (product_row == "7" ) { smb001= $('#tb0046').val(); }
		     if (product_row == "8" ) { smb001= $('#tb0047').val(); }
			 if (product_row == "9" ) { smb001= $('#tb0048').val(); }
			 if (product_row == "10" ) { smb001= $('#tb0049').val(); }	
			 if (product_row == "11" ) { smb001= $('#tb00410').val(); }
			 if (product_row == "12" ) { smb001= $('#tb00411').val(); }
			 if (product_row == "13" ) { smb001= $('#tb00412').val(); }
		     if (product_row == "14" ) { smb001= $('#tb00413').val(); }
			 if (product_row == "15" ) { smb001= $('#tb00414').val(); }
			 if (product_row == "16" ) { smb001= $('#tb00415').val(); }
			 if (product_row == "17" ) { smb001= $('#tb00416').val(); }
		     if (product_row == "18" ) { smb001= $('#tb00417').val(); }
			 if (product_row == "19" ) { smb001= $('#tb00418').val(); }
			 if (product_row == "20" ) { smb001= $('#tb00419').val(); }	
			
			//   smb001=$("#tb004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
	  
	
	
	   
      //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tb009]\'],input[name=\'order_product[' + product_row + '][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
		//流水號
		var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][tb003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*10)+num_1; 
	    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
		
		//alert(num_2);
		
	});
	   //數量
	$('input[name=\'order_product[' + product_row + '][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[' + product_row + '][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[' + product_row + '][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
			$(this).val('');
	});
            
	$('input[name=\'order_product[' + product_row + '][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

<script type="text/javascript"><!--    // 明細 新增 
var product_row = 2; 

function addItem() {
	html  = '<tbody id="product-row' + product_row + '">';
	html += '  <tr>'; 
	html += '    <td class="center"><img src="<?=base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
  	html += '    <input type="hidden"  name="order_product[' + product_row + '][tb001]" value="" />';
	html += '    <input type="hidden" name="order_product[' + product_row + '][tb002]" value="" />';	
	html += '    <input type="hidden"  name="order_product[' + product_row + '][tb003]" value="0"  />';
	html += '    <td class="left"><input type="text"  tabIndex="14" id="tb004'+ product_row+'"   name="order_product[' + product_row + '][tb004]" value="" size="20"  /></td>';	
	html += '    <td class="left"><input readonly="value"   onKeyPress="keyFunction()" type="text" id="tb005"  name="order_product[' + product_row + '][tb005]" value=""  /></td>';
	html += '    <td class="left"><input readonly="value"  onKeyPress="keyFunction()" type="text" id="tb006"   name="order_product[' + product_row + '][tb006]" value=""  size="30" /></td>';
	html += '    <td class="left"><input readonly="value"   onKeyPress="keyFunction()"   type="text" id="tb007"   name="order_product[' + product_row + '][tb007]" value="" size="6" /></td>';
	html += '    <td class="left"><input type="text"  tabIndex="15" id="tb011['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb011]" value="" size="10" class="date" /></td>';
	html += '    <td class="center"><input type="text" tabIndex="16" id="tb009" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb009]" value="1" size="3" style="text-align:right" /></td>';
    html += '    <td class="center"><input type="text" tabIndex="17" id="tb017" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb017]" value="0" size="6" style="text-align:right" /></td>';	
    html += '    <td class="right"><input readonly="value" type="text" name="order_product[' + product_row + '][tb018]" value="" size="10" style="text-align:right" /></td>';
	html += '    <td class="left"><input type="text" id="tb012" tabIndex="18"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb012]" value="" size="20" /></td>';
	html += '  </tr>';	
    html += '</tbody>';
	 
	 $('#order_product tfoot').before(html);  
	   	   //下拉視窗 網頁不更新  mb001 tb004 品號品名輸入
	
    $('input[name=\'order_product[' + product_row + '][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tb004').value;
		       
			 if (product_row == "1" ) { smb001= $('#tb0040').val(); }
			 if (product_row == "2" ) { smb001= $('#tb0041').val(); }
			 if (product_row == "3" ) { smb001= $('#tb0042').val(); }
		     if (product_row == "4" ) { smb001= $('#tb0043').val(); }
			 if (product_row == "5" ) { smb001= $('#tb0044').val(); }
			 if (product_row == "6" ) { smb001= $('#tb0045').val(); }
			 if (product_row == "7" ) { smb001= $('#tb0046').val(); }
		     if (product_row == "8" ) { smb001= $('#tb0047').val(); }
			 if (product_row == "9" ) { smb001= $('#tb0048').val(); }
			 if (product_row == "10" ) { smb001= $('#tb0049').val(); }	
			 if (product_row == "11" ) { smb001= $('#tb00410').val(); }
			 if (product_row == "12" ) { smb001= $('#tb00411').val(); }
			 if (product_row == "13" ) { smb001= $('#tb00412').val(); }
		     if (product_row == "14" ) { smb001= $('#tb00413').val(); }
			 if (product_row == "15" ) { smb001= $('#tb00414').val(); }
			 if (product_row == "16" ) { smb001= $('#tb00415').val(); }
			 if (product_row == "17" ) { smb001= $('#tb00416').val(); }
		     if (product_row == "18" ) { smb001= $('#tb00417').val(); }
			 if (product_row == "19" ) { smb001= $('#tb00418').val(); }
			 if (product_row == "20" ) { smb001= $('#tb00419').val(); }	
			
			//   smb001=$("#tb004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
	  
	
	
	   
      //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tb009]\'],input[name=\'order_product[' + product_row + '][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
		//流水號
		var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][tb003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*10)+num_1; 
	    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
		
		//alert(num_2);
		
	});
	   //數量
	$('input[name=\'order_product[' + product_row + '][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[' + product_row + '][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[' + product_row + '][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
			$(this).val('');
	});
            
	$('input[name=\'order_product[' + product_row + '][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
}
//-->
</script>


