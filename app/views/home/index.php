<!-- 网站首页模板 -->
<?php $this->load->view('common/header_up');?>

<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/slide.css">
<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/course_list.css">

<!-- jquery 动画插件 -->
<script type="text/javascript" src="<? echo base_url(); ?>static/js/jquery.easing.1.3.js"></script>
<!-- 课程鼠标事件 -->
<script type="text/javascript" src="<? echo base_url(); ?>static/js/course_mouse.js"></script>

<?php $this->load->view('common/header_down');?>

<!-- slide -->

<style type="text/css">
	/* ie6 png */
	.mypng img {
	azimuth: expression( this.pngSet?this.pngSet=true:(this.nodeName == "IMG" && this.src.toLowerCase().indexOf('.png')>-1?(this.runtimeStyle.backgroundImage = "none", this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.src + "', sizingMethod='image')", this.src = "transparent.gif"):(this.origBg = this.origBg? this.origBg :this.currentStyle.backgroundImage.toString().replace('url("', '').replace('")', ''), this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.origBg + "', sizingMethod='crop')", this.runtimeStyle.backgroundImage = "none")), this.pngSet=true);
	}
</style>

<div id="focusBar"> 
	<a href="javascript:void(0)" class="arrL" onclick="prePage()">&nbsp;</a>
	<a href="javascript:void(0)" class="arrR" onclick="nextPage()">&nbsp;</a>
	<ul class="mypng">
		<li id="focusIndex1" style="background:url(<? echo base_url(); ?>static/img/bg-line1.gif) repeat-x;">
			<div class="focusL"><a href="#"><img src="<? echo base_url(); ?>static/img/slide1.png" width="1000" height="644" /></a></div>
			<div class="focusR"><a href="#"><img src="<? echo base_url(); ?>static/img/slide2.png" width="1000" height="644" /></a></div>
		</li>
		<li id="focusIndex2">
			<div class="focusL"><a href="#"><img src="<? echo base_url(); ?>static/img/slide3.png" width="1000" height="644" /></a></div>
			<div class="focusR"><a href="#"><img src="<? echo base_url(); ?>static/img/slide2.png" width="1000" height="644" /></a></div>
		</li>
		<li id="focusIndex3" style="background:url(<? echo base_url(); ?>static/img/bg-line1.gif) repeat-x;">
			<div class="focusL"><a href="#"><img src="<? echo base_url(); ?>static/img/slide4.png" width="1000" height="644" /></a></div>
			<div class="focusR"><a href="#"><img src="<? echo base_url(); ?>static/img/slide5.png" width="1000" height="644" /></a></div>
		</li>
		<li id="focusIndex4" style="background:url(<? echo base_url(); ?>static/img/bg-line2.gif) repeat-x;">
			<div class="focusL"><a href="#"><img src="<? echo base_url(); ?>static/img/slide4.png" width="1000" height="644" /></a></div>
			<div class="focusR"><a href="#"><img src="<? echo base_url(); ?>static/img/slide5.png" width="1000" height="644" /></a></div>
		</li>	    
	</ul>
</div>
<script type="text/javascript" src="<? echo base_url(); ?>static/js/slide.js"></script>

<!-- slide end -->

<div class="body">

	<!-- 猜你喜欢 -->
	<div class="push">
		<p>猜你喜欢</p>
		<ul class="push-list">
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
	</div>

	<!-- 热门课程 -->
	<div class="push">
		<p>热门课程</p>
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

	<div class="fill"></div>

</div>


<?php $this->load->view('common/footer');?>