<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
 
class Artisansweb_Testmonial_Widget extends \Elementor\Widget_Base {
  
    public function get_name() {
        return 'artisansweb-carousel';
    }
  
    public function get_title() {
        return __( 'Artisansweb Carousel', 'artisansweb-elementor-add-on' );
    }
  
    public function get_icon() {
        return 'fa fa-sliders';
    }
  
    public function get_categories() {
        return [ 'general' ];
    }
 
    public function get_script_depends() {
        wp_register_script("bootstrap-js", "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", array(), false, true);
         
        return [
            'bootstrap-js'
        ];
    }
 
    public function get_style_depends() {
        wp_register_style( "bootstrap-css", "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css", array(), false, "all" );
        return [
            'bootstrap-css'
        ];
    }
  
    protected function register_controls() {
  
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'artisansweb-elementor-add-on' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
  
        $repeater = new \Elementor\Repeater();
  
        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Title', 'artisansweb-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'List Title' , 'artisansweb-elementor-add-on' ),
                'label_block' => true,
            ]
        );
  
        $repeater->add_control(
            'list_image',
            [
                'label' => esc_html__( 'Choose Image', 'artisansweb-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
  
        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Repeater List', 'artisansweb-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Title #1', 'artisansweb-elementor-add-on' ),
                        'list_image' => esc_html__( 'Item image.', 'artisansweb-elementor-add-on' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Title #2', 'artisansweb-elementor-add-on' ),
                        'list_image' => esc_html__( 'Item image.', 'artisansweb-elementor-add-on' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'artisansweb-elementor-add-on' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .test' => 'color: {{VALUE}};',
				],
			]
		);
  
        $this->end_controls_section();
  
    }
      
    protected function render() {
        // generate the final HTML on the frontend using PHP
        $settings = $this->get_settings_for_display();
  
        if ( $settings['list'] ) {
            ?>
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php for($i=0; $i<count($settings['list']); $i++) { ?>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $i; ?>" <?php if($i==0){ ?> class="active" aria-current="true" <?php } ?>></button>
                    <?php } ?>
                </div>
                <div class="carousel-inner">
                    <?php $i = 0; ?>
                    <?php foreach (  $settings['list'] as $item ) { ?>
                        <div class="carousel-item <?php echo ($i==0) ? 'active':''; ?>">
                            <img class="d-block w-100" src="<?php echo $item['list_image']['url']; ?>" alt="<?php echo $item['list_title']; ?>" />
                            <div class="carousel-caption d-none d-md-block">
                                <h3 class="test"><?php echo $item['list_title']; ?></h3>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
            <?php
        }
    }
}
