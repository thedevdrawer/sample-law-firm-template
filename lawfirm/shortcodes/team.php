<?php
function team(){
    $query = new WP_Query(
        array(
            'post_type' => 'team',
            'post_status' => 'publish',
            'post_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'menu_order'
        )
    );
    $i = 1;
    $str = '<div class="elementor-row staff">';
    while ($query->have_posts()):
        $query->the_post();
        $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'team');
        $str .= '
        <div class="elementor-column elementor-col-33 elementor-top-column elementor-element" data-element_type="column">
            <div class="elementor-column-wrap">
                <div class="elemntor-widget-wrap">
                    <div class="image-wrapper">
                        <a href="'.get_the_permalink().'" title="'.get_the_title().'"><img src="'.$thumbnail.'" alt="'.get_the_title().'"></a>
                    </div>
                    <div class="team-member-info">
                        <h2><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>
                        <h3>'.do_shortcode('[acf field="title"]').'</h3>
                        <div>
                            <a href="mailto:'.do_shortcode('[acf field="email_address"]').'" title="Email '.get_the_title().'">'.do_shortcode('[acf field="email_address"]').'</a>
                        </div>
                        <div>
                            <a href="tel:'.do_shortcode('[acf field="phone_number"]').'" title="Call '.get_the_title().'">'.do_shortcode('[acf field="phone_number"]').'</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';


        if($i % 3 == 0):
            $str .= '</div>';
            $str .= '<div class="elementor-row">';
        endif;
        $i++;
    endwhile;
    
    wp_reset_postdata();
    return $str;
}

add_shortcode('team', 'team');