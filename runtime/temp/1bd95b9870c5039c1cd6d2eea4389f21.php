<?php /*a:2:{s:57:"/usr/local/var/www/Blog/application/index/view/index.html";i:1552642402;s:63:"/usr/local/var/www/Blog/application/index/view/base/header.html";i:1552642620;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>首页</title>
	<!-- bootstrap【start】 -->
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="icon" href="/all/icon/moon.ico" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- bootstrap【end】 -->

	<link rel="stylesheet" href="/all/css/index.css">
	<!-- css3动画库 -->
	<link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/animate-3.1.0.min.css">
	<!-- 图标字体库 -->
	<link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
	<script src="/all/js/index.js"></script>
</head>
<body id="my_body" background="/all/img/bg.jpg"  data-spy="scroll" data-target="#myScrollspy">
	<!-- header[start] -->
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid container"> 
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand visible-xs-inline" href="#">Blog</a>
			</div>
			<div class="collapse navbar-collapse" id="example-navbar-collapse">
				<ul class="nav navbar-nav animated fadeInRight">
					<li class="visible-lg-block visible-md-block" onclick="change_color();">
						<i class="fa fa-magic fa-2x" style="margin-top:10px;color:ghostwhite;" data-toggle="tooltip" data-placement="bottom"
						title="点击切换主题"></i>
					</li>
					<li>
						<a href="index.html">
							<i class="fa fa-codiepie"></i>首页
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-linux"></i>关于技术
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-envira"></i>成长分享
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-github-alt"></i>随笔心得
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-github"></i>思考总结
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-twitter"></i>业余爱好
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- header[end] -->
	<!-- content[start] -->
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="thumbnail">
					<img src="/all/img/1.jpg" alt="" class="animated slideInLeft">
					<div class="caption">
						<h3>缩略图标签</h3>
						<p>一些示例文本。一些示例文本。</p>
						<p>
							<a href="<?php echo url('index/index/article'); ?>" class="btn btn-info" role="button">
								<i class="fa fa-soundcloud"></i>
								原文
							</a>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="thumbnail">
					<img src="/all/img/2.jpg" alt="" class="animated slideInRight">
					<div class="caption">
						<h3>缩略图标签</h3>
						<p>一些示例文本。一些示例文本。</p>
						<p>
							<a href="#" class="btn btn-info" role="button">
								<i class="fa fa-soundcloud"></i>
								原文
							</a>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="thumbnail">
					<img src="/all/img/3.jpg" alt="" class="animated rotateInDownLeft">
					<div class="caption">
						<h3>缩略图标签</h3>
						<p>一些示例文本。一些示例文本。</p>
						<p>
							<a href="#" class="btn btn-info" role="button">
								<i class="fa fa-soundcloud"></i>
								原文
							</a>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="thumbnail">
					<img src="/all/img/4.jpg" alt="" class="animated rotateInDownRight">
					<div class="caption">
						<h3>缩略图标签</h3>
						<p>一些示例文本。一些示例文本。</p>
						<p>
							<a href="#" class="btn btn-info" role="button">
								<i class="fa fa-soundcloud"></i>
								原文
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content[end] -->

	<!-- page[start] -->
	<div class="col-md-offset-2 col-sm-offset-2 col-xs-offset-1">
		<ul class="pagination">
			<li><a href="#">&laquo;</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">&raquo;</a></li>
		</ul>
	</div>
	<!-- page[end] -->
	
</body>
</html>