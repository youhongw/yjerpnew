  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 3.1.10
    </div>
    <strong>Copyright &copy; 2020
  </footer>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url()?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url()?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url()?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url()?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url()?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url()?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE EIP demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url()?>assets/dist/js/pages/EIP.js"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>assets/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- FastClick -->

<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script type="text/javascript"><!-- 	// enterkey 測試   
	$(document).ready(function(){ 
	Enterkey(); 	   
	}); 	   
</script> 	  
		   
<script type="text/javascript"><!-- 	// enterkey 測試    
	function Enterkey() { 	   
	$("input").not( $(":button") ).keypress(function (evt) { 	   
	if (evt.keyCode == 13) { 	   
	if ($(this).attr("type") !== 'submit'){ 	   
	var fields = $(this).parents('form:eq(0),body').find('input, textarea, checkbox, radio'); 	   
	var index = fields.index( this ); 	   
	if ( index > -1 && ( index + 1 ) < fields.length ) { 	   
	fields.eq( index + 1 ).focus(); 	   
	} 	   
	$(this).blur(); 	   
	return false; 	   
	} 	   
	} 	   
	}); 	   
	} 	
	
	function keyFunction() { 	   
	$("input").not( $(":button") ).keypress(function (evt) { 	   
	if (evt.keyCode == 13) { 	   
	if ($(this).attr("type") !== 'submit'){ 	   
	var fields = $(this).parents('form:eq(0),body').find('input, textarea, checkbox, radio'); 	   
	var index = fields.index( this ); 	   
	if ( index > -1 && ( index + 1 ) < fields.length ) { 	   
	fields.eq( index + 1 ).focus(); 	   
	} 	   
	$(this).blur(); 	   
	return false; 	   
	} 	   
	} 	   
	}); 	   
	} 	
</script>
<script type="text/javascript">

//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){    
	// Confirm Delete
    $('#form').submit(function(){
        if ($(this).attr('action').indexOf('delete',1) != -1) {
            if (!confirm('刪除資料後您將不能恢復，確定要刪除嗎?')) {
                return false;
            } 
        }
    });
 
	// Confirm Uninstall
    $('a').click(function(){
        if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
            if (!confirm('刪除或卸載後您將不能恢復，請確定要這麼做嗎?')) {
                return false;
            }
        }
    });
	
});

</script>
<script language="javascript">     //閒置超時，系統強制登出  1000毫秒=1秒, 7200000=2小時 8小時 328
//	function Msg(){
//		alert("閒置超時，系統強制登出!");
//		location="<?php echo base_url()?>";
//	}
//	window.setInterval("Msg()",32800000);
	
	function CheckForm()
      {
        if(confirm("確認要刪除此筆嗎？")==true)
           return true;
        else
           return false;
      } 
    
    function setFocus()                              <!--自動檢查輸入欄位游標停留變黃色  -->
	  {
　       for(var i=0; i<document.forms[0].elements.length; i++) 
           {
　      　   var e = document.forms[0].elements[i];
　      　   if (e.type=="text" || e.type ) 
               {
　　　           e.focus();
　　　           break;
　　           }
　         }
     } 	
	  
</script>
</body>
</html>
