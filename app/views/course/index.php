<!-- 课程列表页模板 -->
<?php $this->load->view('common/header_up');?>

<?php
// 获取控制器
$control = $this->uri->segment(1);
?>

<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/course_list.css">
<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/course.css">

<!-- 课程鼠标事件 -->
<script type="text/javascript" src="<? echo base_url(); ?>static/js/course_mouse.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		// ajax加载更多按钮
		$('.load-more a').click(function(){

			$(this).text('玩命加载中...');

			// 开始位置
			var start = $('.push-list li').length;
			// 分类和排序
			var cateId = "<?=$cateId?>";
			var order = "<?=$order?>";
			
			$.getJSON("<?php echo base_url()?>course/loadMore", {start: start,cateId:cateId,order:order}, function(json){
				if (json == ''){
					$(".load-more a").text('哎呀，木有了...');
				}
				else{
					for(var i in json){
						var html = '<li>';

						if((parseInt(i)+1)%4 == 0){
							html = '<li style="margin-right: 0">' ;
						}
						html += '<a href="<? echo base_url().$control; ?>/info/'+json[i].id+'" class="intro">\
								<img src="<? echo base_url(); ?>upload/img/'+json[i].img+'">\
								<div></div>\
								<p>'+json[i].desc+'</p>\
							</a>\
							<a href="<? echo base_url().$control; ?>/info/'+json[i].id+'"><span>'+json[i].title+'</span></a>\
							<p class="course-info">\
								<span class="score">评分:'+ parseInt((json[i].score/json[i].score_num)*100)/100 +'</span>\
								<span class="number">'+json[i].join_num+'人参加</span>\
							</p>\
						</li>';

						$('.push-list').append(html);
					}
					$(".load-more a").text('加载更多');
				}

			});

		});
	});	

</script>

<?php $this->load->view('common/header_down');?>

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
	
	<div class="load-more">
		<a href="javascript:;">加载更多</a>
	</div>

	<?php $this->load->view('common/footer');?>

</div>