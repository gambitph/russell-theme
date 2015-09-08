<?php
$posts = russell_large_content();
?>	
<div class="russell-gallery-left">
	
	<?php
	foreach ( $posts as $i => $post ) {
		if ( ! empty ( $post['categories'] ) ) {
			$link = '';
			
				if ( $i < count( $post ) ) {
					?><div class="gallery-image"><?php
					echo '<span class="image-title">' . $post['title'] . '</span>';
					echo '<a href="' . $post['link'] . '"><img src="' . $post['image'] . '"></a>';
					echo "<ul class='russell-catlist'>";
		
					foreach ( $post['categories'] as $category) {	
						$id = get_cat_ID( $category );
						$link = get_category_link( $id );
						$a = explode( ", ", $category );
						foreach ( $a as $b ) {	
							echo '<li><a href=' . $link . '>' . $b . '</a></li>';
						}	
					}
					
					echo "</ul>";
					?></div><?php
				}
		}
	}
	?>
</div>

<div class="russell-gallery-right">
	
	<?php
	foreach ( $posts as $i => $post ) {
		if ( $i + 1 > count( $post ) ) {
			?><div class="gallery-image"><?php
			echo '<span class="image-title">' . $post['title'] . '</span>';
			echo '<a href="' . $post['link'] . '"><img src="' . $post['image'] . '"></a>';
			echo "<ul class='russell-catlist'>";
			foreach ( $post['categories'] as $category) {
				$id = get_cat_ID( $category );
				$link = get_category_link( $id );
				$a = explode( ", ", $category );
				foreach ( $a as $b ) {
					echo '<li><a href=' . $link . '>' . $b . '</a></li>';
				}
			}
		echo "</ul>";
			?></div><?php	
		}
	}
	?>
</div>