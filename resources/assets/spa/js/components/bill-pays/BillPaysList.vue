<template>
    <!--<div class="container"> -->
        <div class="row">
            <page-title-component>
                <h5>Minhas contas a pagar</h5>
            </page-title-component>
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
                        <tr v-for="(index,billPay) in billPays">
                            <td>&nbsp; {{ billPay.id }}</td>
                            <td>{{ billPay.name }}</td>
                            <td>{{ billPay.date_due }}</td>
                            <td>{{ billPay.value | numberFormat }}</td>
                            <td>
                                <i class="material-icons green-text" v-if="billPay.done">check</i>
                            </td>
                            <td>
                                <a v-link="{name: 'bill-pays.update',params: {id: billPay.id}}">Editar</a> |
                                <a :id="'link-modal-'+ billPay.id" :href="`#modal-link-remove-${billPay.id}`">Delete</a>

                                <modal-component :modal="{id: 'modal-link-remove-' + billPay.id}">
                                    <div slot="content">
                                        <h5>Mensagem de confirmação</h5>
                                        <p><strong>Deseja excluir esta conta a receber?</strong></p>
                                        <div class="divider"></div>
                                        <p>Nome: <strong>{{ billPay.name  }}</strong></p>
                                        <div class="divider"></div>
                                    </div>
                                    <div slot="footer">
                                        <button class="btn btn-flat waves-effect green lighten-2 modal-close modal-action"
                                                @click="remove(billPay.id)">OK</button>
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
                <a v-link="{name: 'bill-pays.create'}" class="btn-floating btn-large">
                    <i class="large material-icons">add</i>
                </a>
            </div>

        </div>
    <!-- </div> -->
</template>
<script type="text/javascript">
    import {BillPays} from '../../services/resources';
    import BillPaysFormComponent from './BillPaysForm.vue';
    import ModalComponent from '../../../../_default/components/Modal.vue';
    import PaginationComponent from '../Pagination.vue';
    import SearchComponent from '../../../../_default/components/Search.vue';
    import PageTitleComponent from '../PageTitle.vue';

    export default {
        components: {
            'form-component': BillPaysFormComponent,
            'modal-component': ModalComponent,
            'pagination-component:': PaginationComponent,
            'search-component': SearchComponent,
            'page-title-component': PageTitleComponent,
        },
        data() {
            return {
                billPays: [],
                pagination: {
                    current_page: 0,
                    per_page: 0,
                    total: 0,
                    total_pages: 0
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
                            width: '7%'
                        },
                        name: {
                            label: 'Nome',
                            width: '30%'
                        },
                        date_due: {
                            label: 'Data de vencimento',
                            width: '23%'
                        },
                        value: {
                            label: 'Valor',
                            width: '20%'
                        },
                        done: {
                            label: 'Recebido ?',
                            width: '13%'
                        }
                    }
                }
            }
        },
        created() {
            this.populateBillPays();
        },
        methods: {
            remove(id) {

                BillPays.remove({id:id})
                    .then((response) => {
                        this.populateBillPays();
                        Materialize.toast('Conta a receber excluida com sucesso!', 4000);
                    }).catch((response) => {
                        Materialize.toast('Aconteceu um problema! Tente novamente mais tarde', 4000);
                    })
                ;
            },
            populateBillPays(){
                BillPays.query({
                    page: this.pagination.current_page+1,
                    orderBy: this.order.key,
                    sortedBy: this.order.sort,
                    search: this.search

                }).then((response) => {
                    this.billPays = response.data.data;
                    let pagination = response.data.meta.pagination;
                    pagination.current_page--;
                    this.pagination = pagination;
                });
            },
            sortBy(key) {
                this.order.key = key;
                this.order.sort = this.order.sort == 'desc' ? 'asc' : 'desc';
                this.populateBillPays();
            },
            filter() {
                this.pagination.current_page = 0;
                this.populateBillPays();
            }
        },
        events: {
            'pagination::changed'(page) {
                this.populateBillPays();
            }
        }
    };
</script>