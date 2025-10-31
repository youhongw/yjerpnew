  <!-- /.content-wrapper -->
  <footer class="main-footer">
      <div class="pull-right hidden-xs">
          <b>Version</b> 3.1.10
      </div>
      <strong>Copyright &copy; 2022
  </footer>

  <!-- ./wrapper -->

  <!-- jQuery 3 1100311 -->
  <!-- jQuery 3 1100311 -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
      $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="<?php echo base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE EIP demo (This is only for demo purposes) -->
  <script src="<?php echo base_url() ?>assets/dist/js/pages/EIP.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>

  <!-- DataTables -->
  <script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <!-- FastClick -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />-->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
  <!-- page script -->
  <script type="text/javascript" language="javascript">
      var table = $("#example1").DataTable({
          "oLanguage": {
              "sprocessing": "處理中...",
              "sloadingRecords": "載入中...",
              "sLengthMenu": "每頁顯示 _MENU_ 筆記錄",
              "sSearch": "搜尋:",
              "sZeroRecords": "抱歉， 没有找到",
              "sInfo": "從 _START_ 到 _END_ /共 _TOTAL_ 筆記錄",
              "sInfoEmpty": "没有記錄",
              "sInfoFiltered": "(從 _MAX_ 筆記錄中檢索)",
              "oPaginate": {
                  "sFirst": "首頁",
                  "sPrevious": "上一頁",
                  "sNext": "下一頁",
                  "sLast": "尾頁"
              },
          },
          "pageLength": 10,
          "lengthMenu": [10, 50, 100, 500, 1000],
          "deferRender": true,

          "initComplete": function(settings, json) {
              var api = this.api();
              CalculateTableSummary(this);
          },
          "footerCallback": function(row, data, start, end, display) {
              var api = this.api(),
                  data;
              CalculateTableSummary(this);
              return;
          }
      });



      function CalculateTableSummary(table) {
          try {
              var intVal = function(i) {
                  //   console.log('i:' + i);
                  return typeof i === 'string' ?
                      i.replace(/[\$,]/g, '') * 1 :
                      typeof i === 'number' ?
                      i : 0;
              };

              var api = table.api();
              api.columns(".sum").eq(0).each(function(index) {
                  //   console.log('index:' + index);
                  var column = api.column(index, {
                      page: 'current'
                  });

                  var sum = column
                      .data()
                      .reduce(function(a, b) {
                          //return parseInt(a, 10) + parseInt(b, 10);
                          return intVal(a) + intVal(b);
                      }, 0);
                  //   console.log(sum);

                  if ($(column.footer()).hasClass("Int")) {
                      $(column.footer()).html('' + sum.toFixed(0));
                  } else if ($(column.footer()).hasClass("flo")) {
                      $(column.footer()).html('' + sum.toFixed(3));
                  } else {
                      $(column.footer()).html('' + sum);
                  }

              });
              api.columns(".sum1").eq(0).each(function(index) {
                  //   console.log('index:' + index);
                  var column = api.column(index, {
                      page: 'current'
                  });

                  var sum = column
                      .data()
                      .reduce(function(a, b) {
                          //return parseInt(a, 10) + parseInt(b, 10);
                          return intVal(a) + intVal(b);
                      }, 0);

                  //   console.log('sum1:' + sum);

                  if ($(column.footer()).hasClass("Int")) {
                      $(column.footer()).html('' + sum.toFixed(0));
                  } else if ($(column.footer()).hasClass("flo")) {
                      $(column.footer()).html('' + sum.toFixed(3));
                  } else {
                      $(column.footer()).html('' + sum);
                  }

              });
              api.columns(".sum2").eq(0).each(function(index) {
                  //   console.log('index:' + index);
                  var column = api.column(index, {
                      page: 'current'
                  });

                  var sum = column
                      .data()
                      .reduce(function(a, b) {
                          //return parseInt(a, 10) + parseInt(b, 10);
                          return intVal(a) + intVal(b);
                      }, 0);

                  //   console.log('sum1:' + sum);

                  if ($(column.footer()).hasClass("Int")) {
                      $(column.footer()).html('' + sum.toFixed(0));
                  } else if ($(column.footer()).hasClass("flo")) {
                      $(column.footer()).html('' + sum.toFixed(3));
                  } else {
                      $(column.footer()).html('' + sum);
                  }

              });
              api.columns(".sum3").eq(0).each(function(index) {
                  //   console.log('index:' + index);
                  var column = api.column(index, {
                      page: 'current'
                  });

                  var sum = column
                      .data()
                      .reduce(function(a, b) {
                          //return parseInt(a, 10) + parseInt(b, 10);
                          return intVal(a) + intVal(b);
                      }, 0);

                  //   console.log('sum1:' + sum);

                  if ($(column.footer()).hasClass("Int")) {
                      $(column.footer()).html('' + sum.toFixed(0));
                  } else if ($(column.footer()).hasClass("flo")) {
                      $(column.footer()).html('' + sum.toFixed(3));
                  } else {
                      $(column.footer()).html('' + sum);
                  }

              });
              api.columns(".sum4").eq(0).each(function(index) {
                  //   console.log('index:' + index);
                  var column = api.column(index, {
                      page: 'current'
                  });

                  var sum = column
                      .data()
                      .reduce(function(a, b) {
                          //return parseInt(a, 10) + parseInt(b, 10);
                          return intVal(a) + intVal(b);
                      }, 0);

                  //   console.log('sum1:' + sum);

                  if ($(column.footer()).hasClass("Int")) {
                      $(column.footer()).html('' + sum.toFixed(0));
                  } else if ($(column.footer()).hasClass("flo")) {
                      $(column.footer()).html('' + sum.toFixed(3));
                  } else {
                      $(column.footer()).html('' + sum);
                  }

              });
              api.columns(".sum5").eq(0).each(function(index) {
                  //   console.log('index:' + index);
                  var column = api.column(index, {
                      page: 'current'
                  });

                  var sum = column
                      .data()
                      .reduce(function(a, b) {
                          //return parseInt(a, 10) + parseInt(b, 10);
                          return intVal(a) + intVal(b);
                      }, 0);

                  //   console.log('sum1:' + sum);

                  if ($(column.footer()).hasClass("Int")) {
                      $(column.footer()).html('' + sum.toFixed(0));
                  } else if ($(column.footer()).hasClass("flo")) {
                      $(column.footer()).html('' + sum.toFixed(3));
                  } else {
                      $(column.footer()).html('' + sum);
                  }

              });
              api.columns(".sum6").eq(0).each(function(index) {
                  //   console.log('index:' + index);
                  var column = api.column(index, {
                      page: 'current'
                  });

                  var sum = column
                      .data()
                      .reduce(function(a, b) {
                          //return parseInt(a, 10) + parseInt(b, 10);
                          return intVal(a) + intVal(b);
                      }, 0);

                  //   console.log('sum1:' + sum);

                  if ($(column.footer()).hasClass("Int")) {
                      $(column.footer()).html('' + sum.toFixed(0));
                  } else if ($(column.footer()).hasClass("flo")) {
                      $(column.footer()).html('' + sum.toFixed(3));
                  } else {
                      $(column.footer()).html('' + sum);
                  }

              });
          } catch (e) {
              console.log('Error in CalculateTableSummary');
              console.log(e)
          }
      }
  </script>
  <script>
      /* $(function () {
	$('#example1').DataTable
	( {paging: false
"oLanguage": {
	"sprocessing": "處理中...",
    "sloadingRecords": "載入中...",
"sLengthMenu": "每頁顯示 _MENU_ 筆記錄",
"sSearch": "搜尋:",
"sZeroRecords": "抱歉， 没有找到",
"sInfo": "從 _START_ 到 _END_ /共 _TOTAL_ 筆記錄",
"sInfoEmpty": "没有記錄",
"sInfoFiltered": "(從 _MAX_ 筆記錄中檢索)",
"oPaginate": {
"sFirst": "首頁",
"sPrevious": "上一頁",
"sNext": "下一頁",
"sLast": "尾頁"
},

"sZeroRecords": "没有檢索到記錄",
"sProcessing": "<img src='./loading.gif' />"
}
} );
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
 
  }) */
  </script>
  <script type="text/javascript">
      // enterkey 測試   
      $(document).ready(function() {
          Enterkey();
      });
  </script>

  <script type="text/javascript">
      // enterkey 測試    
      function Enterkey() {
          $("input").not($(":button")).keypress(function(evt) {
              if (evt.keyCode == 13) {
                  if ($(this).attr("type") !== 'submit') {
                      var fields = $(this).parents('form:eq(0),body').find('input, textarea, checkbox, radio');
                      var index = fields.index(this);
                      if (index > -1 && (index + 1) < fields.length) {
                          fields.eq(index + 1).focus();
                      }
                      $(this).blur();
                      return false;
                  }
              }
          });
      }

      function keyFunction() {
          $("input").not($(":button")).keypress(function(evt) {
              if (evt.keyCode == 13) {
                  if ($(this).attr("type") !== 'submit') {
                      var fields = $(this).parents('form:eq(0),body').find('input, textarea, checkbox, radio');
                      var index = fields.index(this);
                      if (index > -1 && (index + 1) < fields.length) {
                          fields.eq(index + 1).focus();
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
      $(document).ready(function() {
          // Confirm Delete
          $('#form').submit(function() {
              if ($(this).attr('action').indexOf('delete', 1) != -1) {
                  if (!confirm('刪除資料後您將不能恢復，確定要刪除嗎?')) {
                      return false;
                  }
              }
          });

          // Confirm Uninstall
          $('a').click(function() {
              if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
                  if (!confirm('刪除或卸載後您將不能恢復，請確定要這麼做嗎?')) {
                      return false;
                  }
              }
          });

      });
  </script>
  <script language="javascript">
      //閒置超時，系統強制登出  1000毫秒=1秒, 7200000=2小時 8小時 328
      //	function Msg(){
      //		alert("閒置超時，系統強制登出!");
      //		location="<?php echo base_url() ?>";
      //	}
      //	window.setInterval("Msg()",32800000);

      function CheckForm() {
          if (confirm("確認要刪除此筆嗎？") == true)
              return true;
          else
              return false;
      }

      // < !--自動檢查輸入欄位游標停留變黃色-- >
      function setFocus() {
          for (var i = 0; i < document.forms[0].elements.length; i++) {
              var e = document.forms[0].elements[i];
              if (e.type == "text" || e.type) {
                  e.focus();
                  break;
              }
          }
      }
  </script>

  </body>

  </html>