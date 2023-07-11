<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$this_widget_text = $thisWidget['widgetText'];

$widgetTextContent = str_replace("\n","<br>",$this_widget_text['widgetTextContent']);

$widgetTextContent = str_replace("contenteditable","e",$widgetTextContent);

$widgetTextAlignment = '';
if (isset( $this_widget_text['widgetTextAlignment'] )) {
  $widgetTextAlignment = $this_widget_text['widgetTextAlignment'];
}

if (!isset($this_widget_text['widgetTextTransform'])) {
  $this_widget_text['widgetTextTransform'] = '';
}

$widgetTextTag = esc_attr( $this_widget_text['widgetTextTag']);
$widgetTextColor = esc_attr( $this_widget_text['widgetTextColor']);
$widgetTextSize = esc_attr( $this_widget_text['widgetTextSize']);
$widgetTextFamily = esc_attr( $this_widget_text['widgetTextFamily']);
$widgetTextWeight = esc_attr( $this_widget_text['widgetTextWeight']);
$widgetTextTransform = esc_attr( $this_widget_text['widgetTextTransform']);

$widgetTextBold = ''; $widgetTextItalic = ''; $widgetTextUnderlined = '';

if (isset($this_widget_text['widgetTextBold'])) {
  if ($this_widget_text['widgetTextBold'] == true) { $widgetTextBold = 'bold'; }
}
if (isset($this_widget_text['widgetTextItalic'])) {
  if ($this_widget_text['widgetTextItalic'] == true) { $widgetTextItalic = 'italic'; }
}

if (isset($this_widget_text['widgetTextUnderlined'])) {
  if ($this_widget_text['widgetTextUnderlined'] == true) { $widgetTextUnderlined = 'underline'; }
}
$widgetTextAlignmentTablet = ''; $widgetTextAlignmentMobile = '';
if (isset($this_widget_text['widgetTextAlignmentTablet'])) {
  $widgetTextAlignmentTablet = esc_attr( $this_widget_text['widgetTextAlignmentTablet']);
  $widgetTextAlignmentMobile = esc_attr( $this_widget_text['widgetTextAlignmentMobile']);
}

if (isset($this_widget_text['widgetTextAlignmentMobile'])) {
  $widgetTextAlignmentMobile = esc_attr( $this_widget_text['widgetTextAlignmentMobile']);
}

if (isset($this_widget_text['widgetTextSizeTablet']) || isset($this_widget_text['widgetTextSizeMobile'])) {
  $widgetTextTagNew = $widgetTextTag;
  if ($widgetTextTag == 'a') {
    $widgetTextTagNew = 'p';
  }
  $thisTextWidgetResponsiveWidgetStylesTablet = "
    #widget-$j-$Columni-".$row["rowID"]."  $widgetTextTagNew * {
     font-size: ".esc_attr($this_widget_text['widgetTextSizeTablet'])."px !important;
     line-height: ".esc_attr($this_widget_text['widgetTextLineHeightTablet'])."em !important;
     letter-spacing: ".esc_attr($this_widget_text['widgetTextSpacingTablet'])."px !important;
     text-align:$widgetTextAlignmentTablet !important;
    }

    #widget-$j-$Columni-".$row["rowID"]."  $widgetTextTagNew {
      font-size: ".esc_attr($this_widget_text['widgetTextSizeTablet'])."px !important;
      line-height: ".esc_attr($this_widget_text['widgetTextLineHeightTablet'])."em !important;
      letter-spacing: ".esc_attr($this_widget_text['widgetTextSpacingTablet'])."px !important;
      text-align:$widgetTextAlignmentTablet !important;
     }
  ";

  $thisTextWidgetResponsiveWidgetStylesMobile = "
    #widget-$j-$Columni-".$row["rowID"]."  $widgetTextTagNew * {
     font-size: ".esc_attr($this_widget_text['widgetTextSizeMobile'])."px !important;
     line-height: ".esc_attr($this_widget_text['widgetTextLineHeightMobile'])."em !important;
     letter-spacing: ".esc_attr($this_widget_text['widgetTextSpacingMobile'])."px !important;
     text-align:$widgetTextAlignmentMobile !important;
    }

    #widget-$j-$Columni-".$row["rowID"]."  $widgetTextTagNew {
      font-size: ".esc_attr($this_widget_text['widgetTextSizeMobile'])."px !important;
      line-height: ".esc_attr($this_widget_text['widgetTextLineHeightMobile'])."em !important;
      letter-spacing: ".esc_attr($this_widget_text['widgetTextSpacingMobile'])."px !important;
      text-align:$widgetTextAlignmentMobile !important;
     }
  ";


  array_push($POPBNallRowStylesResponsiveTablet, $thisTextWidgetResponsiveWidgetStylesTablet);
  array_push($POPBNallRowStylesResponsiveMobile, $thisTextWidgetResponsiveWidgetStylesMobile);
}


