
function showDiv(n)
{
    $('#b_'+n).hide();
    $('#d_'+n).show();
    alert(1);
}

function change_reportbutton(obj,data)
{
    changid=data;
    ajax_get('getreportbutton','key='+key+'&keyclass='+obj.value,showdata);
}
