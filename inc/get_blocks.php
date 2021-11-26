
<?php 
/* Functions for displaying blocks of content*/

function get_hero_carousel($id){
    if( have_rows('slides',$id) ):
        ?>
        <div class="swiper-hero">
            <div class="swiper-wrapper">
                <?php
                while( have_rows('slides',$id) ) : the_row();
                    ?><div class="swiper-slide">
                        <?php echo wp_get_attachment_image(get_sub_field('slider_image'), 'full'); ?>
                        <div class="slider-text">
                            <h2><?php echo get_sub_field('slider_text'); ?></h2>
                            <h2><?php echo get_sub_field('slider_text_line_two'); ?></h2>
                        </div>
                    </div><?php
                endwhile; 
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    <?php
    endif;
}

function get_home_layouts($id){
    if( have_rows('home_blocks',$id) ):
        while ( have_rows('home_blocks', $id) ) : the_row();
            if( 'image_text_block' ==get_row_layout() ):
                $styling = get_sub_field('styling');
                $class = $styling?'grid wild padding white ':'flex calm full blue bg'; ?>
                <section class="block image_text_block <?php echo $class; ?>">
                    <div class = "block_images">
                        <?php if($image_1 = get_sub_field('image_1')): ?>
                            <div class="block_images--large"><?php echo wp_get_attachment_image($image_1, 'large'); ?></div>
                        <?php endif; 
                        ?>
                        <?php if( $styling && get_sub_field('image_2')): ?>
                            <div class="block_images--large"><?php echo wp_get_attachment_image(get_sub_field('image_2'), 'large'); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="block_text">
                        <?php if($header = get_sub_field('header')): ?>
                            <h2><?php echo $header; ?></h2>
                        <?php endif; ?>
                        <?php if($text = get_sub_field('text')): ?>
                            <?php echo apply_filters('the_content',$text); ?>
                        <?php endif; ?>
                        <?php if(get_sub_field('button')): 
                            $link = get_sub_field('button');
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="decorative <?php echo $styling?'navy ':'white '; echo get_rand_shape_class(); ?>"><?php echo $link_title; ?></a>
                        <?php endif; ?>
                    </div>
                </section>
            <?php elseif( 'whats_on_block' == get_row_layout()): 
                $format = get_sub_field('whats_on_format');
                get_whatson_blocks($format);
            elseif( 'testimonial_block' == get_row_layout()): ?>
                <section class="block testimonial margins">
                    <div class="magenta <?php echo get_rand_shape_class(); ?> ">
                        <h3><?php echo get_sub_field('testimonial_text'); ?></h3>
                        <h4><?php echo get_sub_field('testimonial_author');?></h4>
                    </div>
                </section>
            <?php elseif( 'from_the_blog_block' == get_row_layout()): ?>
                <?php 
                    if(get_sub_field('featured_blog_post')){ 
                        $featured = get_sub_field('featured_blog_post')[0];
                        $posts = get_posts(array(
                            'numberposts'=>3,
                            'fields' => 'ids',
                            'exclude'=>array($featured)
                        ));
                    } 
                    else { 
                        $posts = get_posts(array(
                            'numberposts'=>4,
                            'fields' => 'ids',
                        ));
                        $featured = array_shift($posts);
                    } ?>
                <section class="block blog_block margins">
                    <h1>From the blog</h1>
                    <div class="flex flex_50">
                        <div class="green blog_item blog_item_featured">
                            <div class="image_container twothree image_bottom_slash">
                                <?php echo get_the_post_thumbnail($featured,'large'); ?>
                            </div>
                            <div class="text_container">
                                <h5><?php echo get_the_category($featured)[0]->name; ?></h5>
                                <h3><?php echo get_the_title($featured); ?></h3>
                                <p><?php echo get_the_excerpt($featured); ?></p>
                                <a href="<?php echo get_the_permalink($featured); ?>">Read more</a>
                            </div>
                        </div>
                        <div class="white">
                            <?php foreach($posts as $post_id){ ?>
                                <div class="blog_item">
                                    <div class="text_container">
                                            <h5><?php echo get_the_category($post_id)[0]->name; ?></h5>
                                            <h3><?php echo get_the_title($post_id); ?></h3>
                                            <p><?php echo get_the_excerpt($post_id); ?></p>
                                            <a href="<?php echo get_the_permalink($post_id); ?>">Read more</a>
                                    </div>
                                </div>
                            <?php } ?>
                            <a href="/posts" class="decorative purple <?php echo get_rand_shape_class(); ?>">View all posts</a>
                        </div>
                    </div>
                </section>
            <?php elseif( 'link_blocks' == get_row_layout()): ?>
                <section class="block link_block margins">
                    <?php if( have_rows('links',$id) ): ?>
                        
                        <div class="flex flex_30 link_items">
                            <?php while ( have_rows('links', $id) ) : the_row(); 
                                if (get_sub_field('link_title')):
                                    $title = get_sub_field('link_title');
                                else:
                                $postid = url_to_postid( get_sub_field('link'));
                                $title = get_the_title($postid);
                                endif; ?>
                                <div class="link_item white">
                                    <a href="<?php echo get_sub_field('link'); ?>">    
                                        <h2><?php echo $title; ?></h2>
                                       
                                    <p><?php echo get_sub_field('link_description'); ?></p>
                                    </a> 
                                    <a href="<?php echo get_sub_field('link'); ?>" class="decorative navy <?php echo get_rand_shape_class(); ?>">
                                        <?php echo get_sub_field('button_text'); ?>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </section>
            <?php elseif( 'media_embed_block' == get_row_layout()): ?>
                <section class="block media_block margins">
                    <div class="media_block_inner violet">
                        <div class="media_container">
                            <?php echo get_sub_field('embeddable_media'); ?>
                        </div>
                    </div>
                    <?php $media_caption = get_sub_field('media_caption'); 
                    if($media_caption){ ?>
                        <h4><?php echo $media_caption; ?></h4>
                    <?php } ?>
                </section>
            <?php endif;
        endwhile;
    endif;
}

