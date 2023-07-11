( function( $ ) {
pageBuilderApp.prevStateOption = false;
const setUpdateObject = (obj, path, val) => { 
    const keys = path.split('.');
    const lastKey = keys.pop();
    const lastObj = keys.reduce((obj, key) => 
        obj[key] = obj[key] || {}, 
        obj);
    if (typeof(lastObj) != 'undefined') {
        pageBuilderApp.prevStateOption = _.clone(lastObj[lastKey]);
        lastObj[lastKey] = val;
    }
    
    
};

function mergeNonsetObjectKeys(source, target) {
    Object.keys(target).forEach(function (k) {

      if (typeof source[k] === 'undefined') {
        source[k] = target[k];
      }else{

        if (typeof(target[k]) == 'object' ) {
          Object.keys(target[k]).forEach(function (k2) {

            if (typeof source[k][k2] === 'undefined') {
              source[k][k2] = target[k][k2];
            }else{


              if (typeof(target[k][k2]) == 'object' ) {
                Object.keys(target[k][k2]).forEach(function (k3) {

                  if (typeof source[k][k2][k3] === 'undefined') {
                    source[k][k2][k3] = target[k][k2][k3];
                  }

                });
              }


            }

          });
        }

      }


    });
}


pageBuilderApp.WidgetView = Backbone.View.extend({
  tagName: 'div',
  className: 'wdt-droppable',
  template: _.template($('#widget-template').html()),
  attributes: function() {
        if(this.model) {
            return {
                'data-widgetID': this.model.cid
            }
        }
        return {}
  },
  events: {
    'click #widgetDelete': 'deleteWidget',
    'click #widgetEdit': 'EditWidget',
    'click #widgetSave': 'updateWidget',
    'click #widgetDuplicate': 'duplicateWidget',
    'click #updateWidgetTemplate': 'updateWidgetTemplate',
    'click #addWidgetTemplateStateToUndoRedo': 'addWidgetTemplateStateToUndoRedo',
    'click #pasteCopiedOptions': 'pasteCopiedOptions',
    'click #updateInlineTextChanges': 'updateInlineTextChanges',
    'click #updateWidgetAdvancedOps': 'loadAdvancedOps',
  },
  initialize: function () {
    _.bindAll(this,'render','deleteWidget','EditWidget','loadAdvancedOps','updateWidget','duplicateWidget','updateWidgetTemplate','addWidgetTemplateStateToUndoRedo','pasteCopiedOptions','updateInlineTextChanges' ,'reRenderWidget');
  },
  render: function () {
        this.$el.html(this.template(this.model.toJSON() )  );

        var widgetType = this.model.get('widgetType');
        var textb = "To edit this widget click the edit button.";
        switch(widgetType){
            case 'wigt-WYSIWYG': textc = 'HTML Widget';      var texta = 'fa-file-text-o'; break;
            case 'wigt-img': textc = 'Image Widget';      var texta = 'fa-picture-o'; break;
            case 'wigt-menu': textc = 'Menu Widget';     var texta = 'fa-picture-o'; break;
            case 'wigt-slider': textc = 'Slider Widget';   var texta = "Slider Extension"; break;
            case 'wigt-btn-gen': textc = 'Button Widget';      var texta = 'fa-mouse-pointer'; break;
            case 'wigt-Sform': textc = 'Subscribe Form Widget';    var texta = "Subscribe Form Extension"; break;
            case 'wigt-PostSlider': textc = 'Posts Slider Widget';   var texta = "Posts Slider Extension"; break;
            case 'wigt-TestimonialSlider': textc = 'Testimonial Slider Widget';    var texta = "Testimonial Slider Extension"; break;
            case 'wigt-SocialFeed': textc = 'Social Stream Widget';   var texta = "Social Feed Extension"; break;
            case 'wigt-pb-form': textc = 'Subscribe Form Widget';      var texta = 'fa-envelope-o'; break;
            case 'wigt-video': textc = 'Video Widget';    var texta = 'fa-video-camera'; break;
            case 'wigt-pb-postSlider': textc = 'Posts Slider Widget';    var texta = 'fa-file-image-o'; break;
            case 'wigt-pb-icons': textc = 'Icon Widget';     var texta = 'fa-fonticons'; break;
            case 'wigt-pb-counter': textc = 'Number Counter Widget';   var texta = 'fa-sort-numeric-desc'; break;
            case 'wigt-pb-audio': textc = 'Audio Widget';     var texta = 'fa-file-audio-o'; break;
            case 'wigt-pb-cards': textc = 'Card Widget';     var texta = 'fa-fonticons'; break;
            case 'wigt-pb-testimonial': textc = 'Testimonial Widget';   var texta = 'fa-quote-left'; break;
            case 'wigt-pb-shortcode': textc = 'Shortcode Widget';     var texta = 'fa-code'; break;
            case 'wigt-pb-countdown': textc = 'Countdown Timer Widget';     var texta = 'fa-sort-numeric-desc'; break;
            case 'wigt-pb-imageSlider': textc = 'Image Slider Widget';     var texta = 'fa-file-image-o'; break;
            case 'wigt-pb-progressBar': textc = 'Progress Bar Widget';     var texta = 'fa-align-left'; break;
            case 'wigt-pb-pricing': textc = 'Pricing Widget';     var texta = 'fa-tags'; break;
            case 'wigt-pb-iconList': textc = 'Icon List';     var texta = 'fa-list'; break;
            case 'wigt-pb-break': textc = 'Break';     var texta = 'fa-ellipsis-h'; break;
            case 'wigt-pb-spacer': textc = 'Spacer';     var texta = 'fa-arrows-v'; break;
            case 'wigt-pb-formBuilder': textc = 'Form Builder';     var texta = 'fa-wpforms'; break;

            case 'wigt-pb-imgCarousel': textc = 'Image Carousel';     var texta = ' "> <i class="fa fa-image"></i><i class="fa fa-image"></i " '; break;

            case 'wigt-pb-wooCommerceProducts': textc = 'WooCommerce Products';     var texta = 'fa-shopping-cart'; break;
            case 'wigt-pb-text': textc = 'Text Widget';     var texta = 'fa-text-width'; break;
            case 'wigt-pb-liveText': textc = 'Text Widget';     var texta = 'fa-text-width'; break
            case 'wigt-pb-embededVideo': textc = 'Embed Video';     var texta = 'fa-youtube-play'; break;
            case 'wigt-pb-popupClose': textc = 'Button Close';     var texta = 'fa-remove'; break;
            case 'wigt-pb-testimonialCarousel': textc = 'Testimonial Carousel';     var texta = 'fa-quote-left'; break;
            case 'wigt-pb-poOptins': textc = 'PluginOps Optins';     var texta = 'fa-puzzle-piece'; break;
            case 'wigt-pb-navmenu': textc = 'Custom Navigation';     var texta = 'fa-puzzle-piece'; break;

            case 'wigt-pb-gallery': textc = 'Image Gallery';     var texta = 'fa-image'; break;


            default : textc = 'No Widget Selected';     var texta = 'Drag a widget or extension and drop it here to use it.'; var textb = " ";  break;
          }

        $(this.el).append(
            '<p class="widget-area-'+this.model.cid+'" style="margin:-15px 5px 0 5px;font-size:14px;"> <i style="font-size:28px; color:#555d66;" class="fa '+texta+'"></i> <br>'+textc+' <br> <br> '+textb+'</p>'+
            '<div style=" display:none;margin-top:-3px; margin-right:5px; "  class="wdt-edit-controls">'+
                '<div class="btn btn-red remove-widgets" id="widgetDelete" " ><span class="dashicons dashicons-trash"></span></div>'+
                '<div id="widgetEdit" class="btn editWidget-'+this.model.cid+'" "> <span class="dashicons dashicons-edit"></span></div>'+
                '<div id="widgetDuplicate" class="btn" "> <span class="dashicons dashicons-admin-page"></span></div>  '+
                '<div id="updateWidgetTemplate" class="pb_hidden" data-thisWidgetCid="'+this.model.cid+'"  data-selected_widget_template=""></div>'+
                '<div id="addWidgetTemplateStateToUndoRedo" class="pb_hidden" data-thisWidgetCid="'+this.model.cid+'"  data-selected_widget_template=""></div>'+
                '<div id="pasteCopiedOptions" class="pb_hidden" data-thisWidgetCid="'+this.model.cid+'"  data-selected_widget_template=""></div>'+
                '<div id="updateInlineTextChanges" class="pb_hidden" data-thisWidgetCid="'+this.model.cid+'"  data-selected_widget_template=""></div>'+
                '<div id="updateWidgetAdvancedOps" class="pb_hidden" data-thisWidgetCid="'+this.model.cid+'"></div>'+
            '</div>'+
            '<input type="text" name="widget-type" class="bp_hidden" style="display:none"  data-widgetType-id="'+this.model.cid+'" value="'+widgetType+'">'
        );

        $('.wdt-droppable').mouseover(function(ev){
            $(ev.target).children(' .wdt-edit-controls').css('display','block');
        });
        $('.wdt-droppable').mouseleave(function(ev){
            $('.wdt-edit-controls').css('display','none');
        });

        $(this.el).append('<div id="widgetSave" class="pb_hidden" data-saveCurrWidget="'+this.model.cid+'"></div>');
  },
  deleteWidget: function () {
        thisDeletedModelAttrs = this.model.clone();
        thisWidgetIndex = pageBuilderApp.widgetList.indexOf(this.model);
        this.model.destroy();
        $(this.el).remove();
        
        ColcurrentEditableRowID = pageBuilderApp.currentlyEditedThisRow;
        currentEditableColId = pageBuilderApp.currentlyEditedThisCol;
        jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');
        jQuery('#'+pageBuilderApp.currentlyEditedColId).children('.wdgt-colChange').trigger('click');
       
        

        if (pageBuilderApp.dontSendToStack != true) {
            var thisChangeRedoProps = {
                changeModelType : 'widgetSpecialAction',
                specialAction:'delete',
                thisModelElId:ColcurrentEditableRowID,
                thisColId:currentEditableColId,
                thisWidgetId:thisWidgetIndex,
                changedOpValue:JSON.stringify(thisDeletedModelAttrs.attributes),
            }
            sendDataBackToUndoStack(thisChangeRedoProps);
        }
        
        pageBuilderApp.dontSendToStack = false;
        $('.ulpb_column_controls').css('display','none');
        hideWidgetOpsPanel();
        $('.pageops_modal').css('display','none');
        $('.edit_column').css('display','none');
        $('.insertRowBlock').css('display','none');
  },
  EditWidget: function () {
    
        //console.log('EditWidget')
        //var tuc0 = performance.now();

        showWidgetOpsPanel();

        $('[href="#tabBasicWidgetOptions"]').trigger('click');

        if (typeof(resizeWindowOpen) != 'undefined') {
            resizeWindowOpen();
        }

        var this_widget_type = $('input[data-widgetType-id="'+this.model.cid+'"]').val();

        thisWidgetIndex = pageBuilderApp.widgetList.indexOf(this.model);
        if (pageBuilderApp.currentlyEditedWidgId != thisWidgetIndex) {
          pageBuilderApp.currentlyEditedWidgId = thisWidgetIndex;
        }
        
        $('.premWidgetNotice').css('display','none');
        //console.log( JSON.stringify(this.model.attributes ) );


        jQuery('.widgetblock').css('display','none');

        jQuery('.widgetblock:contains("'+this_widget_type+'")').css('display','block');

        //$('#columnContent').val(this_column_content);
        $('.pbp-widgets').css('display','none');

        switch (this_widget_type) {
            case 'wigt-WYSIWYG':
                // WYISWYG Options
                var this_widget_editor_content = this.model.get('widgetWYSIWYG');
                var editorContent = this_widget_editor_content['widgetContent'];

                // Editor Widget Options
                let editorID = 'columnContent';
                $('#'+editorID).val(editorContent);
              
              $('.wdt-editor').css('display','block');
            break;
            case 'wigt-img':
                //Image widget Options
                var this_widget_img_content = this.model.get('widgetImg');

                document.getElementById("imgWidgetOpsForm").reset();

                $.each(this_widget_img_content,function(index, val) {

                    if (val != '') {

                        $('.'+index).val(val);

                        if (index == 'imgUrl') {
                            $('.selectImagePreview').attr('src',val);
                        }

                        if (index == 'iwbc') {
                            $("."+index).spectrum( 'set', val );
                        }

                        if (index == 'iwbsc') {
                            $("."+index).spectrum( 'set', val );
                        }

                        if (index == 'imgwctc') {
                            $("."+index).spectrum( 'set', val );
                        }

                        if (index == 'imgwccbg') {
                            $("."+index).spectrum( 'set', val );
                        }

                        if (index == 'imgwctff') {
                            $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                        }

                    }
                    
                });


                if ( this_widget_img_content['imgSize']  == 'custom') {
                    $('.customImageSizeDiv').css('display','block');
                }else{
                    $('.customImageSizeDiv').css('display','none');
                }


                if (this_widget_img_content['iborderRadius'] != 'undefined' && this_widget_img_content['iborderRadius'] != null) {
                  iborderRadius = this_widget_img_content['iborderRadius'];
                  $('.iwbrt').val(iborderRadius['iwbrt'] );
                  $('.iwbrb').val(iborderRadius['iwbrb'] );
                  $('.iwbrl').val(iborderRadius['iwbrl'] );
                  $('.iwbrr').val(iborderRadius['iwbrr'] );
                }else{
                  $('.iwbrt').val( '' );
                  $('.iwbrb').val( '' );
                  $('.iwbrl').val( '' );
                  $('.iwbrr').val( '' );
                }
                if (this_widget_img_content['iborderWidth'] != 'undefined' && this_widget_img_content['iborderWidth'] != null) {
                  iborderWidth = this_widget_img_content['iborderWidth'];
                  $('.iwbwt').val(iborderWidth['iwbwt'] );
                  $('.iwbwb').val(iborderWidth['iwbwb'] );
                  $('.iwbwl').val(iborderWidth['iwbwl'] );
                  $('.iwbwr').val(iborderWidth['iwbwr'] );
                }else{
                  $('.iwbwt').val( '' );
                  $('.iwbwb').val( '' );
                  $('.iwbwl').val( '' );
                  $('.iwbwr').val( '' );
                }

                
                $('.wdt-img').css('display','block');
            break;
            case 'wigt-menu':
                // Menu Widget
                var this_widget_menu_content = this.model.get('widgetMenu');
                var menuName = this_widget_menu_content['menuName'];
                var menuStyle = this_widget_menu_content['menuStyle'];
                var menuColor = this_widget_menu_content['menuColor'];

                if (typeof(this_widget_menu_content['pbMenuFontFamily']) != 'undefined') {
                    pbMenuFontFamily = this_widget_menu_content['pbMenuFontFamily'];
                } else{
                    pbMenuFontFamily = ' none';
                }

                if (typeof(this_widget_menu_content['pbMenuFontHoverColor']) != 'undefined') {
                    pbMenuFontHoverColor = this_widget_menu_content['pbMenuFontHoverColor'];
                } else{
                    pbMenuFontHoverColor = '';
                }
                if (typeof(this_widget_menu_content['pbMenuFontHoverBgColor']) != 'undefined') {
                    pbMenuFontHoverBgColor = this_widget_menu_content['pbMenuFontHoverBgColor'];
                } else{
                    pbMenuFontHoverBgColor = '';
                }
                if (typeof(this_widget_menu_content['pbMenuFontSize']) != 'undefined') {
                    pbMenuFontSize = this_widget_menu_content['pbMenuFontSize'];
                } else{
                    pbMenuFontSize = '';
                }

                $('#ftr-menu-select').val(menuName);
                $('input[value='+menuStyle+']').attr('checked','checked');
                $('#ftr-menu-color').val(menuColor);
                $('.pbMenuFontFamily').val(pbMenuFontFamily);
                $('.pbMenuFontHoverColor').val(pbMenuFontHoverColor);
                $('.pbMenuFontHoverBgColor').val(pbMenuFontHoverBgColor);
                $('.pbMenuFontSize').val(pbMenuFontSize);

                $('.pbMenuFontFamily').trigger('setFont',[ $('.pbMenuFontFamily').val().replace(/\+/g, ' ') ]);
                $("#ftr-menu-color").spectrum( 'set', $('#ftr-menu-color').val() );

                $(".pbMenuFontHoverColor").spectrum( 'set', $('.pbMenuFontHoverColor').val() );
                $(".pbMenuFontHoverBgColor").spectrum( 'set', $('.pbMenuFontHoverBgColor').val() );

              
              $('.wdt-menu').css('display','block');
            break;
            case 'wigt-btn-gen':

                $('.wdt-btn-gen').css('display','block');

                document.getElementById("widgetButtonOpsForm").reset();
                
                var this_widget_btn = this.model.get('widgetButton');

                if (typeof(this_widget_btn['btnClickAction']) == 'undefined') {
                    this_widget_btn['btnClickAction'] = 'openLink';
                }

                $('.btnLinkOpsContainer').css('display','none');
                $('.openPopUpOpsContainer').css('display','none');
                $('.btnWooCommOpsContainer').css('display','none');

                if ( this_widget_btn['btnClickAction'] == 'openPopUp' ) {
                    $('.openPopUpOpsContainer').css('display','block');
                }else if ( this_widget_btn['btnClickAction'] == 'addToCart' ) {
                    $('.btnWooCommOpsContainer').css('display','block');
                } else if ( this_widget_btn['btnClickAction'] == 'addToCheckout' ) {
                    $('.btnWooCommOpsContainer').css('display','block');
                }else{
                    $('.btnLinkOpsContainer').css('display','block');
                }


                $.each(this_widget_btn,function(index, val){

                    if (val != '') {

                        $('.'+index).val(val);

                        if (index == 'btnTextColor') {
                            $('.btnColor').spectrum( 'set', val );
                        }
                        if (index == 'btnBgColor') {
                            $('.btnBgColor').spectrum( 'set', val );
                        }
                        if (index == 'btnHoverBgColor') {
                            $('.btnHoverBgColor').spectrum( 'set', val );
                        }
                        if (index == 'btnHoverTextColor') {
                            $('.btnHoverTextColor').spectrum( 'set', val );
                        }
                        if (index == 'btnColor') {
                            $('.btnColor').spectrum( 'set', val );
                        }
                        if (index == 'btnBorderColor') {
                            $('.btnBorderColor').spectrum( 'set', val );
                        }

                        if (index == 'btnButtonFontFamily') {
                            if (typeof(val) == 'undefined') { val = ' '; }
                            if (val !== '') {
                                $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                            }
                        }

                        if (index == 'btnSelectedIcon') {
                          $('.btnSelectedIconpbicp-auto').val(val);
                          $('.btnSelectedIcon').children().attr('class',val);
                        }
                        
                    }


                });

              
                
            break;
            case 'wigt-pb-form':
                // Subscribe Form Widget
                var this_widget_subscribeForm = this.model.get('widgetSubscribeForm');
                var formLayout = this_widget_subscribeForm['formLayout'];
                var showNameField = this_widget_subscribeForm['showNameField'];
                var successAction = this_widget_subscribeForm['successAction'];
                var successURL = this_widget_subscribeForm['successURL'];
                var successMessage = this_widget_subscribeForm['successMessage'];

                var formBtnText = this_widget_subscribeForm['formBtnText'];
                var formBtnHeight = this_widget_subscribeForm['formBtnHeight'];
                var formBtnWidth = this_widget_subscribeForm['formBtnWidth'];
                var formBtnBgColor = this_widget_subscribeForm['formBtnBgColor'];
                var formBtnColor = this_widget_subscribeForm['formBtnColor'];
                var formBtnHoverBgColor = this_widget_subscribeForm['formBtnHoverBgColor'];
                var formBtnFontSize = this_widget_subscribeForm['formBtnFontSize'];
                var formBtnBorderWidth = this_widget_subscribeForm['formBtnBorderWidth'];
                var formBtnBorderColor = this_widget_subscribeForm['formBtnBorderColor'];
                var formBtnBorderRadius = this_widget_subscribeForm['formBtnBorderRadius'];

                if (this_widget_subscribeForm['formDataSaveType'] != 'undefined') {
                    var formDataSaveType = this_widget_subscribeForm['formDataSaveType'];
                }
                if (this_widget_subscribeForm['formBtnHeightTablet'] != 'undefined') {
                    $('.formBtnHeightTablet').val(this_widget_subscribeForm['formBtnHeightTablet']);
                    $('.formBtnHeightMobile').val(this_widget_subscribeForm['formBtnHeightMobile']);
                    $('.formBtnFontSizeTablet').val(this_widget_subscribeForm['formBtnFontSizeTablet']);
                    $('.formBtnFontSizeMobile').val(this_widget_subscribeForm['formBtnFontSizeMobile']);
                }else{
                    $('.formBtnHeightTablet').val('');
                    $('.formBtnHeightMobile').val('');
                    $('.formBtnFontSizeTablet').val('');
                    $('.formBtnFontSizeMobile').val('');
                }
                formBtnFontFamily = 'select';
                if (typeof(this_widget_subscribeForm['formBtnFontFamily']) != 'undefined') {
                    var formBtnFontFamily = this_widget_subscribeForm['formBtnFontFamily'];
                }

                formSuccessMessageColor = '#333';
                if (typeof(this_widget_subscribeForm['formSuccessMessageColor']) != 'undefined') {
                    var formSuccessMessageColor = this_widget_subscribeForm['formSuccessMessageColor'];
                }
                formBtnHoverTextColor = '';
                if (typeof(this_widget_subscribeForm['formBtnHoverTextColor']) != 'undefined') {
                    var formBtnHoverTextColor = this_widget_subscribeForm['formBtnHoverTextColor'];
                }

                if (this_widget_subscribeForm['formbtnSelectedIcon'] != 'undefined') {
                  $('.formbtnIconPosition').val(this_widget_subscribeForm['formbtnIconPosition']);
                  $('.formbtnIconGap').val(this_widget_subscribeForm['formbtnIconGap']);
                  $('.formbtnIconAnimation').val(this_widget_subscribeForm['formbtnIconAnimation']);

                  $('.formbtnSelectedIconpbicp-auto').val(this_widget_subscribeForm['formbtnSelectedIcon']);
                  $('.formbtnSelectedIcon').children().attr('class',this_widget_subscribeForm['formbtnSelectedIcon']);
                }else{
                  $('.formbtnSelectedIcon').val('');
                  $('.formbtnIconPosition').val('');
                  $('.formbtnIconGap').val('');
                  $('.formbtnIconAnimation').val('');
                  $('.formbtnSelectedIcon').children().attr('class','');
                }

                var formAccountName = $('.mailchimpListIdHolder').val();
                var formApiKey = $('.mailchimpApiKeyHolder').val();

                formDataMailChimpApi = $('.mailchimpApiKeyHolder').val();
                formDataMailChimpListId = $('.mailchimpListIdHolder').val();
                if (typeof(this_widget_subscribeForm['formDataMailChimpApi']) != 'undefined') {
                    var formDataMailChimpApi = this_widget_subscribeForm['formDataMailChimpApi'];
                    var formDataMailChimpListId = this_widget_subscribeForm['formDataMailChimpListId'];
                }

                if (typeof(this_widget_subscribeForm['isMcActive']) != 'undefined') {
                  $('.isMcActive').val(this_widget_subscribeForm['isMcActive']);
                }

                var formIntegrations = '';
                if (typeof(this_widget_subscribeForm['formIntegrations']) != 'undefined' ) {
                  formIntegrations = this_widget_subscribeForm['formIntegrations'];
                  $.each(formIntegrations['getResponse'], function(index,val){
                    $('.'+index).val(val);
                  });
                  $.each(formIntegrations['campaignMonitor'], function(index,val){
                    $('.'+index).val(val);
                  });

                  $.each(formIntegrations['activeCampaign'], function(index,val){
                    $('.'+index).val(val);
                  });

                  if (typeof(formIntegrations['drip']) != 'undefined') {
                    $.each(formIntegrations['drip'], function(index,val){
                      $('.'+index).val(val);
                    });
                  }

                }


                //  Subs Form
                $('.formLayout').val(formLayout);
                $('.showNameField').val(showNameField);
                $('.successAction').val(successAction);
                $('.successURL').val(successURL);
                $('.successMessage').val(successMessage);
                $('.formBtnText').val(formBtnText);
                $('.formBtnHeight').val(formBtnHeight);
                $('.formBtnWidth').val(formBtnWidth);
                $('.formBtnBgColor').val(formBtnBgColor);
                $('.formBtnHoverTextColor').val(formBtnHoverTextColor);
                $('.formBtnColor').val(formBtnColor);
                $('.formBtnHoverBgColor').val(formBtnHoverBgColor);
                $('.formBtnFontSize').val(formBtnFontSize);
                $('.formBtnBorderWidth').val(formBtnBorderWidth);
                $('.formBtnBorderColor').val(formBtnBorderColor);
                $('.formBtnBorderRadius').val(formBtnBorderRadius); 
                $('.formBtnFontFamily').val(formBtnFontFamily);
                $('.formSuccessMessageColor').val(formSuccessMessageColor);
                $('.formDataSaveType').val(formDataSaveType);
                $('.formDataMailChimpListId').val(formDataMailChimpListId);
                $('.formDataMailChimpApi').val(formDataMailChimpApi);   

                $('.formBtnFontFamily').trigger('setFont',[ $('.formBtnFontFamily').val().replace(/\+/g, ' ') ]); 
                
                $('.formBtnBgColor').spectrum( 'set', $('.formBtnBgColor').val() );
                $('.formBtnColor').spectrum( 'set', $('.formBtnColor').val() );
                $('.formBtnHoverBgColor').spectrum( 'set', $('.formBtnHoverBgColor').val() );
                $('.formBtnBorderColor').spectrum( 'set', $('.formBtnBorderColor').val() );

                $('.formSuccessMessageColor').spectrum( 'set', $('.formSuccessMessageColor').val() );

              
                $('.wdt-pb-form').css('display','block');
            break;
            case 'wigt-video':

                //Video Widget
                var this_widget_video = this.model.get('widgetVideo');
                var videoWebM = this_widget_video['videoWebM'];
                var videoMpfour = this_widget_video['videoMpfour'];
                var videoThumb = this_widget_video['videoThumb'];
                var vidAutoPlay = this_widget_video['vidAutoPlay'];
                var vidLoop = this_widget_video['vidLoop'];
                var vidControls = this_widget_video['vidControls'];

                //video
                $('.videoMpfour').val(videoMpfour);
                $('.videoWebM').val(videoWebM);
                $('.videoThumb').val(videoThumb);
                $('.vidAutoPlay').val(vidAutoPlay);
                $('.vidLoop').val(vidLoop); 
                $('.vidControls').val(vidControls);  

              
              $('.wdt-video').css('display','block');
            break;
            case 'wigt-pb-postSlider':

                //post slider
                var this_widget_pbPS = this.model.get('widgetPBPostsSlider');
                psAutoplay = this_widget_pbPS['psAutoplay'];
                psSlideDelay = this_widget_pbPS['psSlideDelay'];
                psSlideLoop = this_widget_pbPS['psSlideLoop'];
                psSlideTransition = this_widget_pbPS['psSlideTransition'];
                psPostsNumber = this_widget_pbPS['psPostsNumber'];
                psDots = this_widget_pbPS['psDots'];
                psArrows = this_widget_pbPS['psArrows'];
                psFtrImage = this_widget_pbPS['psFtrImage'];
                psFtrImageSize = this_widget_pbPS['psFtrImageSize'];
                psExcerpt = this_widget_pbPS['psExcerpt'];
                psReadMore = this_widget_pbPS['psReadMore'];
                psMoreLinkText = this_widget_pbPS['psMoreLinkText'];
                psHeadingSize = this_widget_pbPS['psHeadingSize'];
                psTextAlignment = this_widget_pbPS['psTextAlignment'];
                psBgColor = this_widget_pbPS['psBgColor'];
                psTxtColor = this_widget_pbPS['psTxtColor'];
                psHeadingTxtColor = this_widget_pbPS['psHeadingTxtColor'];
                psPostType = this_widget_pbPS['psPostType'];
                psPostsOrderBy = this_widget_pbPS['psPostsOrderBy'];
                psPostsOrder = this_widget_pbPS['psPostsOrder'];
                psPostsFilterBy = this_widget_pbPS['psPostsFilterBy'];
                psFilterValue = this_widget_pbPS['psFilterValue'];

                // Widget Posts Slider
                $('.psAutoplay').val(psAutoplay);
                $('.psSlideDelay').val(psSlideDelay);
                $('.psSlideLoop').val(psSlideLoop);
                $('.psSlideTransition').val(psSlideTransition);
                $('.psPostsNumber').val(psPostsNumber);
                $('.psDots').val(psDots);
                $('.psArrows').val(psArrows);
                $('.psFtrImage').val(psFtrImage);
                $('.psFtrImageSize').val(psFtrImageSize);
                $('.psExcerpt').val(psExcerpt);
                $('.psReadMore').val(psReadMore);
                $('.psMoreLinkText').val(psMoreLinkText);
                $('.psHeadingSize').val(psHeadingSize);
                $('.psTextAlignment').val(psTextAlignment);
                $('.psBgColor').val(psBgColor);
                $('.psTxtColor').val(psTxtColor);
                $('.psHeadingTxtColor').val(psHeadingTxtColor);
                $('.psPostType').val(psPostType);
                $('.psPostsOrderBy').val(psPostsOrderBy);
                $('.psPostsOrder').val(psPostsOrder);
                $('.psPostsFilterBy').val(psPostsFilterBy);
                $('.psFilterValue').val(psFilterValue);

                $('.psBgColor').spectrum( 'set', $('.psBgColor').val() );
                $('.psTxtColor').spectrum( 'set', $('.psTxtColor').val() );
                $('.psHeadingTxtColor').spectrum( 'set', $('.psHeadingTxtColor').val() );

              
              $('.wdt-pbPostSlider').css('display','block');
            break;
            case 'wigt-pb-icons':

                $('.wdt-icons').css('display','block');

                // Icons Widget
                var this_widget_pbIcon = this.model.get('widgetIcons');
                
                pbSelectedIcon = this_widget_pbIcon['pbSelectedIcon'];
                $('.pbicp-auto').val(pbSelectedIcon);
                $('.pbSelectedIcon').children().attr('class',pbSelectedIcon);
                
                if (typeof(this_widget_pbIcon['pbIcStyle']) != 'undefined') {
                    if ( this_widget_pbIcon['pbIcStyle'] == 'solid') {
                        $('.iconStyleOps').css('display','block');
                    }else{
                        $('.iconStyleOps').css('display','none');
                    }
                }else{
                    this_widget_pbIcon['pbIcStyle'] = 'none';
                    $('.iconStyleOps').css('display','none');
                    $('.pbIcStyle').val('none');
                    $('.pbIcBgC').val('');
                    $('.pbIcBC').val('');
                    $('.pbIcBW').val('');
                    $('.pbIcBR').val('');
                    $('.pbIcSHP').val('');
                    $('.pbIcSVP').val('');
                    $('.pbIcSDB').val('');
                    $('.pbIcSC').val('');
                }

                $.each(this_widget_pbIcon, function(index,val){
                    
                    if ( index == 'pbIconColor' || index == 'pbIcBgC' || index == 'pbIcBC' || index == 'pbIcSC' || index == 'pbIcHC' || index == 'pbIcHBgC' ) {
                        $('.'+index).spectrum( 'set', val );
                    }

                    $('.'+index).val(val);
                    
                });

                
            
                $('.pbIcBC').spectrum( 'set', $('.pbIcBC').val() );

              
            break;
            case 'wigt-pb-counter': 

                // Counter Widget
                var this_widget_pbCounter = this.model.get('widgetCounter');
                counterStartingNumber = this_widget_pbCounter['counterStartingNumber'];
                counterEndingNumber = this_widget_pbCounter['counterEndingNumber'];
                counterNumberPrefix = this_widget_pbCounter['counterNumberPrefix'];
                counterNumberSuffix = this_widget_pbCounter['counterNumberSuffix'];
                counterAnimationTime = this_widget_pbCounter['counterAnimationTime'];
                counterTitle = this_widget_pbCounter['counterTitle'];
                counterTextColor = this_widget_pbCounter['counterTextColor'];
                counterNumberFontSize = this_widget_pbCounter['counterNumberFontSize'];
                counterTitleFontSize = this_widget_pbCounter['counterTitleFontSize'];

                $('.counterStartingNumber').val(counterStartingNumber);
                $('.counterEndingNumber').val(counterEndingNumber);
                $('.counterNumberPrefix').val(counterNumberPrefix);
                $('.counterNumberSuffix').val(counterNumberSuffix);
                $('.counterAnimationTime').val(counterAnimationTime);
                $('.counterTitle').val(counterTitle);
                $('.counterTextColor').val(counterTextColor);
                $('.counterTitleColor').val(counterTitleColor);
                $('.counterNumberFontSize').val(counterNumberFontSize);
                $('.counterTitleFontSize').val(counterTitleFontSize);

                if (pageBuilderApp.premActive == 'false') {
                  $('.premWidgetNotice').css('display','block');
                }
              
              $('.wdt-counter').css('display','block');
            break;
            case 'wigt-pb-audio':

                // Audio Widget
                var this_widget_audio = this.model.get('widgetAudio'); 

                $('.audioOgg').val(this_widget_audio['audioOgg']);
                $('.audioMpThree').val(this_widget_audio['audioMpThree']);
                $('.audioAutoPlay').val(this_widget_audio['audioAutoPlay']);
                $('.audioLoop').val(this_widget_audio['audioLoop']);
                $('.audioControls').val(this_widget_audio['audioControls']);

              
              $('.wdt-audio').css('display','block');
            break;
            case 'wigt-pb-cards': 

                // Card Widget 
                var this_widget_card = this.model.get('widgetCard');
                    
                $.each(this_widget_card, function(index,val){
                    
                    if (index == 'pbSelectedCardIcon') {
                        $('.pbSelectedCardIcon').children().attr('class',val);
                        $('.pbSelectedCardIconValue').val(val);
                    }

                    if (index == 'pbCardIconColor') {
                        $('.'+index).spectrum( 'set', val );
                    }
                    if (index == 'pbCardTitleColor') {
                        $('.'+index).spectrum( 'set', val );
                    }
                    if (index == 'pbCardDescColor') {
                        $('.'+index).spectrum( 'set', val );
                    }

                    $('.'+index).val(val);

                });

                if (pageBuilderApp.premActive == 'false') {
                  $('.premWidgetNotice').css('display','block');
                }
              
              $('.wdt-card').css('display','block');
            break;
            case 'wigt-pb-testimonial': 

                // Testimonial widget
                var this_widget_testimonial = this.model.get('widgetTestimonial');

                $('.tsAuthorName').val(this_widget_testimonial['tsAuthorName']);
                $('.tsJob').val(this_widget_testimonial['tsJob']);
                $('.tsCompanyName').val(this_widget_testimonial['tsCompanyName']);
                $('.tsTestimonial').val(this_widget_testimonial['tsTestimonial']);
                $('.tsUserImg').val(this_widget_testimonial['tsUserImg']);
                $('.tsImageShape').val(this_widget_testimonial['tsImageShape']);
                $('.tsIconColor').val(this_widget_testimonial['tsIconColor']);
                $('.tsIconSize').val(this_widget_testimonial['tsIconSize']);
                $('.tsTextColor').val(this_widget_testimonial['tsTextColor']);
                $('.tsTextSize').val(this_widget_testimonial['tsTextSize']);
                $('.tsTestimonialColor').val(this_widget_testimonial['tsTestimonialColor']);
                $('.tsTestimonialSize').val(this_widget_testimonial['tsTestimonialSize']);
                $('.tsTextAlignment').val(this_widget_testimonial['tsTextAlignment']);

                $('.tsIa').val(this_widget_testimonial['tsIa']);
                $('.tsIt').val(this_widget_testimonial['tsIt']);

                $('.tsIconColor').spectrum( 'set', this_widget_testimonial['tsIconColor'] );
                $('.tsTextColor').spectrum( 'set', this_widget_testimonial['tsTextColor'] );
                $('.tsTestimonialColor').spectrum( 'set', this_widget_testimonial['tsTestimonialColor'] );

                if (pageBuilderApp.premActive == 'false') {
                  $('.premWidgetNotice').css('display','block');
                }
              
              $('.wdt-testimonial').css('display','block');
            break;
            case 'wigt-pb-shortcode':
                // Shortcode Widget
                var this_widget_shortcode = this.model.get('widgetShortCode');

                $('.shortCodeInput').val(this_widget_shortcode['shortCodeInput']);

              $('.wdt-shortcode').css('display','block');
            break;
            case 'wigt-pb-countdown':

                // Countdown Widget
                var this_widget_countdown = this.model.get('widgetCowntdown');

                $('.daysText').val('');
                $('.hoursText').val('');
                $('.minutesText').val('');
                $('.secondsText').val('');
                $('.hideDays').val('');
                $('.hideHours').val('');
                $('.hideMinutes').val('');
                $('.hideSeconds').val('');
                $('.pbcdnbw').val('');
                $('.pbcdnbc').val('');
                $('.pbcdnbs').val('');

                $.each(this_widget_countdown, function(index,val){
                  $('.'+index).val(val);

                  if (index == 'pbCountDownColor' || index == 'pbCountDownLabelColor' || index == 'pbCountDownNumberBgColor' || index == 'pbcdnbc') {
                    $('.'+index).spectrum( 'set', val );
                    $('.'+index).val(val);
                  }

                  if (index == 'pbCountDownLabelFontFamily' || index == 'pbCountDownNumberFontFamily'){
                      if (val !== '') {
                        $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                      }
                    }
                  
                });

                pbCountDownType = this_widget_countdown['pbCountDownType'];
                if (pbCountDownType == 'evergreen') {
                    jQuery('#fixedCountdown').css('display','none');
                    jQuery('#evergreenCountdown').css('display','block');
                }else{
                    jQuery('#evergreenCountdown').css('display','none');
                    jQuery('#fixedCountdown').css('display','block');
                }

                if (pageBuilderApp.premActive == 'false') {
                  $('.premWidgetNotice').css('display','block');
                }
              
              $('.wdt-countdown').css('display','block');
            break;
            case 'wigt-pb-imageSlider':

                $('.wdt-imageSlider').css('display','block');
                // Image Slider Widget
                var this_widget_image_slider = this.model.get('widgetImageSlider');
                // Image Slider Widget
                $('.pbSliderHeight').val(this_widget_image_slider['pbSliderHeight']);
                $('.pbSliderHeightUnit').val(this_widget_image_slider['pbSliderHeightUnit']);
                $('.pbSliderContentBgColor').val(this_widget_image_slider['pbSliderContentBgColor']);
                $('.pbSliderContentBgColor').spectrum( 'set', this_widget_image_slider['pbSliderContentBgColor'] );
                $('.pbSliderAuto').val(this_widget_image_slider['pbSliderAuto']);
                $('.pbSliderDelay').val(this_widget_image_slider['pbSliderDelay']);
                $('.pbSliderPager').val(this_widget_image_slider['pbSliderPager']);
                $('.pbSliderPager').val(this_widget_image_slider['pbSliderPager']);
                $('.pbSliderRandom').val(this_widget_image_slider['pbSliderRandom']);
                $('.pbSliderPause').val(this_widget_image_slider['pbSliderPause']);

                $('.slideContentWidth').val(this_widget_image_slider['slideContentWidth']);
                $('.slideContentWidthT').val(this_widget_image_slider['slideContentWidthT']);
                $('.slideContentWidthM').val(this_widget_image_slider['slideContentWidthM']);
                $('.slideContentWUnit').val(this_widget_image_slider['slideContentWUnit']);
                $('.slideContentWUnitT').val(this_widget_image_slider['slideContentWUnitT']);
                $('.slideContentWUnitM').val(this_widget_image_slider['slideContentWUnitM']);
                $('.slideContentAlignH').val(this_widget_image_slider['slideContentAlignH']);
                $('.slideContentAlignHT').val(this_widget_image_slider['slideContentAlignHT']);
                $('.slideContentAlignHM').val(this_widget_image_slider['slideContentAlignHM']);
                $('.slideContentAlignV').val(this_widget_image_slider['slideContentAlignV']);
                $('.slideContentAlignVT').val(this_widget_image_slider['slideContentAlignVT']);
                $('.slideContentAlignVM').val(this_widget_image_slider['slideContentAlignVM']);
                $('.slideContentAlign').val(this_widget_image_slider['slideContentAlign']);
                $('.slideContentAlignT').val(this_widget_image_slider['slideContentAlignT']);
                $('.slideContentAlignM').val(this_widget_image_slider['slideContentAlignM']);
                

                if ( typeof(this_widget_image_slider['pbSliderHeightTablet']) != 'undefined' ) {
                  $('.pbSliderHeightTablet').val(this_widget_image_slider['pbSliderHeightTablet']);
                  $('.pbSliderHeightMobile').val(this_widget_image_slider['pbSliderHeightMobile']);

                  $('.pbSliderHeightUnitTablet').val(this_widget_image_slider['pbSliderHeightUnitTablet']);
                  $('.pbSliderHeightUnitMobile').val(this_widget_image_slider['pbSliderHeightUnitMobile']);
                }else{
                  $('.pbSliderHeightTablet').val('');
                  $('.pbSliderHeightMobile').val('');
                  $('.pbSliderHeightUnitTablet').val('');
                  $('.pbSliderHeightUnitMobile').val('');
                }

                pbSliderImagesURL = this_widget_image_slider['pbSliderImagesURL'];
                pbSliderContent = this_widget_image_slider['pbSliderContent'];

                if (typeof(pbSliderContent[0]['imageSlideUrl']) != 'undefined' ) {
                    pbSliderImagesURL = pbSliderContent;
                }
                
                renderImageSliderItemsList(pbSliderImagesURL,pbSliderContent);

                if (typeof(this_widget_image_slider['slideHeadingStyles']) != 'undefined' ) {
                    slideHeadingStyles = this_widget_image_slider['slideHeadingStyles'];
                    $.each(slideHeadingStyles,function(index, val){
                        $('.'+index).val(val);
                        
                        if (index == 'slideHeadingColor') {
                          $('.slideHeadingColor').spectrum( 'set', val );
                        }
                        if (index == 'slideHeadingBold' || index == 'slideHeadingItalic' || index == 'slideHeadingUnderlined') {
                            if(val == true){
                                if( $('.'+index).is(':checked') ){
                                }else{
                                    $('.'+index).trigger('click');
                                    $('.'+index).attr('checked', 'checked');
                                }
                            }else{
                                if( $('.'+index).is(':checked') ){
                                    $('.'+index).trigger('click');
                                }
                            }
                        }

                        if (index == 'slideHeadingFontFamily') {
                            $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                        }
                        
                     });
                }

                slideDescStyles = this_widget_image_slider['slideDescStyles'];
                $.each(slideDescStyles,function(index, val){
                    $('.'+index).val(val);
                    if (index == 'slideDescColor') {
                      $('.slideDescColor').spectrum( 'set', val );
                    }

                    if (index == 'slideDescBold' || index == 'slideDescItalic' || index == 'slideDescUnderlined') {
                        if(val == true){
                            if( $('.'+index).is(':checked') ){
                            }else{
                                $('.'+index).trigger('click');
                                $('.'+index).attr('checked', 'checked');
                            }
                        }else{
                            if( $('.'+index).is(':checked') ){
                                $('.'+index).trigger('click');
                            }
                        }
                    }

                    if (index == 'slideDescFontFamily') {
                        $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                    }
                 });

                slideButtonStyles = this_widget_image_slider['slideButtonStyles'];
                $.each(slideButtonStyles,function(index, val){
                    $('.'+index).val(val);
                    
                    if (index == 'slideButtonBtnBgColor') {
                      $('.slideButtonBtnBgColor').spectrum( 'set', val );
                    }
                    if (index == 'slideButtonBtnHoverBgColor') {
                      $('.slideButtonBtnHoverBgColor').spectrum( 'set', val );
                    }
                    if (index == 'slideButtonBtnHoverTextColor') {
                      $('.slideButtonBtnHoverTextColor').spectrum( 'set', val );
                    }
                    if (index == 'slideButtonBtnColor') {
                      $('.slideButtonBtnColor').spectrum( 'set', val );
                    }
                    if (index == 'slideButtonBtnBorderColor') {
                      $('.slideButtonBtnBorderColor').spectrum( 'set', val );
                    }

                    if (index == 'slideButtonBtnFontFamily') {
                        $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                    }
                 });

                if (pageBuilderApp.premActive == 'false') {
                  $('.premWidgetNotice').css('display','block');
                }
              
                
            break;
            case 'wigt-pb-progressBar':

                var this_widget_progressBar = this.model.get('widgetProgressBar');
                $.each(this_widget_progressBar, function(index,val){
                    if (index == 'pbProgressBarTitleColor') {
                      $('.pbProgressBarTitleColor').spectrum( 'set', val );
                    }
                    if (index == 'pbProgressBarTextColor') {
                      $('.pbProgressBarTextColor').spectrum( 'set', val );
                    }
                    if (index == 'pbProgressBarColor') {
                      $('.pbProgressBarColor').spectrum( 'set', val );
                    }
                    if (index == 'pbProgressBarBgColor') {
                      $('.pbProgressBarBgColor').spectrum( 'set', val );
                    }

                    $('.'+index).val(val);
                });

                if (typeof(this_widget_progressBar['pbProgressBarTextFontFamily']) != 'undefined') {
                    pbProgressBarTextFontFamily = this_widget_progressBar['pbProgressBarTextFontFamily'];
                } else{
                    pbProgressBarTextFontFamily = ' none';
                }

                $('.pbProgressBarTextFontFamily').trigger('setFont',[ $('.pbProgressBarTextFontFamily').val().replace(/\+/g, ' ') ]);

                if (pageBuilderApp.premActive == 'false') {
                  $('.premWidgetNotice').css('display','block');
                }
              
              $('.wdt-progressBar').css('display','block');
            break;
            case 'wigt-pb-pricing':

                // Pricing Widget
                var this_widget_pricing = this.model.get('widgetPricing');
                pbPricingContent = this_widget_pricing['pbPricingContent'];

                if (pbPricingContent == '') {
                    pbPricingContent = ' ';
                }


                $.each(this_widget_pricing, function(index,val){
                    
                    if (index == 'pricingbtnTextColor') {
                        $('.'+index).spectrum( 'set', val );
                    }
                    if (index == 'pricingbtnBgColor') {
                        $('.'+index).spectrum( 'set', val );
                    }
                    if (index == 'pricingbtnHoverBgColor') {
                        $('.'+index).spectrum( 'set', val );
                    }
                    if (index == 'pricingbtnHoverTextColor') {
                        $('.'+index).spectrum( 'set', val );
                    }
                    if (index == 'pricingbtnBorderColor') {
                        $('.'+index).spectrum( 'set', val );
                    }

                    if (index == 'pbPricingHeaderTextColor') {
                        $('.'+index).spectrum( 'set', val );
                    }

                    if (index == 'pbPricingHeaderBgColor') {
                        $('.'+index).spectrum( 'set', val );
                    }

                    if (index == 'pbPricingBorderColor') {
                        $('.'+index).spectrum( 'set', val );
                    }

                    if (index == 'pbPricingButtonSectionBgColor') {
                        $('.'+index).spectrum( 'set', val );
                    }

                    if (index == 'pricingbtnButtonFontFamily') {
                        if (typeof(val) != 'undefined') {
                            if (val != '') {
                                $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                            }
                        }
                            
                    }
                    if (index == 'pricingbtnSelectedIcon') {
                      $('.pricingbtnSelectedIconpbicp-auto').val(val);
                      $('.pricingbtnSelectedIcon').children().attr('class',val);
                    }

                    $('.'+index).val(val);

                });


                editorId = 'pbPricingContent';
                $('#'+editorId).val(pbPricingContent);

                if (typeof(tinymce) != 'undefined') {

                    wp.editor.remove(editorId);
                    wp.editor.initialize( editorId,  { tinymce : pageBuilderApp.tinymce, quicktags: true, mediaButtons: true },  );

                    tinymce.editors[editorId].on('change', function (ed, e) {
                      pageBuilderApp.changedOpType = 'specific';
                      pageBuilderApp.changedOpName =  editorId;
                      var that = jQuery('.closeWidgetPopup').attr('data-CurrWidget');
                      
                      jQuery('div[data-saveCurrWidget="'+that+'"]').trigger('click');

                      ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
                      currentEditableColId = jQuery('.currentEditableColId').val();
                      jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

                    });
                }
                    

                var wlteditorID = 'pbPricingContent';
                if ($('#wp-'+wlteditorID+'-wrap').hasClass("tmce-active"))
                    tinyMCE.get(wlteditorID).setContent(pbPricingContent);
                else
                  $('#'+wlteditorID).val(pbPricingContent);



                if (pageBuilderApp.premActive == 'false') {
                  $('.premWidgetNotice').css('display','block');
                }
              
              $('.wdt-pricing').css('display','block');
            break;
            case 'wigt-pb-imgCarousel':

                var this_widget_image_carousel = this.model.get('widgetImgCarousel');

                if (typeof(this_widget_image_carousel['pbImgCarouselSlides']) == 'undefined') {
                    this_widget_image_carousel['pbImgCarouselSlides'] = '4'; 
                }

                $('.pbImgCarouselSlides').val(this_widget_image_carousel['pbImgCarouselSlides']);
                $('.pbImgCarouselAutoplay').val(this_widget_image_carousel['pbImgCarouselAutoplay']);
                $('.pbImgCarouselDelay').val(this_widget_image_carousel['pbImgCarouselDelay']);
                $('.imgCarouselSlideLoop').val(this_widget_image_carousel['imgCarouselSlideLoop']);
                $('.imgCarouselSlideTransition').val(this_widget_image_carousel['imgCarouselSlideTransition']);
                $('.imgCarouselPagination').val(this_widget_image_carousel['imgCarouselPagination']);
                $('.pbImgCarouselNav').val(this_widget_image_carousel['pbImgCarouselNav']);

                imgCarouselSlidesURL = this_widget_image_carousel['imgCarouselSlidesURL'];
                if (typeof(this_widget_image_carousel['imgCarouselSlidesLink']) == 'undefined') {
                    this_widget_image_carousel['imgCarouselSlidesLink'] = [];
                }
                imgCarouselSlidesLink = this_widget_image_carousel['imgCarouselSlidesLink'];

                $('.carouselSlidesContainer').html('');
                $.each(imgCarouselSlidesURL,function(index, val){
                    
                    var slideCountA = index + 180;

                    if (typeof(imgCarouselSlidesLink[index]) == 'undefined') {
                        imgCarouselSlidesLink[index] = '';
                    }

                    jQuery('.carouselSlidesContainer').append(

                        '<li>'+
                            '<h3 class="handleHeader">Slide <span class="dashicons dashicons-trash slideRemoveButton" style="float: right;"></span></h3>'+
                            '<div  class="accordContentHolder">'+
                                '<label>Slide Image :</label>'+
                                '<input id="image_location'+slideCountA+'" type="text" class="carouselImgURL upload_image_button'+slideCountA+'"  name="lpp_add_img_'+slideCountA+'" value="'+val+'"   placeholder="Enter Image URL here" style="width:100%;" />'+
                                '<input id="image_location'+slideCountA+'" type="button" class="upload_bg_btn_imageSlider" data-id="'+slideCountA+'" value="Upload" style="width:100%;"  />'+
                                '<br><br><br><br><br><br><br><hr><br>'+
                                '<label> Slide URL </label>'+
                                '<input type="url" class="carouselImgLink" value="'+imgCarouselSlidesLink[index]+'">'+
                            '</div>'+
                        '</li>'
                    );

                    $( '.carouselSlidesContainer' ).accordion( "refresh" );

                });

                if (pageBuilderApp.premActive == 'false') {
                  $('.premWidgetNotice').css('display','block');
                }
              
                $('.wdt-imgCarousel').css('display','block');
            break;
            case 'wigt-pb-wooCommerceProducts':

                var this_widget_wooPorducts = this.model.get('widgetWooPorducts');

                $.each(this_widget_wooPorducts, function(index,val){
                    $('.'+index).val(val);
                });

                if (pageBuilderApp.premActive == 'false') {
                  $('.premWidgetNotice').css('display','block');
                }
              
              $('.wdt-wooCommerceProducts').css('display','block');
            break;
            case 'wigt-pb-iconList':

                $('.wdt-iconList').css('display','block');

                document.getElementById('iconListWidgetOpsForm').reset();

                var this_widget_icon_list = this.model.get('widgetIconList');

                $('.iconListLineHeight').val(this_widget_icon_list['iconListLineHeight']);
                $('.iconListAlignment').val(this_widget_icon_list['iconListAlignment']);
                $('.iconListIconSize').val(this_widget_icon_list['iconListIconSize']);
                $('.iconListIconColor').val(this_widget_icon_list['iconListIconColor']);
                $('.iconListTextSize').val(this_widget_icon_list['iconListTextSize']);
                $('.iconListTextIndent').val(this_widget_icon_list['iconListTextIndent']);
                $('.iconListTextColor').val(this_widget_icon_list['iconListTextColor']);
                $('.iconListTextFontFamily').val(this_widget_icon_list['iconListTextFontFamily']);


                if (this_widget_icon_list['iconListIconSizeTablet'] != '') {
                    $('.iconListIconSizeTablet').val(this_widget_icon_list['iconListIconSizeTablet']);
                }

                if (this_widget_icon_list['iconListIconSizeMobile'] != '') {
                    $('.iconListIconSizeMobile').val(this_widget_icon_list['iconListIconSizeMobile']);
                }

                console.log(this_widget_icon_list['iconListTextSizeMobile'] );

                if (this_widget_icon_list['iconListTextSizeTablet'] != '') {
                    $('.iconListTextSizeTablet').val(this_widget_icon_list['iconListTextSizeTablet']);
                }

                if (this_widget_icon_list['iconListTextSizeMobile'] != '') {
                    $('.iconListTextSizeMobile').val(this_widget_icon_list['iconListTextSizeMobile']);
                }

                if (this_widget_icon_list['iconListTextIndentTablet'] != '') {
                    $('.iconListTextIndentTablet').val(this_widget_icon_list['iconListTextIndentTablet']);
                }

                if (this_widget_icon_list['iconListTextIndentMobile'] != '') {
                    $('.iconListTextIndentMobile').val(this_widget_icon_list['iconListTextIndentMobile']);
                }


                $('.iconListTextFontFamily').trigger('setFont',[ $('.iconListTextFontFamily').val().replace(/\+/g, ' ') ]);

                iconListComplete = this_widget_icon_list['iconListComplete'];

                renderIconListItemsList(iconListComplete);

                $('.iconListIconColor').spectrum( 'set', $('.iconListIconColor').val() );
                $('.iconListTextColor').spectrum( 'set', $('.iconListTextColor').val() );

              
            break;
            case 'wigt-pb-spacer':

                var this_widget_Spacer = this.model.get('widgetVerticalSpace');

                $.each(this_widget_Spacer, function(index,val){
                    $('.'+index).val(val);
                });

              
              $('.wdt-spacer').css('display','block');
            break;
            case 'wigt-pb-break':

                var this_widget_Breaker = this.model.get('widgetBreaker');

                $.each(this_widget_Breaker, function(index,val){

                    if (index == 'widgetBreakerColor') {
                      $('.widgetBreakerColor').spectrum( 'set', val );
                    }
                    
                    $('.'+index).val(val);
                });

              
              $('.wdt-breaker').css('display','block');
            break;
            case 'wigt-pb-anchor':
                var widgetAnchor = this.model.get('widgetAnchor');
                $.each(widgetAnchor, function(index,val){
                    $('.'+index).val(val);
                });

              
              $('.wdt-anchor').css('display','block');
            break;
            case 'wigt-pb-formBuilder':

                    $('.wdt-formBuilder').css('display','block');

                    document.getElementById('formBuilderWidgetOpsForm').reset();

                    var this_widget_FormBuilder = this.model.get('widgetFormBuilder');

                    widgetPbFbFormFeilds = this_widget_FormBuilder['widgetPbFbFormFeilds'];
                    widgetPbFbFormFeildOptions = this_widget_FormBuilder['widgetPbFbFormFeildOptions'];
                    widgetPbFbFormSubmitOptions = this_widget_FormBuilder['widgetPbFbFormSubmitOptions'];
                    widgetPbFbFormEmailOptions = this_widget_FormBuilder['widgetPbFbFormEmailOptions'];
                    

                    
                    $('.formRequiredFieldMessage').val('Please fill all the required * fields.');


                    formBuilderMCGroupsList = 'false';
                    if (typeof(this_widget_FormBuilder['widgetPbFbFormMailChimp']) == 'undefined') {
                        this_widget_FormBuilder['widgetPbFbFormMailChimp'] = {};
                    }

                    widgetPbFbFormMailChimp = this_widget_FormBuilder['widgetPbFbFormMailChimp'];
                    
                    if (typeof(widgetPbFbFormMailChimp['formBuilderMCGroupsList']) != 'undefined') {
                        if (widgetPbFbFormMailChimp['formBuilderMCGroupsList'] != '') {
                            formBuilderMCGroupsList =  widgetPbFbFormMailChimp['formBuilderMCGroupsList'];
                        }
                    }


                    formBuilderMRGroupsList = 'false';
                    if (typeof(widgetPbFbFormMailChimp['formBuilderMRGroupsList']) != 'undefined') {
                        if (widgetPbFbFormMailChimp['formBuilderMRGroupsList'] != '') {
                            formBuilderMRGroupsList =  widgetPbFbFormMailChimp['formBuilderMRGroupsList'];
                        }
                    }

                    renderFormBuilderFieldsList(widgetPbFbFormFeilds,formBuilderMCGroupsList,formBuilderMRGroupsList);
                    

                    $.each(widgetPbFbFormFeildOptions, function(index,val){

                        if (val != '' && val != ' ') {

                            $('.'+index).val(val);


                            if (index == 'formBuilderLabelColor') {
                              $('.formBuilderLabelColor').spectrum( 'set', val );
                            }
                            if (index == 'formBuilderFieldColor') {
                              $('.formBuilderFieldColor').spectrum( 'set', val );
                            }
                            if (index == 'formBuilderFieldBgColor') {
                              $('.formBuilderFieldBgColor').spectrum( 'set', val );
                            }
                            if (index == 'formBuilderFieldBorderColor') {
                              $('.formBuilderFieldBorderColor').spectrum( 'set', val );
                            }

                            if (index == 'formBuilderFieldFontFamily') {
                                $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                            }
                        }
                            
                    });

                    $('.formBuilderbtnSelectedIcon').children().attr('class','');

                    $.each(widgetPbFbFormSubmitOptions, function(index,val){

                        if (val != '' && val != ' ') {
                            
                            $('.'+index).val(val);

                            if (index == 'formBuilderBtnBgColor') {
                              $('.formBuilderBtnBgColor').spectrum( 'set', val );
                            }
                            if (index == 'formBuilderBtnHoverBgColor') {
                              $('.formBuilderBtnHoverBgColor').spectrum( 'set', val );
                            }
                            if (index == 'formBuilderBtnHoverTextColor') {
                              $('.formBuilderBtnHoverTextColor').spectrum( 'set', val );
                            }
                            if (index == 'formBuilderBtnColor') { 
                              $('.formBuilderBtnColor').spectrum( 'set', val );
                            }
                            if (index == 'formBuilderBtnBorderColor') {
                              $('.formBuilderBtnBorderColor').spectrum( 'set', val );
                            }

                            if (index == 'formBuilderbtnSelectedIcon') {
                              $('.formBuilderbtnSelectedIconpbicp-auto').val(val);
                              $('.formBuilderbtnSelectedIcon').children().attr('class',val);
                            }

                            if (index == 'formBuilderBtnFontFamily') {
                                $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                            }
                        }

                    });

                    $.each(widgetPbFbFormEmailOptions, function(index,val){

                        if (val != '' && val != ' ') {
                            $('.'+index).val(val);
                        }
                        
                        /*
                        if (index == 'formEmailTo') {
                          if (val == '' || val == 'example@example.com' || val == 'test@example.com') {
                            $('.formErrorNotice').css('display','block');
                          }else{
                            $('.formErrorNotice').css('display','none');
                          }
                        }
                        */

                        if (index == 'formSuccessAction') {
                            if (val == 'redirect') {
                                $('.successFormActionCont').css('display','block');
                            }else{
                                $('.successFormActionCont').css('display','none');
                            }
                        }
                    });



                    $.each(widgetPbFbFormMailChimp, function(index,val){

                        if (val != '' && val != ' ') {
                            $('.'+index).val(val);
                        }

                    });


                    if (widgetPbFbFormMailChimp['formBuilderMCAccountName'] != '' && widgetPbFbFormMailChimp['formBuilderMCApiKey'] != '' ) {

                        if ( typeof(widgetPbFbFormMailChimp['formBuilderMCGroups']) != 'undefined' ) {
                            if (widgetPbFbFormMailChimp['formBuilderMCGroups'] != '') {
                                $('.formBuilderMCGroups').val(widgetPbFbFormMailChimp['formBuilderMCGroups']);
                                pageBuilderApp.thisMCSelectedGroup = widgetPbFbFormMailChimp['formBuilderMCGroups'];
                            }
                        }

                        $('#mcGetGrpsBtn').trigger('click');
                    }

                    $('.formBuilderConvertKitAccountName').html( "<option value=''>None</option>");
                    if ( widgetPbFbFormMailChimp['formBuilderConvertKitApiKey'] != '' ) {

                        if ( typeof(widgetPbFbFormMailChimp['formBuilderConvertKitAccountName']) != 'undefined' ) {
                            if (widgetPbFbFormMailChimp['formBuilderConvertKitAccountName'] != '') {
                                $('.formBuilderConvertKitAccountName').val(widgetPbFbFormMailChimp['formBuilderConvertKitAccountName']);
                                pageBuilderApp.thisCkSelectedSeq = widgetPbFbFormMailChimp['formBuilderConvertKitAccountName'];
                            }
                        }

                        $('#ckGetseqsBtn').trigger('click');
                    }

                    if (typeof(this_widget_FormBuilder['widgetPbFbFormAllowDuplicates']) != 'undefined') {
                        if (this_widget_FormBuilder['widgetPbFbFormAllowDuplicates'] != '') {
                            $('.widgetPbFbFormAllowDuplicates').val(this_widget_FormBuilder['widgetPbFbFormAllowDuplicates']);
                        }
                    }

                    if (typeof(this_widget_FormBuilder['formCustomHTML']) != 'undefined') {
                        if (this_widget_FormBuilder['formCustomHTML'] != '') {
                            $('.formCustomHTML').val(this_widget_FormBuilder['formCustomHTML']);
                        }
                    }

                    
                    
            break;
            case 'wigt-pb-text':

                $('.wdt-text').css('display','block');
                
                $('.headlineWidgetOpsContainer').css('display','none');
                $('.headlineTypeDefaultOps').css('display','block');


                $('.widgetTextColorAnimated').spectrum( 'set',  $('.widgetTextColor').val() );
                $('.widgetTextFamilyAnimated').trigger('setFont','select');

                document.getElementById("pbtextwidgetops").reset();

                var this_widget_Text = this.model.get('widgetText');
                $.each(this_widget_Text, function(index,val){

                    if (val != '') {

                        if (index == 'widgetTextContent') {

                          $('.'+index).val(val);

                          editorId = index;
                          $('#'+editorId).val(val);

                          if (typeof(tinymce) !== 'undefined') {
                              wp.editor.remove(editorId);
                              wp.editor.initialize( editorId,  { tinymce : pageBuilderApp.tinymceHeadingWidget, quicktags: true, mediaButtons: false },  );

                              tinymce.editors[editorId].on('change', function (ed, e) {
                                pageBuilderApp.changedOpType = 'specific';
                                pageBuilderApp.changedOpName =  editorId;
                                var that = jQuery('.closeWidgetPopup').attr('data-CurrWidget');
                                
                                jQuery('div[data-saveCurrWidget="'+that+'"]').trigger('click');

                                ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
                                currentEditableColId = jQuery('.currentEditableColId').val();
                                jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

                              });
                          }
                              

                          var wlteditorID = index;
                          if ($('#wp-'+wlteditorID+'-wrap').hasClass("tmce-active")){
                            tinyMCE.get(wlteditorID).setContent(val);
                          }else{
                            $('#'+wlteditorID).val(val);
                          }
                            
                        }

                        if (index == 'widgetTextTag') {
                          if (val == 'a') {
                            $('.linkOpsDiv').css('display','block');
                          }else{
                            $('.linkOpsDiv').css('display','none');
                          }
                        }

                        
                        if(index === 'widgetHeadlineTextType'){

                          $('.headlineWidgetOpsContainer').css('display','none');
                          
                          if(val === "Default"){
                            $('.headlineTypeDefaultOps').css('display','block');
                          }else{
                            $('.headlineTypeSimilarOps').css('display','block');
                          }

                          if(val === "Animated"){
                            $('.headlineTypeAnimatedOps').css('display','block');
                            $('.headlineRotatingTextContainer').css('display','block');
                          }

                          if(val === "Highlighted"){
                            $('.headlineTypeHighlightedOps').css('display','block');
                            $('.headlineHighlightTextContainer').css('display','block');
                          }

                        }

                        

                        if (index == 'widgetTextFamily') {

                            $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                            
                        }

                        if (index == 'widgetTextFamilyAnimated') {

                          $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                          
                      }

                        if (index == 'widgetTextBold' || index == 'widgetTextItalic' || index == 'widgetTextUnderlined') {
                          if(val == true){
                              if( $('.'+index).is(':checked') ){
                              }else{
                                  $('.'+index).trigger('click');
                                  $('.'+index).attr('checked', 'checked');
                              }
                          }else{
                              if( $('.'+index).is(':checked') ){
                                  $('.'+index).trigger('click');
                              }
                          }
                        }

                        if (index == 'widgetTextColor') {
                          $('.widgetTextColor').spectrum( 'set', val );
                          $('.'+index).val(val);
                        }

                        if (index == 'widgetTextColorAnimated') {
                          $('.widgetTextColorAnimated').spectrum( 'set', val );
                          $('.'+index).val(val);
                        }


                        $('.'+index).val(val);

                    }
                        

                });




              
            break;
            case 'wigt-pb-liveText':

                $('.wdt-pb-liveText').css('display','block');

                var thisWidget = this.model.get('wLText');
                var liveTextContent = thisWidget['wltc'];


                editorId = 'wltc';
                $('#'+editorId).val(liveTextContent);


                if (typeof(tinymce) != 'undefined') {
                    wp.editor.remove(editorId);
                    wp.editor.initialize( editorId,  { tinymce : pageBuilderApp.tinymce, quicktags: true, mediaButtons: true },  );

                    tinymce.editors[editorId].on('change', function (ed, e) {
                      pageBuilderApp.changedOpType = 'specific';
                      pageBuilderApp.changedOpName =  editorId;
                      var that = jQuery('.closeWidgetPopup').attr('data-CurrWidget');
                      
                      jQuery('div[data-saveCurrWidget="'+that+'"]').trigger('click');

                      ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
                      currentEditableColId = jQuery('.currentEditableColId').val();
                      jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

                    });
                }
                    

                var wlteditorID = 'wltc';
                if ($('#wp-'+wlteditorID+'-wrap').hasClass("tmce-active"))
                    tinyMCE.get(wlteditorID).setContent(liveTextContent);
                else
                  $('#'+wlteditorID).val(liveTextContent);

              
              
            break;
            case 'wigt-pb-embededVideo':

              var this_widget_widgetEmbedVideo = this.model.get('widgetEmbedVideo');

                $.each(this_widget_widgetEmbedVideo, function(index,val){
                    
                    if (index == 'widgetEvidImageIconColor') {
                      $('.widgetEvidImageIconColor').spectrum( 'set', val );
                    }

                    $('.'+index).val(val);
                });

              
              $('.wdt-embededVideo').css('display','block');
            break;
            case 'wigt-pb-popupClose':

                var this_widget_close_btn = this.model.get('widgetClosePopUp');

                  $.each(this_widget_close_btn, function(index,val){
                      $('.'+index).val(val);


                      if (index == 'closeBtnButtonFontFamily') {
                        $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                      }
                      if (index == 'closeBtnBold' || index == 'closeBtnItalic' || index == 'closeBtnUnderlined') {
                        if (val == true) {
                          if ($('.' + index).is(':checked')) {} else {
                            $('.' + index).trigger('click');
                            $('.' + index).attr('checked', 'checked');
                          }
                        } else {
                          if ($('.' + index).is(':checked')) {
                            $('.' + index).trigger('click');
                          }
                        }
                      }

                      $('.'+index).spectrum( 'set', val );

                  });

                
                $('.wdt-closeBtn').css('display','block');
            break;
            case 'wigt-pb-testimonialCarousel':

                var this_widget_t_carousel = this.model.get('widgetTCarousel');
                var tCarOps = this_widget_t_carousel['tCarOps'];
                var tCarSlides = this_widget_t_carousel['tCarSlides'];
                var tDesignOps = this_widget_t_carousel['tDesignOps'];


                $.each(tCarOps,function(index, val){
                  $('.'+index).val(val);
                });

                $.each(tDesignOps,function(index, val){
                  $('.'+index).val(val);

                  if (index == 'tcic' || index == 'tcntc' || index == 'tcttc') {
                    $('.'+index).spectrum( 'set', val );
                    $('.'+index).val(val);
                  }

                  if (index == 'tcntf' || index == 'tcttf' ) {
                    $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                  }

                });

                $('.testimonialCarSlidesContainer').html('');
                $.each(tCarSlides,function(index, val){
                    
                    if ( typeof(val['tcia']) == 'undefined' ) { val['tcia'] = ''; }
                    if ( typeof(val['tcit']) == 'undefined' ) { val['tcit'] = ''; }
                    

                    var slideCountA = index + 480;

                    jQuery('.testimonialCarSlidesContainer').append('<li><h3 class="handleHeader">Testimonial <span class="dashicons dashicons-trash slideRemoveButton" style="float: right;"></span> </h3> <div  class="accordContentHolder wdt-fields">'+
                      '<label> Name : </label> <input type="text" value="'+val['tcn']+'" class="tcut tcn"> <br><br>'+
                      '<label> Job : </label> <input type="text" value="'+val['tcj']+'" class="tcut tcj"> <br><br>'+
                      '<label> Testimonial : </label> <br> <textarea type="text" class="tcut tct" rows="5" cols="40"> '+val['tct']+' </textarea> <br><br>'+
                      '<label>Testimonial Image :</label> <input id="image_location'+slideCountA+'" type="text" class="tcut tci upload_image_button'+slideCountA+'"  name="lpp_add_img_'+slideCountA+'" value="'+val['tci']+'"  placeholder="Image URL" style="width:40%;" /> <label></label> <input id="image_location'+slideCountA+'" type="button" class="tcut upload_bg_btn_imageSlider" data-id="'+slideCountA+'" value="Upload" /> <br><br><br><br><br>'+
                      '<label> Link : </label> <input type="url" value="'+val['tcl']+'" class="tcut tcl"> <br><br>'+
                      '<input type="hidden" value="'+val['tcia']+'" class="tcut tcia altTextField">       <input type="hidden" value="'+val['tcit']+'" class="tcut tcit titleTextField"> '+
                      '   </div></li>');

                    $( '.testimonialCarSlidesContainer' ).accordion( "refresh" );

                });

                if (pageBuilderApp.premActive == 'false') {
                  $('.premWidgetNotice').css('display','block');
                }

              
                $('.wdt-testimonialSlider').css('display','block');
            break;
            case 'wigt-pb-poOptins':

                var thisWidgetData = this.model.get('widgetPoOptins');
                $('.widgetOptinId').val(thisWidgetData['widgetOptinId']);
                
                $('.wdt-pluginopsOptins').css('display','block');
            break;
            case 'wigt-pb-navmenu':
                var thisWidgetData = this.model.get('widgetNavBuilder');
                var allNavItems = thisWidgetData['navItems'];
                
                renderNavBuilderItems(allNavItems);

                jQuery('.customLinksMenuContainer').css('display', 'block');
                jQuery('.wpMenuSelectionContainer').css('display', 'none');

                var navStyles = thisWidgetData['navStyle'];
                $.each(navStyles,function(index, val){
                    $('.'+index).val(val);
                    
                    if (index == 'cnsff') {
                        $('.'+index).trigger('setFont',[ val.replace(/\+/g, ' ') ]);
                    }

                    if (index == 'cnsfc' || index == 'cnsfhc' || index == 'cnsbc' || index == 'cnshbc' ) {
                        $('.'+index).spectrum( 'set', val );
                        $('.'+index).val(val);
                    }


                    if(index == 'cnsource'){
                    console.log(val);
                      if( val == 'WPMenu' ){
                        jQuery('.wpMenuSelectionContainer').css('display', 'block');
                        jQuery('.customLinksMenuContainer').css('display', 'none');
                      }else{
                        jQuery('.customLinksMenuContainer').css('display', 'block');
                        jQuery('.wpMenuSelectionContainer').css('display', 'none');
                      }
                    }

                });

                $('.wdt-navMenu').css('display','block');
            break;
            case 'wigt-pb-gallery':

                var thisWidgetData = this.model.get('widgetIGallery');
                
                var allGalleryItems = thisWidgetData['gallItems'];
                var allGalleryStyles = thisWidgetData['gallStyles'];
                
                renderImageGalleryImageList(allGalleryItems);

                $.each(allGalleryStyles,function(index, val){
                    $('.'+index).val(val);
                });


                if ( allGalleryStyles['wgISD'] == 'custom') {
                    jQuery('.customImageSizeDiv').css('display','block');
                } else{
                    jQuery('.customImageSizeDiv').css('display','none');
                }

                $('.wdt-gallery').css('display','block');
            break;
            case 'wigt-pb-shareThis':

                var thisWidgetData = this.model.get('widgetShareThis');
                
                $.each(thisWidgetData,function(index, val){
                    $('.'+index).val(val);
                });


                

                $('.wdt-shareThis').css('display','block');
            break;
            case 'wigt-pb-accordion':

                var thisWidgetData = this.model.get('widgetAccordion');

                var accordionItems = thisWidgetData['accordionItems'];
                
                renderAccordionWidgetItems(accordionItems);

                var accordionTitle = thisWidgetData['accordionTitle'];
                var accordionContent = thisWidgetData['accordionContent'];
                var accordionIcon = thisWidgetData['accordionIcon'];
                var accordionSettings = thisWidgetData['accordionSettings'];


                $.each(accordionIcon, function(index, val) {

                    $('[data-optname="accordionIcon.'+index+'"]').val(val);

                    if (index == 'acciColor' || index == 'acciAColor') {
                        $('[data-optname="accordionIcon.'+index+'"]').spectrum( 'set', val ); 
                    }

                });

                $.each(accordionSettings, function(index, val) {

                    $('[data-optname="accordionSettings.'+index+'"]').val(val);

                    if ( index == 'accocborc' ) {
                        $('[data-optname="accordionSettings.'+index+'"]').spectrum( 'set', val ); 
                    }

                });


                $.each(accordionTitle, function(index, val) {

                    if (index != 'typography') {
                        $('[data-optname="accordionTitle.'+index+'"]').val(val);
                    }

                    if (index == 'typography') {
                        $.each(val, function(index2, val2) {
                            $('[data-optname="accordionTitle.typography.'+index2+'"]').val(val2);

                            if (index2 == 'ffam' && val2 != '' ) {
                                $('[data-optname="accordionTitle.typography.'+index2+'"]').trigger('setFont',[ $('[data-optname="accordionTitle.typography.'+index2+'"]').val().replace(/\+/g, ' ') ]);

                            }

                        });
                    }

                    if (index == 'acctbg' || index == 'acctc' || index == 'acctac' || index == 'acctabg') {
                        $('[data-optname="accordionTitle.'+index+'"]').spectrum( 'set', val );
                    }

                    

                });

                $.each(accordionContent, function(index, val) {

                    if (index != 'typography') {
                        $('[data-optname="accordionContent.'+index+'"]').val(val);
                    }

                    if (index == 'typography') {
                        $.each(val, function(index2, val2) {
                            $('[data-optname="accordionContent.typography.'+index2+'"]').val(val2);

                            if (index2 == 'ffam' && val2 != '' ) {
                                $('[data-optname="accordionContent.typography.'+index2+'"]').trigger('setFont',[ $('[data-optname="accordionContent.typography.'+index2+'"]').val().replace(/\+/g, ' ') ]);
                            }

                        });
                    }

                    if (index == 'acctbg' || index == 'acctc' || index == 'acctac') {
                        $('[data-optname="accordionContent.'+index+'"]').spectrum( 'set', val ); 
                    }

                    

                });


                $('.wdt-accordion').css('display','block');
            break;
            case 'wigt-pb-tabs':

                var thisWidgetData = this.model.get('widgetTabs');

                var tabItems = thisWidgetData['tabItems'];
                
                rendertabWidgetItems(tabItems);

                var tabTitle = thisWidgetData['tabTitle'];
                var tabContent = thisWidgetData['tabContent'];
                var tabIcon = thisWidgetData['tabIcon'];
                var tabSettings = thisWidgetData['tabSettings'];


                $.each(tabIcon, function(index, val) {

                    $('[data-optname="tabIcon.'+index+'"]').val(val);

                    if (index == 'acciColor' || index == 'acciAColor') {
                        $('[data-optname="tabIcon.'+index+'"]').spectrum( 'set', val ); 
                    }

                });

                $.each(tabSettings, function(index, val) {

                    $('[data-optname="tabSettings.'+index+'"]').val(val);

                    if ( index == 'accocborc' ) {
                        $('[data-optname="tabSettings.'+index+'"]').spectrum( 'set', val ); 
                    }

                });


                $.each(tabTitle, function(index, val) {

                    if (index != 'typography') {
                        $('[data-optname="tabTitle.'+index+'"]').val(val);
                    }

                    if (index == 'typography') {
                        $.each(val, function(index2, val2) {
                            $('[data-optname="tabTitle.typography.'+index2+'"]').val(val2);

                            if (index2 == 'ffam' && val2 != '' ) {
                                $('[data-optname="tabTitle.typography.'+index2+'"]').trigger('setFont',[ $('[data-optname="tabTitle.typography.'+index2+'"]').val().replace(/\+/g, ' ') ]);
                            }

                        });
                    }

                    if (index == 'acctbg' || index == 'acctc' || index == 'acctac' || index == 'acctabg') {
                        $('[data-optname="tabTitle.'+index+'"]').spectrum( 'set', val );
                    }

                    

                });

                $.each(tabContent, function(index, val) {

                    if (index != 'typography') {
                        $('[data-optname="tabContent.'+index+'"]').val(val);
                    }

                    if (index == 'typography') {
                        $.each(val, function(index2, val2) {
                            $('[data-optname="tabContent.typography.'+index2+'"]').val(val2);

                            if (index2 == 'ffam' && val2 != '' ) {
                                $('[data-optname="tabContent.typography.'+index2+'"]').trigger('setFont',[ $('[data-optname="tabContent.typography.'+index2+'"]').val().replace(/\+/g, ' ') ]);
                            }

                        });
                    }

                    if (index == 'acctbg' || index == 'acctc' || index == 'acctac') {
                        $('[data-optname="tabContent.'+index+'"]').spectrum( 'set', val ); 
                    }

                    

                });


                $('.wdt-tabs').css('display','block');
            break;
            default:
              $('.wdt-droppable').css('display','block');
              $('.wdt-editor, .wdt-img, .wdt-menu, .wdt-smuzform').css('display','none');
            break;
        }

        
        //$('.widgetAdvancedOps').val(JSON.stringify(this.model.attributes));
        

        var that = this.model.cid;
        $('.closeWidgetPopup').attr('data-CurrWidget',that);
        $('.closeWidgetPopupIcon').attr('data-CurrWidget',that);

        //$('.color-picker_btn_two').iris('hide');
        


    //var tuc1 = performance.now();
    //console.log("Call to editWidgetView took " + (tuc1 - tuc0) + " milliseconds.");
        
  },
  loadAdvancedOps: function(){
        
        // Advanced Options start

        //setting values to empty fields

        document.getElementById("widgetAdvOps").reset();

        if (this.model.get('widgetStyling') != '') {
            $('.widgetStyling').val(this.model.get('widgetStyling'));
        }

        if (this.model.get('widgetMtop') != '0') {
            $('.widgetMtop').val(this.model.get('widgetMtop'));
        }

        if (this.model.get('widgetMbottom') != '0') {
            $('.widgetMbottom').val(this.model.get('widgetMbottom'));
        }

        if (this.model.get('widgetMleft') != '0') {
            $('.widgetMleft').val(this.model.get('widgetMleft'));
        }

        if (this.model.get('widgetMright') != '0') {
            $('.widgetMright').val(this.model.get('widgetMright'));
        }

        if (this.model.get('widgetPtop') != '0') {
            $('.widgetPtop').val(this.model.get('widgetPtop'));
        }

        if (this.model.get('widgetPbottom') != '0') {
            $('.widgetPbottom').val(this.model.get('widgetPbottom'));
        }

        if (this.model.get('widgetPleft') != '0') {
            $('.widgetPleft').val(this.model.get('widgetPleft'));
        }

        if (this.model.get('widgetPright') != '0') {
            $('.widgetPright').val(this.model.get('widgetPright'));
        }

        if (this.model.get('widgetBgColor') != '') {
            $('.widgetBgColor').val(this.model.get('widgetBgColor'));
            $('.widgetBgColor').spectrum( 'set', this.model.get('widgetBgColor') );
        }

        if (this.model.get('widgetAnimation') != '') {
            $('.widgetAnimation').val(this.model.get('widgetAnimation'));
        }

        if (this.model.get('widgBgImg') != '') {
            $('.widgBgImg').val(this.model.get('widgBgImg'));
        }

        if (this.model.get('widgetBorderStyle') != '') {
            $('.widgetBorderStyle').val(this.model.get('widgetBorderStyle'));
        }

        if (this.model.get('widgetBorderColor') != '') {
            $('.widgetBorderColor').val(this.model.get('widgetBorderColor'));
            $('.widgetBorderColor').spectrum( 'set', this.model.get('widgetBorderColor') );
        }

        if (this.model.get('widgetBoxShadowH') != '') {
            $('.widgetBoxShadowH').val(this.model.get('widgetBoxShadowH'));
        }

        if (this.model.get('widgetBoxShadowV') != '') {
            $('.widgetBoxShadowV').val(this.model.get('widgetBoxShadowV'));
        }

        if (this.model.get('widgetBoxShadowBlur') != '') {
            $('.widgetBoxShadowBlur').val(this.model.get('widgetBoxShadowBlur'));
        }

        if (this.model.get('widgetBoxShadowColor') != '') {
            $('.widgetBoxShadowColor').val(this.model.get('widgetBoxShadowColor'));
        }
        

        widgetborderRadius = this.model.get('borderRadius');
        widgetborderWidth = this.model.get('borderWidth');

        if (typeof(widgetborderRadius) != 'undefined' && widgetborderRadius != null) {

          if (widgetborderRadius['wbrt'] != '') {
            $('.wbrt').val(widgetborderRadius['wbrt'] );
          }

          if (widgetborderRadius['wbrb'] != '') {
            $('.wbrb').val(widgetborderRadius['wbrb'] );
          }

          if (widgetborderRadius['wbrl'] != '') {
            $('.wbrl').val(widgetborderRadius['wbrl'] );
          }

          if (widgetborderRadius['wbrr'] != '') {
            $('.wbrr').val(widgetborderRadius['wbrr'] );
          }
          
        }

        if (typeof(widgetborderWidth) != 'undefined' && widgetborderWidth != null) {

          if (widgetborderWidth['wbwt'] != '') {
            $('.wbwt').val(widgetborderWidth['wbwt'] );
          } 

          if (widgetborderWidth['wbwb'] != '') {
            $('.wbwb').val(widgetborderWidth['wbwb'] );
          }

          if (widgetborderWidth['wbwl'] != '') {
            $('.wbwl').val(widgetborderWidth['wbwl'] );
          }

          if (widgetborderWidth['wbwr'] != '') {
            $('.wbwr').val(widgetborderWidth['wbwr'] );
          }

        }
        
        
        
        if (typeof(this.model.get('widgetIsInline')) !== 'undefined' ) {
          if (this.model.get('widgetIsInline') != '') {
            $('.widgetIsInline').val(this.model.get('widgetIsInline'));
          }
        }

        if (typeof(this.model.get('widgetCustomClass')) !== 'undefined' ) {
          if (this.model.get('widgetCustomClass') != '') {
            $('.widgetCustomClass').val(this.model.get('widgetCustomClass'));
          }
        }

        if (typeof(this.model.get('widgetIsInlineTablet')) !== 'undefined' ) {

          if (this.model.get('widgetIsInlineTablet') != '') {
            $('.widgetIsInlineTablet').val(this.model.get('widgetIsInlineTablet'));
          }

          if (this.model.get('widgetIsInlineMobile') != '') {
            $('.widgetIsInlineMobile').val(this.model.get('widgetIsInlineMobile'));
          }
          
        }

        if (typeof(this.model.get('widgHideOnDesktop')) !== 'undefined' ) {

          if (this.model.get('widgHideOnDesktop') != '') {
            $('.widgHideOnDesktop').val(this.model.get('widgHideOnDesktop'));
          }

          if (this.model.get('widgHideOnTablet') != '') {
            $('.widgHideOnTablet').val(this.model.get('widgHideOnTablet'));
          }

          if (this.model.get('widgHideOnMobile') != '') {
            $('.widgHideOnMobile').val(this.model.get('widgHideOnMobile'));
          }

        }



        if (typeof(this.model.get('widgetPaddingTablet')) !== 'undefined' ) {

            widgetPaddingTablet = this.model.get('widgetPaddingTablet');
            widgetPaddingMobile = this.model.get('widgetPaddingMobile');
            widgetMarginTablet = this.model.get('widgetMarginTablet');
            widgetMarginMobile = this.model.get('widgetMarginMobile');

            if (widgetMarginTablet['rMTT'] != '') {
              $('.widgetMTopTablet').val(widgetMarginTablet['rMTT']);
            }

            if (widgetMarginTablet['rMBT'] != '') {
              $('.widgetMBottomTablet').val(widgetMarginTablet['rMBT']);
            }

            if (widgetMarginTablet['rMLT'] != '') {
              $('.widgetMLeftTablet').val(widgetMarginTablet['rMLT']);
            }

            if (widgetMarginTablet['rMRT'] != '') {
              $('.widgetMRightTablet').val(widgetMarginTablet['rMRT']);
            }



            if (widgetMarginMobile['rMTM'] != '') {
              $('.widgetMTopMobile').val(widgetMarginMobile['rMTM']);
            }

            if (widgetMarginMobile['rMBM'] != '') {
              $('.widgetMBottomMobile').val(widgetMarginMobile['rMBM']);
            }

            if (widgetMarginMobile['rMLM'] != '') {
              $('.widgetMLeftMobile').val(widgetMarginMobile['rMLM']);
            }

            if (widgetMarginMobile['rMRM'] != '') {
              $('.widgetMRightMobile').val(widgetMarginMobile['rMRM']);
            }



            if (widgetPaddingTablet['rPTT'] != '') {
              $('.widgetPTopTablet').val(widgetPaddingTablet['rPTT']);
            }

            if (widgetPaddingTablet['rPBT'] != '') {
              $('.widgetPBottomTablet').val(widgetPaddingTablet['rPBT']);
            }

            if (widgetPaddingTablet['rPLT'] != '') {
              $('.widgetPLeftTablet').val(widgetPaddingTablet['rPLT']);
            }

            if (widgetPaddingTablet['rPRT'] != '') {
              $('.widgetPRightTablet').val(widgetPaddingTablet['rPRT']);
            }



            if (widgetPaddingMobile['rPTM'] != '') {
              $('.widgetPTopMobile').val(widgetPaddingMobile['rPTM']);
            }

            if (widgetPaddingMobile['rPBM'] != '') {
              $('.widgetPBottomMobile').val(widgetPaddingMobile['rPBM']);
            }

            if (widgetPaddingMobile['rPLM'] != '') {
              $('.widgetPLeftMobile').val(widgetPaddingMobile['rPLM']);
            }

            if (widgetPaddingMobile['rPRM'] != '') {
              $('.widgetPRightMobile').val(widgetPaddingMobile['rPRM']);
            }

        }



        if (typeof( this.model.get('widgGradient') ) !== "undefined"){
            var widgGradient = this.model.get('widgGradient');

            $.each(widgGradient, function(index,val){

              if (val != '') {
                $('.'+index).val(val);

                if (index == 'widgGradientColorFirst') {
                  $('.widgGradientColorFirst').spectrum( 'set', val );
                }
                if (index == 'widgGradientColorSecond') {
                  $('.widgGradientColorSecond').spectrum( 'set', val );
                }
              }
                
            });

            if (widgGradient['widgGradientType'] == 'linear') {
              $('.radialInput').css('display','none');
              $('.linearInput').css('display','block');
            } else if (widgGradient['widgGradientType'] == 'radial') {
              $('.radialInput').css('display','block');
              $('.linearInput').css('display','none');
            }

        }


        if (typeof(this.model.get('widgBackgroundType')) !== "undefined"){
            if (this.model.get('widgBackgroundType') == 'solid') {
              $(".popbInputNormalwidg .widgBackgroundTypeSolid").prop("checked", true);
              $('.popbInputNormalwidg .popbNavItem label').css({'background':'#f1f1f1', 'color':'#333'});
              $('.popbInputNormalwidg .widgBackgroundTypeSolid').prev('label').css({'background':'#c5c5c5', 'color':'#fff'});
              $('.popbInputNormalwidg .popb_tab_content').css('display','none');
              $('.widgNSrCon').css('display','block');
            }
            if (this.model.get('widgBackgroundType') == 'gradient') {
              $(".widgBackgroundTypeGradient").prop("checked", true);
              $('.popbInputNormalwidg .popbNavItem label').css({'background':'#f1f1f1', 'color':'#333'});
              $('.widgBackgroundTypeGradient').prev('label').css({'background':'#c5c5c5', 'color':'#fff'});
              $('.popbInputNormalwidg .popb_tab_content').css('display','none');
              $('.widgNGrCon').css('display','block');
            }
        }else{
              $(".popbInputNormalwidg .widgBackgroundTypeSolid").prop("checked", true);
              $(".widgBackgroundTypeGradient").prop("checked", false);
              $('.popbNavItem label').css({'background':'#f1f1f1', 'color':'#333'});
              $('.popbInputNormalwidg .widgBackgroundTypeSolid').prev('label').css({'background':'#c5c5c5', 'color':'#fff'});
              $('.popb_tab_content').css('display','none');
              $('.widgNSrCon').css('display','block');
        }

        if (typeof(this.model.get('widgHoverOptions')) !== "undefined") {
            var widgHoverOptions = this.model.get('widgHoverOptions');

            if (widgHoverOptions['widgBgColorHover'] != '') {
              $('.widgBgColorHover').val(widgHoverOptions['widgBgColorHover']);
              $('.widgBgColorHover').spectrum( 'set', $('.widgBgColorHover').val() );
            }

            if (widgHoverOptions['widgHoverTransitionDuration'] != '') {
              $('.widgHoverTransitionDuration').val(widgHoverOptions['widgHoverTransitionDuration']);
            }
              
            
            if (widgHoverOptions['widgBackgroundTypeHover'] == 'solid') {
              $(".widgBackgroundTypeSolidHover").prop("checked", true);
              $('.popbInputHoverwidg .popbNavItem label').css({'background':'#f1f1f1', 'color':'#333'});
              $('.widgBackgroundTypeSolidHover').prev('label').css({'background':'#c5c5c5', 'color':'#fff'});
              $('.popbInputHoverwidg .popb_tab_content').css('display','none');
              $('.popbInputHoverwidg .widgHSrCon').css('display','block');
            }
            if (widgHoverOptions['widgBackgroundTypeHover'] == 'gradient') {
              $(".widgBackgroundTypeGradientHover").prop("checked", true);
              $('.popbInputHoverwidg .popbNavItem label').css({'background':'#f1f1f1', 'color':'#333'});
              $('.widgBackgroundTypeGradientHover').prev('label').css({'background':'#c5c5c5', 'color':'#fff'});
              $('.popbInputHoverwidg .popb_tab_content').css('display','none');
              $('.popbInputHoverwidg .widgHGrCon').css('display','block');
            }

            if (typeof(widgHoverOptions['widgGradientHover']) != 'undefined') {
                var widgGradientHover = widgHoverOptions['widgGradientHover'];
                $.each(widgGradientHover, function(index,val){

                  if (val != '') {
                    $('.'+index).val(val);

                    if (index == 'widgGradientColorFirstHover') {
                      $('.widgGradientColorFirstHover').spectrum( 'set', val );
                    }
                    if (index == 'widgGradientColorSecondHover') {
                      $('.widgGradientColorSecondHover').spectrum( 'set', val );
                    }
                  }
                    
                });

                if (widgGradientHover['widgGradientTypeHover'] == 'linear') {
                  $('.radialInputHover').css('display','none');
                  $('.linearInputHover').css('display','block');
                } else if (widgGradientHover['widgGradientTypeHover'] == 'radial') {
                  $('.radialInputHover').css('display','block');
                  $('.linearInputHover').css('display','none');
                }

                if (typeof(widgHoverOptions['widgetHoverAnimation']) !== "undefined") {
                  if (widgHoverOptions['widgetHoverAnimation'] != '') {
                    $('.widgetHoverAnimation').val(widgHoverOptions['widgetHoverAnimation']);
                  }
                }
            }
                

        }


        $('.widget_width_ops_container').css('display','none');
        if (typeof(this.model.get('wp')) !== 'undefined' ){
          
          widgetPositionOps = this.model.get('wp');
          $.each(widgetPositionOps, function(index,value){
            $('.'+index).val(value);
            $('[data-optname="wp.'+index+'"]').val(value);

            if(index == 'wpw'){
              if(value == 'custom'){
                $('.widget_width_ops_container').css('display','block'); 
              }

            }

          });

        }

        // Advanced Options ends
  },
  updateWidget: function (ev) {

    // var tuc0 = performance.now();
    //console.log('updateWidget triggered');
    
    var updateWidgetOpType = pageBuilderApp.changedOpType;
    var updatedWidgetOpName = pageBuilderApp.changedOpName;
    if (typeof(updatedWidgetOpName) == 'undefined') {
        updatedWidgetOpName = ' ';
    }

    var widgetType = $('input[data-widgetType-id="'+this.model.cid+'"]').val();


    if (updateWidgetOpType == 'general') {
        
        /*
        var thisWidgetDefaultGeneralOps = {
            defaults:{
                widgetType:' ',
                widgetStyling:'',
                widgetMtop:'0',
                widgetMleft:'0',
                widgetMbottom:'0',
                widgetMright:'0',
                widgetPtop:'0',
                widgetPleft:'0',
                widgetPbottom:'0',
                widgetPright:'0',
                widgetPaddingTablet:{
                  rPTT:'',
                  rPBT:'',
                  rPLT:'',
                  rPRT:'',
                },
                widgetPaddingMobile:{
                  rPTM:'',
                  rPBM:'',
                  rPLM:'',
                  rPRM:'',
                },
                widgetMarginTablet:{
                  rMTT:'',
                  rMBT:'',
                  rMLT:'',
                  rMRT:'',
                },
                widgetMarginMobile:{
                  rMTM:'',
                  rMBM:'',
                  rMLM:'',
                  rMRM:'',
                },
                widgetBgColor: 'transparent',
                widgetAnimation: 'none',
                widgetBorderWidth: '',
                widgetBorderStyle:'',
                widgetBorderColor:'',
                widgetBorderRadius: '',
                borderRadius:{
                  wbrt: '',
                  wbrb: '',
                  wbrl: '',
                  wbrr: '',
                },
                borderWidth:{
                  wbwt: '',
                  wbwb: '',
                  wbwl: '',
                  wbwr: '',
                },
                widgetBoxShadowH: '',
                widgetBoxShadowV: '',
                widgetBoxShadowBlur: '',
                widgetBoxShadowColor: '',
                widgetIsInline:false,
                widgetIsInlineTablet:'',
                widgetIsInlineMobile:'',
                widgetCustomClass: '',
                widgBgImg:'',
                widgBackgroundType:'solid',
                widgGradient:{
                  widgGradientColorFirst: '#dd9933',
                  widgGradientLocationFirst:'55',
                  widgGradientColorSecond:'#eeee22',
                  widgGradientLocationSecond:'50',
                  widgGradientType:'linear',
                  widgGradientPosition:'top left',
                  widgGradientAngle:'135',
                },
                widgHoverOptions: {
                  widgBgColorHover:'',
                  widgBackgroundTypeHover:'',
                  widgHoverTransitionDuration:'',
                  widgGradientHover:{
                    widgGradientColorFirstHover: '',
                    widgGradientLocationFirstHover:'',
                    widgGradientColorSecondHover:'',
                    widgGradientLocationSecondHover:'',
                    widgGradientTypeHover:'linear',
                    widgGradientPositionHover:'top left',
                    widgGradientAngleHover:'',
                  }
                },
                widgHideOnDesktop:'',
                widgHideOnTablet:'',
                widgHideOnMobile:'',
            }
        };
        */

        var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();
        if (updatedWidgetOpName == 'widgBackgroundType') {
          var thischangedValue = $('.widgBackgroundType:checked').val();
        }
        if (updatedWidgetOpName == 'widgHoverOptions.widgBackgroundTypeHover') {
          var thischangedValue = $('.widgBackgroundTypeHover:checked').val();
        }


        var thisWidgetDataAttrNew = JSON.stringify(_.clone(this.model.attributes));

        thisWidgetDataAttrNew = JSON.parse(thisWidgetDataAttrNew);

        setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

        this.model.set(thisWidgetDataAttrNew); // prev took 120-150ms / Now only 4-10ms

        delete thisWidgetDataAttrNew;
    }
        
    if (updateWidgetOpType == 'specific') {
        switch(widgetType){
            case 'wigt-WYSIWYG': 

                var editorID = 'columnContent';
                var widgetEditorData = $('#'+editorID).val();

                widgetWYSIWYG = this.model.get('widgetWYSIWYG');
                if (typeof(widgetWYSIWYG['widgetContentFonts']) == 'undefined' ) {
                  widgetWYSIWYG['widgetContentFonts'] == '';
                }
                this.model.set({
                    widgetWYSIWYG: {
                      widgetContent:widgetEditorData,
                      widgetContentFonts: widgetWYSIWYG['widgetContentFonts'],
                    }
                });

                var widgetCurrentType = 'widgetWYSIWYG';
            break;
            case 'wigt-img': 
                
                if (updatedWidgetOpName != '' && typeof(updatedWidgetOpName) != 'undefined' && updatedWidgetOpName != ' ' ) {

                    var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();

                    if (typeof(thischangedValue) == 'undefined' ) {
                        break;
                    }


                    var thisWidgetDataAttrNew = _.clone(this.model.get('widgetImg'));

                    setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                    this.model.set({
                        widgetImg : thisWidgetDataAttrNew
                    }); // prev took 120-150ms / Now only 4-10ms

                    delete thisWidgetDataAttrNew;

                    
                }

                /*
                this.model.set({
                    widgetImg:{
                      imgUrl: $('.imgUrl').val(),
                      imgAlt: $('.imgAlt').val(),
                      imgSize: $('.imgSize').val(),
                      imgAlignment: $('.imgAlignment').val(),
                      imgAlignmentTablet: $('.imgAlignmentTablet').val(),
                      imgAlignmentMobile: $('.imgAlignmentMobile').val(),
                      imgSizeCustomWidth: $('.imgSizeCustomWidth').val(),
                      imgSizeCustomWidthTablet: $('.imgSizeCustomWidthTablet').val(),
                      imgSizeCustomWidthMobile: $('.imgSizeCustomWidthMobile').val(),
                      imgSizeCustomHeight: $('.imgSizeCustomHeight').val(),
                      imgSizeCustomHeightTablet: $('.imgSizeCustomHeightTablet').val(),
                      imgSizeCustomHeightMobile: $('.imgSizeCustomHeightMobile').val(),
                      imgLightBox: $('.imgLightBox').val(),
                      imgLink: $('.imgLink').val(),
                      iwbs:$('.iwbs').val(),
                      iwbc:$('.iwbc').val(),
                      iborderRadius:{
                        iwbrt:$('.iwbrt').val(),
                        iwbrb:$('.iwbrb').val(),
                        iwbrl:$('.iwbrl').val(),
                        iwbrr:$('.iwbrr').val(),
                      },
                      iborderWidth:{
                        iwbwt:$('.iwbwt').val(),
                        iwbwb:$('.iwbwb').val(),
                        iwbwl:$('.iwbwl').val(),
                        iwbwr:$('.iwbwr').val(),
                      },
                      iwbsh: $('.iwbsh').val(),
                      iwbsv: $('.iwbsv').val(),
                      iwbsb: $('.iwbsb').val(),
                      iwbsc: $('.iwbsc').val(),
                      }
                });
                */
            break;
            case 'wigt-menu':

                var widgetMenuName    = $('#ftr-menu-select').val();
                var widgetMenuStyle   = $('input[name=ftr-menu-select-style]:checked').val();
                var widgetMenuColor   = $('#ftr-menu-color').val();
                var pbMenuFontFamily   = $('.pbMenuFontFamily').val();

                this.model.set({
                    widgetMenu:{
                      menuName: widgetMenuName,
                      menuStyle: widgetMenuStyle,
                      menuColor: widgetMenuColor,
                      pbMenuFontFamily: pbMenuFontFamily,
                      pbMenuFontHoverColor: $('.pbMenuFontHoverColor').val(),
                      pbMenuFontHoverBgColor:$('.pbMenuFontHoverBgColor').val(),
                      pbMenuFontSize: $('.pbMenuFontSize').val(),
                    }
                });
            break;
            case 'wigt-btn-gen':

                

                btnicon = $('.btnSelectedIconpbicp-auto').val();
                if (btnicon != '') {
                 btnSelectedIcon = $('.btnSelectedIcon').children().attr('class');
                }else{
                 btnSelectedIcon = '';
                }

                var btnLink = $('.btnLink').val();
                /*
                if (btnLink.indexOf('#') == -1) {
                  if (!/^(f|ht)tps?:\/\//i.test(btnLink)) {
                    btnLink = "http://" + btnLink;
                  }
                }
                */

                if (updatedWidgetOpName != '' && typeof(updatedWidgetOpName) != 'undefined' && updatedWidgetOpName != ' ' ) {

                    var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();
                    if (updatedWidgetOpName == 'btnSelectedIcon') {
                        thischangedValue = $('.btnSelectedIcon').children().attr('class');
                    }

                    if (typeof(thischangedValue) == 'undefined' ) {
                        break;
                    }

                    var thisWidgetDataAttrNew = _.clone(this.model.get('widgetButton'));

                    setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                    this.model.set({
                        widgetButton : thisWidgetDataAttrNew
                    });

                    delete thisWidgetDataAttrNew;

                }

                /*
                this.model.set({
                    widgetButton:{
                      btnText: $('.btnText').val(),
                      btnClickAction: $('.btnClickAction').val(),
                      btnWidgetPopUpId: $('.btnWidgetPopUpId').val(),
                      btnLink: $('.btnLink').val(),
                      btnTextColor: $('.btnColor').val(),
                      btnCAction: $('.btnCAction').val(),
                      btnFontSize: $('.btnFontSize').val(),
                      btnFontSizeTablet:$('.btnFontSizeTablet').val(),
                      btnFontSizeMobile:$('.btnFontSizeMobile').val(),
                      btnBgColor: $('.btnBgColor').val(),
                      btnWidth: $('.btnWidth').val(),
                      btnWidthPercent: $('.btnWidthPercent').val(),
                      btnWidthPercentTablet:$('.btnWidthPercentTablet').val(),
                      btnWidthPercentMobile:$('.btnWidthPercentMobile').val(),
                      btnWidthUnit: $('.btnWidthUnit').val(),
                      btnWidthUnitTablet: $('.btnWidthUnitTablet').val(),
                      btnWidthUnitMobile: $('.btnWidthUnitMobile').val(),
                      btnHeight: $('.btnHeight').val(),
                      btnHeightTablet:$('.btnHeightTablet').val(),
                      btnHeightMobile:$('.btnHeightMobile').val(),
                      btnHoverBgColor: $('.btnHoverBgColor').val(),
                      btnHoverTextColor: $('.btnHoverTextColor').val(),
                      btnBlankAttr: $('.btnBlankAttr').val(),
                      btnBorderColor: $('.btnBorderColor').val(),
                      btnBorderWidth: $('.btnBorderWidth').val(),
                      btnBorderRadius: $('.btnBorderRadius').val(),
                      btnButtonAlignment: $('.btnButtonAlignment').val(),
                      btnButtonAlignmentTablet: $('.btnButtonAlignmentTablet').val(),
                      btnButtonAlignmentMobile: $('.btnButtonAlignmentMobile').val(),
                      btnButtonFontFamily: $('.btnButtonFontFamily').val(),
                      btnSelectedIcon: btnSelectedIcon,
                      btnIconPosition: $('.btnIconPosition').val(),
                      btnIconAnimation: $('.btnIconAnimation').val(),
                      btnIconGap: $('.btnIconGap').val(),
                    }
                });
                */
            break;
            case 'wigt-pb-form': 
                var this_widget_subscribeForm = this.model.get('widgetSubscribeForm');
                pbFormID = this_widget_subscribeForm['pbFormID'];


                // subs form
                formLayout = $('.formLayout').val();
                showNameField = $('.showNameField').val();
                successAction = $('.successAction').val();
                successURL = $('.successURL').val();
                successMessage = $('.successMessage').val();
                formBtnText = $('.formBtnText').val();
                formBtnHeight = $('.formBtnHeight').val();
                formBtnWidth = $('.formBtnWidth').val();
                formBtnColor = $('.formBtnColor').val();
                formBtnFontSize = $('.formBtnFontSize').val();
                formBtnBgColor = $('.formBtnBgColor').val();
                formBtnHoverBgColor = $('.formBtnHoverBgColor').val();
                formBtnBorderWidth = $('.formBtnBorderWidth').val();
                formBtnBorderColor = $('.formBtnBorderColor').val();
                formBtnBorderRadius = $('.formBtnBorderRadius').val();
                formDataSaveType = $('.formDataSaveType').val();
                formAccountName = $('.formAccountName').val();
                formApiKey = $('.formApiKey').val();

                $('.mailchimpApiKeyHolder').val(formApiKey);
                $('.mailchimpListIdHolder').val(formAccountName);

                btnicon = $('.formbtnSelectedIconpbicp-auto').val();
                if (btnicon != '') {
                 formbtnSelectedIcon = $('.formbtnSelectedIcon').children().attr('class');
                }else{
                 formbtnSelectedIcon = '';
                }

                this.model.set({
                    widgetSubscribeForm:{
                      pbFormID: pbFormID,
                      formLayout: formLayout,
                      showNameField: showNameField,
                      successAction:successAction,
                      successURL:successURL,
                      successMessage:successMessage,
                      formBtnText:formBtnText,
                      formBtnHeight:formBtnHeight,
                      formBtnHeightTablet:$('.formBtnHeightTablet').val(),
                      formBtnHeightMobile:$('.formBtnHeightMobile').val(),
                      formBtnWidth:formBtnWidth,
                      formBtnBgColor:formBtnBgColor,
                      formBtnHoverTextColor: $('.formBtnHoverTextColor').val(),
                      formBtnColor:formBtnColor,
                      formBtnHoverBgColor:formBtnHoverBgColor,
                      formBtnFontSize:formBtnFontSize,
                      formBtnFontSizeTablet:$('.formBtnFontSizeTablet').val(),
                      formBtnFontSizeMobile:$('.formBtnFontSizeMobile').val(),
                      formBtnBorderWidth:formBtnBorderWidth,
                      formBtnBorderColor:formBtnBorderColor,
                      formBtnBorderRadius:formBtnBorderRadius,
                      formBtnFontFamily:$('.formBtnFontFamily').val(),
                      formSuccessMessageColor:$('.formSuccessMessageColor').val(),
                      formDataSaveType: formDataSaveType,
                      formDataMailChimpApi:$('.formDataMailChimpApi').val(),
                      formDataMailChimpListId:$('.formDataMailChimpListId').val(),
                      isMcActive:$('.isMcActive').val(),
                      formbtnSelectedIcon:formbtnSelectedIcon,
                      formbtnIconPosition:$('.formbtnIconPosition').val(),
                      formbtnIconGap:$('.formbtnIconGap').val(),
                      formbtnIconAnimation:$('.formbtnIconAnimation').val(),
                      formIntegrations:{
                        getResponse:{
                          isGrActive:$('.isGrActive').val(),
                          GrApiKey:$('.GrApiKey').val(),
                          GrAccountName:$('.GrAccountName').val(),
                        },
                        campaignMonitor:{
                          isCmActive: $('.isCmActive').val(),
                          CmApiKey: $('.CmApiKey').val(),
                          CmAccountName: $('.CmAccountName').val(),
                        },
                        activeCampaign:{
                          isAcActive: $('.isAcActive').val(),
                          AcApiKey: $('.AcApiKey').val(),
                          AcApiURL: $('.AcApiURL').val(),
                          AcAccountName: $('.AcAccountName').val(),
                        },
                        drip:{
                          isDripActive: $('.isDripActive').val(),
                          DripApiKey: $('.DripApiKey').val(),
                          DripAccountName: $('.DripAccountName').val(),
                        },
                      }
                    }
                });
            break;
            case 'wigt-video': 

                videoMpfour = $('.videoMpfour').val();
                videoWebM = $('.videoWebM').val();
                videoThumb = $('.videoThumb').val();
                vidAutoPlay = $('.vidAutoPlay').val();
                vidLoop = $('.vidLoop').val(); 
                vidControls = $('.vidControls').val();

                this.model.set({
                    widgetVideo:{
                      videoWebM: videoWebM,
                      videoMpfour: videoMpfour,
                      videoThumb: videoThumb,
                      vidAutoPlay: vidAutoPlay,
                      vidLoop: vidLoop,
                      vidControls: vidControls
                    }
                });
            break;
            case 'wigt-pb-postSlider': 

                psAutoplay = $('.psAutoplay').val();
                psSlideDelay = $('.psSlideDelay').val();
                psSlideLoop = $('.psSlideLoop').val();
                psSlideTransition = $('.psSlideTransition').val();
                psPostsNumber = $('.psPostsNumber').val();
                psDots = $('.psDots').val();
                psArrows = $('.psArrows').val();
                psFtrImage = $('.psFtrImage').val();
                psFtrImageSize = $('.psFtrImageSize').val();
                psExcerpt = $('.psExcerpt').val();
                psReadMore = $('.psReadMore').val();
                psMoreLinkText = $('.psMoreLinkText').val();
                psHeadingSize = $('.psHeadingSize').val();
                psTextAlignment = $('.psTextAlignment').val();
                psBgColor = $('.psBgColor').val();
                psTxtColor = $('.psTxtColor').val();
                psHeadingTxtColor = $('.psHeadingTxtColor').val();
                psPostType = $('.psPostType').val();
                psPostsOrderBy = $('.psPostsOrderBy').val();
                psPostsOrder = $('.psPostsOrder').val();
                psPostsFilterBy = $('.psPostsFilterBy').val();
                psFilterValue = $('.psFilterValue').val();

                this.model.set({
                    widgetPBPostsSlider:{
                      psAutoplay: psAutoplay,
                      psSlideDelay: psSlideDelay,
                      psSlideLoop: psSlideLoop,
                      psSlideTransition: psSlideTransition,
                      psPostsNumber: psPostsNumber,
                      psDots: psDots,
                      psArrows: psArrows,
                      psFtrImage: psFtrImage,
                      psFtrImageSize: psFtrImageSize,
                      psExcerpt: psExcerpt,
                      psReadMore: psReadMore,
                      psMoreLinkText: psMoreLinkText,
                      psHeadingSize: psHeadingSize,
                      psTextAlignment: psTextAlignment,
                      psBgColor: psBgColor,
                      psTxtColor: psTxtColor,
                      psHeadingTxtColor: psHeadingTxtColor,
                      psPostType: psPostType,
                      psPostsOrderBy: psPostsOrderBy,
                      psPostsOrder: psPostsOrder,
                      psPostsFilterBy: psPostsFilterBy,
                      psFilterValue: psFilterValue,
                    }
                });
            break;
            case 'wigt-pb-icons':

                pbSelectedIcon = $('.pbSelectedIcon').prev('input').val();
                pbIconSize = $('.pbIconSize').val();
                pbIconRotation = $('.pbIconRotation').val();
                pbIconColor = $('.pbIconColor').val();
                pbIconLink = $('.pbIconLink').val();

                this.model.set({
                    widgetIcons:{
                      pbSelectedIcon: pbSelectedIcon,
                      pbIcStyle:$('.pbIcStyle').val(),
                      pbIconSize: pbIconSize,
                      pbIconRotation: pbIconRotation,
                      pbIconColor: pbIconColor,
                      pbIconLink: pbIconLink,
                      pbIconLinkOpen: $('.pbIconLinkOpen').val(),
                      pbIcBgC:$('.pbIcBgC').val(),
                      pbIcBC:$('.pbIcBC').val(),
                      pbIcBW:$('.pbIcBW').val(),
                      pbIcBR:$('.pbIcBR').val(),
                      pbIcSHP:$('.pbIcSHP').val(),
                      pbIcSVP:$('.pbIcSVP').val(),
                      pbIcSDB:$('.pbIcSDB').val(),
                      pbIcSC:$('.pbIcSC').val(),
                      pbIcHC:$('.pbIcHC').val(),
                      pbIcHBgC:$('.pbIcHBgC').val(),
                      pbIcHAn:$('.pbIcHAn').val(),
                    }
                });
            break;
            case 'wigt-pb-counter': 
                var this_widget_counter = this.model.get('widgetCounter');
                pbCounterID = this_widget_counter['pbCounterID'];

                counterStartingNumber = $('.counterStartingNumber').val();
                counterEndingNumber = $('.counterEndingNumber').val();
                counterNumberPrefix = $('.counterNumberPrefix').val();
                counterNumberSuffix = $('.counterNumberSuffix').val();
                counterAnimationTime = $('.counterAnimationTime').val(); 
                counterTitle = $('.counterTitle').val();
                counterTextColor = $('.counterTextColor').val();
                counterTitleColor = $('.counterTitleColor').val();
                counterNumberFontSize = $('.counterNumberFontSize').val();
                counterTitleFontSize = $('.counterTitleFontSize').val();

                this.model.set({
                    widgetCounter:{
                      pbCounterID: pbCounterID,
                      counterStartingNumber: counterStartingNumber,
                      counterEndingNumber:counterEndingNumber,
                      counterNumberPrefix: counterNumberPrefix,
                      counterNumberSuffix: counterNumberSuffix,
                      counterAnimationTime: counterAnimationTime,
                      counterTitle: counterTitle,
                      counterTextColor: counterTextColor,
                      counterTitleColor: counterTitleColor,
                      counterNumberFontSize: counterNumberFontSize,
                      counterTitleFontSize: counterTitleFontSize,
                    }
                });
            break;
            case 'wigt-pb-audio':

                //audio widget
                audioOgg = $('.audioOgg').val();
                audioMpThree = $('.audioMpThree').val();
                audioAutoPlay = $('.audioAutoPlay').val();
                audioLoop = $('.audioLoop').val();
                audioControls = $('.audioControls').val();

                this.model.set({
                    widgetAudio:{
                      audioOgg: audioOgg,
                      audioMpThree: audioMpThree,
                      audioAutoPlay: audioAutoPlay,
                      audioLoop: audioLoop,
                      audioControls: audioControls
                    }
                });
            break;
            case 'wigt-pb-cards': 

                // Card Widget
                pbSelectedCardIcon = $('.pbSelectedCardIcon').children().attr('class');
                pbCardIconSize = $('.pbCardIconSize').val();
                pbCardIconRotation = $('.pbCardIconRotation').val();
                pbCardIconColor = $('.pbCardIconColor').val();
                pbCardTitleColor = $('.pbCardTitleColor').val();
                pbCardTitleSize = $('.pbCardTitleSize').val();
                pbCardDescColor = $('.pbCardDescColor').val();
                pbCardDescSize = $('.pbCardDescSize').val();
                pbCardTitle = $('.pbCardTitle').val();
                pbCardDesc = $('.pbCardDesc').val();

                this.model.set({
                    widgetCard:{
                      pbSelectedCardIcon: pbSelectedCardIcon,
                      pbCardIconSize: pbCardIconSize,
                      pbCardIconRotation: pbCardIconRotation,
                      pbCardIconColor: pbCardIconColor,
                      pbCardTitleColor: pbCardTitleColor,
                      pbCardTitleSize: pbCardTitleSize,
                      pbCardDescColor: pbCardDescColor,
                      pbCardDescSize: pbCardDescSize,
                      pbCardTitle: pbCardTitle,
                      pbCardDesc: pbCardDesc,
                      pbCardTitleSizeTablet: $('.pbCardTitleSizeTablet').val(),
                      pbCardTitleSizeMobile: $('.pbCardTitleSizeMobile').val(),
                      pbCardDescSizeTablet:$('.pbCardDescSizeTablet').val(),
                      pbCardDescSizeMobile:$('.pbCardDescSizeMobile').val(),
                    }
                });
            break;
            case 'wigt-pb-testimonial':

                //testimonial widget
                tsAuthorName = $('.tsAuthorName').val();
                tsJob = $('.tsJob').val();
                tsCompanyName = $('.tsCompanyName').val();
                tsTestimonial = $('.tsTestimonial').val();
                tsUserImg = $('.tsUserImg').val();
                tsImageShape = $('.tsImageShape').val();
                tsIconColor = $('.tsIconColor').val();
                tsIconSize = $('.tsIconSize').val();
                tsTextColor = $('.tsTextColor').val();
                tsTextSize = $('.tsTextSize').val();
                tsTestimonialColor = $('.tsTestimonialColor').val();
                tsTestimonialSize = $('.tsTestimonialSize').val();
                tsTextAlignment = $('.tsTextAlignment').val();

                this.model.set({
                    widgetTestimonial: {
                      tsAuthorName: tsAuthorName,
                      tsJob: tsJob,
                      tsCompanyName: tsCompanyName,
                      tsTestimonial: tsTestimonial,
                      tsUserImg: tsUserImg,
                      tsImageShape: tsImageShape,
                      tsIconColor: tsIconColor,
                      tsIconSize: tsIconSize,
                      tsTextColor: tsTextColor,
                      tsTextSize: tsTextSize,
                      tsTestimonialColor: tsTestimonialColor,
                      tsTestimonialSize:tsTestimonialSize,
                      tsTextAlignment: tsTextAlignment,
                      tsIa: $('.tsIa').val(),
                      tsIt: $('.tsIt').val(),
                    }
                });
            break;
            case 'wigt-pb-shortcode': 

                shortCodeInput = $('.shortCodeInput').val();
                this.model.set({
                    widgetShortCode: {
                      shortCodeInput: shortCodeInput,
                    }
                });
            break;
            case 'wigt-pb-countdown': 

                this.model.set({
                  widgetCowntdown: {
                    pbCountDownDate: $('.pbCountDownDate').val(),
                    pbCountDownTimezone: $('.pbCountDownTimezone').val(),
                    pbCountDownLabel: $('.pbCountDownLabel').val(),
                    pbCountDownColor: $('.pbCountDownColor').val(),
                    pbCountDownLabelColor: $('.pbCountDownLabelColor').val(),
                    pbCountDownTextSize: $('.pbCountDownTextSize').val(),
                    pbCountDownTextSizeTablet:$('.pbCountDownTextSizeTablet').val(),
                    pbCountDownTextSizeMobile:$('.pbCountDownTextSizeMobile').val(),
                    pbCountDownLabelTextSize: $('.pbCountDownLabelTextSize').val(),
                    pbCountDownLabelTextSizeTablet:$('.pbCountDownLabelTextSizeTablet').val(),
                    pbCountDownLabelTextSizeMobile:$('.pbCountDownLabelTextSizeMobile').val(),
                    pbCountDownLabelFontFamily:$('.pbCountDownLabelFontFamily').val(),
                    pbCountDownNumberFontFamily:$('.pbCountDownNumberFontFamily').val(),
                    pbCountDownType:$('.pbCountDownType').val(),
                    pbCountDownNumberBgColor:$('.pbCountDownNumberBgColor').val(),
                    pbCountDownNumberBorderRadius:$('.pbCountDownNumberBorderRadius').val(),
                    pbcdnbw:$('.pbcdnbw').val(),
                    pbcdnbc:$('.pbcdnbc').val(),
                    pbcdnbs:$('.pbcdnbs').val(),
                    pbCountDownHGap:$('.pbCountDownHGap').val(),
                    pbCountDownHGapTablet:$('.pbCountDownHGapTablet').val(),
                    pbCountDownHGapMobile:$('.pbCountDownHGapMobile').val(),
                    pbCountDownVGap:$('.pbCountDownVGap').val(),
                    pbCountDownVGapTablet:$('.pbCountDownVGapTablet').val(),
                    pbCountDownVGapMobile:$('.pbCountDownVGapMobile').val(),
                    pbCountDownDateDays:$('.pbCountDownDateDays').val(),
                    pbCountDownDateHours:$('.pbCountDownDateHours').val(),
                    pbCountDownDateMins:$('.pbCountDownDateMins').val(),
                    pbCountDownDateSecs:$('.pbCountDownDateSecs').val(),
                    daysText:$('.daysText').val(),
                    hoursText:$('.hoursText').val(),
                    minutesText:$('.minutesText').val(),
                    secondsText:$('.secondsText').val(),
                    hideDays:$('.hideDays').val(),
                    hideHours:$('.hideHours').val(),
                    hideMinutes:$('.hideMinutes').val(),
                    hideSeconds:$('.hideSeconds').val(),
                  }
                });
            break;
            case 'wigt-pb-imageSlider': 

                // ImageSlider Update 



                if (updatedWidgetOpName != '' && typeof(updatedWidgetOpName) != 'undefined' && updatedWidgetOpName != ' ' ) {

                    var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();

                    if (updatedWidgetOpName == 'slideHeadingStyles.slideHeadingBold' || updatedWidgetOpName == 'slideHeadingStyles.slideHeadingItalic' || updatedWidgetOpName == 'slideHeadingStyles.slideHeadingUnderlined' ) {
                        thischangedValue = false;
                        if( $('[data-optname="'+updatedWidgetOpName+'"]').is(':checked') ){
                            thischangedValue = true;
                        }
                    }

                    if (updatedWidgetOpName == 'slideDescStyles.slideDescBold' || updatedWidgetOpName == 'slideDescStyles.slideDescItalic' || updatedWidgetOpName == 'slideDescStyles.slideDescUnderlined' ) {
                        thischangedValue = false;
                        if( $('[data-optname="'+updatedWidgetOpName+'"]').is(':checked') ){
                            thischangedValue = true;
                        }
                    }

                    
                    if (updatedWidgetOpName == 'slideListEdit') {
                        
                        var pbSliderSlideList = [];
                        var pbSliderContent = [];

                        $('.sliderImageSlidesContainer li').each(function(index){

                            pbSliderSlideList.push($( this ).children('.accordContentHolder').children('.slideImgURL').val() );
                            
                            pbSliderContentThisObject = {};
                            pbSliderContentThisObject = {
                                imageSlideUrl: $( this ).children('.accordContentHolder').children('.slideImgURL').val(),
                                imageSlideHeading: $( this ).children('.accordContentHolder').children('.imageSlideHeading').val(),
                                imageSlideDesc:$( this ).children('.accordContentHolder').children('.imageSlideDesc').val(),
                                imageSlideButtonText:$( this ).children('.accordContentHolder').children('.imageSlideButtonText').val(),
                                imageSlideButtonURL:$( this ).children('.accordContentHolder').children('.imageSlideButtonURL').val(),
                                isalt: $( this ).children('.accordContentHolder').children('.isalt').val(),
                                istitle: $( this ).children('.accordContentHolder').children('.istitle').val(),
                            };

                            pbSliderContent.push(pbSliderContentThisObject);

                        });

                        pbSliderImagesURL = pbSliderSlideList;

                        
                        updatedWidgetOpName = 'pbSliderContent';
                        thischangedValue = pbSliderContent;

                        renderImageSliderItemsList(pbSliderImagesURL,pbSliderContent);

                    }

                    if (typeof(thischangedValue) == 'undefined' ) {
                        break;
                    }

                    var thisWidgetDataAttrNew = _.clone(this.model.get('widgetImageSlider'));

                    setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                    this.model.set({
                        widgetImageSlider : thisWidgetDataAttrNew
                    }); // prev took 120-150ms / Now only 4-10ms


                    delete thisWidgetDataAttrNew;

                }
                
                // pbSliderAuto = $('.pbSliderAuto').val();
                // pbSliderDelay = $('.pbSliderDelay').val();
                // pbSliderPager = $('.pbSliderPager').val();
                // pbSliderNav = $('.pbSliderNav').val();
                // pbSliderRandom = $('.pbSliderRandom').val();
                // pbSliderPause = $('.pbSliderPause').val();



                // slideHeadingBold = false; 
                // slideHeadingItalic = false;
                // slideHeadingUnderlined = false;
                // if( $('.slideHeadingBold').is(':checked') ){
                //     slideHeadingBold = true;
                // }
                // if( $('.slideHeadingItalic').is(':checked') ){
                //     slideHeadingItalic = true;
                // }
                // if( $('.slideHeadingUnderlined').is(':checked') ){
                //     slideHeadingUnderlined = true;
                // }

                // slideHeadingStyles = {
                //     slideHeadingColor: $('.slideHeadingColor').val(),
                //     slideHeadingSize: $('.slideHeadingSize').val(),
                //     slideHeadingSizeTablet: $('.slideHeadingSizeTablet').val(),
                //     slideHeadingSizeMobile: $('.slideHeadingSizeMobile').val(),
                //     slideHeadingLetterSpacing: $('.slideHeadingLetterSpacing').val(),
                //     slideHeadingLetterSpacingTablet:$('.slideHeadingLetterSpacingTablet').val(),
                //     slideHeadingLetterSpacingMobile:$('.slideHeadingLetterSpacingMobile').val(),
                //     slideHeadingLineHeight:$('.slideHeadingLineHeight').val(),
                //     slideHeadingLineHeightTablet:$('.slideHeadingLineHeightTablet').val(),
                //     slideHeadingLineHeightMobile:$('.slideHeadingLineHeightMobile').val(),
                //     slideHeadingFontFamily: $('.slideHeadingFontFamily').val(),
                //     slideHeadingBold: slideHeadingBold,
                //     slideHeadingItalic: slideHeadingItalic,
                //     slideHeadingUnderlined: slideHeadingUnderlined,
                // };

                // slideDescBold = false; 
                // slideDescItalic = false;
                // slideDescUnderlined = false;
                // if( $('.slideDescBold').is(':checked') ){
                //     slideDescBold = true;
                // }
                // if( $('.slideDescItalic').is(':checked') ){
                //     slideDescItalic = true;
                // }
                // if( $('.slideDescUnderlined').is(':checked') ){
                //     slideDescUnderlined = true;
                // }

                // slideDescStyles = {
                //     slideDescColor: $('.slideDescColor').val(),
                //     slideDescSize: $('.slideDescSize').val(),
                //     slideDescSizeTablet:$('.slideDescSizeTablet').val(),
                //     slideDescSizeMobile:$('.slideDescSizeMobile').val(),
                //     slideDescLetterSpacing: $('.slideDescLetterSpacing').val(),
                //     slideDescLetterSpacingTablet:$('.slideDescLetterSpacingTablet').val(),
                //     slideDescLetterSpacingMobile:$('.slideDescLetterSpacingMobile').val(),
                //     slideDescLineHeight:$('.slideDescLineHeight').val(),
                //     slideDescLineHeightTablet:$('.slideDescLineHeightTablet').val(),
                //     slideDescLineHeightMobile:$('.slideDescLineHeightMobile').val(),
                //     slideDescFontFamily: $('.slideDescFontFamily').val(),
                //     slideDescBold: slideDescBold,
                //     slideDescItalic: slideDescItalic,
                //     slideDescUnderlined: slideDescUnderlined,
                // };

                // slideButtonStyles = {
                //     slideButtonBtnHeight: $('.slideButtonBtnHeight').val(),
                //     slideButtonBtnHeightTablet:$('.slideButtonBtnHeightTablet').val(),
                //     slideButtonBtnHeightMobile:$('.slideButtonBtnHeightMobile').val(),
                //     slideButtonBtnWidth: $('.slideButtonBtnWidth').val(),
                //     slideButtonBtnWidthTablet:$('.slideButtonBtnWidthTablet').val(),
                //     slideButtonBtnWidthMobile:$('.slideButtonBtnWidthMobile').val(),
                //     slideButtonBtnBgColor:$('.slideButtonBtnBgColor').val(),
                //     slideButtonBtnColor:$('.slideButtonBtnColor').val(),
                //     slideButtonBtnHoverBgColor:$('.slideButtonBtnHoverBgColor').val(),
                //     slideButtonBtnHoverTextColor:$('.slideButtonBtnHoverTextColor').val(),
                //     slideButtonBtnFontSize:$('.slideButtonBtnFontSize').val(),
                //     slideButtonBtnFontSizeTablet:$('.slideButtonBtnFontSizeTablet').val(),
                //     slideButtonBtnFontSizeMobile:$('.slideButtonBtnFontSizeMobile').val(),
                //     slideButtonBtnFontFamily:$('.slideButtonBtnFontFamily').val(),
                //     slideButtonBtnFontLetterSpacing:$('.slideButtonBtnFontLetterSpacing').val(),
                //     slideButtonBtnFontLetterSpacingTablet:$('.slideButtonBtnFontLetterSpacingTablet').val(),
                //     slideButtonBtnFontLetterSpacingMobile:$('.slideButtonBtnFontLetterSpacingMobile').val(),
                //     slideButtonBtnBorderWidth:$('.slideButtonBtnBorderWidth').val(),
                //     slideButtonBtnBorderColor:$('.slideButtonBtnBorderColor').val(),
                //     slideButtonBtnBorderRadius:$('.slideButtonBtnBorderRadius').val()
                // }

                // this.model.set({
                //     widgetImageSlider: {
                //       pbSliderImagesURL: pbSliderImagesURL,
                //       pbSliderContent: pbSliderContentList,
                //       slideHeadingStyles: slideHeadingStyles,
                //       slideDescStyles: slideDescStyles,
                //       slideButtonStyles: slideButtonStyles,
                //       pbSliderHeight: $('.pbSliderHeight').val(),
                //       pbSliderHeightTablet:$('.pbSliderHeightTablet').val(),
                //       pbSliderHeightMobile:$('.pbSliderHeightMobile').val(),
                //       pbSliderHeightUnit: $('.pbSliderHeightUnit').val(),
                //       pbSliderHeightUnitTablet:$('.pbSliderHeightUnitTablet').val(),
                //       pbSliderHeightUnitMobile:$('.pbSliderHeightUnitMobile').val(),
                //       pbSliderContentBgColor: $('.pbSliderContentBgColor').val(),
                //       pbSliderAuto:  $('.pbSliderAuto').val(),
                //       pbSliderDelay:  $('.pbSliderDelay').val(),
                //       pbSliderPager:  $('.pbSliderPager').val(),
                //       pbSliderNav:  $('.pbSliderNav').val(),
                //       pbSliderRandom:  $('.pbSliderRandom').val(),
                //       pbSliderPause:  $('.pbSliderPause').val(),
                //     }
                // });

            break;
            case 'wigt-pb-progressBar': 
                this.model.set({
                    widgetProgressBar: {
                      pbProgressBarTitle: $('.pbProgressBarTitle').val(),
                      pbProgressBarPrecentage: $('.pbProgressBarPrecentage').val(),
                      pbProgressBarDisplayPrecentage: $('.pbProgressBarDisplayPrecentage').val(),
                      pbProgressBarText: $('.pbProgressBarText').val(),
                      pbProgressBarTitleColor: $('.pbProgressBarTitleColor').val(),
                      pbProgressBarTextColor: $('.pbProgressBarTextColor').val(),
                      pbProgressBarColor: $('.pbProgressBarColor').val(),
                      pbProgressBarBgColor: $('.pbProgressBarBgColor').val(),
                      pbProgressBarTitleSize: $('.pbProgressBarTitleSize').val(),
                      pbProgressBarHeight: $('.pbProgressBarHeight').val(),
                      pbProgressBarTextSize: $('.pbProgressBarTextSize').val(),
                      pbProgressBarTextFontFamily: $('.pbProgressBarTextFontFamily').val(),
                    }
                });
            break;
            case 'wigt-pb-pricing': 


                var pricingeditorID = 'pbPricingContent';
                if($('#wp-'+pricingeditorID+'-wrap').hasClass("tmce-active")){
                    var pbPricingContent = tinyMCE.get(pricingeditorID).getContent({format : 'raw'});
                }else{
                    var pbPricingContent = $('#'+pricingeditorID).val();
                }


                btnicon = $('.pricingbtnSelectedIconpbicp-auto').val();
                if (btnicon != '') {
                 pricingbtnSelectedIcon = $('.pricingbtnSelectedIcon').children().attr('class');
                }else{
                 pricingbtnSelectedIcon = '';
                }


                this.model.set({
                    widgetPricing: {
                      pbPricingHeaderText: $('.pbPricingHeaderText').val(),
                      pbPricingContent: pbPricingContent,
                      pbPricingHeaderTextColor: $('.pbPricingHeaderTextColor').val(),
                      pbPricingHeaderBgColor: $('.pbPricingHeaderBgColor').val(),
                      pbPricingHeaderTextSize: $('.pbPricingHeaderTextSize').val(),
                      pbPricingBorderWidth: $('.pbPricingBorderWidth').val(),
                      pbPricingBorderColor: $('.pbPricingBorderColor').val(),
                      pbPricingButtonSectionBgColor: $('.pbPricingButtonSectionBgColor').val(),
                      pricingbtnText: $('.pricingbtnText').val(),
                      pricingbtnLink: $('.pricingbtnLink').val(),
                      pricingbtnTextColor: $('.pricingbtnTextColor').val(),
                      pricingbtnFontSize: $('.pricingbtnFontSize').val(),
                      pricingbtnFontSizeTablet:$('.pricingbtnFontSizeTablet').val(),
                      pricingbtnFontSizeMobile:$('.pricingbtnFontSizeMobile').val(),
                      pricingbtnBgColor: $('.pricingbtnBgColor').val(),
                      pricingbtnWidth: $('.pricingbtnWidth').val(),
                      pricingbtnWidthPercent: $('.pricingbtnWidthPercent').val(),
                      pricingbtnWidthPercentTablet:$('.pricingbtnWidthPercentTablet').val(),
                      pricingbtnWidthPercentMobile:$('.pricingbtnWidthPercentMobile').val(),
                      pricingbtnWidthUnit: $('.pricingbtnWidthUnit').val(),
                      pricingbtnWidthUnitTablet: $('.pricingbtnWidthUnitTablet').val(),
                      pricingbtnWidthUnitMobile: $('.pricingbtnWidthUnitMobile').val(),
                      pricingbtnHeight: $('.pricingbtnHeight').val(),
                      pricingbtnHeightTablet:$('.pricingbtnHeightTablet').val(),
                      pricingbtnHeightMobile:$('.pricingbtnHeightMobile').val(),
                      pricingbtnHoverBgColor: $('.pricingbtnHoverBgColor').val(),
                      pricingbtnHoverTextColor: $('.pricingbtnHoverTextColor').val(),
                      pricingbtnBlankAttr: $('.pricingbtnBlankAttr').val(),
                      pricingbtnBorderColor: $('.pricingbtnBorderColor').val(),
                      pricingbtnBorderWidth: $('.pricingbtnBorderWidth').val(),
                      pricingbtnBorderRadius: $('.pricingbtnBorderRadius').val(),
                      pricingbtnButtonAlignment: $('.pricingbtnButtonAlignment').val(),
                      pricingbtnButtonAlignmentTablet: $('.pricingbtnButtonAlignmentTablet').val(),
                      pricingbtnButtonAlignmentMobile: $('.pricingbtnButtonAlignmentMobile').val(),
                      pricingbtnButtonFontFamily: $('.pricingbtnButtonFontFamily').val(),
                      pricingbtnSelectedIcon: pricingbtnSelectedIcon,
                      pricingbtnIconPosition: $('.pricingbtnIconPosition').val(),
                      pricingbtnIconAnimation: $('.pricingbtnIconAnimation').val(),
                      pricingbtnIconGap: $('.pricingbtnIconGap').val(),
                    }
                });
            break;

            case 'wigt-pb-imgCarousel': 

                // Image Carousel Widget
                var pbCarouselSlideList = [];

                $('.carouselSlidesContainer li').each(function(index){
                    pbCarouselSlideList.push($( this ).children('.accordContentHolder').children('.carouselImgURL').val() );
                });


                var imgCarouselSlidesLink = [];

                $('.carouselSlidesContainer li').each(function(index){
                    imgCarouselSlidesLink.push($( this ).children('.accordContentHolder').children('.carouselImgLink').val() );
                });

                imgCarouselSlidesURL = pbCarouselSlideList;

                this.model.set({
                    widgetImgCarousel:{
                      pbImgCarouselSlides: $('.pbImgCarouselSlides').val(),
                      pbImgCarouselAutoplay: $('.pbImgCarouselAutoplay').val(),
                      pbImgCarouselDelay: $('.pbImgCarouselDelay').val(),
                      imgCarouselSlideLoop: $('.imgCarouselSlideLoop').val(),
                      imgCarouselSlideTransition: $('.imgCarouselSlideTransition').val(),
                      imgCarouselPagination: $('.imgCarouselPagination').val(),
                      pbImgCarouselNav: $('.pbImgCarouselNav').val(),
                      imgCarouselSlidesURL: imgCarouselSlidesURL,
                      imgCarouselSlidesLink:imgCarouselSlidesLink,
                    }
                });
            break;

            case 'wigt-pb-wooCommerceProducts': 
                this.model.set({
                    widgetWooPorducts:{
                      wooProductsColumn: $('.wooProductsColumn').val(),
                      wooProductsCount: $('.wooProductsCount').val(),
                      wooProductsCategories: $('.wooProductsCategories').val(),
                      wooProductsTags:$('.wooProductsTags').val(),
                      wooProductsOrderBy:$('.wooProductsOrderBy').val(),
                      wooProductsOrder:$('.wooProductsOrder').val(),
                    }
                });
            break;
            case 'wigt-pb-iconList':
                // iconList Widget


                if (updatedWidgetOpName != '' && typeof(updatedWidgetOpName) != 'undefined' && updatedWidgetOpName != ' ' ) {
                    var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();
                    
                    console.log(thischangedValue);

                    if (updatedWidgetOpName == 'slideListEdit') {
                        
                        var pbIconListAllItems = [];

                        $('.iconListItemsContainer li').each(function(index){
                            var thisListValues = {
                                iconListItemText: $( this ).children('.accordContentHolder').children('.iconListItemText').val(),
                                iconListItemIcon: $( this ).children('.accordContentHolder').children('.iconListItemIcon').val(),
                                iconListItemLink: $( this ).children('.accordContentHolder').children('.iconListItemLink').val(),
                                iconListItemLinkOpen: $( this ).children('.accordContentHolder').children('.iconListItemLinkOpen').val()
                            }
                            pbIconListAllItems.push( thisListValues );
                        });

                        pbIconListAllItemsArray = pbIconListAllItems;

                        updatedWidgetOpName = 'iconListComplete';
                        thischangedValue = pbIconListAllItemsArray;

                        renderIconListItemsList(pbIconListAllItemsArray);
                    }


                    if (typeof(thischangedValue) == 'undefined' ) {
                        break;
                    }

                    var thisWidgetDataAttrNew = _.clone(this.model.get('widgetIconList'));

                    setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                    this.model.set({
                        widgetIconList : thisWidgetDataAttrNew
                    }); // prev took 120-150ms / Now only 4-10ms

                    delete thisWidgetDataAttrNew;

                }





                /*
                this.model.set({
                    widgetIconList:{
                      iconListComplete: pbIconListAllItemsArray,
                      iconListLineHeight:$('.iconListLineHeight').val(),
                      iconListAlignment:$('.iconListAlignment').val(),
                      iconListIconSize:$('.iconListIconSize').val(),
                      iconListIconSizeTablet:$('.iconListIconSizeTablet').val(),
                      iconListIconSizeMobile:$('.iconListIconSizeMobile').val(),
                      iconListIconColor: $('.iconListIconColor').val(),
                      iconListTextSize:$('.iconListTextSize').val(),
                      iconListTextSizeTablet:$('.iconListTextSizeTablet').val(),
                      iconListTextSizeMobile:$('.iconListTextSizeMobile').val(),
                      iconListTextIndent:$('.iconListTextIndent').val(),
                      iconListTextIndentTablet:$('.iconListTextIndentTablet').val(),
                      iconListTextIndentMobile:$('.iconListTextIndentMobile').val(),
                      iconListTextColor:$('.iconListTextColor').val(),
                      iconListTextFontFamily:$('.iconListTextFontFamily').val(),
                    }
                });
                */
                
            break;
            case 'wigt-pb-spacer': 
                this.model.set({
                    widgetVerticalSpace:{
                      widgetVerticalSpaceValue: $('.widgetVerticalSpaceValue').val(),
                      widgetVerticalSpaceValueTablet:$('.widgetVerticalSpaceValueTablet').val(),
                      widgetVerticalSpaceValueMobile:$('.widgetVerticalSpaceValueMobile').val()
                    }
                });
            break;
            case 'wigt-pb-break': 
                this.model.set({
                    widgetBreaker:{
                      widgetBreakerStyle: $('.widgetBreakerStyle').val(),
                      widgetBreakerWeight: $('.widgetBreakerWeight').val(),
                      widgetBreakerColor: $('.widgetBreakerColor').val(),
                      widgetBreakerWidth: $('.widgetBreakerWidth').val(),
                      widgetBreakerAlignment: $('.widgetBreakerAlignment').val(),
                      widgetBreakerSpacing: $('.widgetBreakerSpacing').val(),
                    }
                });
            break;
            case 'wigt-pb-anchor': 
                this.model.set({
                    widgetAnchor:{
                      wdtanchorid: $('.wdtanchorid').val(),
                    }
                });
            break;
            case 'wigt-pb-formBuilder': 


                if (updatedWidgetOpName != '' && typeof(updatedWidgetOpName) != 'undefined' && updatedWidgetOpName != ' ' ) {

                    var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();
                    if (updatedWidgetOpName == 'formBuilderbtnSelectedIcon') {
                        thischangedValue = $('.formBuilderbtnSelectedIcon').children().attr('class');
                    }

                    
                    if (updatedWidgetOpName == 'slideListEdit') {

                        var thisWidgetDataAttrNew = _.clone(this.model.get('widgetFormBuilder'));
                        formBuilderMCGroupsList = 'false';
                        if (typeof(thisWidgetDataAttrNew['widgetPbFbFormMailChimp']['formBuilderMCGroupsList']) != 'undefined') {
                            if (thisWidgetDataAttrNew['widgetPbFbFormMailChimp']['formBuilderMCGroupsList'] != '') {
                                formBuilderMCGroupsList =  thisWidgetDataAttrNew['widgetPbFbFormMailChimp']['formBuilderMCGroupsList'];
                            }
                        }

                        formBuilderMRGroupsList = 'false';
                        console.log(thisWidgetDataAttrNew['widgetPbFbFormMailChimp']['formBuilderMRGroupsList']);
                        if (typeof(thisWidgetDataAttrNew['widgetPbFbFormMailChimp']['formBuilderMRGroupsList']) != 'undefined') {
                            if (thisWidgetDataAttrNew['widgetPbFbFormMailChimp']['formBuilderMRGroupsList'] != '') {
                                formBuilderMRGroupsList =  thisWidgetDataAttrNew['widgetPbFbFormMailChimp']['formBuilderMRGroupsList'];
                            }
                        }
                        
                        var pbFormBuilderAllFields = [];

                        $('.formFieldItemsContainer li').each(function(index){
                            var thisListValues = {
                                fbFieldType: $( this ).children('.accordContentHolder').children('.fbFieldType').val(),
                                thisFieldOptions: {
                                    fbFieldLabel: $( this ).children('.accordContentHolder').children('.thisFieldOptions').children('.fbFieldLabel').val(),
                                    fbFieldName: $( this ).children('.accordContentHolder').children('.thisFieldOptions').children('.fbFieldName').val(),
                                    fbFieldPlaceHolder: $( this ).children('.accordContentHolder').children('.thisFieldOptions').children('.fbFieldPlaceHolder').val(),
                                    fbFieldRequired: $( this ).children('.accordContentHolder').children('.thisFieldOptions').children('.fbFieldRequired').val(),
                                    fbFieldWidth: $( this ).children('.accordContentHolder').children('.thisFieldOptions').children('.fbFieldWidth').val(),
                                    multiOptionFieldValues: $( this ).children('.accordContentHolder').children('.multiOptionField').children('.multiOptionFieldValues').val(),
                                    fbtextareaRows: $( this ).children('.accordContentHolder').children('.textareaOptions').children('.fbtextareaRows').val(),
                                    displayFieldsInline: $( this ).children('.accordContentHolder').children('.multiOptionField').children('.displayFieldsInline').val(),
                                    fbFieldPreset: $( this ).children('.accordContentHolder').children('.thisFieldOptions').children('.fbFieldPreset').val(),
                                    fbTextContent: $( this ).children('.accordContentHolder').children('.textHtmlFeildOptions').children('.fbTextContent').val(),
                                    mcgrpftype: $( this ).children('.accordContentHolder').children('.mcgroupsFieldContainer').children('.mcgrpftype').val(),
                                    formBuilderMCFieldGroups: $( this ).children('.accordContentHolder').children('.mcgroupsFieldContainer').children('.formBuilderMCFieldGroupsDiv').children('.formBuilderMCFieldGroups').val(),
                                    mrgrpftype: $( this ).children('.accordContentHolder').children('.mrgroupsFieldContainer').children('.mrgrpftype').val(),
                                    formBuilderMRFieldGroups: $( this ).children('.accordContentHolder').children('.mrgroupsFieldContainer').children('.formBuilderMRFieldGroupsDiv').children('.formBuilderMRFieldGroups').val(),
                                }
                            }

                            pbFormBuilderAllFields.push( thisListValues );

                        });

                        pbFormBuilderAllFieldsArray = pbFormBuilderAllFields;

                        updatedWidgetOpName = 'widgetPbFbFormFeilds';
                        thischangedValue = pbFormBuilderAllFieldsArray;
                        renderFormBuilderFieldsList(pbFormBuilderAllFieldsArray,formBuilderMCGroupsList,formBuilderMRGroupsList);

                    }

                    if (typeof(thischangedValue) == 'undefined' ) {
                        break;
                    }

                    var thisWidgetDataAttrNew = _.clone(this.model.get('widgetFormBuilder'));

                    setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                    this.model.set({
                        widgetFormBuilder :thisWidgetDataAttrNew
                    }); // prev took 120-150ms / Now only 4-10ms

                    delete thisWidgetDataAttrNew;

                }

                /*  
                this.model.set({
                    widgetFormBuilder:{
                      widgetPbFbFormFeilds:pbFormBuilderAllFieldsArray, 
                      widgetPbFbFormFeildOptions: {
                            formBuilderFieldSize: $('.formBuilderFieldSize').val() ,
                            formBuilderFieldLabelDisplay: $('.formBuilderFieldLabelDisplay').val() ,
                            formBuilderFieldBgColor: $('.formBuilderFieldBgColor').val() ,
                            formBuilderFieldColor: $('.formBuilderFieldColor').val() ,
                            formBuilderFieldBorderColor: $('.formBuilderFieldBorderColor').val() ,
                            formBuilderFieldBorderWidth: $('.formBuilderFieldBorderWidth').val() ,
                            formBuilderFieldBorderRadius: $('.formBuilderFieldBorderRadius').val() ,
                            formBuilderLabelSize: $('.formBuilderLabelSize').val(),
                            formBuilderLabelSizeTablet: $('.formBuilderLabelSizeTablet').val(),
                            formBuilderLabelSizeMobile: $('.formBuilderLabelSizeMobile').val(),
                            formBuilderLabelColor:$('.formBuilderLabelColor').val(),
                            formBuilderFieldVGap:$('.formBuilderFieldVGap').val(),
                            formBuilderFieldHGap:$('.formBuilderFieldHGap').val(),
                            formBuilderFieldFontFamily:$('.formBuilderFieldFontFamily').val(),
                      },
                      widgetPbFbFormSubmitOptions:{
                            formBuilderBtnText: $('.formBuilderBtnText').val(),
                            formBuilderBtnSize: $('.formBuilderBtnSize').val(),
                            formBuilderBtnWidth: $('.formBuilderBtnWidth').val(),
                            formBuilderBtnBgColor: $('.formBuilderBtnBgColor').val(),
                            formBuilderBtnColor: $('.formBuilderBtnColor').val(),
                            formBuilderBtnHoverBgColor: $('.formBuilderBtnHoverBgColor').val(),
                            formBuilderBtnHoverTextColor: $('.formBuilderBtnHoverTextColor').val(),
                            formBuilderBtnFontSize: $('.formBuilderBtnFontSize').val(),
                            formBuilderBtnFontSizeTablet:$('.formBuilderBtnFontSizeTablet').val(),
                            formBuilderBtnFontSizeMobile:$('.formBuilderBtnFontSizeMobile').val(),
                            formBuilderBtnBorderWidth: $('.formBuilderBtnBorderWidth').val(),
                            formBuilderBtnBorderColor: $('.formBuilderBtnBorderColor').val(),
                            formBuilderBtnBorderRadius: $('.formBuilderBtnBorderRadius').val(),
                            formBuilderBtnAlignment: $('.formBuilderBtnAlignment').val(),
                            formBuilderBtnHGap: $('.formBuilderBtnHGap').val(),
                            formBuilderBtnVGap: $('.formBuilderBtnVGap').val(),
                            formBuilderbtnSelectedIcon:formBuilderbtnSelectedIcon,
                            formBuilderbtnIconPosition:$('.formBuilderbtnIconPosition').val(),
                            formBuilderbtnIconGap:$('.formBuilderbtnIconGap').val(),
                            formBuilderbtnIconAnimation:$('.formBuilderbtnIconAnimation').val(),
                            formBuilderBtnFontFamily:$('.formBuilderBtnFontFamily').val(),
                      },
                      widgetPbFbFormEmailOptions:{
                            formEmailformName: $('.formEmailformName').val(),
                            formEmailTo: $('.formEmailTo').val(),
                            formEmailfromEmail: $('.formEmailfromEmail').val(),
                            formEmailSubject: $('.formEmailSubject').val(),
                            formEmailFromEmail: $('.formEmailFromEmail').val(),
                            formEmailName: $('.formEmailName').val(),
                            formEmailFormat: $('.formEmailFormat').val(),
                            formSuccessMessage: $('.formSuccessMessage').val(),
                            formSuccessAction:$('.formSuccessAction').val(),
                            formSuccessActionURL:$('.formSuccessActionURL').val(),
                            formSuccessCustomAction:$('.formSuccessCustomAction').val(),
                            onSuccessOptin:$('.onSuccessOptin').val(),
                            formDuplicateMessage: $('.formDuplicateMessage').val(),
                            formDuplicateCustomAction: $('.formDuplicateCustomAction').val(),
                            formFailureMessage: $('.formFailureMessage').val(),
                            formRequiredFieldMessage: $('.formRequiredFieldMessage').val(),
                            formFailureCustomAction: $('.formFailureCustomAction').val(),
                      },
                      widgetPbFbFormMailChimp: {
                         formBuilderEnableMailChimp: $('.formBuilderEnableMailChimp').val(),
                         formBuilderMCAccountName: $('.formBuilderMCAccountName').val(),
                         formBuilderMCApiKey: $('.formBuilderMCApiKey').val(),
                         formBuilderMCDoubleOptin: $('.formBuilderMCDoubleOptin').val(),
                         formBuilderMCGroups: $('.formBuilderMCGroups').val(),
                         formBuilderMCTags: $('.formBuilderMCTags').val(),
                         formBuilderEnableGetResponse: $('.formBuilderEnableGetResponse').val(),
                         formBuilderGRAccountName: $('.formBuilderGRAccountName').val(),
                         formBuilderGRApiKey: $('.formBuilderGRApiKey').val(),
                         formBuilderEnableCM: $('.formBuilderEnableCM').val(),
                         formBuilderCMAccountName: $('.formBuilderCMAccountName').val(),
                         formBuilderCMApiKey: $('.formBuilderCMApiKey').val(),
                         formBuilderEnableAC: $('.formBuilderEnableAC').val(),
                         formBuilderACAccountName: $('.formBuilderACAccountName').val(),
                         formBuilderACApiKey: $('.formBuilderACApiKey').val(),
                         formBuilderACApiUrl: $('.formBuilderACApiUrl').val(),
                         formBuilderEnableDrip: $('.formBuilderEnableDrip').val(),
                         formBuilderDripAccountName: $('.formBuilderDripAccountName').val(),
                         formBuilderDripApiKey: $('.formBuilderDripApiKey').val(),
                         formBuilderEnableAweber: $('.formBuilderEnableAweber').val(),
                         formBuilderAweberList: $('.formBuilderAweberList').val(),
                         formBuilderEnableConvertKit: $('.formBuilderEnableConvertKit').val(),
                         formBuilderConvertKitApiKey: $('.formBuilderConvertKitApiKey').val(),
                         formBuilderConvertKitAccountName: $('.formBuilderConvertKitAccountName').val(),
                         wfb_cWebHook:$('.wfb_cWebHook').val(),
                         wfb_cWebHookURL:$('.wfb_cWebHookURL').val(),
                         wfb_cWebHookSuccResponse:$('.wfb_cWebHookSuccResponse').val(),
                         wfb_cWebHookType: $('.wfb_cWebHookType').val(),
                         fbgreCaptcha:$('.fbgreCaptcha').val(), // Google Captcha
                         fbgreCSiteKey:$('.fbgreCSiteKey').val(), // Google Captcha
                         fbgreCSiteSecret:$('.fbgreCSiteSecret').val(),
                         wfbMHEnable: $('.wfbMHEnable').val(), // Market Hero Enable
                         wfbMHApiKey:$('.wfbMHApiKey').val(),
                         wfbSibEnable: $('.wfbSibEnable').val(), // SendInBlue Enable
                         wfbSibApiKey:$('.wfbSibApiKey').val(),
                         wfbSibListIds:$('.wfbSibListIds').val(),
                         wfbMPEnable: $('.wfbMPEnable').val(), // MailPoet  Enable
                         wfbMPList:$('.wfbMPList').val(),
                         wfbMPConfEmail:$('.wfbMPConfEmail').val(),
                         wfbMPWelcEmail:$('.wfbMPWelcEmail').val(),
                         wfbCCEnable: $('.wfbCCEnable').val(), // ContantContact  Enable
                         wfbCCLists:$('.wfbCCLists').val(),
                      },
                      widgetPbFbFormAllowDuplicates:$('.widgetPbFbFormAllowDuplicates').val(),
                      formCustomHTML:$('.formCustomHTML').val(),
                    }
                });
                */
            break;
            case 'wigt-pb-text': 

                if (updatedWidgetOpName != '' && typeof(updatedWidgetOpName) != 'undefined' && updatedWidgetOpName != ' ' ) {
                    var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();
                    if (updatedWidgetOpName == 'widgetTextBold' || updatedWidgetOpName == 'widgetTextItalic' || updatedWidgetOpName == 'widgetTextUnderlined') {
                        thischangedValue = false;
                        if( $('.'+updatedWidgetOpName).is(':checked') ){
                            thischangedValue = true;
                        }
                    }

                    
                    if (updatedWidgetOpName == 'widgetTextContent') {
                        var wlteditorID = 'widgetTextContent';
                        if($('#wp-'+wlteditorID+'-wrap').hasClass("tmce-active")){
                            var thischangedValue = tinyMCE.get(wlteditorID).getContent({format : 'raw'});
                        }else{
                            var thischangedValue = $('#'+wlteditorID).val();
                      }

                    }
                   

                    if (typeof(thischangedValue) == 'undefined' ) {
                        break;
                    }

                    var thisWidgetDataAttrNew = _.clone(this.model.get('widgetText'));

                    setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                    this.model.set({
                        widgetText : thisWidgetDataAttrNew
                    }); // prev took 120-150ms / Now only 4-10ms

                    delete thisWidgetDataAttrNew;

                    thischangedValue = '';
                    //console.log(updatedWidgetOpName);
                    //console.log(thischangedValue);
                    
                }
            

                /*
                this.model.set({
                    widgetText:{
                      widgetTextContent:  $('.widgetTextContent').val(),
                      widgetTextAlignment: $('.widgetTextAlignment').val(),
                      widgetTextAlignmentTablet: $('.widgetTextAlignmentTablet').val(),
                      widgetTextAlignmentMobile: $('.widgetTextAlignmentMobile').val(),
                      widgetTextTag: $('.widgetTextTag').val(),
                      wtextLink: $('.wtextLink').val(),
                      widgetTextColor: $('.widgetTextColor').val(),
                      widgetTextSize: $('.widgetTextSize').val(),
                      widgetTextFamily: $('.widgetTextFamily').val(),
                      widgetTextWeight: $('.widgetTextWeight').val(),
                      widgetTextTransform: $('.widgetTextTransform').val(),
                      widgetTextLineHeight: $('.widgetTextLineHeight').val(),
                      widgetTextSpacing: $('.widgetTextSpacing').val(),
                      widgetTextBold: widgetTextBold,
                      widgetTextItalic: widgetTextItalic,
                      widgetTextUnderlined: widgetTextUnderlined,
                      widgetTextSizeTablet:$('.widgetTextSizeTablet').val(),
                      widgetTextSizeMobile:$('.widgetTextSizeMobile').val(),
                      widgetTextLineHeightTablet:$('.widgetTextLineHeightTablet').val(),
                      widgetTextLineHeightMobile:$('.widgetTextLineHeightMobile').val(),
                      widgetTextSpacingTablet:$('.widgetTextSpacingTablet').val(),
                      widgetTextSpacingMobile:$('.widgetTextSpacingMobile').val()
                    }
                });
                */ // Improvements : Decreased lag from 20 ms to 4ms.
                
                var widgetCurrentType = 'widgetText';
            break;
            case 'wigt-pb-liveText': 

              var wlteditorID = 'wltc';
              if($('#wp-'+wlteditorID+'-wrap').hasClass("tmce-active")){
                var widgetLiveTextEditorData = tinyMCE.get(wlteditorID).getContent({format : 'raw'});
              }else{
                var widgetLiveTextEditorData = $('#'+wlteditorID).val();
              }

              wltfs = this.model.get('wLText');
              wltfs = wltfs['wltfs'];
              this.model.set({
                wLText:{
                  wltc:  widgetLiveTextEditorData,
                  wltfs:  wltfs,
                }
              });
            break;
            case 'wigt-pb-embededVideo':

                var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();
                if (typeof(thischangedValue) == 'undefined' ) {
                    break;
                }

                var thisWidgetDataAttrNew = _.clone(this.model.get('widgetEmbedVideo'));

                setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                this.model.set({
                        widgetEmbedVideo : thisWidgetDataAttrNew
                }); // prev took 120-150ms / Now only 4-10ms

                delete thisWidgetDataAttrNew;

                /*
                this.model.set({
                    widgetEmbedVideo:{
                      widgetEvidVideoType: $('.widgetEvidVideoType').val(),
                      widgetEvidVideoLink: $('.widgetEvidVideoLink').val(),
                      widgetEvidVideoAutoplay:$('.widgetEvidVideoAutoplay').val(),
                      widgetEvidVideoPlayerControls:$('.widgetEvidVideoPlayerControls').val(),
                      widgetEvidVideoTitle:$('.widgetEvidVideoTitle').val(),
                      widgetEvidVideoSuggested:$('.widgetEvidVideoSuggested').val(),
                      widgetEvidImageOverlay: $('.widgetEvidImageOverlay').val(),
                      widgetEvidImageUrl:$('.widgetEvidImageUrl').val(),
                      widgetEvidImageIcon:$('.widgetEvidImageIcon').val(),
                      widgetEvidImageIconColor:$('.widgetEvidImageIconColor').val(),
                      widgetEvidImageLightbox:$('.widgetEvidImageLightbox').val()
                    }
                });
                */
            break;
            case 'wigt-pb-popupClose':

                closeBtnBold = false; 
                closeBtnItalic = false;
                closeBtnUnderlined = false;
                if( $('.closeBtnBold').is(':checked') ){
                    closeBtnBold = true;
                }
                if( $('.closeBtnItalic').is(':checked') ){
                    closeBtnItalic = true;
                }
                if( $('.closeBtnUnderlined').is(':checked') ){
                    closeBtnUnderlined = true;
                }

                this.model.set({
                  widgetClosePopUp:{
                    closeBtnText: $('.closeBtnText').val(),
                    closeBtnTextColor: $('.closeBtnTextColor').val(),
                    closeBtnFontSize: $('.closeBtnFontSize').val(),
                    closeBtnFontSizeTablet:$('.closeBtnFontSizeTablet').val(),
                    closeBtnFontSizeMobile:$('.closeBtnFontSizeMobile').val(),
                    closeBtnColor: $('.closeBtnColor').val(),
                    closeBtnBgColor: $('.closeBtnBgColor').val(),
                    closeBtnWidth: $('.closeBtnWidth').val(),
                    closeBtnWidthPercent:$('.closeBtnWidthPercent').val(),
                    closeBtnWidthUnit: $('.closeBtnWidthUnit').val(),
                    closeBtnWidthUnitTablet: $('.closeBtnWidthUnitTablet').val(),
                    closeBtnWidthUnitMobile: $('.closeBtnWidthUnitMobile').val(),
                    closeBtnWidthPercentTablet:$('.closeBtnWidthPercentTablet').val(),
                    closeBtnWidthPercentMobile:$('.closeBtnWidthPercentMobile').val(),
                    closeBtnHeight: $('.closeBtnHeight').val(),
                    closeBtnHeightTablet:$('.closeBtnHeightTablet').val(),
                    closeBtnHeightMobile:$('.closeBtnHeightMobile').val(),
                    closeBtnHoverBgColor: $('.closeBtnHoverBgColor').val(),
                    closeBtnHoverColor: $('.closeBtnHoverColor').val(),
                    closeBtnBlankAttr: $('.closeBtnBlankAttr').val(),
                    closeBtnBorderColor: $('.closeBtnBorderColor').val(),
                    closeBtnBorderWidth: $('.closeBtnBorderWidth').val(),
                    closeBtnBorderRadius: $('.closeBtnBorderRadius').val(),
                    closeBtnButtonAlignment: $('.closeBtnButtonAlignment').val(),
                    closeBtnButtonFontFamily: $('.closeBtnButtonFontFamily').val(),
                    closeBtnBold: closeBtnBold,
                    closeBtnItalic: closeBtnItalic,
                    closeBtnUnderlined: closeBtnUnderlined,
                    }
                });
            break;
            case 'wigt-pb-testimonialCarousel': 

                // Image Carousel Widget
                var testimonialsList = [];
                $('.testimonialCarSlidesContainer li').each(function(index){
                  var thisListValues = {
                    fbFieldType: $( this ).children('.accordContentHolder').children('.fbFieldType').val(),
                    tct:$( this ).children('.accordContentHolder').children('.tct').val(),
                    tcn:$( this ).children('.accordContentHolder').children('.tcn').val(),
                    tcj:$( this ).children('.accordContentHolder').children('.tcj').val(),
                    tcl:$( this ).children('.accordContentHolder').children('.tcl').val(),
                    tci:$( this ).children('.accordContentHolder').children('.tci').val(),
                    tcia:$( this ).children('.accordContentHolder').children('.tcia').val(),
                    tcit:$( this ).children('.accordContentHolder').children('.tcit').val(),
                  };
                  testimonialsList.push( thisListValues );
                });

                this.model.set({
                    widgetTCarousel:{
                      tCarOps:{
                        tCarAutoplay: $('.tCarAutoplay').val(),
                        tCarDelay: $('.tCarDelay').val(),
                        tCarSlideLoop: $('.tCarSlideLoop').val(),
                        tCarSlideTransition: $('.tCarSlideTransition').val(),
                        tCarPagination: $('.tCarPagination').val(),
                        tCarNav: $('.tCarNav').val(),
                        tNSlides: $('.tNSlides').val(),
                      },
                      tCarSlides: testimonialsList,
                      tDesignOps:{
                        tcic: $('.tcic').val(),
                        tcis: $('.tcis').val(),
                        tcist: $('.tcist').val(),
                        tcism: $('.tcism').val(),
                        tcntc: $('.tcntc').val(),
                        tcntf: $('.tcntf').val(),
                        tcnts: $('.tcnts').val(),
                        tcntst: $('.tcntst').val(),
                        tcntsm: $('.tcntsm').val(),
                        tcttc: $('.tcttc').val(),
                        tcttf: $('.tcttf').val(),
                        tctts: $('.tctts').val(),
                        tcttst: $('.tcttst').val(),
                        tcttsm: $('.tcttsm').val(),
                        tcca: $('.tcca').val(),
                        tcir: $('.tcir').val(),
                        tcisi: $('.tcisi').val(),
                      }
                    }
                });
            break;
            case 'wigt-pb-poOptins':


                var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();
                if (typeof(thischangedValue) == 'undefined' ) {
                    break;
                }

                var thisWidgetDataAttrNew = _.clone(this.model.get('widgetPoOptins'));

                setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                this.model.set({
                        widgetPoOptins : thisWidgetDataAttrNew
                }); // prev took 120-150ms / Now only 4-10ms

                delete thisWidgetDataAttrNew;
            break;
            case 'wigt-pb-navmenu':





                if (updatedWidgetOpName != '' && typeof(updatedWidgetOpName) != 'undefined' && updatedWidgetOpName != ' ' ) {
                    var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();
                    

                    if (updatedWidgetOpName == 'slideListEdit') {
                        
                        var pbNavListAllItems = [];

                        $('.customNavItemsContainer li').each(function(index){
                            var thisListValues = {
                                cnilab: $( this ).children('.accordContentHolder').children('.cnilab').val(),
                                cniurl: $( this ).children('.accordContentHolder').children('.cniurl').val(),
                            }
                            pbNavListAllItems.push( thisListValues );
                        });

                        pbNavListAllItemsArray = pbNavListAllItems;

                        updatedWidgetOpName = 'navItems';
                        thischangedValue = pbNavListAllItemsArray;

                        renderNavBuilderItems(pbNavListAllItemsArray);
                    }


                    if (typeof(thischangedValue) == 'undefined' ) {
                        break;
                    }

                    var thisWidgetDataAttrNew = _.clone(this.model.get('widgetNavBuilder'));

                    setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                    this.model.set({
                        widgetNavBuilder : thisWidgetDataAttrNew
                    }); // prev took 120-150ms / Now only 4-10ms

                    delete thisWidgetDataAttrNew;

                }

                /*
                    var pbNavListAllItems = [];

                    $('.customNavItemsContainer li').each(function(index){
                        var thisListValues = {
                            cnilab: $( this ).children('.accordContentHolder').children('.cnilab').val(),
                            cniurl: $( this ).children('.accordContentHolder').children('.cniurl').val(),
                        }
                        pbNavListAllItems.push( thisListValues );
                    });

                    this.model.set({
                        widgetNavBuilder:{
                          navItems: pbNavListAllItems,
                          navStyle: { // custom nav styles
                            cnsfc: $('.cnsfc').val(),
                            cnsfhc: $('.cnsfhc').val(),
                            cnsbc: $('.cnsbc').val(),
                            cnshbc: $('.cnshbc').val(),
                            cnsnic: $('.cnsnic').val(),
                            cnsfs: $('.cnsfs').val(),
                            cnsfst: $('.cnsfst').val(),
                            cnsfsm: $('.cnsfsm').val(),
                            cnslg: $('.cnslg').val(),
                            cnslh: $('.cnslh').val(),
                            cnsff: $('.cnsff').val(),
                            cnslourl: $('.cnslourl').val(),
                            cnslos: $('.cnslos').val(),
                            cnslayout: $('.cnslayout').val(),
                            cnsalign: $('.cnsalign').val(),
                            cnsresop:$('.cnsresop').val(), // responsive option
                          }
                        }
                    });
                */



            break;
            case 'wigt-pb-gallery':

                if (updatedWidgetOpName != '' && typeof(updatedWidgetOpName) != 'undefined' && updatedWidgetOpName != ' ' ) {

                    var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();


                    
                    if (updatedWidgetOpName == 'slideListEdit') {
                        
                        var allGalleryItems = [];

                        $('.customImageGalleryItems li').each(function(index){
                            var thisListValues = {
                                gur: $( this ).children('.accordContentHolder').children('.gallItemUrl').val(),
                                gti: $( this ).children('.accordContentHolder').children('.gallItemTitle').val(),
                                gca: $( this ).children('.accordContentHolder').children('.gallItemCaption').val(),
                            }
                            allGalleryItems.push( thisListValues );

                        });


                        updatedWidgetOpName = 'gallItems';
                        thischangedValue = allGalleryItems;
                        renderImageGalleryImageList(allGalleryItems);

                    }

                    if (typeof(thischangedValue) == 'undefined' ) {
                        break;
                    }



                    var thisWidgetDataAttrNew = _.clone(this.model.get('widgetIGallery'));

                    setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                    this.model.set({
                        widgetIGallery :thisWidgetDataAttrNew
                    }); // prev took 120-150ms / Now only 4-10ms

                    delete thisWidgetDataAttrNew;

                }


                /*
                this.model.set({
                    widgetIGallery:{
                        gallItems: allGalleryItems,
                        gallStyles:{
                            wgType: $('.wgType').val(),
                            wgGC: $('.wgGC').val(),
                            wgGCT: $('.wgGCT').val(),
                            wgGCM: $('.wgGCM').val(),
                            wgGCG: $('.wgGCG').val(),
                            wgISD: $('.wgISD').val(),
                            wgICW: $('.wgICW').val(),
                            wgICWT: $('.wgICWT').val(),
                            wgICWM: $('.wgICWM').val(),
                            wgICH: $('.wgICH').val(),
                            wgICHT: $('.wgICHT').val(),
                            wgICHM: $('.wgICHM').val(),
                        }
                    }
                });
                */

            break;
            case 'wigt-pb-shareThis':

                var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();
                if (typeof(thischangedValue) == 'undefined' ) {
                    break;
                }

                var thisWidgetDataAttrNew = _.clone(this.model.get('widgetShareThis'));

                setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                this.model.set({
                        widgetShareThis : thisWidgetDataAttrNew
                }); // prev took 120-150ms / Now only 4-10ms

                delete thisWidgetDataAttrNew;

                /*
                this.model.set({
                    widgetShareThis:{
                      wdtstId: $('.wdtstId').val(),
                      wdtstbt: $('.wdtstbt').val(),
                    }
                });
                */
            break;
            case 'wigt-pb-tabs':

                if (updatedWidgetOpName != '' && typeof(updatedWidgetOpName) != 'undefined' && updatedWidgetOpName != ' ' ) {

                    var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();

                    
                    if (updatedWidgetOpName == 'slideListEdit') {
                        
                        var alltabItems = [];

                        $('.tabItemsContainer li').each(function(index){

                            var editorID = 'tabEditor_'+index;
                            if($('#wp-'+editorID+'-wrap').hasClass("tmce-active")){
                                var accContent = tinyMCE.get(editorID).getContent({format : 'raw'});
                            }else{
                                var accContent = $('#'+editorID).val();
                            }

                            var thisListValues = {
                                title: $( this ).children('.accordContentHolder').children('.title').val(),
                                icon: $( this ).children('.accordContentHolder').children('.tabItemsIcon').val(),
                                content: accContent,
                            }
                            alltabItems.push( thisListValues );

                        });


                        updatedWidgetOpName = 'tabItems';
                        thischangedValue = alltabItems;
                        rendertabWidgetItems(alltabItems);

                    }

                    if (updatedWidgetOpName.indexOf('tabEditor') != -1) {
                        editorID = updatedWidgetOpName;
                        updatedWidgetOpName = $('#'+editorID).attr('data-optname');

                        if($('#wp-'+editorID+'-wrap').hasClass("tmce-active")){
                            thischangedValue = tinyMCE.get(editorID).getContent({format : 'raw'});
                        }else{
                            thischangedValue = $('#'+editorID).val();
                        }

                    }


                    if (typeof(thischangedValue) == 'undefined' ) {
                        break;
                    }



                    var thisWidgetDataAttrNew = _.clone(this.model.get('widgetTabs'));

                    setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                    this.model.set({
                        widgetTabs :thisWidgetDataAttrNew
                    }); // prev took 120-150ms / Now only 4-10ms

                    delete thisWidgetDataAttrNew;

                }

            break;
            case 'wigt-pb-accordion':

                if (updatedWidgetOpName != '' && typeof(updatedWidgetOpName) != 'undefined' && updatedWidgetOpName != ' ' ) {

                    var thischangedValue = $('[data-optname="'+updatedWidgetOpName+'"]').val();

                    
                    if (updatedWidgetOpName == 'slideListEdit') {
                        
                        var allAccordionItems = [];

                        $('.accordionItemsContainer li').each(function(index){

                            var editorID = 'accordionEditor_'+index;
                            if($('#wp-'+editorID+'-wrap').hasClass("tmce-active")){
                                var accContent = tinyMCE.get(editorID).getContent({format : 'raw'});
                            }else{
                                var accContent = $('#'+editorID).val();
                            }

                            var thisListValues = {
                                accoTitle: $( this ).children('.accordContentHolder').children('.accoTitle').val(),
                                accContent: accContent,
                            }
                            allAccordionItems.push( thisListValues );

                        });


                        updatedWidgetOpName = 'accordionItems';
                        thischangedValue = allAccordionItems;
                        renderAccordionWidgetItems(allAccordionItems);

                    }

                    if (updatedWidgetOpName.indexOf('accordionEditor') != -1) {
                        editorID = updatedWidgetOpName;
                        updatedWidgetOpName = $('#'+editorID).attr('data-optname');

                        if($('#wp-'+editorID+'-wrap').hasClass("tmce-active")){
                            thischangedValue = tinyMCE.get(editorID).getContent({format : 'raw'});
                        }else{
                            thischangedValue = $('#'+editorID).val();
                        }

                    }


                    if (typeof(thischangedValue) == 'undefined' ) {
                        break;
                    }



                    var thisWidgetDataAttrNew = _.clone(this.model.get('widgetAccordion'));

                    setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                    this.model.set({
                        widgetAccordion :thisWidgetDataAttrNew
                    }); // prev took 120-150ms / Now only 4-10ms

                    delete thisWidgetDataAttrNew;

                }

            break;
            default :  break;

            //$('.isChagesMade').val('true');
        } // prev took 40-60ms
    }
    

    // var tuc1 = performance.now();
    //console.log("Call to updateWidgetTrigger took " + (tuc1 - tuc0) + " milliseconds.");

    var thisWidgetDataAttr = this.model.attributes;
    var thisColFontsToLoad = [];

    //console.log( JSON.stringify(thisWidgetDataAttr) );

    currentlyEditedColId = pageBuilderApp.currentlyEditedColId;
    currentlyEditedWidgId = pageBuilderApp.currentlyEditedWidgId;
    currentlyEditedThisCol = pageBuilderApp.currentlyEditedThisCol;
    currentlyEditedThisRow = pageBuilderApp.currentlyEditedThisRow;


    var renderredWidget = completeWidgetRender(thisWidgetDataAttr,currentlyEditedWidgId, currentlyEditedThisCol , currentlyEditedThisRow, thisColFontsToLoad ); // takes about 5-10 ms 


    $('#'+currentlyEditedColId+' '+'.widget-'+currentlyEditedWidgId).replaceWith(renderredWidget['WidgetHtml']); // takes 2ms 


    $('#'+currentlyEditedColId+' '+'.widget-'+currentlyEditedWidgId + ' #thisRenderredWidgetScritps ').html(renderredWidget['WidgetScript']); // takes 70ms cuz of scripts execution.
    
    
    $('#'+currentlyEditedThisRow+'-'+currentlyEditedThisCol + ' .widget-Draggable').mouseenter(function(ev){
      $(this).children('.widgetHandle').css('display','block');

      if (pageBuilderApp.copiedWidgOps == '') {
        jQuery('.widgetPasteHandle').css('display','none');
      }
    });

    $('#'+currentlyEditedThisRow+'-'+currentlyEditedThisCol + ' .widget-Draggable').mouseleave(function(){
      $('.widgetHandle').css('display','none');
    });
    
    enabledraggableWidgets();


    if (pageBuilderApp.dontSendToStack != true) {
        var thisChangeRedoProps = {
            changeModelType : 'widget',
            thisModelElId:currentlyEditedThisRow,
            thisColId:currentlyEditedThisCol,
            thisWidgetId:currentlyEditedWidgId,
            changedOpType:updateWidgetOpType,
            changedOpName:updatedWidgetOpName,
            changedOpValue:pageBuilderApp.prevStateOption,
        }

        sendDataBackToUndoStack(thisChangeRedoProps);
    }
        

    pageBuilderApp.dontSendToStack = false;
    pageBuilderApp.isInlineSavingActive = false;
    pageBuilderApp.ifChangesMade = true;
     

    // prev total took 250-330ms
  },
  reRenderWidget: function(){

        var thisWidgetDataAttr = this.model.attributes;
        var thisColFontsToLoad = [];

        //console.log( JSON.stringify(thisWidgetDataAttr) );

        currentlyEditedColId = pageBuilderApp.currentlyEditedColId;
        currentlyEditedWidgId = pageBuilderApp.currentlyEditedWidgId;
        currentlyEditedThisCol = pageBuilderApp.currentlyEditedThisCol;
        currentlyEditedThisRow = pageBuilderApp.currentlyEditedThisRow;

        var renderredWidget = completeWidgetRender(thisWidgetDataAttr,currentlyEditedWidgId, currentlyEditedThisCol , currentlyEditedThisRow, thisColFontsToLoad ); // takes about 5-10 ms 


        $('#'+currentlyEditedColId+' '+'.widget-'+currentlyEditedWidgId).replaceWith(renderredWidget['WidgetHtml']); // takes 2ms 


        $('#'+currentlyEditedColId+' '+'.widget-'+currentlyEditedWidgId + ' #thisRenderredWidgetScritps ').html(renderredWidget['WidgetScript']); // takes 70ms cuz of scripts execution.
        
        
        $('#'+currentlyEditedThisRow+'-'+currentlyEditedThisCol + ' .widget-Draggable').mouseenter(function(ev){
          $(this).children('.widgetHandle').css('display','block');

          if (pageBuilderApp.copiedWidgOps == '') {
            jQuery('.widgetPasteHandle').css('display','none');
          }
        });

        $('#'+currentlyEditedThisRow+'-'+currentlyEditedThisCol + ' .widget-Draggable').mouseleave(function(){
          $('.widgetHandle').css('display','none');
        });
        
        // make a function for making widgets draggable. 
        enabledraggableWidgets();
  },
  duplicateWidget: function () {
      newModel = this.model.clone();
      var modelIndex = pageBuilderApp.widgetList.indexOf(this.model);
      pageBuilderApp.widgetList.add(newModel.attributes, {at: modelIndex+1});
      $(this.el).html('');
      this.render();
      ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
        currentEditableColId = jQuery('.currentEditableColId').val();
        jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSave').trigger('click');
        jQuery('#'+pageBuilderApp.currentlyEditedColId).children('.wdgt-colChange').trigger('click');
          $('.ulpb_column_controls').css('display','none');
          hideWidgetOpsPanel();
          $('.pageops_modal').css('display','none');
          $('.edit_column').css('display','none');
          $('.insertRowBlock').css('display','none');

          pageBuilderApp.ifChangesMade = true;
          //$('.isChagesMade').val('true');
  },
  updateWidgetTemplate: function(ev){
        var blockName = $(ev.target).attr('data-selected_widget_template');
        var widgetBlock = '';
        var modelIndex = $('.insertwidgBlockAtIndex').val();

        var thisWidgetPrevAttrs = this.model.clone();
        var widgetMtop = this.model.get('widgetMtop');
        var widgetMbottom = this.model.get('widgetMbottom');
        var widgetMleft = this.model.get('widgetMleft');
        var widgetMright = this.model.get('widgetMright');
        var widgetMarginTablet = this.model.get('widgetMarginTablet');
        var widgetMarginMobile = this.model.get('widgetMarginMobile');

        


        modelIndex = parseInt(modelIndex);
        $.ajax({
          type: 'GET',
          dataType: "json",
          url: widgetViewLinks.pluginsUrl+'/admin/scripts/blocks/widgetBlocks/'+blockName+''+".json",
          data: { get_param: 'value' },
          success: function( data ) {
            widgetBlock = data;
          },
          error: function(  thrownError ) {
            alert('Some Error Occurred :'+thrownError);
          },
          async:false
        });

        if ( widgetBlock !='' ) {

            if ( this.model.get('widgetType') == 'wigt-pb-text') {
                contents = this.model.get('widgetText');
                widgetBlock['widgetText']['widgetTextContent'] = contents['widgetTextContent'];
            }


            if ( this.model.get('widgetType') == 'wigt-pb-formBuilder' ) {
                var prevModelClone = _.clone(this.model.attributes);
                widgetBlock['widgetFormBuilder']['widgetPbFbFormEmailOptions'] = prevModelClone['widgetFormBuilder']['widgetPbFbFormEmailOptions'];
                widgetBlock['widgetFormBuilder']['widgetPbFbFormMailChimp'] = prevModelClone['widgetFormBuilder']['widgetPbFbFormMailChimp'];
                delete prevModelClone;
            }

            this.model.set(widgetBlock);

            this.model.set({
                widgetMtop:widgetMtop,
                widgetMleft:widgetMleft,
                widgetMbottom:widgetMbottom,
                widgetMright:widgetMright,
                widgetMarginTablet:widgetMarginTablet,
                widgetMarginMobile:widgetMarginMobile,
            });


            currentlyEditedColId = pageBuilderApp.currentlyEditedColId;
            currentlyEditedWidgId = pageBuilderApp.currentlyEditedWidgId;
            currentlyEditedThisCol = pageBuilderApp.currentlyEditedThisCol;
            currentlyEditedThisRow = pageBuilderApp.currentlyEditedThisRow;

            var specialAction = 'widgetTemplate';
            var thisChangeRedoProps = {
            changeModelType : 'widgetSpecialAction',
            specialAction:specialAction,
            thisModelElId:currentlyEditedThisRow,
            thisColId:currentlyEditedThisCol,
            thisWidgetId:currentlyEditedWidgId,
            changedOpValue:JSON.stringify(thisWidgetPrevAttrs),
            }

            sendDataBackToUndoStack(thisChangeRedoProps);


            ColcurrentEditableRowID = $('.ColcurrentEditableRowID').val();
            currentEditableColId = $('.currentEditableColId').val();
            $('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

            $(this.el).html('');
            this.render();
            this.reRenderWidget();
            this.EditWidget();

            pageBuilderApp.ifChangesMade = true;
            $('.popb_confirm_action_popup').css('display','none');
            
        }
  },
  addWidgetTemplateStateToUndoRedo: function(ev){

        var widgetBlock = '';
        var modelIndex = pageBuilderApp.thisUndoRedoProps['thisWidgetId'];

        if ( pageBuilderApp.widgetList.indexOf(this.model) != pageBuilderApp.currentlyEditedWidgId) {
            pageBuilderApp.currentlyEditedWidgId = modelIndex;
        }

        var thisWidgetPrevAttrs = this.model.clone();
        var widgetMtop = this.model.get('widgetMtop');
        var widgetMbottom = this.model.get('widgetMbottom');
        var widgetMleft = this.model.get('widgetMleft');
        var widgetMright = this.model.get('widgetMright');
        var widgetMarginTablet = this.model.get('widgetMarginTablet');
        var widgetMarginMobile = this.model.get('widgetMarginMobile');

        
        widgetBlock = pageBuilderApp.thisUndoRedoProps['changedOpValue'];



        modelIndex = parseInt(modelIndex);
        

        if ( widgetBlock !='' ) {

            widgetBlock = JSON.parse(widgetBlock);

            if ( this.model.get('widgetType') == 'wigt-pb-text') {
                contents = this.model.get('widgetText');
                widgetBlock['widgetText']['widgetTextContent'] = contents['widgetTextContent'];
            }


            if ( this.model.get('widgetType') == 'wigt-pb-formBuilder' ) {
                var prevModelClone = _.clone(this.model.attributes);
                widgetBlock['widgetFormBuilder']['widgetPbFbFormEmailOptions'] = prevModelClone['widgetFormBuilder']['widgetPbFbFormEmailOptions'];
                widgetBlock['widgetFormBuilder']['widgetPbFbFormMailChimp'] = prevModelClone['widgetFormBuilder']['widgetPbFbFormMailChimp'];
                delete prevModelClone;
            }

            this.model.set(widgetBlock);

            this.model.set({
                widgetMtop:widgetMtop,
                widgetMleft:widgetMleft,
                widgetMbottom:widgetMbottom,
                widgetMright:widgetMright,
                widgetMarginTablet:widgetMarginTablet,
                widgetMarginMobile:widgetMarginMobile,
            });


            currentlyEditedColId = pageBuilderApp.currentlyEditedColId;
            currentlyEditedWidgId = pageBuilderApp.currentlyEditedWidgId;
            currentlyEditedThisCol = pageBuilderApp.currentlyEditedThisCol;
            currentlyEditedThisRow = pageBuilderApp.currentlyEditedThisRow;

            var specialAction = 'widgetTemplate';
            var thisChangeRedoProps = {
            changeModelType : 'widgetSpecialAction',
            specialAction:specialAction,
            thisModelElId:currentlyEditedThisRow,
            thisColId:currentlyEditedThisCol,
            thisWidgetId:modelIndex,
            changedOpValue:JSON.stringify(thisWidgetPrevAttrs),
            }

            sendDataBackToUndoStack(thisChangeRedoProps);


            ColcurrentEditableRowID = $('.ColcurrentEditableRowID').val();
            currentEditableColId = $('.currentEditableColId').val();
            $('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

            delete thisWidgetPrevAttrs;
            
            
            this.reRenderWidget();
            $('.popb_confirm_action_popup').css('display','none');
            

            pageBuilderApp.thisUndoRedoProps = '';
            pageBuilderApp.currentlyEditedColId = '';
            pageBuilderApp.currentlyEditedWidgId = '';
            pageBuilderApp.currentlyEditedThisCol = '';
            pageBuilderApp.currentlyEditedThisRow = '';
        }
  },
  pasteCopiedOptions: function(ev){

    if (pageBuilderApp.copiedWidgOps != '') {

        var thisWidgetPrevAttrs = this.model.clone();

        var thisWidgetType = this.model.get('widgetType');

        var thisWidgetName = getRealWidgetType(thisWidgetType);
        var thisWidgetProps = this.model.get(thisWidgetName);

        var copiedWidget = JSON.parse(pageBuilderApp.copiedWidgOps);
        var copiedWidgetName = getRealWidgetType(copiedWidget['widgetType']);
        delete copiedWidget[copiedWidgetName];
        copiedWidget['widgetType'] = thisWidgetType;
        copiedWidget[thisWidgetName] = thisWidgetProps;

        this.model.set(copiedWidget);


        var thisWidgetDataAttr = this.model.attributes;
        var thisColFontsToLoad = [];

        currentlyEditedColId = pageBuilderApp.currentlyEditedColId;
        currentlyEditedWidgId = pageBuilderApp.currentlyEditedWidgId;
        currentlyEditedThisCol = pageBuilderApp.currentlyEditedThisCol;
        currentlyEditedThisRow = pageBuilderApp.currentlyEditedThisRow;


        var specialAction = 'widgetOps';
        var thisChangeRedoProps = {
            changeModelType : 'widgetSpecialAction',
            specialAction:specialAction,
            thisModelElId:currentlyEditedThisRow,
            thisColId:currentlyEditedThisCol,
            thisWidgetId:currentlyEditedWidgId,
            changedOpValue:JSON.stringify(thisWidgetPrevAttrs),
        }

        sendDataBackToUndoStack(thisChangeRedoProps);

        this.reRenderWidget();


        ColcurrentEditableRowID = $('.ColcurrentEditableRowID').val();
        currentEditableColId = $('.currentEditableColId').val();
        $('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

        $(this.el).html('');
        this.render();
        $('.popb_confirm_action_popup').css('display','none');

        hideWidgetOpsPanel();
        jQuery('.edit_column').css('display','none');

        pageBuilderApp.currentlyEditedColId = '';
        pageBuilderApp.currentlyEditedWidgId = '';
        pageBuilderApp.currentlyEditedThisCol = '';
        pageBuilderApp.currentlyEditedThisRow = '';

        pageBuilderApp.ifChangesMade = true;
    }

  },
  updateInlineTextChanges: function(ev){

    //console.log('updateInlineTextChanges')

    //var tuc0 = performance.now();
    console.log(pageBuilderApp.copiedInlineOps);
    if (pageBuilderApp.copiedInlineOps != '') {
        
        thisWidgetType = this.model.get('widgetType');
        passedWidgetData = pageBuilderApp.copiedInlineOps;

        if (passedWidgetData['widgetType'] == 'wigt-pb-liveText' && thisWidgetType == 'wigt-pb-liveText') {

            thisWidgetDefault = this.model.get('wLText');

            this.model.set({
                wLText:{
                  wltc:  passedWidgetData['wltc'],
                  wltfs:  passedWidgetData['wltfs'],
                }
            });


            var editorID = 'wltc';
            if ($('#wp-'+editorID+'-wrap').hasClass("tmce-active"))
                tinyMCE.get(editorID).setContent(passedWidgetData['wltc']);
            else
              $('#'+editorID).val(passedWidgetData['wltc']);


            if (typeof(thisWidgetDefault['wltc']) == 'undefined') { thisWidgetDefault['wltc'] = ''; }
            if (typeof(thisWidgetDefault['wltfs']) == 'undefined') { thisWidgetDefault['wltfs'] = ''; }

            passedWidgetData['wltc'] = thisWidgetDefault['wltc'];
            passedWidgetData['wltfs'] = thisWidgetDefault['wltfs'];

        } else if (passedWidgetData['widgetType'] == 'wigt-pb-accordion' && thisWidgetType == 'wigt-pb-accordion'){

            thisWidgetDefault = _.clone( this.model.get('widgetAccordion') );
            passedWidgetData = _.clone( pageBuilderApp.copiedInlineOps );
            thisWidgetDefault.accordionItems[passedWidgetData.editedFieldIndex].accContent = passedWidgetData.widgetContent;

            this.model.set({
                widgetAccordion :thisWidgetDefault
            }); // prev took 120-150ms / Now only 4-10ms


        } else if (passedWidgetData['widgetType'] == 'wigt-pb-tabs' && thisWidgetType == 'wigt-pb-tabs'){

            thisWidgetDefault = _.clone( this.model.get('widgetTabs') );
            passedWidgetData = _.clone( pageBuilderApp.copiedInlineOps );
            thisWidgetDefault.tabItems[passedWidgetData.editedFieldIndex].content = passedWidgetData.widgetContent;

            this.model.set({
                widgetTabs :thisWidgetDefault
            }); // prev took 120-150ms / Now only 4-10ms


        } else if (passedWidgetData['widgetType'] == 'wigt-btn-gen' && thisWidgetType == 'wigt-btn-gen') {
            thisWidgetDefault = this.model.get('widgetButton');
            if (typeof(passedWidgetData['btnClickAction']) != 'undefined') {
                thisWidgetDefault['btnClickAction'] = '';
                thisWidgetDefault['btnWidgetPopUpId'] = '';
            }


            this.model.set({
                widgetButton:{
                  btnText: passedWidgetData['btnText'],
                  btnLink: thisWidgetDefault['btnLink'],
                  btnClickAction: thisWidgetDefault['btnClickAction'],
                  btnWidgetPopUpId:thisWidgetDefault['btnWidgetPopUpId'],
                  btnTextColor: thisWidgetDefault['btnTextColor'],
                  btnCAction: thisWidgetDefault['btnCAction'],
                  btnFontSize: thisWidgetDefault['btnFontSize'],
                  btnFontSizeTablet:thisWidgetDefault['btnFontSizeTablet'],
                  btnFontSizeMobile:thisWidgetDefault['btnFontSizeMobile'],
                  btnBgColor: thisWidgetDefault['btnBgColor'],
                  btnWidth: thisWidgetDefault['btnWidth'],
                  btnWidthPercent: thisWidgetDefault['btnWidthPercent'],
                  btnWidthPercentTablet:thisWidgetDefault['btnWidthPercentTablet'],
                  btnWidthPercentMobile:thisWidgetDefault['btnWidthPercentMobile'],
                  btnWidthUnit: thisWidgetDefault['btnWidthUnit'],
                  btnWidthUnitTablet: thisWidgetDefault['btnWidthUnitTablet'],
                  btnWidthUnitMobile: thisWidgetDefault['btnWidthUnitMobile'],
                  btnHeight: thisWidgetDefault['btnHeight'],
                  btnHeightTablet:thisWidgetDefault['btnHeightTablet'],
                  btnHeightMobile:thisWidgetDefault['btnHeightMobile'],
                  btnHoverBgColor: thisWidgetDefault['btnHoverBgColor'],
                  btnHoverTextColor: thisWidgetDefault['btnHoverTextColor'],
                  btnBlankAttr: thisWidgetDefault['btnBlankAttr'],
                  btnBorderColor: thisWidgetDefault['btnBorderColor'],
                  btnBorderWidth: thisWidgetDefault['btnBorderWidth'],
                  btnBorderRadius: thisWidgetDefault['btnBorderRadius'],
                  btnButtonAlignment: thisWidgetDefault['btnButtonAlignment'],
                  btnButtonAlignmentTablet: thisWidgetDefault['btnButtonAlignmentTablet'],
                  btnButtonAlignmentMobile: thisWidgetDefault['btnButtonAlignmentMobile'],
                  btnButtonFontFamily: thisWidgetDefault['btnButtonFontFamily'],
                  btnSelectedIcon: thisWidgetDefault['btnSelectedIcon'],
                  btnIconPosition: thisWidgetDefault['btnIconPosition'],
                  btnIconAnimation: thisWidgetDefault['btnIconAnimation'],
                  btnIconGap: thisWidgetDefault['btnIconGap'],
                }
            });

            $('.btnText').val(passedWidgetData['btnText']);

            passedWidgetData['btnText'] = thisWidgetDefault['btnText'];

        } else if (passedWidgetData['widgetType'] == 'wigt-WYSIWYG' && thisWidgetType == 'wigt-WYSIWYG') {
            
            thisWidgetDefault = this.model.get('widgetWYSIWYG');
            
            this.model.set({
                widgetWYSIWYG: {
                  widgetContent:passedWidgetData['widgetContent'],
                  widgetContentFonts: passedWidgetData['widgetContentFonts'],
                }
            });


            var editorID = 'columnContent';
            if ($('#wp-'+editorID+'-wrap').hasClass("tmce-active"))
                tinyMCE.get(editorID).setContent(passedWidgetData['widgetContent']);
            else
              $('#'+editorID).val(passedWidgetData['widgetContent']);


            passedWidgetData['widgetContent'] = thisWidgetDefault['widgetContent'];
            passedWidgetData['widgetContentFonts'] = thisWidgetDefault['widgetContentFonts'];

        } else if (passedWidgetData['widgetType'] == 'wigt-pb-text' && thisWidgetType == 'wigt-pb-text') {

            thisWidgetDefault = this.model.get('widgetText');
            if ( typeof(passedWidgetData['widgetTextAlignment']) == 'undefined') {
                passedWidgetData['widgetTextAlignment'] = false;
            }
            if ( passedWidgetData['widgetTextAlignment'] == false || passedWidgetData['widgetTextAlignment'] == '') {
                passedWidgetData['widgetTextAlignment'] = thisWidgetDefault['widgetTextAlignment'];
            }

            this.model.set({
                widgetText:{
                  widgetTextContent:  passedWidgetData['widgetTextContent'],
                  widgetTextAlignment: passedWidgetData['widgetTextAlignment'],
                  widgetTextAlignmentTablet: thisWidgetDefault['widgetTextAlignmentTablet'],
                  widgetTextAlignmentMobile: thisWidgetDefault['widgetTextAlignmentMobile'],
                  widgetTextTag: thisWidgetDefault['widgetTextTag'],
                  wtextLink: thisWidgetDefault['wtextLink'],
                  widgetTextColor: thisWidgetDefault['widgetTextColor'],
                  widgetTextSize: thisWidgetDefault['widgetTextSize'],
                  widgetTextFamily: thisWidgetDefault['widgetTextFamily'],
                  widgetTextWeight: thisWidgetDefault['widgetTextWeight'],
                  widgetTextTransform: thisWidgetDefault['widgetTextTransform'],
                  widgetTextLineHeight: thisWidgetDefault['widgetTextLineHeight'],
                  widgetTextSpacing: thisWidgetDefault['widgetTextSpacing'],
                  widgetTextBold: thisWidgetDefault['widgetTextBold'],
                  widgetTextItalic: thisWidgetDefault['widgetTextItalic'],
                  widgetTextUnderlined: thisWidgetDefault['widgetTextUnderlined'],
                  widgetTextSizeTablet:thisWidgetDefault['widgetTextSizeTablet'],
                  widgetTextSizeMobile:thisWidgetDefault['widgetTextSizeMobile'],
                  widgetTextLineHeightTablet:thisWidgetDefault['widgetTextLineHeightTablet'],
                  widgetTextLineHeightMobile:thisWidgetDefault['widgetTextLineHeightMobile'],
                  widgetTextSpacingTablet:thisWidgetDefault['widgetTextSpacingTablet'],
                  widgetTextSpacingMobile:thisWidgetDefault['widgetTextSpacingMobile']
                }
            });

            $('.widgetTextContent').val(passedWidgetData['widgetTextContent']);
            $('.widgetTextAlignment').val(passedWidgetData['widgetTextAlignment']);

            passedWidgetData['widgetTextContent'] = thisWidgetDefault['widgetTextContent'];
            passedWidgetData['widgetTextAlignment'] = thisWidgetDefault['widgetTextAlignment'];

        } else if (passedWidgetData['widgetType'] == 'wigt-pb-pricing' && thisWidgetType == 'wigt-pb-pricing') {
            
            thisWidgetDefault = this.model.get('widgetPricing');
            this.model.set({
                widgetPricing: {
                  pbPricingHeaderText: passedWidgetData['pbPricingHeaderText'],
                  pbPricingContent: passedWidgetData['pbPricingContent'],
                  pbPricingHeaderTextColor: thisWidgetDefault['pbPricingHeaderTextColor'],
                  pbPricingHeaderBgColor: thisWidgetDefault['pbPricingHeaderBgColor'],
                  pbPricingHeaderTextSize: thisWidgetDefault['pbPricingHeaderTextSize'],
                  pbPricingBorderWidth: thisWidgetDefault['pbPricingBorderWidth'],
                  pbPricingBorderColor: thisWidgetDefault['pbPricingBorderColor'],
                  pbPricingButtonSectionBgColor: thisWidgetDefault['pbPricingButtonSectionBgColor'],
                  pricingbtnText: passedWidgetData['pricingbtnText'],
                  pricingbtnLink: thisWidgetDefault['pricingbtnLink'],
                  pricingbtnTextColor: thisWidgetDefault['pricingbtnTextColor'],
                  pricingbtnFontSize: thisWidgetDefault['pricingbtnFontSize'],
                  pricingbtnFontSizeTablet:thisWidgetDefault['pricingbtnFontSizeTablet'],
                  pricingbtnFontSizeMobile:thisWidgetDefault['pricingbtnFontSizeMobile'],
                  pricingbtnBgColor: thisWidgetDefault['pricingbtnBgColor'],
                  pricingbtnWidth: thisWidgetDefault['pricingbtnWidth'],
                  pricingbtnWidthPercent: thisWidgetDefault['pricingbtnWidthPercent'],
                  pricingbtnWidthPercentTablet:thisWidgetDefault['pricingbtnWidthPercentTablet'],
                  pricingbtnWidthPercentMobile:thisWidgetDefault['pricingbtnWidthPercentMobile'],
                  pricingbtnWidthUnit: thisWidgetDefault['pricingbtnWidthUnit'],
                  pricingbtnWidthUnitTablet: thisWidgetDefault['pricingbtnWidthUnitTablet'],
                  pricingbtnWidthUnitMobile: thisWidgetDefault['pricingbtnWidthUnitMobile'],
                  pricingbtnHeight: thisWidgetDefault['pricingbtnHeight'],
                  pricingbtnHeightTablet:thisWidgetDefault['pricingbtnHeightTablet'],
                  pricingbtnHeightMobile:thisWidgetDefault['pricingbtnHeightMobile'],
                  pricingbtnHoverBgColor: thisWidgetDefault['pricingbtnHoverBgColor'],
                  pricingbtnHoverTextColor: thisWidgetDefault['pricingbtnHoverTextColor'],
                  pricingbtnBlankAttr: thisWidgetDefault['pricingbtnBlankAttr'],
                  pricingbtnBorderColor: thisWidgetDefault['pricingbtnBorderColor'],
                  pricingbtnBorderWidth: thisWidgetDefault['pricingbtnBorderWidth'],
                  pricingbtnBorderRadius: thisWidgetDefault['pricingbtnBorderRadius'],
                  pricingbtnButtonAlignment: thisWidgetDefault['pricingbtnButtonAlignment'],
                  pricingbtnButtonAlignmentTablet: thisWidgetDefault['pricingbtnButtonAlignmentTablet'],
                  pricingbtnButtonAlignmentMobile: thisWidgetDefault['pricingbtnButtonAlignmentMobile'],
                  pricingbtnButtonFontFamily: thisWidgetDefault['pricingbtnButtonFontFamily'],
                  pricingbtnSelectedIcon: thisWidgetDefault['pricingbtnSelectedIcon'],
                  pricingbtnIconPosition: thisWidgetDefault['pricingbtnIconPosition'],
                  pricingbtnIconAnimation: thisWidgetDefault['pricingbtnIconAnimation'],
                  pricingbtnIconGap: thisWidgetDefault['pricingbtnIconGap'],
                }
            });

            $('.pbPricingHeaderText').val(passedWidgetData['pbPricingHeaderText']);
            $('.pricingbtnText').val(passedWidgetData['pricingbtnText']);

            var editorID = 'pbPricingContent';
            if ($('#wp-'+editorID+'-wrap').hasClass("tmce-active"))
                tinyMCE.get(editorID).setContent(passedWidgetData['pbPricingContent']);
            else
              $('#'+editorID).val(passedWidgetData['pbPricingContent']);


            passedWidgetData['pbPricingHeaderText'] = thisWidgetDefault['pbPricingHeaderText'];
            passedWidgetData['pbPricingContent'] = thisWidgetDefault['pbPricingContent'];
            passedWidgetData['pricingbtnText'] = thisWidgetDefault['pricingbtnText'];

        } else if (passedWidgetData['widgetType'] == 'wigt-pb-navmenu' && thisWidgetType == 'wigt-pb-navmenu') {
            
            thisWidgetDefault = this.model.get('widgetNavBuilder');

            navItems = thisWidgetDefault['navItems'];

            if (passedWidgetData['editedFieldName'] == 'cnilab') {

                var changedNavItems = [];
                $.each(navItems, function(index, val){

                    var thisListValues = {
                        cnilab: val['cnilab'],
                        cniurl: val['cniurl'],
                    }
                    if ( index == passedWidgetData['editedFieldIndex'] ) {
                        var thisListValues = {
                            cnilab: passedWidgetData['widgetContent'],
                            cniurl: val['cniurl'],
                        }
                    }

                    changedNavItems.push( thisListValues );

                });

            }

            this.model.set({
                widgetNavBuilder:{
                  navItems: changedNavItems,
                  navStyle: thisWidgetDefault['navStyle']
                }
            });

            passedWidgetData['navItems'] = thisWidgetDefault['navItems'];

        } else if (passedWidgetData['widgetType'] == 'wigt-pb-cards' && thisWidgetType == 'wigt-pb-cards'){
            
            thisWidgetDefault = this.model.get('widgetCard');

            if (passedWidgetData['editedFieldName'] == 'pbCardTitle') {
                pbCardTitle = passedWidgetData['widgetContent'];
                passedWidgetData['pbCardTitle'] = thisWidgetDefault['pbCardTitle'];
            }else{
                pbCardTitle = thisWidgetDefault['pbCardTitle'];
            }

            if (passedWidgetData['editedFieldName'] == 'pbCardDesc') {
                pbCardDesc = passedWidgetData['widgetContent'];
                passedWidgetData['pbCardDesc'] = thisWidgetDefault['pbCardDesc'];
            }else{
                pbCardDesc = thisWidgetDefault['pbCardDesc'];
            }

            this.model.set({
                widgetCard:{
                  pbSelectedCardIcon: thisWidgetDefault['pbSelectedCardIcon'],
                  pbCardIconSize: thisWidgetDefault['pbCardIconSize'],
                  pbCardIconRotation: thisWidgetDefault['pbCardIconRotation'],
                  pbCardIconColor: thisWidgetDefault['pbCardIconColor'],
                  pbCardTitleColor: thisWidgetDefault['pbCardTitleColor'],
                  pbCardTitleSize: thisWidgetDefault['pbCardTitleSize'],
                  pbCardDescColor: thisWidgetDefault['pbCardDescColor'],
                  pbCardDescSize: thisWidgetDefault['pbCardDescSize'],
                  pbCardTitle: pbCardTitle,
                  pbCardDesc: pbCardDesc,
                  pbCardTitleSizeTablet: thisWidgetDefault['pbCardTitleSizeTablet'],
                  pbCardTitleSizeMobile: thisWidgetDefault['pbCardTitleSizeMobile'],
                  pbCardDescSizeTablet: thisWidgetDefault['pbCardDescSizeTablet'],
                  pbCardDescSizeMobile: thisWidgetDefault['pbCardDescSizeMobile'],
                }
            });

            $('.pbCardTitle').val(pbCardTitle);
            $('.pbCardDesc').val(pbCardDesc);


        } else if (passedWidgetData['widgetType'] == 'wigt-pb-formBuilder' && thisWidgetType == 'wigt-pb-formBuilder') {
            thisWidgetDefault = this.model.get('widgetFormBuilder');

            wfsops = thisWidgetDefault['widgetPbFbFormSubmitOptions'];

            this.model.set({
                widgetFormBuilder:{
                  widgetPbFbFormFeilds:thisWidgetDefault['widgetPbFbFormFeilds'], 
                  widgetPbFbFormFeildOptions: thisWidgetDefault['widgetPbFbFormFeildOptions'],
                  widgetPbFbFormSubmitOptions:{
                    formBuilderBtnText: passedWidgetData['btnText'],
                    formBuilderBtnSize: wfsops['formBuilderBtnSize'], 
                    formBuilderBtnWidth: wfsops['formBuilderBtnWidth'], 
                    formBuilderBtnBgColor: wfsops['formBuilderBtnBgColor'], 
                    formBuilderBtnColor: wfsops['formBuilderBtnColor'], 
                    formBuilderBtnHoverBgColor: wfsops['formBuilderBtnHoverBgColor'], 
                    formBuilderBtnHoverTextColor: wfsops['formBuilderBtnHoverTextColor'], 
                    formBuilderBtnFontSize: wfsops['formBuilderBtnFontSize'], 
                    formBuilderBtnFontSizeTablet: wfsops['formBuilderBtnFontSizeTablet'],
                    formBuilderBtnFontSizeMobile: wfsops['formBuilderBtnFontSizeMobile'],
                    formBuilderBtnBorderWidth: wfsops['formBuilderBtnBorderWidth'], 
                    formBuilderBtnBorderColor: wfsops['formBuilderBtnBorderColor'], 
                    formBuilderBtnBorderRadius: wfsops['formBuilderBtnBorderRadius'], 
                    formBuilderBtnAlignment: wfsops['formBuilderBtnAlignment'], 
                    formBuilderBtnHGap: wfsops['formBuilderBtnHGap'], 
                    formBuilderBtnVGap: wfsops['formBuilderBtnVGap'], 
                    formBuilderbtnSelectedIcon: wfsops['formBuilderbtnSelectedIcon'],
                    formBuilderbtnIconPosition: wfsops['formBuilderbtnIconPosition'],
                    formBuilderbtnIconGap: wfsops['formBuilderbtnIconGap'],
                    formBuilderbtnIconAnimation: wfsops['formBuilderbtnIconAnimation'],
                    formBuilderBtnFontFamily: wfsops['formBuilderBtnFontFamily'],
                  },
                  widgetPbFbFormEmailOptions:thisWidgetDefault['widgetPbFbFormEmailOptions'],
                  widgetPbFbFormMailChimp: thisWidgetDefault['widgetPbFbFormMailChimp'],
                  widgetPbFbFormAllowDuplicates: thisWidgetDefault['widgetPbFbFormAllowDuplicates'],
                  formCustomHTML: thisWidgetDefault['formCustomHTML'],
                }
            });

            $('.formBuilderBtnText').val(passedWidgetData['btnText']);

            passedWidgetData['btnText'] = wfsops['formBuilderBtnText'];

        } else if (passedWidgetData['widgetType'] == 'wigt-img' && thisWidgetType == 'wigt-img') {
            
            thisWidgetDefault = this.model.get('widgetImg');


            var thischangedValue = passedWidgetData['captionText'];
            
            var updatedWidgetOpName = 'imgwcap';

            if (typeof(thischangedValue) !== 'undefined' ) {
                var thisWidgetDataAttrNew = _.clone(this.model.get('widgetImg'));

                setUpdateObject(thisWidgetDataAttrNew, updatedWidgetOpName, thischangedValue);

                this.model.set({
                    widgetImg : thisWidgetDataAttrNew
                }); // prev took 120-150ms / Now only 4-10ms

                delete thisWidgetDataAttrNew;

            }

            $('.imgwcap').val(passedWidgetData['captionText']);

            passedWidgetData['captionText'] = thisWidgetDefault['imgwcap'];

        }



        pageBuilderApp.copiedInlineOps = '';
        ColcurrentEditableRowID = $('.ColcurrentEditableRowID').val();
        currentEditableColId = $('.currentEditableColId').val();
        $('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

        pageBuilderApp.currentlyEditedWidgId = passedWidgetData['thisWidgetId'];

        if (pageBuilderApp.changeFromUndoAction == true || pageBuilderApp.changeFromRedoAction == true) {
            this.reRenderWidget();

            pageBuilderApp.currentlyEditedColId = '';
            pageBuilderApp.currentlyEditedWidgId = '';
            pageBuilderApp.currentlyEditedThisCol = '';
            pageBuilderApp.currentlyEditedThisRow = '';
        }
        

        var thisChangeRedoProps = {
            changeModelType : 'widgetSpecialAction',
            specialAction:'inlineOps',
            thisModelElId:ColcurrentEditableRowID,
            thisColId:currentEditableColId,
            thisWidgetId:passedWidgetData['thisWidgetId'],
            changedOpValue:passedWidgetData,
        }

        sendDataBackToUndoStack(thisChangeRedoProps);

        pageBuilderApp.isInlineSavingActive = false;

    }

    //var tuc1 = performance.now();
    //console.log("Call to updateInlineTextChanges took " + (tuc1 - tuc0) + " milliseconds.");
  },

});

}( jQuery ) );