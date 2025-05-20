<?php
$dpsp_tab   = ( ! empty( $_GET['dpsp-tab'] ) ) ? strip_tags( $_GET['dpsp-tab'] ) : '';
$active_tab = ( ! empty( $dpsp_tab ) ? $dpsp_tab : 'dashboard' );

$dpsp_list_shares_selected = ( ! empty( $_GET['dpsp_list_shares'] ) ) ? strip_tags( $_GET['dpsp_list_shares'] ) : '';
$selected_list_shares = ( !empty( $dpsp_list_shares_selected ) ) ? $dpsp_list_shares_selected : 'most_shares';

$dpsp_list_attention_selected = ( ! empty( $_GET['dpsp_list_attention'] ) ) ? strip_tags( $_GET['dpsp_list_attention'] ) : '';
$selected_list_attention = ( ! empty( $dpsp_list_attention_selected ) ) ? $dpsp_list_attention_selected : 'social_information';

// Preload the lists
$preload_cached_posts_shares 	= dpsp_dashboard_get_post_list( $selected_list_shares );
$preload_cached_posts_attention = dpsp_dashboard_get_post_list( $selected_list_attention );

// Preload Hubbub settings
$settings = get_option( 'dpsp_settings', [] );

// Should we show saves count?
$show_saves_count = false;
?>

