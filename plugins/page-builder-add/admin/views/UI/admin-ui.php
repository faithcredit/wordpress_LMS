<?php if ( ! defined( 'ABSPATH' ) ) exit; 


if (isset( $_GET['thisPostID'] )) {
  $postId = sanitize_text_field( esc_attr( $_GET['thisPostID']) );
  $post = get_post($postId);
}elseif(isset( $_GET['post'] )) {
  $postId = sanitize_text_field( esc_attr($_GET['post']) );
}else{
  if (isset($post)) {
    $postId = $post->ID;
  }else{
    $postId = false;
  }
}


if (isset( $_GET['thisPostType'] )) {
  $thisPostType = sanitize_text_field( esc_attr($_GET['thisPostType']) );
}else{
  $thisPostType = get_post_type($postId);
}

if (isset($post)) {
  $post_slug = $post->post_name;
}else{
  $post_slug = '';
}


if ($post_slug == '') {
  $hidePermalink = '';
}else{
  $hidePermalink = '';
}

$is_front_page = get_post_meta($postId, 'ULPB_FrontPage', true );
$loadWpHead = get_post_meta($postId, 'ULPB_loadWpHead', true );
$loadWpFooter = get_post_meta($postId, 'ULPB_loadWpFooterTwo', true );
$loadThemeWrapper = get_post_meta($postId, 'ULPB_loadThemeWrapper', true );

if ($loadWpHead == '') {
  $loadWpHead = 'true';
}

if ($loadWpFooter == '') {
  $loadWpFooter = 'true';
}

if ($loadThemeWrapper == '') {
  $loadThemeWrapper = 'false';
}

$plugData = get_plugin_data(ULPB_PLUGIN_PATH.'/page-builder-add.php',false,true);

$pb_current_user = wp_get_current_user();


$landingPageSafeModeFeature = get_option( 'landingPageSafeModeFeature', false );

$plugOps_pageBuilder_data_nonce = wp_create_nonce( 'POPB_data_nonce' );


$mcActive = 'false';
if ( is_plugin_active('page-builder-add-mailchimp-extension/page-builder-add-mailchimp-extension.php') || is_plugin_active('PluginOps-Extensions-Pack/extension-pack.php') ) {
  $mcActive = 'true';
}


$tempslib_slug = 'post-list-wp';
$tempslib_install_link =  esc_url( network_admin_url('plugin-install.php?tab=plugin-information&plugin=' . $tempslib_slug . '&TB_iframe=true&width=950&height=800' ) );



if (isset( $_GET['thisPostID'] ) ) {
  $thisLPTitle = get_the_title( $postId );
  ?>
  <br><br><br>
  <div id="titlediv">
    <div id="titlewrap">
      <label class="screen-reader-text" id="title-prompt-text" for="title"> </label>
      <input type="text" name="post_title" size="30" value="<?php echo($thisLPTitle); ?>" id="title" spellcheck="true" autocomplete="off" placeholder="Enter Page Title">
    </div>
    <div class="inside">
      <div id="edit-slug-box" class="hide-if-no-js" style="<?php echo "$hidePermalink"; ?>">
      <strong>Permalink:</strong>
      <span id="sample-permalink">
        <a href="<?php echo(site_url( ) ); ?>/?post_type=ulpb_post&amp;p=<?php echo($postId); ?>&amp;preview=true" target="wp-preview-4882"><?php echo(site_url( ) ); ?>/<span id="editable-post-name"><?php echo $post_slug; ?></span>/</a>
      </span>
      ‎<span id="edit-slug-buttons">
        <input type="text" class="editable-post-name-field" style="display: none; width: auto; height:24px; font-size: 13px; ">
        <button type="button" class="edit-slug button button-small hide-if-no-js" aria-label="Edit permalink">Edit</button>
        <button type="button" class="savePermalink  button button-small" style="display: none;">OK</button>
      </span>
      </div>
    </div>
    <span id="editable-post-name-full"><?php echo $post_slug; ?></span>
  </div>
  </div>
  
  <?php
}


$checkPBactive = get_post_meta( $postId, 'ulpb_page_builder_active', 'true');
if ($checkPBactive == 'true') {
  echo '<div class="tab-editor-deactivate switch_button">Deactivate PluginOps Page Builder For This Page </div>';
}

