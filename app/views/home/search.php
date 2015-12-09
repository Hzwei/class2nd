<?php $this->load->view('common/header_up');?>

<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/course_list.css">
<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/search.css">
<script type="text/javascript" src="<? echo base_url(); ?>static/js/course_mouse.js"></script>

<?php $this->load->view('common/header_down');?>

<div class="result">
	<p class="title">搜索 "<?=$word?>" 的相关结果</p>
	<div class="push">
		<p>课程：</p>
		<ul class="push-list">
			<?php foreach ($courseList as $k=>$val){ ?>
			<li <?php if(($k+1)%4 == 0){echo ' style="margin-right: 0" ';} ?> >
				<a href="<?php echo base_url().'course/info/'.$val['id']?>" class="intro">
					<img src="<? echo base_url(); ?>upload/img/<?=$val['img']?>">
					<div></div>
					<p>
						<?php echo mb_substr($val['desc'],0,35,'utf-8');?>
					</p>
				</a>
				<a href="<?php echo base_url().'course/info/'.$val['id']?>"><span><?=$val['title']?></span></a>
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

	<!-- 视频列表 -->
	<p class="video-title">视频：</p>
	<div class="videolist">
		<ul>
			<?php foreach ($videoList as $val): ?>
				<li>
					<a href="<?php echo base_url().'course/video/'.$val['id']; ?>">
						<?=$val['sort'].'. '.$val['title']?>
					</a>
					<span><?php echo date('Y-m-d H:i:s',$val['time']);?></span>
				</li>
			<?php endforeach ?>
		</ul>
	</div>
	<!-- end -->


</div>


<?php $this->load->view('common/footer');?>