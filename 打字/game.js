/*
 * 时间：2016年4月10日17:02:32
 */
bgImg = new Image;
bgImg.src = './images/bg.jpg';
//game.js负责游戏逻辑
var game = function(){
	var hdThis = this;
	//保存字母的数组
	hdThis.hdLetterArr = [];
	//保存typed的对象
	hdThis.hdTyped = new typed;
	//得到画布对象
	hdThis.hdCtx = document.getElementById("canvas").getContext('2d');
	//错误数量
	hdThis.hdWrongNum = 0;
	//正确的数量
	hdThis.hdRightNum = 0;
	//追加字母的定时器
	hdThis.hdAddTimer;
	//移动字母的定时器
	hdThis.hdMoveTimer;
	
	hdThis.hdRun = function(){
		hdThis.hdInit();
		hdThis.hdFlashCtx();
		hdThis.hdMove();
		hdThis.hdCheckTyped();
	}
	//1.初始化(开始界面消失,音乐播放,初始一个字母) 
	hdThis.hdInit = function(){
		document.getElementById("welcome").style.display = 'none';
		document.getElementById("bgMusic").play();
		//追加一个字母
		hdThis.hdLetterArr.push(hdThis.hdTyped.hdGetLetter());
	}
	//2.绘制(绘制背景,绘制字母)
	hdThis.hdFlashCtx = function(){
		//画背景
		hdThis.hdCtx.drawImage(bgImg,0,0,800,600);
		//写字
		for (var i=0;i<hdThis.hdLetterArr.length;i++) {
			hdThis.hdCtx.font = hdThis.hdLetterArr[i].size + 'px 微软雅黑';
			hdThis.hdCtx.fillStyle = hdThis.hdLetterArr[i].color;
			hdThis.hdCtx.fillText(hdThis.hdLetterArr[i].letter,hdThis.hdLetterArr[i].x,hdThis.hdLetterArr[i].y);
		}
		//写分数
		hdThis.hdCtx.font = '20px 微软雅黑';
		hdThis.hdCtx.fillStyle  = 'red';
		hdThis.hdCtx.fillText('正确：' + hdThis.hdRightNum + '   错误：' + hdThis.hdWrongNum,10,20);
	}
	//3.字母移动(不够数量生成字母,字母向下移动,底部碰撞,写正确失败数 量,检测游戏是否结束)
	hdThis.hdMove = function(){
		//如果不够10个字母，追加数组
		hdThis.hdAddTimer = setInterval(function(){
			if(hdThis.hdLetterArr.length < 10){
				hdThis.hdLetterArr.push(hdThis.hdTyped.hdGetLetter());
			}
		},1000);
		
		hdThis.hdMoveTimer = setInterval(function(){
			for (var i=0;i<hdThis.hdLetterArr.length;i++) {
				hdThis.hdLetterArr[i].y++;
			}
			//刷新画布
			hdThis.hdFlashCtx();
			//碰到底部的检测
			hdThis.hdCheckHit();
			//检测游戏是否结束
			hdThis.hdGameOver();
		},1)
	}
	hdThis.hdGameOver = function(){
		if(hdThis.hdWrongNum>=10){
			//清除定时器
			clearInterval(hdThis.hdMoveTimer);
			clearInterval(hdThis.hdAddTimer);
			//音乐停止
			document.getElementById("bgMusic").pause();
			//显示结束界面
			
		}
	}
	hdThis.hdCheckHit = function(){
		for (var i=0;i<hdThis.hdLetterArr.length;i++) {
				if(hdThis.hdLetterArr[i].y >= 600){
					hdThis.hdWrongNum++;
					hdThis.hdLetterArr.splice(i,1);
				}
			}
	}
	//4.用户击打检测(打对字母移除字母数组,正确错误分数增加,播放音效)
	hdThis.hdCheckTyped = function(){
		var right = document.getElementById("right");
		var wrong = document.getElementById("wrong");
		document.onkeydown = function(e){
			var letter = String.fromCharCode(e.keyCode).toLocaleLowerCase();
			for (var i=0;i<hdThis.hdLetterArr.length;i++) {
				if(letter == hdThis.hdLetterArr[i].letter){
					//删掉指定下标的单元
					hdThis.hdLetterArr.splice(i,1);
					right.play();
					hdThis.hdRightNum++;
					return;
				}
			}
			//如果打错了
			wrong.play();
			hdThis.hdWrongNum++;
			
		}
	}
	
}

game = new game;