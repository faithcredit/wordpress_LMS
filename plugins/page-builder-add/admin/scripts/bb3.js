
pageBuilderApp.ifChangesMade = false;

try {
  jQuery.fn.extend({
    live: function (event, callback) {
       if (this.selector) {
            jQuery(document).on(event, this.selector, callback);
        }
        return this;
    }
  });
} catch(e) {
  console.log(e);
}


pageBuilderApp.isEditingPanelOpen = false;
function convertToCamelCase(str) {
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
}

function popb_check_hasNumber(myString) {
  return /\d/.test(myString);
}




function enabledraggableWidgets(){

  jQuery('.widget-Draggable').draggable({
    helper: function(event){
      var thisELE  = jQuery(event.currentTarget);
          
      var elMarigns  = thisELE.css('margin-top') + ' ' + thisELE.css('margin-right') + ' ' +thisELE.css('margin-bottom') + ' ' +thisELE.css('margin-left');

      return jQuery("<div class='widgetDragHelper' style=' padding: 15px; background: #95CDF8; border-radius: 100px; z-index:9998;'> <span class='dashicons dashicons-move' style='color:#fff;' title='Move'></span> </div>");
    }, 
    cursor: "move",
    appendTo: "#container",
    handle:'.widgetMoveHandle',
    start: function(event,ui){
      jQuery(this).draggable('instance').offset.click = {
        left: Math.floor(ui.helper.width() / 2) +15,
        top: Math.floor(ui.helper.height() / 2) +15
      }; 

      jQuery(event.target).attr('style','display:none;');
      jQuery('.isDroppedOnDroppable').val('false');
      jQuery(this).children('.draggableWidgets').trigger('click');
    },
    stop: function(event,ui){
      jQuery('.droppableBelowWidget').css('display','none');

      var isDroppedOnDroppable = jQuery('.isDroppedOnDroppable').val();

      if (isDroppedOnDroppable != 'true') {
        jQuery(event.target).attr('style','display:block;');
      }
    },

  });

}


function enableColumnDroppable(rowColContainerID){
  jQuery('#'+rowColContainerID+' .column').droppable({
    accept: ".widget-Draggable",
    snap:'.column',
    drop: function(){
      var curr_droppable = jQuery(this).attr('id');
      jQuery('.widgetDroppedAtIndex').val('');
      jQuery('.isDroppedOnDroppable').val('true');
      jQuery('#'+curr_droppable +' .wdgt-dropped').trigger('click');
    },
    over: function(){
      var curr_droppable = jQuery(this).attr('id');
      jQuery('#'+curr_droppable+ " .droppableEmptyColumn").slideDown(250);
    },
    out: function(){
      var curr_droppable = jQuery(this).attr('id');
      jQuery('#'+curr_droppable+ " .droppableEmptyColumn").css('display','none');
    }

  });
  
}

function resizeWindowOpen(){
  var currentVPSPageOps = jQuery('.currentViewPortSize').val();
  if (currentVPSPageOps == 'rbt-l') {
    jQuery('.pb_editor_tab_content #tab1').css({
      'width':'calc(100% - 416px)',
      'float':'right'
    });

    jQuery('.extraTopBarSpaceDivider').css('display','block');
    jQuery('.extraTopBarSpaceDividerTwo').css('display','none');
  }

  pageBuilderApp.isEditingPanelOpen = true;
}

function resizeWindowClose(){
  var currentVPSPageOps = jQuery('.currentViewPortSize').val();
  if (currentVPSPageOps == 'rbt-l') {
    jQuery('.pb_editor_tab_content #tab1').css({
      width:'100%',
    });
    jQuery('.pb_editor_tab_content #tab1').css({
      'float':'unset'
    });

    jQuery('.extraTopBarSpaceDivider').css('display','none');
    jQuery('.extraTopBarSpaceDividerTwo').css('display','block');
  }

  pageBuilderApp.isEditingPanelOpen = false;
}

function hideWidgetOpsPanel(){
  jQuery('.columnWidgetPopup').css('display','none');
  jQuery('.editWidgetSaveButton').css('display','none');
  pageBuilderApp.widgetsPanelOpen = false;
}


function showWidgetOpsPanel(){
  jQuery('.columnWidgetPopup').css('display','block');
  jQuery('.editWidgetSaveButton').css('display','block');
  jQuery('.edit_row, .ulpb_row_controls').css('display','none');
  jQuery('.pageops_modal, .closePageOpsBtn').css('display','none');
  pageBuilderApp.widgetsPanelOpen = true;
}



var pbWrapperWidth = jQuery('#container').width();

( function( $ ) {


jQuery(document).ready(function() {


    $('.pb_fullScreenEditorButton').css('display','block');
    $('.pb_loader_container_pageload').css('display','none');


    $('.tabAdvancedWidgetOptionsTab').on('click',function(){

      var thisWidgetIndex = pageBuilderApp.currentlyEditedWidgId;
      thisWidgetIndex = parseInt(thisWidgetIndex);
      $('#widgets li:nth-child('+(thisWidgetIndex+1)+')').children().children('.wdt-edit-controls').children('#updateWidgetAdvancedOps').trigger('click');

    });


    $('.thisColumnWidgetsTab').on('click',function(){

      $('#'+pageBuilderApp.currentlyEditedColId).children('.thisColumnWidgetsTabTrigger').trigger('click');
      
    });

    if (thisPostType == 'ulpb_post') {
      jQuery('.postbox-container').css('display','none');
    }
    jQuery('.pluginops-tabs .pluginops-tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        jQuery('.pluginops-tabs ' + currentAttrValue).show().siblings().css('display','none');
 
        jQuery(this).parent('li').addClass('pluginops-active').siblings().removeClass('pluginops-active');
 
        e.preventDefault();
    });

    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        jQuery('.tabs ' + currentAttrValue).show().siblings().css('display','none');
 
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });

    jQuery('.pluginops-tabs2 .pluginops-tab2-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        jQuery('.pluginops-tabs2 ' + currentAttrValue).show().siblings().css('display','none');
 
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });

    jQuery('.TemplateTabs .Templatetab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.TemplateTabs ' + currentAttrValue).show().siblings().css('display','none');
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });

    
    jQuery(document).on('click','.pb_img_thumbnail',function(){
      var clikedElID = jQuery(this).attr('id');
      jQuery('#pb_lightbox'+clikedElID).css('display','block');
    });

    jQuery(document).on('click','.pb_single_img_lightbox',function(){
      jQuery(this).css('display','none');
    });

});

var liveEditorGlobal = {};
liveEditorGlobal.lastEditedEl = '';
liveEditorGlobal.multiFontArray = [];

$('.linkfieldBtn').on('click',function(ev){
  var clickedEl = $(this);
  if (clickedEl.is('span')) {
    if (clickedEl.hasClass('linkedBtn') ) {
      clickedEl.removeClass('linkedBtn');
    }else{
      clickedEl.addClass('linkedBtn');
    }
  }else{
    clickedEl = $(this).parent('span');
    if (clickedEl.hasClass('linkedBtn') ) {
      clickedEl.removeClass('linkedBtn');
    }else{
      clickedEl.addClass('linkedBtn');
    }
  }
});



