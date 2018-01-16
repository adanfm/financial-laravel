<template>
    <div class="container">
        <div class="row">
            <h5>Minhas contas bancárias</h5>
            <div class="row">
                <div class="col s12">
                    <a v-link="{name: 'bank-account.create'}" class="btn waves-effect">Novo Banco</a>
                </div>
            </div>

            <table class="bordered striped highlight centered responsive-table z-depth-5">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Agência</th>
                    <th>C/C</th>
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
        </div>
    </div>
</template>
<script type="text/javascript">
    import {BankAccount} from '../../services/resources';
    import BankAccountFormComponent from './BankAccountFormComponent.vue';
    import ModalComponent from '../../../../_default/components/Modal.vue';

    export default {
        components: {
            'form-component': BankAccountFormComponent,
            'modal-component': ModalComponent
        },
        data() {
            return {
                bankAccounts: []
            }
        },
        created() {
            this.populateBankAccount();
        },
        methods: {
            remove(id) {
                BankAccount.remove({id:id})
                    .then((response) => {
                        alert('Conta bancária removida com sucesso');
                        this.populateBankAccount();
                    }).catch((response) => {
                        alert('Aconteceu um problema! Tente novamente mais tarde');
                    })
                ;
            },
            populateBankAccount(){
                BankAccount.get().then((response) => {
                    this.bankAccounts = response.data;
                });
            }
        }
    };
</script>