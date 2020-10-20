add_filter( 'woocommerce_shortcode_products_query', 'royal_price_based_products_query', 10, 3 );
function royal_price_based_products_query( $query_args, $atts, $loop_name ) {
    if( ! ( isset($atts['class']) && ! empty($atts['class']) ) )
        return $query_args;

    if (strpos($atts['class'], 'below-') !== false) {
        $compare   = '<';
        $slug    = 'below-';
    } elseif (strpos($atts['class'], 'above-') !== false) {
        $compare   = '>';
        $slug    = 'above-';
    }

    if( isset($compare) ) {
        $query_args['meta_query'][] = array(
            'key'     => '_price',
            'value'   => (float) str_replace($slug, '', $atts['class']),
            'type'    => 'DECIMAL',
            'compare' => $compare,
        );
    }
    return $query_args;
}

// Usges [products limit="16" paginate="true" columns="4" class="below-50"]
// Usges [products limit="16" paginate="true" columns="4" class="above-50"]
