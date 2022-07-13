<?php
    setcookie('parent_folder',$f, time() + (86400 *30));
    setcookie('full_url',$full_url, time() + (86400 *30));
    setcookie('sub_id',$sub_id, time() + (86400 *30));
?>

<style>
    .file-area {
        position: relative;
        font-size: 18px;
    }
    .file-area input[type=file] {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0;
        cursor: pointer;
    }
    .file-area .file-dummy {
        border-radius: 5px;
        padding: 50px 30px;
        border: 2px dashed #ccc;
        background-color: #213538;
        text-align: center;
        transition: background 0.3s ease-in-out;
    }
    .file-dummy {
        width:100%;
    }
    .file-area:hover .file-dummy {
        border: 2px dashed #8c8d93;
    }
    .default {
        font-family: verdana;
        font-size: 14px;
        color:gray;
    }
    
   .sharable_upload_link {
       display:none;
   } 
    
    
    
    
/* Upload styles ----- */
    
#upload_overlay {
  position: fixed; /* Sit on top of the page content */
  display: none; /* Hidden by default */
  width: 100%; /* Full width (cover the whole page) */
  height: 100%; /* Full height (cover the whole page) */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.3); /* Black background with opacity */
  z-index: 9999; /* Specify a stack order in case you're using a different order for other elements */
  cursor: pointer; /* Add a pointer on hover */
}
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

<div id="upload_overlay" onClick="refreshPage()"></div>

