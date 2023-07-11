 <?php if ( ! defined( 'ABSPATH' ) ) exit;

error_reporting(0);


if (!function_exists('mergeNonSetObjectValues')) {

  function mergeNonSetObjectValues($source,$target){

    foreach ($target as $key => $value) {
        
        if (!isset($source[$key])) {
          $source[$key] = $target[$key];
        }else{

          if (is_array($target[$key])) {
              
              foreach ($target[$key] as $key2 => $value2) {
                  
                if (!isset($source[$key][$key2])) {
                  $source[$key][$key2] = $target[$key][$key2];
                }else{

                  if (is_array($source[$key][$key2])) {
                    
                    foreach ($source[$key][$key2] as $key3 => $value3) {

                      if (!isset($source[$key][$key2][$key3])) {
                        $source[$key][$key2][$key3] = $target[$key][$key2][$key3];
                      }

                    }

                  }

                }

              }

          }

        }

    }

    return $source;

  }

}


$defaultRowDataOps = array (
    'rowCustomClass' => '',
    'bg_color' => '#fff',
    'bg_img' => '',
    'margin' => 
    array (
      'rowMarginTop' => 0,
      'rowMarginBottom' => 0,
      'rowMarginLeft' => 0,
      'rowMarginRight' => 0,
    ),
    'marginTablet' => 
    array (
      'rMTT' => '0',
      'rMBT' => '0',
      'rMLT' => '0',
      'rMRT' => '0',
    ),
    'marginMobile' => 
    array (
      'rMTM' => '0',
      'rMBM' => '0',
      'rMLM' => '0',
      'rMRM' => '0',
    ),
    'padding' => 
    array (
      'rowPaddingTop' => 0,
      'rowPaddingBottom' => 0,
      'rowPaddingLeft' => 0,
      'rowPaddingRight' => 0,
    ),
    'paddingTablet' => 
    array (
      'rPTT' => '1.5',
      'rPBT' => '1.5',
      'rPLT' => '1.5',
      'rPRT' => '1.5',
    ),
    'paddingMobile' => 
    array (
      'rPTM' => '1.5',
      'rPBM' => '1.5',
      'rPLM' => '1.5',
      'rPRM' => '1.5',
    ),
    'video' => 
    array (
      'rowBgVideoEnable' => 'false',
      'rowBgVideoLoop' => 'loop',
      'rowVideoMpfour' => '',
      'rowVideoWebM' => '',
      'rowVideoThumb' => '',
    ),
    'customStyling' => '',
    'customJS' => '',
    'rowBackgroundType' => 'solid',
    'rowGradient' => 
    array (
      'rowGradientColorFirst' => '#dd9933',
      'rowGradientLocationFirst' => '40',
      'rowGradientColorSecond' => '#eeee22',
      'rowGradientLocationSecond' => '60',
      'rowGradientType' => 'linear',
      'rowGradientPosition' => 'top left',
      'rowGradientAngle' => '135',
    ),
    'rowHoverOptions' => 
    array (
      'rowBgColorHover' => '',
      'rowBackgroundTypeHover' => '',
      'rowHoverTransitionDuration' => '',
      'rowGradientHover' => 
      array (
        'rowGradientColorFirstHover' => '',
        'rowGradientLocationFirstHover' => '',
        'rowGradientColorSecondHover' => '',
        'rowGradientLocationSecondHover' => '',
        'rowGradientTypeHover' => 'linear',
        'rowGradientPositionHover' => 'top left',
        'rowGradientAngleHover' => '',
      ),
    ),
    'rowOverlayBackgroundType' => '',
    'rowOverlayGradient' => 
    array (
      'rowOverlayGradientColorFirst' => '',
      'rowOverlayGradientLocationFirst' => '',
      'rowOverlayGradientColorSecond' => '',
      'rowOverlayGradientLocationSecond' => '',
      'rowOverlayGradientType' => '',
      'rowOverlayGradientPosition' => '',
      'rowOverlayGradientAngle' => '',
    ),
    'rowHideOnDesktop' => '',
    'rowHideOnTablet' => '',
    'rowHideOnMobile' => '',
    'bgSTop' => 
    array (
      'rbgstType' => 'none',
      'rbgstColor' => '#e3e3e3',
      'rbgstWidth' => '100',
      'rbgstWidtht' => '',
      'rbgstWidthm' => '',
      'rbgstHeight' => '200',
      'rbgstHeightt' => '',
      'rbgstHeightm' => '',
      'rbgstFlipped' => 'none',
      'rbgstFront' => 'back',
    ),
    'bgSBottom' => 
    array (
      'rbgsbType' => 'none',
      'rbgsbColor' => '#e3e3e3',
      'rbgsbWidth' => '100',
      'rbgsbWidtht' => '',
      'rbgsbWidthm' => '',
      'rbgsbHeight' => '200',
      'rbgsbHeightt' => '',
      'rbgsbHeightm' => '',
      'rbgsbFlipped' => 'none',
      'rbgsbFront' => 'back',
    ),
    'bg_imgT' => '',
    'bg_imgM' => '',
    'conType' => '',
    'conWidth' => '1280',
    'bgImgOps' => 
    array (
      'pos' => 'center center',
      'posT' => '',
      'posM' => '',
      'xPos' => '',
      'xPosT' => '',
      'xPosM' => '',
      'xPosU' => 'px',
      'xPosUT' => 'px',
      'xPosUM' => 'px',
      'yPos' => '',
      'yPosT' => '',
      'yPosM' => '',
      'yPosU' => 'px',
      'yPosUT' => 'px',
      'yPosUM' => 'px',
      'rep' => 'default',
      'repT' => 'default',
      'repM' => 'default',
      'size' => 'cover',
      'sizeT' => '',
      'sizeM' => '',
      'cWid' => '',
      'cWidT' => '',
      'cWidM' => '',
      'widU' => 'px',
      'widUT' => 'px',
      'widUM' => 'px',
      'parlxT' => '',
      'parlxM' => '',
    ),
);



