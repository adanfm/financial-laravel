import JwtToken from './jwt-token';
import LocalStorage from './localStorage';
import {Jwt, User} from "./resources";

const USER  = 'user' ;
const afterLogin = function(response) {
    this.user.check = true;
    User.get().then((response) => {
        this.user.data = response.data;
    });
};

export default {
    user: {
        set data(value) {
            if (!value) {
                LocalStorage.remove(USER);
                this._data = null;
                return;
            }
            this._data = value;
            LocalStorage.setObject(USER, value);
        },
        get data() {
            if (!this._data) {
                this._data = LocalStorage.getObject(USER);
            }
            return this._data;
        },
        check: JwtToken.token ? true : false
    },
    login(email, password) {
        return JwtToken.accessToken(email,password).then((response) => {
            let afterLoginContext = afterLogin.bind(this);
            afterLoginContext(response);
            return response;
        });
    },
    logout() {
        let afterLogin = (response) => {
            this.clearAuth();
            return response;
        }
        return JwtToken.revokeToken()
            .then(afterLogin)
            .catch(afterLogin)
        ;
    },
    clearAuth() {
        this.user.data = null;
        this.user.check = false;
    }
}