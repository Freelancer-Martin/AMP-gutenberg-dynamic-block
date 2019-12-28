<?php
/**
 * Class AMP_Block_Validated_URL_Post_Type
 *
 * @package AMP
 */
/**
 * Class AMP_Block_Validated_URL_Post_Type
 *
 * @since 1.0
 */
class AMP_Block_Validated_URL_Post_Type
{

  function __construct()
  {
    add_action( 'init', array( $this, 'gutenberg_examples_dynamic' ) );
  }

  public static function display_validated_post_types( $attributes, $content )
  {


    $args = array(
        'post_type' => 'amp_validated_url',
        'fields' => 'ids'
    );
    $custom_posts = get_posts( $args );
    $taxonomy_names = get_categories('taxonomy=amp_validation_error&type=amp_validated_url'); //get_object_taxonomies( 'amp_validated_url' );


    if ( count( $custom_posts ) === 0 ) {
        return 'No links';
    }

   if ( isset( $custom_posts ) && ! empty( $custom_posts ) ) {
      foreach ($custom_posts as $key => $value)
      {
         $meta = get_post( $value, ARRAY_A, $filter ='db' );
         //print_r( $meta );
         $array[] = array( 'meta' => $meta['post_content'], 'url'=> $meta['post_title'], 'post_type'=> $meta['post_type'], 'date' => $meta['post_modified'] );

      }
   }

    if ( isset( $taxonomy_names ) && ! empty( $taxonomy_names ) ) {
      foreach ( $taxonomy_names as $taxonomy_key => $taxonomy_value )
      {

         $taxonomy_array[] = array( 'description' => $taxonomy_value->description, 'count' => $taxonomy_value->count );

      }
    }

    //  AMP Validated URLS HTML Container
    $container .= '';
    $container .= '<table>';
    $container .= '<tr>AMP Validated URLS</tr>';
    $container .= '<tr>';
    $container .= '<th>URL</th>';
    $container .= '<th>Markup Status</th>';
    $container .= '<th>Invalid Markup</th>';
    $container .= '<th>Souces</th>';
    $container .= '<th>Last Checked</th>';

    $container .= '</tr>';
    if ( isset( $array ) && ! empty( $array ) ) {
      foreach ( $array as $skey => $svalue )
      {


        $json_decode_meta = json_decode( $svalue['meta'] );
        $json_decode_url = json_decode( $svalue['url'] );
        $wp_parse_url_array = wp_parse_url( $svalue['url'] );

        $container .= '<tr>';

        $container .= "<td><a href=".$wp_parse_url_array['path']." >".$wp_parse_url_array['path']."</a></td>";
        $container .= "<td>".$json_decode_meta[0]->data->code."</td>";
        $container .= "<td>".$json_decode_meta[0]->data->node_name."</td>";
        $container .= "<td>".$json_decode_meta[0]->data->sources[0]->name."</td>";
        $container .= "<td>".$svalue['date']."</td>";
        $container .= '</tr>';

      }
    }
    $container .= '</table>';

    //AMP Errors HTML Container
    $container .= '';
    $container .= '<table>';
    $container .= '<tr>AMP Errors</tr>';
    $container .= '<tr>';
    $container .= '<th>Error</th>';
    $container .= '<th>Markup Status</th>';
    $container .= '<th>Context</th>';
    $container .= '<th>Type</th>';
    $container .= '<th>Last seen</th>';
    $container .= '<th>URLs</th>';

    $container .= '</tr>';

    if ( isset( $taxonomy_array ) && ! empty( $taxonomy_array ) ) {
      foreach ( (array)$taxonomy_array as $taxonomy_array_key => $taxonomy_array_value )
      {


        $json_decode_description = json_decode( $taxonomy_array_value['description'] );
        $json_decode_count = json_decode( $taxonomy_array_value['count'] );
        $wp_parse_url = wp_parse_url( $json_decode_description->node_attributes->src );

        $container .= '<tr>';

        $container .= "<td><a href=".$wp_parse_url['path']." >".$wp_parse_url['path']."</a></td>";
        $container .= "<td>Removed</td>";
        $container .= "<td><pre>".$json_decode_description->parent_name."</pre></td>";
        $container .= "<td>".$json_decode_description->type."</td>";
        $container .= "<td>".$svalue['date']."</td>";
        $container .= "<td>".$json_decode_count."</td>";
        $container .= '</tr>';

      }
    }

    $container .= '</table>';


    return $container;
    //print_r( get_post_types() );

  }


  public static function gutenberg_examples_dynamic() {

      // automatically load dependencies and version
      $asset_file = plugin_dir_path( __FILE__ ) . 'build/index.asset.php';

      wp_register_script(
          'gutenberg-examples-dynamic',
          plugin_dir_url( __FILE__ ) . 'editor-script.js',
          ['wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor'],
  
      );

      wp_register_style(
          'gutenberg-examples-dynamic-editor',
          plugin_dir_url( __FILE__ ) . 'editor-style.css',
          array( 'wp-edit-blocks' ),
          filemtime( plugin_dir_path( __FILE__ ) . 'editor-style.css' )
      );

      wp_register_style(
          'gutenberg-examples-dynamic-style',
          plugin_dir_url( __FILE__ ) . 'editor-style.css',
          array( ),
          filemtime( plugin_dir_path( __FILE__ ) . 'editor-style.css' )
      );


      register_block_type( 'gutenberg-examples/example-dynamic', array(
          'style' => 'gutenberg-examples-dynamic-editor',
          'editor_style' => 'gutenberg-examples-dynamic-style',
          'editor_script' => 'gutenberg-examples-dynamic',
          'render_callback' => array( $this, 'display_validated_post_types' ),
      ) );

  }



}


// Init AMP block class
if ( class_exists('AMP_Block_Validated_URL_Post_Type') )
{
	$new_Class = new AMP_Block_Validated_URL_Post_Type();
}
