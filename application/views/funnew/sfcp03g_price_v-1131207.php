<script type="text/javascript"> 

//規格換算mb00xa1 
function pricea(pgnoa,vprice){
	
	var vpgnoa = pgnoa.value;
	if (vpgnoa=='') { $('#pg0051').val('0');$('#pg005').val(0);return; }
	if (vpgnoa=='0') { $('#pg0051').val('0');$('#pg005').val(0);return; }
	var numa = vprice/vpgnoa;
	    numa = numa.toFixed(3);
		console.log(vpgnoa);
		console.log(vprice);
    $('#pg005').val(numa);
    tot=$('#pg005').val()+$('#pg006').val()+$('#pg007').val()+$('#pg008').val()+$('#pg009').val()+
	    $('#pg010').val()+$('#pg011').val()+$('#pg012').val()+$('#pg014').val();
    tot = tot.toFixed(3);
	$('#pg019').val(tot);		
	
}
function tot(){
	tot=$('#pg005').val()+$('#pg006').val()+$('#pg007').val()+$('#pg008').val()+$('#pg009').val()+
	    $('#pg010').val()+$('#pg011').val()+$('#pg012').val()+$('#pg014').val();
    tot = tot.toFixed(3);
	$('#pg019').val(tot);	
}
function priceb(pgnoa,vprice){
	
	var vpgnoa = pgnoa.value;
	if (vpgnoa=='') { $('#pg0061').val('0');$('#pg006').val(0);return; }
	if (vpgnoa=='0') { $('#pg0061').val('0');$('#pg006').val(0);return; }
	var numa = vprice/vpgnoa;
	    numa = numa.toFixed(3);
    $('#pg006').val(numa);
}
function pricec(pgnoa,vprice){
	
	var vpgnoa = pgnoa.value;
	if (vpgnoa=='') { $('#pg0071').val('0');$('#pg007').val(0);return; }
	if (vpgnoa=='0') { $('#pg0071').val('0');$('#pg007').val(0);return; }
	var numa = vprice/vpgnoa;
	    numa = numa.toFixed(3);
    $('#pg007').val(numa);
}
function priced(pgnoa,vprice){
	var vpgnoa = pgnoa.value;
	if (vpgnoa=='') { $('#pg0081').val('0');$('#pg008').val(0);return; }
	if (vpgnoa=='0') { $('#pg0081').val('0');$('#pg008').val(0);return; }
	var numa = vprice/vpgnoa;
	    numa = numa.toFixed(3);
    $('#pg008').val(numa);
}
function pricee(pgnoa,vprice){
	var vpgnoa = pgnoa.value;
	if (vpgnoa=='') { $('#pg0091').val('0');$('#pg009').val(0);return; }
	if (vpgnoa=='0') { $('#pg0091').val('0');$('#pg009').val(0);return; }
	var numa = vprice/vpgnoa;
	    numa = numa.toFixed(3);
    $('#pg009').val(numa);
}
function pricef(pgnoa,vprice){
	var vpgnoa = pgnoa.value;
	if (vpgnoa=='') { $('#pg0101').val('0');$('#pg010').val(0);return; }
	if (vpgnoa=='0') { $('#pg0101').val('0');$('#pg010').val(0);return; }
	var numa = vprice/vpgnoa;
	    numa = numa.toFixed(3);
    $('#pg010').val(numa);
}
function priceg(pgnoa,vprice){
	var vpgnoa = pgnoa.value;
	if (vpgnoa=='') { $('#pg0111').val('0');$('#pg011').val(0);return; }
	if (vpgnoa=='0') { $('#pg0111').val('0');$('#pg011').val(0);return; }
	var numa = vprice/vpgnoa;
	    numa = numa.toFixed(3);
    $('#pg011').val(numa);
}
function priceh(pgnoa,vprice){
	var vpgnoa = pgnoa.value;
	if (vpgnoa=='') { $('#pg0121').val('0');$('#pg012').val(0);return; }
	if (vpgnoa=='0') { $('#pg0121').val('0');$('#pg012').val(0);return; }
	var numa = vprice/vpgnoa;
	    numa = numa.toFixed(3);
    $('#pg012').val(numa);
}
function pricei(pgnoa,vprice){
	var vpgnoa = pgnoa.value;
	if (vpgnoa=='') { $('#pg0141').val('0');$('#pg014').val(0);return; }
	if (vpgnoa=='0') { $('#pg0141').val('0');$('#pg014').val(0);return; }
	var numa = vprice/vpgnoa;
	    numa = numa.toFixed(3);
    $('#pg014').val(numa);
}

</script>


