<?php if ( ! defined( 'ABSPATH' ) ) exit;

//include 'temp-functions.php';

$loadWpHead = $data['pageOptions']['loadWpHead'];
$loadWpFooter = $data['pageOptions']['loadWpFooter'];
$pageSeoDescription = $data['pageOptions']['pageSeoDescription'];
$pageSeoKeywords = $data['pageOptions']['pageSeoKeywords'];
$pageSeoName = $data['pageOptions']['pageSeoName'];
$pageBgImage = $data['pageOptions']['pageBgImage'];
$pageBgColor = $data['pageOptions']['pageBgColor'];
$pagePadding = $data['pageOptions']['pagePadding'];
$pagePaddingTop = $pagePadding['pagePaddingTop'];
$pagePaddingBottom = $pagePadding['pagePaddingBottom'];
$pagePaddingLeft = $pagePadding['pagePaddingLeft'];
$pagePaddingRight = $pagePadding['pagePaddingRight'];

if (!isset($data['pageOptions']['loadWpFooterTwo'])) {
  $loadWpFooter = 'true';
}else{
  $loadWpFooter = $data['pageOptions']['loadWpFooterTwo'];
}

if (isset($data['pageOptions']['pageFavIconUrl'])) {
  $pageFavIconUrl = $data['pageOptions']['pageFavIconUrl'];
}
if (isset($data['pageOptions']['pageLogoUrl'])) {
  $pageLogoUrl = $data['pageOptions']['pageLogoUrl'];
}

if (isset($data['pageOptions']['POcustomCSS'])) {
  $POcustomCSS = $data['pageOptions']['POcustomCSS'];
}

$POPBDefaultsEnable = '';
if (isset($data['pageOptions']['POPBDefaults'])) {
  $POPBDefaults = $data['pageOptions']['POPBDefaults'];
  $POPBDefaultsEnable = $POPBDefaults['POPBDefaultsEnable'];
  $POPB_typefaces = $POPBDefaults['POPB_typefaces'];
  $POPB_typeSizes = $POPBDefaults['POPB_typeSizes'];
}

if (isset($data['pageOptions']['pagePaddingTablet'])) {
  
  $pagePaddingTablet = $data['pageOptions']['pagePaddingTablet'];
  $pagePaddingMobile = $data['pageOptions']['pagePaddingMobile'];


          $POPBPagePaddingResponsiveTablet = "\n".

            '.ulpb_PageBody_'.$current_pageID.' { padding-top:'.$pagePaddingTablet['pagePaddingTopTablet'].'% !important; padding-bottom:'.$pagePaddingTablet['pagePaddingBottomTablet'].'% !important; padding-left:'.$pagePaddingTablet['pagePaddingLeftTablet'].'% !important; padding-right:'.$pagePaddingTablet['pagePaddingRightTablet'].'% !important;  }  '.
            ' ';

          $POPBPagePaddingResponsiveMobile = "\n".

            '.ulpb_PageBody_'.$current_pageID.' { padding-top:'.$pagePaddingMobile['pagePaddingTopMobile'].'% !important; padding-bottom:'.$pagePaddingMobile['pagePaddingBottomMobile'].'% !important; padding-left:'.$pagePaddingMobile['pagePaddingLeftMobile'].'% !important; padding-right:'.$pagePaddingMobile['pagePaddingRightMobile'].'% !important;  }  '.
            ' ';

            array_push($POPBNallRowStylesResponsiveTablet, $POPBPagePaddingResponsiveTablet);
            array_push($POPBNallRowStylesResponsiveMobile, $POPBPagePaddingResponsiveMobile);
}


if (isset($data['pageOptions']['POcustomJS'])) {
  $POcustomJS = $data['pageOptions']['POcustomJS'];
}


if (!isset($data['pageOptions']['pageSeoMetaTags'])) {
  $data['pageOptions']['pageSeoMetaTags'] = ' ';
}

