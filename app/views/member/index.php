<!-- 会员中心 -->

<?php $this->load->view('common/header_up');?>
<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/member.css">
<script type="text/javascript">
	$(document).ready(function() {
		
		// 加载更多课程
		$('.load-more').click(function(){
			$(this).children('span').text('玩命加载中...');
			var start = $('.join li').length;
			$.getJSON("<?php echo base_url('member/loadMoreCouser')?>", {start: start}, function(json){
				if (json == '') {
					$('.load-more span').text('哎呀，木有了');
					return;
				}
				for( var i in json){
					var html = '<li>\
								<a href=' + "<?php echo base_url('course/info');?>" + '/' +json[i].id+'\
								target="_blank">' + json[i].title + '</a>\
								<span class="number">'+ json[i].join_num +'人参与</span>\
								<span class="r">';
					if(json[i].yourScore){
						html += '已评：'+ json[i].yourScore +'分';
					}
					html+= '&nbsp; &nbsp;&nbsp; &nbsp;\
								参与日期：'+ getDate(json[i].time) +'</span>\
							</li>';

					$('.join').append(html);
				}

				$('.load-more span').text('加载更多');
			});
		});


		// 加载更多课程
		$('.load-more-comment').click(function(){
			$(this).children('span').text('玩命加载中...');
			var start = $('.comment li').length;
			$.getJSON("<?php echo base_url('member/loadMoreComment')?>", {start: start}, function(json){
				if (json == '') {
					$('.load-more-comment span').text('哎呀，木有了');
					return;
				}

				for( var i in json){
					var html ='<li>\
						<span class="comment-text">'+json[i].text+'</span>\
						<span class="right">评论课程：\
						<a href="'+"<?php echo base_url('course/info');?>"+'/'+json[i].cid+'" target="_blank" style="font-size: 12px;">'+json[i].title+'</a>\
							&nbsp;&nbsp;\
							评论日期：'+getDate(json[i].time)+'</span>\
						</li>';
					$('.comment').append(html);
				}

				$('.load-more-comment span').text('加载更多');

			});
		});

		// 显示密码输入框
		$('.user a').click(function(){
			$(this).hide();
			$(this).siblings('input').slideDown('fast');
		});

		// 修改密码
		$('.user input[type=password]').blur(function(){
			var pwd = $(this).val();

			if(checkPwd(pwd)){
				$.post("<?php echo base_url('user/resetPwd')?>", {pwd: pwd}, function(data){
					if (data) {
						$('.user input').fadeOut('slow',function(){
							$('.user a').fadeIn('slow');
						});						
					}
					else{
						alert('修改失败');
					}
				});
			}
			else{
				alert('密码长度8到15位');
			}
			
		});


		// 添加课程名
		$('#add-course').click(function(){
			$(this).hide();
			$(this).siblings('input').slideDown('fast');
		});

		// 失去焦点时自动提交
		$('#course-name').blur(function(){
			var title = $(this).val();
			if (title == ''){
				alert('标题不能为空');
				return ;
			}
			$.post("<?php echo base_url('member/addCourse')?>", {title: title}, function(data){
				if (data) {
					$('#course-name').fadeOut('slow',function(){
						$('#add-course').fadeIn('slow',function(){
							// 重载页面
							location.reload();
						});
					});						
				}
				else{
					alert('添加失败');
				}
			});
		})

		//  删除课程
		$(".delete").click(function(){
			var cid = $(this).data('id');
			$.post("<?php echo base_url('member/delCourse')?>", {cid: cid}, function(data){
				if (data){
					alert("删除成功");
					// 重载页面
					location.reload();
				}
				else{
					alert("删除失败");
				}
			});

		});


		// 加载更多所属课程
		$('.load-more-belong').click(function(){
			
			$(this).children('span').text('玩命加载中...');
			var start = $('.belong-course li').length;

			$.getJSON("<?php echo base_url('member/loadMoreBelongCouser')?>", {start: start}, function(json){
				if (json == '') {
					$('.load-more-belong span').text('哎呀，木有了');
					return;
				}
				for( var i in json){
					var html = '<li>\
								<a href=' + "<?php echo base_url('course/info');?>" + '/' +json[i].id+'\
								target="_blank">' + json[i].title + '</a>\
								<a  class="edit" style="color:#1caaea;"\
								href="'+'<?php echo base_url("member/edit");?>/'+json[i].id+'">编辑</a>\
								<span class="number">'+ json[i].join_num +'人参与</span>\
								<span class="r">';
					html+= '上传日期：'+ getDate(json[i].time) +'</span>\
								<span class="get-score">收获评分：'+
								parseInt((json[i].score/json[i].score_num)*100)/100
								+'</span>\
							</li>';

					$('.belong-course').append(html);
				}

				$('.load-more-belong span').text('加载更多');
			});
		});



	});