function get_whatson_blocks($format){
    $whatson = get_page_by_path('whats-on');
    if ($whatson) {
        $whatson_id = $whatson->ID;
    }
    else{
        return;
    }
    $posts = get_field('events',$whatson_id);
    $class;
    $count;
    switch($format){
        case 'single':
            $class="single whatson_single";
            $decorative="right_slash";
            $count=1;
            break;
        case 'grid':
            $class="flex flex_30 whatson_grid";
            $decorative="bottom_slash";
            $count=6;
            break;
        case 'carousel':
            $class="carousel carousel--three_up whatson_carousel";
            $decorative="bottom_slash swiper-slide";
            $count=9;
            break;
    }
    if($posts){ ?>
        <section class="block whatson_block padding bg yellow">
            <h1>What's on</h1>
            <div class="<?php echo $class; ?>">
                <?php if($count>count($posts)){
                    $count = count($posts);
                }
                if($format == 'carousel'){
                    ?><div class="swiper-wrapper"><?php
                }
                for($i=0;$i<$count;$i++){ 
                    $event = get_event_fields($posts[$i]);?>
                    <div class="whatson_block_item white <?php echo $decorative; ?>">
                        <a href="<?php echo $event['permalink']; ?>">
                            <div class="image_container twothree image_bottom_slash">
                                <?php echo $event['thumbnail']; ?>
                            </div>
                        </a>
                        <div class="text_container">
                            <h4><?php echo $event['title']; ?></h4>
                            <p><strong><?php echo $event['sub_title']; ?></strong></p>
                            <p><?php echo $event['short_description']; ?></p>
                            <p class="date"><?php echo $event['date']; ?></p>
                        </div>
                        <a class="magenta decorative <?php echo get_rand_shape_class(); ?>" href="<?php echo $event['permalink']; ?>">
                            <?php echo $event['cta']; ?>
                        </a>
                    </div>
                <?php } 
                if($format == 'carousel'){
                    ?></div><div class="swiper-nav swiper-button-prev"></div><div class="swiper-nav swiper-button-next"></div><?php
                }?>
            </div> 
            <a href="/whats-on" class="white decorative <?php echo get_rand_shape_class(); ?>">
                View All
            </a>
        </section>
        <?php
    }
    else{
        return;
    }
}

