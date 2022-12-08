<template>
    <PageComponent>
        <template v-slot:header>
            <div>Administración</div>
        </template>

        <template v-slot:body>
            <!-- <pre>{{ categories_collapsed }}</pre> -->
            <div
                class="bg-slate-300 shadow shadow-slate-500/50 p-2 h-96 flex space-x-6"
            >
                <ListComponent
                    :categories="categories_collapsed"
                    :subcategories="subcategories_collapsed"
                    @collapse="collapse"
                    @show="showProducts"
                    @editCategory="editCategory"
                    @editSubcategory="editSubcategory"
                    @cancelEdit="cancelEdit"
                    @doneEditCategory="doneEditCategory"
                    @doneEditSubcategory="doneEditSubcategory"
                ></ListComponent>
                <TableComponent
                    :products="products"
                    :subcategory_id="selected_subcategory"
                >
                </TableComponent>
            </div>
        </template>
    </PageComponent>
</template>

<script setup>
import { ref, computed } from "vue";
import PageComponent from "../components/PageComponent.vue";
import ListComponent from "../components/administration/ListComponent.vue";
import TableComponent from "../components/administration/TableComponent.vue";
import store from "../store";
import { onBeforeMount } from "@vue/runtime-core";

onBeforeMount(() => {
    store.dispatch("getCategories");
    store.dispatch("getSubcategories");
    store.dispatch("getProducts");
    addCollapseController();
});

const categories = computed(() => store.state.categories);
const subcategories = computed(() => store.state.subcategories);
const products = computed(() => store.state.products);
const categories_collapsed = ref([]);
const subcategories_collapsed = ref([]);

// Annade un controlador para manejar colpasado y edicion al arreglo de categorias y subcategories
function addCollapseController() {
    for (let i = 0; i < categories.value.length; i++) {
        categories_collapsed.value[i] = categories.value[i];
        categories_collapsed.value[i]["collapsed"] = true;
        categories_collapsed.value[i]["editing"] = false;
    }
    for (let i = 0; i < subcategories.value.length; i++) {
        subcategories_collapsed.value[i] = subcategories.value[i];
        subcategories_collapsed.value[i]["collapsed"] = true;
        subcategories_collapsed.value[i]["editing"] = false;
    }
}
// Mostrar productos
const selected_subcategory = ref();
function showProducts(subcategory_id) {
    for (let i = 0; i < subcategories_collapsed.value.length; i++) {
        subcategories_collapsed.value[i]["editing"] = false;
        subcategories_collapsed.value[i]["collapsed"] = true;
    }
    selected_subcategory.value = subcategory_id;
    subcategories_collapsed.value.find(
        (subcategory) => subcategory.id === subcategory_id
    ).collapsed = !subcategories_collapsed.value.find(
        (subcategory) => subcategory.id === subcategory_id
    ).collapsed;
}

// colapsar categorias en la lista
function collapse(category_id) {
    categories_collapsed.value.find(
        (category) => category.id === category_id
    ).collapsed = !categories_collapsed.value.find(
        (category) => category.id === category_id
    ).collapsed;
}

function editSubcategory(subcategory_id) {
    for (let i = 0; i < subcategories_collapsed.value.length; i++) {
        subcategories_collapsed.value[i]["editing"] = false;
        subcategories_collapsed.value[i]["collapsed"] = true;
    }
    cacheBeforeEditing.value = subcategories_collapsed.value.find(
        (subcategory) => subcategory.id === subcategory_id
    ).name;
    subcategories_collapsed.value.find(
        (subcategory) => subcategory.id === subcategory_id
    ).editing = !subcategories_collapsed.value.find(
        (subcategory) => subcategory.id === subcategory_id
    ).editing;
}

// Cancelar edicion y colapsado de todas las categorias y activar/desactivar la categoria seleccionada
function editCategory(category_id) {
    for (let i = 0; i < categories_collapsed.value.length; i++) {
        categories_collapsed.value[i]["editing"] = false;
        categories_collapsed.value[i]["collapsed"] = true;
    }
    cacheBeforeEditing.value = categories_collapsed.value.find(
        (category) => category.id === category_id
    ).name;
    categories_collapsed.value.find(
        (category) => category.id === category_id
    ).editing = !categories_collapsed.value.find(
        (category) => category.id === category_id
    ).editing;
}

// Cancelar edicion cuando se presiona ESCAPE
const cacheBeforeEditing = ref("");
function cancelEdit(category_id) {
    categories_collapsed.value.find(
        (category) => category.id === category_id
    ).name = cacheBeforeEditing.value;
    for (let i = 0; i < categories_collapsed.value.length; i++) {
        categories_collapsed.value[i]["editing"] = false;
    }
}

// Procesar edicion/eliminacion de la categoria
function doneEditCategory(editedCategory) {
    if (editedCategory.name) {
        store.dispatch("editCategory", editedCategory);
        // .then(() => {
        //     // store.dispatch("getCategories");
        // });
        categories_collapsed.value.find(
            (category) => category.id === editedCategory.id
        ).editing = !categories_collapsed.value.find(
            (category) => category.id === editedCategory.id
        ).editing;
    } else {
        deleteCategory(editedCategory);
    }
}
function deleteCategory(deletedCategory) {
    store.dispatch("deleteCategory", deletedCategory);
    // .then(() => {
    //     store.dispatch("getCategories");
    // });
    store.dispatch("getCategories");
    categories_collapsed.value.splice(
        categories_collapsed.value.indexOf(deleteCategory),
        1
    );
}

// procesar edicion/eliminacion de la subcategoria
function doneEditSubcategory(editedSubcategory) {
    if (editedSubcategory.name) {
        store.dispatch("editSubcategory", editedSubcategory);
        //.then(() => {
        //     // store.dispatch("getCategories");
        // });
    }
}
</script>
