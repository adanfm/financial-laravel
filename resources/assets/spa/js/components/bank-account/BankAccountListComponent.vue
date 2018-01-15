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
                        <td>&nbsp; {{ index+1 }}</td>
                        <td>{{ bankAccount.name }}</td>
                        <td>{{ bankAccount.agency }}</td>
                        <td>{{ bankAccount.account }}</td>
                        <td>
                            <a href="#">Editar</a> | <a href="#">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script type="text/javascript">
    import {BankAccount} from '../../services/resources';

    export default {
        data() {
            return {
                bankAccounts: []
            }
        },
        created() {
            BankAccount.get().then((response) => {
                this.bankAccounts = response.data;
            });

        },
        methods: {

        }
    };
</script>