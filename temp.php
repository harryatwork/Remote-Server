<HTML>
<head>
<style type="text/css">
  #progress_wrapper {
    width: 100%;
    border-radius: 50px;
    background-color: #9e9e9e;
    margin: 10px 0;
  }

  #progress_bar {
    width: 1%;
    height: 10px;
    border-radius: 50px;
    background-color: #4caf50;
  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/3.1.2/plupload.full.min.js" integrity="sha512-+F2bTlYeSZrUs0uNo8OsYlE4tbdEoGp3Hhur4V+4o4nmsljKKDgCexLpqc5mERevdiOqthT4SVL+SHhz4lyfcA==" crossorigin="anonymous"></script>
    <script>
      window.addEventListener("load", function () {
        var path = "plupload/js/`";
        var fileInputBox = document.querySelector("#videoTitle");
        var progressBar = document.querySelector("#progress_bar");
        var uploader = new plupload.Uploader({
          browse_button: 'pickfiles',
          container: document.getElementById('container'),
          url: 'testupload.php',
          chunk_size: '10000kb',
          max_retries: 2,
          filters: {
            max_file_size: '30000mb',
            mime_types: [{title: "Video", extensions: "*"}]
          },
          init: {
            PostInit: function () {
              document.getElementById('filelist').innerHTML = '';
            },
            FilesAdded: function (up, files) {
              plupload.each(files, function (file) {
                document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                fileInputBox.value = file.name;
              });
              uploader.start();
            },
            UploadProgress: function (up, file) {
              document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
              progressBar.style.width = file.percent + "%";
            },
            UploadComplete: function(up, file){
              document.getElementById('submitBtn').disabled = false;
            },
            Error: function (up, err) {
              // DO YOUR ERROR HANDLING!
              console.log(err);
            }
          }
        });
        uploader.init();
      });
    </script>
  </head>
  <body>

  <div style="display:inline-block;">
     <label style="font-family:verdana;">Upload Full Video </label>
	  <br>
	  <span style="display: block;color: #666;font-size: 12px;padding: 3px;font-family: verdana;padding-bottom: 5px;">(* required Field) </span>
  <div id="container" style="background: #efefef;border-radius: 3px;padding: 3px 5px;color: black;position: relative;border: 1px solid gray;width: 100px;">
    <span id="pickfiles" style="font-family:verdana;">Upload File</span>
  </div>
	  <br>
  <div id="filelist" style="color:red;font-family:verdana;">Your browser doesn't support HTML5 upload.</div>

  <input type="hidden" name="videoTitle" id="videoTitle" />
	  
	 </div>
  

  <div id="progress_wrapper">
    <div id="progress_bar"></div>
  </div>
	  
 <!-- C:fakepath -->