/* ----------- Live Text Editor Starts Here -------------- */

  function getSelectionParentElement() {
      var parentEl = null, sel;
      if (window.getSelection) {
          sel = window.getSelection();
          if (sel.rangeCount) {
              parentEl = sel.getRangeAt(0).commonAncestorContainer;
              if (parentEl.nodeType != 1) {
                  parentEl = parentEl.parentNode;
              }
          }
      } else if ( (sel = document.selection) && sel.type != "Control") {
          parentEl = sel.createRange().parentElement();
      }
      return parentEl;
  }

  function applyStylesOnSelectedEl(action, value , el){

    if (action == 'bold') {
      if (value == true) {
        $(el).css('font-weight', 'bold');
      }else{
        $(el).css('font-weight', 'normal');
      }
    }
    if (action == 'italic') {
      if (value == true) {
        $(el).css('font-style', 'italic');
      }else{
        $(el).css('font-style', '');
      }
    }
    if (action == 'underlined') {
      if (value == true) {
        $(el).css('text-decoration', 'underline');
      }else{
        tagName = $(el).prop('tagName');
        if (tagName == 'a' || tagName == 'A') {
          $(el).css('text-decoration', 'none');
        }else{
          $(el).css('text-decoration', '');
        }
      }
    }
    if (action == 'strike') {
      if (value == true) {
        $(el).css('text-decoration', 'line-through');
      }else{
        tagName = $(el).prop('tagName');
        if (tagName == 'a' || tagName == 'A') {
          $(el).css('text-decoration', 'none');
        }else{
          $(el).css('text-decoration', '');
        }
      }
    }
    parentElAlignment = $(el).parent().css('text-align');
    ispbTextWidget = false;
    if ( $(el).parent().hasClass('pb-text-widget') ) {
      ispbTextWidget = true;
    }
    pageBuilderApp.pbTextAlignment = false;

    if (action == 'alignLeft') {
      if (value == true) {
        $(el).css('text-align', 'left');
        if (ispbTextWidget == true) {
          pageBuilderApp.pbTextAlignment = 'left';
          $(el).parent().css('text-align', 'left');
        }
      }else{
        $(el).css('text-align', '');
      }
    }
    if (action == 'alignCenter') {
      if (value == true) {
        $(el).css('text-align', 'center');
        if (ispbTextWidget == true) {
          pageBuilderApp.pbTextAlignment = 'center';
          $(el).parent().css('text-align', 'center');
        }
      }else{
        $(el).css('text-align', '');
      }
    }
    if (action == 'alignRight') {
      if (value == true) {
        $(el).css('text-align', 'right');
        if (ispbTextWidget == true) {
          pageBuilderApp.pbTextAlignment = 'right';
          $(el).parent().css('text-align', 'right');
        }
      }else{
        $(el).css('text-align', '');
      }
    }

    if (action == 'fontTag') {
      oldStyles = $(el).attr('style');
      if (typeof(oldStyles) == 'undefined') {
        oldStyles = '';
      }
      tagCustomAttr = '';
      var editedElInnerHtml = el.innerHTML;
      if (typeof(editedElInnerHtml) == 'undefined') {
        editedElInnerHtml = $(el).text();
        oldStyles = $(el).html();
        oldStyles = $(oldStyles).attr('style');
        if (typeof(oldStyles) == 'undefined') {
          oldStyles = '';
        }
      }

      if (oldStyles == '' ) {
        if ( $(el).parents('.pb-text-widget').length ) {
           
          oldStyles = 'font-size:inherit; color:inherit; line-height:inherit; font-family:inherit;';
        }
          
      }

      if (value == 'a') { tagCustomAttr = 'href="#" '; }
      oldStyles = oldStyles.replace(/"/g,"");
      $(el).replaceWith( $('<'+value+'  '+tagCustomAttr+'  style="'+oldStyles+'" class="elLtWrapped" >' + editedElInnerHtml + '</'+value+'>') );
      $('.wltControls').html('');
      $('.liveEditorActive').siblings('.inlineEditingSaveTrigger ').trigger('click');
      $('.wltControls').removeClass('liveEditorActive');``
    }
    if (action == 'fontSize') {
      if (value == '' || value == '0') {value = ''; }else{ value = value+'px'; }
      $(el).css('font-size', value);
    }
    if (action == 'fontLineHeight') {
      if (value == '' || value == '0') {value = ''; }else{ value = value+'px'; }
      $(el).css('line-height', value);
    }
    if (action == 'fontLSpace') {
      if (value == '' || value == '0') {value = ''; }else{ value = value+'px'; }
      $(el).css('letter-spacing', value);
    }
    if (action == 'fontColor') {
      $(el).css('color', value);
    }
    if (action == 'linkUrl') {
      tagName = $(el).prop('tagName');
      if (value == '') {  value='#'; }
      if (tagName == 'A' || tagName == 'a') {  $(el).attr('href',value);}
    }
    if (action == 'fontFamily') {
      if (value != '' && value != 'Select' && value != 'Arial' && value != 'Arial Black' && value != 'sans-serif' && value != 'Helvetica' && value != 'Serif' && value != 'Tahoma' && value != 'Verdana' && value != 'Monaco') {
        valuefClass = value.replace(/\+/g, '');
        fontScript = "<link rel='stylesheet' href='https://fonts.googleapis.com/css?family="+value+"' class=loadedfont-"+valuefClass+">";
        if ($('.loadedfont-'+valuefClass).length > 0 && value != 'Select') {}else{
          $(el).parents('.liveTextWrap').find('.ltwFontScript').append(fontScript);
        }
      }
      value = value.replace(/\+/g, ' ');
      if (value == 'Select') { value = ''; }
      $(el).css('font-family', value);
    }

  }

  function editSelectedTextHTML(action, value,modeOfChange) {

    var parentOfSelected = getSelectionParentElement();
    var htmlContents = $(parentOfSelected).html();
    
    try{
      var range = getSelection().getRangeAt(0);
      var contents = range.cloneContents();
      var selectionfound = true;
    } catch(err){
      var contents = '';
      var selectionfound = false;
    }

    var testSpanEl = document.createElement("span");
    testSpanEl.appendChild( contents );
    contents = $(testSpanEl).html();

    if ($(parentOfSelected).parents('.eltEditable').length > 0) {
    }else{
      return;
    }

    if ( $(parentOfSelected).hasClass('elLtWrapped') ) {
      
      if (htmlContents != contents) {
        if (contents == '') {
          applyStylesOnSelectedEl(action, value , parentOfSelected);
        }else{
          var childSpanEl = document.createElement("span");
          var range = getSelection().getRangeAt(0);
          childSpanEl.className = 'elLtWrapped';
          childSpanEl.appendChild(range.extractContents());
          range.insertNode(childSpanEl);
          applyStylesOnSelectedEl(action, value , childSpanEl);
          document.getSelection().removeAllRanges();
          $('.wltBold').prop('checked', false);
        }
      }else{
        applyStylesOnSelectedEl(action, value , parentOfSelected);
      }
    }else{
      if (contents == '') {
        $(parentOfSelected).addClass('elLtWrapped');
        applyStylesOnSelectedEl(action, value , parentOfSelected);
      }else{
        var childSpanEl = document.createElement("span");
        var range = getSelection().getRangeAt(0);
        childSpanEl.className = 'elLtWrapped';
        childSpanEl.appendChild(range.extractContents());
        range.insertNode(childSpanEl);
        applyStylesOnSelectedEl(action, value , childSpanEl);
        document.getSelection().removeAllRanges();
        
        if ( $('.wltBold').is(':checked') ) {
          $('.wltBold').trigger('click');
          $('.wltBold').prop('checked', false);
        }
      }
        
    }

  }

  function getSelectedTextHTML() {

    var parentOfSelected = getSelectionParentElement();
    var htmlContents = $(parentOfSelected).html();
    
    try{
      var range = getSelection().getRangeAt(0);
      var contents = range.cloneContents();
      var selectionfound = true;
    } catch(err){
      var contents = '';
      var selectionfound = false;
    }

    var testSpanEl = document.createElement("span");
    testSpanEl.appendChild( contents );
    contents = $(testSpanEl).html();

    if ($(parentOfSelected).parents('.eltEditable').length > 0) {
    }else{
      return;
    }

    if ( $(parentOfSelected).hasClass('elLtWrapped') ) {
      
      if (htmlContents != contents) {
        if (contents == '') {
          
        }else{
          var childSpanEl = document.createElement("span");
          var range = getSelection().getRangeAt(0);
          childSpanEl.className = 'elLtWrapped';
          childSpanEl.appendChild(range.extractContents());
          range.insertNode(childSpanEl);
          var parentOfSelected = childSpanEl;
        }
      }else{
        
      }
    }else{
      if (contents == '') {
        tagName = $(parentOfSelected).prop('tagName');
        tagName = tagName.toLowerCase();

        if (tagName == 'em' || tagName == 'B' || tagName == 'strong') {
          parentOfSelected = $(parentOfSelected).parent();
        }

        secondParentOfEl = $(parentOfSelected).parent();
        secondParenttagName = $(secondParentOfEl).prop('tagName');
        secondParenttagName = secondParenttagName.toLowerCase();

        if (secondParenttagName == 'h1' || secondParenttagName == 'h2' || secondParenttagName == 'h3' || secondParenttagName == 'h4' || secondParenttagName == 'h5' || secondParenttagName == 'h6' || secondParenttagName == 'p' || secondParenttagName == 'a') {
          parentOfSelected = secondParentOfEl;
        }

        $(parentOfSelected).addClass('elLtWrapped');
        
      }else{
        var childSpanEl = document.createElement("span");
        var range = getSelection().getRangeAt(0);
        childSpanEl.className = 'elLtWrapped';
        childSpanEl.appendChild(range.extractContents());
        range.insertNode(childSpanEl);
        var parentOfSelected = childSpanEl;
      }
        
    }


    return parentOfSelected;

  }

  function getStylesSelectedEl(){
    var parentOfSelected = getSelectionParentElement();
    var fontweight = '', fontstyle = '',textdecoration = '', tagName = '';

    if ( $(parentOfSelected).hasClass('elLtWrapped') ) {
      var fontweight = $(parentOfSelected).css('font-weight');
      var fontstyle = $(parentOfSelected).css('font-style');
      var textdecoration = $(parentOfSelected).css('text-decoration');
    }

    var alignmentVal = $(parentOfSelected).css('text-align');
    var tagName = $(parentOfSelected).prop("tagName");
    var fontSize = $(parentOfSelected).css("font-size");
    var lineHeight = $(parentOfSelected).css("line-height");
    var letterSpacing = $(parentOfSelected).css("letter-spacing");
    var fontColor = $(parentOfSelected).css("color");
    var fontFamily = $(parentOfSelected).css("font-family");
    var linkUrl = $(parentOfSelected).attr('href');

    var returnValue  = {
      fontweight : fontweight,
      fontstyle : fontstyle,
      textdecoration : textdecoration,
      tagName : tagName,
      fontSize:fontSize,
      lineHeight: lineHeight,
      letterSpacing: letterSpacing,
      fontColor: fontColor,
      fontFamily: fontFamily,
      alignment: alignmentVal,
      linkUrl: linkUrl
    }

    return returnValue;
  }

  // Add Controls to editor
  $(document).on('click','.liveTextWrap',function(ev){

    thisControls  =  $(this).prev('.wltControls');
    var parentOfSelected = getSelectedTextHTML();
    liveEditorGlobal.lastEditedEl = parentOfSelected;
    $('.elLtWrapped').removeAttr('data-mce-style');
    $('.liveTextActive').removeClass('liveTextActive');
    $(this).addClass('liveTextActive');
    
    var currentClickedTextELPos = $(ev.target).position();
    $('.wltControls').css('margin-top', currentClickedTextELPos.top - 60 );

    if ( pageBuilderApp.isInlineSavingActive == true ) {
    }else{

      var thisTextElPosition = $(this).offset().top;
      if (thisTextElPosition < 140) {
        wltControlsMarginTop = $(this).outerHeight()+50;
      }else{
        wltControlsMarginTop = "-70px";
      }

      if (pageBuilderApp.widgetsPanelOpen == true) {
        hideWidgetOpsPanel();
        resizeWindowClose();
      }
      
      

      $(this).prev('.wltControls').css('margin-top',wltControlsMarginTop);

      $('.wltControls').html('');
      $('.wltControls').removeClass('liveEditorActive');
      $(this).prev('.wltControls').append("<div class='wltInnerControls '> "+
        "<label for='wltBold' class='wltControlLabels '> <b>B</b> </label>"+
        "<input type='checkbox' id='wltBold' class='wltBold wlt_checkbox wlt-btn'  >"+
        "<label for='wltItalic' class='wltControlLabels '> <i>I</i> </label>"+
        "<input type='checkbox' id='wltItalic' class='wltItalic wlt_checkbox wlt-btn' >"+
        "<label for='wltUnderlined' class='wltControlLabels '> <span style='text-decoration: underline;'>U</span> </label>"+
        "<input type='checkbox' id='wltUnderlined' class='wltUnderlined wlt_checkbox wlt-btn'  >"+
        "<label for='wltStrike' class='wltControlLabels '> <span style='text-decoration: line-through;'>U</span> </label>"+
        "<input type='checkbox' id='wltStrike' class='wltStrike wlt_checkbox wlt-btn'  >"+
        "<label for='wltAlignLeft' class='wltControlLabels '> <span class='dashicons dashicons-editor-alignleft'></span> </label>"+
        "<input type='checkbox' id='wltAlignLeft' class='wltAlignLeft wlt_checkbox wlt-btn'  >"+
        "<label for='wltAlignCenter' class='wltControlLabels '> <span class='dashicons dashicons-editor-aligncenter'></span> </label>"+
        "<input type='checkbox' id='wltAlignCenter' class='wltAlignCenter wlt_checkbox wlt-btn'  >"+
        "<label for='wltAlignRight' class='wltControlLabels '> <span class='dashicons dashicons-editor-alignright'></span> </label>"+
        "<input type='checkbox' id='wltAlignRight' class='wltAlignRight wlt_checkbox wlt-btn'  >"+
        "<div class='wltDropdown'>"+
          "<div class='wltDTitle'><i class='fa fa-angle-double-down'></i></div>"+
          "<div class='wltDContent'> "+
            "<div class='wltDFields'> "+
              "<div class='wltdropContent-divide'> "+
                "<input class='wltFontFamily wltCInput' id='wltFontFamily'>"+
              "</div>"+
              "<div class='wltdropContent-divide'> "+
                "<label for='wltFontTag'> Typography </label>"+
                "<select class='wltCInput wltcSelect wltFontTag' id='wltFontTag' >"+
                  "<option value='p'>Paragraph</option>"+
                  "<option value='span'>Span (Inline)</option>"+
                  "<option value='a'>Link</option>"+
                  "<option value='h1' style='font-size:2.5em;'>H1 (XX Large)</option>"+
                  "<option value='h2' style='font-size:2em;'>H2 (X Large)</option>"+
                  "<option value='h3' style='font-size:1.7em;'>H3 (Large)</option>"+
                  "<option value='h4' style='font-size:1.5em;'>H4 (Medium)</option>"+
                  "<option value='h5' style='font-size:1.2em;'>H5 (Small)</option>"+
                  "<option value='h6' style='font-size:1em;'>H6 (V Small)</option>"+
                "</select> <br>"+
                "<div class='wltFontLinkContainer' style='display:none;'>"+
                  "<label for='wltFontLink'> Link URL </label>"+
                  "<input id='wltFontLink' class='wltFontLink wltCInput wltcSelect'>"+
                "</div>"+
                "<div class='wltdropContent-divide'>"+
                  "<label for='wltcFsize'> Size </label>"+
                  "<input type='number' class='wltcFsize wltCInput wltCIsmall' id='wltcFsize'> <br>"+
                  "<label for='wltcFcolor'> Color </label>"+
                  "<input type='text' class='color-picker_btn_two wltcFcolor' id='wltcFcolor'>"+
                "</div>"+
                "<div class='wltdropContent-divide'>"+
                  "<label for='wltcFlineHeight'> Line Height </label>"+
                  "<input type='number' class='wltcFlineHeight wltCInput wltCIsmall' id='wltcFlineHeight'><br>"+
                  "<label for='wltcLspacing'> Letter Space </label>"+
                  "<input type='number' class='wltcLspacing wltCInput wltCIsmall' id='wltcLspacing'>"+
                "</div>"+
              " </div>"+
            "</div> "+
          " </div> "+
        "</div>"+
      " </div>");

      $('.wltcFcolor').spectrum({ 
        showButtons: false,
        showAlpha: true,
        showInput: true, 
        showPalette: true,
        showSelectionPalette:false,
        palette: [
            ['white', 'black', '#264653', '#339D8F', '#E9C46A', '#F4A261', '#E76F51'],
        ],
        move: function(tinycolor){ var field_id = $(this).attr('id');  $('#'+field_id).val( tinycolor.toRgbString() );  $('#'+field_id).trigger('change'); },
        });

      $('.wltFontFamily').fontselect({
        style: 'font-select',
        placeholder: 'Select a font',
        placeholderSearch: 'Search...',
        lookahead: 1,
        searchable: true,
        localFontsUrl: '/fonts/' // End with a slash!
      });

      $(this).prev('.wltControls').addClass('liveEditorActive');
      $('.wlt_checkbox').checkboxradio({
          icon: false
      });

      $('.widgetHandle').css('display','none');
      $('.editColBtnTop').css('display','none'); 

      $(' .wltControls ').on('mouseover',function(){
        $('.widgetHandle').css('display','none');
        $('.editColBtnTop').css('display','none');
      });

      pageBuilderApp.isInlineSavingActive = true;

      $('body').on('click', function(evta){

        if ($(evta.target).parents('.liveTextActive').length > 0 || $(evta.target).parents('.wltControls').length > 0){
        }else{
          liveEditorGlobal.lastEditedEl = '';
          pageBuilderApp.isInlineSavingActive = false;
          $('.wltControls').html('');
          $('.liveEditorActive').siblings('.inlineEditingSaveTrigger ').trigger('click');
          $('.wltControls').removeClass('liveEditorActive');
          $('.liveTextActive').removeClass('liveTextActive');
        }
        
      });

    }

    var thisSelectedStyles = getStylesSelectedEl();
    if (thisSelectedStyles['fontweight'] == '700' && $('.wltBold').is(':checked') != true ) { 
      $('.wltBold').prev('label').addClass('ui-checkboxradio-checked ui-state-active');
      $('.wltBold').prop('checked', true); 
    }else if (thisSelectedStyles['fontweight'] != '700' && $('.wltBold').is(':checked') == true ) {
      $('.wltBold').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltBold').prop('checked', false);
    }

    if (thisSelectedStyles['fontstyle'] == 'italic' && $('.wltItalic').is(':checked') != true ) { 
      $('.wltItalic').prev('label').addClass('ui-checkboxradio-checked ui-state-active');
      $('.wltItalic').prop('checked', true); 
    }else if (thisSelectedStyles['fontstyle'] != 'italic' && $('.wltItalic').is(':checked') == true ) {
      $('.wltItalic').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltItalic').prop('checked', false);
    }

    textdecorationvalue = thisSelectedStyles['textdecoration'].indexOf('underline', 0);
    textstrikevalue = thisSelectedStyles['textdecoration'].indexOf('line-through', 0);

    if (textdecorationvalue != -1 && $('.wltUnderlined').is(':checked') != true ) { 
      $('.wltUnderlined').prev('label').addClass('ui-checkboxradio-checked ui-state-active');
      $('.wltUnderlined').prop('checked', true); 
    }else if (textdecorationvalue == -1 && $('.wltUnderlined').is(':checked') == true ) {
      $('.wltUnderlined').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltUnderlined').prop('checked', false);
    }


    if (textstrikevalue != -1 && $('.wltStrike').is(':checked') != true ) { 
      $('.wltStrike').prev('label').addClass('ui-checkboxradio-checked ui-state-active');
      $('.wltStrike').prop('checked', true); 
    }else if (textstrikevalue == -1 && $('.wltStrike').is(':checked') == true ) {
      $('.wltStrike').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltStrike').prop('checked', false);
    }

    
    if (thisSelectedStyles['alignment'] != '' && typeof(thisSelectedStyles['alignment']) != 'undefined') {
      $('.wltAlignLeft').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltAlignLeft').prop('checked', false);
      $('.wltAlignCenter').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltAlignCenter').prop('checked', false);
      $('.wltAlignRight').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltAlignRight').prop('checked', false);

      if (thisSelectedStyles['alignment'] == 'left') {
        $('.wltAlignLeft').prev('label').addClass('ui-checkboxradio-checked ui-state-active');
        $('.wltAlignLeft').prop('checked', true);     
      }
      if (thisSelectedStyles['alignment'] == 'center') {
        $('.wltAlignCenter').prev('label').addClass('ui-checkboxradio-checked ui-state-active');
        $('.wltAlignCenter').prop('checked', true);     
      }
      if (thisSelectedStyles['alignment'] == 'right') {
        $('.wltAlignRight').prev('label').addClass('ui-checkboxradio-checked ui-state-active');
        $('.wltAlignRight').prop('checked', true);     
      }
      
    }
    if (thisSelectedStyles['tagName'] != '' && typeof(thisSelectedStyles['tagName']) != 'undefined') {
      $('.wltFontTag').val( thisSelectedStyles['tagName'].toLowerCase() );
      if (thisSelectedStyles['tagName'] == 'a' || thisSelectedStyles['tagName'] == 'A') {
        $('.wltFontLinkContainer').css('display','block');
        if (thisSelectedStyles['linkUrl'] != '' && typeof(thisSelectedStyles['linkUrl']) != 'undefined') {
          $('.wltFontLink').val( thisSelectedStyles['linkUrl'] );
        }
      }else{
        $('.wltFontLinkContainer').css('display','none');
        $('.wltFontLink').val( '' );
      }
    }

    if (thisSelectedStyles['fontSize'] != '' && typeof(thisSelectedStyles['fontSize']) != 'undefined') {
      $('.wltcFsize').val( thisSelectedStyles['fontSize'].replace("px", "") );
    }

    if (thisSelectedStyles['lineHeight'] != '' && typeof(thisSelectedStyles['lineHeight']) != 'undefined') {
      pxLineHeight = parseInt(thisSelectedStyles['lineHeight'] ,10);
      $('.wltcFlineHeight').val( pxLineHeight );
    }
    if (thisSelectedStyles['letterSpacing'] != '' && typeof(thisSelectedStyles['letterSpacing']) != 'undefined') {
      pxletterSpace = parseInt(thisSelectedStyles['letterSpacing'] ,10);
      $('.wltcLspacing').val( pxletterSpace );
    }
    if (thisSelectedStyles['fontColor'] != '' && typeof(thisSelectedStyles['fontColor']) != 'undefined') {
      $('.wltcFcolor').val( thisSelectedStyles['fontColor'] );
      $('.wltcFcolor').spectrum( 'set', $('.wltcFcolor').val() );
    }
    if (thisSelectedStyles['fontFamily'] != '' && typeof(thisSelectedStyles['fontFamily']) != 'undefined') {
      $('.wltFontFamily').val( thisSelectedStyles['fontFamily'] );
      var fontvalue = thisSelectedStyles['fontFamily'].replace(/\+/g, ' ');

      if (fontvalue == '') {
        fontvalue = 'Arial';
      }

      $('.wltFontFamily').trigger('setFont',[ fontvalue ]);

      $('.wltFontFamily').next('.font-select').find('.fs-drop').css('display','block');

      /*
      var thisFsResults = $('.wltFontFamily').next('.font-select').find('.fs-results');
      $(thisFsResults).animate({
        scrollTop: 0
      }, 0);
      $(thisFsResults).find('li:contains("'+fontvalue+'")').addClass('active');
      var scrollToEl = $(thisFsResults).find('li:contains("'+fontvalue+'")');
      if ($(scrollToEl).length > 0 ) {
        var childPos = scrollToEl.offset();
        var parentPos = thisFsResults.parent().offset();
        var childOffset = {
            top: childPos.top - parentPos.top,
            left: childPos.left - parentPos.left
        }
        $(thisFsResults).animate({
          scrollTop: childOffset.top-40
        });
      }
      */
        
    }
  });



  $(document).on('click','.wlt-btn',function(ev){

    if ($(this).hasClass('wltBold')) {  applyStylesOnSelectedEl('bold', $('.wltBold').is(':checked'), liveEditorGlobal.lastEditedEl );  }
    
    if ($(this).hasClass('wltItalic')) { applyStylesOnSelectedEl('italic', $('.wltItalic').is(':checked'), liveEditorGlobal.lastEditedEl ); }

    if ($(this).hasClass('wltUnderlined')) { applyStylesOnSelectedEl('underlined', $('.wltUnderlined').is(':checked'), liveEditorGlobal.lastEditedEl ); }

    if ($(this).hasClass('wltStrike')) { applyStylesOnSelectedEl('strike', $('.wltStrike').is(':checked'), liveEditorGlobal.lastEditedEl ); }

    if ($(this).hasClass('wltAlignLeft')) { 
      applyStylesOnSelectedEl('alignLeft', $('.wltAlignLeft').is(':checked'), liveEditorGlobal.lastEditedEl );
      $('.wltAlignCenter').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltAlignCenter').prop('checked', false);
      $('.wltAlignRight').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltAlignRight').prop('checked', false);
    }

    if ($(this).hasClass('wltAlignCenter')) { 
      applyStylesOnSelectedEl('alignCenter', $('.wltAlignCenter').is(':checked'), liveEditorGlobal.lastEditedEl ); 
      $('.wltAlignLeft').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltAlignLeft').prop('checked', false);
      $('.wltAlignRight').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltAlignRight').prop('checked', false);
    }

    if ($(this).hasClass('wltAlignRight')) { 
      applyStylesOnSelectedEl('alignRight', $('.wltAlignRight').is(':checked'), liveEditorGlobal.lastEditedEl ); 
      $('.wltAlignLeft').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltAlignLeft').prop('checked', false);
      $('.wltAlignCenter').prev('label').removeClass('ui-checkboxradio-checked ui-state-active');
      $('.wltAlignCenter').prop('checked', false);
    }
  });

  $(document).on('change','.wltCInput',function(ev){
    if ($(this).hasClass('wltFontTag')) {  applyStylesOnSelectedEl('fontTag', $('.wltFontTag').val() , liveEditorGlobal.lastEditedEl );  }
    if ($(this).hasClass('wltcFsize')) {  applyStylesOnSelectedEl('fontSize', $('.wltcFsize').val(), liveEditorGlobal.lastEditedEl );  }
    if ($(this).hasClass('wltcFlineHeight')) {  applyStylesOnSelectedEl('fontLineHeight', $('.wltcFlineHeight').val(), liveEditorGlobal.lastEditedEl );  }
    if ($(this).hasClass('wltcLspacing')) {  applyStylesOnSelectedEl('fontLSpace', $('.wltcLspacing').val(), liveEditorGlobal.lastEditedEl );  }
    if ($(this).hasClass('wltFontFamily')) {  applyStylesOnSelectedEl('fontFamily', $('.wltFontFamily').val(), liveEditorGlobal.lastEditedEl );  }

    if ($(this).hasClass('wltFontLink')) {  applyStylesOnSelectedEl('linkUrl', $('.wltFontLink').val(), liveEditorGlobal.lastEditedEl );  }
  });


  $(document).on('change','.wltcFcolor',function(ev){
    if ($(this).hasClass('wltcFcolor')) {  applyStylesOnSelectedEl('fontColor', $('.wltcFcolor').val(), liveEditorGlobal.lastEditedEl );  }
  });


  $(document).on('click','.wltDTitle',function(){
    if (  $('.wltDTitle').hasClass('dropdownActive') ) {
      $('.wltDContent').css('display','none');
      $('.wltDTitle').removeClass('dropdownActive');
    }else{
      $('.wltDContent').css('display','block');
      $('.wltDTitle').addClass('dropdownActive');

      var fontvalue = $('.'+'wltFontFamily').val();
      if (fontvalue == '') { fontvalue = ' '; }
      fontvalue = fontvalue.replace(/\+/g, ' ');
      var thisFsResults = $('.wltFontFamily').next('.font-select').find('.fs-results');
      $(thisFsResults).animate({
        scrollTop: 0
      }, 0);
      $(thisFsResults).find('li:contains('+fontvalue+')').addClass('active');
      var scrollToEl = $('.wltFontFamily').next('.font-select').find('.fs-results').find('li:contains('+fontvalue+')' );

      if ($(scrollToEl).length > 0 ) {
        var childPos = scrollToEl.offset();
        var parentPos = thisFsResults.parent().offset();
        var childOffset = {
            top: childPos.top - parentPos.top,
            left: childPos.left - parentPos.left
        }
        $(thisFsResults).animate({
          scrollTop: childOffset.top-90
        });
      }

    }
    
  });



  $('.widgetTextTag').on('change',function(){
    if ( $(this).val() == 'a' ) {
      $('.linkOpsDiv').css('display','block');
    }else{
      $('.linkOpsDiv').css('display','none');
    }
  });

/* ----------- Live Text Editor Ends Here -------------- */




$('.rowVideoType').on('change',function(){
  var rowVideoType = $(this).val();
  if (rowVideoType == 'mp4') {
    $('.bgrowmp4').css("display",'block');
    $('.bgrowyt').css("display",'none');
  }
  if (rowVideoType == 'yt') {
    $('.bgrowyt').css("display",'block');
    $('.bgrowmp4').css("display",'none');
  }
  
});

$('.linkedField').on('change', function(ev){
  changedField = $(ev.target);
  var changeUpdatedAttr = $(changedField).attr('data-changeupdated');
  if (typeof(changeUpdatedAttr) == 'undefined') {
    changeUpdatedAttr = 'false';
  }
  if (changeUpdatedAttr == 'true') {
  }else{
    linkedBtn = changedField.siblings('.linkfieldBtn');
    if ( linkedBtn.hasClass('linkedBtn') ) {
      changedFieldVal = $(changedField).val();
      changedField.siblings('.linkedField').val(changedFieldVal);

      var siblings = changedField.siblings();
      $.each(siblings,function(i,v){
        $(v).val(changedFieldVal);
        $(v).attr('data-changeupdated','true');
        $(v).trigger('change');
      });
    }
  }
   
  $(changedField).attr('data-changeupdated','false'); 
});


$('.widgetWidthType').on('change',function(){
  if($(this).val() == 'custom'){
   $('.widget_width_ops_container').css('display','block'); 
  }else{
    $('.widget_width_ops_container').css('display','none');
  }

});

$('.template-card').on('click',function(ev){
  console.log(ev.target);

  if( $(ev.target).hasClass('tempPaca') &&  popb_admin_vars_data.isPremActive !== 'true') return;
  
  if( $(ev.target).hasClass('temp-prev-custom')) return;

  if( $(ev.target).hasClass('updateTemplate') ) {
    return;
  }else{
    
    //$('.template-card').css('background-color','#f0f0f0');
    $(this).children('input').prop("checked",true);

    
    $('.template-card').children('.ui-effects-placeholder').remove();
    //$('.template-card').css('background-color','#f0f0f0');
    //$(this).css('background-color','#89d8fb');

    $('.template-card').children('.updateTemplate').remove();
    $(this).append('<div id="updateTemplate" class="updateTemplate"> Insert <i class="fa fa-download" data-rowblockname="1" aria-hidden="true"></i></div>');


    if ( $(this).hasClass('tempPack1') || $(this).hasClass('tempPaca') ) {
    }else{

    }

  }
    
  
  
});

$('.openPageOpsBtn').on('click',function(){
  $('.pageops_modal').show(300);
  $('.closePageOpsBtn').css('display','block');
  resizeWindowOpen();
});


$('.closePageOpsBtn').on('click',function(){

  var pageBgImage = $('.pageBgImage').val();
  var pageBgColor = $('.pageBgColor').val();
  var pagePaddingTop = $('.pagePaddingTop').val();
  var pagePaddingBottom = $('.pagePaddingBottom').val();
  var pagePaddingLeft = $('.pagePaddingLeft').val();
  var pagePaddingRight = $('.pagePaddingRight').val(); 

  $('#pbWrapper').attr('style','background-image: url("'+pageBgImage+'"); background-size:cover; background-color:'+pageBgColor+'; padding: '+pagePaddingTop+'% '+pagePaddingRight+'% '+pagePaddingBottom+'% '+pagePaddingLeft+'%; display:block;  ');

  $('.pageops_modal').css('display','none');
  $('.closePageOpsBtn').css('display','none');
  resizeWindowClose();
});

$('.pageOpsField').on('change',function(){
  
  var pageBgImage = $('.pageBgImage').val();
  var pageBgColor = $('.pageBgColor').val();
  var pagePaddingTop = $('.pagePaddingTop').val();
  var pagePaddingBottom = $('.pagePaddingBottom').val();
  var pagePaddingLeft = $('.pagePaddingLeft').val();
  var pagePaddingRight = $('.pagePaddingRight').val(); 
  var POPBDefaultsEnable = $('.POPBDefaultsEnable').val(); 
  if ($('.pb_fullScreenEditorButton').hasClass('EditorActive') ) {
    displayEditor = 'display:block;';
  }else{
    displayEditor = 'display:none;';
  }

  var selectedOptinType = pageBuilderApp.PageBuilderModel.get('optinType');
  pbWrapperHeight = '';
  if (selectedOptinType == 'Full Page') {
    pbWrapperHeight = 'height:95vh;';
  }

  $('#pbWrapper').css({
      'padding-top': pagePaddingTop+'%',
      'padding-bottom': pagePaddingBottom+'%',
      'padding-left': pagePaddingLeft+'%',
      'padding-right': pagePaddingRight+'%',
      'background-image' : 'url("'+pageBgImage+'")',
      'background-size': 'cover',
      'background-color' : pageBgColor,
      'display':'block',
      'height':pbWrapperHeight,
  });

  var currentVPSPageOps = $('.currentViewPortSize').val();
    if (currentVPSPageOps == 'rbt-l') {
      $('#pbWrapper').css({
        'padding-top': $('.pagePaddingTop').val()+'%',
        'padding-bottom':$('.pagePaddingBottom').val()+'%',
        'padding-left':$('.pagePaddingLeft').val()+'%',
        'padding-right':$('.pagePaddingRight').val()+'%',
      });
    }

    if (currentVPSPageOps == 'rbt-m') {
      $('#pbWrapper').css({
        'padding-top': $('.pagePaddingTopTablet').val()+'%',
        'padding-bottom':$('.pagePaddingBottomTablet').val()+'%',
        'padding-left':$('.pagePaddingLeftTablet').val()+'%',
        'padding-right':$('.pagePaddingRightTablet').val()+'%',
      });
    }

    if (currentVPSPageOps == 'rbt-s') {
      $('#pbWrapper').css({
        'padding-top': $('.pagePaddingTopMobile').val()+'%',
        'padding-bottom':$('.pagePaddingBottomMobile').val()+'%',
        'padding-left':$('.pagePaddingLeftMobile').val()+'%',
        'padding-right':$('.pagePaddingRightMobile').val()+'%',
      });
    }



  if (POPBDefaultsEnable == 'true') {

    var POPB_typefaces =  {
      typefaceHOne:$('.typefaceHOne').val(),
      typefaceHTwo:$('.typefaceHTwo').val(),
      typefaceH3:$('.typefaceH3').val(),
      typefaceH4:$('.typefaceH4').val(),
      typefaceH5:$('.typefaceH5').val(),
      typefaceH6:$('.typefaceH6').val(),
      typefaceParagraph:$('.typefaceParagraph').val(),
      typefaceButton:$('.typefaceButton').val(),
      typefaceAnchorLink:$('.typefaceAnchorLink').val()
    };

    var POPB_typeSizes = {
      typeSizeHOne:$('.typeSizeHOne').val(),
      typeSizeHTwo:$('.typeSizeHTwo').val(),
      typeSizeH3:$('.typeSizeH3').val(),
      typeSizeH4:$('.typeSizeH4').val(),
      typeSizeH5:$('.typeSizeH5').val(),
      typeSizeH6:$('.typeSizeH6').val(),
      typeSizeParagraph:$('.typeSizeParagraph').val(),
      typeSizeButton:$('.typeSizeButton').val(),
      typeSizeAnchorLink:$('.typeSizeAnchorLink').val(),
    };

    $('#fontLoaderContainer').html('<link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+POPB_typefaces['typefaceHOne']+'|'+POPB_typefaces['typefaceHTwo']+'|'+POPB_typefaces['typefaceParagraph']+'|'+POPB_typefaces['typefaceButton']+'|'+POPB_typefaces['typefaceAnchorLink']+' ">');


    typefaceHOne = POPB_typefaces['typefaceHOne'].replace(/\+/g, ' ');
    if (popb_check_hasNumber(POPB_typefaces['typefaceHOne'])) {
      typefaceHOne = "'"+POPB_typefaces['typefaceHOne']+"'";
    }

    typefaceHTwo = POPB_typefaces['typefaceHTwo'].replace(/\+/g, ' ');
    if (popb_check_hasNumber(POPB_typefaces['typefaceHTwo'])) {
        typefaceHTwo = "'" + POPB_typefaces['typefaceHTwo'] + "'";
    }

    typefaceH3 = POPB_typefaces['typefaceH3'].replace(/\+/g, ' ');
    if (popb_check_hasNumber(POPB_typefaces['typefaceH3'])) {
        typefaceH3 = "'" + POPB_typefaces['typefaceH3'] + "'";
    }

    typefaceH4 = POPB_typefaces['typefaceH4'].replace(/\+/g, ' ');
    if (popb_check_hasNumber(POPB_typefaces['typefaceH4'])) {
        typefaceH4 = "'" + POPB_typefaces['typefaceH4'] + "'";
    }

    typefaceH5 = POPB_typefaces['typefaceH5'].replace(/\+/g, ' ');
    if (popb_check_hasNumber(POPB_typefaces['typefaceH5'])) {
        typefaceH5 = "'" + POPB_typefaces['typefaceH5'] + "'";
    }

    typefaceH6 = POPB_typefaces['typefaceH6'].replace(/\+/g, ' ');
    if (popb_check_hasNumber(POPB_typefaces['typefaceH6'])) {
        typefaceH6 = "'" + POPB_typefaces['typefaceH6'] + "'";
    }

    typefaceParagraph = POPB_typefaces['typefaceParagraph'].replace(/\+/g, ' ');
    if (popb_check_hasNumber(POPB_typefaces['typefaceParagraph'])) {
        typefaceParagraph = "'" + POPB_typefaces['typefaceParagraph'] + "'";
    }

    typefaceButton = POPB_typefaces['typefaceButton'].replace(/\+/g, ' ');
    if (popb_check_hasNumber(POPB_typefaces['typefaceButton'])) {
        typefaceButton = "'" + POPB_typefaces['typefaceButton'] + "'";
    }

    typefaceAnchorLink = POPB_typefaces['typefaceAnchorLink'].replace(/\+/g, ' ');
    if (popb_check_hasNumber(POPB_typefaces['typefaceAnchorLink'])) {
        typefaceAnchorLink = "'" + POPB_typefaces['typefaceAnchorLink'] + "'";
    }


          var POPBGlobalStylesTagTypeFaces = '\n'+

            '#pbWrapper h1 { font-family:'+typefaceHOne+';  }  \n'+

            '#pbWrapper h2 { font-family:'+typefaceHTwo+'; }  \n'+

            '#pbWrapper h3 { font-family:'+typefaceH3+';  }  \n'+

            '#pbWrapper h4 { font-family:'+typefaceH4+';  }  \n'+

            '#pbWrapper h5 { font-family:'+typefaceH5+';  }  \n'+

            '#pbWrapper h6 { font-family:'+typefaceH6+';  }  \n'+

            '#pbWrapper p { font-family:'+typefaceParagraph+';  }  \n'+

            '#pbWrapper p span { font-family:'+typefaceParagraph+'; }  \n'+

            '#pbWrapper button { font-family:'+typefaceButton+'; }  \n'+
            
            '#pbWrapper a { font-family:'+typefaceAnchorLink+';  } \n';

          var POPBGlobalStylesTag = '\n'+

            '#pbWrapper h1 { font-size:'+POPB_typeSizes['typeSizeHOne']+'px ; }  \n'+

            '#pbWrapper h2 { font-size:'+POPB_typeSizes['typeSizeHTwo']+'px ; }  \n'+

            '#pbWrapper h3 { font-size:'+POPB_typeSizes['typeSizeH3']+'px ; }  \n'+

            '#pbWrapper h4 { font-size:'+POPB_typeSizes['typeSizeH4']+'px ; }  \n'+

            '#pbWrapper h5 { font-size:'+POPB_typeSizes['typeSizeH5']+'px ; }  \n'+

            '#pbWrapper h6 { font-size:'+POPB_typeSizes['typeSizeH6']+'px ; }  \n'+

            '#pbWrapper p {  font-size:'+POPB_typeSizes['typeSizeParagraph']+'px ; }  \n'+

            '#pbWrapper p span { }  \n'+

            '#pbWrapper button {  font-size:'+POPB_typeSizes['typeSizeButton']+'px; }  \n'+
            
            '#pbWrapper a { font-size:'+POPB_typeSizes['typeSizeAnchorLink']+'px ; } \n';

          $('#POPBDeafaultResponsiveStylesTag').html(' ');
          $('#POPBDeafaultResponsiveStylesTagFontFamily').html(' ');


          if (currentVPSPageOps == 'rbt-m') {

            var POPBGlobalStylesTag = '\n'+

            '#pbWrapper h1 {  font-size:'+$('.typeSizeHOneTablet').val()+'px !important; }  \n'+

            '#pbWrapper h2 {  font-size:'+$('.typeSizeHTwoTablet').val()+'px !important; }  \n'+

            '#pbWrapper h3{  font-size:'+$('.typeSizeH3Tablet').val()+'px !important; }  \n'+

            '#pbWrapper h4{  font-size:'+$('.typeSizeH4Tablet').val()+'px !important; }  \n'+

            '#pbWrapper h3{  font-size:'+$('.typeSizeH3Tablet').val()+'px !important; }  \n'+

            '#pbWrapper h3{  font-size:'+$('.typeSizeH3Tablet').val()+'px !important; }  \n'+

            '#pbWrapper p {  font-size:'+$('.typeSizeParagraphTablet').val()+'px !important; }  \n'+

            '#pbWrapper p span { font-size:'+$('.typeSizeParagraphTablet').val()+'px; }  \n'+

            '#pbWrapper button { font-size:'+$('.typeSizeButtonTablet').val()+'px; }  \n'+
            
            '#pbWrapper a { font-size:'+$('.typeSizeAnchorLinkTablet').val()+'px !important; } \n';

          }
          if (currentVPSPageOps == 'rbt-s') {

            var POPBGlobalStylesTag = '\n'+

            '#pbWrapper h1 {  font-size:'+$('.typeSizeHOneMobile').val()+'px !important; }  \n'+

            '#pbWrapper h2 {  font-size:'+$('.typeSizeHTwoMobile').val()+'px !important; }  \n'+

            '#pbWrapper h3{  font-size:'+$('.typeSizeH3Mobile').val()+'px !important; }  \n'+

            '#pbWrapper h4{  font-size:'+$('.typeSizeH4Mobile').val()+'px !important; }  \n'+

            '#pbWrapper h3{  font-size:'+$('.typeSizeH3Mobile').val()+'px !important; }  \n'+

            '#pbWrapper h3{  font-size:'+$('.typeSizeH3Mobile').val()+'px !important; }  \n'+

            '#pbWrapper p {  font-size:'+$('.typeSizeParagraphMobile').val()+'px !important; }  \n'+

            '#pbWrapper p span { font-size:'+$('.typeSizeParagraphMobile').val()+'px; }  \n'+

            '#pbWrapper button { font-size:'+$('.typeSizeButtonMobile').val()+'px; }  \n'+
            
            '#pbWrapper a { font-size:'+$('.typeSizeAnchorLinkMobile').val()+'px !important; } \n';

          }
          

          $('#POPBGlobalStylesTag').html(POPBGlobalStylesTag);
          $('#POPBDeafaultResponsiveStylesTagFontFamily').html(POPBGlobalStylesTagTypeFaces);

  }else{
    $('#POPBGlobalStylesTag').html('');
    $('#POPBDeafaultResponsiveStylesTagFontFamily').html('');
  }


  var pageOptions = {
    bodyBackgroundType: $('.bodyBackgroundType:checked').val(),
    bodyGradient: {
      bodyGradientColorFirst: $('.bodyGradientColorFirst').val(),
      bodyGradientLocationFirst: $('.bodyGradientLocationFirst').val(),
      bodyGradientColorSecond: $('.bodyGradientColorSecond').val(),
      bodyGradientLocationSecond: $('.bodyGradientLocationSecond').val(),
      bodyGradientType: $('.bodyGradientType').val(),
      bodyGradientPosition: $('.bodyGradientPosition').val(),
      bodyGradientAngle: $('.bodyGradientAngle').val(),
    },
    bodyHoverOptions: {
      bodyBgColorHover: $('.bodyBgColorHover').val(),
      bodyBackgroundTypeHover: $('.bodyBackgroundTypeHover:checked').val(),
      bodyHoverTransitionDuration: $('.bodyHoverTransitionDuration').val(),
      bodyGradientHover: {
        bodyGradientColorFirstHover: $('.bodyGradientColorFirstHover').val(),
        bodyGradientLocationFirstHover: $('.bodyGradientLocationFirstHover').val(),
        bodyGradientColorSecondHover: $('.bodyGradientColorSecondHover').val(),
        bodyGradientLocationSecondHover: $('.bodyGradientLocationSecondHover').val(),
        bodyGradientTypeHover: $('.bodyGradientTypeHover').val(),
        bodyGradientPositionHover: $('.bodyGradientPositionHover').val(),
        bodyGradientAngleHover: $('.bodyGradientAngleHover').val(),
      }
    },
    bodyOverlayBackgroundType: $('.bodyOverlayBackgroundType:checked').val(),
    bodyOverlayGradient: {
      bodyOverlayGradientColorFirst: $('.bodyOverlayGradientColorFirst').val(),
      bodyOverlayGradientLocationFirst: $('.bodyOverlayGradientLocationFirst').val(),
      bodyOverlayGradientColorSecond: $('.bodyOverlayGradientColorSecond').val(),
      bodyOverlayGradientLocationSecond: $('.bodyOverlayGradientLocationSecond').val(),
      bodyOverlayGradientType: $('.bodyOverlayGradientType').val(),
      bodyOverlayGradientPosition: $('.bodyOverlayGradientPosition').val(),
      bodyOverlayGradientAngle: $('.bodyOverlayGradientAngle').val(),
    },
    bodyBgOverlayColor: $('.bodyBgOverlayColor').val(),
    bodyBorderType:$('.bodyBorderType').val(),
    bodyBorderWidth:$('.bodyBorderWidth').val(),
    bodyBorderColor:$('.bodyBorderColor').val(),
    bodyBorderRadius:{
      bbrt:$('.bbrt').val(),
      bbrb:$('.bbrb').val(),
      bbrl:$('.bbrl').val(),
      bbrr:$('.bbrr').val(),
    },
  };
  var bodyID = 'pbWrapper';
  var bodyBackgroundOptions = 'background-color:' + pageBgColor + ';';
  if (pageBgImage != '') {
    bodyBackgroundOptions = 'background: url(' + pageBgImage + '); background-size: cover; ';
  }
  if (typeof (pageOptions['bodyBackgroundType']) !== 'undefined') {
    if (pageOptions['bodyBackgroundType'] == 'gradient') {
      var bodyGradient = pageOptions['bodyGradient'];
      if (bodyGradient['bodyGradientType'] == 'linear') {
        bodyBackgroundOptions = 'background: linear-gradient(' + bodyGradient['bodyGradientAngle'] + 'deg, ' + bodyGradient['bodyGradientColorFirst'] + ' ' + bodyGradient['bodyGradientLocationFirst'] + '%,' + bodyGradient['bodyGradientColorSecond'] + ' ' + bodyGradient['bodyGradientLocationSecond'] + '%);';
      }
      if (bodyGradient['bodyGradientType'] == 'radial') {
        bodyBackgroundOptions = 'background: radial-gradient(at ' + bodyGradient['bodyGradientPosition'] + ', ' + bodyGradient['bodyGradientColorFirst'] + ' ' + bodyGradient['bodyGradientLocationFirst'] + '%,' + bodyGradient['bodyGradientColorSecond'] + ' ' + bodyGradient['bodyGradientLocationSecond'] + '%);';
      }
    }
  }
  var thisbodyHoverStyleTag = '';
  var thisbodyHoverOption = '';
  if (typeof (pageOptions['bodyHoverOptions']) !== 'undefined') {
    var bodyHoverOptions = pageOptions['bodyHoverOptions'];
    if (bodyHoverOptions['bodyBackgroundTypeHover'] == 'solid') {
      var thisbodyHoverOption = ' #' + bodyID + ':hover { background:' + bodyHoverOptions['bodyBgColorHover'] + ' !important; transition: all ' + bodyHoverOptions['bodyHoverTransitionDuration'] + 's; }';
    }
    if (bodyHoverOptions['bodyBackgroundTypeHover'] == 'gradient') {
      var bodyGradientHover = bodyHoverOptions['bodyGradientHover'];
      if (bodyGradientHover['bodyGradientTypeHover'] == 'linear') {
        thisbodyHoverOption = ' #' + bodyID + ':hover { background: linear-gradient(' + bodyGradientHover['bodyGradientAngleHover'] + 'deg, ' + bodyGradientHover['bodyGradientColorFirstHover'] + ' ' + bodyGradientHover['bodyGradientLocationFirstHover'] + '%,' + bodyGradientHover['bodyGradientColorSecondHover'] + ' ' + bodyGradientHover['bodyGradientLocationSecondHover'] + '%) !important; transition: all ' + bodyHoverOptions['bodyHoverTransitionDuration'] + 's; }';
      }
      if (bodyGradientHover['bodyGradientTypeHover'] == 'radial') {
        thisbodyHoverOption = ' #' + bodyID + ':hover { background: radial-gradient(at ' + bodyGradientHover['bodyGradientPositionHover'] + ', ' + bodyGradientHover['bodyGradientColorFirstHover'] + ' ' + bodyGradientHover['bodyGradientLocationFirstHover'] + '%,' + bodyGradientHover['bodyGradientColorSecondHover'] + ' ' + bodyGradientHover['bodyGradientLocationSecondHover'] + '%) !important; transition: all ' + bodyHoverOptions['bodyHoverTransitionDuration'] + 's; }';
      }
    }
    $('#POPBBodyHoverStylesTag').html(thisbodyHoverOption);
  }
  bodyOverlayBackgroundOptions = '';
  if (typeof (pageOptions['bodyBgOverlayColor']) !== 'undefined') {
    var bodyOverlayBackgroundOptions = 'background:' + pageOptions['bodyBgOverlayColor'] + '; background-color:' + pageOptions['bodyBgOverlayColor'] + ';';
  }
  if (typeof (pageOptions['bodyOverlayBackgroundType']) !== 'undefined') {
    if (pageOptions['bodyOverlayBackgroundType'] == 'gradient') {
      var bodyOverlayGradient = pageOptions['bodyOverlayGradient'];
      if (bodyOverlayGradient['bodyOverlayGradientType'] == 'linear') {
        bodyOverlayBackgroundOptions = 'background: linear-gradient(' + bodyOverlayGradient['bodyOverlayGradientAngle'] + 'deg, ' + bodyOverlayGradient['bodyOverlayGradientColorFirst'] + ' ' + bodyOverlayGradient['bodyOverlayGradientLocationFirst'] + '%,' + bodyOverlayGradient['bodyOverlayGradientColorSecond'] + ' ' + bodyOverlayGradient['bodyOverlayGradientLocationSecond'] + '%);';
      }
      if (bodyOverlayGradient['bodyOverlayGradientType'] == 'radial') {
        bodyOverlayBackgroundOptions = 'background: radial-gradient(at ' + bodyOverlayGradient['bodyOverlayGradientPosition'] + ', ' + bodyOverlayGradient['bodyOverlayGradientColorFirst'] + ' ' + bodyOverlayGradient['bodyOverlayGradientLocationFirst'] + '%,' + bodyOverlayGradient['bodyOverlayGradientColorSecond'] + ' ' + bodyOverlayGradient['bodyGradientLocationSecond'] + '%);';
      }
    }
  }
  $('#pbWrapperContainerOverlay').attr('style', bodyOverlayBackgroundOptions);

    if (typeof(bodyBorderRadius)  == 'undefined') { bodyBorderRadius = ''; }
    bodyBorderType = ''; bodyBorderWidth = ''; bodyBorderColor = '';
    if (typeof(pageOptions['bodyBorderType'])  != 'undefined') {
      bodyBorderType = pageOptions['bodyBorderType'];
      bodyBorderWidth = pageOptions['bodyBorderWidth'];
      bodyBorderColor = pageOptions['bodyBorderColor'];
      bodyBorderRadius = pageOptions['bodyBorderRadius'];
      if ( typeof(bodyBorderRadius['bbrt']) != 'undefined') {
      }else{
        bodyBorderRadius['bbrt'] = bodyBorderRadius;
        bodyBorderRadius['bbrb'] = bodyBorderRadius;
        bodyBorderRadius['bbrl'] = bodyBorderRadius;
        bodyBorderRadius['bbrr'] = bodyBorderRadius;
      }
    }

    $('#pbWrapper').css('border',bodyBorderWidth+'px '+bodyBorderType+' '+bodyBorderColor);
    $('#pbWrapper').css('border-top-left-radius',bodyBorderRadius['bbrt']+'px');
    $('#pbWrapper').css('border-top-right-radius',bodyBorderRadius['bbrr']+'px');
    $('#pbWrapper').css('border-bottom-right-radius',bodyBorderRadius['bbrb']+'px');
    $('#pbWrapper').css('border-bottom-left-radius',bodyBorderRadius['bbrl']+'px');

  var pbWrapperExistingStyles = $('#pbWrapper').attr('style');
  $('#pbWrapper').attr('style', pbWrapperExistingStyles+bodyBackgroundOptions);




  $('.isChagesMade').val('true');

});


$('.responsiveBtn').on('click',function(){

  var POPBDeafaultResponsiveStyles = 'h1{font-size:2em ; } h2{ font-size:1.5em ; } h3{ font-size:1.3em ; } h4{ font-size:1em ; } h5{ font-size:1em ; } h6{ font-size:1em ; } p, input, button, label{ font-size: 15px ; } p{  } video{ min-height: auto ; max-width: 100%; } }  .row {width:100% ; padding:30px  0 ; margin: 0 auto ;}  .column {width:99.9% ; margin-bottom: 30px ; } .column > div { padding:10px ; margin: 0 auto ; }';


  if ( $(this).hasClass('rbt-l') ) {



    // PageOps & Global Styles start
      $('#pbWrapper').css({
        'padding-top': $('.pagePaddingTop').val()+'%',
        'padding-bottom':$('.pagePaddingBottom').val()+'%',
        'padding-left':$('.pagePaddingLeft').val()+'%',
        'padding-right':$('.pagePaddingRight').val()+'%',
      });

      var POPB_typefaces =  {
        typefaceHOne:$('.typefaceHOne').val(),
        typefaceHTwo:$('.typefaceHTwo').val(),
        typefaceH3:$('.typefaceH3').val(),
        typefaceH4:$('.typefaceH4').val(),
        typefaceH5:$('.typefaceH5').val(),
        typefaceH6:$('.typefaceH6').val(),
        typefaceParagraph:$('.typefaceParagraph').val(),
        typefaceButton:$('.typefaceButton').val(),
        typefaceAnchorLink:$('.typefaceAnchorLink').val()
      };

      var POPB_typeSizes = {
        typeSizeHOne:$('.typeSizeHOne').val(),
        typeSizeHTwo:$('.typeSizeHTwo').val(),
        typeSizeH3:$('.typeSizeH3').val(),
        typeSizeH4:$('.typeSizeH4').val(),
        typeSizeH5:$('.typeSizeH5').val(),
        typeSizeH6:$('.typeSizeH6').val(),
        typeSizeParagraph:$('.typeSizeParagraph').val(),
        typeSizeButton:$('.typeSizeButton').val(),
        typeSizeAnchorLink:$('.typeSizeAnchorLink').val(),
      };


      typefaceHOne = POPB_typefaces['typefaceHOne'].replace(/\+/g, ' ');
      if (popb_check_hasNumber(POPB_typefaces['typefaceHOne'])) {
        typefaceHOne = "'"+POPB_typefaces['typefaceHOne']+"'";
      }

      var POPBGlobalStylesTagTypeFaces = '\n'+

        '#pbWrapper h1 { font-family:'+typefaceHOne+';  }  \n'+

        '#pbWrapper h2 { font-family:'+POPB_typefaces['typefaceHTwo'].replace(/\+/g, ' ')+'; }  \n'+

        '#pbWrapper h3 { font-family:'+POPB_typefaces['typefaceH3'].replace(/\+/g, ' ')+';  }  \n'+

        '#pbWrapper h4 { font-family:'+POPB_typefaces['typefaceH4'].replace(/\+/g, ' ')+';  }  \n'+

        '#pbWrapper h5 { font-family:'+POPB_typefaces['typefaceH5'].replace(/\+/g, ' ')+';  }  \n'+

        '#pbWrapper h6 { font-family:'+POPB_typefaces['typefaceH6'].replace(/\+/g, ' ')+';  }  \n'+

        '#pbWrapper p { font-family:'+POPB_typefaces['typefaceParagraph'].replace(/\+/g, ' ')+';  }  \n'+

        '#pbWrapper p span { font-family:'+POPB_typefaces['typefaceParagraph'].replace(/\+/g, ' ')+'; }  \n'+

        '#pbWrapper button { font-family:'+POPB_typefaces['typefaceButton'].replace(/\+/g, ' ')+'; }  \n'+
        
        '#pbWrapper a { font-family:'+POPB_typefaces['typefaceAnchorLink'].replace(/\+/g, ' ')+';  } \n';

        var POPBGlobalStylesTag = '\n'+

        '#pbWrapper h1 { font-size:'+POPB_typeSizes['typeSizeHOne']+'px ; }  \n'+

        '#pbWrapper h2 { font-size:'+POPB_typeSizes['typeSizeHTwo']+'px ; }  \n'+

        '#pbWrapper h3 { font-size:'+POPB_typeSizes['typeSizeH3']+'px ; }  \n'+

        '#pbWrapper h4 { font-size:'+POPB_typeSizes['typeSizeH4']+'px ; }  \n'+

        '#pbWrapper h5 { font-size:'+POPB_typeSizes['typeSizeH5']+'px ; }  \n'+

        '#pbWrapper h6 { font-size:'+POPB_typeSizes['typeSizeH6']+'px ; }  \n'+

        '#pbWrapper p {  font-size:'+POPB_typeSizes['typeSizeParagraph']+'px ; }  \n'+

        '#pbWrapper p span { }  \n'+

        '#pbWrapper button {  font-size:'+POPB_typeSizes['typeSizeButton']+'px; }  \n'+
        
        '#pbWrapper a { font-size:'+POPB_typeSizes['typeSizeAnchorLink']+'px ; } \n';

      $('#POPBDeafaultResponsiveStylesTag').html(' ');
      $('#POPBDeafaultResponsiveStylesTagFontFamily').html(' ');
    // PageOps & Global Styles end
  }

  if ($(this).hasClass('rbt-m')) {

    // PageOps & Global Styles start

      $('#pbWrapper').css({
        'padding-top': $('.pagePaddingTopTablet').val()+'%',
        'padding-bottom':$('.pagePaddingBottomTablet').val()+'%',
        'padding-left':$('.pagePaddingLeftTablet').val()+'%',
        'padding-right':$('.pagePaddingRightTablet').val()+'%',
      });

      var POPBGlobalStylesTag = '\n'+

        '#pbWrapper h1 {  font-size:'+$('.typeSizeHOneTablet').val()+'px !important; }  \n'+

        '#pbWrapper h2 {  font-size:'+$('.typeSizeHTwoTablet').val()+'px !important; }  \n'+

        '#pbWrapper h3{  font-size:'+$('.typeSizeH3Tablet').val()+'px !important; }  \n'+

        '#pbWrapper h4{  font-size:'+$('.typeSizeH4Tablet').val()+'px !important; }  \n'+

        '#pbWrapper h3{  font-size:'+$('.typeSizeH3Tablet').val()+'px !important; }  \n'+

        '#pbWrapper h3{  font-size:'+$('.typeSizeH3Tablet').val()+'px !important; }  \n'+

        '#pbWrapper p {  font-size:'+$('.typeSizeParagraphTablet').val()+'px !important; }  \n'+

        '#pbWrapper p span { font-size:'+$('.typeSizeParagraphTablet').val()+'px; }  \n'+

        '#pbWrapper button { font-size:'+$('.typeSizeButtonTablet').val()+'px; }  \n'+
        
        '#pbWrapper a { font-size:'+$('.typeSizeAnchorLinkTablet').val()+'px !important; } \n';

      $('#POPBDeafaultResponsiveStylesTag').html(POPBDeafaultResponsiveStyles);
    // PageOps & Global Styles end
  }

  if ($(this).hasClass('rbt-s')) {

    // PageOps & Global Styles start
      $('#pbWrapper').css({
        'padding-top': $('.pagePaddingTopMobile').val()+'%',
        'padding-bottom':$('.pagePaddingBottomMobile').val()+'%',
        'padding-left':$('.pagePaddingLeftMobile').val()+'%',
        'padding-right':$('.pagePaddingRightMobile').val()+'%',
      });

      var POPBGlobalStylesTag = '\n'+

        '#pbWrapper h1 {  font-size:'+$('.typeSizeHOneMobile').val()+'px !important; }  \n'+

        '#pbWrapper h2 {  font-size:'+$('.typeSizeHTwoMobile').val()+'px !important; }  \n'+

        '#pbWrapper h3{  font-size:'+$('.typeSizeH3Mobile').val()+'px !important; }  \n'+

        '#pbWrapper h4{  font-size:'+$('.typeSizeH4Mobile').val()+'px !important; }  \n'+

        '#pbWrapper h3{  font-size:'+$('.typeSizeH3Mobile').val()+'px !important; }  \n'+

        '#pbWrapper h3{  font-size:'+$('.typeSizeH3Mobile').val()+'px !important; }  \n'+

        '#pbWrapper p {  font-size:'+$('.typeSizeParagraphMobile').val()+'px !important; }  \n'+

        '#pbWrapper p span { font-size:'+$('.typeSizeParagraphMobile').val()+'px; }  \n'+

        '#pbWrapper button { font-size:'+$('.typeSizeButtonMobile').val()+'px; }  \n'+
        
        '#pbWrapper a { font-size:'+$('.typeSizeAnchorLinkMobile').val()+'px !important; } \n';

        $('#POPBDeafaultResponsiveStylesTag').html(POPBDeafaultResponsiveStyles);
    // PageOps & Global Styles end
  
  }

  $('#POPBGlobalStylesTag').html(POPBGlobalStylesTag);
  $('#POPBDeafaultResponsiveStylesTagFontFamily').html(POPBGlobalStylesTagTypeFaces);
    
});


$(".POcustomCSS").on("change", function (e) {
  $("#PBPO_customCSS").html(`<style> ${e.target.value} </style>`);
});


$('.checkIfWidgetsAreLoadedInColumn').val('false');


$('.pageBgImage').on('change',function(){
    var pageBgImage = $('.pageBgImage').val();
    $('#container').attr('style','background-image: url("'+pageBgImage+'"); background-size:cover;');
});

$('.card-img').on('mouseover',function(ev) {
  var tempprevbtn = $(ev.target).attr('class').split(' ')[1];
  $('#'+tempprevbtn).width($(ev.target).width());
  $('#'+tempprevbtn).height($(ev.target).height());
  var tempPhieght = $(ev.target).height();
  $('.tempPrev p').css('margin-top',tempPhieght/2);
  $('#'+tempprevbtn).slideDown(100);
});
$('.template-card').on('mouseleave',function(ev){
  $('.tempPrev').slideUp('100');
});

$('.tempPrev').on('click',function(ev) {
  var ths_tempprev = $(ev.target).attr('id');
  if (typeof(ths_tempprev) == 'undefined') { var ths_tempprev = $(ev.target).parent().attr('id'); }
  
  console.log(ths_tempprev);

  if(ths_tempprev === 'temp-prev-custom' || ths_tempprev === 'temp-prev-0') return;
  
  $('.pb_preview_container').attr('style','display:block;overflow:auto;');
  $('.pb_temp_prev').append('<img src='+$('img.'+ths_tempprev).attr('data-img_src')+' class="pb_temp_prev_img" >');
});

$('.pb_preview_container').on('click',function(){
  $('.pb_preview_container').attr('style','display:none;');
  $('.pb_temp_prev').html(' ');
});




//Responsive Options Buttons Global Script
$('.pb_editor_tab_content #tab1').css('margin','0 auto');

$('.responsiveBtn').on('click',function(){
  $('.responsiveBtn').css('background','#b5b5b5');
  


  $('.responsiveOps').css('display','none');

  if ($(this).hasClass('rbt-l') ) {
    $('.rbt-l').css('background','#2196F3');
    
    $('.responsiveOptionsContainterLarge').css('display','block');
    $('.currentViewPortSize').val('rbt-l');
    $('.pb_fullScreenEditorButtonClose').css('display','block');
     $('.newRowBtnContainerVisible').css('display','block');
    $('.pb_editor_tab_content').css('background','#fff');

    if (pageBuilderApp.isEditingPanelOpen == true) {
      resizeWindowOpen();
    }else{
      $('.pb_editor_tab_content #tab1').animate({margin:'0 auto', width:'100%' } );
    }

  }

  if ($(this).hasClass('rbt-m') ) {
    $('.rbt-m').css('background','#2196F3');
    $('.pb_editor_tab_content #tab1').animate({margin:'0 auto', width:'768px' },500 );
    $('.pb_editor_tab_content #tab1').css('float','unset');
    $('.responsiveOptionsContainterMedium').css('display','block');

    $('.currentViewPortSize').val('rbt-m');
    $('.pb_editor_tab_content').css('background','#5d5d5d');
    $('.newRowBtnContainerVisible').css('display','none');
    
  }

  if ($(this).hasClass('rbt-s') ) {
    $('.rbt-s').css('background','#2196F3');
    $('.pb_editor_tab_content #tab1').animate({margin:'0 auto', width:'395px' },500 );
    $('.pb_editor_tab_content #tab1').css('float','unset');
    $('.responsiveOptionsContainterSmall').css('display','block');

    $('.currentViewPortSize').val('rbt-s');

    $('.pb_editor_tab_content').css('background','#5d5d5d');
    $('.newRowBtnContainerVisible').css('display','none');
  }


});




// POPB Tabs 

$('.popbNavItem').on('click',function(e){
  e.preventDefault();
  
  var clickedPOPBTab = $(this).attr('data-inptabID');
  var currentOptionType = $(this).children('input').attr("name");
  var currentOptionTypeSelected = $(this).children('input').is(':checked');

  if (currentOptionTypeSelected == true) {
    $(this).children('label').css({'background':'#f1f1f1', 'color':'#333'});
    $(this).children('input').prop("checked", false);
    $(this).siblings('.noneValueSelector').children('input').prop("checked", true);
    $(this).children('input').trigger("change");
  }else{
    $(this).siblings('.popbNavItem').children('label').css({'background':'#f1f1f1', 'color':'#333'});
    $(this).children('label').css({'background':'#c5c5c5', 'color':'#fff'});
    $(this).parent().next('.popb_input_tabContent').children('.popb_tab_content').css('display','none');
    $(this).parent().next().children('.'+clickedPOPBTab).css('display','block');
    $("."+currentOptionType).prop("checked", false);
    $(this).children('input').prop("checked", true);
    $(this).children('input').trigger("change");
  }

  e.stopPropagation();
  return;
    
});



// Number Sliders start 
  $('.rowGradientType').on('change',function(){
    var rowGradientType = $(this).val();
    if (rowGradientType == 'linear') {
      $('.radialInput').css('display','none');
      $('.linearInput').css('display','block');
    }else{
      $('.radialInput').css('display','block');
      $('.linearInput').css('display','none');
    }
  });


  $('.rowGradientTypeHover').on('change',function(){
    var rowGradientType = $(this).val();
    if (rowGradientType == 'linear') {
      $('.radialInputHover').css('display','none');
      $('.linearInputHover').css('display','block');
    }else{
      $('.radialInputHover').css('display','block');
      $('.linearInputHover').css('display','none');
    }
  });

  $('.rowOverlayGradientType').on('change',function(){
    var rowOverlayGradientType = $(this).val();
    if (rowOverlayGradientType == 'linear') {
      $('.radialInput').css('display','none');
      $('.linearInput').css('display','block');
    }else{
      $('.radialInput').css('display','block');
      $('.linearInput').css('display','none');
    }
  });


  $('.colGradientType').on('change',function(){
    var colGradientType = $(this).val();
    if (colGradientType == 'linear') {
      $('.radialInputCol').css('display','none');
      $('.linearInputCol').css('display','block');
    }else{
      $('.radialInputCol').css('display','block');
      $('.linearInputCol').css('display','none');
    }
  });


  $('.widgGradientType').on('change',function(){
    var widgGradientType = $(this).val();
    if (widgGradientType == 'linear') {
      $('.radialInputWidg').css('display','none');
      $('.linearInputWidg').css('display','block');
    }else{
      $('.radialInputWidg').css('display','block');
      $('.linearInputWidg').css('display','none');
    }
  });


  $('.colGradientTypeHover').on('change',function(){
    var colGradientTypeHover = $(this).val();
    if (colGradientTypeHover == 'linear') {
      $('.radialInputColHover').css('display','none');
      $('.linearInputColHover').css('display','block');
    }else{
      $('.radialInputColHover').css('display','block');
      $('.linearInputColHover').css('display','none');
    }
  });

  $('.widgGradientTypeHover').on('change',function(){
    var widgGradientTypeHover = $(this).val();
    if (widgGradientTypeHover == 'linear') {
      $('.radialInputWidgHover').css('display','none');
      $('.linearInputWidgHover').css('display','block');
    }else{
      $('.radialInputWidgHover').css('display','block');
      $('.linearInputWidgHover').css('display','none');
    }
  });


  try {
    $( ".PoPbrangeSlider" ).slider({
      value:0,
      min: 0,
      max: 100,
      step: 5,
      slide: function( event, ui ) {
        POPBtagerInput = $(this).attr('data-targetRangeInput');
        $('.'+POPBtagerInput).val(ui.value);
        $('.'+POPBtagerInput).trigger('change');
      }
    });

    $( ".PoPbrangeSliderAngle" ).slider({
      value:0,
      min: 0,
      max: 360,
      step: 5,
      slide: function( event, ui ) {
        POPBtagerInput = $(this).attr('data-targetRangeInput');
        $('.'+POPBtagerInput).val(ui.value);
        $('.'+POPBtagerInput).trigger('change');
      }
    });

    $( ".PoPbrangeSliderTransition" ).slider({
      value:1,
      min: 0.1,
      max: 3,
      step: 0.1,
      slide: function( event, ui ) {
        POPBtagerInput = $(this).attr('data-targetRangeInput');
        $('.'+POPBtagerInput).val(ui.value);
        $('.'+POPBtagerInput).trigger('change');
      }
    });
  } catch(e) {
    // statements
    console.log(e);
  }
  

    

  

  
    
// Number Sliders end




// jQuery('#pbCountDownDate').datepicker({
//   dateFormat: 'yy/mm/dd'
// });




$('.popb_popup_close').on('click',function(){
  $(this).parents('.lpp_modal').slideUp('slow');
  $(this).parents('.lpp_modal').css('display','none');
});


// Save Triggers Start 

  jQuery('.rowCopyButton').on('click',function(){
    currentEditableRowID = jQuery('.currentEditingRow').val();
    jQuery('section[rowid="'+currentEditableRowID+'"]').children('#ulpb_row_controls').children('#copyThisRowLS').trigger('click');
  });
  jQuery('.rowPasteButton').on('click',function(){
    currentEditableRowID = jQuery('.currentEditingRow').val();
    jQuery('section[rowid="'+currentEditableRowID+'"]').children('#ulpb_row_controls').children('#pasteThisRowLS').trigger('click');
  });

  jQuery('.row_edit_fields').on('change',function(){
    currentEditableRowID = jQuery('.currentEditingRow').val();

    pageBuilderApp.changedRowOpName =  $(this).attr('data-optname');


    jQuery('section[rowid="'+currentEditableRowID+'"]').children('#ulpb_row_controls').children('#editRowSave').trigger('click');
  });
  
  jQuery('.row_edit_fieldBG').on('change',function(){
    currentEditableRowID = jQuery('.currentEditingRow').val();

    pageBuilderApp.changedRowOpName =  $(this).attr('data-optname');

    jQuery('section[rowid="'+currentEditableRowID+'"]').children('#ulpb_row_controls').children('#editRowSave').trigger('click');
  });


  jQuery(document).on('click','#editRowSaveVisible',function(){

    currentEditableRowID = jQuery('.currentEditingRow').val();

    jQuery('section[rowid="'+currentEditableRowID+'"]').children('#ulpb_row_controls').children('#editRowSave').trigger('click');

    jQuery('.edit_row').css('display','none');
    jQuery('.ulpb_row_controls').css('display','none');
    resizeWindowClose();
  });

  //col save triggers
  jQuery('.colOptionsFields , .popb_col_fields_container input , .popb_col_fields_container select , #columnBgColor').on('change',function(){
    pageBuilderApp.changedColOpName =  $(this).attr('data-optname');
    ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
    currentEditableColId = jQuery('.currentEditableColId').val();
    jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSave').trigger('click');
  });


  jQuery(document).on('click','#editColumnSaveVisible',function(){

    jQuery('.edit_column').css('display','none');
    jQuery('.ulpb_column_controls').css('display','none');
    resizeWindowClose();

  });


  // widget save triggers
  function saveWidgetTriggerOffside(thisEl,changedOpType){
    //var tsua0 = performance.now();
    pageBuilderApp.changedOpType = changedOpType;
    pageBuilderApp.changedOpName =  $(thisEl).attr('data-optname');
    var that = jQuery('.closeWidgetPopup').attr('data-CurrWidget');
    
    jQuery('div[data-saveCurrWidget="'+that+'"]').trigger('click');

    ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
    currentEditableColId = jQuery('.currentEditableColId').val();
    jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

    //var tsua1 = performance.now();
    //console.log("Call to pbp-widgets change took " + (tsua1 - tsua0) + " milliseconds.");
  }

  $('.closeWidgetPopup').on('click',function(ev){
    saveWidgetTriggerOffside(this,'specific');
  });

  $('.closeWidgetPopupIcon').on('click',function(ev){
    saveWidgetTriggerOffside(this,'specific');
  });

  jQuery('.pbp-widgets input, .pbp-widgets select, .pbp-widgets textarea').on('change',function(){
    saveWidgetTriggerOffside(this,'specific');
  });

  jQuery('.widgetAnimateBtn').on('click',function(){
    jQuery('.isAnimateTrue').val('animate');
    jQuery('.closeWidgetPopup').trigger('click');
  });

  jQuery('.wdt-fields input , .wdt-fields select, .wdt-fields textarea , #widgetBgColor , .widgetStyling , .wdt-img input, .wdt-img select ').on('change',function(){
    saveWidgetTriggerOffside(this,'general');
  });


  jQuery('.wdt-img input, .wdt-img select').on('change',function(){ 
    saveWidgetTriggerOffside(this,'specific');
  });

  jQuery(document).on('change','.slideImgURL',function(){
    saveWidgetTriggerOffside(this,'specific');
  });

  jQuery(document).on('change','.imageSlideHeading , .imageSlideDesc , .imageSlideButtonText , .imageSlideButtonURL',function(){
    saveWidgetTriggerOffside(this,'specific');
  });

   jQuery(document).on('change','.iconListItemsContainer input , .iconListItemsContainer select ',function(){
    saveWidgetTriggerOffside(this,'specific');
  });
  
  jQuery(document).on('change','.carouselImgURL',function(){
    saveWidgetTriggerOffside(this,'specific');
  });

  jQuery(document).on('change','.formFieldItemsContainer select',function(){
    saveWidgetTriggerOffside(this,'specific');
  });
  jQuery(document).on('change','.formFieldItemsContainer input',function(){
    saveWidgetTriggerOffside(this,'specific');
  });
  jQuery(document).on('change','.formFieldItemsContainer textarea',function(){
    saveWidgetTriggerOffside(this,'specific');
  });

  jQuery(document).on('change','.customImageGalleryItems input',function(){
    saveWidgetTriggerOffside(this,'specific');
  });

  jQuery(document).on('change','.sortableAccordionWidget input',function(){
    saveWidgetTriggerOffside(this,'specific');
  });

  jQuery(document).on('change','.sortableAccordionWidget textarea',function(){
    saveWidgetTriggerOffside(this,'specific');
  });



  jQuery('.editWidgetSaveButton').on('click', function(){
    // jQuery('.closeWidgetPopup').trigger('click');
    jQuery('.columnWidgetPopup').css('display','none');
    jQuery('.editWidgetSaveButton').css('display','none');
    jQuery('.edit_column').css('display','none');
    jQuery('.ulpb_column_controls').css('display','none');

    resizeWindowClose();
    
  });

  var widgetDroppedTypeTwo = false;

  jQuery(function ($) {
      if (typeof(tinymce) !== 'undefined') {



      }
  });

// Save Triggers End 

  
  


jQuery(document).ready(function() {


  if (isGlobalRowActive == "true") {
      jQuery('.addNewGlobalRowVisible').parent().css('display','inline-block');
  }

  jQuery('#menuWrap').on('click',function(){return false;});
  jQuery('#lpb_menu_widget').on('click',function(){return false;});


  jQuery(function ($) {

    $('#pbWrapper').css('display','none');
    $('.newRowBtnContainerVisible').css('display','none');

    jQuery('.pb_fullScreenEditorButton').on('click',function(){
      $('.pb_editor_tab_content').attr('style','overflow: hidden;background: #fff;position: absolute;width: 100%;left: 0;right: 15;top: 0;');
      $('#adminmenumain, .pb_fullScreenEditorButton, #wpadminbar, #postbox-container-2, .postbox').css('display','none');
      $('#wpcontent').attr('style','margin-left:0; padding-left:0;');
      $('.pb_fullScreenEditorButtonClose').css('display','block');
      $('#pbWrapper').css('display','block');
      $('.newRowBtnContainerVisible').css('display','block');

      $(this).addClass('EditorActive');

      let topBarHeight = $('#top-optionsBar').height();
      $('#pbWrapper').css('margin-top', topBarHeight+'px');

    });

    jQuery('.pb_fullScreenEditorButtonClose').on('click',function(){
      $('.pb_editor_tab_content').attr('style','overflow: hidden;background: #fff;');
      $('.pb_fullScreenEditorButtonClose').css('display','none');
      $('#wpcontent').attr('style','');
      $('#adminmenumain, .pb_fullScreenEditorButton, #postbox-container-2 , .postbox').css('display','block');

      $('#submitdiv').css('display','none');
      $('#pbWrapper').css('display','none');
      $('.newRowBtnContainerVisible').css('display','none');
      $('.pb_fullScreenEditorButton').removeClass('EditorActive');
      $('.edit_row').css('display','none');
      $('.columnWidgetPopup, .editWidgetSaveButton').css('display','none');
      $('.pageops_modal').css('display','none');
      $('.edit_column').css('display','none');
      $('.ulpb_column_controls, .ulpb_row_controls').css('display','none');
    });

    $('.pb_fullScreenEditorButton').css('display','block');
    $('.pb_loader_container_pageload').css('display','none');

  });



  $(document).on('click','.fontfamilySearchIcon',function(){
    if ($(this).parents('.font-select').find('.fontSearchField').hasClass('fontSearchHidden') ) {
      $(this).parents('.font-select').find('.fontSearchField').addClass('fontSearchVisible');
      $(this).parents('.font-select').find('.fontSearchField').removeClass('fontSearchHidden');
      $(this).parents('.font-select').find('.fontSearchField').focus();
    }else{
      $(this).parents('.font-select').find('.fontSearchField').addClass('fontSearchHidden');
      $(this).parents('.font-select').find('.fontSearchField').removeClass('fontSearchVisible');
    }
    
  });

  $(document).on('change','.fontSearchField',function(){

      var fontvalue = $(this).val();
      fontvalue = convertToCamelCase(fontvalue);
      var thisFsResults = $(this).parents('.font-select').find('.fs-results');
      $(thisFsResults).scrollTop( 0 );

      var scrollToEl = $(thisFsResults).find('li:contains("'+fontvalue+'")');


      if ($(scrollToEl).length > 0 ) {
        var childPos = scrollToEl.offset();
        var parentPos = thisFsResults.parent().offset();
        var childOffset = {
            top: childPos.top - parentPos.top,
            left: childPos.left - parentPos.left
        }
        $(thisFsResults).scrollTop( childOffset.top-40 );
      }

  });


});

}( jQuery ) ); // main container end


