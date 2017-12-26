import config from '../config';

let localConfig = {
    teste: 'teste'
};

const appConfig = Object.assign({}, localConfig, config);

export default appConfig;