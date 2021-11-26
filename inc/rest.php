<?php

add_action( 'rest_api_init', function () {
  register_rest_route( 'confetti/v1', '/filter', array(
    'methods' => 'GET',
    'callback' => 'fetch_projects',
    'permission_callback' => '__return_true',
    
  ) );
} );


function fetch_projects($data){
  if($tax = $data->get_param('taxonomy')){
    $tax = wp_strip_all_tags($tax);
  }
  else{
    $tax = false;
  }
  if($tax=='reset'){
    $tax=false;
  }
  return get_whatson_response($tax);
}

/*
'args' => array(
        'type' => array(
            'validate_callback' => function( $param, $request, $key ) {
                return is_string( $param );
            }
        ),
        'offset' => array(
            'validate_callback' => function( $param, $request, $key ) {
                return is_numeric( $param );
            }
        ),
        'tax' => array(
            'validate_callback' => function( $param, $request, $key ) {
                return is_string( $param );
            }
        ),
        'term' => array(
          'validate_callback' => function( $param, $request, $key ) {
              return is_numeric( $param );
          }
      ),
    ),*/