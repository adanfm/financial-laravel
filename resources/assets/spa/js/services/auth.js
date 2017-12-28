import JwtToken from './jwt-token';
import LocalStorage from './localStorage';
import {Jwt, User} from "./resources";

const USER  = 'user' ;
const afterLogin = (response) => {
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
            afterLogin(response);
            return response;
        });
    },
    logout() {
        return JwtToken.revokeToken()
            .then(this.clearAuth())
            .catch(this.clearAuth)
        ;
    },
    clearAuth() {
        LocalStorage.remove(USER);
    }
}