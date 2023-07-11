( function( $ ) {

// Column Widgets drag/drop
$(function(){

    
  try {
      // statements
    
    $('.wdt-draggable').draggable({revert: true,cursor: "move",appendTo: "#container",
      helper: function(){

        innerHTMLOfDraggedEl = $(this).html();
        helperel = $(
          '<div class="widgetDragHelper" style=" width:110px;padding: 5px 0px; background: rgb(236 245 252); border-radius: 5px; z-index:9998; border:1px dashed #a7bad3; text-align:center"> '+innerHTMLOfDraggedEl+' </div>'
        );

        return helperel;

      },
      stop: function(){
        $('.droppableBelowWidget').css('display','none');
      },
      start: function(event,ui){
        console.log(ui);
        $(this).draggable('instance').offset.click = {
          left: Math.floor(ui.helper.width() / 2) +15,
          top: Math.floor(ui.helper.height() / 2) + 15
        }; 
        pageBuilderApp.isDefaultWidget = true;
        currentWidgetType = $(event.target).attr('data-type');
        
        switch(currentWidgetType){
          case 'wigt-WYSIWYG': 
              thisWidgetAttr = 'widgetWYSIWYG';
              thisWidgetAttrValues = {    
                widgetContent: '<h2>Add some text, Image or anything you like :)</h2>'
              };
          break;
          case 'wigt-img': 
              thisWidgetAttr = 'widgetImg';
              var thisWidgetAttrValues = {
                    imgUrl: pluginURL+'/images/dashboard/placeholder.jpg',
                    imgSize: 'medium',
                    imgAlignment: 'center',
                    imgSizeCustomWidth: '',
                    imgSizeCustomHeight: '',
                    imgLightBox: 'false',
                  };
          break;
          case 'wigt-menu':
              thisWidgetAttr = 'widgetMenu';
              var thisWidgetAttrValues = {
                    menuName: 'Select',
                    menuStyle: 'menu-style-1',
                    menuColor: '#333',
                    pbMenuFontFamily: 'Select',
                    pbMenuFontHoverColor: '#eee',
                    pbMenuFontHoverBgColor:'#e3e3e3',
                    pbMenuFontSize: '16',
                  };
          break;
          case 'wigt-btn-gen': 
            thisWidgetAttr = 'widgetButton';
              var thisWidgetAttrValues = {
                btnBgColor: "#699cfc",
                btnBlankAttr: "_self",
                btnBorderColor: "#699cfc",
                btnBorderRadius: "2",
                btnBorderWidth: "0",
                btnButtonAlignment: "center",
                btnButtonFontFamily: "Montserrat",
                btnClickAction: "openLink",
                btnFontSize: "17",
                btnFontSizeMobile: "",
                btnFontSizeTablet: "",
                btnHeight: "18",
                btnHeightMobile: "",
                btnHeightTablet: "",
                btnHoverBgColor: "rgb(91, 137, 223)",
                btnHoverColor: "#fff",
                btnHoverTextColor: "rgb(255, 255, 255)",
                btnLink: "#",
                btnText: "Click Here",
                btnTextColor: "#fff",
                btnWidth: "50",
                btnWidthPercent: "170",
                btnWidthPercentMobile: "",
                btnWidthPercentTablet: "",
                btnWidthUnit: "px",
                btnWidthUnitMobile: "px",
                btnWidthUnitTablet: "px",
              };
          break;

          case 'wigt-pb-form':
            thisWidgetAttr = 'widgetSubscribeForm';
              thisWidgetAttrValues = {
                pbFormID: 'ulpb_form'+Math.floor((Math.random() * 20000) + 100),
                formLayout: 'stacked',
                showNameField: 'block',
                successAction:'showMessage',
                successURL:'',
                successMessage:'Thanks for subscribing! Please check your email for further instructions.',
                formBtnText:'Subscribe',
                formBtnHeight:'20',
                formBtnWidth:'40',
                formBtnBgColor:'#d9534f',
                formBtnColor:'#fff',
                formBtnHoverBgColor:'#d9534f',
                formBtnHoverTextColor:'',
                formBtnFontSize:'16',
                formBtnBorderWidth:'0',
                formBtnBorderColor:'#d9534f',
                formBtnBorderRadius:'5',
                formBtnFontFamily:'select',
                formSuccessMessageColor: '#333',
                formDataSaveType: 'database',
                formDataMailChimpApi:'',
                formDataMailChimpListId:'',
              };
          break;

          case 'wigt-video': 
            thisWidgetAttr = 'widgetVideo';
              thisWidgetAttrValues = {    
                videoWebM: '',
                videoMpfour: '',
                videoThumb: '',
                vidAutoPlay: 'no',
                vidLoop: 'no',
                vidControls: 'controls'
              };
          break;
          case 'wigt-pb-postSlider': 
            thisWidgetAttr = 'widgetPBPostsSlider';
              thisWidgetAttrValues = {    
                psAutoplay: 'false',
                psSlideDelay: '1',
                psSlideLoop: 'true',
                psSlideTransition: 'fade',
                psPostsNumber: '10',
                psDots: 'true',
                psArrows: 'true',
                psFtrImage: 'initial',
                psFtrImageSize: 'medium',
                psExcerpt: 'initial',
                psReadMore: 'none',
                psMoreLinkText: 'Read More',
                psHeadingSize: '24',
                psTextAlignment: 'center',
                psBgColor: '#55acef',
                psTxtColor: '#fff',
                psHeadingTxtColor: '#fff',
                psPostType: 'post',
                psPostsOrderBy: 'date',
                psPostsOrder: 'Descending',
                psPostsFilterBy: 'none',
                psFilterValue: ' '
              };
          break;
          case 'wigt-pb-icons': 
            thisWidgetAttr = 'widgetIcons';
              thisWidgetAttrValues = {    
                pbSelectedIcon: 'fas fa-star',
                pbIcStyle: 'none',
                pbIconSize: '48',
                pbIconRotation: '0',
                pbIconColor: 'rgb(105, 156, 252)',
                pbIconLink:'',
                pbIcBgC:'rgb(237, 237, 237)',
                pbIcBC:'rgb(237, 237, 237)',
                pbIcBW:'0',
                pbIcBR:'5',
                pbIcSHP:'',
                pbIcSVP:'',
                pbIcSDB:'',
                pbIcSC:'',
                pbIcHC:'',
                pbIcHBgC:'',
                pbIcHAn:'',
              };
          break;
          case 'wigt-pb-counter':
            thisWidgetAttr = 'widgetCounter';
              thisWidgetAttrValues = {
                pbCounterID: 'ulpb_counter'+Math.floor((Math.random() * 20000) + 100),
                counterStartingNumber: '0',
                counterEndingNumber: '100',
                counterNumberPrefix: '',
                counterNumberSuffix: '',
                counterAnimationTime: '1000',
                counterTitle: 'Cool Counter',
                counterTextColor: '#333',
                counterTitleColor: '#333',
                counterNumberFontSize: '36',
                counterTitleFontSize: '34',
              };
          break;
          case 'wigt-pb-audio': 
            thisWidgetAttr = 'widgetAudio';
              thisWidgetAttrValues = {    
                audioOgg: '',
                audioMpThree: '',
                audioAutoPlay: 'no',
                audioLoop: 'no',
                audioControls: 'controls'
              };
          break;
          case 'wigt-pb-cards': 
            thisWidgetAttr = 'widgetCard';
              thisWidgetAttrValues = {    
                pbSelectedCardIcon: 'fa-archive',
                pbCardIconSize: '55',
                pbCardIconRotation: '0',
                pbCardIconColor: '#545e77',
                pbCardTitleColor: '#545e77',
                pbCardTitleSize: '24',
                pbCardTitleSizeTablet: '',
                pbCardTitleSizeMobile: '',
                pbCardDescColor: '#545e77',
                pbCardDescSize: '16',
                pbCardDescSizeTablet:'',
                pbCardDescSizeMobile:'',
                pbCardTitle: 'This is the heading',
                pbCardDesc: 'This is the description',
              };
          break;
          case 'wigt-pb-testimonial': 
            thisWidgetAttr = 'widgetTestimonial';
              thisWidgetAttrValues = {    
                tsAuthorName: 'John Doe',
                tsJob: 'CEO',
                tsCompanyName: 'Example Company',
                tsTestimonial: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                tsUserImg: '',
                tsImageShape: '0',
                tsIconColor: '#333',
                tsIconSize: '45',
                tsTextColor: '#333',
                tsTextSize: '14',
                tsTestimonialColor: '#333',
                tsTestimonialSize:'18',
                tsTextAlignment: 'center',
              };
          break;
          case 'wigt-pb-shortcode': 
            thisWidgetAttr = 'widgetShortCode';
              thisWidgetAttrValues = {    
                shortCodeInput: '<h2> Add your shortcode for widget to render it. <h2>',
              };
          break;
          case 'wigt-pb-countdown': 
            thisWidgetAttr = 'widgetCowntdown';
              thisWidgetAttrValues = {
                pbCountDownDate: '',
                pbCountDownHour: '',
                pbCountDownMinute: '',
                pbCountDownLabel: '',
                pbCountDownColor: '#333',
                pbCountDownLabelColor: '#333',
                pbCountDownTextSize: '21',
                pbCountDownTextSizeTablet:'',
                pbCountDownTextSizeMobile:'',
                pbCountDownLabelTextSize: '18',
                pbCountDownLabelTextSizeTablet:'',
                pbCountDownLabelTextSizeMobile:'',
                pbCountDownLabelFontFamily:'',
                pbCountDownNumberFontFamily:'',
              };
          break;
          case 'wigt-pb-imageSlider':
            thisWidgetAttr = 'widgetImageSlider';
              thisWidgetAttrValues = {
                pbSliderImagesURL: {
                  0: pluginURL+'/images/dashboard/placeholder.jpg',
                  1: pluginURL+'/images/dashboard/placeholder.jpg'
                },
                pbSliderContent:{
                  0: {
                    imageSlideHeading: 'Enter Headline',
                    imageSlideDesc: 'Enter Some Text Here.',
                    imageSlideButtonText: 'A Button',
                    imageSlideButtonURL: '#'
                  },
                  1: {
                    imageSlideHeading: 'Enter Headline',
                    imageSlideDesc: 'Enter Some Text Here.',
                    imageSlideButtonText: 'A Button',
                    imageSlideButtonURL: '#'
                  }
                },
                slideHeadingStyles: {
                  slideHeadingColor: '#333',
                  slideHeadingSize: '45',
                  slideHeadingSizeTablet: '',
                  slideHeadingSizeMobile: '',
                  slideHeadingLetterSpacing: '',
                  slideHeadingLetterSpacingTablet:'',
                  slideHeadingLetterSpacingMobile:'',
                  slideHeadingLineHeight:'',
                  slideHeadingLineHeightTablet:'',
                  slideHeadingLineHeightMobile:'',
                  slideHeadingFontFamily: 'Arial',
                  slideHeadingBold: 'false',
                  slideHeadingItalic: 'false',
                  slideHeadingUnderlined: 'false'
                },
                slideDescStyles:{
                  slideDescColor: '#333',
                  slideDescSize: '18',
                  slideDescSizeTablet:'',
                  slideDescSizeMobile:'',
                  slideDescLetterSpacing: '',
                  slideDescLetterSpacingTablet:'',
                  slideDescLetterSpacingMobile:'',
                  slideDescLineHeight:'',
                  slideDescLineHeightTablet:'',
                  slideDescLineHeightMobile:'',
                  slideDescFontFamily: 'Arial',
                  slideDescBold: 'false',
                  slideDescItalic: 'false',
                  slideDescUnderlined: 'false'
                },
                slideButtonStyles: {
                  slideButtonBtnHeight: '15',
                  slideButtonBtnHeightTablet:'',
                  slideButtonBtnHeightMobile:'',
                  slideButtonBtnWidth: '200',
                  slideButtonBtnWidthTablet:'',
                  slideButtonBtnWidthMobile:'',
                  slideButtonBtnBgColor:'rgba(255,255,255,0)',
                  slideButtonBtnColor:'#333',
                  slideButtonBtnHoverBgColor:'#d9534f',
                  slideButtonBtnHoverTextColor:'#d9534f',
                  slideButtonBtnFontSize:'21',
                  slideButtonBtnFontSizeTablet:'',
                  slideButtonBtnFontSizeMobile:'',
                  slideButtonBtnFontFamily: 'Arial',
                  slideButtonBtnFontLetterSpacing: '',
                  slideButtonBtnFontLetterSpacingTablet:'',
                  slideButtonBtnFontLetterSpacingMobile:'',
                  slideButtonBtnBorderWidth:'2',
                  slideButtonBtnBorderColor:'#333',
                  slideButtonBtnBorderRadius:'5',
                },
                pbSliderHeight: '400',
                pbSliderHeightTablet:'',
                pbSliderHeightMobile:'',
                pbSliderHeightUnit: 'px',
                pbSliderHeightUnitTablet:'',
                pbSliderHeightUnitMobile:'',
                pbSliderContentBgColor: 'transparent',
                pbSliderAuto: 'true',
                pbSliderDelay: '5000',
                pbSliderPager: 'true',
                pbSliderNav: 'true',
                pbSliderRandom: 'false',
                pbSliderPause: 'false',
              };
          break;
          case 'wigt-pb-progressBar': 
            thisWidgetAttr = 'widgetProgressBar';
              thisWidgetAttrValues = {    
                pbProgressBarTitle: 'Progress Bar',
                pbProgressBarPrecentage: '65',
                pbProgressBarDisplayPrecentage: '',
                pbProgressBarText: 'Complete',
                pbProgressBarTitleColor: '#333',
                pbProgressBarTextColor: '#fff',
                pbProgressBarColor: '#434264',
                pbProgressBarBgColor: '#e3e3e3',
                pbProgressBarTitleSize: '18',
                pbProgressBarHeight: '25',
                pbProgressBarTextSize: '15',
                pbProgressBarTextFontFamily:'Select'
              };
          break;
          case 'wigt-pb-pricing': 
            thisWidgetAttr = 'widgetPricing';
              thisWidgetAttrValues = {    
                pbPricingHeaderText: 'Single Site License',
                pbPricingContent: '<span class="elLtWrapped defaultELt"><span class="elLtWrapped defaultELt">        </span></span><p class="elLtWrapped" style="text-align: center; font-size: 22px;"><span style="font-family: helvetica, arial, sans-serif; font-size: 36pt;"><span class="elLtWrapped" style="color: #fd885a; font-size: 75px; font-family: \'Open Sans\'; font-weight: bold;"><span class="elLtWrapped" style="font-size: 35px;">$</span>99<span class="elLtWrapped" style="font-size: 30px; color: #a9a9a9;">/mo</span></span> </span></p><p class="elLtWrapped" style="text-align: center;"><span style="font-family: helvetica, arial, sans-serif; font-size: 36pt;"> </span></p><p class="elLtWrapped" style="text-align: center;"></p><p class="elLtWrapped" style="text-align: center;"></p><div style="text-align: center;"><span class="elLtWrapped"><span style="background-color: transparent; font-size: 18px;"><span class="elLtWrapped" style="line-height: 30px; color: #878787; font-family: Open Sans;">Access to all premium features</span></span><span class="elLtWrapped" style="background-color: transparent; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen-Sans, Ubuntu, Cantarell, \'Helvetica Neue\', sans-serif;"> </span></span></div><div style="text-align: center;"><span class="elLtWrapped"><span class="elLtWrapped" style="background-color: transparent; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen-Sans, Ubuntu, Cantarell, \'Helvetica Neue\', sans-serif;"> </span></span></div><div style="text-align: center;"><span class="elLtWrapped"><span class="elLtWrapped" style="background-color: transparent; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen-Sans, Ubuntu, Cantarell, \'Helvetica Neue\', sans-serif;"><span style="background-color: transparent; font-size: 18px;"><span class="elLtWrapped" style="line-height: 30px; color: #878787; font-family: Open Sans;">Access to 100+ designs</span></span> </span></span></div><div style="text-align: center;"><span class="elLtWrapped"><span class="elLtWrapped" style="background-color: transparent; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen-Sans, Ubuntu, Cantarell, \'Helvetica Neue\', sans-serif;"><span class="elLtWrapped" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen-Sans, Ubuntu, Cantarell, \'Helvetica Neue\', sans-serif; background-color: transparent;"> </span></span></span></div><div style="text-align: center;"><span class="elLtWrapped"><span class="elLtWrapped" style="background-color: transparent; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen-Sans, Ubuntu, Cantarell, \'Helvetica Neue\', sans-serif;"><span class="elLtWrapped" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen-Sans, Ubuntu, Cantarell, \'Helvetica Neue\', sans-serif; background-color: transparent;"><span style="background-color: transparent; font-size: 18px;"><span class="elLtWrapped" style="line-height: 30px; color: #878787; font-family: Open Sans;">Unlimited domains</span></span> </span></span></span></div><div style="text-align: center;"><span class="elLtWrapped"><span class="elLtWrapped" style="background-color: transparent; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen-Sans, Ubuntu, Cantarell, \'Helvetica Neue\', sans-serif;"><span class="elLtWrapped" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen-Sans, Ubuntu, Cantarell, \'Helvetica Neue\', sans-serif; background-color: transparent;"><span class="elLtWrapped" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen-Sans, Ubuntu, Cantarell, \'Helvetica Neue\', sans-serif; background-color: transparent;"> </span></span></span></span></div><div style="text-align: center;"><span class="elLtWrapped"><span class="elLtWrapped" style="background-color: transparent;"><span class="elLtWrapped" style="background-color: transparent;"><span class="elLtWrapped" style="background-color: transparent;"><span class="elLtWrapped" style="background-color: transparent; font-size: 18px;"><span style="color: #878787; font-family: Open Sans;">Charged Monthly</span></span><span class="elLtWrapped" style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen-Sans, Ubuntu, Cantarell, \'Helvetica Neue\', sans-serif; background-color: transparent;"> </span></span></span></span></span></div><p class="elLtWrapped" style="text-align: center;"></p><p class="elLtWrapped" style="text-align: center;"></p><div class="ltwFontScript" style="display: none;"></div><div class="ltwFontScript" style="display: none;"></div><div class="ltwFontScript" style="display: none;"></div><div class="ltwFontScript" style="display: none;"> <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet"></div>',
                pbPricingHeaderTextColor: '#414141',
                pbPricingHeaderBgColor: '#fff',
                pbPricingHeaderTextSize:'22',
                pbPricingBorderWidth: '0',
                pbPricingBorderColor: '#fff',
                pbPricingButtonSectionBgColor: '#fff',
                pricingbtnText: 'Purchase',
                pricingbtnLink: '#',
                pricingbtnTextColor: '#fff',
                pricingbtnFontSize: '18',
                pricingbtnBgColor: '#699cfc',
                pricingbtnWidth: '70',
                pricingbtnHeight: '16',
                pricingbtnHoverBgColor: '#5b89df',
                pricingbtnBlankAttr: '_blank',
                pricingbtnBorderColor: '699cfc',
                pricingbtnBorderWidth: '0',
                pricingbtnBorderRadius: '2',
                pricingbtnButtonAlignment: 'center',
              };
          break;

          case 'wigt-pb-imgCarousel': 
            thisWidgetAttr = 'widgetImgCarousel';
              thisWidgetAttrValues = {    
                pbImgCarouselAutoplay: 'false',
                pbImgCarouselDelay: '1',
                imgCarouselSlideLoop: 'true',
                imgCarouselSlideTransition: 'fade',
                imgCarouselPagination: 'false',
                pbImgCarouselNav: 'true',
                imgCarouselSlidesURL: {
                  0: 'https://storage.googleapis.com/imagelibrarystorage.pluginops.com/images/uploads/2020/01/Gallery-Image-1@2x.jpg',
                  1: 'https://storage.googleapis.com/imagelibrarystorage.pluginops.com/images/uploads/2020/01/Gallery-Image-3@2x.jpg',
                  2: 'https://storage.googleapis.com/imagelibrarystorage.pluginops.com/images/uploads/2020/01/Gallery-Image-4@2x.jpg',
                  3: 'https://storage.googleapis.com/imagelibrarystorage.pluginops.com/images/uploads/2020/01/Gallery-Image-5@2x.jpg',
                  4: 'https://storage.googleapis.com/imagelibrarystorage.pluginops.com/images/uploads/2020/01/ABOUT-US@2x.jpg',
                  4: 'https://storage.googleapis.com/imagelibrarystorage.pluginops.com/images/uploads/2020/01/OUR-PARTNERS@2x-scaled.jpg',
                },
              };
          break;

          case 'wigt-pb-wooCommerceProducts': 
            thisWidgetAttr = 'widgetWooPorducts';
              thisWidgetAttrValues = {    
                wooProductsColumn:'2',
                wooProductsCount: '6',
                wooProductsCategories: '',
                wooProductsTags:'',
                wooProductsOrderBy:'date',
                wooProductsOrder:'asc',
              };
          break;
              
          case 'wigt-pb-spacer': 
            thisWidgetAttr = 'widgetVerticalSpace';
              thisWidgetAttrValues = {    
                widgetVerticalSpaceValue:'50',
                widgetVerticalSpaceValueTablet:'',
                widgetVerticalSpaceValueMobile:''
              };
          break;
          case 'wigt-pb-break': 
            thisWidgetAttr = 'widgetBreaker';
              thisWidgetAttrValues = {    
                widgetBreakerStyle:'solid',
                widgetBreakerWeight:'5',
                widgetBreakerColor:'#3a3a3a',
                widgetBreakerWidth:'50',
                widgetBreakerAlignment:'center',
                widgetBreakerSpacing:'15',
              };
          break;
          case 'wigt-pb-anchor': 
            thisWidgetAttr = 'widgetAnchor';
              thisWidgetAttrValues = {
                wdtanchorid:'',
              };
          break;
          case 'wigt-pb-iconList': 
            thisWidgetAttr = 'widgetIconList';
              thisWidgetAttrValues = {    
                iconListComplete:{
                  0: {
                    iconListItemText:' List Item 1',
                    iconListItemIcon: 'fa-check',
                    iconListItemLink: '',
                    iconListItemLinkOpen: '_blank',
                  },
                  1: {
                    iconListItemText:' List Item 2',
                    iconListItemIcon: 'fa-map-marker',
                    iconListItemLink: '',
                    iconListItemLinkOpen: '_blank',
                  },
                  2: {
                    iconListItemText:' List Item 3',
                    iconListItemIcon: 'fa-paper-plane',
                    iconListItemLink: '',
                    iconListItemLinkOpen: '_blank',
                  },
                },
                iconListLineHeight:'25',
                iconListAlignment:'left',
                iconListIconSize:'14',
                iconListIconColor: '#1e73be',
                iconListTextSize:'18',
                iconListTextIndent:'15',
                iconListTextColor:'#1e73be',
                iconListTextFontFamily: 'Arial',
                iconListItemLinkOpen:'_blank'
              };
          break;
          case 'wigt-pb-formBuilder': 
            thisWidgetAttr = 'widgetFormBuilder';
              thisWidgetAttrValues = {    
                widgetPbFbFormFeilds:{
                 0:{
                    fbFieldType: 'text',
                    thisFieldOptions: {
                      fbFieldLabel: 'First Name',
                      fbFieldPlaceHolder: 'First Name',
                      fbFieldRequired: 'false',
                      fbFieldWidth: '50',
                      multiOptionFieldValues:'',
                      fbtextareaRows: '5'
                    }
                  },
                  1:{
                    fbFieldType: 'text',
                    thisFieldOptions: {
                      fbFieldLabel: 'Last Name',
                      fbFieldPlaceHolder: 'Last Name',
                      fbFieldRequired: 'false',
                      fbFieldWidth: '50',
                      multiOptionFieldValues:'',
                      fbtextareaRows: '5'
                    }
                  },
                  2:{
                    fbFieldType: 'email',
                    thisFieldOptions: {
                      fbFieldLabel: 'Email',
                      fbFieldPlaceHolder: 'Email',
                      fbFieldRequired: 'true',
                      fbFieldWidth: '100',
                      multiOptionFieldValues:'',
                      fbtextareaRows: '5'
                    }
                  },
                  3:{
                    fbFieldType: 'textarea',
                    thisFieldOptions: {
                      fbFieldLabel: 'Message',
                      fbFieldPlaceHolder: 'Your Message',
                      fbFieldRequired: 'true',
                      fbFieldWidth: '100',
                      multiOptionFieldValues:'',
                      fbtextareaRows: '5',
                      displayFieldsInline:'inline-block'
                    },
                  },
                },
                widgetPbFbFormFeildOptions: {
                  formBuilderFieldSize: 'medium',
                  formBuilderFieldLabelDisplay: 'unset',
                  formBuilderFieldBgColor: '#fff',
                  formBuilderFieldColor: '#888888',
                  formBuilderFieldBorderColor: '#dddddd',
                  formBuilderFieldBorderWidth: '1.3',
                  formBuilderFieldBorderRadius: '2',
                  formBuilderLabelSize: '16',
                  formBuilderLabelColor:'#888888'
                },
                widgetPbFbFormSubmitOptions:{
                  formBuilderBtnText:'Subscribe',
                  formBuilderBtnSize:'medium',
                  formBuilderBtnWidth: '100',
                  formBuilderBtnBgColor:'rgb(105, 156, 252)',
                  formBuilderBtnColor:'#fff',
                  formBuilderBtnHoverBgColor:'rgb(105, 156, 252)',
                  formBuilderBtnHoverTextColor:'rgb(105, 156, 252)',
                  formBuilderBtnFontSize:'21',
                  formBuilderBtnBorderWidth:'0',
                  formBuilderBtnBorderColor:'rgb(105, 156, 252)',
                  formBuilderBtnBorderRadius:'2',
                  formBuilderBtnAlignment:'left',
                },
                widgetPbFbFormEmailOptions:{
                  formEmailformName: 'PluginOps Form',
                  formEmailTo: admEMail,
                  formEmailSubject:'PluginOps New Submission',
                  formEmailFromEmail:'formBuilder@pluginops.com',
                  formEmailName: 'PluginOps',
                  formEmailFormat:'plain',
                  formSuccessAction:'',
                  formSuccessActionURL:'',
                  formSuccessMessage:'The form was sent successfully!',
                },
                widgetPbFbFormMailChimp: {
                  formBuilderEnableMailChimp: '',
                  formBuilderMCAccountName: '',
                  formBuilderMCApiKey: ''
                }
              };
          break;
          case 'wigt-pb-text': 
            thisWidgetAttr = 'widgetText';
              thisWidgetAttrValues = {
                widgetTextContent: 'Enter your headline text here.',
                widgetTextAlignment:'left',
                widgetTextTag:'h2',
                widgetTextColor:'#333',
                widgetTextSize:'36',
                widgetTextFamily:'Lato',
                widgetTextWeight:'200',
                widgetTextTransform:'',
                widgetTextLineHeight:'',
                widgetTextSpacing: '',
                widgetTextBold: false,
                widgetTextItalic: false,
                widgetTextUnderlined: false,
                widgetTextSizeTablet:' ',
                widgetTextSizeMobile:' ',
                widgetTextLineHeightTablet:' ',
                widgetTextLineHeightMobile:' ',
                widgetTextSpacingTablet:' ',
                widgetTextSpacingMobile:' '
              };
          break;
          case 'wigt-pb-liveText':
            thisWidgetAttr = 'wLText';
            thisWidgetAttrValues = {
              wltc: '<p style="text-align: left; font-size: 16px; line-height: 1.3em; color: #555;">This is a block of text, Click on this text to start editing or click on edit button to open widget editing panel.</p>',
              wltfs: '',
            };
          break;
          case 'wigt-pb-embededVideo': 
            thisWidgetAttr = 'widgetEmbedVideo';
              thisWidgetAttrValues = {
                widgetEvidVideoType: 'youtube',
                widgetEvidVideoLink: 'https://www.youtube.com/watch?v=xbkwUPbRJH8',
                widgetEvidVideoAutoplay:'false',
                widgetEvidVideoPlayerControls:'true',
                widgetEvidVideoTitle:'true',
                widgetEvidVideoSuggested:'false',
                widgetEvidImageOverlay: 'false',
                widgetEvidImageUrl:pluginURL+'/images/dashboard/placeholder.jpg',
                widgetEvidImageIcon:'block',
                widgetEvidImageLightbox:'false',
                widgetEvidImageIconColor:'#333'
              };
          break;
          case 'wigt-pb-testimonialCarousel': 
            thisWidgetAttr = 'widgetTCarousel';
              thisWidgetAttrValues = {    
                tCarOps:{
                  tCarAutoplay: 'false',
                  tCarDelay: '3',
                  tCarSlideLoop: 'true',
                  tCarSlideTransition: 'fade',
                  tCarPagination: 'false',
                  tCarNav: 'true',
                  tNSlides:'2',
                },
                tCarSlides: {
                  0: {
                    tct:'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                    tcn:'John Doe',
                    tcj:'CEO, Tech Corps',
                    tcl:'none',
                    tci:pluginURL+'/images/dashboard/placeholder.jpg'
                  },
                  1: {
                    tct:'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                    tcn:'John Doe',
                    tcj:'CEO, Tech Corps',
                    tcl:'none',
                    tci:pluginURL+'/images/dashboard/placeholder.jpg'
                  },
                },
                tDesignOps:{
                  tcic: '#333',
                  tcis:'45',
                  tcist:'',
                  tcism:'',
                  tcntc:'#333',
                  tcntf:'Select',
                  tcnts:'14',
                  tcntst:'',
                  tcntsm:'',
                  tcttc:'#333',
                  tcttf:'Select',
                  tctts:'18',
                  tcttst:'',
                  tcttsm:'',
                  tcca:'center',
                  tcir:'200px',
                  tcisi:'60',
                }
              };
          break;
          case 'wigt-pb-poOptins': 
            thisWidgetAttr = 'widgetPoOptins';
              thisWidgetAttrValues = {
                widgetOptinId: 'Select',
              };
          break;
          case 'wigt-pb-shareThis': 
            thisWidgetAttr = 'widgetShareThis';
              thisWidgetAttrValues = {
                wdtstId: '',
                wdtstbt:'SBI',
              };
          break;
          case 'wigt-pb-navmenu': 
            thisWidgetAttr = 'widgetNavBuilder';
              thisWidgetAttrValues = {
                navItems: {
                  0: {
                    cnilab : 'Menu Page 0',
                    cniurl : '#',
                  },
                  1: {
                    cnilab : 'Menu Page 1',
                    cniurl : '#',
                  },
                  2: {
                    cnilab : 'Menu Page 2',
                    cniurl : '#',
                  },
                  3: {
                    cnilab : 'Menu Page 3',
                    cniurl : '#',
                  },
                  4: {
                    cnilab : 'Menu Page 4',
                    cniurl : '#',
                  },
                },
                navStyle: {
                  cnsfc: '#333',
                  cnsfhc: 'rgb(149, 149, 149)',
                  cnsbc: 'rgba(51, 51, 51, 0)',
                  cnshbc: 'rgba(51, 51, 51, 0)',
                  cnsnic: '#333',
                  cnsfs: '16',
                  cnsfst: '',
                  cnsfsm: '',
                  cnslg: '5',
                  cnslh: '8',
                  cnsff: 'Select',
                  cnslourl: '',
                  cnslos: 'Medium',
                  cnslayout: 'Horizontal',
                }
              };
          break;
          case 'wigt-pb-gallery':
            thisWidgetAttr = 'widgetIGallery';
              thisWidgetAttrValues = {
                gallItems: {
                  0: {
                    gur: 'https://storage.googleapis.com/imagelibrarystorage.pluginops.com/images/uploads/2020/01/FAQS@2x.jpg',
                    gti: '',
                    gca: '',
                  },
                  1: {
                    gur: 'https://storage.googleapis.com/imagelibrarystorage.pluginops.com/images/uploads/2020/01/Gallery-Image-1@2x.jpg',
                    gti: '',
                    gca: '',
                  },
                  2: {
                    gur: 'https://storage.googleapis.com/imagelibrarystorage.pluginops.com/images/uploads/2020/01/Gallery-Image-2@2x.jpg',
                    gti: '',
                    gca: '',
                  },
                  3: {
                    gur: 'https://storage.googleapis.com/imagelibrarystorage.pluginops.com/images/uploads/2020/01/Gallery-Image-5@2x.jpg',
                    gti: '',
                    gca: '',
                  },
                },
                gallStyles:{
                  wgType: 'masonry',
                  wgGC:'33',
                  wgGCT: '',
                  wgGCM: '',
                  wgGCG:'',
                  wgISD:'large',
                  wgICW:'',
                  wgICWT:'',
                  wgICWM:'',
                  wgICH:'',
                  wgICHT:'',
                  wgICHM:'',
                }
              };
          break;
          case 'wigt-pb-accordion':
            thisWidgetAttr = 'widgetAccordion';
              thisWidgetAttrValues = {
                accordionItems: {
                  0: {
                    accoTitle: 'Title Accordion 1',
                    accContent: 'Enter content for accordion here.',
                  },
                  1: {
                    accoTitle: 'Title Accordion 2',
                    accContent: 'Enter content for accordion here.',
                  },
                  2: {
                    accoTitle: 'Title Accordion 3',
                    accContent: 'Enter content for accordion here.',
                  },
                },
                accordionIcon:{
                  acciClosed:'fas fa-angle-down',
                  acciOpen:'fas fa-angle-up',
                  acciAlign:'left',
                  acciColor:'#333',
                  acciAColor:'#E3E3E3',
                  acciGap:'10',
                },
                accordionSettings:{
                  accoHeight:'content',
                  accoActive:'true',
                  accocborc:'rgb(179, 179, 179)',
                  accocbort:'solid',
                },
                accordionTitle:{
                  acctbg:'#fff',
                  acctabg:'',
                  acctc:'#333',
                  acctac:'#E3E3E3',
                  hgap:'20',
                  vgap:'15',
                  borwt:'1',
                  borwb:'1',
                  borwl:'2',
                  borwr:'2',
                  typography:{
                    ffam:'Arial',
                    fsize:'24',
                    fsizeT:'',
                    fsizeM:'',
                    fsizeu:'px',
                    fsizeuT:'',
                    fsizeuM:'',
                    fwei:'400',
                    ftrans:'',
                    fstyl:'',
                    fdeco:'',
                    flinh:'',
                    flinhT:'',
                    flinhM:'',
                    fletsp:'',
                    fletspT:'',
                    fletspM:'',
                  },
                },
                accordionContent:{
                  acccbg:'',
                  acccc:'',
                  hgap:'',
                  vgap:'',
                  borwt:'1',
                  borwb:'1',
                  borwl:'2',
                  borwr:'2',
                  typography:{
                    ffam:'Arial',
                    fsize:'',
                    fsizeT:'',
                    fsizeM:'',
                    fsizeu:'px',
                    fsizeuT:'',
                    fsizeuM:'',
                    fwei:'',
                    ftrans:'',
                    fstyl:'',
                    fdeco:'',
                    flinh:'',
                    flinhT:'',
                    flinhM:'',
                    fletsp:'',
                    fletspT:'',
                    fletspM:'',
                  },
                }
              };
          break;
          case 'wigt-pb-tabs':
            thisWidgetAttr = 'widgetTabs';
              thisWidgetAttrValues = {
                tabItems: {
                  0: {
                    title: 'Title Tab 1',
                    icon:'',
                    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ',
                  },
                  1: {
                    title: 'Title Tab 2',
                    icon:'',
                    content: 'Enter content for tab here. 2',
                  },
                  2: {
                    title: 'Title Tab 3',
                    icon:'',
                    content: 'Enter content for tab here. 3',
                  },
                },
                tabIcon:{
                  acciPos:'before',
                  acciGap:'10',
                },
                tabSettings:{
                  accoHeight:'content',
                  accoActive:'true',
                  accocborc:'rgb(179, 179, 179)',
                  accocbort:'solid',
                },
                tabTitle:{
                  acctbg:'#f0f0f0',
                  acctabg:'#636363',
                  acctc:'#000',
                  acctac:'#fff',
                  hgap:'15',
                  vgap:'10',
                  borwt:'0.5',
                  borwb:'0.5',
                  borwl:'1',
                  borwr:'1',
                  typography:{
                    ffam:'Open+Sans',
                    fsize:'16',
                    fsizeT:'',
                    fsizeM:'',
                    fsizeu:'px',
                    fsizeuT:'',
                    fsizeuM:'',
                    fwei:'200',
                    ftrans:'',
                    fstyl:'',
                    fdeco:'',
                    flinh:'1',
                    flinhT:'',
                    flinhM:'',
                    fletsp:'',
                    fletspT:'',
                    fletspM:'',
                  },
                },
                tabContent:{
                  acccbg: '',
                  acccc: '',
                  borwb: '0.5',
                  borwl: '1',
                  borwr: '1',
                  borwt: '0.5',
                  hgap: '5',
                  vgap:'35',
                  typography:{
                    ffam:'Lato',
                    fsize:'14',
                    fsizeT:'',
                    fsizeM:'',
                    fsizeu:'px',
                    fsizeuT:'',
                    fsizeuM:'',
                    fwei:'',
                    ftrans:'',
                    fstyl:'',
                    fdeco:'',
                    flinh:'1',
                    flinhT:'',
                    flinhM:'',
                    fletsp:'',
                    fletspT:'',
                    fletspM:'',
                  },
                }
              };
          break;
          case 'wigt-pb-popupClose':
            thisWidgetAttr = 'widgetClosePopUp';
              var thisWidgetAttrValues = {
                closeBtnText: 'I don\'t want your Offer',
                closeBtnLink: '#',
                closeBtnTextColor: '#636363',
                closeBtnFontSize: '16px',
                closeBtnFontSizeTablet:'',
                closeBtnFontSizeMobile:'',
                closeBtnBgColor: 'rgba(0,0,0,0)',
                closeBtnWidth: '80',
                closeBtnWidthPercent:'80',
                closeBtnWidthUnit: '%',
                closeBtnWidthUnitTablet: '%',
                closeBtnWidthUnitMobile: '%',
                closeBtnWidthPercentTablet:'',
                closeBtnWidthPercentMobile:'',
                closeBtnHeight: '10',
                closeBtnHeightTablet:'',
                closeBtnHeightMobile:'',
                closeBtnHoverBgColor: 'rgba(0,0,0,0)',
                closeBtnHoverColor: '#333',
                closeBtnBorderColor: 'rgba(0,0,0,0)',
                closeBtnBorderWidth: '0',
                closeBtnBorderRadius: '3',
                closeBtnButtonAlignment: 'center',
                closeBtnButtonFontFamily: 'Homemade Apple',
                closeBtnBold: true,
                closeBtnItalic: true,
                closeBtnUnderlined: true,
              };
          break;
          default : 
            alert('Widget of unknown type');
          break;
        }


        var globalWidgetAttrs = {
          widgetType:currentWidgetType,
          widgetStyling:'/* Custom CSS for widget here. */',
          widgetMtop:'0',
          widgetMleft:'0',
          widgetMbottom:'0',
          widgetMright:'0',
          widgetPtop:'0',
          widgetPleft:'0',
          widgetPbottom:'0',
          widgetPright:'0',
          widgetBgColor: 'transparent',
          widgetAnimation: 'none',
          widgetBorderWidth: '',
          widgetBorderStyle:'',
          widgetBorderColor:'',
          widgetBoxShadowH: '',
          widgetBoxShadowV: '',
          widgetBoxShadowBlur: '',
          widgetBoxShadowColor: '',
          [thisWidgetAttr] : thisWidgetAttrValues
        };



        globalWidgetAttrs['widgetType'] = currentWidgetType;
        $('.draggedWidgetAttributes').val(JSON.stringify(globalWidgetAttrs));

        ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
        currentEditableColId = jQuery('.currentEditableColId').val();
          

        $('.column').droppable({
            accept: ".wdt-draggable",
            snap:'.column',
            drop: function(event,ui){
              var curr_droppable = $(this).attr('id');
              $('.widgetDroppedAtIndex').val('');

             $('#'+curr_droppable +' .wdgt-dropped').trigger('click');
            },
            over: function(){
              var curr_droppable = $(this).attr('id');
              $('#'+curr_droppable+ " .droppableEmptyColumn").slideDown(250);

            },
            out: function(){
              var curr_droppable = $(this).attr('id');
              $('#'+curr_droppable+ " .droppableEmptyColumn").css('display','none');
            }

        });


      }

    }); 

  } catch(error) {
      // statements
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
  

});



}( jQuery ) );