$thisLandingPageShareURL = urlencode("Wow! I just created this #amazing #landingpage with #PluginOps Landing Page Builder. \n". get_preview_post_link($postId) );
?>

 <script>
  var popb_errorLog = {};
  var landingPageSafeModeFeature = '<?php echo $landingPageSafeModeFeature; ?>';
  var nonInvasveKnownErrors = [
      "Uncaught TypeError: Cannot read property 'hasClass' of undefined",
      "Uncaught TypeError: Cannot read property 'top' of undefined",
      "TypeError: thisColumnData.colWidgets[this_widget].widgetText is undefined",
      "Uncaught TypeError: Cannot read property 'indexOf' of undefined",
      "Uncaught TypeError: Cannot read property 'replace' of undefined",
      "ResizeObserver loop limit exceeded",
      "Uncaught TypeError: Cannot read property 'innerHTML' of undefined",
  ];

</script>
  <!-- ========= -->
  <!-- Your HTML -->
  <!-- ========= -->

  <?php include('tabs.php'); ?>
  <?php include('edit-column.php'); ?>
  <?php include('edit-row.php'); ?>
  <?php include('edit-widget.php'); ?>
  <?php include('new-row.php'); ?>
  <?php include('side-panel.php'); ?>
  <?php include('row-blocks.php'); ?>


<style type="text/css" id="PBPO_customCSS"></style>
  


<div class="lpp_modal pb_loader_container">
  <div class="pb_loader"></div>
</div>

<div class="lpp_modal pb_preview_container" style="">
  <div class="pb_temp_prev" style="text-align: center; overflow: visible; position: absolute;" ></div>
</div>

<div class="lpp_modal popb_confirm_action_popup">
  <div class="popb_confirm_container">
    <h2 class="popb_confirm_message popb_confirm_message_row">Are you sure you want to do this ? </h2>
    <h4 class="popb_confirm_subMessage  popb_confirm_subMessage_row">You will lose any unsaved changes.</h4>
    <div id="confirm_yes" class="confirm_btn confirm_btn_green confirm_yes">Yes</div>
    <div class="confirm_btn confirm_btn_grey confirm_no">Cancel</div>
  </div>
</div>

<div class="lpp_modal popb_confirm_template_action_popup">
  <div class="popb_confirm_container">
    <div class="popb_popup_close confirm_template_no" id="popb_popup_close" style="" ></div>
    <h2 class="popb_confirm_message" style="line-height: 1.3em;">Do you want replace current landing page or insert below the current one ? </h2>
    <h4 class="popb_confirm_subMessage">Replacing the template will delete current landing page content & design</h4>
    <div id="confirm_template_yes" class="confirm_btn confirm_btn_green confirm_template_yes" data-tempisreplace='false'>Insert</div>
    <div class="confirm_btn confirm_btn_grey confirm_template_yes confirm_template_yes_replace" data-tempisreplace='true'>Replace</div>
  </div>
</div>

<div class="lpp_modal popb_safemode_popup">
  <div class="popb_confirm_container">
    <div class="popb_popup_close" id="popb_popup_close" style="" ></div>
    <h2 class="popb_confirm_message" style="line-height: 1.3em;">There was some error loading the editor </h2>
    <h4 class="popb_confirm_subMessage">Enable safe mode and send error data to PluginOps and reload the editor page to see if that fixes the error, If error persists please contact support.</h4>
    <div id="confirm_safemode_yes" class="confirm_btn confirm_btn_green confirm_safemode_yes" data-doActionValue='true'>Enable Safe Mode</div>
    <div class="confirm_btn confirm_btn_grey confirm_safemode_no" data-doActionValue='false'>No, Just Reload</div>
    <div class="fullErrorMessage"><p>Click To View Full Error Message</p></div>
    <input type="hidden" class="fullErrorMessageInput">
  </div>
</div>


<div class="lpp_modal popb_onSaveError_popup">
  <div class="popb_confirm_container">
    <div class="popb_popup_close" id="popb_popup_close" style="" ></div>
    <h2 class="popb_confirm_message" style="line-height: 1.3em;">There was some error saving the data </h2>
    <h4 class="popb_confirm_subMessage">There was unknown erorr while saving page data, Click on Store Data button to securely reload this page and store your changes.</h4>
    <div id="confirm_safemode_yes" class="confirm_btn confirm_btn_green confirm_saveData_yes" data-doActionValue='true'>Store Data & Reload</div>
    <div class="confirm_btn confirm_btn_grey confirm_saveData_no" data-doActionValue='false'>No, Just Reload</div>
    <div class="fullErrorMessage"><p>Click To View Full Error Message</p></div>
    <input type="hidden" class="fullErrorMessageInput">
  </div>
