//顯示div
var pos = 0;
function swdv(k)
{
	//顯示div
	document.getElementById('mdv'+k).style.display = 'block';
	document.getElementById('mdv'+pos).style.display = 'none';
	//改td背景色
	if (k >= 1) document.getElementById('mtd'+k).style.background = '#F39';
	if (pos >= 1) document.getElementById('mtd'+pos).style.background = '#999';
	
	pos = k;
}

function swpointer(k)
{
	document.getElementById('mtd'+k).style.cursor = 'pointer';
	if (k != pos) document.getElementById('mtd'+k).style.background = '#F39';
}

function hipointer(k)
{
	document.getElementById('mtd'+k).style.cursor = 'pointer';
	if (k != pos) document.getElementById('mtd'+k).style.background = '#999';
}

if (document.getElementById('getbt'))
var b = document.getElementById('getbt').value;

if (b)
{
	swdv(b);
}