<div class="dpsp-page-wrapper dpsp-page-dashboard wrap">
	<input type="hidden" name="_wp_http_referer" value="<?=admin_url( 'admin.php?page=dpsp-dashboard' );?>">
	<h1><?php esc_html_e( 'Dashboard', 'social-pug' ); ?></h1>

	<!-- Navigation Tabs -->
	<div class="dpsp-card navigation">
		<ul class="dpsp-nav-tab-wrapper">
			<?php
			foreach ( $tabs as $tab_slug => $tab_name ) :
				
			?>
				<li class="dpsp-nav-tab <?php echo ( $tab_slug === $active_tab ? 'dpsp-active' : '' ); ?>" data-tab="<?php echo esc_attr( $tab_slug ); ?>">
					<a href="<?=admin_url( 'admin.php?page=dpsp-dashboard&dpsp-tab=' . $tab_slug );?>">
						<?php echo esc_attr( $tab_name ); ?>
				
						<?php if ( $tab_slug == 'find-fix' ) { ?>
							<span class="dpsp-tab-badge"><?php echo ( ! get_transient( 'dpsp_dashboard_count_requires_attention' ) ) ? 0 : number_format( get_transient( 'dpsp_dashboard_count_requires_attention' ), 0, '', ',' ); ?></span>
						<?php } ?>
					</a>
					
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<!-- Dashboard Tab Content -->
	<div id="dpsp-tab-dashboard" class="dpsp-tab <?php echo ( 'dashboard' === $active_tab ? 'dpsp-active' : '' ); ?>">

		<div class="dpsp-card-group">
			<!-- Latest News -->
			<div class="dpsp-card dpsp-card-news">

				<div class="dpsp-card-header">
					<?php esc_html_e( 'Latest News', 'social-pug' ); ?>
					<span class="social-network-icons"> 
						<span class="social-network-icon facebook">
							<a href="https://www.facebook.com/nerdpress.net" target="_blank" title="Follow NerdPress on Facebook">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 18 32"><path d="M17.12 0.224v4.704h-2.784q-1.536 0-2.080 0.64t-0.544 1.92v3.392h5.248l-0.704 5.28h-4.544v13.568h-5.472v-13.568h-4.544v-5.28h4.544v-3.904q0-3.328 1.856-5.152t4.96-1.824q2.624 0 4.064 0.224z"></path></svg>
							</a>
						</span>
						<span class="social-network-icon instagram">
							<a href="https://instagram.com/nerdpressteam" target="_blank" title="Follow NerdPress on Instagram">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 27 32"><path d="M18.272 16q0-1.888-1.312-3.232t-3.232-1.344-3.232 1.344-1.344 3.232 1.344 3.232 3.232 1.344 3.232-1.344 1.312-3.232zM20.736 16q0 2.912-2.048 4.992t-4.96 2.048-4.992-2.048-2.048-4.992 2.048-4.992 4.992-2.048 4.96 2.048 2.048 4.992zM22.688 8.672q0 0.672-0.48 1.152t-1.184 0.48-1.152-0.48-0.48-1.152 0.48-1.152 1.152-0.48 1.184 0.48 0.48 1.152zM13.728 4.736q-0.128 0-1.376 0t-1.888 0-1.728 0.064-1.824 0.16-1.28 0.352q-0.896 0.352-1.568 1.024t-1.056 1.568q-0.192 0.512-0.32 1.28t-0.192 1.856-0.032 1.696 0 1.888 0 1.376 0 1.376 0 1.888 0.032 1.696 0.192 1.856 0.32 1.28q0.384 0.896 1.056 1.568t1.568 1.024q0.512 0.192 1.28 0.352t1.824 0.16 1.728 0.064 1.888 0 1.376 0 1.344 0 1.888 0 1.728-0.064 1.856-0.16 1.248-0.352q0.896-0.352 1.6-1.024t1.024-1.568q0.192-0.512 0.32-1.28t0.192-1.856 0.032-1.696 0-1.888 0-1.376 0-1.376 0-1.888-0.032-1.696-0.192-1.856-0.32-1.28q-0.352-0.896-1.024-1.568t-1.6-1.024q-0.512-0.192-1.248-0.352t-1.856-0.16-1.728-0.064-1.888 0-1.344 0zM27.424 16q0 4.096-0.096 5.664-0.16 3.712-2.208 5.76t-5.728 2.208q-1.6 0.096-5.664 0.096t-5.664-0.096q-3.712-0.192-5.76-2.208t-2.208-5.76q-0.096-1.568-0.096-5.664t0.096-5.664q0.16-3.712 2.208-5.76t5.76-2.208q1.568-0.096 5.664-0.096t5.664 0.096q3.712 0.192 5.728 2.208t2.208 5.76q0.096 1.568 0.096 5.664z"></path></svg>
							</a>
						</span>
					</span>
				</div>

				<div class="dpsp-card-inner">

					<?php echo dpsp_dashboard_display_news( 10 ); ?>

				</div>
			</div> <!-- End Latest News -->
			
			<!-- Wide Ad -->
			<div class="dpsp-card dpsp-card-ad dpsp-card-ad-wide">

				<div class="dpsp-card-inner">
					<?php if ( Social_Pug::is_free() ) { ?>
						<script src="https://api.morehubbub.com/nan/?p=hubbub-lite&v=<?php echo HUBBUB_VERSION; ?>&d=<?php echo get_site_url(); ?>&s=300x250"></script>
					<?php } else { ?>
						<script src="https://api.morehubbub.com/nan/?p=hubbub-pro&v=<?php echo HUBBUB_VERSION; ?>&d=<?php echo get_site_url(); ?>&l=<?php get_option ( 'mv_grow_license_status' ); ?>&s=300x250"></script>
					<?php } ?>
				</div>

			</div> <!-- End Wide Ad -->
		</div>
		
		<div class="dpsp-card-group">
		<!-- Counts -->
		<div class="dpsp-card dpsp-card-counts">

			<div class="dpsp-card-inner">

				<div class="dpsp-counts-item">
					<h3>Total Shares</h3>
					<p><?php echo number_format( dpsp_show_total_count( 'dpsp_networks_shares_total' ), 0, '', ',' ); ?></p>
				</div>

				<div class="dpsp-counts-item">
					<h3>Total Saves</h3>
					<p><?php echo number_format( dpsp_show_total_count( 'dpsp_save_this_count' ), 0, '', ',' ); ?></p>
				</div>

				<div class="dpsp-counts-item warning">
					<h3>Missing Information</h3>

						<?php
						$missing_information_url = 'https://morehubbub.com/find-and-fix/?utm_source=hubbub_plugin&utm_medium=dashboard&utm_campaign=missing-information';
						$missing_information_target = "target=\"_blank\"";

						if ( ! \Social_Pug::is_free() ) {
							$hubbub_activation 	= new \Mediavine\Grow\Activation;
							$license_tier 		= $hubbub_activation->get_license_tier();

							if ( ! empty( $license_tier ) && $license_tier != 'pro' ) { 
								$missing_information_url = admin_url( 'admin.php?page=dpsp-dashboard&dpsp-tab=find-fix');
								$missing_information_target = '';
								$show_saves_count = true;
							}
						}
						 ?>
					<p><a href="<?=$missing_information_url;?>" <?=$missing_information_target;?>><?php
					echo ( ! get_transient( 'dpsp_dashboard_count_requires_attention' ) ) ? 0 : number_format( get_transient( 'dpsp_dashboard_count_requires_attention' ), 0, '', ',' );
					?></a></p>
				</div>

			</div>
		</div> <!-- End Counts -->

		<!-- Ad -->
		<div class="dpsp-card dpsp-card-ad">

			<div class="dpsp-card-inner">
				<?php if ( Social_Pug::is_free() ) { ?>
					<script src="https://api.morehubbub.com/nan/?p=hubbub-lite&v=<?php echo HUBBUB_VERSION; ?>&d=<?php echo get_site_url(); ?>&s=300x250"></script>
				<?php } else { ?>
					<script src="https://api.morehubbub.com/nan/?p=hubbub-pro&v=<?php echo HUBBUB_VERSION; ?>&d=<?php echo get_site_url(); ?>&l=<?php get_option ( 'mv_grow_license_status' ); ?>&s=300x250"></script>
				<?php } ?>
			</div>

		</div> <!-- End Ad -->

		</div> <!-- End card group -->

		<!-- Engagement Stats -->
		<div class="dpsp-card dpsp-card-list-shares">

			<div class="dpsp-card-header">
				<?php esc_html_e( 'Engagement Stats', 'social-pug' ); ?>

				<div class="dpsp-list-dropdown">
					<select id="dpsp_list_shares" name="dpsp_list_shares">
						<option value="most_shares" <?php echo ( $selected_list_shares=='most_shares') ? 'selected' : '';?>>Most Shares</option>
						<option value="most_saves" <?php echo ( $selected_list_shares=='most_saves') ? 'selected' : '';?>>Most Saves</option>
						<option value="recently_published" <?php echo ( $selected_list_shares=='recently_published') ? 'selected' : '';?>>Recently Published</option>
						<option value="fewest_shares" <?php echo ( $selected_list_shares=='fewest_shares') ? 'selected' : '';?>>Fewest Shares</option>
						<option value="fewest_saves" <?php echo ( $selected_list_shares=='fewest_saves') ? 'selected' : '';?>>Fewest Saves</option>
					</select>
				</div>
			</div>

			<div class="dpsp-card-inner">

			<?php $cached_posts = $preload_cached_posts_shares;

				if ( count( $cached_posts ) == 0 ) { ?>
				
					<p class="no-results"><?php esc_html_e('It looks like you might just be getting started. No posts to show here yet.', 'social-pug'); ?></p>

				<?php } else { ?>

					<table class="dpsp-table-shares" width="100%">
						<tr>
							<th></th>
							<th class="post-date"></th>
							<th class="shares">Shares</th>
							<th class="saves">Saves</th>
						</tr>
						<?php
						foreach( $cached_posts as $post ) : ?>
								<tr data-post-id="<?=$post['id'];?>">
									<td class="post-title"><a href="<?=$post['permalink'];?>" target="_blank"><?=$post['title'];?></a> <span class="edit"><a href="<?=admin_url( 'post.php?post=' . $post['id'] . '&action=edit' );?>" target="_blank"><span class="dashicons dashicons-edit"></span></a></span></td>
									<td class="post-date"><?=$post['post_date'];?></td>
									<td class="shares"><?=number_format( $post['shares_count'], 0, '', ',' );?></td>
									<td class="saves">
										<?php
										if ( $show_saves_count ) :
											echo number_format( $post['saves_count'], 0, '', ',' );
										else :
											echo '<a href="https://morehubbub.com/save-this/?utm_source=hubbub_plugin&utm_medium=dashboard&utm_campaign=share-padlocks" target="_blank" style="text-decoration: none;" title="Unlock Hubbub Save This by upgrading to Hubbub Pro+. Click to learn more.">🔒</abbr>';
										endif;
										?>
									</td>
								</tr>
						
						<?php

						endforeach; ?>
					</table>

					<?php if ( \Social_Pug::is_free() ) { ?>
					<p class="dpsp-engagement-stats-lite-notice">💡 Hubbub Lite shows only your top 10 posts—<a href="https://morehubbub.com/pricing/?utm_source=hubbub_plugin&utm_medium=dashboard&utm_campaign=lite-footer-upgrade" target="_blank">upgrade</a> to Pro for the top 50 (and a <em>ton</em> of additional features and settings), or go Pro+ to unlock <a href="https://morehubbub.com/save-this/?utm_source=hubbub_plugin&utm_medium=dashboard&utm_campaign=lite-footer-save-this" target="_blank">Save This</a> and <a href="https://morehubbub.com/find-and-fix/?utm_source=hubbub_plugin&utm_medium=dashboard&utm_campaign=lite-footer-find-and-fix" target="_blank">Find & Fix</a>!</p>
				<?php } ?>
				<?php } ?>
			</div>
		</div> <!-- End Shares and Saves -->

	</div> <!-- End Dashboard tab -->

	<!-- Missing Information Tab Content -->
	<div id="dpsp-tab-find-fix" class="dpsp-tab <?php echo ( 'find-fix' === $active_tab ? 'dpsp-active' : '' ); ?>">

		<!-- Require Attention -->
		<div class="dpsp-card dpsp-card-list-attention">

			<div class="dpsp-card-header">
				<?php esc_html_e( 'Missing Information', 'social-pug' ); ?>

				<div class="dpsp-list-dropdown">
					<select id="dpsp_list_attention" name="dpsp_list_attention">
						<option value="social_information" <?php echo ( $selected_list_attention=='social_information') ? 'selected' : '';?>>Missing Any Social Data</option>
						<option value="custom_title" <?php echo ( $selected_list_attention=='custom_title') ? 'selected' : '';?>>Missing Social Media Title</option>
						<option value="custom_description" <?php echo ( $selected_list_attention=='custom_description') ? 'selected' : '';?>>Missing Social Media Description</option>
						<option value="custom_image" <?php echo ( $selected_list_attention=='custom_image') ? 'selected' : '';?>>Missing Social Media Image</option>
						<option value="custom_image_pinterest" <?php echo ( $selected_list_attention=='custom_image_pinterest') ? 'selected' : '';?>>Missing Pinterest Image</option>
						<!-- TODO: Temporarily disabled <option value="featured_image" <?php echo ( $selected_list_attention=='featured_image') ? 'selected' : '';?>>Featured Image</option> -->
					</select>
					<input type="search" name="list-attention-search" id="dpsp_list_attention_search" placeholder="Or, search titles..." value="<?php echo isset( $_GET['dpsp_list_attention_search'] ) ? $_GET['dpsp_list_attention_search'] : '';?>">
					<button id="dpsp_button_attention_search">Search</button>
				</div>
			</div>

			<div class="dpsp-card-inner">

				<?php
				$cached_posts = $preload_cached_posts_attention;
				
				if ( count( $cached_posts ) == 0 ) { ?>
				
					<p class="no-results"><?php esc_html_e('Excellent job! All of your posts are in tip-top shape!', 'social-pug'); ?></p>

				<?php } else { ?>

					<table class="dpsp-table-attention" width="100%">
						<tr>
							<th class="missing">Missing</th>
							<th></th>
							<th class="post-date"></th>
							<th class="edit"></th>
						</tr>
						<?php

						$icons = [
							'custom_title',
							'custom_description',
							'custom_image',
							'custom_image_pinterest',
						];


						foreach( $cached_posts as $post ) :
							
							$icon_html = '';
							foreach( $icons as $icon ) {

								switch ( $icon ) {
									case 'custom_title':
										$alt = 'Social Media Title';
										break;
									case 'custom_description':
										$alt = 'Social Media Description';
										break;
									case 'custom_image':
										$alt = 'Social Media Image';
										break;
									case 'custom_image_pinterest':
										$alt = 'Pinterest Image';
										break;
								}


								$icon_html .= '<img src="' . DPSP_PLUGIN_DIR_URL . '/assets/dist/' . $icon . '.svg" width="25" ';
								$icon_html .= ( in_array( $icon, $post['missing_data'] ) ) ? 'class="inactive" alt="Missing ' . $alt . '" title="Missing ' . $alt . '" ' : 'alt="Has ' . $alt . '" title="Has ' . $alt . '" ';
								$icon_html .= '/>';
							}
							?>
							<tr>
								<td class="missing"><?=$icon_html;?></td>
								<td class="post-title"><a href="<?=$post['permalink'];?>" target="_blank"><?=$post['title'];?></a> <span class="edit"><a href="<?=admin_url( 'post.php?post=' . $post['id'] . '&action=edit' );?>" target="_blank"><span class="dashicons dashicons-edit"></span></a></span></td>
								<td class="post-date"><?=$post['post_date'];?></td>
								<td class="edit"><a href="#" data-post="<?=$post['id'];?>">Quick Edit</a></td>
							</tr>
						
						<?php

						endforeach; 
						?>
					</table>

					<?php
					// TODO: Move to a helper function
					$is_requires_attention_list = in_array($selected_list_attention, [
						'social_information',
						'custom_title',
						'custom_description',
						'custom_image',
						'custom_image_pinterest',
					], true);
					$transient_key 					= ( $is_requires_attention_list ) ? 'dpsp_dashboard_posts_requires_attention' : 'dpsp_dashboard_posts_' . $selected_list_attention;
					$cached_posts 					= json_decode( get_transient( $transient_key ), true, 5 );

					if ( $is_requires_attention_list && $selected_list_attention != 'social_information' ) : // Filter the list to only include the selected choice
						$filtered_cached_posts = array_filter( $cached_posts, function( $post ) use ( $selected_list_attention ) {	
							return isset( $post['missing_data'] ) && in_array( $selected_list_attention, $post['missing_data'] );
						});
						
						$cached_posts = array_values($filtered_cached_posts);
					endif;

					if ( $is_requires_attention_list && isset( $_GET['dpsp_list_attention_search'] ) ) {
						$filtered_cached_posts = array_filter( $cached_posts, function( $post ) {	
							return stripos($post['title'], $_GET['dpsp_list_attention_search'] ) !== false;
						});
						$cached_posts = array_values($filtered_cached_posts);
					}

					if ( count( $cached_posts ) > 50 && ! isset( $_GET['dpsp_display_all_posts'] ) ) { ?>
						<p style="text-align: center;"><a href="<?=dpsp_dashboard_output_show_all_posts_link();?>">show all <?php echo count($cached_posts);?> posts</a></p>
					<?php }
				}
			
				if ( isset( $settings['disable_meta_tags' ] ) ) { ?>
					<p class="dpsp-find-fix-metatags-disabled"><strong>Attention:</strong> Hubbub's Open Graph meta tags feature is currently disabled. This means the data you add to these fields isn't currently being used on your site. You can <a href="<?=admin_url( 'admin.php?page=dpsp-settings');?>">turn it back on in settings</a>.</p>
				<?php } ?>
			</div>
		</div> <!-- End Require Attention -->

		<div id="dpsp-attention-needed" class="dpsp-attention-needed hidden"></div>

	</div> <!-- End Missing Information Tab -->
	
	<?php echo \Mediavine\Grow\View_Loader::get_view( '/inc/views/made-with-love.php' ); ?>
</div>