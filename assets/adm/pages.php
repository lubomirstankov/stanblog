<?php 
$pages = $mysqli->query("SELECT * FROM stanblog_pages WHERE visible='1'");
while($row = $pages->fetch_assoc()) {
if (basename($_SERVER['REQUEST_URI']) == $row['page_link']) {
$current = "current_page_item";
} else {
$current = "";
}
?>
			<li class="<?php echo $current; ?>"><a href="<?php echo $row['page_link']; ?>"><?php echo $row['page_name']; ?></a></li>
        <?php
        }
        ?>