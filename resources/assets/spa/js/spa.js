import appConfig from './services/appConfig';
require('materialize-css');

window.Vue = require('vue');
require('vue-resource');
Vue.http.options.root = appConfig.api_url;
require('./filters/filters');

require('./services/interceptors');
require('./router');
require('jquery-mask-plugin/dist/jquery.mask.min');
require('../../_default/maks');