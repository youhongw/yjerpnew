<html>
<head>
    <script src="<?php echo base_url()?>assets/report/js/jquery-3.4.1.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/report/js/jqprint.0.3.js"></script>
    <link used="print" rel="stylesheet" media="screen" href="<?php echo base_url()?>assets/report/css/main.css" /> <!-- 頁面呈現的CSS -->
    <link used="print" rel="stylesheet" media="print" href="<?php echo base_url()?>assets/report/css/print_a5pd.css" /> <!-- 列印使用的CSS -->
    <title><?php echo $message; ?></title>
	<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
<body>
    <!-- 公司抬頭 -->
	<?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
<?php exit;} ?>
    <?php $PrintDate=date("Y/m/d");   ?>
    <div style="padding:10px;">
        <a id="print" href="#"  style="font-size: 1.1em;font-family: 微軟正黑體, Arial, Helvetica, sans-serif;padding: 0em 0.625em;border:1px solid black;text-decoration:none;background-color:#f5f6e6;">列印</a>
        <a id="print1" href="<?php echo base_url() ?>index.php/scm/admr01/printdetail"  style="font-size: 1.1em;font-family: 微軟正黑體, Arial, Helvetica, sans-serif;padding: 0em 0.625em;border:1px solid black;text-decoration:none;background-color:#E7EFEF;">返回</a>
	</div>
    <center>
    <form id="data">
    <div style="width:500px;text-align:center;">
    <div id="print-header-wrapper" style="width:500px;">
        <div class="TitleName" style="font-family:Times New Roman,標楷體;padding:5px;font-size:28px;font-weight:bold;letter-spacing: 3px;width:500px;border:0px solid black;text-align:center;line-height:22px">
            <?php echo iconv("big-5","utf-8//IGNORE",$this->session->userdata('sysml003')); ?>
        </div>
        <div style="font-family:Times New Roman,標楷體;padding:5px;font-size:20px;font-weight:bold;letter-spacing: 1px;width:500px;border:0px solid black;text-align:center;clear:both;line-height:12px">
            即時業績明細表
        </div>
		<div style="padding:5px 5px 0 5px;width:600px;text-align:left;display:inline-block ;line-height:12px">
            <div style="font-family:Times New Roman,標楷體;font-size:18px;font-weight:bold;padding:5px;display:inline-block ;text-align:left;white-space:nowrap;width:10%;clear:both;">
                製表日期：<?php echo date("Y/m/d"); ?>
            </div>
            <div style="font-family:Times New Roman,標楷體;font-size:18px;font-weight:bold;padding:5px;display:inline-block ;text-align:right;white-space:nowrap;width:85%;clear:both;">
                頁次：
            </div>
         </div> 
		 <div style="padding:5px 5px 0 5px;width:600px;text-align:left;display:inline-block ;line-height:12px">
            <div style="font-family:Times New Roman,標楷體;font-size:18px;font-weight:bold;padding:5px;display:inline-block ;text-align:left;white-space:nowrap;width:10%;clear:both;">
                起迄日期：<?php echo $dateo;?>&nbsp;&nbsp;至&nbsp;&nbsp;<?php echo $datec;?>
            </div>
            <div style="font-family:Times New Roman,標楷體;font-size:18px;font-weight:bold;padding:5px;display:inline-block ;text-align:right;white-space:nowrap;width:85%;clear:both;">
                
            </div>
         </div> 
		 <div style="padding:5px 5px 0 5px;width:630px;border-top:2px solid black;text-align:left;display:inline-block ;line-height:6px">
		
    </div>
    <div class="row-fluid" id="print-body-wrapper" style="width:500px;border:0px solid black;">
        <table style="width:500px;" id="table_data">
            <thead style="font-size:15px;width:500px;">
                <tr style="width:500px;">
                       <th style="width:80px;"> 
                        <div style="margin: 0 auto;font-family:Times New Roman,標楷體;font-weight:bold;padding:3px;width:75px;border-bottom:2px solid black;">名次</div>
                      </th>
                    <th style="width:80px;"> 
                        <div style="margin: 0 auto;font-family:Times New Roman,標楷體;font-weight:bold;padding:3px;width:208px;border-bottom:2px solid black;">業務代號</div>
                    </th>
                    <th style="width:80px;">  
                        <div style="margin: 0 auto;font-family:Times New Roman,標楷體;font-weight:bold;padding:3px;width:225px;border-bottom:2px solid black;">業務名稱</div>
                    </th> 
                        <th style="width:80px;"> 
                        <div style="margin: 0 auto;font-family:Times New Roman,標楷體;font-weight:bold;padding:3px;width:97px;border-bottom:2px solid black;">銷售額</div>
                    </th> 
                    
                </tr>
            </thead>
            <tbody style="font-size:20px;">
			    <?php $no=1;$totamt=0; ?>
                <?php foreach ($results as $val):?>
                <tr style="height:20px;">
                    <td style="height:25px;border-bottom:1px dashed #999;">
                        <div style="font-family:Times New Roman,新細明體;padding:2px 2px 2px 2px;text-align:center;">
                            &nbsp;<?php echo $no;?>
							<?php  $no=$no+1;?>
                        </div>
                    </td>
                    <td style="height:25px;border-bottom:1px dashed #999;">
                        <div style="font-family:Times New Roman,新細明體;padding:2px 2px 2px 2px;text-align:center;">
                            &nbsp;<?php echo $val->MA001;?>
                        </div>
                    </td>
                    <td style="height:25px;border-bottom:1px dashed #999;">
                        <div style="font-family:Times New Roman,新細明體;padding:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;text-align:center;">
                            &nbsp; <?php echo iconv("big-5","utf-8//IGNORE",$val->MA002);?>
                        </div>
                    </td>
                    <td style="height:25px;border-bottom:1px dashed #999;">
                        <div style="font-family:Times New Roman,新細明體;padding:2px 10px 2px 2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;text-align:right;">
                            &nbsp;<?php echo number_format(round($val->MA003), 0, '.' ,',');?>
                        </div>
                    </td>
                    
                </tr>
                   <?php $totamt=$totamt+round($val->MA003);  ?>
                <?php endforeach;?>
            <!--   <tr>
					  <td colspan="4" align="right" >
						<?php echo '　　　　　　　　　　　　　　　';?>
					  </td>
				</tr> -->
				<tr>
					  <td colspan="4" align="right" >
						<b>&nbsp;合計：</b><?php echo number_format(round($totamt), 0, '.' ,',');?>
					  </td>
				</tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="font-size:15px;padding:10px;">
                        <div style="font-family:Times New Roman,新細明體;margin-left:50px;float:left;width:170px;text-align:left;">核准</div>
                        <div style="font-family:Times New Roman,新細明體;float:left;width:170px;text-align:left;">審核</div>
                        <div style="font-family:Times New Roman,新細明體;float:left;width:170px;text-align:center;">製表</div>
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
            var PageConH = 980; //顯示資料區域高度(height px) 980 1150
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
                $('#print-header-wrapper').html(printHeader.replace("頁次：", "頁次：1" + Allpage));
                
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
                        printHeader1 = printHeader.replace("頁次：", "頁次：" + (current_page + 1) + Allpage); 
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
    
  </body>
</html>
