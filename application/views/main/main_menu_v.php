<div id="container">   <!-- div-1  -->
<div id="header">      <!-- div-2  -->
  <div class="div1">
    <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a>
	            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></div>
        <div class="div3">
		<img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
		<img src="<?=base_url()?>assets/image/lock.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">帳戶管理</a>　
		<img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	    </div>
  </div>
    <div id="menu">   <!-- div-3  -->
    <ul class="left" style="display: none;">
      <li id="dashboard"><a href="#<?=base_url()?>index.php/main" class="top">管理首頁</a></li>
	  
	  <li id="customers"><a href="<?=base_url()?>index.php/main" class="top">進銷存系統模組</a>
		
	  </li>
	  
	  <li id="supplies"><a href="#<?=base_url()?>index.php/main1" class="top">製令託外系統模組</a>
		
	  </li>
	  
	  <li id="materials"><a href="#<?=base_url()?>index.php/main2" class="top">會計總帳分錄模組</a>
       
      </li>
	  
	  <li id="materials1"><a href="#<?=base_url()?>index.php/main3" class="top">票據資金營業稅模組</a>
        
      </li>
	  
	  <li id="ledger"><a href="#<?=base_url()?>index.php/main4" class="top">成本固定資產模組</a>
		
	  </li>
	  
	   <li id="ledger1"><a href="#<?=base_url()?>index.php/main5" class="top">人資薪資刷卡模組</a>
	<!--	</li>
	   <li id="ledger2"><a href="<?=base_url()?>index.php/main9" class="top">upload</a> 
		</li> -->
	  
    </ul>
	
    <ul class="right" style="display: none;">
	  <li id="detail"><a href="#<?=base_url()?>index.php/main6" class="top">生產需求計劃模組</a>
       
      </li>
	       <li id="system"><a href="#<?=base_url()?>index.php/main9" class="top">upload</a>
	<!--  <li id="system"><a class="top">系統管理</a>
        <ul>
		  <li><a onclick="open_cmsi14();" >公司資料參數設定</a></li>
		  <li><a onclick="open_admi01();" >系統模組建立</a></li>
          <li><a onclick="open_admi02();" >程式代號建立</a></li>
          <li><a onclick="open_admi04();" >群組資料建立</a></li>
          <li><a onclick="open_admi10();" >使用者代號建立</a></li>
          <li><a onclick="open_admi05();" >使用者權限建立</a></li>
        </ul>
      </li>  -->
    </ul>
  </div>   <!-- div-3 -->
  </div>   <!-- div-2 -->
  
  <div id="content">   <!-- menu內容 -->
  <div class="breadcrumb">  <!-- menu內容導航 -->
    </div>   <!-- div-1 -->
