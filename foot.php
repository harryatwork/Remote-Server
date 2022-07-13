<!-- JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!--plugins-->
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<!-- Vector map JavaScript -->
<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>
<script src="assets/js/index.js"></script>


<script src="assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
<script src="assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
<script src="assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
<script src="assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
<script src="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
<script>
	$('#fancy-file-upload').FancyFileUpload({
		params: {
			action: 'fileuploader'
		},
		maxfilesize: 1000000
	});
</script>
<script>
	$(document).ready(function () {
		$('#image-uploadify').imageuploadify();
	})
</script>
<script src="assets/js/app.js"></script>