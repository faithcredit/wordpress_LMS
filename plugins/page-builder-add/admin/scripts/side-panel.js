( function( $ ) {

if (isPub == "publish") { 
  var btn_text = "Save Page"; 
} else {var btn_text = "Publish Page"; }

var PageStatus  = '<div style="margin:-35px 0 25px 0;"><label>Status :</label><select class="PbPageStatus"><option value="draft">Draft</option><option value="publish">Publish</option><option value="private">Private</option></select></div>';

$('#side-sortables').append('<div id="savePageSide">'+PageStatus+' <div id="SavePageOther" class="btn-green aligncenter large-btn">'+btn_text+'</div></div>');

$sideOptions = $('#sideOptions').html();
$('#side-sortables').append('<div style="min-height:410px; background:#fff; margin-top:25px; border: 3px dashed #7fc9fb;" class="AdvancedOption">'+$sideOptions+'</div>');


$('#side-sortables').append('<br><span style="font-size:16px;padding:0 10px;"> If you are facing 404 page not found error :   <a href="http://pluginops.com/fix-404-page-not-found-error-wordpress/" target="_blank"> Here is how to fix it </a></span> <br>');

$('#side-sortables').append('<br><span style="font-size:15px; padding:0 10px;"> Don\'t like this plugin ? Please share the problem you are facing so we can fix it :   <a href="https://wordpress.org/support/plugin/page-builder-add/#new-topic-0" target="_blank"> Report an Issue </a></span>');

$('#side-sortables').append('<br> <br><span style="font-size:15px; padding:0 10px;"> Love this plugin ? Post your love here :   <a href="https://wordpress.org/support/plugin/page-builder-add/reviews/?rate=5#new-post" target="_blank"> Send Some Love </a></span>');

$('.switch').on('click',function(ev){

  var thisSwitch = $(ev.currentTarget).children('input').attr('class');
  var checkSwitch = $(ev.currentTarget).children('input').attr('checked');
  if (checkSwitch == 'checked') {
  	$(ev.currentTarget).children('input').removeAttr('checked');
  	$(ev.currentTarget).children('input').prop('checked',false);
  	$(ev.currentTarget).children('input').attr('isChecked','false');
  } else{
    $(ev.currentTarget).children('input').attr('checked','checked');
    $(ev.currentTarget).children('input').prop('checked',true);
    $(ev.currentTarget).children('input').attr('isChecked','true');
  }

  return false;

});

$('#SavePageOther').on('click',function(){
  $('#SavePage').trigger('click');
  return false;
});




//$('body').append('<img class="SPopen-btn animated bounce" src="'+pluginURL+'/images/icons/play-left.png" title="Open Side Panel">');
//$('body').append('<img class="SPclose-btn" src="'+pluginURL+'/images/icons/play-right.png" title="Close Side Panel" >');

$('#postbox-container-1').addClass(' animated slideOutRight');

$('.SPopen-btn').on('click',function(){
	$('#postbox-container-1').removeClass('slideOutRight');
	$('#postbox-container-1').addClass('slideInRight');
	$('#postbox-container-1').show(100);
	$('.SPopen-btn').hide();
	$('.SPclose-btn').show();
	$('#postbox-container-1').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
		$('#postbox-container-1').removeClass('slideInRight');
	} );
});

$('.SPclose-btn').on('click',function(){
	$('#postbox-container-1').addClass(' slideOutRight');
	$('.SPclose-btn').hide();
	$('.SPopen-btn').show();
	$('#postbox-container-1').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
		$('#postbox-container-1').removeClass('slideOutRight');
	} );
	$('#postbox-container-1').hide(1200);
});


$('#collapse-menu').trigger('click');
 }( jQuery ) );