<?php
/**
* Template Name: Test pruebas
*
* @package WooFramework
* @subpackage Template
*/
	// Para mostrar el contenido creado a partir de campos de grupos personalizados se usa la funcion: types_render_field()
	// Donde el primer parametro que recibe es el slug,
	// Y el segundo parametro que recibe es el id del post
	$file = types_render_field('documento', array( 'post_id' => $post2->ID ));


	//RECORDATORIO
	//GUIATE UNICAMENTE CON ESTAS DOS URLS, LA PRIMERA CONTIENE TODAS LAS FUNCIONES DE WORDPRESS Y LA SEGUNDA, UNA GUIA COMPLETA DEL LOOP Y DE COMO SACAR LOS POST A TRAVES DE LA TAXONOMIA

	//CON TODOS ESTOS EJEMPLOS NO HACE FALTA QUE MIRES A OTRO LADO MAS QUE AQUI MISMO ;)

	//UNA GRAN AYUDA PARA EL FUTURO DE ADANNUP

	//////////////// Lista de todas las funciones /////////////////
	//https://codex.wordpress.org/Function_Reference

	//////////////// Parametros para el loop ///////////////////////
	//https://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters


	///IMPORTANTE/////////////////////////////////
	//Para mostrar los campos de archivos y texto que se crearon a partir de campos personalizados, se usa la funcion de: types_render_field("documento")
	// En este ejemplo. "documento" es el nombre que le pusimos a nuestro grupo de campos personalizados.
	// Ahora bien si vas a meter la opcion de que se puedan meter multiples archivos en un solo grupo de campos personalizados, como el que se hizo para el portal de transparencia en intranet (ver imagen.png), debes hacer uso de programacion para hacer un implode de dichos archivos que se vayan agregando por que solo se guarda en la misma funcion como un solo string, si quieres separarlos usa un implode para separarlos y hacer un nuevo array, si tienes dudas, sigue el el codigo de: template_transparencia_intranet.php

	//types_render_field tambien lo usamos para el sitio de atlas, esta es una funcion propia del plugin Toolset

	////////////////////// get_post() ////////////////////////////
	echo '<h1>Post individuales (get_post)<h1>';

	echo '<h2>Normatividad</h2>';
	$post_normatividad = get_post(39910);
	echo $post_normatividad->post_title;
	echo get_edit_post_link( 39910 );

	echo '<h2>Entradas</h2>';
	$post_entradas = get_post(39853);
	echo $post_entradas->post_title;
	echo get_edit_post_link( 39853, '&amp;');

	echo '<h2>Transparencia</h2>';
	$post_Transparencia = get_post(37107);
	echo $post_Transparencia->post_title;

	echo '<h2>Documentos</h2>';
	$post_documentos = get_post(39628);
	echo $post_documentos->post_title;


	///////////////////////// get_posts() ///////////////////////////7
	echo '<br><h1>Obteniendo todos los posts (get_posts)</h1>';

	echo '<h2>Normatividad</h2>';
	$args = array(
		'posts_per_page'   => 10,
		'offset'           => 0,
		'category'         => '',
		'category_name'    => '',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'normatividad',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'author'	   => '',
		'author_name'	   => '',
		'post_status'      => 'publish',
		'suppress_filters' => true
	);
	$posts_array = get_posts( $args );

	foreach($posts_array as $post) {
		echo $post->post_title.'<br>';
	}



////////////////////// get_categories() /////////////////////////////////
// Trae unicamente las secciones padre
	echo '<br><h1>Obteniendo todos los categories (get_categories)</h1>';
$args_categories = array(
	'order_by'	=> 	'menu_order',
	'order'		=>	'ASC',
	'taxonomy'	=>	'accesoinfo',
	'parent'	=>	0,
	'hide_empty'=>	0
);

$categories = get_categories($args_categories);
print_r($categories);





////////////////////// get_terms() /////////////////////////////////
// Obtiene todas las secciones tanto padres como hijos
	echo '<br><h1>Obteniendo todos los terms (get_terms)</h1>';

	$get_terms_default_attributes = array (
            'taxonomy' => 'accesoinfo', //empty string(''), false, 0 don't work, and return empty array
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => true, //can be 1, '1' too
            'include' => 'all', //empty string(''), false, 0 don't work, and return empty array
            'exclude' => 'all', //empty string(''), false, 0 don't work, and return empty array
            'exclude_tree' => 'all', //empty string(''), false, 0 don't work, and return empty array
            'number' => false, //can be 0, '0', '' too
            'offset' => '',
            'fields' => 'all',
            'name' => '',
            'slug' => '',
            'hierarchical' => true, //can be 1, '1' too
            'search' => '',
            'name__like' => '',
            'description__like' => '',
            'pad_counts' => false, //can be 0, '0', '' too
            'get' => '',
            'child_of' => false, //can be 0, '0', '' too
            'childless' => false,
            'cache_domain' => 'core',
            'update_term_meta_cache' => true, //can be 1, '1' too
            'meta_query' => '',
            'meta_key' => array(),
            'meta_value'=> '',
    );

$terms = get_terms($get_terms_default_attributes);
print_r($terms);







////////Obteniendo los hijos de algun term/////////////////////////////////////////
echo '<br><h1>Obteniendo todos los terms hijos de Articulo 18 term_id = 10(get_terms)</h1>';

