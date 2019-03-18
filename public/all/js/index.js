// 切换桌面背景图片和字体颜色
function change_color(){
    var current_color = document.getElementById("my_body").getAttribute("background");
    if(current_color == '/all/img/bg.jpg'){
        document.getElementById("my_body").setAttribute("background","/all/img/bg3.jpg");
    }else if(current_color == '/all/img/bg2.jpg'){
        document.getElementById("my_body").setAttribute("background","/all/img/bg.jpg");
    }else{
        document.getElementById("my_body").setAttribute("background","/all/img/bg2.jpg");
    }
}

//发布文章添加导航
function addNav(){
    var val = document.getElementById("add_nav").innerHTML;
    if(val == '添加导航'){
        document.getElementById("add_nav").innerHTML="关闭导航";
        document.getElementById("nav_add").setAttribute("style","display:block;");
        document.getElementById("nav_add").setAttribute("name","nav_add");
    }else{
        document.getElementById("add_nav").innerHTML="添加导航";
        document.getElementById("nav_add").setAttribute("style","display:none;");
        document.getElementById("nav_add").setAttribute("name","");
    }
}