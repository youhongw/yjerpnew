<html>
<head>
    <script src="<?php echo base_url()?>assets/report/js/jquery-3.4.1.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/report/js/jqprint.0.3.js"></script>
    <link used="print" rel="stylesheet" media="screen" href="<?php echo base_url()?>assets/report/css/main.css" /> <!-- 頁面呈現的CSS -->
    <link used="print" rel="stylesheet" media="print" href="<?php echo base_url()?>assets/report/css/print_a4ls.css" /> <!-- 列印使用的CSS -->
    <title><?php echo $message; ?></title>
	<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
<body>
    <!--  onclick="print();" -->
    <!-- 公司抬頭 -->
	<?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
<?php exit;} ?>
<?php foreach($results1 as $row ) : ?>
		    <!-- //公司簡稱 公司全稱 電話 傳真 地址 E-MAIL 備註 -->
			 <?php  $ml002sys[]=$row->ml002;  ?>
			 <?php $ml003sys[]=$row->ml003;   ?>
			 <?php $ml005sys[]=$row->ml005;  ?>
			 <?php $ml006sys[]=$row->ml006;   ?>
			 <?php $ml012sys[]=$row->ml012;  ?> 
			 <?php $ml010sys[]=$row->ml010;   ?> 
			 <?php $ml011sys[]=$row->ml011;   ?> 
        <?php endforeach;?>
		     <?php    $vsysml002=$ml002sys[0];  ?>
			 <?php    $vsysml003=$ml003sys[0];  ?>
		     <?php    $vsysml005=$ml005sys[0];  ?>
			 <?php    $vsysml006=$ml006sys[0];  ?>
			 <?php    $vsysml012=$ml012sys[0];  ?>
			 <?php    $vsysml010=$ml010sys[0];  ?>
			 <?php    $vsysml011=$ml011sys[0];  ?>
       <!-- 第一頁 -->
    <?php $PrintDate=date("Y/m/d");$th013a=0;$th013b=0;$th013c=0;$th013d=0;   ?>
    <div style="padding:10px;">
        <a id="print" href="#"  style="font-size: 1.1em;font-family: 微軟正黑體, Arial, Helvetica, sans-serif;padding: 0em 0.625em;border:1px solid black;text-decoration:none;background-color:#f5f6e6;">列印</a>
   
        <a id="print1" href="<?php echo base_url() ?>index.php/scm/admr01/printdetail"  style="font-size: 1.1em;font-family: 微軟正黑體, Arial, Helvetica, sans-serif;padding: 0em 0.625em;border:1px solid black;text-decoration:none;background-color:#E7EFEF;">返回</a>
    </div>
    <center>
    <form id="data">
    <div style="width:1170px;text-align:center;">
    <div id="print-header-wrapper" style="width:1170px;">
        <div class="TitleName" style="font-family:Times New Roman,標楷體;padding:5px;font-size:22px;font-weight:bold;letter-spacing: 3px;width:1170px;border:0px solid black;text-align:center;line-height:14px">
            <?php echo $this->session->userdata('sysml003'); ?>
        </div>
		<div class="TitleName" style="font-family:Times New Roman,標楷體;padding:5px;font-size:14px;font-weight:bold;letter-spacing: 3px;width:1170px;border:0px solid black;text-align:center;line-height:18px">
            <?php echo 'Tel:'.$vsysml005.'    '.'Fax:'.$vsysml006; ?>
        </div>
		
        <div style="font-family:Times New Roman,標楷體;padding:5px;font-size:20px;font-weight:bold;letter-spacing: 1px;width:1170px;border:0px solid black;text-align:center;clear:both;line-height:12px">
             客 戶 對 帳 單
        </div>
		<div style="padding:5px 5px 0 5px;width:1170px;text-align:left;display:inline-block ;line-height:12px">
            <div style="font-family:Times New Roman,標楷體;font-size:18px;font-weight:bold;padding:5px;display:inline-block ;text-align:left;white-space:nowrap;width:10%;clear:both;">
                製表日期：<?php echo date("Y/m/d"); ?>
            </div>
            <div style="font-family:Times New Roman,標楷體;font-size:18px;font-weight:bold;padding:5px;display:inline-block ;text-align:right;white-space:nowrap;width:85%;clear:both;">
                Trang(頁次)
            </div>
         </div>  
   <!-- </div>  -->
	<!--抬頭與明細抬頭中間層 -->
	<!--<table style="width:1170px;border:3px solid black;" ></table>-->
	<div style="padding:5px 5px 0 5px;width:1170px;border-top:2px solid black;text-align:left;display:inline-block ;line-height:6px">
            
			<div style="font-family:Times New Roman,標楷體;font-size:16px;font-weight:bold;padding:5px;display:inline-block ;text-align:left;white-space:nowrap;width:35%;clear:both;">
                客戶代號：<?php echo $results[0]->ta004.' '.''.$results[0]->ta004disp.''?>
            </div>
            <div style="font-family:Times New Roman,標楷體;font-size:16px;font-weight:bold;padding:5px;display:inline-block ;text-align:left;white-space:nowrap;width:37%;clear:both;">
                
            </div>
			<div style="font-family:Times New Roman,標楷體;font-size:16px;font-weight:bold;padding:5px;display:inline-block ;text-align:left;white-space:nowrap;width:15%;clear:both;">
                電話：<?php echo $results[0]->ma006 ?>
            </div>
         </div> 
     <div style="padding:5px 5px 0 5px;width:1170px;text-align:left;display:inline-block ;line-height:10px">
            <div style="font-family:Times New Roman,標楷體;font-size:16px;font-weight:bold;padding:5px;display:inline-block ;text-align:left;white-space:nowrap;width:40%;clear:both;">
                帳款日期：<?php echo substr($dateo1,0,4).'/'.substr($dateo1,4,2).'/'.substr($dateo1,6,2).'至'.substr($datec1,0,4).'/'.substr($datec1,4,2).'/'.substr($datec1,6,2) ?>
            </div>
            <div style="font-family:Times New Roman,標楷體;font-size:16px;font-weight:bold;padding:5px;display:inline-block ;text-align:left;white-space:nowrap;width:32%;clear:both;">
               
            </div>
			<div style="font-family:Times New Roman,標楷體;font-size:16px;font-weight:bold;padding:5px;display:inline-block ;text-align:left;white-space:nowrap;width:18%;clear:both;">
                傳真：<?php echo $results[0]->ma008 ?>
            </div>
         </div>  
          <div style="padding:5px 5px 0 5px;width:1170px;text-align:left;display:inline-block ;line-height:12px">
            <div style="font-family:Times New Roman,標楷體;font-size:16px;font-weight:bold;padding:5px;display:inline-block ;text-align:left;white-space:nowrap;width:70%;clear:both;">
                送貨地址：<?php echo $results[0]->ma027 ?>
            </div>
          </div>
			 		  
     </div> 
    <div class="row-fluid" id="print-body-wrapper" style="width:1170px;border:0px solid black;">
        <table style="width:1170px;" id="table_data" cellspacing=0 cellpadding=0>
            <thead style="font-size:15px;background: #E7EFEF;">
                <tr style="height:20px;">
				      <td style="height:25px;border-top:2px solid black;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
                        <div style="font-family:Times New Roman,標楷體;font-weight:bold;width:100px;word-break:break-all;text-align:center;">
                            &nbsp;<?php echo "發票號碼";?>
                        </div>
                    </td>
                    <td style="height:25px;border-top:2px solid black;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,標楷體;font-weight:bold;width:100px;padding:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;text-align:center;">
                            &nbsp;<?php echo "來源";?>
                        </div>
                    </td>
                 <td style="height:25px;border-top:2px solid black;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,標楷體;font-weight:bold;width:90px;padding:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;text-align:center;">
                        
                           &nbsp; <?php echo  "日期";?>
                        </div>
                    </td> 
                    <td style="height:25px;border-top:2px solid black;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,標楷體;font-weight:bold;width:90px;text-align:center;">
                            &nbsp;<?php  echo  "單據號碼";?>
                        </div>
                    </td>
                    <td style="height:25px;border-top:2px solid black;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,標楷體;font-weight:bold;width:340px;padding:2px 12px 2px 2px;text-align:center;">
                            &nbsp;<?php echo  "品名";?></br>&nbsp;<?php echo  "規格";?>
                        </div>
                    </td>
					
                    <td style="height:25px;border-top:2px solid black;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,標楷體;font-weight:bold;width:90px;padding:2px 8px 2px 2px;text-align:center;">
                            &nbsp;<?php  echo "數量";?>
                        </div>
                    </td>   
					 <td style="height:25px;border-top:2px solid black;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,標楷體;font-weight:bold;width:90px;padding:2px 8px 2px 2px;text-align:center;">
                            &nbsp;<?php  echo "單價";?>
                        </div>
                    </td>  
					<td style="height:25px;border-top:2px solid black;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,標楷體;font-weight:bold;width:90px;padding:2px 8px 2px 2px;text-align:center;">
                            &nbsp;<?php  echo "金額";?>
                        </div>
                    </td>  
                    
                </tr>
            </thead>
			<?php $rownum=1;$pnum=15; ?>		 
	 <?php foreach ($results as $key=>$val):?>
	<!-- <div style="padding:5px 5px 0 5px;width:1170px;border-bottom:2px solid black;text-align:center;">
        </div>-->
	<?php $rownum++; ?>
            <tbody style="font-size:15px;">
                <tr style="height:30px;">
                    <td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;font-weight:bold;word-break:break-all;text-align:center;">
                            &nbsp;<?php echo $val->ta015;?>
                        </div>
                    </td>
                    <td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;font-weight:bold;padding:2px;word-break:break-all;text-align:left;">
                            <?php echo $val->tb004;?></span>
                        </div>
                    </td>
                    <td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;font-weight:bold;padding:2px;word-break:break-all;text-align:left;">
                             <?php echo $val->tg042;?>
                        </div>
                    </td> 
                    <td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;font-weight:bold;text-align:center;">
                            &nbsp;<?php  echo $val->tg002;?>
                        </div>
                    </td>
                    <td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;padding:2px 12px 2px 2px;text-align:right;">
                            &nbsp;<?php echo $val->th005;?><br>&nbsp;<?php echo $val->th006;?>
                        </div>
                    </td>
                   
					<td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;padding:2px 8px 2px 2px;text-align:right;">
                            &nbsp;<?php  echo number_format($val->th008, 0, '.' ,',');?>
                        </div>
                    </td>
					<td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;padding:2px 8px 2px 2px;text-align:right;">
                            &nbsp;<?php  echo number_format($val->th012, 0, '.' ,',');?>
                        </div>
                    </td>
					<td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;padding:2px 8px 2px 2px;text-align:right;">
                            &nbsp;<?php  echo number_format($val->th013, 0, '.' ,',');?>
                        </div>
                    </td>
                </tr>
				  <?php $th013a=$th013a+$val->th013;?>
				 <?php if ($pnum == $rownum ) { ?>
				<!--<tr>
					  <td colspan="8" align="left" style="height:25px;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
						<b>金額：</b><?php echo '　　　　　　　　　　　　　　　　　　　　';?><b>稅額：<?php echo ''; ?></b>
						<?php echo '　　　　　　　　　　　　　　　　　　　　';?>
						<b>金額合計：</b><?php echo  '';?>   <?php echo '續下頁..'; ?>
					  </td>
				</tr> -->
				<tr>
					  <td  align="left" style="height:6px;">
					    <?php echo '　　';?>
					  </td>
					</tr>
					
					   <?php $rownum=1;} ?>
                <?php endforeach;?>
				<?php for ($i=$rownum; $i<$pnum; $i++) { ?>
					<tr style="height:30px;">
                    <td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;font-weight:bold;width:90px;word-break:break-all;text-align:center;">
                            &nbsp;<?php echo " ";?><br>&nbsp;<?php echo " ";?>
                        </div>
                    </td>
                    <td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;font-weight:bold;padding:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;text-align:left;">
                           &nbsp; <?php echo "";?>
                        </div>
                    </td>
                   <td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;font-weight:bold;padding:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;text-align:left;">
                            &nbsp; <?php echo  "";?>
                        </div>
                    </td> 
                    <td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman,新細明體;font-weight:bold;text-align:center;">
                            &nbsp;<?php  echo "";?>
                        </div>
                    </td>
                    <td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman;padding:2px 12px 2px 2px;text-align:right;">
                            &nbsp;<?php echo "";?>
                        </div>
                    </td>
					 
					<td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman;padding:2px 12px 2px 2px;text-align:right;">
                            &nbsp;<?php echo "";?>
                        </div>
                    </td>
                    <td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman;padding:2px 8px 2px 2px;text-align:right;">
                            &nbsp;<?php  echo "";?>
                        </div>
                    </td>
					
					<td style="height:25px;border-bottom:1px solid black;border-right:1px solid black;">
                        <div style="font-family:Times New Roman;padding:2px 8px 2px 2px;text-align:right;">
                            &nbsp;<?php  echo "";?>
                        </div>
                    </td>
                </tr>
					<?php } ?>
					
					<tr>
					  <td colspan="9" align="left" style="with:1170px;height:25px;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
					   <?php if ($pnum >= $rownum  ) { ?>
					   <?php if ($results[0]->tg017 >= 2 ) { $th013b=$th013a*$results[0]->tg044;$th013c=$th013a+$th013b; ?> 
						<b>前期結欠<span style="font-family:Times New Roman,標楷體;font-size:10px;"></span>：</b><?php echo ''.'　　　　　　　　　　　　　　　';?>
						<b>本期應收<span style="font-family:Times New Roman,標楷體;font-size:10px;"></span>：<?php echo number_format($th013a, 0, '.' ,','); ?></b>
						<?php echo '　　　　　　　　　　　　';?>
						<b>本期稅額<span style="font-family:Times New Roman,標楷體;font-size:10px;"></span>：</b><?php echo  number_format($th013b, 0, '.' ,',');?>  <?php echo '　　　　　　　　　　　'; ?> 
					    <b>合計應收<span style="font-family:Times New Roman,標楷體;font-size:10px;"></span>：</b><?php echo  number_format($th013c, 0, '.' ,',');?>  
						<?php } ?> 
						<?php if ($results[0]->tg017 == 1 ) { $th013d=round($th013a/(1+$results[0]->tg044));$th013b=$th013a-$th013d; ?> 
						<b>前期結欠<span style="font-family:Times New Roman,標楷體;font-size:10px;"></span>：</b><?php echo ''.'　　　　　　　　　　　　　　　';?>
						<b>本期應收<span style="font-family:Times New Roman,標楷體;font-size:10px;"></span>：<?php echo number_format($th013d, 0, '.' ,','); ?></b>
						<?php echo '　　　　　　　　　　　　';?>
						<b>本期稅額<span style="font-family:Times New Roman,標楷體;font-size:10px;"></span>：</b><?php echo  number_format($th013b, 0, '.' ,',');?>  <?php echo '　　　　　　　　　　　'; ?> 
					    <b>合計應收<span style="font-family:Times New Roman,標楷體;font-size:10px;"></span>：</b><?php echo  number_format($th013a, 0, '.' ,',');?>  
						<?php } ?>
						
						<?php echo '';} ?>
					  
					  </td>
					 </tr>
					 
					 
					
					<tr>
					  <td  align="left" style="height:1px;line-height:2px;">
					    <?php // echo '　　';?>
					  </td>
					</tr>
					
				
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9" style="font-size:5px;padding:5px;">
                        <div style="font-family:Times New Roman,新細明體;float:left;width:920px;text-align:left;">
						第一聯:業務&nbsp;&nbsp;第二聯:客戶&nbsp;&nbsp;
						
						</div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div id="lastDataTable"></div>
    </div>
    </div>
    </form>
    </center>
    <script type="text/javascript">
        jQuery(document).ready(function()
        {
            var printHeader = $('#print-header-wrapper').html();
            var div_pageBreaker = '<div style="page-break-before:always;"></div>';
            var PageConH = 583; //顯示資料區域高度(height px) A4P 980px,L542, a5-L-380 410px  modi a4l-542 498
            var showAllpage = true; // true:顯示共幾筆 false:不顯示
            
            $('#table_data').each(function(index, element)
            {
                //how many pages of rows have we got?
                //var pages = Math.ceil($('tbody tr').length / per_page);
                
                var total_h = page_row_count = page_count = page_height = 0;
                var page_h = PageConH;
                var page_arr = new Array();
                var pageH_arr = new Array();
                var ChgTfoot_arr = new Array();
                
                $('tbody tr').each(function(indexx, elementx){
                    // console.log($(elementx).height());
                    total_h += $(elementx).height();
                    
                    page_h -= $(elementx).height();
                    page_row_count += 1;
                    page_height += $(elementx).height();
                    
                    if(page_h < $(elementx).height()){
                        page_count += 1;
                        page_arr[page_count] = page_row_count;
                        pageH_arr[page_count] = page_height;
                        ChgTfoot_arr[page_count] = PageConH - page_height;
                        // console.log("page:" + page_count + ",row:" + page_row_count + ",height:" + page_height);
                        page_h = PageConH;
                        page_row_count = 0;
                        page_height = 0;
                    }
                });
                var TotalPageNum = page_count; //總共頁數
                if(page_height > 0){ //最後一頁
                    // console.log("Last page:" + (page_count+1) + ",row:" + page_row_count + ",height:" + page_height);
                    page_arr[(page_count+1)] = page_row_count;
                    pageH_arr[(page_count+1)] = page_height;
                    ChgTfoot_arr[(page_count+1)] = PageConH - page_height;
                    TotalPageNum = page_count + 1; //總共頁數
                }
                
                // console.log(ChgTfoot_arr);
                // console.log(total_h);
                // console.log(TotalPageNum);
                
                tfootPadding = parseInt($(element).find("tfoot tr td").css("padding"));
                // console.log(tfootPadding);
                
                //第1頁頁尾padding-top ChgTfoot_arr[1]
                $(element).find("tfoot tr td").css("padding-top",tfootPadding + ChgTfoot_arr[1]+"px");
                // console.log($(element).find("tfoot tr td").css("padding-top"));
                
                var Allpage = "";
                if(showAllpage){
                    Allpage = " / " + TotalPageNum;
                }
                $('#print-header-wrapper').html(printHeader.replace("(頁次)", "(頁次)：1" + Allpage));
                
                //if we only have one page no more
                if (TotalPageNum == 1) {
                    return;
                }
                //get the table we're splutting
                var table_to_split = $(element);

                var current_page   = 1;
                //loop through each of our pages
                for (current_page = 1; current_page <= TotalPageNum; current_page++) 
                {
                    //make a new copy of the table
                    var cloned_table = table_to_split.clone();
                    
                    //第2頁頁尾padding-top到最後一頁 ChgTfoot_arr[2]~[last]
                    cloned_table.find("tfoot tr td").css("padding-top",tfootPadding + ChgTfoot_arr[(current_page+1)] +"px");
                    
                    //remove rows on later pages
                    $('tbody tr', table_to_split).each(function(loop, row_element) {
                        //if we've reached our max
                        if (loop >= page_arr[current_page]) { //if (loop >= per_page) {
                            //get rid of the row
                            $(row_element).remove();
                            // if(loop == per_page){
                                // console.log($(row_element).find("td").eq(2).find("div").html());
                            // }
                        }
                    });

                    //loop through the other copy
                    $('tbody tr', cloned_table).each(function(loop, row_element) {
                        //if we are before our current page
                        if (loop < page_arr[current_page]) {
                            //remove that one
                            $(row_element).remove();
                        }
                    });
                    
                    //insert the other table afdter the copy
                    if (current_page < TotalPageNum) {
                        printHeader1 = printHeader.replace("(頁次)", "(頁次)" + (current_page + 1) + Allpage); 
                        $(div_pageBreaker).appendTo('#lastDataTable');
                        $(printHeader1).appendTo('#lastDataTable');
                        $(cloned_table).appendTo('#lastDataTable');
                    }
                    
                    //make a break
                    table_to_split = cloned_table;
                }
            });
            
            
            $("#print").click(function(){
                $("#data").jqprint({
                    
                });
            })
            
        });
    </script>