$defaultColDataOps = array (
    'bg_color' => 'transparent',
    'width' => '',
    'widthTablet' => '',
    'widthMobile' => '',
    'columnCSS' => '',
    'columnCustomClass' => '',
    'colHideOnDesktop' => '',
    'colHideOnTablet' => '',
    'colHideOnMobile' => '',
    'margin' => 
    array (
      'columnMarginTop' => '0',
      'columnMarginBottom' => '0',
      'columnMarginLeft' => '0',
      'columnMarginRight' => '0',
    ),
    'padding' => 
    array (
      'columnPaddingTop' => '0',
      'columnPaddingBottom' => '0',
      'columnPaddingLeft' => '0',
      'columnPaddingRight' => '0',
    ),
    'paddingTablet' => 
    array (
      'rPTT' => '',
      'rPBT' => '',
      'rPLT' => '',
      'rPRT' => '',
    ),
    'paddingMobile' => 
    array (
      'rPTM' => '',
      'rPBM' => '',
      'rPLM' => '',
      'rPRM' => '',
    ),
    'marginTablet' => 
    array (
      'rMTT' => '',
      'rMBT' => '',
      'rMLT' => '',
      'rMRT' => '',
    ),
    'marginMobile' => 
    array (
      'rMTM' => '',
      'rMBM' => '',
      'rMLM' => '',
      'rMRM' => '',
    ),
    'colBoxShadow' => 
    array (
      'colBoxShadowH' => '',
      'colBoxShadowV' => '',
      'colBoxShadowBlur' => '',
      'colBoxShadowColor' => 'hsv(0, 0%, 0%)',
    ),
    'colBgImg' => '',
    'colBgImgT' => '',
    'colBgImgM' => '',
    'colBackgroundType' => 'solid',
    'colGradient' => 
    array (
      'colGradientColorFirst' => '#dd9933',
      'colGradientLocationFirst' => '55',
      'colGradientColorSecond' => '#eeee22',
      'colGradientLocationSecond' => '50',
      'colGradientType' => 'linear',
      'colGradientPosition' => 'top left',
      'colGradientAngle' => '135',
    ),
    'colHoverOptions' => 
    array (
      'colBgColorHover' => '',
      'colBackgroundTypeHover' => '',
      'colHoverTransitionDuration' => '',
      'colGradientHover' => 
      array (
        'colGradientColorFirstHover' => '',
        'colGradientLocationFirstHover' => '',
        'colGradientColorSecondHover' => '',
        'colGradientLocationSecondHover' => '',
        'colGradientTypeHover' => 'linear',
        'colGradientPositionHover' => 'top left',
        'colGradientAngleHover' => '',
      ),
    ),
    'bgImgOps' => 
    array (
      'pos' => 'center center',
      'posT' => '',
      'posM' => '',
      'xPos' => '',
      'xPosT' => '',
      'xPosM' => '',
      'xPosU' => 'px',
      'xPosUT' => 'px',
      'xPosUM' => 'px',
      'yPos' => '',
      'yPosT' => '',
      'yPosM' => '',
      'yPosU' => 'px',
      'yPosUT' => 'px',
      'yPosUM' => 'px',
      'rep' => 'default',
      'repT' => 'default',
      'repM' => 'default',
      'size' => 'cover',
      'sizeT' => '',
      'sizeM' => '',
      'cWid' => '',
      'cWidT' => '',
      'cWidM' => '',
      'widU' => 'px',
      'widUT' => 'px',
      'widUM' => 'px',
      'parlxT' => '',
      'parlxM' => '',
    ),
    'colBorder' => 
    array (
      'bwt' => '',
      'bwb' => '',
      'bwl' => '',
      'bwr' => '',
      'bwtT' => '',
      'bwbT' => '',
      'bwlT' => '',
      'bwrT' => '',
      'bwtM' => '',
      'bwbM' => '',
      'bwlM' => '',
      'bwrM' => '',
      'brt' => '',
      'brb' => '',
      'brl' => '',
      'brr' => '',
      'brtT' => '',
      'brbT' => '',
      'brlT' => '',
      'brrT' => '',
      'brtM' => '',
      'brbM' => '',
      'brlM' => '',
      'brrM' => '',
      'colBorderStyle' => '',
      'colBorderColor' => '',
    ),
);


$defaultWidgetDataOps = array (
  'widgetType' => ' ',
  'widgetStyling' => '/* Custom CSS for widget here. */',
  'widgetMtop' => '0',
  'widgetMleft' => '0',
  'widgetMbottom' => '0',
  'widgetMright' => '0',
  'widgetPtop' => '0',
  'widgetPleft' => '0',
  'widgetPbottom' => '0',
  'widgetPright' => '0',
  'widgetPaddingTablet' => 
  array (
    'rPTT' => '1.5',
    'rPBT' => '1.5',
    'rPLT' => '1.5',
    'rPRT' => '1.5',
  ),
  'widgetPaddingMobile' => 
  array (
    'rPTM' => '1.5',
    'rPBM' => '1.5',
    'rPLM' => '1.5',
    'rPRM' => '1.5',
  ),
  'widgetMarginTablet' => 
  array (
    'rMTT' => '0',
    'rMBT' => '0',
    'rMLT' => '0',
    'rMRT' => '0',
  ),
  'widgetMarginMobile' => 
  array (
    'rMTM' => '0',
    'rMBM' => '0',
    'rMLM' => '0',
    'rMRM' => '0',
  ),
  'widgetBgColor' => 'transparent',
  'widgetAnimation' => 'none',
  'widgetBorderWidth' => '',
  'widgetBorderStyle' => '',
  'widgetBorderColor' => '',
  'widgetBoxShadowH' => '',
  'widgetBoxShadowV' => '',
  'widgetBoxShadowBlur' => '',
  'widgetBoxShadowColor' => '',
  'widgetIsInline' => false,
  'widgetIsInlineTablet' => '',
  'widgetIsInlineMobile' => '',
  'widgetCustomClass' => '',
  'widgBgImg' => '',
  'widgBackgroundType' => 'solid',
  'widgGradient' => 
  array (
    'widgGradientColorFirst' => '#dd9933',
    'widgGradientLocationFirst' => '55',
    'widgGradientColorSecond' => '#eeee22',
    'widgGradientLocationSecond' => '50',
    'widgGradientType' => 'linear',
    'widgGradientPosition' => 'top left',
    'widgGradientAngle' => '135',
  ),
  'widgHoverOptions' => 
  array (
    'widgBgColorHover' => 'hsv(0, 0%, 0%)',
    'widgBackgroundTypeHover' => '',
    'widgHoverTransitionDuration' => '',
    'widgetHoverAnimation' => '',
    'widgGradientHover' => 
    array (
      'widgGradientColorFirstHover' => 'hsv(0, 0%, 0%)',
      'widgGradientLocationFirstHover' => '',
      'widgGradientColorSecondHover' => 'hsv(0, 0%, 0%)',
      'widgGradientLocationSecondHover' => '',
      'widgGradientTypeHover' => 'linear',
      'widgGradientPositionHover' => 'top left',
      'widgGradientAngleHover' => '',
    ),
  ),
  'borderRadius' => 
  array (
    'wbrt' => '',
    'wbrb' => '',
    'wbrl' => '',
    'wbrr' => '',
  ),
  'borderWidth' => 
  array (
    'wbwt' => '',
    'wbwb' => '',
    'wbwl' => '',
    'wbwr' => '',
  ),
  'widgHideOnDesktop' => '',
  'widgHideOnTablet' => '',
  'widgHideOnMobile' => '',
);
  

$landingPageLinkTrackingFeature = get_option( 'landingPageLinkTrackingFeature', false );
if ($landingPageLinkTrackingFeature != 'disabled' || $landingPageLinkTrackingFeature == false) {
  $landingPageLinkTrackingFeatureisEnabled = true;
}else{
  $landingPageLinkTrackingFeatureisEnabled = false;
}


if ( isset($_GET['popb_track_url']) && isset($_GET['popb_pID']) ) {
  $popb_track_url = sanitize_text_field( $_GET['popb_track_url'] );
  $post_id = sanitize_text_field( $_GET['popb_pID'] );

  if (!empty($popb_track_url) && !empty($post_id)) {
    $postStatus = get_post_status( $post_id );
    if ($postStatus == 'publish') {

      $allowed = array();
      $pluginOpsUserTimeZone = get_option('timezone_string');
      date_default_timezone_set($pluginOpsUserTimeZone);
      $todaysDate = date('d-m-Y');

      $ctnTotal = get_post_meta($post_id,'ctnTotal',true);
      $ctnTotal++;
      $updateResultConversionCount = update_post_meta( $post_id, 'ctnTotal', $ctnTotal, $unique = false);
      $ctrLinks = get_post_meta($post_id,'ctrTpLinks',true);

      if (! is_array($ctrLinks)) {
        $ctrLinks = array();
      }

      if (!isset($ctrLinks[$popb_track_url])) {
        $ctrLinks[$popb_track_url] = array();
      }

      if (!isset( $ctrLinks[$popb_track_url][$todaysDate] )) {
        $ctrLinks[$popb_track_url][$todaysDate] = 0;
      }

      $ctrLinks[$popb_track_url][$todaysDate]++;
      update_post_meta( $post_id, 'ctrTpLinks', $ctrLinks, $unique = false);

    }
    
    if ( headers_sent() ) {
      echo "<script> location.href = '$popb_track_url' </script>";
    }else{
      header('Location: ' . $popb_track_url, true, 302);
    }
    
    exit();

  }
}

$current_pageID = $post->ID;

if (isset($isShortCodeTemplate)) {
  if ($isShortCodeTemplate == true) {
    $current_pageID = $template_id;
  }
} else{ 
  $isShortCodeTemplate = '';
}


// if (!isset($data['pageOptions'])) {
//   return;
// }


$data = get_post_meta( $current_pageID, 'ULPB_DATA', true );

