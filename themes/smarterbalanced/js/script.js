// JavaScript Document for Portal Template 2
$(document).ready(function(){
	//resize font in quicklinks	
		var originalFontSize = 0;
		originalFontSize = parseInt($('.quickLink .lName span').css("font-size"));
		var divWidth = 0;
		divWidth = $('.quickLink').width() - 4;
		$('.quickLink .lName span').each(function(){
			var spanWidth = $(this).width();
			var newFontSize = (divWidth/spanWidth) * originalFontSize;
				if (newFontSize < originalFontSize){
				$(this).css({"font-size" : newFontSize});
			}else{$(this).css({"font-size" : originalFontSize});}
		});
		
			
	//Browser Tabs
		$(".btabs li").click(function(event) {
			if($(this).hasClass("disabled")){}else{
				
			var index = $(this).index();
			$(".browser").hide();
			$(".browser").eq(index).show();
			sbWidth();
			$(".btabs li").removeClass("active");
  			$(this).addClass('active');
			}
		});
		sbWidth();
	
	
	//Announcement Tabs
	$(".announcementTabs li").click(function(event) {
            var index = $(this).index();
            $(".announcements .announcementSection").fadeOut(500);
            $(".announcements .announcementSection").eq(index).delay(500).fadeIn(500);
            $(".announcementTabs li").removeClass("selected");
              $(this).addClass('selected');
			  var left = ($(this).width()+1)*index;
			$("#tabSelector").animate({left:left},1000);
        });
	
	//Preview window
		$('.preview').fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);

		$('.newPost').fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
	$(window).load(function() {
		scaleFont();
		cardFont();
		qls();
		//align Home Page QLs
		var qlNum=0;
		$(".homeQL").each(function(){
			qlNum++;
		});
		var hcHeight = $(".homeCard").outerHeight();
		var hqlHeight = $(".homeQLs").outerHeight() ;
		var margin1 = (hcHeight - hqlHeight)/2;
		if (margin1 < 0){}else{
		$(".homeQLs").css({"margin-top":margin1});}
		var height4 = $(".btabs").height();
		$(".browser").css({"min-height" : height4});
	});
	$(window).resize(function() {
		
		scaleFont();
		sbWidth();
		
	
		
		
	
	
	
	//Size cards for Phone display
		var win = 0;
		win = $(window).width();
		if (win < 801){
			var x = $(".cardBox").width();
			var y = $(".cardTop").width();
			var z = x - y - 12;
        		$(".cardBottom").width(z);
		}else{
			$(".cardBottom").width('auto');
		}
	});
});
	//pass variable between pages to determine which section to show on Resources
		$.extend({
			  getUrlVars: function(){
				var vars = [], hash;
				var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
				for(var i = 0; i < hashes.length; i++)
				{
				  hash = hashes[i].split('=');
				  vars.push(hash[0]);
				  vars[hash[0]] = hash[1];
				}
				return vars;
			  },
			  getUrlVar: function(name){
				return $.getUrlVars()[name];
			  }
			});
	
	//Browser Section Width
		function sbWidth(){
			$('.OS').show();
			var q =  $('.browserPage').width();
			if ( q < 500){
				$('.OS').hide();
				$('.btabs').css({'width':'64px'});
			}
			var w1 = $('.browserPage').width();
			var w3 = w1 - 252 + 'px';
			$('.bDownloads').css({'width':w3});
		}
	
	//Scale Font
		function scaleFont(){
					$('.quickLink .lName span').each(function(){
						if (($(this).width() > $(this).parent().width())) {
						while (($(this).width() > $(this).parent().width())) {
							var fontSize = parseInt($(this).css('font-size'));
							fontSize--;
							$(this).css({'font-size':fontSize});
							
						}
						}
						centerQLText();
					});
					
		}
		
		function qls(){
			$('.quickLink .title .fontSizer').each(function(){
						if (($(this).height() > $(this).parent().height())) {
						while (($(this).height() > $(this).parent().height())) {
							var fontSize = parseInt($(this).css('font-size'));
							fontSize--;
							$(this).css({'font-size':fontSize});
						}
						}
						var x = $(this).height();
						var y = $(this).parent().height();
						var z = (y - x)/2 +'px';
						$(this).css({'margin':z + ' 0'});
					});
		}
		
		function cardFont(){
			$('.multiWrapper .cardBox .cardBottom.home .cardTitle').each(function(){
				if (($(this).height()) > 42) {
					while (($(this).height()) > 42) {
							var fontSize = parseInt($(this).css('font-size'));
							var lineHeight = parseInt($(this).css('line-height'));
							fontSize--;
							lineHeight = (parseInt($(this).css('font-size')))/fontSize;
							$(this).css({'font-size':fontSize}).css({'line-height':lineHeight + 'em'});
					}
				}
			});
		}
		
		function centerQLText(){
				$('.quickLink .lName span').each(function(){
					var x = $(this).height();
					var y = (60 - x) / 2;
					var z = Math.floor(y) + "px 0";
					$(this).css({"padding":z});
				});
		}
			/*var originalFontSize = 0;
		originalFontSize = parseInt($('.quickLink .lName span').css("font-size"));
		var divWidth = 0;
		divWidth = $('.quickLink').width() - 4;
		$('.quickLink .lName span').each(function(){
			var spanWidth = $(this).width();
			var newFontSize = (divWidth/spanWidth) * originalFontSize;
				if (newFontSize < originalFontSize){
				$(this).css({"font-size" : newFontSize});
			}else{$(this).css({"font-size" : originalFontSize});}
		});*/
		