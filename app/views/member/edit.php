<!-- 课程编辑 -->

<?php $this->load->view('common/header_up');?>

<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/edit.css">

<?php $this->load->view('common/header_down');?>


<div class='course'>
	<p class="course-info">课程信息</p>
	<form method="POST" action="<? echo base_url('member/editCommit'); ?>">
		<span>分类：</span>
		<select name="category">
			<?php foreach ($category as $value): ?>
				<option value='<?=$value['id']?>' <?php if ($value['id'] == $course['cid']): ?> selected <?php endif ?> >
					<?=$value['name']?>
				</option>
			<?php endforeach ?>
		</select>

		<br><br>

		<span>题目：</span>
		<input name="title" type='text' value='<?=$course["title"]?>'>
		
		<br><br>

		<span class="desc">描述：</span>
		<textarea  name="desc" class=""><?=$course['desc']?></textarea>

		<br><br>

		<span>图片：</span>
		<input type="file" name="img">
		<img style="display: block" src="<?php echo base_url().'upload/img/'.$course['img']?>">
		<input type="submit" value="确认修改" class="submit">
	</form>
</div>

<!-- 视频 -->
<!-- 视频列表 -->
<div class="videolist">
	<p>视频列表</p>
	<ul>
		<?php foreach ($video as $val): ?>
			<li>
				<span style="font-size: 20px;color:#1caaea;margin-right: 10px;margin-top: 5px;">
					<?=$val['sort']?>
				</span>
				<input type="text" value="<?=$val['title']?>">
				<textarea><?=$val['link']?></textarea>
			</li>
		<?php endforeach ?>
	</ul>
</div>
<!-- end -->


<?php $this->load->view('common/footer');?>