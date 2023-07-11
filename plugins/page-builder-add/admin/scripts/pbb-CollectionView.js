( function( $ ) {
pageBuilderApp.rowList = new pageBuilderApp.RowCollection();
pageBuilderApp.widgetList = new pageBuilderApp.WidgetCollection();
pageBuilderApp.PageBuilderModel = new pageBuilderApp.ULPBPage();

pageBuilderApp.row = new pageBuilderApp.Row();
var widget = new pageBuilderApp.ColWidget();

//check local storage for stored data on error. 
let pageID = popb_admin_vars_data.post_id;

let ulpb_loadedFromLocalStorage = false;

function loadFromLocalStorageObject(template){

  pageBuilderApp.PageBuilderModel.set(template);

      var Rows = pageBuilderApp.PageBuilderModel.get('Rows');
      var pageOptions = pageBuilderApp.PageBuilderModel.get('pageOptions');
      var pageStatus = pageBuilderApp.PageBuilderModel.get('pageStatus');

      allRowsInString = JSON.stringify(Rows);

      allRowsInString = allRowsInString.replaceAll('<pluginopsfont ', '<link ');
      allRowsInString = allRowsInString.replaceAll('<pluginopsstyle>', '<style>');
      allRowsInString = allRowsInString.replaceAll('</pluginopsstyle>', '</style>');
      allRowsInString = allRowsInString.replaceAll('<pluginopsscript', '<script');
      allRowsInString = allRowsInString.replaceAll('</pluginopsscript>', '</script>');

      Rows = JSON.parse(allRowsInString);
      
      renderPageOps(pageOptions, pageStatus);


      rowslength = 0;
      try {

        _.each( Rows, function(Row, index ) {
        pageBuilderApp.rowList.add(Row);
        rowslength++;
        
      });
      } catch(error) {
        console.log(error);

        jQuery('.popb_safemode_popup').css('display','block');

        jQuery('.confirm_safemode_no').on('click',function(){
          jQuery('.popb_safemode_popup').css('display','none');
          location.reload();
        });

        popb_errorLog.errorMsg = error.message;
        popb_errorLog.errorURL = error.stack.split("\n")[1];

        jQuery('.fullErrorMessage p').text('Click To View Full Error Message');
        jQuery('.fullErrorMessageInput').val(popb_errorLog.errorMsg);

        jQuery('.confirm_safemode_yes').on('click',function(){

            var result = " ";
            var form = jQuery('.insertTemplateForm');

            jQuery.ajax({
                url: admURL+'/admin-ajax.php?action=popb_enable_safe_mode&POPB_nonce='+shortCodeRenderWidgetNO,
                method: 'post',
                data:{
                  errorMsg : popb_errorLog.errorMsg,
                  errorURL : popb_errorLog.errorURL,
                },
                success: function(result){
                    location.reload();
                }
            });

        });


      }

      ulpb_loadedFromLocalStorage = true;

}

const getLocalStorageTemplateData = window.localStorage.getItem('ulpbStoreDataObect_'+pageID);

if(getLocalStorageTemplateData !== null){

  const ulpb_localStorageObject = JSON.parse(getLocalStorageTemplateData);
  if(ulpb_localStorageObject.pageID === pageID){
    loadFromLocalStorageObject(ulpb_localStorageObject);
  }

}
  

if(ulpb_loadedFromLocalStorage === false){
  pageBuilderApp.PageBuilderModel.fetch({
    success: function() { 
      var Rows = pageBuilderApp.PageBuilderModel.get('Rows');
      var pageOptions = pageBuilderApp.PageBuilderModel.get('pageOptions');
      var pageStatus = pageBuilderApp.PageBuilderModel.get('pageStatus');

      allRowsInString = JSON.stringify(Rows);

      allRowsInString = allRowsInString.replaceAll('<pluginopsfont ', '<link ');
      allRowsInString = allRowsInString.replaceAll('<pluginopsstyle>', '<style>');
      allRowsInString = allRowsInString.replaceAll('</pluginopsstyle>', '</style>');
      allRowsInString = allRowsInString.replaceAll('<pluginopsscript', '<script');
      allRowsInString = allRowsInString.replaceAll('</pluginopsscript>', '</script>');

      Rows = JSON.parse(allRowsInString);
      
      renderPageOps(pageOptions, pageStatus);


      rowslength = 0;
      try {

        _.each( Rows, function(Row, index ) {
        pageBuilderApp.rowList.add(Row);
        rowslength++;
        
      });
      } catch(error) {
        console.log(error);

        jQuery('.popb_safemode_popup').css('display','block');

        jQuery('.confirm_safemode_no').on('click',function(){
          jQuery('.popb_safemode_popup').css('display','none');
          location.reload();
        });

        popb_errorLog.errorMsg = error.message;
        popb_errorLog.errorURL = error.stack.split("\n")[1];

        jQuery('.fullErrorMessage p').text('Click To View Full Error Message');
        jQuery('.fullErrorMessageInput').val(popb_errorLog.errorMsg);

        jQuery('.confirm_safemode_yes').on('click',function(){

            var result = " ";
            var form = jQuery('.insertTemplateForm');

            jQuery.ajax({
                url: admURL+'/admin-ajax.php?action=popb_enable_safe_mode&POPB_nonce='+shortCodeRenderWidgetNO,
                method: 'post',
                data:{
                  errorMsg : popb_errorLog.errorMsg,
                  errorURL : popb_errorLog.errorURL,
                },
                success: function(result){
                    location.reload();
                }
            });

        });


      }


      //pageBuilderApp.rowUndoManager.startTracking();

      if (rowslength == 0) {
        var currentAttrValue = jQuery('.templatesTabDefault').children('a').attr('href');
        jQuery('.pluginops-tabs ' + currentAttrValue).show().siblings().hide();
        jQuery('.templatesTabDefault').addClass('pluginops-active').siblings().removeClass('pluginops-active');
      }
      // console.log(JSON.stringify(pageBuilderApp.PageBuilderModel) );
    },
    error: function() {
        console.log('Failed to fetch!');
    }
  });
}



pageBuilderApp.PgCollectionView = new Backbone.CollectionView( {
    el : $( "#container" ),
    modelView : pageBuilderApp.RowView,
    collection : pageBuilderApp.rowList,
    sortable: true,
    selectable: false,
    emptyListCaption: ''+
      '<div class="newRowBtnContainerVisible" >'+
        '<div class="newRowBtnContainerSections">'+
          '<div class="addNewRowVisible  row-section-btn" style="background:#5AB1F7;" > ADD NEW SECTION</div>'+
        '</div>'+
        '<div class="newRowBtnContainerSections" style="display: none;">'+
          '<div class="addNewGlobalRowVisible  row-section-btn" style="background:#F1D204;" > INSERT GLOBAL SECTION</div>'+
        '</div>'+
        '<div class="newRowBtnContainerSections">'+
          '<div class="addNewRowBlockVisible  row-section-btn" style="background:#4CAF50;">INSERT DESIGN BLOCK</div>'+
        '</div> '+
      '</div>'+
      '<br> <br> <br> <h3 style="margin-left:50px;"> Add a section to get started.</h3>',
      
} );




/*
var PgFullWidthCollectionView = new Backbone.CollectionView( {
    el : $( "#fullWidthContainer" ),
    modelView : pageBuilderApp.RowView,
    collection : pageBuilderApp.rowList,
    sortable: true,
    selectable: false,
    emptyListCaption: '<h3>Add some rows.</h3>'
} );
*/

var widgetCollectionView = new Backbone.CollectionView( {
    el : $( "#widgets" ),
    modelView : pageBuilderApp.WidgetView,
    collection : pageBuilderApp.widgetList,
    sortable: true,
    selectable: false,
    emptyListCaption: 'Add some widgets.',

} );



widgetCollectionView.on('sortStop',function(){
    ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
    currentEditableColId = jQuery('.currentEditableColId').val();
    jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSave').trgger('click');
});

pageBuilderApp.PgCollectionView.render();
//PgFullWidthCollectionView.render();
widgetCollectionView.render();

// pageBuilderApp.rowUndoManager = new Backbone.UndoManager({
//   track: false, 
//   maximumStackLength: 30,
//   register: [pageBuilderApp.rowList ]
// });


$(document).ready(function(){
  $('#pbbtnUndo').on('click',function(){
    /*
    if ( pageBuilderApp.rowUndoManager.isAvailable('undo') ) {
      $('.pb_loader_container').css('display','block');
      try {
        pageBuilderApp.rowUndoManager.undo();
        pageBuilderApp.PgCollectionView.render();
      } catch (e){
        $('.ulpb_column_controls').hide();
        hideWidgetOpsPanel();
        $('.pageops_modal').hide(50);
        $('.edit_column').hide(50);
        $('.insertRowBlock').hide(50);
        setTimeout(function(){
          $('.pb_loader_container').css('display','none');
        },250);
      }

      
      setTimeout(function(){
        $('.pb_loader_container').css('display','none');
      },250);
    }
    */
    if (isUndoAvailable()) {
      popb_undo();

      $('.ulpb_column_controls').hide();
      hideWidgetOpsPanel();
      $('.pageops_modal').hide(50);
      $('.edit_column').hide(50);
      $('.insertRowBlock').hide(50);
    }
    
  });

  $('#pbbtnRedo').on('click',function(){
    
    /*
    if ( pageBuilderApp.rowUndoManager.isAvailable('redo') ) {
      $('.pb_loader_container').css('display','block');

      try {
        pageBuilderApp.rowUndoManager.redo();
        pageBuilderApp.PgCollectionView.render();
      } catch (e){

      }

      
      $('.ulpb_column_controls').hide();
      hideWidgetOpsPanel();
      $('.pageops_modal').hide(50);
      $('.edit_column').hide(50);
      $('.insertRowBlock').hide(50);
      setTimeout(function(){
        $('.pb_loader_container').css('display','none');
      },250);
    }
    */
    if (isRedoAvailable()) {
      popb_redo();

      $('.ulpb_column_controls').hide();
      hideWidgetOpsPanel();
      $('.pageops_modal').hide(50);
      $('.edit_column').hide(50);
      $('.insertRowBlock').hide(50);
    }
    
  });


  jQuery(document).ready(function($) {
    
    try {
      if ( ! isUndoAvailable() ) {
          jQuery('#pbbtnUndo').css('background','#c5c5c5');
      }else{
          jQuery('#pbbtnUndo').css('background','#e3e3e3');
      }

      if ( ! isRedoAvailable() ) {
          jQuery('#pbbtnRedo').css('background','#c5c5c5');
      }else{
          jQuery('#pbbtnRedo').css('background','#e3e3e3');
      }
    } catch(e) {
      // statements
      console.log(e);
    }

      

  });
    

});



}( jQuery ) );