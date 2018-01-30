<template>
    <form id="bank_account_form" @submit.prevent="submitForm">
        <input type="hidden" v-model="bankAccount.id">
        <div class="row">
            <div class="input-field col s12">
                <input v-model="bankAccount.name" type="text" required id="bank_account_name"/>
                <label for="bank_account_name" :class="{'active': bankAccount.name !== ''}">Nome</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <label class="active" for="bank-id">Banco</label>
                <!-- <select v-model="bankAccount.bank_id" id="bank_account_bank" class="browser-default">
                    <option disabled selected>Selecione um banco</option>
                    <option v-for="o in banks" :value="o.id">{{ o.name }}</option>
                </select>-->
                <input
                    type="text"
                    id="bank-id"
                    placeholder="Procure o banco"
                    autocomplete="off"
                    data-activates="bank-id-dropdown"
                    data-beloworigin="true"
                />
                <ul id="bank-id-dropdown" class="dropdown-content ac-dropdown">
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <input v-model="bankAccount.agency" type="text" id="bank_account_agency" placeholder="Digite a agência"/>
                <label for="bank_account_agency" :class="{'active': bankAccount.agency !== ''}">Agência</label>
            </div>
            <div class="input-field col s6">
                <input v-model="bankAccount.account" type="text" id="bank_account_number" placeholder="Digite a conta corrente"/>
                <label for="bank_account_number" :class="{'active': bankAccount.account !== ''}">Conta</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" class="filled-in" v-model="bankAccount.default" id="bank_account_default" />
                <label for="bank_account_default">Padrão?</label>
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
    import {BankAccount, Bank} from "../../services/resources";
    import 'materialize-autocomplete';
    import _ from 'lodash';

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
                    'default': false
                },
                banks: []
            }
        },
        created() {
            Bank.query().then((response) => {
                this.banks = response.data.data;
                this.initAutocomplete();
            });
        },
        ready() {
            if (this.action == 'update') {
                let id = this.$route.params.id;
                BankAccount
                    .query({id:id})
                    .then((response) => {
                        this.bankAccount = response.data.data;
                    });
            }
        },
        methods: {
            submitForm(event) {
                if (this.action == 'create') {
                    BankAccount
                        .save({}, this.bankAccount)
                        .then((response) => {
                            Materialize.toast('Conta bancária criada com sucesso!', 4000);
                            this.$router.go({name: 'bank-account.list'});
                        }).catch((response) => {
                            Materialize.toast('Aconteceu um problema! Tente novamente mais tarde', 4000);
                        })
                    ;
                } else {
                    let id = this.$route.params.id;

                    BankAccount
                        .update({id:id}, this.bankAccount)
                        .then((response) => {
                            Materialize.toast('Conta bancária atualizada com sucesso', 4000);
                            this.$router.go({name: 'bank-account.list'});
                        })
                        .catch((response) => {
                            Materialize.toast('Aconteceu um problema! Tente novamente mais tarde', 4000);
                        })
                    ;
                }
            },
            initAutocomplete() {
                let self = this;
                $(document).ready(() => {
                    $('#bank-id').materialize_autocomplete({
                        limit:10,
                        multiple: {
                            enable: false
                        },
                        dropdown: {
                            el: '#bank-id-dropdown'
                        },
                        getData(value, callback) {
                            let banks = self.filterBankByName(value);
                            banks = banks.map((o) => {
                                return {id: o.id, text: o.name}
                            });

                            callback(value, banks);
                        },
                        onSelect(item) {
                            self.bankAccount.bank_id = item.id;
                        },
                        onExists(item) {
                            console.log(item);
                        }
                    });
                });
            },
            filterBankByName(name) {
                return _.filter(this.banks, (o) => {
                    return _.contains(o.name.toLowerCase(), name.toLowerCase());
                });
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