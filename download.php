<?php ob_start();
      include("db.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Vdofy</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.pngs" type="image/png" />
	<!-- Vector CSS -->
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&amp;family=Roboto&amp;display=swap" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="assets/css/app.css" />
	
	
	<link href="assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
	<link href="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
	
	
</head>


<!--sidebar-wrapper-->
<div class="sidebar-wrapper" data-simplebar="true" style="height: 0%;">
	<div class="sidebar-header">
		<div class="" style="width: 100%;text-align: center;">
			<img src="assets/images/general/logo.png" class="logo-icon-2" alt="" style="width:100px;" />
		</div>
	</div>
	<!--navigation-->
	
	<!--end navigation-->
</div>
<!--end sidebar-wrapper-->







<header class="top-header">
	<nav class="navbar navbar-expand">
		<div class="right-topbar ml-auto">
			<ul class="navbar-nav">
				<li class="nav-item search-btn-mobile">
					<a class="nav-link position-relative" href="javascript:;">	
					<i class="bx bx-search vertical-align-middle"></i></a>
				</li>

				<li class="nav-item dropdown dropdown-user-profile">
					<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
						<div class="media user-box align-items-center">
							<div class="media-body user-info">
								<p class="user-name mb-0"></p>
							</div>
							<span class="user-img" style="padding: 16px;display: inline-flex;align-items: center;">U</span>
							<!--<img src="assets/images/avatars/avatar-1.png" class="user-img" alt="user avatar">-->
						</div>
					</a>
				</li>
			</ul>
		</div>
	</nav>
</header>

<?php
    $full_url = 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; 
    $current_folder = explode("/", $full_url);
    $current_folder = end($current_folder);
?>

<body class="bg-theme bg-theme1">
    <div class="wrapper">
        
        <div class="page-content-wrapper" style="margin-left: 0;">
				<div class="page-content">

					<div class="row">
						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="row mt-3">
										
									<?php
                        			    $sql_folders = "SELECT * FROM items WHERE timestamp = '$current_folder' AND state = 'Live'";
                                    	$result_folders = $conn->query($sql_folders);
                                    	if ($result_folders->num_rows > 0) {   
                                    	while($row_folders = $result_folders->fetch_assoc()) {
                                    		$folders_id = $row_folders["id"];
                                    		$folders_name = $row_folders["name"];
                                    		$file_name = $row_folders["file_name"];
                                    		$folders_type = $row_folders["type"];
                                    		$folders_parent = $row_folders["parent"];
                                    		$folders_state = $row_folders["state"];
                                    		$folders_size = $row_folders["size"];
                                    		$folders_timestamp = $row_folders["timestamp"];
                                    ?>
										
										<div class="col-12 col-lg-3 item">
										  <a <?php if($folders_type == 'Folder' || $folders_type == 'DropBox'){ ?> href="download_sub?/<?= $folders_timestamp; ?>/<?= $folders_id; ?>" 
										     <?php } elseif($folders_type == 'Image' || $folders_type == 'Png' || $folders_type == 'Jpeg' || $folders_type == 'Jpg' || $folders_type == 'Gif') { ?> id="item_href" data-toggle="modal" data-target="#exampleModal8" data-type="image" data-img="<?= $file_name; ?>" 
										     <?php } elseif($folders_type == 'Video' || $folders_type == 'Mp4' || $folders_type == 'Webm' || $folders_type == 'Mov') { ?> id="item_href" data-toggle="modal" data-target="#exampleModal8" data-type="video" data-img="<?= $file_name; ?>" 
										     <?php } elseif($folders_type == 'Pdf' || $folders_type == 'pdf') { ?> id="item_href" data-toggle="modal" data-target="#exampleModal8" data-type="pdf" data-img="<?= $file_name; ?>"
										     <?php } elseif($folders_type == 'Ogg' || $folders_type == '3gp' || $folders_type == 'Mp3' || $folders_type == 'Wav') { ?> id="item_href" data-toggle="modal" data-target="#exampleModal8" data-type="video" data-img="<?= $file_name; ?>"  
										     <?php } else { ?> id="item_href" data-toggle="modal" data-target="#exampleModal8" data-type="other" data-img="<?= $file_name; ?>" <?php } ?> >
											<div class="card shadow-none" style="border-radius: 10px;cursor:pointer;">
											  <?php if($folders_type == 'Image' || $folders_type == 'Png' || $folders_type == 'Jpeg' || $folders_type == 'Jpg' || $folders_type == 'Gif') { ?>
											    <img src="files/<?= $file_name; ?>" class="" alt="user avatar" style="
                                                        width: 100%;
                                                        height: 120px;
                                                        border-top-left-radius: 10px;
                                                        border-top-right-radius: 10px;
                                                        object-fit: cover;
                                                ">
                                              <?php } else { } ?>
												<div class="card-body" data-item-id="<?= $folders_id; ?>" data-timestamp="<?= $folders_timestamp; ?>">
											  <?php if($folders_type == 'Image' || $folders_type == 'Png' || $folders_type == 'Jpeg' || $folders_type == 'Jpg' || $folders_type == 'Gif') { } else { ?>
											   
													<div class="d-flex align-items-center" style="text-align: center;">
														<div class="fm-icon-box" style="width: 100%;height: auto;padding: 10%;">
														  <?php if($folders_type == 'Video' || $folders_type == 'Mp4' || $folders_type == 'Webm' || $folders_type == 'ogg' || $folders_type == 'Mov') { ?>
														    <i class="fadeIn animated bx bx-video" style="font-size:65px;line-height: 1;"></i>
														  <?php } elseif($folders_type == 'Ogg' || $folders_type == '3gp' || $folders_type == 'Mp3' || $folders_type == 'Wav') { ?>
														    <i class="fadeIn animated bx bx-music" style="font-size:65px;line-height: 1;"></i>
														  <?php } elseif($folders_type == 'Doc' || $folders_type == 'Docx' || $folders_type == 'Txt') { ?>
														    <i class="fadeIn animated bx bx-text" style="font-size:65px;line-height: 1;"></i>
														  <?php } elseif($folders_type == 'Excel' || $folders_type == 'Xls' || $folders_type == 'Xlsx') { ?>
														    <i class="fadeIn animated bx bx-spreadsheet" style="font-size:65px;line-height: 1;"></i>
														  <?php } elseif($folders_type == 'DropBox') { ?>
														    <i class="fadeIn animated bx bx-cloud-upload" style="font-size:65px;line-height: 1;"></i>
														  <?php } else { ?>
														    <i class="lni lni-folder" style="font-size:65px;line-height: 1;"></i>
														  <?php } ?>
														</div>
													</div>
													
											  <?php } ?>
											  
													<span class="item_starred_span"></span>
													<h5 class="mt-3 mb-0 text-white" style="font-size: 14px;"><?= substr($folders_name, 0, 15); ?></h5>
													<p class="mb-1 mt-4 text-white" style="margin-top: 5px !important;">
													    <?php
                    										$sql_folder_items_count = "SELECT COUNT(*) AS total FROM items WHERE parent = '$folders_id'";
                    										$row_folder_items_count = mysqli_query($conn, $sql_folder_items_count);
                    										$count_folder_items_count = mysqli_fetch_assoc($row_folder_items_count);					
                    										
                    										$total_count_folder_items_sum = 0;
                    										$sql_folder_items_sum = "SELECT SUM(size) AS total FROM items WHERE parent = '$folders_id'";
                    										$row_folder_items_sum = mysqli_query($conn, $sql_folder_items_sum);
                    										$count_folder_items_sum = mysqli_fetch_assoc($row_folder_items_sum);
                    										$total_count_folder_items_sum_sub = $count_folder_items_sum["total"];
                    										$total_count_folder_items_sum = $total_count_folder_items_sum_sub + $total_count_folder_items_sum + $folders_size;
                    										
                    										if($total_count_folder_items_sum > 100000000) { 
                    										    $total_count_folder_items_sum_in_GB = round(((($total_count_folder_items_sum/1000)/1000)/1000), 1);
                    										    $total_count_folder_items_sum_in_GB_ext = 'GB';
                    										} elseif($total_count_folder_items_sum < 100000000 && $total_count_folder_items_sum > 1000000) {
                    										    $total_count_folder_items_sum_in_GB = round(((($total_count_folder_items_sum/1000)/1000)), 1);
                    										    $total_count_folder_items_sum_in_GB_ext = 'MB';
                    										} else {
                    										    $total_count_folder_items_sum_in_GB = round(((($total_count_folder_items_sum/1000))), 1);
                    										    $total_count_folder_items_sum_in_GB_ext = 'KB';
                    										}
                    									?>
													    <span> 
													    <?php if($folders_type == 'Folder') { ?>
													        <svg style="width: 15px;margin-right: 2px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>    
													        <?= $count_folder_items_count["total"]; ?> Items</span>  
													    <?php } else { } ?>
													    <span class="float-right">
													        <svg style="width: 15px;margin-right: 2px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
													        <?= $total_count_folder_items_sum_in_GB ?> <?= $total_count_folder_items_sum_in_GB_ext; ?></span>
													</p>
													<?php if($folders_type == 'Folder') { ?>
													    <a href="backend_functions/download_zip?folder=<?= $folders_id; ?>" target="_blank" class="btn btn-secondary m-1 px-5" style="width:100%;">Download</a>
													<?php } else { ?>
													    <a href="backend_functions/download_indi?folder=<?= $folders_id; ?>" target="_blank" class="btn btn-secondary m-1 px-5" style="width:100%;">Download</a>
													<?php } ?>
												</div>
											</div>
										  </a>
										</div>
										
									<?php } } else { } ?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
			
			
			<div class="modal fade" id="exampleModal8" tabindex="-1" aria-hidden="true" style="display: none;">
    			<div class="modal-dialog modal-dialog-centered">
    				<div class="modal-content">
    					<div class="">
    						<div class="card mb-0 preview_sub_div">
    							<img src="" class="card-img-top popup_img" alt="...">
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
			
        
<?php include("footer.php"); ?>

    </div>
    
<?php include("foot.php"); ?>

<?php include("script.php"); ?>

    </body>
</html>