<!-- Draggable Div STARTS -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Draggable Div ENDS -->

<script>
//On mouse rigt click Default event None ---------
$("body").on("contextmenu", function(e) {
  return false;
});

$("#exampleModal8").on("contextmenu", function(e) {
  return true;
});

//Notification Set time out / Clear timeout --------
var notify_settime;
function notify_timeout() {
    clearTimeout(notify_settime);
    notify_settime = setInterval(function(){ 
                        $(".notification").css({"display": "none"});
                     }, 2000);
}


//On Login Form Btn click -----------------------
$(".login_submit_btn").on('click',function() {
    $(this).attr("disabled", true);
    let login_form_email = $("#login_form_email").val();
    let login_form_password = $("#login_form_password").val();
    
    if(!login_form_email || !login_form_password) {
        $(".login_form_error_message_2").css("display","block");
	    setTimeout(function(){
         	$(".login_form_error_message_2").css("display","none");
        }, 2000);
        $(this).attr("disabled", false);
    } else {
        $.post(
            	'backend_functions/logincheck.php',
              {
                 login_form_email: login_form_email,
                 login_form_password: login_form_password,
              },
              function(result){
                  
                 if(result == 'error') {
        		    $(".login_form_error_message").css("display","block");
        		    setTimeout(function(){
                     	$(".login_form_error_message").css("display","none");
                    }, 2000);
                 } else {
                     window.location="index";
                 }
              }
          );
             
    $(this).attr("disabled", false);
  }
});


// On file input select - Show details -------
updateList = function() {
    var input = document.getElementById('file');
    $(".image_preview_div").css("display","none");
    var output = document.getElementById('fileList');
    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
        children += '<p style="font-size:12px;background: #283b3a;border-radius: 7px;padding: 5px 20px;">' + input.files.item(i).name + '</p>';
    }
    output.innerHTML = children;
}

//On File upload button submit -------------
$(".file_upload_btn").on('click',function() {
   $("#upload_overlay").css("display","block");
   $(".file-area").append(`<div style=" top: 50%;left: 50%;transform: translate(-50%, -50%);padding: 30px 20px;width: 500px;border-radius: 7px;background: #1a1c27;position: absolute;">
                            <h4 style="text-align:center;">Uploading in Progress</h4>
                            <p style="color:red;font-size:14px;text-align:center;"> Please do not close the window or refresh</p>
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;display:block;" width="300px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                <defs>
                                  <clipPath id="ldio-15d0jodozgy-cp" x="0" y="0" width="100" height="100">
                                    <path d="M81.3,58.7H18.7c-4.8,0-8.7-3.9-8.7-8.7v0c0-4.8,3.9-8.7,8.7-8.7h62.7c4.8,0,8.7,3.9,8.7,8.7v0C90,54.8,86.1,58.7,81.3,58.7z"></path>
                                  </clipPath>
                                </defs>
                                <path fill="none" stroke="#ffffff" stroke-width="2.7928" d="M82 63H18c-7.2,0-13-5.8-13-13v0c0-7.2,5.8-13,13-13h64c7.2,0,13,5.8,13,13v0C95,57.2,89.2,63,82,63z"></path>
                                <g clip-path="url(#ldio-15d0jodozgy-cp)">
                                  <g>
                                    <rect x="-100" y="0" width="25" height="100" fill="#e15b64"></rect>
                                    <rect x="-75" y="0" width="25" height="100" fill="#f47e60"></rect>
                                    <rect x="-50" y="0" width="25" height="100" fill="#f8b26a"></rect>
                                    <rect x="-25" y="0" width="25" height="100" fill="#abbd81"></rect>
                                    <rect x="0" y="0" width="25" height="100" fill="#e15b64"></rect>
                                    <rect x="25" y="0" width="25" height="100" fill="#f47e60"></rect>
                                    <rect x="50" y="0" width="25" height="100" fill="#f8b26a"></rect>
                                    <rect x="75" y="0" width="25" height="100" fill="#abbd81"></rect>
                                    <animateTransform attributeName="transform" type="translate" dur="1.6949152542372883s" repeatCount="indefinite" keyTimes="0;1" values="0;100"></animateTransform>
                                  </g>
                                </g>
                              </svg>
                             </div>`);
   $(".file_upload_btn").css("display","none");
});


// On folder create button submit ------------
$("#create_folder_btn").on('click',function() {
   $(this).attr("disabled", true); 
   $("#create_folder_form").submit();
});

