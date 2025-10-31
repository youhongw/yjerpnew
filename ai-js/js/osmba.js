
$("#ba001").change(function() {
    var valx = $(this).val();
    
    $("span[keyid='ba001']").each(function() {
        
        $(this).html(valx);
    });
});

$("#ba004").change(function() {
    var valx = $(this).val();
    
    $("span[keyid='ba004']").each(function() {
        
        $(this).html(valx);
    });
});