$pbLocale = get_locale();
$pb_langAttr = get_language_attributes();
?>
<?php if ($current_postType == 'post' || $current_postType == 'page' || $isShortCodeTemplate == true ){} else{ echo "  <!DOCTYPE html>
<html $pb_langAttr > \n  <head>"; }   ?>
  
<?php if ($isShortCodeTemplate == true) {
} else{ 
  if ( !isset( $data['pageOptions']['pageSeofbOgImage'] ) ) {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $customLogoImage = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    $data['pageOptions']['pageSeofbOgImage'] =  $customLogoImage[0];
  }else{
    if ( $data['pageOptions']['pageSeofbOgImage'] == '') {
      $custom_logo_id = get_theme_mod( 'custom_logo' );
      $customLogoImage = wp_get_attachment_image_src( $custom_logo_id , 'full' );
      $data['pageOptions']['pageSeofbOgImage'] =  $customLogoImage[0];
    }
  }
  ?>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $currentPageTitle; ?></title>
  <?php 
  if (isset($pageFavIconUrl)) {
    echo "<link rel='shortcut icon' href='$pageFavIconUrl' />";
  }
  
  if (class_exists('E_Clean_Exit') ) {
      if (! did_action( 'wp_head' ) ) { 

        if ($loadThemeWrapper !== "true") {
          wp_head(); 
        }
        $loadWpHead = 'true'; 
        
      }  
  }


  if ($loadWpHead === 'true') {
    if (! did_action( 'wp_head' ) ) {
      if ($loadThemeWrapper !== "true") {
        wp_head();
      }
    }   
  }

}


if ($loadThemeWrapper !== "true") {

  echo "

    <style>
      body{
        margin:0;
        padding:0;
      }
    </style>

  ";

}
?>
  
  <meta property="og:locale" content="<?php echo $pbLocale; ?>" />
  <meta property="og:type" content="object" />
  <meta property="og:title" content="<?php echo $currentPageTitle; ?>" />
  <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
  <meta property="og:description" name="og:description" content="<?php echo $pageSeoDescription; ?>">
  <meta property="og:image" name="og:image" content="<?php echo $data['pageOptions']['pageSeofbOgImage']; ?>">
  <meta property="og:url" content="<?php $url = get_the_permalink($current_pageID); echo $url; ?>">
  <meta name="description" content="<?php echo $pageSeoDescription; ?>">
  <meta name="keywords" content="<?php echo $pageSeoKeywords; ?>">


<?php
  
  echo $data['pageOptions']['pageSeoMetaTags'];

?>

  <style type="text/css">
  <?php if (!empty($pageBgImage)) {
    if ($isShortCodeTemplate !== true) {
      ?>
      .ulpb_PageBody_<?php echo $current_pageID ?> {
      background:url("<?php echo $pageBgImage; ?>")no-repeat center center; background-size:cover;
      }
      <?php
    }
      
    } ?>
  <?php 

    if (!empty($pageBgColor)){
      if (isset($isShortCodeTemplate)) {
        if ($isShortCodeTemplate !== true) {
          ?>
          .ulpb_PageBody_<?php echo $current_pageID ?> {
            background-color: <?php echo $pageBgColor; ?> ;
          }
          <?php
        }
      }
    }
    if (isset($isShortCodeTemplate)) {
      if ($isShortCodeTemplate !== true) {
        ?>
        .ulpb_PageBody_<?php echo $current_pageID ?>{
          padding: <?php echo "$pagePaddingTop"."% $pagePaddingRight"."% $pagePaddingBottom"."% $pagePaddingLeft"."%"; ?>;
        }
        <?php  
      
      }
    }
      
    ?>



  <?php 

    $bodyBackgroundOptions = "background:url($pageBgImage) no-repeat center center; background-size:cover; background-color:$pageBgColor ; ";

  if (isset($data['pageOptions']['bodyBackgroundType'])) {
   if ($data['pageOptions']['bodyBackgroundType'] == 'gradient') {
    $bodyGradient = $data['pageOptions']['bodyGradient'];
    if ($bodyGradient['bodyGradientType'] == 'linear') {
     $bodyBackgroundOptions = 'background: linear-gradient(' . $bodyGradient['bodyGradientAngle'] . 'deg, ' . $bodyGradient['bodyGradientColorFirst'] . ' ' . $bodyGradient['bodyGradientLocationFirst'] . '%,' . $bodyGradient['bodyGradientColorSecond'] . ' ' . $bodyGradient['bodyGradientLocationSecond'] . '%) ;';
    }

    if ($bodyGradient['bodyGradientType'] == 'radial') {
     $bodyBackgroundOptions = 'background: radial-gradient(at ' . $bodyGradient['bodyGradientPosition'] . ', ' . $bodyGradient['bodyGradientColorFirst'] . ' ' . $bodyGradient['bodyGradientLocationFirst'] . '%,' . $bodyGradient['bodyGradientColorSecond'] . ' ' . $bodyGradient['bodyGradientLocationSecond'] . '%) ;';
    }
   }
  }

  $bodyOverlayBackgroundOptions = '';

  if (isset($data['pageOptions']['bodyBgOverlayColor'])) {
   $bodyOverlayBackgroundOptions = " background:" . $data['pageOptions']['bodyBgOverlayColor'] . " ; background-color:" . $data['pageOptions']['bodyBgOverlayColor'] . " ;";
  }

  $thisbodyHoverOption = '';

  if (isset($data['pageOptions']['bodyHoverOptions'])) {
   $bodyHoverOptions = $data['pageOptions']['bodyHoverOptions'];

    if (isset($bodyHoverOptions['bodyBackgroundTypeHover'])) {
      if ($bodyHoverOptions['bodyBackgroundTypeHover'] == 'solid') {
        $thisbodyHoverOption = ' .ulpb_PageBody' . $current_pageID . ':hover { background:' . $bodyHoverOptions['bodyBgColorHover'] . ' !important; transition: all ' . $bodyHoverOptions['bodyHoverTransitionDuration'] . 's; }';
      }

      if ($bodyHoverOptions['bodyBackgroundTypeHover'] == 'gradient') {
        $bodyGradientHover = $bodyHoverOptions['bodyGradientHover'];
        if ($bodyGradientHover['bodyGradientTypeHover'] == 'linear') {
          $thisbodyHoverOption = ' .ulpb_PageBody' . $current_pageID . ':hover { background: linear-gradient(' . $bodyGradientHover['bodyGradientAngleHover'] . 'deg, ' . $bodyGradientHover['bodyGradientColorFirstHover'] . ' ' . $bodyGradientHover['bodyGradientLocationFirstHover'] . '%,' . $bodyGradientHover['bodyGradientColorSecondHover'] . ' ' . $bodyGradientHover['bodyGradientLocationSecondHover'] . '%) !important; transition: all ' . $bodyHoverOptions['bodyHoverTransitionDuration'] . 's; }';
        }

        if ($bodyGradientHover['bodyGradientTypeHover'] == 'radial') {
        $thisbodyHoverOption = ' .ulpb_PageBody' . $current_pageID . ':hover { background: radial-gradient(at ' . $bodyGradientHover['bodyGradientPositionHover'] . ', ' . $bodyGradientHover['bodyGradientColorFirstHover'] . ' ' . $bodyGradientHover['bodyGradientLocationFirstHover'] . '%,' . $bodyGradientHover['bodyGradientColorSecondHover'] . ' ' . $bodyGradientHover['bodyGradientLocationSecondHover'] . '%) !important; transition: all ' . $bodyHoverOptions['bodyHoverTransitionDuration'] . 's; }';
        }
      }
    }
    
  }

  if (isset($data['pageOptions']['bodyOverlayBackgroundType'])) {
   if ($data['pageOptions']['bodyOverlayBackgroundType'] == 'gradient') {
    $bodyOverlayGradient = $data['pageOptions']['bodyOverlayGradient'];
    if ($bodyOverlayGradient['bodyOverlayGradientType'] == 'linear') {
     $bodyOverlayBackgroundOptions = 'background: linear-gradient(' . $bodyOverlayGradient['bodyOverlayGradientAngle'] . 'deg, ' . $bodyOverlayGradient['bodyOverlayGradientColorFirst'] . ' ' . $bodyOverlayGradient['bodyOverlayGradientLocationFirst'] . '%,' . $bodyOverlayGradient['bodyOverlayGradientColorSecond'] . ' ' . $bodyOverlayGradient['bodyOverlayGradientLocationSecond'] . '%) ;';
    }

    if ($bodyOverlayGradient['bodyOverlayGradientType'] == 'radial') {
     $bodyOverlayBackgroundOptions = 'background: radial-gradient(at ' . $bodyOverlayGradient['bodyOverlayGradientPosition'] . ', ' . $bodyOverlayGradient['bodyOverlayGradientColorFirst'] . ' ' . $bodyOverlayGradient['bodyOverlayGradientLocationFirst'] . '%,' . $bodyOverlayGradient['bodyOverlayGradientColorSecond'] . ' ' . $bodyOverlayGradient['bodyOverlayGradientLocationSecond'] . '%) ;';
    }
   }
  }


  ?>
  .ulpb_PageBody<?php echo $current_pageID; 
  echo "{ $bodyBackgroundOptions }";

  echo " #fullPageBgOverlay_$current_pageID { $bodyOverlayBackgroundOptions }";

  echo "$thisbodyHoverOption";
?>
  
  </style>

<!-- Tracking Scripts -->
<?php
$ulpb_global_tracking_scripts = get_option( 'ulpb_global_tracking_scripts' );
echo $ulpb_global_tracking_scripts;
?>

<!-- Custom head styling  -->
<style type="text/css">
  

  <?php 
    if (isset($POcustomCSS)) {
      echo "$POcustomCSS";
    }
  ?>
</style>

<!-- Custom head script  -->
<script>
  <?php 
    if (isset($POcustomJS)) {
      echo "$POcustomJS";
    }
  ?>
</script>

<?php


if ($POPBDefaultsEnable == 'true') {

          if ( !isset( $POPB_typefaces['typefaceH3'] ) ) {
            $POPB_typefaces['typefaceH3'] = '';
            $POPB_typefaces['typefaceH4'] = '';
            $POPB_typefaces['typefaceH5'] = '';
            $POPB_typefaces['typefaceH6'] = '';
          }
          if (!isset( $POPB_typeSizes['typeSizeH3'] )) {
            $POPB_typeSizes['typeSizeH3'] = '';
            $POPB_typeSizes['typeSizeH3Tablet'] = '';
            $POPB_typeSizes['typeSizeH3Mobile'] = '';

            $POPB_typeSizes['typeSizeH4'] = '';
            $POPB_typeSizes['typeSizeH4Tablet'] = '';
            $POPB_typeSizes['typeSizeH4Mobile'] = '';

            $POPB_typeSizes['typeSizeH5'] = '';
            $POPB_typeSizes['typeSizeH5Tablet'] = '';
            $POPB_typeSizes['typeSizeH5Mobile'] = '';

            $POPB_typeSizes['typeSizeH6'] = '';
            $POPB_typeSizes['typeSizeH6Tablet'] = '';
            $POPB_typeSizes['typeSizeH6Mobile'] = '';
          }

          if(1 === preg_match('~[0-9]~', $POPB_typefaces['typefaceHOne'])){
            $POPB_typefaces['typefaceHOne'] = "'".$POPB_typefaces['typefaceHOne']."'";
          }
          if(1 === preg_match('~[0-9]~', $POPB_typefaces['typefaceHTwo'])){
            $POPB_typefaces['typefaceHTwo'] = "'".$POPB_typefaces['typefaceHTwo']."'";
          }
          if(1 === preg_match('~[0-9]~', $POPB_typefaces['typefaceH3'])){
            $POPB_typefaces['typefaceH3'] = "'".$POPB_typefaces['typefaceH3']."'";
          }
          if(1 === preg_match('~[0-9]~', $POPB_typefaces['typefaceH4'])){
            $POPB_typefaces['typefaceH4'] = "'".$POPB_typefaces['typefaceH4']."'";
          }
          if(1 === preg_match('~[0-9]~', $POPB_typefaces['typefaceH5'])){
            $POPB_typefaces['typefaceH5'] = "'".$POPB_typefaces['typefaceH5']."'";
          }
          if(1 === preg_match('~[0-9]~', $POPB_typefaces['typefaceH6'])){
            $POPB_typefaces['typefaceH6'] = "'".$POPB_typefaces['typefaceH6']."'";
          }
          if(1 === preg_match('~[0-9]~', $POPB_typefaces['typefaceParagraph'])){
            $POPB_typefaces['typefaceParagraph'] = "'".$POPB_typefaces['typefaceParagraph']."'";
          }
          if(1 === preg_match('~[0-9]~', $POPB_typefaces['typefaceButton'])){
            $POPB_typefaces['typefaceButton'] = "'".$POPB_typefaces['typefaceButton']."'";
          }
          if(1 === preg_match('~[0-9]~', $POPB_typefaces['typefaceAnchorLink'])){
            $POPB_typefaces['typefaceAnchorLink'] = "'".$POPB_typefaces['typefaceAnchorLink']."'";
          }

          array_push($thisColFontsToLoad, $POPB_typefaces['typefaceHOne']);
          array_push($thisColFontsToLoad, $POPB_typefaces['typefaceHTwo']);
          array_push($thisColFontsToLoad, $POPB_typefaces['typefaceH3']);
          array_push($thisColFontsToLoad, $POPB_typefaces['typefaceH4']);
          array_push($thisColFontsToLoad, $POPB_typefaces['typefaceH5']);
          array_push($thisColFontsToLoad, $POPB_typefaces['typefaceH6']);
          array_push($thisColFontsToLoad, $POPB_typefaces['typefaceParagraph']);
          array_push($thisColFontsToLoad, $POPB_typefaces['typefaceButton']);
          array_push($thisColFontsToLoad, $POPB_typefaces['typefaceAnchorLink']);

          $POPBGlobalStylesTag = "\n".

            '.ulpb_PageBody_'.$current_pageID.' h1 { font-family:'.str_replace('+',' ',$POPB_typefaces['typefaceHOne']).'; font-size:'.$POPB_typeSizes['typeSizeHOne'].'px; }  '.

            '.ulpb_PageBody_'.$current_pageID.' h2 { font-family:'.str_replace('+',' ',$POPB_typefaces['typefaceHTwo']).'; font-size:'.$POPB_typeSizes['typeSizeHTwo'].'px; }  '.

            '.ulpb_PageBody_'.$current_pageID.' h3 { font-family:'.str_replace('+',' ',$POPB_typefaces['typefaceH3']).'; font-size:'.$POPB_typeSizes['typeSizeH3'].'px; }  '.

            '.ulpb_PageBody_'.$current_pageID.' h4 { font-family:'.str_replace('+',' ',$POPB_typefaces['typefaceH4']).'; font-size:'.$POPB_typeSizes['typeSizeH4'].'px; }  '.

            '.ulpb_PageBody_'.$current_pageID.' h5 { font-family:'.str_replace('+',' ',$POPB_typefaces['typefaceH5']).'; font-size:'.$POPB_typeSizes['typeSizeH5'].'px; }  '.

            '.ulpb_PageBody_'.$current_pageID.' h6 { font-family:'.str_replace('+',' ',$POPB_typefaces['typefaceH6']).'; font-size:'.$POPB_typeSizes['typeSizeH6'].'px; }  '.

            '.ulpb_PageBody_'.$current_pageID.' p { font-family:'.str_replace('+',' ',$POPB_typefaces['typefaceParagraph']).'; font-size:'.$POPB_typeSizes['typeSizeParagraph'].'px; }  '.

            '.ulpb_PageBody_'.$current_pageID.' p span { font-size:'.$POPB_typeSizes['typeSizeParagraph'].'px; }  '.

            '.ulpb_PageBody_'.$current_pageID.' button { font-family:'.str_replace('+',' ',$POPB_typefaces['typefaceButton']).'; font-size:'.$POPB_typeSizes['typeSizeButton'].'px; }  '.
            
            '.ulpb_PageBody_'.$current_pageID.' a { font-family:'.str_replace('+',' ',$POPB_typefaces['typefaceAnchorLink']).'; font-size:'.$POPB_typeSizes['typeSizeAnchorLink'].'px; } ';

          echo '<style type="text/css" id="POPBGlobalStylesTag">'.$POPBGlobalStylesTag.'</style>'."\n";


          if (isset($POPB_typeSizes['typeSizeHOneTablet'])) {

            $POPBGlobalStylesResponsiveTablet = "\n".

              '.ulpb_PageBody_'.$current_pageID.' h1 { font-size:'.$POPB_typeSizes['typeSizeHOneTablet'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' h2 { font-size:'.$POPB_typeSizes['typeSizeHTwoTablet'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' h3 { font-size:'.$POPB_typeSizes['typeSizeH3Tablet'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' h4 { font-size:'.$POPB_typeSizes['typeSizeH4Tablet'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' h5 { font-size:'.$POPB_typeSizes['typeSizeH5Tablet'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' h6 { font-size:'.$POPB_typeSizes['typeSizeH6Tablet'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' p { font-size:'.$POPB_typeSizes['typeSizeParagraphTablet'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' button { font-size:'.$POPB_typeSizes['typeSizeButtonTablet'].'px !important; }  '.
              
              '.ulpb_PageBody_'.$current_pageID.' a {  font-size:'.$POPB_typeSizes['typeSizeAnchorLinkTablet'].'px !important; } '.
              ' ';

            $POPBGlobalStylesResponsiveMobile = "\n".

              '.ulpb_PageBody_'.$current_pageID.' h1 { font-size:'.$POPB_typeSizes['typeSizeHOneMobile'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' h2 { font-size:'.$POPB_typeSizes['typeSizeHTwoMobile'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' h3 { font-size:'.$POPB_typeSizes['typeSizeH3Mobile'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' h4 { font-size:'.$POPB_typeSizes['typeSizeH4Mobile'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' h5 { font-size:'.$POPB_typeSizes['typeSizeH5Mobile'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' h6 { font-size:'.$POPB_typeSizes['typeSizeH6Mobile'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' p { font-size:'.$POPB_typeSizes['typeSizeParagraphMobile'].'px !important; }  '.

              '.ulpb_PageBody_'.$current_pageID.' button { font-size:'.$POPB_typeSizes['typeSizeButtonMobile'].'px !important; }  '.
              
              '.ulpb_PageBody_'.$current_pageID.' a {  font-size:'.$POPB_typeSizes['typeSizeAnchorLinkMobile'].'px !important; } '.
              ' ';

              array_push($POPBNallRowStylesResponsiveTablet, $POPBGlobalStylesResponsiveTablet);
              array_push($POPBNallRowStylesResponsiveMobile, $POPBGlobalStylesResponsiveMobile);

          }

}


if ($lp_thisPostType == 'ulpb_post') {
  include 'counter.php';
}

if ( function_exists('ulpb_available_pro_widgets') ) { echo " <!--- PluginOps Type - 1 --->"; } else { echo " <!--- PluginOps Type - 0 --->"; }


wp_enqueue_style( 'dashicons' );

if ($loadWpFooter == 'true') {
  wp_enqueue_style( 'pluginops-landingpage-style-css', ULPB_PLUGIN_URL.'/public/templates/style.css', array(), '1.0', $media = 'all' );
}else{
  echo "<link rel='stylesheet' href='".ULPB_PLUGIN_URL."/public/templates/style.css"."'>";
}



if ($current_postType == 'post' || $current_postType == 'page' || $isShortCodeTemplate == true ){} else{ echo "</head>"; }



$pluginOpsCheckElViewFrameScript =
  '
    jQuery(document).ready(function(){

      jQuery(".pb_img_thumbnail").on("click",function(){
        var clikedElID = jQuery(this).attr("id");
        jQuery("#pb_lightbox"+clikedElID).css("display","block");
      });

      jQuery(".pb_single_img_lightbox").on("click",function(){
        jQuery(this).css("display","none");
      });

      jQuery(window).scroll();

    });


    (function($) {

      /**
       * Copyright 2012, Digital Fusion
       * Licensed under the MIT license.
       * http://teamdf.com/jquery-plugins/license/
       *
       * @author Sam Sehnert
       * @desc A small plugin that checks whether elements are within
       *     the user visible viewport of a web browser.
       *     only accounts for vertical position, not horizontal.
       */

      $.fn.visible = function(partial) {
        
          var $t            = $(this),
              $w            = $(window),
              viewTop       = $w.scrollTop(),
              viewBottom    = viewTop + $w.height(),
              _top          = $t.offset().top,
              _bottom       = _top + $t.height(),
              compareTop    = partial === true ? _bottom : _top,
              compareBottom = partial === true ? _top : _bottom;
        
        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

      };

      jQuery(document).on("click", \'a[href^="#"]\', function (event) {
        event.preventDefault();
        
        var clickedLinkElAttr = jQuery(this ).attr("href");
        if(typeof(jQuery(clickedLinkElAttr).offset() ) != "undefined"){
          jQuery("html, body").animate({
              scrollTop: jQuery(jQuery.attr(this, "href")).offset().top
          }, 500);
        }
          
      });
      
    })(jQuery);

  
    if(typeof pluginOpsCheckElViewFrame != "function" ){
      function pluginOpsCheckElViewFrame (el) {

        if (typeof jQuery === "function" && el instanceof jQuery) {
            el = el[0];
        }

        if( typeof(el.getBoundingClientRect) == "function"  ){
          var rect = el.getBoundingClientRect();
          windowInnerHeight = window.innerHeight;
          if(rect.height >= windowInnerHeight){
            rect.height = windowInnerHeight - 50;
          }
          docClientHeight = document.documentElement.clientHeight;
          if( rect.top >= 0 &&
              rect.left >= 0 &&
              rect.bottom <= (windowInnerHeight) && 
              rect.right <= (window.innerWidth || document.documentElement.clientWidth) ) {
                return "InView";
              }else{
                return "NotInView";
              }
        }else{
          return "Function didnt work";
        }

      }
    }
      

    '.$widgetAnimationTriggerScript. " jQuery(window).scroll();

  ";

?>