function get_event_fields($id){
    $fields=array();
    $field['thumbnail']=get_the_post_thumbnail($id,'large');
    $field['title']=get_the_title($id);
    $field['sub_title']=get_field('sub_title',$id);
    $field['short_description']=get_field('short_description',$id);
    $field['date']=format_date_range($id);
    $field['highlight_text']=get_field('custom_highlighted_text',$id);
    $field['cta']=get_field('custom_call_to_action',$id);
    $field['featured']=get_field('featured_event',$id);
    $field['permalink']=get_the_permalink($id);
    return $field;
}


function get_filter_list($taxonomy){
    $filters = '<button class="filter white" data-id="reset" data-tax="reset">Everything</button>';
    $args = array(
        'taxonomy' => $taxonomy, 
    );
    $terms = get_terms($args);
    foreach($terms as $term){
        $filters.='<button class="filter white" data-id="'.$term->slug.'" data-tax="'.$term->taxonomy.'">'.$term->name.'</button>';
    }
    return $filters;
}

function get_whatson_response($filter=false){
    $id = get_page_by_path('whats-on');
    $events = get_field('events',$id);
    $cta_blocks = get_field('call_to_action_blocks',$id);
    $output ='';
    foreach($events as $event){
        if($filter){
            $terms = get_the_terms($event,'event-category');
            if(!$terms){
                continue;
            }
            $terms = array_map(function($n){return $n->slug;}, $terms);
            if(!in_array($filter,$terms)){
                continue;
            }
        }
        $fields = get_event_fields($event);
        $class='';
        if($fields['featured']){
            $class='featured blue';
            $image_class='image_right_slash';
        }
        else{
            $class='white bottom_slash';
            $image_class='image_bottom_slash';
        }
        $output.='<div class="event '.$class.'">';
        $output.='<a href="'.$fields['permalink'].'">
                    <div class="image_container twothree '.$image_class.' ">'
                        .$fields['thumbnail'].'
                    </div>'
                ;
        if($fields['highlight_text']){
            $output.='<div class="highlight_text magenta">'.$fields['highlight_text'].'</div>';
        }
        $output.='
                <div class="text_container">
                    <h3>'.$fields['title'].'</h3>
                    <p><strong>'.$fields['sub_title'].'</strong></p>
                    <p>'.$fields['short_description'].'</p>
                    <p class="date">'.$fields['date'].'</p>
                </div></a></div>';
    }
    if(empty($output)){
        $output='<h3 class="whatson_empty">Nothing to see here</h3>';
    }
    
   
    if($cta_blocks){
        $output.='<div class="cta_blocks flex">';
        foreach($cta_blocks as $key=>$block){ 
            if($key == 0){
                $class='green';
            }
            else{
                $class='pink';
            }
            $output.='<div class="cta '.$class.' bottom_slash">
                <div class="image_container twothree image_bottom_slash">'
                    .wp_get_attachment_image($block['image'],'large').
                '</div>
                <div class="text_container">
                    <h3>'.$block['title'].'</h3>'
                    .apply_filters('the_content',$block['description']).
                    '<a href="'.$block['link'].'" class="decorative white '.get_rand_shape_class().'">'
                        .$block['button_text'].
                    '</a>
                </div>
            </div>';
        }
        $output.='</div>';
    }
    return $output;
    
}

function get_breadcrumbs($id){
    $type=get_post_type($id);
    $output.='<a href="'.site_url().'">Home</a>';
    if('post'==$type){
        $output.=' > <a href="'.site_url().'/blog">Blog</a>';
    }
    elseif('event'==$type){
        $output.=' > <a href="'.site_url().'/whats-on">What\'s On</a>';
    }
    $output.=' > '.get_the_title();
    return $output;
}

