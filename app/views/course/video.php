<!-- 视频页模板 -->
<?php $this->load->view('common/header_up');?>

<?php
// 获取控制器
$control = $this->uri->segment(1);
$vid = $this->uri->segment(3);
?>

<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/video.css">
<script type="text/javascript">
	$(document).ready(function() {

		// 留言
		$('.submit').click(function(){
			var text = $('#content').val();
			if (text == '') {
				alert('不能为空');
			}
			else{
				$.post("<?php echo base_url('member/commentVideo')?>", {vid:"<?=$vid?>",text:text}, function(data){
					if (data) {
						alert('留言成功');
						location.reload();
					}
					else{
						alert('留言失败');
					}

				});
			}

		});

		// 加载更多留言
		$('#load-more').click(function(){
			$(this).text('玩命加载中...');
			var count = $('#forum-ul li').length;
			$.post("<?php echo base_url('course/loadMoreCom')?>", {vid:"<?=$vid?>",count:count}, function(data){
				if(data == ''){
					$('#load-more').text('哎呀，没有了');
				}
				else{
					for(var i in data){
						// console.log(data[i]);
						var html = '<li>\
									<p class="message">'+data[i].message+'</p>\
									<span class="for-time">'+ getDate(data[i].time) +'</span>\
									<span class="name">'+data[i].name+'</span>\
									</li>';
						$('#forum-ul').append(html);
						$('#load-more').text('加载更多');	
					}

				}

			},'json');


		});



	});
</script>

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

<div class="forum-list">
	<p class="forum-title">讨论区</p>
	<ul id="forum-ul">
		<?php foreach ($commentList as $v): ?>
			<li>
				<p class="message"><?=$v['message']?></p>
				<span class="for-time"><?php echo date("Y-m-d H:i:s",$v['time']);?></span>
				<span class="name"><?=$v['name']?></span>
			</li>
		<?php endforeach ?>
	</ul>
	<a href="javascript:;" id="load-more">加载更多</a>
</div>

<div class="forum">
	<?php if (isset($_SESSION['uid'])): ?>
		<textarea id="content" placeholder="没有什么想留下的吗？"></textarea>
		<button class="submit">留言</button>
	<?php else:?>
		<p style="text-align: center;margin: 10px auto;font-size: 15px;color:#D63116">留言请登录</p>
	<?php endif ?>
</div>

<?php $this->load->view('common/footer');?>