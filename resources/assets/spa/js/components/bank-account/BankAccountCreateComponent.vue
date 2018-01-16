<template>
    <div class="container">
        <div class="row">
            <h5>Criar nova conta Bancária</h5>
            <div class="row">
                <div class="col s12">
                    <a v-link="{name: 'bank-account.list'}" class="btn waves-effect">Listagem </a>
                </div>
            </div>

            <div class="row">
                <form-component action="create" label-button="Cadastrar"></form-component>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import BankAccountFormComponent from './BankAccountFormComponent.vue';
    export default {
        components: {
            'form-component': BankAccountFormComponent,
        }
    };
</script>