// No space on folder name ---------
$("#create_folder_input").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});
$("#create_folder_input").on('input', function() {
    this.value = this.value.replace(/\\/g, '');
    this.value = this.value.replace(/\\|\//g,'');
});


//On Folder/file right click item option animate --------
$(".item").on("mousedown", function() {
  $(".card-body").css({"border":"none","border-radius":"0px"});
  let sub_id = $("#sub_id").val();
  if (event.which === 3) {
    $(this).find(".card-body").css({"border":"1px solid white","border-radius":"10px"});
    $(this).find(".card-body").addClass("item_selected");
    let item_id = $(this).find(".card-body").attr('data-item-id');
    let item_timestamp = $(this).find(".card-body").attr('data-timestamp');
    let item_type = $(this).find(".card-body").attr('data-type');
    let item_bywhom = $(this).find(".card-body").attr('data-bywhom');
    let item_name = $(this).find(".card-body").attr('data-name');
    let item_db_name = $(this).find("#item_href").attr('data-img');
    let item_deletable = $(this).find(".card-body").attr('data-deletable');
    $(".item_options").animate({'bottom': '0'}, 500);
    $(".item_options").attr('data-item-id', item_id);
    $(".item_options").attr('data-timestamp', item_timestamp);
    $(".item_options").attr('data-bywhom', item_bywhom);
    $(".item_options").attr('data-name', item_name);
if(item_type == 'Folder') {
    $(".item_options").attr('data-db-name', 'Folder');
} else {
    $(".item_options").attr('data-db-name', item_db_name);
}
    $(".item_options").attr('data-deletable', item_deletable);
    
    if(item_deletable == '0'){
        $(".delete_btn_alt").addClass("delete_btn");
        $(".delete_btn_alt").css("opacity","1");
    } else {
        $(".delete_btn_alt").removeClass("delete_btn");
        $(".delete_btn_alt").css("opacity","0.3");
    }
    
    if(item_name == 'User_Uploads'){
        $(".delete_btn_alt").removeClass("delete_btn");
        $(".delete_btn_alt").css("opacity","0.3");
        $(".rename_btn").attr('data-target','');
        $(".rename_btn").css("opacity","0.3");
        $(".sharable_upload_link").css("display","block");
    } else {
        $(".delete_btn_alt").addClass("delete_btn");
        $(".delete_btn_alt").css("opacity","1");
        $(".rename_btn").attr('data-target','#file_rename');
        $(".rename_btn").css("opacity","1");
        $(".sharable_upload_link").css("display","none");
    }
    
    if(item_type == 'DropBox'){
        $(".sharable_upload_link").css("display","block");
    } else {
        $(".sharable_upload_link").css("display","none");
    }
        
    
    
    
    
    if(item_bywhom == sub_id) {
        $(".undeletable_btn_alt").addClass("undeletable_btn");
        $(".undeletable_btn_alt").css("opacity","1");
        $(".private_btn_alt").addClass("private_btn");
        $(".private_btn_alt").css("opacity","1");
    } else { 
        $(".undeletable_btn_alt").removeClass("undeletable_btn");
        $(".undeletable_btn_alt").css("opacity","0.3");
        $(".private_btn_alt").removeClass("private_btn");
        $(".private_btn_alt").css("opacity","0.3");
    }
    
    let download_link = '';
    if(item_type == 'Folder') {
        download_link = 'backend_functions/download_zip?folder='+item_id;
    } else {
        download_link = 'backend_functions/download_indi?folder='+item_id;
    }
    $(".download_btn").attr('href', download_link);
  } else { }
});

//On click outside item options animate back ------------
$(document).on('click',function(){
    $(".card-body").css({"border":"none","border-radius":"0px"});
    $(".card-body").removeClass("item_selected");
    $(".item_options").animate({'bottom': '-20%'}, 500);
    $(".item_options").removeAttr("data-item-id");
    $(".item_options").removeAttr("data-timestamp");
    $(".search_results").html('');
    $("#search_input").val('');
    $(".search_results").css("display","none");
});

// On item options hover animate to highlight ------------
$(".item_options_indi").mouseover(function() {
    $(this).find(".lni").css("font-size","36px");
    $(this).css("background","#817f64");
})
.mouseout(function() {
    $(this).find(".lni").css("font-size","20px");
    $(this).css("background","rgb(84 96 92)");
});
  
  
// On Starring a item ---------------------
$(".starred_btn").on('click',function() {
    let item_id = $(this).parent().attr('data-item-id');
    let sub_id = $("#sub_id").val();
    if ($(".item_selected").find(".item_starred_span").hasClass("starred")) {
        $(".item_selected").find(".item_starred_span").html('');
        $(".item_selected").find(".item_starred_span").removeClass("starred");
        $.post(
        	'backend_functions/starring.php',
          {
             item_id: item_id,
             sub_id: sub_id,
             status: 'remove'
          },
          function(result){
            if(result == 1) {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Item Removed from Favorites Successfully';
                $(".notification").html(notify);
            } else {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Some error occured. Please try again after some time';
                $(".notification").html(notify);
            }
             $(".notification").css({"display":"block"});
             notify_timeout();
          }
        );
    } else {
        $(".item_selected").find(".item_starred_span").addClass("starred");
        $(".item_selected").find(".item_starred_span").html('<img src="assets/images/general/star_gif.gif?x='+ Math.random()+'" style="position: absolute;top: 6%;right: 2%;width: 56px;">');
        $.post(
        	'backend_functions/starring.php',
          {
             item_id: item_id,
             sub_id: sub_id,
             status: 'add'
          },
          function(result){
            if(result == 1) {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Item added to Favorites Successfully';
                $(".notification").html(notify);
            } else {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Some error occured. Please try again after some time';
                $(".notification").html(notify);
            }
             $(".notification").css({"display":"block"});
             notify_timeout();
             
          }
        );
    }
});


// On Undeletable Btn of item ---------------------
$(document).on('click','.undeletable_btn',function(){
    let item_id = $(this).parent().attr('data-item-id');
    let sub_id = $("#sub_id").val();
    if ($(".item_selected").find(".item_undeletable_span").hasClass("starred")) {
        $(".item_selected").find(".item_undeletable_span").html('');
        $(".item_selected").find(".item_undeletable_span").removeClass("starred");
        $.post(
        	'backend_functions/undeletable.php',
          {
             item_id: item_id,
             sub_id: sub_id,
             status: 'remove'
          },
          function(result){
            if(result == 1) {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Item Marked as Deletable Successfully';
                $(".notification").html(notify);
            } else {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Some error occured. Please try again after some time';
                $(".notification").html(notify);
            }
             $(".notification").css({"display":"block"});
             notify_timeout();
          }
        );
    } else {
        $(".item_selected").find(".item_undeletable_span").addClass("starred");
        $(".item_selected").find(".item_undeletable_span").html('<img src="assets/images/general/trash_no.png" style="position: absolute;top: 12%;right: 22%;width: 16px;">');
        $.post(
        	'backend_functions/undeletable.php',
          {
             item_id: item_id,
             sub_id: sub_id,
             status: 'add'
          },
          function(result){
            if(result == 1) {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Item Marked as Undeletable Successfully';
                $(".notification").html(notify);
            } else {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Some error occured. Please try again after some time';
                $(".notification").html(notify);
            }
             $(".notification").css({"display":"block"});
             notify_timeout();
             
          }
        );
    }
});



// On Private Btn of item ---------------------
$(document).on('click','.private_btn',function(){
    let item_id = $(this).parent().attr('data-item-id');
    let sub_id = $("#sub_id").val();
    if ($(".item_selected").find(".item_private_span").hasClass("starred")) {
        $(".item_selected").find(".item_private_span").html('');
        $(".item_selected").find(".item_private_span").removeClass("starred");
        $.post(
        	'backend_functions/private.php',
          {
             item_id: item_id,
             sub_id: sub_id,
             status: 'remove'
          },
          function(result){
            if(result == 1) {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Item Marked as Public Successfully';
                $(".notification").html(notify);
            } else {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Some error occured. Please try again after some time';
                $(".notification").html(notify);
            }
             $(".notification").css({"display":"block"});
             notify_timeout();
          }
        );
    } else {
        $(".item_selected").find(".item_private_span").addClass("starred");
        $(".item_selected").find(".item_private_span").html('<img src="assets/images/general/incognito.png" style="position: absolute;top: 12%;left: 13%;width: 18px;">');
        $.post(
        	'backend_functions/private.php',
          {
             item_id: item_id,
             sub_id: sub_id,
             status: 'add'
          },
          function(result){
            if(result == 1) {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Item Marked as Private Successfully';
                $(".notification").html(notify);
            } else {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Some error occured. Please try again after some time';
                $(".notification").html(notify);
            }
             $(".notification").css({"display":"block"});
             notify_timeout();
             
          }
        );
    }
});





//On Delete of a item -----------------------
$(document).on('click','.delete_btn',function(){
    let item_id = $(this).parent().attr('data-item-id');
    if ($(".item_selected").parent().hasClass("deleted")) { } else {
        $(".item_selected").parent().addClass("deleted");
        $(".item_selected").parent().css({"filter": "blur(5px)", "opacity": "0.5"});
        $(".item_selected").closest(".item").append(`<div class="deleted_icon_div" style="position: absolute; top: 10%; left: 30%; opacity: 0.7; color: #e4eaea;">
                                                        <i class="lni lni-trash" style="font-size: 100px;"></i>
                                                        <br /><br />
                                                        <a class="btn btn-light undo_delete_item" data-item-id="`+item_id+`" style="width: 100%; font-weight: 600;">Undo</a>
                                                     </div>`);
        $.post(
        	'backend_functions/delete_item.php',
          {
             item_id: item_id,
             item_state: 'Deleted',
          },
          function(result){
            
          }
        );
    }
});


//On Share of a item Button CLick -----------------------
$(".share_btn").on('click',function() {
    let item_id = $(this).parent().attr('data-item-id');
    let item_db_name = $(this).parent().attr('data-db-name');
    let item_timestamp = $(this).parent().attr('data-timestamp');
    $("#share_link_preview").val("https://vdofyfilex.com/preview?/i="+item_id+"&/"+Math.floor(Math.random() * 1000000));
    $("#share_link_download").val("https://vdofyfilex.com/download?/"+item_timestamp);
if(item_db_name == 'Folder') {
    $("#share_link_direct").val("https://vdofyfilex.com/download?/"+item_timestamp);
} else {
    $("#share_link_direct").val("https://vdofyfilex.com/files/"+item_db_name);
}
    $("#share_link_upload").val("https://vdofyfilex.com/user_uploads?/"+item_timestamp);
});

$(document).on('click','.undo_delete_item',function(){
    let item_id = $(this).attr('data-item-id');
    $(this).closest(".item").find(".card").removeClass("deleted");
    $(this).closest(".item").find(".card").css({"filter": "blur(0px)", "opacity": "1"});
    $(this).parent().remove();
    $.post(
    	'backend_functions/delete_item.php',
      {
         item_id: item_id,
         item_state: 'Live',
      },
      function(result){
        
      }
    );
});



//On Item Preview href click -------------------
$(document).on('click','#item_href',function(){
    let data_type =  $(this).attr('data-type');
    let data_img =  $(this).attr('data-img');
    
    if(data_type == 'image') {
        $(".preview_sub_div").html('<img src="files/'+data_img+'" class="card-img-top popup_img" alt="...">');
    } else if(data_type == 'video') {
        $(".preview_sub_div").html('<video  controls controlsList="nodownload" ><source src="files/'+data_img+'"></video>');
    } else if(data_type == 'pdf') {
        $(".preview_sub_div").css("left","-45%");
        $(".preview_sub_div").html('<iframe src="files/'+data_img+'" width="1200" height="800">');
    } else if(data_type == 'other') {
        $(".preview_sub_div").css("left","-45%");
        // $(".preview_sub_div").html('<iframe src="https://docs.google.com/gview?url=https://vdofyfilex.com/files/'+data_img+'&embedded=true" width="1000" height="800"></iframe>');
        $(".preview_sub_div").html('<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=https://vdofyfilex.com/files/'+data_img+'&embedded=true" width="1000" height="800"></iframe>');
    } else { }
});

$("#exampleModal8").on('click',function() {
    $(".preview_sub_div").html('');
    $(".preview_sub_div").css("left","0%");
});



//On search Input type -------------------
$('#search_input').on('input', function() {
    let search = $('#search_input').val();
    if(search == '') {
        $(".search_results").css("display","none");
    } else {
        $(".search_results").css("display","block");
        $.post(
        	'backend_functions/search.php',
          {
             search: search,
          },
          function(result){
            $(".search_results").html(result);
          }
        );
    }
});

//On hover of serach results --------
$(document).on('mouseover', '.search_results_indi',function(){
    $(".search_results_indi").css("background","rgb(19, 52, 74)");
    $(this).css("background","#295668");
    console.log(this);
});



//On Drag and Drop Item to Move -----------------------
$(document).ready(function() {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
        
    } else {
        dragger();
    }
});

