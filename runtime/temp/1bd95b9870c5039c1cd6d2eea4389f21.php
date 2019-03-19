<?php /*a:3:{s:57:"/usr/local/var/www/Blog/application/index/view/index.html";i:1552888705;s:63:"/usr/local/var/www/Blog/application/index/view/base/header.html";i:1552988340;s:62:"/usr/local/var/www/Blog/application/index/view/base/login.html";i:1552985371;}*/ ?>
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
	<!-- layer -->
	<script src="/all/layui/lay/modules/layer.js"></script>
	<link rel="stylesheet" href="/all/layui/css/modules/layer/default/layer.css">
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
						<a href="#technology">
							<i class="fa fa-linux"></i>关于技术
						</a>
					</li>
					<li>
						<a href="#share">
							<i class="fa fa-envira"></i>成长分享
						</a>
					</li>
					<li>
						<a href="#study">
							<i class="fa fa-github-alt"></i>随笔心得
						</a>
					</li>
					<li>
						<a href="#think">
							<i class="fa fa-github"></i>思考总结
						</a>
					</li>
					<li>
						<a href="#life">
							<i class="fa fa-twitter"></i>业余生活
						</a>
					</li>
					<?php if(session('id') == ''): ?>
						<li>
							<a href="#" data-toggle="modal" data-target="#myModal">
								<i class="fa fa-user"></i>登录
							</a>
						</li>
					<?php else: ?>
						<li>
							<a href="<?php echo url('index/index/publish'); ?>">
								<i class="fa fa-pencil"></i>发布文章
							</a>
						</li>
					<?php endif; ?>
					
				</ul>
			</div>
		</div>
	</nav>
	<!-- header[end] -->
<!-- 发布文章登陆框 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    发布文章登陆
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">账号:</label>
                    <input type="text" class="form-control" name="name" placeholder="请输入账号">
                </div>
                <div class="form-group">
                    <label for="name">密码:</label>
                    <input type="password" class="form-control" name="password" placeholder="请输入密码">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-success" onclick="login();">提交</button>
            </div>
        </div>
    </div>
</div>

<script>
// 登录
function login(){
    var name = $("input[name='name']").val();
    var password  = $("input[name='password']").val();
    $('#myModal').modal('hide');//隐藏模态框
    if(name == ''){
        layer.msg('名称不能为空', {icon: 2});
        return false;
    }
    if(password == ''){
        layer.msg('密码不能为空', {icon: 2});
        return false;
    }

    $.ajax({
        type: "POST",
        url: "/index/index/login",
        contentType: 'application/x-www-form-urlencoded;charset=utf-8',
        data: {
            'name':name,
            'password':password
        },
        dataType: "json",
        success: function(data){
            if(data.code == 200){
                layer.msg(data.msg, {icon: 1});
            　　setTimeout(jumurl,2000);
            }else{
                layer.msg(data.msg, {icon: 2});
            }
        }, error: function(data){
            layer.msg("当前网络不稳定!请稍后再试", {icon: 2});
        }
    });
}

// 跳转至发布文章
function jumurl(){
　　window.location.href = "/index/index/publish";
}
</script>
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
					<img src="/all/img/3.jpg" alt="" class="animated rotateInDownLeft">
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
					<img src="/all/img/4.jpg" alt="" class="animated rotateInDownRight">
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
		</div>
	</div>
	<!-- content[end] -->

	<!-- page[start] -->
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
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
		</div>
	</div>
	<!-- page[end] -->
</body>
</html>