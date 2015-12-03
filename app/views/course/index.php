<!-- 课程页模板 -->
<?php $this->load->view('common/header_up');?>

<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/course_list.css">
<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/course.css">

<!-- 课程鼠标事件 -->
<script type="text/javascript" src="<? echo base_url(); ?>static/js/course_mouse.js"></script>

<?php $this->load->view('common/header_down');?>

<?php
// 获取控制器
$control = $this->uri->segment(1);
?>

<!-- 分类 -->
<div class="category">
	<p class="left-word">类目:</p>
	<ul class="cate-info">
		<li><a <?php if($cateId == 0){echo 'style="color: #1caaea;"';}?> href="<?php echo base_url().$control.'/index/0/'.$order;?>">全部</a></li>
		<? foreach ($category as $val){?>
			<li>
				<a <?php if($cateId == $val['id']){echo 'style="color: #1caaea;"';}?> href="<?php echo base_url().$control.'/index/'.$val['id'].'/'.$order?>">
					<?=$val['name']?>
				</a>
			</li>
		<? }?>
	</ul>
</div>

<!-- 排序 -->
<div class="order-tab">
	<a href="<?php echo base_url().$control.'/index/'.$cateId.'/hot'?>" <?php if($order == 'hot'){echo 'style="color: #1caaea;"';}?> >
		热门课程
	</a>
	<a href="<?php echo base_url().$control.'/index/'.$cateId.'/top'?>" <?php if($order == 'top'){echo 'style="color: #1caaea;"';}?> >
		评分最高
	</a>
	<a href="<?php echo base_url().$control.'/index/'.$cateId.'/new'?>" <?php if($order == 'new'){echo 'style="color: #1caaea;"';}?> >
		最新课程
	</a>
</div>

<div class="push" style="min-height: 500px">
	<ul class="push-list" style="height:auto">
		<li>
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
		<li>
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
		<li>
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
		<li style="margin-right: 0">
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
		<li>
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
		<li>
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
		<li>
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
		<li style="margin-right: 0">
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
		<li>
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
		<li>
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
		<li>
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
		<li style="margin-right: 0">
			<a href="#" class="intro">
				<img src="<? echo base_url(); ?>upload/img/demo.jpg">
				<div></div>
				<p>物联网是非常重要也受到高度关注的议题，主要诉求是"物物联网"或是"万物联网"...</p>
			</a>
			<a href="#"><span>物联网概论</span></a>
			<p class="course-info">
				<span class="score">评分:9.0</span>
				<span class="number">1000人参加</span>
			</p>
		</li>
	</ul>
	
	<div class="load-more">
		<a href="javascript:;">加载更多</a>
	</div>

	<?php $this->load->view('common/footer');?>

</div>