$widgetTextLineHeight = '';
if (isset($this_widget_text['widgetTextLineHeight'])) {
  $widgetTextLineHeight = esc_attr($this_widget_text['widgetTextLineHeight']);
}

$widgetTextSpacing = '';
if (isset($this_widget_text['widgetTextSpacing'])) {
  $widgetTextSpacing = esc_attr($this_widget_text['widgetTextSpacing']);
}

$widgetTextFamily = str_replace('+', ' ', $widgetTextFamily);

if(1 === preg_match('~[0-9]~', $widgetTextFamily)){
  $widgetTextFamily = "'".$widgetTextFamily."'";
}

if($widgetTextFamily == 'Select'){
  $widgetTextFamily = '';
}

if(!isset($this_widget_text['wtextLink'])){
  $this_widget_text['wtextLink'] = '#';
}

$textWidgetContentStyles = '
  text-align:'.$widgetTextAlignment.';
  color:'.$widgetTextColor.';
  font-size:'.$widgetTextSize.'px;
  font-weight:'.$widgetTextWeight.';
  text-transform:'.$widgetTextTransform.';
  font-family:'.$widgetTextFamily.',  sans-serif;
  font-weight:'.$widgetTextBold.';
  font-style:'.$widgetTextItalic.';
  text-decoration:'.$widgetTextUnderlined.';
  line-height:'.$widgetTextLineHeight.'em;
  letter-spacing:'.$widgetTextSpacing.'px;
';


$widgetHeadlineTextType = 'Default';
if(isset($this_widget_text['widgetHeadlineTextType'])){
  $widgetHeadlineTextType = $this_widget_text['widgetHeadlineTextType'];
}

if($widgetHeadlineTextType !== 'Default'){

  $animatedElColor = isset($this_widget_text['widgetTextColorAnimated']) ? 'color:'.$this_widget_text['widgetTextColorAnimated'].';' : '';

  $animatedElFontSize = isset($this_widget_text['widgetTextSizeAnimated']) ? 'font-size:'.$this_widget_text['widgetTextSizeAnimated'].'px;' : '';

  $animatedElFontWeight = isset($this_widget_text['widgetTextWeightAnimated']) ? 'font-weight:'.$this_widget_text['widgetTextWeightAnimated'].';' : '';

  $animatedElTextTransform = isset($this_widget_text['widgetTextTransformAnimated']) ? 'text-transform:'.$this_widget_text['widgetTextTransformAnimated'].';' : '';

  if(isset($this_widget_text['widgetTextFamilyAnimated'])){
    
    if(1 === preg_match('~[0-9]~', $this_widget_text['widgetTextFamilyAnimated'])){
      $this_widget_text['widgetTextFamilyAnimated'] = "'".$this_widget_text['widgetTextFamilyAnimated']."'";
    }

    array_push($thisColFontsToLoad, $this_widget_text['widgetTextFamilyAnimated']);

  }

  $animatedElFontFamily = isset($this_widget_text['widgetTextFamilyAnimated']) ? 'font-family:'.$this_widget_text['widgetTextFamilyAnimated'].';' : '';
  

  $animatedElTextSpacing = isset($this_widget_text['widgetTextSpacingAnimated']) ? 'letter-spacing:'.$this_widget_text['widgetTextSpacingAnimated'].'px;' : '';


  
  $textWidgetAnimatedElStyles = "
  $animatedElColor
  $animatedElFontSize
  $animatedElFontWeight
  $animatedElTextTransform
  $animatedElFontFamily
  $animatedElTextSpacing
  ";

}

