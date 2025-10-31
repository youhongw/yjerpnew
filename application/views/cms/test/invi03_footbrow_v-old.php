 
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	
	var filter_ma001 = $('select[name=\'filter_ma001\']').attr('value');
	if (filter_ma001 != '*') {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma001/desc/' + encodeURIComponent(filter_ma001);
	}
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma002/desc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').attr('value');
	if (filter_ma003) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma003/desc/' + encodeURIComponent(filter_ma003);
	}
		
	var filter_ma004 = $('input[name=\'filter_ma004\']').attr('value');
	if (filter_ma004) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma004/desc/' + encodeURIComponent(filter_ma004); 
	}
	
	var filter_ma005 = $('input[name=\'filter_ma005\']').attr('value');
	if (filter_ma005) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma005/desc/' + encodeURIComponent(filter_ma005); 
	}
	
	var filter_ma006 = $('input[name=\'filter_ma006\']').attr('value');
	if (filter_ma006) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma006/desc/' + encodeURIComponent(filter_ma006); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_ma001 == '*' && !filter_ma002  && !filter_ma003 && !filter_ma004  && !filter_ma005 && !filter_ma006 && !filter_create) {         
	   url = 'http://ci.dercaster.com/index.php/inv/invi03/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ma001 = $('select[name=\'filter_ma001\']').attr('value');
	if (filter_ma001 != '*') {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma001/asc/' + encodeURIComponent(filter_ma001);
	}
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma002/asc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').attr('value');
	if (filter_ma003) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma003/asc/' + encodeURIComponent(filter_ma003);
	}
		
	var filter_ma004 = $('input[name=\'filter_ma004\']').attr('value');
	if (filter_ma004) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma004/asc/' + encodeURIComponent(filter_ma004); 
	}
	
	var filter_ma005 = $('input[name=\'filter_ma005\']').attr('value');
	if (filter_ma005) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma005/asc/' + encodeURIComponent(filter_ma005); 
	}
	
	var filter_ma006 = $('input[name=\'filter_ma006\']').attr('value');
	if (filter_ma006) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma006/asc/' + encodeURIComponent(filter_ma006); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_ma001 == '*' && !filter_ma002  && !filter_ma003 && !filter_ma004  && !filter_ma005 && !filter_ma006 && !filter_create) {         
	   url = 'http://ci.dercaster.com/index.php/inv/invi03/display';location = url;
	   }
	   
	location = url;
}
//--></script>
 <div id="footer"><br />Design by <a tabIndex="-1" href="<?=base_url()?>" target="_blank">個人電腦,筆電,平板,手機四合一雲端ERP</a> &copy; 2013-2014 Project </div>
