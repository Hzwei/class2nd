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


	});
</script>

<?php $this->load->view('common/header_down');?>

<div class="head-info">
	<div class="head-info-left">
		<p class="course-title"><?=$courseInfo['title']?></p>
		<p class="course-desc"><?=$courseInfo['desc']?></p>
	</div>
	<div class="head-info-right">
		<img src="<? echo base_url(); ?>upload/img/<?=$courseInfo['img']?>">
	</div>
</div>

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

<div class="videolist">
	<ul>
		<li><a href="#">视频1</a></li>
		<li><a href="#">视频2</a></li>
		<li><a href="#">视频3</a></li>
		<li><a href="#">视频4</a></li>
		<li><a href="#">视频5</a></li>
		<li><a href="#">视频6</a></li>
	</ul>
</div>

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

<?php $this->load->view('common/footer');?>