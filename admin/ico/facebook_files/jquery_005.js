(function(a){jQuery.fn.superbgimage=function(b){var c=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options,b);return a.superbg_inAnimation=!1,a.superbg_slideshowActive=!1,a.superbg_imgIndex=1,a.superbg_imgActual=1,a.superbg_imgLast=-1,a.superbg_imgSlide=0,a.superbg_interval=0,a.superbg_preload=0,a.superbg_direction=0,a.superbg_max_randomtrans=7,a.superbg_lasttrans=-1,a.superbg_isIE6=!1,a.superbg_firstLoaded=!1,a.superbg_saveId=a(this).attr("id"),a("#"+c.id).length===0?a("body").prepend('<div id="'+c.id+'" style="display:none;"></div>'):a("body").prepend(a("#"+c.id)),a("#"+c.id).css("display","none").css("overflow","hidden").css("z-index",c.z_index),c.inlineMode===0&&a("#"+c.id).css("position","fixed").css("width","100%").css("height","100%").css("top",0).css("left",0),c.reload&&a("#"+c.id+" img").remove(),a("#"+c.id+" img").hide().css("position","absolute"),a("#"+c.id).children("img").each(function(){a(this).attr("rel",a.superbg_imgIndex++),c.showtitle||a(this).attr("title","")}),a(this).find("a").each(function(){a(this).attr("rel",a.superbg_imgIndex++).click(function(){return a(this).superbgShowImage(),!1}).addClass("preload")}),a.superbg_imgIndex--,a(window).bind("load",function(){a(this).superbgLoad()}),a(window).bind("resize",function(){a(this).superbgResize()}),a.superbg_isIE6=/msie|MSIE 6/.test(navigator.userAgent),a.superbg_isIE6&&c.inlineMode===0&&(a("#"+c.id).css("position","absolute").width(a(window).width()).height(a(window).height()),a(window).bind("scroll",function(){a(this).superbgScrollIE6()})),c.reload&&a(this).superbgLoad(),this},jQuery.fn.superbgScrollIE6=function(){var b=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options);a("#"+b.id).css("top",document.documentElement.scrollTop+"px")},jQuery.fn.superbgLoad=function(){var b=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options);(a("#"+b.id).children("img").length>0||a("#"+a.superbg_saveId).find("a").length>0)&&a("#"+b.id).show(),typeof b.showimage!="undefined"&&b.showimage>=0&&(a.superbg_imgActual=b.showimage),b.randomimage===1&&(a.superbg_imgActual=1+parseInt(Math.random()*(a.superbg_imgIndex-1+1),10)),a(this).superbgShowImage(a.superbg_imgActual)},jQuery.fn.superbgimagePreload=function(){var b=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options);clearInterval(a.superbg_preload);if(!a.superbg_firstLoaded&&a("#"+a.superbg_saveId).find("a").length>0){a.superbg_preload=setInterval("$(this).superbgimagePreload()",111);return}a("#"+a.superbg_saveId).children("a.preload:first").each(function(){var c=a(this).attr("rel"),d=a(this).attr("title"),e=new Image;a(e).load(function(){a(this).css("position","absolute").hide(),a("#"+b.id).children("img[rel='"+c+"']").length===0&&(a(this).attr("rel",c),b.showtitle===1&&a(this).attr("title",d),a("#"+b.id).prepend(this)),e.onload=function(){}}).error(function(){e.onerror=function(){}}).attr("src",a(this).attr("href")),a.superbg_preload=setInterval("$(this).superbgimagePreload()",111)}).removeClass("preload")},jQuery.fn.startSlideShow=function(){var b=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options);return a.superbg_imgSlide=a.superbg_imgActual,a.superbg_interval!==0&&clearInterval(a.superbg_interval),a.superbg_interval=setInterval("$(this).nextSlide()",b.slide_interval),a.superbg_slideshowActive=!0,!1},jQuery.fn.stopSlideShow=function(){var b=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options);return clearInterval(a.superbg_interval),a.superbg_slideshowActive=!1,!1},jQuery.fn.nextSlide=function(){var b=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options);if(a.superbg_inAnimation)return!1;a.superbg_slideshowActive&&clearInterval(a.superbg_preload),a.superbg_direction=0,a.superbg_imgSlide++,a.superbg_imgSlide>a.superbg_imgIndex&&(a.superbg_imgSlide=1);if(b.randomimage===1){a.superbg_imgSlide=1+parseInt(Math.random()*(a.superbg_imgIndex-1+1),10);while(a.superbg_imgSlide===a.superbg_imgLast)a.superbg_imgSlide=1+parseInt(Math.random()*(a.superbg_imgIndex-1+1),10)}return a.superbg_imgActual=a.superbg_imgSlide,a(this).superbgShowImage(a.superbg_imgActual)},jQuery.fn.prevSlide=function(){var b=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options);if(a.superbg_inAnimation)return!1;a.superbg_direction=1,a.superbg_imgSlide--,a.superbg_imgSlide<1&&(a.superbg_imgSlide=a.superbg_imgIndex);if(b.randomimage===1){a.superbg_imgSlide=1+parseInt(Math.random()*(a.superbg_imgIndex-1+1),10);while(a.superbg_imgSlide===a.superbg_imgLast)a.superbg_imgSlide=1+parseInt(Math.random()*(a.superbg_imgIndex-1+1),10)}return a.superbg_imgActual=a.superbg_imgSlide,a(this).superbgShowImage(a.superbg_imgActual)},jQuery.fn.superbgResize=function(){var b=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options),c=a("#"+b.id+" img.activeslide"),d=a(this).superbgCalcSize(a(c).width(),a(c).height()),e=d[0],f=d[1],g=d[2],h=d[3];a(c).css("width",e+"px"),a(c).css("height",f+"px"),a.superbg_isIE6&&b.inlineMode===0&&(a("#"+b.id).width(e).height(f),a(c).width(e),a(c).height(f)),a(c).css("left",g+"px"),b.vertical_center===1?a(c).css("top",h+"px"):a(c).css("top","0px")},jQuery.fn.superbgCalcSize=function(b,c){var d=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options),e=a(window).width(),f=a(window).height();d.inlineMode===1&&(e=a("#"+d.id).width(),f=a("#"+d.id).height());var g=c/b,h=0,i=0;f/e>g?(h=f,i=Math.round(f/g)):(h=Math.round(e*g),i=e);var j=Math.round((e-i)/2),k=Math.round((f-h)/2),l=[i,h,j,k];return l},jQuery.fn.superbgShowImage=function(b){var c=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options);a.superbg_imgActual=a(this).attr("rel"),typeof b!="undefined"&&(a.superbg_imgActual=b);if(a("#"+c.id+" img.activeslide").attr("rel")===a.superbg_imgActual)return!1;if(a.superbg_inAnimation)return!1;a.superbg_inAnimation=!0;var d="",e="";return a("#"+c.id).children("img[rel='"+a.superbg_imgActual+"']").length===0?(d=a("#"+a.superbg_saveId+" a"+"[rel='"+a.superbg_imgActual+"']").attr("href"),e=a("#"+a.superbg_saveId+" a"+"[rel='"+a.superbg_imgActual+"']").attr("title")):d=a("#"+c.id).children("img[rel='"+a.superbg_imgActual+"']").attr("src"),typeof c.onHide=="function"&&c.onHide!==null&&a.superbg_imgLast>=0&&c.onHide(a.superbg_imgLast),a("#"+c.id+" img.activeslide").superbgLoadImage(d,e),a("#"+a.superbg_saveId+" a").removeClass("activeslide"),a("#"+a.superbg_saveId).children("a[rel='"+a.superbg_imgActual+"']").addClass("activeslide"),a.superbg_imgSlide=a.superbg_imgActual,a.superbg_imgLast=a.superbg_imgActual,!1},jQuery.fn.superbgLoadImage=function(b,c){var d=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options);if(a("#"+d.id).children("img[rel='"+a.superbg_imgActual+"']").length===0){var e=new Image;a(e).load(function(){a(this).css("position","absolute").hide(),a("#"+d.id).children("img[rel='"+a.superbg_imgActual+"']").length===0&&(a(this).attr("rel",a.superbg_imgActual),d.showtitle===1&&a(this).attr("title",c),a("#"+d.id).prepend(this));var b=a("#"+d.id).children("img[rel='"+a.superbg_imgActual+"']"),f=a(this).superbgCalcSize(e.width,e.height);a(this).superbgTransition(b,f),a.superbg_firstLoaded||(d.slideshow===1&&a(this).startSlideShow(),d.preload===1&&a("#"+a.superbg_saveId).find("a").length>0&&(a.superbg_preload=setInterval("$(this).superbgimagePreload()",250))),a.superbg_firstLoaded=!0,e.onload=function(){}}).error(function(){a.superbg_inAnimation=!1,e.onerror=function(){}}).attr("src",b)}else{var f=a("#"+d.id).children("img[rel='"+a.superbg_imgActual+"']"),g=a(this).superbgCalcSize(a(f).width(),a(f).height());a(this).superbgTransition(f,g),a.superbg_firstLoaded||(d.slideshow===1&&a(this).startSlideShow(),d.preload===1&&a("#"+a.superbg_saveId).find("a").length>0&&(a.superbg_preload=setInterval("$(this).superbgimagePreload()",250)),a.superbg_firstLoaded=!0)}},jQuery.fn.getCurrentSlide=function(){return a("#"+a.fn.superbgimage.options.id+" img.activeslide").attr("src")},jQuery.fn.superbgTransition=function(b,c){var d=a.extend(a.fn.superbgimage.defaults,a.fn.superbgimage.options),e=c[0],f=c[1],g=c[2],h=c[3];a(b).css("width",e+"px").css("height",f+"px").css("left",g+"px"),typeof d.onClick=="function"&&d.onClick!==null&&a(b).unbind("click").click(function(){d.onClick(a.superbg_imgActual)}),typeof d.onMouseenter=="function"&&d.onMouseenter!==null&&a(b).unbind("mouseenter").mouseenter(function(){d.onMouseenter(a.superbg_imgActual)}),typeof d.onMouseleave=="function"&&d.onMouseleave!==null&&a(b).unbind("mouseleave").mouseleave(function(){d.onMouseleave(a.superbg_imgActual)}),typeof d.onMousemove=="function"&&d.onMousemove!==null&&a(b).unbind("mousemove").mousemove(function(b){d.onMousemove(a.superbg_imgActual,b)});if(d.randomtransition===1){var i=0+parseInt(Math.random()*(a.superbg_max_randomtrans-0+1),10);while(i===a.superbg_lasttrans)i=0+parseInt(Math.random()*(a.superbg_max_randomtrans-0+1),10);d.transition=i}d.vertical_center===1?a(b).css("top",h+"px"):a(b).css("top","0px");var j=d.transitionout;if(d.transition===6||d.transition===7)j=0;j===1?a("#"+d.id+" img.activeslide").removeClass("activeslide").addClass("lastslide").css("z-index",0):a("#"+d.id+" img.activeslide").removeClass("activeslide").addClass("lastslideno").css("z-index",0),a(b).css("z-index",1),d.transition=parseInt(d.transition,10),a.superbg_lasttrans=d.transition;var k="",l="";d.transition===0?a(b).show(1,function(){typeof d.onShow=="function"&&d.onShow!==null&&d.onShow(a.superbg_imgActual),a.superbg_inAnimation=!1,a.superbg_slideshowActive&&a("#"+d.id).startSlideShow()}).addClass("activeslide"):d.transition===1?a(b).fadeIn(d.speed,function(){typeof d.onShow=="function"&&d.onShow!==null&&d.onShow(a.superbg_imgActual),a("#"+d.id+" img.lastslideno").hide(1,null).removeClass("lastslideno"),a.superbg_inAnimation=!1,a.superbg_slideshowActive&&a("#"+d.id).startSlideShow()}).addClass("activeslide"):(d.transition===2&&(k="slide",l="up"),d.transition===3&&(k="slide",l="right"),d.transition===4&&(k="slide",l="down"),d.transition===5&&(k="slide",l="left"),d.transition===6&&(k="blind",l="horizontal"),d.transition===7&&(k="blind",l="vertical"),d.transition===90&&(k="slide",l="left",a.superbg_direction===1&&(l="right")),d.transition===91&&(k="slide",l="down",a.superbg_direction===1&&(l="up")),a(b).show(k,{direction:l},d.speed,function(){typeof d.onShow=="function"&&d.onShow!==null&&d.onShow(a.superbg_imgActual),a("#"+d.id+" img.lastslideno").hide(1,null).removeClass("lastslideno"),a.superbg_inAnimation=!1,a.superbg_slideshowActive&&a("#"+d.id).startSlideShow()}).addClass("activeslide"));if(j===1){var m=d.speed;d.speed=="slow"?m=800:d.speed=="normal"?m=600:d.speed=="fast"?m=600:m=d.speed+200,d.transition===0?a("#"+d.id+" img.lastslide").hide(1,null).removeClass("lastslide"):d.transition==1?a("#"+d.id+" img.lastslide").fadeOut(m).removeClass("lastslide"):(d.transition===2&&(k="slide",l="down"),d.transition===3&&(k="slide",l="left"),d.transition===4&&(k="slide",l="up"),d.transition===5&&(k="slide",l="right"),d.transition===6&&(k="",l=""),d.transition===7&&(k="",l=""),d.transition===90&&(k="slide",l="right",a.superbg_direction===1&&(l="left")),d.transition===91&&(k="slide",l="up",a.superbg_direction===1&&(l="down")),a("#"+d.id+" img.lastslide").hide(k,{direction:l},m).removeClass("lastslide"))}else a("#"+d.id+" img.lastslide").hide(1,null).removeClass("lastslide")},jQuery.fn.superbgimage.defaults={id:"superbgimage",z_index:0,inlineMode:0,showimage:1,vertical_center:1,transition:1,transitionout:1,randomtransition:0,showtitle:0,slideshow:0,slide_interval:5e3,randomimage:0,speed:"slow",preload:1,onShow:null,onClick:null,onHide:null,onMouseenter:null,onMouseleave:null,onMousemove:null}})(jQuery)