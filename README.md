# Russell Classes


## LAYOUTS

#### Main wrapper small-content left & large image right

	<div id="content" class="russell-content-wrapper russell-content-reverse">
		<section class="russell-content-large russell-content-image"></section>
		<section class="russell-content-small russell-content-area">
			<div>
			</div>
	        <div class="russell-copyright">
	            <?php russell_copyright(); ?>
	        </div>
		</section>
	</div>


#### Main wrapper large image left & small content right

	<div id="content" class="russell-content-wrapper">
		<section class="russell-content-small russell-content-area">
			<div>
			</div>
	        <div class="russell-copyright">
	            <?php russell_copyright(); ?>
	        </div>
		</section>
		<section class="russell-content-large russell-content-image"></section>
	</div>


#### Main wrapper full content only
	<div id="content" class="russell-content-wrapper">
		<section class="russell-content-full russell-content-area">
			<div>
			</div>
	        <div class="russell-copyright">
	            <?php russell_copyright(); ?>
	        </div>
		</section>
	</div>


## Elements

#### Main Page Title

	<h1 class="russell-site-title">
		<a href='#'>Title</a>
		<span>Description</span>
	</h1>
