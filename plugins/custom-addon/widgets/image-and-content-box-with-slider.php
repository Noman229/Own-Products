<?php

class Elementor_Image_And_Content_Box_With_Slider extends \Elementor\Widget_Base {
    public function get_name() {
        return 'image_and_content_box_with_slider';
    }

    public function get_title() {
        return esc_html__( 'Slider Box', 'custom-elementor-addon' );
    }

    public function get_icon() {
        return 'eicon-featured-image';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    public function get_keywords() {
        return [ 'Slider', 'Carousel' ];
    }

    protected function register_controls() {

        // Content Tab Start
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'custom-elementor-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater Field
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_title',
            [
                'label' => esc_html__( 'Title', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'custom-elementor-addon' ),
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Content goes here', 'custom-elementor-addon' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'repeater_field',
            [
                'label' => esc_html__( 'Repeater Field', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'repeater_title' => esc_html__( 'Title #1', 'custom-elementor-addon' ),
                        'content' => esc_html__( 'Content #1', 'custom-elementor-addon' ),
                        'image' => '',
                        'link' => '',
                    ],
                ],
                'title_field' => '{{{ repeater_title }}}',
            ]
        );

        $this->end_controls_section();
        // Content Tab End

        // Title Style Tab Start
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Title', 'custom-elementor-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_font_size',
            [
                'label' => esc_html__( 'Font Size', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-title' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_font_weight',
            [
                'label' => esc_html__( 'Font Weight', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '100' => '100',
                    '200' => '200',
                    '300' => '300',
                    '400' => '400',
                    '500' => '500',
                    '600' => '600',
                    '700' => '700',
                    '800' => '800',
                    '900' => '900',
                ],
                'default' => '400',
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-title' => 'font-weight: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_line_height',
            [
                'label' => esc_html__( 'Line Height', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'em', 'px' ],
                'range' => [
                    'em' => [
                        'min' => 1,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => 12,
                        'max' => 72,
                    ],
                ],
                'default' => [
                    'unit' => 'em',
                    'size' => 1.2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-title' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_letter_spacing',
            [
                'label' => esc_html__( 'Letter Spacing', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => -5,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                    'em' => [
                        'min' => -0.5,
                        'max' => 0.5,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-title' => 'letter-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Title Style Tab End

        // Content Style Tab Start
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'custom-elementor-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Color', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_font_size',
            [
                'label' => esc_html__( 'Font Size', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 14,
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-text' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_font_weight',
            [
                'label' => esc_html__( 'Font Weight', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '100' => '100',
                    '200' => '200',
                    '300' => '300',
                    '400' => '400',
                    '500' => '500',
                    '600' => '600',
                    '700' => '700',
                    '800' => '800',
                    '900' => '900',
                ],
                'default' => '400',
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-text' => 'font-weight: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Content Style Tab End

        // Image Style Tab Start
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => esc_html__( 'Image', 'custom-elementor-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_box_shadow',
            [
                'label' => esc_html__( 'Box Shadow', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::BOX_SHADOW,
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-image img' => 'box-shadow: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Image Style Tab End

        // Link Style Tab Start
        $this->start_controls_section(
            'section_link_style',
            [
                'label' => esc_html__( 'Link', 'custom-elementor-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => esc_html__( 'Link Color', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_hover_color',
            [
                'label' => esc_html__( 'Link Hover Color', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-item-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Link Style Tab End
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if ( ! empty( $settings['repeater_field'] ) ) {
            echo '<div class="slider-box carousel-items">';
            foreach ( $settings['repeater_field'] as $item ) {
                $image_url = ! empty( $item['image']['url'] ) ? $item['image']['url'] : '';
                $link_url = ! empty( $item['link']['url'] ) ? $item['link']['url'] : '#';
                
                echo '<div class="carousel-item">';
                if ( $image_url ) {
                    echo '<div class="carousel-item-image"><img src="' . esc_url( $image_url ) . '" alt=""></div>';
                }
                echo '<div class="carousel-item-content">';
                echo '<h3 class="carousel-item-title">' . esc_html( $item['repeater_title'] ) . '</h3>';
                echo '<p class="carousel-item-text">' . wp_kses_post( $item['content'] ) . '</p>';
                echo '</div>';
                echo '<a href="' . esc_url( $link_url ) . '" class="carousel-item-link">Read more</a>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
}

