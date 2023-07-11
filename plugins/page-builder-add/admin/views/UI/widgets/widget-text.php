<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="pluginops-tabs2" style="width: 100%;">
  <ul class="pluginops-tab2-links">
    <li class="active"><a href="#TextWidgetTab1" class="pluginops-tab2_link">Text</a></li>
    <li><a href="#TextWidgetTab2" class="pluginops-tab2_link">Style</a></li>
  </ul>
<form id="pbtextwidgetops">
<div class="pluginops-tab2-content" style="box-shadow:none;">
    <div id="TextWidgetTab1" class="pluginops-tab2 active">
        <div class="pbp_form" style="background: #fff; padding:20px 10px 20px 25px; width: 99%;">

        <div style="display:none !important;opacity:0;">

          <label>Headline Type</label>
          <select class="widgetHeadlineTextType" data-optname="widgetHeadlineTextType" >
            <option value="Default">Default</option>
            <option value="Animated">Animated</option>
            <option value="Highlighted">Highlighted</option>
          </select>
          <br><br><hr><br>

        </div>
        
        <div class="headlineTypeDefaultOps headlineWidgetOpsContainer" >
            <label>Text </label>
            <div style="width: 90%; min-height:110px;">
              <textarea style="width:100%; height: 110px;"  name="widgetTextContent" id="widgetTextContent" class="widgetTextContent" data-optname="widgetTextContent"  ></textarea>
            </div>
            <br><br><hr><br>
            
        </div>

        <div class="headlineTypeAnimatedOps headlineWidgetOpsContainer" style="display:none;" >
            <label> Animation </label>
            <select class="widgetHeadlineTextAnimation" data-optname="widgetHeadlineTextAnimation" >
              <option value="animatedEffectZoom">Default</option>
              <option value="animationEffectBouncingLetters">Bouncing Letters</option>
              <option value="animatedEffectZoom">Zoom</option>
              <option value="animationEffectZoomBounce">Zoom Bounce</option>
              <option value="animationEffectClip">Clip</option>

            </select>
            <br><br><hr><br>
        </div>

        <div class="headlineTypeHighlightedOps headlineWidgetOpsContainer" style="display:none;" >
            <label> Highlight </label>
            <select class="widgetHeadlineTextHighlight" data-optname="widgetHeadlineTextHighlight" >
              <option value="Default">Default</option>
              <option value="bouncingLetters">Bouncing Letters</option>
              <option value="Animation2">Animation2</option>
            </select>
            <br><br><hr><br>
        </div>


        <div class="headlineTypeSimilarOps headlineWidgetOpsContainer">
            <label> Before Text </label>
            <input type="text"  class="animationBeforeText" data-optname="animationBeforeText" style="width:80%; float:unset;">
            <br><hr><br>

            <div class="headlineRotatingTextContainer headlineWidgetOpsContainer" >
              <label>Rotating Text </label>
              <div style="width: 90%; min-height:110px;">
                <textarea style="width:100%; height: 110px;" id="animationRotatingText" class="animationRotatingText" data-optname="animationRotatingText" placeholder="Enter Each Word In New Line" cols="10" ></textarea>
              </div>
              <br><hr><br>
            </div>

            <div class="headlineHighlightTextContainer headlineWidgetOpsContainer" >
              <label>Highlight Text </label>
              <input type="text"  class="widgetHeadlineTextHighlightText" data-optname="widgetHeadlineTextHighlightText" style="width:80%; float:unset;">
              <br><hr><br>
            </div>

            <label> After Text </label>
            <input type="text"  class="animationAfterText" data-optname="animationAfterText" style="width:80%; float:unset;">
            <br><hr><br>

            <label>Loop</label>
            <select class="animationLoop" data-optname="animationLoop">
              <option value="true">Yes</option>
              <option value="false">No</option>
            </select>
            <br><br><hr><br>


            <label>Duration</label>
            <input type="number" class="animationDuration" data-optname="animationDuration" step="5" min="0" />
            <br><br><hr><br>


        </div>

        <div>
            <label>HTML Tag</label>
            <select class="widgetTextTag" data-optname="widgetTextTag" >
                <option value="p">p</option>
                <option value="h1">H1</option>
                <option value="h2">H2</option>
                <option value="h3">H3</option>
                <option value="h4">H4</option>
                <option value="h5">H5</option>
                <option value="h6">H6</option>
                <option value="a">Link</option>
                <option value="div">div</option>
                <option value="span">span</option>
            </select>
            <br><br><hr><br>
            <div>
                <h4>Text Alignment
                  <span class="responsiveBtn rbt-l " > <i class="fa fa-desktop"></i> </span>   
                  <span class="responsiveBtn rbt-m " > <i class="fa fa-tablet"></i> </span>
                  <span class="responsiveBtn rbt-s " > <i class="fa fa-mobile-phone"></i> </span>
                </h4>
                <div class="responsiveOps responsiveOptionsContainterLarge">
                  <label></label>
                  <select class="widgetTextAlignment" data-optname="widgetTextAlignment" >
                    <option value="left">Left</option>
                    <option value="center">Center</option>
                    <option value="right">Right</option>
                    <option value="justified">Justified</option>
                  </select>
                </div>
                <div class="responsiveOps responsiveOptionsContainterMedium" style="display: none;">
                    <label></label>
                    <select class="widgetTextAlignmentTablet" data-optname="widgetTextAlignmentTablet" >
                        <option value="left">Left</option>
                        <option value="center">Center</option>
                        <option value="right">Right</option>
                        <option value="justified">Justified</option>
                    </select>
                </div>
                <div class="responsiveOps responsiveOptionsContainterSmall" style="display: none;">
                    <label></label>
                    <select class="widgetTextAlignmentMobile" data-optname="widgetTextAlignmentMobile" >
                        <option value="left">Left</option>
                        <option value="center">Center</option>
                        <option value="right">Right</option>
                        <option value="justified">Justified</option>
                    </select>
                </div>
            </div>
            <br><br><hr><br>
            <div class="linkOpsDiv" style="display: none;">
                <label>Link URL : </label>
                <input type="url" class="wtextLink" data-optname="wtextLink" style="width:95%;">
            </div>
            <br><br><hr><br>

        </div>
            
       </div>
    </div>
    <div id="TextWidgetTab2" class="pluginops-tab2">
      <div class="pbp_form" style="background: #fff; padding:20px 5px 20px 5px; width: 99%;">

        <div class="PB_accordion" style="width:390px;">
          <h4> Heading </h4>
          <div style="padding:1em 0 1em 1em;">
            <label>Text Color :</label>
            <input type="text" class="color-picker_btn_two widgetTextColor" id="widgetTextColor" value='#333333' data-optname="widgetTextColor">
            <br><br><br><hr>
            <div>
                <h4>Text Size 
                  <span class="responsiveBtn rbt-l " > <i class="fa fa-desktop"></i> </span>   
                  <span class="responsiveBtn rbt-m " > <i class="fa fa-tablet"></i> </span>
                  <span class="responsiveBtn rbt-s " > <i class="fa fa-mobile-phone"></i> </span>
                </h4>
                <div class="responsiveOps responsiveOptionsContainterLarge">
                    <label></label>
                  <input type="number" class="widgetTextSize" data-optname="widgetTextSize"> px
                </div>
                <div class="responsiveOps responsiveOptionsContainterMedium" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextSizeTablet" data-optname="widgetTextSizeTablet"> px
                </div>
                <div class="responsiveOps responsiveOptionsContainterSmall" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextSizeMobile" data-optname="widgetTextSizeMobile"> px
                </div>
            </div>
            <br><br><hr>
            <div>
                <h4>Text Line Height
                  <span class="responsiveBtn rbt-l " > <i class="fa fa-desktop"></i> </span>   
                  <span class="responsiveBtn rbt-m " > <i class="fa fa-tablet"></i> </span>
                  <span class="responsiveBtn rbt-s " > <i class="fa fa-mobile-phone"></i> </span>
                </h4>
                <div class="responsiveOps responsiveOptionsContainterLarge">
                  <label></label>
                  <input type="number" class="widgetTextLineHeight" data-optname="widgetTextLineHeight"> em
                </div>
                <div class="responsiveOps responsiveOptionsContainterMedium" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextLineHeightTablet" data-optname="widgetTextLineHeightTablet"> em
                </div>
                <div class="responsiveOps responsiveOptionsContainterSmall" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextLineHeightMobile" data-optname="widgetTextLineHeightMobile"> em
                </div>
            </div>
            <br><br><hr>
            <div>
                <h4>Text Spacing
                  <span class="responsiveBtn rbt-l " > <i class="fa fa-desktop"></i> </span>   
                  <span class="responsiveBtn rbt-m " > <i class="fa fa-tablet"></i> </span>
                  <span class="responsiveBtn rbt-s " > <i class="fa fa-mobile-phone"></i> </span>
                </h4>
                <div class="responsiveOps responsiveOptionsContainterLarge">
                  <label></label>
                  <input type="number" class="widgetTextSpacing" data-optname="widgetTextSpacing" > px
                </div>
                <div class="responsiveOps responsiveOptionsContainterMedium" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextSpacingTablet" data-optname="widgetTextSpacingTablet" > px
                </div>
                <div class="responsiveOps responsiveOptionsContainterSmall" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextSpacingMobile" data-optname="widgetTextSpacingMobile" > px
                </div>
            </div>
            <br><br><hr><br>
            <label>Font Weight</label>
            <select class="widgetTextWeight" data-optname="widgetTextWeight" >
                <option value="">Default</option>
                <option value="normal">Normal</option>
                <option value="bold">Bold</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                <option value="500">500</option>
                <option value="600">600</option>
                <option value="700">700</option>
                <option value="800">800</option>
                <option value="900">900</option>
            </select>
            <br><br><br><hr><br>
            <label>Text Transform</label>
            <select class="widgetTextTransform" data-optname="widgetTextTransform" >
                <option value="none">Default</option>
                <option value="uppercase">Uppercase</option>
                <option value="lowercase">Lowercase</option>
                <option value="capitalize">Capitalize</option>
            </select>
            <br><br><br><hr><br>
            <label>Font family :</label>
            <input class="widgetTextFamily gFontSelectorulpb" id="widgetTextFamily" data-optname="widgetTextFamily">
            <br><br><br><hr><br><br><br>
            <label for="widgetTextBold" class="checkboxBtnLabel"> Bold </label>
            <input type="checkbox" id="widgetTextBold" class="widgetTextBold popb_checkbox" data-optname="widgetTextBold">
            <label for="widgetTextItalic" class="checkboxBtnLabel"> Italic </label>
            <input type="checkbox" id="widgetTextItalic" class="widgetTextItalic popb_checkbox" data-optname="widgetTextItalic">
            <label for="widgetTextUnderlined" class="checkboxBtnLabel"> Underlined </label>
            <input type="checkbox" id="widgetTextUnderlined" class="widgetTextUnderlined popb_checkbox" data-optname="widgetTextUnderlined">
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          </div>

          <div style="padding:1em 0 1em 1em; display:none;">
            <label>Text Color :</label>
            <input type="text" class="color-picker_btn_two widgetTextColorAnimated" id="widgetTextColorAnimated" value='#333333' data-optname="widgetTextColorAnimated">
            <br><br><br><hr>
            <div>
                <h4>Text Size 
                  <span class="responsiveBtn rbt-l " > <i class="fa fa-desktop"></i> </span>   
                  <span class="responsiveBtn rbt-m " > <i class="fa fa-tablet"></i> </span>
                  <span class="responsiveBtn rbt-s " > <i class="fa fa-mobile-phone"></i> </span>
                </h4>
                <div class="responsiveOps responsiveOptionsContainterLarge">
                    <label></label>
                  <input type="number" class="widgetTextSizeAnimated" data-optname="widgetTextSizeAnimated"> px
                </div>
                <div class="responsiveOps responsiveOptionsContainterMedium" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextSizeAnimatedTablet" data-optname="widgetTextSizeAnimatedTablet"> px
                </div>
                <div class="responsiveOps responsiveOptionsContainterSmall" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextSizeAnimatedMobile" data-optname="widgetTextSizeAnimatedMobile"> px
                </div>
            </div>
            <br><br><hr>
            <div>
                <h4>Text Line Height
                  <span class="responsiveBtn rbt-l " > <i class="fa fa-desktop"></i> </span>   
                  <span class="responsiveBtn rbt-m " > <i class="fa fa-tablet"></i> </span>
                  <span class="responsiveBtn rbt-s " > <i class="fa fa-mobile-phone"></i> </span>
                </h4>
                <div class="responsiveOps responsiveOptionsContainterLarge">
                  <label></label>
                  <input type="number" class="widgetTextLineHeightAnimated" data-optname="widgetTextLineHeightAnimated"> em
                </div>
                <div class="responsiveOps responsiveOptionsContainterMedium" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextLineHeightAnimatedTablet" data-optname="widgetTextLineHeightAnimatedTablet"> em
                </div>
                <div class="responsiveOps responsiveOptionsContainterSmall" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextLineHeightAnimatedMobile" data-optname="widgetTextLineHeightAnimatedMobile"> em
                </div>
            </div>
            <br><br><hr>
            <div>
                <h4>Text Spacing
                  <span class="responsiveBtn rbt-l " > <i class="fa fa-desktop"></i> </span>   
                  <span class="responsiveBtn rbt-m " > <i class="fa fa-tablet"></i> </span>
                  <span class="responsiveBtn rbt-s " > <i class="fa fa-mobile-phone"></i> </span>
                </h4>
                <div class="responsiveOps responsiveOptionsContainterLarge">
                  <label></label>
                  <input type="number" class="widgetTextSpacingAnimated" data-optname="widgetTextSpacingAnimated" > px
                </div>
                <div class="responsiveOps responsiveOptionsContainterMedium" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextSpacingAnimatedTablet" data-optname="widgetTextSpacingAnimatedTablet" > px
                </div>
                <div class="responsiveOps responsiveOptionsContainterSmall" style="display: none;">
                    <label></label>
                  <input type="number" class="widgetTextSpacingAnimatedMobile" data-optname="widgetTextSpacingAnimatedMobile" > px
                </div>
            </div>
            <br><br><hr><br>
            <label>Font Weight</label>
            <select class="widgetTextWeightAnimated" data-optname="widgetTextWeightAnimated" >
                <option value="">Default</option>
                <option value="normal">Normal</option>
                <option value="bold">Bold</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                <option value="500">500</option>
                <option value="600">600</option>
                <option value="700">700</option>
                <option value="800">800</option>
                <option value="900">900</option>
            </select>
            <br><br><br><hr><br>
            <label>Text Transform</label>
            <select class="widgetTextTransformAnimated" data-optname="widgetTextTransformAnimated" >
                <option value="none">Default</option>
                <option value="uppercase">Uppercase</option>
                <option value="lowercase">Lowercase</option>
                <option value="capitalize">Capitalize</option>
            </select>
            <br><br><br><hr><br>
            <label>Font family :</label>
            <input class="widgetTextFamilyAnimated gFontSelectorulpb" id="widgetTextFamilyAnimated" data-optname="widgetTextFamilyAnimated">
            <br><br><br><hr><br><br><br>
          </div>
        </div>
            
        </div>
    </div>
</div>
</form>
</div>
