import LoginComponent from './components/Login.vue';
import LogoutComponent from './components/logout.vue';
import DashboardComponent from './components/Dashboard.vue';
import BankAccountListComponent from './components/bank-account/BankAccountListComponent.vue';
import BankAccountCreateComponent from './components/bank-account/BankAccountCreateComponent.vue';
import BankAccountUpdateComponent from './components/bank-account/BankAccountUpdateComponent.vue';

export default {
    '/login': {
        name: 'auth.login',
        component: LoginComponent,
        auth: false
    },
    '/logout' : {
        name: 'auth.logout',
        component: LogoutComponent,
        auth: true
    },
    '/dashboard': {
        name: 'dashboard',
        component: DashboardComponent,
        auth: true
    },
    '/bank-accounts': {
        component: {template: "<router-view></router-view>"},
        auth: true,
        subRoutes: {
            '/': {
                name: 'bank-account.list',
                component: BankAccountListComponent
            },
            '/create': {
                name: 'bank-account.create',
                component: BankAccountCreateComponent
            },
            '/:id/update': {
                name: 'bank-account.update',
                component: BankAccountUpdateComponent
            }
        }
    },
}