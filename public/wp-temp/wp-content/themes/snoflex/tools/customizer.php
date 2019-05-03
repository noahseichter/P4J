<?php
add_action( 'customize_register', 'sno_remove_styles_sections', 20 );
function sno_remove_styles_sections(){
	global $wp_customize;
	$wp_customize->remove_section('title_tagline');
	$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_section('themes');
}

function sno_edit_admin_menus() {
    global $submenu;
    $submenu['themes.php'][6][0] = 'Customize Live';
    $submenu['themes.php'][6][2] = 'customize.php?return=%2Fwp-admin';
}
add_action( 'admin_menu', 'sno_edit_admin_menus' );

function snoflex_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'snoflex_carousels' , array(
    	'title'      => __( 'Header Area', 'snoflex' ),
    	'priority'   => 30,
	) );
	$wp_customize->add_setting( 'accentcolor-header' , array(
	    'default'     => '#990000',
        'sanitize_callback' => 'sanitize_hex_color',
	    'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accentcolor-header', array(
		'label'        => __( 'Header Color', 'snoflex' ),
		'section'    => 'snoflex_carousels',
		'settings'   => 'accentcolor-header',
	) ) );

	$wp_customize->add_setting('featured-cat', array(
  		'default'        => get_theme_mod('featured-cat'),
        'sanitize_callback' => 'example_sanitize_integer',
	));
	$wp_customize->add_control( 'featured-cat', array(
	  	'settings' => 'featured-cat',
	  	'label'    => 'Carousel Category',
	  	'section'  => 'snoflex_carousels',
	  	'type'     => 'select',
	  	'choices'  => sno_get_categories_select()
	));

// upload header graphic

$wp_customize->add_section(
    'header-image',
    array(
        'title'     => 'Header Image',
        'priority'  => 201
    )
);

$wp_customize->add_setting(
    'header-image',
    array(
        'default'      => '',
        'transport'    => 'refresh'
    )
);

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'header-image',
        array(
            'label'    => 'Header Image',
            'settings' => 'header-image',
            'section'  => 'header-image'
        )
    )
);	

// end header graphic

}
// add_action( 'customize_register', 'snoflex_customize_register' ); // uncomment to activate customizer controls
function sno_get_categories_select() {
  $teh_cats = get_categories();
  $results;
 
  $count = count($teh_cats);
  for ($i=0; $i < $count; $i++) {
    if (isset($teh_cats[$i]))
      $results[$teh_cats[$i]->cat_ID] = $teh_cats[$i]->name;
    else
      $count++;
  }
  return $results;
}

