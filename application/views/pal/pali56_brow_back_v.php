<?php 
if(!@$dateo){$dateo=$this->input->get('dateo');}
if(!@$datec){$datec=$this->input->get('datec');}
if(!@$epyo){$epyo=$this->input->get('epyo');}
if(!@$epyc){$epyc=$this->input->get('epyc');}
?>
  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" onclick="location = '<?php echo base_url()?>index.php/pal/pali56/display?dateo=<?php echo $dateo;?>&datec=<?php echo $datec;?>&epyo=<?php echo $epyo;?>&epyc=<?php echo $epyc;?>&type=<?php echo $type;?>'" alt="" /> 出勤資料管理作業 - 瀏覽備份</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:right; ">
	   <div style="float:left;" class="button">
	   日常<input id="type" name="type" type="radio" style="height:9px;" value="A" onclick="change_date();" <?if(@$type=="A"){echo "checked";}?> />
	    異常(包含已請)<input id="type" name="type" type="radio" style="height:9px;" value="B" onclick="change_date();" <?if(@$type=="B"){echo "checked";}?> />
		 異常(未請假)<input id="type" name="type" type="radio" style="height:9px;" value="C" onclick="change_date();" <?if(@$type=="C"){echo "checked";}?> />
	   </div>
	   <div style="float:left;" class="button">起始員編：<input id="epyo" name="epyo" style="height:9px;" value="<?php if(@$epyo){echo $epyo;}else{echo "";}?>" size="9" /></div>
	   <div style="float:left;" class="button">終止員編：<input id="epyc" name="epyc" style="height:9px;" value="<?php if(@$epyc){echo $epyc;}else{echo "";}?>" size="9" /></div>
	   <div style="float:left;" class="button">起始日期：<input id="dateo" name="dateo" style="height:9px;" value="<?php if(@$dateo&&strlen($dateo)==8){echo substr($dateo,0,4)."-".substr($dateo,4,2)."-".substr($dateo,6,2);}else{echo date("Y-m-d");}?>" size="9" onclick="scwShow(this,event);" /></div>
	   <div style="float:left;" class="button">終止日期：<input id="datec" name="datec" style="height:9px;" value="<?php if(@$datec&&strlen($dateo)==8){echo substr($datec,0,4)."-".substr($datec,4,2)."-".substr($datec,6,2);}else{echo date("Y-m-d");}?>" size="9" onclick="scwShow(this,event);" /></div>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <!--<a onclick="location = '<?php echo base_url()?>index.php/pal/pali56/beforeadd'" style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>-->
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <!--<a onclick="location = '<?php echo base_url()?>index.php/pal/pali56/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>-->
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <!--<a onclick="location = '<?php echo base_url()?>index.php/pal/pali56/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>-->
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <!--<a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>-->
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <!--<a onclick="open_winprint();"    style="float:left" accesskey="p" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  -->
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <!--<a onclick="open_winexcel();"    style="float:left" accesskey="l" class="button">轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> -->
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali56/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali56/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	<style>
	.list tbody td {
		background-color : inherit;
	}
	</style>
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali56/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="6%" class="left">
	        <?php echo anchor("pal/pali56/display/tf002/" . (($sort_order == 'asc' && $sort_by == 'tf002') ? 'desc' : 'asc') ,'部門名稱'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="6%" class="left"> 
		   <?php echo anchor("pal/pali56/display/count_count/" . (($sort_order == 'asc' && $sort_by == 'count_count') ? 'desc' : 'asc') ,'刷卡日期'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="5%" class="left">
	        <?php echo anchor("pal/pali56/display/tf002/" . (($sort_order == 'asc' && $sort_by == 'tf002') ? 'desc' : 'asc') ,'員工編號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left"> 
		   <?php echo anchor("pal/pali56/display/c.me002/" . (($sort_order == 'asc' && $sort_by == 'c.me002') ? 'desc' : 'asc') ,'員工姓名'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="30%" class="left">
	        <?php echo anchor("pal/pali56/display/creator/" .(($sort_order == 'asc' && $sort_by == 'creator') ? 'desc' : 'asc') ,'刷卡時間'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="20%" class="left">
		   <?php echo anchor("pal/pali56/display/modi_date/" . (($sort_order == 'asc' && $sort_by == 'modi_date') ? 'desc' : 'asc') ,'狀態'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <!--<td width="18%" class="center"></td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>-->
        </tr>
        </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_tf002='';$filter_me002='';$filter_tf002='';$filter_tf003='';$filter_tf004='';$filter_tf005='';$filter_tf007=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_tf002" name="filter_tf002" value=""  size="8" disabled />
		   </div>
	     </td>
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_tf002" name="filter_tf002" value=""  size="8" disabled />
		   </div>
	     </td>
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_me002" name="filter_me002" value=""  size="10" disabled />
		  </td>
		  
		    <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_count_count" name="filter_count_count" value="" size="10" disabled />
		  </td>
		  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" id="filter_creator" name="filter_creator" value=""  size="12" disabled />
		   </div>			  
	      </td>
			 <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_modi_date" value=""   size="12" disabled />
		   </div>			  
	      </td>
	      <!--<td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>-->
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('tf002'); ?> -->
	    <?php $chkval=1; 
			//echo "<pre>";var_dump($results);exit;
		?>               
	    <?php if(count(@$results)!=0&&is_array(@$results)){
				foreach($results as $day_data ){
					foreach($day_data as $row){ ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->te002."/".$row->te001 ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
		  <td class="left"><?php echo $row->me002;?></td>
		  <td class="left"><?php echo substr($row->te002,0,4).'/'.substr($row->te002,4,2).'/'.substr($row->te002,6,2);?></td>
		  <td class="left"><?php if($row->te001){echo $row->te001;}else{echo $row->te004;}?></td>
		  <td class="left"><?php echo $row->mv002;?></td>
		  <td class="left" id="td_<?php echo $row->te002."_".$row->te001; ?>" >
			<?php if(@$row->te003){
					foreach($row->te003 as $k => $v){
						$div_str = "<div ";					//Start
						$div_str .= "class='time_".$row->te002."_".$row->te001."' ";//加入前墜
						$div_str .= "style='float:left;margin:2px; '";
						$div_str .= "id='div_".$row->te002."_".$row->te001."_".$v."' ";
						$div_str .= " >";
						$div_str .= "<span ";				//Start
						$div_str .= "class='span_".$row->te002."_".$row->te001."_".$v."'";//加入前墜
						$div_str .= "style='float:left;' ";
						$div_str .= "id='disp_".$row->te002."_".$row->te001."_".$v."'";
						$div_str .= " >";
						$div_str .= $v;
						$div_str .= "</span>";				//結尾
						$div_str .= "<span ";				//Start
						$div_str .= "class='span_".$row->te002."_".$row->te001."_".$v."' ";//加入前墜
						$div_str .= "style='float:left;' ";
						$div_str .= "id='form_".$row->te002."_".$row->te001."_".$v."' ";
						$div_str .= " >";
						$div_str .= "<input ";				//Start
						$div_str .= "class='ipt_".$row->te002."_".$row->te001."' ";//加入前墜
						$div_str .= "id='ipt_".$row->te002."_".$row->te001."_".$v."' ";
						$div_str .= "style='float:left;height:8px;text-align:center;display:none;' ";
						$div_str .= "size='4' value='".$v."' ";
						$div_str .= " />";					//結尾
						$div_str .= "<input ";				//Start
						$div_str .= "id='del_".$row->te002."_".$row->te001."_".$v."' ";
						$div_str .= "style='float:left;width:15px;height:15px;text-align:center;display:none;margin:0px;padding:0px;' ";
						$div_str .= "type='button' size='4' value='x' ";
						$div_str .= " />";					//結尾
						
						
						$div_str .= "</span>";				//結尾
						
						$div_str .= "</div>";				//結尾
						echo $div_str;
					}
				}?>
		  </td>
		  <td class="left">
			<?php foreach($row->status as $status_key => $status_val){
					if($status_key == "error"){
						echo "<font color='red'>".$status_val."</font> ";
					}
					if($status_key == "late"){
						echo "<font color='gray'>".$status_val."</font> ";
					}
					if($status_key == "absenteeism"){
						echo "<font color='orange'>".$status_val."</font> ";
					}
					if($status_key == "leave"){
						echo "<font color='blue'>".$status_val."</font> ";
					}
				}
		?></td>
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali56/del/'.$row->tf001."/".trim($row->tf003))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <!--<td class="center"></td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="javascript:edit_time(<?php echo $row->te002.",".$row->te001?>)">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
	      <?PHP } ?>-->
		</tr>
		  <?php $chkval += 1; ?>
		<?php }}}else{echo "<font color='red' size='6'>無刷卡資料!!!</font>";} ?>
          </tbody>		 
        </table>
		       <!-- 修改時 留在原來那一筆資料使用 -->
	          <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		    <!--    <?php echo $this->pagination->create_links();?>	
			    <?php echo $this->session->userdata('find05');$find05; ?><?php echo $this->session->userdata('find07');$find07;  ?> -->
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '?> </div>	
      </form>
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/pal/pali56/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali56/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/pal/pali56/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali56/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});
//參數區

function change_date(){
	url = '<?php echo base_url() ?>index.php/pal/pali56/display_bak?dateo='+$('#dateo').val()+'&datec='+$('#datec').val()+'&epyo='+$('#epyo').val()+'&epyc='+$('#epyc').val()+'&type='+$('input[name=type]:checked').val();
	location = url;
}

$('#epyo').keyup(function(e) {
    if (e.keyCode == 13) {
		console.log("HAHA!");
		change_date();
    }
	
});
$('#epyc').keyup(function(e) {
    if (e.keyCode == 13) {
		console.log("ㄏㄏ!");
		change_date();
    }
	
});
$('#dateo').keyup(function(e) {
    if (e.keyCode == 13) {
		console.log("ㄏㄏ!");
		change_date();
    }
	
});
$('#datec').keyup(function(e) {
    if (e.keyCode == 13) {
		console.log("ㄏㄏ!");
		change_date();
    }
	
});
</script>