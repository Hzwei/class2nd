<!-- 课程编辑 -->

<?php $this->load->view('common/header_up');?>

<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/edit.css">

<script type="text/javascript">

	var courseId = "<?php echo $this->uri->segment(3)?>";

	$(document).ready(function(){
		// 前端表单验证
		$('#course').submit(function(e){
			var cate = $(this).find('select[name=category]').val();
			var title = $(this).find('input[name=title]').val();
			var desc = $(this).find('textarea[name=desc]').val();
			
			//  为空
			if(cate == '' || title=='' || desc == ''){
				e.preventDefault();
				alert('请填写完整');
			}
		});

		// 新增视频
		$('.add-new').click(function(){
			// 计算顺序
			var sort = parseInt($('#video li:last .sort').text()) + 1;

			// 构造插入
			var html = '<li><span class="sort">'+ sort +'</span>\
				标题：<input name="title" type="text" value=""><br>\
				<span class="link-word">链接：</span><textarea name="link"></textarea>\
				<button class="change">确认添加</button>\
				<input type="hidden" name="vid" value="0"></li>';

			$("#video").append(html);

			// 绑定点击事件
			$('.change').on('click',videoMethod);
		});

		// 添加&修改 视频 函数
		var videoMethod = function(){
			var sort = $(this).siblings('.sort').text();
			var title = $(this).siblings('input[name=title]').val();
			var link = $(this).siblings('textarea[name=link]').val();
			var vid = $(this).siblings('input[name=vid]').val();

			$.post("<?php echo base_url('member/methodVideo')?>", 
				{sort:sort,title:title,link:link,vid:vid,cid:courseId}, function(data){
					// console.log(data);
					if (data){
						alert("操作成功");
						location.reload();
					}
					else{
						alert("操作失败");
					}
			});

		}

		// 绑定点击事件
		$('.change').on('click',videoMethod);

		// 删除此视频
		$('.del').click(function(){
			if (confirm("您确认要删除此视频么?")){
				var vid = $(this).siblings('input[name=vid]').val();
				$.post("<?php echo base_url('member/delVideo')?>", {vid:vid,cid:courseId}, function(data){
					if (data){
						alert("操作成功");
						location.reload();
					}
					else{
						alert("操作失败");
					}

				});

			}
			else{
				return;
			}
		});



	});

</script>

<?php $this->load->view('common/header_down');?>

<?php $cid = $this->uri->segment(3);?>

<div class='course'>
	<p class="course-info">课程信息</p>
	<form id="course" method="POST" enctype="multipart/form-data" action="<? echo base_url('member/editCommit').'/'.$cid; ?>">
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
		<input name="title" type='text' value='<?=$course["title"]?>' required>
		
		<br><br>

		<span class="desc">描述：</span>
		<textarea required name="desc" class=""><?=$course['desc']?></textarea>

		<br><br>

		<span>图片：</span>
		<input type="file" name="img">
		<?php if ($course['img']): ?>
			<img style="display: block" src="<?php echo base_url().'upload/img/'.$course['img']?>" height="200px;">
		<?php endif ?>
		<input type="submit" value="确认修改" class="submit">
	</form>
</div>

<!-- 视频 -->
<!-- 视频列表 -->
<div class="videolist">
	<p>视频列表</p>
	<ul id="video">
		<?php foreach ($video as $val): ?>
			<li>
				<a href="javascript:;" style="color:red;font-size: 18px;position: absolute;padding-top: 10px;" title="删除此视频" class="del">
					X
				</a>
				<span class="sort">
					<?=$val['sort']?>
				</span>
				标题：<input name="title" type="text" value="<?=$val['title']?>"><br>
				<span class="link-word">链接：</span><textarea name="link"><?=$val['link']?></textarea>
				<button class="change">确认修改</button>
				<input type="hidden" name="vid" value="<?=$val['id']?>">
			</li>
		<?php endforeach ?>
	</ul>
	<a title='添加课程' href="javascript:;" class="add-new">+</a>
</div>
<!-- end -->


<?php $this->load->view('common/footer');?>