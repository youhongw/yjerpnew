<div id="container">   <!-- div-1  -->
<div id="header">      <!-- div-2  -->
  <div class="div1">
    <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
		<img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
		<img src="<?=base_url()?>assets/image/lock.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">帳戶管理</a>　
		<img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	    </div>
  </div>
    <div id="menu">   <!-- div-3  -->
    <ul class="left" style="display: none;">
      <li id="dashboard"><a href="#<?=base_url()?>index.php/main" class="top">管理首頁</a></li>
	  
	  <li id="customers"><a href="<?=base_url()?>index.php/main" class="top">票據管理</a>
		<ul>
		  <li><a class="parent">基本資料</a>
            <ul>
              <li><a href="#<?=base_url()?>index.php/welcome">銀行帳號建立</a></li>
			  <li><a href="#<?=base_url()?>index.php/welcome">票據科目建立</a></li>
			  <li><a href="#<?=base_url()?>index.php/welcome">單據性質設定</a></li>
            </ul>
          </li>
		  <li><a href="#<?=base_url()?>index.php/welcome">應付票據建立</a></li>
		  <li><a href="#<?=base_url()?>index.php/welcome">應收票據建立</a></li>
		  <li><a href="#<?=base_url()?>index.php/welcome">票據底稿產生作業</a></li>
        </ul>
	  </li>
	  
	  <li id="supplies"><a class="top">資金管理</a>
		<ul>
		  <li><a class="parent">基本資料</a>
            <ul>
              <li><a href="#<?=base_url()?>index.php/welcome">融資種類建立</a></li>
			  <li><a href="#<?=base_url()?>index.php/welcome">預計收支建立</a></li>
			  <li><a href="#<?=base_url()?>index.php/welcome">銀行存款存提建立作業</a></li>
            </ul>
          </li>
		  <li><a href="#<?=base_url()?>index.php/welcome">掋押資料建立</a></li>
		  <li><a href="#<?=base_url()?>index.php/welcome">借&還款資料建立</a></li>
		  <li><a href="#<?=base_url()?>index.php/welcome">融資&撤票建立作業</a></li>
        </ul>
	  </li>
	  
	  <li id="materials"><a class="top">自動分錄管理</a>
        <ul>
            <li><a href="#<?=base_url()?>index.php/welcome">自動分錄參數設定</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">自動分錄性質設定</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">還原分錄底稿作業</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">產生分錄底稿作業</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">分錄底稿維護作業</a></li>
        </ul>
      </li>
	  
	  <li id="materials1"><a class="top">營業稅申報管理</a>
        <ul>
            <li><a href="#<?=base_url()?>index.php/welcome">每月發票建立作業</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">進項憑證產生作業</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">銷項憑證產生作業</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">進銷項憑證維護作業</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">營業稅資料建立作業</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">營業稅申報401報表</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">營業稅申報403報表</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">進銷項媒體產生作業</a></li>
        </ul>
      </li>
	  
	  <li id="ledger"><a class="top">會計總帳管理</a>
		<ul>
		  <li><a class="parent">基本參數設定</a>
			<ul>
				<li><a href="#<?=base_url()?>index.php/welcome">會計參數設定</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">會計期間設定</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">部門層級建立</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">報表格式建立</a></li>
				
			</ul>
		  </li>
		  <li><a class="parent">科目管理</a>
			<ul>
				<li><a href="#<?=base_url()?>index.php/welcome">科目部門建立</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">科目資料建立作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">單據性質設定</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">常用傳票建立作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">常用傳票複製作業</a></li>
			</ul>
		  </li>
		  <li><a class="parent">傳票管理</a>
			<ul>
				<li><a href="#<?=base_url()?>index.php/welcome">會計傳票建立作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">傳票整批過帳作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">月底結轉作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">指定關帳作業</a></li>
			</ul>
		  </li>
		  <li><a href="#<?=base_url()?>index.php/welcome">報表管理</a></li>
		  <li><a class="parent">統計報表</a>
			<ul>
				<li><a href="#<?=base_url()?>index.php/welcome">試算表</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">損益表</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">資產負債表</a></li>
			</ul>
		  </li>
		  <li><a class="parent">明細報表</a>
			<ul>
				<li><a href="#<?=base_url()?>index.php/welcome">日計表表</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">日記帳</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">明細分類帳</a></li>
			</ul>
		  </li>
        </ul>
	  </li>
	  
	   <li id="ledger1"><a class="top">刷卡出勤管理</a>
		<ul>
		  <li><a class="parent">基本參數設定</a>
			<ul>
				<li><a href="#<?=base_url()?>index.php/welcome">刷卡資料設定</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">加班時間尾數設定</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">員工班別產生作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">員工每日班別建立</a></li>
				
			</ul>
		  </li>
		  <li><a class="parent">刷卡管理</a>
			<ul>
				<li><a href="#<?=base_url()?>index.php/welcome">臨時卡號建立</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">刷卡資料轉換作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">刷卡資料維護作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">刷卡檔還原作業</a></li>
			</ul>
		  </li>
		  <li><a class="parent">報表管理</a>
			<ul>
				<li><a href="#<?=base_url()?>index.php/welcome">刷卡明細產生作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">刷卡明細建立作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">員工出勤日報</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">員工出勤明細表</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">刷卡異常明細表</a></li>
			</ul>
		  </li>
		  <li><a class="parent">人事管理</a>
			<ul>
				<li><a href="#<?=base_url()?>index.php/welcome">員工基本資料建立</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">特休天數建立</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">學歷代號建立</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">班別資料建立</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">特休年資計算作業</a></li>
			</ul>
		  </li>
		  <li><a class="parent">日常管理</a>
			<ul>
				<li><a href="#<?=base_url()?>index.php/welcome">請假單建立作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">加班單建立作業</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">員工請假統計表</a></li>
				<li><a href="#<?=base_url()?>index.php/welcome">員工特休統計表</a></li>
			</ul>
		  </li>
        </ul>
	  </li>

	   <li id="materials2"><a class="top">產品結構管理</a>
        <ul>
            <li><a href="#<?=base_url()?>index.php/welcome">BOM用量資料建立作業</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">低階碼更新作業</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">標準成本計算作業</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">多階標準成本表</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">單階用量清單</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">單階用途清單</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">多階用量清單</a></li>
			<li><a href="#<?=base_url()?>index.php/welcome">多階用途清單</a></li>
        </ul>
      </li>
	  
    </ul>
	
    <ul class="right" style="display: none;">
	  <li id="detail"><a class="top">細項設定</a>
        <ul>
		  <li><a class="parent">區域設置</a>
            <ul>
              <li><a href="#<?=base_url()?>index.php/welcome">國家設置</a></li>
              <li><a href="#<?=base_url()?>index.php/welcome">縣市設置</a></li>
			  <li><a href="#<?=base_url()?>index.php/welcome">地區設置</a></li>
            </ul>
          </li>
		  <li><a href="#<?=base_url()?>index.php/welcome">貨幣設置</a></li>
		  <li><a href="#<?=base_url()?>index.php/welcome">訂單狀態</a></li>
		  <li><a href="#<?=base_url()?>index.php/welcome">運送設置</a></li>
        </ul>
      </li>
	  <li id="tax"><a class="top">稅率設置</a>
                <ul>
                  <li><a href="#<?=base_url()?>index.php/welcome">稅率類別</a></li>
                  <li><a href="#<?=base_url()?>index.php/welcome">商品稅率</a></li>
                </ul>
      </li>
	  <li id="system"><a class="top">系統管理</a>
        <ul>
		  <li><a onclick="open_cmsi14();" >公司資料參數設定</a></li>
		  <li><a onclick="open_admi01();" >系統模組建立</a></li>
          <li><a onclick="open_admi02();" >程式代號建立</a></li>
          <li><a onclick="open_admi04();" >群組資料建立</a></li>
          <li><a onclick="open_admi10();" >使用者代號建立</a></li>
          <li><a onclick="open_admi05();" >使用者權限建立</a></li>
        </ul>
      </li>
    </ul>
  </div>   <!-- div-3 -->
  </div>   <!-- div-2 -->
  
  <div id="content">   <!-- menu內容 -->
  <div class="breadcrumb">  <!-- menu內容導航 -->
    </div>   <!-- div-1 -->
