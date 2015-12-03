/*
**	 课程图片鼠标事件
 */
$(document).ready(function(){
		$('.intro img').on({
			mouseover:function(){
				$(this).siblings('div').show();
				$(this).siblings('p').show('fast',function(){
					$(this).animate({'padding-left':'20px'},400);
				});
			}
		});

		$('.intro>p').on({
			mouseout:function(){
				$(this).animate({'padding-left': 0},400,function(){
					$(this).hide('fast');
					$(this).siblings('div').hide();
				});
			}
		});


});