(function ($) {
  jQuery(document).ready(function(){

    jQuery(window).on('beforeunload', function(){
      
      if (pageBuilderApp.ifChangesMade == true) {
        return 'Are you sure you want to leave there is unsaved data ?';
      }

      
    });

  });



  // Templates type  filter

  $('.templateSearchInput').on('keyup', function(e){

    let WidgetSearchQuery = e.target.value.trim();

    const toCamelCase = (str) => {
      return str
      .replace(/\s(.)/g, function (a) {
          return a.toUpperCase();
      })
      .replace(/\s/g, '')
      .replace(/^(.)/, function (b) {
          return b.toLowerCase();
      });
    };


    $('.templatesTypeFilterItem').removeClass('active');
    $('.template-card').css('display','none');
        
    $('.template-card:contains("'+WidgetSearchQuery+'")').css('display','inline-block');
    $('.template-card:contains("'+WidgetSearchQuery.toLowerCase()+'")').css('display','inline-block');
    $('.template-card:contains("'+toCamelCase(WidgetSearchQuery)+'")').css('display','inline-block');

    if (WidgetSearchQuery == 'all' || WidgetSearchQuery == '') {
      $('.template-card').css('display','inline-block');
    }

    if (WidgetSearchQuery == 'Coming Soon') {
      $('.popup-tutorialNotice').show(150);
    }else{
      $('.popup-tutorialNotice').hide(150);
    }

  })

  $('.templatesTypeFilterItem').on('click', function(){

    $('.templatesTypeFilterItem').removeClass('active');
    $(this).addClass('active');
    var WidgetSearchQuery =  $(this).text();
    $('.template-card').css('display','none');
        
    $('.template-card:contains("'+WidgetSearchQuery+'")').css('display','inline-block');
    

    if (WidgetSearchQuery == 'All') {
      $('.template-card').css('display','inline-block');
    }

    if (WidgetSearchQuery == 'Coming Soon') {
      $('.popup-tutorialNotice').show(150);
    }else{
      $('.popup-tutorialNotice').hide(150);
    }

  });

  $('.closeTutorialNotice').on('click', function(){
    $(this).parent().hide(150);
  });

  
})(jQuery);
  

