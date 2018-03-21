<?php
/**
  * Template Name: Transparencia template
  *
  */

	get_header();
?>

<?php
	//Funciones
	function file_type($file){
		$archivos = explode(" ", $file); //En un array de documentos, aqui se cortan, y se guardan en un array

		return $archivos;
	}


	function file_type2($file){
		$archivos = explode(" ", $file);

		$i = 0;
		foreach($archivos as $archivo){
			$file_type[$i]['url'] = $archivo; //http://intranet.sanluis.gob.mx/wp-content/uploads/2017/02/DICIEMBRE-2016.pdf 
			$documento = substr(strrchr($archivo, "/"), 1); //DICIEMBRE-2016.pdf  (Se corta la URL hastal aultimas coincidencia del string /)
			 //DICIEMBRE-2016.pdf
			$encontrar = strrpos($documento, "."); //14 (Cuenta los caracteres hasta el string (.), punto.)
			$recortar = substr($documento, 0, $encontrar); //DICIEMBRE-2016 (Se corta el string, antes de la aparicion del string (.)

			if(substr_count($recortar, '-') > 1){	//Si al subir un archivo este tiene mas de 2 " - ", entoces se le quitan con este proceso
				$file_type[$i]['type'] = strtr($recortar, "-", " ");
			}else{
				$file_type[$i]['type'] = $recortar; 
			} 

			$i++;
		}

		return $file_type;
	}
?>
<?php
	
	$args = array(
		'post_type' => 'transparencia',
		'order'    => 'ASC',
	);
	
	$loop = new WP_Query( $args );
	//Muestro solo el titulo para generar el menu.
	echo '<nav class="unidad-transparencia"><ul class="panel-nav">';
	while ( $loop->have_posts() ) : $loop->the_post();
		echo '<a href="#'.get_the_ID().'"><li>';
	  	the_title();
	  	echo '</li></a>';
	endwhile;
	echo '</ul></nav>';

	// rewind posts
	rewind_posts();
	?>
	<main class="unidad-transparencia">
	<?php
	//Muestro todo el contenido junto al titulo, la cual sera cada section en la vista
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		echo '<section id="'.get_the_ID().'" >';
			echo '<h2>';
				the_title();
			echo '</h2>';

			the_content();
			

			//Para indicar los documentos, se implementa lo siguiente:
			$file = types_render_field("documento-transparencia");

			if($file){
				$types = file_type2($file);
				foreach ($types as $value) {
					echo '<a href="'.$value['url'].'" class="document" target="_blank"> '.$value['type'].' </a>';
				}
			}

			//Para mostrar los videos multimedia se indica lo siguiente:
			echo types_render_field("multimedia-transparencia"); //Types_render_fiel corresponde al plugin de wordpress http://www.wp-types.com


	echo '</section>';
	endwhile;

?>
	</main>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>

		$('.panel-nav').each(function(){
		  // For each set of tabs, we want to keep track of
		  // which tab is active and its associated content
		  var $active, $content, $links = $(this).find('a');

		  // If the location.hash matches one of the links, use that as the active tab.
		  // If no match is found, use the first link as the initial active tab.
		  $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
		  $active.addClass('active');

		  $content = $($active[0].hash);

		  // Hide the remaining content
		  $links.not($active).each(function () {
		    $(this.hash).hide();
		  });

		  // Bind the click event handler
		  $(this).on('click', 'a', function(e){
		    // Make the old tab inactive.
		    $active.removeClass('active');
		    $content.hide();

		    // Update the variables with the new link and content
		    $active = $(this);
		    $content = $(this.hash);

		    // Make the tab active.
		    $active.addClass('active');
		    $content.show();

		    // Prevent the anchor's default click action
		    e.preventDefault();
		  });
		});
	</script>
<?php get_footer(); ?>
<?php
	/**
	 * Al desarrollador:
	 * La funcion Types_render_fiel, permite obtener los archivos, texto, urls, que se agregaron a traves de los campos personalizados
	 * Sin embargo, la funcion de manera predeterminada agrega etiquetas a cada contenido, esto dificulta la manipulacion de los mismos, a su vez dificulta
	 * el poder agregar etiquetas de estilo, para poder eliminar esas etiquetas se puede recurrir a buscar el plugin y editar el codigo fuente del plugin
	 * sin embargo no es lo correcto, se pueden crear funciones especificas para manipular las etiquetas y modificarlas a peticion.
	 */

?>