</script>

<?php $this->load->view('common/header_down');?>

<!-- 修改用户名和密码 -->
<div class="user">
	<a href="javascript:;">修改密码</a>
	<input type="password" placeholder='请输入新密码'>
</div>

<!-- 参与课程列表 -->
<div class="course-list">
	<p>最近参与</p>
	<ul class="join">
		<?php foreach ($recentCourse as $val): ?>
			<li>
				<a href="<?php echo base_url('course/info').'/'.$val['id'];?>" target='_blank'>
					<?=$val['title']?>
				</a>
				<span class="number"><?=$val['join_num']?>人参与</span>
				<span class="r">
					<?php if (isset($val['yourScore'])){?>
						已评：<?=$val['yourScore']?>分 &nbsp; &nbsp;&nbsp; &nbsp; 
					<?php } ?>
					参与日期：
					<?php echo date('Y-m-d H:i:s',$val['time']);?>
				</span>
			</li>
		<?php endforeach ?>
	</ul>
	<a href="javascript:;" class="load-more"><span>加载更多</span></a>
</div>

<!-- 点评列表 -->
<div class="course-list">
	<p>最近点评</p>
	<ul class="comment">
		<?php foreach ($recentComment as $k => $v): ?>
		<li>
			<span class="comment-text"><?=$v['text']?></span>
			<span class="right">
				评论课程：
				<a href="<?php echo base_url('course/info').'/'.$v['cid']?>" target="_blank" style="font-size: 12px;">
					<?=$v['title']?>
				</a>
				&nbsp;&nbsp;
				评论日期：<?=date('Y-m-d H:i:s',$v['time'])?>
			</span>
		</li>
		<?php endforeach ?>
	</ul>
	<a href="javascript:;" class="load-more-comment"><span>加载更多</span></a>
</div>


<!-- 所属课程列表 -->
<div class="course-list">
	<p>贡献课程
		<a id="add-course" href="javascript:;"><span style="float: right;color:#1caaea">新增课程</span></a>
		<input type="text" id="course-name" placeholder='请输入课程名' style="float: right;width: 250px;padding: 5px;display: none">
	</p>
	<ul class="belong-course">
		<?php foreach ($belongCourse as $val): ?>
			<li>
				<a href="<?php echo base_url('course/info').'/'.$val['id'];?>" target='_blank'>
					<?=$val['title']?>
				</a>
				<a class="edit" style="color:#1caaea;" href="<?php echo base_url('member/edit').'/'.$val['id'];?>">编辑</a>
				<a class="delete" data-id="<?=$val['id']?>" href="javascript:;" style="color:#1caaea;margin-left: 15px;">删除</a>
				<span class="number"><?=$val['join_num']?>人参与</span>
				<span class="r">
					上传日期：
					<?php echo date('Y-m-d H:i:s',$val['time']);?>
				</span>
				<span class="get-score">
					收获评分：
					<?php if ($val['score_num']): ?>
						<?php echo sprintf('%.2f',$val['score']/$val['score_num'])?>
					<?php else:?>
						无
					<?php endif ?>
				</span>
			</li>
		<?php endforeach ?>
	</ul>
	<a href="javascript:;" class="load-more-belong"><span>加载更多</span></a>
</div>
<!-- end -->


<?php $this->load->view('common/footer');?>