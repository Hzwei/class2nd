<!-- 网站首页模板 -->
<?php $this->load->view('common/header_up');?>

<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>static/css/index.css">
<script type="text/javascript" src="<? echo base_url(); ?>static/js/jquery.easing.1.3.js"></script>


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
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li style="margin-right: 0"><a href="#">4</a></li>
		</ul>
	</div>


</div>


<?php $this->load->view('common/footer');?>