(function($){

  $(document).on( 'click','.customfontRemoveBtn', function(){
    jQuery(this).parent().parent().remove();
  });

  $(document).on( 'change','.fontTitle', function(){


    if ($(this).val() != '') {
      thisText = $(this).val().slice(0,25);
    }else{
      thisText = '';
    }
    

    $(this).parent().siblings('.handleHeader').html(' Font - '+ thisText + '<span class="dashicons dashicons-trash customfontRemoveBtn"></span>');

  });

  $(document).ready(function() {


    jQuery('#addNewCustomFont').on('click',function(){

      var accordionItemsCount = jQuery('.customFontsItemsContainer li').length;

      var editorId = 'customFontsEditor_'+accordionItemsCount;

      jQuery('.customFontsItemsContainer').append(
        '<li>'+
          '<h3 class="handleHeader">Custom Font '+
            '<span class="dashicons dashicons-trash customfontRemoveBtn"></span>'+
          '</h3>'+
          '<div class="accordContentHolder">'+

              '<label> Font Name  </label>'+
              '<input style="width:90%;" type="text" class="fontTitle" value="Custom Font">'+

              '<br><br><br><br><hr><br>'+
              
              "<label>Font WOFF :</label>"+
              '<input id="image_location_woff_'+accordionItemsCount+'" type="text" class="fontItemUrl image_location_woff_'+accordionItemsCount+' "  name="lpp_add_img_'+accordionItemsCount+'" value=""  placeholder="Upload or Select a font" style="width:90%;" />'+
              "<label></label>"+ 
              '<input id="image_location_woff_'+accordionItemsCount+'" type="button" class="fontUploadBtn" data-id="'+accordionItemsCount+'" data-fonttype="woff" value="Select Font File" style="width:90%;" />'+

              "<br><br><br><br><br><br><br><hr><br>"+

              "<label>Font WOFF2 :</label>"+
              '<input id="image_location_woff2_'+accordionItemsCount+'" type="text" class="fontItemUrl image_location_woff2_'+accordionItemsCount+' "  name="lpp_add_img_'+accordionItemsCount+'" value=""  placeholder="Upload or Select a font" style="width:90%;" />'+
              "<label></label>"+ 
              '<input id="image_location_woff2_'+accordionItemsCount+'" type="button" class="fontUploadBtn" data-id="'+accordionItemsCount+'" data-fonttype="woff2" value="Select Font File" style="width:90%;" />'+

              "<br><br><br><br><br><br><br><hr><br>"+

              "<label>Font TTF :</label>"+
              '<input id="image_location_ttf_'+accordionItemsCount+'" type="text" class="fontItemUrl image_location_ttf_'+accordionItemsCount+' "  name="lpp_add_img_'+accordionItemsCount+'" value=""  placeholder="Upload or Select a font" style="width:90%;" />'+
              "<label></label>"+ 
              '<input id="image_location_ttf_'+accordionItemsCount+'" type="button" class="fontUploadBtn" data-id="'+accordionItemsCount+'" data-fonttype="ttf" value="Select Font File" style="width:90%;" />'+

              "<br><br><br><br><br><br><br><hr><br>"+

              "<label>Font SVG :</label>"+
              '<input id="image_location_svg_'+accordionItemsCount+'" type="text" class="fontItemUrl image_location_svg_'+accordionItemsCount+' "  name="lpp_add_img_'+accordionItemsCount+'" value=""  placeholder="Upload or Select a font" style="width:90%;" />'+
              "<label></label>"+ 
              '<input id="image_location_svg_'+accordionItemsCount+'" type="button" class="fontUploadBtn" data-id="'+accordionItemsCount+'" data-fonttype="svg" value="Select Font File" style="width:90%;" />'+

              "<br><br><br><br><br><br><br><hr><br>"+

              "<label>Font EOT :</label>"+
              '<input id="image_location_eot_'+accordionItemsCount+'" type="text" class="fontItemUrl image_location_eot_'+accordionItemsCount+' "  name="lpp_add_img_'+accordionItemsCount+'" value=""  placeholder="Upload or Select a font" style="width:90%;" />'+
              "<label></label>"+ 
              '<input id="image_location_eot_'+accordionItemsCount+'" type="button" class="fontUploadBtn" data-id="'+accordionItemsCount+'" data-fonttype="eot" value="Select Font File" style="width:90%;" />'+

              "<br><br><br><br><br><br><br><hr><br>"+

          '</div>'+
        '</li>'
      );


      jQuery( '.customFontsItemsContainer' ).accordion( "refresh" );

    }); // Custom fonts Add new function ends here.
    

    jQuery('#addNewAccordionItem').on('click',function(){

      var accordionItemsCount = jQuery('.accordionItemsContainer li').length;

      var editorId = 'accordionEditor_'+accordionItemsCount;

      jQuery('.accordionItemsContainer').append(
        '<li>'+
          '<h3 class="handleHeader">Accordion '+
            '<span class="dashicons dashicons-trash slideRemoveButton"></span>'+
          '</h3>'+
          '<div class="accordContentHolder">'+
              '<label> Title  </label>'+
              '<input style="width:80%;" type="text" class="accoTitle" data-optname="accordionItems.'+accordionItemsCount+'.accoTitle" value="Accordion '+accordionItemsCount+'">'+
              '<br><br><br><br><hr><br>'+
              '<textarea id="'+editorId+'"  class="accContent" data-optname="accordionItems.'+accordionItemsCount+'.accContent"> Accordion '+accordionItemsCount+'</textarea>'+
          '</div>'+
        '</li>'
      );


      pageBuilderApp.changedOpType = 'specific';
      pageBuilderApp.changedOpName = 'slideListEdit';

      var that = jQuery('.closeWidgetPopup').attr('data-CurrWidget');
      jQuery('div[data-saveCurrWidget="'+that+'"]').trigger('click');

      ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
      currentEditableColId = jQuery('.currentEditableColId').val();
      jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

      try {
        wp.editor.initialize(editorId,  { tinymce : pageBuilderApp.tinymce, quicktags: true, mediaButtons: true },  );

        tinymce.editors[editorId].on('change', function (ed, e) {

          pageBuilderApp.changedOpType = 'specific';
          pageBuilderApp.changedOpName =  editorId;
          var that = jQuery('.closeWidgetPopup').attr('data-CurrWidget');
          
          jQuery('div[data-saveCurrWidget="'+that+'"]').trigger('click');

          ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
          currentEditableColId = jQuery('.currentEditableColId').val();
          jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

        });
      } catch(e) {
        console.log(e);
      }

        

      accordionItemsCount++;
      jQuery('.closeWidgetPopup').trigger('click');

    }); // CLICK function ends here.


    $(document).on( 'change','.accoTitle', function(){
      if ($(this).val() == '') {
                
      } else{
        fieldLabel  = $(this).val().slice(0,30);
        $(this).parent().siblings('.handleHeader').html('Accordion - '+fieldLabel + '<span class="dashicons dashicons-trash slideRemoveButton" ></span> <span class="dashicons dashicons-admin-page accordDuplicateButton" style="float: right;" title="Duplicate"></span>');

      }
    });


  });


  $(document).ready(function() {
    

    jQuery('#addNewtabItem').on('click',function(){

      var tabItemsCount = jQuery('.tabItemsContainer li').length;

      var editorId = 'tabEditor_'+tabItemsCount;

      jQuery('.tabItemsContainer').append(
        '<li>'+
          '<h3 class="handleHeader">Tab '+
              '<span class="dashicons dashicons-trash slideRemoveButton"></span>'+
          '</h3>'+
          '<div class="accordContentHolder">'+
            '<label> Title  </label>'+
            '<input style="width:80%;" type="text" class="title" data-optname="tabItems.'+tabItemsCount+'.title" value="Enter Title Here ">'+
            '<br><br><br><br><hr><br>'+
            '<label> Icon  </label>'+
            '<input  data-placement="bottomRight" class="icp pbIconListPicker tabItemsIcon"  type="text" data-optname="tabItems.'+tabItemsCount+'.icon" style="width:95px;" /> <span class="input-group-addon" style="font-size: 14px !important;"></span> <br> <br> '+
            '<br><hr><br>'+
            '<textarea id="'+editorId+'"  class="content" data-optname="tabItems.'+tabItemsCount+'.content" ></textarea>'+
          '</div>'+
        '</li>'
      );


      pageBuilderApp.changedOpType = 'specific';
      pageBuilderApp.changedOpName = 'slideListEdit';

      var that = jQuery('.closeWidgetPopup').attr('data-CurrWidget');
      jQuery('div[data-saveCurrWidget="'+that+'"]').trigger('click');

      ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
      currentEditableColId = jQuery('.currentEditableColId').val();
      jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');


      jQuery( '.tabItemsContainer' ).accordion( "refresh" );

      tabItemsCount++;

    }); // CLICK function ends here.


    $(document).on( 'change','.accTitle', function(){
      if ($(this).val() == '') {
                
      } else{
        fieldLabel  = $(this).val().slice(0,30);
        $(this).parent().siblings('.handleHeader').html('Tab - '+fieldLabel + '<span class="dashicons dashicons-trash slideRemoveButton" ></span> <span class="dashicons dashicons-admin-page accordDuplicateButton" style="float: right;" title="Duplicate"></span>');

      }
    });





    jQuery('#addNewMenuItem').on('click',function(){

      var navItemsCount = jQuery('.customNavItemsContainer li').length;
      jQuery('.customNavItemsContainer').append(
            
        '<li>'+
          '<h3 class="handleHeader">Menu Link <span class="dashicons dashicons-trash slideRemoveButton" style="float: right;"></span> </h3>'+
          '<div  class="accordContentHolder">'+
            '<label> Link Label :</label>'+
            '<input style="width:95%;" type="text" class="cnilab" value="Menu Item" data-optname="navItems.'+navItemsCount+'cnilab" > <br> <br> <br> <br> <br> <br>'+
            '<label> Link URL :</label>'+
            '<input style="width:95%;" type="text" class="cniurl" value="#" data-optname="navItems.'+navItemsCount+'cniurl" >  <br> <br> <br> <br> <br> <br>'+
          '</div>'+
        '</li>'

      );


      pageBuilderApp.changedOpType = 'specific';
      pageBuilderApp.changedOpName = 'slideListEdit';

      var that = jQuery('.closeWidgetPopup').attr('data-CurrWidget');
      jQuery('div[data-saveCurrWidget="'+that+'"]').trigger('click');

      ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
      currentEditableColId = jQuery('.currentEditableColId').val();
      jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

      jQuery( '.customNavItemsContainer' ).accordion( "refresh" );

      navItemsCount++;

    }); // CLICK function ends here.

    
    jQuery('.cnsource').on('change',function(){
      console.log(jQuery(this).val())
      if( jQuery(this).val() == 'WPMenu' ){
        jQuery('.wpMenuSelectionContainer').css('display', 'block');
        jQuery('.customLinksMenuContainer').css('display', 'none');
      }else{
        jQuery('.customLinksMenuContainer').css('display', 'block');
        jQuery('.wpMenuSelectionContainer').css('display', 'none');
      }

    });


    $(document).on( 'change','.customNavItemsContainer input', function(){
        if ( $(this).hasClass('cnilab') ) {
            if ($(this).val() == '') {                
            } else{
                $(this).parent().parent().siblings('.handleHeader').html($(this).val() + '<span class="dashicons dashicons-trash slideRemoveButton" style="float: right;"></span>');
            }
        }

      jQuery('.closeWidgetPopup').trigger('click');
    });


  });

})(jQuery);