if (!empty($data)) {

  $pageTitle = get_the_title($current_pageID);

  if ($pageTitle != $data['pageOptions']['pageSeoName']) {
    $data['pageOptions']['pageSeoName'] = $pageTitle;
  }

  $currentPageTitle = $data['pageOptions']['pageSeoName'];
}
$current_postType = get_post_type( $current_pageID );


$loadThemeWrapper = get_post_meta($current_pageID,'ULPB_loadThemeWrapper',true);

if ($current_postType == 'post' || $current_postType == 'page') {
  if ($loadThemeWrapper == '') {
    $loadThemeWrapper = 'true';
  }
}


$currentVariant = 'A';
$abTestingActive = false;
if (isset($data['pageOptions']['MultiVariantTesting']) && $data['pageOptions']['MultiVariantTesting'] != null ) {

  $VariantB_ID = $data['pageOptions']['MultiVariantTesting']['VariantB'];
  $VariantC_ID = $data['pageOptions']['MultiVariantTesting']['VariantC'];
  $VariantD_ID = $data['pageOptions']['MultiVariantTesting']['VariantD'];
  
  if ( ($VariantB_ID != 'none' && $VariantB_ID != null && $VariantB_ID != '') || ($VariantC_ID != 'none' && $VariantC_ID != null && $VariantC_ID != '') || ($VariantD_ID != 'none' && $VariantD_ID != null && $VariantD_ID != '') ) {
    include 'ab-lib/phpab.php';
    $startAbTest = new phpab('AbTestOne');

    if ($VariantB_ID != 'none' && $VariantB_ID != null && $VariantB_ID != '') {
      $startAbTest->add_variation('variantb');
      $abTestingActive = true;
    }
    if ($VariantC_ID != 'none' && $VariantC_ID != null && $VariantC_ID != '') {
      $startAbTest->add_variation('variantc');
    }
    if ($VariantD_ID != 'none' && $VariantD_ID != null && $VariantD_ID != '') {
      $startAbTest->add_variation('variantd');
    }

    if ($startAbTest->get_user_segment() == 'variantb') {
      $data = get_post_meta( $VariantB_ID, 'ULPB_DATA', true );
      $current_pageID = $VariantB_ID;
      $currentVariant = 'B';
    }else if ($startAbTest->get_user_segment() == 'variantc') {
      $data = get_post_meta( $VariantC_ID, 'ULPB_DATA', true );
      $current_pageID = $VariantC_ID;
      $currentVariant = 'C';
    }else if ($startAbTest->get_user_segment() == 'variantd') {
      $data = get_post_meta( $VariantD_ID, 'ULPB_DATA', true );
      $current_pageID = $VariantD_ID;
      $currentVariant = 'D';
    }else{
      $data = get_post_meta( $current_pageID, 'ULPB_DATA', true );
    }
  }
}

if (isset( $data['RowsDivided'] )) {
  if ($data['RowsDivided'] > 0 ) {
    $rowsCollection = array();
    for($i = 0; $i< $data['RowsDivided']; $i++ ){
      $theseRows =  get_post_meta($current_pageID, 'ULPB_DATA_Rows_Part_'.$i, true);
      foreach ($theseRows as $value) {
        array_push($data['Rows'], $value );
      }
    }
  }
}

$lp_thisPostType = get_post_type( $current_pageID );
  

  $widgetAnimationTriggerScript = '';
  $widgetCounterLoadScripts = false;
  $widgetCountDownLoadScripts = false;
  $widgetSliderLoadScripts = false;
  $widgetFALoadScripts = false;
  $widgetVideoLoadScripts = false;
  $widgetOwlLoadScripts = false;
  $widgetWooCommLoadScripts = false;
  $widgetPostsSliderExternalScripts = false;
  $widgetSubscribeFormWidget = false;
  $shapesinluded = false;
  $widgetMasonryLoadScripts = false;
  $widgetJQueryLoadScripts = false;
  $widget_postsSliderLibrary = false;



  $POPBNallRowStyles = array();
  $POPBNallRowStylesResponsiveTablet = array();
  $POPBNallRowStylesResponsiveMobile = array();
  $POPBallColumnStylesArray = array();
  $POPBallWidgetsStylesArray = array();
  $POPBallWidgetsScriptsArray = array();
  $POPBallWidgetsScriptsFilesArray = array();
  $POPBallWidgetsStylesFilesArray = array();
  $thisColFontsToLoad = array();
  $POPB_popups_loaded = array();
  $widgetTextFontsBulk = array();





