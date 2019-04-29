$( document ).ready()
{
  var page = $('.page');
  var nav = $('#nav-box');
  var chapter = $('.show-chapter-Box');
  var navList = $('.nav-list > a');
  var showMenuBtn = $('.show-menu-btn');
  var hideMenuBtn = $('.hide-menu-btn');
  var fullScreenBtn = $('.full-screen');
  var overflowBtn = $('.scroll');
  nav.css({backgroundColor: 'rgba(255, 255, 255, 0.3)'});
  navList.hide();
  showMenuBtn.show();
  overflowBtn.hide();
  showMenuBtn.on('click', function (){
    navList.fadeIn(1500);
    nav.css({backgroundColor: 'white'});
    hideMenuBtn.show();
    showMenuBtn.hide();
  });

  hideMenuBtn.on('click', function (){
    navList.fadeOut(1500);
    nav.css({backgroundColor: 'rgba(255, 255, 255, 0.3)'});
    showMenuBtn.show();
    hideMenuBtn.hide();
  });

  fullScreenBtn.on('click', function (){
    chapter.css({overflow: 'inherit'});
    chapter.css({height: 'auto'});
    chapter.css({width: '100%'});
    fullScreenBtn.hide();
    overflowBtn.show();
    page.css({padding: '0'});
  });

  overflowBtn.on('click', function (){
    chapter.css({overflow: 'auto'});
    chapter.css({height: '80vh'});
    chapter.css({width: '90%'});
    overflowBtn.hide();
    fullScreenBtn.show();
    page.css({padding: '25px'});
  });

}
