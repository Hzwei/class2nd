<!-- 视频页模板 -->
<?php $this->load->view('common/header_up');?>

<?php
// 获取控制器
$control = $this->uri->segment(1);
?>

<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/video.css">

<?php $this->load->view('common/header_down');?>

<div class="video-head">
	<p>
		<a href="<?php echo base_url().$control.'/index/'.$cateInfo['id'].'/hot'?>" target="_blank">
			<span><?=$cateInfo['name']?></span>
		</a>
		<span style="color:red">&nbsp; > &nbsp;</span>
		<a href="<?php echo base_url().$control.'/info/'.$courseInfo['id'];?>" target="_blank">
			<span><?php echo $courseInfo['title'];?></span>
		</a>
		<span style="color:red">&nbsp; > &nbsp;</span>
		<span>第<?=$videoInfo['sort']?>节：</span>
		<span><?=$videoInfo['title']?></span>
		<span class="video-time">上传日期：<?php echo date("Y-m-d H:i:s",$videoInfo['time'])?></span>
	</p>
</div>

<div class="video">
	<?=$videoInfo['link']?>
</div>

<div class="video-nav">
	<?php if ($nearVideo[0] != 0): ?>
		<a href="<?php echo base_url().$control.'/video/'.$nearVideo[0]?>" class="pre"><span>上一节</span></a>
	<?php endif ?>
	<?php if ($nearVideo[1] != 0): ?>
		<a href="<?php echo base_url().$control.'/video/'.$nearVideo[1]?>" class="next"><span>下一节</span></a>
	<?php endif ?>
</div>

<?php $this->load->view('common/footer');?>