if (!empty($data)) {
  include('header.php');


if ($loadWpFooter == 'false') {

  if (defined('AUTOPTIMIZE_PLUGIN_VERSION') ) {

    if (! function_exists('pluginops_pb_ao_override_jsexclude')) {
      add_filter('autoptimize_filter_js_exclude','pluginops_pb_ao_override_jsexclude',10,1);
      function pluginops_pb_ao_override_jsexclude($exclude) {
        return $exclude.", jquery.js, jquery.min.js, moment.js , cookie.js , jquery-ui.js , fa.js , video.js , slider.min.js , countdown.js , moment-timezone-with-data-2010-2020.min.js ,  moment.min.js , owl.carousel.js";
      }
    }
      

    if ( !function_exists('pluginops_pb_ao_css_include_inline')) {
      add_filter('autoptimize_css_include_inline','pluginops_pb_ao_css_include_inline',10,1);
      function pluginops_pb_ao_css_include_inline() {
          return false;
      }
    }
    
  }

}


?>

<?php 
  if ($loadThemeWrapper == 'true' || $isShortCodeTemplate == true ){ echo "<div class='ulpb_PageBody ulpb_PageBody_$current_pageID'>";
  }else{ echo "<body class='ulpb_PageBody ulpb_PageBody_$current_pageID'>";  echo "<div id='fullPageBgOverlay_$current_pageID' class='fullPageBgOverlay' style='height: 100%; top: 0 !important; bottom:0 !important; left: 0 !important; right:0 !important;  width: 100%; position: fixed;'></div>";
  }
?>

  <?php

  $ulpb_global_tracking_scriptsBodyTag = get_option( 'ulpb_global_tracking_scriptsBodyTag' );

  echo " $ulpb_global_tracking_scriptsBodyTag ";

  $rows = $data['Rows'];

  $rowCount = 0;

  

  foreach ($rows as $row) {

    if (isset($row['globalRow'])) {

      if (isset($row['globalRow']['globalRowPid'])) {
        $isGlobalRow = $row['globalRow']['isGlobalRow'];
        if ($isGlobalRow == true) {
          $globalRowPostData = get_post_meta( $row['globalRow']['globalRowPid'], 'ULPB_DATA', true );
          $row = $globalRowPostData['Rows'][0]; 
        }
      }
    }


    $rowData = $row['rowData'];

    $rowDataMerged = mergeNonSetObjectValues($rowData,$defaultRowDataOps);

    $rowData = $rowDataMerged;

    $rowID = $row["rowID"];
  	$columns = $row['columns'];

  	$rowMargins = $rowData['margin'];
    $rowPadding = $rowData['padding'];
  	$rowBgColor = $rowData['bg_color'];
  	$rowBgImg = $rowData['bg_img'];
    $currentRowcustomCss = $rowData['customStyling'];
    $currentRowcustomJS = $rowData['customJS'];

    if (isset($row['rowHeight'])) {
      $rowHeight = $row['rowHeight'];
    }else{
      $rowHeight = '100';
    }

    $rowMarginTop = $rowMargins['rowMarginTop'];
    $rowMarginBottom = $rowMargins['rowMarginBottom'];
    $rowMarginLeft = $rowMargins['rowMarginLeft'];
    $rowMarginRight = $rowMargins['rowMarginRight'];

    $rowPaddingTop = $rowPadding['rowPaddingTop'];
    $rowPaddingBottom = $rowPadding['rowPaddingBottom'];
    $rowPaddingLeft = $rowPadding['rowPaddingLeft'];
    $rowPaddingRight = $rowPadding['rowPaddingRight'];

    if (!isset($row['rowHeightUnit']) ) {
      $rowHeightUnit = 'px';
    }else{  
      if ($row['rowHeightUnit'] == '') {
        $rowHeightUnit = 'px';
      } else{
        $rowHeightUnit = $row['rowHeightUnit'];
      }
    }

    if (isset($row['rowHeightTablet']) ) {
      $rowHeightTablet = $row['rowHeightTablet'];
      $rowHeightUnitTablet = $row['rowHeightUnitTablet'];
      $rowHeightMobile = $row['rowHeightMobile'];
      $rowHeightUnitMobile = $row['rowHeightUnitMobile'];
    }else{
      $rowHeightTablet = 'auto';
      $rowHeightUnitTablet = '';
      $rowHeightMobile = 'auto';
      $rowHeightUnitMobile = '';
    }


    if ($rowHeightTablet == '') {
      $rowHeightTablet = 'auto';
      $rowHeightUnitTablet = '';
    }

    if ($rowHeightMobile == '') {
      $rowHeightMobile = 'auto';
      $rowHeightUnitMobile = '';
    }


    $rowBackgroundParallax = '';
    if (isset($rowData['rowBackgroundParallax'])) {
      if ($rowData['rowBackgroundParallax'] == 'true') {
        $rowBackgroundParallax = 'background-attachment:fixed !important;';
      }
    }else{
      $rowData['rowBackgroundParallax'] = '';
    }

    if ($rowBgImg != '' && $rowBgColor == '' ) {
      $rowBgColor = 'transparent';
    }


    $currRowDefaultBackgroundOps = ''; 
    if ( isset($rowData['bgImgOps']) ) {

      $drbgImgOps = $rowData['bgImgOps'];

      $defaultRowBgImg = $rowData['bg_img'];
      $tabletRowBgImg = $rowData['bg_imgT'];
      $mobileRowBgImg = $rowData['bg_imgM'];
      if ($tabletRowBgImg == '') { $tabletRowBgImg = $defaultRowBgImg; }
      if ($mobileRowBgImg == '') { $mobileRowBgImg = $tabletRowBgImg; }


      $defaultRowBgFixed = 'scroll';
      if ($rowData['rowBackgroundParallax'] == 'true') { $defaultRowBgFixed = 'fixed'; }
      $tabletRowBgFixed = $defaultRowBgFixed; $mobileRowBgFixed = $defaultRowBgFixed;
      if ($drbgImgOps['parlxT'] == 'true') { $tabletRowBgFixed = 'fixed'; }
      if ($drbgImgOps['parlxT'] == 'false') { $tabletRowBgFixed = 'scroll'; }
      if ($drbgImgOps['parlxM'] == 'true') { $mobileRowBgFixed = 'fixed'; }
      if ($drbgImgOps['parlxM'] == 'false') { $mobileRowBgFixed = 'scroll'; }

      $drbgImgOpsRep = $drbgImgOps['rep'];
      $drbgImgOpsRepT = $drbgImgOps['repT'];
      $drbgImgOpsRepM = $drbgImgOps['repM'];

      // desktop
      if ($drbgImgOps['pos'] == 'custom') {
        $defaultBgImgPos = 
        "background-position-x: ".$drbgImgOps['xPos'].$drbgImgOps['xPosU']. "; " . 
        "background-position-y: ".$drbgImgOps['yPos'].$drbgImgOps['yPosU']. "; ";
      }else{
        $defaultBgImgPos = "background-position: ".$drbgImgOps['pos']."; ";
      }

      if ( $drbgImgOpsRep == '' || $drbgImgOpsRep == 'default') { $drbgImgOpsRep = 'no-repeat'; }

      if ($drbgImgOps['size'] == 'custom') {
        $defaultBgImgSize = "background-size: ".$drbgImgOps['cWid'].$drbgImgOps['widU']."; ";
      }else{
        $defaultBgImgSize = "background-size: ".$drbgImgOps['size']."; ";
      }
        
      $currRowDefaultBackgroundOps = "
          background-color:$rowBgColor ;
          background-image: url($defaultRowBgImg);
          background-repeat: $drbgImgOpsRep;
          background-attachment: $defaultRowBgFixed;
          $defaultBgImgPos
          $defaultBgImgSize
        
      ";

         



      // Tablet
      if ($drbgImgOps['posT'] == 'custom') {
          $tabletBgImgPos = "background-position-x: ".$drbgImgOps['xPosT'].$drbgImgOps['xPosUT']. "; " .
           "background-position-y: ".$drbgImgOps['yPosT'].$drbgImgOps['yPosUT']. "; ";
      } else if($drbgImgOps['posT'] == ''){
        $tabletBgImgPos = $defaultBgImgPos;
      }else{
        $tabletBgImgPos = "background-position: ".$drbgImgOps['posT']."; ";
      }

      if ($drbgImgOpsRepT == '' || $drbgImgOpsRepT == 'default') { $drbgImgOpsRepT = $drbgImgOpsRep; }


      if ($drbgImgOps['sizeT'] == 'custom') {
        $tabletBgImgSize = "background-size: ".$drbgImgOps['cWidT'].$drbgImgOps['widUT']."; ";
      }else if($drbgImgOps['sizeT'] == ''){
        $tabletBgImgSize = $defaultBgImgSize;
      }else{
        $tabletBgImgSize = "background-size: ".$drbgImgOps['sizeT']."; ";
      }
      

      $currRowtabletBackgroundOps = "
        #".$row["rowID"]." {
          background-image: url($tabletRowBgImg) !important;
          background-repeat: $drbgImgOpsRepT !important;
          background-attachment: $tabletRowBgFixed !important;
          $tabletBgImgPos
          $tabletBgImgSize
        }
      ";




      // mobile
      if ($drbgImgOps['posM'] == 'custom') {
        $mobileBgImgPos = 
        "background-position-x: ".$drbgImgOps['xPosM'].$drbgImgOps['xPosUM']. "; " . 
        "background-position-y: ".$drbgImgOps['yPosM'].$drbgImgOps['yPosUM']. "; ";
      }else if($drbgImgOps['posM'] == ''){
        $mobileBgImgPos = $tabletBgImgPos;
      }else{
        $mobileBgImgPos = "background-position: ".$drbgImgOps['posM']."; ";
      }

      if ($drbgImgOpsRepM == '' || $drbgImgOpsRepM == 'default') { $drbgImgOpsRepM = $drbgImgOpsRepT; }

      if ($drbgImgOps['sizeM'] == 'custom') {
        $mobileBgImgSize = "background-size: ".$drbgImgOps['cWidM'].$drbgImgOps['widUM']."; ";
      }else if($drbgImgOps['sizeM'] == ''){
        $mobileBgImgSize = $tabletBgImgSize;
      }else{
        $mobileBgImgSize = "background-size: ".$drbgImgOps['sizeM']."; ";
      }

      $currRowmobileBackgroundOps = "
        #".$row["rowID"]." {
          background-image: url($mobileRowBgImg) !important;
          background-repeat: $drbgImgOpsRepM !important;
          background-attachment: $mobileRowBgFixed !important;
          $mobileBgImgPos
          $mobileBgImgSize
        }
      ";


      if ($rowData['rowBackgroundType'] !== 'gradient') {
        array_push($POPBNallRowStylesResponsiveTablet, $currRowtabletBackgroundOps);
        array_push($POPBNallRowStylesResponsiveMobile, $currRowmobileBackgroundOps);
      }
      
        
    } // latest row bg options ends 


    $rowBackgroundOptions  = "background-image:url($rowBgImg); background-repeat:no-repeat; background-position:center center; background-size:cover; background-color:$rowBgColor ; "; // old row bg ops

    if ($currRowDefaultBackgroundOps != '') {  $rowBackgroundOptions = $currRowDefaultBackgroundOps;  } // set latest row bg options if available

    if (isset($rowData['rowBackgroundType'])) {
      if ($rowData['rowBackgroundType'] == 'gradient') {
        $rowGradient = $rowData['rowGradient'];
        if ($rowGradient['rowGradientType'] == 'linear') {
          $rowBackgroundOptions = 'background: linear-gradient('.$rowGradient['rowGradientAngle'].'deg, '.$rowGradient['rowGradientColorFirst'].' '.$rowGradient['rowGradientLocationFirst'].'%,'.$rowGradient['rowGradientColorSecond'].' '.$rowGradient['rowGradientLocationSecond'].'%) ;';
        }
        if ($rowGradient['rowGradientType'] == 'radial') {
          $rowBackgroundOptions = 'background: radial-gradient(at '.$rowGradient['rowGradientPosition'].', '.$rowGradient['rowGradientColorFirst'].' '.$rowGradient['rowGradientLocationFirst'].'%,'.$rowGradient['rowGradientColorSecond'].' '.$rowGradient['rowGradientLocationSecond'].'%) ;';
        }
      }
    }

    $rowOverlayBackgroundOptions = '';
    if (isset($rowData['rowBgOverlayColor'])) {
      $rowOverlayBackgroundOptions  = " background:".$rowData['rowBgOverlayColor']." ; background-color:".$rowData['rowBgOverlayColor']." ;";
    }
    if (isset($rowData['rowOverlayBackgroundType'])) {
      if ($rowData['rowOverlayBackgroundType'] == 'gradient') {
        $rowOverlayGradient = $rowData['rowOverlayGradient'];
        if ($rowOverlayGradient['rowOverlayGradientType'] == 'linear') {
          $rowOverlayBackgroundOptions = 'background: linear-gradient('.$rowOverlayGradient['rowOverlayGradientAngle'].'deg, '.$rowOverlayGradient['rowOverlayGradientColorFirst'].' '.$rowOverlayGradient['rowOverlayGradientLocationFirst'].'%,'.$rowOverlayGradient['rowOverlayGradientColorSecond'].' '.$rowOverlayGradient['rowOverlayGradientLocationSecond'].'%) ;';
        }
        if ($rowOverlayGradient['rowOverlayGradientType'] == 'radial') {
          $rowOverlayBackgroundOptions = 'background: radial-gradient(at '.$rowOverlayGradient['rowOverlayGradientPosition'].', '.$rowOverlayGradient['rowOverlayGradientColorFirst'].' '.$rowOverlayGradient['rowOverlayGradientLocationFirst'].'%,'.$rowOverlayGradient['rowOverlayGradientColorSecond'].' '.$rowOverlayGradient['rowOverlayGradientLocationSecond'].'%) ;';
        }
      }
    }


    $thisRowHoverOption = '';
    if (isset($rowData['rowHoverOptions'])) {
        $rowHoverOptions = $rowData['rowHoverOptions'];
        if (isset($rowHoverOptions['rowBackgroundTypeHover'])) {
          if ($rowHoverOptions['rowBackgroundTypeHover'] == 'solid') {
            $thisRowHoverOption = ' #'.$row['rowID'].':hover { background:'.$rowHoverOptions['rowBgColorHover'].' !important; transition: all '.$rowHoverOptions['rowHoverTransitionDuration'].'s; }';
          }
          if ($rowHoverOptions['rowBackgroundTypeHover'] == 'gradient') {
            $rowGradientHover = $rowHoverOptions['rowGradientHover'];

            if (!isset($$rowGradientHover['rowGradientTypeHover'])) {
              $rowGradientHover['rowGradientTypeHover'] = 'linear';
            }
            if ($rowGradientHover['rowGradientTypeHover'] == 'linear') {
              $thisRowHoverOption = ' #'.$row['rowID'].':hover { background: linear-gradient('.$rowGradientHover['rowGradientAngleHover'].'deg, '.$rowGradientHover['rowGradientColorFirstHover'].' '.$rowGradientHover['rowGradientLocationFirstHover'].'%,'.$rowGradientHover['rowGradientColorSecondHover'].' '.$rowGradientHover['rowGradientLocationSecondHover'].'%) !important; transition: all '.$rowHoverOptions['rowHoverTransitionDuration'].'s; }';
            }

            if ($rowGradientHover['rowGradientTypeHover'] == 'radial') {

              $thisRowHoverOption = ' #'.$row['rowID'].':hover { background: radial-gradient(at '.$rowGradientHover['rowGradientPositionHover'].', '.$rowGradientHover['rowGradientColorFirstHover'].' '.$rowGradientHover['rowGradientLocationFirstHover'].'%,'.$rowGradientHover['rowGradientColorSecondHover'].' '.$rowGradientHover['rowGradientLocationSecondHover'].'%) !important; transition: all '.$rowHoverOptions['rowHoverTransitionDuration'].'s; }';
            }
          }
        }

      }


    $rowCustomClass ='';
    if (isset($rowData['rowCustomClass'])) {
      $rowCustomClass = $rowData['rowCustomClass'];
    }

    $rowHideOnDesktop = "display:block"; $rowHideOnTablet = "display:block"; $rowHideOnMobile = "display:block";
    if (isset($rowData['rowHideOnDesktop']) ) {
      if ($rowData['rowHideOnDesktop'] == 'hide') {
        $rowHideOnDesktop ="display:none";
      }
      if ($rowData['rowHideOnTablet'] == 'hide') {
        $rowHideOnTablet ="display:none !important;";
      }
      if ($rowData['rowHideOnMobile'] == 'hide') {
        $rowHideOnMobile ="display:none !important;";
      }
    }
    
    if (isset($rowData['marginTablet'])) {

      $rowMarginTablet = $rowData['marginTablet'];
      $rowMarginMobile = $rowData['marginMobile'];
      $rowPaddingTablet = $rowData['paddingTablet'];
      $rowPaddingMobile = $rowData['paddingMobile'];
      
      $thisRowResponsiveRowStylesTablet = "
        #".$row["rowID"]." {
         margin-top: ".$rowMarginTablet['rMTT']."% !important;
         margin-bottom: ".$rowMarginTablet['rMBT']."% !important;
         margin-left: ".$rowMarginTablet['rMLT']."% !important;
         margin-right: ".$rowMarginTablet['rMRT']."% !important;

         padding-top: ".$rowPaddingTablet['rPTT']."% !important;
         padding-bottom: ".$rowPaddingTablet['rPBT']."% !important;
         padding-left: ".$rowPaddingTablet['rPLT']."% !important;
         padding-right: ".$rowPaddingTablet['rPRT']."% !important;

         min-height:".$rowHeightTablet."$rowHeightUnitTablet !important;
         $rowHideOnTablet
        }
      
      ";
      $thisRowResponsiveRowStylesMobile = "
      
        #".$row["rowID"]." {
         margin-top: ".$rowMarginMobile['rMTM']."% !important;
         margin-bottom: ".$rowMarginMobile['rMBM']."% !important;
         margin-left: ".$rowMarginMobile['rMLM']."% !important;
         margin-right: ".$rowMarginMobile['rMRM']."% !important;

         padding-top: ".$rowPaddingMobile['rPTM']."% !important;
         padding-bottom: ".$rowPaddingMobile['rPBM']."% !important;
         padding-left: ".$rowPaddingMobile['rPLM']."% !important;
         padding-right: ".$rowPaddingMobile['rPRM']."% !important;

         min-height:".$rowHeightMobile."$rowHeightUnitMobile !important;
         $rowHideOnMobile
        }
      ";

      array_push($POPBNallRowStylesResponsiveTablet, $thisRowResponsiveRowStylesTablet);
      array_push($POPBNallRowStylesResponsiveMobile, $thisRowResponsiveRowStylesMobile);
    }

    $rowMarginStyle = "margin:$rowMarginTop"."% $rowMarginRight"."% $rowMarginBottom"."% $rowMarginLeft"."%;";

    $rowPaddingStyle = "padding:$rowPaddingTop"."% $rowPaddingRight"."% $rowPaddingBottom"."% $rowPaddingLeft"."%;";

  	$currentRowStyles = "#".$row["rowID"]."{   min-height:$rowHeight"."$rowHeightUnit; $rowPaddingStyle  $rowMarginStyle  $rowBackgroundOptions  $rowBackgroundParallax  $currentRowcustomCss  $rowHideOnDesktop }     $thisRowHoverOption ";

    array_push($POPBNallRowStyles, $currentRowStyles);

  	//echo($row['rowID']."<br>");
  	

  	?>

    <script type="text/javascript">
      <?php echo $currentRowcustomJS; ?>
    </script>
  	<div class='pops-row w3-row  <?php echo $rowCustomClass ?> <?php echo "pops-row-".$rowCount; ?>' data-row_id='<?php echo $row["rowID"]; ?>' id='<?php echo $row["rowID"]; ?>'>
      <div class="overlay-row" style="<?php echo "$rowOverlayBackgroundOptions"; ?>"></div>

      <?php

        if (isset($rowData['bgSTop']) ) {
          $bgSTop = $rowData['bgSTop'];
          $bgShapeTop = '';
          $rowID = $row["rowID"];
          $positionID  = 'top';
          $shapeType = $bgSTop['rbgstType'];
          if ($shapesinluded == false) {
            include_once 'svgShapes.php';
            $shapesinluded = true;
          }

          $invertTransform = '';
          if ($shapeType == 'random' ) {
            $invertTransform = 'transform:rotate(180deg); -webkit-transform:rotate(180deg);  -moz-transform:rotate(180deg);  -ms-transform:rotate(180deg);';
          }

          if (function_exists('bgSvgShapesRenderCode') ) {
            $bgShapesArray = bgSvgShapesRenderCode($rowID, $positionID, $shapeType);
            $bgShapeTop = $bgShapesArray['shape'];
            $vieBoxAttr = $bgShapesArray['shapeAttr'];
          }

          $renderredHTML = '';
          $returnScripts = '';

          
          if ($bgSTop != 'false') {
            $isFlipped = '';
            if ($bgSTop['rbgstFlipped'] == 'true') {
              $isFlipped = 'transform:rotateY(180deg); -webkit-transform:rotateY(180deg);  -moz-transform:rotateY(180deg);  -ms-transform:rotateY(180deg);';
            }

            if ($bgSTop['rbgstType'] == 'none') {
              $bgShapeTop = '';
            }
            $onFront = '';
            if ($bgSTop['rbgstFront'] == 'true') {
              $onFront = 'z-index:2;'; 
            }

            if ($bgShapeTop != '') {

              $renderredShapeHTML = 
              '<div class="bgShapes bgShapeTop-'.$row["rowID"].'"  style="overflow: hidden; position: absolute; left: 0; width: 100%; direction: ltr; top: -2px; text-align:center; '.$onFront.' '.$invertTransform.' ">'.
                  '<svg xmlns="http://www.w3.org/2000/svg" viewBox="'.$vieBoxAttr.'" preserveAspectRatio="none" style="width: calc('.$bgSTop['rbgstWidth'].'% + 1.5px); height: '.$bgSTop['rbgstHeight'].'px;  position: relative; '.$isFlipped.'" >'.
                  $bgShapeTop.
                '</svg>'.
              ' <style>  .po-top-path-'.$row["rowID"].' { fill:'.$bgSTop['rbgstColor'].'; } </style> </div>  ';

              echo "$renderredShapeHTML";

              $thisShapeResponsiveTablet = "
                .bgShapeTop-".$row["rowID"]." svg {
                  width: calc(".$bgSTop['rbgstWidtht']."% + 1.5px) !important;
                  height:".$bgSTop['rbgstHeightt']."px !important;
                }
              ";

              $thisShapeResponsiveMobile = "
                .bgShapeTop-".$row["rowID"]." svg {
                  width: calc(".$bgSTop['rbgstWidthm']."% + 1.5px) !important;
                  height:".$bgSTop['rbgstHeightm']."px !important;
                }
              ";
              array_push($POPBNallRowStylesResponsiveTablet, $thisShapeResponsiveTablet);
              array_push($POPBNallRowStylesResponsiveMobile, $thisShapeResponsiveMobile);


            }
          }

        }

        if (isset($rowData['bgSBottom']) ) {
          $bgSBottom = $rowData['bgSBottom'];
          $bgShapeBottom = '';
          $rowID = $row["rowID"];
          $positionID  = 'bottom';
          $shapeType = $bgSBottom['rbgsbType'];
          if ($shapesinluded == false) {
            include_once 'svgShapes.php';
            $shapesinluded = true;
          }

          $invertTransform = '';
          if ($shapeType == 'random' ) {
            $invertTransform = 'transform:rotate(0deg); -webkit-transform:rotate(0deg);  -moz-transform:rotate(0deg);  -ms-transform:rotate(0deg);';
          }

          if (function_exists('bgSvgShapesRenderCode') ) {
            $bgShapesArray = bgSvgShapesRenderCode($rowID, $positionID, $shapeType);
            $bgShapeBottom = $bgShapesArray['shape'];
            $vieBoxAttr = $bgShapesArray['shapeAttr'];
          }

          $renderredHTML = '';
          $returnScripts = '';

          
          if ($bgSBottom != 'false') {
            $isFlipped = '';
            if ($bgSBottom['rbgsbFlipped'] == 'true') {
              $isFlipped = 'transform:rotateY(180deg); -webkit-transform:rotateY(180deg);  -moz-transform:rotateY(180deg);  -ms-transform:rotateY(180deg);';
            }

            if ($bgSBottom['rbgsbType'] == 'none') {
              $bgShapeBottom = '';
            }
            $onFront = '';
            if ($bgSBottom['rbgsbFront'] == 'true') {
              $onFront = 'z-index:2;'; 
            }

            if ($bgShapeBottom != '') {

              $renderredShapeHTML = 
              '<div class="bgShapes bgShapeBottom-'.$row["rowID"].'"  style="overflow: hidden; position: absolute; left: 0; width: 100%; direction: ltr;  bottom: -1px; transform: rotate(180deg); -webkit-transform: rotate(180deg);  -moz-transform: rotate(180deg);  -ms-transform: rotate(180deg);  text-align:center; '.$onFront.' '.$invertTransform.' ">'.
                  '<svg xmlns="http://www.w3.org/2000/svg" viewBox="'.$vieBoxAttr.'" preserveAspectRatio="none" style="width: calc('.$bgSBottom['rbgsbWidth'].'% + 1.5px); height: '.$bgSBottom['rbgsbHeight'].'px;  position: relative; '.$isFlipped.'" >'.
                  $bgShapeBottom.
                '</svg>'.
              ' <style>  .po-bottom-path-'.$row["rowID"].' { fill:'.$bgSBottom['rbgsbColor'].'; } </style> </div>  ';

              echo "$renderredShapeHTML";

              $thisShapeResponsiveTablet = "
                .bgShapeBottom-".$row["rowID"]." svg {
                  width: calc(".$bgSBottom['rbgsbWidtht']."% + 1.5px) !important;
                  height:".$bgSBottom['rbgsbHeightt']."px !important;
                }
              ";

              $thisShapeResponsiveMobile = "
                .bgShapeBottom-".$row["rowID"]." svg {
                  width: calc(".$bgSBottom['rbgsbWidthm']."% + 1.5px) !important;
                  height:".$bgSBottom['rbgsbHeightm']."px !important;
                }
              ";
              array_push($POPBNallRowStylesResponsiveTablet, $thisShapeResponsiveTablet);
              array_push($POPBNallRowStylesResponsiveMobile, $thisShapeResponsiveMobile);


            }
          }

        }

      ?>

      

        <?php
          if (isset($rowData['video'])) {
            $rowVideo = $rowData['video'];
            $rowBgVideoEnable = $rowVideo['rowBgVideoEnable'];
            if ($rowBgVideoEnable == 'true') {
              $rowBgVideoLoop = $rowVideo['rowBgVideoLoop'];
              $rowVideoMpfour = $rowVideo['rowVideoMpfour'];
              $rowVideoWebM = $rowVideo['rowVideoWebM'];
              $rowVideoThumb = $rowVideo['rowVideoThumb'];

              if ( !isset($rowVideo['rowVideoType']) ) { $rowVideo['rowVideoType'] = ''; }

              if ($rowVideo['rowVideoType'] == 'yt') {
                 $YtregExp = "/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/";
                 $YTurlMatch = preg_match($YtregExp, $rowVideo['rowVideoYtUrl'],$YTurlMatches);
                 if($YTurlMatch == 1){
                  $ytvidId =  $YTurlMatches[7];
                 }else{
                  $ytvidId = 'false';
                 }
                $VideoBgHtml = '<iframe id="bgVid-'.$row["rowID"].'" width="100%" height="100%" src="https://www.youtube.com/embed/'.$ytvidId.'?rel=0&amp;controls=0&amp;showinfo=0;mute=1;autoplay=1&loop=1&playlist='.$ytvidId.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen ></iframe>';
                echo "$VideoBgHtml";
                ?>
                  <style type="text/css">
                    #bgVid-<?php echo $row["rowID"]; ?> { 
                      position: absolute;
                      min-width: 100%;
                      min-height: 100%;
                      width: auto;
                      height: auto;
                      z-index: -100;
                      background: url('<?php echo $rowVideoThumb; ?>') no-repeat;
                      background-size: cover;
                      transition: 1s opacity;
                      left: 0;
                      right: 0;
                      top: 0;
                    }
                    <?php echo '#'.$row["rowID"]; ?> {
                      background: transparent !important;
                      background-color: transparent !important;
                    }
                  </style>
                <?php
              }else{

                ?>
                  <video class="rowBgVideo" poster="<?php echo $rowVideoThumb; ?>" id="bgVid-<?php echo $row["rowID"]; ?>" playsinline autoplay muted <?php echo $rowBgVideoLoop; ?> >
                    <source src="<?php echo $rowVideoWebM; ?>" type="video/webm">
                    <source src="<?php echo $rowVideoMpfour; ?>" type="video/mp4">
                  </video>
                  <style type="text/css">
                    #bgVid-<?php echo $row["rowID"]; ?> { 
                      position: absolute;
                      min-width: 100%;
                      min-height: 100%;
                      width: auto;
                      height: auto;
                      z-index: -100;
                      background: url('<?php echo $rowVideoThumb; ?>') no-repeat;
                      background-size: cover;
                      transition: 1s opacity;
                      left: 0; 
                      right: 0;
                      top: 0;
                    }
                    <?php echo '#'.$row["rowID"]; ?> {
                      background: transparent !important;
                      background-color: transparent !important;
                      overflow: hidden;
                      position: relative;
                    }
                  </style>

                <?php
              }

            }
            
          }
        ?>

        <?php
          $columnContainerSetWidth = 'max-width:100% !important;';
          if (isset($rowData['conType'])) {
            if ($rowData['conType'] == 'boxed') {
              if ($rowData['conWidth'] != '') {
                $columnContainerSetWidth = 'max-width:'.$rowData['conWidth'].'px !important;';
              }
            }
          }
        ?>
      
      <div class="rowColumnsContainer" id="rowColCont-<?php echo $rowID; ?>" style="margin:0 auto !important; <?php echo "$columnContainerSetWidth"; ?>">
  	   <?php include('columns.php'); ?>
      </div>
      
  	</div>
  	<?php 
    $rowCount++;
  } // ForEach loop for rows ends here



  ob_start();

  foreach ($POPBNallRowStyles as $value) {
    echo $value . "  ";
  }

  foreach ($POPBallColumnStylesArray as $value) {
    echo $value . "  ";
  }

  foreach ($POPBallWidgetsStylesArray as $value) {
    echo $value . "  ";
  }


  echo " \n @media only screen and (min-width : 768px) and (max-width : 1024px) { ";
  foreach ($POPBNallRowStylesResponsiveTablet as $value) {
    echo $value . "  ";
  }
  echo " } ";

  echo " \n @media only screen and (min-width : 320px) and (max-width : 767px) { ";
  foreach ($POPBNallRowStylesResponsiveMobile as $value) {
    echo $value . "  ";
  }
  echo " } ";

  $these_row_styles_inline = ob_get_contents();
  ob_end_clean();


  if ($loadWpFooter == 'true') {

    wp_add_inline_style( 'pluginops-landingpage-style-css', $these_row_styles_inline );

  }else{

    echo '<style>'. $these_row_styles_inline . '</style>';

  }
  



  if ($widgetPostsSliderExternalScripts == true) {
    array_push($POPBallWidgetsScriptsFilesArray, "/public/scripts/owl-carousel/owl.carousel.js" );
  }


  if ($widgetSubscribeFormWidget == true) {
    array_push($POPBallWidgetsScriptsFilesArray, "/js/cookie.js" );
  }


  if ($widgetMasonryLoadScripts == true) {
    array_push($POPBallWidgetsScriptsFilesArray, "/js/masonry.pkgd.min.js" );
  }



  if ($widgetCountDownLoadScripts == true) {
    array_push($POPBallWidgetsScriptsFilesArray, "/js/countdown.js" );
    array_push($POPBallWidgetsScriptsFilesArray, "/js/moment.min.js" );
    array_push($POPBallWidgetsScriptsFilesArray, "/js/moment-timezone-with-data-2010-2020.min.js" );
  }


  if ($widgetSliderLoadScripts == true) {
    array_push($POPBallWidgetsScriptsFilesArray, "/js/slider.min.js" );
  }



  if ($widgetFALoadScripts == true) {
    array_push($POPBallWidgetsScriptsFilesArray, "/js/fa.js" );
  } 

  if ($widgetVideoLoadScripts == true) {

    array_push($POPBallWidgetsStylesFilesArray, "/js/videoJS/video-js.css");

    array_push($POPBallWidgetsScriptsFilesArray, "/js/videoJS/video.js" );

  }


  if ($widgetOwlLoadScripts == true) {

    array_push($POPBallWidgetsStylesFilesArray, "/public/scripts/owl-carousel/owl.carousel.css");
    array_push($POPBallWidgetsStylesFilesArray, "/public/scripts/owl-carousel/owl.theme.css");
    array_push($POPBallWidgetsStylesFilesArray, "/public/scripts/owl-carousel/owl.transitions.css");


  } 

  if ($widgetWooCommLoadScripts == true) {
    array_push($POPBallWidgetsStylesFilesArray, "/styles/wooStyles.css");
  } 

  array_push($POPBallWidgetsStylesFilesArray, "/public/templates/animate.min.css");


  $landingpagejQueryloadScripts = '';
  if ($widgetJQueryLoadScripts == true) {

    if ($loadWpFooter == 'true') {
        
      wp_enqueue_script('jquery');

      wp_enqueue_script( 'jquery-ui-core' );

      wp_enqueue_script( 'jquery-ui-tooltip' );

      wp_enqueue_script( 'jquery-ui-slider' );

      wp_enqueue_script( 'jquery-ui-accordion' );

      wp_enqueue_script( 'jquery-ui-datepicker' );

      wp_enqueue_script( 'jquery-ui-button' );

      wp_enqueue_script( 'jquery-ui-tabs' );

      wp_enqueue_script( 'jquery-ui-draggable' );

      wp_enqueue_script( 'jquery-ui-resizable' );

      wp_enqueue_script( 'jquery-ui-droppable' );

      wp_enqueue_script( 'jquery-ui-sortable' );

      wp_enqueue_script( 'jquery-ui-progressbar' );

      wp_enqueue_script( 'jquery-ui-effects' );

      wp_enqueue_style( 'landing-page-public-jqueryui-styles', ULPB_PLUGIN_URL.'/js/Backbone-resources/jquery-ui.css' , 1.0, $media = 'all' );

    }else{

      $landingpagejQueryloadScripts = 
        '<script type="text/javascript" src="'.ULPB_PLUGIN_URL.'/js/jquery.min.js"></script>
        <script type="text/javascript" src="'.ULPB_PLUGIN_URL.'/js/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="'.ULPB_PLUGIN_URL.'/js/Backbone-resources/jquery-ui.css">';

      if ( $loadThemeWrapper == 'true') {
        $landingpagejQueryloadScripts = '<script type="text/javascript" src="'.ULPB_PLUGIN_URL.'/js/jquery-ui.js"></script>' . '<link rel="stylesheet" type="text/css" href="'.ULPB_PLUGIN_URL.'/js/Backbone-resources/jquery-ui.css">';
      }


    }

      


    $widgetJQueryLoadScripts = true;

  }

  
  echo $landingpagejQueryloadScripts;
  wp_enqueue_script('pluginops-landingpage-scripts-libs',  ULPB_PLUGIN_URL.'/public/scripts/scripts.js', array('jquery'), '1.0', true);

  $landingpageScriptsCounter = 0;
  foreach ($POPBallWidgetsScriptsFilesArray as $value) {

    
    if ($loadWpFooter == 'true') {
      wp_enqueue_script(
        "pluginops-landingpage-script-files_$landingpageScriptsCounter",
        ULPB_PLUGIN_URL.$value ,
        array('pluginops-landingpage-scripts-libs'),
        '1.0',
        true
      );

    }else{

      if ($value != '') {
        echo "<script src='".ULPB_PLUGIN_URL.$value."'></script>";
      }
      
    }

    

    $landingpageScriptsCounter++;

  }


  $landingpageScriptsCounter = 0;
  foreach ($POPBallWidgetsStylesFilesArray as $value) {

    if ($loadWpFooter == 'true') {

      wp_enqueue_style( 'pluginops-landingpage-style-css-files_'.$landingpageScriptsCounter, ULPB_PLUGIN_URL.$value, array(), '1.0', $media = 'all' );

    }else{

      if ($value != '') {
        echo "<link rel='stylesheet' href='".ULPB_PLUGIN_URL.$value."'>";
      }
      
    }

    

    $landingpageScriptsCounter++;

  }


  wp_enqueue_script('pluginops-landingpage-scripts-inline-js-footer',  ULPB_PLUGIN_URL.'/public/scripts/scripts.js', array('jquery'), '1.0', true);


  $landingpageScriptsCounter = 0;
  foreach ($POPBallWidgetsScriptsArray as $value) {


    if ($loadWpFooter == 'true') {

      wp_add_inline_script('pluginops-landingpage-scripts-inline-js-footer', $value, 'after');

    }else{

      if ($value != '') {
        echo  "<script>".$value."</script>";
      }
      
    }
    
    

    $landingpageScriptsCounter++;

  }


  if ($loadWpFooter == 'true') {

    wp_add_inline_script('pluginops-landingpage-scripts-inline-js-footer', $pluginOpsCheckElViewFrameScript, 'after');


    wp_add_inline_script('pluginops-landingpage-scripts-inline-js-footer', $widgetAnimationTriggerScript, 'after');

  }else{

    echo  "<script>".$pluginOpsCheckElViewFrameScript."</script>";

    echo  "<script>".$widgetAnimationTriggerScript."</script>";

  }

    


  
  echo "<div class='popb_footer_scripts' style='display:none !important;'>";


  $customFontsNames = array();
  $pluginops_customFontsSaved = get_option( 'popb_pluginops_custom_fonts', false );


  

  if ( is_array($pluginops_customFontsSaved) ) {
    
      foreach ($pluginops_customFontsSaved as $key => $value) {

        $checkIsCustomFontHasNumber = $value['fontTitle'];
        if(1 === preg_match('~[0-9]~', $checkIsCustomFontHasNumber)){
          $checkIsCustomFontHasNumber = "'".$checkIsCustomFontHasNumber."'";
        }

        
        
        if ($checkIsCustomFontHasNumber != '') {

          $fontwoff =  'url("'.$value['fontwoff'].'") format("woff")';

          $fontwoff2 = ', url("'.$value['fontwoff2'].'") format("woff2")';

          $fontttf = ', url("'.$value['fontttf'].'") format("truetype")';

          $fonteot = ', url("'.$value['fonteot'].'") format("embedded-opentype")';

          $fontsvg = ', url("'.$value['fontsvg'].'") format("svg")';


          $addThisFontToCustomFontStyles = $fontwoff .$fontwoff2 .$fontttf .$fonteot .$fontsvg;

          echo "

            <style>

              @font-face {

                font-family: '".$value['fontTitle']."' ;

                src: $addThisFontToCustomFontStyles

              }

            </style>

          ";

          array_push($customFontsNames, $checkIsCustomFontHasNumber);

        }

      }

  }

  $aller = '';
  $thisColFontsToLoadSeparatedValue = 'Allerta';
  $thisFontsIndex = 0;
      foreach ($thisColFontsToLoad as $value) {

        $value = str_replace("'", "", $value);

        if ($value !== '') {
          $aller = strpos($thisColFontsToLoadSeparatedValue, $value);
        }

        if ( is_array($customFontsNames) ) {
          $valueCheckInCustomFonts = str_replace("'","",$value); 
          if ( in_array($valueCheckInCustomFonts, $customFontsNames, false) ) {
            $value = 'Select';
          }
        }
        
        if ($value == 'Select' || $value == 'select' || $value == 'Arial' || $value == 'sans-serif' || $value == 'Arial Black' || $value == 'sans' || $value == 'Helvetica' || $value == 'Serif' || $value == 'Tahoma' || $value == 'Verdana' || $value == 'Monaco' || $value == 'Impact' || $aller !== false) {
        }else{
          if ($value != '' && $value !== ' ') {
            if ($thisFontsIndex == 0) {
              $thisColFontsToLoadSeparatedValue = '?family='.$value;
            }else{
              $thisColFontsToLoadSeparatedValue = $thisColFontsToLoadSeparatedValue . '&family='.$value;
            }

            $thisFontsIndex++;
          }
        }
        
      }

      echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2'.$thisColFontsToLoadSeparatedValue.'">';


  foreach ($widgetTextFontsBulk as $value) {

    if ( !isset($value) ) { $value = '';  }

    $checkFontValue = str_replace(' ', '', $value); 
    if ($checkFontValue != '' && $checkFontValue != ' ' && $checkFontValue != 'undefined') {
      echo "$value";
    }

  }

  echo '</div>'; //  .popb_footer_scripts end


  ?>

