<template>
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col s6">
                    <page-title>
                        <h5>Editar conta bancária</h5>
                    </page-title>
                </div>
                <div class="col s6">
                    <page-title class="valign-wrapper">
                        <div class="valign">
                            <a href="#" class="waves-effect waves-light btn" v-link="{name: 'bank-account.list'}">
                                <i class="material-icons">arrow_back</i>
                            </a>
                        </div>
                    </page-title>
                </div>
            </div>
            <div class="card-panel z-depth-5">
                <form-component action="update" label-button="Editar"></form-component>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import BankAccountFormComponent from './BankAccountFormComponent.vue';
    import PageTitleComponent from '../PageTitle.vue';

    export default {
        components: {
            'form-component': BankAccountFormComponent,
            'page-title': PageTitleComponent
        }
    };
</script>