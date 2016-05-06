/*
 * 时间：2016年4月10日17:02:32
 */
//typed.js负责字母处理
//获得字母(随机字母,随机坐标,随机颜色)

var typed = function(){
	var hdThis = this;
	hdThis.hdSeed = ['a','b','c','d','e','f','g','h','i'];
	//获得字母
	hdThis.hdGetLetter = function(){
		return {
			x : hdThis.hdGetPos().x,
			y : hdThis.hdGetPos().y,
			letter : hdThis.hdGetRandomLetter(),
			size : hdThis.hdGetSize(),
			color: hdThis.hdGetColor()
		}
	}
	//获得随机的颜色
	hdThis.hdGetColor = function(){
		var r = Math.floor(Math.random() * 256);
		var g = Math.floor(Math.random() * 256);
		var b = Math.floor(Math.random() * 256);
		return 'rgb('+r+','+g+','+b+')';
	}
	//获得随机大小
	hdThis.hdGetSize = function(){
		//20-60的随机数
		var num = 20 + Math.floor(Math.random() * 40);
		return num;
	}
	//获得随机字母
	hdThis.hdGetRandomLetter = function(){
		var index = Math.floor(Math.random() * hdThis.hdSeed.length);
		return hdThis.hdSeed[index];
	}
	//获得随机坐标
	hdThis.hdGetPos = function(){
		var x = Math.floor(Math.random() * 800);
		return {
			x : x,
			y : 30
		}
	}	
}
