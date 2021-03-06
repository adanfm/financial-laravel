<template>
    <div class="row">
        <page-title>
            <h5>Administração de categorias (Despesas)</h5>
        </page-title>
        <div class="card-panel z-depth-5">
            <category-tree :categories="categories"></category-tree>
        </div>
        <category-save
                :modal-options="modalOptionsSave"
                :category.sync="categorySave"
                :cp-options="cpOptions"
                @save-category="saveCategory"
        >
            <span slot="title">{{ title }}</span>
            <div slot="footer">
                <button type="submit" class="btn btn-flat waves-effect green lighten-2 modal-close modal-action">
                    OK
                </button>
                <button class="btn btn-flat waves-effect waves-red modal-close modal-action">
                    Cancelar
                </button>
            </div>
        </category-save>

        <modal :modal="modalOptionsDelete">
            <div slot="content" v-if="categoryDelete">
                <h4>Mensagem de confirmação</h4>
                <p><strong>Deseja excluir esta categoria ?</strong></p>
                <div class="divider"></div>
                <p>Nome: <strong>{{ categoryDelete.name }}</strong></p>
                <div class="divider"></div>
            </div>
            <div slot="footer">
                <button @click="destroy()" class="btn btn-flat waves-effect green lighten-2 modal-close modal-action">
                    OK
                </button>
                <button class="btn btn-flat waves-effect waves-red modal-close modal-action">
                    Cancelar
                </button>
            </div>
        </modal>

        <div class="fixed-action-btn">
            <button @click="modalNew(null)" class="btn-floating btn-large">
                <i class="large material-icons">add</i>
            </button>
        </div>

    </div>
</template>

<script type="text/javascript">
    import PageTitleComponent from '../PageTitle.vue';
    import CategoryTreeComponent from './CategoryTree.vue';
    import CategorySaveComponent from './CategorySave.vue';
    import {CategoryExpenses} from '../../services/resources';
    import {CategoryFormat, CategoryService} from '../../services/category-nsm';
    import ModalComponent from '../../../../_default/components/Modal.vue';


    export default {
        components: {
            'page-title': PageTitleComponent,
            'category-tree': CategoryTreeComponent,
            'category-save': CategorySaveComponent,
            'modal': ModalComponent

        },
        data() {
            return {
                categories: [],
                categoriesFormatted: [],
                categorySave: {
                    id:0,
                    name: '',
                    parent_id: 0,
                },
                categoryDelete: null,
                category: null,
                parent: null,
                title: '',
                modalOptionsSave: {
                    id: 'modal-category-save'
                },
                modalOptionsDelete: {
                    id: 'modal-category-delete'
                }
            }
        },
        computed: {
            //opções para o campo select2 de categoria Pai
            cpOptions() {
                return {
                    data: this.categoriesFormatted,
                    templateResult(category) {
                        let margin =  '&nbsp;'.repeat(category.level * 6);
                        let text   =  category.hasChildren ? `<strong>${category.text}</strong>` : category.text;
                        return `${margin}${text}`;
                    },
                    escapeMarkup(m) {
                        return m;
                    }
                }
            }
        },
        created() {
            this.getCategories();
        },
        methods: {
            getCategories() {
                CategoryExpenses.query().then(response => {
                    this.categories = response.data.data;
                    this.formatCategories();
                });
            },
            saveCategory(){
                CategoryService.save(CategoryExpenses, this.categorySave, this.parent, this.categories, this.category).then((response)=>{
                    if(this.categorySave.id === 0){
                        Materialize.toast('Categoria adicionada com sucesso!', 5000);
                    }else{
                        Materialize.toast('Categoria alterada com sucesso!', 5000);
                    }
                    this.resetScope();
                });
            },
            destroy() {
                CategoryService.destroy(CategoryExpenses, this.categoryDelete, this.parent, this.categories).then(response => {
                    Materialize.toast('Categoria excluida com sucesso!', 5000);
                    this.resetScope();
                });
            },
            modalNew(category) {
                this.title = 'Nova Categoria';
                this.categorySave = {
                    id: 0,
                    name: '',
                    parent_id: category === null ? null : category.id
                };
                this.parent = category;
                $(`#${this.modalOptionsSave.id}`).modal('open');
            },
            modalEdit(category, parent) {
                this.title = 'Editar Categoria';
                this.categorySave = {
                    id: category.id,
                    name: category.name,
                    parent_id: category.parent_id
                };
                this.category = category;
                this.parent = parent;

                $(`#${this.modalOptionsSave.id}`).modal('open');
            },
            modalDelete(category, parent) {
                this.categoryDelete = category;
                this.parent = parent;
                $(`#${this.modalOptionsDelete.id}`).modal('open');
            },
            formatCategories() {
                this.categoriesFormatted = CategoryFormat.getCategoriesFormatted(this.categories);
            },
            resetScope() {
                this.categorySave = {
                    id:0,
                    name: '',
                    parent_id: 0,
                };

                this.categoryDelete = null;
                this.category = null;
                this.parent = null;

                this.formatCategories();
            }
        },
        events: {
            'category-new'(category) {
                this.modalNew(category);
            },
            'category-edit'(category, parent) {
                this.modalEdit(category, parent);
            },
            'category-delete'(category, parent) {
                this.modalDelete(category, parent);
            }
        }
    }
</script>