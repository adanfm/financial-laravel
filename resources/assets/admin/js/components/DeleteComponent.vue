<template>
    <form method="POST" :action="action" :id="`form_item_delete_${idItem}`">
        <input type="hidden" name="_method" value="DELETE" />
        <input type="hidden" name="_token" :value="csrfToken">
    </form>
    <a class="link-delete" :data-id="idItem" href="#">Excluir</a>
</template>
<script type="text/javascript">
    export default {
        props: ['action', 'csrfToken', 'idItem'],
        ready(){
            $(document).ready(() => {
                $('.link-delete').on('click',(event) => {
                    event.preventDefault();
                    let idForm = `#form_item_delete_${this.idItem}`;
                    let answer = confirm('Você deseja mesmo remover este registro?');
                    if (answer) {
                        $(idForm).submit();
                    }
                })
            })
        }
    }
</script>
<style>

</style>