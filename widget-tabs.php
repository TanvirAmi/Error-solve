//First you have to go via ftp or cPanel;
///wp-content/themes/portal/includes/widgets

<?php
/**
 * Theme Junkie Tabs Widget
tabs
functions
css

 */
 
class TJ_Widget_Tabs extends WP_Widget {

	function TJ_Widget_Tabs() {
		$widget_ops = array('classname' => 'widget_tab', 'description' => __('Display an Ajax tabber with Popular Posts, Latest Posts, Recent Comments and Tags.','themejunkie'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('tab', __('ThemeJunkie - Tabs','themejunkie'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$popular_post_num = $instance['popular_post_num'];
		$recent_post_num = $instance['recent_post_num'];
		$recent_comment_num = $instance['recent_comment_num'];
		$avatar_size = $instance['avatar_size'];
		?>
<script type="text/javascript"> 
	$(document).ready(function(){//need jquery-ui.custom.min.js 1.8.5 suport
		$("#tabber").tabs();
	});
</script>
	<div id="tabber">
		<ul class="tabs">
			<li class="first"><a href="#popular-posts"><?php _e('Popular', 'themejunkie'); ?></a></li>
	        <li><a href="#recent-comments"><?php _e('Comments', 'themejunkie'); ?></a></li>
            <li><a href="#monthly-archives"><?php _e('Archives', 'themejunkie'); ?></a></li>
			<li><a href="#tag-cloud" class="border-none"><?php _e('Tags', 'themejunkie'); ?></a></li>
		</ul> <!--end .tabs-->
			
		<div class="clear"></div>
		<div class="inside">
			<div id="popular-posts">
				<ul>
                	<?php tj_popular_posts($popular_post_num); ?>
				</ul>			
		    </div> <!--end #popular-posts-->
		       
		    <div id="recent-comments"> 
		        <ul>
                    <?php tj_recent_comments($recent_comment_num); ?>                   
				</ul>	
		    </div> <!--end #recent-posts-->
		    
		    <div id="monthly-archives">  
				<ul>
                	<?php wp_get_archives('type=monthly&limit=12'); ?>
				</ul>
		    </div> <!--end #recent-comments-->
		      
			<div id="tag-cloud">
				<?php wp_tag_cloud('smallest=12&largest=20'); ?>
			</div> <!--end #tag-cloud-->
			
			<div class="clear"></div>
			
		</div> <!--end .inside -->
		
		<div class="clear"></div>
		
	</div><!--end #tabber -->

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['popular_post_num'] = $new_instance['popular_post_num'];
		$instance['recent_post_num'] =  $new_instance['recent_post_num'];
		$instance['recent_comment_num'] =  $new_instance['recent_comment_num'];
		$instance['avatar_size'] =  $new_instance['avatar_size'];
		return $instance;
	}

	function form( $instance ) { 
		$instance = wp_parse_args( (array) $instance, array( 'popular_post_num' => '10', 'recent_post_num' => '10', 'recent_comment_num' => '10', 'avatar_size' => '42' ) );
		$popular_post_num = $instance['popular_post_num'];
		$recent_post_num = format_to_edit($instance['recent_post_num']);
		$recent_comment_num = format_to_edit($instance['recent_comment_num']);
		$avatar_size = format_to_edit($instance['avatar_size']);
	?>
		<p><label for="<?php echo $this->get_field_id('popular_post_num'); ?>"><?php _e('Number of popular posts to show:','themejunkie'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('popular_post_num'); ?>" name="<?php echo $this->get_field_name('popular_post_num'); ?>" type="text" value="<?php echo $popular_post_num; ?>" /></p>
		        
		<p><label for="<?php echo $this->get_field_id('recent_comment_num'); ?>"><?php _e('Number of recent comments to show:','themejunkie'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('recent_comment_num'); ?>" value="<?php echo $recent_comment_num; ?>" /></p>
	<?php }
}

register_widget('TJ_Widget_Tabs');

?>
