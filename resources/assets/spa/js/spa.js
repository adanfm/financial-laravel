import appConfig from './services/appConfig';
require('materialize-css');

window.Vue = require('vue');
require('vue-resource');
Vue.http.options.root = appConfig.api_url;

require('./services/interceptors');
require('./router');
/*
    window.localStorage.setItem('nome','valor');
    window.localStorage.setItem('nome','alterar_valor');
    window.localStorage.clear();
    window.localStorage.removeItem('nome');
*/