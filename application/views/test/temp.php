 protected function checkPlatform() {
		    if( stripos($this-&gt;_agent, &#039;windows&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_WINDOWS;
		    }
		    else if( stripos($this-&gt;_agent, &#039;iPad&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_IPAD;
		    }
		    else if( stripos($this-&gt;_agent, &#039;iPod&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_IPOD;
		    }
		    else if( stripos($this-&gt;_agent, &#039;iPhone&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_IPHONE;
		    }
		    elseif( stripos($this-&gt;_agent, &#039;mac&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_APPLE;
		    }
		    elseif( stripos($this-&gt;_agent, &#039;android&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_ANDROID;
		    }
		    elseif( stripos($this-&gt;_agent, &#039;linux&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_LINUX;
		    }
		    else if( stripos($this-&gt;_agent, &#039;Nokia&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_NOKIA;
		    }
		    else if( stripos($this-&gt;_agent, &#039;BlackBerry&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_BLACKBERRY;
		    }
		    elseif( stripos($this-&gt;_agent,&#039;FreeBSD&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_FREEBSD;
		    }
		    elseif( stripos($this-&gt;_agent,&#039;OpenBSD&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_OPENBSD;
		    }
		    elseif( stripos($this-&gt;_agent,&#039;NetBSD&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_NETBSD;
		    }
		    elseif( stripos($this-&gt;_agent, &#039;OpenSolaris&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_OPENSOLARIS;
		    }
		    elseif( stripos($this-&gt;_agent, &#039;SunOS&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_SUNOS;
		    }
		    elseif( stripos($this-&gt;_agent, &#039;OS\/2&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_OS2;
		    }
		    elseif( stripos($this-&gt;_agent, &#039;BeOS&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_BEOS;
		    }
		    elseif( stripos($this-&gt;_agent, &#039;win&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_WINDOWS;
		    }

	    }

 
 
 =================
 <td class="left"><? echo $row['ma001'];?></td>
 $data['fields'] = array(
		    'company' => 'company',
			'creator' =>'creator',
			'usr_group' => 'usr_group',
			'create_date' =>'create_date',
			'modifier' => 'modifier',
			'modi_date' => 'modi_date',
			'flag' => 'flag',
			'ma001' => 'ma001',
			'ma002' => 'ma002',
			'ma003' => 'ma003',
			'ma004' => 'ma004',
			'ma005' => 'ma005',
			'ma006' => 'ma006'
			
		);
			<?php foreach($fields as $field_name => $field_display): ?>
			<?php endforeach; ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('inv/invi01/del/'.$row['ma001']."/".trim($row['ma002']))?>" id="delete1"  >[ 刪除 ]</a></td>
			  <td class="center"><a href="<?php echo site_url('inv/invi01/editform/'.$row['ma001']."/".trim($row['ma002']))?>">[ 编辑 ]</a></td>
			  
			  
			  <div class="pagination"><div class="results"><?php echo $this->pagination->create_links(); ?></div></div>
	  <div align="center"> <?php echo '操作說明:[ 點選欄位名稱即自動排序 ] '.' 總數:'.ceil($page).' 頁, '.$numrow.' 筆' ?></div>
	    <div class="pagination"><div class="results"><?php echo $this->pagination->create_links(); ?></div></div>  
	  <div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span style="margin-left:"150px">
	  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選可查詢資料, 先選取列項出現打勾可多筆刪除. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>
	 <!-- <div align="center"> <?php echo '操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選可查詢資料, 先選取列項出現打勾可多筆刪除. ] '.' 總數:'.ceil($page).' 頁, '.$numrow.' 筆' ?></div> -->
	</div>
	    <div class="pagination"><div class="results"><?php echo $this->pagination->create_links(); ?></div></div>  
	  <div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選可查詢資料, 先選取列項出現打勾可多筆刪除. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>
	 <!-- <div align="center"> <?php echo '操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選可查詢資料, 先選取列項出現打勾可多筆刪除. ] '.' 總數:'.ceil($page).' 頁, '.$numrow.' 筆' ?></div> -->
	</div>
	  
	   public function updsave()
    {
	   $this->load->helper('url');
		$date=date("Ymd");
	
       $this->db->get('invma');	
       $this->load->model('inv/invi01_model','',TRUE);
	   echo '修改存檔';
       $this->invi01_model->updatef();
	   	   
	  $data['date']= date("Ymd");
	  $data['numrow']=$this->db->count_all_results('invma');// 總筆數 
	  $data['page']=$this->db->count_all_results('invma')/15; // 總頁數 
      $this->load->helper('url'); 
	  $this->load->library('pagination');//加載分頁類 
	  $this->load->model('inv/invi01_model');// 加載TABLE model 模型 
	  $config['base_url'] = base_url().'index.php/inv/invi01/index';//設定分頁url路徑
	  $config['total_rows'] = $this->db->count_all_results('invma');// 總筆數 
	  $config ['uri_segment'] = 4; //設置url上第几段用于傳分頁器的偏移量
	  $config['per_page'] = '15';// 每頁筆數
	  $config['first_link'] = '首頁';
	  $config['last_link'] = '尾頁';
	  $config ['next_link'] = '下一頁>';
      $config ['prev_link'] = '<上一頁';
	  $config['display_pages'] = TRUE;  //隐藏數字鏈接
	//  $config['num_links']=3;  //當前頁碼前後數字鏈結數量
	//  $config['last_tag_open'] = '';  //最後一頁鏈結打開標簽。
	//  $config['cur_tag_open'] = '<li>';//當前鏈結打開標簽。
	  $config['full_tag_open'] = '<p>';
	  $config['full_tag_close'] = '</p>'; 
	  $this->pagination->initialize($config);//分頁初始化 
	  $data['results']=  $this->invi01_model->selbrowse($config['per_page'],$this->uri->segment(4));//得到數据庫記錄 
	  $this->load->library('table');//加載table函數	  
	   $this->pagination->initialize($config);//初始化 
      $this->load->view('inv/invi01_v/display',$data);   
	  
	  
	  ===========del
	    $data['date']= date("Ymd");
	  $data['numrow']=$this->db->count_all_results('invma');// 總筆數 
	  $data['page']=$this->db->count_all_results('invma')/15; // 總頁數 
      $this->load->helper('url'); 
	  $this->load->library('pagination');//加載分頁類 
	  $this->load->model('inv/invi01_model');// 加載TABLE model 模型 
	  $config['base_url'] = base_url().'index.php/inv/invi01/index';//設定分頁url路徑
	  $config['total_rows'] = $this->db->count_all_results('invma');// 總筆數 
	  $config ['uri_segment'] = 4; //設置url上第几段用于傳分頁器的偏移量
	  $config['per_page'] = '15';// 每頁筆數
	  $config['first_link'] = '首頁';
	  $config['last_link'] = '尾頁';
	  $config ['next_link'] = '下一頁>';
      $config ['prev_link'] = '<上一頁';
	  $config['display_pages'] = TRUE;  //隐藏數字鏈接
	//  $config['num_links']=3;  //當前頁碼前後數字鏈結數量
	//  $config['last_tag_open'] = '';  //最後一頁鏈結打開標簽。
	//  $config['cur_tag_open'] = '<li>';//當前鏈結打開標簽。
	  $config['full_tag_open'] = '<p>';
	  $config['full_tag_close'] = '</p>'; 
	  $this->pagination->initialize($config);//分頁初始化 
	  $data['results']=  $this->invi01_model->selbrowse($config['per_page'],$this->uri->segment(4));//得到數据庫記錄 
	  $this->load->library('table');//加載table函數	  
	   $this->pagination->initialize($config);//初始化 
      $this->load->view('inv/invi01_v',$data);   
    	
	  ===============================1115-3  
	  http://docs.jquery.com/Plugins/Validation
	  http://blog.csdn.net/lxf9601/article/details/5863728
	  ==================================
	  /**//**   
 * @author ming   
 */    
$(document).ready(function(){         
           
/**//* 设置默认属性 */         
$.validator.setDefaults({         
    submitHandler: function(form) {      
        form.submit();      
    }         
});     
    
// 字符验证         
jQuery.validator.addMethod("stringCheck", function(value, element) {         
    return this.optional(element) || /^[/u0391-/uFFE5/w]+$/.test(value);         
}, "只能包括中文字、英文字母、数字和下划线");     
    
// 中文字两个字节         
jQuery.validator.addMethod("byteRangeLength", function(value, element, param) {         
    var length = value.length;         
    for(var i = 0; i < value.length; i++){         
        if(value.charCodeAt(i) > 127){         
        length++;         
        }         
    }         
    return this.optional(element) || ( length >= param[0] && length <= param[1] );         
}, "请确保输入的值在3-15个字节之间(一个中文字算2个字节)");     
    
// 身份证号码验证         
jQuery.validator.addMethod("isIdCardNo", function(value, element) {         
    return this.optional(element) || isIdCardNo(value);         
}, "请正确输入您的身份证号码");      
       
// 手机号码验证         
jQuery.validator.addMethod("isMobile", function(value, element) {         
    var length = value.length;     
    var mobile = /^(((13[0-9]{1})|(15[0-9]{1}))+/d{8})$/;     
    return this.optional(element) || (length == 11 && mobile.test(value));         
}, "请正确填写您的手机号码");         
       
// 电话号码验证         
jQuery.validator.addMethod("isTel", function(value, element) {         
    var tel = /^/d{3,4}-?/d{7,9}$/;    //电话号码格式010-12345678     
    return this.optional(element) || (tel.test(value));         
}, "请正确填写您的电话号码");     
    
// 联系电话(手机/电话皆可)验证     
jQuery.validator.addMethod("isPhone", function(value,element) {     
    var length = value.length;     
    var mobile = /^(((13[0-9]{1})|(15[0-9]{1}))+/d{8})$/;     
    var tel = /^/d{3,4}-?/d{7,9}$/;     
    return this.optional(element) || (tel.test(value) || mobile.test(value));     
    
}, "请正确填写您的联系电话");     
       
// 邮政编码验证         
jQuery.validator.addMethod("isZipCode", function(value, element) {         
    var tel = /^[0-9]{6}$/;         
    return this.optional(element) || (tel.test(value));         
}, "请正确填写您的邮政编码");      
    
//开始验证     
$('#submitForm').validate({     
    /**//* 设置验证规则 */    
    rules: {     
        username: {     
            required:true,     
            stringCheck:true,     
            byteRangeLength:[3,15]     
        },     
        email:{     
            required:true,     
            email:true    
        },     
        phone:{     
            required:true,     
            isPhone:true    
        },     
        address:{     
            required:true,     
            stringCheck:true,     
            byteRangeLength:[3,100]     
        }     
    },     
         
    /**//* 设置错误信息 */    
    messages: {     
        username: {         
            required: "请填写用户名",     
            stringCheck: "用户名只能包括中文字、英文字母、数字和下划线",     
            byteRangeLength: "用户名必须在3-15个字符之间(一个中文字算2个字符)"         
        },     
        email:{     
            required: "请输入一个Email地址",     
            email: "请输入一个有效的Email地址"    
        },     
        phone:{     
            required: "请输入您的联系电话",     
            isPhone: "请输入一个有效的联系电话"    
        },     
        address:{     
            required: "请输入您的联系地址",     
            stringCheck: "请正确输入您的联系地址",     
            byteRangeLength: "请详实您的联系地址以便于我们联系您"    
        }     
    },     
         
    /**//* 设置验证触发事件 */    
    focusInvalid: false,     
    onkeyup: false,     
         
    /**//* 设置错误信息提示DOM */    
    errorPlacement: function(error, element) {         
        error.appendTo( element.parent());         
    },       
         
});     
    
});  

=====================1115-3  test9.html
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"     
"http://www.w3.org/TR/html4/loose.dtd">    
<html xmlns="http://www.w3.org/1999/xhtml">    
    <head>    
        <meta http-equiv="Content-Type" content="text/html; charset=gbk" />    
        <title>jQuery验证</title>    
        <mce:script src="lib/jquery/jquery-1.3.2.min.js" mce_src="lib/jquery/jquery-1.3.2.min.js" ></mce:script>    
        <mce:script type="text/javascript" src="lib/jquery/jquery.validate.js" mce_src="lib/jquery/jquery.validate.js"></mce:script>    
        <mce:script type="text/javascript" src="lib/jquery/messages_cn.js" mce_src="lib/jquery/messages_cn.js"></mce:script>    
        <mce:script type="text/javascript" src="lib/jquery/formValidatorClass.js" mce_src="lib/jquery/formValidatorClass.js"></mce:script>    
        <mce:style type="text/css"><!--
  
  
        * {}{      
            font-family: Verdana;      
            font-size: 96%;      
        }     
        label {}{      
            width: 10em;      
            float: left;      
        }     
        label.error {}{      
            float: none;      
            color: red;      
            padding-left: .5em;      
            vertical-align: top;      
        }     
        p {}{      
            clear: both;      
        }     
        .submit {}{      
            margin-left: 12em;      
        }     
        em {}{      
            font-weight: bold;      
            padding-right: 1em;      
            vertical-align: top;      
        }     
             
--></mce:style><style type="text/css" mce_bogus="1">  
  
        * {}{      
            font-family: Verdana;      
            font-size: 96%;      
        }     
        label {}{      
            width: 10em;      
            float: left;      
        }     
        label.error {}{      
            float: none;      
            color: red;      
            padding-left: .5em;      
            vertical-align: top;      
        }     
        p {}{      
            clear: both;      
        }     
        .submit {}{      
            margin-left: 12em;      
        }     
        em {}{      
            font-weight: bold;      
            padding-right: 1em;      
            vertical-align: top;      
        }     
             </style>  
    </head>    
    <body>    
        <form class="submitForm" id="submitForm" method="get" action="">    
         <fieldset>    
           <legend>表单验证</legend>    
           <p>    
             <label for="username">用户名</label>    
             <em>*</em><input id="userName" name="username" size="25" />    
           </p>    
           <p>    
             <label for="email">E-Mail</label>    
             <em>*</em><input id="email" name="email" size="25" />    
           </p>    
           <p>    
             <label for="phone">联系电话</label>    
             <em>*</em><input id="phone" name="phone" size="25" value="" />    
           </p>    
           <p>    
             <label for="address">地址</label>    
             <em>*</em><input id="address" name="address" size="22">    
           </p>    
             <input class="submit" type="submit" value="提交"/>    
           </p>    
          </fieldset>    
         </form>    
    </body>    
</html> 	  
	  ==============1115-5  例子
	  <form class="cmxform" id="commentForm" method="get" action="">
  <fieldset>
    <legend>Please provide your name, email address (won't be published) and a comment</legend>
    <p>
      <label for="cname">Name (required, at least 2 characters)</label>
      <input id="cname" name="name" minlength="2" type="text" required/>
    </p>
    <p>
      <label for="cemail">E-Mail (required)</label>
      <input id="cemail" type="email" name="email" required/>
    </p>
    <p>
      <label for="curl">URL (optional)</label>
      <input id="curl" type="url" name="url"/>
    </p>
    <p>
      <label for="ccomment">Your comment (required)</label>
      <textarea id="ccomment" name="comment" required></textarea>
    </p>
    <p>
      <input class="submit" type="submit" value="Submit"/>
    </p>
  </fieldset>
</form>
<script>
$("#commentForm").validate();
</script>
===================1115-51
 $("#myform").validate({
  submitHandler: function(form) {
    // some other code
    // maybe disabling submit button
    // then:
    $(form).submit();
  }
 });
 ===========1115-52
  $("#myform").validate({
  submitHandler: function(form) {
    form.submit();
  }
 });
 ========================1115-53
    <mce:script src="base_url()?>assets/validation/lib/jquery-1.8.3.min.js" mce_src="base_url()?>assets/validation/lib/jquery-1.8.3.min.js" ></mce:script>  
    <mce:script type="text/javascript" src="base_url()?>assets/validation/jquery.validate.js" mce_src="base_url()?>assets/validation/jquery.validate.js"> </mce:script>   
       <script type="text/javascript" src="base_url()?>assets/validation/localization/messages_zh_TW.js"></script>  
       <script type="text/javascript" src="base_url()?>assets/validation/lib/jquery.form.js"></script>  
	   <script type="text/javascript" src="base_url()?>assets/validation/lib/formValidatorClass.js"></script>  