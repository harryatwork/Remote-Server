<?php include("head.php"); ?>

<?php include("menu.php"); ?>

<?php include("header.php"); ?>

<body class="bg-theme bg-theme1">
    <div class="wrapper">
        
        <div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3"> <i class="bx bx-home-alt"></i> Home</div>
						
						<div class="pl-3">
							<nav aria-label="breadcrumb">
							</nav>
						</div>
						
						<div class="pl-3" style="right: 4%;position: absolute;">
							<nav aria-label="breadcrumb">
							    <?php include("layout_view.php"); ?>
							</nav>
						</div>
					
					</div>
					<!--end breadcrumb-->

					<div class="row">
						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="row mt-3">
										
									<?php
                        			    $sql_folders = "SELECT * FROM items WHERE parent = 0 AND private = 1 AND bywhom = '$sub_id' AND state = 'Live'";
                                    	$result_folders = $conn->query($sql_folders);
                                    	if ($result_folders->num_rows > 0) {   
                                    	while($row_folders = $result_folders->fetch_assoc()) {
                                    		$folders_id = $row_folders["id"];
                                    		$folders_bywhom = $row_folders["bywhom"];
                                    		$folders_name = $row_folders["name"];
                                    		$file_name = $row_folders["file_name"];
                                    		$folders_type = $row_folders["type"];
                                    		$folders_parent = $row_folders["parent"];
                                    		$folders_state = $row_folders["state"];
                                    		$folders_size = $row_folders["size"];
                                    		$folders_timestamp = $row_folders["timestamp"];
                                    		$folders_undeletable = $row_folders["undeletable"];
                                        	$folders_private = $row_folders["private"];
                                    ?>
										
										<div class="col-12 col-lg-3 item <?php if($folders_type == 'Folder') { ?> item_holder <?php } else { } ?> ">
										  <a <?php if($folders_type == 'Folder' || $folders_type == 'DropBox'){ ?> href="folder?f=<?= $folders_id; ?>&/<?= $folders_name; ?>" 
										     <?php } elseif($folders_type == 'Image' || $folders_type == 'Png' || $folders_type == 'Jpeg' || $folders_type == 'Jpg' || $folders_type == 'Gif') { ?> id="item_href" data-toggle="modal" data-target="#exampleModal8" data-type="image" data-img="<?= $file_name; ?>" 
										     <?php } elseif($folders_type == 'Video' || $folders_type == 'Mp4' || $folders_type == 'Webm' || $folders_type == 'Mov' || $folders_type == 'Ogg') { ?> id="item_href" data-toggle="modal" data-target="#exampleModal8" data-type="video" data-img="<?= $file_name; ?>" 
										     <?php } elseif($folders_type == 'Mp3' || $folders_type == 'Ogg' || $folders_type == '3gp' || $folders_type == 'Wav') { ?> id="item_href" data-toggle="modal" data-target="#exampleModal8" data-type="video" data-img="<?= $file_name; ?>" 
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
                                              <div class="card-body" data-item-id="<?= $folders_id; ?>" data-timestamp="<?= $folders_timestamp; ?>" data-type="<?= $folders_type; ?>" data-bywhom="<?= $folders_bywhom; ?>" data-name="<?= $folders_name; ?>" date-deletable="<?= $folders_undeletable; ?>" style="padding: 8px 10px;">
                                              <?php } else { ?>
                                                <div class="card-body" data-item-id="<?= $folders_id; ?>" data-timestamp="<?= $folders_timestamp; ?>" data-type="<?= $folders_type; ?>" data-bywhom="<?= $folders_bywhom; ?>" data-name="<?= $folders_name; ?>" date-deletable="<?= $folders_undeletable; ?>" >
                                              <?php } ?>

											  <?php if($folders_type == 'Image' || $folders_type == 'Png' || $folders_type == 'Jpeg' || $folders_type == 'Jpg' || $folders_type == 'Gif') { } else { ?>
											   
													<div class="d-flex align-items-center" style="text-align: center;">
														<div class="fm-icon-box" style="width: 100%;height: auto;padding: 10%;">
														  <?php if($folders_type == 'Video' || $folders_type == 'Mp4' || $folders_type == 'Webm' || $folders_type == 'ogg') { ?>
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
											  
													
												<?php
												    $sql_starred = "SELECT * FROM starred WHERE sub_id = '$sub_id' AND item_id = '$folders_id' LIMIT 1";
                                                	$result_starred = $conn->query($sql_starred);
                                                	if ($result_starred->num_rows > 0) {   
                                                	while($row_starred = $result_starred->fetch_assoc()) {
                                                ?>
                                                    <span class="item_starred_span starred">
													    <img src="assets/images/general/star_gif.gif" style="position: absolute;top: 6%;right: 2%;width: 56px;">
													</span>
												<?php } } else { ?>
													<span class="item_starred_span"></span>
												<?php } ?>
													
												<?php if($folders_undeletable == 1) { ?>
												    <span class="item_undeletable_span starred">
												        <img src="assets/images/general/trash_no.png" style="position: absolute;top: 12%;right: 22%;width: 16px;">
												    </span>
												<?php } else { ?>
												        <span class="item_undeletable_span"></span>
												<?php } ?>
												
												<?php if($folders_private == 1) { ?>
													<span class="item_private_span starred">
													    <img src="assets/images/general/incognito.png" style="position: absolute;top: 12%;left: 13%;width: 18px;">
													</span>
												<?php } else { ?>
												    <span class="item_private_span"></span>
												<?php } ?>
													
													<h5 class="mt-3 mb-0 text-white item_name_<?= $folders_id; ?>" style="font-size: 14px;"><?= substr($folders_name, 0, 15); ?></h5>
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

<?php include("modals.php"); ?>

<?php include("script.php"); ?>

    </body>
</html>