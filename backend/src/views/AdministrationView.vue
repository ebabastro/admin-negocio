<template>
  <PageComponent>
    <template v-slot:header>
      <div>Administracion</div>
    </template>

    <template v-slot:body>
      <div class="h-full">
        <ModalFormProduct
          :newProduct = "newProduct"
          :openModal="openModal"
          :subcategory="selected_subcategory"
          @close-modal="closeModal"
          @store-product="saveProduct"
        >

        </ModalFormProduct>
        <div class="p-1 flex space-x-3 bg-slate-300 h-full">

          <div class="bg-slate-50 w-[30%] p-1 flex flex-col justify-between h-full">

              <ul class="p-1 overflow-y-auto">
                <CategoryElement
                  v-for="category in categories"
                  :key="category.id"
                  :category="category"
                >
                  <template v-slot:subcategories>
                    <ul class="ml-6">
                      <SubcategoryElement
                        v-show="category.id == subcategory.fk_category_id"
                        v-if="!category.collapsed"
                        v-for="subcategory in subcategories"
                        :key="subcategory.id"
                        :subcategory="subcategory"
                        @show="showProducts"
                      >
                      </SubcategoryElement>
                    <AddButton
                    class="my-1"
                    v-show="!category.collapsed"
                    :newElement="newSubcategory"
                    @done-create="storeSubcategory(category.id)"></AddButton>
                    </ul>
                  </template>
                </CategoryElement>
              </ul>
              <AddButton :newElement="newCategory" @done-create="storeCategory"></AddButton>
            </div>
            <div class="bg-slate-50 w-full p-2 h-full">
              <h1 v-show="selected_subcategory.id" class="text-3xl text-center bg-green-500 rounded mb-1 p-1">{{selected_subcategory.name}}</h1>
              <div class="w-full flex flex-col items-center justify-between">

              <table v-show="selected_subcategory.id" class="w-full border-2 border-black">
                <tr class="bg-slate-200 text-left">
                  <th class="border border-black w-[10%]">ID</th>
                  <th class="border border-black w-[60%]">Nombre</th>
                  <th class="border border-black w-[20%]">Costo</th>
                  <th class="border border-black w-[5%]"></th>
                  <th class="border border-black w-[5%]"></th>
                </tr>
                  <ProductElement
                    v-for="product in products"
                    :key="product.id"
                    :product="product"
                    v-show="selected_subcategory.id == product.fk_subcategory_id"
                    @edit-product="editProduct"
                    @delete-product="deleteProduct"
                  >

                  </ProductElement>
                </table>
                <div v-if="selected_subcategory.id" class="mt-1">
                  <AddProduct @open-modal="addProduct"></AddProduct>
                </div>
            </div>
            </div>
        </div>
      </div>
  </template>
  </PageComponent>

</template>

<script setup>
import {ref, computed} from "vue";
import {onBeforeMount} from "@vue/runtime-core";
import store from "../store";
import PageComponent from "../components/PageComponent.vue";
import CategoryElement from "../components/list/CategoryElement.vue";
import SubcategoryElement from "../components/list/SubcategoryElement.vue";
import ProductElement from "../components/list/ProductElement.vue";
import AddButton from "../components/buttons/AddButton.vue";
import AddProduct from "../components/buttons/AddProduct.vue";
import ModalFormProduct from "../components/modals/ModalFormProduct.vue";

onBeforeMount(()=>{
  store.dispatch('getCategories');
  store.dispatch('getSubcategories');
  store.dispatch('getProducts');
})

const newCategory = ref({
  name: "",
})
const newSubcategory = ref({
  name: "",
  fk_category_id: "",
})
const newProduct = ref({
  id: "",
  name: "",
  fk_subcategory_id: "",
  cost: 0,
})

const categories = computed(()=>store.state.categories);
const subcategories = computed(()=>store.state.subcategories);
const products = computed(()=>store.state.products);

const selected_subcategory = ref({});
function showProducts(subcategory){

  for (var i = 0; i < subcategories.value.length; i++) {
    subcategories.value[i].collapsed = true;
  }
  subcategory.collapsed = false;
  selected_subcategory.value = subcategory;
}

function storeCategory(){
  store.dispatch('storeCategory', newCategory.value).then(()=>{
    store.dispatch('getCategories');
  });
  newCategory.value.name = "";
}

function storeSubcategory(category_id){
  newSubcategory.value.fk_category_id = category_id;
  store.dispatch('storeSubcategory', newSubcategory.value).then(()=>{
    store.dispatch('getSubcategories');
  })
  newSubcategory.value.name = "";
  newSubcategory.value.fk_category_id = "";
}
const editing = ref(false);
function saveProduct(){
  if(editing.value){
    store.dispatch('editProduct', newProduct.value).then(()=>{
      store.dispatch('getProducts');
    })
  }
  else{
    store.dispatch('storeProduct', newProduct.value).then(()=>{
      store.dispatch('getProducts');
    })
  }
  openModal.value = false;
  newProduct.value.name = "";
  newProduct.value.cost = 0;
}
function editProduct(product){
  newProduct.value.id = product.id;
  newProduct.value.name = product.name;
  newProduct.value.cost = product.cost;
  newProduct.value.fk_subcategory_id = selected_subcategory.value.id;
  openModal.value = true;
  editing.value = true;
}
function deleteProduct(product){
  store.dispatch('deleteProduct', product).then(()=>{
    store.dispatch('getProducts');
  })
}

const openModal = ref(false);
function addProduct(){
  newProduct.value.name = "";
  newProduct.value.cost = "";
  newProduct.value.fk_subcategory_id = selected_subcategory.value.id;
  editing.value = false;
  openModal.value = true;
}
function closeModal(){
  openModal.value = false;
}
</script>

<style scoped></style>
