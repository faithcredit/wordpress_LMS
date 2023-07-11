<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="pluginops-tabs2" style="">
  <ul class="pluginops-tab2-links">
    <li class="active"><a href="#customNavTab1" class="pluginops-tab2_link">Menu links</a></li>
    <li><a href="#customNavTab2" class="pluginops-tab2_link">Design</a></li>
  </ul>
<div class="pluginops-tab2-content" style="box-shadow:none;">
	<div id="customNavTab1" class="pluginops-tab2 active" style="min-width: 380px;">
          <br>
          <br>
          <label style="margin-left:15px;"> Links Source </label>
          <select class="cnsource"  data-optname="navStyle.cnsource" > 
              <option value="">Custom Links</option>
              <option value="WPMenu">WordPress Menu</option>
          </select>

          <div class="wpMenuSelectionContainer" style="display:none;">

            <br><br><br><hr><br>
            <label style="margin-left:15px;"> Select Menu </label>
            <select  class="cnselmenu" data-optname="navStyle.cnselmenu" >
                <option value="Select">Choose</option>
                <?php $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
                if (!is_array($menus)) {
                    $menus = array();
                }
                foreach($menus as $menu){ echo "<option value='$menu->name'>$menu->name</option>"; } ?>
            </select>
          </div>

          <div class="customLinksMenuContainer" style="display:none;">
            
            <br><br><br><hr><br>
            <div class="btn btn-blue" id="addNewMenuItem" > <span class="dashicons dashicons-plus-alt"></span> Add Menu Link </div>
            <br>
            <br>
            <ul class="sortableAccordionWidget    customNavItemsContainer"></ul>
          </div>

          <br><br><br><br><hr><br>
	</div>
	<div id="customNavTab2" class="pluginops-tab2" style="background: #fff; padding:20px 10px 20px 25px; width: 99%;">
        <br>
        <br>
        <label> Eanble Hamburger Mode :</label>
        <select class="cnsresop" data-optname="navStyle.cnsresop" >
            <option value="true">Yes</option>
            <option value="false">No</option>
        </select>
        <br><br>
        <p><i>Note :</i> Responsive Hamburger navigation will only work on Tablet and Phone Screens.</p>
        <hr><br>
        <label> Layout :</label>
        <select class="cnslayout" data-optname="navStyle.cnslayout" >
            <option value="Horizontal">Horizontal</option>
            <option value="Vertical">Vertical</option>
        </select>
        <br><br><hr><br>
        <label> Alignment :</label>
        <select class="cnsalign" data-optname="navStyle.cnsalign">
            <option value="">Select</option>
            <option value="center">Center</option>
            <option value="left">Left</option>
            <option value="right">Right</option>
        </select>
        <br><br><hr><br>
        <label>Font Color :</label>
        <input type="text" class="color-picker_btn_two cnsfc" id="cnsfc" value='#333333' data-optname="navStyle.cnsfc" >
        <br>
        <br>
        <hr>
        <br>
        <label>Hover Color :</label>
        <input type="text" class="color-picker_btn_two cnsfhc" id="cnsfhc" value='#333333' data-optname="navStyle.cnsfhc" >
        <br>
        <br>
        <hr>
        <br>
        <label>Background Color :</label>
        <input type="text" class="color-picker_btn_two cnsbc" id="cnsbc" value='rgba(51, 51, 51, 0)' data-optname="navStyle.cnsbc" >
        <br>
        <br>
        <hr>
        <br>
        <label>Hover Background Color :</label>
        <input type="text" class="color-picker_btn_two cnshbc" id="cnshbc" value='#333333' data-optname="navStyle.cnshbc" >
        <br>
        <br>
        <hr>
        <br>
        <label>Nav Icon Color :</label>
        <input type="text" class="color-picker_btn_two cnsnic" id="cnsnic" value='#333333' data-optname="navStyle.cnsnic" >
        <br>
        <br>
        <hr>
        <br>
        <div>
            <h4>Text Size 
                <span class="responsiveBtn rbt-l " > <i class="fa fa-desktop"></i> </span>   
                <span class="responsiveBtn rbt-m " > <i class="fa fa-tablet"></i> </span>
                <span class="responsiveBtn rbt-s " > <i class="fa fa-mobile-phone"></i> </span>
            </h4>
            <div class="responsiveOps responsiveOptionsContainterLarge">
                <label></label>
                <input type="number" class="cnsfs" data-optname="navStyle.cnsfs" > px
            </div>
            <div class="responsiveOps responsiveOptionsContainterMedium" style="display: none;">
                <label></label>
                <input type="number" class="cnsfst" data-optname="navStyle.cnsfst" > px
            </div>
            <div class="responsiveOps responsiveOptionsContainterSmall" style="display: none;">
                <label></label>
                <input type="number" class="cnsfsm" data-optname="navStyle.cnsfsm" > px
            </div>
        </div>
        <br>
        <br>
        <hr>
        <br>
        <label>Links Gap :</label>
        <input type="number" class="cnslg" id="cnslg" data-optname="navStyle.cnslg" > px
        <br><br><br><br><hr><br>
        <label>Links Height :</label>
        <input type="number" class="cnslh" id="cnslh" data-optname="navStyle.cnslh" > px
        <br><br><br><br><hr><br>
        <label>Menu Font Family:</label>
        <input class="cnsff gFontSelectorulpb" id="cnsff" data-optname="navStyle.cnsff" >
        <br><br><br><br><hr><br>
        <label>Logo Image :</label>
        <input id="image_location1" type="text" class=" cnslourl upload_image_button2"  name='lpp_add_img_1' value=' ' placeholder='Insert Image URL here' / data-optname="navStyle.cnslourl" >
        <label></label>
        <input id="image_location1" type="button" class="upload_bg" data-id="2" value="Upload" />
        <br><br><br><br><hr><br>
        <label> Logo Size :</label>
        <select class="cnslos" data-optname="navStyle.cnslos" >
            <option value="Small">Small</option>
            <option value="Medium">Medium</option>
            <option value="Large">Large</option>
        </select>
        <br><br><br><hr><br><br>
        <label> Logo Gap :</label>
        <input type="number" class="cnsig" id="cnsig" data-optname="navStyle.cnsig" >
        <br><br><br><hr><br><br><br><br><br><br>
	</div>
</div>
</div>