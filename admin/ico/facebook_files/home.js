
$(document).ready(function(){

    $('.language-trigger').on('click', function() {
        $('#language-list').stop().fadeToggle();
     });
	
    $('#language-list').on('mouseleave', function() {
        $('#language-list').stop().fadeToggle();
     });
    
    // when language is changed, set cookie reload page immediately
    $("#language-list li").click(function() {
        var lang = $(this).data('lang');
        $.cookie( _profile + "language",lang,{ expires: 365});
        location.reload();
    });
    
	$('#homepage_footer_theme').html(L['Choose a background picture']);
	$('#homepage_footer_preferences').html(L['Preferences']);
	$('#feedback').html(L['Feedback']);
	
	var veerTrackUrl = 'http://offers.veer.com/click.track?CID=134842&AFID=189279&ADID=626009&SID=&NonEncodedURL=';
	var iSearchSuggestionNumber = "8";
	
	$(".q").inputCaption({
		'caption': "", 
		'color': '#aaa'
	});
	
	resize();
	
	$('#pageoption').bind('show', function(oEvent, iPanel) {
	
		var oTabAPI = $("#pageoption ul.tabs").tabs(
			"#pageoption div.panes > div", { initialIndex: iPanel }
		);
		
		var oCBox = jQuery.colorbox({ 
			inline: true, 
			href: "#pageoption", 
			open: true, 
			initialWidth: 10,
			initialHeight: 10,
			width: 600, 
			height: 400,
			opacity: 0.4
		});
		
		oCBox.bind('cbox_closed', function() {
			oCBox.unbind('cbox_closed');
			// reset the bg popup
			setBackgroundDescriptions();
		});
		
	});
	
	$('.buttonlabel').html(L['Search']);
	$('#homepage_app_footer_contact').html(L['Contact Us']);
	if(L['Privacy'] == 'Privacy')
	    L['Privacy'] = 'Privacy Policy';
	$('#homepage_app_footer_privacy').html(L['Privacy']);

    $('.copyright .text').html(customL['copyright']);
    $('#footer_slogan .text').html(customL['Lavasoft']);
    $('#homepage_app_footer_terms').html(customL['Terms']);
    
	$('#search_interface_tab').html(L['Language']);

	$(".searchbutton").click(function(){
		if($(this).siblings(".q").val() !== "")
			$("form").filter(":visible").submit();
	});	
	

	// set focus to active searchbox
	$('#homepage_app_searchbox input.q:visible').focus();
	
	$('.searchtabs').click(function(){
		var feedType = 'web';
		var buttonlabel = 'Web Search';
		
		if($(this).attr('id').indexOf('images') > -1)
		{	
			feedType = 'images';
			buttonlabel = 'Image Search';			
		}
		else if($(this).attr('id').indexOf('videos') > -1)	
		{
			feedType = 'videos';
			buttonlabel = 'Video Search';
		}

//		$('#homepage_app_searchbox .buttonlabel').html(L[buttonlabel]);	
		$('#homepage_app_searchform input[name="searchfeed"]').attr('value', feedType);
		setCurrentTab(feedType);		
		calcSuggestionWidth();
		
	});
			
	function setCurrentTab(feedType){
		$('#homepage_searchtabs .searchtabs').removeClass('current');
		$('#homepage_searchtabs #searchtabs_' + feedType).addClass('current');	
		$('#suggestion_searchtabs .searchtabs').removeClass('current');
		$('#suggestion_searchtabs #suggestiontabs_' + feedType).addClass('current');
	}	

	$('#homepage_app_searchform').submit(function(e){
		if($('.q').val() === '')
			return false;
	
		var form = this;
		e.preventDefault(); // disable the default submit action
	
		var searchType = $('#homepage_app_searchform input[name="searchfeed"]').val();
		_gaq.push([ '_trackEvent','SearchForm', searchType,	$('#q').val() ]);
		_gaq.push([ 'lavasoft._trackEvent','SearchForm', searchType ]);
		
		if(typeof ga === 'function'){
			ga('send', 'event', 'SearchForm', searchType, $('#q').val());
			ga('partner.send', 'event', 'SearchForm', searchType, $('#q').val());
		}
				
		// Blekko workaround: set v-parameter from URL
		$('#homepage_app_searchform input[name=v_blekko]').val($.url.param('v'));
		
		setTimeout(function() { // after 1 second, submit the form
		    form.submit();
		}, 500);
	});
	
	$('#searchtabs_web').html(L['Web Search Link']);
	$('#searchtabs_images').html(L['Images']);
	$('#searchtabs_videos').html(L['Videos']);	

	$('#suggestiontabs_web .content').html(L['Web Search Link']);
	$('#suggestiontabs_images .content').html(L['Images']);
	$('#suggestiontabs_videos .content').html(L['Videos']);	
	
	if($.browser.msie && $.cookie(_profile + 'HomepageBackgroundMakeItHomepage') === null )
	{
		$('#makeHomepage').show();
	}
	
	calcSuggestionWidth();

	// Suggestion handling
	var sLastQuery = '';
	var iSelected = -1;
	
	var applyMouseHandler = function () {
		var oLISuggestion = $(".suggetion .result li");  	
		oLISuggestion.mouseenter(function(oEvent) {
			oLISuggestion.removeClass('selected');
			jQuery(this).addClass('selected');
		});
		oLISuggestion.mouseleave(function(oEvent) {
			jQuery(this).removeClass('selected');
		});
		oLISuggestion.click(function(oEvent) {
			iSelected = jQuery(this).index(); 
			$(".q").val(jQuery(this).text());
			sLastQuery = jQuery(this).text();
			$("form").filter(":visible").submit();
		});
	};

	
	var onYahooResult = function(a, oULResult, sQuery) {

		// if there is no results, hide suggestion-list
		if(typeof a == 'undefined' || typeof a.searchresults == 'undefined' || typeof a.searchresults.AlsoTryData == 'undefined')
		{
			$(".suggetion").hide();
			return;
		}
		
		oULResult.empty();
		for(var i in a.searchresults.AlsoTryData) {
			var sSuggestion = a.searchresults.AlsoTryData[i];
			sSuggestionLower = sSuggestion.toLowerCase();
			var iPos = sSuggestionLower.indexOf(sQuery.toLowerCase());
			var sFinal = '';
			if(iPos < 0)
				sFinal = sSuggestion;
			else
				sFinal =  sSuggestion.substr(0, iPos)+ "<strong>"+ sSuggestion.substr(iPos, iPos + sQuery.length)+"</strong>"+ sSuggestion.substr(iPos + sQuery.length);
			oULResult.append("<li>"+ sFinal +"</li>");
		}
		
		applyMouseHandler();				
		if (sQuery) {
			$(".suggetion").slideDown();
		} else {
			$(".suggetion").slideUp();
		}
	};
	
	$(".q").keyup(function(oEvent) {
		var sQuery = jQuery(this).val();
		if(sQuery.length <= 0)
			return false;
	
		var oULResult = $(".suggetion ul.result");
		if(sLastQuery != sQuery)
		{ 
			jQuery.getJSON(_api_url +
				'get_alternative_searchterms/?q=' + escape(sQuery) + '&limit='+ iSearchSuggestionNumber + '&callback=?',
				function(a) { onYahooResult(a, oULResult, sQuery); }
			);
			iSelected = -1;
		}

		sLastQuery = sQuery;
	
		if (oEvent.which == 40 || oEvent.which == 38) { // up or down
			iSelectedNew = (oEvent.which == 40 ? iSelected+1: iSelected-1); // 40=down
			var numItems = $(".suggetion ul.result li").length;
			if (iSelectedNew >= 0 && iSelectedNew < numItems) 
			{
				oULResult.find("li:eq("+ iSelected+ ")").removeClass('selected');
				iSelected = (oEvent.which == 40 ? iSelected+1: iSelected-1);
				var oLISelected = oULResult.find("li:eq("+ iSelected+ ")").addClass('selected');
				$(this).val(oLISelected.text());
				sLastQuery = oLISelected.text(); 
			}
		}
		
		if (oEvent.which == 13) {
			$("form").filter(":visible").submit();
		}
		
		if (oEvent.which == 27) {
			$(".suggetion").slideUp();
		}
		
	});

	$('body').click(function(e) {
		// when anything is clicked, except the searchtabs, then remove the suggestions
		if($(e.target).isChildOf('#homepage_searchtabs') === false)
			$(".suggetion").slideUp();
	});

	$('.sbq-x').click(function(){
		$('.q').val('');
	});
	
	function calcSuggestionWidth(){
		// JS Fix of width suggestion width base on button space 	
		var pos1 = $(".searchbutton:visible").offset().left;
		var pos2 = $("#searchBoxInputArea").offset().left;
		var iInputFieldWidth = pos1 - pos2;
		iInputFieldWidth -= 30;
		
		$('.q').css('width', iInputFieldWidth + 'px'); 	
		$(".suggetion").css('width', iInputFieldWidth + 8 + 'px'); 
	}
	
	$("#suggestion_searchtabs").show();
		
	
	(function($) {
	    $.fn.extend({
	        isChildOf: function( filter_string ) {
	          
	          var parents = $(this).parents().get();
	         
	          for ( j = 0; j < parents.length; j++ ) {
	           if ( $(parents[j]).is(filter_string) ) {
	      return true;
	           }
	          }
	          
	          return false;
	        }
	    });
	})(jQuery); 
	
	var TopValue = 0;
	var BottomValue = 0;
	var EndUserModifyable = "";
	
	if($("#homepage_topbar").length !== 0 || $("#homepage_searchfeedbar").length !== 0) {
		var heightTb = $("#homepage_topbar").height();
		var heightSfb = $("#homepage_searchfeedbar").height();
		var height = heightTb + heightSfb;
		TopValue += height;
	}
	
	if($("#homepage_logoarea").length !== 0) {
		TopValue += $("#homepage_logoarea").outerHeight();
	}
	
	if($("#homepage_app_footer").length !== 0) {
		BottomValue += 35;
		if($("#footer_logo").length !== 0) {
			BottomValue += 66;
		}
	}
	
	$("#homepage_background").css("top", 0);
	$("#homepage_background").css("bottom", 0);
	
	
	$('#thumbs img').click(function(){
		$('.like_count, .unlike_count').hide();
	});
	
	$('#nextslide').click(function(){
		$('#thumbs').nextSlide();
	});
	
	$('#prevslide').click(function(){
		$('#thumbs').prevSlide();
	});
	
	/**
		This is some stuff for the popup
	**/
	$(function () {
		  $('.bubbleInfo').each(function () {
		    // options
		    var distance = 5;
		    var time = 250;
		    var hideDelay = 500;
		    var opacity = 0.9;
		
		    var hideDelayTimer = null;
		
		    // tracker
		    var beingShown = false;
		    var shown = false;
		    
		    var trigger = $('.trigger', this);
		    var popup = $('.popup', this).css('opacity', 0);
		
		    // set the mouseover and mouseout on both element
		    $([trigger.get(0), popup.get(0)]).mouseover(function () {
		      // stops the hide event if we move from the trigger to the popup element
		      if (hideDelayTimer) clearTimeout(hideDelayTimer);
		
		      // don't trigger the animation again if we're being shown, or already visible
		      if (beingShown || shown) {
		        return;
		      } else {
		        beingShown = true;
		
		        // reset position of popup box
		        popup.css({
		          display: 'block' // brings the popup back in to view
		        })
		
		        // (we're using chaining on the popup) now animate it's opacity and position
		        .animate({
		          bottom: '+=' + distance + 'px',
		          opacity: opacity
		        }, time, 'swing', function() {
		          // once the animation is complete, set the tracker variables
		          beingShown = false;
		          shown = true;
		        });
		      }
		    }).mouseout(function () {
		      // reset the timer if we get fired again - avoids double animations
		      if (hideDelayTimer) clearTimeout(hideDelayTimer);
		      
		      // store the timer so that it can be cleared in the mouseover if required
		      hideDelayTimer = setTimeout(function () {
		        hideDelayTimer = null;
		        popup.animate({
		          bottom: '-=' + distance + 'px',
		          opacity: 0
		        }, time, 'swing', function () {
		          // once the animate is complete, set the tracker variables
		          shown = false;
		          // hide the popup entirely after the effect (opacity alone doesn't do the job)
		          popup.css('display', 'none');
		        });
		      }, hideDelay);
		    });
		  });
	});
	
	$( window ).resize(function() {
		resize();
	});
	
	function resize(){
		var top = $('#homepage_app_searchbox').offset().top;
		$('#lavasoft_iframe').css('top',top + 40 + 'px');
		$('#lavasoft_widget').css('top',top + 200 + 'px');		
	}


	if(_language == 'en')
	    $('#find-best').fadeIn('slow');
	
	$('#find-best .link').click(function(e){
		_gaq.push(['_trackEvent', 'SearchSafelyLink', 'clicked']);
		_gaq.push(['lavasoft._trackEvent', 'SearchSafelyLink', 'clicked']);
		
		setTimeout(function() { 
			// do nothing
		}, 500);
		return true;
	});
	
}); 