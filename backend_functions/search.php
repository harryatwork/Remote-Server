<?php include("../db.php");

    $search = $_POST["search"];

    $sql_search = "SELECT * FROM items WHERE name LIKE '%$search%' AND state = 'Live'";
	$result_search = $conn->query($sql_search);
	if ($result_search->num_rows > 0) {   
	while($row_search = $result_search->fetch_assoc()) {
		$id = $row_search["id"];
		$name = $row_search["name"];
		$type = $row_search["type"];
		$parent = $row_search["parent"];
		$bywhom = $row_search["bywhom"];
		$date = date_create($row_search["date"]);
		$date_formated = date_format($date,"M-d,Y");  

        $sql_search_parent = "SELECT * FROM items WHERE id = '$parent'";
    	$result_search_parent = $conn->query($sql_search_parent);
    	if ($result_search_parent->num_rows > 0) {   
    	while($row_search_parent = $result_search_parent->fetch_assoc()) {
    		$name_parent = $row_search_parent["name"];
    		$id_parent = $row_search_parent["id"];

    		$name_parent_to_root = '../'.$name_parent;
    		
    	} } else {
    	    $id_parent = 0;
    	    $name_parent_to_root = 'Home';
    	}
    	
    	$sql_search_bywhom = "SELECT * FROM subadmin WHERE id = '$bywhom'";
    	$result_search_bywhom = $conn->query($sql_search_bywhom);
    	if ($result_search_bywhom->num_rows > 0) {   
    	while($row_search_bywhom = $result_search_bywhom->fetch_assoc()) {
    		$name_bywhom = $row_search_bywhom["name"];
    	} } else { }
		
		if($type == 'Folder') {
		    $icon = '<i class="fadeIn animated bx bx-folder"></i>';
		    $link = 'search?f='.$id.'&/'.$name;
		} elseif($type == 'Image' || $type == 'Png' || $type == 'Jpeg' || $type == 'Jpg' || $type == 'Gif') {
		    $icon = '<i class="fadeIn animated bx bx-image"></i>';
		    $link = 'search?f='.$id.'&/'.$name_parent;
		} elseif($type == 'Video' || $type == 'Mp4' || $type == 'Webm' || $type == 'ogg') {
		    $icon = '<i class="fadeIn animated bx bx-video"></i>';
		    $link = 'search?f='.$id.'&/'.$name_parent;
		} elseif($type == 'Doc' || $type == 'Docx' || $type == 'Txt') { 
		    $icon = '<i class="fadeIn animated bx bx-text"></i>';
		    $link = 'search?f='.$id.'&/'.$name_parent;
		} elseif($type == 'Excel' || $type == 'Xls' || $type == 'Xlsx') { 
		    $icon = '<i class="fadeIn animated bx bx-spreadsheet"></i>';
		    $link = 'search?f='.$id.'&/'.$name_parent;
		} else { 
		    $icon = '<i class="lni lni-folder"></i>';
		    $link = 'search?f='.$id.'&/'.$name_parent;
		}
?>		
	<a class="search_results_indi" href="<?= $link; ?>" style="display: block;padding: 5px 15px;line-height: 30px;font-size: 16px;border-bottom: 1px solid #5d787c;">
	    <div>
	        <span><?= $icon; ?></span> <?= $name; ?>
	    </div>
	    <div>
	        <div style="display: inline-block;font-size: 12px;"><?= $name_parent_to_root; ?>/</div>
	        <div style="display: inline-block;float: right;font-size: 12px;">By <?= $name_bywhom; ?> - <?= $date_formated; ?></div>
	    </div>
	</a>

<?php } } else { } ?>
