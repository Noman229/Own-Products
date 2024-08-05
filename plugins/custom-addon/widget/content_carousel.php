<?php
    class Elementor_Content_Carousel extends \Elementor\Widget_Base {
        public function get_name() {
            return 'content_slider';
        }
        public function get_title() {
            return esc_html__( 'Content Carousel', 'custom-elementor-addon' );
        }
        public function get_script_depends() {
            return [ 'slick-js', 'custom-js' ];
        }
        public function get_style_depends() {
            return [ 'slick-css', 'slick-theme-css' ];
        }
        public function get_icon() {
            return 'eicon-featured-image';
        }
        public function get_categories() {
            return [ 'general' ];
        }
        public function get_keywords() {
            return [ 'Slider', 'Carousel' ];
        }
        protected function register_controls() {
            // Content Tab Start
            $this->start_controls_section(
                'section_title',
                [
                    'label' => esc_html__( 'Content List', 'custom-elementor-addon' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
            $this->add_control(
                'repeater_field',
                [
                    'label' => esc_html__( 'Items', 'custom-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => [
                        [
                            'name' => 'repeater_title',
                            'label' => esc_html__( 'Title', 'custom-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__( 'List Title', 'custom-elementor-addon' ),
                            'label_block' => true,
                        ],
                        [
                            'name' => 'content',
                            'label' => esc_html__( 'Content', 'custom-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::WYSIWYG,
                            'default' => esc_html__( 'List Content', 'custom-elementor-addon' ),
                            'show_label' => false,
                        ],
                        [
                            'name' => 'image',
                            'label' => esc_html__( 'Image', 'custom-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'default' => [
                                'url' => '',
                            ],
                        ],
                        [
                            'name' => 'link',
                            'label' => esc_html__( 'Link', 'custom-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::URL,
                            'default' => [
                                'url' => '',
                            ],
                        ],
                        [
                            'name' => 'link_text',
                            'label' => esc_html__( 'Link Text', 'custom-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__( 'Read more', 'custom-elementor-addon' ),
                        ],
                    ],
                    'default' => [
                        [
                            'repeater_title' => esc_html__( 'Title #1', 'custom-elementor-addon' ),
                            'content' => esc_html__( 'Content #1', 'custom-elementor-addon' ),
                            'image' => [
                                'url' => '',
                            ],
                            'link' => [
                                'url' => '',
                            ],
                            'link_text' => esc_html__( 'Read more', 'custom-elementor-addon' ),
                        ],
                    ],
                    'title_field' => '{{{ repeater_title }}}',
                ]
            );
            $this->end_controls_section();
            // Content Tab End

            // Style Tab Start
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
            // Style Tab End

        }

        protected function render() {
            $settings = $this->get_settings_for_display();
            
            if ( ! empty( $settings['repeater_field'] ) ) {
                echo '<div class="carousel-items">';
                foreach ( $settings['repeater_field'] as $item ) {
                    $image_url = ! empty( $item['image']['url'] ) ? $item['image']['url'] : '';
                    $link_url = ! empty( $item['link']['url'] ) ? $item['link']['url'] : '#';
                    $link_text = ! empty( $item['link_text'] ) ? $item['link_text'] : esc_html__( 'Read more', 'custom-elementor-addon' );
                    
                    echo '<div class="carousel-item">';
                    if ( $image_url ) {
                        echo '<div class="carousel-item-image"><img src="' . esc_url( $image_url ) . '" alt=""></div>';
                    }
                    echo '<div class="carousel-item-content">';
                    echo '<h3 class="carousel-item-title">' . esc_html( $item['repeater_title'] ) . '</h3>';
                    echo '<div class="carousel-item-text">' . wp_kses_post( $item['content'] ) . '</div>';
                    echo '</div>';
                    echo '<a href="' . esc_url( $link_url ) . '" class="carousel-item-link">' . esc_html( $link_text ) . '</a>';
                    echo '</div>';
                }
                echo '</div>';
            }
        }

        protected function content_template() {
            ?>
            <# var settings = view.model.get('settings');
            if ( settings.repeater_field && settings.repeater_field.length ) { #>
                <div class="carousel-items">
                    <# _.each( settings.repeater_field, function( item ) { #>                      
                        <div class="carousel-item">
                            <# if ( item.image.url ) { #>
                                <div class="carousel-item-image">
                                    <img src="{{ item.image.url }}" alt="">
                                </div>
                            <# } #>
                            <div class="carousel-item-content">
                                <h3 class="carousel-item-title">{{{ item.repeater_title }}}</h3>
                                <div class="carousel-item-text">{{{ item.content }}}</div>
                            </div>
                            <a href="{{ item.link.url || '#' }}" class="carousel-item-link">
                                {{{ item.link_text || 'Read more' }}}
                            </a>
                        </div>
                    <# }); #>
                </div>
            <# } #>
            <?php
        }
    }