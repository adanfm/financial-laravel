<template>
    <form id="bank_account_form" @submit.prevent="submitForm">
        <input type="hidden" v-model="billReceive.id">
        <div class="row">
            <div class="input-field col s12">
                <input v-model="billReceive.name" type="text" required id="bill_receives_name"/>
                <label for="bill_receives_name" :class="{'active': billReceive.name !== ''}">Nome</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <input v-model="billReceive.date_due" type="text" id="bill_receives_date_due" class="date" placeholder="Informe a data de vencimento"/>
                <label for="bill_receives_date_due" class="active">Data de vencimento</label>
            </div>
            <div class="input-field col s6">
                <input v-model="billReceive.value" type="text" id="bill_receives_value" placeholder="Digite a conta corrente"/>
                <label for="bill_receives_value" :class="{'active': billReceive.value !== ''}">Valor</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" class="filled-in" v-model="billReceive.done" id="bill_receives_done" />
                <label for="bill_receives_done">Pago?</label>
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                <button type="submit" class="btn waves-effect waves-light btn btn-large" type="button"> {{ labelButton }}</button>
            </div>
        </div>
    </form>
</template>
<script type="text/javascript">
    import {BillReceive} from "../../services/resources";

    export default{

        props: ['action', 'labelButton'],
        data() {
            return {
                billReceive: {
                    id: '',
                    name: '',
                    date_due: '',
                    'value': '',
                    done: '',
                }
            }
        },
        ready() {
            if (this.action == 'update') {
                let id = this.$route.params.id;
                BillReceive
                    .query({id:id})
                    .then((response) => {
                        this.billReceive = response.data.data;
                });
            }
        },
        methods: {
            submitForm(event) {
                if (this.action == 'create') {
                    BillReceive
                        .save({}, this.billReceive)
                        .then((response) => {
                            Materialize.toast('Conta a receber criada com sucesso!', 4000);
                            this.$router.go({name: 'bill-receives.list'});
                        }).catch((response) => {
                            Materialize.toast('Aconteceu um problema! Tente novamente mais tarde', 4000);
                        })
                    ;
                } else {
                    let id = this.$route.params.id;

                    BillReceive
                        .update({id:id}, this.billReceive)
                        .then((response) => {
                            Materialize.toast('Conta a receber atualizada com sucesso', 4000);
                            this.$router.go({name: 'bill-receives.list'});
                        })
                        .catch((response) => {
                            Materialize.toast('Aconteceu um problema! Tente novamente mais tarde', 4000);
                        })
                    ;
                }
            }
        }
    }
</script>
<style type="text/css" scoped>
    select {
        margin-top: 5px;
    }

    button[type=submit] {
        margin-top: 8px;
    }
</style>