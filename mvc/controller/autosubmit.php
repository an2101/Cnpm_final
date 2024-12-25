<?php

?>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("btn3");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
 window.onload = function exampleFunction() {
            modal.style.display = "block";
        }



// When the user clicks on <span> (x), close the modal
btn3.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script type="text/javascript">
    
    addEventListener("click", function() {
    var
          el = document.documentElement
        , rfs =
               el.requestFullScreen
            || el.webkitRequestFullScreen
            || el.mozRequestFullScreen
    ;
    rfs.call(el);
});</script>
<script>
var hasSwitchedTab = false;

// Khi người dùng mở tab khác (hoặc mất tiêu điểm của trang)
window.onblur = function() {
  hasSwitchedTab = true;
};

// Khi người dùng quay trở lại tab
window.onfocus = function() {
  if (hasSwitchedTab) {
    // Submit bài làm tự động nếu đã mở tab khác
    //alert('You switched tabs! Submitting your answers automatically.');
    document.getElementById('btnSubmit').click();  // Tự động click vào nút submit
    
  }
};
</script>
<?php
// Kết thúc file PHP
?>
