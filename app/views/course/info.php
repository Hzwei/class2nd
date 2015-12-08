<!-- 课程模板 -->
<?php $this->load->view('common/header_up');?>

<?php 
$control = $this->uri->segment(1);
$cid = $this->uri->segment(3);
?>

<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/course_list.css">
<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/course_info.css">
<!-- 课程鼠标事件 -->
<script type="text/javascript" src="<? echo base_url(); ?>static/js/course_mouse.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		// 加载更多
		$('.more a').click(function(){
			$(this).text('玩命加载中...');
			
			var start = $('.comment ul li').length;

			$.post("<?php echo base_url().$control.'/loadComment'?>", {cid:"<?=$cid?>",start: start}, function(data){
				if (data == ''){
					$(".more a").text('哎呀，木有了...');
				}
				else{
					for(var i in data){
						var html ='<li>\
							<p class="content">'+data[i].text+'</p>\
							<p class="author">'+ data[i].username +'\
								<span>'+ getDate(data[i].time) +'</span>\
							</p>\
						</li>';

						$('.comment ul').append(html);
					}

					$(".more a").text('加载更多');
				}
			},'json');

		});


		// 加入课程
		$('.join a').click(function(){

			$.post("<?php echo base_url().$control.'/joinCourse'?>", {cid:"<?=$cid?>"}, function(status){
				if (parseInt(status) == 1){
					$('.join').html('已加入');
					var joinNum = parseInt($('.number').text()) + 1;
					$('.number').text(joinNum+'人参加');
				}
				else{
					alert('加入失败，请重试！');
				}
			});

		});

		// 评分
		$('.give-score input[type=button]').click(function(){
			var score = parseInt($(this).siblings("input[type=text]").val());
			if (score>=1 && score <=10){
				$.post("<?php echo base_url().$control.'/giveScore'?>", {cid:"<?=$cid?>",score:score}, function(data){
					if (data){
						alert("评分成功");
					}
				});

			}
			else{
				alert('请填1到10的整数');
			}
		});

		// 评论
		$('.your_comment button').click(function(event){
			var comment = $(this).siblings('textarea').val();

			if (comment == '') {
				alert("请填写评论");
			}
			else{
				$.post("<?php echo base_url().$control.'/giveComment'?>", {cid:"<?=$cid?>",comment:comment}, function(data){
					if (data){
						alert('评论成功');
					}
					else{
						alert('评论失败');
					}
				});
			}
		});


	});
</script>

<?php $this->load->view('common/header_down');?>

<!-- 第一块区域 -->
<div class="head-info">
	<div class="head-info-left">
		<p class="course-title">
			<a href="<?php echo base_url().$control.'/index/'.$cateInfo['id'].'/hot'?>">
				<span><?=$cateInfo['name']?></span>
			</a>
			<span style="color:red">&nbsp; > &nbsp;</span>
			<?=$courseInfo['title']?>
		</p>
		<p class="course-desc"><?=$courseInfo['desc']?></p>
	</div>
	<div class="head-info-right">
		<img src="<? echo base_url(); ?>upload/img/<?=$courseInfo['img']?>">
	</div>
</div>
<!-- end -->

<!-- 第二块评分和参与情况 -->
<div class="more-info">
	<p class="course-info">
		<span class="score">评分：<?php echo sprintf("%.2f",$courseInfo['score']/$courseInfo['score_num']);?></span>
		<span class="number"><?=$courseInfo['join_num']?>人参加</span>
		<span class="time">入库日期：
			<?php 
				echo date('Y-m-d H:i:s',$courseInfo['time']);
			?>
		</span>
		
		<!-- 加入课程	 -->
		<?php if (isset($_SESSION['uid'])){ ?>
			<?php if ($joinStatus == 0){ ?>
				<span class="join"><a href="javascript:;">立即加入</a></span>
			<?php }else{?>
				<span class="join">已加入</span>
			<?php }?>
		<?php }?>
		
		<!-- 评分 -->
		<?php if ($score == -1){?>
			<span class="give-score">
				给个分吧(1~10)
				<input type="text"></input>
				<input type="button" value="点我">
			</span>
		<?php }?>
		<?php if ($score > 0){?>
			<span class="give-score">
				已评 <?=$score?> 分
			</span>	
		<?php }?>

	</p>
</div>
<!-- end -->

<!-- 视频列表 -->
<div class="videolist">
	<ul>
		<?php foreach ($videoList as $val): ?>
			<li>
				<a href="<?php echo base_url().$control.'/video/'.$val['id']; ?>">
					<?=$val['sort'].'. '.$val['title']?>
				</a>
				<span><?php echo date('Y-m-d H:i:s',$val['time']);?></span>
			</li>
		<?php endforeach ?>
	</ul>
</div>
<!-- end -->

<!-- 课程点评 -->
<p class="course_comment">课程点评</p>

<div class="comment">
	<ul>
		<?php foreach ($comment as $val){?>
			<li>
				<p class="content"><?=$val['text']?></p>
				<p class="author"><?=$val['username']?>
					<span><?php echo date("Y-m-d H:i:s",$val['time']);?></span>
				</p>
			</li>
		<?php }?>
	</ul>
	<p class="more"><a href="javascript:;">加载更多</a></p>
</div>
<!-- end -->

<!-- 点评 -->
<p class="course_comment">不点评吗？</p>
<div class="your_comment">
	<?php if (isset($_SESSION['uid'])){ ?>
		
		<?php if ($joinStatus){?>

			<?php if(empty($myComment)){ ?>
				<textarea placeholder="留个评论吧，300字之内"></textarea><br>
				<button>提交</button>
			<?php }else{?>
				<p><?=$myComment['text']?></p>
				<p>您评论于 <?php echo date("Y-m-d H:i:s",$myComment['time']);?></p>
			<?php }?>

		<?php }else{?>
			<p>请先加入该课程</p>
		<?php }?>

	<?php }else{?>
		<p>请先前往右上角登录</p>


	<?php }?>

</div>
<!-- end -->


<!-- 相关推荐 -->
<div class="push" style="margin-bottom: 20px;">
	<p>相关推荐</p>
	<ul class="push-list">
		<?php foreach ($courseList as $k=>$val){ ?>
			<li <?php if(($k+1)%4 == 0){echo ' style="margin-right: 0" ';} ?> >
				<a href="<?php echo base_url().$control.'/info/'.$val['id']?>" class="intro">
					<img src="<? echo base_url(); ?>upload/img/<?=$val['img']?>">
					<div></div>
					<p>
						<?php echo mb_substr($val['desc'],0,35,'utf-8');?>
					</p>
				</a>
				<a href="<?php echo base_url().$control.'/info/'.$val['id']?>"><span><?=$val['title']?></span></a>
				<p class="course-info">
					<span class="score">评分:
						<?php echo sprintf("%.2f",$val['score']/$val['score_num']);?>
					</span>
					<span class="number"><?=$val['join_num']?>人参加</span>
				</p>
			</li>
		<?php }?>
	</ul>
</div>
<!-- end -->

<?php $this->load->view('common/footer');?>