<!-- Popup Modals Starts ---->

    <!-- File Upload Starts ---->
    <div class="" id="upload_file" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;position: fixed;top: 20%;left: 30%;width: 40%;z-index: 9999;border-radius: 15px;">
    	<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" style="width: 100%;text-align: center;">Upload Files</h5>
    				<a href="backend_functions/update_file_sizes?folder_name=<?= $current_folder; ?>&f=<?= $f; ?>" class="close" aria-label="Close">	
    				    <span aria-hidden="true">&times;</span>
    				</a>
    			</div>
    			<div class="modal-body">
    			   
    				<form action="backend_functions/upload_files" method="POST" enctype='multipart/form-data'>
                        
                        <div class="file-area" id="container" style="position: relative;font-size: 18px;margin: 1% 5% 1% 5%;">
                            <!--<input name="files[]" type="file" id="file" onchange="javascript:updateList()" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf/*,.mkv," multiple="" style="display: block;" />-->
                            <div class="file-dummy image_preview_div" id="pickfiles" style="background: #213538;">
                                <span class="default" style="font-size:20px;color: #8c8d93;">
                                    <i class="fadeIn animated bx bx-cloud-upload" aria-hidden="true" style="font-size: 36px;"></i>
                                <br/>Click to Choose Files</span>
    				        </div>
    				        <br/>
    				        <div id="filelist" style="max-height: 100px;overflow-y: scroll;"></div>
    				        <input type="hidden" name="videoTitle" id="videoTitle" />
                        </div>
                        
                        <div id="progress_wrapper" style="opacity:0">
                          <div id="progress_bar"></div>
                        </div>

            			<input type="hidden"  name="parent_folder" value="<?= $f; ?>" />
        				<input type="hidden"  name="full_url" value="<?= $full_url; ?>" />
        				<input type="hidden" name="sub_id" value="<?= $sub_id; ?>" />
            			
            			<div class="modal-footer">
            				<a onClick="refreshPage()" class="btn btn-light">OK</a>
            			</div>
            		</form>
            	</div>
    			
    		</div>
    	</div>
    </div>
    <!-- File Upload Ends ---->
    
    
    <!-- Folder Create Starts ---->
    <div class="modal fade" id="create_folder" tabindex="-1" role="dialog" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" style="width: 100%;text-align: center;">Create Folder</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">	
    				    <span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    			   
    				<form action="backend_functions/create_folder.php" method="post" id="create_folder_form"></form>
				     <input type="hidden" form="create_folder_form" name="parent_folder" value="<?= $f; ?>" />
				     <input type="hidden" form="create_folder_form" name="full_url" value="<?= $full_url; ?>" />
                     <input form="create_folder_form" id="create_folder_input" name="folder_name" type="text" class="form-control" placeholder="Folder Name" />
                     <input type="hidden" form="create_folder_form" name="sub_id" value="<?= $sub_id; ?>" />
    			</div>
    			<div class="modal-footer">
    				<!--<button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>-->
    				<button form="create_folder_form" id="create_folder_btn" type="submit" class="btn btn-light">Create</button>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- Folder Create Ends ---->
    
    
    
    <!-- File Rename Starts ---->
    <div class="modal fade" id="file_rename" tabindex="-1" role="dialog" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" style="width: 100%;text-align: center;">Rename</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">	
    				    <span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<form action="rename_item.php" method="post">
        			<div class="modal-body">
        			   
                        <input type="text" class="form-control rename_folder_input" value="" placeholder="File Name" />
                        <input type="hidden" name="sub_id" class="sub_id" value="<?= $sub_id; ?>" />
                        <input type="hidden" name="rename_folder_item_id" class="rename_folder_item_id" value="<?= $sub_id; ?>" />
    
        			</div>
        			<div class="modal-footer">
        				<!--<button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>-->
        				<button type="button" class="btn btn-light rename_folder_btn">Rename</button>
        			</div>
    			</form>
    		</div>
    	</div>
    </div>
    <!-- File Rename Ends ---->
    
    
    <!-- File Share Starts ---->
    <div class="modal fade" id="file_share" tabindex="-1" role="dialog" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" style="width: 100%;text-align: center;">Share</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">	
    				    <span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				<label>Preview Link</label>
                        <input type="text" id="share_link_preview" class="form-control" readonly value="" placeholder="File Name" readonly />
                    <br/>
                    <label>Downloadable Link</label>
                        <input type="text" id="share_link_download" class="form-control" readonly value="" placeholder="File Name" readonly />
                    <br/>
                    <label>Direct Link</label>
                        <input type="text" id="share_link_direct" class="form-control" readonly value="" placeholder="File Name" readonly />
                    <br/>
                    <label class="sharable_upload_link">Sharable Upload Link</label>
                        <input type="text" id="share_link_upload" class="form-control sharable_upload_link" readonly value="" placeholder="File Name" readonly />
    			</div>
    		<!--
    			<div class="modal-footer">
    				<button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
    				<button type="button" class="btn btn-light">Copy Link</button>
    			</div>
    		-->
    		</div>
    	</div>
    </div>
    <!-- File Share Ends ---->
    
    
    
    <!-- Item Options Starts -->
    <div class="page-breadcrumb d-none d-md-flex align-items-center item_options" style="background: #54605c; border-radius: 5px;width: 73%;right: 3%;position: fixed;bottom: -20%;z-index: 99;">
        <div class="breadcrumb-title pr-3 item_options_indi starred_btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as Favorite" style="padding: 6px 0 !important; width: 14.2%; text-align: center;cursor:pointer;"><i class="lni lni-star-filled" ></i></div>
        <div class="breadcrumb-title pr-3 item_options_indi share_btn" data-toggle="modal" data-target="#file_share" style="padding: 6px 0 !important; width: 14.2%; text-align: center;cursor:pointer;"><i class="lni lni-link"></i></div>
        <div class="breadcrumb-title pr-3 item_options_indi rename_btn" data-toggle="modal"  style="padding: 6px 0 !important; width: 14.2%; text-align: center;cursor:pointer;"><i class="lni lni-pencil-alt"></i></div>
        <div class="breadcrumb-title pr-3 item_options_indi undeletable_btn undeletable_btn_alt" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as Un-Deletable" style="padding: 6px 0 !important; width: 14.2%; text-align: center;cursor:pointer;opacity: 0.3;"><img src="assets/images/general/trash_no.png" alt="" style="width:20px;color:white;" /></div>
        <div class="breadcrumb-title pr-3 item_options_indi private_btn private_btn_alt" data-toggle="tooltip" data-placement="top" title="" data-original-title="Move them to Private" style="padding: 6px 0 !important; width: 14.2%; text-align: center;cursor:pointer;opacity: 0.3;"><img src="assets/images/general/incognito.png" alt="" style="width:25px;color:white;" /></div>
        <div class="breadcrumb-title pr-3 item_options_indi" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download" style="padding: 6px 0 !important; width: 14.2%; text-align: center;cursor:pointer;"><a href="" class="download_btn" ><i class="lni lni-cloud-download"  style=""></i></a></div>
        <div class="breadcrumb-title pr-3 item_options_indi delete_btn delete_btn_alt" data-toggle="tooltip" data-placement="top" title="" data-original-title="Move Item to Trash" style="padding: 6px 0 !important; width: 14.2%; border-right: navajowhite; text-align: center;cursor:pointer;"><i class="lni lni-trash" style=""></i></div>
    </div>
    <!-- Item Options Ends -->

<!-- Popup Modals Ends ---->