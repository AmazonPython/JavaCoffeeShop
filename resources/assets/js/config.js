/**
 * Defines the API route we are using.
 */
var api_url = '';
var gaode_maps_js_api_key = 'c526fadd6d3959312ce7f690b0ad57a2';

switch( process.env.NODE_ENV ){
    case 'development':
        api_url = 'http://javacoffee.bb/api/v1';
        break;
    case 'production':
        api_url = 'http://coffeeshop.lunanova.top/api/v1';
        break;
}

export const ROAST_CONFIG = {
    API_URL: api_url,
    GAODE_MAPS_JS_API_KEY: gaode_maps_js_api_key
}
