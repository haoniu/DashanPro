$(function(){
	
	
	$('#slide').slide({
	    width: 980,//宽度
	    height: 400,//高度
	    timeout: 3,//间隔时间
	    bgcolor: '#1B2527',//背景颜色
	    bgopacity: 0.9,//背景透明度
	    textColor: '#ddd'//文字颜色
	});
	
	
	
	
	
	
	
	
	
	
	//设置默认图片数值为0
	var pic_num = 0;
	//给小图添加一个点击事件
	$('#shop-con .shop-pic .s-pic ul li').mouseenter(function(){
		//获取序号
		pic_num = $(this).index();
		//获取小图的src属性
		var src = $('#shop-con .shop-pic .s-pic ul li img').eq(pic_num).attr('src');
		//将小图的src属性赋值给大图
		$('#shop-con .shop-pic .pic img').attr('src',src);
		//给当前的class添加一个class属性
		$(this).addClass('one').siblings().removeClass('one');
	})
	//给右键添加点击事件
	$('#shop-con .shop-pic .s-pic .y').click(function(){
		pic_num++;
		
		pic(pic_num);
	})
	//给左键添加点击事件
	$('#shop-con .shop-pic .s-pic .z').click(function(){
		pic_num--;
		if(pic_num < 3){
			pic_num = 0;
		}
		pic(pic_num);
	})
	
	
})
function pic(pic_num){
	var src = $('#shop-con .shop-pic .s-pic ul li img').eq(pic_num).attr('src');
	$('#shop-con .shop-pic .pic img').attr('src',src);
	$('#shop-con .shop-pic .s-pic ul li').eq(pic_num).addClass('one').siblings().removeClass('one');
	var left = pic_num*-92;
	if($('#shop-con .shop-pic .s-pic ul li').length > 5 && pic_num < $('#shop-con .shop-pic .s-pic ul li').length -4){
		$('#shop-con .shop-pic .s-pic ul').css('left', left+'px');
	}
}



$(function(){
	//设定一个title变量
	var $title = $('#shop-feature .title li');
	//设定一个要显示的变量
	var $ul = $('#shop-feature .shop-content ul');
	//给title添加一个点击事件
	$title.click(function(){
		//给当前点击的class增加一个元素属性
		$(this).addClass('one').siblings().removeClass('one');
		//获取当前元素
		var $t = $(this).index();
		//让对应的内容显示
		$ul.eq($t).css('display','block').siblings().css('display','none');
	})
	

	
})








