/* Global JavaScript File for working with jQuery library */

// execute when the HTML file's (document object model: DOM) has loaded
$(document).ready(function() {

  /* USERNAME VALIDATION */
  // use element id=username 
  // bind our function to the element's onblur event
  $('#username').blur(function() {

    // get the value from the username field                              
    var username = $('#username').val();
    
    // Ajax request sent to the CodeIgniter controller "ajax" method "username_taken"
    // post the username field's value
    $.post('/index.php/ajax/username_taken',
      { 'username':username },

      // when the Web server responds to the request
      function(result) {
        // clear any message that may have already been written
        $('#bad_username').replaceWith('');
        
        // if the result is TRUE write a message to the page
        if (result) {
          $('#username').after('<div id="bad_username" style="color:red;">' +
            '<p>(That Username is already taken. Please choose another.)</p></div>');
        }
      }
    );
  });  

});
 /* AUTOSAVE PARTICIPATION */
  // use input element name=participation_type_id and type=radio
  // bind our function to the element's onclick event
  $('input[name=participation_type_id]:radio').click(function() {
    
    var participation_type_id = this.value;

    // create global variables for use below
    var class_activity_id, user_id;
    
    // get the form's two hidden input elements 
    // each is a sibling of the parent of the clicked radio button
    // store their values in the global variables
    var hidden_elements = $(this).parent().siblings('input:hidden');
    $(hidden_elements).map(function() {
      if (this.name == 'class_activity_id') {
        class_activity_id = this.value;
      }
      if (this.name == 'user_id') {
        user_id = this.value;
      }
    });
   // Ajax request to CodeIgniter controller "ajax" method "update_user_participation"
    // post the user_id, class_activity_id and participation_type_id fields' values
    $.post('/index.php/ajax/update_user_participation',
      { 'user_id':user_id, 
        'class_activity_id':class_activity_id, 
        'participation_type_id':participation_type_id },
      // when the Web server responds to the request
      function(result) { }
    );
 // set the text next to the clicked radio button to red
    $(this).next().css("color", "red");

    // set the text next to the remaining radio buttons to black
    var other_r_buttons = $(this).siblings('input[name=participation_type_id]:radio');
    $(other_r_buttons).map(function() {
      $(this).next().css("color", "black");
    });

  });
/* AUTOSUGGEST SEARCH */
// triggered by input field onkeyup
function autosuggest(str){
  // if there's no text to search, hide the list div
  if (str.length == 0) {
    $('#autosuggest_list').fadeOut(500);
  } else {
    // first show the loading animation
    $('#class_activity').addClass('loading');
    
    // Ajax request to CodeIgniter controller "ajax" method "autosuggest"
    // post the str parameter value
    $.post('/index.php/ajax/autosuggest',
      { 'str':str },
      function(result) {
        // if there is a result, fill the list div, fade it in 
        // then remove the loading animation
        if(result) {
          $('#autosuggest_list').html(result);
          $('#autosuggest_list').fadeIn(500);
          $('#class_activity').removeClass('loading');
      }
    });
  }
}
/* AUTOSUGGEST SET ACTIVITY */
// triggered by an onclick from any of the li's in the autosuggest list
// set the class_acitity field, wait and fade the autosuggest list
// then display the activity details
function set_activity(activity_name, master_activity_id) {
  $('#class_activity').val(activity_name);
  setTimeout("$('#autosuggest_list').fadeOut(500);", 250);
  display_activity_details(master_activity_id);
}

/* AUTOSUGGEST DISPLAY ACTIVITY DETAILS */
// called by set_activity()
// get the HTML to display and display it
function display_activity_details(master_activity_id) {
  
  // Ajax request to CodeIgniter controller "ajax" method "get_activity_html"
  // post the master_class_activity parameter values
  $.post('/index.php/ajax/get_activity_html',
    { 'master_activity_id':master_activity_id },
    // when the Web server responds to the request
    // replace the innerHTML of the select_activity element
    function(result) { 
      $('#select_activity').html(result);
    }
  );
}
代码还使用 Ajax 获得显示所选活动的表行。使用清单 17 的代码生成它的 HTML。
清单 17. 回传显示活动的 HTML 表
  public function get_activity_html()
  {
    $this->load->model('MActivity', '', TRUE);
    $this->load->library('table');

    $requested_activity_id = $_POST['master_activity_id'];
    $requested_activity_qry = 
      $this->MActivity->get_requested_master_activity($requested_activity_id);

    // code leveraged from /controllers/activity.php manage_class_listing() method
    // generate HTML table from query results
    $tmpl = array (
      'table_open' => '<table>',
      'heading_row_start' => '<tr class="table_header_add">',
      'row_start' => '<tr class="odd_row_add">' 
    );
    $this->table->set_template($tmpl); 
    
    $this->table->set_caption('&nbsp;Add this Activity'); 

    $this->table->set_empty("&nbsp;"); 
    
    $this->table->set_heading('<span class="date_column">Date</span>',
                  '<span class="activity_name_column">Activity Name</span>',
                  '<span class="address_column">Address</span>',
                  'City', 'Details');
    
    $table_row = array();

    foreach ($requested_activity_qry->result() as $activity)
    {
      $m_id = $activity->master_activity_id;

      $table_row = NULL;

      $table_row[] = ''.
        '<form action="" name="form_'.$m_id.'" method="post">'.
        '<input type="hidden" name="master_activity_id" value="'.$m_id.'"/> '.
        '<input type="text" name="activity_date" size="12" /> '.
        '<input type="hidden" name="action" value="save" /> '.
        '</form>'.
        '<span class="help-text">format: MM-DD-YYYY</span><br/>'.
        '<a href="" onclick="document.forms[\'form_'.$m_id.'\'].submit();'.
        'return false;">save</a>';


      $table_row[] = '<input type="text" value="'.$activity->name.
        '" id="class_activity" onkeyup="autosuggest(this.value);"'.
        'class="autosuggest_input" />'.
        '<div class="autosuggest" id="autosuggest_list"></div>';
      $table_row[] = htmlspecialchars($activity->address);
      $table_row[] = htmlspecialchars($activity->city);
      $table_row[] = htmlspecialchars($activity->details);

      $this->table->add_row($table_row);
    }    
      
    $requested_activities_table = $this->table->generate();

    echo $requested_activities_table;
  }

}
