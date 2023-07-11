jQuery(document).ready(function($) {
 /*Time*/
  var myVar = setInterval(function() {
    myTimer();
  }, 100);

  function myTimer() {
    var d = new Date();
    document.getElementById("time").innerHTML = d.toLocaleTimeString();
  }
});