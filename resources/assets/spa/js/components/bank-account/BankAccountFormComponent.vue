<template>
    <form id="bank_account_form" @submit.prevent="submitForm">
        <input type="hidden" v-model="bankAccount.id">
        <div class="row">
            <div class="input-field col s6">
                <input v-model="bankAccount.name" type="text" required id="bank_account_name"/>
                <label for="bank_account_name">Nome</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input v-model="bankAccount.agency" type="text" id="bank_account_agency"/>
                <label for="bank_account_agency">Agência</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input v-model="bankAccount.account" type="text" id="bank_account_number"/>
                <label for="bank_account_number">Conta</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <label class="active" for="bank_account_bank">Banco</label>
                <select v-model="bankAccount.bank_id" id="bank_account_bank" class="browser-default">
                    <option>Selecione um banco</option>
                    <option v-for="(index,o) in banks" :value="o.id">{{ o.name }}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col s6">
                    <button type="submit" class="btn waves-effect waves-light btn" type="button"> {{ labelButton }}</button>
                </div>
            </div>
        </div>
    </form>
</template>
<script type="text/javascript">
    import {Bank} from "../../services/resources";

    export default{
        props: ['action', 'labelButton'],
        data() {
            return {
                bankAccount: {
                    id: '',
                    name: '',
                    agency: '',
                    account: '',
                    bank_id: '',
                },
                banks: [],
                methodRequest: 'POST'
            }
        },
        ready() {
            Bank.get().then((response) => {
                this.banks = response.data.data;
            });
        },
        methods: {
            submitForm(event) {
                console.log(event);
                console.log(this.bankAccount);
            }
        }
    }
</script>