</div>


<div class="lpp_modal popb_install_template_library">
  <div class="popb_confirm_container">
    <div class="popb_popup_close installTemplateLibraryPopUpHide" id="popb_popup_close" style="" ></div>
    <h2 class="popb_confirm_message">There was some error while loading template</h2><br>
    <h4 class="popb_confirm_subMessage">Please try reloading the page if error persists contact support</h4>
    
    <p style="font-size:12; color:#777;">support@pluginops.com </p>
  </div>
</div>


<div class="lpp_modal">
  <div class="popb_confirm_container">
    <div class="popb_popup_close postSharePopUpHide" id="popb_popup_close" style="" ></div>
    <h2 class="popb_confirm_message">Awesome! You Have Published Your Landing Page </h2>
    <h4 class="popb_confirm_subMessage">Share it with your friends on social media.</h4>
    <a class="twitter-share-button confirm_btn" style="background: #358fde;"  href="https://twitter.com/intent/tweet?text=<?php echo $thisLandingPageShareURL; ?>"data-size="large" target="_blank">
      Tweet 
      <i class="fa fa-twitter"></i>
    </a>
  </div>
</div>

<div class="lpp_modal pb_preview_fields_container" style="">
  <div class="pb_fields_prev" style="
    overflow: visible;
    background: #fff;
    width: 48%;
    height: 80vh;
    margin: 3% 24% 0 24%;
    position: absolute;
    padding: 10px 40px;
    border-radius: 5px;
    text-align: center;
  " >
    <span class="dashicons dashicons-no formEntriesPreviewClose" style="
      float: right;
      font-size: 21px;
      margin: 5px 10px;
      cursor: pointer;
      background: #dadada;
      padding: 7px 7px;
      text-align: center;
      border-radius: 40px;
    "></span>
    <br><h2 style="text-align: center; color: #333; font-size:24px;">Form Entries</h2>
    <table class='w3-table w3-striped w3-bordered w3-card-4 formFieldsPreviewTable' style="margin-top: 50px;">
    </table>
  </div>
</div>


<input type="hidden" class="runTemplateUpdateFunction">


<input type="hidden" class="draggedWidgetAttributes" value='' >
<input type="hidden" class="draggedWidgetIndex" value='' >
<input type="hidden" class="widgetDroppedAtIndex" value='' >


<input type="hidden" class="mailchimpListIdHolder" value='' >
<input type="hidden" class="mailchimpApiKeyHolder" value='' >


<input type="hidden" class="globalRowRetrievedPostID" value='' >
<input type="hidden" class="globalRowRetrievedAttributes" value='' >

<input type="hidden" class="insertRowBlockAtIndex" value='' >


<input type="hidden" class="allTextEditableWidgetIds">

<input type="hidden" class="checkIfWidgetsAreLoadedInColumn">

<input type="hidden" class="isChagesMade" value="false">


<input type="hidden" class="currentViewPortSize" value="rbt-l">

<input type="hidden" class="currentResizedRowTarget">
<input type="hidden" class="currentResizedRowColTarget">
<input type="hidden" class="currentResizedRowColTargetNext">
<input type="hidden" class="currentResizedRowHeight">

<input type="hidden" class="isAnimateTrue">
<input type="hidden" class="animateWidgetId">


<input type="hidden" class="widgetDroppedRowId">
<input type="hidden" class="widgetDroppedColIndex">
<input type="hidden" class="widgetDroppedIndex">

<input type="hidden" class="widgetDraggedRowId">
<input type="hidden" class="widgetDraggedIndex">
<input type="hidden" class="widgetDraggedColIndex">

<input type="hidden" class="widgetDeletionCompleted" value="false">

<input type="hidden" class="isDroppedOnDroppable">

<input type="hidden" class="deleteRowIndex">
<input type="hidden" class="widgDeleteColIndex">
<input type="hidden" class="widgDeleteIndex">

<input type="hidden" class="currentlyEditedColId">
<input type="hidden" class="currentlyEditedWidgId">
<input type="hidden" class="currentlyEditedThisCol">
<input type="hidden" class="currentlyEditedThisRow">

<input type="hidden" class="ifEmptyFeaturedImageUrl">

