<?php
# 
# rt-theme
# post content for standart post types in listing pages
# 
global $rt_list_style, $more, $rt_global_post_values, $rt_is_template_builder;

//extract global values 
extract( $rt_global_post_values );

// Create thumbnail image
if( $featured_image_single_page ){
	if( ! $featured_image_same_single_page ){
		$featured_image_width = $max_image_width;
		$featured_image_height = 10000;	
		$crop = false;
		$featured_image_position = "center";	
	}

	// Create thumbnail image
	$thumbnail_image_output = ! empty( $featured_image_id ) ? get_resized_image_output( array( "image_url" => "", "image_id" => $featured_image_id, "w" => $featured_image_width, "h" => $featured_image_height, "crop" => $crop ) ) : ""; 

	// Tiny image thumbnail for lightbox gallery feature
	$lightbox_thumbnail = ! empty( $featured_image_id ) ? rt_vt_resize( $featured_image_id, "", 75, 50, true ) : rt_vt_resize( $featured_image_id, "", 75, 50, true ); 
	$lightbox_thumbnail = is_array( $lightbox_thumbnail ) ? $lightbox_thumbnail["url"] : "" ; 
}else{
	$thumbnail_image_output = "";		
}
?> 
	
<!-- blog box-->
<article itemscope itemtype="http://schema.org/Article" class="blog_list single" id="post-<?php the_ID(); ?>">

	<?php if( ! is_attachment() ): ?>
		<?php if( $rt_list_style == "style1" ):?>
		<section class="first_section">     
			<div class="date_box"><span class="day"><?php the_time("d") ?></span><span class="year"><?php the_time("M") ?> <?php the_time("Y") ?></span></div>
		</section> 
		<?php endif;?>


		<section class="article_info article_section <?php if( $rt_list_style != "style1" ):?>with_icon<?php endif;?>">
			
			<div class="blog-head-line clearfix">    

				<div class="post-title-holder">

					<!-- blog headline-->
					<?php if( $rt_list_style == "style2" ):?><h1 class="icon-pencil"><?php else:?><h1><?php endif;?><?php the_title(); ?></h1> 
					<!-- / blog headline--> 
	 
					<?php do_action( "post_meta_bar" )?>

				</div><!-- / end div  .post-title-holder -->
				
			</div><!-- / end div  .blog-head-line -->  

		</section> 
	<?php endif;?>


	<section itemprop="articleBody" class="article_content clearfix">

		<?php
		if( ! empty( $thumbnail_image_output ) && $featured_image_single_page ):?>
			<!-- image -->
			<div class="imgeffect align<?php echo $featured_image_position;?>"> 

					<?php 
						//create lightbox link
						do_action("create_lightbox_link",
							array(
								'class'          => 'icon-zoom-in lightbox_ single',
								'href'           => $featured_image_url,
								'title'          => __('Enlarge Image','rt_theme'),
								'data_group'     => 'image_'.$featured_image_id,
								'data_title'     => $title,													
								'data_thumbnail' => $lightbox_thumbnail,
							)
						);
					?> 

					<?php echo $thumbnail_image_output; ?>

			</div>
		<?php endif;?>
 

		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

		<?php do_action( "post_tag_bar" )?>

	</section> 

</article> 
<!-- / blog box-->

<?php if( $rt_is_template_builder && get_option( RT_THEMESLUG ."_hide_author_info" ) ):?>
	<?php get_template_part("author","bio"); ?>
<?php endif;?>