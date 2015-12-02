<!-- 
	项目模板公用header文件 下
-->

</head>
<body>
	<!-- header start -->
	<div class="header">
		<div class="logo">
			<a href="<? echo base_url(); ?>">
				<img src="<? echo base_url(); ?>static/img/logo.png">
			</a>
			<span class="web-name">
				转课网
			</span>
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
				<span>注册</span>
				<span>登录</span>
			</p>
		</div>
	</div>
	<!-- end -->

	<!-- nav start -->
	<div class="nav">
		<ul>
			<li><a href="<? echo base_url(); ?>">首页</a></li>
			<li><a href="<? echo base_url(); ?>course">课程</a></li>
			<li><a href="<? echo base_url(); ?>speech">演讲</a></li>
			<li><a href="<? echo base_url(); ?>exam">测验</a></li>
			<li><a href="<? echo base_url(); ?>community">社区</a></li>
		</ul>
	</div>
	<!-- end -->