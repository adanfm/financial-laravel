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
let BillReceive = Vue.resource('bill_receives{/id}');
let BillPays = Vue.resource('bill_pays{/id}');
let Category = Vue.resource('categories{/id}');

export {User, BankAccount, Bank, BillReceive, BillPays,Category};