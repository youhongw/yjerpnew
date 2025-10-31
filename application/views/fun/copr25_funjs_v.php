<script type="text/javascript">
$(document).ready(function(){
	$('#commentForm').submit(function() {
		if(check_date())
			return true;
		else
			return false;
	});
});
function check_date(){
	if($('#datec').val()-$('#dateo').val()>99){
		alert('輸入之日期區間超過一年，請重新輸入');
		$('#dateo').select();
		return false;
	}
	return true;
}
</script>