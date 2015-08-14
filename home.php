<?php

get_header();

?>	
<div id="content" class="russell-content-wrapper russell-content-reverse">
	
	<section class="russell-content-large russell-content-image">
		
		<div class="russell-gallery">
			
			<?php
			$posts = russell_latest_post(); 
		
			$img = '';
			?>
		
			<div class="russell-gallery-left">
				
				<?php
				foreach ( $posts as $i => $post ) {
					foreach ( $post['categories'] as $tag) {
						if ( $i < count( $post ) ) {
							?><div class="gallery-image"><?php
							echo '<span class="image-title">' . $post['title'] . '</span>';
							$img = '<img src="' . $post['image'] . '"/>';
							echo $img;
							echo '<span class="image-tag">' . $tag . '</span>';
							?></div><?php
						}	
					}
				}		
				?>
			</div>
		
			<div class="russell-gallery-right">
				
				<?php
				foreach ( $posts as $i => $post ) {
					if ( $i + 1 > count( $post ) ) 
					{
						?><div class="gallery-image"><?php
						echo '<span class="image-title">' . $post['title'] . '</span>';
						$img = '<img src="' . $post['image'] . '"/>';
						echo $img;	
						echo '<span class="image-tag">' . $post['tags'] . '</span>';
						?></div><?php	
					}
				}
				?>
			</div>
		
		</div>
		
	</section>

	<section class="russell-content-small russell-content-area">

	    <div>
	
	        <h1 class="russell-site-title">
				<?php
		
				if ( function_exists( 'jetpack_the_site_logo' ) && function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {    
					jetpack_the_site_logo();
				} else {
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
					<?php
				}
		
				$description = get_bloginfo( 'description' );
				if ( ! empty( $description ) ) {
					?>
					<span><?php echo $description ?></span>
					<?php
				}
				?>
			</h1>
	
			<?php
		    if ( class_exists( 'TitanFramework' ) ) {
			    $titan = TitanFramework::getInstance( 'russell' ); 
			    echo wpautop( esc_attr( $titan->getOption( 'russell_site_elaboration' ) ) );
			} ?> 	
		
		</div>

	    <div class="russell-copyright">
	        <?php russell_copyright(); ?>
	    </div>

	</section><!-- .russell-content-small -->

</div><!-- .russell-content-wrapper -->
<?php

get_footer();