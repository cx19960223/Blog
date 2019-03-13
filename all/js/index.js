// 切换桌面背景图片和字体颜色
function change_color(){
    var current_color = document.getElementById("my_body").getAttribute("background");
    if(current_color == 'all/img/bg.jpg'){
        document.getElementById("my_body").setAttribute("background","all/img/bg3.jpg");
    }else if(current_color == 'all/img/bg2.jpg'){
        document.getElementById("my_body").setAttribute("background","all/img/bg.jpg");
    }else{
        document.getElementById("my_body").setAttribute("background","all/img/bg2.jpg");
    }
}