jQuery(document).ready(function($) {
	var y={
		ele:[],
		pos:[],
		anim:[]
	}
	var isIE = (function() {
		var div = document.createElement('div');
		div.innerHTML = '<!--[if IE]><i></i><![endif]-->';
		return (div.getElementsByTagName('i').length === 1);         
	}());
	$('#animatedheader > li').each(function() {
		y.anim.push(0);
		$(this).prepend('<span class="pos"/>');
		var p=$('.pos',this).offset();
		var pt=$(this).offset();
		p.left=p.left-pt.left;
		p.top=p.top-pt.top;
		var h=$(this).html();
		var d=$('<div/>');
		d.html('<div>'+h+'</div>');
		$(this).html('');
		$(this).append(d);
		y.ele.push(this);
		y.pos.push(p);
		var a=$('<span class="arrow"/>');
		$(this).append(a);
		var arrowanimate=function(w,delay,bcallback) {
			var e=y.ele[w];
			var l=y.pos[w].left;
			$('> span.arrow',e).stop().css({left:l-50,opacity:0}).show().animate({opacity:1,left:l-25},400,'linear',function() {
				$(this).fadeOut('fast',function() {
					window.setTimeout(bcallback,delay);
				});
			});
		}
		if (isIE) {
			$('> div',this).css({top:0});
			$('> div > div',this).css({top:0});
			return;
		}
		var animate=function(w,acallback) {
			if (y.anim[w])
				return;
			y.anim[w]=1;
			var e=y.ele[w];
			if (isIE) {
				$('> div',e).css({top:0});
				$('> div > div',e).css({top:0});
			} else {
				$('> div',e).animate({top:0},500);
				$('> div > div',e).animate({top:0},500,'linear',function() {
					arrowanimate(w,100,function() {
						window.setTimeout(function() {
							acallback();
							y.anim[w]=0;
						},500);
					});
				});
			}
		}
		var animatecycle=function() {
			animate(0,function(){
				animate(1,function() {
					animate(2,function() {
						arrow(1500);	
					});
				});
			});			
		}
		var arrow=function(delay) {
			window.setTimeout(function() {
				arrowanimate(0,delay,function() {
					arrowanimate(1,delay,function() {
						arrowanimate(2,delay,function() {
							arrow(1500);
						});
					});
				})	
			},3500);
		}
		animatecycle();
	});
});