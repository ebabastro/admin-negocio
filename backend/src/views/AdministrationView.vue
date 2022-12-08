<template>
    <PageComponent>
        <template v-slot:header>
            Administracion
            <!-- //añadir reload a la pagina
		//agregar, editar, eliminar productos
		//agregar efecto de loading -->
        </template>
        <template v-slot:body>
            <div
                class="bg-slate-300 shadow shadow-slate-500/50 p-2 h-96 flex space-x-6 relative"
            >
                <div
                    class="flex flex-col justify-between items-center relative w-64 bg-slate-50 h-full shadow-inner shadow-slate-500/50 p-2 overflow-y-auto"
                >
                    <ul class="w-full">
                        <CategoryComponent
                            v-for="(category, index) in categories"
                            :key="category.id"
                            :index="index"
                            :element="category"
                            @toggleCollapse="
                                category.collapsed = !category.collapsed
                            "
                            @toggleEditing="editingCategory"
                            @cancelEdit="cancelEditCategory"
                            @doneEdit="doneEditCategory"
                        >
                            <ul class="ml-6">
                                <CategoryComponent
                                    class="bg-slate-50"
                                    v-for="(
                                        subcategory, index
                                    ) in subcategories"
                                    :key="subcategory.id"
                                    :index="index"
                                    :element="subcategory"
                                    :visibility="
                                        !category.collapsed &&
                                        subcategory.fk_category_id ==
                                            category.id
                                    "
                                    :isSubcategory="true"
                                    @showProducts="showProducts"
                                    @doneEdit="doneEditSubcategory"
                                    @toggleEditing="editingSubcategory"
                                    @cancelEdit="cancelEditSubcategory"
                                >
                                    <ModalError
                                        :openModal="error.value"
                                        @close-modal="toggleModalError"
                                    >
                                        <p>{{ error.message }}</p>
                                    </ModalError>
                                </CategoryComponent>
                                <AgregarComponent
                                    @agregar="addSubcategory"
                                    v-show="!category.collapsed"
                                    :category_id="category.id"
                                >
                                    Agregar Subcategoria
                                </AgregarComponent>
                            </ul>
                        </CategoryComponent>
                    </ul>
                    <AgregarComponent @agregar="addCategory"
                        >Agregar Categoria</AgregarComponent
                    >

                    <ModalError
                        :openModal="error.error"
                        @close-modal="toggleModalError"
                    >
                        <p>{{ error.message }}</p>
                    </ModalError>
                </div>
                <ProductsComponent
                    :products="products"
                    :subcategory_id="selected_subcategory.id"
                    @addProduct="addProduct"
                    @showModalForm="openModalForm"
                    @editModalForm="editModalForm"
                    @deleteProduct="deleteProduct"
                >
                    <ModalFormProduct
                        :editing="editingProduct"
                        :subcategory="selected_subcategory"
                        :newProduct="toAddProduct"
                        :openModal="modalActive"
                        @close-modal="closeModalForm"
                        @store-product="addProduct"
                    ></ModalFormProduct>
                </ProductsComponent>

                <!-- <pre>{{ toAddProduct }}</pre> -->
            </div>
        </template>
    </PageComponent>
</template>

<script setup>
import { ref, computed } from "vue";
import ModalFormProduct from "../components/modals/ModalFormProduct.vue";
import PageComponent from "../components/PageComponent.vue";
import CategoryComponent from "../components/administration/CategoryComponent.vue";
import ProductsComponent from "../components/administration/ProductsComponent.vue";
import AgregarComponent from "../components/administration/AgregarComponent.vue";
import { onBeforeMount } from "@vue/runtime-core";
import store from "../store";
import ModalError from "../components/modals/ModalError.vue";

onBeforeMount(() => {
    store.dispatch("getCategories");
    store.dispatch("getSubcategories");
    store.dispatch("getProducts");
});
// Controlar abrir/cerrar modales de error

const toggleModalError = () => {
    error.value.error = !error.value.error;
};

const error = ref({
    error: false,
    message: "",
});

// Controlar abrir/cerrar modal de formulario
const editingProduct = ref(false);
const modalActive = ref(false);
function editModalForm(product) {
    modalActive.value = true;
    toAddProduct.value.id = product.id;
    toAddProduct.value.name = product.name;
    toAddProduct.value.cost = product.cost;
    editingProduct.value = true;
}
function openModalForm() {
    modalActive.value = true;
}
const closeModalForm = () => {
    modalActive.value = false;
    toAddProduct.value.name = "";
    toAddProduct.value.cost = 0;
};

