<ul class="sidebar-menu" data-widget="tree">
        <li class="header">功能選單</li>
		 <li>
          <a href="<?php echo base_url()?>index.php/main">
            <i class="glyphicon glyphicon-bell"></i> <span>首頁</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
        </li>
		
      <!--  <li class="active treeview"> -->
	  
	      
         
		
        <li>
		  
          <a href="<?php echo base_url()?>index.php/scm/admr01/printdetail">
		  <?php if ($this->session->userdata('sysuser')=='demo'  ) {?>
            <i class="fa fa-th"></i> <span ><font face="新細明體";color="#FF0000">即時業續查詢作業</font></span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
			<?php }?>
          </a>
		 
        </li>
		
		
		<li>
         <a href="<?php echo base_url()?>index.php/scm/admr02/printdetail">
		    <?php if ($this->session->userdata('sysuser')=='demo'  ) {?>
            <i class="fa fa-th"  ></i> <span>新開發客戶查詢</span>
			<?php }?>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
			
          </a>
		  
        </li>
	    
		<li>
		
          <a href="<?php echo base_url()?>index.php/scm/admi04/display">
            <i class="fa fa-th"></i> <span>客戶上次售價查詢</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
		  
        </li>
		<li>
		
          <a  href="<?php echo base_url()?>index.php/scm/admi05/display">
            <i class="fa fa-th"></i> <span>客戶基本資料查詢</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
		  
        </li>
		
		
        <li>
		  <?php if ($this->session->userdata('sysuser')=='82002'  ) {?>
          <a  href="<?php echo base_url()?>index.php/pur/puri06/printdetailc">
            <i class="fa fa-th"></i> <span>請購明細表查詢</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
		  <?php }?>
        </li>
       
	   
	    <li>
          <a  href="<?php echo base_url()?>index.php/cop/copi05/copyform">
            <i class="fa fa-th"></i> <span>報價單資料-複製</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
        </li>
      </ul>