function ytVidURLParser(url){
  try {
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11)? match[7] : false;
  } catch(e) {
    // statements
    console.log(e);
  }
    
}

function popb_hasNumber(myString) {
  return /\d/.test(myString);
}

function mergeNonsetObjectKeys(source, target) {
    Object.keys(target).forEach(function (k) {

      if (typeof source[k] === 'undefined') {
        source[k] = target[k];
      }else{

        if (typeof(target[k]) == 'object' ) {
          Object.keys(target[k]).forEach(function (k2) {

            if (typeof source[k][k2] === 'undefined') {
              source[k][k2] = target[k][k2];
            }else{


              if (typeof(target[k][k2]) == 'object' ) {
                Object.keys(target[k][k2]).forEach(function (k3) {

                  if (typeof source[k][k2][k3] === 'undefined') {
                    source[k][k2][k3] = target[k][k2][k3];
                  }

                });
              }


            }

          });
        }

      }


    });
}

function escapeSpecChars(str) {

  if( typeof str === 'undefined') return '';

  return str
  .replace(/&/g, "")
  .replace(/</g, "")
  .replace(/>/g, "")
  .replace(/"/g, "")
  .replace(/'/g, "");
}

function bgshapessvgrender(rowID, shapeType, shapebottom, bgSTop, bgSBottom ){

  if (shapebottom == true) {
    positionID  = 'bottom';
  }else{
    positionID  = 'top';
  }

  var bgShapes = {};

  bgShapes['Mountains'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M0 0.67L1000 0.67L1000 28.35C948.48 92.11 906.33 100.75 873.55 54.29C824.38 -15.4 822.72 17.63 704.38 65.89C586.05 114.15 518.55 93.6 485.22 54.29C451.88 14.99 430.22 -16.34 271.88 54.29C166.33 101.38 75.7 99.58 0 48.91L0 0.67Z"  ></path>    <path class="po-'+positionID+'-path-'+rowID+'" style="opacity:0.66"  d="M0 0.67L1000 0.67C1048.48 28.2 1038.83 50.54 971.05 67.68C869.38 93.39 788.55 39.21 778.55 18.09C771.88 4.01 762.44 4.01 750.22 18.09C671.33 89.72 597.44 108.4 528.55 74.13C425.22 22.73 437.72 34.62 346.88 74.13C256.05 113.64 211.05 52.07 148.55 28.19C106.88 12.28 57.37 25.44 0 67.68L0 0.67Z"  ></path>        <path class="po-'+positionID+'-path-'+rowID+'"  style="opacity:0.33" d="M1000 0.67L0 0.67C-48.48 28.2 -38.83 50.54 28.95 67.68C130.62 93.39 211.45 39.21 221.45 18.09C228.12 4.01 237.56 4.01 249.78 18.09C328.67 89.72 402.56 108.4 471.45 74.13C574.78 22.73 562.28 34.62 653.12 74.13C743.95 113.64 788.95 52.07 851.45 28.19C893.12 12.28 942.63 25.44 1000 67.68L1000 0.67Z"  ></path>';
  bgShapes['MountainsAttr'] = '0 0 1000 100';

  bgShapes['Spikes'] = '<path class="po-'+positionID+'-path-'+rowID+'"  d="M315.79 0L342.11 0L329.72 100L315.79 0ZM289.47 0L315.79 0L303.4 100L289.47 0ZM131.58 0L119.19 100L105.26 0L157.89 0L145.51 100L131.58 0ZM157.89 0L184.21 0L171.82 100L157.89 0ZM0 0L26.32 0L13.93 100L0 0ZM78.95 0L66.56 100L52.63 0L40.25 96.8L26.32 0L105.26 0L92.88 100L78.95 0ZM394.74 0L421.05 0L408.67 100L394.74 0ZM368.42 0L356.04 100L342.11 0L394.74 0L382.35 100L368.42 0ZM263.16 0L250.77 96.8L236.84 0L224.46 100L210.53 0L198.14 100L184.21 0L289.47 0L277.09 100L263.16 0ZM473.68 0L461.3 100L447.37 0L434.98 100L421.05 0L500 0L487.61 100L473.68 0ZM921.06 -0.01L947.37 -0.01L934.99 99.99L921.06 -0.01ZM973.69 -0.01L1000 -0.01L987.62 99.99L973.69 -0.01ZM763.16 -0.01L750.78 96.79L736.85 -0.01L789.48 -0.01L777.09 99.99L763.16 -0.01ZM842.11 -0.01L868.43 -0.01L856.04 99.99L842.11 -0.01ZM894.74 -0.01L921.06 -0.01L908.67 99.99L894.74 -0.01ZM710.53 -0.01L736.85 -0.01L724.46 99.99L710.53 -0.01ZM552.64 -0.01L578.95 -0.01L566.57 99.99L552.64 -0.01ZM631.58 -0.01L657.9 -0.01L645.51 99.99L631.58 -0.01ZM684.22 -0.01L710.53 -0.01L698.15 99.99L684.22 -0.01ZM500 -0.01L526.32 -0.01L513.93 99.99L500 -0.01ZM657.9 -0.01L684.22 -0.01L671.83 99.99L657.9 -0.01ZM578.95 -0.01L605.27 -0.01L592.88 99.99L578.95 -0.01ZM605.27 -0.01L631.58 -0.01L619.2 99.99L605.27 -0.01ZM868.43 -0.01L894.74 -0.01L882.36 99.99L868.43 -0.01ZM789.48 -0.01L815.79 -0.01L803.41 99.99L789.48 -0.01ZM815.79 -0.01L842.11 -0.01L829.72 99.99L815.79 -0.01ZM947.37 -0.01L973.69 -0.01L961.3 99.99L947.37 -0.01ZM526.32 -0.01L552.64 -0.01L540.25 96.79L526.32 -0.01Z"></path>';
  bgShapes['SpikesAttr'] = '0 0 1000 100';

  bgShapes['Pyramids'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M0 0.46L0 11.66L117.91 75.84L241.04 11.66L416.42 93L623.13 14.64L764.93 58.67L1000 0.46L0 0.46Z"></path>';
  bgShapes['PyramidsAttr'] = '0 0 1000 100';

  bgShapes['Triangle'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M0 0L500 96.17L1000 0L0 0Z"></path>';
  bgShapes['TriangleAttr'] = '0 0 1000 100';

  bgShapes['TriangleInvert'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M0 0L1000 0L1000 100L500 0L0 100L0 0Z"></path>';
  bgShapes['TriangleInvertAttr'] = '0 0 1000 100';

  bgShapes['TriangleAssym'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M1000 0L301.49 88.06L0 0L1000 0Z"></path>';
  bgShapes['TriangleAssymAttr'] = '0 0 1000 100';

  bgShapes['TriangleAssymInvert'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M-0.74 -1.25L1000 -1.25L1000 101.25L302.17 10.99L-2.24 101.25L-0.74 -1.25Z"></path>';
  bgShapes['TriangleAssymInvertAttr'] = '0 0 1000 100';

  bgShapes['Slope'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M1000 0L1000 100L0 0L1000 0Z"></path>';
  bgShapes['SlopeAttr'] = '0 0 1000 100';

  bgShapes['FanOpaque'] = '<path class="po-'+positionID+'-path-'+rowID+'" style="opacity:0.325" d="M0 0.5L1000 0.5L1000 100.5L500 11.5L0 100.5L0 0.5Z"></path>'+
  '<path class="po-'+positionID+'-path-'+rowID+'" style="opacity:0.325" d="M0 0.5L1000 0.5L1000 71.4L500 8.3L0 71.4L0 0.5Z"></path>'+
  '<path class="po-'+positionID+'-path-'+rowID+'" style="opacity:0.325" d="M0 0.5L1000 0.5L1000 50.5L500 6L0 50.5L0 0.5Z"></path>'+
  '<path class="po-'+positionID+'-path-'+rowID+'" style="opacity:0.325" d="M0 0L1000 0L1000 30.6L500 3.37L0 30.6L0 0Z"></path>';
  bgShapes['FanOpaqueAttr'] = '0 0 1000 100';

  bgShapes['Curve'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M0 0C0 -55.69 224.04 -100.91 500 -100.91C775.96 -100.91 1000 -55.69 1000 0C1000 55.69 775.96 100.91 500 100.91C224.04 100.91 0 55.69 0 0Z"></path>';
  bgShapes['CurveAttr'] = '0 0 1000 100';

  bgShapes['CurveInvert'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M500.15 8.3C193.81 6.82 27.09 37.39 0 100L0 0L500.15 0"></path>  <path class="po-'+positionID+'-path-'+rowID+'" d="M499.85 8.3C806.19 6.82 972.91 37.39 1000 100L1000 0L499.85 0"></path>';
  bgShapes['CurveInvertAttr'] = '0 0 1000 100';

  bgShapes['Waves'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M0 -0.08L1000 -0.08L1000 77.28C944.28 11.15 873.88 2.96 788.81 52.71C661.19 127.34 597.76 100.03 382.09 52.71C238.31 21.16 110.95 26.32 0 68.18L0 -0.08Z"></path>   <path class="po-'+positionID+'-path-'+rowID+'"  style="opacity:0.45" d="M0 -0.08L1008.21 -0.08C1055.47 89.33 1014.93 112.61 886.57 69.79C694.03 5.55 601.49 24.01 389.55 59.35C248.26 82.9 118.41 70.59 0 22.41L0 -0.08Z"></path>';
  bgShapes['WavesAttr'] = '0 0 1000 100';

  bgShapes['Arrow'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M1000,650.8 1029.3,600 1058.7,549.2 1000,549.2 941.3,549.2 970.7,600 z"></path>';
  bgShapes['ArrowAttr'] = '500 550 1000 100';

  bgShapes['ArrowInvert'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M500 3.61L482.57 52.8L465.08 101.99L0 101.99L0 -1L1000 -1L1000 101.99L534.92 101.99L517.43 52.8L500 3.61Z"></path>';
  bgShapes['ArrowInvertAttr'] = '0 0 1000 100';

  bgShapes['Book'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M608.29 -48.02L623.01 -47.42L638.56 -46.57L654.93 -45.48L672.14 -44.14L690.17 -42.57L709.03 -40.75L728.72 -38.68L749.24 -36.38L770.59 -33.83L792.76 -31.04L815.77 -28.01L839.6 -24.74L864.26 -21.22L889.75 -17.46L916.07 -13.46L943.22 -9.22L971.2 -4.73L1000 0L1000 100L978.85 99.79L958.14 99.47L937.86 99.02L918.02 98.46L898.62 97.78L879.65 96.99L861.11 96.08L843.02 95.04L825.36 93.9L808.13 92.63L791.34 91.25L774.99 89.75L759.07 88.13L743.59 86.39L728.55 84.54L713.94 82.57L699.77 80.48L686.03 78.27L672.73 75.95L659.86 73.51L647.44 70.95L635.44 68.27L623.89 65.48L612.77 62.57L602.08 59.54L591.83 56.39L582.02 53.13L572.64 49.75L563.7 46.25L555.2 42.63L547.13 38.9L539.5 35.04L532.3 31.08L525.54 26.99L519.22 22.78L513.33 18.46L507.88 14.02L502.86 9.47L500 6.55L497.14 9.47L492.12 14.02L486.67 18.46L480.78 22.78L474.46 26.99L467.7 31.08L460.5 35.04L452.87 38.9L444.8 42.63L436.3 46.25L427.36 49.75L417.98 53.13L408.17 56.39L397.92 59.54L387.23 62.57L376.11 65.48L364.56 68.27L352.56 70.95L340.14 73.51L327.27 75.95L313.97 78.27L300.23 80.48L286.06 82.57L271.45 84.54L256.41 86.39L240.93 88.13L225.01 89.75L208.66 91.25L191.87 92.63L174.64 93.9L156.98 95.04L138.89 96.08L120.35 96.99L101.38 97.78L81.98 98.46L62.14 99.02L41.86 99.47L21.15 99.79L0 100L0 0L28.8 -4.73L56.78 -9.22L83.93 -13.46L110.25 -17.46L135.74 -21.22L160.4 -24.74L184.23 -28.01L207.24 -31.04L229.41 -33.83L250.76 -36.38L271.28 -38.68L290.97 -40.75L309.83 -42.57L327.86 -44.14L345.07 -45.48L361.44 -46.57L376.99 -47.42L391.71 -48.02L405.6 -48.39L418.66 -48.51L430.89 -48.39L442.29 -48.02L452.87 -47.42L462.61 -46.57L471.53 -45.48L479.62 -44.14L486.88 -42.57L493.31 -40.75L498.92 -38.68L500 -38.16L501.08 -38.68L506.69 -40.75L513.12 -42.57L520.38 -44.14L528.47 -45.48L537.39 -46.57L547.13 -47.42L557.71 -48.02L569.11 -48.39L581.34 -48.51L594.4 -48.39L608.29 -48.02Z"></path>';
  bgShapes['BookAttr'] = '0 0 1000 100';

  bgShapes['BookInvert'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M958.14 0.57L937.86 1.05L918.02 1.64L898.62 2.37L879.65 3.22L861.11 4.2L843.02 5.3L825.36 6.53L808.13 7.89L791.34 9.37L774.99 10.97L759.07 12.7L743.59 14.56L728.55 16.54L713.94 18.65L699.77 20.89L686.03 23.25L672.73 25.74L659.86 28.35L647.44 31.09L635.44 33.95L623.89 36.94L612.77 40.05L602.08 43.3L591.83 46.66L582.02 50.16L572.64 53.77L563.7 57.52L555.2 61.39L547.13 65.38L539.5 69.51L532.3 73.75L525.54 78.13L519.22 82.62L513.33 87.25L507.88 92L502.86 96.88L500 100L497.14 96.88L492.12 92L486.67 87.25L480.78 82.62L474.46 78.13L467.7 73.75L460.5 69.51L452.87 65.38L444.8 61.39L436.3 57.52L427.36 53.77L417.98 50.16L408.17 46.66L397.92 43.3L387.23 40.05L376.11 36.94L364.56 33.95L352.56 31.09L340.14 28.35L327.27 25.74L313.97 23.25L300.23 20.89L286.06 18.65L271.45 16.54L256.41 14.56L240.93 12.7L225.01 10.97L208.66 9.37L191.87 7.89L174.64 6.53L156.98 5.3L138.89 4.2L120.35 3.22L101.38 2.37L81.98 1.64L62.14 1.05L41.86 0.57L21.15 0.22L0 0L1000 0L978.85 0.22L958.14 0.57Z"></path>';
  bgShapes['BookInvertAttr'] = '0 0 1000 100';

  bgShapes['Clouds'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M1407.9,692.1c-4.6-2.9-10-4.5-15.8-4.5c-8.9,0-16.9,3.9-22.3,10.1c-8.3-9.6-20.6-15.8-34.3-15.8  c-8.4,0-16.2,2.3-23,6.3c0-0.2,0-0.3,0-0.5c0-10.6-8.6-19.2-19.2-19.2s-19.2,8.6-19.2,19.2c0,1.1,0.1,2.2,0.3,3.3  c-12.2,0.8-22.2,9.7-24.5,21.5c-3.2-2-7-3.2-11.1-3.2c-0.2,0-0.4,0-0.6,0c2.8-5.6,4.4-11.9,4.4-18.6c0-23-18.6-41.6-41.6-41.6  c-21,0-38.3,15.5-41.2,35.7c-0.1,0-0.3,0-0.4,0c-0.8,0-1.7,0-2.5,0.1c-7.6-8.6-18.7-14-31.1-14c-3.4,0-6.7,0.4-9.8,1.2  c-7.1-30.4-34.4-53.1-67-53.1c-29.3,0-54.3,18.3-64.2,44.1c-7.5-4.9-16.5-7.8-26.1-7.8c-24.3,0-44.3,18.1-47.4,41.4  c-3.3,1.1-6.4,2.5-9.3,4.3c-1.1-25.4-22.1-45.7-47.8-45.7c-9.6,0-18.5,2.8-26,7.7c-13.7-12.1-31.6-19.5-51.3-19.5  c-32.9,0-61,20.6-72.2,49.6c-4.8-2.5-10.2-3.9-16-3.9c-4.1,0-8.1,0.7-11.8,2c-6.9-16.1-22.9-27.4-41.5-27.4  c-17,0-31.8,9.4-39.5,23.3c-1.8-0.3-3.7-0.4-5.6-0.4c-15,0-27.9,8.8-33.8,21.5c-6.7-6.5-15.8-10.5-25.9-10.5  c-12.6,0-23.7,6.2-30.5,15.8V585.2h1000v66.3c-8.3-3.6-17.5-5.6-27.1-5.6C1442.8,645.9,1417.3,665.2,1407.9,692.1z"></path>';
  bgShapes['CloudsAttr'] = '500 585.2 1000 150';

  bgShapes['Skyline'] = '<path class="po-'+positionID+'-path-'+rowID+'" d="M500,512.8c1.1,0.1,2.2,0.1,3.7,0.2c0,8.5,0,16.9,0,25.4c1.3,0.1,2.3,0.2,3.5,0.2c-0.5,2.5,1.4,2.7,3.5,2.5   c1-0.1,2,0,3.2,0c0-0.8,0-1.5,0-2.1c0-7.6,0-15.3,0-22.9c0-0.7-0.2-1.4,0.1-1.9c0.3-0.5,1-1,1.6-1.2c0.6-0.2,1.4,0,2.1,0   c1.6-0.1,2.1,0.4,2.1,1.8c-0.1,6.1,0,12.3,0,18.4c0,0.6,0,1.3,0,2.1c2.9,0,5.5,0,8.4,0c0,7.5,0,14.8,0,22.1   c3.9,0.3,3.9,0.3,4.5,3.3c2.8,0,5.7,0,8.6,0c0.1-0.9,0.2-1.8,0.3-2.7c0.9-0.1,1.8-0.2,2.9-0.4c0-11.7,0-23.3,0-35.1   c4.9,0,9.4,0,14.2,0c0-2.8-0.1-5.4,0.1-8c0-0.5,0.7-1.5,1.1-1.5c3.1-0.1,6.1-0.1,9.4-0.1c0,0.8,0,1.5,0,2.1c0,6.7,0.1,13.4,0.1,20   c0,1.2,0.1,2.1,1.8,2.1c0.2,3,0.2,3,3.9,3.8c0.1,1,0.1,2.1,0.2,3.3c1.5,0,2.8,0,4.2,0c4.8,0,4.3,0.6,4.5-3.4c0-0.1,0.1-0.2,0.2-0.4   c0.6-0.1,1.3-0.2,2.2-0.3c0-9.1,0-18.1,0-27.2c6,0,11.8,0,17.8,0c0,1.3,0,2.5,0,3.7c0.5,0.1,0.8,0.1,1,0.1c3.2,0,3.2,0,3.2,2.6   c0,6.3,0,12.6,0,19c0,0.6,0,1.3,0,2c2.1,0,3.9,0.1,5.7,0c2.6-0.3,4.6,0.5,6.2,2.2c0.5,0.5,1.2,1,1.9,1.1c2.7,0.1,5.4,0,8.4,0   c0-4.7,0-9.3,0-13.9c2.5,0,4.7,0,7.1,0c0,4.1,0,8.1,0,12.4c2.2,0,4.2,0,6.1,0c0.1,1,0.2,1.7,0.3,2.6c3.4,0,6.7,0,10,0   c0.1-1.4-0.3-2.9,0.5-3.7c0.6-0.7,2.5-0.7,4.1-1c0-1.5,0-3.1,0-4.7c1.5-0.1,2.9-0.2,4.4-0.3c0-4.3,0-8.4,0-12.5   c0.5-0.1,0.7-0.1,1-0.1c3-0.1,2.9-0.1,2.8-2.5c-0.1-2.3,0-4.6,0-7c3,0,5.5,0,8,0c1.2,0,1.6,0.5,1.6,1.5c0,1.5,0,2.9,0,4.6   c1.5,0,2.9,0,4.3,0c0,0.8,0,1.4,0,1.9c0,15.7,0,31.4,0,47.1c0,3.4-0.4,2.9,3.5,3.3c0.1,0,0.2,0.1,0.6,0.3c0,0.7,0.1,1.4,0,2.2   c-0.1,1.4,0.5,1.9,2.2,1.8c3.2-0.1,6.5,0,9.7,0c1.9,0,3.8,0,6,0c0-17.6,0-35,0-52.3c4.5,0,8.8,0,13.3,0c0,3.4,0.1,6.8,0,10.1   c0,1.4,0.6,1.9,2.3,1.8c2.3-0.1,4.7,0,7.2,0c0,0.9,0,1.4,0,2c0,6.8,0,13.6,0,20.4c0,3.6,2.3,5.5,6.6,5.5c2.5,0,5.1,0.1,7.6-0.1   c1-0.1,2.3-0.4,2.8-0.9c1.5-1.6,3.2-2.2,5.6-1.9c0.5,0.1,1-0.1,1.7-0.1c0-6.1,0-12.1,0-18.2c2.4,0.4,2.8-0.7,2.7-2.1   c-0.1-0.9,0-1.8,0-2.7c0-2.4,0-4.8,0-7.3c2.2,0,4.1,0,6,0c3.1,0,3.1,0,3.1,2.5c0,20.6,0,41.3,0,61.9c0,1,0.6,2.3,1.4,3   c4.4,3.8,8.9,7.5,13.4,11.1c0.6,0.5,1.3,0.7,2.4,1.3c0-3,0-5.4,0-8.2c4.2,0,8.3,0,12.5,0c0-1,0-1.6,0-2.2c0-13.1,0-26.1,0-39.2   c0-0.4-0.1-0.9,0.1-1.2c0.3-0.4,0.8-1,1.2-1.1c1.8-0.1,3.7-0.1,5.8-0.1c0,0.8,0,1.4,0,1.9c0,4,0,8,0,12c0,1.4,3.6,5.3,5.1,5.3   c4.6,0.1,9.2,0,14,0c0-16.2,0-32.1,0-48.3c3,0,5.8,0,8.6,0c0-1.1,0-1.9,0-2.7c0-3.7,0-7.4,0.1-11.1c0-0.6,0.7-1.7,1.2-1.7   c3.9-0.1,7.7-0.1,11.8-0.1c0,2.7,0,5.2,0,7.8c1.1,0,2-0.1,2.8,0c0.8,0.1,1.9,0.2,2.3,0.6c1.5,1.7,3.4,2.2,5.8,2   c0.9-0.1,1.8,0,2.9,0c0,0.8,0.1,1.4,0.1,2c0,6.7,0,13.5,0,20.2c0,2,0.4,3.7,2.4,5c1.2,0.7,2.2,1.7,3.2,2.7c1.5,1.5,3.2,2,5.5,1.8   c2.7-0.1,5.5,0,8.2,0c3.6-0.1,3.8,0.6,3.6-3c-0.1-1.3,0.4-1.9,2.2-1.9c2.9,0.1,5.7,0,8.9,0c0-12.3,0-24.3,0-36.4   c0.2-0.1,0.4-0.1,0.6-0.2c2.1,1.7,4.1,3.4,6.2,5.1c1.3,1,2,2.1,1.9,3.6c-0.1,2,0,4,0,6.1c0.7,0.1,1.1,0.1,1.5,0.1   c3.1,0.1,3.1,0.1,3.1,2.7c0,4.1,0,8.1,0,12.2c0,3.2,0,3.2,3.7,3.8c0.1,0.9,0.1,1.9,0.2,2.9c3,0,5.7,0,8.4,0   c0.1-1.1,0.2-2.1,0.3-3.1c1.2,0,2.2-0.1,3.2,0c1.9,0.2,2.7-0.5,2.5-2c-0.2-1.5,0.3-2.7,1.7-3.6c2.7-1.8,4.5-3.8,4-6.9   c-0.3-1.6,6.6-7.7,8.5-7.7c3.9-0.1,7.9,0,12.1,0c0,2.2,0,4.2,0,6.2c1.4,0.1,2.5,0.1,3.6,0.1c0.3,2.8,0.3,2.8,3.7,2.8   c0.4,0,0.7,0,1.1,0c1.7,0.2,2.3-0.4,2.2-1.8c-0.1-2.4,0-4.7,0-7.1c3,0,5.7,0,8.7,0c0,6.3,0,12.5,0,18.8c1.5,0.1,2.6,0.1,4,0.2   c0,1.3,0,2.3,0,3.4c3,0,5.7,0,8.7,0c0-1.2,0-2.2,0-3.4c1.2-0.1,2.2-0.1,3.5-0.2c0-10.6,0-21.1,0-32.2c2.4,2,4.5,3.7,6.4,5.4   c1.2,1.1,2.5,1.9,4.5,1.6c1.5-0.2,2.2,0.5,2.1,1.8c-0.1,1.5,0,2.9,0,4.4c1.8,0.1,3.2,0.1,4.9,0.2c0,9.5,0,18.8,0,28.2   c3.1,0.3,3.1,0.3,3.1,2.8c0,1.3,0,2.6,0,3.9c0.9,0.2,1.6,0.4,2.3,0.6c0,0.8,0,1.6,0,2.4c0.2,5.6-1.3,4.9,6.1,5   c1.5,0,2.2-0.4,2.2-1.7c-0.1-1.8,0-3.5,0-5.3c1-0.2,1.7-0.3,2.5-0.4c0-2.4,0-4.8,0-7.2c1.2-0.1,2.3-0.2,3.5-0.3c0-1.9,0-3.7,0-5.6   c1.1-0.1,2-0.1,3.2-0.2c0.1-1.1,0.3-2.1,0.3-3.2c0-6.3,0.1-12.5,0-18.8c0-1.4,0.5-2.5,1.8-3.4c3.5-2.8,7.1-5.6,10.4-8.6   c2.1-1.9,4.3-1.7,6.9-1.4c0,0.8,0,1.4,0,2.1c0,5.3-0.1,10.5,0,15.8c0,1.2,0.7,2.4,1.1,3.5c0.4,1,1.2,1.9,1.2,2.8   c0.1,20.6,0.1,41.3,0,61.9c0,1.2,0.4,2.1,1.4,3c5.6,4.5,11,9.1,16.5,13.7c0.5,0.4,1.2,0.7,2,1.2c0.1-1,0.1-1.7,0.1-2.3   c0-10,0-20,0-30.1c0-13.4,0-26.7,0-40.1c0-1.5,0.4-2.2,2.4-2.1c2.3,0.1,4.6,0,7.1,0c0-3-0.1-5.8,0.1-8.5c0.1-1.1,0.7-2.1,1.2-3.1   c0.4-0.9,1.1-1.8,1.1-2.7c0.1-4.5,0-9.1,0.1-13.6c0-0.6,0.8-1.8,1.3-1.8c3.6-0.2,7.2-0.1,10.9-0.1c0,0.9,0,1.6,0,2.2   c0,5.4,0,10.9,0,16.3c0,4.2-0.2,3.3,4.1,3.6c0,0,0,0,0,0c0,0,0.1,0,0.1,0c0.1,0,0.1,0.1,0,0c0,0,0,0,0,0c0,0,0,0,0,0   c0.6,1.4,0.8,3.1,1.8,3.6c1.2,0.6,3.2,0.2,4.9,0.2c0.2,0,0.4-0.1,0.6-0.1c1.7-0.4,2.2,0.2,2.1,1.5c-0.1,1.1,0,2.2,0,3.5   c1.8,0,3.4-0.1,4.9,0c2.6,0.2,0.9,2.2,1.7,3.1c4.5,0.6,8.5,0.4,11.8-3c1.9-2,3.9-4.6,8.2-3.7c0-9.2,0-18.2,0-27.3   c2.6,0,5.1,0.1,7.5,0c2.1-0.1,2.7,0.5,2.7,2.2c-0.1,6,0,11.9,0,17.9c0,0.7,0.1,1.4,0.1,2.1c1.7,0.1,3.1,0.2,3.9,0.2   c0.7,1.2,1.1,2.6,1.8,2.7c2.4,0.3,4.8,0.1,7,0.1c0.3-1.3,0.1-2.7,0.9-3.2c0.8-0.6,2.4-0.4,3.9-0.5c0-3.9,0-7.6,0-11.4   c0.3-0.2,0.5-0.3,0.8-0.5c0.7,0.8,1.2,1.8,2.2,2.4c1.6,1.1,2.1,2.3,2.1,4c-0.1,5.4,0,10.7,0,16.1c0,1.3,0,2.6,0,4   c2.3,0,4.4,0,6.6,0c2.5,0,4.4-1.6,4.4-3.7c0-2.9,0.1-5.8,0-8.8c0-1.3,0.3-2.3,1.6-3.1c2.5-1.5,3.5-3.4,3.2-6   c-0.3-2.3-0.1-4.6-0.1-7c0-2.4,0-4.9,0-7.3c3.4,0,6.6,0,10,0c0,13.8,0,27.4,0,41c4.1,0,8.1,0,12.2,0c0-0.8,0-1.5,0-2.1   c0-4.5,0-9.1,0.1-13.6c0-2.5,0-2.5,3.1-2.5c0.8,0,1.7,0,2.7,0c0-1.2,0.1-2.2,0-3.2c-0.6-3.5,0.6-6.3,4.1-8.8c1.9-1.3,3.7-1.1,5.6-1   c1.4,0.1,3.5,2.7,3.5,3.9c0,2.3-0.1,4.7,0.1,7c0,0.5,0.6,1.3,1,1.3c3.1,0.1,6.3,0.1,9.5,0.1c0-0.7,0.2-1.1,0.1-1.5   c-0.8-3.6,0.7-6.3,4.2-8.4c2.1-1.3,3.6-3,3.1-5.4c-0.1-0.4,0.6-1.3,0.9-1.3c4.4-0.1,8.7-0.1,13.3-0.1c0,4.6,0.1,8.9,0,13.3   c0,1.6,0.6,2.2,2.6,2.1c2.9-0.1,5.8,0,8.9,0c0,3.7,0,7.2,0,10.7c5.2,0,10.2,0,15.5,0c0-5.8,0-11.5,0-17.1c3,0,5.7,0,8.6,0   c0,1.3,0,2.5,0,3.7c0,0.5-0.1,1.1,0.3,1.4c1.6,1.2,2.7,3.1,5.6,2.7c1.3-0.2,2.7,0.1,4.1,0c1.6-0.1,2.7,0.4,3.8,1.3   c0.7,0.6,1.6,1.5,2.5,1.6c2.7,0.2,5.4,0.1,8.4,0.1c0-5.9,0-11.6,0-17.3c3,0,5.7,0,8.6,0c0,0.7,0,1.3,0,1.9c0,4.1,0.1,8.1,0,12.2   c0,1.2,0.4,1.6,1.9,1.6c1.8-0.1,3.7,0,5.6,0c0,0.9,0,1.5,0,2.1c-0.1,1.4,0.5,2.1,2.4,1.9c1.9-0.1,3.7-0.1,5.6,0   c1.5,0.1,2-0.4,2-1.7c-0.1-4,0-8,0-12c0-1.9,0-3.9,0-6c2.7,0,5.1-0.1,7.6,0.1c0.5,0,1.4,0.8,1.4,1.2c0.2,1.8,0.2,3.7,0.1,5.5   c-0.1,1.7,0.5,3,1.8,4.2c0.6,0.6,0.9,1.6,1,2.4c0.1,5.3,0,10.6,0.1,15.9c0,0.6,0,1.3,0,1.9c3.6,0,6.9,0,10.4,0c0-5.9,0-11.7,0-17.7   c2.3,0,4.5,0,6.6,0c3.6-0.1,6-2.1,6-5c0-3,0-6,0-9c0-1.3,0-2.7,0-4.1c2,0,3.7,0,5.6,0c0,9.9,0,19.5,0,29.3c4.1,0,8,0,11.9,0   c1.4,0,1.4-0.7,1.4-1.6c0-3.4,0-6.8,0-10.2c0-1.3,0-2.6,0-4c2.5,0,4.7,0,7.2,0c0-5.7,0-11.3,0-16.9c6.5,0,12.7,0,19.2,0   c0,16,0,31.8,0,47.8c1.9,0,3.5,0,5.2,0c0.1,1.1,0.2,2.1,0.3,3.1c1.8,0,3.5,0,5.2,0c0.1-0.9,0.2-1.6,0.3-2.4   c1.2-0.1,2.3-0.1,3.6-0.2c0-8.2,0-16.3,0-24.3c3.3,0,6.2,0,9.4,0c0,1.9-0.1,3.6,0.1,5.3c0.1,0.8,0.6,1.6,1.2,2.3   c2.5,2.9,6,1.5,9.4,1.7c0-0.9,0-1.5,0-2.2c0-7.8,0-15.5,0-23.3c0-1-0.1-2.1,1.8-2c1.9,0,1.7,1,1.8,2.1c0.1,1.2,0,2.6,0.8,3.6   c1.5,1.8,3.3,3.5,6.5,3c0.2,0,0.5,0.1,1,0.2c0,0.6,0,1.2,0,1.8c0,5.6,0.3,11.2-0.1,16.8c-0.2,3.6,0.9,6.4,4.5,8.4   c0.7,0.4,1.3,1.4,2,1.4c2.5,0.2,5.1,0.1,7.8,0.1c0-0.9,0-1.7,0-2.4c0-10,0-19.9,0-29.9c0-3-0.1-6.1,0.1-9.1c0-0.6,0.7-1.7,1.1-1.7   c3.6-0.1,7.3-0.1,11.1-0.1c0,7.6,0,14.8,0,22.1c3.8,0,7.4,0,11,0c0-10.9,0-21.8,0-32.7H500C500,505.8,500,509.3,500,512.8z    M1091.7,534.8C1091.8,534.9,1091.9,534.9,1091.7,534.8C1091.7,534.8,1091.7,534.8,1091.7,534.8   C1091.7,534.8,1091.7,534.8,1091.7,534.8C1091.7,534.8,1091.7,534.8,1091.7,534.8C1091.7,534.8,1091.7,534.8,1091.7,534.8z"></path>';
  bgShapes['SkylineAttr'] = '500 502.3 1000 115';

  bgShapes['none'] = '';
  bgShapes['noneAttr'] = '';

  invertTransform = '';
  if (shapeType == 'random' ) {
    invertTransform = 'transform:rotate(180deg);  -ms-transform:rotate(180deg);  -webkit-transform:rotate(180deg);';
  }

  var selectedShape =  bgShapes[shapeType];
  var vieBoxAttrName = shapeType+'Attr';
  vieBoxAttr = bgShapes[vieBoxAttrName];

  renderredHTML = '';
  returnScripts = '';
  if (bgSTop != 'false') {
        bgShapeTop = '';
        isFlipped = '';
        if (bgSTop['rbgstFlipped'] == 'true') {
          isFlipped = 'transform:rotateY(180deg);  -ms-transform:rotateY(180deg);  -webkit-transform:rotateY(180deg);';
        }
        bgShapeTop = selectedShape;

        if (bgSTop['rbgstType'] == 'none') {
          bgShapeTop = '';
        }
        onFront = '';
        if (bgSTop['rbgstFront'] == 'true') {
          onFront = 'z-index:2;'; 
        }

        if (bgShapeTop != '') {

          renderredHTML = 
          '<div class="bgShapes bgShapeTop-'+rowID+'"  style="overflow: hidden; position: absolute; left: 0; width: 100%; direction: ltr; top: -2px; text-align:center; '+onFront+' '+invertTransform+' ">'+
              '<svg xmlns="http://www.w3.org/2000/svg" viewBox="'+vieBoxAttr+'" preserveAspectRatio="none" style="width: calc('+bgSTop['rbgstWidth']+'% + 1.5px); height: '+bgSTop['rbgstHeight']+'px;  position: relative; '+isFlipped+'" >'+
              bgShapeTop+
            '</svg>'+
          ' <style>  .po-top-path-'+rowID+' { fill:'+bgSTop['rbgstColor']+'; } </style> </div>  ';
          if (bgSTop['rbgstWidtht'] == '') {
            bgSTop['rbgstWidtht'] = bgSTop['rbgstWidth'];
          }
          if (bgSTop['rbgstWidthm'] == '') {
            bgSTop['rbgstWidthm'] = bgSTop['rbgstWidth'];
          }
          var currbgShapeSizeDefaultTop  = ''+
            '<script>'+
            "jQuery('.responsiveBtn').on('click',function(){"+
            " if (jQuery(this).hasClass('rbt-l') ) { "+
            "  jQuery('.bgShapeTop-"+rowID+" svg').css({'width':'"+bgSTop['rbgstWidth']+'.095'+"%', 'height':'"+bgSTop['rbgstHeight']+"px' });"+
            
            " }"+
            "});"+
            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-l' ) { "+
            "  jQuery('.bgShapeTop-"+rowID+" svg').css({'width':'"+bgSTop['rbgstWidth']+'.095'+"%', 'height':'"+bgSTop['rbgstHeight']+"px' });"+
            "}"+
            " "+
            '</script> ';

          var currbgShapeSizeTabletTop  = ''+
            '<script>'+
            "jQuery('.responsiveBtn').on('click',function(){"+
            " if (jQuery(this).hasClass('rbt-m') ) { "+
            "  jQuery('.bgShapeTop-"+rowID+" svg').css({'width':'"+bgSTop['rbgstWidtht']+'.095'+"%', 'height':'"+bgSTop['rbgstHeightt']+"px' });"+
            
            " }"+
            "});"+
            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-m' ) { "+
            "  jQuery('.bgShapeTop-"+rowID+" svg').css({'width':'"+bgSTop['rbgstWidtht']+'.095'+"%', 'height':'"+bgSTop['rbgstHeightt']+"px' });"+
            "}"+
            " "+
            '</script> ';

          var currbgShapeSizeMobileTop  = ''+
            '<script>'+
            "jQuery('.responsiveBtn').on('click',function(){"+
            " if (jQuery(this).hasClass('rbt-s') ) { "+
            "  jQuery('.bgShapeTop-"+rowID+" svg').css({'width':'"+bgSTop['rbgstWidthm']+'.095'+"%', 'height':'"+bgSTop['rbgstHeightm']+"px' });"+
            
            " }"+
            "});"+
            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-s' ) { "+
            "  jQuery('.bgShapeTop-"+rowID+" svg').css({'width':'"+bgSTop['rbgstWidthm']+'.095'+"%', 'height':'"+bgSTop['rbgstHeightm']+"px' });"+
            "}"+
            " "+
            '</script> ';

         returnScripts = currbgShapeSizeDefaultTop + currbgShapeSizeTabletTop + currbgShapeSizeMobileTop;

        }
  }

  if (bgSBottom != 'false') {
        bgShapeBottom = '';
        isFlipped = '';
        if (bgSBottom['rbgsbFlipped'] == 'true') {
          isFlipped = 'transform:rotateY(180deg);  -ms-transform:rotateY(180deg);  -webkit-transform:rotateY(180deg);';
        }

        bgShapeBottom = selectedShape;

        if (bgSBottom['rbgsbType'] == 'none') {
          bgShapeBottom = '';
        }

        onFront = '';
        if (bgSBottom['rbgsbFront'] == 'true') {
          onFront = 'z-index:2;'; 
        }
        if (bgShapeBottom != '') {

          if ( shapeType == 'random') {
            invertTransform = 'transform:rotate(0); -ms-transform:rotateY(0);  -webkit-transform:rotateY(0);';
          }

          renderredHTML = '<div class="bgShapes bgShapeBottom-'+rowID+'"  style="overflow: hidden; position: absolute; left: 0; width: 100%; direction: ltr; bottom: -2px; transform: rotate(180deg); -ms-transform:rotate(180deg);  -webkit-transform:rotate(180deg); text-align:center; '+onFront+' '+invertTransform+' ">'+
              '<svg xmlns="http://www.w3.org/2000/svg" viewBox="'+vieBoxAttr+'" preserveAspectRatio="none" style="width: calc('+bgSBottom['rbgsbWidth']+'% + 1.5px); height: '+bgSBottom['rbgsbHeight']+'px;  position: relative; '+isFlipped+'" >'+
              bgShapeBottom+
            '</svg>'+
          '  <style>  .po-bottom-path-'+rowID+' { fill:'+bgSBottom['rbgsbColor']+'; } </style>   </div> ';

          if (bgSBottom['rbgsbWidtht'] == '') {
            bgSBottom['rbgsbWidtht'] = bgSBottom['rbgsbWidth'];
          }
          if (bgSBottom['rbgsbWidthm'] == '') {
            bgSBottom['rbgsbWidthm'] = bgSBottom['rbgsbWidth'];
          }

          var currbgShapeSizeDefaultBottom  = ''+
            '<script>'+
            "jQuery('.responsiveBtn').on('click',function(){"+
            " if (jQuery(this).hasClass('rbt-l') ) { "+
            "  jQuery('.bgShapeBottom-"+rowID+" svg').css({'width':'"+bgSBottom['rbgsbWidth']+'.095'+"%', 'height':'"+bgSBottom['rbgsbHeight']+"px' });"+
            
            " }"+
            "});"+
            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-l' ) { "+
            "  jQuery('.bgShapeBottom-"+rowID+" svg').css({'width':'"+bgSBottom['rbgsbWidth']+'.095'+"%', 'height':'"+bgSBottom['rbgsbHeight']+"px' });"+
            "}"+
            " "+
            '</script> ';

          var currbgShapeSizeTabletBottom  = ''+
            '<script>'+
            "jQuery('.responsiveBtn').on('click',function(){"+
            " if (jQuery(this).hasClass('rbt-m') ) { "+
            "  jQuery('.bgShapeBottom-"+rowID+" svg').css({'width':'"+bgSBottom['rbgsbWidtht']+'.095'+"%', 'height':'"+bgSBottom['rbgsbHeightt']+"px' });"+
            
            " }"+
            "});"+
            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-m' ) { "+
            "  jQuery('.bgShapeBottom-"+rowID+" svg').css({'width':'"+bgSBottom['rbgsbWidtht']+'.095'+"%', 'height':'"+bgSBottom['rbgsbHeightt']+"px' });"+
            "}"+
            " "+
            '</script> ';

          var currbgShapeSizeMobileBottom  = ''+
            '<script>'+
            "jQuery('.responsiveBtn').on('click',function(){"+
            " if (jQuery(this).hasClass('rbt-s') ) { "+
            "  jQuery('.bgShapeBottom-"+rowID+" svg').css({'width':'"+bgSBottom['rbgsbWidthm']+'.095'+"%', 'height':'"+bgSBottom['rbgsbHeightm']+"px' });"+
            
            " }"+
            "});"+
            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-s' ) { "+
            "  jQuery('.bgShapeBottom-"+rowID+" svg').css({'width':'"+bgSBottom['rbgsbWidthm']+'.095'+"%', 'height':'"+bgSBottom['rbgsbHeightm']+"px' });"+
            "}"+
            " "+
            '</script> ';

          returnScripts = currbgShapeSizeDefaultBottom + currbgShapeSizeTabletBottom + currbgShapeSizeMobileBottom ;

        }

  }

  returnArray = {
    html:renderredHTML,
    scripts: returnScripts,
  }
 
 return returnArray;   
}


function sendGlobalRowDataToDb(globalRowAttrToSet,askGlobalRowName){

  globalRowAttrToSet['globalRowTitle'] = askGlobalRowName;
  
  var encodedglobalRowAttrToSet = JSON.stringify(globalRowAttrToSet);

  jQuery.ajax({
      url: admURL+'/admin-ajax.php?action=ulpb_insert_global_row_content&POPB_GRI_Nonce='+shortCodeRenderWidgetNO,
      method: 'post',
      data:  encodedglobalRowAttrToSet,
      contentType: "application/json",
      success: function(result){
        jQuery('.globalRowRetrievedPostID').val(result);
      },
      async:false
  });


}

function getGlobalRowDataFromDb(globalRowID){
  jQuery.ajax({
      url: admURL+'/admin-ajax.php?action=ulpb_get_global_row_content&POPB_GRG_Nonce='+shortCodeRenderWidgetNO,
      method: 'post',
      data:{  globalRowID:globalRowID },
      success: function(result){
        jQuery('.globalRowRetrievedAttributes').val(result);
      },
      async:false
  });

}

function subscribeFormWidgetRender(this_widget){
            var formLayout = this_widget['formLayout'];
            var showNameField = this_widget['showNameField'];
            var successAction = this_widget['successAction'];
            var successURL = this_widget['successURL'];
            var successMessage = this_widget['successMessage'];
            var formBtnText = this_widget['formBtnText'];
            var formBtnHeight = this_widget['formBtnHeight'];
            var formBtnWidth = this_widget['formBtnWidth'];
            var formBtnBgColor = this_widget['formBtnBgColor'];
            var formBtnColor = this_widget['formBtnColor'];
            var formBtnHoverBgColor = this_widget['formBtnHoverBgColor'];
            var formBtnFontSize = this_widget['formBtnFontSize'];
            var formBtnBorderWidth = this_widget['formBtnBorderWidth'];
            var formBtnBorderColor = this_widget['formBtnBorderColor'];
            var formBtnBorderRadius = this_widget['formBtnBorderRadius'];

            formBtnFontFamily = ' ';
            if (typeof(this_widget['formBtnFontFamily']) != 'undefined') {
              var formBtnFontFamily = this_widget['formBtnFontFamily'];
            }


            formBtnFontFamily = formBtnFontFamily.replace(/\+/g, ' ');
            if (popb_hasNumber(formBtnFontFamily)) {
              formBtnFontFamily = '"'+formBtnFontFamily+'"';
            }

            formSuccessMessageColor = '#333';
            if (typeof(this_widget['formSuccessMessageColor']) != 'undefined') {
              var formSuccessMessageColor = this_widget['formSuccessMessageColor'];
            }

            formBtnHeightTablet = ' '; formBtnHeightMobile = ' '; formBtnFontSizeTablet = ' '; formBtnFontSizeMobile = ' ';
            if (typeof(this_widget['formBtnHeightTablet']) != 'undefined') {
              var formBtnHeightTablet = this_widget['formBtnHeightTablet'];
              var formBtnHeightMobile = this_widget['formBtnHeightMobile'];

              var formBtnFontSizeTablet = this_widget['formBtnFontSizeTablet'];
              var formBtnFontSizeMobile = this_widget['formBtnFontSizeMobile'];
            }

              formbtnIcon = ''; formbtnIconBefore = ''; formbtnIconAfter = ''; formbtnIconAnimation = '';
              if (typeof(this_widget['formbtnSelectedIcon']) != 'undefined') {
                formbtnSelectedIcon = this_widget['formbtnSelectedIcon'];
                formbtnIconPosition = this_widget['formbtnIconPosition'];
                formbtnIconAnimation = this_widget['formbtnIconAnimation'];
                formbtnIconGap = this_widget['formbtnIconGap'];

                if (formbtnSelectedIcon != '') {
                  if (formbtnIconPosition == 'before') {
                    formbtnIconGap = 'margin-right:'+formbtnIconGap+'px;';
                  }else{
                    formbtnIconGap = 'margin-left:'+formbtnIconGap+'px;';
                  }

                  if (typeof(formbtnSelectedIcon) == 'undefined') { formbtnSelectedIcon = ' '; }
                  if (formbtnSelectedIcon == '') { formbtnSelectedIcon = ' '; }
                  faClassAppend = 'fa';
                  if (formbtnSelectedIcon.indexOf("fab") >= 0 || formbtnSelectedIcon.indexOf("fas") >= 0 || formbtnSelectedIcon.indexOf("far") >= 0)  {
                    faClassAppend = '';
                  }

                  formbtnIcon = '<i style="'+formbtnIconGap+'" class="'+faClassAppend+' '+formbtnSelectedIcon+'"></i>';
                }else{
                  formbtnIcon = '';
                }

                if (formbtnIconPosition == 'before') {
                  formbtnIconBefore = formbtnIcon;
                  formbtnIconAfter = '';
                }else{
                  formbtnIconAfter = formbtnIcon;
                  formbtnIconBefore = '';
                }
              }

            var formLayoutAction = " ";
            var formFieldWidth = '60%';
            var formButtonWidth = '30%';
            if (showNameField  == 'block'){ formFieldWidth = '35%' }
            if (showNameField  == 'block' && formLayout  == 'inline' ){ showNameField = 'inline-block'; formButtonWidth = '25%'}
            if (formLayout  == 'stacked') { formLayoutAction = "<br>"; formFieldWidth = '99.9%';formButtonWidth = '99.9%'; }

            var inputNameStyles = "display:"+showNameField+"; width:"+formFieldWidth+"; padding: "+formBtnHeight+"px 5px; font-size:"+formBtnFontSize+"px;";
            var inputEmailStyles = "width:"+formFieldWidth+"; padding: "+formBtnHeight+"px 5px; font-size:"+formBtnFontSize+"px;";
            var inputButtonStyles = "width:"+formButtonWidth+"; padding: "+formBtnHeight+"px "+'5px'+"; font-size:"+formBtnFontSize+"px; background:"+formBtnBgColor+"; color:"+formBtnColor+"; border: "+formBtnBorderWidth+"px solid "+formBtnBorderColor+" !important; border-radius: "+formBtnBorderRadius+"px !important;  font-family:"+formBtnFontFamily+";   ";

            var this_widget_form_inputName = "<input type='text'  placeholder='Your name' style='"+inputNameStyles+"' >"+formLayoutAction;
            var this_widget_form_inputEmail = "<input type='text' placeholder='Your e-mail' style='"+inputEmailStyles+"' >"+formLayoutAction;
            var this_widget_form_inputSubmit = "<button type='submit'  style='"+inputButtonStyles+"' class='btnField' disabled> "+formbtnIconBefore+" "+formBtnText+" "+formbtnIconAfter+" </button>";

            var uniqueFormId = 'pbSubscribe'+Math.floor((Math.random() * 2000) + 100);
            var this_widget_form = "<form id='"+uniqueFormId+"'> "+this_widget_form_inputName+" "+this_widget_form_inputEmail+" "+this_widget_form_inputSubmit+" </form>";

            var currWidgetDefaultResponsive  = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+
              " if (jQuery(this).hasClass('rbt-l') ) { "+

              "  jQuery('#"+uniqueFormId+" input, #"+uniqueFormId+" button').animate({'font-size':'"+formBtnFontSize+"px',  'padding-top':'"+formBtnHeight+"px', 'padding-bottom':'"+formBtnHeight+"px',  }); "+
              

              "}"+
              
              " });"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-l' ) { "+

              "  jQuery('#"+uniqueFormId+" input, #"+uniqueFormId+" button').animate({'font-size':'"+formBtnFontSize+"px',  'padding-top':'"+formBtnHeight+"px', 'padding-bottom':'"+formBtnHeight+"px',  }); "+
              
              "}"+
              " "+
              '</script> ';

            var currWidgetTabletResponsive  = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+
              " if (jQuery(this).hasClass('rbt-m') ) { "+

              "  jQuery('#"+uniqueFormId+" input, #"+uniqueFormId+" button').animate({'font-size':'"+formBtnFontSizeTablet+"px',  'padding-top':'"+formBtnHeightTablet+"px', 'padding-bottom':'"+formBtnHeightTablet+"px',  }); "+
              

              "}"+
              
              " });"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-m' ) { "+

              "  jQuery('#"+uniqueFormId+" input, #"+uniqueFormId+" button').animate({'font-size':'"+formBtnFontSizeTablet+"px',  'padding-top':'"+formBtnHeightTablet+"px', 'padding-bottom':'"+formBtnHeightTablet+"px',  }); "+
              
              "}"+
              " "+
              '</script> ';

            var currWidgetMobileResponsive  = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+
              " if (jQuery(this).hasClass('rbt-s') ) { "+

              "  jQuery('#"+uniqueFormId+" input, #"+uniqueFormId+" button').animate({'font-size':'"+formBtnFontSizeMobile+"px',  'padding-top':'"+formBtnHeightMobile+"px', 'padding-bottom':'"+formBtnHeightMobile+"px',  }); "+

              "}"+
              
              " });"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-s' ) { "+

              "  jQuery('#"+uniqueFormId+" input, #"+uniqueFormId+" button').animate({'font-size':'"+formBtnFontSizeMobile+"px',  'padding-top':'"+formBtnHeightMobile+"px', 'padding-bottom':'"+formBtnHeightMobile+"px',  }); "+
              
              "}"+
              " "+
              '</script> ';

              var thisRenderredWidget = {
                WidgetHtml: this_widget_form,
                WidgetScript: currWidgetDefaultResponsive + currWidgetTabletResponsive + currWidgetMobileResponsive,
              }
            return thisRenderredWidget;
}

function postsSliderWidgetRender(this_widget_postsSlider){
  
  var psAutoplay = this_widget_postsSlider['psAutoplay'];
  var psSlideDelay = this_widget_postsSlider['psSlideDelay'];
  var psSlideLoop = this_widget_postsSlider['psSlideLoop'];
  var psSlideTransition = this_widget_postsSlider['psSlideTransition'];
  var psPostsNumber = this_widget_postsSlider['psPostsNumber'];
  var psDots = this_widget_postsSlider['psDots'];
  var psArrows = this_widget_postsSlider['psArrows'];
  var psFtrImage = this_widget_postsSlider['psFtrImage'];
  var psFtrImageSize = this_widget_postsSlider['psFtrImageSize'];
  var psExcerpt = this_widget_postsSlider['psExcerpt'];
  var psReadMore = this_widget_postsSlider['psReadMore'];
  var psMoreLinkText = this_widget_postsSlider['psMoreLinkText'];
  var psHeadingSize = this_widget_postsSlider['psHeadingSize'];
  var psTextAlignment = this_widget_postsSlider['psTextAlignment'];
  var psBgColor = this_widget_postsSlider['psBgColor'];
  var psTxtColor = this_widget_postsSlider['psTxtColor'];
  var psHeadingTxtColor = this_widget_postsSlider['psHeadingTxtColor'];
  var psPostType = this_widget_postsSlider['psPostType'];
  var psPostsOrderBy = this_widget_postsSlider['psPostsOrderBy'];
  var psPostsOrder = this_widget_postsSlider['psPostsOrder'];
  var psPostsFilterBy = this_widget_postsSlider['psPostsFilterBy'];
  var psFilterValue = this_widget_postsSlider['psFilterValue'];

  function PShexToRGB(col, amt) {
  
    var usePound = false;
  
    if (col[0] == "#") {
        col = col.slice(1);
        usePound = true;
    }
 
    var num = parseInt(col,16);
 
    var r = (num >> 16) + amt;
 
    if (r > 255) r = 255;
    else if  (r < 0) r = 0;
 
    var b = ((num >> 8) & 0x00FF) + amt;
 
    if (b > 255) b = 255;
    else if  (b < 0) b = 0;
 
    var g = (num & 0x0000FF) + amt;
 
    if (g > 255) g = 255;
    else if (g < 0) g = 0;
 
    return (usePound?"#":"") + (g | (b << 8) | (r << 16)).toString(16);
  
  }

  switch(psFtrImageSize){
    case 'thumbnail':
    psFtrImageSizes = '150x150';
    break;
    case 'medium':
    psFtrImageSizes = '300x200';
    break;
    case 'large':
    psFtrImageSizes = '750x500';
    break;
    default:
    psFtrImageSizes = '750x700';
    break;
  }

  if (psDots == 'false') {
    psDots = 'none';
  }
  if (psArrows == 'false') {
    psArrows = 'none';
  }

  var DotColor = PShexToRGB(psBgColor, -40);
  var PSliderHeading = '<h3 style="color:'+psHeadingTxtColor+'; font-size:'+psHeadingSize+'px; text-align:'+psTextAlignment+'; ">Hello World!</h3>';
  var PSliderReadMore = '<a  style="display:'+psReadMore+';"> '+psMoreLinkText+' </a>';
  var PSliderExcerpt = '<p style="display:'+psExcerpt+'; text-align:'+psTextAlignment+';color:'+psTxtColor+'; font-size:'+((psHeadingSize/2)+1)+'px;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  '+PSliderReadMore+'</p>';
  var PSliderFtrImage = '<br style="display:'+psFtrImage+';"><img src="http://placehold.it/'+psFtrImageSizes+'" style="display:'+psFtrImage+';"><br style="display:'+psFtrImage+';">';
  var PSliderDots = '<br style="display:'+psDots+';"><br style="display:'+psDots+';"><div style="display:'+psDots+'; margin:0 auto; width:10px; height:10px; border-radius:100px; background:'+DotColor+';"></div>';
  var PSliderArrows = '<br style="display:'+psArrows+';"><div style="display:'+psArrows+'; margin:0 auto;" ><span class="dashicons dashicons-arrow-left-alt2" style="color:'+DotColor+'; margin:5px; font-size:40px;"></span> <span class="dashicons dashicons-arrow-right-alt2" style="color:'+DotColor+'; margin:5px; font-size:40px;"></span> </div>';


  var PSlider = '<div style="background:'+psBgColor+'; text-align:'+psTextAlignment+'; width:95%; margin: 0 auto; padding:0.1% 0 2% 0;">'+PSliderFtrImage+PSliderHeading+PSliderExcerpt+PSliderDots+PSliderArrows+'</div>';

              var thisRenderredWidget = {
                WidgetHtml: PSlider,
                WidgetScript: ' ',
              }
  return thisRenderredWidget;

}

function cardWidgetRender(this_widget_card, j, rowID,this_column,this_column_type){
  
  var pbSelectedCardIcon = this_widget_card['pbSelectedCardIcon'];
  var pbCardIconSize = this_widget_card['pbCardIconSize'];
  var pbCardIconRotation = this_widget_card['pbCardIconRotation'];
  var pbCardIconColor = this_widget_card['pbCardIconColor'];
  var pbCardTitleColor = this_widget_card['pbCardTitleColor'];
  var pbCardTitleSize = this_widget_card['pbCardTitleSize'];
  var pbCardDescColor = this_widget_card['pbCardDescColor'];
  var pbCardDescSize = this_widget_card['pbCardDescSize'];
  var pbCardTitle = this_widget_card['pbCardTitle'];
  var pbCardDesc = this_widget_card['pbCardDesc'];

  pbWidgetCardId = 'pb_card_'+Math.floor((Math.random() * 2000) + 100);

  var currCardWidgetDefaultResponsive  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-l') ) { "+

        "  jQuery('#"+pbWidgetCardId+" h2').animate({'font-size':'"+pbCardTitleSize+"px',}); "+
        "  jQuery('#"+pbWidgetCardId+" p').animate({'font-size':'"+pbCardDescSize+"px',}); "+
        "}"+
        
        " });"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-l' ) { "+

        "  jQuery('#"+pbWidgetCardId+" h2').animate({'font-size':'"+pbCardTitleSize+"px',}); "+
        "  jQuery('#"+pbWidgetCardId+" p').animate({'font-size':'"+pbCardDescSize+"px',}); "+
        
        "}"+
        " "+
        '</script> ';


      currCardWidgetResponsiveScripts = '\n' + currCardWidgetDefaultResponsive;
      if (typeof( this_widget_card['pbCardTitleSizeTablet']) !== 'undefined' ) {

        var currCardWidgetDefaultResponsiveTablet  = ''+
          '<script>'+
          "jQuery('.responsiveBtn').on('click',function(){"+
          " if (jQuery(this).hasClass('rbt-m') ) { "+

          "  jQuery('#"+pbWidgetCardId+" h2').animate({'font-size':'"+this_widget_card['pbCardTitleSizeTablet']+"px',}); "+
          "  jQuery('#"+pbWidgetCardId+" p').animate({'font-size':'"+this_widget_card['pbCardDescSizeTablet']+"px',}); "+
          "}"+
          
          " });"+
          "var currentVPS = jQuery('.currentViewPortSize').val();"+
          "if ( currentVPS == 'rbt-m' ) { "+

          "  jQuery('#"+pbWidgetCardId+" h2').animate({'font-size':'"+this_widget_card['pbCardTitleSizeTablet']+"px',}); "+
          "  jQuery('#"+pbWidgetCardId+" p').animate({'font-size':'"+this_widget_card['pbCardDescSizeTablet']+"px',}); "+
          
          "}"+
          " "+
          '</script> ';

        var currCardWidgetDefaultResponsiveMobile  = ''+
          '<script>'+
          "jQuery('.responsiveBtn').on('click',function(){"+
          " if (jQuery(this).hasClass('rbt-s') ) { "+

          "  jQuery('#"+pbWidgetCardId+" h2').animate({'font-size':'"+this_widget_card['pbCardTitleSizeMobile']+"px',}); "+
          "  jQuery('#"+pbWidgetCardId+" p').animate({'font-size':'"+this_widget_card['pbCardDescSizeMobile']+"px',}); "+
          "}"+
          
          " });"+
          "var currentVPS = jQuery('.currentViewPortSize').val();"+
          "if ( currentVPS == 'rbt-s' ) { "+

          "  jQuery('#"+pbWidgetCardId+" h2').animate({'font-size':'"+this_widget_card['pbCardTitleSizeMobile']+"px',}); "+
          "  jQuery('#"+pbWidgetCardId+" p').animate({'font-size':'"+this_widget_card['pbCardDescSizeMobile']+"px',}); "+
          
          "}"+
          " "+
          '</script> ';

        currCardWidgetResponsiveScripts = '\n' + currCardWidgetDefaultResponsive + '\n' + currCardWidgetDefaultResponsiveTablet + '\n' + currCardWidgetDefaultResponsiveMobile;

      }

  var cardWidgetIconStyles = 'transform: rotate('+pbCardIconRotation+ 'deg);  -ms-transform:rotate('+pbCardIconRotation+ 'deg);  -webkit-transform:rotate('+pbCardIconRotation+ 'deg); color:'+pbCardIconColor+'; font-size:'+pbCardIconSize+'px;';

  var cardWidgetIcon = '<i class="'+pbSelectedCardIcon+'" style="'+cardWidgetIconStyles+'" ></i>';

  var cardTitleSaveTrigger = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-fieldName='pbCardTitle' data-fieldIndex='0' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";

    if ( pbCardTitle.includes('defaultELt') ) {
    }else{
      pbCardTitle = "<span class='elLtWrapped defaultELt' >  " +pbCardTitle+ " </span> <div class='ltwFontScript' style='display:none;'></div>";
    }

  var pbCardTitle = cardTitleSaveTrigger + " <div class='wltControls' style='display:none;'></div> <div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'>  <span contenteditable='true' class='eltEditable' >  "+pbCardTitle+" </span> </div>  ";

  var cardWidgetHeading = '<h2 style="color:'+pbCardTitleColor+'; font-size:'+pbCardTitleSize+'px !important;">'+pbCardTitle+'</h2>';



  var cardDescSaveTrigger = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-fieldName='pbCardDesc' data-fieldIndex='0' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";

    if ( pbCardDesc.includes('defaultELt') ) {
    }else{
      pbCardDesc = "<span class='elLtWrapped defaultELt' >  " +pbCardDesc+ " </span> <div class='ltwFontScript' style='display:none;'></div>";
    }

  var pbCardDesc = cardDescSaveTrigger + " <div class='wltControls' style='display:none;'></div> <div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'>  <span contenteditable='true' class='eltEditable' >  "+pbCardDesc+" </span> </div>  ";

  var cardWidgetDesc = '<p style="color:'+pbCardDescColor+'; font-size:'+pbCardDescSize+'px;">'+pbCardDesc+'</p>';

  var cardWidgetHTML = '<div style="text-align:center;padding:3%;" id="'+pbWidgetCardId+'">'+cardWidgetIcon + cardWidgetHeading + cardWidgetDesc+'</div>';

  var thisRenderredWidget = {
    WidgetHtml: cardWidgetHTML,
    WidgetScript: currCardWidgetResponsiveScripts,
  }

  return thisRenderredWidget;
}

function testimonialWidgetRender(this_widget_testimonial, j, this_column ,this_column_type, rowID){
  
  var tsAuthorName = this_widget_testimonial['tsAuthorName'];
  var tsJob = this_widget_testimonial['tsJob'];
  var tsCompanyName = this_widget_testimonial['tsCompanyName'];
  var tsTestimonial = this_widget_testimonial['tsTestimonial'];
  var tsUserImg = this_widget_testimonial['tsUserImg'];
  var tsImageShape = this_widget_testimonial['tsImageShape'];
  var tsIconColor = this_widget_testimonial['tsIconColor'];
  var tsIconSize = this_widget_testimonial['tsIconSize'];
  var tsTextColor = this_widget_testimonial['tsTextColor'];
  var tsTextSize = this_widget_testimonial['tsTextSize'];
  var tsTestimonialColor = this_widget_testimonial['tsTestimonialColor'];
  var tsTestimonialSize = this_widget_testimonial['tsTestimonialSize'];
  var tsTextAlignment = this_widget_testimonial['tsTextAlignment'];

  var iconHTML = '<i class="fas fa-quote-left" style="border:2px solid '+tsIconColor+'; padding:15px; font-size:'+tsIconSize+'px; color:'+tsIconColor+'; text-align:center; margin:5px 0 5px 0; border-radius:'+tsImageShape+'; "></i>';

  if (tsUserImg !== '') {
    var imgHTMLCenter = '<img src='+tsUserImg+' style="width:25%; height:25%; border-radius:'+tsImageShape+';"    />';
    var imgHTMLLeft = '<img src='+tsUserImg+' style="width:55%; height:25%; border-radius:'+tsImageShape+';"    />';
    var imgArea = 'visible';
  } else{
    imgHTMLCenter = ''; imgHTMLLeft = '';
    var imgArea = 'none';
  }

  var authorNameEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-fieldName='tsAuthorName' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";
  var authorNameWrapped = '<div id="widgetInlineEditor"  data-wid_col_id="'+this_column+'"  data-widget_id="'+j+'" data-widgetType="'+this_column_type+'" >'+tsAuthorName+' </div>'+authorNameEditingSaveTriggerBtn;


  var authorInfoEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-fieldName='tsCompanyName' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";
  var authorInfoWrapped = '<div id="widgetInlineEditor"  data-wid_col_id="'+this_column+'"  data-widget_id="'+j+'" data-widgetType="'+this_column_type+'" >'+tsCompanyName+' </div>'+authorInfoEditingSaveTriggerBtn;

  var testimonialTextEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-fieldName='tsTestimonial' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";
  var testimonialTextWrapped = '<div id="widgetInlineEditor"  style="color:'+tsTestimonialColor+'; font-size:'+tsTestimonialSize+'px ;"  data-wid_col_id="'+this_column+'"  data-widget_id="'+j+'" data-widgetType="'+this_column_type+'" >'+tsTestimonial+' </div>'+testimonialTextEditingSaveTriggerBtn;

  var authorName = '<p style="color:'+tsTextColor+'; font-size:'+tsTextSize+'px;"> '+authorNameWrapped+' </p>';


  var authorinfo =  '<p style="color:'+tsTextColor+'; font-size: calc(3 - '+tsTextSize+'px);" >'+tsJob+', '+authorInfoWrapped+'</p>';

  var testimonialText = '<p style="color:'+tsTestimonialColor+'; font-size:'+tsTestimonialSize+'px ;" >'+testimonialTextWrapped+'</p>';



  var testimonialCardHTMLCenter = '<div style="text-align:center; padding:3% 1% 3% 1%;"> '+iconHTML+' <br> <br>   '+imgHTMLCenter+' '+testimonialText+' <b>'+authorName+'</b> '+authorinfo+'</div>';

  var testimonialCardHTMLLeft = '<div style="padding:3% 1% 3% 1%; text-align:center;"> <div style="width:30%; display:inline-block; text-align:center; display:'+imgArea+'; ">'+imgHTMLLeft+' </div>   <div style="width:69%; display:inline-block; text-align:left;">'+testimonialText+' <b>'+authorName+'</b> '+authorinfo+'</div> </div>';

  var testimonialCardHTMLRight = '<div style="padding:3% 1% 3% 1%; text-align:center;"> <div style="width:69%; display:inline-block; text-align:left; margin-left:2%; ">'+testimonialText+' <b>'+authorName+'</b> '+authorinfo+' </div> <div style="width:28%; display:inline-block; text-align:center; display:'+imgArea+'; ">'+imgHTMLLeft+' </div>   </div>';

  if (tsTextAlignment == 'center') {
    testimonialCardHTML = testimonialCardHTMLCenter;
  } else if (tsTextAlignment == 'left'){
    testimonialCardHTML = testimonialCardHTMLLeft;
  } else if (tsTextAlignment == 'right'){
    testimonialCardHTML = testimonialCardHTMLRight;
  } else{
    testimonialCardHTML = testimonialCardHTMLCenter;
  }

  var thisRenderredWidget = {
    WidgetHtml: testimonialCardHTML,
    WidgetScript: '',
  }
  return thisRenderredWidget;
}

function testimonialCarouselWidgetRender(this_widget_testimonial, j, this_column ,this_column_type){
  
  var tCarOps = this_widget_testimonial['tCarOps'];
  var tCarSlides = this_widget_testimonial['tCarSlides'];
  var tDesignOps = this_widget_testimonial['tDesignOps'];

  iconHTML ='';
  if (tDesignOps['tcis'] !='' && tDesignOps['tcis'] != '0') {
    var iconHTML = '<i class="fas fa-quote-left" style="border:2px solid '+tDesignOps['tcic']+'; padding:15px; font-size:'+tDesignOps['tcis']+'px; color:'+tDesignOps['tcic']+'; text-align:center; margin:5px 0 5px 0; border-radius:'+tDesignOps['tcir']+'; "></i>';
  }
  pbCarouselAllSlides = '';
  jQuery.each(tCarSlides,function(index, val){
    pbSliderPrevSlides = pbCarouselAllSlides;

    if (val['tci'] != '') {
      var imgHTMLCenter = '<img src='+val['tci']+' style="width:'+tDesignOps['tcisi']+'%;  border-radius:'+tDesignOps['tcir']+';"    />';
      var imgArea = 'visible';
    } else{
      imgHTMLCenter = '';
      var imgArea = 'none';
    }

    var authorName = '<p class="tesAName"> '+val['tcn']+' </p>';
    var authorinfo =  '<p class="tesAJob" >'+val['tcj']+'</p>';
    var testimonialText = '<p class="tesAComment">'+val['tct']+'</p>';

    if (val['tcl'] != '') {
      authorinfo = '<a href='+val['tcl']+' target="_blank">'+authorinfo+'</a>';
    }

    if (tDesignOps['tcca'] == 'center') {

      testimonialCardHTML = '<div style="text-align:center; padding:3% 1% 3% 1%;"> '+iconHTML+' <br> <br>   '+imgHTMLCenter+' '+testimonialText+' <b>'+authorName+'</b> '+authorinfo+'</div>';

    } else if (tDesignOps['tcca'] == 'left'){

      testimonialCardHTML = 
        '<div style="padding:3% 1% 3% 1%; text-align:center; display: inline-flex; align-items: center;"> '+
          '<div style="width:30%; display:inline-block; text-align:center; display:'+imgArea+'; ">'+imgHTMLCenter+' </div>'+
          '<div style="width:69%; display:inline-block; text-align:left;">'+testimonialText+' <b>'+authorName+'</b> '+authorinfo+'</div> '+
        '</div>';

    } else if (tDesignOps['tcca'] == 'right'){

      testimonialCardHTML = 

        '<div style="padding:3% 1% 3% 1%; text-align:center; display: inline-flex; align-items: center; ">'+
          '<div style="width:69%; display:inline-block; text-align:left; margin-left:2%; ">'+testimonialText+' <b>'+authorName+'</b> '+authorinfo+' </div>'+
          '<div style="width:28%; display:inline-block; text-align:center; display:'+imgArea+'; ">'+imgHTMLCenter+' </div>'+
        '</div>';

    } else{
      testimonialCardHTML = '<div style="text-align:center; padding:3% 1% 3% 1%;"> '+iconHTML+' <br> <br>   '+imgHTMLCenter+' '+testimonialText+' <b>'+authorName+'</b> '+authorinfo+'</div>';
    }

    pbSliderThisSlide = "<div class='carouselSingleSlide'> "+testimonialCardHTML+" </div>";
    pbCarouselAllSlides = pbSliderPrevSlides +  pbSliderThisSlide;

  });

  pbTCarouselUniqueId = 'pb_testimonialCarousel_'+Math.floor((Math.random() * 2000) + 100);

  tcntf = tDesignOps['tcntf'];
  tcntf = tcntf.replace(/\+/g, ' ');
  if (popb_hasNumber(tcntf)) {
    tcntf = '"'+tcntf+'"';
  }


  tcttf = tDesignOps['tcttf'];
  tcttf = tcttf.replace(/\+/g, ' ');
  if (popb_hasNumber(tcttf)) {
    tcttf = '"'+tcttf+'"';
  }


  pbCarouselScript = "<script> jQuery('#"+pbTCarouselUniqueId+"').owlCarousel({items:"+tCarOps['tNSlides']+",   singleItem: false,  autoPlay : "+tCarOps['tCarAutoplay']+",   stopOnHover : true,   navigation: "+tCarOps['tCarNav']+" ,    paginationSpeed : "+tCarOps['tCarDelay']+"00,   goToFirstSpeed : "+tCarOps['tCarDelay']+"00,    autoHeight : true,    slideSpeed : "+tCarOps['tCarDelay']+"000,   transitionStyle: '"+tCarOps['tCarSlideTransition']+"',    pagination : "+tCarOps['tCarPagination']+",   paginationNumbers: false,   navigationText : ['<span class=\"dashicons dashicons-arrow-left-alt2\" > </span>', '<span class=\"dashicons dashicons-arrow-right-alt2\" > </span>'], theme: 'pbOwl-theme', baseClass: 'pbOwl-carousel' ,  }); </script>";

  var pbCarStyles = '<style>  '+
    '#'+pbTCarouselUniqueId+' .tesAName { color:'+tDesignOps['tcntc']+'; font-size:'+tDesignOps['tcnts']+'px; font-family:'+tcntf+'; }'+
    '#'+pbTCarouselUniqueId+' .tesAJob { color:'+tDesignOps['tcntc']+'; font-size: calc(3 - '+tDesignOps['tcnts']+'px); font-family:'+tcntf+'; }'+
    '#'+pbTCarouselUniqueId+' .tesAComment { color:'+tDesignOps['tcttc']+'; font-size:'+tDesignOps['tctts']+'px ; font-family:'+tcttf+'; }'+
  '</style>';

  var currTCarWidgetDefaultResponsive  = ''+
    '<script>'+
    "jQuery('.responsiveBtn').on('click',function(){"+
    " if (jQuery(this).hasClass('rbt-l') ) { "+

      "jQuery('#"+pbTCarouselUniqueId+" .tesAName').animate({'font-size':'"+tDesignOps['tcnts']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAJob').animate({'font-size':'"+tDesignOps['tcnts']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAComment').animate({'font-size':'"+tDesignOps['tctts']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .fa').animate({'font-size':'"+tDesignOps['tcis']+"px',});"+

    " }"+
                      
    " });"+
    "var currentVPS = jQuery('.currentViewPortSize').val();"+
    "if ( currentVPS == 'rbt-l' ) { "+

      "jQuery('#"+pbTCarouselUniqueId+" .tesAName').animate({'font-size':'"+tDesignOps['tcnts']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAJob').animate({'font-size':'"+tDesignOps['tcnts']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAComment').animate({'font-size':'"+tDesignOps['tctts']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .fa').animate({'font-size':'"+tDesignOps['tcis']+"px',});"+
                      
    "}"+
    " "+
    '</script> ';
  var currTCarWidgetTabletResponsive  = ''+
    '<script>'+
    "jQuery('.responsiveBtn').on('click',function(){"+
    " if (jQuery(this).hasClass('rbt-m') ) { "+

      "jQuery('#"+pbTCarouselUniqueId+" .tesAName').animate({'font-size':'"+tDesignOps['tcntst']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAJob').animate({'font-size':'"+tDesignOps['tcntst']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAComment').animate({'font-size':'"+tDesignOps['tcttst']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .fa').animate({'font-size':'"+tDesignOps['tcist']+"px',});"+

    " }"+
                      
    " });"+
    "var currentVPS = jQuery('.currentViewPortSize').val();"+
    "if ( currentVPS == 'rbt-m' ) { "+

      "jQuery('#"+pbTCarouselUniqueId+" .tesAName').animate({'font-size':'"+tDesignOps['tcntst']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAJob').animate({'font-size':'"+tDesignOps['tcntst']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAComment').animate({'font-size':'"+tDesignOps['tcttst']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .fa').animate({'font-size':'"+tDesignOps['tcist']+"px',});"+
                      
    "}"+
    " "+
    '</script> ';
  var currTCarWidgetMobileResponsive  = ''+
    '<script>'+
    "jQuery('.responsiveBtn').on('click',function(){"+
    " if (jQuery(this).hasClass('rbt-s') ) { "+

      "jQuery('#"+pbTCarouselUniqueId+" .tesAName').animate({'font-size':'"+tDesignOps['tcntsm']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAJob').animate({'font-size':'"+tDesignOps['tcntsm']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAComment').animate({'font-size':'"+tDesignOps['tcttsm']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .fa').animate({'font-size':'"+tDesignOps['tcism']+"px',});"+

    " }"+
                      
    " });"+
    "var currentVPS = jQuery('.currentViewPortSize').val();"+
    "if ( currentVPS == 'rbt-s' ) { "+

      "jQuery('#"+pbTCarouselUniqueId+" .tesAName').animate({'font-size':'"+tDesignOps['tcntsm']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAJob').animate({'font-size':'"+tDesignOps['tcntsm']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .tesAComment').animate({'font-size':'"+tDesignOps['tcttsm']+"px',});"+
      "jQuery('#"+pbTCarouselUniqueId+" .fa').animate({'font-size':'"+tDesignOps['tcism']+"px',});"+
                      
    "}"+
    " "+
    '</script> ';

  pbCarouselSlidesWrapper = '<div  id='+pbTCarouselUniqueId+' class="pbOwl-carousel">' +pbCarouselAllSlides+  pbCarStyles+'</div>';

  

  var thisRenderredWidget = {
    WidgetHtml: pbCarouselSlidesWrapper,
    WidgetScript: pbCarouselScript + currTCarWidgetDefaultResponsive + currTCarWidgetTabletResponsive +  currTCarWidgetMobileResponsive,
  }
  return thisRenderredWidget;
}

function shortCodeWidgetRender(this_widget_shortcode){
  

  var shortCodeContainerUniqueId = 'pb_shortCodeContainer'+Math.floor((Math.random() * 2000) + 100);
  var shortCodeContent = '<br><div title="Scripts Detected" style="text-align:center; font-size:17px; padding:5px 0; width:100%; background:#b5b5b5; color:#fff; "> Shortcode will be loaded on front end of page. </div><br>';

  shortCodeScript = '';

  //shortCodeScript = '<script type="text/javascript">(function(jQuery){ var submit_URl=admURL+"admin-ajax.php?action=ulpb_loadShortcode_content&POPB_Shortcode_nonce="+shortCodeRenderWidgetNO; var result=" ";jQuery.ajax({url:submit_URl,method:"post",data:"ulpb_shortcode='+shortCodeInput+'",success:function(result){jQuery(".'+shortCodeContainerUniqueId+'").html(result)}}); return false; })(jQuery);</script>';

  var thisRenderredWidget = {
    WidgetHtml: shortCodeContent,
    WidgetScript: shortCodeScript,
  }
  return thisRenderredWidget;
}

function countDownWidgetRender(this_widget_countdown){
  
  var pbCountDownDate = this_widget_countdown['pbCountDownDate'];
  var pbCountDownLabel = this_widget_countdown['pbCountDownLabel'];
  var pbCountDownColor = this_widget_countdown['pbCountDownColor'];
  var pbCountDownLabelColor = this_widget_countdown['pbCountDownLabelColor'];
  var pbCountDownTextSize = this_widget_countdown['pbCountDownTextSize'];
  var pbCountDownLabelTextSize = this_widget_countdown['pbCountDownLabelTextSize'];

  pbcdnbw = ''; pbcdnbc = ''; pbcdnbs = '';
  if ( typeof(this_widget_countdown['pbcdnbw']) != 'undefined' ) {
    pbcdnbw = this_widget_countdown['pbcdnbw'];
    pbcdnbc = this_widget_countdown['pbcdnbc'];
    pbcdnbs = this_widget_countdown['pbcdnbs'];
  }
  

  pbCountDownType = 'fixed' , pbCountDownNumberBgColor = 'transparent', pbCountDownHGap = 1, pbCountDownHGapTablet = 1, pbCountDownHGapMobile = 1, pbCountDownVGap = ''; pbCountDownNumberBorderRadius = ''; pbCountDownVGapTablet = ''; pbCountDownVGapMobile = '';
  if ( typeof(this_widget_countdown['pbCountDownType']) !='undefined' ) {
    pbCountDownType = this_widget_countdown['pbCountDownType'];
    pbCountDownNumberBgColor = this_widget_countdown['pbCountDownNumberBgColor'];
    pbCountDownHGap = this_widget_countdown['pbCountDownHGap'];
    if (this_widget_countdown['pbCountDownHGap'] == '' || this_widget_countdown['pbCountDownHGap'] == null) {
      pbCountDownHGap = 1;
    }
    
    if (this_widget_countdown['pbCountDownVGap'] == '' || this_widget_countdown['pbCountDownVGap'] == null) {
      this_widget_countdown['pbCountDownVGap'] = 60;
    }
    pbCountDownHGapTablet = this_widget_countdown['pbCountDownHGapTablet'];
    pbCountDownHGapMobile = this_widget_countdown['pbCountDownHGapMobile'];
    pbCountDownVGap = (parseInt(this_widget_countdown['pbCountDownVGap']) / 2);
    pbCountDownVGapTablet = (parseInt(this_widget_countdown['pbCountDownVGapTablet']) / 2);
    pbCountDownVGapMobile = (parseInt(this_widget_countdown['pbCountDownVGapMobile']) / 2);

    pbCountDownNumberBorderRadius = this_widget_countdown['pbCountDownNumberBorderRadius'];
  }else{
    pbCountDownHGap = 1;
    pbCountDownVGap = 30;
  }

  if (pbCountDownType == 'evergreen') {
    pbCountDownDateDays = this_widget_countdown['pbCountDownDateDays'];
    pbCountDownDateHours = this_widget_countdown['pbCountDownDateHours'];
    pbCountDownDateMins = this_widget_countdown['pbCountDownDateMins'];
    pbCountDownDateSecs = this_widget_countdown['pbCountDownDateSecs'];

    // set 0
      if (pbCountDownDateDays == '') {
        pbCountDownDateDays = 0;
      }
      if (pbCountDownDateHours == '') {
        pbCountDownDateHours = 0;
      }
      if (pbCountDownDateMins == '') {
        pbCountDownDateMins = 0;
      }
      if (pbCountDownDateSecs == '') {
        pbCountDownDateSecs = 0;
      }


    var todaysDate = new Date();

    todaysTime = todaysDate.getTime();

    addedMinutesSeconds = todaysTime +  (((1*60000)*60)*24)*pbCountDownDateDays  + ((pbCountDownDateHours*60000)*60) + pbCountDownDateMins*60000 + pbCountDownDateSecs*1000;

    pbCountDownDate = addedMinutesSeconds;


  }

  pbCountDownHGapWidth = (23 - parseInt(pbCountDownHGap) );
  pbCountDownHGapWidthTablet = (23 - parseInt(pbCountDownHGapTablet) );
  pbCountDownHGapWidthMobile = (23 - parseInt(pbCountDownHGapMobile) );

  pbCountDownLabelTextSizeTablet = ''; pbCountDownLabelTextSizeMobile = '';
  pbCountDownTextSizeTablet = ''; pbCountDownTextSizeMobile = '';
  if (typeof(this_widget_countdown['pbCountDownLabelTextSizeTablet']) !== 'undefined' ) {
    pbCountDownLabelTextSizeTablet = this_widget_countdown['pbCountDownLabelTextSizeTablet'];
    pbCountDownLabelTextSizeMobile = this_widget_countdown['pbCountDownLabelTextSizeMobile'];

    pbCountDownTextSizeTablet = this_widget_countdown['pbCountDownTextSizeTablet'];
    pbCountDownTextSizeMobile = this_widget_countdown['pbCountDownTextSizeMobile'];
  }

  pbCountDownLabelFontFamily = ''; pbCountDownNumberFontFamily = '';
  if (typeof(this_widget_countdown['pbCountDownLabelFontFamily']) !== 'undefined' ) {
    pbCountDownLabelFontFamily = this_widget_countdown['pbCountDownLabelFontFamily'];
    pbCountDownNumberFontFamily = this_widget_countdown['pbCountDownNumberFontFamily'];
  }

    numberBlockStyles = " width: "+pbCountDownHGapWidth+"%; margin-right:"+pbCountDownHGap+"%; background:"+pbCountDownNumberBgColor+"; border-radius:"+pbCountDownNumberBorderRadius+"px; border-width:"+pbcdnbw+"px; border-color:"+pbcdnbc+"; border-style:"+pbcdnbs+"; ";

    if (pbCountDownDate != '') {
      if ( typeof(this_widget_countdown['pbCountDownTimezone']) != 'undefined' ) {
        if (this_widget_countdown['pbCountDownTimezone'] != '') {
          pbCountDownDate = moment.tz(pbCountDownDate,this_widget_countdown['pbCountDownTimezone'] );
          pbCountDownDate = pbCountDownDate.format('YYYY/MM/DD HH:mm:ss');
        }
      }
    }

  hideDays = 'inline-block';  hideHours = 'inline-block'; hideMinutes = 'inline-block';  hideSeconds = 'inline-block'; 
  daysText = 'DAYS'; hoursText= 'HOURS'; minutesText = 'MINUTES'; secondsText = 'SECONDS';
  if (typeof(this_widget_countdown['daysText']) !== 'undefined' ) {
    if (this_widget_countdown['daysText'] != '') {
      daysText = this_widget_countdown['daysText'];
    }
    if (this_widget_countdown['hoursText'] != '') {
      hoursText = this_widget_countdown['hoursText'];
    }
    if (this_widget_countdown['minutesText'] != '') {
      minutesText = this_widget_countdown['minutesText'];
    }
    if (this_widget_countdown['secondsText'] != '') {
      secondsText = this_widget_countdown['secondsText'];
    }

    if (this_widget_countdown['hideDays'] != '' && this_widget_countdown['hideDays'] != null) {
      hideDays = this_widget_countdown['hideDays'];
    }
    if (this_widget_countdown['hideHours'] != '' && this_widget_countdown['hideHours'] != null) {
      hideHours = this_widget_countdown['hideHours'];
    }
    if (this_widget_countdown['hideMinutes'] != '' && this_widget_countdown['hideMinutes'] != null) {
      hideMinutes = this_widget_countdown['hideMinutes'];
    }
    if (this_widget_countdown['hideSeconds'] != '' && this_widget_countdown['hideSeconds'] != null) {
      hideSeconds = this_widget_countdown['hideSeconds'];
    }
  }



  var countDownId = 'pb_countDown-'+Math.floor((Math.random() * 2000) + 100);

  var countDownScript = 

  "<script>"+

    "jQuery('#"+countDownId+"').countdown('"+pbCountDownDate+"', function(event) { "+

      "if (hideDays == 'none') {"+
        "totalHours = event.offset.totalDays * 24 + event.offset.hours; "+
      "}else {"+
        "totalHours =  event.offset.hours; if (totalHours < 10) { totalHours = '0'+totalHours; } "+
      "}"+

      "if (hideHours == 'none') {"+
      "totalMins = totalHours * 60 + event.offset.minutes; } else {"+
        "totalMins =  event.offset.minutes;  if (totalMins < 10) { totalMins = '0'+totalMins; }"+
      "}"+

      "jQuery(this).html( "+

        "event.strftime('' +'<div style=\"width: 100%; letter-spacing:2.5px; \"> <div class=\" numberBlock \" style=\" display:"+hideDays+"; "+numberBlockStyles+" \"><p class=\"countDownNumbers\"  > %D </p> <p class=\"countDownLabels\">"+daysText+"</p></div>  <div class=\" numberBlock \" style=\" display:"+hideHours+"; "+numberBlockStyles+" \"><p class=\"countDownNumbers\" > '+totalHours+' </p> <p class=\"countDownLabels\">"+hoursText+"</p></div><div class=\" numberBlock \" style=\" display:"+hideMinutes+"; "+numberBlockStyles+" \"><p class=\"countDownNumbers\" > '+totalMins+' </p> <p class=\"countDownLabels\">"+minutesText+"</p></div><div class=\" numberBlock \" style=\" display:"+hideSeconds+"; "+numberBlockStyles+" \"><p class=\"countDownNumbers\" > %S </p> <p class=\"countDownLabels\">"+secondsText+"</p></div> </div>' )"+

      ");"+

    "}); "+

  "</script>";


  pbCountDownLabelFontFamily = pbCountDownLabelFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(pbCountDownLabelFontFamily)) {
    pbCountDownLabelFontFamily = '"'+pbCountDownLabelFontFamily+'"';
  }

  pbCountDownNumberFontFamily = pbCountDownNumberFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(pbCountDownNumberFontFamily)) {
    pbCountDownNumberFontFamily = '"'+pbCountDownNumberFontFamily+'"';
  }

  var countDownContainer = "<div id="+countDownId+" class='popb_countDown' style='text-align:center;'></div>";

  var currWidgetDefaultStyles = '<style>'+
    '#'+countDownId+' .countDownLabels{  font-size:'+pbCountDownLabelTextSize+'px; margin-top:'+pbCountDownVGap+'px; margin-bottom:'+pbCountDownVGap+'px; color:'+pbCountDownLabelColor+'; display:'+pbCountDownLabel+'; line-height:0; font-family:'+pbCountDownLabelFontFamily+'; }' +
    '#'+countDownId+' .countDownNumbers{ margin-top:'+pbCountDownVGap+'px; margin-bottom:'+pbCountDownVGap+'px;   font-size:'+pbCountDownTextSize+'px; color:'+pbCountDownColor+'; line-height:0; font-family:'+pbCountDownNumberFontFamily+'; } </style>';


  var currWidgetDefaultResponsive  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-l') ) { "+

        "  jQuery('#"+countDownId+" .numberBlock').css({'width':'"+pbCountDownHGapWidth+"%', 'margin-right':'"+pbCountDownHGap+"%',  }); "+

        "  jQuery('#"+countDownId+" .countDownLabels').css({'font-size':'"+pbCountDownLabelTextSize+"px', 'margin-top':'"+pbCountDownVGap+"px', 'margin-bottom':'"+pbCountDownVGap+"px', }); "+

        "  jQuery('#"+countDownId+" .countDownNumbers').css({'font-size':'"+pbCountDownTextSize+"px', 'margin-top':'"+pbCountDownVGap+"px', 'margin-bottom':'"+pbCountDownVGap+"px', }); } "+
        
        " });"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-l' ) { "+

        "  jQuery('#"+countDownId+" .numberBlock').css({'width':'"+pbCountDownHGapWidth+"%', 'margin-right':'"+pbCountDownHGap+"%',  }); "+

        "  jQuery('#"+countDownId+" .countDownLabels').css({'font-size':'"+pbCountDownLabelTextSize+"px', 'margin-top':'"+pbCountDownVGap+"px', 'margin-bottom':'"+pbCountDownVGap+"px', }); "+

        "  jQuery('#"+countDownId+" .countDownNumbers').css({'font-size':'"+pbCountDownTextSize+"px', 'margin-top':'"+pbCountDownVGap+"px', 'margin-bottom':'"+pbCountDownVGap+"px',}); "+
        
        "}"+
        " "+
        '</script> ';

  var currWidgetTabletResponsive  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-m') ) { "+

        "  jQuery('#"+countDownId+" .numberBlock').css({'width':'"+pbCountDownHGapWidthTablet+"%', 'margin-right':'"+pbCountDownHGapTablet+"%',  }); "+

        "  jQuery('#"+countDownId+" .countDownLabels').css({'font-size':'"+pbCountDownLabelTextSizeTablet+"px',  'margin-top':'"+pbCountDownVGapTablet+"px', 'margin-bottom':'"+pbCountDownVGapTablet+"px' }); "+

        "  jQuery('#"+countDownId+" .countDownNumbers').css({'font-size':'"+pbCountDownTextSizeTablet+"px', 'margin-top':'"+pbCountDownVGapTablet+"px', 'margin-bottom':'"+pbCountDownVGapTablet+"px'}); } "+
        
        " });"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-m' ) { "+

        "  jQuery('#"+countDownId+" .numberBlock').css({'width':'"+pbCountDownHGapWidthTablet+"%', 'margin-right':'"+pbCountDownHGapTablet+"%',  }); "+

        "  jQuery('#"+countDownId+" .countDownLabels').css({'font-size':'"+pbCountDownLabelTextSizeTablet+"px',  'margin-top':'"+pbCountDownVGapTablet+"px', 'margin-bottom':'"+pbCountDownVGapTablet+"px' }); "+

        "  jQuery('#"+countDownId+" .countDownNumbers').css({'font-size':'"+pbCountDownTextSizeTablet+"px',  'margin-top':'"+pbCountDownVGapTablet+"px', 'margin-bottom':'"+pbCountDownVGapTablet+"px'}); "+
        
        "}"+
        " "+
        '</script> ';

  var currWidgetMobileResponsive  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-s') ) { "+

        "  jQuery('#"+countDownId+" .numberBlock').css({'width':'"+pbCountDownHGapWidthMobile+"%', 'margin-right':'"+pbCountDownHGapMobile+"%',  }); "+

        "  jQuery('#"+countDownId+" .countDownLabels').css({'font-size':'"+pbCountDownLabelTextSizeMobile+"px',  'margin-top':'"+pbCountDownVGapMobile+"px', 'margin-bottom':'"+pbCountDownVGapMobile+"px'}); "+

        "  jQuery('#"+countDownId+" .countDownNumbers').css({'font-size':'"+pbCountDownTextSizeMobile+"px', 'margin-top':'"+pbCountDownVGapMobile+"px', 'margin-bottom':'"+pbCountDownVGapMobile+"px' }); } "+
        
        " });"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-s' ) { "+

        "  jQuery('#"+countDownId+" .numberBlock').css({'width':'"+pbCountDownHGapWidthMobile+"%', 'margin-right':'"+pbCountDownHGapMobile+"%',  }); "+

        "  jQuery('#"+countDownId+" .countDownLabels').css({'font-size':'"+pbCountDownLabelTextSizeMobile+"px', 'margin-top':'"+pbCountDownVGapMobile+"px', 'margin-bottom':'"+pbCountDownVGapMobile+"px' }); "+

        "  jQuery('#"+countDownId+" .countDownNumbers').css({'font-size':'"+pbCountDownTextSizeMobile+"px',  'margin-top':'"+pbCountDownVGapMobile+"px', 'margin-bottom':'"+pbCountDownVGapMobile+"px'}); "+
        
        "}"+
        " "+
        '</script> ';

        var resposiveScripts = currWidgetDefaultResponsive;

    var resposiveScripts = currWidgetDefaultResponsive + currWidgetTabletResponsive + currWidgetMobileResponsive + countDownScript ;

    var thisRenderredWidget = {
      WidgetHtml: countDownContainer + currWidgetDefaultStyles,
      WidgetScript: resposiveScripts,
    }
  return thisRenderredWidget;

}

function imageSliderWidgetRender(this_widget_imageSlider){
  widget_imageSlider = _.clone(this_widget_imageSlider);

  pbSliderImagesURL = widget_imageSlider['pbSliderImagesURL'];
  pbSliderContent = widget_imageSlider['pbSliderContent'];
  pbSliderAuto = widget_imageSlider['pbSliderAuto'];
  pbSliderDelay = widget_imageSlider['pbSliderDelay'];
  pbSliderPager = widget_imageSlider['pbSliderPager'];
  pbSliderNav = widget_imageSlider['pbSliderNav'];
  pbSliderRandom = widget_imageSlider['pbSliderRandom'];
  pbSliderPause = widget_imageSlider['pbSliderPause'];
  

  if (typeof(widget_imageSlider['pbSliderHeight']) == 'undefined') {
    pbSliderHeight = '400';
    pbSliderHeightUnit = 'px';
  }else{
    pbSliderHeight = widget_imageSlider['pbSliderHeight'];
    pbSliderHeightUnit = widget_imageSlider['pbSliderHeightUnit'];
  }
  if (typeof(widget_imageSlider['pbSliderContent']) == 'undefined') {
    contentSlider = false;
  }else{
    contentSlider = true;
  }


  pbImageSliderUniqueId = 'pb_imageSlider-'+Math.floor((Math.random() * 2000) + 100);

  pbSliderContainer =  "<div class='rslides_container' style='min-height:100px;'> <ul class='rslides' id='"+pbImageSliderUniqueId+"'>";
  
  pbSliderAllSlides = '';

  if (typeof(pbSliderContent[0]['imageSlideUrl']) != 'undefined' ) {
    pbSliderImagesURL = pbSliderContent;
  }

  jQuery.each(pbSliderImagesURL,function(index, val){

    pbSliderPrevSlides = pbSliderAllSlides;
    
    var slideImageUrl = val;
    if (typeof(val['imageSlideUrl']) !== 'undefined') {
      slideImageUrl = val['imageSlideUrl'];
    }

    if (contentSlider == false) {imageSlideContent = ''; 
    } else{

      pbSlideContent = pbSliderContent[index];
      imageSlideHeading = '';  imageSlideDesc = ''; imageSlideButton = '';
      if (pbSlideContent['imageSlideHeading'] != '') {
        imageSlideHeading = "<h2>"+pbSlideContent['imageSlideHeading']+"</h2>";
      }

      if (pbSlideContent['imageSlideDesc'] != '') {
        imageSlideDesc = "<p>"+ pbSlideContent['imageSlideDesc'] +"</p>";
      }

      if (pbSlideContent['imageSlideButtonText'] != '') {
        imageSlideButton = "<a href="+pbSlideContent['imageSlideButtonURL']+" target='_blank'> <button disabled>"+pbSlideContent['imageSlideButtonText']+"</button> </a>";

      }

      thisSlideContentHidden = '';
      if (imageSlideHeading == '' && imageSlideDesc == '' && imageSlideButton == '') {
        thisSlideContentHidden = 'display:none !important;';
      }
      
      imageSlideContent = "<div class='popb_slide_content' style='"+thisSlideContentHidden+"'>"+imageSlideHeading+" "+imageSlideDesc+"  "+imageSlideButton+"   </div>";
    }
    

    pbSliderThisSlide = 
      "<li>"+
        "<div class='popb_slideContainer' style='background:url("+slideImageUrl+"); width: 100%;height:"+pbSliderHeight+pbSliderHeightUnit+";background-size: cover; background-repeat: no-repeat;background-position: center;'> "+imageSlideContent+"  </div>"+
      "</li>"
    ;
    pbSliderAllSlides = pbSliderPrevSlides +  pbSliderThisSlide;
  });

  pbSliderContainerClose = "</ul> </div>";

  pbSliderScript = "<script>  jQuery(function() {  jQuery('#"+pbImageSliderUniqueId+"').responsiveSlides({  auto:  "+pbSliderAuto+",  speed: 500,             timeout:  "+pbSliderDelay+",  pager:  "+pbSliderPager+",            nav:  "+pbSliderNav+",               random:  "+pbSliderRandom+",            pause:  "+pbSliderPause+",        namespace: 'pb-centeredSlider',  });   });   </script>";

  if (contentSlider == false){ 
    pbSliderStyling = '';
  }else{

    slideHeadingStyles = widget_imageSlider['slideHeadingStyles'];
    slideDescStyles = widget_imageSlider['slideDescStyles'];
    slideButtonStyles = widget_imageSlider['slideButtonStyles'];
    pbSliderContentBgColor = widget_imageSlider['pbSliderContentBgColor'];

    slideHeadingBold = ''; slideHeadingItalic = ''; slideHeadingUnderlined = '';
    if (slideHeadingStyles['slideHeadingBold'] == true) { slideHeadingBold = 'bold'; }
    if (slideHeadingStyles['slideHeadingItalic'] == true) { slideHeadingItalic = 'italic'; }
    if (slideHeadingStyles['slideHeadingUnderlined'] == true) { slideHeadingUnderlined = 'underline'; }


    if (typeof(slideHeadingStyles['slideHeadingFontFamily']) != 'undefined') {
      slideHeadingFontFamily = slideHeadingStyles['slideHeadingFontFamily'];
    } else{
      slideHeadingFontFamily = ' none';
    }

    if (typeof(slideDescStyles['slideDescFontFamily']) != 'undefined') {
      slideDescFontFamily = slideDescStyles['slideDescFontFamily'];
    } else{
      slideDescFontFamily = ' none';
    }

    if (typeof(slideButtonStyles['slideButtonBtnFontFamily']) != 'undefined') {
      slideButtonBtnFontFamily = slideButtonStyles['slideButtonBtnFontFamily'];
    } else{
      slideButtonBtnFontFamily = ' none';
    }

    slideHeadingFontFamily = slideHeadingFontFamily.replace(/\+/g, ' ');
    if (popb_hasNumber(slideHeadingFontFamily)) {
      slideHeadingFontFamily = '"'+slideHeadingFontFamily+'"';
    }

    pbSliderHeadingStyles = ''
      +'color:'+slideHeadingStyles['slideHeadingColor']+';'
      +'font-size:'+slideHeadingStyles['slideHeadingSize']+'px;'
      +'letter-spacing:'+slideHeadingStyles['slideHeadingLetterSpacing']+'px;'
      +'line-height:'+slideHeadingStyles['slideHeadingLineHeight']+'px;'
      +'font-family:'+slideHeadingFontFamily+';'
      +'font-weight:'+slideHeadingBold+';'
      +'font-style:'+slideHeadingItalic+';'
      +'text-decoration:'+slideHeadingUnderlined+';'
    ;


    slideDescBold = ''; slideDescItalic = ''; slideDescUnderlined = '';
    if (slideDescStyles['slideDescBold'] == true) { slideDescBold = 'bold'; }
    if (slideDescStyles['slideDescItalic'] == true) { slideDescItalic = 'italic'; }
    if (slideDescStyles['slideDescUnderlined'] == true) { slideDescUnderlined = 'underline'; }


    slideDescFontFamily = slideDescFontFamily.replace(/\+/g, ' ');
    if (popb_hasNumber(slideDescFontFamily)) {
      slideDescFontFamily = '"'+slideDescFontFamily+'"';
    }

    pbSliderDescStyles = ''
      +'color:'+slideDescStyles['slideDescColor']+';'
      +'font-size:'+slideDescStyles['slideDescSize']+'px;'
      +'letter-spacing:'+slideDescStyles['slideDescLetterSpacing']+'px;'
      +'line-height:'+slideDescStyles['slideDescLineHeight']+'px;'
      +'font-family:'+slideDescFontFamily+';'
      +'font-weight:'+slideDescBold+';'
      +'font-style:'+slideDescItalic+';'
      +'text-decoration:'+slideDescUnderlined+';'
    ;

    slideButtonBtnFontFamily = slideButtonBtnFontFamily.replace(/\+/g, ' ');
    if (popb_hasNumber(slideButtonBtnFontFamily)) {
      slideButtonBtnFontFamily = '"'+slideButtonBtnFontFamily+'"';
    }

    pbSliderBtnStyles =
      'padding:'+slideButtonStyles['slideButtonBtnHeight']+'px 5px;'+
      'width: '+slideButtonStyles['slideButtonBtnWidth']+'px;'+
      'background:'+slideButtonStyles['slideButtonBtnBgColor']+';'+
      'background-color:'+slideButtonStyles['slideButtonBtnBgColor']+';'+
      'color:'+slideButtonStyles['slideButtonBtnColor']+';'+
      'font-size:'+slideButtonStyles['slideButtonBtnFontSize']+'px;'+
      'font-family:'+slideButtonBtnFontFamily+';'+
      'letter-spacing:'+slideButtonStyles['slideButtonBtnFontLetterSpacing']+'px;'+
      'border-width:'+slideButtonStyles['slideButtonBtnBorderWidth']+'px;'+
      'border-color:'+slideButtonStyles['slideButtonBtnBorderColor']+'px;'+
      'border-radius:'+slideButtonStyles['slideButtonBtnBorderRadius']+'px;'+
      'border-style:solid;'
    ;




    if ( typeof(widget_imageSlider['slideContentWidth']) == 'undefined' || widget_imageSlider['slideContentWidth'] == '' ) { widget_imageSlider['slideContentWidth'] = '40';  }

    if ( typeof(widget_imageSlider['slideContentWUnit']) == 'undefined' || widget_imageSlider['slideContentWUnit'] == '' ) { widget_imageSlider['slideContentWUnit'] = '%';  }
    
    if ( typeof(widget_imageSlider['slideContentAlignH']) == 'undefined' || widget_imageSlider['slideContentAlignH'] == '' ) { widget_imageSlider['slideContentAlignH'] = 'center';  }

    if ( typeof(widget_imageSlider['slideContentAlignV']) == 'undefined' || widget_imageSlider['slideContentAlignV'] == '' ) { widget_imageSlider['slideContentAlignV'] = 'middle';  }

    if ( typeof(widget_imageSlider['slideContentAlign']) == 'undefined' || widget_imageSlider['slideContentAlign'] == '' ) { widget_imageSlider['slideContentAlign'] = 'center';  }

    slideContentAlignVMargin = '';

    if (widget_imageSlider['slideContentAlignV'] == 'middle') {
      slideContentAlignV = '50%';
    }

    if (widget_imageSlider['slideContentAlignV'] == 'top') {
      slideContentAlignV = '0%';
    }
    if (widget_imageSlider['slideContentAlignV'] == 'bottom') {
      slideContentAlignV = '0%';
      slideContentAlignVMargin = 'bottom:0%; top:inherit;';
    }

    slideContentAlignHMargin = '';
    if (widget_imageSlider['slideContentAlignH'] == 'center') {
      slideContentAlignH = '50%';
      slideContentAlignHMargin = 'margin:0 auto;';
    }
    
    if (widget_imageSlider['slideContentAlignH'] == 'left') {
      slideContentAlignH = '0%';
    }

    if (widget_imageSlider['slideContentAlignH'] == 'right') {
      slideContentAlignH = '0%';
      slideContentAlignHMargin = 'left:inherit; right: 0;';
    }

    slideContentAlignmentCss =
      'position: absolute;'+
      'top: '+slideContentAlignV+';'+
      'left: '+slideContentAlignH+';'+
      'transform: translate(-'+slideContentAlignH+', -'+slideContentAlignV+');'+
      '-ms-transform: translate(-'+slideContentAlignH+', -'+slideContentAlignV+');'+
      '-webkit-transform: translate(-'+slideContentAlignH+', -'+slideContentAlignV+');'+
      slideContentAlignHMargin + slideContentAlignVMargin
    ;

    

    pbSliderStyling = '<style> '+
    '#'+pbImageSliderUniqueId+' .popb_slide_content{ '+
      'width:'+widget_imageSlider['slideContentWidth']+widget_imageSlider['slideContentWUnit']+';'+
      'text-align:'+widget_imageSlider['slideContentAlign']+';'+
      'background:'+pbSliderContentBgColor+';'+
      'padding:3% 6%;'+
      slideContentAlignmentCss+
    '} \n' +
    '#'+pbImageSliderUniqueId+' .popb_slide_content h2{ '+pbSliderHeadingStyles+'  } \n'+
    '#'+pbImageSliderUniqueId+' .popb_slide_content p{ '+pbSliderDescStyles+'  }'+
    '#'+pbImageSliderUniqueId+' .popb_slide_content button{ '+pbSliderBtnStyles+'  } \n'+
    '</style>'+'\n <link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+slideHeadingFontFamily+'|'+slideDescFontFamily+'|'+slideButtonBtnFontFamily+'">';

  }

    
  currWidgetDefaultResponsive = ''; currWidgetTabletResponsive = ''; currWidgetMobileResponsive = '';
  if (typeof(widget_imageSlider['pbSliderHeightTablet']) != 'undefined') {

    var currWidgetDefaultResponsive  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-l') ) { "+

          "jQuery('#"+pbImageSliderUniqueId+"').animate({'height':'"+pbSliderHeight+pbSliderHeightUnit+"',}); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content h2').animate({'font-size':'"+slideHeadingStyles['slideHeadingSize']+"px', 'letter-spacing':'"+slideHeadingStyles['slideHeadingLetterSpacing']+"px', 'line-height':'"+slideHeadingStyles['slideHeadingLineHeight']+"px' , }); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content p').animate({'font-size':'"+slideDescStyles['slideDescSize']+"px', 'letter-spacing':'"+slideDescStyles['slideDescLetterSpacing']+"px', 'line-height':'"+slideDescStyles['slideDescLineHeight']+"px' , }); "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content button').animate({'font-size':'"+slideButtonStyles['slideButtonBtnFontSize']+"px', 'letter-spacing':'"+slideButtonStyles['slideButtonBtnFontLetterSpacing']+"px', 'padding':'"+slideButtonStyles['slideButtonBtnHeight']+"px 5px' ,  'width':'"+slideButtonStyles['slideButtonBtnWidth']+"px' ,}); "+
        
        "}"+
        
        " });"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-l' ) { "+

        "jQuery('#"+pbImageSliderUniqueId+"').animate({'height':'"+pbSliderHeight+pbSliderHeightUnit+"',}); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content h2').animate({'font-size':'"+slideHeadingStyles['slideHeadingSize']+"px', 'letter-spacing':'"+slideHeadingStyles['slideHeadingLetterSpacing']+"px', 'line-height':'"+slideHeadingStyles['slideHeadingLineHeight']+"px' , }); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content p').animate({'font-size':'"+slideDescStyles['slideDescSize']+"px', 'letter-spacing':'"+slideDescStyles['slideDescLetterSpacing']+"px', 'line-height':'"+slideDescStyles['slideDescLineHeight']+"px' , }); "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content button').animate({'font-size':'"+slideButtonStyles['slideButtonBtnFontSize']+"px', 'letter-spacing':'"+slideButtonStyles['slideButtonBtnFontLetterSpacing']+"px', 'padding':'"+slideButtonStyles['slideButtonBtnHeight']+"px 5px' ,  'width':'"+slideButtonStyles['slideButtonBtnWidth']+"px' ,}); "+
        
        "}"+
        " "+
        '</script> ';

    var currWidgetTabletResponsive  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-m') ) { "+

          "jQuery('#"+pbImageSliderUniqueId+"').animate({'height':'"+widget_imageSlider['pbSliderHeightTablet']+widget_imageSlider['pbSliderHeightUnitTablet']+"',}); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content h2').animate({'font-size':'"+slideHeadingStyles['slideHeadingSizeTablet']+"px', 'letter-spacing':'"+slideHeadingStyles['slideHeadingLetterSpacingTablet']+"px', 'line-height':'"+slideHeadingStyles['slideHeadingLineHeightTablet']+"px' , }); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content p').animate({'font-size':'"+slideDescStyles['slideDescSizeTablet']+"px', 'letter-spacing':'"+slideDescStyles['slideDescLetterSpacingTablet']+"px', 'line-height':'"+slideDescStyles['slideDescLineHeightTablet']+"px' , }); "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content button').animate({'font-size':'"+slideButtonStyles['slideButtonBtnFontSizeTablet']+"px', 'letter-spacing':'"+slideButtonStyles['slideButtonBtnFontLetterSpacingTablet']+"px', 'padding':'"+slideButtonStyles['slideButtonBtnHeightTablet']+"px 5px' ,  'width':'"+slideButtonStyles['slideButtonBtnWidthTablet']+"px' ,}); "+
        
        "}"+
        
        " });"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-m' ) { "+

          "jQuery('#"+pbImageSliderUniqueId+"').animate({'height':'"+widget_imageSlider['pbSliderHeightTablet']+widget_imageSlider['pbSliderHeightUnitTablet']+"',}); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content h2').animate({'font-size':'"+slideHeadingStyles['slideHeadingSizeTablet']+"px', 'letter-spacing':'"+slideHeadingStyles['slideHeadingLetterSpacingTablet']+"px', 'line-height':'"+slideHeadingStyles['slideHeadingLineHeightTablet']+"px' , }); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content p').animate({'font-size':'"+slideDescStyles['slideDescSizeTablet']+"px', 'letter-spacing':'"+slideDescStyles['slideDescLetterSpacingTablet']+"px', 'line-height':'"+slideDescStyles['slideDescLineHeightTablet']+"px' , }); "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content button').animate({'font-size':'"+slideButtonStyles['slideButtonBtnFontSizeTablet']+"px', 'letter-spacing':'"+slideButtonStyles['slideButtonBtnFontLetterSpacingTablet']+"px', 'padding':'"+slideButtonStyles['slideButtonBtnHeightTablet']+"px 5px' ,  'width':'"+slideButtonStyles['slideButtonBtnWidthTablet']+"px' ,}); "+
        
        "}"+
        " "+
        '</script> ';

    var currWidgetMobileResponsive  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-s') ) { "+

          "jQuery('#"+pbImageSliderUniqueId+"').animate({'height':'"+widget_imageSlider['pbSliderHeightMobile']+widget_imageSlider['pbSliderHeightUnitMobile']+"',}); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content h2').animate({'font-size':'"+slideHeadingStyles['slideHeadingSizeMobile']+"px', 'letter-spacing':'"+slideHeadingStyles['slideHeadingLetterSpacingMobile']+"px', 'line-height':'"+slideHeadingStyles['slideHeadingLineHeightMobile']+"px' , }); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content p').animate({'font-size':'"+slideDescStyles['slideDescSizeMobile']+"px', 'letter-spacing':'"+slideDescStyles['slideDescLetterSpacingMobile']+"px', 'line-height':'"+slideDescStyles['slideDescLineHeightMobile']+"px' , }); "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content button').animate({'font-size':'"+slideButtonStyles['slideButtonBtnFontSizeMobile']+"px', 'letter-spacing':'"+slideButtonStyles['slideButtonBtnFontLetterSpacingMobile']+"px', 'padding':'"+slideButtonStyles['slideButtonBtnHeightMobile']+"px 5px' ,  'width':'"+slideButtonStyles['slideButtonBtnWidthMobile']+"px' ,}); "+
        
        "}"+
        
        " });"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-s' ) { "+

          "jQuery('#"+pbImageSliderUniqueId+"').animate({'height':'"+widget_imageSlider['pbSliderHeightMobile']+widget_imageSlider['pbSliderHeightUnitMobile']+"',}); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content h2').animate({'font-size':'"+slideHeadingStyles['slideHeadingSizeMobile']+"px', 'letter-spacing':'"+slideHeadingStyles['slideHeadingLetterSpacingMobile']+"px', 'line-height':'"+slideHeadingStyles['slideHeadingLineHeightMobile']+"px' , }); "+
          
          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content p').animate({'font-size':'"+slideDescStyles['slideDescSizeMobile']+"px', 'letter-spacing':'"+slideDescStyles['slideDescLetterSpacingMobile']+"px', 'line-height':'"+slideDescStyles['slideDescLineHeightMobile']+"px' , }); "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content button').animate({'font-size':'"+slideButtonStyles['slideButtonBtnFontSizeMobile']+"px', 'letter-spacing':'"+slideButtonStyles['slideButtonBtnFontLetterSpacingMobile']+"px', 'padding':'"+slideButtonStyles['slideButtonBtnHeightMobile']+"px 5px' ,  'width':'"+slideButtonStyles['slideButtonBtnWidthMobile']+"px' ,}); "+
        
        "}"+
        " "+
        '</script> ';

  }


    slideContentAlignVMargin = '';

    if (widget_imageSlider['slideContentAlignV'] == 'middle') {
      slideContentAlignV = '50%';
    }

    if (widget_imageSlider['slideContentAlignV'] == 'top') {
      slideContentAlignV = '0%';
    }
    if (widget_imageSlider['slideContentAlignV'] == 'bottom') {
      slideContentAlignV = '0%';
      slideContentAlignVMargin = "'bottom':'0%', 'top':'inherit',";
    }

    slideContentAlignHMargin = '';
    if (widget_imageSlider['slideContentAlignH'] == 'center') {
      slideContentAlignH = '50%';
      slideContentAlignHMargin = "'margin':'0 auto',";
    }
    
    if (widget_imageSlider['slideContentAlignH'] == 'left') {
      slideContentAlignH = '0%';
    }

    if (widget_imageSlider['slideContentAlignH'] == 'right') {
      slideContentAlignH = '0%';
      slideContentAlignHMargin = "'left':'inherit', 'right':'0',";
    }

    slideContentAlignmentCss =
      '"top":"'+slideContentAlignV+'",'+
      '"left":"'+slideContentAlignH+'",'+
      '"transform":"translate(-'+slideContentAlignH+', -'+slideContentAlignV+')",'+
      '"-ms-transform":"translate(-'+slideContentAlignH+', -'+slideContentAlignV+')",'+
      '"-webkit-transform":"translate(-'+slideContentAlignH+', -'+slideContentAlignV+')",'+
      slideContentAlignHMargin + slideContentAlignVMargin
    ;

  var currWidgetContentDefaultResponsive  = ''+
    '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-l') ) { "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content').css({"+
            "'width':'"+widget_imageSlider['slideContentWidth']+widget_imageSlider['slideContentWUnit']+"',"+
            "'text-align':'"+widget_imageSlider['slideContentAlign']+"',"+
            slideContentAlignmentCss+
          "}); "+
          
        "}"+
        "});"+

        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-l' ) { "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content').css({"+
            "'width':'"+widget_imageSlider['slideContentWidth']+widget_imageSlider['slideContentWUnit']+"',"+
            "'text-align':'"+widget_imageSlider['slideContentAlign']+"',"+
            slideContentAlignmentCss+
          "}); "+
        
        "}"+
    '</script>'
  ;


    slideContentAlignVMargin = '';

    if (widget_imageSlider['slideContentAlignVT'] == 'middle') {
      slideContentAlignV = '50%';
    }

    if (widget_imageSlider['slideContentAlignVT'] == 'top') {
      slideContentAlignV = '0%';
    }
    if (widget_imageSlider['slideContentAlignVT'] == 'bottom') {
      slideContentAlignV = '0%';
      slideContentAlignVMargin = "'bottom':'0%', 'top':'inherit',";
    }

    slideContentAlignHMargin = '';
    if (widget_imageSlider['slideContentAlignHT'] == 'center') {
      slideContentAlignH = '50%';
      slideContentAlignHMargin = "'margin':'0 auto',";
    }
    
    if (widget_imageSlider['slideContentAlignHT'] == 'left') {
      slideContentAlignH = '0%';
    }

    if (widget_imageSlider['slideContentAlignHT'] == 'right') {
      slideContentAlignH = '0%';
      slideContentAlignHMargin = "'left':'inherit', 'right':'0',";
    }

    slideContentAlignmentCss =
      '"top":"'+slideContentAlignV+'",'+
      '"left":"'+slideContentAlignH+'",'+
      '"transform":"translate(-'+slideContentAlignH+', -'+slideContentAlignV+')",'+
      '"-ms-transform":"translate(-'+slideContentAlignH+', -'+slideContentAlignV+')",'+
      '"-webkit-transform":"translate(-'+slideContentAlignH+', -'+slideContentAlignV+')",'+
      slideContentAlignHMargin + slideContentAlignVMargin
    ;

  var currWidgetContentTabletResponsive  = ''+
    '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-m') ) { "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content').css({"+
            "'width':'"+widget_imageSlider['slideContentWidthT']+widget_imageSlider['slideContentWUnitT']+"',"+
            "'text-align':'"+widget_imageSlider['slideContentAlignT']+"',"+
            slideContentAlignmentCss+
          "}); "+
          
        "}"+
        "});"+
        
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-m' ) { "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content').css({"+
            "'width':'"+widget_imageSlider['slideContentWidthT']+widget_imageSlider['slideContentWUnitT']+"',"+
            "'text-align':'"+widget_imageSlider['slideContentAlignT']+"',"+
            slideContentAlignmentCss+
          "}); "+
        
        "}"+
    '</script>'
  ;


    slideContentAlignVMargin = '';

    if (widget_imageSlider['slideContentAlignVM'] == 'middle') {
      slideContentAlignV = '50%';
    }

    if (widget_imageSlider['slideContentAlignVM'] == 'top') {
      slideContentAlignV = '0%';
    }
    if (widget_imageSlider['slideContentAlignVM'] == 'bottom') {
      slideContentAlignV = '0%';
      slideContentAlignVMargin = "'bottom':'0%', 'top':'inherit',";
    }

    slideContentAlignHMargin = '';
    if (widget_imageSlider['slideContentAlignHM'] == 'center') {
      slideContentAlignH = '50%';
      slideContentAlignHMargin = "'margin':'0 auto',";
    }
    
    if (widget_imageSlider['slideContentAlignHM'] == 'left') {
      slideContentAlignH = '0%';
    }

    if (widget_imageSlider['slideContentAlignHM'] == 'right') {
      slideContentAlignH = '0%';
      slideContentAlignHMargin = "'left':'inherit', 'right':'0',";
    }

    slideContentAlignmentCss =
      '"top":"'+slideContentAlignV+'",'+
      '"left":"'+slideContentAlignH+'",'+
      '"transform":"translate(-'+slideContentAlignH+', -'+slideContentAlignV+')",'+
      '"-ms-transform":"translate(-'+slideContentAlignH+', -'+slideContentAlignV+')",'+
      '"-webkit-transform":"translate(-'+slideContentAlignH+', -'+slideContentAlignV+')",'+
      slideContentAlignHMargin + slideContentAlignVMargin
    ;


  var currWidgetContentMobileResponsive  = ''+
    '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-s') ) { "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content').css({"+
            "'width':'"+widget_imageSlider['slideContentWidthM']+widget_imageSlider['slideContentWUnitM']+"',"+
            "'text-align':'"+widget_imageSlider['slideContentAlignM']+"',"+
            slideContentAlignmentCss+
          "}); "+
          
        "}"+
        "});"+
        
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-s' ) { "+

          "jQuery('#"+pbImageSliderUniqueId+" .popb_slide_content').css({"+
            "'width':'"+widget_imageSlider['slideContentWidthM']+widget_imageSlider['slideContentWUnitM']+"',"+
            "'text-align':'"+widget_imageSlider['slideContentAlignM']+"',"+
            slideContentAlignmentCss+
          "}); "+
        
        "}"+
    '</script>'
  ;



  var thisRenderredWidget = {
    WidgetHtml: pbSliderContainer  +  pbSliderAllSlides  +   pbSliderContainerClose   + pbSliderStyling,
    WidgetScript: pbSliderScript + currWidgetDefaultResponsive + currWidgetTabletResponsive + currWidgetMobileResponsive + currWidgetContentDefaultResponsive + currWidgetContentTabletResponsive + currWidgetContentMobileResponsive,
  }
  return  thisRenderredWidget;

}



function progressBarWidgetRender(this_widget_progressBar){
  
  pbProgressBarTitle = this_widget_progressBar['pbProgressBarTitle'];
  pbProgressBarPrecentage = this_widget_progressBar['pbProgressBarPrecentage'];
  pbProgressBarText = this_widget_progressBar['pbProgressBarText'];
  pbProgressBarDisplayPrecentage = this_widget_progressBar['pbProgressBarDisplayPrecentage'];
  pbProgressBarTitleColor = this_widget_progressBar['pbProgressBarTitleColor'];
  pbProgressBarTextColor = this_widget_progressBar['pbProgressBarTextColor'];
  pbProgressBarColor = this_widget_progressBar['pbProgressBarColor'];
  pbProgressBarBgColor = this_widget_progressBar['pbProgressBarBgColor'];
  pbProgressBarTitleSize = this_widget_progressBar['pbProgressBarTitleSize'];
  pbProgressBarHeight = this_widget_progressBar['pbProgressBarHeight'];
  pbProgressBarTextSize = this_widget_progressBar['pbProgressBarTextSize'];
  
  if (typeof(this_widget_progressBar['pbProgressBarTextFontFamily']) != 'undefined') {
    pbProgressBarTextFontFamily = this_widget_progressBar['pbProgressBarTextFontFamily'];
  } else{
    pbProgressBarTextFontFamily = ' none';
  }

  if (pbProgressBarDisplayPrecentage !== '%') {
    pbProgressBarDisplayPrecentage = '';
  }
  pbProgressBarUniqueId = 'pb_progressBar_'+Math.floor((Math.random() * 2000) + 100);

  pbProgressBarTextFontFamily = pbProgressBarTextFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(pbProgressBarTextFontFamily)) {
    pbProgressBarTextFontFamily = '"'+pbProgressBarTextFontFamily+'"';
  }

  pbProgressBarHTML = '<p style="font-size:'+pbProgressBarTitleSize+'px; color:'+pbProgressBarTitleColor+';line-height:0; font-family:'+pbProgressBarTextFontFamily+',arial,sans-serif; " >'+pbProgressBarTitle+'</p><div id='+pbProgressBarUniqueId+' style="background-color:'+pbProgressBarBgColor+'; height:'+pbProgressBarHeight+'px; position:relative;"> <div style="position:absolute; top:'+pbProgressBarHeight/2+'px; line-height:0; color:'+pbProgressBarTextColor+'; font-size:'+pbProgressBarTextSize+'px; left:2%; font-family:'+pbProgressBarTextFontFamily+',arial,sans-serif; ">'+pbProgressBarText+'</div>  <div class="progressBarNumber" style="position:absolute;left:'+(pbProgressBarPrecentage-4)+'%; top:'+pbProgressBarHeight/2+'px; line-height:0; color:'+pbProgressBarTextColor+'; font-size:'+pbProgressBarTextSize+'px; font-family:'+pbProgressBarTextFontFamily+',arial,sans-serif; "></div>   </div>';

  pbProgressBarScript = '<script> var thisProgressBar_'+pbProgressBarUniqueId+' = jQuery( "#'+pbProgressBarUniqueId+'" ); var progressNumber_'+pbProgressBarUniqueId+' = jQuery("#'+pbProgressBarUniqueId+'  .progressBarNumber");   thisProgressBar_'+pbProgressBarUniqueId+'.progressbar({ value: 0, change: function(){ progressNumber_'+pbProgressBarUniqueId+'.text(thisProgressBar_'+pbProgressBarUniqueId+'.progressbar("value")+ "'+pbProgressBarDisplayPrecentage+'");   progressNumber_'+pbProgressBarUniqueId+'.css("left",thisProgressBar_'+pbProgressBarUniqueId+'.progressbar("value")-10 + "%");   }   }); function '+pbProgressBarUniqueId+'_pb_progress() { var val = thisProgressBar_'+pbProgressBarUniqueId+'.progressbar( "value" ) || 0;  thisProgressBar_'+pbProgressBarUniqueId+'.progressbar( "value", val + 1 );  if ( val <= '+(pbProgressBarPrecentage -2)+' ) { setTimeout( '+pbProgressBarUniqueId+'_pb_progress, 20 ); } } setTimeout( '+pbProgressBarUniqueId+'_pb_progress, 1000 );  </script>    <style> #'+pbProgressBarUniqueId+' .ui-progressbar-value{background-color:'+pbProgressBarColor+' !important; } </style>  ' + '\n <link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+pbProgressBarTextFontFamily+'">';
  


  pbProgressBarHTMLContainer = pbProgressBarHTML;
  var thisRenderredWidget = {
    WidgetHtml: pbProgressBarHTMLContainer,
    WidgetScript: pbProgressBarScript,
  }
  return thisRenderredWidget;
}

function pricingWidgetRender(this_widget_pricing, j, rowID, this_column_type,this_column){
  
  pbPricingHeaderText = this_widget_pricing['pbPricingHeaderText'];
  pbPricingContent = this_widget_pricing['pbPricingContent'];
  pbPricingHeaderTextColor = this_widget_pricing['pbPricingHeaderTextColor'];
  pbPricingHeaderBgColor = this_widget_pricing['pbPricingHeaderBgColor'];
  pbPricingHeaderTextSize = this_widget_pricing['pbPricingHeaderTextSize'];
  pbPricingBorderWidth = this_widget_pricing['pbPricingBorderWidth'];
  pbPricingBorderColor = this_widget_pricing['pbPricingBorderColor'];


  if (pbPricingHeaderText !== '') {

    if (typeof(pbPricingHeaderText) == 'undefined') { pbPricingHeaderText = ''; }
    if ( pbPricingHeaderText.includes('defaultELt') ) {
    }else{
      pbPricingHeaderText = "<span class='elLtWrapped defaultELt'> " +pbPricingHeaderText+" </span> <div class='ltwFontScript' style='display:none;'></div>";
    }
  
    var pricingHeaderEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-parentWidgetId='"+rowID+'-'+this_column+"'  data-fieldName='pbPricingHeaderText'></div>";
  var headerContentWrapped =  pricingHeaderEditingSaveTriggerBtn +" <div class='wltControls' style='display:none;'></div> <div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'> <span contenteditable='true' class='eltEditable' >  " +pbPricingHeaderText+ ' </span> </div> ';

    var pricingHeader = '<div class="pb_prcingHeader" style="color:'+pbPricingHeaderTextColor+'; background:'+pbPricingHeaderBgColor+'; font-size:'+pbPricingHeaderTextSize+'px; width:100%; text-align:center; padding:30px 0 35px 0; border-bottom:1px solid '+pbPricingBorderColor+';"> <b>'+headerContentWrapped+'</b> </div>';
  } else{
    pricingHeader = '';
  }


              var btnText = this_widget_pricing['pricingbtnText'];
              var pricingbtnLink = this_widget_pricing['pricingbtnLink'];
              var btnBgColor = this_widget_pricing['pricingbtnBgColor'];
              var btnTextColor = this_widget_pricing['pricingbtnTextColor'];
              var btnFontSize = this_widget_pricing['pricingbtnFontSize'];
              var btnHoverBgColor = this_widget_pricing['pricingbtnHoverBgColor'];
              var btnHoverTextColor = this_widget_pricing['pricingbtnHoverTextColor'];
              var btnWidth = this_widget_pricing['pricingbtnWidth'];
              var btnHeight = this_widget_pricing['pricingbtnHeight'];
              var btnBlankAttr = this_widget_pricing['pricingbtnBlankAttr'];
              var btnBorderColor = this_widget_pricing['pricingbtnBorderColor'];
              var btnBorderWidth = this_widget_pricing['pricingbtnBorderWidth'];
              var btnBorderRadius = this_widget_pricing['pricingbtnBorderRadius'];
              var btnButtonAlignment = this_widget_pricing['pricingbtnButtonAlignment'];
              pbPricingButtonSectionBgColor = this_widget_pricing['pbPricingButtonSectionBgColor'];
              
              pbWidgetBtnId = 'pb_btn_'+Math.floor((Math.random() * 2000) + 100);

              if (typeof(this_widget_pricing['pricingbtnButtonFontFamily']) != 'undefined') {
                var btnButtonFontFamily = this_widget_pricing['pricingbtnButtonFontFamily'];
              } else{
                var btnButtonFontFamily = 'none';
              }

              btnIcon = ''; btnIconBefore = ''; btnIconAfter = ''; btnIconAnimation = '';
              if (typeof(this_widget_pricing['pricingbtnSelectedIcon']) != 'undefined') {
                btnSelectedIcon = this_widget_pricing['pricingbtnSelectedIcon'];
                btnIconPosition = this_widget_pricing['pricingbtnIconPosition'];
                btnIconAnimation = this_widget_pricing['pricingbtnIconAnimation'];
                btnIconGap = this_widget_pricing['pricingbtnIconGap'];

                if (btnSelectedIcon != '') {
                  if (btnIconPosition == 'before') {
                    btnIconGap = 'margin-right:'+btnIconGap+'px;';
                  }else{
                    btnIconGap = 'margin-left:'+btnIconGap+'px;';
                  }

                  if (typeof(btnSelectedIcon) == 'undefined') { btnSelectedIcon = ' '; }
                  if (btnSelectedIcon == '') { btnSelectedIcon = ' '; }
                  faClassAppend = 'fa';
                  if (btnSelectedIcon.indexOf("fab") >= 0 || btnSelectedIcon.indexOf("fas") >= 0 || btnSelectedIcon.indexOf("far") >= 0)  {
                    faClassAppend = '';
                  }

                  btnIcon = '<i style="'+btnIconGap+'" class="'+faClassAppend+' '+btnSelectedIcon+'"></i>';
                }else{
                  btnIcon = '';
                }

                if (btnIconPosition == 'before') {
                  btnIconBefore = btnIcon;
                  btnIconAfter = '';
                }else{
                  btnIconAfter = btnIcon;
                  btnIconBefore = '';
                }
              }

              var btn_width = "padding: "+btnHeight+"px "+btnWidth+"px !important;";
              if (typeof(this_widget_pricing['pricingbtnWidthPercent']) != 'undefined') {
                var btnWidthPercent = this_widget_pricing['pricingbtnWidthPercent'];
                if (btnWidthPercent !== '') {
                  var btn_width = "padding: "+btnHeight+"px "+'5'+"px !important; width:"+btnWidthPercent+"%;";
                }
                
              } else{
                var btnWidthPercent = 'none';
              }

              var btnWidthUnit = '%';
              var btnWidthUnitTablet = '%';
              var btnWidthUnitMobile = '%';
              if (typeof(this_widget_pricing['pricingbtnWidthUnit']) != 'undefined') {
                btnWidthUnit = this_widget_pricing['pricingbtnWidthUnit'];
                btnWidthUnitTablet = this_widget_pricing['pricingbtnWidthUnitTablet'];
                btnWidthUnitMobile = this_widget_pricing['pricingbtnWidthUnitMobile'];
              }

              

              btnTextWrapped = ' '+btnIconBefore+' '+btnText+' '+btnIconAfter+' ';

              var btnTextEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-parentWidgetId='"+rowID+'-'+this_column+"'  data-fieldName='pricingbtnText'></div>";

              if ( btnText.includes('defaultELt') ) {
              }else{
                btnText = "<span class='elLtWrapped defaultELt'> " +btnText+" </span> <div class='ltwFontScript' style='display:none;'></div>";
              }

              var btnTextWrapped =  btnTextEditingSaveTriggerBtn + " <div class='wltControls' style='display:none;'></div> <div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'> "+btnIconBefore+" <span contenteditable='true' class='eltEditable' > " +btnText+'   </span> '+btnIconAfter+' </div> ';

              btnButtonFontFamily = btnButtonFontFamily.replace(/\+/g, ' ');
              if (popb_hasNumber(btnButtonFontFamily)) {
                btnButtonFontFamily = '"'+btnButtonFontFamily+'"';
              }

              var this_widget_btn_complete = 
                "<div class='wdt-"+'pricingButton'+" parent-"+pbWidgetBtnId+"' style='text-align:"+btnButtonAlignment+"; margin:0 0 2px 0; padding:0;' >"+
                  "<button id='"+pbWidgetBtnId+"' style='color:"+btnTextColor+" !important;font-size:"+btnFontSize+"px !important; background: "+btnBgColor+" !important; background-color: "+btnBgColor+" !important;  border: "+btnBorderWidth+"px solid "+btnBorderColor+" !important; border-radius: "+btnBorderRadius+"px !important; font-family:"+btnButtonFontFamily+" ,sans-serif; "+btn_width+" ' disabled >   "+btnTextWrapped+"  </button>"+
                "</div>"+
                "<style> #"+pbWidgetBtnId+":hover {background:"+btnHoverBgColor+" !important; color:"+btnHoverTextColor+" !important; transition: all .5s;}  </style>";

                  var currButtonWidgetDefaultResponsive  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-l') ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+btnFontSize+"px', 'width':'"+btnWidthPercent+btnWidthUnit+"', 'padding-top':'"+btnHeight+"px', 'padding-bottom':'"+btnHeight+"px', }); "+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignment+"', });"+
                      " }"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      " if ( currentVPS == 'rbt-l' ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+btnFontSize+"px', 'width':'"+btnWidthPercent+btnWidthUnit+"', 'padding-top':'"+btnHeight+"px', 'padding-bottom':'"+btnHeight+"px', });"+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignment+"', }); "+
                      
                      "}"+
                      " "+
                      '</script> ';

                  btnButtonAlignmentTablet = ''; btnButtonAlignmentMobile = '';
                  if (typeof(this_widget_pricing['pricingbtnButtonAlignmentTablet']) != 'undefined') {
                    btnButtonAlignmentTablet = this_widget_pricing['pricingbtnButtonAlignmentTablet'];
                    btnButtonAlignmentMobile = this_widget_pricing['pricingbtnButtonAlignmentMobile'];
                  }
                  currButtonWidgetDefaultResponsiveTablet = '';
                  currButtonWidgetDefaultResponsiveMobile = '';
                  if (typeof(this_widget_pricing['pricingbtnFontSizeTablet']) !== 'undefined') {
                    var currButtonWidgetDefaultResponsiveTablet  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-m') ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+this_widget_pricing['pricingbtnFontSizeTablet']+"px', 'width':'"+this_widget_pricing['pricingbtnWidthPercentTablet']+btnWidthUnitTablet+"', 'padding-top':'"+this_widget_pricing['pricingbtnHeightTablet']+"px', 'padding-bottom':'"+this_widget_pricing['pricingbtnHeightTablet']+"px', }); "+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignmentTablet+"', }); "+
                      "}"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-m' ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+this_widget_pricing['pricingbtnFontSizeTablet']+"px', 'width':'"+this_widget_pricing['pricingbtnWidthPercentTablet']+btnWidthUnitTablet+"', 'padding-top':'"+this_widget_pricing['pricingbtnHeightTablet']+"px', 'padding-bottom':'"+this_widget_pricing['pricingbtnHeightTablet']+"px', }); "+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignmentTablet+"', }); "+
                      "}"+
                      " "+
                      '</script> ';

                    var currButtonWidgetDefaultResponsiveMobile  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-s') ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+this_widget_pricing['pricingbtnFontSizeMobile']+"px', 'width':'"+this_widget_pricing['pricingbtnWidthPercentMobile']+btnWidthUnitMobile+"', 'padding-top':'"+this_widget_pricing['pricingbtnHeightMobile']+"px', 'padding-bottom':'"+this_widget_pricing['pricingbtnHeightMobile']+"px', }); "+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignmentMobile+"', }); "+
                      " }"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-s' ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+this_widget_pricing['pricingbtnFontSizeMobile']+"px', 'width':'"+this_widget_pricing['pricingbtnWidthPercentMobile']+btnWidthUnitMobile+"', 'padding-top':'"+this_widget_pricing['pricingbtnHeightMobile']+"px', 'padding-bottom':'"+this_widget_pricing['pricingbtnHeightMobile']+"px', });"+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignmentMobile+"', }); "+
                      
                      "}"+
                      " "+
                      '</script> ';

                  }

                  currButtonWidgetResponsiveScripts = '\n' + currButtonWidgetDefaultResponsive + '\n' + currButtonWidgetDefaultResponsiveTablet + '\n' + currButtonWidgetDefaultResponsiveMobile;

                var thisWidgetFonts = '<link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+btnButtonFontFamily+'">';
                this_widget_btn_complete = this_widget_btn_complete + thisWidgetFonts;






    
  if (pricingbtnLink !== '') {
    var pricingButton = "<br><div class='wdt-this_column_type' style='text-align:"+btnButtonAlignment+"; padding:20px 0 40px 0; background:"+pbPricingButtonSectionBgColor+";'>"+this_widget_btn_complete+"</div>";
  }else{
    pricingButton = '';
  }


  var pricingTextEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-parentWidgetId='"+rowID+'-'+this_column+"'  data-fieldName='pbPricingContent'></div>";
  
  if (typeof(pbPricingContent) == 'undefined') { pbPricingContent = ''; }
  if ( pbPricingContent.includes('defaultELt') ) {
  }else{
    pbPricingContent = "<span class='elLtWrapped defaultELt'> " +pbPricingContent+" </span> <div class='ltwFontScript' style='display:none;'></div>";
  }

  var pbPricingContentWrapped =  pricingTextEditingSaveTriggerBtn +" <div class='wltControls' style='display:none;'></div> <div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'> <span contenteditable='true' class='eltEditable' >  " +pbPricingContent+ '  </span> </div> ';

  var pricingContainer = '<div class="pb_pricingContainer"  style="border:'+pbPricingBorderWidth+'px solid '+pbPricingBorderColor+'; border-radius:5px; box-shadow:0px 0px 10px '+pbPricingBorderColor+';"> '+pricingHeader+' <div>'+pbPricingContentWrapped+'</div> '+pricingButton+' </div>';

  var thisRenderredWidget = {
    WidgetHtml: pricingContainer,
    WidgetScript: currButtonWidgetResponsiveScripts,
  }

  return thisRenderredWidget;
}

function imgCarouselWidgetRender(this_widget_img_carousel){
  
  pbImgCarouselAutoplay = this_widget_img_carousel['pbImgCarouselAutoplay'];
  pbImgCarouselDelay = this_widget_img_carousel['pbImgCarouselDelay'];
  imgCarouselSlideLoop = this_widget_img_carousel['imgCarouselSlideLoop'];
  imgCarouselSlideTransition = this_widget_img_carousel['imgCarouselSlideTransition'];
  imgCarouselPagination = this_widget_img_carousel['imgCarouselPagination'];
  pbImgCarouselNav = this_widget_img_carousel['pbImgCarouselNav'];
  imgCarouselSlidesURL = this_widget_img_carousel['imgCarouselSlidesURL'];

  if (typeof(this_widget_img_carousel['pbImgCarouselSlides']) == 'undefined') {
    this_widget_img_carousel['pbImgCarouselSlides'] = '4';
  }
  pbImgCarouselSlides = this_widget_img_carousel['pbImgCarouselSlides'];

  if (pbImgCarouselSlides == '1') {
    singleItem = 'true';
  }else{
    singleItem = 'false';
  }

  pbImgCarouselUniqueId = 'pb_imgCarousel_'+Math.floor((Math.random() * 2000) + 100);

  pbCarouselAllSlides = '';
  jQuery.each(imgCarouselSlidesURL,function(index, val){
    pbSliderPrevSlides = pbCarouselAllSlides;
    pbSliderThisSlide = "<div class='carouselSingleSlide'> <img src='"+val+"' alt='slideImg' style='width:100%;' ></div>";
    pbCarouselAllSlides = pbSliderPrevSlides +  pbSliderThisSlide;
  });


  pbCarouselScript = "<script> "+

  "jQuery('#"+pbImgCarouselUniqueId+"').owlCarousel({"+
    "singleItem: "+singleItem+","+
    "items: "+pbImgCarouselSlides+","+
    "autoPlay : "+pbImgCarouselAutoplay+","+
    "stopOnHover : true,"+
    "navigation: "+pbImgCarouselNav+" ,"+
    "paginationSpeed : "+pbImgCarouselDelay+"00,"+
    "goToFirstSpeed : "+pbImgCarouselDelay+"00,"+
    "autoHeight : true,"+
    "slideSpeed : "+pbImgCarouselDelay+"000,"+
    "transitionStyle: '"+imgCarouselSlideTransition+"',"+
    "pagination : "+imgCarouselPagination+","+
    "paginationNumbers: false,"+
    "navigationText : ['<span class=\"dashicons dashicons-arrow-left-alt2\" > </span>',"+
    "'<span class=\"dashicons dashicons-arrow-right-alt2\" > </span>'],"+
    "theme: 'pbOwl-theme',"+
    "baseClass: 'pbOwl-carousel' ,"+
    "  "+
    "}); "+
    "</script>";

  pbCarouselSlidesWrapper = '<div  id='+pbImgCarouselUniqueId+' class="pbOwl-carousel">' +pbCarouselAllSlides+ '</div>';

  var thisRenderredWidget = {
    WidgetHtml: pbCarouselSlidesWrapper,
    WidgetScript: pbCarouselScript,
  }
  return thisRenderredWidget ;
}

function wooCommerceWidgetRender(this_widget_wooCommerceProducts){

  var wooProductsColumn = this_widget_wooCommerceProducts['wooProductsColumn'];
  var wooProductsCount = this_widget_wooCommerceProducts['wooProductsCount'];
  var wooProductsCategories = this_widget_wooCommerceProducts['wooProductsCategories'];
  //var wooProductsTags = this_widget_wooCommerceProducts['wooProductsTags'];
  var wooProductsOrderBy = this_widget_wooCommerceProducts['wooProductsOrderBy'];
  var wooProductsOrder = this_widget_wooCommerceProducts['wooProductsOrder'];

  var generateWooProductsShortcode = '[products columns="'+wooProductsColumn+'" per_page="'+wooProductsCount+'" orderby="'+wooProductsOrderBy+'" order="'+wooProductsOrder+'" ]';

  if (wooProductsCategories !== '') {
    var generateWooProductsShortcode = '[product_category columns="'+wooProductsColumn+'" per_page="'+wooProductsCount+'" orderby="'+wooProductsOrderBy+'" order="'+wooProductsOrder+'" category="'+wooProductsCategories+'" ]';
  }

  if (wooProductsOrderBy == 'popularity') {
    var generateWooProductsShortcode = '[best_selling_products columns="'+wooProductsColumn+'" per_page="'+wooProductsCount+'" orderby="'+wooProductsOrderBy+'" order="'+wooProductsOrder+'" category="'+wooProductsCategories+'" ]';
  }

  generateWooProductsShortcode = generateWooProductsShortcode.replace(/['"]+/g, '');
  var shortCodeContainerUniqueId = 'pb_shortCodeContainer'+Math.floor((Math.random() * 2000) + 100);
  var shortCodeContent = '<div class="'+shortCodeContainerUniqueId+'">Content Here!</div>'
  shortCodeScript = '<script type="text/javascript">(function(jQuery){ var submit_URl=admURL+"admin-ajax.php?action=ulpb_loadShortcode_content&POPB_Shortcode_nonce="+shortCodeRenderWidgetNO; var result=" ";jQuery.ajax({url:submit_URl,method:"post",data:"ulpb_shortcode='+generateWooProductsShortcode+'",success:function(result){jQuery(".'+shortCodeContainerUniqueId+'").html(result)}}); return false; })(jQuery);</script>';

  var thisRenderredWidget = {
    WidgetHtml: shortCodeContent,
    WidgetScript: shortCodeScript,
  }
  return thisRenderredWidget;
}

function navigationMenuWidgetRender(this_column_menu_content){

  var menuName = this_column_menu_content['menuName'];
  var menuStyle = this_column_menu_content['menuStyle'];
  var menuColor = this_column_menu_content['menuColor'];

  if (typeof(this_column_menu_content['pbMenuFontFamily']) != 'undefined') {
    pbMenuFontFamily = this_column_menu_content['pbMenuFontFamily'];
  } else{
    pbMenuFontFamily = ' none';
  }

  if (typeof(this_column_menu_content['pbMenuFontHoverColor']) != 'undefined') {
    pbMenuFontHoverColor = this_column_menu_content['pbMenuFontHoverColor'];
  } else{
    pbMenuFontHoverColor = '';
  }
  if (typeof(this_column_menu_content['pbMenuFontHoverBgColor']) != 'undefined') {
    pbMenuFontHoverBgColor = this_column_menu_content['pbMenuFontHoverBgColor'];
  } else{
    pbMenuFontHoverBgColor = '';
  }
  if (typeof(this_column_menu_content['pbMenuFontSize']) != 'undefined') {
    pbMenuFontSize = this_column_menu_content['pbMenuFontSize'];
  } else{
    pbMenuFontSize = '';
  }

  var logoURL = jQuery('.pageLogoUrl ').val();

  pbMenuFontFamily = pbMenuFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(pbMenuFontFamily)) {
    pbMenuFontFamily = '"'+pbMenuFontFamily+'"';
  }

  this_widget_nav_shortcode = "[pb_samlple_nav pb_menu='"+menuName+"'    pb_logo_url='"+logoURL+"' menucolor='"+menuColor+"'  menu_class='"+menuStyle+"' menu_font='"+pbMenuFontFamily+"' menu_fonthovercolor='"+pbMenuFontHoverColor+"' menu_fonthoverbgcolor='"+pbMenuFontHoverBgColor+"' menu_fontsize='"+pbMenuFontSize+"' ]";


  var shortCodeContainerUniqueId = 'pb_shortCodeContainer'+Math.floor((Math.random() * 2000) + 100);
  var shortCodeContent = '<div class="'+shortCodeContainerUniqueId+'">nav menu!</div>';
  var shortCodeScript = '<script type="text/javascript">(function(jQuery){ var submit_URl=admURL+"admin-ajax.php?action=ulpb_loadShortcode_content&POPB_Shortcode_nonce="+shortCodeRenderWidgetNO; var result=" ";jQuery.ajax({url:submit_URl,method:"post",data:"ulpb_shortcode='+this_widget_nav_shortcode+'",success:function(result){jQuery(".'+shortCodeContainerUniqueId+'").html(result)}}); return false; })(jQuery);</script>'+ '\n <link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+pbMenuFontFamily+'">';

  var thisRenderredWidget = {
    WidgetHtml: shortCodeContent,
    WidgetScript: shortCodeScript,
  }
  return thisRenderredWidget;
}


function pluginopsOptinWidgetRender(this_widget){
  
  var optinID = this_widget['widgetOptinId'];
  
  var shortCodeContainerUniqueId = 'pb_shortCodeContainer'+Math.floor((Math.random() * 2000) + 100);
  var shortCodeScript = '';
  if (optinID != '' && optinID != 'Select') {
    var shortCodeContent = '<div id="" title="Optin Widget" style="text-align:center; font-size:15px; padding:5px 0; width:100%; background:#afafaf; color:#fff; "> <i class="fas fa-check" style="color:#3ae841;"></i> <p> The Optin will be rendered on front end of page. </p> </div>';
  }else{
    var shortCodeContent = '<div class=" '+shortCodeContainerUniqueId+'">  </div>';
    var shortCodeContent = '<div id="" title="Optin Widget" style="text-align:center; font-size:15px; padding:5px 0; width:100%; background:#afafaf; color:#fff; ">  <i class="fas fa-times" style="color:#f44336;" ></i> <p> Please edit this widget & select the Optin from dropdown list. </p> </div>';
  }

  var thisRenderredWidget = {
    WidgetHtml: shortCodeContent,
    WidgetScript: shortCodeScript,
  }
  return thisRenderredWidget;
}

function iconListWidgetRender(this_widget){

  iconListLineHeight = this_widget['iconListLineHeight'];
  iconListAlignment = this_widget['iconListAlignment'];
  iconListIconSize = this_widget['iconListIconSize'];
  iconListIconColor = this_widget['iconListIconColor'];
  iconListTextSize = this_widget['iconListTextSize'];
  iconListTextIndent = this_widget['iconListTextIndent'];
  iconListTextColor = this_widget['iconListTextColor'];
  iconListItemLinkOpen = this_widget['iconListItemLinkOpen'];
  iconListComplete = this_widget['iconListComplete'];

  iconListTextFontFam  = '';
  iconListTextFontFamily = '';
  if (typeof(this_widget['iconListTextFontFamily']) != 'undefined') {
    iconListTextFontFam = this_widget['iconListTextFontFamily'];
    iconListTextFontFamily = this_widget['iconListTextFontFamily'];
  }

  iconListTextFontFamily = iconListTextFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(iconListTextFontFamily)) {
    iconListTextFontFamily = '"'+iconListTextFontFamily+'"';
  }

  iconListIconSizeTablet = ''; iconListIconSizeMobile = '';
  iconListTextSizeTablet = ''; iconListTextSizeMobile = '';
  iconListTextIndentTablet = ''; iconListTextIndentMobile = '';
  
    iconListIconSizeTablet = this_widget['iconListIconSizeTablet'];
    iconListIconSizeMobile = this_widget['iconListIconSizeMobile'];

    iconListTextSizeTablet = this_widget['iconListTextSizeTablet'];
    iconListTextSizeMobile = this_widget['iconListTextSizeMobile'];

    iconListTextIndentTablet = this_widget['iconListTextIndentTablet'];
    iconListTextIndentMobile = this_widget['iconListTextIndentMobile'];

  pbIconListAllItems = '';
  jQuery.each(iconListComplete,function(index, val){

    if (typeof(val['iconListItemIcon']) == 'undefined') { val['iconListItemIcon'] = ' '; }
    if (val['iconListItemIcon'] == '') { val['iconListItemIcon'] = ' '; }
    faClassAppend = 'fa';
    if (val['iconListItemIcon'].indexOf("fab") >= 0 || val['iconListItemIcon'].indexOf("fas") >= 0 || val['iconListItemIcon'].indexOf("far") >= 0)  {
      faClassAppend = '';
    }

    pbThisListIcon = '<i class=" '+faClassAppend+' '+val['iconListItemIcon']+'"></i>';
    if (val['iconListItemLink'] !== '') {
      pbThisListItemLinkOpen = '<a href='+val['iconListItemLink']+' target="_blank" >';
      pbThisListItemLinkClose = '</a>'
    } else{
      pbThisListItemLinkOpen = '';
      pbThisListItemLinkClose = '';
    }
    pbListPrevItem = pbIconListAllItems;
    pbListThisItem = pbThisListItemLinkOpen+ " <li> "+pbThisListIcon+"  <span>"+val['iconListItemText']+"</span>  </li> " + pbThisListItemLinkClose;
    pbIconListAllItems = pbListPrevItem +  pbListThisItem;
  });

  pbIconListUniqueId = 'pb_IconList_'+Math.floor((Math.random() * 2000) + 100);

  flexAlignment = iconListAlignment;
  if (iconListAlignment == 'left') {
    flexAlignment = 'flex-start';
  }
  if (iconListAlignment == 'right') {
    flexAlignment = 'flex-end';
  }

  pbIconListUniqueStyles = ' <style> #'+pbIconListUniqueId+' { text-align:'+iconListAlignment+'; text-decoration:none; }  #'+pbIconListUniqueId+' li { margin-top:'+iconListLineHeight+'px; display:flex; align-items: center; justify-content:'+flexAlignment+';}  #'+pbIconListUniqueId+' li i { font-size:'+iconListIconSize+'px; color:'+iconListIconColor+';  } #'+pbIconListUniqueId+' li span { font-size:'+iconListTextSize+'px; color:'+iconListTextColor+';  margin-left:'+iconListTextIndent+'px; font-family:'+iconListTextFontFamily+';  line-height:'+iconListLineHeight+'px; }  #'+pbIconListUniqueId+' a { text-decoration:none; } </style>  ' + '\n <link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+iconListTextFontFam+'">';

  var currWidgetDefaultResponsive  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-l') ) { "+

        "  jQuery('#"+pbIconListUniqueId+" li i').animate({'font-size':'"+iconListIconSize+"px', }); "+
        "  jQuery('#"+pbIconListUniqueId+" li span').animate({'font-size':'"+iconListTextSize+"px', 'margin-left':'"+iconListTextIndent+"px', }); "+


        "}"+
        
        " });"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-l' ) { "+

        "  jQuery('#"+pbIconListUniqueId+" li i').animate({'font-size':'"+iconListIconSize+"px', }); "+
        "  jQuery('#"+pbIconListUniqueId+" li span').animate({'font-size':'"+iconListTextSize+"px', 'margin-left':'"+iconListTextIndent+"px', }); "+
        
        "}"+
        " "+
        '</script> ';

  var currWidgetTabletResponsive  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-m') ) { "+

        "  jQuery('#"+pbIconListUniqueId+" li i').animate({'font-size':'"+iconListIconSizeTablet+"px', }); "+
        "  jQuery('#"+pbIconListUniqueId+" li span').animate({'font-size':'"+iconListTextSizeTablet+"px', 'margin-left':'"+iconListTextIndentTablet+"px', }); "+


        "}"+
        
        " });"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-m' ) { "+

        "  jQuery('#"+pbIconListUniqueId+" li i').animate({'font-size':'"+iconListIconSizeTablet+"px', }); "+
        "  jQuery('#"+pbIconListUniqueId+" li span').animate({'font-size':'"+iconListTextSizeTablet+"px', 'margin-left':'"+iconListTextIndentTablet+"px', }); "+
        
        "}"+
        " "+
        '</script> ';

  var currWidgetMobileResponsive  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-s') ) { "+

        "  jQuery('#"+pbIconListUniqueId+" li i').animate({'font-size':'"+iconListIconSizeMobile+"px', }); "+
        "  jQuery('#"+pbIconListUniqueId+" li span').animate({'font-size':'"+iconListTextSizeMobile+"px', 'margin-left':'"+iconListTextIndentMobile+"px', }); "+


        "}"+
        
        " });"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-s' ) { "+

        "  jQuery('#"+pbIconListUniqueId+" li i').animate({'font-size':'"+iconListIconSizeMobile+"px', }); "+
        "  jQuery('#"+pbIconListUniqueId+" li span').animate({'font-size':'"+iconListTextSizeMobile+"px', 'margin-left':'"+iconListTextIndentMobile+"px', }); "+
        
        "}"+
        " "+
        '</script> ';

  pbIconListItemContainer = '<ul id='+pbIconListUniqueId+' > '+pbIconListAllItems+' </ul>';

  var thisRenderredWidget = {
    WidgetHtml: pbIconListItemContainer + pbIconListUniqueStyles,
    WidgetScript: currWidgetDefaultResponsive+currWidgetTabletResponsive+currWidgetMobileResponsive,
  }
  return thisRenderredWidget;
}

function formBuilderWidgetRender(this_widget, j, this_column, rowID, this_column_type ){
 
  widgetPbFbFormFeilds = this_widget['widgetPbFbFormFeilds'];
  widgetPbFbFormFeildOptions = this_widget['widgetPbFbFormFeildOptions'];
  widgetPbFbFormSubmitOptions = this_widget['widgetPbFbFormSubmitOptions'];
  widgetPbFbFormMailChimp = this_widget['widgetPbFbFormMailChimp'];

  formBuilderFieldSize = 'pbField-'+widgetPbFbFormFeildOptions['formBuilderFieldSize'];
  pbFormAllFields = [];

  formBuilderFieldVGap = '2'; formBuilderFieldHGap = '2'; 
  if (typeof(widgetPbFbFormFeildOptions['formBuilderFieldVGap']) != 'undefined') {
    
    if (widgetPbFbFormFeildOptions['formBuilderFieldVGap'] != '') {
      formBuilderFieldVGap = widgetPbFbFormFeildOptions['formBuilderFieldVGap'];
    }
    if (widgetPbFbFormFeildOptions['formBuilderFieldHGap'] != '') {
      formBuilderFieldHGap = widgetPbFbFormFeildOptions['formBuilderFieldHGap'];
    }
  }

  formBuilderBtnVGap = '2'; formBuilderBtnHGap = '3';
  if (typeof(widgetPbFbFormSubmitOptions['formBuilderBtnVGap']) != 'undefined') {
    
    if (widgetPbFbFormSubmitOptions['formBuilderBtnVGap'] != '') {
      formBuilderBtnVGap = widgetPbFbFormSubmitOptions['formBuilderBtnVGap'];
    }
    if (widgetPbFbFormSubmitOptions['formBuilderBtnHGap'] != '') {
      formBuilderBtnHGap = widgetPbFbFormSubmitOptions['formBuilderBtnHGap'];
    }
  }
  pbFormBuilderUniqueIdBtn = Math.floor((Math.random() * 2000) + 100);
  formBuilderbtnIcon = '';formBuilderbtnIconBefore = '';formBuilderbtnIconAfter = '';formBuilderbtnIconAnimation = ''; formBuilderbtnIconHoverAnimationScript = '';
  if (typeof (widgetPbFbFormSubmitOptions['formBuilderbtnSelectedIcon']) != 'undefined') {
    formBuilderbtnSelectedIcon = widgetPbFbFormSubmitOptions['formBuilderbtnSelectedIcon'];
    formBuilderbtnIconPosition = widgetPbFbFormSubmitOptions['formBuilderbtnIconPosition'];
    formBuilderbtnIconAnimation = widgetPbFbFormSubmitOptions['formBuilderbtnIconAnimation'];
    formBuilderbtnIconGap = widgetPbFbFormSubmitOptions['formBuilderbtnIconGap'];
    if (formBuilderbtnSelectedIcon != '') {
      if (formBuilderbtnIconPosition == 'before') {
        formBuilderbtnIconGap = 'margin-right:' + formBuilderbtnIconGap + 'px;';
      } else {
        formBuilderbtnIconGap = 'margin-left:' + formBuilderbtnIconGap + 'px;';
      }

      if (typeof(formBuilderbtnSelectedIcon) == 'undefined') { formBuilderbtnSelectedIcon = ' '; }
      if (formBuilderbtnSelectedIcon == '') { formBuilderbtnSelectedIcon = ' '; }
      faClassAppend = 'fa';
      if (formBuilderbtnSelectedIcon.indexOf("fab") >= 0 || formBuilderbtnSelectedIcon.indexOf("fas") >= 0 || formBuilderbtnSelectedIcon.indexOf("far") >= 0)  {
        faClassAppend = '';
      }

      formBuilderbtnIcon = '<i style="' + formBuilderbtnIconGap + '" class="'+faClassAppend+' ' + formBuilderbtnSelectedIcon + ' btnIcon-'+pbFormBuilderUniqueIdBtn+'"></i>';

      if (formBuilderbtnIconAnimation != '') {
        formBuilderbtnIconHoverAnimationScript = " <script>"+
          "jQuery('.form-btn-"+pbFormBuilderUniqueIdBtn+"').mouseenter(function(){"+
            "jQuery('.btnIcon-"+pbFormBuilderUniqueIdBtn+"').addClass('animated "+formBuilderbtnIconAnimation+"').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',function(){ "+
                "jQuery('.btnIcon-"+pbFormBuilderUniqueIdBtn+"').removeClass('animated "+formBuilderbtnIconAnimation+"') "+
            "}); "+
          "});"+
          "</script> " ;
      }

    } else {
      formBuilderbtnIcon = '';
    }
    if (formBuilderbtnIconPosition == 'before') {
      formBuilderbtnIconBefore = formBuilderbtnIcon;
      formBuilderbtnIconAfter = '';
    } else {
      formBuilderbtnIconAfter = formBuilderbtnIcon;
      formBuilderbtnIconBefore = '';
    }
  }

  jQuery.each(widgetPbFbFormFeilds, function(index, val){
    
    
    thisFieldOptions = val['thisFieldOptions'];

    thisFieldOptions['fbFieldPreset'] = escapeSpecChars(thisFieldOptions['fbFieldPreset']);
    thisFieldOptions['fbFieldPlaceHolder'] = escapeSpecChars(thisFieldOptions['fbFieldPlaceHolder']);
    thisFieldOptions['fbFieldRequired'] = escapeSpecChars(thisFieldOptions['fbFieldRequired']);

    var presetValue = '';
    if (typeof(thisFieldOptions['fbFieldPreset']) != 'undefined' ) {
      var presetValue =  `value=\"${thisFieldOptions['fbFieldPreset']}\"`;
    }

    var thisFieldAttr = `style="width:99%;"  placeholder=\"${thisFieldOptions['fbFieldPlaceHolder']}\" required=\"${thisFieldOptions['fbFieldRequired']}\"  id=\"fieldID-${index}\"  ${presetValue} ` ;

    var multiFieldStyleAttr = 'style="margin-right:25px; display:'+thisFieldOptions['displayFieldsInline']+'; line-height:1.4em; "';

    pbThisFormFieldLabel = '<label for="fieldID-'+index+'" class="pbFormLabel"> '+thisFieldOptions['fbFieldLabel']+' </label>';

    switch (val['fbFieldType']) {
      case 'textarea':
           pbThisFormField = '<textarea rows="'+thisFieldOptions['fbtextareaRows']+'" name="textareaField'+index+'" '+thisFieldAttr+' class="pbFormField  '+formBuilderFieldSize+'" ></textarea>';
      break;
      case 'radio':

           multiOptionFieldValues = thisFieldOptions['multiOptionFieldValues'].split('\n');
           allRadioItems = '';

           for (var i =0; i< multiOptionFieldValues.length; i++) {
             thisRadioLabel = '<label for="fieldID-'+index+'-'+i+'">'+multiOptionFieldValues[i]+'</label>';
             thisRadioItem = '<span '+multiFieldStyleAttr+' class="pbFormMultiLabel">  <input type="radio" name="radioField'+index+'" id="fieldID-'+index+'-'+i+'" > ' +thisRadioLabel+ ' </span>';
             
             prevRadioFields = allRadioItems;
             allRadioItems = prevRadioFields +  thisRadioItem;
           }
           pbThisFormField = allRadioItems;

      break;
      case 'checkbox':
           multiOptionFieldValues = thisFieldOptions['multiOptionFieldValues'].split('\n');
           allRadioItems = '';

           for (var i =0; i< multiOptionFieldValues.length; i++) {
             thisRadioLabel = '<label for="fieldID-'+index+'-'+i+'">'+multiOptionFieldValues[i]+'</label>';
             thisRadioItem = '<span '+multiFieldStyleAttr+' class="pbFormMultiLabel">  <input type="checkbox" name="checkField'+index+'" id="fieldID-'+index+'-'+i+'"  > ' +thisRadioLabel+ ' </span>';
             
             prevRadioFields = allRadioItems;
             allRadioItems = prevRadioFields +  thisRadioItem;
           }
           pbThisFormField = allRadioItems;
      break;
      case 'select':
           multiOptionFieldValues = thisFieldOptions['multiOptionFieldValues'].split('\n');
           allRadioItems = '';

           for (var i =0; i< multiOptionFieldValues.length; i++) {

             thisRadioItem = '<option> '+multiOptionFieldValues[i]+' </option> ';
             
             prevRadioFields = allRadioItems;
             allRadioItems = prevRadioFields +  thisRadioItem;
           }


           pbThisFormField = '<select name="selectField'+index+'" id="fieldID-'+index+'"  '+thisFieldAttr+' class="pbFormField  '+formBuilderFieldSize+'">'+ allRadioItems +'</select>';  
      break;
      case 'html':
          if (typeof(thisFieldOptions['fbTextContent']) == 'undefined') { thisFieldOptions['fbTextContent'] = ''; }
          pbThisFormField = '<div class="'+thisFieldOptions['fbFieldName']+' pbFormHTML"  > '+thisFieldOptions['fbTextContent']+'  </div>';
          pbThisFormFieldLabel = '';
      break;
      case 'mcgroups':
        pbThisFormField = '<div class="'+thisFieldOptions['fbFieldName']+' pbFormHTML"  > MailChimp Groups will be loaded on front end. </div>';
          pbThisFormFieldLabel = '';
      break;
      case 'mrgroups':
        pbThisFormField = '<div class="'+thisFieldOptions['fbFieldName']+' pbFormHTML"  > MailRelay Groups will be loaded on front end. </div>';
          pbThisFormFieldLabel = '';
      break;
      default: 
           pbThisFormField = '<input type="'+val['fbFieldType']+'" name="inputField'+index+'" '+thisFieldAttr+' class="pbFormField  '+formBuilderFieldSize+'" autocomplete="off" >';
      break;
    } //switch end

    var hiddenField = '';
    if (val['fbFieldType'] == 'hidden') {
      hiddenField = 'display:none !important;';
    }
      
      pbThisFormFieldWrapped =  '<div style=" '+hiddenField+' width:'+(thisFieldOptions['fbFieldWidth']-parseInt(formBuilderFieldHGap) )+'%; margin-right:'+formBuilderFieldHGap+'%; margin-top:'+formBuilderFieldVGap+'%; display:inline-block;">' + pbThisFormFieldLabel+'\n <br> '+pbThisFormField +'</div>';

      pbFormPrevFields = pbFormAllFields;
      pbFormAllFields = pbFormPrevFields +  pbThisFormFieldWrapped;

  } ); //each loop end

  formBuilderBtnFontFamily = ' '; formBuilderFieldFontFamily = ' ';
  if (typeof(widgetPbFbFormSubmitOptions['formBuilderBtnFontFamily']) != 'undefined' ) {
    if (widgetPbFbFormSubmitOptions['formBuilderBtnFontFamily'] != '') {
      var formBuilderBtnFontFamily = widgetPbFbFormSubmitOptions['formBuilderBtnFontFamily'];
    }
  }
  if (typeof(widgetPbFbFormFeildOptions['formBuilderFieldFontFamily']) != 'undefined') {
    if (widgetPbFbFormFeildOptions['formBuilderFieldFontFamily'] != '') {
      var formBuilderFieldFontFamily = widgetPbFbFormFeildOptions['formBuilderFieldFontFamily'];
    }
  }


  formBuilderBtnFontFamily = formBuilderBtnFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(formBuilderBtnFontFamily)) {
    formBuilderBtnFontFamily = "'"+formBuilderBtnFontFamily+"'";
  }

  pbFormBuilderSubmitStyles = '  width:100%; background:'+widgetPbFbFormSubmitOptions['formBuilderBtnBgColor']+'; color:'+widgetPbFbFormSubmitOptions['formBuilderBtnColor']+'; font-size:'+widgetPbFbFormSubmitOptions['formBuilderBtnFontSize']+'px;  border:'+widgetPbFbFormSubmitOptions['formBuilderBtnBorderWidth']+'px solid '+widgetPbFbFormSubmitOptions['formBuilderBtnBorderColor']+'; border-radius:'+widgetPbFbFormSubmitOptions['formBuilderBtnBorderRadius']+'px; font-family:'+formBuilderBtnFontFamily+', helvetica, arial;  ';
  buttonMargin = '2% 2% 2% 0';
  if (widgetPbFbFormSubmitOptions['formBuilderBtnAlignment'] == 'center') {
    calcMargin = 50 - (widgetPbFbFormSubmitOptions['formBuilderBtnWidth']/2);
    buttonMargin = '2% 2% 2% '+calcMargin+'%';
  } else if(widgetPbFbFormSubmitOptions['formBuilderBtnAlignment'] == 'right') {
    calcMargin = 100 -(widgetPbFbFormSubmitOptions['formBuilderBtnWidth']);
    buttonMargin = '2% 2% 2% '+calcMargin+'%';
  }

  greCaptchaFieldRender = '';
  if (typeof(widgetPbFbFormMailChimp) != 'undefined' ) {
    if ( typeof(widgetPbFbFormMailChimp['fbgreCaptcha']) != 'undefined' ) {
      if ( widgetPbFbFormMailChimp['fbgreCaptcha'] ==  'true') {
        greCaptchaFieldRender = '<script src="https://www.google.com/recaptcha/api.js" async defer></script>'+ "<br><br><div class='g-recaptcha' data-sitekey='"+widgetPbFbFormMailChimp['fbgreCSiteKey']+"'></div>";
      }
    }
  }

  var btnTextEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";


  btnText = widgetPbFbFormSubmitOptions['formBuilderBtnText'];

  if ( btnText.includes('defaultELt') ) {
  }else{
    btnText = "<span class='elLtWrapped defaultELt'> " +btnText+" </span> <div class='ltwFontScript' style='display:none;'></div>";
  }

  var btnTextWrapped =  btnTextEditingSaveTriggerBtn + " <div class='wltControls' style='display:none;'></div> <div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'> "+formBuilderbtnIconBefore+" <span contenteditable='true' class='eltEditable' >  " +btnText+'   </span> '+formBuilderbtnIconAfter+' </div> ';

  pbFormBuilderSubmit = greCaptchaFieldRender + 
    '<div style="text-align:'+widgetPbFbFormSubmitOptions['formBuilderBtnAlignment']+';  width:'+(widgetPbFbFormSubmitOptions['formBuilderBtnWidth']-parseInt(formBuilderBtnHGap) )+'%; margin:'+buttonMargin+'; margin-right:'+formBuilderBtnHGap+'%; margin-top:'+formBuilderBtnVGap+'%;  display:inline-block;"> '+
      '<button  style="'+pbFormBuilderSubmitStyles+'" class="pbField-'+widgetPbFbFormSubmitOptions['formBuilderBtnSize']+' pbFieldBtn  form-btn-'+pbFormBuilderUniqueIdBtn+'" disabled="disabled"> '+btnTextWrapped+' </button>'+
    '</div>'
    ;


  pbFormBuilderUniqueId = 'pb_FormBuilder_'+Math.floor((Math.random() * 2000) + 100);

  pbFormBuilderWrapper = '<form id="'+pbFormBuilderUniqueId+'" autocomplete="off" > <input type="hidden" autocomplete="false" > '+pbFormAllFields+'   '+pbFormBuilderSubmit+' </form>';

  pbFormBuilderStylesID = '#'+pbFormBuilderUniqueId;

  formBuilderFieldFontFamily = formBuilderFieldFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(formBuilderFieldFontFamily)) {
    formBuilderFieldFontFamily = "'"+formBuilderFieldFontFamily+"'";
  }

  pbThisFormBuilderStyles = '<style>'+

    pbFormBuilderStylesID+' .pbFormField { '+
      'background:'+widgetPbFbFormFeildOptions['formBuilderFieldBgColor']+';  color:'+widgetPbFbFormFeildOptions['formBuilderFieldColor']+'; border:'+widgetPbFbFormFeildOptions['formBuilderFieldBorderWidth']+'px solid '+widgetPbFbFormFeildOptions['formBuilderFieldBorderColor']+'; border-radius:'+widgetPbFbFormFeildOptions['formBuilderFieldBorderRadius']+'px; font-family:'+formBuilderFieldFontFamily+', helvetica, arial; '+
    '}'+
    pbFormBuilderStylesID+' .pbFormField::placeholder {'+
      ' color:'+widgetPbFbFormFeildOptions['formBuilderFieldColor']+'; '+
    '}'+
    pbFormBuilderStylesID+' .pbFormLabel{'+
      'font-size:'+widgetPbFbFormFeildOptions['formBuilderLabelSize']+'px; font-family:'+formBuilderFieldFontFamily+', helvetica, arial;  color:'+widgetPbFbFormFeildOptions['formBuilderLabelColor']+'; line-height:3em; '+
    '}'+
    pbFormBuilderStylesID+' .pbFormHTML{'+
      'font-size:'+widgetPbFbFormFeildOptions['formBuilderLabelSize']+'px; font-family:'+formBuilderFieldFontFamily+', helvetica, arial;  color:'+widgetPbFbFormFeildOptions['formBuilderLabelColor']+'; line-height:3em; '+
    '}'+
    pbFormBuilderStylesID+' .pbFormLabel {'+
      'display:'+widgetPbFbFormFeildOptions['formBuilderFieldLabelDisplay']+';'+
    '}'+
    ' '+pbFormBuilderStylesID+' button:hover {'+
      'background:'+widgetPbFbFormSubmitOptions['formBuilderBtnHoverBgColor']+' !important; color:'+widgetPbFbFormSubmitOptions['formBuilderBtnHoverTextColor']+' !important; '+
    '}'+
    pbFormBuilderStylesID+' .pbFormMultiLabel{'+
      'font-size:'+widgetPbFbFormFeildOptions['formBuilderLabelSize']+'px; color:'+widgetPbFbFormFeildOptions['formBuilderLabelColor']+'; '+
    '}'+
    pbFormBuilderStylesID+' button:hover {'+
      'background:'+widgetPbFbFormSubmitOptions['formBuilderBtnHoverBgColor']+' !important; color:'+widgetPbFbFormSubmitOptions['formBuilderBtnHoverTextColor']+' !important; '+
    '}'+
    pbFormBuilderStylesID+' .pbFormMultiLabel label {'+
      'font-family:'+formBuilderFieldFontFamily+', helvetica, arial; '+
    '}'+
  '</style>'+
  '<link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+formBuilderBtnFontFamily+'">'+'<link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+formBuilderFieldFontFamily+'">';



        formBuilderLabelSize = widgetPbFbFormFeildOptions['formBuilderLabelSize'];
        formBuilderBtnFontSize = widgetPbFbFormSubmitOptions['formBuilderBtnFontSize'];
        if (typeof(widgetPbFbFormFeildOptions['formBuilderLabelSizeTablet']) != 'undefined') {
          formBuilderLabelSizeTablet = widgetPbFbFormFeildOptions['formBuilderLabelSizeTablet'];
          formBuilderLabelSizeMobile = widgetPbFbFormFeildOptions['formBuilderLabelSizeMobile'];

          formBuilderBtnFontSizeTablet = widgetPbFbFormSubmitOptions['formBuilderBtnFontSizeTablet'];
          formBuilderBtnFontSizeMobile = widgetPbFbFormSubmitOptions['formBuilderBtnFontSizeMobile'];
        }else{
          formBuilderLabelSizeTablet = '';
          formBuilderLabelSizeMobile = '';
          formBuilderBtnFontSizeTablet = '';
          formBuilderBtnFontSizeMobile = '';
        }

          var currWidgetDefaultResponsive  = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+
              " if (jQuery(this).hasClass('rbt-l') ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" .pbFormLabel').animate({'font-size':'"+formBuilderLabelSize+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" .pbFieldBtn').animate({'font-size':'"+formBuilderBtnFontSize+"px', }); "+

              "}"+
              
              " });"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-l' ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" .pbFormLabel').animate({'font-size':'"+formBuilderLabelSize+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" .pbFieldBtn').animate({'font-size':'"+formBuilderBtnFontSize+"px', }); "+
              
              "}"+
              " "+
              '</script> ';

          var currWidgetTabletResponsive  = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+
              " if (jQuery(this).hasClass('rbt-m') ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" .pbFormLabel').animate({'font-size':'"+formBuilderLabelSizeTablet+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" .pbFieldBtn').animate({'font-size':'"+formBuilderBtnFontSizeTablet+"px', }); "+

              "}"+
              
              " });"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-m' ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" .pbFormLabel').animate({'font-size':'"+formBuilderLabelSizeTablet+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" .pbFieldBtn').animate({'font-size':'"+formBuilderBtnFontSizeTablet+"px', }); "+
              
              "}"+
              " "+
              '</script> ';

          var currWidgetMobileResponsive  = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+
              " if (jQuery(this).hasClass('rbt-s') ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" .pbFormLabel').animate({'font-size':'"+formBuilderLabelSizeMobile+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" .pbFieldBtn').animate({'font-size':'"+formBuilderBtnFontSizeMobile+"px', }); "+

              "}"+
              
              " });"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-s' ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" .pbFormLabel').animate({'font-size':'"+formBuilderLabelSizeMobile+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" .pbFieldBtn').animate({'font-size':'"+formBuilderBtnFontSizeMobile+"px', }); "+
              
              "}"+
              " "+
              '</script> ';



  if (typeof(this_widget['formCustomHTML']) != 'undefined' ) {
    if (this_widget['formCustomHTML'] != '') {
      pbFormBuilderWrapper = '<div id="'+pbFormBuilderUniqueId+'" > '+this_widget['formCustomHTML']+' </div>';

      pbThisFormBuilderStyles = '<style>  '+pbFormBuilderStylesID+' input { margin-top:'+formBuilderFieldVGap+'%;  background:'+widgetPbFbFormFeildOptions['formBuilderFieldBgColor']+';  color:'+widgetPbFbFormFeildOptions['formBuilderFieldColor']+'; border:'+widgetPbFbFormFeildOptions['formBuilderFieldBorderWidth']+'px solid '+widgetPbFbFormFeildOptions['formBuilderFieldBorderColor']+'; border-radius:'+widgetPbFbFormFeildOptions['formBuilderFieldBorderRadius']+'px; font-family:'+formBuilderFieldFontFamily+', helvetica, arial; }  '+pbFormBuilderStylesID+' .pbFormField::placeholder { color:'+widgetPbFbFormFeildOptions['formBuilderFieldColor']+'; }          '+pbFormBuilderStylesID+' label { font-size:'+widgetPbFbFormFeildOptions['formBuilderLabelSize']+'px; color:'+widgetPbFbFormFeildOptions['formBuilderLabelColor']+'; display:'+widgetPbFbFormFeildOptions['formBuilderFieldLabelDisplay']+'; line-height:3em; } '+pbFormBuilderStylesID+' button:hover , '+pbFormBuilderStylesID+' input[type=submit]:hover { background:'+widgetPbFbFormSubmitOptions['formBuilderBtnHoverBgColor']+' !important; color:'+widgetPbFbFormSubmitOptions['formBuilderBtnHoverTextColor']+' !important; }                                                                                 '+pbFormBuilderStylesID+' label{ font-size:'+widgetPbFbFormFeildOptions['formBuilderLabelSize']+'px; color:'+widgetPbFbFormFeildOptions['formBuilderLabelColor']+';} '+pbFormBuilderStylesID+' button:hover , '+pbFormBuilderStylesID+' input[type=submit]:hover { background:'+widgetPbFbFormSubmitOptions['formBuilderBtnHoverBgColor']+' !important; color:'+widgetPbFbFormSubmitOptions['formBuilderBtnHoverTextColor']+' !important; }   '+pbFormBuilderStylesID+' button , '+pbFormBuilderStylesID+' input[type=submit]  { margin-top:'+formBuilderBtnVGap+'%;   width:100%; background:'+widgetPbFbFormSubmitOptions['formBuilderBtnBgColor']+'; color:'+widgetPbFbFormSubmitOptions['formBuilderBtnColor']+'; font-size:'+widgetPbFbFormSubmitOptions['formBuilderBtnFontSize']+'px;  border:'+widgetPbFbFormSubmitOptions['formBuilderBtnBorderWidth']+'px solid '+widgetPbFbFormSubmitOptions['formBuilderBtnBorderColor']+'; border-radius:'+widgetPbFbFormSubmitOptions['formBuilderBtnBorderRadius']+'px; font-family:'+formBuilderBtnFontFamily+', helvetica, arial;  } </style>' + '<link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+formBuilderBtnFontFamily+'">  <link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+formBuilderFieldFontFamily+'">';

        var currWidgetDefaultResponsive  = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+
              " if (jQuery(this).hasClass('rbt-l') ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" label').animate({'font-size':'"+formBuilderLabelSize+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" button , "+pbFormBuilderStylesID+" input[type=submit] ').animate({'font-size':'"+formBuilderBtnFontSize+"px', }); "+

              "}"+
              
              " });"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-l' ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" label').animate({'font-size':'"+formBuilderLabelSize+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" button , "+pbFormBuilderStylesID+" input[type=submit]  ').animate({'font-size':'"+formBuilderBtnFontSize+"px', }); "+
              
              "}"+
              " "+
              '</script> ';

          var currWidgetTabletResponsive  = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+
              " if (jQuery(this).hasClass('rbt-m') ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" label').animate({'font-size':'"+formBuilderLabelSizeTablet+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" button , "+pbFormBuilderStylesID+" input[type=submit]  ').animate({'font-size':'"+formBuilderBtnFontSizeTablet+"px', }); "+

              "}"+
              
              " });"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-m' ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" label').animate({'font-size':'"+formBuilderLabelSizeTablet+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" button , "+pbFormBuilderStylesID+" input[type=submit]  ').animate({'font-size':'"+formBuilderBtnFontSizeTablet+"px', }); "+
              
              "}"+
              " "+
              '</script> ';

          var currWidgetMobileResponsive  = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+
              " if (jQuery(this).hasClass('rbt-s') ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" label').animate({'font-size':'"+formBuilderLabelSizeMobile+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" button , "+pbFormBuilderStylesID+" input[type=submit]  ').animate({'font-size':'"+formBuilderBtnFontSizeMobile+"px', }); "+

              "}"+
              
              " });"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-s' ) { "+

              "  jQuery('"+pbFormBuilderStylesID+" label').animate({'font-size':'"+formBuilderLabelSizeMobile+"px', }); "+
              "  jQuery('"+pbFormBuilderStylesID+" button , "+pbFormBuilderStylesID+" input[type=submit]  ').animate({'font-size':'"+formBuilderBtnFontSizeMobile+"px', }); "+
              
              "}"+
              " "+
              '</script> ';

    }
  }


  var thisRenderredWidget = {
    WidgetHtml: pbFormBuilderWrapper + '\n '+ pbThisFormBuilderStyles + '\n',
    WidgetScript: currWidgetDefaultResponsive + currWidgetTabletResponsive + currWidgetMobileResponsive + formBuilderbtnIconHoverAnimationScript,
  }
  return  thisRenderredWidget;

}

function liveTextWidgetRender(this_widget, j, rowID , this_column){

  if (typeof(this_widget['wltc']) == 'undefined' ) {
    this_widget['wltc'] = ' ';
  }
  if (this_widget['wltc'] == '') {
    this_widget['wltc'] = ' ';
  }
  widgetElWithScript = false;
  if (this_widget['wltc'].indexOf("<script>") >= 0)  {
    widgetElWithScript =  true;
  }
  if (this_widget['wltc'].indexOf('<script type="text/javascript">') >= 0)  {
    widgetElWithScript =  true;
  }
  if (this_widget['wltc'].indexOf("<script type='text/javascript'>") >= 0)  {
    widgetElWithScript =  true;
  }

  if (widgetElWithScript == true) {
    contentsofThisWidget = ' <div title="Scripts Detected" style="text-align:center; font-size:17px; padding:5px 0; width:100%; background:#b5b5b5; color:#fff; "> Scripts will only be added on front end side of page. </div> ';

    thisWidgetHtmlWrapper = contentsofThisWidget;
  }else{
    var thisWidgetHtmlWrapper = " <div class='wltControls' style='display:none;'></div> <div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"' > <div contenteditable='true' class='eltEditable' > <span class='elLtWrapped defaultELt'> " + this_widget['wltc'] + ' </span> </div> <div class="ltwFontScript" style="display:none;"> '+this_widget['wltfs']+' </div> </div> ';
  }

  
  var thisRenderredWidget = {
    WidgetHtml: thisWidgetHtmlWrapper + '\n ',
    WidgetScript: '',
  }
  return  thisRenderredWidget;
}

function customHeadingTextWidgetRender(this_widget_text, j, this_column, this_column_type, rowID){

  widgetTextFamily = this_widget_text['widgetTextFamily'];
  widgetTextContent = this_widget_text['widgetTextContent'];
  widgetTextAlignment = this_widget_text['widgetTextAlignment'];
  widgetTextTag = this_widget_text['widgetTextTag'];
  widgetTextColor = this_widget_text['widgetTextColor'];
  widgetTextSize = this_widget_text['widgetTextSize'];
  widgetTextWeight = this_widget_text['widgetTextWeight'];
  widgetTextTransform = this_widget_text['widgetTextTransform']; 

  po_widgets = 'po_widgets';

  if (typeof(this_widget_text['widgetTextFamily']) != 'undefined') {
    widgetTextFamily = this_widget_text['widgetTextFamily'];
  } else{
    widgetTextFamily = 'none';
  }

  if (typeof(this_widget_text['widgetTextLineHeight']) != 'undefined') {
    widgetTextLineHeight = this_widget_text['widgetTextLineHeight'];
  } else{
    widgetTextLineHeight = '';
  }

  if (widgetTextLineHeight == '') {
    widgetTextLineHeight = 'initial';
  }else{
    widgetTextLineHeight = widgetTextLineHeight+'em';
  }

  if (typeof(this_widget_text['widgetTextSpacing']) != 'undefined') {
    widgetTextSpacing = this_widget_text['widgetTextSpacing'];
  } else{
    widgetTextSpacing = '';
  }

  widgetTextAlignmentTablet = widgetTextAlignment; widgetTextAlignmentMobile = widgetTextAlignment;
  if (typeof(this_widget_text['widgetTextAlignment']) != 'undefined' ) {
    widgetTextAlignmentTablet = this_widget_text['widgetTextAlignmentTablet'];
    widgetTextAlignmentMobile = this_widget_text['widgetTextAlignmentMobile'];
  }

  pbWidgetTextId = 'pb_text_'+Math.floor((Math.random() * 200000) + 120);

  var currTextWidgetDefaultResponsive  = ''+
                  '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                        "if (jQuery(this).hasClass('rbt-l') ) { "+
                          "jQuery('#"+pbWidgetTextId+"').animate({"+
                            "'font-size':'"+widgetTextSize+"px',"+
                            "'line-height':'"+widgetTextLineHeight+"',"+
                            "'letter-spacing':'"+widgetTextSpacing+"px', "+
                          "});"+
                          "jQuery('#"+pbWidgetTextId+"').css({"+
                            "'text-align':'"+widgetTextAlignment+"',"+
                          "});"+
                        "}"+
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-l' ) { "+
                        "jQuery('#"+pbWidgetTextId+"').animate({"+
                          "'font-size':'"+widgetTextSize+"px',"+
                          "'line-height':'"+widgetTextLineHeight+"',"+
                          "'letter-spacing':'"+widgetTextSpacing+"px', "+
                        "});"+
                        "jQuery('#"+pbWidgetTextId+"').css({"+
                          "'text-align':'"+widgetTextAlignment+"',"+
                        "});"+
                      "}"+
  '</script>';

  var currTextWidgetResponsiveScripts = '\n' + currTextWidgetDefaultResponsive;
  if (typeof(this_widget_text['widgetTextSizeTablet']) != 'undefined') {

    if (this_widget_text['widgetTextSizeTablet'] == '') {
      this_widget_text['widgetTextSizeTablet'] = ' ';
    }
    
    
    var currTextWidgetResponsiveTablet  = ''+
    '<script>'+

                        "jQuery('.responsiveBtn').on('click',function(){"+
                          "if (jQuery(this).hasClass('rbt-m') ) { "+

                            "jQuery('#"+pbWidgetTextId+"').animate({"+
                              "'font-size':'"+this_widget_text['widgetTextSizeTablet']+"px',"+
                              "'line-height':'"+this_widget_text['widgetTextLineHeightTablet']+"em',"+
                              "'letter-spacing':'"+this_widget_text['widgetTextSpacingTablet']+"px',"+
                            "});"+
                            "jQuery('#"+pbWidgetTextId+"').css({"+
                              "'text-align':'"+widgetTextAlignmentTablet+"', "+
                            "});"+

                          "}"+
                        "});"+

                        "var currentVPS = jQuery('.currentViewPortSize').val();"+
                        "if ( currentVPS == 'rbt-m' ) { "+
                          
                          "jQuery('#"+pbWidgetTextId+"').animate({"+
                            "'font-size':'"+this_widget_text['widgetTextSizeTablet']+"px',"+
                            "'line-height':'"+this_widget_text['widgetTextLineHeightTablet']+"em',"+
                            "'letter-spacing':'"+this_widget_text['widgetTextSpacingTablet']+"px',"+
                          "});"+
                          "jQuery('#"+pbWidgetTextId+"').css({"+
                            "'text-align':'"+widgetTextAlignmentTablet+"', "+
                          "});"+
                        
                        "}"+
    '</script> ';

    
    currTextWidgetResponsiveScripts = '\n' + currTextWidgetDefaultResponsive + '\n' + currTextWidgetResponsiveTablet + '\n';

  }

  if (typeof(this_widget_text['widgetTextSizeMobile']) != 'undefined') {

   if (this_widget_text['widgetTextSizeMobile'] == '') {
      this_widget_text['widgetTextSizeMobile'] = ' ';
    } 

    var currTextWidgetResponsiveMobile  = ''+
    '<script>'+

                        "jQuery('.responsiveBtn').on('click',function(){"+
                          "if (jQuery(this).hasClass('rbt-s') ) { "+

                          "jQuery('#"+pbWidgetTextId+"').animate({"+
                            "'font-size':'"+this_widget_text['widgetTextSizeMobile']+"px',"+
                            "'line-height':'"+this_widget_text['widgetTextLineHeightMobile']+"em',"+
                            "'letter-spacing':'"+this_widget_text['widgetTextSpacingMobile']+"px',"+
                          "});  "+
                          "jQuery('#"+pbWidgetTextId+"').css({"+
                            "'text-align':'"+widgetTextAlignmentMobile+"', "+
                          "});"+

                          "}"+
                        "});"+

                        "var currentVPS = jQuery('.currentViewPortSize').val();"+
                        "if ( currentVPS == 'rbt-s' ) { "+
                        
                          "jQuery('#"+pbWidgetTextId+"').animate({"+
                            "'font-size':'"+this_widget_text['widgetTextSizeMobile']+"px',"+
                            "'line-height':'"+this_widget_text['widgetTextLineHeightMobile']+"em',"+
                            "'letter-spacing':'"+this_widget_text['widgetTextSpacingMobile']+"px',"+
                          "});  "+
                          "jQuery('#"+pbWidgetTextId+"').css({"+
                            "'text-align':'"+widgetTextAlignmentMobile+"', "+
                          "});"+

                        "}"+
    '</script> ';

    currTextWidgetResponsiveScripts = currTextWidgetResponsiveScripts + currTextWidgetResponsiveMobile + '\n';

  }


  widgetTextBold = ''; widgetTextItalic = ''; widgetTextUnderlined = '';
  if (this_widget_text['widgetTextBold'] == true) { widgetTextBold = 'bold'; }
  if (this_widget_text['widgetTextItalic'] == true) { widgetTextItalic = 'italic'; }
  if (this_widget_text['widgetTextUnderlined'] == true) { widgetTextUnderlined = 'underline'; }

  widgetTextFamily = widgetTextFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(widgetTextFamily)) {
    widgetTextFamily = "'"+widgetTextFamily+"'";
  }

  if (widgetTextFamily == 'Select') {
    widgetTextFamily = '';
  }
  
  var textWidgetContentStyles = ''+
    'text-align:'+widgetTextAlignment+';'+
    'color:'+widgetTextColor+';'+
    'font-size:'+widgetTextSize+'px;'+
    'font-weight:'+widgetTextWeight+';'+
    'text-transform:'+widgetTextTransform+';'+
    'font-family:'+widgetTextFamily+', sans-serif;'+
    'font-weight:'+widgetTextBold+';'+
    'font-style:'+widgetTextItalic+';'+
    'text-decoration:'+widgetTextUnderlined+';'+
    'line-height:'+widgetTextLineHeight+';'+
    'letter-spacing:'+widgetTextSpacing+'px;'+
  '';

  textWidgetContentHTML = '';
  lineBreakTag = '';
  if (typeof(widgetTextContent) == 'undefined') {
    widgetTextContent = '';
  }
  
  textWidgetContentHTML = widgetTextContent.replace(/\n/g, "<br>");

  var textInlineSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";

              
  if ( textWidgetContentHTML.includes('defaultELt') ) {

    var textWidgetContentHTMLWrapped =  ' <'+widgetTextTag+' contenteditable="true" class="eltEditable pb-text-widget" id="'+pbWidgetTextId+'" style="'+textWidgetContentStyles+'"> '+textWidgetContentHTML+' </'+widgetTextTag+'> ';

    textWidgetContentComplete =  " <div class='wltControls' style='display:none;'></div> <div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'> "+textWidgetContentHTMLWrapped+ '</div> '+'\n ';

    po_widgets = ' ';


  }else{


    var textWidgetContentHTMLWrapped =  ' <'+widgetTextTag+' class="pb-text-widget" id="'+pbWidgetTextId+'" style="'+textWidgetContentStyles+'"> '+textWidgetContentHTML+' </'+widgetTextTag+'> ';

    textWidgetContentComplete =  "<div class=' ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'> "+textWidgetContentHTMLWrapped+ '</div> '+'\n ';
    

    //var textWidgetContentHTMLWrapped =  ' <'+widgetTextTag+' contenteditable="true" class="eltEditable pb-text-widget" id="'+pbWidgetTextId+'" style="'+textWidgetContentStyles+'"> <span class="elLtWrapped defaultELt"> '+textWidgetContentHTML+' </span> <div class="ltwFontScript" style="display:none;"> </div> </'+widgetTextTag+'> ';

    //textWidgetContentComplete =  " <div class='wltControls' style='display:none;'></div> <div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'> "+textWidgetContentHTMLWrapped+ '</div> '+'\n ';
    //po_widgets = ' ';

  }
              


  var linkHref = '';
  if (widgetTextTag == 'a') {
    linkHref = ' href ="'+this_widget_text['wtextLink']+'"  target="_blank" ';

    textWidgetContentComplete = ' <'+widgetTextTag+' '+linkHref+' style="text-decoration:none; " >   <p  style="'+textWidgetContentStyles+'">  '+textWidgetContentHTML+' </p> </'+widgetTextTag+'> '+'\n <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family='+widgetTextFamily+'"> ';
  }

  var thisWidgetFonts = '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family='+widgetTextFamily+'">';

  currTextWidgetResponsiveScripts = currTextWidgetResponsiveScripts + thisWidgetFonts;


  var thisRenderredWidget = {
    WidgetHtml: textWidgetContentComplete,
    WidgetScript: currTextWidgetResponsiveScripts,
    poWidgets: po_widgets,
  }
  return thisRenderredWidget;

}



function embededVideoRender(this_widget_widgetEmbedVideo){
  
  widgetEvidVideoType = this_widget_widgetEmbedVideo['widgetEvidVideoType'];
  widgetEvidVideoLink = this_widget_widgetEmbedVideo['widgetEvidVideoLink'];
  widgetEvidVideoAutoplay = this_widget_widgetEmbedVideo['widgetEvidVideoAutoplay'];
  widgetEvidVideoPlayerControls = this_widget_widgetEmbedVideo['widgetEvidVideoPlayerControls'];
  widgetEvidVideoTitle = this_widget_widgetEmbedVideo['widgetEvidVideoTitle'];
  widgetEvidVideoSuggested = this_widget_widgetEmbedVideo['widgetEvidVideoSuggested'];
  widgetEvidImageOverlay = this_widget_widgetEmbedVideo['widgetEvidImageOverlay']; 
  widgetEvidImageUrl = this_widget_widgetEmbedVideo['widgetEvidImageUrl'];
  widgetEvidImageIcon = this_widget_widgetEmbedVideo['widgetEvidImageIcon'];
  widgetEvidImageLightbox = this_widget_widgetEmbedVideo['widgetEvidImageLightbox'];
  widgetEvidImageIconColor = this_widget_widgetEmbedVideo['widgetEvidImageIconColor'];

  widgetEvidPlayerId = 'POPB_player'+Math.floor((Math.random() * 2000) + 100);

  if (widgetEvidVideoAutoplay == 'true') {
      widgetEvidVideoAutoplay = 1;
    }else{
      widgetEvidVideoAutoplay = 0;
    }

    if (widgetEvidVideoPlayerControls == 'true') {
      widgetEvidVideoPlayerControls = 1;
    }else{
      widgetEvidVideoPlayerControls = 0;
    }

    if (widgetEvidVideoSuggested == 'true') {
      widgetEvidVideoSuggested = 1;
    }else{
      widgetEvidVideoSuggested = 0;
    }

    if (widgetEvidVideoTitle == 'true') {
      widgetEvidVideoTitle = 1;
    }else{
      widgetEvidVideoTitle = 0;
    }

  if (widgetEvidVideoType == 'youtube') {


    if (widgetEvidImageOverlay == 'true') {
      widgetEvidVideoAutoplay = 1;
    }


    function embededyoutube_parser(url){
      var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
      var match = url.match(regExp);
      return (match&&match[7].length==11)? match[7] : false;
    }

    widgetEvidVideoLink =  embededyoutube_parser(widgetEvidVideoLink);


    videoIframeURL = "https://www.youtube.com/embed/"+widgetEvidVideoLink+"?autoplay="+widgetEvidVideoAutoplay+"&amp;rel="+widgetEvidVideoSuggested+"&amp;showinfo="+widgetEvidVideoTitle+"&amp;controls="+widgetEvidVideoPlayerControls;

    thumbImageScript = '';
    if (widgetEvidImageOverlay == 'true' ) {
      thumbnailVidIframe = '<iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="'+videoIframeURL+'" frameborder="0" allowfullscreen></iframe> ';

      thumbnailVidIframe = thumbnailVidIframe.replace(/"/g, "'");
      thumbImageScript = '<script>'+
        'jQuery("#thumbImage_'+widgetEvidPlayerId+'").on("click",function(){'+
          'jQuery("#'+widgetEvidPlayerId+'").html("'+thumbnailVidIframe+'");'+
          'jQuery(this).remove();'+
        '}); '+
      '</script>';
      POPBVideoIframeContainer = '<div id="'+widgetEvidPlayerId+'" style="position: relative; padding-bottom: 56.25%; height: 0; cursor:pointer;" >  <div id="thumbImage_'+widgetEvidPlayerId+'" > <i class="fas fa-play" style="color:'+widgetEvidImageIconColor+'; box-shadow:2px 15px 20px '+widgetEvidImageIconColor+'55; font-size:85px;z-index:1;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);border: 5px solid '+widgetEvidImageIconColor+';padding: 20px 30px;border-radius: 200px; display:'+widgetEvidImageIcon+'; box-shadow:2px 3px 10px; text-shadow:2px 3px 10px; "></i> <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; "  src="'+widgetEvidImageUrl+'"> </div> </div> \n'+thumbImageScript;

    } else{

      POPBVideoIframeContainer = '<div id="'+widgetEvidPlayerId+'" style="position: relative; padding-bottom: 56.25%;  height: 0;" > <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="'+videoIframeURL+'" frameborder="0" allowfullscreen></iframe> </div>';

    }

  } else if(widgetEvidVideoType == 'vimeo'){

    if (widgetEvidImageOverlay == 'true') {
      widgetEvidVideoAutoplay = 1;
    }

    embededVimeo_url_parser = /https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/;

    var embededVimeo_urlMatch = widgetEvidVideoLink.match(embededVimeo_url_parser);

    if (embededVimeo_urlMatch) {
      embededVimeo_url = embededVimeo_urlMatch[3];
    }else{
      embededVimeo_url = 'Not Valid URL';
    }

    videoIframeURL = "https://player.vimeo.com/video/"+embededVimeo_url+"?autoplay="+widgetEvidVideoAutoplay+"&amp;rel="+widgetEvidVideoSuggested+"&amp;title="+widgetEvidVideoTitle;

    if (widgetEvidImageOverlay == 'true' ) {
      thumbnailVidIframe = '<iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="'+videoIframeURL+'" frameborder="0" allowfullscreen></iframe> ';

      thumbnailVidIframe = thumbnailVidIframe.replace(/"/g, "'");
      thumbImageScript = '<script>'+
        'jQuery("#thumbImage_'+widgetEvidPlayerId+'").on("click",function(){'+
          'jQuery("#'+widgetEvidPlayerId+'").html("'+thumbnailVidIframe+'");'+
          'jQuery(this).remove();'+
        '}); '+
      '</script>';
      POPBVideoIframeContainer = '<div id="'+widgetEvidPlayerId+'" style="position: relative; padding-bottom: 56.25%; height: 0; cursor:pointer;" >  <div id="thumbImage_'+widgetEvidPlayerId+'" > <i class="fas fa-play" style="color:'+widgetEvidImageIconColor+'; box-shadow:2px 15px 20px '+widgetEvidImageIconColor+'55; font-size:85px;z-index:1;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);border: 5px solid '+widgetEvidImageIconColor+';padding: 20px 30px;border-radius: 200px; display:'+widgetEvidImageIcon+'; box-shadow:2px 3px 10px; text-shadow:2px 3px 10px; "></i> <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; "  src="'+widgetEvidImageUrl+'"> </div> </div> \n';

    } else{

      POPBVideoIframeContainer = '<div id="'+widgetEvidPlayerId+'" style="position: relative; padding-bottom: 56.25%;  height: 0;" > <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="'+videoIframeURL+'" frameborder="0" allowfullscreen></iframe> </div>';

    }

    


  }


  if (typeof(thumbImageScript) == 'undefined') {
    thumbImageScript = '';
  }

  var thisRenderredWidget = {
    WidgetHtml: POPBVideoIframeContainer,
    WidgetScript: thumbImageScript,
  }
  return thisRenderredWidget;

}


function navigationBuilderWidgetRender(this_widget, j , rowID,this_column,this_column_type){
  
  var allNavItems = this_widget['navItems'];
  var allNavStyles = this_widget['navStyle'];

  pbAllNavItemsHtml = '';
  jQuery.each(allNavItems,function(index, val){

    var customNavLinkEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-fieldName='cnilab' data-fieldIndex='"+index+"' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";
    linkText = val['cnilab'];
    if ( linkText.includes('defaultELt') ) {
    }else{
      linkText = "<span class='elLtWrapped defaultELt' >  " +val['cnilab']+ " </span> <div class='ltwFontScript' style='display:none;'></div>";
    }

    var thisLinkText = customNavLinkEditingSaveTriggerBtn + " <div class='wltControls' style='display:none;'></div> <div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'>  <span contenteditable='true' class='eltEditable' >  "+linkText+" </span> </div>  ";

    thisMenuLink = '<div class="alink" >'+thisLinkText+'</div>';
    
    pbListPrevItem = pbAllNavItemsHtml;
    pbListThisItem = " <li> "+thisMenuLink+" </li> ";
    pbAllNavItemsHtml = pbListPrevItem +  pbListThisItem;
  });

  pbCustomId = 'pb_navMenu_'+Math.floor((Math.random() * 2000) + 100);

  var responsiveMenuSwitch = '<div class="responsiveNavBtn responsiveNavBtninActive" style=" cursor:pointer;"> <i class=" fas fa-bars "> </i> </div>  <div class="responsiveNavBtn responsiveNavBtnActive" style=" cursor:pointer;"> <i class=" fas fa-bars "> </i> </div> ';


  if (typeof(allNavStyles['cnsresop']) == 'undefined' ) {
    allNavStyles['cnsresop'] = 'true';
  }
  if (allNavStyles['cnsresop'] == '' ) {
    allNavStyles['cnsresop'] = 'true';
  }


  var containerLayout = '';
  hideNavIfResposiveActive = 'none';
  var menuLinkGap = " margin: "+allNavStyles['cnslg']+"px 0 ; ";
  if (allNavStyles['cnslayout'] == "Horizontal") { 
    var containerLayout = "display:inline-block;"; 
    var menuLinkGap = " margin:2px "+allNavStyles['cnslg']+"px; "  
  }

  if (typeof(allNavStyles['cnsalign']) == 'undefined') {
    allNavStyles['cnsalign'] = 'center';
  }



  var cnsalign = 'align-items: center; display: flex; justify-content: center; ';
  if (allNavStyles['cnsalign'] == 'center') {
    cnsalign = 'align-items: center; display: flex; justify-content: center; ';
  }
  if (allNavStyles['cnsalign'] == 'left') {
    cnsalign = 'align-items: center; display: flex; justify-content: left; ';
  }

  if (allNavStyles['cnsalign'] == 'right') {
    cnsalign = cnsalign+'float:right;';
  }

  if (allNavStyles['cnsresop'] == 'false') {
    responsiveMenuSwitch = '';
    hideNavIfResposiveActive = 'inline-block';
  }

  var thisCustomNav = "<div style='"+containerLayout+"' class='menuItemListContainer'> <ul id='ul_"+pbCustomId+"'> "+pbAllNavItemsHtml+" </ul> </div>";


  if( typeof( allNavStyles['cnsig'] ) == 'undefined'){
    
    allNavStyles['cnsig'] = '20';

  }


  if( typeof( allNavStyles['cnslos'] ) == 'undefined'){
    
    allNavStyles['cnslos'] = 'Medium';

  }

  if(allNavStyles['cnslos'] == 'Small'){ logoImageSize = 'width:70%;'; }
  if(allNavStyles['cnslos'] == 'Medium'){ logoImageSize = 'width:85%;'; }
  if(allNavStyles['cnslos'] == 'Large'){ logoImageSize = 'width:100%;'; }

  var logoImg = '';
  if (allNavStyles['cnslourl'] != '') {
    var logoImg = ' <div class="cMenuLogoContainer" style="'+containerLayout+' margin-right:'+allNavStyles['cnsig']+'px; "> <img style="'+logoImageSize+'" src="'+allNavStyles['cnslourl']+'"> </div>';
  }

 

  logoImg = "<div class='navNlogoContainer' style=''>"+ logoImg +responsiveMenuSwitch +' </div>';

  thisPickedFontFamily = allNavStyles['cnsff'];

  thisPickedFontFamily = thisPickedFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(thisPickedFontFamily)) {
    thisPickedFontFamily = '"'+thisPickedFontFamily+'"';
  }

  var customStyles = "<style>  "+
  "#"+pbCustomId+" .navNlogoContainer img { max-width:300px; } "+
    "#"+pbCustomId+" ul li { "+containerLayout+ "  "+menuLinkGap+"  } "+
    "#"+pbCustomId+" ul li .alink {  text-decoration:none; color:"+allNavStyles['cnsfc']+"; font-size:"+allNavStyles['cnsfs']+"px; font-family: "+thisPickedFontFamily+" , Sans-Serif ;  padding:"+allNavStyles['cnslh']+"px 8px; background:"+allNavStyles['cnsbc']+";  border-radius:2px; display:block; } "+
    "#"+pbCustomId+" ul li:hover .alink { color:"+allNavStyles['cnsfhc']+";  background:"+allNavStyles['cnshbc']+"; } "+
          
          "#"+pbCustomId+" .responsiveNavBtn i { color:"+allNavStyles['cnsnic']+"; font-size: 55px ;}"+
          "#"+pbCustomId+" .responsiveNavBtn { display: none ;  }"+
          "@media screen and (max-width: 780px) {"+
            "#"+pbCustomId+" .responsiveNavBtn  {  margin-left: 3%; width: 15%; margin-top: 2%; }"+
            "#"+pbCustomId+" .responsiveNavBtninActive { display: inline-block ;  }"+
            "#"+pbCustomId+" .menuItemListContainer {  }"+
            "#"+pbCustomId+" { align-items: center; display: block; justify-content: center; }"+
            "#"+pbCustomId+" ul li { display:block; }"+
          "}"+
  "</style>   <link rel='stylesheet'href='https://fonts.googleapis.com/css?family="+allNavStyles['cnsff']+"'> ";

  var customNavScript = " "+ 
    "<script type='text/javascript'>"+
    
                    "jQuery('.responsiveBtn').on('click',function(){"+
                      "if (jQuery(this).hasClass('rbt-l') ) { "+
                        "jQuery('#"+pbCustomId+" .responsiveNavBtnActive').css('display','none');"+
                        "jQuery('#"+pbCustomId+" .responsiveNavBtninActive').css('display','none');"+
                        "jQuery('#"+pbCustomId+" .menuItemListContainer').css('display','block');"+
                        "jQuery('#"+pbCustomId+" .menuItemListContainer').css('display','inline-block');"+
                        "jQuery('#"+pbCustomId+"  ul li .alink ').css('font-size','"+allNavStyles['cnsfs']+"px');"+
                      "}"+
                    "});"+

                    "var currentVPS = jQuery('.currentViewPortSize').val();"+
                    "if ( currentVPS == 'rbt-l' ) { "+
                        "jQuery('#"+pbCustomId+" .responsiveNavBtnActive').css('display','none');"+
                        "jQuery('#"+pbCustomId+" .responsiveNavBtninActive').css('display','none');"+
                        "jQuery('#"+pbCustomId+" .menuItemListContainer').css('display','block');"+
                        "jQuery('#"+pbCustomId+" .menuItemListContainer').css('display','inline-block');"+
                        "jQuery('#"+pbCustomId+"  ul li .alink ').css('font-size','"+allNavStyles['cnsfs']+"px');"+
                    "}"+


                    "jQuery('.responsiveBtn').on('click',function(){"+
                      "if (jQuery(this).hasClass('rbt-m') ) { "+
                        "jQuery('.responsiveNavBtnActive').css('display','inline-block');"+
                        "jQuery('#"+pbCustomId+" .menuItemListContainer').css('display','"+hideNavIfResposiveActive+"');"+
                        "jQuery('#"+pbCustomId+"  ul li .alink ').css('font-size','"+allNavStyles['cnsfst']+"px');"+
                      "}"+
                    "});"+
                    
                    "var currentVPS = jQuery('.currentViewPortSize').val();"+
                    "if ( currentVPS == 'rbt-m' ) { "+
                        "jQuery('.responsiveNavBtnActive').css('display','inline-block');"+
                        "jQuery('#"+pbCustomId+" .menuItemListContainer').css('display','"+hideNavIfResposiveActive+"');"+
                        "jQuery('#"+pbCustomId+"  ul li .alink ').css('font-size','"+allNavStyles['cnsfst']+"px');"+
                    "}"+


                    "jQuery('.responsiveBtn').on('click',function(){"+
                      "if (jQuery(this).hasClass('rbt-s') ) { "+
                        "jQuery('.responsiveNavBtnActive').css('display','inline-block');"+
                        "jQuery('#"+pbCustomId+" .menuItemListContainer').css('display','"+hideNavIfResposiveActive+"');"+
                        "jQuery('#"+pbCustomId+"  ul li .alink ').css('font-size','"+allNavStyles['cnsfsm']+"px');"+
                      "}"+
                    "});"+
                    
                    "var currentVPS = jQuery('.currentViewPortSize').val();"+
                    "if ( currentVPS == 'rbt-s' ) { "+
                        "jQuery('.responsiveNavBtnActive').css('display','inline-block');"+
                        "jQuery('#"+pbCustomId+" .menuItemListContainer').css('display','"+hideNavIfResposiveActive+"');"+
                        "jQuery('#"+pbCustomId+"  ul li .alink ').css('font-size','"+allNavStyles['cnsfsm']+"px');"+
                    "}"+

                    " "+
    "</script>";

  var wholeNavigationContainer = "<div id='"+pbCustomId+"' class='customNavBuilderWidget' style='"+cnsalign+"'> "+logoImg+thisCustomNav+" </div>" + customStyles;

  var thisRenderredWidget = {
    WidgetHtml: wholeNavigationContainer + '\n ',
    WidgetScript: customNavScript,
  }
  return  thisRenderredWidget;
}

function imageGalleryWidgetRender( this_widget, j , rowID,this_column,this_column_type ){
  
  var allGalleryitems = this_widget['gallItems'];
  var allGalleryStyles = this_widget['gallStyles'];

  var uniqueGallId = Math.floor((Math.random() * 2000) + 100);
  gridScriptResponsive = '';

  var allGalleryitemsHTML = '';
  jQuery.each(allGalleryitems, function(index, val){

    var thisImage = ' <div class="po-grid-item po-grid-item_'+uniqueGallId+'">'+

      '<a href="#"><img src="'+val['gur']+'" alt="'+val['gti']+'" style="" > </a>'+

    ' </div>';

    allGalleryitemsHTML = allGalleryitemsHTML + thisImage;

  });

  var fullRenderedImageGallery = '<div id="pluginops_galery_'+uniqueGallId+'" class="po-grid pluginops_galery_'+uniqueGallId+' " >'+allGalleryitemsHTML+'</div>';

  switch(allGalleryStyles['wgISD']) {
    case 'large':
      defaultImgSize = 'width:100%;';
    break;
    case 'medium':
      defaultImgSize = 'width:70%;';
    break;
    case 'small':
      defaultImgSize = 'width:40%;';
    break;
    case 'custom':
      defaultImgSize = 'custom';
    break;
  }
  if (defaultImgSize == 'custom') {
    defaultImgSize = 'width: '+allGalleryStyles['wgICW']+'px ; height:'+allGalleryStyles['wgICH']+'px; ';
  }

  if (allGalleryStyles['wgGCG'] == '') {
    allGalleryStyles['wgGCG'] = '0';
  }

  var pixels = allGalleryStyles['wgGCG'];
  var screenWidth = window.screen.width;
  var wgGCG_percentage = ( screenWidth - pixels ) / screenWidth * 100 ;
  wgGCG_percentage =  100 - wgGCG_percentage;

  if (allGalleryStyles['wgType'] == 'grid') {
    
    gridCSS = '<style>  .po-grid-item_'+uniqueGallId+' img { '+defaultImgSize+' } .po-grid-item_'+uniqueGallId+' { display:inline-block; width: '+(allGalleryStyles['wgGC'] - wgGCG_percentage )+'%; text-align:center; margin-top :'+(allGalleryStyles['wgGCG'] / 2)+'px; margin-bottom:'+(allGalleryStyles['wgGCG'] / 2)+'px; margin-left:'+( wgGCG_percentage / 2)+'%; margin-right:'+( wgGCG_percentage / 2)+'%;  }   </style>';
    gridScript = '';
  }else{

    gridCSS = '<style>  .po-grid-item_'+uniqueGallId+' img { '+defaultImgSize+' }  .po-grid-item_'+uniqueGallId+' { width:'+(allGalleryStyles['wgGC'] - wgGCG_percentage )+'%; margin-top :'+(allGalleryStyles['wgGCG'] / 2)+'px; margin-bottom:'+(allGalleryStyles['wgGCG'] / 2)+'px; }  </style>';

    var gridScript = " <script> "+

      "jQuery(' .pluginops_galery_"+uniqueGallId+" ').imagesLoaded( function() { "+

        "jQuery(' .pluginops_galery_"+uniqueGallId+" ').masonry({"+
          "itemSelector: '.po-grid-item_"+uniqueGallId+"',"+
          "gutter: "+allGalleryStyles['wgGCG']+","+
        "});"+
        
      "});"+

      "</script>";

      var gridScriptResponsive = " <script> "+

      "jQuery('.responsiveBtn').on('click',function(){"+
        "jQuery(' .pluginops_galery_"+uniqueGallId+" ').imagesLoaded( function() { "+
          "jQuery(' .pluginops_galery_"+uniqueGallId+" ').masonry({"+
            "itemSelector: '.po-grid-item_"+uniqueGallId+"',"+
            "gutter: "+allGalleryStyles['wgGCG']+","+
          "});"+
        "});"+
      "});"+

      "var currentVPS = jQuery('.currentViewPortSize').val();"+
      "if ( currentVPS == 'rbt-l' || currentVPS == 'rbt-m' || currentVPS == 'rbt-s' ) { "+
        "jQuery(' .pluginops_galery_"+uniqueGallId+" ').imagesLoaded( function() { "+
          "jQuery(' .pluginops_galery_"+uniqueGallId+" ').masonry({"+
            "itemSelector: '.po-grid-item_"+uniqueGallId+"',"+
            "gutter: "+allGalleryStyles['wgGCG']+","+
          "});"+
        "});"+
      "}"+
    "</script>";
  }


  gridResponsiveDefault = " <script> "+

      "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-l') ) { "+
          "jQuery('.po-grid-item_"+uniqueGallId+"').css('width',' "+( parseFloat( allGalleryStyles['wgGC']) - wgGCG_percentage )+"%');"+
        "}"+
      "});"+

      "var currentVPS = jQuery('.currentViewPortSize').val();"+
      "if ( currentVPS == 'rbt-l' ) { "+
        "jQuery('.po-grid-item_"+uniqueGallId+"').css('width','"+( parseFloat( allGalleryStyles['wgGC']) - wgGCG_percentage )+"%');"+
      "}"+
    "</script>";

  gridResponsiveTablet = " <script> "+

      "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-m') ) { "+
          "jQuery('.po-grid-item_"+uniqueGallId+"').css('width','"+( parseFloat( allGalleryStyles['wgGCT']) - wgGCG_percentage )+"%');"+
        "}"+
      "});"+

      "var currentVPS = jQuery('.currentViewPortSize').val();"+
      "if ( currentVPS == 'rbt-m' ) { "+
        "jQuery('.po-grid-item_"+uniqueGallId+"').css('width','"+( parseFloat( allGalleryStyles['wgGCT']) - wgGCG_percentage )+"%');"+
      "}"+
    "</script>";

  gridResponsiveMobile = " <script> "+

      "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-s') ) { "+
          "jQuery('.po-grid-item_"+uniqueGallId+"').css('width','"+( parseFloat( allGalleryStyles['wgGCM']) - wgGCG_percentage )+"%');"+
        "}"+
      "});"+

      "var currentVPS = jQuery('.currentViewPortSize').val();"+
      "if ( currentVPS == 'rbt-s' ) { "+
        "jQuery('.po-grid-item_"+uniqueGallId+"').css('width','"+( parseFloat( allGalleryStyles['wgGCM']) - wgGCG_percentage )+"%');"+
      "}"+
  "</script>";
  


  var thisRenderredWidget = {
    WidgetHtml: fullRenderedImageGallery,
    WidgetScript: gridCSS + gridResponsiveDefault + gridResponsiveTablet +gridResponsiveMobile + gridScript + gridScriptResponsive,
  }
  return thisRenderredWidget;
}

function imageWidgetRender(this_widget, j , rowID,this_column,this_column_type){
              var imgUrl  = this_widget['imgUrl'];
              var imgSize = this_widget['imgSize'];
              var imgAlignment = this_widget['imgAlignment'];
              var uniqueImgId = 'pb_img'+Math.floor((Math.random() * 25000) + 100);

              if (pageBuilderApp.setFeaturedImageIfEmpty != true) {
                if (imgUrl != '') {
                  replacementImgUrl = imgUrl;
                  if ( jQuery('.pageSeofbOgImage ').val() == '' ) {
                    jQuery('.pageSeofbOgImage ').val(replacementImgUrl);
                  }
                  pageBuilderApp.setFeaturedImageIfEmpty = true;
                }
                
              }

              if (this_widget['iborderRadius'] != 'undefined' && this_widget['iborderRadius'] != null) {
                iborderRadius = this_widget['iborderRadius'];
              }else{
                iborderRadius = [];
                iborderRadius['iwbrt'] = '';
                iborderRadius['iwbrb'] = '';
                iborderRadius['iwbrl'] = '';
                iborderRadius['iwbrr'] = '';
              }
              if (this_widget['iborderWidth'] != 'undefined' && this_widget['iborderWidth'] != null) {
                iborderWidth = this_widget['iborderWidth'];
              }else{
                iborderWidth = [];
                iborderWidth['iwbwt'] = '';
                iborderWidth['iwbwb'] = '';
                iborderWidth['iwbwl'] = '';
                iborderWidth['iwbwr'] = '';
              }

              var imgWidgetboxShadow = 'border-width: '+iborderWidth['iwbwt']+'px '+iborderWidth['iwbwr']+'px  '+iborderWidth['iwbwb']+'px '+iborderWidth['iwbwl']+'px; border-style: '+this_widget['iwbs']+'; border-color: '+this_widget['iwbc']+'; border-radius:'+iborderRadius['iwbrt']+'px '+iborderRadius['iwbrr']+'px '+iborderRadius['iwbrb']+'px '+iborderRadius['iwbrl']+'px; box-shadow: '+this_widget['iwbsh']+'px  '+this_widget['iwbsv']+'px  '+this_widget['iwbsb']+'px '+this_widget['iwbsc']+' ;  ';

              imgCustomSize = ''; imgWidgetDefaultResponsive = ''; imgWidgetTabletResponsive = ''; imgWidgetMobileResponsive= '';

              if (imgSize == 'custom') {

                  
                  if (this_widget['imgSizeCustomWidth'] != "undefined") {
                    imgSizeCustomWidth = this_widget['imgSizeCustomWidth'];
                  }
                  if (this_widget['imgSizeCustomHeight'] != "undefined") {
                    imgSizeCustomHeight = this_widget['imgSizeCustomHeight'];
                  }

                  var imgCustomSize = 'width:'+imgSizeCustomWidth+'px; height:'+imgSizeCustomHeight+'px;';

                  if (typeof(this_widget['imgSizeCustomWidthTablet']) != 'undefined' ) {
                    var imgWidgetDefaultResponsive  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-l') ) { "+

                      "  jQuery('#"+uniqueImgId+" img').animate({'width':'"+this_widget['imgSizeCustomWidth']+"px', 'height':'"+this_widget['imgSizeCustomHeight']+"px' }); "+

                      "}"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-l' ) { "+

                      "  jQuery('#"+uniqueImgId+" img').animate({'width':'"+this_widget['imgSizeCustomWidth']+"px', 'height':'"+this_widget['imgSizeCustomHeight']+"px' }); "+
                      "}"+
                      " "+
                      '</script> ';
                    var imgWidgetTabletResponsive  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-m') ) { "+

                      "  jQuery('#"+uniqueImgId+" img').animate({'width':'"+this_widget['imgSizeCustomWidthTablet']+"px', 'height':'"+this_widget['imgSizeCustomHeightTablet']+"px' }); "+

                      "}"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-m' ) { "+

                      "  jQuery('#"+uniqueImgId+" img').animate({'width':'"+this_widget['imgSizeCustomWidthTablet']+"px', 'height':'"+this_widget['imgSizeCustomHeightTablet']+"px' }); "+
                      "}"+
                      " "+
                      '</script> ';
                    var imgWidgetMobileResponsive  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-s') ) { "+

                      "  jQuery('#"+uniqueImgId+" img').animate({'width':'"+this_widget['imgSizeCustomWidthMobile']+"px', 'height':'"+this_widget['imgSizeCustomHeightMobile']+"px' }); "+

                      "}"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-s' ) { "+

                      "  jQuery('#"+uniqueImgId+" img').animate({'width':'"+this_widget['imgSizeCustomWidthMobile']+"px', 'height':'"+this_widget['imgSizeCustomHeightMobile']+"px' }); "+
                      "}"+
                      " "+
                      '</script> ';
                  }

              }


              captionHTML = '';
              imgWidgetCaptionResponsiveScripts = '';

              if (typeof(this_widget['imgwctff']) == 'undefined' || this_widget['imgwctff'] == '') {
                this_widget['imgwctff'] = 'Arial';
              }

              if (typeof(this_widget['imgwccdis']) == 'undefined') { this_widget['imgwccdis'] = 'hidden'; }

              if ( this_widget['imgwccdis'] != 'hidden' ) {


                if ( typeof(this_widget['imgwccw']) == 'undefined' || this_widget['imgwccw'] == '' ) { this_widget['imgwccw'] = '50';  }

                if ( typeof(this_widget['imgwccwu']) == 'undefined' || this_widget['imgwccwu'] == '' ) { this_widget['imgwccwu'] = '%';  }
                
                if ( typeof(this_widget['imgwccah']) == 'undefined' || this_widget['imgwccah'] == '' ) { this_widget['imgwccah'] = 'center';  }

                if ( typeof(this_widget['imgwccav']) == 'undefined' || this_widget['imgwccav'] == '' ) { this_widget['imgwccav'] = 'middle';  }

                if ( typeof(this_widget['slideContentAlign']) == 'undefined' || this_widget['slideContentAlign'] == '' ) { this_widget['slideContentAlign'] = 'center';  }

                imgwccavMargin = ''; imgwccahMargin =''; imgwccav = ''; imgwccah = ''; 

                if (this_widget['imgwccav'] == 'middle') {
                  imgwccav = '50%';
                }

                if (this_widget['imgwccav'] == 'top') {
                  imgwccav = '0%';
                }
                if (this_widget['imgwccav'] == 'bottom') {
                  imgwccav = '0%';
                  imgwccavMargin = 'bottom:0%; top:inherit;';
                }

                
                if (this_widget['imgwccah'] == 'center') {
                  imgwccah = '50%';
                  imgwccahMargin = 'margin:0 auto;';
                }
                
                if (this_widget['imgwccah'] == 'left') {
                  imgwccah = '0%';
                }

                if (this_widget['imgwccah'] == 'right') {
                  imgwccah = '0%';
                  imgwccahMargin = 'left:inherit; right: 0;';
                }

                hideImageCaption = '';
                if (this_widget['imgwccdis'] != 'always') {
                  hideImageCaption = 'display:none;';
                }

                captionContentAlignmentCss =
                  'position: absolute;'+
                  'top: '+imgwccav+';'+
                  'left: '+imgwccah+';'+
                  'transform: translate(-'+imgwccah+', -'+imgwccav+') !important;'+
                  '-ms-transform: translate(-'+imgwccah+', -'+imgwccav+') !important;'+
                  '-webkit-transform: translate(-'+imgwccah+', -'+imgwccav+') !important;'+
                  imgwccahMargin + imgwccavMargin
                ;

                if (typeof(this_widget['imgwcch']) == 'undefined') { this_widget['imgwcch'] = '50%'; }

                if (this_widget['imgwcch'] == '' ) {
                  this_widget['imgwcch'] = '50%';
                }

                if (this_widget['imgwcch'] == 'Fit Content' ) {
                  var imgCapContainerHeight = 'padding:4% 3%;' ;
                }else{
                  var imgCapContainerHeight = 'height:'+this_widget['imgwcch']+';' ;
                }


                if (typeof(this_widget['imgwctsu']) == 'undefined' || this_widget['imgwctsu'] == '') {
                  this_widget['imgwctsu'] = 'px';
                }

                if (typeof(this_widget['imgwctav']) == 'undefined') { this_widget['imgwctav'] = 'center'; }

                if (typeof(this_widget['imgwcap']) == 'undefined') { this_widget['imgwcap'] = '<h2>Enter Your Caption</h2>'; }

                if (this_widget['imgwcap'] == '') { this_widget['imgwcap'] = ' '; }

                if (typeof(this_widget['imgwctc']) == 'undefined') { this_widget['imgwctc'] = '#333'; }

                if (typeof(this_widget['imgwccbg']) == 'undefined') { this_widget['imgwccbg'] = 'rgba(255, 255, 255, 0.38)'; }


                thisPickedFontFamily = this_widget['imgwctff'];

                thisPickedFontFamily = thisPickedFontFamily.replace(/\+/g, ' ');
                if (popb_hasNumber(thisPickedFontFamily)) {
                  thisPickedFontFamily = "'"+thisPickedFontFamily+"'";
                }

                captionContentTextVAlignmentCss = 
                  'display: flex;'+
                  'justify-content: '+this_widget['imgwctav']+';'+
                  'flex-direction: column;'
                ;

                var captionContainerStyles = 

                  'min-width: '+this_widget['imgwccw']+this_widget['imgwccwu']+';'+
                  captionContentAlignmentCss+
                  imgCapContainerHeight+
                  'background: '+this_widget['imgwccbg']+'; '+
                  'font-size:'+this_widget['imgwcts']+this_widget['imgwctsu']+';'+
                  'font-family: '+thisPickedFontFamily+',sans-serif;'+
                  'color:'+this_widget['imgwctc']+';'+
                  'border-radius:'+this_widget['imgwccbr']+'px;'+
                  'line-height:1.35em;'+
                  captionContentTextVAlignmentCss + 
                  hideImageCaption
                ;


                captionContentTextAlignmentCss = 
                  'text-align:'+this_widget['imgwcta']+';'+
                  'padding:5% 3%;'
                ;

                var imgTextEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";

                if ( this_widget['imgwcap'].includes('defaultELt') ) {
                }else{
                  this_widget['imgwcap'] = "<span class='elLtWrapped defaultELt'> " +this_widget['imgwcap']+" </span> <div class='ltwFontScript' style='display:none;'></div>";
                }

                var imgCaptionTextWrapped =
                imgTextEditingSaveTriggerBtn + 
                "<div class='wltControls' style='display:none;'></div>"+
                "<div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'>"+
                  "<span contenteditable='true' class='eltEditable' >" +this_widget['imgwcap']+"</span>"+
                "</div>";
                

                var captionHTML =
                  '<div class="img-caption-'+uniqueImgId+' img-caption animated" style="'+captionContainerStyles+'">'+
                    '<div class="img-caption-inner" style="'+captionContentTextAlignmentCss+'">'+imgCaptionTextWrapped+'</div>'+
                  '</div>'
                ;


                var imageWidgetHoverClickScripts = ''; imageWidgetMouseenterScripts =''; imageWidgetMouseleaveScripts = '';
                if (this_widget['imgwccdis'] == 'on hover') {
                  imageWidgetMouseenterScripts =  
                    'jQuery(".img-caption-'+uniqueImgId+'").slideToggle();'+
                    'jQuery(".img-caption-'+uniqueImgId+'").css("display","flex");'
                  ;
                  imageWidgetMouseleaveScripts = 
                    'jQuery(".img-caption-'+uniqueImgId+'").slideToggle();'
                  ;

                  var imageWidgetHoverClickScripts = 
                    '<script>'+
                      'jQuery(".img-caption-'+uniqueImgId+'").parent().mouseenter(function(){'+
                        imageWidgetMouseenterScripts+
                      '}).mouseleave(function(){'+
                        imageWidgetMouseleaveScripts+
                      '});'+
                    '</script>'
                  ;

                }

                  

                imageWidgetMouseClickScripts =''; imageWidgetMouseClickAgainScripts = '';
                if (this_widget['imgwccdis'] == 'on click') {
                  imageWidgetMouseClickScripts =  
                    'jQuery(".img-caption-'+uniqueImgId+'").slideToggle();'+
                    'jQuery(".img-caption-'+uniqueImgId+'").css("display","flex");'+
                    'jQuery(".img-caption-'+uniqueImgId+'").addClass("img-caption-'+uniqueImgId+'-imageClickedActive");'
                  ;
                  imageWidgetMouseClickAgainScripts = 
                    'jQuery(".img-caption-'+uniqueImgId+'").slideToggle();'+
                    'jQuery(".img-caption-'+uniqueImgId+'").removeClass("img-caption-'+uniqueImgId+'-imageClickedActive");'
                  ;

                  var imageWidgetHoverClickScripts = 
                    '<script>'+
                      'jQuery(".img-caption-'+uniqueImgId+'").parent().on("click",function(){'+
                        imageWidgetMouseClickScripts+
                      '});'+
                      'jQuery(".img-caption-'+uniqueImgId+'-imageClickedActive").parent().on("click",function(){'+
                        imageWidgetMouseClickAgainScripts+
                      '});'+
                    '</script>'
                  ;

                }

                  


                var imgWidgetCaptionDefaultResponsive  = ''+
                  '<script>'+
                    "jQuery('.responsiveBtn').on('click',function(){"+
                      "if (jQuery(this).hasClass('rbt-l') ) { "+

                        "jQuery('.img-caption-"+uniqueImgId+"').animate({"+
                          "'min-width':'"+this_widget['imgwccw']+this_widget['imgwccwu']+"',"+
                          "'font-size':'"+this_widget['imgwcts']+this_widget['imgwctsu']+"',"+
                        "});"+

                        "jQuery('.img-caption-"+uniqueImgId+" .img-caption-inner').css({"+
                          "'text-align':'"+this_widget['imgwcta']+"',"+
                        "});"+

                      "}"+
                      
                    "});"+
                      
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-l' ) { "+

                        "jQuery('.img-caption-"+uniqueImgId+"').animate({"+
                          "'min-width':'"+this_widget['imgwccw']+this_widget['imgwccwu']+"',"+
                          "'font-size':'"+this_widget['imgwcts']+this_widget['imgwctsu']+"',"+
                        "});"+

                        "jQuery('.img-caption-"+uniqueImgId+" .img-caption-inner').css({"+
                          "'text-align':'"+this_widget['imgwcta']+"',"+
                        "});"+
                      "}"+

                  '</script>'
                ;

                var imgWidgetCaptionTabletResponsive  = ''+
                  '<script>'+
                    "jQuery('.responsiveBtn').on('click',function(){"+
                      "if (jQuery(this).hasClass('rbt-m') ) { "+

                        "jQuery('.img-caption-"+uniqueImgId+"').animate({"+
                          "'min-width':'"+this_widget['imgwccwT']+this_widget['imgwccwuT']+"',"+
                          "'font-size':'"+this_widget['imgwctsT']+this_widget['imgwctsuT']+"',"+
                        "});"+

                        "jQuery('.img-caption-"+uniqueImgId+" .img-caption-inner').css({"+
                          "'text-align':'"+this_widget['imgwctaT']+"',"+
                        "});"+

                      "}"+
                      
                    "});"+
                      
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-m' ) { "+

                        "jQuery('.img-caption-"+uniqueImgId+"').animate({"+
                          "'min-width':'"+this_widget['imgwccwT']+this_widget['imgwccwuT']+"',"+
                          "'font-size':'"+this_widget['imgwctsT']+this_widget['imgwctsuT']+"',"+
                        "});"+

                        "jQuery('.img-caption-"+uniqueImgId+" .img-caption-inner').css({"+
                          "'text-align':'"+this_widget['imgwctaT']+"',"+
                        "});"+
                      "}"+

                  '</script>'
                ;

                var imgWidgetCaptionMobileResponsive  = ''+
                  '<script>'+
                    "jQuery('.responsiveBtn').on('click',function(){"+
                      "if (jQuery(this).hasClass('rbt-s') ) { "+

                        "jQuery('.img-caption-"+uniqueImgId+"').animate({"+
                          "'min-width':'"+this_widget['imgwccwM']+this_widget['imgwccwuM']+"',"+
                          "'font-size':'"+this_widget['imgwctsM']+this_widget['imgwctsuM']+"',"+
                        "});"+

                        "jQuery('.img-caption-"+uniqueImgId+" .img-caption-inner').css({"+
                          "'text-align':'"+this_widget['imgwctaM']+"',"+
                        "});"+

                      "}"+
                      
                    "});"+
                      
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-s' ) { "+

                        "jQuery('.img-caption-"+uniqueImgId+"').animate({"+
                          "'min-width':'"+this_widget['imgwccwM']+this_widget['imgwccwuM']+"',"+
                          "'font-size':'"+this_widget['imgwctsM']+this_widget['imgwctsuM']+"',"+
                        "});"+

                        "jQuery('.img-caption-"+uniqueImgId+" .img-caption-inner').css({"+
                          "'text-align':'"+this_widget['imgwctaM']+"',"+
                        "});"+
                      "}"+

                  '</script>'
                ;

                imgWidgetCaptionResponsiveScripts =  imgWidgetCaptionDefaultResponsive + imgWidgetCaptionTabletResponsive + imgWidgetCaptionMobileResponsive + imageWidgetHoverClickScripts;


              }

                
              
              if ( typeof(this_widget['imgLightBox']) == "undefined" ){ this_widget['imgLightBox'] = 'false'; }

              imgLightBox = this_widget['imgLightBox'];
              if (imgLightBox == 'true') {
                  var this_column_img = 
                    "<div class='pb_img_thumbnail'  id='"+uniqueImgId+"' style='text-align:"+imgAlignment+";'> "+

                      "<img src="+imgUrl+" style=' "+imgCustomSize+" "+imgWidgetboxShadow+" ' class='ftr-img-"+this_column+" img-"+imgSize+" '>"+
                      captionHTML+

                    "</div>"+

                    "<div class='pb_single_img_lightbox' id='pb_lightbox"+uniqueImgId+"'>"+
                      "<img src='"+imgUrl+"'>"+
                    "</div><br>"
                  ;
              } else{
                
                  var this_column_img = 
                    "<div id='"+uniqueImgId+"' style='text-align:"+imgAlignment+"; position:relative;'>"+
                      "<img src="+imgUrl+" style='text-align:"+imgAlignment+"; "+imgCustomSize+" "+imgWidgetboxShadow+" ' class='ftr-img-"+this_column+" img-"+imgSize+" '>"+
                      captionHTML+
                    "</div>"
                  ;
              }
              

              imgWidgetDefaultResponsiveAligment = ''; imgWidgetTabletResponsiveAligment = ''; imgWidgetMobileResponsiveAligment = '';
              if (typeof(this_widget['imgAlignmentTablet']) != 'undefined' ) {

                var imgWidgetDefaultResponsiveAligment  = ''+
                  '<script>'+
                  "jQuery('.responsiveBtn').on('click',function(){"+
                  " if (jQuery(this).hasClass('rbt-l') ) { "+

                  "  jQuery('#"+uniqueImgId+"').css({'text-align':'"+this_widget['imgAlignment']+"' }); "+

                  "}"+
                  
                  " });"+
                  "var currentVPS = jQuery('.currentViewPortSize').val();"+
                  "if ( currentVPS == 'rbt-l' ) { "+

                  "  jQuery('#"+uniqueImgId+"').css({'text-align':'"+this_widget['imgAlignment']+"' }); "+
                  "}"+
                  " "+
                  '</script> ';

                var imgWidgetTabletResponsiveAligment  = ''+
                    '<script>'+
                    "jQuery('.responsiveBtn').on('click',function(){"+
                    " if (jQuery(this).hasClass('rbt-m') ) { "+

                    "  jQuery('#"+uniqueImgId+"').css({'text-align':'"+this_widget['imgAlignmentTablet']+"' }); "+

                    "}"+
                    
                    " });"+
                    "var currentVPS = jQuery('.currentViewPortSize').val();"+
                    "if ( currentVPS == 'rbt-m' ) { "+

                    "  jQuery('#"+uniqueImgId+"').css({'text-align':'"+this_widget['imgAlignmentTablet']+"' }); "+
                    "}"+
                    " "+
                    '</script> ';

                var imgWidgetMobileResponsiveAligment  = ''+
                    '<script>'+
                    "jQuery('.responsiveBtn').on('click',function(){"+
                    " if (jQuery(this).hasClass('rbt-s') ) { "+

                    "  jQuery('#"+uniqueImgId+"').css({'text-align':'"+this_widget['imgAlignmentMobile']+"' }); "+

                    "}"+
                    
                    " });"+
                    "var currentVPS = jQuery('.currentViewPortSize').val();"+
                    "if ( currentVPS == 'rbt-m' ) { "+

                    "  jQuery('#"+uniqueImgId+"').css({'text-align':'"+this_widget['imgAlignmentMobile']+"' }); "+
                    "}"+
                    " "+
                    '</script> ';
              }

              var imgWidgetScripts = imgWidgetDefaultResponsiveAligment + imgWidgetTabletResponsiveAligment + imgWidgetMobileResponsiveAligment + imgWidgetDefaultResponsive + imgWidgetTabletResponsive + imgWidgetMobileResponsive + imgWidgetCaptionResponsiveScripts +  '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family='+this_widget['imgwctff']+'"> ';


              var thisRenderredWidget = {
                WidgetHtml: this_column_img + '\n ',
                WidgetScript: imgWidgetScripts,
              }
              return  thisRenderredWidget;
}



function pluginopsAccordionWidgetRender(this_widget, j , rowID,this_column,this_column_type){


  var accordionItems = this_widget['accordionItems'];
  var accordionIcon = this_widget['accordionIcon'];
  var accordionSettings = this_widget['accordionSettings'];
  var accordionTitle = this_widget['accordionTitle'];
  var accordionTitleTypography = this_widget['accordionTitle']['typography'];
  var accordionContent = this_widget['accordionContent'];
  var accordionContentTypography = this_widget['accordionContent']['typography'];

  var uniqueAccordionId = Math.floor((Math.random() * 2000) + 100);

  var allAccordionItems = '';

  if (accordionTitleTypography['ffam'] == '') { accordionTitleTypography['ffam'] = ' '; }

  var accordionIconClosed = '<i class=" '+accordionIcon['acciClosed']+' acw_iconClosed"></i>';
  var accordionIconOpen = '<i class=" '+accordionIcon['acciOpen']+' acw_iconOpen"></i>';

  jQuery.each(accordionItems,function(index, val) {
    
    thisAccordTitle =
      '<h4 class="accordionTitle">'+
        accordionIconClosed+
        accordionIconOpen+
        val['accoTitle']+
      '</h4>'
    ;


    var accContent = val['accContent'];
    var accordionTitleEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-fieldName='accContent' data-fieldIndex='"+index+"' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";

    if ( accContent.includes('defaultELt') ) {
    }else{
      accContent = "<span class='elLtWrapped defaultELt'> " +val['accContent']+" </span> <div class='ltwFontScript' style='display:none;'></div>";
    }

    var accordContentTextWrapped =
      accordionTitleEditingSaveTriggerBtn + 
      "<div class='wltControls' style='display:none;'></div>"+
      "<div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"'>"+
        "<span contenteditable='true' class='eltEditable' >" +accContent+"</span>"+
      "</div>"
    ;


    thisAccordContent =
      '<div class="accordionContent"> '+accordContentTextWrapped+' </div>'
    ;

    thisAccordItem = thisAccordTitle + "\n" + thisAccordContent;

    allAccordionItems = allAccordionItems + "\n" + thisAccordItem;

  });


  fullRenderedAccordionWidget = 
    "<div id='accordion_widget_"+uniqueAccordionId+"' class='accordion_widget' style=''>"+
      allAccordionItems+
    "</div>"
  ;

  accordionTitleTypography['flinh'] = (accordionTitleTypography['flinh'] === '') ? '1' : accordionTitleTypography['flinh'];

  var thisTitleBorderWidth = accordionTitle['borwt']+'px ' + accordionTitle['borwr']+'px ' + accordionTitle['borwb']+'px ' + accordionTitle['borwl']+'px ';
  var thisAccordTitleStyles = 
    'background:'+accordionTitle['acctbg']+';'+
    'color:'+accordionTitle['acctc']+';'+
    'padding:'+accordionTitleTypography['flinh']+'em; '+accordionTitle['hgap']+'px;'+
    'border-style:'+accordionSettings['accocbort']+';'+
    'border-color:'+accordionSettings['accocborc']+' !important;'+
    'border-width: '+thisTitleBorderWidth+' ;'+
    'margin: '+accordionTitle['vgap']+'px 0 0 0;'
  ;


  thisPickedFontFamily = accordionTitleTypography['ffam'];

  thisPickedFontFamily = thisPickedFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(thisPickedFontFamily)) {
    thisPickedFontFamily = '"'+thisPickedFontFamily+'"';
  }


  var thisAccordTitleTypoStyles =
    'font-family:'+thisPickedFontFamily+';'+
    'font-size:'+accordionTitleTypography['fsize']+accordionTitleTypography['fsizeu']+';'+
    'font-weight:'+accordionTitleTypography['fwei']+';'+
    'text-transform:'+accordionTitleTypography['ftrans']+';'+
    'text-style:'+accordionTitleTypography['fstyl']+';'+
    'text-decoration:'+accordionTitleTypography['fdeco']+';'+
    'letter-spacing:'+accordionTitleTypography['fletsp']+'px;'
  ;

  var thisContentBorderWidth = accordionContent['borwt']+'px ' + accordionContent['borwr']+'px ' + accordionContent['borwb']+'px ' + accordionContent['borwl']+'px ';
  var thisAccordContentStyles =
    'background:'+accordionContent['acccbg']+';'+
    'color:'+accordionContent['acccc']+';'+
    'padding:'+accordionContent['vgap']+'px '+accordionContent['hgap']+'px;'+
    'border-style:'+accordionSettings['accocbort']+';'+
    'border-color:'+accordionSettings['accocborc']+'; !important;'+
    'border-width: '+thisContentBorderWidth+' ;'
  ;


  thisPickedFontFamily = accordionContentTypography['ffam'];

  thisPickedFontFamily = thisPickedFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(thisPickedFontFamily)) {
    thisPickedFontFamily = '"'+thisPickedFontFamily+'"';
  }

  var thisAccordContentTypoStyles =
    'font-family:'+thisPickedFontFamily+';'+
    'font-size:'+accordionContentTypography['fsize']+accordionContentTypography['fsizeu']+';'+
    'font-weight:'+accordionContentTypography['fwei']+';'+
    'text-transform:'+accordionContentTypography['ftrans']+';'+
    'text-style:'+accordionContentTypography['fstyl']+';'+
    'text-decoration:'+accordionContentTypography['fdeco']+';'+
    'line-height:'+accordionContentTypography['flinh']+'em;'+
    'letter-spacing:'+accordionContentTypography['fletsp']+'px;'
  ;

  accordionCSS = 
    '<style>'+

      '#accordion_widget_'+uniqueAccordionId+' .accordionTitle {'+
        thisAccordTitleStyles+
        thisAccordTitleTypoStyles+
      '}'+

      '#accordion_widget_'+uniqueAccordionId+' .accordionContent {'+
        thisAccordContentStyles+
        thisAccordContentTypoStyles+
      '}'+

      '#accordion_widget_'+uniqueAccordionId+' .ui-accordion-header-active {'+
        'color: '+accordionTitle['acctc']+';'+
        'background: '+accordionTitle['acctabg']+';'+
      '}'+

      '#accordion_widget_'+uniqueAccordionId+' .accordionTitle i {'+
        'padding: 0px '+accordionIcon['acciGap']+'px;'+
        'color: '+accordionIcon['acciColor']+';'+
        'float:'+accordionIcon['acciAlign']+';'+
      '}'+

      '#accordion_widget_'+uniqueAccordionId+'  .acwIconActive { '+
        'color: '+accordionIcon['acciAColor']+' !important; '+
      '}'+

      '#accordion_widget_'+uniqueAccordionId+'  .acwTitleActive { '+
        'color: '+accordionTitle['acctac']+' !important;'+
        'background: '+accordionTitle['acctabg']+' !important;'+
      '}'+

      '.accordion_widget  .ui-icon { display:none; }'+
      '.accordion_widget  .acw_iconOpen { display:none; }'+


    '</style>'
  ;


  if (accordionSettings['accoActive'] == 'true') {
    var isAccordionActive = '';
  }else{
    var isAccordionActive = 'active:false,';
  }
  
  accordionScript = 
    '<script>'+
      'jQuery( function() {'+

        'jQuery( "#accordion_widget_'+uniqueAccordionId+'" ).accordion({'+

          'collapsible: true,'+
          'heightStyle: "'+accordionSettings['accoHeight']+'",'+
          isAccordionActive+
          'beforeActivate: function(event,ui){'+

            'var oldHeader = ui.oldHeader[0];'+
            'var newHeader = ui.newHeader[0];'+
            "jQuery(oldHeader).children('.acw_iconClosed').css('display','inline-block');"+
            "jQuery(oldHeader).children('.acw_iconOpen').css('display','none');"+

            "jQuery(newHeader).children('.acw_iconClosed').css('display','none');"+
            "jQuery(newHeader).children('.acw_iconOpen').css('display','inline-block');"+

            "jQuery('.acwIconActive').removeClass('acwIconActive');"+ 
            "jQuery(newHeader).children('.acw_iconOpen').addClass('acwIconActive');"+

            "jQuery('.acwTitleActive').removeClass('acwTitleActive');"+ 
            "jQuery(newHeader).addClass('acwTitleActive');"+

          '},'+

        '});'+
      '});'+
    '</script>'
  ;


  accordionDefaultStylesScript = 
    '<script>'+
      "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-l') ) { "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionTitle').css({"+
            "'font-size':'"+accordionTitleTypography['fsize']+accordionTitleTypography['fsizeu']+"', "+
            "'line-height':'"+accordionTitleTypography['flinh']+"em', "+
            "'letter-spacing':'"+accordionTitleTypography['fletsp']+"px', "+
          "}); "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionContent').css({"+
            "'font-size':'"+accordionContentTypography['fsize']+accordionContentTypography['fsizeu']+"', "+
            "'line-height':'"+accordionContentTypography['flinh']+"em', "+
            "'letter-spacing':'"+accordionContentTypography['fletsp']+"px', "+
          "}); "+

        "}"+
      "});"+
      
      "var currentVPS = jQuery('.currentViewPortSize').val();"+
      "if ( currentVPS == 'rbt-l' ) { "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionTitle').css({"+
            "'font-size':'"+accordionTitleTypography['fsize']+accordionTitleTypography['fsizeu']+"', "+
            "'line-height':'"+accordionTitleTypography['flinh']+"em', "+
            "'letter-spacing':'"+accordionTitleTypography['fletsp']+"px', "+
          "}); "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionContent').css({"+
            "'font-size':'"+accordionContentTypography['fsize']+accordionContentTypography['fsizeu']+"', "+
            "'line-height':'"+accordionContentTypography['flinh']+"em', "+
            "'letter-spacing':'"+accordionContentTypography['fletsp']+"px', "+
          "}); "+
      
      "}"+

    '</script>'
  ;

  accordionTabletStylesScript = 
    '<script>'+
      "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-m') ) { "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionTitle').css({"+
            "'font-size':'"+accordionTitleTypography['fsizeT']+accordionTitleTypography['fsizeuT']+"', "+
            "'line-height':'"+accordionTitleTypography['flinhT']+"em', "+
            "'letter-spacing':'"+accordionTitleTypography['fletspT']+"px', "+
          "}); "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionContent').css({"+
            "'font-size':'"+accordionContentTypography['fsizeT']+accordionContentTypography['fsizeuT']+"', "+
            "'line-height':'"+accordionContentTypography['flinhT']+"em', "+
            "'letter-spacing':'"+accordionContentTypography['fletspT']+"px', "+
          "}); "+

        "}"+
      "});"+
      
      "var currentVPS = jQuery('.currentViewPortSize').val();"+
      "if ( currentVPS == 'rbt-m' ) { "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionTitle').css({"+
            "'font-size':'"+accordionTitleTypography['fsizeT']+accordionTitleTypography['fsizeuT']+"', "+
            "'line-height':'"+accordionTitleTypography['flinhT']+"em', "+
            "'letter-spacing':'"+accordionTitleTypography['fletspT']+"px', "+
          "}); "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionContent').css({"+
            "'font-size':'"+accordionContentTypography['fsizeT']+accordionContentTypography['fsizeuT']+"', "+
            "'line-height':'"+accordionContentTypography['flinhT']+"em', "+
            "'letter-spacing':'"+accordionContentTypography['fletspT']+"px', "+
          "}); "+
      
      "}"+

    '</script>'
  ;

  accordionMobileStylesScript = 
    '<script>'+
      "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-s') ) { "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionTitle').css({"+
            "'font-size':'"+accordionTitleTypography['fsizeM']+accordionTitleTypography['fsizeuM']+"', "+
            "'line-height':'"+accordionTitleTypography['flinhM']+"em', "+
            "'letter-spacing':'"+accordionTitleTypography['fletspM']+"px', "+
          "}); "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionContent').css({"+
            "'font-size':'"+accordionContentTypography['fsizeM']+accordionContentTypography['fsizeuM']+"', "+
            "'line-height':'"+accordionContentTypography['flinhM']+"em', "+
            "'letter-spacing':'"+accordionContentTypography['fletspM']+"px', "+
          "}); "+

        "}"+
      "});"+
      
      "var currentVPS = jQuery('.currentViewPortSize').val();"+
      "if ( currentVPS == 'rbt-s' ) { "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionTitle').css({"+
            "'font-size':'"+accordionTitleTypography['fsizeM']+accordionTitleTypography['fsizeuM']+"', "+
            "'line-height':'"+accordionTitleTypography['flinhM']+"em', "+
            "'letter-spacing':'"+accordionTitleTypography['fletspM']+"px', "+
          "}); "+

          "jQuery('#accordion_widget_"+uniqueAccordionId+" .accordionContent').css({"+
            "'font-size':'"+accordionContentTypography['fsizeM']+accordionContentTypography['fsizeuM']+"', "+
            "'line-height':'"+accordionContentTypography['flinhM']+"em', "+
            "'letter-spacing':'"+accordionContentTypography['fletspM']+"px', "+
          "}); "+
      
      "}"+

    '</script>'
  ;

  var thisRenderredWidget = {
    WidgetHtml: fullRenderedAccordionWidget,
    WidgetScript: accordionCSS + accordionScript + accordionDefaultStylesScript + accordionTabletStylesScript + accordionMobileStylesScript ,
  }
  return thisRenderredWidget;

}

function pluginopsTabsWidgetRender(this_widget, j , rowID,this_column,this_column_type){


  var tabItems = this_widget['tabItems'];
  var tabIcon = this_widget['tabIcon'];
  var tabettings = this_widget['tabSettings'];
  var tabTitle = this_widget['tabTitle'];
  var tabTitleTypography = this_widget['tabTitle']['typography'];
  var tabContent = this_widget['tabContent'];
  var tabContentTypography = this_widget['tabContent']['typography'];

  var uniquetabId = Math.floor((Math.random() * 2000) + 100);

  var allTabTitles = '';
  var allTabContent = '';

  if (tabTitleTypography['ffam'] == '') { tabTitleTypography['ffam'] = ' '; }


  jQuery.each(tabItems,function(index, val) {

    thisTabIcon = '';
    if (val['icon'] != '') {
      thisTabIcon = '<i class=" '+val['icon']+' tab_icon"></i>';
    }
    
    linkActiveContainer = ''; linkActiveClass = '';
    if (index == 0) {
      linkActiveClass = 'tab_widget_linkActive';
      linkActiveContainer = 'tabContentActive';
    }

    thisTabIconAfter = ''; thisTabIconBefore = '';
    if (tabIcon['acciPos'] == 'before') {
      thisTabIconBefore = thisTabIcon;
    }else{
      thisTabIconAfter = thisTabIcon;
    }


    thisTabTitle =
      "<li class='tab_widget-menu tabTitle tab_widget-tab_link "+linkActiveClass+"' data-href='#tabWidget_"+index+"_"+uniquetabId+"' >"+
        thisTabIconBefore+
          val['title']+
        thisTabIconAfter+
      "</li>"
    ;


    var accContent = val['content'];
    var tabTitleEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-fieldName='accContent' data-fieldIndex='"+index+"' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";

    if (accContent == '') { accContent = ' '; }

    if ( accContent.includes('defaultELt') ) {
    }else{
      accContent = "<span class='elLtWrapped defaultELt'> " +val['content']+" </span> <div class='ltwFontScript' style='display:none;'></div>";
    }


    let accordContentTextWrapped = tabTitleEditingSaveTriggerBtn +
      "<div class='wltControls' style='display:none;'></div>" + 
      "<div class='liveTextWrap liveText-"+j+" ' data-colInd='"+this_column+"' data-rowId='"+rowID+"' >"+
        "<div contenteditable='true' class='eltEditable' > "+ 
          accContent +
        "</div>"+
      "</div> ";

    thistabContent =
      '<div id="tabWidget_'+index+'_'+uniquetabId+'" class="tab_widget-tab tabContent '+linkActiveContainer+'" > '+accordContentTextWrapped+' </div>'
    ;


    allTabTitles = allTabTitles + "\n" + thisTabTitle;

    allTabContent = allTabContent + "\n" + thistabContent;

  });


  fullRenderedtabWidget = 
    "<div class='tab_widget tab_widget-tab' id='tab_widget_"+uniquetabId+"' >"+
      "<div style='width:95%;display:block; float:left;' >"+
        "<ul class='tab_widget-links'>"+
          allTabTitles+
        "</ul>"+
      "</div>"+
      "<div class='tab_widget-tab-content' style='float:left;'>"+
        allTabContent+
      "</div>"+
    "</div>"
  ;


  var thisTitleBorderWidth = tabTitle['borwt']+'px ' + tabTitle['borwr']+'px ' + tabTitle['borwb']+'px ' + tabTitle['borwl']+'px ';
  var thisAccordTitleStyles = 
    'background:'+tabTitle['acctbg']+';'+
    'color:'+tabTitle['acctc']+';'+
    'padding:'+tabTitle['vgap']+'px '+tabTitle['hgap']+'px;'+
    'border-style:'+tabettings['accocbort']+';'+
    'border-color:'+tabettings['accocborc']+' !important;'+
    'border-width: '+thisTitleBorderWidth+' ;'+
    'margin: 0px 0 0 0;'
  ;

  thisPickedFontFamily = tabTitleTypography['ffam'];

  thisPickedFontFamily = thisPickedFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(thisPickedFontFamily)) {
    thisPickedFontFamily = '"'+thisPickedFontFamily+'"';
  }

  var thisAccordTitleTypoStyles =
    'font-family:'+thisPickedFontFamily+';'+
    'font-size:'+tabTitleTypography['fsize']+tabTitleTypography['fsizeu']+';'+
    'font-weight:'+tabTitleTypography['fwei']+';'+
    'text-transform:'+tabTitleTypography['ftrans']+';'+
    'text-style:'+tabTitleTypography['fstyl']+';'+
    'text-decoration:'+tabTitleTypography['fdeco']+';'+
    'line-height:'+tabTitleTypography['flinh']+'em;'+
    'letter-spacing:'+tabTitleTypography['fletsp']+'px;'
  ;

  var thisContentBorderWidth = tabContent['borwt']+'px ' + tabContent['borwr']+'px ' + tabContent['borwb']+'px ' + tabContent['borwl']+'px ';
  var thisAccordContentStyles =
    'background:'+tabContent['acccbg']+';'+
    'color:'+tabContent['acccc']+';'+
    'padding:'+tabContent['vgap']+'px '+tabContent['hgap']+'px;'+
    'border-style:'+tabettings['accocbort']+';'+
    'border-color:'+tabettings['accocborc']+'; !important;'+
    'border-width: '+thisContentBorderWidth+' ;'
  ;


  thisPickedFontFamily = tabContentTypography['ffam'];

  thisPickedFontFamily = thisPickedFontFamily.replace(/\+/g, ' ');
  if (popb_hasNumber(thisPickedFontFamily)) {
    thisPickedFontFamily = '"'+thisPickedFontFamily+'"';
  }


  var thisAccordContentTypoStyles =
    'font-family:'+thisPickedFontFamily+';'+
    'font-size:'+tabContentTypography['fsize']+tabContentTypography['fsizeu']+';'+
    'font-weight:'+tabContentTypography['fwei']+';'+
    'text-transform:'+tabContentTypography['ftrans']+';'+
    'text-style:'+tabContentTypography['fstyl']+';'+
    'text-decoration:'+tabContentTypography['fdeco']+';'+
    'line-height:'+tabContentTypography['flinh']+'em;'+
    'letter-spacing:'+tabContentTypography['fletsp']+'px;'
  ;

  tabCSS = 
    '<style>'+

      '#tab_widget_'+uniquetabId+' .tabTitle {'+
        thisAccordTitleStyles+
        thisAccordTitleTypoStyles+
      '}'+

      '#tab_widget_'+uniquetabId+' .tabContent {'+
        thisAccordContentStyles+
        thisAccordContentTypoStyles+
      '}'+

      '#tab_widget_'+uniquetabId+' .ui-tab-header-active {'+
        'color: '+tabTitle['acctc']+';'+
        'background: '+tabTitle['acctabg']+';'+
      '}'+

      '#tab_widget_'+uniquetabId+' .tab_widget-menu i {'+
        'padding: 0px '+tabIcon['acciGap']+'px;'+
      '}'+

      '#tab_widget_'+uniquetabId+'  .tab_widget_linkActive { '+
        'color: '+tabTitle['acctac']+' !important;'+
        'background: '+tabTitle['acctabg']+' !important;'+
      '}'+

      '#tab_widget_'+uniquetabId+' .tabContent  {'+
        'display:none;'+
      '}'+
      '#tab_widget_'+uniquetabId+' .tabContentActive  {'+
        'display:block !important;'+
      '}'+
      '.tab_widget {min-height:135px;} '+
      '.tab_widget  .ui-icon { display:none; }'+
      '.tab_widget  .acw_iconOpen { display:none; }'+


    '</style>'
  ;


  if (tabettings['accoActive'] == 'true') {
    var istabActive = '';
  }else{
    var istabActive = 'active:false,';
  }
  
  tabScript = 
    '<script>'+
      'jQuery( function() {'+

        "jQuery('#tab_widget_"+uniquetabId+" .tab_widget-tab_link').on('click', function(e)  {"+
            "var currentAttrValue = jQuery(this).attr('data-href');"+
            
            "jQuery('#tab_widget_"+uniquetabId+" .tab_widget-tab-content ' + currentAttrValue).show().siblings().hide();"+
            
            "jQuery('#tab_widget_"+uniquetabId+" .tabContentActive ').removeClass('tabContentActive');"+
            "jQuery('#tab_widget_"+uniquetabId+" .tab_widget-tab-content ' + currentAttrValue).addClass('tabContentActive');"+

            "jQuery(this).addClass('tab_widget_linkActive').siblings().removeClass('tab_widget_linkActive');"+
     
            "e.preventDefault();"+
        "});"+

      '});'+
    '</script>'
  ;


  tabDefaultStylesScript = 
    '<script>'+
      "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-l') ) { "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabTitle').css({"+
            "'font-size':'"+tabTitleTypography['fsize']+tabTitleTypography['fsizeu']+"', "+
            "'line-height':'"+tabTitleTypography['flinh']+"em', "+
            "'letter-spacing':'"+tabTitleTypography['fletsp']+"px', "+
          "}); "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabContent').css({"+
            "'font-size':'"+tabContentTypography['fsize']+tabContentTypography['fsizeu']+"', "+
            "'line-height':'"+tabContentTypography['flinh']+"em', "+
            "'letter-spacing':'"+tabContentTypography['fletsp']+"px', "+
          "}); "+

        "}"+
      "});"+
      
      "var currentVPS = jQuery('.currentViewPortSize').val();"+
      "if ( currentVPS == 'rbt-l' ) { "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabTitle').css({"+
            "'font-size':'"+tabTitleTypography['fsize']+tabTitleTypography['fsizeu']+"', "+
            "'line-height':'"+tabTitleTypography['flinh']+"em', "+
            "'letter-spacing':'"+tabTitleTypography['fletsp']+"px', "+
          "}); "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabContent').css({"+
            "'font-size':'"+tabContentTypography['fsize']+tabContentTypography['fsizeu']+"', "+
            "'line-height':'"+tabContentTypography['flinh']+"em', "+
            "'letter-spacing':'"+tabContentTypography['fletsp']+"px', "+
          "}); "+
      
      "}"+

    '</script>'
  ;

  tabTabletStylesScript = 
    '<script>'+
      "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-m') ) { "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabTitle').css({"+
            "'font-size':'"+tabTitleTypography['fsizeT']+tabTitleTypography['fsizeuT']+"', "+
            "'line-height':'"+tabTitleTypography['flinhT']+"em', "+
            "'letter-spacing':'"+tabTitleTypography['fletspT']+"px', "+
          "}); "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabContent').css({"+
            "'font-size':'"+tabContentTypography['fsizeT']+tabContentTypography['fsizeuT']+"', "+
            "'line-height':'"+tabContentTypography['flinhT']+"em', "+
            "'letter-spacing':'"+tabContentTypography['fletspT']+"px', "+
          "}); "+

        "}"+
      "});"+
      
      "var currentVPS = jQuery('.currentViewPortSize').val();"+
      "if ( currentVPS == 'rbt-m' ) { "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabTitle').css({"+
            "'font-size':'"+tabTitleTypography['fsizeT']+tabTitleTypography['fsizeuT']+"', "+
            "'line-height':'"+tabTitleTypography['flinhT']+"em', "+
            "'letter-spacing':'"+tabTitleTypography['fletspT']+"px', "+
          "}); "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabContent').css({"+
            "'font-size':'"+tabContentTypography['fsizeT']+tabContentTypography['fsizeuT']+"', "+
            "'line-height':'"+tabContentTypography['flinhT']+"em', "+
            "'letter-spacing':'"+tabContentTypography['fletspT']+"px', "+
          "}); "+
      
      "}"+

    '</script>'
  ;

  tabMobileStylesScript = 
    '<script>'+
      "jQuery('.responsiveBtn').on('click',function(){"+
        "if (jQuery(this).hasClass('rbt-s') ) { "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabTitle').css({"+
            "'font-size':'"+tabTitleTypography['fsizeM']+tabTitleTypography['fsizeuM']+"', "+
            "'line-height':'"+tabTitleTypography['flinhM']+"em', "+
            "'letter-spacing':'"+tabTitleTypography['fletspM']+"px', "+
          "}); "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabContent').css({"+
            "'font-size':'"+tabContentTypography['fsizeM']+tabContentTypography['fsizeuM']+"', "+
            "'line-height':'"+tabContentTypography['flinhM']+"em', "+
            "'letter-spacing':'"+tabContentTypography['fletspM']+"px', "+
          "}); "+

        "}"+
      "});"+
      
      "var currentVPS = jQuery('.currentViewPortSize').val();"+
      "if ( currentVPS == 'rbt-s' ) { "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabTitle').css({"+
            "'font-size':'"+tabTitleTypography['fsizeM']+tabTitleTypography['fsizeuM']+"', "+
            "'line-height':'"+tabTitleTypography['flinhM']+"em', "+
            "'letter-spacing':'"+tabTitleTypography['fletspM']+"px', "+
          "}); "+

          "jQuery('#tab_widget_"+uniquetabId+" .tabContent').css({"+
            "'font-size':'"+tabContentTypography['fsizeM']+tabContentTypography['fsizeuM']+"', "+
            "'line-height':'"+tabContentTypography['flinhM']+"em', "+
            "'letter-spacing':'"+tabContentTypography['fletspM']+"px', "+
          "}); "+
      
      "}"+

    '</script>'
  ;

  var thisRenderredWidget = {
    WidgetHtml: fullRenderedtabWidget,
    WidgetScript: tabCSS + tabScript + tabDefaultStylesScript + tabTabletStylesScript + tabMobileStylesScript ,
  }
  return thisRenderredWidget;

}


// completeWidgetRender
function completeWidgetRender(this_column_widgets_array_C, j, this_column, rowID, thisColFontsToLoad){
  //console.log('completeWidgetRender triggered');
  //var t0 = performance.now();

          var this_column_widgets_array_current = this_column_widgets_array_C;

          var thisModelDataAttr =  JSON.stringify(  _.clone(this_column_widgets_array_current) );

          thisModelDataAttr = JSON.parse(thisModelDataAttr);

          var defaultModelDataAttr = JSON.stringify( _.clone(pageBuilderApp.colWidgetDefaults ) );

          defaultModelDataAttr = JSON.parse(defaultModelDataAttr);

          mergeNonsetObjectKeys(thisModelDataAttr, defaultModelDataAttr);

          this_column_widgets_array_current = thisModelDataAttr;

          var this_column_type = this_column_widgets_array_current['widgetType'];
          var widgetStyling = this_column_widgets_array_current['widgetStyling'];

          var widgetMtop = this_column_widgets_array_current['widgetMtop'];
          var widgetMleft = this_column_widgets_array_current['widgetMleft'];
          var widgetMbottom = this_column_widgets_array_current['widgetMbottom'];
          var widgetMright = this_column_widgets_array_current['widgetMright'];

          var widgetPtop = this_column_widgets_array_current['widgetPtop'];
          var widgetPleft = this_column_widgets_array_current['widgetPleft'];
          var widgetPbottom = this_column_widgets_array_current['widgetPbottom'];
          var widgetPright = this_column_widgets_array_current['widgetPright'];

          var widgetBgColor = this_column_widgets_array_current['widgetBgColor'];
          isAnimateTrue = jQuery('.isAnimateTrue').val();
          animateWidgetId = jQuery('.animateWidgetId').val();
          if (this_column_widgets_array_current['widgetAnimation'] != 'undefined') {
            if (isAnimateTrue == 'animate' && parseInt(animateWidgetId) == j) {
              var widgetAnimation = ' animated '+this_column_widgets_array_current['widgetAnimation'];
              
              jQuery('.isAnimateTrue').val('');
            }else{
              var widgetAnimation = '';
            }
          }else{ 
            var widgetAnimation = '';
          }

          var allResponsiveScripts = '';
          var widgetBorderStyle = this_column_widgets_array_current['widgetBorderStyle'];
          var widgetBorderColor = this_column_widgets_array_current['widgetBorderColor'];
          var widgetBoxShadowH = this_column_widgets_array_current['widgetBoxShadowH'];
          var widgetBoxShadowV = this_column_widgets_array_current['widgetBoxShadowV'];
          var widgetBoxShadowBlur = this_column_widgets_array_current['widgetBoxShadowBlur'];
          var widgetBoxShadowColor = this_column_widgets_array_current['widgetBoxShadowColor'];

          widgetBorderRadius = '';
          if (typeof( this_column_widgets_array_current['widgetBorderRadius']) == 'undefined' ) {
            this_column_widgets_array_current['widgetBorderRadius'] == '';
          }
          widgetBorderWidth = '';
          if (typeof( this_column_widgets_array_current['widgetBorderWidth']) == 'undefined' ) {
            this_column_widgets_array_current['widgetBorderWidth'] == '';
          }

          if (this_column_widgets_array_current['borderRadius'] != 'undefined' && this_column_widgets_array_current['borderRadius'] != null) {
            widgetBorderRadius = this_column_widgets_array_current['borderRadius'];
          }else{
            widgetBorderRadius['wbrt'] = widgetBorderRadius;
            widgetBorderRadius['wbrb'] = widgetBorderRadius;
            widgetBorderRadius['wbrl'] = widgetBorderRadius;
            widgetBorderRadius['wbrr'] = widgetBorderRadius;
          }
          if (this_column_widgets_array_current['borderWidth'] != 'undefined' && this_column_widgets_array_current['borderWidth'] != null) {
            widgetBorderWidth = this_column_widgets_array_current['borderWidth'];
          }else{
            widgetBorderWidth['wbwt'] = this_column_widgets_array_current['widgetBorderWidth'];
            widgetBorderWidth['wbwb'] = this_column_widgets_array_current['widgetBorderWidth'];
            widgetBorderWidth['wbwl'] = this_column_widgets_array_current['widgetBorderWidth'];
            widgetBorderWidth['wbwr'] = this_column_widgets_array_current['widgetBorderWidth'];
          }

          var this_widget_border_shadow = 'border-width: '+widgetBorderWidth['wbwt']+'px '+widgetBorderWidth['wbwr']+'px  '+widgetBorderWidth['wbwb']+'px '+widgetBorderWidth['wbwl']+'px; border-style: '+widgetBorderStyle+'; border-color: '+widgetBorderColor+'; border-radius:'+widgetBorderRadius['wbrt']+'px '+widgetBorderRadius['wbrr']+'px '+widgetBorderRadius['wbrb']+'px '+widgetBorderRadius['wbrl']+'px; box-shadow: '+widgetBoxShadowH+'px  '+widgetBoxShadowV+'px  '+widgetBoxShadowBlur+'px '+widgetBoxShadowColor+' ;  ';


          var po_widgets = ' ';
          if (this_column_type != 'wigt-pb-text' && this_column_type != 'wigt-pb-liveText' && this_column_type != 'wigt-btn-gen' && this_column_type != 'wigt-WYSIWYG' && this_column_type != 'wigt-pb-pricing' && this_column_type != 'wigt-pb-navmenu') {
            po_widgets = 'po_widgets';
          }

          po_widgets = 'po_widgets';

          if (this_column_type == 'wigt-pb-liveText') {
            po_widgets = ' ';
          }

          switch (this_column_type) {
            case 'wigt-WYSIWYG':
              
              var this_column_editor = this_column_widgets_array_current['widgetWYSIWYG'];
              if (typeof(this_column_editor['widgetContentFonts']) == 'undefined') {
                this_column_editor['widgetContentFonts'] == '';
              }

              if (typeof(this_column_editor['widgetContent']) == 'undefined') { this_column_editor['widgetContent'] = ' '; }
              if (this_column_editor['widgetContent'] == '') {
                this_column_editor['widgetContent'] = ' ';
              }

              widgetElWithScript = false;
              if (this_column_editor['widgetContent'].indexOf("<script>") >= 0)  {
                widgetElWithScript =  true;
              }
              if (this_column_editor['widgetContent'].indexOf('<script type="text/javascript">') >= 0)  {
                widgetElWithScript =  true;
              }
              if (this_column_editor['widgetContent'].indexOf("<script type='text/javascript'>") >= 0)  {
                widgetElWithScript =  true;
              }

              if (widgetElWithScript == true) {
                contentsofThisWidget = ' <div title="Scripts Detected" style="text-align:center; font-size:17px; padding:5px 0; width:100%; background:#b5b5b5; color:#fff; "> Scripts will only be added on front end side of page. </div> ';

                this_column_editor_content = contentsofThisWidget;
              }else{
                contentsofThisWidget = this_column_editor['widgetContent'];
                var this_column_editor_content =  contentsofThisWidget;
              }

              
              this_column_content = this_column_editor_content;
              contentAlign = 'none';
              break;
            case 'wigt-img':
              var this_column_img_content = this_column_widgets_array_current['widgetImg'];
              
              try {
                var this_column_content = imageWidgetRender(this_column_img_content, j , rowID,this_column,this_column_type);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
              
              contentAlign = 'none';
            break;
            case 'wigt-menu':
              //Column Menu Widget
              var this_column_menu_content = this_column_widgets_array_current['widgetMenu'];
              var pbMenuFontFamily = this_column_menu_content['pbMenuFontFamily'];
              try {
                var this_column_content = navigationMenuWidgetRender(this_column_menu_content);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              var thisWidgetFonts = '<link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+pbMenuFontFamily+'">';
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'] + thisWidgetFonts;
              contentAlign = 'none';
              break;
            case 'wigt-btn-gen':
              //Button Widget
              var this_widget_btn = this_column_widgets_array_current['widgetButton'];
              var btnText = this_widget_btn['btnText'];
              var btnLink = this_widget_btn['btnLink'];
              var btnBgColor = this_widget_btn['btnBgColor'];
              var btnTextColor = this_widget_btn['btnTextColor'];
              var btnFontSize = this_widget_btn['btnFontSize'];
              var btnHoverBgColor = this_widget_btn['btnHoverBgColor'];
              var btnHoverTextColor = this_widget_btn['btnHoverTextColor'];
              var btnWidth = this_widget_btn['btnWidth'];
              var btnHeight = this_widget_btn['btnHeight'];
              var btnBlankAttr = this_widget_btn['btnBlankAttr'];
              var btnBorderColor = this_widget_btn['btnBorderColor'];
              var btnBorderWidth = this_widget_btn['btnBorderWidth'];
              var btnBorderRadius = this_widget_btn['btnBorderRadius'];
              var btnButtonAlignment = this_widget_btn['btnButtonAlignment'];
              pbWidgetBtnId = 'pb_btn_'+Math.floor((Math.random() * 2000) + 100);

              if (typeof(this_widget_btn['btnButtonFontFamily']) != 'undefined') {
                var btnButtonFontFamily = this_widget_btn['btnButtonFontFamily'];
              } else{
                var btnButtonFontFamily = 'none';
              }

              btnIcon = ''; btnIconBefore = ''; btnIconAfter = ''; btnIconAnimation = '';
              if (typeof(this_widget_btn['btnSelectedIcon']) != 'undefined') {
                btnSelectedIcon = this_widget_btn['btnSelectedIcon'];
                btnIconPosition = this_widget_btn['btnIconPosition'];
                btnIconAnimation = this_widget_btn['btnIconAnimation'];
                btnIconGap = this_widget_btn['btnIconGap'];

                if (btnSelectedIcon != '') {
                  if (btnIconPosition == 'before') {
                    btnIconGap = 'margin-right:'+btnIconGap+'px;';
                  }else{
                    btnIconGap = 'margin-left:'+btnIconGap+'px;';
                  }

                  if (typeof(btnSelectedIcon) == 'undefined') { btnSelectedIcon = ' '; }
                  if (btnSelectedIcon == '') { btnSelectedIcon = ' '; }
                  faClassAppend = 'fa';
                  if (btnSelectedIcon.indexOf("fab") >= 0 || btnSelectedIcon.indexOf("fas") >= 0 || btnSelectedIcon.indexOf("far") >= 0)  {
                    faClassAppend = '';
                  }

                  btnIcon = '<i style="'+btnIconGap+'" class="'+faClassAppend+' '+btnSelectedIcon+'"></i>';
                }else{
                  btnIcon = '';
                }

                if (btnIconPosition == 'before') {
                  btnIconBefore = btnIcon;
                  btnIconAfter = '';
                }else{
                  btnIconAfter = btnIcon;
                  btnIconBefore = '';
                }
              }

              var btn_width = "padding: "+btnHeight+"px "+btnWidth+"px !important;";
              if (typeof(this_widget_btn['btnWidthPercent']) != 'undefined') {
                var btnWidthPercent = this_widget_btn['btnWidthPercent'];
                if (btnWidthPercent !== '') {
                  var btn_width = "padding: "+btnHeight+"px "+'5'+"px !important; width:"+btnWidthPercent+"%;";
                }
                
              } else{
                var btnWidthPercent = 'none';
              }

              var btnWidthUnit = '%';
              var btnWidthUnitTablet = '%';
              var btnWidthUnitMobile = '%';
              if (typeof(this_widget_btn['btnWidthUnit']) != 'undefined') {
                btnWidthUnit = this_widget_btn['btnWidthUnit'];
                btnWidthUnitTablet = this_widget_btn['btnWidthUnitTablet'];
                btnWidthUnitMobile = this_widget_btn['btnWidthUnitMobile'];
              }

              var btnTextEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";

              var btnTextWrapped = " "+btnIconBefore+" <span>"+btnText+"   </span> "+btnIconAfter+" ";


              

              //btnTextWrapped = '<div id="widgetInlineEditor"  data-wid_col_id="'+this_column+'"  data-widget_id="'+j+'" data-widgetType="'+this_column_type+'" > '+btnIconBefore+' '+btnText+' '+btnIconAfter+' </div>'+btnTextEditingSaveTriggerBtn;

              btnButtonFontFamily = btnButtonFontFamily.replace(/\+/g, ' ');

              if (popb_hasNumber(btnButtonFontFamily)) {
                btnButtonFontFamily = '"'+btnButtonFontFamily+'"';
              }

              var this_widget_btn_complete =
                "<div class='wdt-"+this_column_type+" parent-"+pbWidgetBtnId+"' style='text-align:"+btnButtonAlignment+"; margin:0 0 2px 0; padding:0;' > "+
                  "<button id='"+pbWidgetBtnId+"' style='color:"+btnTextColor+" !important;font-size:"+btnFontSize+"px !important; background: "+btnBgColor+" !important; background-color: "+btnBgColor+" !important;  border: "+btnBorderWidth+"px solid "+btnBorderColor+" !important; border-radius: "+btnBorderRadius+"px !important; font-family:"+btnButtonFontFamily+" ,sans-serif; "+btn_width+" ' onClick='e.preventDefault()' >   "+btnTextWrapped+"  </button>"+
                "</div>"+
                "<style> #"+pbWidgetBtnId+":hover {background:"+btnHoverBgColor+" !important; color:"+btnHoverTextColor+" !important; transition: all .5s;}  </style>";

                  var currButtonWidgetDefaultResponsive  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-l') ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').css({'font-size':'"+btnFontSize+"px', 'width':'"+btnWidthPercent+btnWidthUnit+"', 'padding-top':'"+btnHeight+"px', 'padding-bottom':'"+btnHeight+"px', }); "+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignment+"', });"+
                      " }"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      " if ( currentVPS == 'rbt-l' ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').css({'font-size':'"+btnFontSize+"px', 'width':'"+btnWidthPercent+btnWidthUnit+"', 'padding-top':'"+btnHeight+"px', 'padding-bottom':'"+btnHeight+"px', });"+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignment+"', }); "+
                      
                      "}"+
                      " "+
                      '</script> ';

                  btnButtonAlignmentTablet = ''; btnButtonAlignmentMobile = '';
                  if (typeof(this_widget_btn['btnButtonAlignmentTablet']) != 'undefined') {
                    btnButtonAlignmentTablet = this_widget_btn['btnButtonAlignmentTablet'];
                  }

                  if (typeof(this_widget_btn['btnButtonAlignmentMobile']) != 'undefined') {
                    btnButtonAlignmentMobile = this_widget_btn['btnButtonAlignmentMobile'];
                  }
                  
                  currButtonWidgetDefaultResponsiveTablet = '';
                  currButtonWidgetDefaultResponsiveMobile = '';
                  if (
                    typeof(this_widget_btn['btnFontSizeTablet']) !== 'undefined' || 
                    typeof(this_widget_btn['btnFontSizeMobile']) !== 'undefined' || 
                    typeof(this_widget_btn['btnWidthPercentTablet']) !== 'undefined' || 
                    typeof(this_widget_btn['btnWidthPercentMobile']) !== 'undefined' ||
                    typeof(this_widget_btn['btnButtonAlignmentMobile']) !== 'undefined' ||
                    typeof(this_widget_btn['btnButtonAlignmentTablet']) !== 'undefined'
                    ) {
                    var currButtonWidgetDefaultResponsiveTablet  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-m') ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').css({'font-size':'"+this_widget_btn['btnFontSizeTablet']+"px', 'width':'"+this_widget_btn['btnWidthPercentTablet']+btnWidthUnitTablet+"', 'padding-top':'"+this_widget_btn['btnHeightTablet']+"px', 'padding-bottom':'"+this_widget_btn['btnHeightTablet']+"px', }); "+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignmentTablet+"', }); "+
                      "}"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-m' ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').css({'font-size':'"+this_widget_btn['btnFontSizeTablet']+"px', 'width':'"+this_widget_btn['btnWidthPercentTablet']+btnWidthUnitTablet+"', 'padding-top':'"+this_widget_btn['btnHeightTablet']+"px', 'padding-bottom':'"+this_widget_btn['btnHeightTablet']+"px', }); "+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignmentTablet+"', }); "+
                      "}"+
                      " "+
                      '</script> ';

                    var currButtonWidgetDefaultResponsiveMobile  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-s') ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').css({'font-size':'"+this_widget_btn['btnFontSizeMobile']+"px', 'width':'"+this_widget_btn['btnWidthPercentMobile']+btnWidthUnitMobile+"', 'padding-top':'"+this_widget_btn['btnHeightMobile']+"px', 'padding-bottom':'"+this_widget_btn['btnHeightMobile']+"px', }); "+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignmentMobile+"', }); "+
                      " }"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-s' ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').css({'font-size':'"+this_widget_btn['btnFontSizeMobile']+"px', 'width':'"+this_widget_btn['btnWidthPercentMobile']+btnWidthUnitMobile+"', 'padding-top':'"+this_widget_btn['btnHeightMobile']+"px', 'padding-bottom':'"+this_widget_btn['btnHeightMobile']+"px', });"+
                      "  jQuery('.parent-"+pbWidgetBtnId+"').css({'text-align':'"+btnButtonAlignmentMobile+"', }); "+
                      
                      "}"+
                      " "+
                      '</script> ';

                  }

                  currButtonWidgetResponsiveScripts = '\n' + currButtonWidgetDefaultResponsive + '\n' + currButtonWidgetDefaultResponsiveTablet + '\n' + currButtonWidgetDefaultResponsiveMobile;
                  
                  allResponsiveScripts = allResponsiveScripts + currButtonWidgetResponsiveScripts;

                var thisWidgetFonts = '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family='+btnButtonFontFamily+'">';
                this_widget_btn_complete = this_widget_btn_complete + thisWidgetFonts;
              this_column_content = this_widget_btn_complete ;
            break;
            case 'wigt-pb-form':
              var this_widget_subscribeForm = this_column_widgets_array_current['widgetSubscribeForm'];
                try {
                  var this_column_content = subscribeFormWidgetRender(this_widget_subscribeForm);
                } catch(e) {
                  this_column_content = [];
                  this_column_content['WidgetScript'] = '';
                  this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                  console.log(e);
                }

                allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
                this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-postSlider':
              var this_widget_postsSlider = this_column_widgets_array_current['widgetPBPostsSlider'];
              
              try {
                var this_column_content = postsSliderWidgetRender(this_widget_postsSlider);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-video':
              var this_widget_widgetVideo = this_column_widgets_array_current['widgetVideo'];
              var videoWebM = this_widget_widgetVideo['videoWebM'];
              var videoMpfour = this_widget_widgetVideo['videoMpfour'];
              var videoThumb = this_widget_widgetVideo['videoThumb'];
              var vidAutoPlay = this_widget_widgetVideo['vidAutoPlay'];
              var vidLoop = this_widget_widgetVideo['vidLoop']; 
              var vidControls = this_widget_widgetVideo['vidControls'];

              var widgetVideoRender = "<video "+vidLoop+" muted "+vidAutoPlay+" poster='"+videoThumb+"' class='pbp_renderVideo video-js vjs-default-skin vjs-big-play-centered vjs-fluid' style='width:100%;' "+vidControls+"  data-setup='{}' ><source src='"+videoWebM+"' type='video/webm'><source src='"+videoMpfour+"' type='video/mp4'></video>"

                this_column_content = widgetVideoRender;
            break;
            case 'wigt-pb-icons':
              var this_widget_icons = this_column_widgets_array_current['widgetIcons'];
              var pbSelectedIcon = this_widget_icons['pbSelectedIcon'];
              var pbIconSize = this_widget_icons['pbIconSize'];
              var pbIconRotation = this_widget_icons['pbIconRotation'];
              var pbIconColor = this_widget_icons['pbIconColor'];
              var iconPadding = (parseInt(pbIconSize) / 3) + 5;

              if (typeof(this_widget_icons['pbIcStyle']) !='undefined') {
                var pbIcStyle = this_widget_icons['pbIcStyle'];
                var pbIcBgC = this_widget_icons['pbIcBgC'];
                var pbIcBC = this_widget_icons['pbIcBC'];
                var pbIcBW = this_widget_icons['pbIcBW'];
                var pbIcBR = this_widget_icons['pbIcBR'];
              }else{
                var pbIcStyle = 'none';
                var pbIcBgC = '';
                var pbIcBC = '';
                var pbIcBW = '';
                var pbIcBR = '';
              }

              if (pbIcBC == '') { pbIcBC = pbIconColor; }
              var iconTextShadow = '';
              if (typeof(this_widget_icons['pbIcSC']) != 'undefined' ) {
                iconTextShadow = 'text-shadow: '+this_widget_icons['pbIcSHP']+'px '+this_widget_icons['pbIcSVP']+'px '+this_widget_icons['pbIcSDB']+'px  '+this_widget_icons['pbIcSC']+' ;';
              }

              var widgetIconStyles = 'transform: rotate('+pbIconRotation+ 'deg); color:'+pbIconColor+'; font-size:'+pbIconSize+'px; margin:0 auto; '+iconTextShadow+'  ';

              if (pbIcStyle == 'solid') {
                var widgetIconStyles = 'transform: rotate('+pbIconRotation+ 'deg); color:'+pbIconColor+'; font-size:'+pbIconSize+'px; padding:'+iconPadding+'px;  border:'+pbIcBW+'px solid '+pbIcBC+'; border-radius:'+pbIcBR+'px; background:'+pbIcBgC+';  display: flex; align-items: center; justify-content: center; '+iconTextShadow+' ';
              }

              
              var widgetIconRender = '<div class="iconContainerDiv" style="text-align:center; display:flex; align-items:center; justify-content:center; "><i class="'+pbSelectedIcon+'" style="'+widgetIconStyles+'" ></i> </div>';

                this_column_content = widgetIconRender;
            break;
            case 'wigt-pb-counter':
              var this_widget_counter = this_column_widgets_array_current['widgetCounter'];
              var pbCounterID = 'pb_counter'+Math.floor((Math.random() * 2000) + 100);
              var counterStartingNumber = this_widget_counter['counterStartingNumber'];
              var counterEndingNumber = this_widget_counter['counterEndingNumber'];
              var counterNumberPrefix = this_widget_counter['counterNumberPrefix'];
              var counterNumberSuffix = this_widget_counter['counterNumberSuffix'];
              var counterAnimationTime = this_widget_counter['counterAnimationTime'];
              var counterTitle = this_widget_counter['counterTitle'];
              var counterTextColor = this_widget_counter['counterTextColor'];
              var counterTitleColor = this_widget_counter['counterTitleColor'];
              var counterNumberFontSize = this_widget_counter['counterNumberFontSize'];
              var counterTitleFontSize = this_widget_counter['counterTitleFontSize'];

              if (typeof(counterAnimationTime) == 'undefined') { counterAnimationTime = 0; }
              if(counterAnimationTime == '') {counterAnimationTime = 0; }

              if (typeof(counterStartingNumber) == 'undefined') { counterStartingNumber = '0'; }

              if (counterStartingNumber == '' || counterStartingNumber == ' ') { counterStartingNumber = '0'; }

              var counterScript =  "<script> jQuery('#"+pbCounterID+"').each(function () { var currElementCounter = jQuery(this); jQuery({ Counter: "+counterStartingNumber+" }).animate({ Counter: currElementCounter.text() }, { duration: "+counterAnimationTime+", easing: 'swing', step: function () { currElementCounter.text(Math.ceil(this.Counter)); }   });  }); </script>";

              var counterHTMLStyles = 'color:'+counterTextColor+'; font-size:'+counterNumberFontSize+'px;  line-height:1.5; text-align:center;';

              var counterTitleStyles = 'color:'+counterTitleColor+'; font-size:'+counterTitleFontSize+'px !important;  line-height:1.5; text-align:center;';

              var counterTitleHTML = '<div style="'+counterTitleStyles+'" >'+counterTitle+'</div>';

              var counterHTML = '<div style="'+counterHTMLStyles+'" >'+counterNumberPrefix+'<span id="'+pbCounterID+'">'+counterEndingNumber+'</span>'+counterNumberSuffix+' </div> '+counterTitleHTML;
              this_column_content = counterHTML + counterScript;
            break;
            case 'wigt-pb-audio':
              var this_widget_audio = this_column_widgets_array_current['widgetAudio'];
              var audioOgg = this_widget_audio['audioOgg'];
              var audioMpThree = this_widget_audio['audioMpThree'];
              var audioAutoPlay = this_widget_audio['audioAutoPlay'];
              var audioLoop = this_widget_audio['audioLoop'];
              var audioControls = this_widget_audio['audioControls'];

              var audioPlayerHTML = '<audio '+audioLoop+' '+audioControls+'  style="width:100%;" > <source src="'+audioOgg+'" type="audio/ogg"> <source src="'+audioMpThree+'" type="audio/mpeg"> Your browser does not support the audio player. </audio>';
              this_column_content = audioPlayerHTML;
            break; 
            case 'wigt-pb-cards':
              var this_widget_card = this_column_widgets_array_current['widgetCard'];
              try {
                var this_column_content = cardWidgetRender(this_widget_card, j, rowID,this_column,this_column_type);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break; 
            case 'wigt-pb-testimonial':
              var this_widget_testimonial = this_column_widgets_array_current['widgetTestimonial'];
              try {
                var this_column_content = testimonialWidgetRender(this_widget_testimonial, j, this_column ,this_column_type, rowID);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-shortcode':
              var this_widget_shortcode = this_column_widgets_array_current['widgetShortCode'];
              try {
                var this_column_content = shortCodeWidgetRender(this_widget_shortcode);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-countdown': 
              var this_widget_countdown = this_column_widgets_array_current['widgetCowntdown'];
              try {
                var this_column_content = countDownWidgetRender(this_widget_countdown);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-imageSlider': 
              var this_widget_imageSlider = this_column_widgets_array_current['widgetImageSlider'];
              try {
                var this_column_content = imageSliderWidgetRender(this_widget_imageSlider);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-progressBar': 
              var this_widget_progressBar = this_column_widgets_array_current['widgetProgressBar'];

              var pbProgressBarTextFontFamily = this_widget_progressBar['pbProgressBarTextFontFamily'];

              var thisWidgetFonts = '<link rel="stylesheet"href="https://fonts.googleapis.com/css?family='+pbProgressBarTextFontFamily+'">';
              try {
                var this_column_content = progressBarWidgetRender(this_widget_progressBar);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'] + thisWidgetFonts;
            break;
            case 'wigt-pb-pricing':
              var this_widget_pricing = this_column_widgets_array_current['widgetPricing'];
              try {
                var this_column_content = pricingWidgetRender(this_widget_pricing,  j, rowID, this_column_type,this_column);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];

              po_widgets = ' ';
            break;
            case 'wigt-pb-imgCarousel':
              var this_widget_img_carousel = this_column_widgets_array_current['widgetImgCarousel'];
              try {
                var this_column_content = imgCarouselWidgetRender(this_widget_img_carousel);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-wooCommerceProducts':
              var this_widget_wooCommerceProducts = this_column_widgets_array_current['widgetWooPorducts'];
              try {
                var this_column_content = wooCommerceWidgetRender(this_widget_wooCommerceProducts);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-iconList':
              var this_widget_icon_list = this_column_widgets_array_current['widgetIconList'];
              try {
                this_column_content = iconListWidgetRender(this_widget_icon_list);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-spacer':
              var this_widget_spacer = this_column_widgets_array_current['widgetVerticalSpace'];
              pbWidgetSpacerId = 'pb_spacer_'+Math.floor((Math.random() * 2000) + 100);

              var currSpacerWidgetDefaultResponsive  = ''+
                '<script>'+
                "jQuery('.responsiveBtn').on('click',function(){"+
                " if (jQuery(this).hasClass('rbt-l') ) { "+

                "  jQuery('#"+pbWidgetSpacerId+"').animate({'height':'"+this_widget_spacer['widgetVerticalSpaceValue']+"px',}); "+
                "}"+
                
                " });"+
                "var currentVPS = jQuery('.currentViewPortSize').val();"+
                "if ( currentVPS == 'rbt-l' ) { "+

                "  jQuery('#"+pbWidgetSpacerId+"').animate({'height':'"+this_widget_spacer['widgetVerticalSpaceValue']+"px',}); "+
                
                "}"+
                " "+
                '</script> ';

                currSpacerWidgetResponsiveScripts = '\n' + currSpacerWidgetDefaultResponsive;
              if (typeof(this_widget_spacer['widgetVerticalSpaceValueTablet']) !== 'undefined') {
                  var currSpacerWidgetDefaultResponsiveTablet  = ''+
                    '<script>'+
                    "jQuery('.responsiveBtn').on('click',function(){"+
                    " if (jQuery(this).hasClass('rbt-m') ) { "+

                    "  jQuery('#"+pbWidgetSpacerId+"').animate({'height':'"+this_widget_spacer['widgetVerticalSpaceValueTablet']+"px',}); "+
                    "}"+
                    
                    " });"+
                    "var currentVPS = jQuery('.currentViewPortSize').val();"+
                    "if ( currentVPS == 'rbt-m' ) { "+

                    "  jQuery('#"+pbWidgetSpacerId+"').animate({'height':'"+this_widget_spacer['widgetVerticalSpaceValueTablet']+"px',}); "+
                    
                    "}"+
                    " "+
                    '</script> ';

                  var currSpacerWidgetDefaultResponsiveMobile  = ''+
                    '<script>'+
                    "jQuery('.responsiveBtn').on('click',function(){"+
                    " if (jQuery(this).hasClass('rbt-s') ) { "+

                    "  jQuery('#"+pbWidgetSpacerId+"').animate({'height':'"+this_widget_spacer['widgetVerticalSpaceValueMobile']+"px',}); "+
                    "}"+
                    
                    " });"+
                    "var currentVPS = jQuery('.currentViewPortSize').val();"+
                    "if ( currentVPS == 'rbt-s' ) { "+

                    "  jQuery('#"+pbWidgetSpacerId+"').animate({'height':'"+this_widget_spacer['widgetVerticalSpaceValueMobile']+"px',}); "+
                    
                    "}"+
                    " "+
                    '</script> ';

                  currSpacerWidgetResponsiveScripts = '\n' + currSpacerWidgetDefaultResponsive +'\n' + currSpacerWidgetDefaultResponsiveTablet + '\n' + currSpacerWidgetDefaultResponsiveMobile;
              }

              widgetSpacer = '<div id="'+pbWidgetSpacerId+'" style="height:'+this_widget_spacer['widgetVerticalSpaceValue']+'px ;"></div>';

              allResponsiveScripts = allResponsiveScripts + currSpacerWidgetResponsiveScripts;

              this_column_content = widgetSpacer;
            break;
            case 'wigt-pb-break':
              var this_widget_breaker = this_column_widgets_array_current['widgetBreaker'];

              widgetBreaker = '<div style=" padding:'+this_widget_breaker['widgetBreakerSpacing']+'px 0; text-align: '+this_widget_breaker['widgetBreakerAlignment']+' ; "> <span style=" border-top:'+this_widget_breaker['widgetBreakerWeight']+'px  '+this_widget_breaker['widgetBreakerStyle']+'   '+this_widget_breaker['widgetBreakerColor']+'; width:'+this_widget_breaker['widgetBreakerWidth']+'%; display:inline-block; line-height:0;" ></span> </div>';

              this_column_content = widgetBreaker;
            break;
            case 'wigt-pb-anchor':
              var this_widgetAnchor = this_column_widgets_array_current['widgetAnchor'];

              this_widgetAnchorHTML = '<div id="'+this_widgetAnchor['wdtanchorid']+'" title="Anchor Widget" style="text-align:center; font-size:15px; padding:5px 0; width:100%; background:#e3e3e3; color:#fff; "> <i class="fas fa-anchor"></i>  </div>';

              this_column_content = this_widgetAnchorHTML;
            break;
            case 'wigt-pb-formBuilder':
              var this_widget_form_builder = this_column_widgets_array_current['widgetFormBuilder'];
              try {
                this_column_content = formBuilderWidgetRender(this_widget_form_builder, j, this_column, rowID, this_column_type );
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-text':
              var this_widget_text = this_column_widgets_array_current['widgetText'];
                
              try {
                var this_column_content = customHeadingTextWidgetRender(this_widget_text, j, this_column, this_column_type, rowID);
                po_widgets = this_column_content['poWidgets'];
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];

            break;
            case 'wigt-pb-liveText':
              var thisWidgetFields = this_column_widgets_array_current['wLText'];
              try {
                this_column_content = liveTextWidgetRender(thisWidgetFields, j,  rowID , this_column);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }

              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-embededVideo':
              var this_widget_widgetEmbedVideo = this_column_widgets_array_current['widgetEmbedVideo'];
              try {
                var this_column_content = embededVideoRender(this_widget_widgetEmbedVideo);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-popupClose':

              var this_widget_btn_close = this_column_widgets_array_current['widgetClosePopUp'];
              var closeBtnText = this_widget_btn_close['closeBtnText'];
              var closeBtnBgColor = this_widget_btn_close['closeBtnBgColor'];
              var closeBtnColor = this_widget_btn_close['closeBtnColor'];
              var closeBtnFontSize = this_widget_btn_close['closeBtnFontSize'];
              var closeBtnHoverBgColor = this_widget_btn_close['closeBtnHoverBgColor'];
              var closeBtnWidth = this_widget_btn_close['closeBtnWidth'];
              var closeBtnHeight = this_widget_btn_close['closeBtnHeight'];
              var closeBtnBlankAttr = this_widget_btn_close['closeBtnBlankAttr'];
              var closeBtnBorderColor = this_widget_btn_close['closeBtnBorderColor'];
              var closeBtnBorderWidth = this_widget_btn_close['closeBtnBorderWidth'];
              var closeBtnBorderRadius = this_widget_btn_close['closeBtnBorderRadius'];
              var closeBtnButtonAlignment = this_widget_btn_close['closeBtnButtonAlignment'];
              pbWidgetBtnId = 'pb_btn_'+Math.floor((Math.random() * 2000) + 100);

              closeBtnBold = ''; closeBtnItalic = ''; closeBtnUnderlined = '';
                  if (this_widget_btn_close['closeBtnBold'] == true) { closeBtnBold = 'bold'; }
                  if (this_widget_btn_close['closeBtnItalic'] == true) { closeBtnItalic = 'italic'; }
                  if (this_widget_btn_close['closeBtnUnderlined'] == true) { closeBtnUnderlined = 'underline'; }


              if (typeof(this_widget_btn_close['closeBtnButtonFontFamily']) != 'undefined') {
                var closeBtnButtonFontFamily = this_widget_btn_close['closeBtnButtonFontFamily'];
              } else{
                var closeBtnButtonFontFamily = 'none';
              }

              var closeBtn_width = "padding: "+closeBtnHeight+"px "+closeBtnWidth+"px !important;";
              if (typeof(this_widget_btn_close['closeBtnWidthPercent']) != 'undefined') {
                var closeBtnWidthPercent = this_widget_btn_close['closeBtnWidthPercent'];
                if (btnWidthPercent !== '') {
                  var closeBtn_width = "padding: "+closeBtnHeight+"px "+'5'+"px !important; width:"+closeBtnWidthPercent+"%;";
                }
                
              } else{
                var btnWidthPercent = 'none';
              }

              var closeBtnWidthUnit = '%';
              var closeBtnWidthUnitTablet = '%';
              var closeBtnWidthUnitMobile = '%';
              if (typeof(this_widget_btn_close['closeBtnWidthUnit']) != 'undefined') {
                closeBtnWidthUnit = this_widget_btn_close['closeBtnWidthUnit'];
                closeBtnWidthUnitTablet = this_widget_btn_close['closeBtnWidthUnitTablet'];
                closeBtnWidthUnitMobile = this_widget_btn_close['closeBtnWidthUnitMobile'];
              }


              closeBtnButtonFontFamily = closeBtnButtonFontFamily.replace(/\+/g, ' ');

              if (popb_hasNumber(closeBtnButtonFontFamily)) {
                closeBtnButtonFontFamily = '"'+closeBtnButtonFontFamily+'"';
              }

              var closeBtnTextEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>"; 

              closeBtnTextWrapped = '<div id="widgetInlineEditor"  data-wid_col_id="'+this_column+'"  data-widget_id="'+j+'" data-widgetType="'+this_column_type+'" >'+closeBtnText+' </div>'+closeBtnTextEditingSaveTriggerBtn;

              var this_widget_btn_close_complete = "<div class='wdt-this_column_type' style='text-align:"+closeBtnButtonAlignment+";'> <button id='"+pbWidgetBtnId+"' style='color:"+closeBtnColor+" !important; font-weight:"+closeBtnBold+"; font-style:"+closeBtnItalic+"; text-decoration:"+closeBtnUnderlined+";  font-size:"+closeBtnFontSize+"px !important; background: "+closeBtnBgColor+" !important; background-color: "+closeBtnBgColor+" !important;  border: "+closeBtnBorderWidth+"px solid "+closeBtnBorderColor+" !important; border-radius: "+closeBtnBorderRadius+"px !important; font-family:"+closeBtnButtonFontFamily+" ,sans-serif; "+closeBtn_width+" ' disabled >"+closeBtnTextWrapped+"</button></div>";

                  var currButtonWidgetDefaultResponsive  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-l') ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+closeBtnFontSize+"px', 'width':'"+closeBtnWidthPercent+closeBtnWidthUnit+"', 'padding-top':'"+closeBtnHeight+"px', 'padding-bottom':'"+closeBtnHeight+"px', }); }"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      " if ( currentVPS == 'rbt-l' ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+closeBtnFontSize+"px', 'width':'"+closeBtnWidthPercent+closeBtnWidthUnit+"', 'padding-top':'"+closeBtnHeight+"px', 'padding-bottom':'"+closeBtnHeight+"px', });"+
                      
                      "}"+
                      " "+
                      '</script> ';

                  currButtonWidgetDefaultResponsiveTablet = '';
                  currButtonWidgetDefaultResponsiveMobile = '';
                  if (typeof(this_widget_btn_close['closeBtnFontSizeTablet']) !== 'undefined') {
                    var currButtonWidgetDefaultResponsiveTablet  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-m') ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+this_widget_btn_close['closeBtnFontSizeTablet']+"px', 'width':'"+this_widget_btn_close['closeBtnWidthPercentTablet']+closeBtnWidthUnitTablet+"', 'padding-top':'"+this_widget_btn_close['closeBtnHeightTablet']+"px', 'padding-bottom':'"+this_widget_btn_close['closeBtnHeightTablet']+"px', }); }"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-m' ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+this_widget_btn_close['closeBtnFontSizeTablet']+"px', 'width':'"+this_widget_btn_close['closeBtnWidthPercentTablet']+closeBtnWidthUnitTablet+"', 'padding-top':'"+this_widget_btn_close['closeBtnHeightTablet']+"px', 'padding-bottom':'"+this_widget_btn_close['closeBtnHeightTablet']+"px', }); "+
                      
                      "}"+
                      " "+
                      '</script> ';

                    var currButtonWidgetDefaultResponsiveMobile  = ''+
                      '<script>'+
                      "jQuery('.responsiveBtn').on('click',function(){"+
                      " if (jQuery(this).hasClass('rbt-s') ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+this_widget_btn_close['closeBtnFontSizeMobile']+"px', 'width':'"+this_widget_btn_close['closeBtnWidthPercentMobile']+closeBtnWidthUnitMobile+"', 'padding-top':'"+this_widget_btn_close['closeBtnHeightMobile']+"px', 'padding-bottom':'"+this_widget_btn_close['closeBtnHeightMobile']+"px', }); }"+
                      
                      " });"+
                      "var currentVPS = jQuery('.currentViewPortSize').val();"+
                      "if ( currentVPS == 'rbt-s' ) { "+

                      "  jQuery('#"+pbWidgetBtnId+"').animate({'font-size':'"+this_widget_btn_close['closeBtnFontSizeMobile']+"px', 'width':'"+this_widget_btn_close['closeBtnWidthPercentMobile']+closeBtnWidthUnitMobile+"', 'padding-top':'"+this_widget_btn_close['closeBtnHeightMobile']+"px', 'padding-bottom':'"+this_widget_btn_close['closeBtnHeightMobile']+"px', });"+
                      
                      "}"+
                      " "+
                      '</script> ';

                  }

                  currButtonWidgetResponsiveScripts = '\n' + currButtonWidgetDefaultResponsive + '\n' + currButtonWidgetDefaultResponsiveTablet + '\n' + currButtonWidgetDefaultResponsiveMobile;
                  
                thisColFontsToLoad.push(closeBtnButtonFontFamily);

                this_widget_btn_close_complete = this_widget_btn_close_complete + "\n"+ currButtonWidgetResponsiveScripts;
              this_column_content = this_widget_btn_close_complete ;
            break;
            case 'wigt-pb-testimonialCarousel':
              var this_widget_testimonialCar = this_column_widgets_array_current['widgetTCarousel'];
              try {
                var this_column_content = testimonialCarouselWidgetRender(this_widget_testimonialCar, j, this_column ,this_column_type);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-poOptins':
              var this_widget = this_column_widgets_array_current['widgetPoOptins'];
              try {
                var this_column_content = pluginopsOptinWidgetRender(this_widget);
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-navmenu':
              var this_widget = this_column_widgets_array_current['widgetNavBuilder'];
              try {
                var this_column_content = navigationBuilderWidgetRender(this_widget, j , rowID,this_column,this_column_type );
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-gallery':
              var this_widget = this_column_widgets_array_current['widgetIGallery'];  
              try {
                var this_column_content = imageGalleryWidgetRender(this_widget, j , rowID,this_column,this_column_type );
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
            break;
            case 'wigt-pb-shareThis':
              var this_widget = this_column_widgets_array_current['widgetShareThis'];

              var shareThisScripts = "<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property="+this_widget['wdtstId']+"' async='async'></script>";

              if (this_widget['wdtstId'] != '') {
                var shareThisRenderredHTML = '<div style="text-align:center;"> <div id="" title="ShareThis Widget" style="text-align:center; font-size:17px; padding:5px 0; width:100%; max-width:450px; background:#afafaf; color:#fff; margin:0 auto; "> <i class="fas fa-check" style="color:#3ae841;"></i> <p> The ShareThis Widget will be rendered on front end of page. </p> </div> </div>';

              }else{
                var shareThisRenderredHTML = ' <div style="text-align:center;"><div id="" title="ShareThis Widget" style="text-align:center; font-size:17px; padding:5px 0; width:100%; max-width:450px; background:#afafaf; color:#fff; margin:0 auto;"> <i class="fas fa-times" style="color:#f44336;" ></i> <p> Please edit this widget & enter propery ID for ShareThis buttons to load on front end. </p> </div> </div>';
              }
              
              allResponsiveScripts = allResponsiveScripts;
              this_column_content = shareThisRenderredHTML;
            break;
            case 'wigt-pb-accordion':
              var this_widget = this_column_widgets_array_current['widgetAccordion'];
              try {
                var this_column_content = pluginopsAccordionWidgetRender(this_widget, j , rowID,this_column,this_column_type );
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
              po_widgets = ' ';
            break;
            case 'wigt-pb-tabs':
              var this_widget = this_column_widgets_array_current['widgetTabs'];
              try {
                var this_column_content = pluginopsTabsWidgetRender(this_widget, j , rowID,this_column,this_column_type );
              } catch(e) {
                this_column_content = [];
                this_column_content['WidgetScript'] = '';
                this_column_content['WidgetHtml'] = '<p>Some Error occurred while rendering this widget.</p>';
                console.log(e);
              }
              allResponsiveScripts = allResponsiveScripts + this_column_content['WidgetScript'];
              this_column_content = this_column_content['WidgetHtml'];
              po_widgets = ' ';
            break;
            default:
              this_column_content = this_column_editor_content;
              contentAlign = 'none';
              break;
          }


          // Render widgets

          var widgetHandlesSameStyling  = 'width:25px; height:25px; float:left; padding:5px; display:none; cursor:pointer; z-index:99; position:absolute; text-align:center; color:#fff; margin-top:5px;';

          if (j == '0' || j == 0) {
            widgetHandlesSameStyling = widgetHandlesSameStyling + 'margin-top:10px;';
          }

          var widgetEditButtonsAttrs = 
            "data-wid_col_id='"+this_column+"'"+
            "data-widget_id='"+j+"'"+
            "data-overlay_id='widget-"+j+"'"+
            "data-parentWidgetId='"+rowID+'-'+this_column+"'"
          ;

          var widgetMoveHandle = 
            "<div class='widgetMoveHandle widgetHandle' style=' "+widgetHandlesSameStyling+" background:#494949; margin-left: 50px;' "+widgetEditButtonsAttrs+" >"+
              "<span class='dashicons dashicons-move' style='color:#fff;' title='Move'></span>"+
            "</div>"
          ;
          
          var widgetDuplicateHandle = 
            "<div class='widgetDuplicateHandle widgetHandle' style=' "+widgetHandlesSameStyling+" background:#9DC45F; margin-left:85px;' "+widgetEditButtonsAttrs+" >"+
              "<span class='dashicons dashicons-admin-page' style='color:#fff;' title='Duplicate Widget' "+widgetEditButtonsAttrs+" ></span>"+
            "</div>"
          ;

          var widgetEditHandle = 
            "<div class='widgetEditHandle widgetHandle' style=' "+widgetHandlesSameStyling+" background:#9DC45F; margin-left:120px;' "+widgetEditButtonsAttrs+"  >"+
              "<span class='dashicons dashicons-edit' style='color:#fff;' title='Edit Widget' "+widgetEditButtonsAttrs+"  ></span>"+
            "</div>"
          ;

          var widgetDeleteHandle = 
            "<div class='widgetDeleteHandle widgetHandle' style=' "+widgetHandlesSameStyling+" background:#e67e22; margin-left:155px;' "+widgetEditButtonsAttrs+" >"+
              "<span class='dashicons dashicons-trash' style='color:#fff;' title='Delete Widget' "+widgetEditButtonsAttrs+" ></span>"+
            "</div>"+
            "<div class='widgetCopyHandle widgetHandle' style=' "+widgetHandlesSameStyling+" width:35px; background:#607D8B; margin-left:190px;' "+widgetEditButtonsAttrs+" >Copy</div>"+
            "<div class='widgetPasteHandle widgetHandle' style=' "+widgetHandlesSameStyling+" width:35px; background:#607D8B; margin-left:235px;' "+widgetEditButtonsAttrs+" >Paste</div>"
            ;

            displayWigetInline = 'block';
            if (typeof(this_column_widgets_array_current['widgetIsInline']) !== 'undefined'){
              if (this_column_widgets_array_current['widgetIsInline'] == 'true') {
                displayWigetInline = 'inline-block';
              }
            }

            widgetCustomClass = '';
            if (typeof(this_column_widgets_array_current['widgetCustomClass']) !== 'undefined'){
              var widgetCustomClass = this_column_widgets_array_current['widgetCustomClass'];
            }


          var this_widget_paddings = "padding:"+widgetPtop+"% "+widgetPright+"% "+widgetPbottom+"% "+widgetPleft+"%;";


          var widgBackgroundOptions = 'background:'+widgetBgColor+';';

          if (typeof(this_column_widgets_array_current['widgBgImg']) !== 'undefined') {
            thisWidgBgImg = this_column_widgets_array_current['widgBgImg'];
            if (thisWidgBgImg !== '') {
              widgBackgroundOptions = 'background: url('+thisWidgBgImg+') no-repeat center; background-size:cover;';
            }
          }

          if (typeof(this_column_widgets_array_current['widgBackgroundType']) !== 'undefined') {
            if (this_column_widgets_array_current['widgBackgroundType'] == 'gradient') {
              var widgGradient = this_column_widgets_array_current['widgGradient'];

              if (widgGradient['widgGradientType'] == 'linear') {
                widgBackgroundOptions = 'background: linear-gradient('+widgGradient['widgGradientAngle']+'deg, '+widgGradient['widgGradientColorFirst']+' '+widgGradient['widgGradientLocationFirst']+'%,'+widgGradient['widgGradientColorSecond']+' '+widgGradient['widgGradientLocationSecond']+'%);';
              }

              if (widgGradient['widgGradientType'] == 'radial') {
                widgBackgroundOptions = 'background: radial-gradient(at '+widgGradient['widgGradientPosition']+', '+widgGradient['widgGradientColorFirst']+' '+widgGradient['widgGradientLocationFirst']+'%,'+widgGradient['widgGradientColorSecond']+' '+widgGradient['widgGradientLocationSecond']+'%);';
              }
              
            }
          }

          var thisWidgHoverStyleTag = '';
          var thisWidgHoverOption = '';
          if (typeof(this_column_widgets_array_current['widgHoverOptions']) !== 'undefined') {
            var widgID = "widget_"+rowID+"_"+this_column+"_"+j;
            var widgHoverOptions = this_column_widgets_array_current['widgHoverOptions'];
            if (widgHoverOptions['widgBackgroundTypeHover'] == 'solid') {
              var thisWidgHoverOption = ' #'+widgID+':hover { background:'+widgHoverOptions['widgBgColorHover']+' !important; transition: all '+widgHoverOptions['widgHoverTransitionDuration']+'s; }';
            }
            if (widgHoverOptions['widgBackgroundTypeHover'] == 'gradient') {
              var widgGradientHover = widgHoverOptions['widgGradientHover'];

              if (widgGradientHover['widgGradientTypeHover'] == 'linear') {
                thisWidgHoverOption = ' #'+widgID+':hover { background: linear-gradient('+widgGradientHover['widgGradientAngleHover']+'deg, '+widgGradientHover['widgGradientColorFirstHover']+' '+widgGradientHover['widgGradientLocationFirstHover']+'%,'+widgGradientHover['widgGradientColorSecondHover']+' '+widgGradientHover['widgGradientLocationSecondHover']+'%) !important; transition: all '+widgHoverOptions['widgHoverTransitionDuration']+'s; }';
              }

              if (widgGradientHover['widgGradientTypeHover'] == 'radial') {

                thisWidgHoverOption = ' #'+widgID+':hover { background: radial-gradient(at '+widgGradientHover['widgGradientPositionHover']+', '+widgGradientHover['widgGradientColorFirstHover']+' '+widgGradientHover['widgGradientLocationFirstHover']+'%,'+widgGradientHover['widgGradientColorSecondHover']+' '+widgGradientHover['widgGradientLocationSecondHover']+'%) !important; transition: all '+widgHoverOptions['widgHoverTransitionDuration']+'s; }';
              }
            }

            widgetHoverAnimationScript = '';
            if (typeof(widgHoverOptions['widgetHoverAnimation']) !== 'undefined') {
              var widgetHoverAnimation = widgHoverOptions['widgetHoverAnimation'];
              if (widgetHoverAnimation != '') {
                widgetHoverAnimationScript = " <script>"
                +"jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').mouseenter(function(){"
                  +" jQuery(this).addClass('animated "+widgetHoverAnimation+"').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',function(){ "
                      +"jQuery(this).removeClass('animated "+widgetHoverAnimation+"') "
                    +" }); "
                +"}); "
                +"</script> " ;
              }
            }
            thisWidgHoverStyleTag = '<style> '+thisWidgHoverOption+' </style> ' + widgetHoverAnimationScript;
          }


          var dragTriggerBtn = "<div class='widget-"+j+" draggableWidgets ' style='display:none' data-widg_row_id='"+rowID+"' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' ></div>";
          var draggedWidgDelTriggerBtn = "<div class='widget-"+j+" wdgt-dragRemove draggedRemove_"+rowID+"_"+this_column+"_widg_"+j+"' style='display:none'  data-widg_row_id='"+rowID+"' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' ></div>";

          var inlineEditingSaveTriggerBtn = "<div class='widget-"+j+" inlineEditingSaveTrigger ' style='display:none' data-wid_col_id='"+this_column+"'  data-widget_id='"+j+"' data-widgetType='"+this_column_type+"' data-parentWidgetId='"+rowID+'-'+this_column+"' ></div>";


            if (j == 0) {
              var droppableAboveWidget = '<div class="droppableAboveWidget" style=" display:none;" data-targetColId="'+rowID+'-'+this_column+'"  data-widgetIndex="'+(j)+'" ></div>';
            } else{
              var droppableAboveWidget = '';
            }

            //droppableAboveWidget = '';
          

          var droppableBelowWidget = '<div class="droppableBelowWidget" style="display:none;" data-targetColId="'+rowID+'-'+this_column+'"  data-widgetIndex="'+(j+1)+'" ></div>';

          var widgetIsInline = '';
          var widgetIsInlineTablet = '';
          var widgetIsInlineMobile = '';
          if (typeof(this_column_widgets_array_current['widgetIsInlineTablet']) !== 'undefined'){
            if (this_column_widgets_array_current['widgetIsInline'] == 'true') {
              widgetIsInline = 'inline-block';
              widgetIsInlineTablet = 'inline-block';
              widgetIsInlineMobile = 'inline-block';
            }
            if (this_column_widgets_array_current['widgetIsInlineTablet'] == 'true') {
              widgetIsInlineTablet = 'inline-block';
            }else if(this_column_widgets_array_current['widgetIsInlineTablet'] == 'false'){
              widgetIsInlineTablet = 'block';
            }
            if (this_column_widgets_array_current['widgetIsInlineMobile'] == 'true') {
              widgetIsInlineMobile = 'inline-block';
            }else if(this_column_widgets_array_current['widgetIsInlineMobile'] == 'false'){
              widgetIsInlineMobile = 'block';
            }
          }


          var widgHideOnDesktop ="'display':'"+displayWigetInline+"'", widgHideOnTablet = "'display':'"+widgetIsInlineTablet+"'", widgHideOnMobile = "'display':'"+widgetIsInlineMobile+"'";
          if (typeof(this_column_widgets_array_current['widgHideOnDesktop']) !== 'undefined' ) {
            if (this_column_widgets_array_current['widgHideOnDesktop'] == 'hide') {
              widgHideOnDesktop = "display:'none' ,";
            }

            if (this_column_widgets_array_current['widgHideOnTablet'] == 'hide') {
              widgHideOnTablet = "display:'none' ,";
            }
            if (this_column_widgets_array_current['widgHideOnMobile'] == 'hide') {
              widgHideOnMobile = "display:'none' ,";
            }
          }


         widgetWidth = ''; widgetWidthDefault =''; widgetWidthTablet = ''; widgetWidthMobile = '';
         if (typeof(this_column_widgets_array_current['wp']) !== 'undefined' ){
            widgetPositionOps = this_column_widgets_array_current['wp'];
            if(typeof(widgetPositionOps['wpw'] !== 'undefined') ){
              
              if(widgetPositionOps['wpw'] == 'custom'){

                if(typeof(widgetPositionOps['wpcwu']) == 'undefined'){
                  widgetPositionOps['wpcwu'] = 'px';
                }
                widgetWidth = 'width:'+widgetPositionOps['wpcw']+widgetPositionOps['wpcwu']+';';

                widgetWidthValue = "jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'width':'"+widgetPositionOps['wpcw']+widgetPositionOps['wpcwu']+"', });" ;
                
              }else if(widgetPositionOps['wpw'] == 'full'){
                widgetWidthValue = "jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'width':'100%', });";
                widgetWidth = 'width:100%;';
              }else{

                widgetWidthValue = "jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'width':'auto', });";
                widgetWidth = 'width:auto;';
              }


              widgetWidthDefault = ''+
                '<script>'+
                  "jQuery('.responsiveBtn').on('click',function(){"+
                  " if (jQuery(this).hasClass('rbt-l') || jQuery(this).hasClass('rbt-l') ) { "+
                    widgetWidthValue+
                  " }"+
                  "});"+
                  "var currentVPS = jQuery('.currentViewPortSize').val();"+
                  "if ( currentVPS == 'rbt-l' || currentVPS == 'rbt-l' ) { "+
                    widgetWidthValue+
                  "}"+
                  " "+
                '</script> ';

            }


            if(typeof(widgetPositionOps['wpwt'] !== 'undefined') ){
              
              if(widgetPositionOps['wpwt'] == 'custom'){
                if(typeof(widgetPositionOps['wpcwut']) == 'undefined'){
                  widgetPositionOps['wpcwut'] = 'px';
                }

                widgetWidthTabletValue = "jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'width':'"+widgetPositionOps['wpcwt']+widgetPositionOps['wpcwut']+"', });";
                
              }else if(widgetPositionOps['wpwt'] == 'full'){
                widgetWidthTabletValue =  "jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'width':'100%', });";
                widgetWidthTablet = 'width:100%;';
              }else{
                widgetWidthTabletValue =  "jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'width':'auto', });";
                widgetWidthTablet = 'width:auto;';
              }


              widgetWidthTablet = ''+
                '<script>'+
                  "jQuery('.responsiveBtn').on('click',function(){"+
                  " if (jQuery(this).hasClass('rbt-m') || jQuery(this).hasClass('rbt-m') ) { "+
                    widgetWidthTabletValue+
                  "}"+
                  "});"+
                  "var currentVPS = jQuery('.currentViewPortSize').val();"+
                  "if ( currentVPS == 'rbt-m' || currentVPS == 'rbt-m' ) { "+
                    widgetWidthTabletValue+
                  "}"+
                  " "+
                '</script> ';

            }

            if(typeof(widgetPositionOps['wpwm'] !== 'undefined') ){
              
              if(widgetPositionOps['wpwm'] == 'custom'){
                if(typeof(widgetPositionOps['wpcwum']) == 'undefined'){
                  widgetPositionOps['wpcwum'] = 'px';
                }

                widgetWidthMobileValue = "jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'width':'"+widgetPositionOps['wpcwm']+widgetPositionOps['wpcwum']+"', });";
                
              }else if(widgetPositionOps['wpwm'] == 'full'){
                widgetWidthMobileValue =  "jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'width':'100%', });";
                widgetWidthMobile = 'width:100%;';
              }else{
                widgetWidthMobileValue =  "jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'width':'auto', });";
                widgetWidthMobile = 'width:auto;';
              }


              widgetWidthMobile = ''+
                '<script>'+
                  "jQuery('.responsiveBtn').on('click',function(){"+
                  " if (jQuery(this).hasClass('rbt-s') || jQuery(this).hasClass('rbt-s') ) { "+
                    widgetWidthMobileValue+
                  "}"+
                  "});"+
                  "var currentVPS = jQuery('.currentViewPortSize').val();"+
                  "if ( currentVPS == 'rbt-s' || currentVPS == 'rbt-s' ) { "+
                    widgetWidthMobileValue+
                  "}"+
                  " "+
                '</script> ';

            }

         }

         widgetWidthResponsive = widgetWidthDefault + widgetWidthTablet + widgetWidthMobile;


          var currWidgetmarginDefault  = ''+
            '<script>'+
            "jQuery('.responsiveBtn').on('click',function(){"+
            " if (jQuery(this).hasClass('rbt-l') ) { "+
            "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'margin-top':'"+widgetMtop+"%', 'margin-bottom':'"+widgetMbottom+"%', 'margin-left':'"+widgetMleft+"%', 'margin-right':'"+widgetMright+"%', display:'"+widgetIsInline+"', "+widgHideOnDesktop+"});"+

            "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'padding-top':'"+widgetPtop+"%', 'padding-bottom':'"+widgetPbottom+"%', 'padding-left':'"+widgetPleft+"%', 'padding-right':'"+widgetPright+"%', });"+
            " }"+
            "});"+

            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-l' ) { "+
            "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'margin-top':'"+widgetMtop+"%', 'margin-bottom':'"+widgetMbottom+"%', 'margin-left':'"+widgetMleft+"%', 'margin-right':'"+widgetMright+"%', display:'"+widgetIsInline+"',  "+widgHideOnDesktop+"});"+

            "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'padding-top':'"+widgetPtop+"%', 'padding-bottom':'"+widgetPbottom+"%', 'padding-left':'"+widgetPleft+"%', 'padding-right':'"+widgetPright+"%', });"+
            "}"+
            " "+
            '</script> ';


          currWidgetmarginTablet = '';
          var currWidgetmarginMobile = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+
              " if (jQuery(this).hasClass('rbt-s') || jQuery(this).hasClass('rbt-m') ) { "+
              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'margin':'0 auto', });"+

              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'padding':'10px', });"+
              " }"+
              "});"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-s' || currentVPS == 'rbt-m' ) { "+
              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'margin':'0 auto', });"+

              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'padding':'10px', });"+
              "}"+
              " "+
              '</script> ';

         if (typeof(this_column_widgets_array_current['widgetMarginTablet']) !== 'undefined') {
            widgetPaddingTablet = this_column_widgets_array_current['widgetPaddingTablet'];
            widgetPaddingMobile = this_column_widgets_array_current['widgetPaddingMobile'];
            widgetMarginTablet = this_column_widgets_array_current['widgetMarginTablet'];
            widgetMarginMobile = this_column_widgets_array_current['widgetMarginMobile'];

            if (widgetMarginTablet['rMTT'] == '') {  widgetMarginTablet['rMTT'] = '0';  }
            if (widgetMarginTablet['rMBT'] == '') {  widgetMarginTablet['rMBT'] = '0';  }
            if (widgetMarginTablet['rMLT'] == '') {  widgetMarginTablet['rMLT'] = '0';  }
            if (widgetMarginTablet['rMRT'] == '') {  widgetMarginTablet['rMRT'] = '0';  }

            if (widgetPaddingTablet['rPTT'] == '') {  widgetPaddingTablet['rPTT'] = '1.5';  }
            if (widgetPaddingTablet['rPBT'] == '') {  widgetPaddingTablet['rPBT'] = '1.5';  }
            if (widgetPaddingTablet['rPLT'] == '') {  widgetPaddingTablet['rPLT'] = '1.5';  }
            if (widgetPaddingTablet['rPRT'] == '') {  widgetPaddingTablet['rPRT'] = '1.5';  }

            var currWidgetmarginTablet  = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+
              " if (jQuery(this).hasClass('rbt-m') ) { "+
              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'margin-top':'"+widgetMarginTablet['rMTT']+"%', 'margin-bottom':'"+widgetMarginTablet['rMBT']+"%', 'margin-left':'"+widgetMarginTablet['rMLT']+"%', 'margin-right':'"+widgetMarginTablet['rMRT']+"%', display:'"+widgetIsInlineTablet+"', "+widgHideOnTablet+"  });"+

              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'padding-top':'"+widgetPaddingTablet['rPTT']+"%', 'padding-bottom':'"+widgetPaddingTablet['rPBT']+"%', 'padding-left':'"+widgetPaddingTablet['rPLT']+"%', 'padding-right':'"+widgetPaddingTablet['rPRT']+"%', });"+
              " }"+
              "});"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-m' ) { "+
              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'margin-top':'"+widgetMarginTablet['rMTT']+"%', 'margin-bottom':'"+widgetMarginTablet['rMBT']+"%', 'margin-left':'"+widgetMarginTablet['rMLT']+"%', 'margin-right':'"+widgetMarginTablet['rMRT']+"%', display:'"+widgetIsInlineTablet+"', "+widgHideOnTablet+"  });"+

              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'padding-top':'"+widgetPaddingTablet['rPTT']+"%', 'padding-bottom':'"+widgetPaddingTablet['rPBT']+"%', 'padding-left':'"+widgetPaddingTablet['rPLT']+"%', 'padding-right':'"+widgetPaddingTablet['rPRT']+"%', });"+
              "}"+
              " "+
              '</script> ';


            if (widgetMarginMobile['rMTM'] == '') {  widgetMarginMobile['rMTM'] = '0';  }
            if (widgetMarginMobile['rMBM'] == '') {  widgetMarginMobile['rMBM'] = '0';  }
            if (widgetMarginMobile['rMLM'] == '') {  widgetMarginMobile['rMLM'] = '0';  }
            if (widgetMarginMobile['rMRM'] == '') {  widgetMarginMobile['rMRM'] = '0';  }

            if (widgetPaddingMobile['rPTM'] == '') {  widgetPaddingMobile['rPTM'] = '1.5';  }
            if (widgetPaddingMobile['rPBM'] == '') {  widgetPaddingMobile['rPBM'] = '1.5';  }
            if (widgetPaddingMobile['rPLM'] == '') {  widgetPaddingMobile['rPLM'] = '1.5';  }
            if (widgetPaddingMobile['rPRM'] == '') {  widgetPaddingMobile['rPRM'] = '1.5';  }

            var currWidgetmarginMobile  = ''+
              '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){ "+
              " if (jQuery(this).hasClass('rbt-s') ) { "+
              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'margin-top':'"+widgetMarginMobile['rMTM']+"%', 'margin-bottom':'"+widgetMarginMobile['rMBM']+"%', 'margin-left':'"+widgetMarginMobile['rMLM']+"%', 'margin-right':'"+widgetMarginMobile['rMRM']+"%', display:'"+widgetIsInlineMobile+"', "+widgHideOnMobile+"  });"+

              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'padding-top':'"+widgetPaddingMobile['rPTM']+"%', 'padding-bottom':'"+widgetPaddingMobile['rPBM']+"%', 'padding-left':'"+widgetPaddingMobile['rPLM']+"%', 'padding-right':'"+widgetPaddingMobile['rPRM']+"%', });"+
              " }"+
              "});"+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-s' ) { "+
              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'margin-top':'"+widgetMarginMobile['rMTM']+"%', 'margin-bottom':'"+widgetMarginMobile['rMBM']+"%', 'margin-left':'"+widgetMarginMobile['rMLM']+"%', 'margin-right':'"+widgetMarginMobile['rMRM']+"%', display:'"+widgetIsInlineMobile+"', "+widgHideOnMobile+" });"+

              "  jQuery('#widget_"+rowID+"_"+this_column+"_"+j+"').css({'padding-top':'"+widgetPaddingMobile['rPTM']+"%', 'padding-bottom':'"+widgetPaddingMobile['rPBM']+"%', 'padding-left':'"+widgetPaddingMobile['rPLM']+"%', 'padding-right':'"+widgetPaddingMobile['rPRM']+"%', });"+
              "}"+
              " "+
              '</script> ';
         }
          

         var  currWidgetResponsiveTriggerScripts = '\n' + currWidgetmarginDefault +'\n' + currWidgetmarginTablet +'\n' + currWidgetmarginMobile + '\n' + thisWidgHoverStyleTag + '\n' + widgetWidthResponsive ;

         

          //Widget render container

          var this_widget_styles = "min-height:15px; margin:"+widgetMtop+"% "+widgetMright+"% "+widgetMbottom+"% "+widgetMleft+"%; "+this_widget_paddings+" "+widgBackgroundOptions+"  "+this_widget_border_shadow+" display:"+displayWigetInline+";  "+widgetStyling+" " +widgetWidth;

          var thisRenderredWidgetHtmlDefaultAttrs = 
            "class='widget-"+j+" pb_widgetr widget-Draggable   widgetType-"+this_column_type+ "  " + widgetCustomClass +" "+po_widgets+" "+widgetAnimation+"' "+
            "style='"+this_widget_styles+"' "+
            "data-wid_col_id='"+this_column+"' "+
            "id='widget_"+rowID+"_"+this_column+"_"+j+"' "+
            "data-widget_id='"+j+"' "+
            "data-targetColId='"+rowID+'-'+this_column+"' "+
            "data-widgetIndex='"+(j+1)+"' "+
            widgetEditButtonsAttrs
          ;

          var thisRenderredWidgetHtml = 
            "<div "+thisRenderredWidgetHtmlDefaultAttrs+" >"+
              widgetMoveHandle+
              widgetDuplicateHandle+
              widgetEditHandle+
              widgetDeleteHandle+
              droppableAboveWidget+
              this_column_content+
              droppableBelowWidget+
              dragTriggerBtn+
              draggedWidgDelTriggerBtn+
              inlineEditingSaveTriggerBtn+
              "<div id='thisRenderredWidgetScritps'></div>"+
            "</div>"
          ;


          var thisRenderredWidgetScritps = currWidgetResponsiveTriggerScripts + allResponsiveScripts;

          var thisRenderredWidgetHtmlDefault = 
            "<div  "+thisRenderredWidgetHtmlDefaultAttrs+">"+
              widgetMoveHandle+
              widgetDuplicateHandle+
              widgetEditHandle+
              widgetDeleteHandle+
              droppableAboveWidget+
              this_column_content+
              droppableBelowWidget+
              dragTriggerBtn+
              draggedWidgDelTriggerBtn+
              inlineEditingSaveTriggerBtn+
              "<div id='thisRenderredWidgetScritps'>"+thisRenderredWidgetScritps+"</div>"+
            "</div>"
          ;

          /*
          var prevValATEW = jQuery('.allTextEditableWidgetIds').val();
          if (this_column_type == 'wigt-WYSIWYG' || this_column_type == 'wigt-pb-text') {
            thisWidgetID = "widget_"+rowID+"_"+this_column+"_"+j;

            if (prevValATEW !== '') {
              prevValATEW == prevValATEW+',';
            }
            jQuery('.allTextEditableWidgetIds').val(prevValATEW+thisWidgetID);

            jQuery('.allTextEditableWidgetIds').trigger('change');
          }
          */

          jQuery('#'+rowID+'-'+this_column + ' .widget-Draggable').mouseenter(function(ev){
            
            jQuery(this).children('.widgetHandle').css('display','block');

            if (pageBuilderApp.copiedWidgOps == '') {
              jQuery('.widgetPasteHandle').css('display','none');
            }
            
          });
          jQuery('#'+rowID+'-'+this_column + ' .widget-Draggable').mouseleave(function(){
            jQuery('.widgetHandle').css('display','none');
          });

          var thisRenderredWidget = {
            WidgetHtml: thisRenderredWidgetHtml,
            WidgetScript: thisRenderredWidgetScritps,
            RenderredWidgetHtmlDefault: thisRenderredWidgetHtmlDefault,
          }

  //var t1 = performance.now();
  //console.log("Call to completeWidgetRender took " + (t1 - t0) + " milliseconds.");
  return thisRenderredWidget;

  
}



// columnrender
function rowColumnSingleRender(thisColumnModelData, rowID ,this_column, rowColumns, rowHeightData ){

        var this_column_options = thisColumnModelData['columnOptions'];
        var this_column_bg_color = this_column_options['bg_color'];
        var this_column_margin = this_column_options['margin'];
        var this_column_padding = this_column_options['padding'];
        var colWidth = this_column_options['width'];
        var columnCSS = this_column_options['columnCSS'];
        //var colWidthInPx = Math.floor( (1268*colWidth)/100); 
        var columnMarginTop = this_column_margin['columnMarginTop'];
        var columnMarginRight = this_column_margin['columnMarginRight'];
        var columnMarginBottom = this_column_margin['columnMarginBottom'];
        var columnMarginLeft = this_column_margin['columnMarginLeft'];

        var columnPaddingTop = this_column_padding['columnPaddingTop'];
        var columnPaddingRight = this_column_padding['columnPaddingRight'];
        var columnPaddingBottom = this_column_padding['columnPaddingBottom'];
        var columnPaddingLeft = this_column_padding['columnPaddingLeft'];

        rowHeight = rowHeightData['rowHeight'];
        rowHeightUnit = rowHeightData['rowHeightUnit'];
        rowHeightTablet = rowHeightData['rowHeightTablet'];
        rowHeightUnitTablet = rowHeightData['rowHeightUnitTablet'];
        rowHeightMobile = rowHeightData['rowHeightMobile'];
        rowHeightUnitMobile = rowHeightData['rowHeightUnitMobile'];

        var this_column_margins = "margin:"+columnMarginTop+"% "+columnMarginRight+"% "+columnMarginBottom+"% "+columnMarginLeft+"%;   padding:"+columnPaddingTop+"% "+columnPaddingRight+"% "+columnPaddingBottom+"% "+columnPaddingLeft+"%;";

        this_col_shadow = '';
        if (typeof(this_column_options['colBoxShadow']) !== 'undefined') {
          colBoxShadow = this_column_options['colBoxShadow'];
          var this_col_shadow = 'box-shadow: '+colBoxShadow['colBoxShadowH']+'px  '+colBoxShadow['colBoxShadowV']+'px  '+colBoxShadow['colBoxShadowBlur']+'px '+colBoxShadow['colBoxShadowColor']+' ;  ';
        }
        

        if (typeof(this_column_options['colBorder']) !== 'undefined') {
          colBorder = this_column_options['colBorder'];
          if (typeof(colBorder['bwt']) == 'undefined') {
            
            colBorder['bwt'] = colBorder['colBorderWidth'];
            colBorder['bwb'] = colBorder['colBorderWidth'];
            colBorder['bwl'] = colBorder['colBorderWidth'];
            colBorder['bwr'] = colBorder['colBorderWidth'];
            // border radius
            colBorder['brt'] = colBorder['colBorderRadius'];
            colBorder['brb'] = colBorder['colBorderRadius'];
            colBorder['brl'] = colBorder['colBorderRadius'];
            colBorder['brr'] = colBorder['colBorderRadius'];

            this_column_options['colBorder'] = colBorder;
          }
        }


        this_col_border = ''; currColBorderDefault = ''; currColBorderTablet = ''; currColBorderMobile = '';
        if (typeof(this_column_options['colBorder']) !== 'undefined') {
          colBorder = this_column_options['colBorder'];
          var this_col_border =
            'border-top-width:'+colBorder['bwt']+'px;'+
            'border-bottom-width:'+colBorder['bwb']+'px;'+
            'border-left-width:'+colBorder['bwl']+'px;'+
            'border-right-width:'+colBorder['bwr']+'px;'+
            'border-style:'+colBorder['colBorderStyle']+';'+
            'border-color:'+colBorder['colBorderColor']+ ';'+
            'border-radius:'+colBorder['brt']+'px '+colBorder['brb']+'px '+colBorder['brr']+'px '+colBorder['brl']+'px;'
          ;


          if (typeof(colBorder['bwt']) != 'undefined') {
            var currColBorderDefault  = ''+
            '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+

                "if (jQuery(this).hasClass('rbt-l') ) { "+
                  
                  "jQuery('#"+rowID+"-"+this_column+"').css({"+
                    "'border-top-width':'"+colBorder['bwt']+"px',"+
                    "'border-bottom-width':'"+colBorder['bwb']+"px',"+
                    "'border-left-width':'"+colBorder['bwl']+"px',"+
                    "'border-right-width':'"+colBorder['bwr']+"px',"+
                    "'border-radius':'"+colBorder['brt']+"px "+colBorder['brb']+"px "+colBorder['brr']+"px "+colBorder['brl']+"px',"+
                  "});"+

                "}"+

              "});"+

              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-l' ) { "+
                  "jQuery('#"+rowID+"-"+this_column+"').css({"+
                    "'border-top-width':'"+colBorder['bwt']+"px',"+
                    "'border-bottom-width':'"+colBorder['bwb']+"px',"+
                    "'border-left-width':'"+colBorder['bwl']+"px',"+
                    "'border-right-width':'"+colBorder['bwr']+"px',"+
                    "'border-radius':'"+colBorder['brt']+"px "+colBorder['brb']+"px "+colBorder['brr']+"px "+colBorder['brl']+"px',"+
                  "});"+
              "}"+

            '</script>';

          }

          if (typeof(colBorder['bwtT']) != 'undefined') {
            var currColBorderTablet  = ''+
            '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+

                "if (jQuery(this).hasClass('rbt-m') ) { "+
                  
                  "jQuery('#"+rowID+"-"+this_column+"').css({"+
                    "'border-top-width':'"+colBorder['bwtT']+"px',"+
                    "'border-bottom-width':'"+colBorder['bwbT']+"px',"+
                    "'border-left-width':'"+colBorder['bwlT']+"px',"+
                    "'border-right-width':'"+colBorder['bwrT']+"px',"+
                    "'border-radius':'"+colBorder['brtT']+"px "+colBorder['brbT']+"px "+colBorder['brrT']+"px "+colBorder['brlT']+"px',"+
                  "});"+

                "}"+

              "});"+

              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-m' ) { "+
                  "jQuery('#"+rowID+"-"+this_column+"').css({"+
                    "'border-top-width':'"+colBorder['bwtT']+"px',"+
                    "'border-bottom-width':'"+colBorder['bwbT']+"px',"+
                    "'border-left-width':'"+colBorder['bwlT']+"px',"+
                    "'border-right-width':'"+colBorder['bwrT']+"px',"+
                    "'border-radius':'"+colBorder['brtT']+"px "+colBorder['brbT']+"px "+colBorder['brrT']+"px "+colBorder['brlT']+"px',"+
                  "});"+
              "}"+

            '</script>';

          }

          if (typeof(colBorder['bwtM']) != 'undefined') {
            var currColBorderMobile  = ''+
            '<script>'+
              "jQuery('.responsiveBtn').on('click',function(){"+

                "if (jQuery(this).hasClass('rbt-s') ) { "+
                  
                  "jQuery('#"+rowID+"-"+this_column+"').css({"+
                    "'border-top-width':'"+colBorder['bwtM']+"px',"+
                    "'border-bottom-width':'"+colBorder['bwbM']+"px',"+
                    "'border-left-width':'"+colBorder['bwlM']+"px',"+
                    "'border-right-width':'"+colBorder['bwrM']+"px',"+
                    "'border-radius':'"+colBorder['brtM']+"px "+colBorder['brbM']+"px "+colBorder['brrM']+"px "+colBorder['brlM']+"px',"+
                  "});"+

                "}"+

              "});"+

              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-s' ) { "+
                  "jQuery('#"+rowID+"-"+this_column+"').css({"+
                    "'border-top-width':'"+colBorder['bwtM']+"px',"+
                    "'border-bottom-width':'"+colBorder['bwbM']+"px',"+
                    "'border-left-width':'"+colBorder['bwlM']+"px',"+
                    "'border-right-width':'"+colBorder['bwrM']+"px',"+
                    "'border-radius':'"+colBorder['brtM']+"px "+colBorder['brbM']+"px "+colBorder['brrM']+"px "+colBorder['brlM']+"px',"+
                  "});"+
              "}"+

            '</script>';

          } 

        }

        colBorderResponsiveScripts = currColBorderDefault + currColBorderTablet + currColBorderMobile;

        this_col_shadow = this_col_shadow + this_col_border;

        colWidthIsEmpty = false;
        var colWidthUnit = '%';
        if (colWidth == "" || colWidth == " ") {
          switch (rowColumns) {
            case '1':
              colWidth = 100;
              break;
            case '2':
              colWidth = 49;
              break;
            case '3':
              colWidth = 33;
              break;
            case '4':
              colWidth = 24;
              break;
            case '5':
              colWidth = 19;
              break;
            case '6':
              colWidth = 16.5;
              break;
            case '7':
              colWidth = 14.1;
              break;
            case '8':
              colWidth = 12;
              break;
            case '9':
              colWidth = 11;
              break;
            case '10':
              colWidth = 9.5;
              break;  
            default:
              colWidth = 99;
              break;
          }

          colWidthIsEmpty = true;
        }

        if ( parseInt(columnPaddingLeft) > 0 ) {  colWidth = parseInt(colWidth) - parseInt(columnPaddingLeft) }
        if ( parseInt(columnPaddingRight) > 0 ) {  colWidth = parseInt(colWidth) - parseInt(columnPaddingRight) }

        if (colWidthIsEmpty == true) {
          if ( parseInt(columnMarginLeft) > 0 ) {  colWidth = parseInt(colWidth) - parseInt(columnMarginLeft) }
          if ( parseInt(columnMarginRight) > 0 ) {  colWidth = parseInt(colWidth) - parseInt(columnMarginRight)  }
        }


          columnCustomClass = '';
        if (typeof(this_column_options['columnCustomClass']) !== 'undefined') {
          columnCustomClass = this_column_options['columnCustomClass'];
        }

        var colHideOnDesktop ="'display':'inline-block' ,", colHideOnTablet = "'display':'inline-block' ,", colHideOnMobile = "'display':'inline-block' ,";
        if (typeof(this_column_options['colHideOnDesktop']) !== 'undefined' ) {
          if (this_column_options['colHideOnDesktop'] == 'hide') {
            colHideOnDesktop =  "display:'none' ,";
          }

          if (this_column_options['colHideOnTablet'] == 'hide') {
            colHideOnTablet = "display:'none' ,";
          }
          if (this_column_options['colHideOnMobile'] == 'hide') {
            colHideOnMobile = "display:'none' ,";
          }
        }

        colContentAlignD = '' , colContentAlignT = '', colContentAlignM = '';
        if (typeof(this_column_options['colCAD']) != 'undefined' ) {

          if (this_column_options['colCAD'] != 'default' && this_column_options['colCAD'] != '') {
            if (colHideOnDesktop != "display:'none' ,") {
              colContentAlignD = "display: 'flex' , 'justify-content': '"+this_column_options['colCAD']+"' , 'flex-direction': 'column' ,";
            }
          }

          if (this_column_options['colCAT'] != 'default' && this_column_options['colCAT'] != '') {
            if (colHideOnTablet != "display:'none' ,") {
              colContentAlignT = "display: 'flex' , 'justify-content': '"+this_column_options['colCAT']+"' , 'flex-direction': 'column' ,";
            }
          }

          if (this_column_options['colCAM'] != 'default' && this_column_options['colCAM'] != '') {
            if (colHideOnMobile != "display:'none' ,") {
              colContentAlignM = "display: 'flex' , 'justify-content': '"+this_column_options['colCAM']+"' , 'flex-direction': 'column' ,";
            }
          }

        }
        
        currColmarginDefault = '';
        currColmarginTablet = '';
        currColmarginMobile = '';

        var currColmarginDefault  = ''+
          '<script>'+
            "jQuery('.responsiveBtn').on('click',function(){"+
            " if (jQuery(this).hasClass('rbt-l') ) { "+
            "  jQuery('#"+rowID+"-"+this_column+"').css({'margin-top':'"+columnMarginTop+"%', 'margin-bottom':'"+columnMarginBottom+"%', 'margin-left':'"+columnMarginLeft+"%', 'margin-right':'"+columnMarginRight+"%', 'min-height':'"+rowHeight+rowHeightUnit+"',  "+colHideOnDesktop+colContentAlignD+" });"+

            "  jQuery('#"+rowID+"-"+this_column+"').css({'padding-top':'"+columnPaddingTop+"%', 'padding-bottom':'"+columnPaddingBottom+"%', 'padding-left':'"+columnPaddingLeft+"%', 'padding-right':'"+columnPaddingRight+"%', 'width':'"+colWidth+colWidthUnit+"', });"+
            " }"+
            "});"+

            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-l' ) { "+
            "  jQuery('#"+rowID+"-"+this_column+"').css({'margin-top':'"+columnMarginTop+"%', 'margin-bottom':'"+columnMarginBottom+"%', 'margin-left':'"+columnMarginLeft+"%', 'margin-right':'"+columnMarginRight+"%', 'min-height':'"+rowHeight+rowHeightUnit+"', "+colHideOnDesktop+colContentAlignD+"  });"+

            "  jQuery('#"+rowID+"-"+this_column+"').css({'padding-top':'"+columnPaddingTop+"%', 'padding-bottom':'"+columnPaddingBottom+"%', 'padding-left':'"+columnPaddingLeft+"%', 'padding-right':'"+columnPaddingRight+"%', 'width':'"+colWidth+colWidthUnit+"', });"+
            "}"+
            " "+
          '</script> ';


        if (typeof(this_column_options['paddingTablet']) !== 'undefined') {

          colPaddingTablet = this_column_options['paddingTablet'];
          colMarginTablet = this_column_options['marginTablet'];
          colWidthTablet = this_column_options['widthTablet'];

          if (colWidthTablet == '') {
            colWidthTablet = '99.9';
          }

          if (colWidthTablet != '') {
            if ( parseInt(colPaddingTablet['rPLT']) > 0 ) {  colWidthTablet = parseInt(colWidthTablet) - parseInt(colPaddingTablet['rPLT']) }
            if ( parseInt(colPaddingTablet['rPRT']) > 0 ) {  colWidthTablet = parseInt(colWidthTablet) - parseInt(colPaddingTablet['rPRT']) }
          }

          var currColmarginTablet  = ''+
            '<script>'+
            "jQuery('.responsiveBtn').on('click',function(){"+
            " if (jQuery(this).hasClass('rbt-m') ) { "+
            "  jQuery('#"+rowID+"-"+this_column+"').css({'margin-top':'"+colMarginTablet['rMTT']+"%', 'margin-bottom':'"+colMarginTablet['rMBT']+"%', 'margin-left':'"+colMarginTablet['rMLT']+"%', 'margin-right':'"+colMarginTablet['rMRT']+"%',  'min-height':'"+rowHeightTablet+rowHeightUnitTablet+"', "+colHideOnTablet+colContentAlignT+" });"+

            "  jQuery('#"+rowID+"-"+this_column+"').css({'padding-top':'"+colPaddingTablet['rPTT']+"%', 'padding-bottom':'"+colPaddingTablet['rPBT']+"%', 'padding-left':'"+colPaddingTablet['rPLT']+"%', 'padding-right':'"+colPaddingTablet['rPRT']+"%', 'width':'"+colWidthTablet+"%', });"+
            " }"+
            "});"+

            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-m' ) { "+
            "  jQuery('#"+rowID+"-"+this_column+"').css({'margin-top':'"+colMarginTablet['rMTT']+"%', 'margin-bottom':'"+colMarginTablet['rMBT']+"%', 'margin-left':'"+colMarginTablet['rMLT']+"%', 'margin-right':'"+colMarginTablet['rMRT']+"%', 'min-height':'"+rowHeightTablet+rowHeightUnitTablet+"', "+colHideOnTablet+colContentAlignT+" });"+

            "  jQuery('#"+rowID+"-"+this_column+"').css({'padding-top':'"+colPaddingTablet['rPTT']+"%', 'padding-bottom':'"+colPaddingTablet['rPBT']+"%', 'padding-left':'"+colPaddingTablet['rPLT']+"%', 'padding-right':'"+colPaddingTablet['rPRT']+"%', 'width':'"+colWidthTablet+"%', });"+
            "}"+
            " "+
            '</script> ';
          
        }

        var currColmarginMobile  = ''+
            '<script>'+
            "jQuery('.responsiveBtn').on('click',function(){"+
            " if (jQuery(this).hasClass('rbt-s') || jQuery(this).hasClass('rbt-m') ) { "+
            "  jQuery('#"+rowID+"-"+this_column+"').css({'margin-top':'"+''+"%', 'margin-bottom':'"+'30px'+"', 'margin-left':'"+''+"%', 'margin-right':'"+''+"%', 'min-height':'"+ rowHeightMobile+rowHeightUnitMobile+"',});"+

            "  jQuery('#"+rowID+"-"+this_column+"').css({'padding-top':'"+''+"%', 'padding-bottom':'"+''+"%', 'padding-left':'"+''+"%', 'padding-right':'"+''+"%', 'width':'"+'99.9'+"%', });"+
            " }"+
            "});"+

            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-s' || currentVPS == 'rbt-m' ) { "+
            "  jQuery('#"+rowID+"-"+this_column+"').css({'margin-top':'"+''+"%', 'margin-bottom':'"+'30px'+"', 'margin-left':'"+''+"%', 'margin-right':'"+''+"%', 'min-height':'"+ rowHeightMobile+rowHeightUnitMobile+"',});"+

            "  jQuery('#"+rowID+"-"+this_column+"').css({'padding-top':'"+''+"%', 'padding-bottom':'"+''+"%', 'padding-left':'"+''+"%', 'padding-right':'"+''+"%', 'width':'"+'99.9'+"%', });"+
            "}"+
            " "+
            '</script> ';
        if (typeof(this_column_options['paddingMobile']) !== 'undefined') {
          colPaddingMobile = this_column_options['paddingMobile'];
          colMarginMobile = this_column_options['marginMobile'];
          colWidthMobile = this_column_options['widthMobile'];

          if (colWidthMobile == '') {
            colWidthMobile = '99.9';
          }

          if (colWidthMobile != '') {
            if ( parseInt(colPaddingMobile['rPLM']) > 0 ) {  colWidthMobile = parseInt(colWidthMobile) - parseInt(colPaddingMobile['rPLM']) }
            if ( parseInt(colMarginMobile['rMRM']) > 0 ) {  colWidthMobile = parseInt(colWidthMobile) - parseInt(colMarginMobile['rMRM']) }
          }

          colMarginMobileBottomUnit = '%';
          if (colMarginMobile['rMBM'] == '') {
            colMarginMobile['rMBM'] = '';
            colMarginMobileBottomUnit = 'px';
          }

          currColmarginMobile  = ''+
            '<script>'+
            "jQuery('.responsiveBtn').on('click',function(){"+
            " if (jQuery(this).hasClass('rbt-s') ) { "+
            "  jQuery('#"+rowID+"-"+this_column+"').css({'margin-top':'"+colMarginMobile['rMTM']+"%', 'margin-bottom':'"+colMarginMobile['rMBM']+colMarginMobileBottomUnit+"', 'margin-left':'"+colMarginMobile['rMLM']+"%', 'margin-right':'"+colMarginMobile['rMRM']+"%', 'min-height':'"+rowHeightMobile+rowHeightUnitMobile+"', "+colHideOnMobile+colContentAlignM+" });"+

            "  jQuery('#"+rowID+"-"+this_column+"').css({'padding-top':'"+colPaddingMobile['rPTM']+"%', 'padding-bottom':'"+colPaddingMobile['rPBM']+"%', 'padding-left':'"+colPaddingMobile['rPLM']+"%', 'padding-right':'"+colPaddingMobile['rPRM']+"%', 'width':'"+colWidthMobile+"%', });"+
            " }"+
            "});"+

            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-s' ) { "+
            "  jQuery('#"+rowID+"-"+this_column+"').css({'margin-top':'"+colMarginMobile['rMTM']+"%', 'margin-bottom':'"+colMarginMobile['rMBM']+colMarginMobileBottomUnit+"', 'margin-left':'"+colMarginMobile['rMLM']+"%', 'margin-right':'"+colMarginMobile['rMRM']+"%', 'min-height':'"+rowHeightMobile+rowHeightUnitMobile+"', "+colHideOnMobile+colContentAlignM+" });"+

            "  jQuery('#"+rowID+"-"+this_column+"').css({'padding-top':'"+colPaddingMobile['rPTM']+"%', 'padding-bottom':'"+colPaddingMobile['rPBM']+"%', 'padding-left':'"+colPaddingMobile['rPLM']+"%', 'padding-right':'"+colPaddingMobile['rPRM']+"%', 'width':'"+colWidthMobile+"%', });"+
            "}"+
            " "+
            '</script> ';
        }

        var currColResponsiveScriptsTrigger = ' \n ' + currColmarginTablet + ' \n ' + currColmarginMobile + ' \n ' +currColmarginDefault + colBorderResponsiveScripts;

        var colBackgroundOptions = 'background-color:'+this_column_bg_color+';';

        this_column_bg_img = '';
        if (typeof(this_column_options['colBgImg']) !== 'undefined') {
          this_column_bg_img = this_column_options['colBgImg'];
          if (this_column_bg_img !== '') {
            colBackgroundOptions = 'background-image: url('+this_column_bg_img+'); background-repeat: no-repeat; background-position:center; background-size:cover; background-color:'+this_column_bg_color+';';
          }
        }
        
        var defaultColBackgroundType = 'solid';
        if (typeof(this_column_options['colBackgroundType']) !== 'undefined') {
          defaultColBackgroundType = this_column_options['colBackgroundType'];
          if (this_column_options['colBackgroundType'] == 'gradient') {
            var colGradient = this_column_options['colGradient'];

            if (colGradient['colGradientType'] == 'linear') {
              colBackgroundOptions = 'background: linear-gradient('+colGradient['colGradientAngle']+'deg, '+colGradient['colGradientColorFirst']+' '+colGradient['colGradientLocationFirst']+'%,'+colGradient['colGradientColorSecond']+' '+colGradient['colGradientLocationSecond']+'%);';
            }

            if (colGradient['colGradientType'] == 'radial') {
              colBackgroundOptions = 'background: radial-gradient(at '+colGradient['colGradientPosition']+', '+colGradient['colGradientColorFirst']+' '+colGradient['colGradientLocationFirst']+'%,'+colGradient['colGradientColorSecond']+' '+colGradient['colGradientLocationSecond']+'%);';
            }
            
          }
        }

        var colID = rowID+'-'+this_column;
        var thisColHoverStyleTag = '';
        var thisColHoverOption = '';
        if (typeof(this_column_options['colHoverOptions']) !== 'undefined') {
          var colHoverOptions = this_column_options['colHoverOptions'];
          if (colHoverOptions['colBackgroundTypeHover'] == 'solid') {
            var thisColHoverOption = ' #'+colID+':hover { background:'+colHoverOptions['colBgColorHover']+' !important; transition: all '+colHoverOptions['colHoverTransitionDuration']+'s; }';
          }
          if (colHoverOptions['colBackgroundTypeHover'] == 'gradient') {
            var colGradientHover = colHoverOptions['colGradientHover'];

            if (colGradientHover['colGradientTypeHover'] == 'linear') {
              thisColHoverOption = ' #'+colID+':hover { background: linear-gradient('+colGradientHover['colGradientAngleHover']+'deg, '+colGradientHover['colGradientColorFirstHover']+' '+colGradientHover['colGradientLocationFirstHover']+'%,'+colGradientHover['colGradientColorSecondHover']+' '+colGradientHover['colGradientLocationSecondHover']+'%) !important; transition: all '+colHoverOptions['colHoverTransitionDuration']+'s; }';
            }

            if (colGradientHover['colGradientTypeHover'] == 'radial') {

              thisColHoverOption = ' #'+colID+':hover { background: radial-gradient(at '+colGradientHover['colGradientPositionHover']+', '+colGradientHover['colGradientColorFirstHover']+' '+colGradientHover['colGradientLocationFirstHover']+'%,'+colGradientHover['colGradientColorSecondHover']+' '+colGradientHover['colGradientLocationSecondHover']+'%) !important; transition: all '+colHoverOptions['colHoverTransitionDuration']+'s; }';
            }
          }

          thisColHoverStyleTag = ' <style> '+thisColHoverOption+' </style> ';
        }
        thisColumnStylesInline = 'width:' + colWidth +colWidthUnit+';  min-height:'+rowHeight+rowHeightUnit+'; '+colBackgroundOptions+' '+this_column_margins+'  '+this_col_shadow +'  '+columnCSS+' ';

        jQuery('#'+colID).attr( 'style', thisColumnStylesInline );


        // New column bg options
        currColDefaultBackgroundOps = '';
        currColtabletBackgroundOps = '';
        currColmobileBackgroundOps = '';

        if (defaultColBackgroundType == 'solid') {
          if (typeof(this_column_options['bgImgOps']) != 'undefined') {

            drbgImgOps = this_column_options['bgImgOps'];

            defaultRowBgImg = this_column_options['colBgImg'];
            tabletRowBgImg = this_column_options['colBgImgT'];
            mobileRowBgImg = this_column_options['colBgImgM'];
            if (tabletRowBgImg == '') { tabletRowBgImg = defaultRowBgImg; }
            if (mobileRowBgImg == '') { mobileRowBgImg = tabletRowBgImg; }


            defaultRowBgFixed = 'scroll';
            if (drbgImgOps['parlx'] == 'true') { defaultRowBgFixed = 'fixed'; }
            tabletRowBgFixed = defaultRowBgFixed; mobileRowBgFixed = defaultRowBgFixed;
            if (drbgImgOps['parlxT'] == 'true') { tabletRowBgFixed = 'fixed'; }
            if (drbgImgOps['parlxT'] == 'false') { tabletRowBgFixed = 'scroll'; }
            if (drbgImgOps['parlxM'] == 'true') { mobileRowBgFixed = 'fixed'; }
            if (drbgImgOps['parlxM'] == 'false') { mobileRowBgFixed = 'scroll'; }

            drbgImgOpsRep = drbgImgOps['rep'];
            drbgImgOpsRepT = drbgImgOps['repT'];
            drbgImgOpsRepM = drbgImgOps['repM'];

            // desktop
            if (drbgImgOps['pos'] == 'custom') {
              defaultBgImgPos = "'background-position-x': '"+drbgImgOps['xPos']+drbgImgOps['xPosU']+ "', " + "'background-position-y': '"+drbgImgOps['yPos']+drbgImgOps['yPosU']+ "', ";
            }else{
              defaultBgImgPos = "'background-position': '"+drbgImgOps['pos']+"', ";
            }

            if ( drbgImgOpsRep == '' || drbgImgOpsRep == 'default') { drbgImgOpsRep = 'no-repeat'; }

            if (drbgImgOps['size'] == 'custom') {
              defaultBgImgSize = "'background-size': '"+drbgImgOps['cWid']+drbgImgOps['widU']+"', ";
            }else{
              defaultBgImgSize = "'background-size': '"+drbgImgOps['size']+"', ";
            }
            

            var currColDefaultBackgroundOps  = ''+
            "<script>"+
              "jQuery('.responsiveBtn').on('click',function(){"+
              "if (jQuery(this).hasClass('rbt-l') ) { "+
                "jQuery('#"+colID+"').css({ "+
                  "'background-image': 'url("+defaultRowBgImg+")', "+
                  "'background-repeat': '"+drbgImgOpsRep+"', "+
                  "'background-attachment': '"+defaultRowBgFixed+"', "+
                  defaultBgImgPos +
                  defaultBgImgSize+
                "});"+
              "}"+
              "});"+
              " "+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-l' ) { "+
                "jQuery('#"+colID+"').css({ "+
                  "'background-image': 'url("+defaultRowBgImg+")', "+
                  "'background-repeat': '"+drbgImgOpsRep+"', "+
                  "'background-attachment': '"+defaultRowBgFixed+"', "+
                  defaultBgImgPos +
                  defaultBgImgSize+
                "});"+
              "}"+
              " "+
            "</script>";



            // Tablet
            if (drbgImgOps['posT'] == 'custom') {
              tabletBgImgPos = "'background-position-x': '"+drbgImgOps['xPosT']+drbgImgOps['xPosUT']+ "', " + "'background-position-y': '"+drbgImgOps['yPosT']+drbgImgOps['yPosUT']+ "', ";
            } else if(drbgImgOps['posT'] == ''){
              tabletBgImgPos = defaultBgImgPos;
            }else{
              tabletBgImgPos = "'background-position': '"+drbgImgOps['posT']+"', ";
            }

            if (drbgImgOpsRepT == '' || drbgImgOpsRepT == 'default') { drbgImgOpsRepT = drbgImgOpsRep; }


            if (drbgImgOps['sizeT'] == 'custom') {
              tabletBgImgSize = "'background-size': '"+drbgImgOps['cWidT']+drbgImgOps['widUT']+"', " 
            }else if(drbgImgOps['sizeT'] == ''){
              tabletBgImgSize = defaultBgImgSize;
            }else{
              tabletBgImgSize = "'background-size': '"+drbgImgOps['sizeT']+"', ";
            }
            

            var currColtabletBackgroundOps  = ''+
            "<script>"+
              "jQuery('.responsiveBtn').on('click',function(){"+
              "if (jQuery(this).hasClass('rbt-m') ) { "+
                "jQuery('#"+colID+"').css({ "+
                  "'background-image': 'url("+tabletRowBgImg+")', "+
                  "'background-repeat': '"+drbgImgOpsRepT+"', "+
                  "'background-attachment': '"+tabletRowBgFixed+"', "+
                  tabletBgImgPos +
                  tabletBgImgSize+
                "});"+
              "}"+
              "});"+
              " "+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-m' ) { "+
                "jQuery('#"+colID+"').css({ "+
                  "'background-image': 'url("+tabletRowBgImg+")', "+
                  "'background-repeat': '"+drbgImgOpsRepT+"', "+
                  "'background-attachment': '"+tabletRowBgFixed+"', "+
                  tabletBgImgPos +
                  tabletBgImgSize+
                "});"+
              "}"+
              " "+
            "</script>";




            // mobile
            if (drbgImgOps['posM'] == 'custom') {
              mobileBgImgPos = "'background-position-x': '"+drbgImgOps['xPosM']+drbgImgOps['xPosUM']+ "', " + "'background-position-y': '"+drbgImgOps['yPosM']+drbgImgOps['yPosUM']+ "', ";
            }else if(drbgImgOps['posM'] == ''){
              mobileBgImgPos = tabletBgImgPos;
            }else{
              mobileBgImgPos = "'background-position': '"+drbgImgOps['posM']+"', ";
            }

            if (drbgImgOpsRepM == '' || drbgImgOpsRepM == 'default') { drbgImgOpsRepM = drbgImgOpsRepT; }

            if (drbgImgOps['sizeM'] == 'custom') {
              mobileBgImgSize = "'background-size': '"+drbgImgOps['cWidM']+drbgImgOps['widUM']+"', ";
            }else if(drbgImgOps['sizeM'] == ''){
              mobileBgImgSize = tabletBgImgSize;
            }else{
              mobileBgImgSize = "'background-size': '"+drbgImgOps['sizeM']+"', ";
            }
            
            var currColmobileBackgroundOps  = ''+
            "<script>"+
              "jQuery('.responsiveBtn').on('click',function(){"+
              "if (jQuery(this).hasClass('rbt-s') ) { "+
                "jQuery('#"+colID+"').css({ "+
                  "'background-image': 'url("+mobileRowBgImg+")', "+
                  "'background-repeat': '"+drbgImgOpsRepM+"', "+
                  "'background-attachment': '"+mobileRowBgFixed+"', "+
                  mobileBgImgPos +
                  mobileBgImgSize+
                "});"+
              "}"+
              "});"+
              " "+
              "var currentVPS = jQuery('.currentViewPortSize').val();"+
              "if ( currentVPS == 'rbt-s' ) { "+
                "jQuery('#"+colID+"').css({ "+
                  "'background-image': 'url("+mobileRowBgImg+")', "+
                  "'background-repeat': '"+drbgImgOpsRepM+"', "+
                  "'background-attachment': '"+mobileRowBgFixed+"', "+
                  mobileBgImgPos +
                  mobileBgImgSize+
                "});"+
              "}"+
              " "+
            "</script>";


          }
        }
          

        colBgResScripts = currColDefaultBackgroundOps + currColtabletBackgroundOps + currColmobileBackgroundOps;
        currColResponsiveScriptsTrigger = currColResponsiveScriptsTrigger + colBgResScripts;

        jQuery('#'+colID+'> #columnResponsiveScripts' ).html(currColResponsiveScriptsTrigger);
        jQuery('#'+colID+'> #columnStyleTag' ).html(thisColHoverStyleTag);
        
}


// Row Options Render
function rowOptionsRender(rowID,rowCID,rowColumns,rowHeightUnit,rowData, rowHeightTablet,rowHeightUnitTablet,rowHeightMobile,rowHeightUnitMobile){

  var row_bg_img = rowData['bg_img'];
  var row_bg_color = rowData['bg_color'];
  var row_margin = rowData['margin'];
  var row_padding = rowData['padding'];
  var custom_styling = rowData['customStyling'];
  var custom_JS = rowData['customJS'];

      if (typeof(rowHeightUnit) == 'undefined' || rowHeightUnit == '') {
          rowHeightUnit = 'px';
      }

      var rowHideOnDesktop ="'display':'block'", rowHideOnTablet = "'display':'block'", rowHideOnMobile = "'display':'block'";
      if (typeof(rowData['rowHideOnDesktop']) !== 'undefined' ) {
        if (rowData['rowHideOnDesktop'] == 'hide') {
          rowHideOnDesktop = "display:'none' ,";
        }

        if (rowData['rowHideOnTablet'] == 'hide') {
          rowHideOnTablet = "display:'none' ,";
        }
        if (rowData['rowHideOnMobile'] == 'hide') {
          rowHideOnMobile = "display:'none' ,";
        }
      }

      var currRowDefaultMarginPadding  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-l') ) { "+
        "  jQuery('#"+rowID+"').css({'margin-top':'"+row_margin['rowMarginTop']+"%', 'margin-bottom':'"+row_margin['rowMarginBottom']+"%', 'margin-left':'"+row_margin['rowMarginLeft']+"%', 'margin-right':'"+row_margin['rowMarginRight']+"%', });"+
        "  jQuery('#"+rowID+"').css({'padding-top':'"+row_padding['rowPaddingTop']+"%', 'padding-bottom':'"+row_padding['rowPaddingBottom']+"%', 'padding-left':'"+row_padding['rowPaddingLeft']+"%', 'padding-right':'"+row_padding['rowPaddingRight']+"%', "+rowHideOnDesktop+" });"+
        " }"+
        "});"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-l' ) { "+
        "  jQuery('#"+rowID+"').css({'margin-top':'"+row_margin['rowMarginTop']+"%', 'margin-bottom':'"+row_margin['rowMarginBottom']+"%', 'margin-left':'"+row_margin['rowMarginLeft']+"%', 'margin-right':'"+row_margin['rowMarginRight']+"%', });"+
        "  jQuery('#"+rowID+"').css({'padding-top':'"+row_padding['rowPaddingTop']+"%', 'padding-bottom':'"+row_padding['rowPaddingBottom']+"%', 'padding-left':'"+row_padding['rowPaddingLeft']+"%', 'padding-right':'"+row_padding['rowPaddingRight']+"%', "+rowHideOnDesktop+" });"+
        "}"+
        " "+
        '</script> ';

      if (typeof(rowData['rowCustomClass']) !== 'undefined' ) {
        jQuery('li[data-model-cid="'+rowCID+'"] section').attr('class',' row '+rowData['rowCustomClass']);
      }

      var currRowMarginTablet = '';
      var currRowMarginMobile = '';
      var currRowMarginMobile = ''+
        '<script>'+
          "jQuery('.responsiveBtn').on('click',function(){"+
          " if (jQuery(this).hasClass('rbt-s') || jQuery(this).hasClass('rbt-m') ) { "+
          "  jQuery('#"+rowID+"').css({'margin':'0 auto', });"+

          "  jQuery('#"+rowID+"').css({'padding':'10px 0', });"+
          " }"+
          "});"+
          "var currentVPS = jQuery('.currentViewPortSize').val();"+
          "if ( currentVPS == 'rbt-s' || currentVPS == 'rbt-m' ) { "+
          "  jQuery('#"+rowID+"').css({'margin':'0 auto', });"+

          "  jQuery('#"+rowID+"').css({'padding':'10px 0', });"+
          "}"+
          " "+
        '</script> ';

      if (typeof(rowData['marginTablet']) !== 'undefined' ) {
        rowMarginTablet = rowData['marginTablet'];
        rowPaddingTablet = rowData['paddingTablet'];

        if (rowMarginTablet['rMTT'] == '') {  rowMarginTablet['rMTT'] = '0';  }
        if (rowMarginTablet['rMBT'] == '') {  rowMarginTablet['rMBT'] = '0';  }
        if (rowMarginTablet['rMLT'] == '') {  rowMarginTablet['rMLT'] = '0';  }
        if (rowMarginTablet['rMRT'] == '') {  rowMarginTablet['rMRT'] = '0';  }

        if (rowPaddingTablet['rPTT'] == '') {  rowPaddingTablet['rPTT'] = '1.5';  }
        if (rowPaddingTablet['rPBT'] == '') {  rowPaddingTablet['rPBT'] = '1.5';  }
        if (rowPaddingTablet['rPLT'] == '') {  rowPaddingTablet['rPLT'] = '1.5';  }
        if (rowPaddingTablet['rPRT'] == '') {  rowPaddingTablet['rPRT'] = '1.5';  }

        var currRowMarginTablet  = ''+
          '<script>'+
          "jQuery('.responsiveBtn').on('click',function(){"+
          " if (jQuery(this).hasClass('rbt-m') ) { "+
          "  jQuery('#"+rowID+"').css({'margin-top':'"+rowMarginTablet['rMTT']+"%', 'margin-bottom':'"+rowMarginTablet['rMBT']+"%', 'margin-left':'"+rowMarginTablet['rMLT']+"%', 'margin-right':'"+rowMarginTablet['rMRT']+"%',  "+rowHideOnTablet+" });"+

          "  jQuery('#"+rowID+"').css({'padding-top':'"+rowPaddingTablet['rPTT']+"%', 'padding-bottom':'"+rowPaddingTablet['rPBT']+"%', 'padding-left':'"+rowPaddingTablet['rPLT']+"%', 'padding-right':'"+rowPaddingTablet['rPRT']+"%', });"+
          " }"+
          "});"+
          "var currentVPS = jQuery('.currentViewPortSize').val();"+
          "if ( currentVPS == 'rbt-m' ) { "+
          "  jQuery('#"+rowID+"').css({'margin-top':'"+rowMarginTablet['rMTT']+"%', 'margin-bottom':'"+rowMarginTablet['rMBT']+"%', 'margin-left':'"+rowMarginTablet['rMLT']+"%', 'margin-right':'"+rowMarginTablet['rMRT']+"%', "+rowHideOnTablet+" });"+

          "  jQuery('#"+rowID+"').css({'padding-top':'"+rowPaddingTablet['rPTT']+"%', 'padding-bottom':'"+rowPaddingTablet['rPBT']+"%', 'padding-left':'"+rowPaddingTablet['rPLT']+"%', 'padding-right':'"+rowPaddingTablet['rPRT']+"%', });"+
          "}"+
          " "+
          '</script> ';
      }

      var currRowMarginMobile = '';
      if (typeof(rowData['marginMobile']) !== 'undefined' ) {
        rowMarginMobile = rowData['marginMobile'];
        rowPaddingMobile = rowData['paddingMobile'];

        if (rowMarginMobile['rMTM'] == '') {  rowMarginMobile['rMTM'] = '0';  }
        if (rowMarginMobile['rMBM'] == '') {  rowMarginMobile['rMBM'] = '0';  }
        if (rowMarginMobile['rMLM'] == '') {  rowMarginMobile['rMLM'] = '0';  }
        if (rowMarginMobile['rMRM'] == '') {  rowMarginMobile['rMRM'] = '0';  }

        if (rowPaddingMobile['rPTM'] == '') {  rowPaddingMobile['rPTM'] = '1.5';  }
        if (rowPaddingMobile['rPBM'] == '') {  rowPaddingMobile['rPBM'] = '1.5';  }
        if (rowPaddingMobile['rPLM'] == '') {  rowPaddingMobile['rPLM'] = '1.5';  }
        if (rowPaddingMobile['rPRM'] == '') {  rowPaddingMobile['rPRM'] = '1.5';  }

        var currRowMarginMobile  = ''+
        '<script>'+
        "jQuery('.responsiveBtn').on('click',function(){"+
        " if (jQuery(this).hasClass('rbt-s') ) { "+
        "  jQuery('#"+rowID+"').css({'margin-top':'"+rowMarginMobile['rMTM']+"%', 'margin-bottom':'"+rowMarginMobile['rMBM']+"%', 'margin-left':'"+rowMarginMobile['rMLM']+"%', 'margin-right':'"+rowMarginMobile['rMRM']+"%', "+rowHideOnMobile+" });"+

        "  jQuery('#"+rowID+"').css({'padding-top':'"+rowPaddingMobile['rPTM']+"%', 'padding-bottom':'"+rowPaddingMobile['rPBM']+"%', 'padding-left':'"+rowPaddingMobile['rPLM']+"%', 'padding-right':'"+rowPaddingMobile['rPRM']+"%', });"+
        " }"+
        "});"+
        "var currentVPS = jQuery('.currentViewPortSize').val();"+
        "if ( currentVPS == 'rbt-s' ) { "+
        "  jQuery('#"+rowID+"').css({'margin-top':'"+rowMarginMobile['rMTM']+"%', 'margin-bottom':'"+rowMarginMobile['rMBM']+"%', 'margin-left':'"+rowMarginMobile['rMLM']+"%', 'margin-right':'"+rowMarginMobile['rMRM']+"%', "+rowHideOnMobile+" });"+

        "  jQuery('#"+rowID+"').css({'padding-top':'"+rowPaddingMobile['rPTM']+"%', 'padding-bottom':'"+rowPaddingMobile['rPBM']+"%', 'padding-left':'"+rowPaddingMobile['rPLM']+"%', 'padding-right':'"+rowPaddingMobile['rPRM']+"%', });"+
        "}"+
        " "+
        '</script> ';

      }


      var currentRowResponsiveTriggerScripts = '\n'+ currRowMarginTablet + '\n' + currRowMarginMobile + '\n' +currRowDefaultMarginPadding;

      var currRowPadding  = 'padding:'+row_padding['rowPaddingTop'] +'% '+row_padding['rowPaddingRight']+'% '+ row_padding['rowPaddingBottom'] +'% '+ row_padding['rowPaddingLeft']+'%; ';
      var currRowMargins  = 'margin:'+row_margin['rowMarginTop'] +'% '+row_margin['rowMarginRight']+'% '+ row_margin['rowMarginBottom'] +'% '+ row_margin['rowMarginLeft']+'%; ';

      var rowBackgroundOptions = 'background-color:'+row_bg_color+';';

      rowBackgroundParallax = '';
      if (typeof(rowData['rowBackgroundParallax']) !== 'undefined') {
        if (rowData['rowBackgroundParallax'] == 'true') {
          rowBackgroundParallax = 'background-attachment:fixed;';
        }
      }
      if (row_bg_img != '') {
        rowBackgroundOptions = 'background-image: url('+row_bg_img+') no-repeat center center; background-size: cover; background-color:'+row_bg_color+';';
      }


      var defaultRowBackgroundType = 'solid';
      if (typeof(rowData['rowBackgroundType']) !== 'undefined') {
        defaultRowBackgroundType = rowData['rowBackgroundType'];
        if (rowData['rowBackgroundType'] == 'gradient') {
          var rowGradient = rowData['rowGradient'];

          if (rowGradient['rowGradientType'] == 'linear') {
            rowBackgroundOptions = 'background: linear-gradient('+rowGradient['rowGradientAngle']+'deg, '+rowGradient['rowGradientColorFirst']+' '+rowGradient['rowGradientLocationFirst']+'%,'+rowGradient['rowGradientColorSecond']+' '+rowGradient['rowGradientLocationSecond']+'%);';
          }

          if (rowGradient['rowGradientType'] == 'radial') {
            rowBackgroundOptions = 'background: radial-gradient(at '+rowGradient['rowGradientPosition']+', '+rowGradient['rowGradientColorFirst']+' '+rowGradient['rowGradientLocationFirst']+'%,'+rowGradient['rowGradientColorSecond']+' '+rowGradient['rowGradientLocationSecond']+'%);';
          }
          
        }
      }

      var thisRowHoverStyleTag = '';
      var thisRowHoverOption = '';
      if (typeof(rowData['rowHoverOptions']) !== 'undefined') {
        var rowHoverOptions = rowData['rowHoverOptions'];
        if (rowHoverOptions['rowBackgroundTypeHover'] == 'solid') {
          var thisRowHoverOption = ' #'+rowID+':hover { background:'+rowHoverOptions['rowBgColorHover']+' !important; transition: all '+rowHoverOptions['rowHoverTransitionDuration']+'s; }';
        }
        if (rowHoverOptions['rowBackgroundTypeHover'] == 'gradient') {
          var rowGradientHover = rowHoverOptions['rowGradientHover'];

          if (rowGradientHover['rowGradientTypeHover'] == 'linear') {
            thisRowHoverOption = ' #'+rowID+':hover { background: linear-gradient('+rowGradientHover['rowGradientAngleHover']+'deg, '+rowGradientHover['rowGradientColorFirstHover']+' '+rowGradientHover['rowGradientLocationFirstHover']+'%,'+rowGradientHover['rowGradientColorSecondHover']+' '+rowGradientHover['rowGradientLocationSecondHover']+'%) !important; transition: all '+rowHoverOptions['rowHoverTransitionDuration']+'s; }';
          }

          if (rowGradientHover['rowGradientTypeHover'] == 'radial') {

            thisRowHoverOption = ' #'+rowID+':hover { background: radial-gradient(at '+rowGradientHover['rowGradientPositionHover']+', '+rowGradientHover['rowGradientColorFirstHover']+' '+rowGradientHover['rowGradientLocationFirstHover']+'%,'+rowGradientHover['rowGradientColorSecondHover']+' '+rowGradientHover['rowGradientLocationSecondHover']+'%) !important; transition: all '+rowHoverOptions['rowHoverTransitionDuration']+'s; }';
          }
        }

        thisRowHoverStyleTag = '<style> '+thisRowHoverOption+' </style>';
      }

      rowOverlayBackgroundOptions = '';
      if (typeof(rowData['rowBgOverlayColor']) !== 'undefined') {
        var rowOverlayBackgroundOptions = 'background:'+rowData['rowBgOverlayColor']+'; background-color:'+rowData['rowBgOverlayColor']+';';
      }
      
      if (typeof(rowData['rowOverlayBackgroundType']) !== 'undefined') {
        if (rowData['rowOverlayBackgroundType'] == 'gradient') {
          var rowOverlayGradient = rowData['rowOverlayGradient'];

          if (rowOverlayGradient['rowOverlayGradientType'] == 'linear') {
            rowOverlayBackgroundOptions = 'background: linear-gradient('+rowOverlayGradient['rowOverlayGradientAngle']+'deg, '+rowOverlayGradient['rowOverlayGradientColorFirst']+' '+rowOverlayGradient['rowOverlayGradientLocationFirst']+'%,'+rowOverlayGradient['rowOverlayGradientColorSecond']+' '+rowOverlayGradient['rowOverlayGradientLocationSecond']+'%);';
          }

          if (rowOverlayGradient['rowOverlayGradientType'] == 'radial') {
            rowOverlayBackgroundOptions = 'background: radial-gradient(at '+rowOverlayGradient['rowOverlayGradientPosition']+', '+rowOverlayGradient['rowOverlayGradientColorFirst']+' '+rowOverlayGradient['rowOverlayGradientLocationFirst']+'%,'+rowOverlayGradient['rowOverlayGradientColorSecond']+' '+rowOverlayGradient['rowOverlayGradientLocationSecond']+'%);';
          }
          
        }
      }

      var VideoBgHtml = '';
      var VideoBgStyling = '';
      if (  typeof(rowData['video']) != 'undefined' )  {
        var rowVideo = rowData['video'];
        if (typeof(rowVideo['rowBgVideoEnable']) == 'undefined') {
          rowVideo['rowBgVideoEnable'] = '';
        }
        rowBgVideoEnable = rowVideo['rowBgVideoEnable'];
        if (rowBgVideoEnable == 'true') {
          rowBgVideoLoop = rowVideo['rowBgVideoLoop'];
          rowVideoMpfour = rowVideo['rowVideoMpfour'];
          rowVideoWebM = rowVideo['rowVideoWebM'];
          rowVideoThumb = rowVideo['rowVideoThumb'];

          rowVideoID = 'bgVid-'+rowID;
          
          var VideoBgHtml = '<video class="rowBgVideo" poster="'+rowVideoThumb+'" id="'+rowVideoID+'" playsinline autoplay muted '+rowBgVideoLoop+' > <source src="'+rowVideoWebM+'" type="video/webm"> <source src="'+rowVideoMpfour+'" type="video/mp4"> </video>';

          var ifVideoMp4RowStyles = '#'+rowID+' {overflow:hidden !important; position:relative; }';

          if (typeof(rowVideo['rowVideoType']) != 'undefined') {
            if (rowVideo['rowVideoType'] == 'yt') {
              ytvidId = ytVidURLParser(rowVideo['rowVideoYtUrl']);
              var VideoBgHtml = '<iframe id="'+rowVideoID+'" width="100%" height="100%" src="https://www.youtube.com/embed/'+ytvidId+'?rel=0&amp;controls=0&amp;showinfo=0;mute=1;autoplay=1&loop=1&playlist='+ytvidId+'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen ></iframe>';
              ifVideoMp4RowStyles = '';
            }
          }

          var VideoBgStyling = '<div class="rowBgVidStyles"> <style type="text/css">#'+rowVideoID+' { position: absolute; min-width: 100%; min-height: 100%;background: url("'+rowVideoThumb+'") no-repeat;background-size: cover;transition: 1s opacity; left:0; right:0; top: 0; } '+ifVideoMp4RowStyles+' </style> </div>';

          jQuery('#'+rowVideoID).remove();
          
          jQuery('#'+rowID).prepend(VideoBgHtml);
          jQuery('#'+rowID + '.rowBgVidStyles').html(VideoBgStyling);
        }else{
          rowVideoID = 'bgVid-'+rowID;
          jQuery('#'+rowVideoID).remove();
        }
        
      }

      jQuery('#'+rowID).attr('style','height:auto; overflow:visible; '+rowBackgroundOptions+' '+rowBackgroundParallax+' '+currRowMargins+' '+currRowPadding +custom_styling );

      jQuery('#'+rowID + ' .row-overlay').attr('style','height:100%; '+rowOverlayBackgroundOptions+' top:0; left: 0; width: 100%; position:absolute;');

      if (typeof(rowData['bgSTop']) != 'undefined') {
        jQuery('#'+rowID+' .bgShapeTop-'+rowID+' ').remove();

        var bgSTop = rowData['bgSTop'];
        var shapeType = bgSTop['rbgstType'];
        var rennderredShape = bgshapessvgrender(rowID, shapeType, false, bgSTop, 'false' );

        jQuery('#'+rowID+' .row-overlay').after(rennderredShape['html']);

        currentRowResponsiveTriggerScripts = currentRowResponsiveTriggerScripts + rennderredShape['scripts'];
      }


      if (typeof(rowData['bgSBottom']) != 'undefined') {
        jQuery('#'+rowID+' .bgShapeBottom-'+rowID+' ').remove();

        var bgSBottom = rowData['bgSBottom'];
        var shapeType = bgSBottom['rbgsbType'];
        var rennderredShape = bgshapessvgrender(rowID, shapeType, true, 'false', bgSBottom );

        jQuery('#'+rowID+' .row-overlay').after(rennderredShape['html']);
        currentRowResponsiveTriggerScripts = currentRowResponsiveTriggerScripts + rennderredShape['scripts'];

      }



      // New row bg options
      currRowDefaultBackgroundOps = '';
      currRowtabletBackgroundOps = '';
      currRowmobileBackgroundOps = '';



      if (defaultRowBackgroundType == 'solid') {
        if (typeof(rowData['bg_imgT']) != 'undefined') {

          drbgImgOps = rowData['bgImgOps'];

          defaultRowBgImg = rowData['bg_img'];
          tabletRowBgImg = rowData['bg_imgT'];
          mobileRowBgImg = rowData['bg_imgM'];
          if (tabletRowBgImg == '') { tabletRowBgImg = defaultRowBgImg; }
          if (mobileRowBgImg == '') { mobileRowBgImg = tabletRowBgImg; }


          defaultRowBgFixed = 'scroll';
          if (rowData['rowBackgroundParallax'] == 'true') { defaultRowBgFixed = 'fixed'; }
          tabletRowBgFixed = defaultRowBgFixed; mobileRowBgFixed = defaultRowBgFixed;
          if (drbgImgOps['parlxT'] == 'true') { tabletRowBgFixed = 'fixed'; }
          if (drbgImgOps['parlxT'] == 'false') { tabletRowBgFixed = 'scroll'; }
          if (drbgImgOps['parlxM'] == 'true') { mobileRowBgFixed = 'fixed'; }
          if (drbgImgOps['parlxM'] == 'false') { mobileRowBgFixed = 'scroll'; }

          drbgImgOpsRep = drbgImgOps['rep'];
          drbgImgOpsRepT = drbgImgOps['repT'];
          drbgImgOpsRepM = drbgImgOps['repM'];

          // desktop
          if (drbgImgOps['pos'] == 'custom') {
            defaultBgImgPos = "'background-position-x': '"+drbgImgOps['xPos']+drbgImgOps['xPosU']+ "', " + "'background-position-y': '"+drbgImgOps['yPos']+drbgImgOps['yPosU']+ "', ";
          }else{
            defaultBgImgPos = "'background-position': '"+drbgImgOps['pos']+"', ";
          }

          if ( drbgImgOpsRep == '' || drbgImgOpsRep == 'default') { drbgImgOpsRep = 'no-repeat'; }

          if (drbgImgOps['size'] == 'custom') {
            defaultBgImgSize = "'background-size': '"+drbgImgOps['cWid']+drbgImgOps['widU']+"', " 
          }else{
            defaultBgImgSize = "'background-size': '"+drbgImgOps['size']+"', ";
          }
          
          var currRowDefaultBackgroundOps  = ''+
          "<script>"+
            "jQuery('.responsiveBtn').on('click',function(){"+
            "if (jQuery(this).hasClass('rbt-l') ) { "+
              "jQuery('#"+rowID+"').css({ "+
                "'background-image': 'url("+defaultRowBgImg+")', "+
                "'background-repeat': '"+drbgImgOpsRep+"', "+
                "'background-attachment': '"+defaultRowBgFixed+"', "+
                defaultBgImgPos +
                defaultBgImgSize+
              "});"+
            "}"+
            "});"+
            " "+
            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-l' ) { "+
              "jQuery('#"+rowID+"').css({ "+
                "'background-image': 'url("+defaultRowBgImg+")', "+
                "'background-repeat': '"+drbgImgOpsRep+"', "+
                "'background-attachment': '"+defaultRowBgFixed+"', "+
                defaultBgImgPos +
                defaultBgImgSize+
              "});"+
            "}"+
            " "+
          "</script>";



          // Tablet
          if (drbgImgOps['posT'] == 'custom') {
            tabletBgImgPos = "'background-position-x': '"+drbgImgOps['xPosT']+drbgImgOps['xPosUT']+ "', " + "'background-position-y': '"+drbgImgOps['yPosT']+drbgImgOps['yPosUT']+ "', ";
          } else if(drbgImgOps['posT'] == ''){
            tabletBgImgPos = defaultBgImgPos;
          }else{
            tabletBgImgPos = "'background-position': '"+drbgImgOps['posT']+"', ";
          }

          if (drbgImgOpsRepT == '' || drbgImgOpsRepT == 'default') { drbgImgOpsRepT = drbgImgOpsRep; }


          if (drbgImgOps['sizeT'] == 'custom') {
            tabletBgImgSize = "'background-size': '"+drbgImgOps['cWidT']+drbgImgOps['widUT']+"', " 
          }else if(drbgImgOps['sizeT'] == ''){
            tabletBgImgSize = defaultBgImgSize;
          }else{
            tabletBgImgSize = "'background-size': '"+drbgImgOps['sizeT']+"', ";
          }
          

          var currRowtabletBackgroundOps  = ''+
          "<script>"+
            "jQuery('.responsiveBtn').on('click',function(){"+
            "if (jQuery(this).hasClass('rbt-m') ) { "+
              "jQuery('#"+rowID+"').css({ "+
                "'background-image': 'url("+tabletRowBgImg+")', "+
                "'background-repeat': '"+drbgImgOpsRepT+"', "+
                "'background-attachment': '"+tabletRowBgFixed+"', "+
                tabletBgImgPos +
                tabletBgImgSize+
              "});"+
            "}"+
            "});"+
            " "+
            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-m' ) { "+
              "jQuery('#"+rowID+"').css({ "+
                "'background-image': 'url("+tabletRowBgImg+")', "+
                "'background-repeat': '"+drbgImgOpsRepT+"', "+
                "'background-attachment': '"+tabletRowBgFixed+"', "+
                tabletBgImgPos +
                tabletBgImgSize+
              "});"+
            "}"+
            " "+
          "</script>";




          // mobile
          if (drbgImgOps['posM'] == 'custom') {
            mobileBgImgPos = "'background-position-x': '"+drbgImgOps['xPosM']+drbgImgOps['xPosUM']+ "', " + "'background-position-y': '"+drbgImgOps['yPosM']+drbgImgOps['yPosUM']+ "', ";
          }else if(drbgImgOps['posM'] == ''){
            mobileBgImgPos = tabletBgImgPos;
          }else{
            mobileBgImgPos = "'background-position': '"+drbgImgOps['posM']+"', ";
          }

          if (drbgImgOpsRepM == '' || drbgImgOpsRepM == 'default') { drbgImgOpsRepM = drbgImgOpsRepT; }

          if (drbgImgOps['sizeM'] == 'custom') {
            mobileBgImgSize = "'background-size': '"+drbgImgOps['cWidM']+drbgImgOps['widUM']+"', ";
          }else if(drbgImgOps['sizeM'] == ''){
            mobileBgImgSize = tabletBgImgSize;
          }else{
            mobileBgImgSize = "'background-size': '"+drbgImgOps['sizeM']+"', ";
          }
          
          var currRowmobileBackgroundOps  = ''+
          "<script>"+
            "jQuery('.responsiveBtn').on('click',function(){"+
            "if (jQuery(this).hasClass('rbt-s') ) { "+
              "jQuery('#"+rowID+"').css({ "+
                "'background-image': 'url("+mobileRowBgImg+")', "+
                "'background-repeat': '"+drbgImgOpsRepM+"', "+
                "'background-attachment': '"+mobileRowBgFixed+"', "+
                mobileBgImgPos +
                mobileBgImgSize+
              "});"+
            "}"+
            "});"+
            " "+
            "var currentVPS = jQuery('.currentViewPortSize').val();"+
            "if ( currentVPS == 'rbt-s' ) { "+
              "jQuery('#"+rowID+"').css({ "+
                "'background-image': 'url("+mobileRowBgImg+")', "+
                "'background-repeat': '"+drbgImgOpsRepM+"', "+
                "'background-attachment': '"+mobileRowBgFixed+"', "+
                mobileBgImgPos +
                mobileBgImgSize+
              "});"+
            "}"+
            " "+
          "</script>";


        }
      }
        

      rowBgResScripts = currRowDefaultBackgroundOps + currRowtabletBackgroundOps + currRowmobileBackgroundOps;

      columnContainerSetWidth = "100%";
      if (typeof(rowData['conType']) != 'undefined' ) {
        if (rowData['conType'] == 'boxed') {
          if (rowData['conWidth'] != '') {
            columnContainerSetWidth = rowData['conWidth']+'px';
          }
        }
      }

      jQuery('#rowColCont-'+rowID).css(
        'max-width', columnContainerSetWidth
      );

      jQuery('#'+rowID + ' #thisRowScripts').html( currentRowResponsiveTriggerScripts + rowBgResScripts +thisRowHoverStyleTag );
    
}


function getRealWidgetType(widgType){
  widgetName = '';
  switch(widgType){
    case 'wigt-WYSIWYG': widgetName = 'widgetWYSIWYG';       break;
    case 'wigt-img': widgetName = 'widgetImg';      break;
    case 'wigt-menu': widgetName = 'widgetMenu';     break;
    case 'wigt-btn-gen': widgetName = 'widgetButton';      break;
    case 'wigt-pb-form': widgetName = 'wigt-pb-form';      break;
    case 'wigt-video': widgetName = 'widgetVideo';     break;
    case 'wigt-pb-postSlider': widgetName = 'widgetPBPostsSlider';     break;
    case 'wigt-pb-icons': widgetName = 'widgetIcons';      break;
    case 'wigt-pb-counter': widgetName = 'widgetCounter';   break;
    case 'wigt-pb-audio': widgetName = 'widgetAudio';      break;
    case 'wigt-pb-cards': widgetName = 'widgetCard';     break;
    case 'wigt-pb-testimonial': widgetName = 'widgetTestimonial';    break;
    case 'wigt-pb-shortcode': widgetName = 'widgetShortCode';      break;
    case 'wigt-pb-countdown': widgetName = 'widgetCowntdown';     break;
    case 'wigt-pb-imageSlider': widgetName = 'widgetImageSlider';      break;
    case 'wigt-pb-progressBar': widgetName = 'widgetProgressBar';      break;
    case 'wigt-pb-pricing': widgetName = 'widgetPricing';      break;
    case 'wigt-pb-iconList': widgetName = 'widgetIconList';     break;
    case 'wigt-pb-break': widgetName = 'widgetBreaker';      break;
    case 'wigt-pb-spacer': widgetName = 'widgetVerticalSpace';     break;
    case 'wigt-pb-formBuilder': widgetName = 'widgetFormBuilder';      break;
    case 'wigt-pb-imgCarousel': widgetName = 'widgetImgCarousel';    break;
    case 'wigt-pb-wooCommerceProducts': widgetName = 'widgetWooPorducts';     break;
    case 'wigt-pb-text': widgetName = 'widgetText';      break;
    case 'wigt-pb-embededVideo': widgetName = 'widgetEmbedVideo';     break;
    case 'wigt-pb-popupClose': widgetName = 'widgetClosePopUp';      break;
    case 'wigt-pb-testimonialCarousel': widgetName = 'widgetTCarousel';      break;
    case 'wigt-pb-poOptins': widgetName = 'widgetPoOptins';      break;
    case 'wigt-pb-navmenu': widgetName = 'widgetNavBuilder';      break;
  }

  return widgetName;
}