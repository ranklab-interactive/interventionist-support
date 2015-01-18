$(document).ready(function (){
	//Alternating Rows
	$("#subpage .sub_item:even").addClass("alt");
	
	//FAQ Accordian 1
	$('div.accordian1> div').hide();  
	  $('div.accordian1> h3').click(function() {
	    $(this).next('div').slideToggle('fast')
	    .siblings('div:visible').slideUp('fast');
	});
	
	
	//Tabs
	$('.tab-menu li a').click(function(event) {
	    event.preventDefault();
	    $('.dynamic').hide();
	    $('.tab-menu li a').removeClass('current');
	    var parent = $(event.target).parent();
	    $('.dynamic.' + parent.attr('class')).fadeIn();
	    parent.find('a').addClass('current');
	});
	
	//Form Style
	$("select, input, textarea, select, button, input:checkbox, input:radio, input:file").uniform();
	
	//Geolocation
	/*
	var city = geoplugin_city();
	var state = geoplugin_region();
    $("#geo-promo").append("<span>"+city+"," +state+"</span>");
    $(".promo-large-text").append("<span class='city-state'> "+city+", "+state+"?</span>");
    */
    
    //Filter   
    $('ul#filter a').click(function() {  
        $(this).css('outline','none');  
        $('ul#filter .current').removeClass('current');  
        $('div.directory-cta:not(:last-of-type)').addClass('hide');
        $(this).parent().addClass('current');  
  
        var filterVal = $(this).text().toLowerCase().replace();  
  
        if(filterVal == 'all') {  
            $('ul#interventionists li.hidden').fadeIn('slow').removeClass('hidden'); 
            $('div.directory-cta:not(:last-of-type)').removeClass('hide'); 
        } else {  
            $('ul#interventionists li').each(function() {  
                if(!$(this).hasClass(filterVal)) {  
                    $(this).fadeOut('normal').addClass('hidden');  
                } else {  
                    $(this).fadeIn('slow').removeClass('hidden');  
                }  
            });  
        }  
  
        return false;  
    }); 
    
    //Equal Heights http://www.cssnewbie.com/equalheights-jquery-plugin/
	$(".equal").equalHeights(120,1000);
	
	
	//Content Formatting
	
	//Accordion
	$('div.accordion> div').hide();  
	  $('div.accordion> h3').click(function() {
	    $(this).next('div').slideToggle('fast')
	    .siblings('div:visible').slideUp('fast');
	});
	
	//Content Tabs
	$('.content-tabs .tab-menu li a').click(function(event) {
	    event.preventDefault();
	    $('.dynamic').hide();
	    $('.content-tabs .tab-menu li a').removeClass('current');
	    var parent = $(event.target).parent();
	    $('.dynamic.' + parent.attr('class')).fadeIn();
	    parent.find('a').addClass('current');
	});
});
