<?php
#麵包屑
?>
<table width="80%" cellpadding="0" cellspacing="0" style="text-align:left">
<tr><!--麵包屑-->
<td style="background:#EEE" height="30" width="60%">&nbsp;<a href="<?php echo base_url().'main/action';?>">首頁</a>
                                                    / <a href="<?php echo base_url().'main/action?id='.$main_id;?>"> <?php echo $main_title?></a>
                                                    / <?php echo $sub_title?></td>
<td style="background:#EEE" width="40%" align="right">公司名稱: <span style="color:#F39; font-weight:bold"><?php echo $user_copna;?></span>
&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
使用者: <span style="color:#F39; font-weight:bold"><?php echo $user_id;?></span>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
</tr>
</table>



<!--資料載入..loaging-->
<div class="loading2"></div> 