// revert: function() {
//     $('.item').css("opacity","100%");
//     return 'invalid';
// },
function dragger() {
    $(".item").draggable({
      revert: "invalid",
      containment: "",
      cursor: "move",
      drag: function() {
        $('.item').css("opacity","50%");
        $('.item_holder').css("opacity","100%");
        $(this).css("opacity","100%");
      },
      drop: function() {
        $('.item').css("opacity","100%");
      }
    });
    
    $(".item_holder").droppable({
      accept: ".item",
      drop: function( event, ui ) {
        $('.item').css("opacity","100%");
        let item_id = ui.draggable.find(".card-body").attr('data-item-id');
        let item_drop_id = $(this).find(".card-body").attr('data-item-id');

        $.post(
        	'backend_functions/item_move.php',
          {
             item_id: item_id,
             item_drop_id: item_drop_id,
          },
          function(result){
             if(result == 1) {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> File Moved Successfully';
                $(".notification").html(notify);
                ui.draggable.remove();
             } else {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Some error occured. Please try again after some time';
                $(".notification").html(notify);
             }
                 $(".notification").css({"display":"block"});
                 notify_timeout();

          }
        );
        
      }
    });
}


//On Folder Rename Input -------------------

$('.rename_btn').on('click',function() {
    let item_id = $(this).parent().attr('data-item-id');
    let item_name = $(this).parent().attr('data-name');
    $(".rename_folder_input").val(item_name);
    $(".rename_folder_item_id").val(item_id);
});