function get_sidebar_blocks($id){
    if( have_rows('sidebar_blocks',$id) ):
        while ( have_rows('sidebar_blocks', $id) ) : the_row();
            if( 'text_block' == get_row_layout() ): ?>
                <div class="sidebar_block">
                    <h3><?php echo get_sub_field('title'); ?></h3>
                    <?php echo apply_filters('the_content', get_sub_field('info')); ?>
                    <?php if($link = get_sub_field('button')): ?>
                        <a href="<?php echo $link['url']; ?>" class="white decorative <?php echo get_rand_shape_class(); ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
                    <?php endif; ?>
                </div>
            <?php elseif( 'nav_block' == get_row_layout() ): ?>
                <?php if(get_sub_field('enable_nav_block')): ?>
                    <div class="sidebar_block nav_block">
                        <?php $layouts=get_field('content_blocks',$id); 
                        $duplicate_test = array();
                        foreach($layouts as $layout): 
                            if($duplicate_test[$layout['acf_fc_layout']]):
                                $duplicate_test[$layout['acf_fc_layout']]+=1;
                            else:
                                $duplicate_test[$layout['acf_fc_layout']]=1;
                            endif;
                            if('two_columns_with_headers'==$layout['acf_fc_layout']): 
                                ?>
                                <a href="#<?php echo $layout['acf_fc_layout'].'_'.$duplicate_test[$layout['acf_fc_layout']];?>"><?php echo $layout['header_1']; ?></a>
                                <a href="#<?php echo $layout['acf_fc_layout'].'_'.$duplicate_test[$layout['acf_fc_layout']];?>"><?php echo $layout['header_2']; ?></a>
                            <?php elseif('info_block'==$layout['acf_fc_layout']):
                                continue;
                            elseif('big_text_with_image'==$layout['acf_fc_layout']):
                                continue;
                            elseif('single_full_image'==$layout['acf_fc_layout']):
                                continue;
                            elseif('featured_post_or_page'==$layout['acf_fc_layout']):
                                continue;
                            elseif('related_events'==$layout['acf_fc_layout']): ?>
                                <a href="#<?php echo $layout['acf_fc_layout'].'_'.$duplicate_test[$layout['acf_fc_layout']];?>">Related Events</a>
                            <?php elseif('contact_forms'==$layout['acf_fc_layout']): ?>
                                <a href="#<?php echo $layout['acf_fc_layout'].'_'.$duplicate_test[$layout['acf_fc_layout']];?>"><?php echo ucfirst($layout['contact_form_type']); ?></a>
                            <?php else: ?>
                                <a href="#<?php echo $layout['acf_fc_layout'].'_'.$duplicate_test[$layout['acf_fc_layout']];?>"><?php echo $layout['title']; ?></a>
                            <?php endif;
                        endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php elseif( 'related_posts_list' == get_row_layout() ): ?>
                <div class="sidebar_block">
                    <h3>Related blog posts</h3>
                    <?php $related = get_sub_field('related_posts_from_the_blog');
                    foreach($related as $item): ?>
                        <a href="<?php echo get_permalink($item); ?>"><?php echo get_the_title($item); ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif;
        endwhile;
    endif;
}

function get_social_share($id){
    $current_url = get_permalink($id);
?>
    <div class="social_share">
            <p>Share</p>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_url; ?>" class="share--icon" target="_blank">
                <span class="screen-reader-text">Share on Facebook</span><img src="<?php echo site_url(); ?>/wp-content/themes/confetti/assets/fb.svg">
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo $current_url; ?>&text=" class="share--icon" target="_blank">
                <span class="screen-reader-text">Share on Twitter</span><img src="<?php echo site_url(); ?>/wp-content/themes/confetti/assets/twitter.svg">
            </a>
            <a href="whatsapp://send?text=<?php echo $current_url; ?>&text=" class="share--icon mobile-only" target="_blank">
                <span class="screen-reader-text">Share on Whatsapp</span><img src="<?php echo site_url(); ?>/wp-content/themes/confetti/assets/whatsapp.svg">
            </a>
    </div>
<?php
}

