( function( $ ) {



function isObjectEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

function filterDefaultRowOps(modelData){

  $.each(modelData, function(index,value){

    thisRowAttrs = value['attributes'];

    if (thisRowAttrs['rowHeight'] == '100' || thisRowAttrs['rowHeight'] == '') {
      delete thisRowAttrs.rowHeight;
    }

    if (thisRowAttrs['rowHeightTablet'] == '') {
      delete thisRowAttrs.rowHeightTablet;
    }

    if (thisRowAttrs['rowHeightMobile'] == '') {
      delete thisRowAttrs.rowHeightMobile;
    }

    if (thisRowAttrs['rowHeightUnit'] == 'px' || thisRowAttrs['rowHeightUnit'] == '') {
      delete thisRowAttrs.rowHeightUnit;
    }

    if (thisRowAttrs['rowHeightUnitTablet'] == '') {
      delete thisRowAttrs.rowHeightUnitTablet;
    }

    if (thisRowAttrs['rowHeightUnitMobile'] == '') {
      delete thisRowAttrs.rowHeightUnitMobile;
    }


    /* rowDataAttrs */
      thisRowData = thisRowAttrs['rowData'];


      if (thisRowData['rowCustomClass'] == '' || thisRowData['rowCustomClass'] == '') {
        delete thisRowData.rowCustomClass;
      }

      if (thisRowData['bg_color'] == '#fff' || thisRowData['bg_color'] == '') {
        delete thisRowData.bg_color;
      }

      if (thisRowData['bg_img'] == '') {
        delete thisRowData.bg_img;
      }

      if (thisRowData['bg_imgT'] == '') {
        delete thisRowData.bg_imgT;
      }

      if (thisRowData['bg_imgM'] == '') {
        delete thisRowData.bg_imgM;
      }

      if (thisRowData['bg_imgM'] == '') {
        delete thisRowData.bg_imgM;
      }

      if (thisRowData['rowCustomClass'] == '') {
        delete thisRowData.rowCustomClass;
      }

      if (thisRowData['customStyling'] == '' || thisRowData['customStyling'] == '/* Insert your custom CSS for this row here. */') {
        delete thisRowData.customStyling;
      }

      if (thisRowData['customJS'] == '' || thisRowData['customJS'] == ' ') {
        delete thisRowData.customJS;
      }

      if (thisRowData['conType'] == '') {
        delete thisRowData.conType;
      }

      if (thisRowData['conWidth'] == '') {
        delete thisRowData.conWidth;
      }

      if (thisRowData['rowHideOnDesktop'] == '') {
        delete thisRowData.rowHideOnDesktop;
      }

      if (thisRowData['rowHideOnTablet'] == '') {
        delete thisRowData.rowHideOnTablet;
      }

      if (thisRowData['rowHideOnMobile'] == '') {
        delete thisRowData.rowHideOnMobile;
      }

      if (thisRowData['rowOverlayBackgroundType'] == '') {
        delete thisRowData.rowOverlayBackgroundType;
      }

    /* rowDataAttrs */


    /* rowDataMarginAttrs */

      if (typeof(thisRowData['marginTablet']) != 'undefined') {
        thisRowDataMarginTab = thisRowData['marginTablet'];

        if (thisRowDataMarginTab['rMTT'] == '' || thisRowDataMarginTab['rMTT'] == '0') {
          delete thisRowDataMarginTab.rMTT;
        }

        if (thisRowDataMarginTab['rMBT'] == '' ||  thisRowDataMarginTab['rMBT'] == '0') {
          delete thisRowDataMarginTab.rMBT;
        }

        if (thisRowDataMarginTab['rMLT'] == '' ||  thisRowDataMarginTab['rMLT'] == '0') {
          delete thisRowDataMarginTab.rMLT;
        }

        if (thisRowDataMarginTab['rMRT'] == '' ||  thisRowDataMarginTab['rMRT'] == '0') {
          delete thisRowDataMarginTab.rMRT;
        }

        if (isObjectEmpty(thisRowData['marginTablet'])) {
          delete thisRowData.marginTablet;
        }

      }

      



      if (typeof(thisRowData['marginMobile']) != 'undefined') {

        thisRowDataMarginMob = thisRowData['marginMobile'];

        if (thisRowDataMarginMob['rMTM'] == '' ||  thisRowDataMarginMob['rMTM'] == '0') {
          delete thisRowDataMarginMob.rMTM;
        }

        if (thisRowDataMarginMob['rMBM'] == '' ||  thisRowDataMarginMob['rMBM'] == '0') {
          delete thisRowDataMarginMob.rMBM;
        }

        if (thisRowDataMarginMob['rMLM'] == '' ||  thisRowDataMarginMob['rMLM'] == '0') {
          delete thisRowDataMarginMob.rMLM;
        }

        if (thisRowDataMarginMob['rMRM'] == '' ||  thisRowDataMarginMob['rMRM'] == '0') {
          delete thisRowDataMarginMob.rMRM;
        }

        if (isObjectEmpty(thisRowData['marginMobile'])) {
          delete thisRowData.marginMobile;
        }


      }

      
      if (typeof(thisRowData['paddingTablet']) != 'undefined') {

        thisRowDataPaddingTab = thisRowData['paddingTablet'];

        if (thisRowDataPaddingTab['rPTT'] == '' || thisRowDataPaddingTab['rPTT'] == '1.5') {
          delete thisRowDataPaddingTab.rPTT;
        }

        if (thisRowDataPaddingTab['rPBT'] == '' ||  thisRowDataPaddingTab['rPBT'] == '1.5') {
          delete thisRowDataPaddingTab.rPBT;
        }

        if (thisRowDataPaddingTab['rPLT'] == '' ||  thisRowDataPaddingTab['rPLT'] == '1.5') {
          delete thisRowDataPaddingTab.rPLT;
        }

        if (thisRowDataPaddingTab['rPRT'] == '' ||  thisRowDataPaddingTab['rPRT'] == '1.5') {
          delete thisRowDataPaddingTab.rPRT;
        }

        if (isObjectEmpty(thisRowData['paddingTablet'])) {
          delete thisRowData.paddingTablet;
        }

      }
      


      if (typeof(thisRowData['paddingMobile']) != 'undefined') {

        thisRowDataPaddingMob = thisRowData['paddingMobile'];

        if (thisRowDataPaddingMob['rPTM'] == '' ||  thisRowDataPaddingMob['rPTM'] == '1.5') {
          delete thisRowDataPaddingMob.rPTM;
        }

        if (thisRowDataPaddingMob['rPBM'] == '' ||  thisRowDataPaddingMob['rPBM'] == '1.5') {
          delete thisRowDataPaddingMob.rPBM;
        }

        if (thisRowDataPaddingMob['rPLM'] == '' ||  thisRowDataPaddingMob['rPLM'] == '1.5') {
          delete thisRowDataPaddingMob.rPLM;
        }

        if (thisRowDataPaddingMob['rPRM'] == '' ||  thisRowDataPaddingMob['rPRM'] == '1.5') {
          delete thisRowDataPaddingMob.rPRM;
        }

        if (isObjectEmpty(thisRowData['paddingMobile'])) {
          delete thisRowData.paddingMobile;
        }

      }

        

    /* rowDataMarginAttrs */



    /* rowDataBgShapesAttrs */


      if (typeof(thisRowData['bgSTop']) != 'undefined') {

        thisRowDatabgSTop = thisRowData['bgSTop'];

        if (thisRowDatabgSTop['rbgstType'] == '' ||  thisRowDatabgSTop['rbgstType'] == 'none') {
          delete thisRowDatabgSTop.rbgstType;
        }

        if (thisRowDatabgSTop['rbgstColor'] == '' ||  thisRowDatabgSTop['rbgstColor'] == '#e3e3e3') {
          delete thisRowDatabgSTop.rbgstColor;
        }

        if (thisRowDatabgSTop['rbgstWidth'] == '' ||  thisRowDatabgSTop['rbgstWidth'] == '100') {
          delete thisRowDatabgSTop.rbgstWidth;
        }

        if (thisRowDatabgSTop['rbgstWidtht'] == '' ||  thisRowDatabgSTop['rbgstWidtht'] == '') {
          delete thisRowDatabgSTop.rbgstWidtht;
        }

        if (thisRowDatabgSTop['rbgstWidthm'] == '' ||  thisRowDatabgSTop['rbgstWidthm'] == '') {
          delete thisRowDatabgSTop.rbgstWidthm;
        }

        if (thisRowDatabgSTop['rbgstHeight'] == '' ||  thisRowDatabgSTop['rbgstHeight'] == '200') {
          delete thisRowDatabgSTop.rbgstHeight;
        }

        if (thisRowDatabgSTop['rbgstHeightt'] == '' ||  thisRowDatabgSTop['rbgstHeightt'] == '') {
          delete thisRowDatabgSTop.rbgstHeightt;
        }

        if (thisRowDatabgSTop['rbgstHeightm'] == '' ||  thisRowDatabgSTop['rbgstHeightm'] == '') {
          delete thisRowDatabgSTop.rbgstHeightm;
        }

        if (thisRowDatabgSTop['rbgstFlipped'] == '' ||  thisRowDatabgSTop['rbgstFlipped'] == 'none') {
          delete thisRowDatabgSTop.rbgstFlipped;
        }

        if (thisRowDatabgSTop['rbgstFront'] == '' ||  thisRowDatabgSTop['rbgstFront'] == 'back') {
          delete thisRowDatabgSTop.rbgstFront;
        }


        if (isObjectEmpty(thisRowData['bgSTop'])) {
          delete thisRowData.bgSTop;
        }

      }

      
      if (typeof(thisRowData['bgSBottom']) != 'undefined') {

        thisRowDatabgSBottom = thisRowData['bgSBottom'];

        if (thisRowDatabgSBottom['rbgsbType'] == '' ||  thisRowDatabgSBottom['rbgsbType'] == 'none') {
          delete thisRowDatabgSBottom.rbgsbType;
        }

        if (thisRowDatabgSBottom['rbgsbColor'] == '' ||  thisRowDatabgSBottom['rbgsbColor'] == '#e3e3e3') {
          delete thisRowDatabgSBottom.rbgsbColor;
        }

        if (thisRowDatabgSBottom['rbgsbWidth'] == '' ||  thisRowDatabgSBottom['rbgsbWidth'] == '100') {
          delete thisRowDatabgSBottom.rbgsbWidth;
        }

        if (thisRowDatabgSBottom['rbgsbWidtht'] == '' ||  thisRowDatabgSBottom['rbgsbWidtht'] == '') {
          delete thisRowDatabgSBottom.rbgsbWidtht;
        }

        if (thisRowDatabgSBottom['rbgsbWidthm'] == '' ||  thisRowDatabgSBottom['rbgsbWidthm'] == '') {
          delete thisRowDatabgSBottom.rbgsbWidthm;
        }

        if (thisRowDatabgSBottom['rbgsbHeight'] == '' ||  thisRowDatabgSBottom['rbgsbHeight'] == '200') {
          delete thisRowDatabgSBottom.rbgsbHeight;
        }

        if (thisRowDatabgSBottom['rbgsbHeightt'] == '' ||  thisRowDatabgSBottom['rbgsbHeightt'] == '') {
          delete thisRowDatabgSBottom.rbgsbHeightt;
        }

        if (thisRowDatabgSBottom['rbgsbHeightm'] == '' ||  thisRowDatabgSBottom['rbgsbHeightm'] == '') {
          delete thisRowDatabgSBottom.rbgsbHeightm;
        }

        if (thisRowDatabgSBottom['rbgsbFlipped'] == '' ||  thisRowDatabgSBottom['rbgsbFlipped'] == 'none') {
          delete thisRowDatabgSBottom.rbgsbFlipped;
        }

        if (thisRowDatabgSBottom['rbgsbFront'] == '' ||  thisRowDatabgSBottom['rbgsbFront'] == 'back') {
          delete thisRowDatabgSBottom.rbgsbFront;
        }


        if (isObjectEmpty(thisRowData['bgSBottom'])) {
          delete thisRowData.bgSBottom;
        }

      } 


    /* rowDataBgShapesAttrs */


    if (typeof(thisRowData['video']) != 'undefined') {

      thisRowDataVideo = thisRowData['video'];

      if (thisRowDataVideo['rowBgVideoEnable'] == '' ||  thisRowDataVideo['rowBgVideoEnable'] == 'false') {
        delete thisRowDataVideo.rowBgVideoEnable;
      }

      if (thisRowDataVideo['rowBgVideoLoop'] == '' ||  thisRowDataVideo['rowBgVideoLoop'] == 'loop') {
        delete thisRowDataVideo.rowBgVideoLoop;
      }

      if (thisRowDataVideo['rowVideoMpfour'] == '' ||  thisRowDataVideo['rowVideoMpfour'] == ' ') {
        delete thisRowDataVideo.rowVideoMpfour;
      }

      if (thisRowDataVideo['rowVideoWebM'] == '' ||  thisRowDataVideo['rowVideoWebM'] == ' ') {
        delete thisRowDataVideo.rowVideoWebM;
      }

      if (thisRowDataVideo['rowVideoThumb'] == '' ||  thisRowDataVideo['rowVideoThumb'] == ' ') {
        delete thisRowDataVideo.rowVideoThumb;
      }

      if (thisRowDataVideo['rowVideoType'] == '' ||  thisRowDataVideo['rowVideoType'] == 'mp4') {
        delete thisRowDataVideo.rowVideoType;
      }

      if (thisRowDataVideo['rowVideoYtUrl'] == '') {
        delete thisRowDataVideo.rowVideoYtUrl;
      }


      if (isObjectEmpty(thisRowData['video'])) {
        delete thisRowData.video;
      }

    }


    if (typeof(thisRowData['rowGradient']) != 'undefined') {

      thisRowGrad = thisRowData['rowGradient'];

      if (thisRowGrad['rowGradientColorFirst'] == '' ||  thisRowGrad['rowGradientColorFirst'] == '#dd9933') {
        delete thisRowGrad.rowGradientColorFirst;
      }

      if (thisRowGrad['rowGradientLocationFirst'] == '' ||  thisRowGrad['rowGradientLocationFirst'] == '40') {
        delete thisRowGrad.rowGradientLocationFirst;
      }

      if (thisRowGrad['rowGradientColorSecond'] == '' ||  thisRowGrad['rowGradientColorSecond'] == '#eeee22') {
        delete thisRowGrad.rowGradientColorSecond;
      }

      if (thisRowGrad['rowGradientLocationSecond'] == '' ||  thisRowGrad['rowGradientLocationSecond'] == '60') {
        delete thisRowGrad.rowGradientLocationSecond;
      }

      if (thisRowGrad['rowGradientType'] == '' ||  thisRowGrad['rowGradientType'] == 'linear') {
        delete thisRowGrad.rowGradientType;
      }

      if (thisRowGrad['rowGradientPosition'] == '' ||  thisRowGrad['rowGradientPosition'] == 'top left') {
        delete thisRowGrad.rowGradientPosition;
      }

      if (thisRowGrad['rowGradientAngle'] == '' ||  thisRowGrad['rowGradientAngle'] == '135') {
        delete thisRowGrad.rowGradientAngle;
      }

      if (isObjectEmpty(thisRowData['rowGradient'])) {
        delete thisRowData.rowGradient;
      }

    }
      

    
    if (typeof(thisRowData['rowHoverOptions']) != 'undefined') {

      thisRowHover = thisRowData['rowHoverOptions'];

      if (thisRowHover['rowBgColorHover'] == '' ||  thisRowHover['rowBgColorHover'] == '') {
        delete thisRowHover.rowBgColorHover;
      }

      if (thisRowHover['rowBackgroundTypeHover'] == '' ||  thisRowHover['rowBackgroundTypeHover'] == '') {
        delete thisRowHover.rowBackgroundTypeHover;
      }

      if (thisRowHover['rowHoverTransitionDuration'] == '' ||  thisRowHover['rowHoverTransitionDuration'] == '') {
        delete thisRowHover.rowHoverTransitionDuration;
      }


      thisRowGrHover = thisRowHover['rowGradientHover'];

      if (thisRowGrHover['rowGradientColorFirstHover'] == '' ||  thisRowGrHover['rowGradientColorFirstHover'] == '') {
        delete thisRowGrHover.rowGradientColorFirstHover;
      }

      if (thisRowGrHover['rowGradientLocationFirstHover'] == '' ||  thisRowGrHover['rowGradientLocationFirstHover'] == '') {
        delete thisRowGrHover.rowGradientLocationFirstHover;
      }

      if (thisRowGrHover['rowGradientColorSecondHover'] == '' ||  thisRowGrHover['rowGradientColorSecondHover'] == '') {
        delete thisRowGrHover.rowGradientColorSecondHover;
      }

      if (thisRowGrHover['rowGradientLocationSecondHover'] == '' ||  thisRowGrHover['rowGradientLocationSecondHover'] == '') {
        delete thisRowGrHover.rowGradientLocationSecondHover;
      }

      if (thisRowGrHover['rowGradientTypeHover'] == '' ||  thisRowGrHover['rowGradientTypeHover'] == 'linear') {
        delete thisRowGrHover.rowGradientTypeHover;
      }

      if (thisRowGrHover['rowGradientPositionHover'] == '' ||  thisRowGrHover['rowGradientPositionHover'] == 'top left') {
        delete thisRowGrHover.rowGradientPositionHover;
      }

      if (thisRowGrHover['rowGradientAngleHover'] == '' ||  thisRowGrHover['rowGradientAngleHover'] == '') {
        delete thisRowGrHover.rowGradientAngleHover;
      }


      if (isObjectEmpty(thisRowHover['rowGradientHover'])) {
        delete thisRowHover.rowGradientHover;
      }

      if (isObjectEmpty(thisRowData['rowHoverOptions'])) {
        delete thisRowData.rowHoverOptions;
      }

    }

    

    if (typeof(thisRowData['rowOverlayGradient']) != 'undefined') {

      thisRowOverGr = thisRowData['rowOverlayGradient'];

      if (thisRowOverGr['rowOverlayGradientColorFirst'] == '') {
        delete thisRowOverGr.rowOverlayGradientColorFirst;
      }

      if (thisRowOverGr['rowOverlayGradientLocationFirst'] == '') {
        delete thisRowOverGr.rowOverlayGradientLocationFirst;
      }

      if (thisRowOverGr['rowOverlayGradientColorSecond'] == '') {
        delete thisRowOverGr.rowOverlayGradientColorSecond;
      }

      if (thisRowOverGr['rowOverlayGradientLocationSecond'] == '') {
        delete thisRowOverGr.rowOverlayGradientLocationSecond;
      }

      if (thisRowOverGr['rowOverlayGradientType'] == '') {
        delete thisRowOverGr.rowOverlayGradientType;
      }

      if (thisRowOverGr['rowOverlayGradientPosition'] == '') {
        delete thisRowOverGr.rowOverlayGradientPosition;
      }

      if (thisRowOverGr['rowOverlayGradientAngle'] == '') {
        delete thisRowOverGr.rowOverlayGradientAngle;
      }

      if (isObjectEmpty(thisRowData['rowOverlayGradient'])) {
        delete thisRowData.rowOverlayGradient;
      }

    }


    if (typeof(thisRowData['bgImgOps']) != 'undefined') {

      bgImgOps = thisRowData['bgImgOps'];

      if (bgImgOps['pos'] == '' || bgImgOps['pos'] == 'center center') {
        delete bgImgOps.pos;
      }

      if (bgImgOps['posT'] == '') {
        delete bgImgOps.posT;
      }

      if (bgImgOps['posM'] == '') {
        delete bgImgOps.posM;
      }

      if (bgImgOps['xPos'] == '') {
        delete bgImgOps.xPos;
      }

      if (bgImgOps['xPosT'] == '') {
        delete bgImgOps.xPosT;
      }

      if (bgImgOps['xPosM'] == '') {
        delete bgImgOps.xPosM;
      }

      if (bgImgOps['xPosU'] == '' || bgImgOps['xPosU'] == 'px') {
        delete bgImgOps.xPosU;
      }

      if (bgImgOps['xPosUT'] == '' || bgImgOps['xPosUT'] == 'px') {
        delete bgImgOps.xPosUT;
      }

      if (bgImgOps['xPosUM'] == '' || bgImgOps['xPosUM'] == 'px') {
        delete bgImgOps.xPosUM;
      }

      if (bgImgOps['yPos'] == '') {
        delete bgImgOps.yPos;
      }

      if (bgImgOps['yPosT'] == '') {
        delete bgImgOps.yPosT;
      }

      if (bgImgOps['yPosM'] == '') {
        delete bgImgOps.yPosM;
      }

      if (bgImgOps['yPosU'] == '' || bgImgOps['yPosU'] == 'px') {
        delete bgImgOps.yPosU;
      }

      if (bgImgOps['yPosUT'] == '' || bgImgOps['yPosUT'] == 'px') {
        delete bgImgOps.yPosUT;
      }

      if (bgImgOps['yPosUM'] == '' || bgImgOps['yPosUM'] == 'px') {
        delete bgImgOps.yPosUM;
      }

      if (bgImgOps['rep'] == '' || bgImgOps['rep'] == 'default') {
        delete bgImgOps.rep;
      }

      if (bgImgOps['repT'] == '' || bgImgOps['repT'] == 'default') {
        delete bgImgOps.repT;
      }

      if (bgImgOps['repM'] == '' || bgImgOps['repM'] == 'default') {
        delete bgImgOps.repM;
      }

      if (bgImgOps['size'] == '' || bgImgOps['size'] == 'cover') {
        delete bgImgOps.size;
      }

      if (bgImgOps['sizeT'] == '') {
        delete bgImgOps.sizeT;
      }

      if (bgImgOps['sizeM'] == '') {
        delete bgImgOps.sizeM;
      }

      if (bgImgOps['cWid'] == '') {
        delete bgImgOps.cWid;
      }

      if (bgImgOps['cWidT'] == '') {
        delete bgImgOps.cWidT;
      }

      if (bgImgOps['cWidM'] == '') {
        delete bgImgOps.cWidM;
      }

      if (bgImgOps['widU'] == '' || bgImgOps['widU'] == 'px') {
        delete bgImgOps.widU;
      }

      if (bgImgOps['widUT'] == '' || bgImgOps['widUT'] == 'px') {
        delete bgImgOps.widUT;
      }

      if (bgImgOps['widUM'] == '' || bgImgOps['widUM'] == 'px') {
        delete bgImgOps.widUM;
      }

      if (bgImgOps['cWid'] == '') {
        delete bgImgOps.cWid;
      }

      if (bgImgOps['parlxT'] == '') {
        delete bgImgOps.parlxT;
      }

      if (bgImgOps['parlxM'] == '') {
        delete bgImgOps.parlxM;
      }

      if (isObjectEmpty(thisRowData['bgImgOps'])) {
        delete thisRowData.bgImgOps;
      }

    }

      


  });


  return modelData;

}

function filterDefaultColumnsOps(modelData){

  $.each(modelData, function(index,value){

    thisRowAttrs = value['attributes'];
    thisRowColumns = thisRowAttrs['columns'];

    for(var i = 1; i <= thisRowColumns; i++){


      var this_column = 'column'+i;
      var thisColumnModelData = thisRowAttrs[this_column];
      if (typeof(thisColumnModelData) == 'undefined' ) {
        continue;
      }

      thisColOps = thisColumnModelData['columnOptions'];

      /* thisColOps */

        if (thisColOps['bg_color'] == '' || thisColOps['bg_color'] == 'transparent') {
          delete thisColOps.bg_color;
        }

        if (thisColOps['widthTablet'] == '') {
          delete thisColOps.widthTablet;
        }

        if (thisColOps['width'] == '') {
          delete thisColOps.width;
        }

        if (thisColOps['widthMobile'] == '') {
          delete thisColOps.widthMobile;
        }

        if (thisColOps['columnCSS'] == '' || thisColOps['columnCSS'] == '/* Add column custom styling here */') {
          delete thisColOps.columnCSS;
        }

        if (thisColOps['columnCustomClass'] == '') {
          delete thisColOps.columnCustomClass;
        }

        if (thisColOps['colHideOnDesktop'] == '') {
          delete thisColOps.colHideOnDesktop;
        }

        if (thisColOps['colHideOnTablet'] == '') {
          delete thisColOps.colHideOnTablet;
        }

        if (thisColOps['colHideOnMobile'] == '') {
          delete thisColOps.colHideOnMobile;
        }

        if (thisColOps['colBgImg'] == '') {
          delete thisColOps.colBgImg;
        }

        if (thisColOps['colBgImgT'] == '') {
          delete thisColOps.colBgImgT;
        }

        if (thisColOps['colBgImgM'] == '') {
          delete thisColOps.colBgImgM;
        }

      /* thisColOps */



      /* thisColMarginAttrs */

      
        if (typeof(thisColOps['margin']) != 'undefined') {
          thisColOpsMargin = thisColOps['margin'];

          if (thisColOpsMargin['columnMarginTop'] == '' || thisColOpsMargin['columnMarginTop'] == '0') {
            delete thisColOpsMargin.columnMarginTop;
          }

          if (thisColOpsMargin['columnMarginBottom'] == '' || thisColOpsMargin['columnMarginBottom'] == '0' ) {
            delete thisColOpsMargin.columnMarginBottom;
          }

          if (thisColOpsMargin['columnMarginLeft'] == '' || thisColOpsMargin['columnMarginLeft'] == '0' ) {
            delete thisColOpsMargin.columnMarginLeft;
          }

          if (thisColOpsMargin['columnMarginRight'] == '' || thisColOpsMargin['columnMarginRight'] == '0' ) {
            delete thisColOpsMargin.columnMarginRight;
          }

          if (isObjectEmpty(thisColOps['margin'])) {
            delete thisColOps.margin;
          }

        }


        if (typeof(thisColOps['marginTablet']) != 'undefined') {
          thisColOpsMarginTab = thisColOps['marginTablet'];

          if (thisColOpsMarginTab['rMTT'] == '' ) {
            delete thisColOpsMarginTab.rMTT;
          }

          if (thisColOpsMarginTab['rMBT'] == '' ) {
            delete thisColOpsMarginTab.rMBT;
          }

          if (thisColOpsMarginTab['rMLT'] == '' ) {
            delete thisColOpsMarginTab.rMLT;
          }

          if (thisColOpsMarginTab['rMRT'] == '' ) {
            delete thisColOpsMarginTab.rMRT;
          }

          if (isObjectEmpty(thisColOps['marginTablet'])) {
            delete thisColOps.marginTablet;
          }

        }
        

        if (typeof(thisColOps['marginMobile']) != 'undefined') {

          thisColOpsMarginMob = thisColOps['marginMobile'];

          if (thisColOpsMarginMob['rMTM'] == '' ) {
            delete thisColOpsMarginMob.rMTM;
          }

          if (thisColOpsMarginMob['rMBM'] == '' ) {
            delete thisColOpsMarginMob.rMBM;
          }

          if (thisColOpsMarginMob['rMLM'] == '' ) {
            delete thisColOpsMarginMob.rMLM;
          }

          if (thisColOpsMarginMob['rMRM'] == '' ) {
            delete thisColOpsMarginMob.rMRM;
          }

          if (isObjectEmpty(thisColOps['marginMobile'])) {
            delete thisColOps.marginMobile;
          }


        }


        if (typeof(thisColOps['padding']) != 'undefined') {
          thisColOpsPadding = thisColOps['padding'];

          if (thisColOpsPadding['columnPaddingTop'] == '' || thisColOpsPadding['columnPaddingTop'] == '0' ) {
            delete thisColOpsPadding.columnPaddingTop;
          }

          if (thisColOpsPadding['columnPaddingBottom'] == '' || thisColOpsPadding['columnPaddingBottom'] == '0'  ) {
            delete thisColOpsPadding.columnPaddingBottom;
          }

          if (thisColOpsPadding['columnPaddingLeft'] == '' || thisColOpsPadding['columnPaddingLeft'] == '0'  ) {
            delete thisColOpsPadding.columnPaddingLeft;
          }

          if (thisColOpsPadding['columnPaddingRight'] == '' || thisColOpsPadding['columnPaddingRight'] == '0'  ) {
            delete thisColOpsPadding.columnPaddingRight;
          }

          if (isObjectEmpty(thisColOps['padding'])) {
            delete thisColOps.padding;
          }

        }

        
        if (typeof(thisColOps['paddingTablet']) != 'undefined') {

          thisColOpsPaddingTab = thisColOps['paddingTablet'];

          if (thisColOpsPaddingTab['rPTT'] == '' ) {
            delete thisColOpsPaddingTab.rPTT;
          }

          if (thisColOpsPaddingTab['rPBT'] == '' ) {
            delete thisColOpsPaddingTab.rPBT;
          }

          if (thisColOpsPaddingTab['rPLT'] == '' ) {
            delete thisColOpsPaddingTab.rPLT;
          }

          if (thisColOpsPaddingTab['rPRT'] == '' ) {
            delete thisColOpsPaddingTab.rPRT;
          }

          if (isObjectEmpty(thisColOps['paddingTablet'])) {
            delete thisColOps.paddingTablet;
          }

        }
        


        if (typeof(thisColOps['paddingMobile']) != 'undefined') {

          thisColOpsPaddingMob = thisColOps['paddingMobile'];

          if (thisColOpsPaddingMob['rPTM'] == '' ) {
            delete thisColOpsPaddingMob.rPTM;
          }

          if (thisColOpsPaddingMob['rPBM'] == '' ) {
            delete thisColOpsPaddingMob.rPBM;
          }

          if (thisColOpsPaddingMob['rPLM'] == '' ) {
            delete thisColOpsPaddingMob.rPLM;
          }

          if (thisColOpsPaddingMob['rPRM'] == '' ) {
            delete thisColOpsPaddingMob.rPRM;
          }

          if (isObjectEmpty(thisColOps['paddingMobile'])) {
            delete thisColOps.paddingMobile;
          }

        }

        
      /* thisColMarginAttrs */

      if (typeof(thisColOps['colGradient']) != 'undefined') {

        thisRowGrad = thisColOps['colGradient'];

        if (thisRowGrad['colGradientColorFirst'] == '' ||  thisRowGrad['colGradientColorFirst'] == '#dd9933') {
          delete thisRowGrad.colGradientColorFirst;
        }

        if (thisRowGrad['colGradientLocationFirst'] == '' ||  thisRowGrad['colGradientLocationFirst'] == '55') {
          delete thisRowGrad.colGradientLocationFirst;
        }

        if (thisRowGrad['colGradientColorSecond'] == '' ||  thisRowGrad['colGradientColorSecond'] == '#eeee22') {
          delete thisRowGrad.colGradientColorSecond;
        }

        if (thisRowGrad['colGradientLocationSecond'] == '' ||  thisRowGrad['colGradientLocationSecond'] == '50') {
          delete thisRowGrad.colGradientLocationSecond;
        }

        if (thisRowGrad['colGradientType'] == '' ||  thisRowGrad['colGradientType'] == 'linear') {
          delete thisRowGrad.colGradientType;
        }

        if (thisRowGrad['colGradientPosition'] == '' ||  thisRowGrad['colGradientPosition'] == 'top left') {
          delete thisRowGrad.colGradientPosition;
        }

        if (thisRowGrad['colGradientAngle'] == '' ||  thisRowGrad['colGradientAngle'] == '135') {
          delete thisRowGrad.colGradientAngle;
        }

        if (isObjectEmpty(thisColOps['colGradient'])) {
          delete thisColOps.colGradient;
        }

      }

      /* colDataHoverAttrs */

      if (typeof(thisColOps['colHoverOptions']) != 'undefined') {

        thisColHover = thisColOps['colHoverOptions'];

          if (thisColHover['colBgColorHover'] == '') {
            delete thisColHover.colBgColorHover;
          }

          if (thisColHover['colBackgroundTypeHover'] == '' ) {
            delete thisColHover.colBackgroundTypeHover;
          }

          if (thisColHover['colHoverTransitionDuration'] == '' ) {
            delete thisColHover.colHoverTransitionDuration;
          }


          if (typeof(thisColHover['colGradientHover']) != 'undefined') {

            thisColGrHover = thisColHover['colGradientHover'];

            if (thisColGrHover['colGradientColorFirstHover'] == '' || thisColGrHover['colGradientColorFirstHover'] == 'hsv(0, 0%, 0%)' ) {
              delete thisColGrHover.colGradientColorFirstHover;
            }

            if (thisColGrHover['colGradientLocationFirstHover'] == '' ) {
              delete thisColGrHover.colGradientLocationFirstHover;
            }

            if (thisColGrHover['colGradientColorSecondHover'] == '' || thisColGrHover['colGradientColorSecondHover'] == 'hsv(0, 0%, 0%)' ) {
              delete thisColGrHover.colGradientColorSecondHover;
            }

            if (thisColGrHover['colGradientLocationSecondHover'] == '' ) {
              delete thisColGrHover.colGradientLocationSecondHover;
            }

            if (thisColGrHover['colGradientTypeHover'] == '' || thisColGrHover['colGradientTypeHover'] == 'linear') {
              delete thisColGrHover.colGradientTypeHover;
            }

            if (thisColGrHover['colGradientPositionHover'] == '' || thisColGrHover['colGradientPositionHover'] == 'top left') {
              delete thisColGrHover.colGradientPositionHover;
            }

            if (thisColGrHover['colGradientAngleHover'] == '') {
              delete thisColGrHover.colGradientAngleHover;
            }
            if (isObjectEmpty(thisColHover['colGradientHover'])) {
              delete thisColOps.colHoverOptions.colGradientHover;
            }

          }
            

          if (isObjectEmpty(thisColOps['colHoverOptions'])) {
            delete thisColOps.colHoverOptions;
          }

      }

      /* colDataHoverAttrs */


      if (typeof(thisColOps['bgImgOps']) != 'undefined') {

        bgImgOps = thisColOps['bgImgOps'];

        if (bgImgOps['pos'] == '' || bgImgOps['pos'] == 'center center') {
          delete bgImgOps.pos;
        }

        if (bgImgOps['posT'] == '') {
          delete bgImgOps.posT;
        }

        if (bgImgOps['posM'] == '') {
          delete bgImgOps.posM;
        }

        if (bgImgOps['xPos'] == '') {
          delete bgImgOps.xPos;
        }

        if (bgImgOps['xPosT'] == '') {
          delete bgImgOps.xPosT;
        }

        if (bgImgOps['xPosM'] == '') {
          delete bgImgOps.xPosM;
        }

        if (bgImgOps['xPosU'] == '' || bgImgOps['xPosU'] == 'px') {
          delete bgImgOps.xPosU;
        }

        if (bgImgOps['xPosUT'] == '' || bgImgOps['xPosUT'] == 'px') {
          delete bgImgOps.xPosUT;
        }

        if (bgImgOps['xPosUM'] == '' || bgImgOps['xPosUM'] == 'px') {
          delete bgImgOps.xPosUM;
        }

        if (bgImgOps['yPos'] == '') {
          delete bgImgOps.yPos;
        }

        if (bgImgOps['yPosT'] == '') {
          delete bgImgOps.yPosT;
        }

        if (bgImgOps['yPosM'] == '') {
          delete bgImgOps.yPosM;
        }

        if (bgImgOps['yPosU'] == '' || bgImgOps['yPosU'] == 'px') {
          delete bgImgOps.yPosU;
        }

        if (bgImgOps['yPosUT'] == '' || bgImgOps['yPosUT'] == 'px') {
          delete bgImgOps.yPosUT;
        }

        if (bgImgOps['yPosUM'] == '' || bgImgOps['yPosUM'] == 'px') {
          delete bgImgOps.yPosUM;
        }

        if (bgImgOps['rep'] == '' || bgImgOps['rep'] == 'default') {
          delete bgImgOps.rep;
        }

        if (bgImgOps['repT'] == '' || bgImgOps['repT'] == 'default') {
          delete bgImgOps.repT;
        }

        if (bgImgOps['repM'] == '' || bgImgOps['repM'] == 'default') {
          delete bgImgOps.repM;
        }

        if (bgImgOps['size'] == '' || bgImgOps['size'] == 'cover') {
          delete bgImgOps.size;
        }

        if (bgImgOps['sizeT'] == '') {
          delete bgImgOps.sizeT;
        }

        if (bgImgOps['sizeM'] == '') {
          delete bgImgOps.sizeM;
        }

        if (bgImgOps['cWid'] == '') {
          delete bgImgOps.cWid;
        }

        if (bgImgOps['cWidT'] == '') {
          delete bgImgOps.cWidT;
        }

        if (bgImgOps['cWidM'] == '') {
          delete bgImgOps.cWidM;
        }

        if (bgImgOps['widU'] == '' || bgImgOps['widU'] == 'px') {
          delete bgImgOps.widU;
        }

        if (bgImgOps['widUT'] == '' || bgImgOps['widUT'] == 'px') {
          delete bgImgOps.widUT;
        }

        if (bgImgOps['widUM'] == '' || bgImgOps['widUM'] == 'px') {
          delete bgImgOps.widUM;
        }

        if (bgImgOps['cWid'] == '') {
          delete bgImgOps.cWid;
        }

        if (bgImgOps['parlxT'] == '') {
          delete bgImgOps.parlxT;
        }

        if (bgImgOps['parlxM'] == '') {
          delete bgImgOps.parlxM;
        }

        if (isObjectEmpty(thisColOps['bgImgOps'])) {
          delete thisColOps.bgImgOps;
        }

      }



      if (typeof(thisColOps['colBorder']) != 'undefined') {

        colBorder = thisColOps['colBorder'];

        if (colBorder['bwt'] == '') {
          delete colBorder.bwt;
        }

        if (colBorder['bwb'] == '') {
          delete colBorder.bwb;
        }

        if (colBorder['bwl'] == '') {
          delete colBorder.bwl;
        }

        if (colBorder['bwr'] == '') {
          delete colBorder.bwr;
        }

        if (colBorder['bwtT'] == '') {
          delete colBorder.bwtT;
        }

        if (colBorder['bwbT'] == '') {
          delete colBorder.bwbT;
        }

        if (colBorder['bwlT'] == '') {
          delete colBorder.bwlT;
        }

        if (colBorder['bwrT'] == '') {
          delete colBorder.bwrT;
        }

        if (colBorder['bwtM'] == '') {
          delete colBorder.bwtM;
        }

        if (colBorder['bwbM'] == '') {
          delete colBorder.bwbM;
        }

        if (colBorder['bwlM'] == '') {
          delete colBorder.bwlM;
        }

        if (colBorder['bwrM'] == '') {
          delete colBorder.bwrM;
        }

        if (colBorder['brt'] == '') {
          delete colBorder.brt;
        }

        if (colBorder['brb'] == '') {
          delete colBorder.brb;
        }

        if (colBorder['brl'] == '') {
          delete colBorder.brl;
        }

        if (colBorder['brr'] == '') {
          delete colBorder.brr;
        }


        if (colBorder['brtT'] == '') {
          delete colBorder.brtT;
        }

        if (colBorder['brbT'] == '') {
          delete colBorder.brbT;
        }

        if (colBorder['brlT'] == '') {
          delete colBorder.brlT;
        }

        if (colBorder['brrT'] == '') {
          delete colBorder.brrT;
        }


        if (colBorder['brtM'] == '') {
          delete colBorder.brtM;
        }

        if (colBorder['brbM'] == '') {
          delete colBorder.brbM;
        }

        if (colBorder['brlM'] == '') {
          delete colBorder.brlM;
        }

        if (colBorder['brrM'] == '') {
          delete colBorder.brrM;
        }

        if (colBorder['colBorderStyle'] == '' || colBorder['colBorderStyle'] == null) {
          delete colBorder.colBorderStyle;
        }

        if (colBorder['colBorderColor'] == '' || colBorder['colBorderColor'] == 'hsv(0, 0%, 0%)') {
          delete colBorder.colBorderColor;
        }

        if (colBorder['colBorderRadius'] == '' || colBorder['colBorderRadius'] == null) {
          delete colBorder.colBorderRadius;
        }

        if (colBorder['colBorderWidth'] == '' || colBorder['colBorderWidth'] == null) {
          delete colBorder.colBorderWidth;
        }

        if (isObjectEmpty(thisColOps['colBorder'])) {
          delete thisColOps.colBorder;
        }

      }


      if (typeof(thisColOps['colBoxShadow']) != 'undefined') {

        colBoxShadow = thisColOps['colBoxShadow'];

        if (colBoxShadow['colBoxShadowH'] == '') {
          delete colBoxShadow.colBoxShadowH;
        }

        if (colBoxShadow['colBoxShadowV'] == '') {
          delete colBoxShadow.colBoxShadowV;
        }

        if (colBoxShadow['colBoxShadowBlur'] == '') {
          delete colBoxShadow.colBoxShadowBlur;
        }

        if (colBoxShadow['colBoxShadowColor'] == '' || colBoxShadow['colBoxShadowColor'] == 'hsv(0, 0%, 0%)') {
          delete colBoxShadow.colBoxShadowColor;
        }


        if (isObjectEmpty(thisColOps['colBoxShadow'])) {
          delete thisColOps.colBoxShadow;
        }

      }


      $.each(thisColOps,function(childIndex,childValue){
        if (childValue == null) {
          delete thisColOps[childIndex];
        }
        
      });

      $.each(thisColumnModelData['colWidgets'],function(index,value){

        filterDefaultWidgetOps(value);

      });

    }


    for(i = thisRowColumns; i < 12; i++){
      thisCol = parseInt(i)+1;

      if (typeof(thisRowAttrs['column'+thisCol]) != 'undefined') {
        delete thisRowAttrs['column'+thisCol];
      }

    }


  });


}

function filterDefaultWidgetOps(thisWidgetData){

  $.each(thisWidgetData,function(index,value){

    var defaultWidgetOps = pageBuilderApp.colWidgetDefaults;
    
    if(thisWidgetData[index] == defaultWidgetOps[index] || thisWidgetData[index] == ''){
      delete thisWidgetData[index];
    }

    if(thisWidgetData[index] == null){
      delete thisWidgetData[index];
    }


    if (typeof(thisWidgetData[index]) == 'object') {

      $.each(thisWidgetData[index],function(index2,value2){

        if (typeof(defaultWidgetOps[index]) != 'undefined') {
          if (thisWidgetData[index][index2] == defaultWidgetOps[index][index2] || thisWidgetData[index][index2] == '') {
            delete thisWidgetData[index][index2];
          }

          if (typeof(thisWidgetData[index][index2]) == 'object') {

            $.each(thisWidgetData[index][index2],function(index3,value3){
              if (typeof(defaultWidgetOps[index][index2]) != 'undefined') {
                if (thisWidgetData[index][index2][index3] == defaultWidgetOps[index][index2][index3] || thisWidgetData[index][index2][index3] == '') {
                  delete thisWidgetData[index][index2][index3];
                }
              }

            });


            if (isObjectEmpty(thisWidgetData[index][index2])) {
              delete thisWidgetData[index][index2];
            }

          }

        }

        if (thisWidgetData[index][index2] == null) {
          delete thisWidgetData[index][index2];
        }





      });

      if (isObjectEmpty(thisWidgetData[index])) {
        delete thisWidgetData[index];
      }

    }


  });


}

$('.SavePage').on('click',function() {

  var setFrontPage = '';
  var loadWpHead = $('.loadWpHead').attr('isChecked');
  var loadWpFooter = $('.loadWpFooter').attr('isChecked');
  var loadThemeWrapper = $('.loadThemeWrapper').attr('isChecked');
  var pageSeoName = $('#title').val();
  var pageLink = $('#editable-post-name-full').html();
  var pageSeoDescription = $('.pageSeoDescription').val();
  var pageSeoMetaTags = $('.pageSeoMetaTags').val();
  var pageSeoKeywords = $('.pageSeoKeywords').val();
  var pageBgImage = $('.pageBgImage').val();
  var pageBgColor = $('.pageBgColor').val();
  var pagePaddingTop = $('.pagePaddingTop').val();
  var pagePaddingBottom = $('.pagePaddingBottom').val();
  var pagePaddingLeft = $('.pagePaddingLeft').val();
  var pagePaddingRight = $('.pagePaddingRight').val(); 
  var pageLogoUrl = $('.pageLogoUrl').val();
  var pageFavIconUrl = $('.pageFavIconUrl').val();
  var VariantB_ID = $('.VariantB_ID').val();

  if (pageSeoName == '' || pageSeoName == 'Auto Draft') {
    $('#title').val('PluginOps Page  - '+P_ID);
    pageSeoName = $('#title').val();
  }

  var PbPageStatus = $('.PbPageStatus').val();
  var checkBtnClickedTypePublish = $(this).hasClass('publishBtn');
  if (checkBtnClickedTypePublish == true) {
    PbPageStatus = 'publish';
  }
  var checkBtnClickedTypeDraft = $(this).hasClass('draftBtn');
  if (checkBtnClickedTypeDraft == true) {
    PbPageStatus = 'draft';
  }

  var POcustomCSS = $('.POcustomCSS').val();
  var POcustomJS = $('.POcustomJS').val();

  setFrontPage = "false";
  isChecked = $('.setFrontPage').attr('isChecked');
  if (isChecked == 'true') {
    setFrontPage = "true";
  } else{
    setFrontPage = "false"; 
  }

  if (loadWpHead == 'true') {
    loadWpHead = "true";
  } else{
    loadWpHead = "false"; 
  }

  if (loadWpFooter == 'true') {
    loadWpFooter = "true";
  } else{
    loadWpFooter = "false"; 
  }

  if (loadThemeWrapper == 'true') {
    loadThemeWrapper = "true";
  } else{
    loadThemeWrapper = "false";
  }

  var POPBDefaultsEnable = $('.POPBDefaultsEnable').val();

  var POPB_typefaces =  {
    typefaceHOne:$('.typefaceHOne').val(),
    typefaceHTwo:$('.typefaceHTwo').val(),
    typefaceH3:$('.typefaceH3').val(),
    typefaceH4:$('.typefaceH4').val(),
    typefaceH5:$('.typefaceH5').val(),
    typefaceH6:$('.typefaceH6').val(),
    typefaceParagraph:$('.typefaceParagraph').val(),
    typefaceButton:$('.typefaceButton').val(),
    typefaceAnchorLink:$('.typefaceAnchorLink').val()
  };

  var POPB_typeSizes = {
    typeSizeHOne:$('.typeSizeHOne').val(),
    typeSizeHTwo:$('.typeSizeHTwo').val(),
    typeSizeParagraph:$('.typeSizeParagraph').val(),
    typeSizeButton:$('.typeSizeButton').val(),
    typeSizeAnchorLink:$('.typeSizeAnchorLink').val(),
    typeSizeHOneTablet:$('.typeSizeHOneTablet').val(),
    typeSizeHOneMobile:$('.typeSizeHOneMobile').val(),
    typeSizeHTwoTablet:$('.typeSizeHTwoTablet').val(),
    typeSizeHTwoMobile:$('.typeSizeHTwoMobile').val(),
    typeSizeH3: $('.typeSizeH3').val(),
    typeSizeH3Tablet: $('.typeSizeH3Tablet').val(),
    typeSizeH3Mobile: $('.typeSizeH3Mobile').val(),
    typeSizeH4: $('.typeSizeH4').val(),
    typeSizeH4Tablet: $('.typeSizeH4Tablet').val(),
    typeSizeH4Mobile: $('.typeSizeH4Mobile').val(),
    typeSizeH5: $('.typeSizeH5').val(),
    typeSizeH5Tablet: $('.typeSizeH5Tablet').val(),
    typeSizeH5Mobile: $('.typeSizeH5Mobile').val(),
    typeSizeH6: $('.typeSizeH6').val(),
    typeSizeH6Tablet: $('.typeSizeH6Tablet').val(),
    typeSizeH6Mobile: $('.typeSizeH6Mobile').val(),
    typeSizeParagraphTablet:$('.typeSizeParagraphTablet').val(),
    typeSizeParagraphMobile:$('.typeSizeParagraphMobile').val(),
    typeSizeButtonTablet:$('.typeSizeButtonTablet').val(),
    typeSizeButtonMobile:$('.typeSizeButtonMobile').val(),
    typeSizeAnchorLinkTablet:$('.typeSizeAnchorLinkTablet').val(),
    typeSizeAnchorLinkMobile:$('.typeSizeAnchorLinkMobile').val(),
  };

  var poCustomFonts = [];
  /*
  $('.customFontsItems li').each(function(index){
    var poCfName =  $( this ).children('.accordContentHolder').children('.poCfName').val();
    var thisListValues = {
      poCfName: $.trim( poCfName ),
      poCfFileUrlEot: $( this ).children('.accordContentHolder').children('.poCfFileUrlEot').val(),
      poCfFileUrlOtf: $( this ).children('.accordContentHolder').children('.poCfFileUrlOtf').val(),
      poCfFileUrlWoff: $( this ).children('.accordContentHolder').children('.poCfFileUrlWoff').val(),
      poCfFileUrlSvg: $( this ).children('.accordContentHolder').children('.poCfFileUrlSvg').val(),
    }
    poCustomFonts.push( thisListValues );
  });
  */


  var pageOps = {
    setFrontPage: setFrontPage,
    loadWpHead:loadWpHead,
    loadWpFooter: loadWpFooter,
    loadWpFooterTwo: loadWpFooter,
    loadThemeWrapper:loadThemeWrapper,
    pageBgImage: pageBgImage,
    pageBgColor: pageBgColor,
    pageLink: pageLink,
    pagePadding: {
      pagePaddingTop : pagePaddingTop,
      pagePaddingBottom : pagePaddingBottom,
      pagePaddingLeft : pagePaddingLeft,
      pagePaddingRight : pagePaddingRight,
    },
    pagePaddingTablet: {
      pagePaddingTopTablet : $('.pagePaddingTopTablet').val(),
      pagePaddingBottomTablet : $('.pagePaddingBottomTablet').val(),
      pagePaddingLeftTablet : $('.pagePaddingLeftTablet').val(),
      pagePaddingRightTablet : $('.pagePaddingRightTablet').val(),
    },
    pagePaddingMobile: {
      pagePaddingTopMobile : $('.pagePaddingTopMobile').val(),
      pagePaddingBottomMobile : $('.pagePaddingBottomMobile').val(),
      pagePaddingLeftMobile : $('.pagePaddingLeftMobile').val(),
      pagePaddingRightMobile : $('.pagePaddingRightMobile').val(),
    },
    pageSeoName: pageSeoName,
    pageSeoDescription: pageSeoDescription,
    pageSeoMetaTags:pageSeoMetaTags,
    pageSeoKeywords: pageSeoKeywords,
    pageLogoUrl: pageLogoUrl,
    pageFavIconUrl: pageFavIconUrl,
    pageSeofbOgImage: $('.pageSeofbOgImage').val(),
    MultiVariantTesting: {
      VariantB: $('.VariantB').val(),
      VariantC:$('.VariantC').val(),
      VariantD:$('.VariantD').val(),
    },
    POcustomCSS:POcustomCSS,
    POcustomJS:POcustomJS,
    POPBDefaults: {
      POPBDefaultsEnable : POPBDefaultsEnable,
      POPB_typefaces:POPB_typefaces ,
      POPB_typeSizes: POPB_typeSizes
    },
    bodyBackgroundType:$('.bodyBackgroundType:checked').val(),
    bodyGradient:{
      bodyGradientColorFirst: $('.bodyGradientColorFirst').val(),
      bodyGradientLocationFirst:$('.bodyGradientLocationFirst').val(),
      bodyGradientColorSecond:$('.bodyGradientColorSecond').val(),
      bodyGradientLocationSecond:$('.bodyGradientLocationSecond').val(),
      bodyGradientType:$('.bodyGradientType').val(),
      bodyGradientPosition:$('.bodyGradientPosition').val(),
      bodyGradientAngle:$('.bodyGradientAngle').val(),
    },
    bodyHoverOptions: {
      bodyBgColorHover:$('.bodyBgColorHover').val(),
      bodyBackgroundTypeHover:$('.bodyBackgroundTypeHover:checked').val(),
      bodyHoverTransitionDuration:$('.bodyHoverTransitionDuration').val(),
      bodyGradientHover:{
        bodyGradientColorFirstHover: $('.bodyGradientColorFirstHover').val(),
        bodyGradientLocationFirstHover:$('.bodyGradientLocationFirstHover').val(),
        bodyGradientColorSecondHover:$('.bodyGradientColorSecondHover').val(),
        bodyGradientLocationSecondHover:$('.bodyGradientLocationSecondHover').val(),
        bodyGradientTypeHover:$('.bodyGradientTypeHover').val(),
        bodyGradientPositionHover:$('.bodyGradientPositionHover').val(),
        bodyGradientAngleHover:$('.bodyGradientAngleHover').val(),
      }
    },
    bodyOverlayBackgroundType: $('.bodyOverlayBackgroundType:checked').val(),
    bodyOverlayGradient:{
      bodyOverlayGradientColorFirst: $('.bodyOverlayGradientColorFirst').val(),
      bodyOverlayGradientLocationFirst:$('.bodyOverlayGradientLocationFirst').val(),
      bodyOverlayGradientColorSecond:$('.bodyOverlayGradientColorSecond').val(),
      bodyOverlayGradientLocationSecond:$('.bodyOverlayGradientLocationSecond').val(),
      bodyOverlayGradientType:$('.bodyOverlayGradientType').val(),
      bodyOverlayGradientPosition:$('.bodyOverlayGradientPosition').val(),
      bodyOverlayGradientAngle:$('.bodyOverlayGradientAngle').val(),
    },
    bodyBgOverlayColor:$('.bodyBgOverlayColor').val(),
    bodyBorderType:$('.bodyBorderType').val(),
    bodyBorderWidth:$('.bodyBorderWidth').val(),
    bodyBorderColor:$('.bodyBorderColor').val(),
    bodyBorderRadius:{
      bbrt:$('.bbrt').val(),
      bbrb:$('.bbrb').val(),
      bbrl:$('.bbrl').val(),
      bbrr:$('.bbrr').val(),
    },
    poCustomFonts:poCustomFonts,
  };

  var newPermalinkUrl = siteURLpb+'/'+pageLink;
  $('#sample-permalink a').attr('href',newPermalinkUrl);

  var isEditorEnabled = $('.pb_fullScreenEditorButton');
  if (isEditorEnabled.hasClass('EditorActive')) {
    displayEditor = 'block';
  } else{
    displayEditor = 'none';
  }




  renderPageOps(pageOps, PbPageStatus);

  $('#pbWrapper').css( 'display' , displayEditor );

  try{
    filterDefaultRowOps(pageBuilderApp.rowList.models);
    filterDefaultColumnsOps(pageBuilderApp.rowList.models);
  }catch(e){
    console.log(e);
  }

  try{
    rowListModelsString = JSON.stringify(pageBuilderApp.rowList.models);
    rowListModelsString = rowListModelsString.replaceAll('<link ', '<pluginopsfont ');
    rowListModelsString = rowListModelsString.replaceAll('<style>', '<pluginopsstyle>');
    rowListModelsString = rowListModelsString.replaceAll('</style>', '</pluginopsstyle>');
    rowListModelsString = rowListModelsString.replaceAll('<script', '<pluginopsscript');
    rowListModelsString = rowListModelsString.replaceAll('</script>', '</pluginopsscript>');

    rowListModelsParsed = JSON.parse(rowListModelsString);
  }catch(e){
    console.log(e);
  }
  


  $('.pb_loader_container').slideDown(200);
  var PageStatus = pageBuilderApp.PageBuilderModel.get('pageStatus');
  pageBuilderApp.PageBuilderModel.set( 'pageID', P_ID);
  pageBuilderApp.PageBuilderModel.set( 'pageOptions', pageOps);
  pageBuilderApp.PageBuilderModel.set('pageStatus',PbPageStatus);
  pageBuilderApp.PageBuilderModel.set( 'Rows', rowListModelsParsed );

  if (PbPageStatus == 'publish') {
    if (typeof(pageBuilderApp.PageBuilderModel.get('shareOpShown')) != 'undefined') {
      shareOpShownTimes = pageBuilderApp.PageBuilderModel.get('shareOpShown');
      shareOpShownTimes++;
    }else{
      shareOpShownTimes = 1;
    }
    pageBuilderApp.PageBuilderModel.set('shareOpShown',shareOpShownTimes);
  }else{
    pageBuilderApp.PageBuilderModel.set('shareOpShown',0);
  }


  pageBuilderAppModelToJson = JSON.stringify(  pageBuilderApp.PageBuilderModel.attributes );

  $.ajax({
    url: URLL,
    type: 'post',
    dataType: 'json',
    data: {defaults:pageBuilderAppModelToJson},
  })
  .done(function(result) {

    setTimeout(function(){

      $('.pb_loader_container').css('display','none');
      if (PbPageStatus == 'publish' && pageBuilderApp.PageBuilderModel.get('shareOpShown') < 2) {
        $('.popb_post_publish_share').slideDown('slow');
        $('.popb_post_publish_share').css('display','block');
      }
      
      if (PageStatus === 'publish' || PageStatus === 'draft' || PageStatus === 'private') {

      }else{

        var pageOptions = pageBuilderApp.PageBuilderModel.get('pageOptions');
        var pageStatus = pageBuilderApp.PageBuilderModel.get('pageStatus');

      
        renderPageOps(pageOptions, pageStatus);

        var currentAttrValue = jQuery('.templatesTabEditor .pluginops-tab_link').attr('href');
 
        jQuery('.pluginops-tabs ' + currentAttrValue).show().siblings().hide();
       
        jQuery('.templatesTabEditor .pluginops-tab_link').parent('li').addClass('pluginops-active').siblings().removeClass('pluginops-active');
          
        $('.pb_fullScreenEditorButton').trigger('click');
      }

    }, 200);
    window.localStorage.removeItem('ulpbStoreDataObect_'+P_ID);
    console.log('Saved');

    pageBuilderApp.ifChangesMade = false;

  })
  .fail(function(response) {


    if (response.status == '403') {
      if (response['responseText'].includes('Wordfence')) {

        try {

          window.localStorage.setItem('ulpbStoreDataObect_'+P_ID, pageBuilderAppModelToJson);
          
          var nDoc = document.createElement('div'), nElem, length, i;
          nDoc.className = 'responseErrorContainer';
          nDoc.innerHTML = response['responseText'];
          sDocEl =  nDoc.querySelectorAll('#whitelist-form');
          sDocElScr =  nDoc.querySelectorAll('script');

          jQuery('.fullErrorMessage').html(sDocEl);
          jQuery('.fullErrorMessage').prepend('<h2 class="popb_confirm_message">Please click on Allowlist this Action to save.</2>');
          //jQuery('.fullErrorMessage').append(sDocElScr);

          jQuery('.fullErrorMessage').find('#verified-false-positive-checkbox').prop("checked", true);

          console.log(jQuery('.fullErrorMessage').find('#verified-false-positive-checkbox').checked);

          jQuery('.fullErrorMessage').find('#whitelist-button').trigger('click');

          //jQuery('.fullErrorMessage p').text('Click To View Full Error Message');
          jQuery('.fullErrorMessageInput').val(popb_errorLog.errorMsg);
        } catch (error) {
          
        }

          popb_errorLog.errorMsg = 'Wordfence Blocked Request - Please disable WordFence firewall. Visit the link below to disable it. <br>  <a href="'+admURL+'admin.php?page=WordfenceWAF&subpage=waf_options" target="_blank">Wordfence Firewall Settings</a>';
          
      }

    }
    
    if(pageBuilderApp.ifChangesMade){

      jQuery('.popb_onSaveError_popup').css('display','block');
      
      jQuery('.confirm_saveData_no').on('click',function(){
        jQuery('.popb_onSaveError_popup').css('display','none');
        location.reload();
      });

      jQuery('.confirm_saveData_yes').on('click',function(){

        window.localStorage.setItem('ulpbStoreDataObect_'+P_ID, pageBuilderAppModelToJson);

        setTimeout(function(){
          location.reload();
        }, 500);
        
      });

    }else{
      
      if (response['responseText'] != '') {

        jQuery('.popb_safemode_popup').css('display','block');

        jQuery('.confirm_safemode_no').on('click',function(){
          jQuery('.popb_safemode_popup').css('display','none');
          location.reload();
        });

        popb_errorLog.errorMsg = response['responseText'];
        popb_errorLog.errorURL = 'na';


        jQuery('.fullErrorMessage p').text('Click To View Full Error Message');
        jQuery('.fullErrorMessageInput').val(popb_errorLog.errorMsg);


        if (response.status == '403') {
          if (response['responseText'].includes('Wordfence')) {
            jQuery('.fullErrorMessage p').trigger('click');
          }
        }



        jQuery('.confirm_safemode_yes').on('click',function(){

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
      
    }
      

    if (response['responseText'] == 'Invalid Nonce') {
      alert('Nonce Expired  - Changes cannot be saved, Please reload the page.');
      $('.pb_loader_container').slideUp(200);
    }else{
      $('.pb_loader_container').slideUp(200);
    }
  })



  /*
    pageBuilderApp.PageBuilderModel.save(pageBuilderAppModelToJson,{ wait:true }).success(function(response){

      

    }).error(function(response){

      console.log(response);
      
      var result = response;

      if (response['responseText'] != '') {

        jQuery('.popb_safemode_popup').css('display','block');

        jQuery('.confirm_safemode_no').on('click',function(){
          jQuery('.popb_safemode_popup').css('display','none');
          location.reload();
        });

        popb_errorLog.errorMsg = response['responseText'];
        popb_errorLog.errorURL = 'na';

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

      if (response['responseText'] == 'Invalid Nonce') {
        alert('Nonce Expired  - Changes cannot be saved, Please reload the page.');
        $('.pb_loader_container').slideUp(200);
      }else{
        alert('Page Not Saved - Some Error Occurred! ');
        $('.pb_loader_container').slideUp(200);
      }

      

      

    });
  */

  

});




}( jQuery ) );