<?php

    if (class_exists('E_Clean_Exit') ) {
      if (! did_action( 'wp_footer' ) ) {
        
        if ($loadThemeWrapper !== "true") {
          wp_footer(); 
        }
        $loadWpFooter = 'true'; 
      
      }
    }

    if ($loadWpFooter === 'true') { 
      if (! did_action( 'wp_footer' ) ) {

        if ($loadThemeWrapper !== "true") {
          wp_footer(); 
        }

      }
    }
?>


<?php

if ( function_exists('ulpb_available_pro_widgets') ) { echo " <!--- PluginOps Type - 1 --->"; } else { echo " <!--- PluginOps Type - 0 --->"; }

?>


<?php
if (current_user_can( 'publish_pages' ) ) {

  if ($abTestingActive == true) {
    ?>
    <div class="variantTypePopUp">
      <h4>Variant</h4>
      <h2><?php echo $currentVariant; ?></h2>
    </div>
    <?php
  }

}
?>


<?php if ($current_postType == 'post' || $current_postType == 'page' || $isShortCodeTemplate == true ){ echo "</div>";} else{ echo "</body>"; }   ?>

<?php
} else{
  echo "<h3> Please add some content in your page.</h3>";
}


?>


<!-- <style type="text/css">
  <?php 
  // if (isset( $data['pageOptions']['poCustomFonts'] )) {
  //   foreach ($data['pageOptions']['poCustomFonts'] as $key => $value) {
  //     echo '@font-face {
  //       font-family: "'.$value['poCfName'].'"
  //       src: url("'.$value['poCfFileUrlEot'].'");
  //       src: url("'.$value['poCfFileUrlWoff'].'") format("woff"), 
  //            url("'.$value['poCfFileUrlOtf'].'") format("opentype");
  //     }';
  //   }
  // }

  ?>
</style> -->


</html>