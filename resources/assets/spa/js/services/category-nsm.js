import {Category} from "./resources";

export class CategoryFormat
{
    static getCategoriesFormatted(categories)
    {
        let categoriesFormatted = this._formatCategories(categories);

        categoriesFormatted.unshift({
            id: 0,
            text: 'Nenhuma categoria',
            level: 0,
            hasChildren: false
        });

        return categoriesFormatted;
    }

    static _formatCategories(categories, categoryCollection = [])
    {
        for (let category of categories) {
            let categoryNew = {
                id: category.id,
                text: category.name,
                level: category.depth,
                hasChildren: category.children.data.length > 0
            };
            categoryCollection.push(categoryNew);
            this._formatCategories(category.children.data, categoryCollection);
        }

        return categoryCollection;

    }
}

export class CategoryService
{
    static save(resource, category, parent, categories, categoryOriginal) {
        if (category.id === 0) {
            return this.new(resource, category,parent, categories);
        }
        return this.edit(resource, category,parent,categories,categoryOriginal);
    }

    static new(resource, category, parent, categories){
        let categoryCopy = $.extend(true, {}, category);
        if(categoryCopy.parent_id === null){
            delete categoryCopy.parent_id;
        }
        return resource.save(categoryCopy).then((response) => {
            let categoryAdded = response.data.data;
            if(categoryAdded.parent_id === null){
                categories.push(categoryAdded);
            }else{
                console.log(parent);
                parent.children.data.push(categoryAdded);
            }
            return response;
        });
    }

    static edit(resource, category, parent, categories, categoryOriginal){
        let categoryCopy = $.extend(true, {}, category);
        if(categoryCopy.parent_id === null){
            delete categoryCopy.parent_id;
        }
        let self = this;
        return resource.update({id: categoryCopy.id}, categoryCopy).then((response) => {
            let categoryUpdated = response.data.data;
            if(categoryUpdated.parent_id === null){
                if(parent){
                    parent.children.data.$remove(categoryOriginal);
                    categories.push(categoryUpdated);
                    return response;
                }
            }else{
                if(parent){
                    if(parent.id != categoryUpdated.parent_id){
                        parent.children.data.$remove(categoryOriginal);
                        self._addChild(categoryUpdated, categories);
                        return response;
                    }
                }else{
                    categories.$remove(categoryOriginal);
                    self._addChild(categoryUpdated, categories);
                    return response;
                }
            }

            if(parent){
                let index = parent.children.data.findIndex(element => {
                    return element.id == categoryUpdated.id;
                });
                parent.children.data.$set(index, categoryUpdated);
            }else{
                let index = categories.findIndex(element => {
                    return element.id == categoryUpdated.id;
                });
                categories.$set(index, categoryUpdated);
            }

            return response;
        });
    }

    static destroy(resource, category,parent,categories){
        return resource.delete({id: category.id}).then(response => {
            if(parent){
                parent.children.data.$remove(category);
            }else{
                categories.$remove(category);
            }
            return response;
        });
    }

    static _addChild(child, categories) {
        let parent = this._findParent(child.parent_id, categories);
        parent.children.data.push(child);
    }

    static _findParent(id, categories) {

        let result = null;
        for (let category of categories) {
            if (id == category.id) {
                result = category;
                break;
            }
            result = this._findParent(id, categories.children.data);
            if (result !== null) {
                break;
            }
        }
        return result;
    }
}