<!-- 未登出, 直接離開  1050419 -->
<script>
    $(document).mousemove(function(e) {});
    $(document).mouseleave(function(e) {
        $('#debug').html('leave')
        window.onbeforeunload = function() {
            window.onunload = function() {
                alert('bye')
            }
            return '';
            // return '您確定已登出,要離開此系統嗎？';
        }
    });
    $(document).mouseenter(function(e) {
        $('#debug').html('enter')
        window.onbeforeunload = null
        window.onunload = null
    });

    //-->
</script>
<div id="footercontainer">
    <center>Design by 個人電腦,筆電,平板,手機四合一雲端ERP &copy; 2022 Project 　<a href="mailto:mis3@dersheng.com.tw?subject=陽江外掛ERP　問題">寄出問答 Email</a>
        <center>
</div>