(function ($) {

  // Detect touch support
  $.support.touch = 'ontouchend' in document;

  // Ignore browsers without touch support
  if (!$.support.touch) {
    return;
  }

  var mouseProto = $.ui.mouse.prototype,
      _mouseInit = mouseProto._mouseInit,
      _mouseDestroy = mouseProto._mouseDestroy,
      touchHandled;

  /**
   * Simulate a mouse event based on a corresponding touch event
   * @param {Object} event A touch event
   * @param {String} simulatedType The corresponding mouse event
   */
  function simulateMouseEvent (event, simulatedType) {

    // Ignore multi-touch events
    if (event.originalEvent.touches.length > 1) {
      return;
    }

    event.preventDefault();

    var touch = event.originalEvent.changedTouches[0],
        simulatedEvent = document.createEvent('MouseEvents');
    
    // Initialize the simulated mouse event using the touch event's coordinates
    simulatedEvent.initMouseEvent(
      simulatedType,    // type
      true,             // bubbles                    
      true,             // cancelable                 
      window,           // view                       
      1,                // detail                     
      touch.screenX,    // screenX                    
      touch.screenY,    // screenY                    
      touch.clientX,    // clientX                    
      touch.clientY,    // clientY                    
      false,            // ctrlKey                    
      false,            // altKey                     
      false,            // shiftKey                   
      false,            // metaKey                    
      0,                // button                     
      null              // relatedTarget              
    );

    // Dispatch the simulated event to the target element
    event.target.dispatchEvent(simulatedEvent);
  }

  /**
   * Handle the jQuery UI widget's touchstart events
   * @param {Object} event The widget element's touchstart event
   */
  mouseProto._touchStart = function (event) {

    var self = this;

    // Ignore the event if another widget is already being handled
    if (touchHandled || !self._mouseCapture(event.originalEvent.changedTouches[0])) {
      return;
    }

    // Set the flag to prevent other widgets from inheriting the touch event
    touchHandled = true;

    // Track movement to determine if interaction was a click
    self._touchMoved = false;

    // Simulate the mouseover event
    simulateMouseEvent(event, 'mouseover');

    // Simulate the mousemove event
    simulateMouseEvent(event, 'mousemove');

    // Simulate the mousedown event
    simulateMouseEvent(event, 'mousedown');
  };

  /**
   * Handle the jQuery UI widget's touchmove events
   * @param {Object} event The document's touchmove event
   */
  mouseProto._touchMove = function (event) {

    // Ignore event if not handled
    if (!touchHandled) {
      return;
    }

    // Interaction was not a click
    this._touchMoved = true;

    // Simulate the mousemove event
    simulateMouseEvent(event, 'mousemove');
  };

  /**
   * Handle the jQuery UI widget's touchend events
   * @param {Object} event The document's touchend event
   */
  mouseProto._touchEnd = function (event) {

    // Ignore event if not handled
    if (!touchHandled) {
      return;
    }

    simulateMouseEvent(event, 'mouseup');

    simulateMouseEvent(event, 'mouseout');

    if (!this._touchMoved) {

      simulateMouseEvent(event, 'click');
    }

    touchHandled = false;
  };

  
  mouseProto._mouseInit = function () {
    
    var self = this;

    self.element.bind({
      touchstart: $.proxy(self, '_touchStart'),
      touchmove: $.proxy(self, '_touchMove'),
      touchend: $.proxy(self, '_touchEnd')
    });

    _mouseInit.call(self);
  };

  
  mouseProto._mouseDestroy = function () {
    
    var self = this;

    // Delegate the touch handlers to the widget's element
    self.element.unbind({
      touchstart: $.proxy(self, '_touchStart'),
      touchmove: $.proxy(self, '_touchMove'),
      touchend: $.proxy(self, '_touchEnd')
    });

    // Call the original $.ui.mouse destroy method
    _mouseDestroy.call(self);
  };

})(jQuery);



