$(function(){
		var $ad = $('#abgne_fade_pic a.ad'),
			showIndex = 0,			// 預設要先顯示那一張
			fadeOutSpeed = 8000,	// 淡出的速度2000
			fadeInSpeed = 12000,		// 淡入的速度3000
			defaultZ = 10,			// 預設的 z-index
			isHover = false,
			timer, speed = 9696000;	// 計時器及輪播切換的速度6000 48
		
		// 先把其它圖片的變成透明
		$ad.css({
			opacity: 0,
			zIndex: defaultZ - 1
		}).eq(showIndex).css({
			opacity: 1,
			zIndex: defaultZ
		});
		
		// 組出右下的按鈕
		var str = '';
		for(var i=0;i<$ad.length;i++){
			str += '<li><a href="#">' + (i + 1) + '</a></li>';
		}
		var $controlA = $('#abgne_fade_pic').append($('<div class="NUMBER">' + str + '</div>').css('zIndex', defaultZ + 1)).find('.NUMBER li a');

		// 當按鈕被點選時
		// 若要變成滑鼠滑入來切換時, 可以把 click 換成 mouseover
		$controlA.click(function(){
			// 取得目前點擊的號碼
			showIndex = $(this).text() * 1 - 1;
			
			// 顯示相對應的區域並把其它區域變成透明
			$ad.eq(showIndex).stop().fadeTo(fadeInSpeed, 1, function(){
				if(!isHover){
					// 啟動計時器
					timer = setTimeout(autoClick, speed);
				}
			}).css('zIndex', defaultZ).siblings('a').stop().fadeTo(fadeOutSpeed, 0).css('zIndex', defaultZ - 1);
			// 讓 a 加上 .on
			//$(this).addClass('on').siblings().removeClass('on');
			$(this).addClass('on').parent().siblings().children().removeClass('on');
			return false;
		}).focus(function(){
			$(this).blur();
		}).eq(showIndex).addClass('on');

		$ad.hover(function(){
			isHover = true;
			// 停止計時器
			clearTimeout(timer);
		}, function(){
			isHover = false;
			// 啟動計時器
			timer = setTimeout(autoClick, speed);
		})
		
		// 自動點擊下一個
		function autoClick(){
			if(isHover) return;
			showIndex = (showIndex + 1) % $controlA.length;
			$controlA.eq(showIndex).click();
		}
		
		// 啟動計時器
		timer = setTimeout(autoClick, speed);
	});


