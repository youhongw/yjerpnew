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
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
          <?  $purq04a31=$row->ta001;?>
          <?  $ta002=$row->ta002;?>
          <?  $ta003=substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?>
          <?  $cmsq05a=$row->ta004;?>
          <?  $ta005=$row->ta005;?>
          <?  $ta006=$row->ta006;?>
		  <?  $ta007=$row->ta007;?>
		  <?  $ta008=$row->ta008;?>
		  <?  $ta009=$row->ta009;?>
		  <?  $cmsq02a=$row->ta010;?>
		  <?  $ta011=$row->ta011;?>
          <?  $palq01a=$row->ta012;?>
          <?  $ta013=substr($row->ta013,0,4).'/'.substr($row->ta013,4,2).'/'.substr($row->ta013,6,2);?>
          <?  $ta014=$row->ta014;?>
          <?  $ta015=$row->ta015;?>
          <?  $ta016=$row->ta016;?>
		   <?  $flag=$row->flag;?>	
		  <?  $purq04a31disp=$row->ta001disp;?>
		  <?  $cmsq05adisp=$row->ta004disp;?>
		  <?  $cmsq02adisp=$row->ta010disp;?>	
		  <?  $palq01adisp=$row->ta012disp;?>		
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
		 
	<?php $ii = $ii + 1 ; }?>
	<?php 

	  //開視窗及不更新網頁直接輸入出現中文	 
	  if($this->uri->segment(4) && $this->uri->segment(6)==0) { $ta001=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta001', $ta001);$ta001 = $this->session->userdata('ta001'); }
	//  if($this->uri->segment(5) && $this->uri->segment(6)==0) { $ta001disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta001disp', $ta001disp); $ta001disp = $this->session->userdata('ta001disp');} 
	  
      if($this->uri->segment(4) && $this->uri->segment(6)==1) { $ta004=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta004', $ta004);$ta004 = $this->session->userdata('ta004'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==1) { $ta004disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta004disp', $ta004disp); $ta004disp = $this->session->userdata('ta004disp');} 
	   	  
      if($this->uri->segment(4) && $this->uri->segment(6)==2) { $ta010=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta010', $ta010);$ta010 = $this->session->userdata('ta010'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==2) { $ta010disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta010disp', $ta010disp); $ta010disp = $this->session->userdata('ta010disp');} 
	  	   
      if($this->uri->segment(4) && $this->uri->segment(6)==3) { $ta012=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta012', $ta012);$ta012 = $this->session->userdata('ta012'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==3) { $ta012disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta012disp', $ta012disp); $ta012disp = $this->session->userdata('ta012disp');} 
	  	 
      if ($this->session->userdata('ta004')) { $ta004= $this->session->userdata('ta004'); }
	  if ($this->session->userdata('ta010')) { $ta010= $this->session->userdata('ta010'); }
	  if ($this->session->userdata('ta012')) { $ta012= $this->session->userdata('ta012'); }
	  if ($this->session->userdata('ta001')) { $ta001 = $this->session->userdata('ta001'); } 
	?>
	 <table class="form12"  >     <!-- 頭部表格 -->
	  <tr>
	     
	     <td class="start12a"  width="10%"><span class="required">請購單別：</span> </td>
            <td class="normal12a"  width="50%"><input tabIndex="1" id="ta001"  readonly="value"  onKeyPress="keyFunction()"  onchange="startpurq04a31(this)"  name="purq04a31" value="<?php echo strtoupper($purq04a31); ?>"  type="text" required /><a href="javascript:;"><img id="Showpurq04a31" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		    <span id="purq04a31disp"> <?php   echo $purq04a31disp; ?> </span></td>
			
	    <td class="normal12a" width="10%" > </td>
            <td class="normal12a"  width="50%" >&nbsp;&nbsp;</td>
	 </tr>	
		  
	  <tr>
	    <td class="start12a" ><span class="required">講購單號：</span> </td>
            <td class="normal12a" ><input tabIndex="2" id="ta002" onKeyPress="keyFunction()" readonly="value" name="ta002" value="<?php echo $ta002; ?>" size="30" type="text" required /><span id="ta002disp" ></span></td>
		   <td class="normal12a">&nbsp;&nbsp;</td>
            <td class="normal12a"></td>
		
	  </tr>
		
	  <tr>
	    <td  class="normal12" >單據日期：</td>
            <td  class="normal12"  ><input tabIndex="3" onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  class="date" id="ta013" onKeyPress="keyFunction()"   name="ta013"  value="<?php echo $ta013; ?>"  size="10" type="text"   /></td>
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
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="4" onKeyPress="keyFunction()"  id="ta004" onchange="startcmsq05a(this);" name="cmsq05a"   value="<?php echo  $cmsq05a; ?>"     /><a href="javascript:;"><img id="Showcmsq05a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="cmsq05adisp"> <?php   echo $cmsq05adisp; ?> </span></td>	
			
		<td class="start14a"  width="10%" > 廠別：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="5" onKeyPress="keyFunction()" id="ta010"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
	    <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
       
	</tr>	
		  
	  <tr>
	   <td class="start14a"  >請購人員：</td>
        <td class="normal14" ><input type="text" tabIndex="6" id="ta012" onKeyPress="keyFunction()"   onchange="startpalq01a(this)" name="palq01a"   value="<?php echo  $palq01a; ?>"    size="6"  /><a href="javascript:;"><img id="Showpalq01a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
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
	     <td class="center"><img src="<?=base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
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
			  if (product_row == "1" ) { smb001= $('#tb0040').val(); }
			// alert(smb001);
			 
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
	//	var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][tb003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
	//	var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*2)+num_1; 
	 //   $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
		
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
		   $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[0][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	$('input[name=\'order_product[0][tb012]\']').blur(function(){
		$('input[name=\'order_product[1][tb004]\']').focus();
	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 
	<!-- javascrit 明細1 -->	  	 
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
			  if (product_row == "2" ) { smb001= $('#tb0041').val(); }
		//	alert(smb001);
			 
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
	//	var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][tb003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
	//	var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*10)+num_1; 
	//    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
		
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
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	$('input[name=\'order_product[1][tb012]\']').blur(function(){
		$('input[name=\'order_product[2][tb004]\']').focus();
	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "3"; 	 
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
	 
		 $('input[name=\'order_product[2][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0042').val();
		    if (product_row == "3" ) { smb001= $('#tb0042').val(); }
		
			
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
	$('input[name=\'order_product[2][tb009]\'],input[name=\'order_product[2][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
		//流水號
	//	var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][tb003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
	//	var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*10)+num_1; 
	//    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
		
		//alert(num_2);
		
	});
	   //數量
	$('input[name=\'order_product[2][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[2][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[2][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[2][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[2][tb012]\']').blur(function(){
		$('input[name=\'order_product[3][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 

     <script type="text/javascript"><!--
         var product_row = "4"; 	 
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
	 
		 $('input[name=\'order_product[3][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0043').val();
			if (product_row == "4" ) { smb001= $('#tb0043').val(); }
		//	alert(smb001);
			 
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
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[3][tb012]\']').blur(function(){
		$('input[name=\'order_product[4][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>


     <script type="text/javascript"><!--
         var product_row = "5"; 	 
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
	 
		 $('input[name=\'order_product[4][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0044').val();
			if (product_row == "5" ) { smb001= $('#tb0044').val(); }
		//	alert(smb001);
			 
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
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[3][tb012]\']').blur(function(){
		$('input[name=\'order_product[4][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "6"; 	 
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
	 
		 $('input[name=\'order_product[5][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0045').val();
			if (product_row == "6" ) { smb001= $('#tb0045').val(); }
		//	alert(smb001);
			 
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
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[3][tb012]\']').blur(function(){
		$('input[name=\'order_product[4][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "7"; 	 
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
	 
		 $('input[name=\'order_product[6][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0046').val();
			if (product_row == "7" ) { smb001= $('#tb0046').val(); }
		//	alert(smb001);
			 
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
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[3][tb012]\']').blur(function(){
		$('input[name=\'order_product[4][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "8"; 	 
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
	 
		 $('input[name=\'order_product[7][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0047').val();
			if (product_row == "8" ) { smb001= $('#tb0047').val(); }
		//	alert(smb001);
			 
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
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[3][tb012]\']').blur(function(){
		$('input[name=\'order_product[4][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "9"; 	 
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
	 
		 $('input[name=\'order_product[8][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0048').val();
			if (product_row == "9" ) { smb001= $('#tb0048').val(); }
		//	alert(smb001);
			 
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
	//	var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][tb003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
	//	var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*10)+num_1; 
	//    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
		
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
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[3][tb012]\']').blur(function(){
		$('input[name=\'order_product[4][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "10"; 	 
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
	 
		 $('input[name=\'order_product[9][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0049').val();
			if (product_row == "10" ) { smb001= $('#tb0049').val(); }
		//	alert(smb001);
			 
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
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[3][tb012]\']').blur(function(){
		$('input[name=\'order_product[4][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
	
		 
		   <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
              <tr>
                <td class="center" valign="top"><img src="<?=base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				<td class="left" colspan="11"></td>
              </tr>
		 
			  
              </tfoot>
          </table>
        </div>
	
	 </div>
	</div>
	<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	<div class="buttons">
	<button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri05/display'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
	  
    </form>
    </div> 
	
  </div>
</div>

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> 
  </div> 
   </div> 

 <?php include("./application/views/fun/puri05_funjsupd_v.php"); ?> 