<input type="text" id="copyRowAttrsAllInput" style="display: none !important;" >


<div id="pageStatusHolder" style="display: none;">
</div>

<div style="display: none;" class="rowWithNoColumnContainer">
  <div class="rowWithNoColumn" >
    <h5> SELECT COLUMN STRUCTURE </h5>
    <div class=" setColbtn" data-colNumber="1">
      <img src="<?php echo ULPB_PLUGIN_URL.'/images/icons/1.png' ?>" loading="lazy">
    </div>
    <div class=" setColbtn" data-colNumber="2">
      <img src="<?php echo ULPB_PLUGIN_URL.'/images/icons/2.png' ?>" loading="lazy">
    </div>
    <div class=" setColbtn" data-colNumber="3">
      <img src="<?php echo ULPB_PLUGIN_URL.'/images/icons/3.png' ?>" loading="lazy">
    </div>
    <div class=" setColbtn" data-colNumber="4">
      <img src="<?php echo ULPB_PLUGIN_URL.'/images/icons/4.png' ?>" loading="lazy">
    </div>
    <div class=" setColbtn" data-colNumber="5">
      <img src="<?php echo ULPB_PLUGIN_URL.'/images/icons/5.png' ?>" loading="lazy">
    </div>
    <div class=" setColbtn" data-colNumber="6">
      <img src="<?php echo ULPB_PLUGIN_URL.'/images/icons/6.png' ?>" loading="lazy">
    </div>
    <div class=" setColbtn" data-colNumber="7">
      <img src="<?php echo ULPB_PLUGIN_URL.'/images/icons/7.png' ?>" loading="lazy">
    </div>
    <div class=" setColbtn" data-colNumber="8">
      <img src="<?php echo ULPB_PLUGIN_URL.'/images/icons/8.png' ?>" loading="lazy">
    </div>


  </div>
</div>




<div id="fontLoaderContainer"></div>
<style type="text/css">
  #PbaceEditorJS, #PbaceEditorCSS,#PbColaceEditorCSS, #PbPOaceEditorCSS, #PbPOaceEditorJS { 
        padding: 20px; margin: 20px;
        width: 80%; min-height: 450px;
    }
    #pbWrapper{
      display: none;
    }
</style>

<style type="text/css" id="POPBGlobalStylesTag"></style>

<style type="text/css" id="POPBDeafaultResponsiveStylesTag"></style>

<style type="text/css" id="POPBDeafaultResponsiveStylesTagFontFamily"></style>

<div id="allresponsiveScriptStylesTag" style="display: none !important;"></div>

<div class="savePageModelSilent" style="display: none !important;"></div>



<style>
      #popb_popup_close:before {
        transform: rotate(45deg);
      }
      #popb_popup_close:after {
        transform: rotate(-45deg);
      }
      #popb_popup_close:after, #popb_popup_close:before {
        background-color: #414141;
        content: '';
        position: absolute;
        left: 14px;
        height: 14px;
        top: 8px;
        width: 2px;
      }

      #popb_popup_close {
        width: 30px;
        height: 30px;
        background-color: #fff;
        border-radius: 100%;
        box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.2);
        cursor: pointer;
        position: absolute;
        right: -15px;
        top: -15px;
        z-index: 2;
        float: right;
        clear: left;
      }

      .popb_popup_close:hover{
        background-color: #7a7a7a !important;
        transition: all .5s;
      }
      .popb_popup_close:hover::after, .popb_popup_close:hover::before {
        background-color: #fff !important;
        transition: all .5s;
      }
</style>

<?php

$checkPBactive = get_post_meta( $postId, 'ulpb_page_builder_active', 'true');
if ($checkPBactive == 'true') {
  ?>
  <style type="text/css">
      #submitdiv,.wp-editor-expand,.fl-builder-admin{
        display: none !important;
      }
      .setasfrontpageopscontainer{
        display: none;
      }
  </style>

  <style type="text/css">
    .switch_button{
      margin-top:20px;
      text-decoration: none;
      background-color: #333;
        border-radius: 3px;
        border: none;
        padding: 10px 20px 10px 20px;
        color: #FFF;
        font-size: 16px;
        float: left;
        cursor: pointer;
    }
  </style>
  <?php 
}else{

  echo(
    "<style>
      .loadThemeWrapperContainer { display: none; } 
    </style>"
  );

}


?>