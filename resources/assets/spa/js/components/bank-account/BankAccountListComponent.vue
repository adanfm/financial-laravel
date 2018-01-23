<template>
    <div class="container">
        <div class="row">
            <div class="card-panel green lighten-3">
                <span class="green-text text-darken-2">
                    <h5>Minhas contas bancárias</h5>
                </span>
            </div>
            <div class="card-panel z-depth-5">
                <search-component :model.sync="search" @on-submit="filter"></search-component>
                <table class="bordered striped highlight centered responsive-table">
                    <thead>
                    <tr>
                        <th v-for="(key, o) in table.headers" :width="o.width">
                            <a href="#" @click.prevent="sortBy(key)">
                                {{ o.label }}
                                <i class="material-icons right" v-if="order.key == key">
                                    {{ order.sort == 'asc' ? 'arrow_drop_up' : 'arrow_drop_down' }}
                                </i>
                            </a>
                        </th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(index,bankAccount) in bankAccounts">
                            <td>&nbsp; {{ bankAccount.id }}</td>
                            <td>{{ bankAccount.name }}</td>
                            <td>{{ bankAccount.agency }}</td>
                            <td>{{ bankAccount.account }}</td>
                            <td>
                                <a v-link="{name: 'bank-account.update',params: {id: bankAccount.id}}">Editar</a> |
                                <a :id="'link-modal-'+ bankAccount.id" :href="`#modal-link-remove-${bankAccount.id}`">Delete</a>

                                <modal-component :modal="{id: 'modal-link-remove-' + bankAccount.id}">
                                    <div slot="content">
                                        <h5>Mensagem de confirmação</h5>
                                        <p><strong>Deseja excluir esta conta bancária?</strong></p>
                                        <div class="divider"></div>
                                        <p>Nome: <strong>{{ bankAccount.name  }}</strong></p>
                                        <div class="divider"></div>
                                    </div>
                                    <div slot="footer">
                                        <button class="btn btn-flat waves-effect green lighten-2 modal-close modal-action"
                                                @click="remove(bankAccount.id)">OK</button>
                                        <button class="btn btn-flat waves-effect waves-red modal-close modal-action">Cancelar</button>
                                    </div>
                                </modal-component>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <pagination-component:
                        :per-page="pagination.per_page"
                        :total-records="pagination.total"
                        :current-page.sync="pagination.current_page"
                ></pagination-component:>
            </div>

            <div class="fixed-action-btn">
                <a v-link="{name: 'bank-account.create'}" class="btn-floating btn-large">
                    <i class="large material-icons">add</i>
                </a>
            </div>

        </div>
    </div>
</template>
<script type="text/javascript">
    import {BankAccount} from '../../services/resources';
    import BankAccountFormComponent from './BankAccountFormComponent.vue';
    import ModalComponent from '../../../../_default/components/Modal.vue';
    import PaginationComponent from '../Pagination.vue';
    import SearchComponent from '../../../../_default/components/Search.vue';

    export default {
        components: {
            'form-component': BankAccountFormComponent,
            'modal-component': ModalComponent,
            'pagination-component:': PaginationComponent,
            'search-component': SearchComponent
        },
        data() {
            return {
                bankAccounts: [],
                pagination: {
                    current_page: 0,
                    per_page: 0,
                    total: 0
                },
                search: "",
                order: {
                    key: 'id',
                    sort: 'asc'
                },
                table: {
                    headers: {
                        id: {
                            label: '#',
                            width: '10%'
                        },
                        name: {
                            label: 'Nome',
                            width: '45%'
                        },
                        agency: {
                            label: 'Agência',
                            width: '15%'
                        },
                        account: {
                            label: 'C/C',
                            width: '15%'
                        }
                    }
                }
            }
        },
        created() {
            this.populateBankAccount();
        },
        methods: {
            remove(id) {
                BankAccount.remove({id:id})
                    .then((response) => {
                        Materialize.toast('Conta bancária excluida com sucesso!', 4000);
                        this.populateBankAccount();
                    }).catch((response) => {
                        Materialize.toast('Aconteceu um problema! Tente novamente mais tarde', 4000);
                    })
                ;
            },
            populateBankAccount(){
                BankAccount.query({
                    page: this.pagination.current_page+1,
                    orderBy: this.order.key,
                    sortedBy: this.order.sort,
                    search: this.search

                }).then((response) => {
                    this.bankAccounts = response.data.data;
                    let pagination = response.data.meta.pagination;
                    pagination.current_page--;
                    this.pagination = pagination;
                });
            },
            sortBy(key) {
                this.order.key = key;
                this.order.sort = this.order.sort == 'desc' ? 'asc' : 'desc';
                this.populateBankAccount();
            },
            filter() {
                this.populateBankAccount();
            }
        },
        events: {
            'pagination::changed'(page) {
                this.populateBankAccount();
            }
        }
    };
</script>