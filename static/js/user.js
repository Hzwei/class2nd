$(document).ready(function(){

	/*	显示登录注册窗口 , 激活相关窗口	*/
	$('.log-reg p span.display').on('click',function(){
		// console.log($(this).index());
		$('.black-bg').show();
		$('.login').show();
		switch($(this).index()){
			case 0:
				$('.login-header h1 span').eq(0).addClass('active-title');
				$('.login-header h1 span').eq(1).removeClass();
				$('.login-form').show();
				$('.reg-form').hide();
				break;
			case 1:
				$('.login-header h1 span').eq(0).removeClass();
				$('.login-header h1 span').eq(1).addClass('active-title');
				$('.login-form').hide();
				$('.reg-form').show();
				break;
			default:
				break;
		}
	});

	/* 隐藏窗口 */
	$('.rl-close').on({
		'click':function(){
			$('.black-bg').hide();
			$('.login').hide();
		},
		'mouseover':function(){
			$(this).css('background-position', '0 -20px');
		},
		'mouseout':function(){
			$(this).css('background-position', '0 0');
		}
	});
	$('.black-bg').on('click',function(){
		$('.black-bg').hide();
		$('.login').hide();
	});

	/* 切换登录注册表单 */
	$('.login-header h1 span:eq(0)').on('click',function(){
		$('.login-form').show();
		$('.reg-form').hide();
		$(this).addClass('active-title');
		$(this).siblings().removeClass();
	});
	$('.login-header h1 span:eq(1)').on('click',function(){
		$('.login-form').hide();
		$('.reg-form').show();
		$(this).addClass('active-title');
		$(this).siblings().removeClass();
	});

	/* form login */
	$('.btn-log').on('click',function(){
		var email = $('input[name=username]').val();
		var password = $('input[name=password]').val();
		var autoin = 0;		//下次自动登录标示
		if ($('input[name=autoin]:checked').val()){
			autoin = 1;
		}		

		if(email == '' || password == ''){
			$('.msg-log').text('请输入用户名和密码').show();
			return;
		}
		if(!checkEmail(email)){
			$('.msg-log').text('邮箱格式不符').show();
			return;	
		}
		if(!checkPwd(password)){
			$('.msg-log').text('密码为8到15位').show();
			return;	
		}

		$.post(baseUrl+'user/login',{email:email,password:password,autoin:autoin},function(data){
			if(data.status == 'false'){
				$('.msg-log').text('用户名或密码错误').show();	// 失败信息
			}
			if (data.status == 'success'){
				$('.black-bg').hide();
				$('.login').hide();
				$('.display').hide();
				$('.userinfo').show().text(data.info.username);
				$('.logout').show();
			}

		},'json');

	});

	/* 用户注销 */
	$('.logout').on('click',function(){
		$.post(baseUrl+'user/logout',function(data){
			if(data == 0){
				alert('退出失败!');
				return;
			}
			if(data == 1){
				alert("退出成功");
				$('.display').show();
				$('.userinfo').hide();
				$('.logout').hide();
				return;
			}
		});
	});


	/* 发送验证码 */
	$('.checkcode').on('click',function(){
		var email = $('input[name=uname]').val();
		// 验证邮箱
		if (checkEmail(email)){
			$.post(baseUrl+'user/sendEmail', {email: email}, function(data){

				if(data.status == 'success'){

					$('.msg-reg').text('验证码已发送至邮箱，请去邮箱查收').show();

					/* 开启倒计时 */
					$('.cover').text('90s').show();
					$(this).hide();

					var timer = setInterval(function(){
						var current = parseInt($('.cover').text());
						if(current == 0){
							clearInterval(timer);
							$('.checkcode').text('获取验证码').show();
							$('.cover').hide();
						}
						else{
							$('.cover').text(--current + 's');
						}
					},1000);
					/* end */
				}
				else{
					$('.msg-reg').text(data.message).show();
				}
			},'json');
		}
		else{
			$('.msg-reg').text('邮箱格式不正确').show();
		}

	});


	/* form register */
	$('.btn-reg').on('click',function(){
		var uname = $('input[name=uname]').val();
		var pwd = $('input[name=pwd]').val();
		var pwd2 = $('input[name=pwd2]').val();
		var checkcode = $('input[name=checkcode]').val();

		// 前端验证
		if(!checkEmail(uname)){
			$('.msg-reg').text('邮箱格式不正确').show();
			return;
		}
		if(!checkPwd(pwd)){
			$('.msg-reg').text('密码需8到15位').show();
			return;
		}
		if (pwd != pwd2){
			$('.msg-reg').text('两次密码不匹配').show();
			return;
		}
		if(!checkCode(checkcode)){
			$('.msg-reg').text('验证码不正确').show();
			return;
		}

		// 请求
		$.post(baseUrl+'user/register',{email:uname,password:pwd,code:checkcode},function(data){
			if (data.status == 'false'){
				$('.msg-reg').text(data.message).show();
				return;
			}
			if(data.status == 'success'){
				$('.login-form').show();
				$('.reg-form').hide();
				$('.login-header h1 span:eq(0)').addClass('active-title');
				$('.login-header h1 span:eq(1)').removeClass();
				$('.msg-log').text('注册成功请直接登录').show();
			}
		},'json');

	})



});