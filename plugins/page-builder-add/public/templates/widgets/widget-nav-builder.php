<?php

$this_widget = $thisWidget['widgetNavBuilder'];

$allNavItems = $this_widget['navItems'];
$allNavStyles = $this_widget['navStyle'];

$pbAllNavItemsHtml = '';

foreach ($allNavItems as $key => $val)
{
    $thisMenuLink = '<a href="' . $val['cniurl'] . '" >' . $val['cnilab'] . '</a>';

    $pbListPrevItem = $pbAllNavItemsHtml;
    $pbListThisItem = " <li> " . $thisMenuLink . " </li> ";
    $pbAllNavItemsHtml = $pbListPrevItem . $pbListThisItem;
}

$pbCustomId = 'pb_navMenu_' . (rand(500, 1000) * 2) * rand(10, 500);

if (!isset($allNavStyles['cnsresop']))
{
    $allNavStyles['cnsresop'] = 'false';
    if ($allNavStyles['cnslayout'] == "Horizontal")
    {
        $allNavStyles['cnsresop'] = 'true';
    }
}
if ($allNavStyles['cnsresop'] == '')
{
    $allNavStyles['cnsresop'] = 'false';
    if ($allNavStyles['cnslayout'] == "Horizontal")
    {
        $allNavStyles['cnsresop'] = 'true';
    }
}

$containerLayout = 'display:none;';
$menuLinkGap = " margin: " . $allNavStyles['cnslg'] . "px 0 ; ";
$hideMenuIfNotHorizontal = "";
$responsiveMenuSwitch = '';

$responsiveMenuSwitch = '<div class="responsiveNavBtn responsiveNavBtninActive" style=" cursor:pointer;"> <i class=" fas fa-bars "> </i> </div>  <div class="responsiveNavBtn responsiveNavBtnActive" style=" cursor:pointer;"> <i class=" fas fa-bars "> </i> </div>';

if ($allNavStyles['cnslayout'] == "Horizontal")
{
    $containerLayout = "display:inline-block;";
    $menuLinkGap = " margin: 3px " . $allNavStyles['cnslg'] . "px; ";
    $listItemHeightwrapped = ' ';
    $hideMenuIfNotHorizontal = 'display:none;';
}

if (!isset($allNavStyles['cnsalign']))
{
    $allNavStyles['cnsalign'] = 'center';
}

$cnsalign = 'align-items: center; display: flex; justify-content: center; ';
if ($allNavStyles['cnsalign'] == 'center')
{
    $cnsalign = 'align-items: center; display: flex; justify-content: center; ';
}
if ($allNavStyles['cnsalign'] == 'left')
{
    $cnsalign = 'align-items: center; display: flex; justify-content: left; ';
}

if ($allNavStyles['cnsalign'] == 'right')
{
    $cnsalign = $cnsalign . 'float:right;';
}

if ($allNavStyles['cnsresop'] == 'false')
{
    $responsiveMenuSwitch = '';
    if ($allNavStyles['cnslayout'] == "Horizontal")
    {
        $containerLayout = "display:inline-block;";
        $hideMenuIfNotHorizontal = 'display:inline-block;';
    }
    else
    {
        $containerLayout = "display:block;";
        $hideMenuIfNotHorizontal = 'display:block;';
    }
}

$thisCustomNav = "<div  class='menuItemListContainer'> <ul id='ul_" . $pbCustomId . "' style='list-style:none;'> " . $pbAllNavItemsHtml . " </ul> </div>";

include_once(ULPB_PLUGIN_PATH.'/public/templates/widgets/navBuilderMenuWalker.php');

if( !isset( $allNavStyles['cnsource'])){
    $allNavStyles['cnsource'] = '';
}

if($allNavStyles['cnsource'] == 'WPMenu'){

    if(!isset( $allNavStyles['cnselmenu'] )){
        $allNavStyles['cnselmenu'] = '';
    }

    ob_start();
    wp_nav_menu( array( 
        'menu' => $allNavStyles['cnselmenu'],
        'menu_id' => 'ul_'.$pbCustomId.'',
        'menu_class' => 'pbp-navbuilder',
        'walker' => new Custom_Walker_Nav_Menu
    ) );
    $this_widget_menu = ob_get_contents();
    ob_end_clean();

    $thisCustomNav = "<div  class='menuItemListContainer'> " . $this_widget_menu . " </div>";

}


$homeUrl = home_url();

$logoImg = '';
if ($allNavStyles['cnslourl'] != '')
{
    $logoImg = ' <div class="cMenuLogoContainer"> <a href="' . $homeUrl . '"> <img src="' . $allNavStyles['cnslourl'] . '"> </a> </div>';
}

$logoImg = "<div class='navNlogoContainer' style='align-items: center; display: flex; justify-content: " . $allNavStyles['cnsalign'] . "; '>" . $logoImg . $responsiveMenuSwitch . '   </div>';

$thisSelectedFont = $allNavStyles['cnsff'];
if (1 === preg_match('~[0-9]~', $thisSelectedFont))
{
    $thisSelectedFont = "'" . $thisSelectedFont . "'";
}

if( !isset($allNavStyles['cnsig'])){
    $allNavStyles['cnsig'] = '20';
}


if( !isset($allNavStyles['cnslos'])){
    
    $allNavStyles['cnslos'] = 'Medium';

  }

  if($allNavStyles['cnslos'] == 'Small'){ $logoImageSize = 'width:70%;'; }
  if($allNavStyles['cnslos'] == 'Medium'){ $logoImageSize = 'width:85%;'; }
  if($allNavStyles['cnslos'] == 'Large'){ $logoImageSize = 'width:100%;'; }