(function ($) {

  $(document).ready(function() {


  try {
      
    

    jQuery( function() {
      jQuery( "#PB_accordion, .PB_accordion" ).accordion({
        collapsible: true,
        heightStyle: "content",

      });
    });

    jQuery( function() {
      jQuery( "#PB_accordion_customHTMlForm, .PB_accordion_customHTMlForm" ).accordion({
        collapsible: true,
        heightStyle: "content",
        active: false
      });
    });

    jQuery( function() {
      jQuery( "#PB_accordion_forms, .PB_accordion_forms" ).accordion({
        collapsible: true,
        heightStyle: "content"
      });
    });
    
    jQuery( function() {
      jQuery( "#accordion1" ).accordion({
        collapsible: true,
        heightStyle: "content"
      });
    });

    jQuery( ".sortableAccordionWidget" )
    .accordion({
      header: '> li > h3',
      collapsible: true,
      active:false,
      heightStyle: "content"
    })
    .sortable({
          axis: "y",
          handle: ".handleHeader",
          stop: function( event, ui ) {
            // IE doesn't register the blur when sorting
            // so trigger focusout handlers to remove .ui-state-focus
            ui.item.children( ".handleHeader" ).triggerHandler( "focusout" );
            pageBuilderApp.changedOpType = 'specific';
            pageBuilderApp.changedOpName = 'slideListEdit';
            
            var that = jQuery('.closeWidgetPopup').attr('data-CurrWidget');
            jQuery('div[data-saveCurrWidget="'+that+'"]').trigger('click');

            ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
            currentEditableColId = jQuery('.currentEditableColId').val();
            jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');
            // Refresh accordion to handle new order
            jQuery( this ).accordion( "refresh" );
          }
    });


    jQuery( ".customFontsItemsContainer" )
    .accordion({
      header: '> li > h3',
      collapsible: true,
      active:false,
      heightStyle: "content"
    });



    jQuery('.pbicp-auto').iconpicker({ });

    jQuery('.pbicp-auto').on('iconpickerSelected',function(event){
      jQuery(this).trigger('change');
    });

    jQuery('.pbIconListPicker').iconpicker({ });

    jQuery('.pbIconListPicker').on('iconpickerSelected',function(event){
      jQuery(this).trigger('change');
    });

    $('.popb_checkbox').checkboxradio({
      icon: false
    });


    var localFonts = [];

    try {
      
      $.each(popb_admin_url_data.customFonts,function(index, val) {
        
        localFonts.push(val['fontTitle']);

      });

    } catch(e) {
      console.log(e);
    }

    jQuery('.gFontSelectorulpb').fontselect({
      style: 'font-select',
      placeholder: 'Select a font',
      placeholderSearch: 'Search...',
      lookahead: 1,
      searchable: true,
      localFonts: localFonts,
      localFontsUrl: '/fonts/' // End with a slash!
    });

  } catch(e) {
    console.log(e);
  }


      

    jQuery("input").on('keypress',function (evt) {
    
      var keycode = evt.charCode || evt.keyCode;
      if (keycode  == 13) { //Enter key's keycode
        return false;
      }
      
    });


    try {
      String.prototype.PBSearchStrcapitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
      }
      
      jQuery('.pbSearchWidget').on('keyup', function(){
        var WidgetSearchQuery =  jQuery(this).val().PBSearchStrcapitalize();
        jQuery('.POPB_widget').css('display','none');
        
        jQuery('.POPB_widget:contains("'+WidgetSearchQuery+'")').css('display','block');

      });
    } catch(e) {
      // statements
      console.log(e);
    }
      


    if (pageBuilderApp.premActive == 'true') {
      $('.premiumNoticeWidget').css('display','none');
    }


  });

})(jQuery);




