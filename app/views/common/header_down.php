<?php
/*
**	项目模板公用header文件 下
*/
?>

</head>
<body>
	<!--  login register -->
	<div class="black-bg">
	</div>
	<div class="login">
		<div class="login-header">
		    <h1>
				<span class="active-title">登录</span>
				<span>注册</span>
		    </h1>
		    <button type="button" class="rl-close" data-dismiss="modal" hidefocus="true" aria-hidden="true"></button>
		</div>
		<div class="login-body">
			<div class="login-body-content">

				<form class="login-form">
					<input type="text" value="" name="username" autocomplete="off" class="username" placeholder="请输入邮箱">
					<input type="password" value="" name="password" autocomplete="off" class="username password" placeholder="请输入密码">
					<label for="auto-signin" class="autoin" hidefocus="true">
						<input type="checkbox" checked="checked" class="auto-cbx" id="auto-signin" name="autoin" value="1">五天内自动登录
					</label>
					<a href="/user/newforgot" class="forget" target="_blank" hidefocus="true">忘记密码</a>
					<p class="msg-log msg"></p>
					<input type="button" value="登录" hidefocus="true" class="btn-log btn-yellow">
				</form>

				<form class="reg-form" style="display: none">
					<input type="text" value="" name="uname" autocomplete="off" class="username" placeholder="请输入邮箱">
					<input type="password" value="" name="pwd" autocomplete="off" class="username password" placeholder="请输入密码" style="margin-bottom: 0px;">
					<input type="password" value="" name="pwd2" autocomplete="off" class="username password" placeholder="请再次输入密码" style="margin-bottom: 0px;">
					<input type="number" value="" name="checkcode" autocomplete="off" class="username password" placeholder="请输入验证码" style="margin-bottom: 0px;width:155px;">
					<div class="div-code">
						<a href="javascript:;" class="checkcode">获取验证码</a>
						<div class="cover"></div>
					</div>
					<p class="msg-reg msg"></p>
					<input type="button" value="注册" hidefocus="true" class="btn-reg btn-yellow">
				</form>

			</div>
		</div>
	</div>
	<!-- end -->

	<!-- header start -->
	<div class="head">
		<div class="header">
			<div class="logo">
				<a href="<? echo base_url(); ?>">
					<img src="<? echo base_url(); ?>static/img/logo.png">
				</a>
				<a href="<? echo base_url(); ?>">
					<span class="web-name">转课网</span>
				</a>
			</div>
			<div class="search">
				<form action='<? echo base_url(); ?>/search' method="GET" role="search">
					<div class="form-group">
						<input class="form-control" type="text" maxlength="30" placeholder="搜你所想，30字之内 :)" name="word">
	                </div>
	                <button class="btn-search" type="submit">搜索</button>
	        	</form>
			</div>
			<div class="log-reg">
				<p>
					<?php if (isset($_SESSION['uid'])){ ?>
						<span class="display" style="display:none">登录</span>
						<span class="display" style="display:none">注册</span>
						<a href="#" class="userinfo" style="color: #518FDC;"><?=$_SESSION['username']?></a>
						<span class="logout">退出</span>
					<?php }else{?>
						<span class="display">登录</span>
						<span class="display">注册</span>
						<a href="#" class="userinfo" style="display:none;color: #518FDC;"></a>
						<span class="logout" style="display:none">退出</span>
					<?php }?>
				</p>
			</div>
		</div>
	</div>
	<!-- end -->

	<!-- nav start -->
	<div class="nav">
		<ul>
			<li><a href="<? echo base_url(); ?>">首页</a></li>
			<li><a href="<? echo base_url(); ?>course">课程</a></li>
			<li><a href="<? echo base_url(); ?>exam">测验</a></li>
			<li><a href="<? echo base_url(); ?>community">社区</a></li>
		</ul>
	</div>
	<!-- end -->