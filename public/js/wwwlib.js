//手机访问二维码
jQuery(document).ready(function($) {

    $(".sjfw").mouseover(function(){
		$(this).siblings(dewmdiv).show();
		
    });

$('.sjfw').mouseout(function(){

		$(this).siblings(dewmdiv).hide();
});


//head-nave全部分类显示隐藏


    $(".category-all").mouseover(function(){

		$(this).children(".category").show();
		
    });

$('.category-all').mouseout(function(){

		$(this).children(".category").hide();



//全部分类列表

    $(".listnav > li").mouseover(function(){

		$(this).children(".below").show();
		
    });

$('.listnav > li').mouseout(function(){

		$(this).children(".below").hide();
});

 });


//list分类 more

  var fl=  $(".listfenlei");
  var btn = $(".more");
  var txt=$(".more > .text");
  var i= $(".more > i")
  btn.click(function() {
                    if ( txt.text() === '更多') {
                    i.addClass("up");  
					fl.addClass("moreshow"); 
                    }
                    if ( txt.text() === '收起') {
                    i.removeClass("up");  
					fl.removeClass("moreshow"); 
                    }
                    if(txt.text() === '收起') {
                        txt.text('更多');
                    } else {
                        txt.text('收起');
                    }
     
});




//产品排序


  var  cppx= $(".cpsortbar > ul > li");
  cppx.click(function() {
	     
	        var th = $(this);
            var bs = th.siblings("li");
    	    var tha = $(this).children("a");
    		var bsa = $(this).siblings().children("a");
    	
    		bs.removeAttr("class"); th.addClass("selected");
			bsa.removeAttr("class"); 
			
  
     if (tha.attr("Class") == "desc") {
                  tha.attr("class", "asc");
                }    
				else
				tha.attr("class", "desc");
     
});


//详情页产品

  var  cpshow= $(".showleft-item > ul > li");
  if(cpshow.length){
  cpshow.mouseover(function() {
	     
	        var cpth = $(this);
    	    var cptha = $(this).children("img");
    		var cpbsa = $(this).siblings().children("img");
			var cpbit = $(this).parent().parent().siblings().find(".jqimg");
    	
			
    		cpbsa.removeAttr("class"); cptha.addClass("active");

             var src = cptha.attr("src");cpbit.attr("src", src);
                     
			
     
});

  
  var  prev=$("#prev"), next=$("#next");
   var per = document.getElementById("tulist");
   var j = per.getElementsByTagName("li").length-7
    var c = per.offsetLeft;      
	var k=parseInt(per.style.left);
     prev.click(function() {
	   per.style.left=(c)+"px";
              
	  });
 
     next.click(function() {
	 per.style.left=(c-j*80)+"px";
	  });}

 });