function get_content_blocks($id){
    $type = get_post_type($id);
    if( have_rows('content_blocks',$id) ):
        $duplicate_test = array();
        while ( have_rows('content_blocks', $id) ) : the_row();
            $layout_type = get_row_layout();
            if($duplicate_test[$layout_type]):
                $duplicate_test[$layout_type]+=1;
            else:
                $duplicate_test[$layout_type]=1;
            endif;
            $hash = $layout_type.'_'.$duplicate_test[$layout_type]; 
            if( 'info_block' == $layout_type ): ?>
                <div class="content_info padding wheat" id="<?php echo $hash; ?>">
                    <?php echo apply_filters('the_content',get_sub_field('info')); ?>
                </div>
            <?php elseif( 'gallery' == $layout_type ): ?>
                <div class="content_gallery padding <?php echo $type=='event'?'black':'wheat'; ?>" id="<?php echo $hash; ?>">
                    <h2><?php echo get_sub_field('title'); ?></h2>
                    <?php if(get_sub_field('description')): ?>
                        <div class="two_col">
                            <?php echo apply_filters('the_content',get_sub_field('description')); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(have_rows('carousel')): ?>
                        <div class="carousel carousel--one_up page_carousel">
                            <div class="swiper-wrapper">
                                <?php while(have_rows('carousel')): the_row(); ?>
                                    <div class="swiper-slide">
                                    <?php if(get_sub_field('image')):
                                        echo wp_get_attachment_image(get_sub_field('image'),'full');
                                    elseif(get_sub_field('embedded_media')): ?>
                                        <div class="media_container">
                                            <?php echo get_sub_field('embedded_media'); ?>
                                        </div>    
                                    <?php endif; 
                                    if(get_sub_field('caption')): ?>
                                        <p><?php echo get_sub_field('caption'); ?></p>
                                    <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                            <div class="swiper-nav swiper-button-prev"></div><div class="swiper-nav swiper-button-next"></div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php elseif( 'related_events' == $layout_type ): ?>
                <div class="content_related padding toothpaste" id="<?php echo $hash; ?>">
                    <h2>You may also like...</h2>
                    <?php $events = get_sub_field('events'); ?>
                    <div class="flex flex_30 whatson_grid">
                    <?php foreach($events as $event_id): 
                        $event = get_event_fields($event_id);?>
                        <div class="whatson_block_item white bottom_slash">
                            <a href="<?php echo $event['permalink']; ?>">
                                <div class="image_container twothree image_bottom_slash">
                                    <?php echo $event['thumbnail']; ?>
                                </div>
                            </a>
                            <div class="text_container">
                                <h4><?php echo $event['title']; ?></h4>
                                <p><strong><?php echo $event['sub_title']; ?></strong></p>
                                <p class="date"><?php echo $event['date']; ?></p>
                            </div>
                            <a class="magenta decorative <?php echo get_rand_shape_class(); ?>" href="<?php echo $event['permalink']; ?>">
                                <?php echo $event['cta']; ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                    <a href="/whats-on" class="white decorative <?php echo get_rand_shape_class(); ?>">
                        View All
                    </a>
                    </div>
                </div>
            <?php elseif( 'map' == $layout_type ): ?>
                <div class="content_map toothpaste padding both_slash" id="<?php echo $hash; ?>">
                    <div class="grid map-inner">
                        <h2><?php echo get_sub_field('title'); ?></h2>
                        <div class="map_text">
                            <?php echo apply_filters('the_content',get_sub_field('description')); ?>
                        </div>
                        <div class="media_container">
                            <?php echo get_sub_field('google_map_embed_url'); ?>
                        </div>
                    </div>
                </div>
            <?php elseif( 'two_columns_with_headers' == $layout_type ): ?>
                <div class="content_two_col_header margins white" id="<?php echo $hash; ?>">
                    <div class="grid two_col_inner">
                        <div class="col">
                            <h2><?php echo get_sub_field('header_1'); ?></h2>
                            <?php echo apply_filters('the_content', get_sub_field('text_1')); ?>
                        </div>
                        <div class="col">
                            <h2><?php echo get_sub_field('header_2'); ?></h2>
                            <?php echo apply_filters('the_content', get_sub_field('text_2')); ?>
                        </div>
                    </div>
                </div>
            <?php elseif( 'big_text_with_image' == $layout_type ): ?>
                <div class="content_text_image image_text_block grid wild padding white"  id="<?php echo $hash; ?>">
                    <div class = "block_images">
                        <div class="block_images--large"><?php echo wp_get_attachment_image(get_sub_field('image'), 'large'); ?></div>
                    </div>
                    <div class="block_text">
                        <?php if($text = get_sub_field('text')): ?>
                            <?php echo apply_filters('the_content',$text); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php elseif( 'contact_forms' == $layout_type ): ?>
                <div class="content_contact margins white"  id="<?php echo $hash; ?>">
                    <?php $contact_type = get_sub_field('contact_form_type');
                    if('contact'==$contact_type): ?>
                        <h2>Contact us</h2>
                        <address>
                            <p><?php echo get_field('address','option'); ?></p>
                            <p></p>
                            <p><a href="tel:<?php echo get_field('phone_number','option'); ?>"><?php echo get_field('phone_number','option'); ?></a></p>
                            <p><a href="mailto:<?php echo get_field('email_address','option'); ?>"><?php echo get_field('email_address','option'); ?></a></p>
                            <p></p>
                            <p><?php echo get_field('opening_hours','option'); ?></p>
                        </address>
                        <?php echo do_shortcode('[contact-form-7 id="192" title="Contact Us"]');
                    elseif('venue'==$contact_type): ?>
                        <h2>Venue hire</h2>
                        <address>
                            <p><?php echo get_field('address','option'); ?></p>
                            <p></p>
                            <p><a href="tel:<?php echo get_field('phone_number','option'); ?>"><?php echo get_field('phone_number','option'); ?></a></p>
                            <p><a href="mailto:<?php echo get_field('email_address','option'); ?>"><?php echo get_field('email_address','option'); ?></a></p>
                        </address>
                       <?php echo do_shortcode('[contact-form-7 id="191" title="Venue Hire"]');
                    elseif('newsletter'==$contact_type):
                        ?>
                        <button id="newsletter_trigger-2" class="large_button gold <?php echo get_rand_shape_class(); ?>"  aria-controls="pb_signup_container" aria-expanded="false" >Sign up to our newsletter</button>
                        <?php
                    endif;
                    ?>
                </div>
            <?php elseif( 'grid_of_images' == $layout_type ): ?>
                <div class="content_grid padding green"  id="<?php echo $hash; ?>">
                    <h2><?php echo get_sub_field('title'); ?></h2>
                    <div class="content_grid_inner grid">
                        <?php $images = get_sub_field('images'); 
                        foreach($images as $image): ?>
                            <div class="content_grid_item">
                                <div class="image_container round">
                                    <?php echo wp_get_attachment_image($image,'medium'); ?>
                                </div>
                                <h4><?php echo wp_get_attachment_caption( $image); ?></h4>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php elseif( 'featured_post_or_page' == $layout_type ):
                $post_id = get_sub_field('featured')[0];
                $permalink = get_permalink($post_id);
                ?>
                <div class="single whatson_single white" id="<?php echo $hash; ?>">
                    <div class="whatson_block_item blue">
                        <a href="<?php echo $permalink; ?>">
                            <div class="image_container twothree image_right_slash">
                                <?php echo get_the_post_thumbnail($post_id,'large') ?>
                            </div>
                        </a>
                        <div class="text_container">
                            <h4><?php echo get_sub_field('title')?get_sub_field('title'):get_the_title($post_id); ?></h4>
                            <p><?php echo apply_filters('the_content',get_sub_field('description')); ?></p>
                            <a class="white decorative <?php echo get_rand_shape_class(); ?>" href="<?php echo $permalink; ?>">
                                <?php echo get_sub_field('button_text'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif;
        endwhile;
    endif;
}