<?php 
  function convert_2_cn($num) {
$convert_cn = array("零","壹","貳","叄","肆","伍","陸","柒","捌","玖");
$repair_number = array('零仟零佰零拾零','零萬','零仟','零佰','零拾');
$unit_cn = array("拾","佰","仟","萬","拾");
$exp_cn = array("","萬","拾");
$max_len = 12;
$len = strlen($num);
if($len > $max_len) {
return 'outnumber';
}
$num = str_pad($num,12,'-',STR_PAD_LEFT);
$exp_num = array();
$k = 0;
for($i=12;$i>0;$i--){
if($i%4 == 0) {
$k  ;
}
$exp_num[$k][] = substr($num,$i-1,1);
}
$str = '';
foreach($exp_num as $key=>$nums) {
if(array_sum($nums)){
$str = array_shift($exp_cn) . $str;
}
foreach($nums as $nk=>$nv) {
if($nv == '-'){continue;}
if($nk == 0) {
$str = $convert_cn[$nv] . $str;
} else {
$str = $convert_cn[$nv].$unit_cn[$nk-1] . $str;
}
}
}
$str = str_replace($repair_number,array('萬','億','-'),$str);
$str = preg_replace("/-{2,}/","",$str);
$str = str_replace(array('零','-'),array('','零'),$str);
return $str;
}
?>

  </body>
</html>
