<template>
    <!--<div class="container"> -->
        <div class="row">
            <page-title-component>
                <h5>Minhas contas a receber</h5>
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
                        <tr v-for="(index,billReceive) in billReceives">
                            <td>&nbsp; {{ billReceive.id }}</td>
                            <td>{{ billReceive.name }}</td>
                            <td>{{ billReceive.date_due }}</td>
                            <td>{{ billReceive.value | numberFormat }}</td>
                            <td>
                                <i class="material-icons green-text" v-if="billReceive.done">check</i>
                            </td>
                            <td>
                                <a v-link="{name: 'bill-receives.update',params: {id: billReceive.id}}">Editar</a> |
                                <a :id="'link-modal-'+ billReceive.id" :href="`#modal-link-remove-${billReceive.id}`">Delete</a>

                                <modal-component :modal="{id: 'modal-link-remove-' + billReceive.id}">
                                    <div slot="content">
                                        <h5>Mensagem de confirmação</h5>
                                        <p><strong>Deseja excluir esta conta a receber?</strong></p>
                                        <div class="divider"></div>
                                        <p>Nome: <strong>{{ billReceive.name  }}</strong></p>
                                        <div class="divider"></div>
                                    </div>
                                    <div slot="footer">
                                        <button class="btn btn-flat waves-effect green lighten-2 modal-close modal-action"
                                                @click="remove(billReceive.id)">OK</button>
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
                <a v-link="{name: 'bill-receives.create'}" class="btn-floating btn-large">
                    <i class="large material-icons">add</i>
                </a>
            </div>

        </div>
    <!-- </div> -->
</template>
<script type="text/javascript">
    import {BillReceive} from '../../services/resources';
    import BillReceivesFormComponent from './BillReceivesForm.vue';
    import ModalComponent from '../../../../_default/components/Modal.vue';
    import PaginationComponent from '../Pagination.vue';
    import SearchComponent from '../../../../_default/components/Search.vue';
    import PageTitleComponent from '../PageTitle.vue';

    export default {
        components: {
            'form-component': BillReceivesFormComponent,
            'modal-component': ModalComponent,
            'pagination-component:': PaginationComponent,
            'search-component': SearchComponent,
            'page-title-component': PageTitleComponent,
        },
        data() {
            return {
                billReceives: [],
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
                            label: 'Pago ?',
                            width: '13%'
                        }
                    }
                }
            }
        },
        created() {
            this.populateBillReceives();
        },
        methods: {
            remove(id) {

                BillReceive.remove({id:id})
                    .then((response) => {
                        this.populateBillReceives();

                        Materialize.toast('Conta a receber excluida com sucesso!', 4000);
                    }).catch((response) => {
                        Materialize.toast('Aconteceu um problema! Tente novamente mais tarde', 4000);
                    })
                ;
            },
            populateBillReceives(){
                BillReceive.query({
                    page: this.pagination.current_page+1,
                    orderBy: this.order.key,
                    sortedBy: this.order.sort,
                    search: this.search

                }).then((response) => {
                    this.billReceives = response.data.data;
                    let pagination = response.data.meta.pagination;
                    pagination.current_page--;
                    this.pagination = pagination;
                });
            },
            sortBy(key) {
                this.order.key = key;
                this.order.sort = this.order.sort == 'desc' ? 'asc' : 'desc';
                this.populateBillReceives();
            },
            filter() {
                this.pagination.current_page = 0;
                this.populateBillReceives();
            }
        },
        events: {
            'pagination::changed'(page) {
                this.populateBillReceives();
            }
        }
    };
</script>