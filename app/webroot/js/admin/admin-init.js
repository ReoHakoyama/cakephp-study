$(function(){
  var currentUrl = location.pathname + location.search;
  $('.nav-second-level').hide();
  $('.side-nav li').each(function(){
    var $that = $(this);
    var $ul = $(this).find('ul');
    if($ul.length == 0){
      var u = $(this).find('a').attr('href');
      if(u == currentUrl){ $(this).addClass('active'); }
    }else{
      $ul.find('li').each(function(){
        var u = $(this).find('a').attr('href');
        if(u == currentUrl){
          $ul.show();
          $that.addClass('active');
        }
      });
    }
  });
  $('a.second-level-torriger').click(function(){
    var arrow = $(this).find('span.menu-arrow i');
    if($(this).hasClass('on')){
      arrow.removeClass('fa-caret-down').addClass('fa-caret-left');
      $(this).parent().find('ul.nav-second-level').slideUp('fast');
      $(this).removeClass('on');
    }else{
      arrow.removeClass('fa-caret-left').addClass('fa-caret-down');
      $(this).parent().find('ul.nav-second-level').slideDown('fast');
      $(this).addClass('on');
    }
  });
  setTimeout(function(){
    $("div.flash_success").fadeOut(1000);
  },500);
});
