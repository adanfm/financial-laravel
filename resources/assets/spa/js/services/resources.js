export class Jwt {
    static accessToken(email, password) {
        return Vue.http.post('access_token', {
            email: email,
            password: password
        });
    }

    static refreshToken() {
        return Vue.http.post('refresh_token');
    }

    static logout() {
        return Vue.http.post('logout');
    }
}

let User = Vue.resource('user');
let BankAccount = Vue.resource('bank_accounts{/id}');
let Bank = Vue.resource('banks{/id}');

export {User, BankAccount, Bank};