( function( $ ) {

  jQuery(document).ready(function($) {

    $('[data-optname="rowData.bg_img"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal != '' && thisFieldVal != ' ') {
        $('.imageBackgroundOpsRow').css('display','block');
      }else{
        $('.imageBackgroundOpsRow').css('display','none');
      }
    });

    $('[data-optname="rowData.bg_imgT"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal != '' && thisFieldVal != ' ') {
        $('.imageBackgroundOpsRow').css('display','block');
      }else{
        $('.imageBackgroundOpsRow').css('display','none');
      }
    });

    $('[data-optname="rowData.bg_imgM"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal != '' && thisFieldVal != ' ') {
        $('.imageBackgroundOpsRow').css('display','block');
      }else{
        $('.imageBackgroundOpsRow').css('display','none');
      }
    });

    $('[data-optname="rowData.bgImgOps.pos"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomPositionDiv').css('display','block');
      }else{
        $('.rowBgImgCustomPositionDiv').css('display','none');
      }
    });
    $('[data-optname="rowData.bgImgOps.posT"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomPositionDiv').css('display','block');
      }else{
        $('.rowBgImgCustomPositionDiv').css('display','none');
      }
    });
    $('[data-optname="rowData.bgImgOps.posM"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomPositionDiv').css('display','block');
      }else{
        $('.rowBgImgCustomPositionDiv').css('display','none');
      }
    });



    $('[data-optname="rowData.bgImgOps.size"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomSizeDiv').css('display','block');
      }else{
        $('.rowBgImgCustomSizeDiv').css('display','none');
      }
    });
    $('[data-optname="rowData.bgImgOps.sizeT"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomSizeDiv').css('display','block');
      }else{
        $('.rowBgImgCustomSizeDiv').css('display','none');
      }
    });
    $('[data-optname="rowData.bgImgOps.sizeM"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomSizeDiv').css('display','block');
      }else{
        $('.rowBgImgCustomSizeDiv').css('display','none');
      }
    });



    $('[data-optname="rowData.conType"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'boxed') {
        $('.boxedWidthOptionContainer').css('display','block');
      }else{
        $('.boxedWidthOptionContainer').css('display','none');
      }
    });





    //cols

    $('[data-optname="colBgImg"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal != '' && thisFieldVal != ' ') {
        $('.imageBackgroundOpsCol').css('display','block');
      }else{
        $('.imageBackgroundOpsCol').css('display','none');
      }
    });

    $('[data-optname="colBgImgT"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal != '' && thisFieldVal != ' ') {
        $('.imageBackgroundOpsCol').css('display','block');
      }else{
        $('.imageBackgroundOpsCol').css('display','none');
      }
    });

    $('[data-optname="colBgImgM"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal != '' && thisFieldVal != ' ') {
        $('.imageBackgroundOpsCol').css('display','block');
      }else{
        $('.imageBackgroundOpsCol').css('display','none');
      }
    });

    $('[data-optname="bgImgOps.pos"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomPositionDiv').css('display','block');
      }else{
        $('.rowBgImgCustomPositionDiv').css('display','none');
      }
    });
    $('[data-optname="bgImgOps.posT"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomPositionDiv').css('display','block');
      }else{
        $('.rowBgImgCustomPositionDiv').css('display','none');
      }
    });
    $('[data-optname="bgImgOps.posM"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomPositionDiv').css('display','block');
      }else{
        $('.rowBgImgCustomPositionDiv').css('display','none');
      }
    });



    $('[data-optname="bgImgOps.size"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomSizeDiv').css('display','block');
      }else{
        $('.rowBgImgCustomSizeDiv').css('display','none');
      }
    });
    $('[data-optname="bgImgOps.sizeT"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomSizeDiv').css('display','block');
      }else{
        $('.rowBgImgCustomSizeDiv').css('display','none');
      }
    });
    $('[data-optname="bgImgOps.sizeM"]').on('change',function(){
      var thisFieldVal = $(this).val();
      if (thisFieldVal == 'custom') {
        $('.rowBgImgCustomSizeDiv').css('display','block');
      }else{
        $('.rowBgImgCustomSizeDiv').css('display','none');
      }
    });



    /* Misc Widgets Starts */

    jQuery('.pbIconRotation').on('change',function(){
      var pbIconRotation = jQuery('.pbIconRotation').val();
      jQuery('.pbselIconStyles').css('transform','rotate('+pbIconRotation+ 'deg)');
    });
    jQuery('.pbIconColor').on('change',function(){
      var pbIconColor = jQuery('.pbIconColor').val();
      jQuery('.pbselIconStyles').css('color',pbIconColor);
    });

    jQuery('.pbIcStyle').on('change',function(){
      if ( jQuery(this).val() == 'solid') {
        jQuery('.iconStyleOps').css('display','block');
      }else{
        jQuery('.iconStyleOps').css('display','none');
      }
    });


    jQuery('#ftr-img-size').on('change', function(e) {
      
      selectedValue = jQuery(this).val();

      if (selectedValue == 'custom') {
        jQuery('.customImageSizeDiv').css('display','block');
      } else {
        jQuery('.customImageSizeDiv').css('display','none');
      }

    });


    $('.btnClickAction').on('change',function(){

      $('.btnLinkOpsContainer').css('display','none');
      $('.openPopUpOpsContainer').css('display','none');
      $('.btnWooCommOpsContainer').css('display','none');

      if ( $(this).val() == 'openPopUp' ) {
        $('.btnLinkOpsContainer').css('display','none');
        $('.openPopUpOpsContainer').css('display','block');
      } else if ( $(this).val() == 'addToCart' ) {
        $('.btnWooCommOpsContainer').css('display','block');
      } else if ( $(this).val() == 'addToCheckout' ) {
        $('.btnWooCommOpsContainer').css('display','block');
      } else{
        $('.btnLinkOpsContainer').css('display','block');
      }

    });


    jQuery('.pbCountDownType').on('change',function(){

      pbCountDownType = jQuery('.pbCountDownType').val();
      if (pbCountDownType == 'evergreen') {
        jQuery('#fixedCountdown').css('display','none');
        jQuery('#evergreenCountdown').css('display','block');
      }else{
        jQuery('#evergreenCountdown').css('display','none');
        jQuery('#fixedCountdown').css('display','block');
      }

    });

    /* Misc Widgets Ends */


    jQuery('.fullErrorMessage p').on('click',function(){
      $(this).html($('.fullErrorMessageInput').val());
    });


    $('.imgUrl').on('change',function(){

      $('.selectImagePreview').attr('src', $(this).val() );

    });


    $('.widgetHeadlineTextType').on('change', function(){
      
      let value = $(this).val();

      $('.headlineWidgetOpsContainer').css('display','none');

      if(value === "Default"){
        $('.headlineTypeDefaultOps').css('display','block');
      }else{
        $('.headlineTypeSimilarOps').css('display','block');
      }

      if(value === "Animated"){
        $('.headlineTypeAnimatedOps').css('display','block');
        $('.headlineRotatingTextContainer').css('display','block');
      }

      if(value === "Highlighted"){
        $('.headlineTypeHighlightedOps').css('display','block');
        $('.headlineHighlightTextContainer').css('display','block');
      }

    });
    
    


    
  });

}( jQuery ) );