$('.rename_folder_btn').on('click',function() {
    let item_name = $('.rename_folder_input').val();
    let item_id = $('.rename_folder_item_id').val();
    let sub_id = $('.sub_id').val();
    if(item_name == '') { } else {
        $.post(
        	'backend_functions/rename_item.php',
          {
             item_name: item_name,
             item_id: item_id,
             sub_id: sub_id
          },
          function(result){
            if(result == 1) {
                $(".item_name_"+item_id).html(item_name);
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Item Renamed Successfully';
                $(".notification").html(notify);
            } else {
                let notify = '<i class="fadeIn animated bx bx-bell"></i> Some error occured. Please try again after some time';
                $(".notification").html(notify);
            }
            $(".close").click();
              $(".notification").css({"display":"block"});
              notify_timeout();
          }
        );
    }
});





/* Chunk upload starts */
window.addEventListener("load", function () {

    var path = "plupload/js/`";
    var fileInputBox = document.querySelector("#videoTitle");
    var progressBar = document.querySelector("#progress_bar");
    var uploader = new plupload.Uploader({
      browse_button: 'pickfiles',
      container: document.getElementById('container'),
      url: '../backend_functions/chunk_upload.php',
      chunk_size: '10000kb',
      max_retries: 2,
      filters: {
        max_file_size: '50000mb',
        mime_types: [{title: "*", extensions: "*"}]
      },
      init: {
        PostInit: function () {
          document.getElementById('filelist').innerHTML = '';
        },
        FilesAdded: function (up, files) {
          plupload.each(files, function (file) {
            document.getElementById('filelist').innerHTML += '<div id="' + file.id + '" style="font-size: 13px;">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
            fileInputBox.value = file.name;
          });
          uploader.start();
          $("#progress_wrapper").css("opacity","1");
        },
        UploadProgress: function (up, file) {
          document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
          progressBar.style.width = file.percent + "%";
        },
        UploadComplete: function(up, file){
        //   document.getElementById('submitBtn').disabled = false;
        },
        Error: function (up, err) {
          // DO YOUR ERROR HANDLING!
          console.log(err);
        }
      }
    });
    uploader.init();
});
/* Chunk upload ends */


/* Refresh function Starts ---- */
function refreshPage(){
    window.location.reload();
} 
/* Refresh function Ends ---- */ 

/* Escape Not allowed Starts ---- */
$(document).keydown(function(e) {
    // ESCAPE key pressed
    if (e.keyCode == 27) {
        return false;
    }
});
/* Escape Not allowed Ends ---- */




/* Layout Change Starts ---- */
$("#layout_big").on('click',function() {
    $(".item").css({"flex":"0 0 25%","zoom":"1"});
});

$("#layout_medium").on('click',function() {
    $(".item").css({"flex":"0 0 20%","zoom":"0.8"});
});

$("#layout_small").on('click',function() {
    $(".item").css({"flex":"0 0 14%","zoom":"0.6"});
});

/* Layout Change Ends ---- */




</script>