const categories = computed(() => store.state.categories);
const subcategories = computed(() => store.state.subcategories);
const products = computed(() => store.state.products);

// Añadir controladores de colapso/edicion a los arrays

// Function de edition de categoria
function editingCategory(index) {
    cacheBeforeEditing.value = categories.value[index].name;
    categories.value[index].editing = true;
}

// Cancelar edicion de todos los elementos
const cacheBeforeEditing = ref();
function cancelEditCategory(index) {
    categories.value[index].name = cacheBeforeEditing.value;
    for (var i = 0; i < categories.value.length; i++) {
        categories.value[i].editing = false;
    }
}

// Editada la categoria
function doneEditCategory(category) {
    if (category.name) {
        store.dispatch("editCategory", category).then(() => {
            store.dispatch("getCategories");
        });
        for (var i = 0; i < categories.value.length; i++) {
            categories.value[i].editing = false;
        }
    } else {
        store.dispatch("deleteCategory", category);
        categories.value.splice(categories.value.indexOf(category), 1);
        for (var i = 0; i < categories.value.length; i++) {
            categories.value[i].editing = false;
        }
    }
}

// Mostrar productos
const selected_subcategory = ref({});
function showProducts(subcategory, index) {
    selected_subcategory.value = subcategory;
    for (var i = 0; i < subcategories.value.length; i++) {
        subcategories.value[i].collapsed = true;
    }
    subcategories.value[index].collapsed = false;
}

// Agregar categoria
const newCategory = ref({
    name: "",
});
function addCategory(name) {
    newCategory.value.name = name;
    store
        .dispatch("storeCategory", newCategory.value)
        .then(() => {
            store.dispatch("getCategories");
        })
        .catch((err) => {
            error.value.error = true;
            error.value.message = err.response.data.message;
        });
}

// Agregar subcategoria
const newSubcategory = ref({
    fk_category_id: "",
    name: "",
});
function addSubcategory(name, category_id) {
    newSubcategory.value.fk_category_id = category_id;
    newSubcategory.value.name = name;
    store
        .dispatch("storeSubcategory", newSubcategory.value)
        .then(() => {
            store.dispatch("getSubcategories");
        })
        .catch((err) => {
            error.value.error = true;
            error.value.message = err.response.data.message;
        });
}

// Editando la subcategoria
function editingSubcategory(index) {
    cacheBeforeEditing.value = subcategories.value[index].name;
    subcategories.value[index].editing = true;
}

// Cancelando la edicion de subcategoria
function cancelEditSubcategory(index) {
    subcategories.value[index].name = cacheBeforeEditing.value;
    for (var i = 0; i < subcategories.value.length; i++) {
        subcategories.value[i].editing = false;
    }
}

// Editada la subcategoria
function doneEditSubcategory(subcategory) {
    if (subcategory.name) {
        store.dispatch("editSubcategory", subcategory).then(() => {
            store.dispatch("getSubcategories");
        });
        for (var i = 0; i < subcategories.value.length; i++) {
            subcategories.value[i].editing = false;
        }
    } else {
        store.dispatch("deleteSubcategory", subcategory);
        subcategories.value.splice(subcategories.value.indexOf(subcategory), 1);
        for (var i = 0; i < subcategories.value.length; i++) {
            subcategories.value[i].editing = false;
        }
    }
}

// Agregar producto
const toAddProduct = ref({
    id: "",
    name: "",
    cost: 0,
    fk_subcategory_id: "",
});
function addProduct(newProduct, subcategory_id, editing) {
    toAddProduct.value.name = newProduct.name;
    toAddProduct.value.cost = newProduct.cost;
    toAddProduct.value.fk_subcategory_id = subcategory_id;
    if (editing) {
        store.dispatch("editProduct", newProduct).then(() => {
            store.dispatch("getProducts");
            closeModalForm();
        });
    } else {
        store.dispatch("storeProduct", toAddProduct.value).then(() => {
            store.dispatch("getProducts");
            closeModalForm();
        });
    }
}

function deleteProduct(product) {
    store.dispatch("deleteProduct", product).then(() => {
        store.dispatch("getProducts");
    });
}
</script>