$get_terms_child = array (
    'taxonomy' => 'accesoinfo', //empty string(''), false, 0 don't work, and return empty array
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => true, //can be 1, '1' too
    'include' => 'all', //empty string(''), false, 0 don't work, and return empty array
    'exclude' => 'all', //empty string(''), false, 0 don't work, and return empty array
    'exclude_tree' => 'all', //empty string(''), false, 0 don't work, and return empty array
    'number' => false, //can be 0, '0', '' too
    'offset' => '',
    'fields' => 'all',
    'name' => '',
    'slug' => '',
    'hierarchical' => true, //can be 1, '1' too
    'search' => '',
    'name__like' => '',
    'description__like' => '',
    'pad_counts' => false, //can be 0, '0', '' too
    'get' => '',
    'child_of' => '10', //can be 0, '0', '' too
    'childless' => false,
    'cache_domain' => 'core',
    'update_term_meta_cache' => true, //can be 1, '1' too
    'meta_query' => '',
    'meta_key' => array(),
    'meta_value'=> '',
 );
$terms_child = get_terms($get_terms_child);
print_r($terms_child);




///////////////////////Obtener las publicaciones de los terms///////////////////////
echo '<br><h1>Obteniendo la publicaciones de los terms de un child term (Indicadores de gestion)(get_post)</h1>';

$args_child_post = array(
	'post_type' => 'documentos',
	'tax_query' => array(
		array(
			'taxonomy' => 'accesoinfo',
			'field'    => 'slug',
			'terms'    => 'aindicadores-de-gestion',
		),
	),
	'posts_per_page' => '-1'
);
$query = new WP_Query( $args_child_post );
if ( $query->have_posts() ) {
	// The Loop
	while ( $query->have_posts() ) {
		$query->the_post();
		echo '<li>' . get_the_title() . '</li>';
	}

	/* Restore original Post Data
	 * NB: Because we are using new WP_Query we aren't stomping on the
	 * original $wp_query and it does not need to be reset with
	 * wp_reset_query(). We just need to set the post data back up with
	 * wp_reset_postdata().
	 */
	wp_reset_postdata();
}






//// Ejemplo de codigo avanzado ///////////
echo '<br><h1>Ejemplo practico aplicado para mostrar los post unicamente del term "2016" y que estan en "Indicadores de gestion"</h1>';

//El term_id del año 2016 es term_id=790
//DICHO TERM 2016 TAMBIEN SE ENCUENTRA EN LA TAXONOMIA DE accesoinfo
// lA PROPIEDAD "relation" en el primer nivel del array de tax_query sirve para indicar que va hacer un join de las busquedas, esto puede incluir parametros como OR, AND
// POR DEFECTO SI NO INCLUYE DICHO PARAMETRO LO TOMA COMO UN AND

//En el segundo nivel de array acepta tres parametros AND. NOT, OR
$args99 = array(
    "post_type" => "documentos",
    "tax_query" => array(
        array(
            "taxonomy" => "accesoinfo",
            "field" => "id",
            "terms" => array(790),
        ),
        array(
            "taxonomy" => "accesoinfo",
            "field" => "slug",
            "terms" => 'aindicadores-de-gestion',
        )
    ),
    "posts_per_page"=> -1,
    "order" => "DESC"
);

$query99 = new WP_Query( $args99 );
if ( $query99->have_posts() ) {
	// The Loop
	while ( $query99->have_posts() ) {
		$query99->the_post();
		echo '<li>' . get_the_title() . '</li>';
	}

	/* Restore original Post Data
	 * NB: Because we are using new WP_Query we aren't stomping on the
	 * original $wp_query and it does not need to be reset with
	 * wp_reset_query(). We just need to set the post data back up with
	 * wp_reset_postdata().
	 */
	wp_reset_postdata();
}





//// Ejemplo de codigo avanzado 2 ///////////
echo '<br><h1>EJEMPLO QUE MUESTRA TODOS LOS POST EN "Indicadores de gestion" MENOS LOS QUE TAMBIEN ESTAN EN 2016</h1>';

//DICHO TERM 2016 TAMBIEN SE ENCUENTRA EN LA TAXONOMIA DE accesoinfo
//El term_id del año 2016 es term_id=790
// lA PROPIEDAD "relation" en el primer nivel del array de tax_query sirve para indicar que va hacer un join de las busquedas, esto puede incluir parametros como OR, AND
// POR DEFECTO SI NO INCLUYE DICHO PARAMETRO LO TOMA COMO UN AND

//En el segundo nivel de array acepta tres parametros AND. NOT, OR
$args99 = array(
    "post_type" => "documentos",
    "tax_query" => array(
    	'relation' => 'AND',
        array(
            "taxonomy" => "accesoinfo",
            "field" => "id",
            "terms" => array(790),
            'operator' => 'NOT IN',
        ),
        array(
            "taxonomy" => "accesoinfo",
            "field" => "slug",
            "terms" => 'aindicadores-de-gestion',
        )
    ),
    "posts_per_page"=> -1,
    "order" => "DESC"
);

$query99 = new WP_Query( $args99 );
if ( $query99->have_posts() ) {
	// The Loop
	while ( $query99->have_posts() ) {
		$query99->the_post();
		echo '<li>' . get_the_title() . '</li>';
		echo $file = types_render_field("documento");
	}

	/* Restore original Post Data
	 * NB: Because we are using new WP_Query we aren't stomping on the
	 * original $wp_query and it does not need to be reset with
	 * wp_reset_query(). We just need to set the post data back up with
	 * wp_reset_postdata().
	 */
	wp_reset_postdata();
}
