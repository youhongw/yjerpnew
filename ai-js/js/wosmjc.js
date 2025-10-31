
$("select[id='jc013']").change(function() {
    var text1 = $(this).find("option:selected").text();
    var keyid1 = $(this).attr("keyid");
    
    if($(this).val() !== "0"){
        // console.log($(this).find("option:selected").text());
        // console.log($(this).attr("keyid"));
        $("input[keyid='jc014_"+keyid1+"']").val(text1.split("_")[1]).change();
    }else{
        $("input[keyid='jc014_"+keyid1+"']").val("").change();
    }
});