<?php if ( ! defined( 'ABSPATH' ) ) exit;
  $colWidgets = $currentColumn['colWidgets'];
  $premWidgetNotice = "<p style='background:#fff; padding:5px 15px;'>Please install or update premium version for activating this premium widget.</p>";

  $ulpb_new_user = get_option( 'ulpb_new_user' );

  if ($ulpb_new_user == true) {
    $isPremUser = true;
  }else{
    $isPremUser = true;
  }

  
  if (function_exists('ulpb_available_pro_widgets') ) { $isPremUser = true; }

  if (function_exists('ppb_lpb_check_free_version_active')) {
    if (!function_exists('ulpb_available_pro_widgets') ) { $isPremUser = false; }
  }

      for ($j = 0; $j < count($colWidgets); $j++) {  // widgets loop
          $thisWidget = $colWidgets[$j];


          if ($thisWidget['widgetType'] == 'wigt-btn-gen' || $thisWidget['widgetType'] == 'wigt-WYSIWYG' || $thisWidget['widgetType'] == 'wigt-pb-text' || $thisWidget['widgetType'] == 'wigt-pb-navmenu' || $thisWidget['widgetType'] == 'wigt-pb-pricing' || $thisWidget['widgetType'] == 'wigt-pb-cards' || $thisWidget['widgetType'] == 'wigt-pb-formBuilder' || $thisWidget['widgetType'] == 'wigt-pb-liveText'  || $thisWidget['widgetType'] == 'wigt-pb-accordion'  || $thisWidget['widgetType'] == 'wigt-pb-tabs'  )  {
            
            $thisWidget = json_encode($thisWidget);

            $thisWidget = str_replace('<pluginopsfont ', '<link ', $thisWidget);
            $thisWidget = str_replace('pluginopsstyle', 'style', $thisWidget);
            $thisWidget = str_replace('pluginopsscript', 'script', $thisWidget);
            
            $thisWidget = json_decode($thisWidget, true);

          }
          

          $columnOptions = $currentColumn['columnOptions'];

          $widgetDataMerged = mergeNonSetObjectValues($thisWidget,$defaultWidgetDataOps);

          $thisWidget = $widgetDataMerged;

          $this_column_type = $thisWidget['widgetType'];
          $widgetStyling = $thisWidget['widgetStyling'];

          $widgetMtop = $thisWidget['widgetMtop'];
          $widgetMleft = $thisWidget['widgetMleft'];
          $widgetMbottom = $thisWidget['widgetMbottom'];
          $widgetMright = $thisWidget['widgetMright'];
          $widgetBgColor = $thisWidget['widgetBgColor'];

          if (isset($thisWidget['widgetPtop'])) {
            $widgetPtop = $thisWidget['widgetPtop'];
            $widgetPleft = $thisWidget['widgetPleft'];
            $widgetPbottom = $thisWidget['widgetPbottom'];
            $widgetPright = $thisWidget['widgetPright'];

            $widgetPaddings = "padding:".$widgetPtop."% ".$widgetPright."% ".$widgetPbottom."% ".$widgetPleft."%;";
          } else{
            $widgetPaddings = "";
          }

          $widgetIsInline = 'display:block;';
          if (isset($thisWidget['widgetIsInline'])) {
            if ($thisWidget['widgetIsInline'] == 'true') {
              $widgetIsInline = 'display:inline-block;';
            }
          }
          $widgHideOnDesktop = "";



          if (isset($thisWidget['widgetPaddingTablet'])) {
            $widgetMarginTablet = $thisWidget['widgetMarginTablet'];
            $widgetMarginMobile = $thisWidget['widgetMarginMobile'];
            $widgetPaddingTablet = $thisWidget['widgetPaddingTablet'];
            $widgetPaddingMobile = $thisWidget['widgetPaddingMobile'];

            $displayWidgetInlineTablet = "display: block !important;";
            $displayWidgetInlineMobile = "display: block !important;";

            if (isset($thisWidget['widgetIsInlineTablet']) || isset($thisWidget['widgetIsInlineMobile'])) {

              if ($thisWidget['widgetIsInlineTablet'] == 'true') {
                $displayWidgetInlineTablet = "display: inline-block !important;";
              }elseif ($thisWidget['widgetIsInlineTablet'] == 'false') {
                $displayWidgetInlineTablet = "display: block !important;";
              }
              if ($thisWidget['widgetIsInlineMobile'] == 'true') {
                $displayWidgetInlineMobile = "display: inline-block !important;";
              }elseif ($thisWidget['widgetIsInlineMobile'] == 'false') {
                $displayWidgetInlineMobile = "display: block !important;";
              }
              
            }

            $widgHideOnDesktop = ""; $widgHideOnTablet = ""; $widgHideOnMobile = "";
            if (isset($thisWidget['widgHideOnDesktop']) ) {
              if ($thisWidget['widgHideOnDesktop'] == 'hide') {
                $widgetIsInline ="display:none;";
              }
              if ($thisWidget['widgHideOnTablet'] == 'hide') {
                $displayWidgetInlineTablet ="display:none !important;";
              }
              if ($thisWidget['widgHideOnMobile'] == 'hide') {
                $displayWidgetInlineMobile ="display:none !important;";
              }
            }

            $widgetWidthDefault =' '; $widgetWidthTablet = ' '; $widgetWidthMobile = ' ';
            if(isset($thisWidget['wp'])){

              $widgetPositionOps = $thisWidget['wp'];
              if (isset($widgetPositionOps['wpw'])) {
                
                
                if($widgetPositionOps['wpw'] == 'custom'){

                  if (!isset($widgetPositionOps['wpcwu'])) {
                    $widgetPositionOps['wpcwu'] = 'px';
                  }

                  $widgetWidthDefault = 'width: '.$widgetPositionOps['wpcw'].$widgetPositionOps['wpcwu'].';';

                }elseif($widgetPositionOps['wpw'] == 'full'){

                  $widgetWidthDefault = 'width: 100%;';
                  
                }
                else{

                  $widgetWidthDefault = 'width:auto;';
                  
                }

              }

              if (isset($widgetPositionOps['wpwt'])) {
                
                
                if($widgetPositionOps['wpwt'] == 'custom'){

                  if (!isset($widgetPositionOps['wpcwut'])) {
                    $widgetPositionOps['wpcwut'] = 'px';
                  }

                  $widgetWidthTablet = 'width: '.$widgetPositionOps['wpcwt'].$widgetPositionOps['wpcwut'].' !important;';

                }elseif($widgetPositionOps['wpwt'] == 'full'){

                  $widgetWidthTablet = 'width: 100% !important;';
                  
                }
                else{

                  $widgetWidthTablet = 'width:auto !important;';
                  
                }

              }

              if (isset($widgetPositionOps['wpwm'])) {
                
                
                if($widgetPositionOps['wpwm'] == 'custom'){

                  if (!isset($widgetPositionOps['wpcwum'])) {
                    $widgetPositionOps['wpcwum'] = 'px';
                  }

                  $widgetWidthMobile = 'width: '.$widgetPositionOps['wpcwm'].$widgetPositionOps['wpcwum'].' !important;';

                }elseif($widgetPositionOps['wpwm'] == 'full'){

                  $widgetWidthMobile = 'width: 100% !important;';
                  
                }
                else{

                  $widgetWidthMobile = 'width:auto !important;';
                  
                }

              }
              
            }

            $thisWidgetResponsiveWidgetStylesTablet = "
              #widget-$j-$Columni-".$row["rowID"]." {
               margin-top: ".$widgetMarginTablet['rMTT']."% !important;
               margin-bottom: ".$widgetMarginTablet['rMBT']."% !important;
               margin-left: ".$widgetMarginTablet['rMLT']."% !important;
               margin-right: ".$widgetMarginTablet['rMRT']."% !important;

               padding-top: ".$widgetPaddingTablet['rPTT']."% !important;
               padding-bottom: ".$widgetPaddingTablet['rPBT']."% !important;
               padding-left: ".$widgetPaddingTablet['rPLT']."% !important;
               padding-right: ".$widgetPaddingTablet['rPRT']."% !important;
               ".$displayWidgetInlineTablet." $widgetWidthTablet
              }
            ";

            $thisWidgetResponsiveWidgetStylesMobile = "
             #widget-$j-$Columni-".$row["rowID"]." {
               margin-top: ".$widgetMarginMobile['rMTM']."% !important;
               margin-bottom: ".$widgetMarginMobile['rMBM']."% !important;
               margin-left: ".$widgetMarginMobile['rMLM']."% !important;
               margin-right: ".$widgetMarginMobile['rMRM']."% !important;

               padding-top: ".$widgetPaddingMobile['rPTM']."% !important;
               padding-bottom: ".$widgetPaddingMobile['rPBM']."% !important;
               padding-left: ".$widgetPaddingMobile['rPLM']."% !important;
               padding-right: ".$widgetPaddingMobile['rPRM']."% !important;
               ".$displayWidgetInlineMobile." $widgetWidthMobile
              }
            ";

            array_push($POPBNallRowStylesResponsiveTablet, $thisWidgetResponsiveWidgetStylesTablet);
            array_push($POPBNallRowStylesResponsiveMobile, $thisWidgetResponsiveWidgetStylesMobile);
          }
          

          if (isset($thisWidget['widgetAnimation'])) {

              $widgetAnimation = ' animated '.$thisWidget['widgetAnimation'];

          }else{
            $widgetAnimation = '';
          }


          $widgetCustomClass = '';
          if (isset($thisWidget['widgetCustomClass'])) {
              $widgetCustomClass = $thisWidget['widgetCustomClass'];
          }


          if (isset($thisWidget['widgetBoxShadowH'])) {
            $widgetBorderRadius = '';
            if (isset($thisWidget['widgetBorderRadius'])) {
              $widgetBorderRadius = 'border:'.$thisWidget['widgetBorderRadius'].';';
            }

            if ( isset($thisWidget['borderRadius']) ) {
              $WborderRadius = $thisWidget['borderRadius'];
              $widgetBorderRadius = 'border-radius:'.$WborderRadius['wbrt'].'px '.$WborderRadius['wbrr'].'px '.$WborderRadius['wbrb'].'px '.$WborderRadius['wbrl'].'px;';
            }

            if ( isset($thisWidget['borderWidth']) ) {
              $widgetBorderWidth = $thisWidget['borderWidth'];
            }else{
              $widgetBorderWidth = array();
              $widgetBorderWidth['wbwt'] = $thisWidget['widgetBorderWidth'];
              $widgetBorderWidth['wbwb'] = $thisWidget['widgetBorderWidth'];
              $widgetBorderWidth['wbwl'] = $thisWidget['widgetBorderWidth'];
              $widgetBorderWidth['wbwr'] = $thisWidget['widgetBorderWidth'];
            }

            if($thisWidget['widgetBorderStyle'] == ''){
              $thisWidget['widgetBorderStyle'] = 'none';
            }
            
            $this_widget_border_shadow = 'border-width: '.$widgetBorderWidth['wbwt'].'px '.$widgetBorderWidth['wbwr'].'px  '.$widgetBorderWidth['wbwb'].'px '.$widgetBorderWidth['wbwl'].'px; border-style: '.$thisWidget['widgetBorderStyle'].'; border-color: '.$thisWidget['widgetBorderColor'].'; box-shadow: '.$thisWidget['widgetBoxShadowH'].'px  '.$thisWidget['widgetBoxShadowV'].'px  '.$thisWidget['widgetBoxShadowBlur'].'px '.$thisWidget['widgetBoxShadowColor'].' ; '.$widgetBorderRadius.' ';
          }else{
            $this_widget_border_shadow = '';
          }
          

          $imgAlignment  = '';
          


          

          //Menu Widget
          $menuSpecificStyles = " ";
          $menuSpecificClass = " ";
          if ($this_column_type == 'wigt-menu') {
            $this_widget_menu_content = $thisWidget['widgetMenu'];
            $menuName = $this_widget_menu_content['menuName'];
            $menuStyle = $this_widget_menu_content['menuStyle'];
            $menuColor = $this_widget_menu_content['menuColor'];

              

              if (isset($this_widget_menu_content['pbMenuFontFamily'])) {



                $pbMenuFontFamily = str_replace('+', ' ', $this_widget_menu_content['pbMenuFontFamily']);

                if(1 === preg_match('~[0-9]~', $this_widget_menu_content['pbMenuFontFamily'])){
                  $this_widget_menu_content['pbMenuFontFamily'] = "'".$this_widget_menu_content['pbMenuFontFamily']."'";
                }

                array_push($thisColFontsToLoad, $this_widget_menu_content['pbMenuFontFamily']);
              }else{
                $pbMenuFontFamily = '';
              }

              if (isset($this_widget_menu_content['pbMenuFontHoverColor'])) {
                $pbMenuFontHoverColor = $this_widget_menu_content['pbMenuFontHoverColor'];
              }else{
                $pbMenuFontHoverColor = '';
              }
              if (isset($this_widget_menu_content['pbMenuFontHoverBgColor'])) {
                $pbMenuFontHoverBgColor = $this_widget_menu_content['pbMenuFontHoverBgColor'];
              }else{
                $pbMenuFontHoverBgColor = '';
              }
              if (isset($this_widget_menu_content['pbMenuFontSize'])) {
                $pbMenuFontSize = $this_widget_menu_content['pbMenuFontSize'];
              }else{
                $pbMenuFontSize = '16';
              }


            
            if ($menuStyle == 'menu-style-1' || $menuStyle == 'menu-style-4') {
              $menuSpecificStyles = "display: flex; justify-content: center; align-items: center;";
            } elseif ($menuStyle == 'menu-style-2') {
              $menuSpecificClass = "widget-$j-menuFixed";
            }

            include(ULPB_PLUGIN_PATH.'public/templates/menus/'.$menuStyle.'.php');
            
          }


          switch ($this_column_type) {
            case 'wigt-WYSIWYG':
              //WYSIWYG Widget
              $this_widget_editor = $thisWidget['widgetWYSIWYG'];
              
              if (!isset($this_widget_editor['widgetContentFonts']) || $this_widget_editor['widgetContentFonts'] == null) {
                $this_widget_editor['widgetContentFonts'] = '';
              }

              $thisWidgetContentEditor =  $this_widget_editor['widgetContent'];

              $thisWidgetContentEditor = str_replace("contenteditable","e",$thisWidgetContentEditor);

              if ($this_widget_editor['widgetContentFonts']  != '' && $this_widget_editor['widgetContentFonts']  != ' ') {
                array_push($widgetTextFontsBulk, $this_widget_editor['widgetContentFonts'] );
              }

              $widgetContent = do_shortcode( $thisWidgetContentEditor );
              $contentAlignment = ' ';
              break;
            case 'wigt-img':


              try {

                // IMG Widget
                $this_widget_img_content = $thisWidget['widgetImg'];
                $imgUrl  = esc_url($this_widget_img_content['imgUrl']);
                $imgSize = esc_attr($this_widget_img_content['imgSize']);
                $imgAlignment = esc_attr($this_widget_img_content['imgAlignment']);
                $uniqueImgId = 'pb_img'.(rand(500,1000)*2)*rand(10,500) ;
                $imgCustomSize = '';

                if (!isset( $this_widget_img_content['imgAlt'] )) {
                  $this_widget_img_content['imgAlt'] = '';
                }
                $imgAltText = esc_attr($this_widget_img_content['imgAlt']);


                if ( isset($this_widget_img_content['iborderRadius']) ) {
                  $iborderRadius = $this_widget_img_content['iborderRadius'];
                }else{
                  $iborderRadius = array();
                  $iborderRadius['iwbrt'] = '';
                  $iborderRadius['iwbrb'] = '';
                  $iborderRadius['iwbrl'] = '';
                  $iborderRadius['iwbrr'] = '';
                }
                if ( isset($this_widget_img_content['iborderWidth']) ) {
                  $iborderWidth = $this_widget_img_content['iborderWidth'];
                }else{
                  $iborderWidth = array();
                  $iborderWidth['iwbwt'] = '0';
                  $iborderWidth['iwbwb'] = '0';
                  $iborderWidth['iwbwl'] = '0';
                  $iborderWidth['iwbwr'] = '0';
                }

                if(!isset($this_widget_img_content['iwbs']) ) { $this_widget_img_content['iwbs'] = 'none'; };
                if(!isset($this_widget_img_content['iwbc']) ) { $this_widget_img_content['iwbc'] = ''; };
                if(!isset($this_widget_img_content['iwbsh']) ) { $this_widget_img_content['iwbsh'] = ''; };
                if(!isset($this_widget_img_content['iwbsv']) ) { $this_widget_img_content['iwbsv'] = ''; };
                if(!isset($this_widget_img_content['iwbsb']) ) { $this_widget_img_content['iwbsb'] = ''; };
                if(!isset($this_widget_img_content['iwbsc']) ) { $this_widget_img_content['iwbsc'] = ''; };





                if(!isset($this_widget_img_content['iwbs'])){
                  $this_widget_img_content['iwbs'] = '';
                }

                if(!isset($this_widget_img_content['iwbc'])){
                  $this_widget_img_content['iwbc'] = '';
                }

                if(!isset($this_widget_img_content['iwbsh'])){
                  $this_widget_img_content['iwbsh'] = '';
                }

                if(!isset($this_widget_img_content['iwbsv'])){
                  $this_widget_img_content['iwbsv'] = '';
                }

                if(!isset($this_widget_img_content['iwbsb'])){
                  $this_widget_img_content['iwbsb'] = '';
                }

                if(!isset($this_widget_img_content['iwbsc'])){
                  $this_widget_img_content['iwbsc'] = '';
                }

                $imgWidgetboxShadow = 
                  '
                  border-width: '.esc_attr($iborderWidth['iwbwt']).'px '.esc_attr($iborderWidth['iwbwr']).'px  '.esc_attr($iborderWidth['iwbwb']).'px '.esc_attr($iborderWidth['iwbwl']).'px;
                  border-style: '.esc_attr($this_widget_img_content['iwbs']).';
                  border-color: '.esc_attr($this_widget_img_content['iwbc']).';
                  border-radius:'.esc_attr($iborderRadius['iwbrt']).'px '.esc_attr($iborderRadius['iwbrr']).'px '.esc_attr($iborderRadius['iwbrb']).'px '.esc_attr($iborderRadius['iwbrl']).'px;
                  box-shadow: '.esc_attr($this_widget_img_content['iwbsh']).'px  '.esc_attr($this_widget_img_content['iwbsv']).'px  '.esc_attr($this_widget_img_content['iwbsb']).'px '.esc_attr($this_widget_img_content['iwbsc']).' ;
                ';

                if ($imgSize == 'custom') {
                    if ($this_widget_img_content['imgSizeCustomWidth'] != "undefined") {
                      $imgSizeCustomWidth = esc_attr($this_widget_img_content['imgSizeCustomWidth']);
                    }
                    if ($this_widget_img_content['imgSizeCustomHeight'] != "undefined") {
                      $imgSizeCustomHeight = esc_attr($this_widget_img_content['imgSizeCustomHeight']);
                    }

                    $imgCustomSize = 'width:'.$imgSizeCustomWidth.'px; height:'.$imgSizeCustomHeight.'px;';
                }


                $captionHTML = '';
                $imgWidgetCaptionResponsiveScripts = '';

                if (!isset($this_widget_img_content['imgwctff'])  || $this_widget_img_content['imgwctff'] == '') {
                  $this_widget_img_content['imgwctff'] = 'Arial';
                }

                if (!isset($this_widget_img_content['imgwccdis']) ) { $this_widget_img_content['imgwccdis'] = 'hidden'; }

                if ( $this_widget_img_content['imgwccdis'] != 'hidden' ) {

                  $hideImageCaption = '';
                  if ($this_widget_img_content['imgwccdis'] != 'always') {
                    $hideImageCaption = 'display:none;';
                  }

                  if ( !isset($this_widget_img_content['imgwccw'])  || $this_widget_img_content['imgwccw'] == '' ) { $this_widget_img_content['imgwccw'] = '50';  }

                  if ( !isset($this_widget_img_content['imgwccwu'])  || $this_widget_img_content['imgwccwu'] == '' ) { $this_widget_img_content['imgwccwu'] = '%';  }
                  
                  if ( !isset($this_widget_img_content['imgwccah'])  || $this_widget_img_content['imgwccah'] == '' ) { $this_widget_img_content['imgwccah'] = 'center';  }

                  if ( !isset($this_widget_img_content['imgwccav'])  || $this_widget_img_content['imgwccav'] == '' ) { $this_widget_img_content['imgwccav'] = 'middle';  }

                  if ( !isset($this_widget_img_content['slideContentAlign'])  || $this_widget_img_content['slideContentAlign'] == '' ) { $this_widget_img_content['slideContentAlign'] = 'center';  }

                  $imgwccavMargin = ''; $imgwccahMargin =''; $imgwccav = ''; $imgwccah = ''; 

                  if ($this_widget_img_content['imgwccav'] == 'middle') {
                    $imgwccav = '50%';
                  }

                  if ($this_widget_img_content['imgwccav'] == 'top') {
                    $imgwccav = '0%';
                  }
                  if ($this_widget_img_content['imgwccav'] == 'bottom') {
                    $imgwccav = '0%';
                    $imgwccavMargin = 'bottom:0%; top:inherit;';
                  }

                  
                  if ($this_widget_img_content['imgwccah'] == 'center') {
                    $imgwccah = '50%';
                    $imgwccahMargin = 'margin:0 auto;';
                  }
                  
                  if ($this_widget_img_content['imgwccah'] == 'left') {
                    $imgwccah = '0%';
                  }

                  if ($this_widget_img_content['imgwccah'] == 'right') {
                    $imgwccah = '0%';
                    $imgwccahMargin = 'left:inherit; right: 0;';
                  }

                  $captionContentAlignmentCss =
                    'position: absolute;'.
                    'top: '.$imgwccav.';'.
                    'left: '.$imgwccah.';'.
                    'transform: translate(-'.$imgwccah.', -'.$imgwccav.');'.
                    '-ms-transform: translate(-'.$imgwccah.', -'.$imgwccav.');'.
                    '-webkit-transform: translate(-'.$imgwccah.', -'.$imgwccav.');'.
                    $imgwccahMargin . $imgwccavMargin
                  ;

                  if (!isset($this_widget_img_content['imgwcch']) ) { $this_widget_img_content['imgwcch'] = '50%'; }

                  if ($this_widget_img_content['imgwcch'] == '' ) {
                    $this_widget_img_content['imgwcch'] = '50%';
                  }

                  if ($this_widget_img_content['imgwcch'] == 'Fit Content' ) {
                    $imgCapContainerHeight = 'padding:4% 3%;' ;
                  }else{
                    $imgCapContainerHeight = 'height:'.esc_attr($this_widget_img_content['imgwcch']).';' ;
                  }


                  if (!isset($this_widget_img_content['imgwctsu'])  || $this_widget_img_content['imgwctsu'] == '') {
                    $this_widget_img_content['imgwctsu'] = 'px';
                  }

                  if (!isset($this_widget_img_content['imgwctav']) ) { $this_widget_img_content['imgwctav'] = 'center'; }

                  $captionContentTextVAlignmentCss = 
                    'display: flex;'.
                    'justify-content: '.esc_attr($this_widget_img_content['imgwctav']).';'.
                    'flex-direction: column;'
                  ;

                  if(1 === preg_match('~[0-9]~', $this_widget_img_content['imgwctff'])){
                    $this_widget_img_content['imgwctff'] = "'".esc_attr($this_widget_img_content['imgwctff'])."'";
                  }

                  $captionContainerStyles = 

                    'min-width: '.esc_attr($this_widget_img_content['imgwccw']).esc_attr($this_widget_img_content['imgwccwu']).';'.
                    $captionContentAlignmentCss.
                    $imgCapContainerHeight.
                    'background: '.esc_attr($this_widget_img_content['imgwccbg']).'; '.
                    'font-size:'.esc_attr($this_widget_img_content['imgwcts']).esc_attr($this_widget_img_content['imgwctsu']).';'.
                    'font-family: '.str_replace('+', ' ', $this_widget_img_content['imgwctff']).',sans-serif;'.
                    'color:'.esc_attr($this_widget_img_content['imgwctc']).';'.
                    'border-radius:'.esc_attr($this_widget_img_content['imgwccbr']).'px;'.
                    'line-height:1.35em;'.
                    $captionContentTextVAlignmentCss .
                    $hideImageCaption
                  ;

                  array_push($thisColFontsToLoad, $this_widget_img_content['imgwctff']);


                  $captionContentTextAlignmentCss = 
                    'text-align:'.esc_attr($this_widget_img_content['imgwcta']).';'.
                    'padding:5% 3%;'
                  ;
                  

                  $captionHTML =
                    '<div class="img-caption-'.$uniqueImgId.' img-caption" style="'.$captionContainerStyles.'">'.
                      '<div class="img-caption-inner" style="'.$captionContentTextAlignmentCss.'">'.$this_widget_img_content['imgwcap'].'</div>'.
                    '</div>'
                  ;


                  $imgWidgetCaptionShowOnHoverScript = ''; $imageWidgetMouseenterScripts =''; $imageWidgetMouseleaveScripts = '';
                  if ($this_widget_img_content['imgwccdis'] == 'on hover') {
                    $imageWidgetMouseenterScripts =  
                      'jQuery(".img-caption-'.$uniqueImgId.'").slideToggle();'.
                      'jQuery(".img-caption-'.$uniqueImgId.'").css("display","flex");'
                    ;
                    $imageWidgetMouseleaveScripts = 
                      'jQuery(".img-caption-'.$uniqueImgId.'").slideToggle();'
                    ;

                    $imageWidgetHoverClickScripts =
                      
                        'jQuery(".img-caption-'.$uniqueImgId.'").parent().mouseenter(function(){'.
                          $imageWidgetMouseenterScripts.
                        '}).mouseleave(function(){'.
                          $imageWidgetMouseleaveScripts.
                        '});'.
                    '';

                    array_push($POPBallWidgetsScriptsArray, $imageWidgetHoverClickScripts);


                  }

                  $imageWidgetMouseClickScripts =''; $imageWidgetMouseClickAgainScripts = '';
                  if ($this_widget_img_content['imgwccdis'] == 'on click') {
                    $imageWidgetMouseClickScripts =  
                      'jQuery(".img-caption-'.$uniqueImgId.'").slideToggle();'.
                      'jQuery(".img-caption-'.$uniqueImgId.'").css("display","flex");'.
                      'jQuery(".img-caption-'.$uniqueImgId.'").addClass("img-caption-'.$uniqueImgId.'-imageClickedActive");'
                    ;
                    $imageWidgetMouseClickAgainScripts = 
                      'jQuery(".img-caption-'.$uniqueImgId.'").slideToggle();'.
                      'jQuery(".img-caption-'.$uniqueImgId.'").removeClass("img-caption-'.$uniqueImgId.'-imageClickedActive");'
                    ;

                    $imageWidgetHoverClickScripts =
                      
                        'jQuery(".img-caption-'.$uniqueImgId.'").parent().click(function(){'.
                          $imageWidgetMouseClickScripts.
                        '});'.
                        'jQuery(".img-caption-'.$uniqueImgId.'-imageClickedActive").parent().click(function(){'.
                          $imageWidgetMouseClickAgainScripts.
                        '});'.
                    '';

                    array_push($POPBallWidgetsScriptsArray, $imageWidgetHoverClickScripts);

                  }



                  $imgWidgetCaptionTabletResponsive = "
                    .img-caption-$uniqueImgId {
                      min-width:".$this_widget_img_content['imgwccwT'].$this_widget_img_content['imgwccwuT']." !important;
                      font-size:".$this_widget_img_content['imgwctsT'].$this_widget_img_content['imgwctsuT']." !important;
                    }

                    .img-caption-$uniqueImgId  .img-caption-inner {
                      text-align:".$this_widget_img_content['imgwctaT']." !important;
                    }
                  ";

                  $imgWidgetCaptionMobileResponsive = "
                    .img-caption-$uniqueImgId {
                      min-width:".$this_widget_img_content['imgwccwM'].$this_widget_img_content['imgwccwuM']." !important;
                      font-size:".$this_widget_img_content['imgwctsM'].$this_widget_img_content['imgwctsuM']." !important;
                    }

                    .img-caption-$uniqueImgId  .img-caption-inner {
                      text-align:".$this_widget_img_content['imgwctaM']." !important;
                    }
                  ";

                  array_push($POPBNallRowStylesResponsiveTablet, $imgWidgetCaptionTabletResponsive);
                  array_push($POPBNallRowStylesResponsiveMobile, $imgWidgetCaptionMobileResponsive);


                }


                $imgTarget = '_self';

                if (isset($this_widget_img_content['imgLinkOpen'])) {
                  $imgTarget = esc_attr($this_widget_img_content['imgLinkOpen']);
                }

                $imgLinkTag = '';
                $imgLinkTagClose = '';
                if (isset($this_widget_img_content['imgLink']) && !empty($this_widget_img_content['imgLink'])) {
                  $imgLink = esc_url($this_widget_img_content['imgLink']);
                  $imgLinkTag = '<a href="'.$imgLink.'" target="'.$imgTarget.'">';
                  $imgLinkTagClose = '</a>';
                }


                if (!isset($this_widget_img_content['imgLightBox'])) {
                  $this_widget_img_content['imgLightBox'] = 'false';
                }

                if (isset($this_widget_img_content['imgLightBox']) ) {
                  $imgLightBox = $this_widget_img_content['imgLightBox'];
                  if ($imgLightBox == 'true') {
                    
                    $this_column_img = 
                      "<div class='pb_img_thumbnail'  id='".$uniqueImgId."' style='text-align: $imgAlignment ; position:relative;'>
                        $imgLinkTag
                        <img src=".$imgUrl." alt='$imgAltText' style='display:inline; text-align:".$imgAlignment."; ".$imgCustomSize." $imgWidgetboxShadow  ' class='ftr-img-".$Columni." img-".$imgSize." '>
                        $imgLinkTagClose
                        $captionHTML
                      </div>
                      <div class='pb_single_img_lightbox' id='pb_lightbox".$uniqueImgId."'>
                        <img src='$imgUrl' alt='$imgAltText'>
                      </div><br> ";

                  } else{
                    $this_column_img = 
                      "<div id='".$uniqueImgId."' style='text-align:".$imgAlignment."; position:relative;'> 
                        $imgLinkTag 
                        <img src=".$imgUrl." alt='$imgAltText' style='display:inline; text-align:".$imgAlignment."; ".$imgCustomSize." $imgWidgetboxShadow ' class='ftr-img-".$Columni." img-".$imgSize."'>
                        $captionHTML
                        $imgLinkTagClose
                      </div>";

                  }
                }
                
                if(!isset($this_widget_img_content['imgSizeCustomHeightTablet'])){
                  $this_widget_img_content['imgSizeCustomHeightTablet'] = '';
                }

                if(!isset($this_widget_img_content['imgSizeCustomHeightMobile'])){
                  $this_widget_img_content['imgSizeCustomHeightMobile'] = '';
                }

                if ($imgSize == 'custom') {
                  if (isset($this_widget_img_content['imgSizeCustomWidthTablet'])) {
                    $thisImgSizeResponsiveWidgetStylesTablet = "
                      #$uniqueImgId img{
                      width: ".$this_widget_img_content['imgSizeCustomWidthTablet']."px !important;
                      height: ".$this_widget_img_content['imgSizeCustomHeightTablet']."px !important;
                      }
                    ";
                    $thisImgSizeResponsiveWidgetStylesMobile = "
                      #$uniqueImgId img{
                      width: ".$this_widget_img_content['imgSizeCustomWidthMobile']."px !important;
                      height: ".$this_widget_img_content['imgSizeCustomHeightMobile']."px !important;
                      }
                    ";

                    array_push($POPBNallRowStylesResponsiveTablet, $thisImgSizeResponsiveWidgetStylesTablet);
                    array_push($POPBNallRowStylesResponsiveMobile, $thisImgSizeResponsiveWidgetStylesMobile);
                  }
                }

                if (isset($this_widget_img_content['imgAlignmentTablet'])) {
                    
                    $thisImgWidgetResponsiveWidgetStylesTablet = "
                      #$uniqueImgId {
                      text-align: ".$this_widget_img_content['imgAlignmentTablet']." !important;
                      }
                    ";
                    $thisImgWidgetResponsiveWidgetStylesMobile = "
                      #$uniqueImgId {
                      text-align: ".$this_widget_img_content['imgAlignmentMobile']." !important;
                      }
                    ";

                    array_push($POPBNallRowStylesResponsiveTablet, $thisImgWidgetResponsiveWidgetStylesTablet);
                    array_push($POPBNallRowStylesResponsiveMobile, $thisImgWidgetResponsiveWidgetStylesMobile);
                  }

                $widgetJQueryLoadScripts = true;  
                $widgetContent = $this_column_img;
                $contentAlignment = $imgAlignment;

              } catch (\Throwable $th) {
                var_dump($th);
              }

            break;
            case 'wigt-menu':
              $widgetContent = $this_widget_menu;
              $widgetJQueryLoadScripts = true;
              $contentAlignment = ' ';
            break;
            case 'wigt-btn-gen':

              // BTN Widget
              $randomBtnClass = (rand(500,1000)*2)*rand(10,500);
              $this_widget_btn_content = $thisWidget['widgetButton'];
              $btnText = $this_widget_btn_content['btnText'];
              $btnAllignment = esc_attr( $this_widget_btn_content['btnButtonAlignment'] );
              $btnTextColor = esc_attr( $this_widget_btn_content['btnTextColor'] );
              $btnFontSize = esc_attr( $this_widget_btn_content['btnFontSize'] );
              $btnBgColor = esc_attr( $this_widget_btn_content['btnBgColor'] );
              $btnHeight = esc_attr( $this_widget_btn_content['btnHeight'] );
              $btnHoverBgColor = esc_attr( $this_widget_btn_content['btnHoverBgColor'] );

              if (isset( $this_widget_btn_content['btnLink'] )) {
                $btnLink = $this_widget_btn_content['btnLink'];
              }else{
                $btnLink = '#';
              }

              $btnLink = do_shortcode( $btnLink, false );

              if (isset($this_widget_btn_content['btnBlankAttr'])) {
                $btnBlankAttr = $this_widget_btn_content['btnBlankAttr'];
              }else{
                $btnBlankAttr = '';
              }
              if (isset($this_widget_btn_content['btnWidth'])) {
                $btnWidth = $this_widget_btn_content['btnWidth'];
              }else{
                $btnWidth = '5';
              }

              if (isset($this_widget_btn_content['btnButtonFontFamily'])) {
                $btnButtonFontFamily = $this_widget_btn_content['btnButtonFontFamily'];
              }else{
                $btnButtonFontFamily = '';
              }

              $btnWidthUnit = '%';
              $btnWidthUnitTablet = '%';
              $btnWidthUnitMobile = '%';
              if (isset($this_widget_btn_content['btnWidthUnit']) ) {
                $btnWidthUnit = $this_widget_btn_content['btnWidthUnit'];
                $btnWidthUnitTablet = $this_widget_btn_content['btnWidthUnitTablet'];
                $btnWidthUnitMobile = $this_widget_btn_content['btnWidthUnitMobile'];
              }


              $btnIcon = ''; $btnIconBefore = ''; $btnIconAfter = ''; $btnIconAnimation = ''; $btnIconHoverAnimationScript = '';
              if (isset($this_widget_btn_content['btnSelectedIcon']) ) {
                if (!isset($this_widget_btn_content['btnIconGap'])) {
                  $this_widget_btn_content['btnIconGap'] = '';
                }
                if (!isset($this_widget_btn_content['btnIconPosition'])) {
                  $this_widget_btn_content['btnIconPosition'] = '';
                }
                if (!isset($this_widget_btn_content['btnIconAnimation'])) {
                  $this_widget_btn_content['btnIconAnimation'] = '';
                }

                $btnSelectedIcon = esc_attr($this_widget_btn_content['btnSelectedIcon']);
                $btnIconPosition = esc_attr($this_widget_btn_content['btnIconPosition']);
                $btnIconAnimation = esc_attr($this_widget_btn_content['btnIconAnimation']);
                $btnIconGap = esc_attr($this_widget_btn_content['btnIconGap']);

                if ($btnSelectedIcon != '') {
                  if ($btnIconPosition == 'before') {
                    $btnIconGap = 'margin-right:'.$btnIconGap.'px;';
                  }else{
                    $btnIconGap = 'margin-left:'.$btnIconGap.'px;';
                  }
                  $faClassAppend = 'fa';
                  if (strpos($btnSelectedIcon, 'fab') !== false || strpos($btnSelectedIcon, 'fas') !== false || strpos($btnSelectedIcon, 'far') !== false) {
                      $faClassAppend = '';
                  }
                  $btnIcon = '<i style="'.$btnIconGap.'" class="'.$faClassAppend.' '.$btnSelectedIcon.'  btnIcon-'.$randomBtnClass.'"></i>';

                  if ($btnIconAnimation != '') {
                    $btnIconHoverAnimationScript = "
                      jQuery('.btn-".$randomBtnClass."').mouseenter(function(){
                        jQuery('.btnIcon-".$randomBtnClass."').addClass('animated ".$btnIconAnimation."').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',function(){ 
                           jQuery('.btnIcon-".$randomBtnClass."').removeClass('animated ".$btnIconAnimation."') 
                          });
                     });
                    ";
                  }
                  
                  $widgetFALoadScripts = true;
                }else{
                  $btnIcon = '';
                }

                if ($btnIconPosition == 'before') {
                  $btnIconBefore = $btnIcon;
                  $btnIconAfter = '';
                }else{
                  $btnIconAfter = $btnIcon;
                  $btnIconBefore = '';
                }
              }

              if (isset($this_widget_btn_content['btnHoverTextColor'])) {
                  $btnHoverTextColor = esc_attr($this_widget_btn_content['btnHoverTextColor']);
                } else{
                  $btnHoverTextColor = '';
                }

              $POPB_buton_width = "padding: $btnHeight"."px $btnWidth"."px !important;";
              if (isset($this_widget_btn_content['btnWidthPercent'])) {
                $btnWidthPercent = esc_attr($this_widget_btn_content['btnWidthPercent']);
                if ($btnWidthPercent !== '') {
                  $POPB_buton_width = "padding: $btnHeight"."px 5"."px; width:$btnWidthPercent"."$btnWidthUnit;";
                }
              }else{
                $btnWidthPercent = '';
              }

              if (!isset( $this_widget_btn_content['btnCAction'] )) {
                 $this_widget_btn_content['btnCAction'] = '';
              }

              if (!isset($this_widget_btn_content['btnClickAction'])) {
                $this_widget_btn_content['btnClickAction'] = 'openLink';
              }

              if ($this_widget_btn_content['btnClickAction'] == 'openPopUp') {
                $btnLink = '#';
              }

              if (!isset($this_widget_btn_content['btnWidgetPopUpId'])) {
                $this_widget_btn_content['btnWidgetPopUpId'] = '';
              }

              $renderredPopUp = '';
              if ($this_widget_btn_content['btnClickAction'] == 'openPopUp') {

                $loadWpFooter = 'true';

                
                $this_widget_Optin_Id = sanitize_text_field($this_widget_btn_content['btnWidgetPopUpId']);

                if (!isset($buttonLinkedPopUps)) {
                  $buttonLinkedPopUps = array();
                }

                if (in_array($this_widget_Optin_Id, $buttonLinkedPopUps)) {
                  $this_widget_Optin_Id = '';
                }
                  
                if ($this_widget_Optin_Id != '') {
                  if (! function_exists('btn_widget_get_pluginops_optin_shortcode_from_id')) {
                    function btn_widget_get_pluginops_optin_shortcode_from_id($optin_id, $onClickId){
                      $optinData = get_post_meta( $optin_id, 'ULPB_DATA', true );
                      if ( !isset($optinData) || !is_array($optinData) ) {
                        $generatedOptinShortcode = 'Optin Not Found';
                      }

                      $generatedOptinShortcode = $optinData['campaignPlacement']['generatedShortcode'];

                      if ( !post_type_exists('pluginops_forms') ) {
                        $generatedOptinShortcode = 'PluginOps Optin Builder Is not Active.';
                      }

                      $shortcodeToArray = shortcode_parse_atts($generatedOptinShortcode);


                      $shortcodeToArray['onclick'] = $onClickId;
                      if (!isset( $shortcodeToArray['exitanimation'] )) {
                        $shortcodeToArray['exitanimation'] = '';
                      }
                      if (!isset( $shortcodeToArray['entranceanimation'] )) {
                        $shortcodeToArray['entranceanimation'] = '';
                      }
                      if (!isset( $shortcodeToArray['template_id'] )) {
                        $shortcodeToArray['template_id'] = 'none';
                      }
                      if ($shortcodeToArray[0] == '[pluginops_form') {
                        $shortcodeToArray[0] = '[pluginops_popup_form';
                      }
                      
                      $generatedOptinShortcode = ' '.$shortcodeToArray[0].' template_id='.$shortcodeToArray['template_id'].' onclick='.$shortcodeToArray['onclick'].' entranceanimation='.$shortcodeToArray['entranceanimation'].' exitanimation='.$shortcodeToArray['exitanimation'].' ]';

                      if ($shortcodeToArray[0] == '[pluginops_bar_form' || $shortcodeToArray[0] == '[pluginops_flyin_form' ) {
                        $generatedOptinShortcode = ' '.$shortcodeToArray[0].' template_id='.$shortcodeToArray['template_id'].' onclick='.$shortcodeToArray['onclick'].' position='.$shortcodeToArray['position'].'  entranceanimation='.$shortcodeToArray['entranceanimation'].' exitanimation='.$shortcodeToArray['exitanimation'].' ]';
                      }

                      return $generatedOptinShortcode;
                    }
                  }
                  $onClickId = 'btnLink-'.$this_widget_Optin_Id;

                  $renderredPopUp = do_shortcode( btn_widget_get_pluginops_optin_shortcode_from_id($this_widget_Optin_Id, $onClickId ) );

                  array_push($buttonLinkedPopUps,$this_widget_Optin_Id);
                  
                }
              }

              $btnpreventDefault = '' ; $btnredirectToLink = '';
              if ($btnBlankAttr !== '_blank') {
                $btnpreventDefault = 'e.preventDefault();';
                $btnredirectToLink  = "location.href = '".esc_url($btnLink)."';";
              }

              

              if (function_exists('ulpb_available_pro_widgets') ) {


                if (strpos($btnLink, 'http') !== false && $landingPageLinkTrackingFeatureisEnabled == true) {
                  
                  $thisPageLink = get_preview_post_link($post->ID);
                  
                  if ( get_post_status( $post->ID ) == 'publish') {
                    $thisPageLink = str_replace('?preview=true', '' ,$thisPageLink );
                  }
                  $thisPageLinkParsed = parse_url($thisPageLink);

                  if (isset($thisPageLinkParsed['query'])) {
                    if ($thisPageLinkParsed['query']) {
                    $btnLink = $thisPageLink."&popb_pID=".$current_pageID."&popb_track_url=".urlencode($btnLink);
                    }else{
                      $btnLink = $thisPageLink."?popb_pID=".$current_pageID."&popb_track_url=".urlencode($btnLink);
                    }
                  }else{
                    $btnLink = $thisPageLink."?popb_pID=".$current_pageID."&popb_track_url=".urlencode($btnLink);
                  }

                }

                if ($this_widget_btn_content['btnClickAction'] == 'addToCart') {
                  $btnLink = wc_get_cart_url().'?add-to-cart='.$this_widget_btn_content['btnWooProdID'];
                }

                if ($this_widget_btn_content['btnClickAction'] == 'addToCheckout') {
                  $btnLink = wc_get_checkout_url().'?add-to-cart='.$this_widget_btn_content['btnWooProdID'];
                }

              }
                

              $btnBorderColor = esc_attr( $this_widget_btn_content['btnBorderColor'] );
              $btnBorderWidth = esc_attr( $this_widget_btn_content['btnBorderWidth'] );
              $btnBorderRadius = esc_attr( $this_widget_btn_content['btnBorderRadius'] );

              if(1 === preg_match('~[0-9]~', $btnButtonFontFamily)){
                $btnButtonFontFamily = "'".$btnButtonFontFamily."'";
              }


              if($this_widget_btn_content['btnClickAction'] !== 'openPopUp'){
                $this_widget_btn_content['btnWidgetPopUpId'] = '';
              }
                
              $thisBtnStyles = "style=\"color:$btnTextColor ;font-size:$btnFontSize"."px ; background: $btnBgColor ; background-color: $btnBgColor;  $POPB_buton_width  border: $btnBorderWidth"."px solid $btnBorderColor !important; border-radius: $btnBorderRadius"."px !important; text-align:center; font-family:".str_replace('+', ' ', $btnButtonFontFamily)." ,sans-serif;\" ";

              $this_btn_click_detectionScript = "
                <style> .btn-$randomBtnClass:hover{ background-color: $btnHoverBgColor !important; background: $btnHoverBgColor !important; color:$btnHoverTextColor !important; transition: all .5s; }   .btn-$randomBtnClass { transition: all .5s; } </style>  ";
              $this_widget_btn = $renderredPopUp."
                <div class='wdt-$this_column_type parent-btn-$randomBtnClass' style='text-align:$btnAllignment;margin:0 0 2px 0; padding:0;' >
                  <a href='".esc_url($btnLink)."' style='text-decoration:none !important;' target='$btnBlankAttr' id='btnLink-$randomBtnClass' ".$this_widget_btn_content['btnCAction']." >
                    <button class='btn-$randomBtnClass btnLink-".$this_widget_btn_content['btnWidgetPopUpId']."' $thisBtnStyles >$btnIconBefore $btnText  $btnIconAfter</button>
                  </a>
                </div> $this_btn_click_detectionScript 
                ";

                if (isset($this_widget_btn_content['btnButtonAlignmentTablet']) || isset($this_widget_btn_content['btnButtonAlignmentMobile']) ) {

                  if (!isset($this_widget_btn_content['btnButtonAlignmentTablet'])) {
                    $this_widget_btn_content['btnButtonAlignmentTablet'] = '';
                  }
                  if (!isset($this_widget_btn_content['btnButtonAlignmentMobile'])) {
                    $this_widget_btn_content['btnButtonAlignmentMobile'] = '';
                  }
                  $thisButtonWidgetResponsiveAlignmentTablet = "
                  .parent-btn-$randomBtnClass {
                    text-align:".$this_widget_btn_content['btnButtonAlignmentTablet']." !important;
                  }
                  ";
                  $thisButtonWidgetResponsiveAlignmentMobile = "
                  .parent-btn-$randomBtnClass {
                    text-align:".$this_widget_btn_content['btnButtonAlignmentMobile']." !important;
                  }
                  ";

                  array_push($POPBNallRowStylesResponsiveTablet, $thisButtonWidgetResponsiveAlignmentTablet);
                  array_push($POPBNallRowStylesResponsiveMobile, $thisButtonWidgetResponsiveAlignmentMobile);
                }
                  
                  $thisButtonWidgetResponsiveWidgetStylesTablet = "            

                    #widget-$j-$Columni-".$row["rowID"]."  .btn-$randomBtnClass {
                     font-size: ".$this_widget_btn_content['btnFontSizeTablet']."px !important;
                     width: ".$this_widget_btn_content['btnWidthPercentTablet']."$btnWidthUnitTablet !important;
                     padding: ".$this_widget_btn_content['btnHeightTablet']."px 5px !important;
                    }
                  ";

                  $thisButtonWidgetResponsiveWidgetStylesMobile = "
                    #widget-$j-$Columni-".$row["rowID"]."  .btn-$randomBtnClass {
                     font-size: ".$this_widget_btn_content['btnFontSizeMobile']."px !important;
                     width: ".$this_widget_btn_content['btnWidthPercentMobile']."$btnWidthUnitMobile !important;
                     padding: ".$this_widget_btn_content['btnHeightMobile']."px 5px !important;
                    }
                  ";

                  array_push($POPBNallRowStylesResponsiveTablet, $thisButtonWidgetResponsiveWidgetStylesTablet);
                  array_push($POPBNallRowStylesResponsiveMobile, $thisButtonWidgetResponsiveWidgetStylesMobile);



                array_push($thisColFontsToLoad, $btnButtonFontFamily);
                array_push($POPBallWidgetsScriptsArray, $btnIconHoverAnimationScript);
                $widgetJQueryLoadScripts = true;

                $widgetContent = $this_widget_btn;
                $contentAlignment = ' ';
            break;
            case 'wigt-pb-form':

                ob_start();
                $this_widget_subscribeForm = $thisWidget['widgetSubscribeForm'];
                $pbFormID = (rand(500,1000)*2)*rand(10,500);
                $formLayout = $this_widget_subscribeForm['formLayout'];
                $showNameField = $this_widget_subscribeForm['showNameField'];
                $successAction = $this_widget_subscribeForm['successAction'];
                $successURL = $this_widget_subscribeForm['successURL'];
                $successMessage = $this_widget_subscribeForm['successMessage'];
                $formBtnText = $this_widget_subscribeForm['formBtnText'];
                $formBtnHeight = $this_widget_subscribeForm['formBtnHeight'];
                $formBtnBgColor = $this_widget_subscribeForm['formBtnBgColor'];
                $formBtnColor = $this_widget_subscribeForm['formBtnColor'];
                $formBtnHoverBgColor = $this_widget_subscribeForm['formBtnHoverBgColor'];
                $formBtnFontSize = $this_widget_subscribeForm['formBtnFontSize'];
                $formBtnBorderWidth = $this_widget_subscribeForm['formBtnBorderWidth'];
                $formBtnBorderColor = $this_widget_subscribeForm['formBtnBorderColor'];
                $formBtnBorderRadius = $this_widget_subscribeForm['formBtnBorderRadius'];

                if (isset($this_widget_subscribeForm['formDataSaveType'])) {
                  $formDataSaveType = $this_widget_subscribeForm['formDataSaveType'];
                } else{
                  $formDataSaveType = '';
                }
                if (isset($this_widget_subscribeForm['formBtnFontFamily'])) {
                  $formBtnFontFamily = $this_widget_subscribeForm['formBtnFontFamily'];
                  $formBtnFontFamily = str_replace('+', ' ', $this_widget_subscribeForm['formBtnFontFamily']);
                  if(1 === preg_match('~[0-9]~', $formBtnFontFamily)){
                    $formBtnFontFamily = "'".$formBtnFontFamily."'";
                  }

                  array_push($thisColFontsToLoad, $this_widget_subscribeForm['formBtnFontFamily']);
                } else{
                  $formBtnFontFamily = '';
                }

                if (isset($this_widget_subscribeForm['formSuccessMessageColor'])) {
                  $formSuccessMessageColor = $this_widget_subscribeForm['formSuccessMessageColor'];
                } else{
                  $formSuccessMessageColor = '#333';
                }
                if (isset($this_widget_subscribeForm['formBtnHoverTextColor'])) {
                  $formBtnHoverTextColor = $this_widget_subscribeForm['formBtnHoverTextColor'];
                } else{
                  $formBtnHoverTextColor = '';
                }

                if (isset($this_widget_subscribeForm['formBtnHeightTablet'])) {
                  $formBtnHeightTablet = $this_widget_subscribeForm['formBtnHeightTablet'];
                  $formBtnHeightMobile = $this_widget_subscribeForm['formBtnHeightMobile'];

                  $formBtnFontSizeTablet = $this_widget_subscribeForm['formBtnFontSizeTablet'];
                  $formBtnFontSizeMobile = $this_widget_subscribeForm['formBtnFontSizeMobile'];
                }else{
                  $formBtnHeightTablet = '';
                  $formBtnHeightMobile = '';
                  $formBtnFontSizeTablet = '';
                  $formBtnFontSizeMobile = '';
                }

                $randomFormBtnClass = (rand(500,1000)*2)*rand(10,500);
                $formbtnIcon = ''; $formbtnIconBefore = ''; $formbtnIconAfter = ''; $formbtnIconAnimation = ''; $formbtnIconHoverAnimationScript = '';
                if (isset($this_widget_subscribeForm['formbtnSelectedIcon']) ) {
                  $formbtnSelectedIcon = $this_widget_subscribeForm['formbtnSelectedIcon'];
                  $formbtnIconPosition = $this_widget_subscribeForm['formbtnIconPosition'];
                  $formbtnIconAnimation = $this_widget_subscribeForm['formbtnIconAnimation'];
                  $formbtnIconGap = $this_widget_subscribeForm['formbtnIconGap'];

                  if ($formbtnSelectedIcon != '') {
                    if ($formbtnIconPosition == 'before') {
                      $formbtnIconGap = 'margin-right:'.$formbtnIconGap.'px;';
                    }else{
                      $formbtnIconGap = 'margin-left:'.$formbtnIconGap.'px;';
                    }
                    $faClassAppend = 'fa';
                    if (strpos($formbtnSelectedIcon, 'fab') !== false || strpos($formbtnSelectedIcon, 'fas') !== false || strpos($formbtnSelectedIcon, 'far') !== false) {
                        $faClassAppend = '';
                    }
                    $formbtnIcon = '<i style="'.$formbtnIconGap.'" class="'.$faClassAppend.' '.$formbtnSelectedIcon.'  btnIcon-'.$randomFormBtnClass.'"></i>';

                    if ($formbtnIconAnimation != '') {
                      $formbtnIconHoverAnimationScript = "
                        jQuery('.form-btn-".$randomFormBtnClass."').mouseenter(function(){
                          jQuery('.btnIcon-".$randomFormBtnClass."').addClass('animated ".$formbtnIconAnimation."').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',function(){ 
                             jQuery('.btnIcon-".$randomFormBtnClass."').removeClass('animated ".$formbtnIconAnimation."') 
                            });
                       });

                      ";
                    }
                    
                    $widgetFALoadScripts = true;
                  }else{
                    $formbtnIcon = '';
                  }

                  if ($formbtnIconPosition == 'before') {
                    $formbtnIconBefore = $formbtnIcon;
                    $formbtnIconAfter = '';
                  }else{
                    $formbtnIconAfter = $formbtnIcon;
                    $formbtnIconBefore = '';
                  }
                }

                 $formLayoutAction = " ";
                $formFieldWidth = '60%';
                $formButtonWidth = '30%';
                $showNameFieldType = 'hidden';
                $fieldsMarginTop = ' margin-top : 0;';
                $fieldsMarginRight = '';
                $showNameFieldValue = ' ';
                $showFieldsInline = 'inline-block';
                if ($showNameField  == 'block') { $formFieldWidth = '33%';  $showNameFieldType = 'text';  $showNameFieldValue = ''; }
                if ($showNameField  == 'block' && $formLayout  == 'inline' ){
                  $showNameField = 'inline-block';
                  $showFieldsInline = 'inline-block';
                  $formButtonWidth = '25%';
                  $fieldsMarginTop = ' margin-top : 0;';
                  $fieldsMarginRight = 'margin-right:2.5%;';
                }
                if ($formLayout  == 'stacked') { $showFieldsInline = '';  $formLayoutAction = " "; $formFieldWidth = '99%'; $formButtonWidth = '99%'; $fieldsMarginTop = ' margin-top : 20px;'; }
                
                $inputNameStyles = "display:".$showNameField."; width:".$formFieldWidth."; padding: ".$formBtnHeight."px 5px; height:auto; font-size:".$formBtnFontSize."px; $fieldsMarginTop  $fieldsMarginRight";
                $inputEmailStyles = "display:$showFieldsInline; width:".$formFieldWidth."; padding: ".$formBtnHeight."px 5px; height:auto; font-size:".$formBtnFontSize."px; $fieldsMarginTop  $fieldsMarginRight";
                $inputButtonStyles = "display:$showFieldsInline; width:".$formButtonWidth."; padding: ".$formBtnHeight."px ".'10'."px; font-size:".$formBtnFontSize."px; background:".$formBtnBgColor."; color:".$formBtnColor."; border: ".$formBtnBorderWidth."px solid ".$formBtnBorderColor." !important; border-radius: ".$formBtnBorderRadius."px !important; font-family:$formBtnFontFamily;   $fieldsMarginTop ";

                $this_widget_form_inputID = " <input type='hidden' name='sm_pID' value='".$current_pageID."'> ";
                $this_widget_form_inputName = "<input type='$showNameFieldType' name='sm_name' placeholder='Your name' style='".$inputNameStyles."' value='$showNameFieldValue' >".$formLayoutAction;
                $this_widget_form_inputEmail = "<input type='email' name='sm_email' placeholder='Your e-mail' style='".$inputEmailStyles."' >".$formLayoutAction.$formLayoutAction;
                $this_widget_form_inputSubmit = "<button type='submit' class='form-btn-$randomFormBtnClass'  style=\".$inputButtonStyles.\" > $formbtnIconBefore ".$formBtnText." $formbtnIconAfter </button>";

                $this_widget_form_ExtraFields = " <input type='hidden' name='postsID' value='$current_pageID'>       
                                <input type='hidden' name='pbFormTargetInfo' value='$rowCount \n  $Columni \n $j '>
                                <input type='text' id='enteryourmessagehere' name='entermessagehere'> "; 

                $SfactionURL = admin_url('admin-ajax.php?action=ulpb_subscribeForm_data');
                if (empty($formDataSaveType)) {
                  $SfactionURL = admin_url('admin-ajax.php?action=ulpb_subscribeForm_data');
                } elseif ($formDataSaveType == 'database') {
                  $SfactionURL = admin_url('admin-ajax.php?action=ulpb_subscribeForm_data');
                } elseif ($formDataSaveType == 'mailchimp') { 
                  $SfactionURL = admin_url('admin-ajax.php?action=ulpb_subscribeForm_mailchimp_data');
                }


               echo $this_widget_form = "<form id='ulpb_form".$pbFormID."' action='".$SfactionURL."' method='post' class='pluginops-subscribe-form'> ".$this_widget_form_inputID.$this_widget_form_inputName." ".$this_widget_form_inputEmail. '  ' .$this_widget_form_ExtraFields."  ".wp_nonce_field('POPB_send_Subsform_data','POPB_SubsForm_Nonce')." ".$this_widget_form_inputSubmit."<p id='pluginops-response' style='color:".$formSuccessMessageColor.";'></p> </form>
                  <style>.form-btn-$randomFormBtnClass:hover{ background:$ !important; background-color:$formBtnHoverBgColor !important; color:$formBtnHoverTextColor !important; transition:all 0.5s;}  </style>
                ";

                $successMessage = str_replace("'", "\'", $successMessage);

                $successMessage = str_replace('"', '\"', $successMessage);

                $successMessage = str_replace("\n", ' <br> ', $successMessage);

                $this_form = ob_get_contents();
                ob_end_clean();


                ob_start();
                ?>
                <script>
                  (function($){
                    $(document).ready(function() {

                    $('#enteryourmessagehere').hide();
                    
                    $('#ulpb_form'+'<?php echo $pbFormID; ?>').on('submit', function()  {
                      var successAction = "<?php echo sanitize_text_field($successAction); ?>";
                      var successMessage = "<?php echo sanitize_text_field($successMessage); ?>";
                      var successURL = "<?php echo esc_url($successURL); ?>";
                      $('#pluginops-response').hide();
                      var formActionType = '<?php echo "$formDataSaveType"; ?>';
                      var form = $(this);
                      var result = " ";
                        $.ajax({
                          url: form.attr('action'),
                          method: form.attr('method'),
                          data: form.serialize(),
                          success: function(result){
                            var result = JSON.parse(result);

                            if (formActionType == 'mailchimp') {
                              var mcResult = result['mailchimp'];
                            }if (formActionType == 'getresponse') {
                              var mcResult = result['getResponse'];
                            }else{
                              var mcResult = result['database'];
                            }
                            
                            if(mcResult == 'success'){
                              $('#ulpb_form'+'<?php echo $pbFormID; ?> #pluginops-response').html(successMessage);
                              $('#ulpb_form'+'<?php echo $pbFormID; ?> #pluginops-response').show('slow');
                              setTimeout(function(){
                                $('.pluginops-modal').fadeOut();
                              } , 2000);

                              if (successAction == 'redirect') {
                                location.href = successURL;
                              }
                            } else if(mcResult == 'Subscriber Already Exists'){
                              $('#ulpb_form'+'<?php echo $pbFormID; ?> #pluginops-response').html(successMessage);
                              $('#ulpb_form'+'<?php echo $pbFormID; ?> #pluginops-response').show('slow');
                              setTimeout(function(){
                                $('.pluginops-modal').fadeOut();
                              } , 2000);
                              if (successAction == 'redirect') {
                                location.href = successURL;
                              }
                            } else{
                              $('#ulpb_form'+'<?php echo $pbFormID; ?> #pluginops-response').html(mcResult);
                              $('#ulpb_form'+'<?php echo $pbFormID; ?> #pluginops-response').show('slow');
                            }

                            console.log('MailChimp Result  : ' + result['mailchimp']);
                            console.log('Database Result  : ' + result['database']);
                            console.log('GetResponse Result  : ' + result['getResponse']);
                            console.log('Campaign Monitor Result  : ' + result['campaignMonitor']);
                            console.log('Active Campaign Result  : ' + result['activeCampaign']);
                            console.log('Drip Result  : ' + result['drip']);

                          }
                      });
                         
                        // Prevents default submission of the form after clicking on the submit button. 
                        return false;   
                    });

                  });

                    })(jQuery);

                  </script>
                <?php 

                

                $this_form_Scripts = ob_get_contents();
                ob_end_clean();

                $this_form_Scripts = str_replace('<script>', ' ',$this_form_Scripts);
                $this_form_Scripts = str_replace('</script>', ' ',$this_form_Scripts);

                $thisWidgetResponsiveWidgetStylesTablet = "
                  #ulpb_form$pbFormID input {
                    font-size: ".$formBtnFontSizeTablet."px !important;
                    padding-top: ".$formBtnHeightTablet."px !important;
                    padding-bottom: ".$formBtnHeightTablet."px !important;
                  }
                ";
                $thisWidgetResponsiveWidgetStylesMobile = "
                  #ulpb_form$pbFormID input {
                    font-size: ".$formBtnFontSizeMobile."px !important;
                    padding-top: ".$formBtnHeightMobile."px !important;
                    padding-bottom: ".$formBtnHeightMobile."px !important;
                  }
                ";


                array_push($POPBNallRowStylesResponsiveTablet, $thisWidgetResponsiveWidgetStylesTablet);
                array_push($POPBNallRowStylesResponsiveMobile, $thisWidgetResponsiveWidgetStylesMobile);

                array_push($POPBallWidgetsScriptsArray, $formbtnIconHoverAnimationScript);
                array_push($POPBallWidgetsScriptsArray, $this_form_Scripts);
                $widgetJQueryLoadScripts = true;

                $widgetContent = $this_form;
                $contentAlignment = ' ';
            break;
            case 'wigt-video':
              
                $this_widget_widgetVideo = $thisWidget['widgetVideo'];
                $videoWebM = esc_url($this_widget_widgetVideo['videoWebM']);
                $videoMpfour = esc_url($this_widget_widgetVideo['videoMpfour']);
                $videoThumb = esc_url($this_widget_widgetVideo['videoThumb']);
                $vidAutoPlay = esc_attr($this_widget_widgetVideo['vidAutoPlay']);
                $vidLoop = esc_attr($this_widget_widgetVideo['vidLoop']); 
                $vidControls = sanitize_text_field($this_widget_widgetVideo['vidControls']);

                if ($vidAutoPlay == 'autoplay') {
                  $vidAutoPlay = "autoplay='autoplay' muted";
                }

                $widgetVideoRender = "<video ".$vidLoop." ".$vidAutoPlay." poster='".$videoThumb."' class='pbp_renderVideo video-js vjs-default-skin vjs-big-play-centered vjs-fluid' style='width:100%;' ".$vidControls."='true'  data-setup='{}' ><source src='".$videoWebM."' type='video/webm'><source src='".$videoMpfour."' type='video/mp4'></video>";
                $widgetContent = $widgetVideoRender;

                $widgetVideoLoadScripts = true;
            break;
            case 'wigt-pb-postSlider':
              $this_widget_postsSlider = $thisWidget['widgetPBPostsSlider'];

              $widgetPostsSliderExternalScripts = true;

              include ULPB_PLUGIN_PATH.'/public/templates/widgets/widget-postslider.php';

              $widgetJQueryLoadScripts = true;
              array_push($POPBallWidgetsScriptsArray, $psInitJS);

              $widgetContent = " \n  ".$PSlider;

              $widgetOwlLoadScripts = true;
            break;
              case 'wigt-pb-icons':
                $this_widget_widgetIcons = $thisWidget['widgetIcons'];
                $pbSelectedIcon = esc_attr($this_widget_widgetIcons['pbSelectedIcon']);
                $pbIconSize = esc_attr($this_widget_widgetIcons['pbIconSize']);
                $pbIconRotation = esc_attr($this_widget_widgetIcons['pbIconRotation']);
                $pbIconColor = esc_attr($this_widget_widgetIcons['pbIconColor']);
                $iconPadding =  (int)$pbIconSize / 3 + 5;
                $randomClass = (rand(500,1000)*2)*rand(10,500);

                $pbIconLinkOpen = '_self';
                if( isset($this_widget_widgetIcons['pbIconLinkOpen']) ){
                  $pbIconLinkOpen = esc_attr($this_widget_widgetIcons['pbIconLinkOpen']);
                }

                $pbIcStyle = 'none'; $pbIcBgC = ''; $pbIcBC = ''; $pbIcBW = ''; $pbIcBR = '';
                if ( isset($this_widget_widgetIcons['pbIcStyle']) ) {
                  if ($this_widget_widgetIcons['pbIcStyle'] == 'solid') {
                    $pbIcStyle = $this_widget_widgetIcons['pbIcStyle'];
                    $pbIcBgC = esc_attr($this_widget_widgetIcons['pbIcBgC']);
                    $pbIcBC = esc_attr($this_widget_widgetIcons['pbIcBC']);
                    $pbIcBW = esc_attr($this_widget_widgetIcons['pbIcBW']);
                    $pbIcBR = esc_attr($this_widget_widgetIcons['pbIcBR']);
                  }
                }

                if ($pbIcBC == '') { $pbIcBC = $pbIconColor; }
                $iconTextShadow = '';
                if (isset( $this_widget_widgetIcons['pbIcSC'] )) {
                  $iconTextShadow = 'text-shadow: '.esc_attr($this_widget_widgetIcons['pbIcSHP']).'px '.esc_attr($this_widget_widgetIcons['pbIcSVP']).'px '.esc_attr($this_widget_widgetIcons['pbIcSDB']).'px  '.esc_attr($this_widget_widgetIcons['pbIcSC']).' ;';
                }

                $widgetIconStyles = 'transform: rotate('.$pbIconRotation. 'deg); color:'.$pbIconColor.'; font-size:'.$pbIconSize.'px; margin:0 auto; '.$iconTextShadow ;

                if ($pbIcStyle == 'solid') {
                  $widgetIconStyles = 'transform: rotate('.$pbIconRotation. 'deg); color:'.$pbIconColor.'; font-size:'.$pbIconSize.'px; padding:'.$iconPadding.'px;  border:'.$pbIcBW.'px solid '.$pbIcBC.'; border-radius:'.$pbIcBR.'px; background:'.$pbIcBgC.';  display: flex; align-items: center; justify-content: center; margin:0 auto;'.$iconTextShadow;
                }

                if (isset($this_widget_widgetIcons['pbIconLink']) && !empty($this_widget_widgetIcons['pbIconLink'])) {
                  $pbIconLink = esc_url($this_widget_widgetIcons['pbIconLink']);
                  $pbIconLinkHTMl = '<a href='.$pbIconLink.' style="text-decoration:none;" target='.$pbIconLinkOpen.'>';
                  $pbIconLinkHTMlclose = '</a>';
                }else{
                  $pbIconLinkHTMl = '';
                  $pbIconLinkHTMlclose = '';
                }

                if (!isset($this_widget_widgetIcons['pbIcHAn'])) {
                  $this_widget_widgetIcons['pbIcHAn'] = '';
                }
                
                $hoverStyles = '';
                if ( isset($this_widget_widgetIcons['pbIcHC'])) {
                  $hoverStyles = "<style>
                    .icon-".$randomClass.":hover {
                      color:".$this_widget_widgetIcons['pbIcHC']." !important;
                      background: ".$this_widget_widgetIcons['pbIcHBgC']." !important;
                      transition: all 1s;
                    }
                    .icon-".$randomClass." {
                      transition: all 1s;
                    }
                  </style>";
                }

                $iconHoverAnimationScript = '';
                if ($this_widget_widgetIcons['pbIcHAn'] != '') {
                    $iconHoverAnimationScript = "
                      jQuery('.icon-".$randomClass."').mouseenter(function(){
                        jQuery('.icon-".$randomClass."').addClass('animated ".$this_widget_widgetIcons['pbIcHAn']."').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',function(){ 
                           jQuery('.icon-".$randomClass."').removeClass('animated ".$this_widget_widgetIcons['pbIcHAn']."');
                          });
                     });
                    ";
                }
                
                $widgetIconRender = "<div class='iconContainerDiv iconContainer-".$randomClass." ' style='text-align:center; display:flex; align-items:center; justify-content:center; '  > $pbIconLinkHTMl <i class='$pbSelectedIcon icon-".$randomClass."' style='$widgetIconStyles' ></i> $pbIconLinkHTMlclose </div>" . $hoverStyles;

                array_push($POPBallWidgetsScriptsArray, $iconHoverAnimationScript);

                $widgetContent = $widgetIconRender;
                $widgetJQueryLoadScripts = true;

                $widgetFALoadScripts = true;
              break;
              case 'wigt-pb-counter':
                $this_widget_counter = $thisWidget['widgetCounter'];
                $pbCounterID = (rand(500,1000)*2)*rand(10,500);
                $counterStartingNumber = $this_widget_counter['counterStartingNumber'];
                $counterEndingNumber = $this_widget_counter['counterEndingNumber'];
                $counterNumberPrefix = $this_widget_counter['counterNumberPrefix'];
                $counterNumberSuffix = $this_widget_counter['counterNumberSuffix'];
                $counterAnimationTime = $this_widget_counter['counterAnimationTime'];
                $counterTitle = $this_widget_counter['counterTitle'];
                $counterTextColor = $this_widget_counter['counterTextColor'];
                $counterTitleColor = $this_widget_counter['counterTitleColor'];
                $counterNumberFontSize = $this_widget_counter['counterNumberFontSize'];
                $counterTitleFontSize = $this_widget_counter['counterTitleFontSize'];

                $counterScript = "
                
                  jQuery(window).scroll(function(event){
                    jQuery('#pb_counter-".$pbCounterID."').each(function (i, el){
                      var el = jQuery(el);
                      if (el.visible(true)) {
                        el.html('$counterEndingNumber');
                        var currElementCounter = el; 
                        jQuery({ Counter: ".$counterStartingNumber." }).animate({ 
                          Counter: currElementCounter.text() 
                        },
                        { 
                          duration: ".$counterAnimationTime.", easing: 'swing',
                          step: function () { currElementCounter.text(Math.ceil(this.Counter)); 
                        }
                        });
                      }
                    }); 
                  });

                ";

                $counterHTMLStyles = 'color:'.$counterTextColor.'; font-size:'.$counterNumberFontSize.'px; line-height:1.5; text-align:center;';

                $counterTitleStyles = 'color:'.$counterTitleColor.'; font-size:'.$counterTitleFontSize.'px; line-height:1.5; text-align:center;';

                $counterTitleHTML = '<div style="'.$counterTitleStyles.'" >'.$counterTitle.'</div>';

                $counterHTML = '<div style="'.$counterHTMLStyles.'" >'.$counterNumberPrefix.'<span id="pb_counter-'.$pbCounterID.'">'.$counterEndingNumber.'</span>'.$counterNumberSuffix.' </div> '.$counterTitleHTML;

                $widgetContent = $counterHTML;
                $widgetCounterLoadScripts = true;
                $widgetJQueryLoadScripts = true;
                array_push($POPBallWidgetsScriptsArray, $counterScript);

                if ( $isPremUser == false ) { $widgetContent = "$premWidgetNotice"; }
              break;
            case 'wigt-pb-audio':
                $this_widget_audio = $thisWidget['widgetAudio'];
                $audioOgg = $this_widget_audio['audioOgg'];
                $audioMpThree = $this_widget_audio['audioMpThree'];
                $audioAutoPlay = $this_widget_audio['audioAutoPlay'];
                $audioLoop = $this_widget_audio['audioLoop'];
                $audioControls = $this_widget_audio['audioControls'];

                $audioPlayerHTML = '<br><audio '.$audioLoop.' '.$audioControls.' '.$audioAutoPlay.' style="width:100%;" > 
                  <source src="'.$audioOgg.'" type="audio/ogg">
                  <source src="'.$audioMpThree.'" type="audio/mpeg">
                  Your browser does not support the audio player. 
                </audio> <br>';
              $widgetContent = $audioPlayerHTML;
            break;
            case 'wigt-pb-cards':
              $this_widget_card = $thisWidget['widgetCard'];
              $pbSelectedCardIcon = $this_widget_card['pbSelectedCardIcon'];
              $pbCardIconSize = $this_widget_card['pbCardIconSize'];
              $pbCardIconRotation = $this_widget_card['pbCardIconRotation'];
              $pbCardIconColor = $this_widget_card['pbCardIconColor'];
              $pbCardTitleColor = $this_widget_card['pbCardTitleColor'];
              $pbCardTitleSize = $this_widget_card['pbCardTitleSize'];
              $pbCardDescColor = $this_widget_card['pbCardDescColor'];
              $pbCardDescSize = $this_widget_card['pbCardDescSize'];
              $pbCardTitle = $this_widget_card['pbCardTitle'];
              $pbCardDesc = $this_widget_card['pbCardDesc'];


              if (isset($this_widget_card['pbCardTitleSizeTablet'])) {
                  $thisCardWidgetResponsiveWidgetStylesTablet = "
                    #widget-$j-$Columni-".$row["rowID"]."  div h2 {
                     font-size: ".$this_widget_card['pbCardTitleSizeTablet']."px !important;
                    }
                    #widget-$j-$Columni-".$row["rowID"]."  div p {
                     font-size: ".$this_widget_card['pbCardDescSizeTablet']."px !important;
                    }
                  ";

                  $thisCardWidgetResponsiveWidgetStylesMobile = "
                    #widget-$j-$Columni-".$row["rowID"]."  div h2 {
                     font-size: ".$this_widget_card['pbCardTitleSizeMobile']."px !important;
                    }
                    #widget-$j-$Columni-".$row["rowID"]."  div p {
                     font-size: ".$this_widget_card['pbCardDescSizeMobile']."px !important;
                    }
                  ";

                  array_push($POPBNallRowStylesResponsiveTablet, $thisCardWidgetResponsiveWidgetStylesTablet);
                  array_push($POPBNallRowStylesResponsiveMobile, $thisCardWidgetResponsiveWidgetStylesMobile);
              }


              $cardWidgetIconStyles = 'transform: rotate('.$pbCardIconRotation. 'deg); color:'.$pbCardIconColor.'; font-size:'.$pbCardIconSize.'px;';

              $cardWidgetIcon = '<i class="'.$pbSelectedCardIcon.'" style="'.$cardWidgetIconStyles.'" ></i>';

              $cardWidgetHeading = '<h2 style="color:'.$pbCardTitleColor.'; font-size:'.$pbCardTitleSize.'px;">'.$pbCardTitle.'</h2>';

              $cardWidgetDesc = '<p style="color:'.$pbCardDescColor.'; font-size:'.$pbCardDescSize.'px;">'.$pbCardDesc.'</p>';

              $cardWidgetHTML = '<div style="text-align:center;padding:4%;">'.$cardWidgetIcon . $cardWidgetHeading . $cardWidgetDesc.'</div>';

              $widgetContent =  $cardWidgetHTML;

              $widgetFALoadScripts = true;

              if ( $isPremUser == false ) { $widgetContent = "$premWidgetNotice"; }
            break;
            case 'wigt-pb-testimonial':

              $this_widget_testimonial = $thisWidget['widgetTestimonial'];
              $tsAuthorName = $this_widget_testimonial['tsAuthorName'];
              $tsJob = $this_widget_testimonial['tsJob'];
              $tsCompanyName = $this_widget_testimonial['tsCompanyName'];
              $tsTestimonial = $this_widget_testimonial['tsTestimonial'];
              $tsUserImg = $this_widget_testimonial['tsUserImg'];
              $tsImageShape = $this_widget_testimonial['tsImageShape'];
              $tsIconColor = $this_widget_testimonial['tsIconColor'];
              $tsIconSize = $this_widget_testimonial['tsIconSize'];
              $tsTextColor = $this_widget_testimonial['tsTextColor'];
              $tsTextSize = $this_widget_testimonial['tsTextSize'];
              $tsTestimonialColor = $this_widget_testimonial['tsTestimonialColor'];
              $tsTestimonialSize = $this_widget_testimonial['tsTestimonialSize'];
              $tsTextAlignment = $this_widget_testimonial['tsTextAlignment'];

              if ( !isset($this_widget_testimonial['tsIa']) ) { $this_widget_testimonial['tsIa'] = '';  }
              if ( !isset($this_widget_testimonial['tsIt']) ) { $this_widget_testimonial['tsIt'] = '';  }

              $iconHTML = '<i class="fas fa-quote-right" style="border:2px solid '.$tsIconColor.'; padding:15px; font-size:'.$tsIconSize.'px; color:'.$tsIconColor.'; text-align:center; margin:5px 0 5px 0; border-radius:'.$tsImageShape.'; "></i>';

              if ($tsUserImg !== '') {
                $imgHTMLCenter = '<img src='.$tsUserImg.' style="width:25%; border-radius:'.$tsImageShape.';"   alt="'.$this_widget_testimonial['tsIa'].'" title="'.$this_widget_testimonial['tsIt'].'"  />';
                $imgHTMLLeft = '<img src='.$tsUserImg.' style="width:75%; border-radius:'.$tsImageShape.';"    alt="'.$this_widget_testimonial['tsIa'].'" title="'.$this_widget_testimonial['tsIt'].'"  />';
                $imgArea = 'visible';
              } else{
                $imgHTMLCenter = ''; $imgHTMLLeft = '';
                $imgArea = 'none';
              }

              $authorName = '<p style="color:'.$tsTextColor.'; font-size:'.$tsTextSize.'px;"> '.$tsAuthorName.' </p>';

              $authorinfo =  '<p style="color:'.$tsTextColor.'; font-size: calc(3 - '.$tsTextSize.'px);" >'.$tsJob.', '.$tsCompanyName.'</p>';

              $testimonialText = '<p style="color:'.$tsTestimonialColor.'; font-size:'.$tsTestimonialSize.'px ;" >'.$tsTestimonial.'</p>';


              $testimonialCardHTMLCenter = '<div style="text-align:center; padding:3% 1% 3% 1%;"> '.$iconHTML.' <br> <br>   '.$imgHTMLCenter.' '.$testimonialText.' <b>'.$authorName.'</b> '.$authorinfo.'</div>';

              $testimonialCardHTMLLeft = '<div style="padding:3% 1% 3% 1%; text-align:center;"> <div style="width:16%; display:inline-block; text-align:center; display:'.$imgArea.'; ">'.$imgHTMLLeft.' </div>   <div style="width:80%; display:inline-block; text-align:left;">'.$testimonialText.' '.$authorName.' '.$authorinfo.'</div> </div>';

              $testimonialCardHTMLRight = '<div style="padding:3% 1% 3% 1%; text-align:center;"> <div style="width:80%; display:inline-block; text-align:left; margin-left:2%; ">'.$testimonialText.' '.$authorName.' '.$authorinfo.' </div> <div style="width:16%; display:inline-block; text-align:center; display:'.$imgArea.'; ">'.$imgHTMLLeft.' </div>   </div>';

              if ($tsTextAlignment == 'center') {
                $testimonialCardHTML = $testimonialCardHTMLCenter;
              } else if ($tsTextAlignment == 'left'){
                $testimonialCardHTML = $testimonialCardHTMLLeft;
              } else if ($tsTextAlignment == 'right'){
                $testimonialCardHTML = $testimonialCardHTMLRight;
              } else{
                $testimonialCardHTML = $testimonialCardHTMLCenter;
              }

              $widgetContent = $testimonialCardHTML;
              $widgetFALoadScripts = true;
              if ( $isPremUser == false ) { $widgetContent = "$premWidgetNotice"; }
            break;
            case 'wigt-pb-shortcode':
              $this_widget_shortcode = $thisWidget['widgetShortCode'];
              $shortCodeInput = $this_widget_shortcode['shortCodeInput'];
              ob_start();
              do_shortcode( $shortCodeInput );
              $shortcodeRenderredValue = ob_get_contents();
              ob_end_clean();

              if ($shortCodeInput != '' && $shortcodeRenderredValue == '') {
                $shortcodeRenderredValue = do_shortcode( $shortCodeInput );
              }
              $widgetContent = '<div>'. $shortcodeRenderredValue . '</div>';

              $contentAlignment = ' ';
            break;
            case 'wigt-pb-countdown':

              $widgetCountDownLoadScripts = true;
              $widgetJQueryLoadScripts = true;
              
              $this_widget_countdown = $thisWidget['widgetCowntdown'];
              $pbCountDownDate = $this_widget_countdown['pbCountDownDate'];
              $pbCountDownLabel = $this_widget_countdown['pbCountDownLabel'];
              $pbCountDownColor = $this_widget_countdown['pbCountDownColor'];
              $pbCountDownLabelColor = $this_widget_countdown['pbCountDownLabelColor'];
              $pbCountDownTextSize = $this_widget_countdown['pbCountDownTextSize'];
              $pbCountDownLabelTextSize = $this_widget_countdown['pbCountDownLabelTextSize'];

              $pbcdnbw = ''; $pbcdnbc = ''; $pbcdnbs = '';
              if ( isset($this_widget_countdown['pbcdnbw']) ) {
                if (!isset($this_widget_countdown['pbcdnbs'])) {
                  $this_widget_countdown['pbcdnbs'] = 'solid';
                }
                $pbcdnbw = $this_widget_countdown['pbcdnbw'];
                $pbcdnbc = $this_widget_countdown['pbcdnbc'];
                $pbcdnbs = $this_widget_countdown['pbcdnbs'];
              }


              $pbCountDownTextSizeTablet =  ''; $pbCountDownTextSizeMobile =  ''; $pbCountDownLabelTextSizeTablet =  ''; $pbCountDownLabelTextSizeMobile =  ''; $pbCountDownLabelFontFamily = ''; $pbCountDownNumberFontFamily =  '';
              if (isset($this_widget_countdown['pbCountDownTextSizeTablet'])) {
                $pbCountDownTextSizeTablet =  $this_widget_countdown['pbCountDownTextSizeTablet'];
                $pbCountDownTextSizeMobile =  $this_widget_countdown['pbCountDownTextSizeMobile'];
                
                $pbCountDownLabelTextSizeTablet =  $this_widget_countdown['pbCountDownLabelTextSizeTablet'];
                $pbCountDownLabelTextSizeMobile =  $this_widget_countdown['pbCountDownLabelTextSizeMobile'];

                $pbCountDownLabelFontFamily =  $this_widget_countdown['pbCountDownLabelFontFamily'];
                $pbCountDownNumberFontFamily =  $this_widget_countdown['pbCountDownNumberFontFamily'];

                if(1 === preg_match('~[0-9]~', $pbCountDownLabelFontFamily)){
                  $pbCountDownLabelFontFamily = "'".$pbCountDownLabelFontFamily."'";
                }
                if(1 === preg_match('~[0-9]~', $pbCountDownNumberFontFamily)){
                  $pbCountDownNumberFontFamily = "'".$pbCountDownNumberFontFamily."'";
                }

                array_push($thisColFontsToLoad, $pbCountDownLabelFontFamily);
                array_push($thisColFontsToLoad, $pbCountDownNumberFontFamily);

              }

              $pbCountDownType = 'fixed' ; $pbCountDownNumberBgColor = 'transparent'; $pbCountDownHGap = 0; $pbCountDownHGapTablet = 0; $pbCountDownHGapMobile = 0; $pbCountDownVGap = ''; $pbCountDownVGapTablet = ''; $pbCountDownVGapMobile = ''; $pbCountDownNumberBorderRadius = '';
              $pbCountDownDateDays = ''; $pbCountDownDateHours = ''; $pbCountDownDateMins = ''; $pbCountDownDateSecs = '';
              if ( isset($this_widget_countdown['pbCountDownType']) ) {

                $pbCountDownType = $this_widget_countdown['pbCountDownType'];
                $pbCountDownNumberBgColor = $this_widget_countdown['pbCountDownNumberBgColor'];
                $pbCountDownHGap = $this_widget_countdown['pbCountDownHGap'];
                $pbCountDownHGapTablet = $this_widget_countdown['pbCountDownHGapTablet'];
                $pbCountDownHGapMobile = $this_widget_countdown['pbCountDownHGapMobile'];
                $pbCountDownVGap = ( (int)$this_widget_countdown['pbCountDownVGap'] / 2);
                $pbCountDownVGapTablet = ( (int)$this_widget_countdown['pbCountDownVGapTablet'] / 2);
                $pbCountDownVGapMobile = ( (int)$this_widget_countdown['pbCountDownVGapMobile'] / 2);

                if ($this_widget_countdown['pbCountDownVGap'] == '') {
                  $pbCountDownVGap = ( 45 / 2);
                }

                $pbCountDownNumberBorderRadius = $this_widget_countdown['pbCountDownNumberBorderRadius'];

                if ($pbCountDownType == 'evergreen') {
                  $pbCountDownDateDays = $this_widget_countdown['pbCountDownDateDays'];
                  $pbCountDownDateHours = $this_widget_countdown['pbCountDownDateHours'];
                  $pbCountDownDateMins = $this_widget_countdown['pbCountDownDateMins'];
                  $pbCountDownDateSecs = $this_widget_countdown['pbCountDownDateSecs'];
                }

              }

              // set 0
                    if ($pbCountDownDateDays == '') {
                      $pbCountDownDateDays = 0;
                    }
                    if ($pbCountDownDateHours == '') {
                      $pbCountDownDateHours = 0;
                    }
                    if ($pbCountDownDateMins == '') {
                      $pbCountDownDateMins = 0;
                    }
                    if ($pbCountDownDateSecs == '') {
                      $pbCountDownDateSecs = 0;
                    }

              $pbCountDownHGapWidth = (25- (int)$pbCountDownHGap );
              $pbCountDownHGapWidthTablet = (25- (int)$pbCountDownHGapTablet );
              $pbCountDownHGapWidthMobile = (25- (int)$pbCountDownHGapMobile );
              
              $pbCountDownTimezone = '';
              if ( isset($this_widget_countdown['pbCountDownTimezone']) ) {
                $pbCountDownTimezone = $this_widget_countdown['pbCountDownTimezone'];
              }


              $hideDays = 'inline-block';  $hideHours = 'inline-block'; $hideMinutes = 'inline-block';  $hideSeconds = 'inline-block'; 
              $daysText = 'DAYS'; $hoursText= 'HOURS'; $minutesText = 'MINUTES'; $secondsText = 'SECONDS';
              if (isset($this_widget_countdown['daysText']) ) {
                if ($this_widget_countdown['daysText'] != '') {
                  $daysText = $this_widget_countdown['daysText'];
                }
                if ($this_widget_countdown['hoursText'] != '') {
                  $hoursText = $this_widget_countdown['hoursText'];
                }
                if ($this_widget_countdown['minutesText'] != '') {
                  $minutesText = $this_widget_countdown['minutesText'];
                }
                if ($this_widget_countdown['secondsText'] != '') {
                  $secondsText = $this_widget_countdown['secondsText'];
                }
                
                if (!isset($this_widget_countdown['hideDays'])) {
                  $this_widget_countdown['hideDays'] = '';
                }
                if ($this_widget_countdown['hideDays'] != '' && $this_widget_countdown['hideDays'] != null) {
                  $hideDays = $this_widget_countdown['hideDays'];
                }

                if (!isset($this_widget_countdown['hideHours'])) {
                  $this_widget_countdown['hideHours'] = '';
                }
                if ($this_widget_countdown['hideHours'] != '' && $this_widget_countdown['hideHours'] != null) {
                  $hideHours = $this_widget_countdown['hideHours'];
                }

                if (!isset($this_widget_countdown['hideMinutes'])) {
                  $this_widget_countdown['hideMinutes'] = '';
                }
                if ($this_widget_countdown['hideMinutes'] != '' && $this_widget_countdown['hideMinutes'] != null) {
                  $hideMinutes = $this_widget_countdown['hideMinutes'];
                }

                if (!isset($this_widget_countdown['hideSeconds'])) {
                  $this_widget_countdown['hideSeconds'] = '';
                }
                if ($this_widget_countdown['hideSeconds'] != '' && $this_widget_countdown['hideSeconds'] != null) {
                  $hideSeconds = $this_widget_countdown['hideSeconds'];
                }
              }

              $countDownCookieId = 'pluginops_countdownTimer_'.$rowID.$Columni.'_'.$j;
              $countDownId = (rand(500,1000)*2)*rand(10,500);
              $countDownScript = "

                (function($){

                $(document).ready(function() {
                  if('$pbCountDownType' == 'evergreen'){

                    let todaysDate = new Date();
                    todaysTime = todaysDate.getTime();

                    let addedMinutesSeconds = todaysTime +  (((1*60000)*60)*24)*$pbCountDownDateDays  + (($pbCountDownDateHours*60000)*60) + ($pbCountDownDateMins+10)*60000 + $pbCountDownDateSecs*1000;
                    const expiryTimeForCookie = new Date(addedMinutesSeconds);
                    if(typeof($.cookie) !== 'undefined'){
                      
                      const countDownStoredTime = $.cookie('$countDownCookieId');
                      if( typeof(countDownStoredTime) == 'undefined' ){
                        document.cookie = '$countDownCookieId='+todaysTime+'; expires='+expiryTimeForCookie;
                      }else{
                        todaysTime = parseInt(countDownStoredTime);
                      }

                    }

                    addedMinutesSeconds = todaysTime +  (((1*60000)*60)*24)*$pbCountDownDateDays  + (($pbCountDownDateHours*60000)*60) + $pbCountDownDateMins*60000 + $pbCountDownDateSecs*1000;

                    pbCountDownDate = addedMinutesSeconds;

                  }else{
                    pbCountDownDate = '$pbCountDownDate';
                  }

                  if (pbCountDownDate != '') {
                    if ('$pbCountDownTimezone' != '') {
                      pbCountDownDate = moment.tz(pbCountDownDate,'$pbCountDownTimezone' );
                      pbCountDownDate = pbCountDownDate.format('YYYY/MM/DD HH:mm:ss');
                    }
                  }

                  const pbCountDownDateFinal = pbCountDownDate;
                  console.log('".$countDownId."' + '--'+ pbCountDownDateFinal);

                  const numberBlockStyles = 'width: $pbCountDownHGapWidth%; margin-right:$pbCountDownHGap%; background:$pbCountDownNumberBgColor; border-radius:".$pbCountDownNumberBorderRadius."px ;   border-width:".$pbcdnbw."px; border-color:".$pbcdnbc."; border-style:".$pbcdnbs."; ';

                  jQuery('#pb_countDown-".$countDownId."').countdown(pbCountDownDateFinal, function(event) {
                    hideDays = '$hideDays'; hideHours = '$hideHours';
                    if (hideDays == 'none') { totalHours = event.offset.totalDays * 24 + event.offset.hours; } 
                    else { totalHours =  event.offset.hours; if (totalHours < 10) { totalHours = '0'+totalHours; } }
                    if (hideHours == 'none') { totalMins = totalHours * 60 + event.offset.minutes; } 
                    else { totalMins =  event.offset.minutes;  if (totalMins < 10) { totalMins = '0'+totalMins; } }
                    jQuery(this).html(event.strftime(
                    '<div style=\"width: 100%; letter-spacing:5px; \">'+
                      '<div class=\" numberBlock \" style=\" display:$hideDays; '+numberBlockStyles+' \"><p class=\"pluginOpsCountDownNumbers\" > %D </p> <p class=\"pluginOpsCountDownLabels\" >$daysText</p></div>'+
                      '<div class=\" numberBlock \" style=\" display:$hideHours; '+numberBlockStyles+' \"><p class=\"pluginOpsCountDownNumbers\"> '+totalHours+' </p> <p class=\"pluginOpsCountDownLabels\" >$hoursText</p></div>'+
                      '<div class=\" numberBlock \" style=\" display:$hideMinutes; '+numberBlockStyles+' \"><p class=\"pluginOpsCountDownNumbers\"> '+totalMins+' </p> <p class=\"pluginOpsCountDownLabels\" >$minutesText</p></div>'+
                      '<div class=\" numberBlock \" style=\" display:$hideSeconds; '+numberBlockStyles+' \"><p class=\"pluginOpsCountDownNumbers\"> %S </p> <p class=\"pluginOpsCountDownLabels\" >$secondsText</p></div> '+
                    '</div>' ) );
                  });

                });

                })(jQuery);

              ";

              $countDownContainer = "<div id='pb_countDown-".$countDownId."' style='text-align:center;' class='pb_countDown-".$countDownId." po_countDownTimerContainer'></div>";

              $thisWidgetStyles = " <style>
                #pb_countDown-$countDownId .pluginOpsCountDownNumbers {
                  margin-top:".$pbCountDownVGap."px; margin-bottom:".$pbCountDownVGap."px; 
                  font-size:".$pbCountDownTextSize."px; color:".$pbCountDownColor."; line-height:0;
                  font-family:".str_replace('+', ' ', $pbCountDownNumberFontFamily).";

                }
                #pb_countDown-$countDownId .pluginOpsCountDownLabels {
                  margin-top:".$pbCountDownVGap."px; margin-bottom:".$pbCountDownVGap."px; 
                  font-size:".$pbCountDownLabelTextSize."px; color:".$pbCountDownLabelColor."; display:".$pbCountDownLabel."; line-height:0;
                  font-family:".str_replace('+', ' ', $pbCountDownLabelFontFamily).";
                }
                #pb_countDown-$countDownId .numberBlock { width:".$pbCountDownHGapWidth."%; margin-right:".$pbCountDownHGap."%; }
              </style> ";

              $thisWidgetResponsiveWidgetStylesTablet = "
                #pb_countDown-$countDownId .pluginOpsCountDownNumbers {
                  font-size: ".$pbCountDownTextSizeTablet."px !important;
                  margin-top:".$pbCountDownVGapTablet."px; margin-bottom:".$pbCountDownVGapTablet."px;
                }
                #pb_countDown-$countDownId .pluginOpsCountDownLabels {
                  font-size: ".$pbCountDownLabelTextSizeTablet."px !important;
                  margin-top:".$pbCountDownVGapTablet."px; margin-bottom:".$pbCountDownVGapTablet."px;
                }
                #pb_countDown-$countDownId .numberBlock { width:".$pbCountDownHGapWidthTablet."%; margin-right:".$pbCountDownHGapTablet."%; }
              ";
              $thisWidgetResponsiveWidgetStylesMobile = "
                #pb_countDown-$countDownId .pluginOpsCountDownNumbers {
                  font-size: ".$pbCountDownTextSizeMobile."px !important;
                  margin-top:".$pbCountDownVGapMobile."px; margin-bottom:".$pbCountDownVGapMobile."px;
                }
                #pb_countDown-$countDownId .pluginOpsCountDownLabels {
                  font-size: ".$pbCountDownLabelTextSizeMobile."px !important;
                  margin-top:".$pbCountDownVGapMobile."px; margin-bottom:".$pbCountDownVGapMobile."px;
                }
                #pb_countDown-$countDownId .numberBlock { width:".$pbCountDownHGapWidthMobile."%; margin-right:".$pbCountDownHGapMobile."%; }
              ";


              array_push($POPBNallRowStylesResponsiveTablet, $thisWidgetResponsiveWidgetStylesTablet);
              array_push($POPBNallRowStylesResponsiveMobile, $thisWidgetResponsiveWidgetStylesMobile);

              array_push($POPBallWidgetsScriptsArray, $countDownScript);

              $widgetSubscribeFormWidget = true;
              $widgetContent = $countDownContainer . $thisWidgetStyles;
              
              //if ( $isPremUser == false ) { $widgetContent = "$premWidgetNotice"; }
            break;
            case 'wigt-pb-imageSlider':
              include(ULPB_PLUGIN_PATH.'public/templates/widgets/widget-imageSlider.php');
              if ( $isPremUser == false ) { $widgetContent = "$premWidgetNotice"; }
            break;
            case 'wigt-pb-progressBar':
              $this_widget_progressBar = $thisWidget['widgetProgressBar'];

              $pbProgressBarTitle = $this_widget_progressBar['pbProgressBarTitle'];
              $pbProgressBarPrecentage = $this_widget_progressBar['pbProgressBarPrecentage'];
              $pbProgressBarText = $this_widget_progressBar['pbProgressBarText'];
              $pbProgressBarDisplayPrecentage = $this_widget_progressBar['pbProgressBarDisplayPrecentage'];
              $pbProgressBarTitleColor = $this_widget_progressBar['pbProgressBarTitleColor'];
              $pbProgressBarTextColor = $this_widget_progressBar['pbProgressBarTextColor'];
              $pbProgressBarColor = $this_widget_progressBar['pbProgressBarColor'];
              $pbProgressBarBgColor = $this_widget_progressBar['pbProgressBarBgColor'];
              $pbProgressBarTitleSize = $this_widget_progressBar['pbProgressBarTitleSize'];
              $pbProgressBarHeight = $this_widget_progressBar['pbProgressBarHeight'];
              $pbProgressBarTextSize = $this_widget_progressBar['pbProgressBarTextSize'];

              if (isset($this_widget_progressBar['pbProgressBarTextFontFamily'])) {



                $pbProgressBarTextFontFamily = str_replace('+', ' ', $this_widget_progressBar['pbProgressBarTextFontFamily']);
                if(1 === preg_match('~[0-9]~', $pbProgressBarTextFontFamily)){
                  $pbProgressBarTextFontFamily = "'".$pbProgressBarTextFontFamily."'";
                }

                array_push($thisColFontsToLoad, $this_widget_progressBar['pbProgressBarTextFontFamily']);
              }else{
                $pbProgressBarTextFontFamily = '';
              }

              
              $pbProgressBarUniqueId = 'pb_progressBar_'.(rand(500,1000)*2)*rand(10,500);

              $pbProgressBarHTML = '
              <p style="font-size:'.$pbProgressBarTitleSize.'px; color:'.$pbProgressBarTitleColor.';line-height:0; font-family:'.$pbProgressBarTextFontFamily.',sans-serif;" >'.$pbProgressBarTitle.'</p>

              <div id='.$pbProgressBarUniqueId.' style="background-color:'.$pbProgressBarBgColor.'; height:'.$pbProgressBarHeight.'px; position:relative;">

                <div style="position:absolute; top:'.($pbProgressBarHeight/2).'px; line-height:0; color:'.$pbProgressBarTextColor.'; font-size:'.$pbProgressBarTextSize.'px; left:2%; font-family:'.$pbProgressBarTextFontFamily.',sans-serif;">'.$pbProgressBarText.'</div>

                <div class="progressBarNumber" style="position:absolute;left:'.($pbProgressBarPrecentage-6).'%; top:'.($pbProgressBarHeight/2).'px; line-height:0; color:'.$pbProgressBarTextColor.'; font-size:'.$pbProgressBarTextSize.'px; font-family:'.$pbProgressBarTextFontFamily.',sans-serif; ">%</div>
              </div>';

              $pbProgressBarScript = '

                var thisProgressBar_'.$pbProgressBarUniqueId.' = jQuery( "#'.$pbProgressBarUniqueId.'" );
                var progressNumber_'.$pbProgressBarUniqueId.' = jQuery("#'.$pbProgressBarUniqueId.'  .progressBarNumber");

                thisProgressBar_'.$pbProgressBarUniqueId.'.progressbar({ value: 0, change: function(){
                  progressNumber_'.$pbProgressBarUniqueId.'.text(thisProgressBar_'.$pbProgressBarUniqueId.'.progressbar("value")+ "%"); 
                  progressNumber_'.$pbProgressBarUniqueId.'.css("left",thisProgressBar_'.$pbProgressBarUniqueId.'.progressbar("value")-10 + "%");
                  }   
                });
                  
                function '.$pbProgressBarUniqueId.'_pb_progress() { 
                    var val = thisProgressBar_'.$pbProgressBarUniqueId.'.progressbar( "value" ) || 0;
                    thisProgressBar_'.$pbProgressBarUniqueId.'.progressbar( "value", val + 1 );

                    if ( val <= '.($pbProgressBarPrecentage -2).' ) {
                      setTimeout( '.$pbProgressBarUniqueId.'_pb_progress, 20 ); 
                    }
                } 
                setTimeout( '.$pbProgressBarUniqueId.'_pb_progress, 500 );

              ';



              $pbProgressBarHTMLContainer = $pbProgressBarHTML;

              array_push($POPBallWidgetsScriptsArray, $pbProgressBarScript);

              array_push($POPBallWidgetsStylesArray, " #$pbProgressBarUniqueId .ui-progressbar-value{background-color: $pbProgressBarColor !important; margin:0 !important; } ");

              $widgetJQueryLoadScripts = true;

              $widgetContent = $pbProgressBarHTMLContainer;

              if ( $isPremUser == false ) { $widgetContent = "$premWidgetNotice"; }
            break;
            case 'wigt-pb-pricing':
              $this_widget_pricing = $thisWidget['widgetPricing'];
              $pbPricingHeaderText = $this_widget_pricing['pbPricingHeaderText'];
              $pbPricingContent = $this_widget_pricing['pbPricingContent'];
              $pbPricingHeaderTextColor = $this_widget_pricing['pbPricingHeaderTextColor'];
              $pbPricingHeaderBgColor = $this_widget_pricing['pbPricingHeaderBgColor'];
              $pbPricingHeaderTextSize = $this_widget_pricing['pbPricingHeaderTextSize'];
              $pbPricingBorderWidth = $this_widget_pricing['pbPricingBorderWidth'];
              $pbPricingBorderColor = $this_widget_pricing['pbPricingBorderColor'];
              $pricingbtnButtonAlignment = $this_widget_pricing['pricingbtnButtonAlignment'];
              if (isset($this_widget_pricing['pbPricingButtonSectionBgColor'])) {
                $pbPricingButtonSectionBgColor = $this_widget_pricing['pbPricingButtonSectionBgColor'];
              }else{
                $pbPricingButtonSectionBgColor = '';
              }
              

              if ($pbPricingHeaderText !== '') {
                $pricingHeader = '<div class="pb_prcingHeader" style="color:'.$pbPricingHeaderTextColor.'; background:'.$pbPricingHeaderBgColor.'; font-size:'.$pbPricingHeaderTextSize.'px; width:100%; text-align:center; padding:30px 0 35px 0; border-bottom:1px solid '.$pbPricingBorderColor.';"> <b>'.$pbPricingHeaderText.'</b> </div>';
              } else{
                $pricingHeader = '';
              }
              
              $randomBtnClass = (rand(500,1000)*2)*rand(10,500);
              $btnText = $this_widget_pricing['pricingbtnText'];
              $btnLink = $this_widget_pricing['pricingbtnLink'];
              $btnAllignment = $this_widget_pricing['pricingbtnButtonAlignment'];
              $btnTextColor = $this_widget_pricing['pricingbtnTextColor'];
              $btnFontSize = $this_widget_pricing['pricingbtnFontSize'];
              $btnBgColor = $this_widget_pricing['pricingbtnBgColor'];
              $btnHeight = $this_widget_pricing['pricingbtnHeight'];
              $btnHoverBgColor = $this_widget_pricing['pricingbtnHoverBgColor'];
              if (isset($this_widget_pricing['pricingbtnBlankAttr'])) {
                $btnBlankAttr = $this_widget_pricing['pricingbtnBlankAttr'];
              }else{
                $btnBlankAttr = '';
              }
              if (isset($this_widget_pricing['pricingbtnWidth'])) {
                $btnWidth = $this_widget_pricing['pricingbtnWidth'];
              }else{
                $btnWidth = '5';
              }

              if (isset($this_widget_pricing['pricingbtnButtonFontFamily'])) {
                $btnButtonFontFamily = $this_widget_pricing['pricingbtnButtonFontFamily'];
              }else{
                $btnButtonFontFamily = '';
              }

              $btnWidthUnit = '%';
              $btnWidthUnitTablet = '%';
              $btnWidthUnitMobile = '%';
              if (isset($this_widget_pricing['pricingbtnWidthUnit']) ) {
                $btnWidthUnit = $this_widget_pricing['pricingbtnWidthUnit'];
                $btnWidthUnitTablet = $this_widget_pricing['pricingbtnWidthUnitTablet'];
                $btnWidthUnitMobile = $this_widget_pricing['pricingbtnWidthUnitMobile'];
              }


              $btnIcon = ''; $btnIconBefore = ''; $btnIconAfter = ''; $btnIconAnimation = ''; $btnIconHoverAnimationScript = '';
              if (isset($this_widget_pricing['pricingbtnSelectedIcon']) ) {
                $btnSelectedIcon = $this_widget_pricing['pricingbtnSelectedIcon'];
                $btnIconPosition = $this_widget_pricing['pricingbtnIconPosition'];
                $btnIconAnimation = $this_widget_pricing['pricingbtnIconAnimation'];
                $btnIconGap = $this_widget_pricing['pricingbtnIconGap'];

                if ($btnSelectedIcon != '') {
                  if ($btnIconPosition == 'before') {
                    $btnIconGap = 'margin-right:'.$btnIconGap.'px;';
                  }else{
                    $btnIconGap = 'margin-left:'.$btnIconGap.'px;';
                  }
                  $faClassAppend = 'fa';
                  if (strpos($btnSelectedIcon, 'fab') !== false || strpos($btnSelectedIcon, 'fas') !== false || strpos($btnSelectedIcon, 'far') !== false) {
                      $faClassAppend = '';
                  }
                  $btnIcon = '<i style="'.$btnIconGap.'" class="'.$faClassAppend.' '.$btnSelectedIcon.'  btnIcon-'.$randomBtnClass.'"></i>';

                  if ($btnIconAnimation != '') {
                    $btnIconHoverAnimationScript = "
                      jQuery('.btn-".$randomBtnClass."').mouseenter(function(){
                        jQuery('.btnIcon-".$randomBtnClass."').addClass('animated ".$btnIconAnimation."').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',function(){ 
                           jQuery('.btnIcon-".$randomBtnClass."').removeClass('animated ".$btnIconAnimation."') 
                          });
                     });
                    ";
                  }
                  
                  $widgetFALoadScripts = true;
                }else{
                  $btnIcon = '';
                }

                if ($btnIconPosition == 'before') {
                  $btnIconBefore = $btnIcon;
                  $btnIconAfter = '';
                }else{
                  $btnIconAfter = $btnIcon;
                  $btnIconBefore = '';
                }
              }

              if (isset($this_widget_pricing['pricingbtnHoverTextColor'])) {
                  $btnHoverTextColor = $this_widget_pricing['pricingbtnHoverTextColor'];
                } else{
                  $btnHoverTextColor = '';
                }

              $POPB_buton_width = "padding: $btnHeight"."px $btnWidth"."px !important;";
              if (isset($this_widget_pricing['pricingbtnWidthPercent'])) {
                $btnWidthPercent = $this_widget_pricing['pricingbtnWidthPercent'];
                if ($btnWidthPercent !== '') {
                  $POPB_buton_width = "padding: $btnHeight"."px 5"."px !important; width:$btnWidthPercent"."$btnWidthUnit;";
                }
              }else{
                $btnWidthPercent = '';
              }

              $btnpreventDefault = '' ; $btnredirectToLink = '';
              if ($btnBlankAttr !== '_blank') {
                $btnpreventDefault = 'e.preventDefault();';
                $btnredirectToLink  = "location.href = '".esc_url($btnLink)."';";
              }
              
              $btnBorderColor = $this_widget_pricing['pricingbtnBorderColor'];
              $btnBorderWidth = $this_widget_pricing['pricingbtnBorderWidth'];
              $btnBorderRadius = $this_widget_pricing['pricingbtnBorderRadius'];
              
              $this_btn_click_detectionScript = "
                <style> .btn-$randomBtnClass:hover{ background-color: $btnHoverBgColor !important; background: $btnHoverBgColor !important; color:$btnHoverTextColor !important; transition: all .5s;}  </style>
                ";

              if(1 === preg_match('~[0-9]~', $btnButtonFontFamily)){
                $btnButtonFontFamily = "'".$btnButtonFontFamily."'";
              }

              $this_widget_btn = "
                <div class='wdt-$this_column_type parent-btn-$randomBtnClass' style='text-align:$btnAllignment; margin:0 0 2px 0; padding:0;' >
                  <a href='".esc_url($btnLink)."' style='text-decoration:none !important;' target='$btnBlankAttr' id='btnLink-$randomBtnClass'>
                    <button class='btn-$randomBtnClass' style=\"color:$btnTextColor ;font-size:$btnFontSize"."px ; background: $btnBgColor ; background-color: $btnBgColor;  $POPB_buton_width  border: $btnBorderWidth"."px solid $btnBorderColor !important; border-radius: $btnBorderRadius"."px !important; text-align:center; font-family:".str_replace('+', ' ', $btnButtonFontFamily)." ,sans-serif;\" >$btnIconBefore $btnText  $btnIconAfter</button>
                  </a>
                </div> $this_btn_click_detectionScript
                ";

                if (isset($this_widget_pricing['pricingbtnButtonAlignmentTablet'])) {
                  $thisButtonWidgetResponsiveAlignmentTablet = "
                  .parent-btn-$randomBtnClass {
                    text-align:".$this_widget_pricing['pricingbtnButtonAlignmentTablet']." !important;
                  }
                  ";
                  $thisButtonWidgetResponsiveAlignmentMobile = "
                  .parent-btn-$randomBtnClass {
                    text-align:".$this_widget_pricing['pricingbtnButtonAlignmentMobile']." !important;
                  }
                  ";

                  array_push($POPBNallRowStylesResponsiveTablet, $thisButtonWidgetResponsiveAlignmentTablet);
                  array_push($POPBNallRowStylesResponsiveMobile, $thisButtonWidgetResponsiveAlignmentMobile);
                }
                if (isset($this_widget_pricing['pricingbtnFontSizeTablet'])) {
                  if (!isset($this_widget_pricing['pricingbtnWidthPercentTablet'])) {
                    $this_widget_pricing['pricingbtnWidthPercentTablet'] = '';
                  }
                  if (!isset($this_widget_pricing['pricingbtnWidthPercentMobile'])) {
                    $this_widget_pricing['pricingbtnWidthPercentMobile'] = '';
                  }
                  
                  $thisButtonWidgetResponsiveWidgetStylesTablet = "            

                    #widget-$j-$Columni-".$row["rowID"]."  .btn-$randomBtnClass {
                     font-size: ".$this_widget_pricing['pricingbtnFontSizeTablet']."px !important;
                     width: ".$this_widget_pricing['pricingbtnWidthPercentTablet']."$btnWidthUnitTablet !important;
                     padding: ".$this_widget_pricing['pricingbtnHeightTablet']."px 5px !important;
                    }
                  ";

                  $thisButtonWidgetResponsiveWidgetStylesMobile = "
                    #widget-$j-$Columni-".$row["rowID"]."  .btn-$randomBtnClass {
                     font-size: ".$this_widget_pricing['pricingbtnFontSizeMobile']."px !important;
                     width: ".$this_widget_pricing['pricingbtnWidthPercentMobile']."$btnWidthUnitMobile !important;
                     padding: ".$this_widget_pricing['pricingbtnHeightMobile']."px 5px !important;
                    }
                  ";

                  array_push($POPBNallRowStylesResponsiveTablet, $thisButtonWidgetResponsiveWidgetStylesTablet);
                  array_push($POPBNallRowStylesResponsiveMobile, $thisButtonWidgetResponsiveWidgetStylesMobile);
                }

                array_push($thisColFontsToLoad, $btnButtonFontFamily);

                array_push($POPBallWidgetsScriptsArray, $btnIconHoverAnimationScript);

              if ($btnLink !== '') {
                $randomBtnClass = (rand(500,1000)*2)*rand(10,500);
                
                $pricingButton = "<br>
                  <div class='wdt-$this_column_type' style='text-align:".$pricingbtnButtonAlignment."; padding:20px 0 40px 0; background:".$pbPricingButtonSectionBgColor.";'> $this_widget_btn </div>";
              }else{
                $pricingButton = '';
              }

              $pricingContainer = '<div class="pb_pricingContainer"  style="border:'.$pbPricingBorderWidth.'px solid '.$pbPricingBorderColor.'; border-radius:5px; box-shadow:0px 0px 10px '.$pbPricingBorderColor.';"> '.$pricingHeader.' <div>'.$pbPricingContent.'</div> '.$pricingButton.' </div>';
              $widgetContent = $pricingContainer;
              $widgetJQueryLoadScripts = true;

              if ( $isPremUser == false ) { $widgetContent = "$premWidgetNotice"; }
            break;
            case 'wigt-pb-imgCarousel':
              $this_widget_img_carousel = $thisWidget['widgetImgCarousel'];
              $pbImgCarouselAutoplay = $this_widget_img_carousel['pbImgCarouselAutoplay'];
              $pbImgCarouselDelay = $this_widget_img_carousel['pbImgCarouselDelay'];
              $imgCarouselSlideLoop = $this_widget_img_carousel['imgCarouselSlideLoop'];
              $imgCarouselSlideTransition = $this_widget_img_carousel['imgCarouselSlideTransition'];
              $imgCarouselPagination = $this_widget_img_carousel['imgCarouselPagination'];
              $pbImgCarouselNav = $this_widget_img_carousel['pbImgCarouselNav'];
              $imgCarouselSlidesURL = $this_widget_img_carousel['imgCarouselSlidesURL'];

              if (!isset($this_widget_img_carousel['pbImgCarouselSlides'])) {
                $this_widget_img_carousel['pbImgCarouselSlides'] = '4';
              }

              $pbImgCarouselSlides = $this_widget_img_carousel['pbImgCarouselSlides'];

              if ($pbImgCarouselSlides == '1') {
                $singleItem = 'true';
              }else{
                $singleItem = 'false';
              }

              if (isset($this_widget_img_carousel['imgCarouselSlidesLink'])) {
                $imgCarouselSlidesLink = $this_widget_img_carousel['imgCarouselSlidesLink'];
              }else{
                $imgCarouselSlidesLink = array();
              }
              

              $widgetPostsSliderExternalScripts = true;

              ob_start();

              
              $widgetOwlLoadScripts = true;

              $pbImgCarouselUniqueId = 'pb_imgCarousel_'.(rand(500,1000)*2)*rand(10,500);

              echo "\n <div  id='$pbImgCarouselUniqueId' class='pbOwl-carousel'> \n";

              $slideCount = 0;
              foreach ($imgCarouselSlidesURL as $imgCarouselThisSlideURL) {

                $slideLinkOpen = ''; $slideLinkClose = '';
                if (isset($imgCarouselSlidesLink[$slideCount])) {
                  if ($imgCarouselSlidesLink[$slideCount] != '') {
                    $slideLinkOpen = '<a href="'.esc_url($imgCarouselSlidesLink[$slideCount]).'"  target="_blank" >';
                    $slideLinkClose = '</a>';
                  }
                }

                echo "<div class='carouselSingleSlide'>  $slideLinkOpen <img src='$imgCarouselThisSlideURL' alt='slideImg' style='width:100%;' > $slideLinkClose </div> \n";

                $slideCount++;
              }

              echo "</div> \n";


              
              $pbCarouselSlidesWrapper = ob_get_contents();
              ob_end_clean();

              if ($loadWpHead == 'true') {
                $carouselNavigationBtnLeft = '<span class=\"dashicons dashicons-arrow-left-alt2\" > </span>';
                $carouselNavigationBtnRight = '<span class=\"dashicons dashicons-arrow-right-alt2\" > </span>';
              }else{
                $carouselNavigationBtnLeft = '<i class=\" fas fa-angle-left \" > </i>';
                $carouselNavigationBtnRight = '<i class=\" fas fa-angle-right \" > </i>';
                $widgetFALoadScripts = true;
                echo "<style> .pbOwl-theme .owl-controls .owl-buttons div { font-size:35px !important; margin:-10px 15px !important; }  </style>";
              }
              $carouselScript = "
                jQuery(document).ready(function() {
                  jQuery('#$pbImgCarouselUniqueId').owlCarousel({
                      singleItem: ".$singleItem.",
                      items: ".$pbImgCarouselSlides.",
                      autoPlay : ".$pbImgCarouselAutoplay.",   
                      stopOnHover : true,   
                      navigation: ".$pbImgCarouselNav." ,    
                      paginationSpeed : ".$pbImgCarouselDelay."00,   
                      goToFirstSpeed : ".$pbImgCarouselDelay."00,    
                      autoHeight : true,    
                      slideSpeed : ".$pbImgCarouselDelay."000,   
                      transitionStyle: '".$imgCarouselSlideTransition."',    
                      pagination : ".$imgCarouselPagination.",   
                      paginationNumbers: false,   
                      navigationText : [ '$carouselNavigationBtnLeft', '$carouselNavigationBtnRight' ],
                      theme: 'pbOwl-theme',
                      baseClass: 'pbOwl-carousel'
                  });
                });
              ";

              array_push($POPBallWidgetsScriptsArray, $carouselScript);

              $widgetContent = $pbCarouselSlidesWrapper  ."\n";

              $widgetJQueryLoadScripts = true;

              if ( $isPremUser == false ) { $widgetContent = "$premWidgetNotice"; }
              break;
            case 'wigt-pb-wooCommerceProducts':
              $this_widget_wooCommerceProducts = $thisWidget['widgetWooPorducts'];
              $wooProductsColumn = $this_widget_wooCommerceProducts['wooProductsColumn'];
              $wooProductsCount = $this_widget_wooCommerceProducts['wooProductsCount'];
              $wooProductsCategories = $this_widget_wooCommerceProducts['wooProductsCategories'];
              //$wooProductsTags = $this_widget_wooCommerceProducts['wooProductsTags'];
              $wooProductsOrderBy = $this_widget_wooCommerceProducts['wooProductsOrderBy'];
              $wooProductsOrder = $this_widget_wooCommerceProducts['wooProductsOrder'];

              $generateWooProductsShortcode = '[products columns="'.$wooProductsColumn.'" per_page="'.$wooProductsCount.'" orderby="'.$wooProductsOrderBy.'" order="'.$wooProductsOrder.'" ]';

              if ($wooProductsCategories !== '') {
                $generateWooProductsShortcode = '[product_category columns="'.$wooProductsColumn.'" per_page="'.$wooProductsCount.'" orderby="'.$wooProductsOrderBy.'" order="'.$wooProductsOrder.'" category="'.$wooProductsCategories.'" ]';
              }

              if ($wooProductsOrderBy == 'popularity') {
                $generateWooProductsShortcode = '[best_selling_products columns="'.$wooProductsColumn.'" per_page="'.$wooProductsCount.'" orderby="'.$wooProductsOrderBy.'" order="'.$wooProductsOrder.'" category="'.$wooProductsCategories.'" ]';
              }

              $widgetContent = do_shortcode( $generateWooProductsShortcode );

              $widgetWooCommLoadScripts = true;
              if ( $isPremUser == false ) { $widgetContent = "$premWidgetNotice"; }
              break;
              case 'wigt-pb-spacer':

                $this_widget_spacer = $thisWidget['widgetVerticalSpace'];
                $widgetSpacer = '<div style="height:'.$this_widget_spacer['widgetVerticalSpaceValue'].'px ;"></div>';

                if (isset($this_widget_spacer['widgetVerticalSpaceValueTablet'])) {
                  $thisSpacerWidgetResponsiveWidgetStylesTablet = "
                    #widget-$j-$Columni-".$row["rowID"]."  div {
                     height: ".$this_widget_spacer['widgetVerticalSpaceValueTablet']."px !important;
                    }
                  ";

                  $thisSpacerWidgetResponsiveWidgetStylesMobile = "
                    #widget-$j-$Columni-".$row["rowID"]."  div {
                     height: ".$this_widget_spacer['widgetVerticalSpaceValueMobile']."px !important;
                    }
                  ";

                  array_push($POPBNallRowStylesResponsiveTablet, $thisSpacerWidgetResponsiveWidgetStylesTablet);
                  array_push($POPBNallRowStylesResponsiveMobile, $thisSpacerWidgetResponsiveWidgetStylesMobile);
                }


                $widgetContent = $widgetSpacer;
              break;
              case 'wigt-pb-break':
              
                $this_widget_breaker = $thisWidget['widgetBreaker'];
                $widgetBreaker = '<div style=" padding:'.$this_widget_breaker['widgetBreakerSpacing'].'px 0; text-align: '.$this_widget_breaker['widgetBreakerAlignment'].' ; "> <span style=" border-top:'.$this_widget_breaker['widgetBreakerWeight'].'px  '.$this_widget_breaker['widgetBreakerStyle'].'   '.$this_widget_breaker['widgetBreakerColor'].'; width:'.$this_widget_breaker['widgetBreakerWidth'].'%; display:inline-block; line-height:0;" ></span> </div>';

                $widgetContent = $widgetBreaker;
              break;
              case 'wigt-pb-anchor':
              
                $this_widgetAnchor = $thisWidget['widgetAnchor'];
                $this_widgetAnchorHTML = '<div id="'.$this_widgetAnchor['wdtanchorid'].'" style=" margin:0 !important; padding:0 !important; height:0 !important;  widget:0 !important; line-height:0 !important; opacity:0;">  </div>';

                $widgetContent = $this_widgetAnchorHTML;
              break;
              case 'wigt-pb-iconList':
              
                $this_widget_icon_list = $thisWidget['widgetIconList'];
                
                $iconListLineHeight = $this_widget_icon_list['iconListLineHeight'];
                $iconListAlignment = $this_widget_icon_list['iconListAlignment'];
                $iconListIconSize = $this_widget_icon_list['iconListIconSize'];
                $iconListIconColor = $this_widget_icon_list['iconListIconColor'];
                $iconListTextSize = $this_widget_icon_list['iconListTextSize'];
                $iconListTextIndent = $this_widget_icon_list['iconListTextIndent'];
                $iconListTextColor = $this_widget_icon_list['iconListTextColor'];
                $pbIconListUniqueId = 'pb_IconList_'.(rand(500,1000)*2)*rand(10,500);

                if (isset($this_widget_icon_list['iconListItemLinkOpen'])) {
                  $iconListItemLinkOpen = $this_widget_icon_list['iconListItemLinkOpen'];
                }

                $iconListTextFontFamily = '';
                if (isset($this_widget_icon_list['iconListTextFontFamily'])) {
                  $iconListTextFontFamily = $this_widget_icon_list['iconListTextFontFamily'];
                }

                $this_widget_icon_list['iconListIconSizeTablet'] = (isset($this_widget_icon_list['iconListIconSizeTablet'])) ? $this_widget_icon_list['iconListIconSizeTablet'] : '';
                $this_widget_icon_list['iconListIconSizeMobile'] = (isset($this_widget_icon_list['iconListIconSizeMobile'])) ? $this_widget_icon_list['iconListIconSizeMobile'] : '';

                $this_widget_icon_list['iconListTextSizeTablet'] = (isset($this_widget_icon_list['iconListTextSizeTablet'])) ? $this_widget_icon_list['iconListTextSizeTablet'] : '';

                $this_widget_icon_list['iconListTextSizeMobile'] = (isset($this_widget_icon_list['iconListTextSizeMobile'])) ? $this_widget_icon_list['iconListTextSizeMobile'] : '';

                $this_widget_icon_list['iconListTextIndentTablet'] = (isset($this_widget_icon_list['iconListTextIndentTablet'])) ? $this_widget_icon_list['iconListTextIndentTablet'] : '';

                $this_widget_icon_list['iconListTextIndentMobile'] = (isset($this_widget_icon_list['iconListTextIndentMobile'])) ? $this_widget_icon_list['iconListTextIndentMobile'] : '';



                  $iconListIconSizeTablet = $this_widget_icon_list['iconListIconSizeTablet'];
                  $iconListIconSizeMobile = $this_widget_icon_list['iconListIconSizeMobile'];

                  $iconListTextSizeTablet = $this_widget_icon_list['iconListTextSizeTablet'];
                  $iconListTextSizeMobile = $this_widget_icon_list['iconListTextSizeMobile'];

                  $iconListTextIndentTablet = $this_widget_icon_list['iconListTextIndentTablet'];
                  $iconListTextIndentMobile = $this_widget_icon_list['iconListTextIndentMobile'];

                  $thisWidgetResponsiveWidgetStylesTablet = "
                    #$pbIconListUniqueId li i {
                      font-size: ".$iconListIconSizeTablet."px !important;
                    }
                    #$pbIconListUniqueId li span {
                      font-size: ".$iconListTextSizeTablet."px !important;
                      margin-left: ".$iconListTextIndentTablet."px !important;
                    }
                  ";
                  $thisWidgetResponsiveWidgetStylesMobile = "
                    #$pbIconListUniqueId li i {
                      font-size: ".$iconListIconSizeMobile."px !important;
                    }
                    #$pbIconListUniqueId li span {
                      font-size: ".$iconListTextSizeMobile."px !important;
                      margin-left: ".$iconListTextIndentMobile."px !important;
                    }
                  ";


                  array_push($POPBNallRowStylesResponsiveTablet, $thisWidgetResponsiveWidgetStylesTablet);
                  array_push($POPBNallRowStylesResponsiveMobile, $thisWidgetResponsiveWidgetStylesMobile);
                
                $iconListComplete = $this_widget_icon_list['iconListComplete'];


                $pbIconListAllItems = '';

                ob_start();

                  echo "\n <ul id='$pbIconListUniqueId' > \n";

                  foreach ($iconListComplete as $iconListItem) {

                    $faClassAppend = 'fa';
                    if (strpos($iconListItem['iconListItemIcon'], 'fab') !== false || strpos($iconListItem['iconListItemIcon'], 'fas') !== false || strpos($iconListItem['iconListItemIcon'], 'far') !== false) {
                      $faClassAppend = '';
                    }

                    $pbThisListIcon = '<i class=" '.$faClassAppend.' '.$iconListItem['iconListItemIcon'].'"></i>';
                    if ($iconListItem['iconListItemLink'] !== '') {
                      $pbThisListItemLinkOpen = '<a href='.esc_url($iconListItem['iconListItemLink']).' target="_blank" >';
                      $pbThisListItemLinkClose = '</a>';
                    } else{
                      $pbThisListItemLinkOpen = '';
                      $pbThisListItemLinkClose = '';
                    }
                    $pbListThisItem = $pbThisListItemLinkOpen. " <li> ".$pbThisListIcon."  <span>".$iconListItem['iconListItemText']."</span>  </li> " . $pbThisListItemLinkClose;
                    
                    echo $pbListThisItem;
                  }

                  echo "</ul> \n";


                  
                  $pbIconListWrapper = ob_get_contents();
                ob_end_clean();

                $flexAlignment = $iconListAlignment;
                if ($iconListAlignment == 'left') {
                  $flexAlignment = 'flex-start';
                }
                if ($iconListAlignment == 'right') {
                  $flexAlignment = 'flex-end';
                }

                if(1 === preg_match('~[0-9]~', $iconListTextFontFamily)){
                  $iconListTextFontFamily = "'".$iconListTextFontFamily."'";
                }

                $pbIconListUniqueStyles = ' <style> 
                #'.$pbIconListUniqueId.' { text-align:'.$iconListAlignment.'; text-decoration:none; list-style:none; padding:0; margin:0; } 
                 #'.$pbIconListUniqueId.' li { margin-top:'.$iconListLineHeight.'px;  display : flex; align-items: center; justify-content: '.$flexAlignment.'; }
                 #'.$pbIconListUniqueId.' li i { font-size:'.$iconListIconSize.'px; color:'.$iconListIconColor.';  } 
                 #'.$pbIconListUniqueId.' li span { font-size:'.$iconListTextSize.'px;  font-family:'.str_replace('+', ' ', $iconListTextFontFamily).'; color:'.$iconListTextColor.';  margin-left:'.$iconListTextIndent.'px;  line-height:'.$iconListLineHeight.'px; }
                 #'.$pbIconListUniqueId.' a { text-decoration:none; } </style>  ';

                array_push($thisColFontsToLoad, $iconListTextFontFamily);

                $widgetContent = $pbIconListWrapper ."\n". $pbIconListUniqueStyles;

                $widgetFALoadScripts = true;
              break;

              case 'wigt-pb-formBuilder':

                include(ULPB_PLUGIN_PATH.'public/templates/widgets/form-builder-widget.php');

              break;
              case 'wigt-pb-text':
                
                include(ULPB_PLUGIN_PATH.'public/templates/widgets/headingWidget.php');

              break;
              case 'wigt-pb-liveText':
                $this_widget_text = $thisWidget['wLText'];
                $widgetTextContent = str_replace("elLtWrapped"," ",$this_widget_text['wltc']);
                $widgetTextContent = str_replace("contenteditable","e",$widgetTextContent);
                $widgetLiveContent = "<div>".$widgetTextContent."</div>";

                if ($this_widget_text['wltfs'] != '' && $this_widget_text['wltfs'] != ' ') {
                  array_push($widgetTextFontsBulk, $this_widget_text['wltfs']);
                }
                

                $widgetContent = $widgetLiveContent;
              break;
              case 'wigt-pb-embededVideo':
                include(ULPB_PLUGIN_PATH.'public/templates/widgets/widget-embededVideo.php');
              break;
              case 'wigt-pb-testimonialCarousel':
                include(ULPB_PLUGIN_PATH.'public/templates/widgets/widget-testimonialCarousel.php');
                if ( $isPremUser == false ) { $widgetContent = "$premWidgetNotice"; }
              break;
              case 'wigt-pb-poOptins':
                $this_widget_Optin_Id = $thisWidget['widgetPoOptins']['widgetOptinId'];
                if (! function_exists('get_pluginops_optin_shortcode_from_id')) {
                  function get_pluginops_optin_shortcode_from_id($optin_id){
                    $optinData = get_post_meta( $optin_id, 'ULPB_DATA', true );
                    if ( !isset($optinData) || !is_array($optinData) ) {
                      $generatedOptinShortcode = 'Optin Not Found';
                    }

                    if (isset( $optinData['campaignPlacement'] )) {
                      $generatedOptinShortcode = $optinData['campaignPlacement']['generatedShortcode'];
                    }else{
                      $generatedOptinShortcode = 'Optin Not Found';
                    }
                    

                    if ( !post_type_exists('pluginops_forms') ) {
                      $generatedOptinShortcode = 'PluginOps Optin Builder Is not Active.';
                    }

                    return $generatedOptinShortcode;
                  }
                }
                $widgetContent = do_shortcode( get_pluginops_optin_shortcode_from_id($this_widget_Optin_Id) );
              break;
              case 'wigt-pb-navmenu':

                include(ULPB_PLUGIN_PATH.'public/templates/widgets/widget-nav-builder.php');
                
              break;
              case 'wigt-pb-gallery':

                include(ULPB_PLUGIN_PATH.'public/templates/widgets/image-gallery-widget.php');

              break;
              case 'wigt-pb-accordion':

                include(ULPB_PLUGIN_PATH.'public/templates/widgets/accordion-widget.php');

              break;
              case 'wigt-pb-tabs':

                include(ULPB_PLUGIN_PATH.'public/templates/widgets/widget-tabs.php');


              break;
              case 'wigt-pb-shareThis':
                $this_widget = $thisWidget['widgetShareThis'];
                $shareThisType = '';

                if ($this_widget['wdtstbt'] == 'SBI') {
                  $shareThisType = '<div class="sharethis-inline-share-buttons" ></div>';
                }

                if ($this_widget['wdtstbt'] == 'FBI') {
                  $shareThisType = '<div class="sharethis-inline-follow-buttons"> </div>';
                }

                if ($this_widget['wdtstbt'] == 'RBI') {
                  $shareThisType = '<div class="sharethis-inline-reaction-buttons"> </div>';
                }
                

                $shareThisScripts = "<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=".$this_widget['wdtstId']."' async='async'></script>";

                $widgetContent = $shareThisScripts . '<div>'. $shareThisType . '</div>';
              break;
              default:
              $widgetContent = " ";
              $contentAlignment = ' ';
                break;
          } // column type switch ends here


          /*
          $widgetMtop = floor( ($widgetMtop/1268)*100);
          $widgetMright = floor( ($widgetMright/1268)*100);
          $widgetMbottom = floor( ($widgetMbottom/1268)*100);
          $widgetMleft = floor( ($widgetMleft/1268)*100); */
          
         /// $columnContentOld = 





          $widgBackgroundOptions = 'background:'.$widgetBgColor.';';

          if (isset($thisWidget['widgBgImg']) ) {
            $thisWidgBgImg = $thisWidget['widgBgImg'];
            if ($thisWidgBgImg !== '') {
              $widgBackgroundOptions = 'background: url('.$thisWidgBgImg.') no-repeat center; background-size:cover;';
            }
          }

          if (isset($thisWidget['widgBackgroundType']) ) {
            if ($thisWidget['widgBackgroundType'] == 'gradient') {
              $widgGradient = $thisWidget['widgGradient'];

              if ($widgGradient['widgGradientType'] == 'linear') {
                $widgBackgroundOptions = 'background: linear-gradient('.$widgGradient['widgGradientAngle'].'deg, '.$widgGradient['widgGradientColorFirst'].' '.$widgGradient['widgGradientLocationFirst'].'%,'.$widgGradient['widgGradientColorSecond'].' '.$widgGradient['widgGradientLocationSecond'].'%);';
              }

              if ($widgGradient['widgGradientType'] == 'radial') {
                $widgBackgroundOptions = 'background: radial-gradient(at '.$widgGradient['widgGradientPosition'].', '.$widgGradient['widgGradientColorFirst'].' '.$widgGradient['widgGradientLocationFirst'].'%,'.$widgGradient['widgGradientColorSecond'].' '.$widgGradient['widgGradientLocationSecond'].'%);';
              }
              
            }
          }

          $thisWidgHoverStyleTag = '';
          $thisWidgHoverOption = '';
          $widgetHoverAnimationScript = '';
          if (isset($thisWidget['widgHoverOptions']) ) {
            $widgID = "widget-$j-$Columni-".$row["rowID"];
            $widgHoverOptions = $thisWidget['widgHoverOptions'];

            if (isset($widgHoverOptions['widgBackgroundTypeHover'])) {
              if ($widgHoverOptions['widgBackgroundTypeHover'] == 'solid') {
                $thisWidgHoverOption = ' #'.$widgID.':hover { background:'.$widgHoverOptions['widgBgColorHover'].' !important; transition: all '.$widgHoverOptions['widgHoverTransitionDuration'].'s; }';
              }
              if ($widgHoverOptions['widgBackgroundTypeHover'] == 'gradient') {
                $widgGradientHover = $widgHoverOptions['widgGradientHover'];

                if ($widgGradientHover['widgGradientTypeHover'] == 'linear') {
                  $thisWidgHoverOption = ' #'.$widgID.':hover { background: linear-gradient('.$widgGradientHover['widgGradientAngleHover'].'deg, '.$widgGradientHover['widgGradientColorFirstHover'].' '.$widgGradientHover['widgGradientLocationFirstHover'].'%,'.$widgGradientHover['widgGradientColorSecondHover'].' '.$widgGradientHover['widgGradientLocationSecondHover'].'%) !important; transition: all '.$widgHoverOptions['widgHoverTransitionDuration'].'s; }';
                }

                if ($widgGradientHover['widgGradientTypeHover'] == 'radial') {

                  $thisWidgHoverOption = ' #'.$widgID.':hover { background: radial-gradient(at '.$widgGradientHover['widgGradientPositionHover'].', '.$widgGradientHover['widgGradientColorFirstHover'].' '.$widgGradientHover['widgGradientLocationFirstHover'].'%,'.$widgGradientHover['widgGradientColorSecondHover'].' '.$widgGradientHover['widgGradientLocationSecondHover'].'%) !important; transition: all '.$widgHoverOptions['widgHoverTransitionDuration'].'s; }';
                }
              }
            }
              
            $widgetHoverAnimationScript = '';
            if (isset($widgHoverOptions['widgetHoverAnimation']) ) {
              $widgetHoverAnimation = $widgHoverOptions['widgetHoverAnimation'];
              if ($widgetHoverAnimation != '') {
                $widgetHoverAnimationScript = "
                 jQuery('#".$widgID."').mouseenter(function(){
                    jQuery(this).addClass('animated ".$widgetHoverAnimation."').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',function(){ 
                       jQuery(this).removeClass('animated ".$widgetHoverAnimation."') 
                      }); 
                 });
                ";

                 $widgetJQueryLoadScripts = true;
              }
            }
            $thisWidgHoverStyleTag = ' '.$thisWidgHoverOption.'  ';
            array_push($POPBallWidgetsStylesArray, $thisWidgHoverStyleTag);
          }


          

          
            $widgetStyles =
              "#widget-$j-$Columni-".$row['rowID']." {
                margin:".$widgetMtop."% ".$widgetMright."% ".$widgetMbottom."% ".$widgetMleft."%;
                $widgetPaddings  $this_widget_border_shadow  background: $widgetBgColor;
                $widgBackgroundOptions  $widgetIsInline text-align:$imgAlignment;
                $widgetWidthDefault
                $menuSpecificStyles  $widgetStyling $widgHideOnDesktop
              }";

          array_push($POPBallColumnStylesArray, $widgetStyles);

          $columnContent = $columnContent."\n"."<div class='widget-$j $menuSpecificClass $widgetCustomClass'  id='widget-$j-$Columni-".$row["rowID"]."'  >".$widgetContent."</div>  \n";

          array_push($POPBallWidgetsScriptsArray, $widgetHoverAnimationScript);
          
          ?>

          <?php if (!empty($thisWidget['widgetAnimation']) && $thisWidget['widgetAnimation'] !== 'none' && $thisWidget['widgetAnimation'] !== '') {
            if ($j > 4) {
              $widgNumber = 4;
            }else{
              $widgNumber = $j;
            }
            ob_start();

          echo "
          jQuery('#".$row["rowID"]."-$Columni > .widget-$j' ).css('opacity','0');
          jQuery(window).scroll(function(event) { 
              jQuery('#".$row["rowID"]."-$Columni > .widget-$j' ).each( function(i, el){
                var el = ".'jQuery(el);'."
                var isInView = pluginOpsCheckElViewFrame(el);
                if (isInView == 'InView' ) {
                  setTimeout(function(){
                    jQuery('#".$row["rowID"]."-$Columni > .widget-$j' ).css('opacity','1');
                    el.addClass('$widgetAnimation');
                  },".($widgNumber+1+$widgNumber)."00);
                }

                if (isInView == 'Function didnt work' ) {
                  jQuery('#".$row["rowID"]."-$Columni > .widget-$j' ).css('opacity','1');
                }

              });
          });
          ";

          $thisWidgetAnimationTrigger =  ob_get_contents();
          ob_end_clean();

          $prevWidgetAnimationTriggers = $widgetAnimationTriggerScript;

          $widgetAnimationTriggerScript = $prevWidgetAnimationTriggers. "\n" . $thisWidgetAnimationTrigger;
          $widgetJQueryLoadScripts = true;
          }
      } // widget loop ends here
?>