$customStyles = "<style>  " . " #" . $pbCustomId . " .menuItemListContainer { $containerLayout }
                
    #" . $pbCustomId . " .cMenuLogoContainer { $containerLayout margin-right: ".$allNavStyles['cnsig']."px; }
    
    #" . $pbCustomId . " .cMenuLogoContainer img { max-width:300px; $logoImageSize }
    
    #" . $pbCustomId . " { align-items: center; display: flex; justify-content: center; } " . "#" . $pbCustomId . " ul li { $containerLayout " . $menuLinkGap . " } " . "#" . $pbCustomId . " ul li a { text-decoration:none; color:" . $allNavStyles['cnsfc'] . "; font-size:" . $allNavStyles['cnsfs'] . "px; font-family: " . str_replace('+', ' ', $thisSelectedFont) . " , Sans-Serif ;  padding:" . $allNavStyles['cnslh'] . "px 8px; background:" . $allNavStyles['cnsbc'] . ";  border-radius:2px;  display:block; }
    
    #" . $pbCustomId . " ul a:hover { color:" . $allNavStyles['cnsfhc'] . "; background:" . $allNavStyles['cnshbc'] . "; transition: all 0.3s; } 
    
    #" . $pbCustomId . " .responsiveNavBtn i { color:" . $allNavStyles['cnsnic'] . "; font-size: 55px ;} 
    
    #" . $pbCustomId . " .responsiveNavBtn { display: none ;  }


    #" . $pbCustomId . " .menu-item-has-children:hover > .sub-menu {  display:block;  transition: all 0.5s; }

    #" . $pbCustomId . " .sub-menu { display:none; float:left; z-index:1;  margin:0; width:inherit;  position:absolute; min-width:200px; }
    #" . $pbCustomId . " .sub-menu li { display:block; margin:0; }
    #" . $pbCustomId . " .sub-menu a { border-radius:0; }

    #" . $pbCustomId . " .sub-menu .sub-menu{ left: 100%; top: -".($allNavStyles['cnslh'] + $allNavStyles['cnslh'] + $allNavStyles['cnsfs'] + $allNavStyles['cnslh'] )."px; position: relative; z-index: 2; }

    #" . $pbCustomId . " .sub-menu .fa-caret-down { color:" . $allNavStyles['cnsfc'] . ";  }

  

    @media screen and (max-width: 480px) {

        #" . $pbCustomId . " .responsiveNavBtn  {  margin-left: 3%; width: 15%; margin-top: 2%; }
        #" . $pbCustomId . " .responsiveNavBtninActive { display: inline-block ;  }
        #" . $pbCustomId . " .menuItemListContainer { $hideMenuIfNotHorizontal }
        #" . $pbCustomId . " { align-items: center; display: block; justify-content: center; }
        #" . $pbCustomId . " ul li { display:block;}

        #" . $pbCustomId . " { align-items: unset !important; display: unset !important; justify-content: unset !important;  text-align: " . $allNavStyles['cnsalign'] . "; }

        #" . $pbCustomId . " .menuItemListContainer {width:100%;}

        #" . $pbCustomId . " .sub-menu {  width:100%;  position:relative; }

        #" . $pbCustomId . " .sub-menu .sub-menu { left:unset; top: unset; z-index: 2; }

        #" . $pbCustomId . " .sub-menu .fa-caret-down { font-size:". ($allNavStyles['cnsfs']+5)."px; color:" . $allNavStyles['cnsfc'] . ";  }
        

    }
" . "</style>";

$thisNavWidgetResponsiveWidgetStylesTablet = "#" . $pbCustomId . " ul li a { font-size: " . $allNavStyles['cnsfst'] . "px; } ";
$thisNavWidgetResponsiveWidgetStylesMobile = "#" . $pbCustomId . " ul li a { font-size: " . $allNavStyles['cnsfsm'] . "px; } ";

array_push($thisColFontsToLoad, $thisSelectedFont);

array_push($POPBNallRowStylesResponsiveTablet, $thisNavWidgetResponsiveWidgetStylesTablet);
array_push($POPBNallRowStylesResponsiveMobile, $thisNavWidgetResponsiveWidgetStylesMobile);

$responsiveMenuScript = "
                
                  (function($){
                    $('.responsiveNavBtninActive').on('click',function(){
                      $('#" . $pbCustomId . " .menuItemListContainer').show();
                      $('#" . $pbCustomId . " .menuItemListContainer').css('display','block');

                      $('#" . $pbCustomId . " .responsiveNavBtninActive').css('display','none');
                      $('#" . $pbCustomId . " .responsiveNavBtnActive').css('display','inline-block');
                    });
                    $('.responsiveNavBtnActive').on('click',function(){
                      $('#" . $pbCustomId . " .menuItemListContainer').hide();
                      $('#" . $pbCustomId . " .menuItemListContainer').css('display','none');
                      $(this).css('display','none');
                      $('#" . $pbCustomId . " .responsiveNavBtninActive').css('display','inline-block');
                    });

                    $('.menu-item .fa-caret-down').on('click', (e) => {
                        e.preventDefault();
                    } )
                  })(jQuery);
                
                ";

if ($allNavStyles['cnsresop'] == 'false')
{
    $responsiveMenuScript = '';
}

$wholeNavigationContainer = "<div id='" . $pbCustomId . "' class='customNavBuilderWidget' style='$cnsalign'> " . $logoImg . $thisCustomNav . " </div>" . $customStyles;

array_push($POPBallWidgetsScriptsArray, $responsiveMenuScript);

$widgetFALoadScripts = true;
$widgetJQueryLoadScripts = true;


$widgetContent = $wholeNavigationContainer;

?>
