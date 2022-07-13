<?php
    $sqluser = "SELECT * FROM subadmin WHERE email = '$email'";
	$resultuser = $conn->query($sqluser);
	if ($resultuser->num_rows > 0) {   
	while($rowuser = $resultuser->fetch_assoc()) {
		$sub_id = $rowuser["id"];
		$name = $rowuser["name"];
		$type = $rowuser["type"];
		$initials = substr($name, 0, 1);


    $full_url = 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; 
    $current_folder = explode("/", $full_url);
    $current_folder = end($current_folder);
    
	} } else { } 
	
	if(isset($_GET["f"])) {
	    $parent_id = $_GET["f"];
	} else {
	    $parent_id = 0;
	}

?>
<input type="hidden" id="sub_id" value="<?= $sub_id; ?>" />

<!--sidebar-wrapper-->
<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div class="" style="width: 100%;text-align: center;">
			<img src="assets/images/general/logo.png" class="logo-icon-2" alt="" style="width:100px;" />
		</div>
	</div>
	<!--navigation-->
	
	<ul class="metismenu" id="menu">
	    
	    <li style="border: 1px solid white;border-radius: 5px;">
    		<a class="has-arrow" href="javascript:;" style="cursor:pointer;">
    			<div class="parent-icon"><i class="lni lni-plus"></i></div>
    			<div class="menu-title" style="color:white;">New</div>
    		</a>
    		<ul>
    			<li><a data-toggle="modal" data-target="#create_folder" style="cursor:pointer;">
    			    <div class="icon-base">	
    			        <i class="fadeIn animated bx bx-folder"></i>
					</div>Create Folder</a>
			    </li>
			    <li><a href="backend_functions/create_dropbox?parent_folder=<?= $f; ?>&full_url=<?= $full_url; ?>&sub_id=<?= $sub_id; ?>" style="cursor:pointer;">
    			    <div class="icon-base">	
    			        <i class="fadeIn animated bx bx-cloud-upload"></i>
					</div>Create DropBox</a>
			    </li>
    			<li><a data-toggle="modal" data-target="#upload_file" style="cursor:pointer;">
    			    <div class="icon-base">	
    			        <i class="fadeIn animated bx bx-file"></i>
					</div>Upload Files</a>
				</li>
			<!--
    			<li><a data-toggle="modal" data-target="#upload_file">
			        <div class="icon-base">	
			            <i class="fadeIn animated bx bx-video"></i>
					</div>Upload Video</a>
				</li>
    			<li><a data-toggle="modal" data-target="#upload_file">
			        <div class="icon-base">	
			            <i class="fadeIn animated bx bx-text"></i>
					</div>Upload Doc</a>
			    </li>
    			<li><a data-toggle="modal" data-target="#upload_file">
			        <div class="icon-base">	
			            <i class="fadeIn animated bx bx-spreadsheet"></i>
					</div>Upload Sheet</a>
				</li>
    			<li><a data-toggle="modal" data-target="#upload_file">
			        <div class="icon-base">	
			            <i class="fadeIn animated bx bx-file"></i>
				    </div>Upload PDF</a>
				</li>
		    -->
    		</ul>
    	</li>
	    
		<li>
			<a href="index" class="">
				<div class="parent-icon"><i class="bx bx-home-alt"></i></div>
				<div class="menu-title">Home</div>
			</a>
		</li>
		
		<li>
			<a class="has-arrow" href="javascript:;" style="cursor:pointer;">
				<div class="parent-icon"><i class="bx bx-folder"></i></div>
				<div class="menu-title">All Folders</div>
			</a>
			<ul>
			<?php
			    $sql_folders = "SELECT * FROM items WHERE parent = 0 AND type = 'Folder' AND state = 'Live'";
            	$result_folders = $conn->query($sql_folders);
            	if ($result_folders->num_rows > 0) {   
            	while($row_folders = $result_folders->fetch_assoc()) {
            		$folders_id = $row_folders["id"];
            		$folders_name = $row_folders["name"];
            		$folders_type = $row_folders["type"];
            		$folders_parent = $row_folders["parent"];
            		$folders_state = $row_folders["state"];
            		$folders_timestamp = $row_folders["timestamp"];
            ?>
				<li><a href="folder?f=<?= $folders_id; ?>&/<?= $folders_name; ?>" style="padding-left: 30px;font-size:14px;"><i class="bx bx-folder"></i><?= substr($folders_name, 0 ,15); ?></a></li>
			<?php } } else { } ?>
			</ul>
		</li>
		
		<li>
			<a href="uploads">
				<div class="parent-icon"><i class="fadeIn animated bx bx-cloud-upload"></i></div>
				<div class="menu-title">Uploaded by me</div>
			</a>
		</li>
		
		<li>
			<a href="starred">
				<div class="parent-icon"><i class="lni lni-star"></i></div>
				<div class="menu-title">Starred</div>
			</a>
		</li>
		
		<li>
			<a href="trash">
				<div class="parent-icon"><i class="lni lni-trash"></i></div>
				<div class="menu-title">Trash</div>
			</a>
		</li>

	</ul>
	
    <div class="card">
    	<div class="card-body">
    	    
    	   <?php
    	    $sql_all_size = "SELECT SUM(size) AS total FROM items";
			$row_all_size = mysqli_query($conn, $sql_all_size);
			$count_all_size = mysqli_fetch_assoc($row_all_size);
			$total_all_size = $count_all_size["total"];
			if($total_all_size > 100000000) { 
			    $total_all_size_in_GB = round(((($total_all_size/1000)/1000)/1000), 1);
			    $total_all_size_in_GB_ext = 'GB';
			} elseif($total_all_size < 100000000 && $total_all_size > 1000000) {
			    $total_all_size_in_GB = round(((($total_all_size/1000)/1000)), 1);
			    $total_all_size_in_GB_ext = 'MB';
			} else {
			    $total_all_size_in_GB = round(((($total_all_size/1000))), 1);
			    $total_all_size_in_GB_ext = 'KB';
			}
		   ?>
    	    
    		<h5 class="mb-0 font-weight-bold" style="font-size:16px;"><?= $total_all_size_in_GB; ?> <?= $total_all_size_in_GB_ext; ?> 
    		    <span class="float-right">Unlimited</span>
    		</h5>
    		<p class="mb-0 mt-2">
    		    <span class="">Used</span>
    		    <span class="float-right">...</span>
    		</p>
    		<div class="progress mt-3" style="height:7px;">
    			<div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
    			<div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
    			<div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
    		</div>
    		<div class="mt-3"></div> 
    		
    	<?php
    	    $sql_image_items_count = "SELECT COUNT(*) AS total FROM items WHERE (type = 'Image' OR type = 'Png' OR type = 'Jpeg' OR type = 'Jpg' OR type = 'Gif')";
			$row_image_items_count = mysqli_query($conn, $sql_image_items_count);
			$count_image_items_count = mysqli_fetch_assoc($row_image_items_count);	
    	
    	    $sql_image_size = "SELECT SUM(size) AS total FROM items WHERE (type = 'Image' OR type = 'Png' OR type = 'Jpeg' OR type = 'Jpg' OR type = 'Gif')";
			$row_image_size = mysqli_query($conn, $sql_image_size);
			$count_image_size = mysqli_fetch_assoc($row_image_size);
			$total_image_size = $count_image_size["total"];
			if($total_image_size > 100000000) { 
			    $total_image_size_in_GB = round(((($total_image_size/1000)/1000)/1000), 1);
			    $total_image_size_in_GB_ext = 'GB';
			} elseif($total_image_size < 100000000 && $total_image_size > 1000000) {
			    $total_image_size_in_GB = round(((($total_image_size/1000)/1000)), 1);
			    $total_image_size_in_GB_ext = 'MB';
			} else {
			    $total_image_size_in_GB = round(((($total_image_size/1000))), 1);
			    $total_image_size_in_GB_ext = 'KB';
			}
		?>
    		
    		<div class="media align-items-center" style="font-size:12px;">
    			<div class="fm-file-box bg-white text-primary">
    			    <i class="bx bx-image"></i>
    			</div>
    			<div class="media-body ml-2">
    				<h6 class="mb-0">Images</h6>
    				<p class="mb-0"><?= $count_image_items_count["total"]; ?> files</p>
    			</div>
    			<h6 class="mb-0"><?= $total_image_size_in_GB; ?> <?= $total_image_size_in_GB_ext; ?></h6>
    		</div>
    		
    	<?php
    	    $sql_doc_items_count = "SELECT COUNT(*) AS total FROM items WHERE (type = 'Doc' OR type = 'Docx' OR type = 'Txt')";
			$row_doc_items_count = mysqli_query($conn, $sql_doc_items_count);
			$count_doc_items_count = mysqli_fetch_assoc($row_doc_items_count);	
    	
    	    $sql_doc_size = "SELECT SUM(size) AS total FROM items WHERE (type = 'Doc' OR type = 'Docx' OR type = 'Txt')";
			$row_doc_size = mysqli_query($conn, $sql_doc_size);
			$count_doc_size = mysqli_fetch_assoc($row_doc_size);
			$total_doc_size = $count_doc_size["total"];
			if($total_doc_size > 100000000) { 
			    $total_doc_size_in_GB = round(((($total_doc_size/1000)/1000)/1000), 1);
			    $total_doc_size_in_GB_ext = 'GB';
			} elseif($total_doc_size < 100000000 && $total_doc_size > 1000000) {
			    $total_doc_size_in_GB = round(((($total_doc_size/1000)/1000)), 1);
			    $total_doc_size_in_GB_ext = 'MB';
			} else {
			    $total_doc_size_in_GB = round(((($total_doc_size/1000))), 1);
			    $total_doc_size_in_GB_ext = 'KB';
			}
		?>
    		
    		<div class="media align-items-center mt-3" style="font-size:12px;">
    			<div class="fm-file-box bg-light-success text-success"><i class="bx bxs-file-doc"></i>
    			</div>
    			<div class="media-body ml-2">
    				<h6 class="mb-0">Documents</h6>
    				<p class="mb-0"><?= $count_doc_items_count["total"]; ?> files</p>
    			</div>
    			<h6 class="mb-0"><?= $total_doc_size_in_GB; ?> <?= $total_doc_size_in_GB_ext; ?></h6>
    		</div>
    		
    	<?php
    	    $sql_video_items_count = "SELECT COUNT(*) AS total FROM items WHERE (type = 'Video' OR type = 'Mp4' OR type = 'Webm' OR type = 'ogg')";
			$row_video_items_count = mysqli_query($conn, $sql_video_items_count);
			$count_video_items_count = mysqli_fetch_assoc($row_video_items_count);	
    	
    	    $sql_video_size = "SELECT SUM(size) AS total FROM items WHERE (type = 'Video' OR type = 'Mp4' OR type = 'Webm' OR type = 'ogg')";
			$row_video_size = mysqli_query($conn, $sql_video_size);
			$count_video_size = mysqli_fetch_assoc($row_video_size);
			$total_video_size = $count_video_size["total"];
			if($total_video_size > 100000000) { 
			    $total_video_size_in_GB = round(((($total_video_size/1000)/1000)/1000), 1);
			    $total_video_size_in_GB_ext = 'GB';
			} elseif($total_video_size < 100000000 && $total_video_size > 1000000) {
			    $total_video_size_in_GB = round(((($total_video_size/1000)/1000)), 1);
			    $total_video_size_in_GB_ext = 'MB';
			} else {
			    $total_video_size_in_GB = round(((($total_video_size/1000))), 1);
			    $total_video_size_in_GB_ext = 'KB';
			}
		?>
    		
    		<div class="media align-items-center mt-3" style="font-size:12px;">
    			<div class="fm-file-box bg-light-danger text-danger"><i class="bx bx-video"></i>
    			</div>
    			<div class="media-body ml-2">
    				<h6 class="mb-0">Media Files</h6>
    				<p class="mb-0"><?= $count_video_items_count["total"]; ?> files</p>
    			</div>
    			<h6 class="mb-0"><?= $total_video_size_in_GB; ?> <?= $total_video_size_in_GB_ext; ?></h6>
    		</div>
    		
    	<?php
    	    $sql_other_items_count = "SELECT COUNT(*) AS total FROM items WHERE (type != 'Image' AND type != 'Png' AND type != 'Jpeg' AND type != 'Jpg' AND type != 'Gif' AND type != 'Doc' AND type != 'Docx' AND type != 'Txt' AND type != 'Video' AND type != 'Mp4' AND type != 'Webm' AND type != 'ogg' AND type != 'Folder')";
			$row_other_items_count = mysqli_query($conn, $sql_other_items_count);
			$count_other_items_count = mysqli_fetch_assoc($row_other_items_count);	
    	
    	    $sql_other_size = "SELECT SUM(size) AS total FROM items WHERE (type != 'Image' AND type != 'Png' AND type != 'Jpeg' AND type != 'Jpg' AND type != 'Gif' AND type != 'Doc' AND type != 'Docx' AND type != 'Txt' AND type != 'Video' AND type != 'Mp4' AND type != 'Webm' AND type != 'ogg' AND type != 'Folder')";
			$row_other_size = mysqli_query($conn, $sql_other_size);
			$count_other_size = mysqli_fetch_assoc($row_other_size);
			$total_other_size = $count_other_size["total"];
			if($total_other_size > 100000000) { 
			    $total_other_size_in_GB = round(((($total_other_size/1000)/1000)/1000), 1);
			    $total_other_size_in_GB_ext = 'GB';
			} elseif($total_video_size < 100000000 && $total_other_size > 1000000) {
			    $total_other_size_in_GB = round(((($total_other_size/1000)/1000)), 1);
			    $total_other_size_in_GB_ext = 'MB';
			} else {
			    $total_other_size_in_GB = round(((($total_other_size/1000))), 1);
			    $total_other_size_in_GB_ext = 'KB';
			}
		?>
    		
    		<div class="media align-items-center mt-3" style="font-size:12px;">
    			<div class="fm-file-box bg-light-warning text-warning"><i class="bx bx-image"></i>
    			</div>
    			<div class="media-body ml-2">
    				<h6 class="mb-0">Other Files</h6>
    				<p class="mb-0"><?= $count_other_items_count["total"]; ?> files</p>
    			</div>
    			<h6 class="mb-0"><?= $total_other_size_in_GB; ?> <?= $total_other_size_in_GB_ext; ?></h6>
    		</div>
    	
    	</div>
    </div>
	
	<!--end navigation-->
</div>
<!--end sidebar-wrapper-->