if($widgetHeadlineTextType === "Animated"){

  $animatedWidgetUniqueID  = 'pluginops-animated-text-'.(rand(500,1000)*2)*rand(10,500);


  $animationBeforeText = (isset($this_widget_text['animationBeforeText'])) ? $this_widget_text['animationBeforeText'] : '';

  $animationAfterText = (isset($this_widget_text['animationAfterText'])) ? $this_widget_text['animationAfterText'] : '';

  $animationRotatingText = (isset($this_widget_text['animationRotatingText'])) ? $this_widget_text['animationRotatingText'] : '';

  $animationRotatingText = explode( "\n", $animationRotatingText);

  $rotatingTextEls = '';

  $animatedTimelineAddAnims = "";


  $animatedEffects = array(
    "animatedEffectZoom" => array(
      "animationIn" => "
        scale: [4,1],
        opacity: [0,1],
        translateZ: 0,
        easing: \"easeOutExpo\",
        duration: 1250,
        delay: (el, i) => 70*i,
      ",
      "animationOut" => "
        opacity: 0,
        scale: [1, 0.1],
        duration: 1250,
        easing:  \"easeInExpo\",
        delay: (el, i) => 70*i,
      "
    ),

    "animationEffectZoomBounce" => array(
      "animationIn" => "
        scale: [0.2, 1],
        opacity: [0, 1],
        duration: 800,
      ",
      "animationOut" => "
        opacity: 0,
        scale: 3,
        duration: 600,
        easing:  \"easeInExpo\",
        delay: 500,
      "
    ),
    "animationEffectBouncingLetters" => array(
      "animationIn" => "
        scale: [0, 1],
        duration: 1500,
        elasticity: 600,
        delay: (el, i) => 70 * (i+1),
      ", 
      "animationOut" => "
        scale: [1, 0],
        duration: 1500,
        elasticity: 600,
        delay: (el, i) => 70 * (i+1),
      "
    ),
    "animationEffectClip" => array(
      "animationIn" => "
        easing: \"easeOutExpo\",
        duration: 1500,
        offset: '-=775',
        delay: (el, i) => 34 * (i+1),
      ", 
      "animationOut" => "
        easing: \"easeOutExpo\",
        duration: 600,
        offset: '-=775',
        delay: (el, i) => 34 * (i+1),
      "
    ),
    

  );


  $widgetHeadlineTextAnimation = (isset($this_widget_text['widgetHeadlineTextAnimation'])) ? $this_widget_text['widgetHeadlineTextAnimation'] : 'Default';
  
  $splitWordIntoLettersScript = "";
  $letterAnimation =  false;
  if($widgetHeadlineTextAnimation == "animationEffectBouncingLetters" || $widgetHeadlineTextAnimation == "animatedEffectZoom" || $widgetHeadlineTextAnimation == "animationEffectClip"){
    $splitWordIntoLettersScript = "
      var textWrapper = document.querySelectorAll('.$animatedWidgetUniqueID .pluginops-animated-word');
      for( let i = 0; i < textWrapper.length; i++){
        textWrapper[i].innerHTML = textWrapper[i].textContent.replace(/\S/g, \"<span class='animated-letter'>$&</span>\");
      }
    ";
    $letterAnimation = true;
  }

  if(is_array($animationRotatingText)){
    $animTextCount = 0;
    foreach ($animationRotatingText as $animTextKey => $animTextValue) {
      $rotatingTextEls .= "<span class='pluginops-animated-word animated-word-$animTextCount'> $animTextValue </span> \n";


      $animationTargets = ".$animatedWidgetUniqueID .animated-word-$animTextCount";
      if($letterAnimation){
        $animationTargets = ".$animatedWidgetUniqueID .animated-word-$animTextCount .animated-letter";
      }

        $animatedTimelineAddAnims .= "
          .add({
            targets: '$animationTargets',
            ".$animatedEffects[$widgetHeadlineTextAnimation]['animationIn']."
            changeBegin: () => {
              document.querySelector('.$animatedWidgetUniqueID .animated-word-$animTextCount').style.display = 'inline-block';
            }
          }).add({
            targets: '$animationTargets',
            ".$animatedEffects[$widgetHeadlineTextAnimation]['animationOut']."
            changeComplete: () => {
              document.querySelector('.$animatedWidgetUniqueID .animated-word-$animTextCount').style.display = 'none';
            }
          })
        ";

      $animTextCount++;
    }
  }



  $animatedTextEls = "
  <span> $animationBeforeText </span>
  <span class=\"$animatedWidgetUniqueID\" style='$textWidgetAnimatedElStyles' >
    $rotatingTextEls
  </span>
  <span> $animationAfterText </span>

  <script src=\"https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js\"></script>

  <style>

  .$animatedWidgetUniqueID:after{
    content:\"\";
    width:5px;
    border:2px solid #333;

  }

  </style>
  ";


  

  $animatedTextScript = "

  <script>

    $splitWordIntoLettersScript
    
    let timeline = anime.timeline({loop: true});

    timeline".$animatedTimelineAddAnims."

  </script>
 
  ";



  $widgetTextContent = $animatedTextEls;

  array_push($POPBallWidgetsScriptsArray, $animatedTextScript);


}


if($widgetHeadlineTextType === "Highlighted"){

  $animatedWidgetUniqueID  = 'pluginops-animated-text-'.(rand(500,1000)*2)*rand(10,500);

  $selectedHighlight = (isset($this_widget_text['widgetHeadlineTextHighlight']) ) ? $this_widget_text['widgetHeadlineTextHighlight'] : '';

  $highlightedText = (isset($this_widget_text['widgetHeadlineTextHighlightText'])) ? $this_widget_text['widgetHeadlineTextHighlightText'] : 'Highlight Text';


  $animationBeforeText = (isset($this_widget_text['animationBeforeText'])) ? $this_widget_text['animationBeforeText'] : '';

  $animationAfterText = (isset($this_widget_text['animationAfterText'])) ? $this_widget_text['animationAfterText'] : '';

  $animatedWidgetSvgUniqueID = 'pluginops-animated-svg-'.(rand(500,1000)*2)*rand(10,500);


  $svgElement = "
  <svg id=\"$animatedWidgetSvgUniqueID\" class=\"pluginops-highlightedTextSvg\" viewBox=\"0 0 500 150\" preserveAspectRatio=\"none\" >
    <path d=\"M325,18C228.7-8.3,118.5,8.3,78,21C22.4,38.4,4.6,54.6,5.6,76.6c1.4,32.4,52.2,54,140.6,62.7 c66.2,7.1,214.2,7.5,273.5-8.3c64.4-16.6,105.3-57.6,34.8-98.2C386.7-4.9,180.4-1.4,126.3,20.7\"  fill=\"none\" stroke=\"#fff\" stroke-width=\"5\" />
  </svg>
  ";

  $animatedTextEls = "
  <span> $animationBeforeText </span>
  <span style='position: relative; display: inline-block;'>

    <span style='display: inline-block; position: relative; top: 0; left: 0; $textWidgetAnimatedElStyles ' class=\"$animatedWidgetUniqueID pluginops-highlightedText \"> $highlightedText </span>
    
    $svgElement

  </span>
  <span> $animationAfterText </span>

  <script src=\"https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js\"></script>6
  ";


  $animatedTextScript = "

  <script>

    anime.timeline({loop: true}).add({
      targets:'#".$animatedWidgetSvgUniqueID." path',
      strokeDashoffset: [anime.setDashoffset, 0],
      easing: 'easeInOutSine',
      duration: 2500,
      delay: function(el, i) { return i * 800 },
      direction: 'linear',
    });

  </script>
  ";



  $widgetTextContent = $animatedTextEls;

  array_push($POPBallWidgetsScriptsArray, $animatedTextScript);

}




$textWidgetContentComplete = '<'.$widgetTextTag.' style="'.$textWidgetContentStyles.'" > '.$widgetTextContent.' </'.$widgetTextTag.'> ';

if ($widgetTextTag == 'p') {
  $textWidgetContentComplete = '<div style="'.$textWidgetContentStyles.'" >'.'<'.$widgetTextTag.' style="'.$textWidgetContentStyles.'"> '.$widgetTextContent.' </'.$widgetTextTag.'> '.'</div>';
}

if ($widgetTextTag == 'a') {
  $linkHref = ' href ="'.esc_url($this_widget_text['wtextLink']).'" ';

  $textWidgetContentComplete = ' <'.$widgetTextTag.' '.$linkHref.' style="text-decoration:none; " >   <p  style="'.$textWidgetContentStyles.'">  '.$widgetTextContent.' </p> </'.$widgetTextTag.'> ';

}

$widgetContent = $textWidgetContentComplete;

array_push($thisColFontsToLoad, $widgetTextFamily);

?>