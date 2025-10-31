/**
 * 后端脚本
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
$(function (){
	// 公共
	$('input[title], textarea[title], .prompt_title[title]').tooltip({position : {my:'left+8 center'}});
	$('input[type=submit], input[type=reset]').button();
	$('.input_radio_container').buttonset();
	$('#tabs').show().tabs();
	$(window).resize(function (){
		// 后台登录页
		$('#login_body').css({'width':$(window).width(), 'height':$(window).height()});
		$('#login_container').css({'left':($(window).width() - $('#login_container').width()) / 2});
		
		// 后台首页
		$('#hcb_left, #hcb_right').css({'height':$(window).height() - 97});
		$('#hch_right, #hcb_right, #hcf_right').css({'width':$(window).width() - 223});
	});
	$(window).resize();
	
	// 后台登录页
	$('#login_container').draggable({containment:'#login_body', scroll:false, handle:'#lc_title'});
	
	// 后台首页
	if($('#local_time').length > 0)
	{
		window.setInterval('get_time()', 1000);
	}
	$('.power_list').accordion({heightStyle:'content', collapsible:true});
	
	// 后台表单验证
	$('#lc_form').submit(function (){
		if(!$('#username').val()){$('#username').focus(); return false;}
		if(!$('#password').val()){$('#password').focus(); return false;}
	});
	$('#power_form').submit(function (){
		$('#power_name, #power_url, #power_site_prompt, #power_target_prompt, #power_ico').blur();
		var select_length = $('select[name="pid[]"]').length;
		if(select_length > 3){show_dialog('选择的上级权限不能超过两项'); return false;}
		if(!$('#power_name').val()){$('#power_name').focus(); return false;}
		if((select_length == 3 && $('#power_url').val() == 'default') || (select_length != 3 && $('#power_url').val() != 'default')){$('#power_url').focus(); return false;}
		if((select_length == 1 && $('input[name="power_site"]:checked').val() == 1) || (select_length != 1 && $('input[name="power_site"]:checked').val() != 1)){$('#power_site_prompt').focus(); return false;}
		if((select_length == 3 && $('input[name="power_target"]:checked').val() == 1) || (select_length != 3 && $('input[name="power_target"]:checked').val() != 1)){$('#power_target_prompt').focus(); return false;}
		if(select_length != 1 && $('#power_ico').val()){$('#power_ico').focus(); return false;}
	});
	$('#group_power_form').submit(function (){
		if(!$('#group_name').val()){$('#group_name').focus(); return false;}
		if($('input[name="power_ids[]"]:checked').length == 0){show_dialog('请选择一项权限'); return false;}
	});
	$('#admin_form').submit(function (){
		if(!$('#username').val()){$('#username').focus(); return false;}
		if(!$('#password').val()){$('#password').focus(); return false;}
		if(!$('#power_group_id').val()){show_dialog('请选择所属权限组'); return false;}
	});
	$('#pwd_form').submit(function (){
		if(!$('#old_password').val()){$('#old_password').focus(); return false;}
		if(!$('#password').val()){$('#password').focus(); return false;}
		if($('#check_password').val() != $('#password').val()){$('#check_password').focus(); return false;}
	});
});

// 获取当前时间
function get_time()
{
	var date = new Date();
	$('#local_time').html(date.toLocaleString());
}

// 导航选中
function nav_in(obj)
{
	$('.pl_nav a').removeClass('nav_in');
	$(obj).addClass('nav_in');
	return true;
}

// 菜单切换
function nav_show(obj, num)
{
	$('#hch_right a').removeClass('top_nav_in');
	$(obj).addClass('top_nav_in');
	$('.power_list').hide();
	$('#power_list_' + num).show();
}

// 对话框调用
function show_dialog(content, type, action_url, action_obj)
{
	type = typeof(type) == 'undefined' ? '' : type;
	action_url = typeof(action_url) == 'undefined' ? '' : action_url;
	action_obj = typeof(action_obj) == 'undefined' ? '' : action_obj;
	var options = {
		title     : '提示信息',
		minHeight : 0,
		resizable : false,
		show      : 'clip',
		hide      : 'clip'
	};
	switch(type)
	{
		case 'del':
			options.buttons = {
                '删除' : function (){
                    if(action_url)
					{
						$(this).dialog('destroy');
						$.get(action_url, function (msg){
							if(msg == 1)
							{
								show_dialog('删除成功');
								$('#' + action_obj).fadeOut(2000, function (){$(this).remove();});
							} else {
								show_dialog('删除失败或未找到记录');
							}
						});
					}
                },
                '取消' : function (){
                    $(this).dialog('close');
                }
            }
		break;
	}
	$('#submit_info').html(content).dialog(options);
	if(type != 'del')
	{
		setTimeout(function (){$('#submit_info').dialog('close')}, 3000);
	}
}

// 无级分类事件触发
function cate_initialize(cate_container_name, img_storage_path)
{
	$('.' + cate_container_name + ' a').click(function (){
		var obj_img = $(this).find('img');
		var img_name = obj_img.attr('src').replace(img_storage_path, '');
		var this_padding_left = parseInt($(this).parent('.' + cate_container_name).css('padding-left'));
		var child_plus = new Array();
		$(this).parents('tr').nextAll().each(function (){
			if(parseInt($(this).find('.' + cate_container_name).eq(0).css('padding-left')) > this_padding_left)
			{
				var new_img_name = '';
				if(img_name.indexOf('plus') != -1)
				{
					new_img_name = img_name.replace('plus', 'minus');
					var obj_a_img = $(this).find('.' + cate_container_name).eq(0).find('a img');
					if(obj_a_img.length > 0 && obj_a_img.attr('src').replace(img_storage_path, '').indexOf('plus') != -1)
					{
						obj_a_img.attr('src', obj_a_img.attr('src').replace('plus', 'minus'));
						child_plus[child_plus.length] = $(this).find('.' + cate_container_name).eq(0).find('a');
					}
					$(this).show();
				} else if(img_name.indexOf('minus') != -1) {
					new_img_name = img_name.replace('minus', 'plus');
					$(this).hide();
				}
				obj_img.attr('src', img_storage_path + new_img_name);
				return true;
			} else {
				return false;
			}
		});
		$(child_plus).each(function (i, n){
			this.click();
		});
	});
}

// 单选默认选中
function radio_select(name, value)
{
	$('input[name="' + name + '"]').each(function (){
		if($(this).val() == value)
		{
			$(this).attr('checked', true);
			return false;
		}
	});
}

// 权限组中权限的点击
function power_click(obj_this, n)
{
	if($(obj_this).attr('checked'))
	{
		$('#dj_' + n + ' input').removeAttr('disabled');
		$('#dj_' + n + ' span input').attr('disabled', true);
	} else {
		$('#dj_' + n + ' input').attr('disabled', true).removeAttr('checked').click();
	}
}

// 权限组默认选中权限
function default_sel(ids_str)
{
	var power_sel = ids_str.split(',');
	$(power_sel).each(function (){
		var sel_val = this;
		$('input[name="power_ids[]"]').each(function (){
			if($(this).val() == sel_val)
			{
				$(this).attr('checked', true);
				$('#dj_' + $(this).val() + ' input').removeAttr('disabled');
				$('#dj_' + $(this).val() + ' span input').attr('disabled', true);
				return false;
			}
		});
	});
}