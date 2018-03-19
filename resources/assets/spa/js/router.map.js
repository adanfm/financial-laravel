import LoginComponent from './components/Login.vue';
import LogoutComponent from './components/logout.vue';
import DashboardComponent from './components/Dashboard.vue';
import BankAccountListComponent from './components/bank-account/BankAccountListComponent.vue';
import BankAccountCreateComponent from './components/bank-account/BankAccountCreateComponent.vue';
import BankAccountUpdateComponent from './components/bank-account/BankAccountUpdateComponent.vue';
import BillReceivesListComponent from './components/bill-receives/BillReceivesList.vue';
import BillReceivesCreateComponent from './components/bill-receives/BillReceivesCreate.vue';
import BillReceivesUpdateComponent from './components/bill-receives/BillReceivesUpdate.vue';
import BillPaysListComponent from './components/bill-pays/BillPaysList.vue';
import BillPaysCreateComponent from './components/bill-pays/BillPaysCreate.vue';
import BillPaysUpdateComponent from './components/bill-pays/BillPaysUpdate.vue';
import CategoryListComponent from './components/category/CategoryList.vue';

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
    '/bill-receives': {
        component: {template: "<router-view></router-view>"},
        auth: true,
        subRoutes: {
            '/': {
                name: 'bill-receives.list',
                component: BillReceivesListComponent
            },
            '/create': {
                name: 'bill-receives.create',
                component: BillReceivesCreateComponent
            },
            '/:id/update': {
                name: 'bill-receives.update',
                component: BillReceivesUpdateComponent
            }
        }
    },
    '/bill-pays': {
        component: {template: "<router-view></router-view>"},
        auth: true,
        subRoutes: {
            '/': {
                name: 'bill-pays.list',
                component: BillPaysListComponent
            },
            '/create': {
                name: 'bill-pays.create',
                component: BillPaysCreateComponent
            },
            '/:id/update': {
                name: 'bill-pays.update',
                component: BillPaysUpdateComponent
            }
        }
    },
    '/categories': {
        name: 'category.list',
        component: CategoryListComponent,
        auth:true
    }
}