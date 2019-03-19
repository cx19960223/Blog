<?php /*a:3:{s:59:"/usr/local/var/www/Blog/application/index/view/article.html";i:1552988077;s:63:"/usr/local/var/www/Blog/application/index/view/base/header.html";i:1552988340;s:62:"/usr/local/var/www/Blog/application/index/view/base/login.html";i:1552985371;}*/ ?>
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
<link rel="stylesheet" href="/all/css/article.css">

	<div class="container" style="background-color:white;">
        <!-- 面包屑 [start] -->
        <ul class="breadcrumb" style="margin-top:10px;">
            <li class="animated rollIn"><a href="#">Home</a></li>
            <li class="animated rollIn"><a href="#">2013</a></li>
            <li class="active animated rollIn">十一月</li>
        </ul>
        <!-- 面包屑 [end] -->
        <div class="jumbotron">
            <h1 class="animated lightSpeedIn">Bootstrap Affix&nbsp;<small>author</small></h1>
        </div>
        <div class="row">
            <div class="visible-lg-block col-md-2" id="myScrollspy">
                <ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125">
                    <li class="active"><a href="#section-1">第一部分</a></li>
                    <li><a href="#section-2">第二部分</a></li>
                    <li><a href="#section-3">第三部分</a></li>
                    <li><a href="#section-4">第四部分</a></li>
                    <li><a href="#section-5">第五部分</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-md-10">
                <h2 id="section-1">第一部分</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum id metus ac nisl bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet sagittis. In tincidunt orci sit amet elementum vestibulum. Vivamus fermentum in arcu in aliquam. Quisque aliquam porta odio in fringilla. Vivamus nisl leo, blandit at bibendum eu, tristique eget risus. Integer aliquet quam ut elit suscipit, id interdum neque porttitor. Integer faucibus ligula.</p>
                <p class="thumbnail"><img src="/all/img/1.jpg" alt=""></p>
                <p>Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget nisi a mi suscipit tincidunt. Ut tempus dictum risus. Pellentesque viverra sagittis quam at mattis. Suspendisse potenti. Aliquam sit amet gravida nibh, facilisis gravida odio. Phasellus auctor velit at lacus blandit, commodo iaculis justo viverra. Etiam vitae est arcu. Mauris vel congue dolor. Aliquam eget mi mi. Fusce quam tortor, commodo ac dui quis, bibendum viverra erat. Maecenas mattis lectus enim, quis tincidunt dui molestie euismod. Curabitur et diam tristique, accumsan nunc eu, hendrerit tellus.</p>
                <hr>
                <h2 id="section-2">第二部分</h2>
                <p>Nullam hendrerit justo non leo aliquet imperdiet. Etiam in sagittis lectus. Suspendisse ultrices placerat accumsan. Mauris quis dapibus orci. In dapibus velit blandit pharetra tincidunt. Quisque non sapien nec lacus condimentum facilisis ut iaculis enim. Sed viverra interdum bibendum. Donec ac sollicitudin dolor. Sed fringilla vitae lacus at rutrum. Phasellus congue vestibulum ligula sed consequat.</p>
                <p>Vestibulum consectetur scelerisque lacus, ac fermentum lorem convallis sed. Nam odio tortor, dictum quis malesuada at, pellentesque vitae orci. Vivamus elementum, felis eu auctor lobortis, diam velit egestas lacus, quis fermentum metus ante quis urna. Sed at facilisis libero. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum bibendum blandit dolor. Nunc orci dolor, molestie nec nibh in, hendrerit tincidunt ante. Vivamus sem augue, hendrerit non sapien in, mollis ornare augue.</p>
                <hr>
                <h2 id="section-3">第三部分</h2>
                <p>Integer pulvinar leo id risus pellentesque vestibulum. Sed diam libero, sodales eget sapien vel, porttitor bibendum enim. Donec sed nibh vitae lorem porttitor blandit in nec ante. Pellentesque vitae metus ipsum. Phasellus sed nunc ac sem malesuada condimentum. Etiam in aliquam lectus. Nam vel sapien diam. Donec pharetra id arcu eget blandit. Proin imperdiet mattis augue in porttitor. Quisque tempus enim id lobortis feugiat. Suspendisse tincidunt risus quis dolor fringilla blandit. Ut sed sapien at purus lacinia porttitor. Nullam iaculis, felis a pretium ornare, dolor nisl semper tortor, vel sagittis lacus est consequat eros. Sed id pretium nisl. Curabitur dolor nisl, laoreet vitae aliquam id, tincidunt sit amet mauris.</p>
                <p>Phasellus vitae suscipit justo. Mauris pharetra feugiat ante id lacinia. Etiam faucibus mauris id tempor egestas. Duis luctus turpis at accumsan tincidunt. Phasellus risus risus, volutpat vel tellus ac, tincidunt fringilla massa. Etiam hendrerit dolor eget ante rutrum adipiscing. Cras interdum ipsum mattis, tempus mauris vel, semper ipsum. Duis sed dolor ut enim lobortis pellentesque ultricies ac ligula. Pellentesque convallis elit nisi, id vulputate ipsum ullamcorper ut. Cras ac pulvinar purus, ac viverra est. Suspendisse potenti. Integer pellentesque neque et elementum tempus. Curabitur bibendum in ligula ut rhoncus.</p>
                <p>Quisque pharetra velit id velit iaculis pretium. Nullam a justo sed ligula porta semper eu quis enim. Pellentesque pellentesque, metus at facilisis hendrerit, lectus velit facilisis leo, quis volutpat turpis arcu quis enim. Nulla viverra lorem elementum interdum ultricies. Suspendisse accumsan quam nec ante mollis tempus. Morbi vel accumsan diam, eget convallis tellus. Suspendisse potenti.</p>
                <hr>
                <h2 id="section-4">第四部分</h2>
                <p>Suspendisse a orci facilisis, dignissim tortor vitae, ultrices mi. Vestibulum a iaculis lacus. Phasellus vitae convallis ligula, nec volutpat tellus. Vivamus scelerisque mollis nisl, nec vehicula elit egestas a. Sed luctus metus id mi gravida, faucibus convallis neque pretium. Maecenas quis sapien ut leo fringilla tempor vitae sit amet leo. Donec imperdiet tempus placerat. Pellentesque pulvinar ultrices nunc sed ultrices. Morbi vel mi pretium, fermentum lacus et, viverra tellus. Phasellus sodales libero nec dui convallis, sit amet fermentum sapien auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed eu elementum nibh, quis varius libero.</p>
                <p>Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget nisi a mi suscipit tincidunt. Ut tempus dictum risus. Pellentesque viverra sagittis quam at mattis. Suspendisse potenti. Aliquam sit amet gravida nibh, facilisis gravida odio. Phasellus auctor velit at lacus blandit, commodo iaculis justo viverra. Etiam vitae est arcu. Mauris vel congue dolor. Aliquam eget mi mi. Fusce quam tortor, commodo ac dui quis, bibendum viverra erat. Maecenas mattis lectus enim, quis tincidunt dui molestie euismod. Curabitur et diam tristique, accumsan nunc eu, hendrerit tellus.</p>
                <p>Phasellus fermentum, neque sit amet sodales tempor, enim ante interdum eros, eget luctus ipsum eros ut ligula. Nunc ornare erat quis faucibus molestie. Proin malesuada consequat commodo. Mauris iaculis, eros ut dapibus luctus, massa enim elementum purus, sit amet tristique purus purus nec felis. Morbi vestibulum sapien eget porta pulvinar. Nam at quam diam. Proin rhoncus, felis elementum accumsan dictum, felis nisi vestibulum tellus, et ultrices risus felis in orci. Quisque vestibulum sem nisl, vel congue leo dictum nec. Cras eget est at velit sagittis ullamcorper vel et lectus. In hac habitasse platea dictumst. Etiam interdum iaculis velit, vel sollicitudin lorem feugiat sit amet. Etiam luctus, quam sed sodales aliquam, lorem libero hendrerit urna, faucibus rhoncus massa nibh at felis. Curabitur ac tempus nulla, ut semper erat. Vivamus porta ullamcorper sem, ornare egestas mauris facilisis id.</p>
                <p>Ut ut risus nisl. Fusce porttitor eros at magna luctus, non congue nulla eleifend. Aenean porttitor feugiat dolor sit amet facilisis. Pellentesque venenatis magna et risus commodo, a commodo turpis gravida. Nam mollis massa dapibus urna aliquet, quis iaculis elit sodales. Sed eget ornare orci, eu malesuada justo. Nunc lacus augue, dictum quis dui id, lacinia congue quam. Nulla sem sem, aliquam nec dolor ac, tempus convallis nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla suscipit convallis iaculis. Quisque eget commodo ligula. Praesent leo dui, facilisis quis eleifend in, aliquet vitae nunc. Suspendisse fermentum odio ac massa ultricies pellentesque. Fusce eu suscipit massa.</p>
                <hr>
                <h2 id="section-5">第五部分</h2>
                <p>Nam eget purus nec est consectetur vehicula. Nullam ultrices nisl risus, in viverra libero egestas sit amet. Etiam porttitor dolor non eros pulvinar malesuada. Vestibulum sit amet est mollis nulla tempus aliquet. Praesent luctus hendrerit arcu non laoreet. Morbi consequat placerat magna, ac ornare odio sagittis sed. Donec vitae ullamcorper purus. Vivamus non metus ac justo porta volutpat.</p>
                <p>Vivamus mattis accumsan erat, vel convallis risus pretium nec. Integer nunc nulla, viverra ut sem non, scelerisque vehicula arcu. Fusce bibendum convallis augue sit amet lobortis. Cras porta urna turpis, sodales lobortis purus adipiscing id. Maecenas ullamcorper, turpis suscipit pellentesque fringilla, massa lacus pulvinar mi, nec dignissim velit arcu eget purus. Nam at dapibus tellus, eget euismod nisl. Ut eget venenatis sapien. Vivamus vulputate varius mauris, vel varius nisl facilisis ac. Nulla aliquet justo a nibh ornare, eu congue neque rutrum.</p>
                <p>Suspendisse a orci facilisis, dignissim tortor vitae, ultrices mi. Vestibulum a iaculis lacus. Phasellus vitae convallis ligula, nec volutpat tellus. Vivamus scelerisque mollis nisl, nec vehicula elit egestas a. Sed luctus metus id mi gravida, faucibus convallis neque pretium. Maecenas quis sapien ut leo fringilla tempor vitae sit amet leo. Donec imperdiet tempus placerat. Pellentesque pulvinar ultrices nunc sed ultrices. Morbi vel mi pretium, fermentum lacus et, viverra tellus. Phasellus sodales libero nec dui convallis, sit amet fermentum sapien auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed eu elementum nibh, quis varius libero.</p>
                <p>Morbi sed fermentum ipsum. Morbi a orci vulputate tortor ornare blandit a quis orci. Donec aliquam sodales gravida. In ut ullamcorper nisi, ac pretium velit. Vestibulum vitae lectus volutpat, consequat lorem sit amet, pulvinar tellus. In tincidunt vel leo eget pulvinar. Curabitur a eros non lacus malesuada aliquam. Praesent et tempus odio. Integer a quam nunc. In hac habitasse platea dictumst. Aliquam porta nibh nulla, et mattis turpis placerat eget. Pellentesque dui diam, pellentesque vel gravida id, accumsan eu magna. Sed a semper arcu, ut dignissim leo.</p>
                <p>Sed vitae lobortis diam, id molestie magna. Aliquam consequat ipsum quis est dictum ultrices. Aenean nibh velit, fringilla in diam id, blandit hendrerit lacus. Donec vehicula rutrum tellus eget fermentum. Pellentesque ac erat et arcu ornare tincidunt. Aliquam erat volutpat. Vivamus lobortis urna quis gravida semper. In condimentum, est a faucibus luctus, mi dolor cursus mi, id vehicula arcu risus a nibh. Pellentesque blandit sapien lacus, vel vehicula nunc feugiat sit amet.</p>
            </div>
        </div>
    </div>
	
</body>
</html>