<?php ?>
<script>
    function displayIframe() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"../view/admin_upquestion.php\" frameborder=\"0\" height=\"530rem\" width=\"600rem\" ></iframe>";

    }
</script>


<script>
    function viewquestion() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"../view/admin_viewquestion.php\" frameborder=\"0\" height=\"530rem\" width=\"600rem\" ></iframe>";

    }
</script>
<script>
    function result() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"../view/admin_result.php\" frameborder=\"0\" height=\"530rem\" width=\"600rem\" ></iframe>";

    }
</script>
<script>
    function student() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"../view/admin_students.php\" frameborder=\"0\" height=\"530rem\" width=\"600rem\" ></iframe>";

    }
</script>
<script type="text/javascript">
	function onload(){

		  document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"../view/admin_welcome.php\" frameborder=\"0\" height=\"530rem\" width=\"600rem\" ></iframe>";


	}
</script>
<script>
    function updatestudent() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"../view/admin_updatestudent.php\" frameborder=\"0\" height=\"530rem\" width=\"600rem\" ></iframe>";

    }
</script>
<script>
    function upload() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"../view/admin_uploadstudents.php\" frameborder=\"0\" height=\"530rem\" width=\"600rem\" ></iframe>";

    }
</script>
<script>
    function logout() {
       location.href="../controller/admin_logout.php";

    }
</script>
<?php ?>