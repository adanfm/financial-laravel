require('materialize-css');

window.Vue = require('vue');
require('vue-resource');
Vue.http.options.root = 'http://127.0.0.1/api';

require('./router');