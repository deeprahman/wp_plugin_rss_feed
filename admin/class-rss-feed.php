<?php

class RSS_Feed_Generator extends WP_Widget
{
    function __construct(){
        $widget_ops =[
            'classname' => 'boj_awe_widget_class',
            'description' => 'Display an RSS feed with options'
        ];
        parent::__construct(
            'boj_awe_widget',
            'YYYYYYYYYYYYY',
            $widget_ops
        );
    }

    public function form($instance){
        $defaults = [
            'title' => 'RSS Feed',
            'rss_feed' => 'http://strangeword.com/feed',
            'rss_items' => '2',
            'rss_date' => '',
            'rss_summary' => ''
            
        ];

        $instance = wp_parse_args(
            (array) $instance,
            $defaults
        );
        $title= $instance['title'];
        $rss_feed = $instance['rss_feed'];
        $rss_items = $instance['rss_items'];
        $rss_date = $instance['rss_date'];
        $rss_summary = $instance['rss_summary'];
        ?>
        <p>TItle:
            <input type="text" class="widefat" name="<?= $this->get_field_name('title')?>" value="<?= esc_attr($title)?>"> 
        </p>
        <p>
        RSS Feed:
            <input type="text" class="widefat" name="<?= $this->get_field_name('rss_feed')?>" value="<?= esc_attr($rss_feed)?>">
        </p>
        <p>Items To Display:
            <select name="<?= $this->get_field_name('rss_item')?>" id="">
                <option value="1" <?php selected($rss_items,1)?>>1</option>
                <option value="2" <?php selected($rss_items,2)?>>2</option>
                <option value="3" <?php selected($rss_items,3)?>>3</option>
                <option value="4" <?php selected($rss_items,4)?>>4</option>
                <option value="5" <?php selected($rss_items,5)?>>5</option>
            </select>
        </p>
        <p>
        Show Date?:
        <input type="checkbox" name="<?= $this->get_field_name('rss_date')?>" <?php checked($rss_date, 'on')?>>
        </p>
        <p>
        Show Summary?:
        <input type="checkbox" name="<?= $this->get_field_name('rss_summary')?>" id="" <?php checked($rss_summary, 'on')?>>
        </p>
        <?php
    }
    public function update( $new_instance, $old_instance ){
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['rss_feed'] = strip_tags( $new_instance['rss_feed'] );
        $instance['rss_items'] = strip_tags( $new_instance['rss_items'] );
        $instance['rss_date'] = strip_tags( $new_instance['rss_date'] );
        $instance['rss_summary'] = strip_tags( $instance['rss_summary'] );

        return $instance;
    }

    public function widget( $args, $instance ){
        extract ($args);

        echo $before_widget;

        //Load the widget settings
        $title = apply_filters( 'widget_title', $instance['title'] );
        $rss_feed = empty( $instance['rss_feed'] ) ? '' : $instance['rss_feed'];
        $rss_items = empty( $instance['rss_items'] ) ? '2' : $instance['rss_items'];
        $rss_date = empty( $instance['rss_date'] ) ? 0 : $instance['rss_date'];
        $rss_summary = empty( $instance['rss_summery'] ) ? 0 : $instance['rss_summary'];

        if( ! empty( $title ) ){
            echo $before_title.$title.$after_title;
        }
        if( $rss_feed ){
            //Display the RSS feed
            wp_widget_rss_output([
                'url' => $rss_feed,
                'title' => $title,
                'items' => $rss_items,
                'show_summery' => $rss_summary,
                'show_author' => 0,
                'show_date' => $rss_date
            ]);
        }

        echo $after_widget;
    }
}