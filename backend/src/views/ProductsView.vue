<template>

  <PageComponent>
        <template v-slot:header>
            Administración
        </template>
        <template v-slot:body>
            <div class="bg-slate-300 shadow shadow-slate-500/50 p-2 h-96 flex space-x-6">
                <LeftPanelComponent @sendSubcategory_id="(sendedId) => newProduct.fk_subcategory_id = sendedId">

                </LeftPanelComponent>
                <!-- <pre>{{newProduct}}</pre> -->
                <div class="w-full bg-slate-50 h-[80%] shadow-inner shadow-slate-500/50 p-2 overflow-auto">
                    <!-- <pre>{{subcategoryId}}</pre> -->
                    <table class="w-full border-collapse border-2 border-slate-500 table text-sm">
                        
                        <thead class="">
                            <tr>
                                <th class="border border-slate-600 w-10">ID</th>
                                <th class="border border-slate-600 w-56">Nombre</th>
                                <th class="border border-slate-600 w-20">Costo</th>
                                <th class="border border-slate-600 w-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <tr v-for="product in products" :key="product.id"
                                    v-show="(product.fk_subcategory_id == newProduct.fk_subcategory_id)">
                                    <td class="border border-collapse border-slate-600">{{product.id}}</td>
                                    <td class="border border-collapse border-slate-600">{{product.name}}</td>
                                    <td class="border border-collapse border-slate-600">{{product.cost}}</td>
                                    <td class="border border-collapse border-slate-600 text-center text-red-700">
                                        <form @submit.prevent="deleteProduct(product.id)" action="">
                                            <input type="hidden" v-model="toDeleteProduct.id">
                                            <button type="submit"><font-awesome-icon icon="fa-solid fa-trash-can" /></button>
                                        </form>
                                    </td>
                                </tr>
                        </tbody>
                        <tfoot v-show="newProduct.fk_subcategory_id">
                            <tr class="">
                                <td class="border border-collapse border-slate-600 text-2xl text-emerald-700 text-center">
                                    <button form="form-store-product">
                                        <font-awesome-icon  class="cursor-pointer" icon="fa-solid fa-square-plus" 
                                        />
                                    </button>
                                </td>
                                <td class="border border-collapse border-slate-600">
                                    <input v-model="newProduct.name" name="product_name" form="form-store-product" class="w-[95%] border m-1" type="input">
                                </td>
                                <td class="border border-collapse border-slate-600">
                                    <input v-model="newProduct.cost" name="product_cost" form="form-store-product" class="w-[90%] border m-1" type="number" min="0"/>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <form id="form-store-product" @submit.prevent="storeProduct" action="#">
                        <input type="hidden" v-model="newProduct.fk_subcategory_id">
                    </form>
                    <!-- <pre>{{newProduct}}</pre> -->
                </div>                
            </div>
        </template>


    </PageComponent>

</template>

<script setup>
import LeftPanelComponent from '../components/Helpers/LeftPanelComponent.vue';
import ProductPanelComponent from '../components/Helpers/ProductPanelComponent.vue';
import PageComponent from '../components/PageComponent.vue';
import {ref, computed} from "vue";
import { onBeforeMount } from "@vue/runtime-core"
import store from "../store";

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faSquarePlus, faTrashCan } from '@fortawesome/free-solid-svg-icons';

library.add(faSquarePlus)
library.add(faTrashCan)

const creatingProduct = ref(false);

const products = computed(()=>store.state.products);
onBeforeMount(()=>{
    store.dispatch('getProducts');
})

// const subcategoryId = ref();

const newProduct = ref({
    name: "",
    fk_subcategory_id: 0,
    cost: 0,
});
let error = ref({
	error: false,
	message: "",
});
function storeProduct(){
    // newProduct.fk_subcategory_id = subcategoryId;
    store.dispatch('storeProduct', newProduct.value)
		.then(() => {
			products.value.push(newProduct);
			store.dispatch('getProducts');
		}).catch((err)=>{
			error.value.error = true;
			error.value.message = err.response.data.message;
		})
    newProduct.value.name = "";
    newProduct.value.cost = 0;
}

const toDeleteProduct = ref({
    id: "",
})

function deleteProduct(productId) {
    toDeleteProduct.value.id = productId;
    store.dispatch('deleteProduct', toDeleteProduct.value)
        .then(() => {
            // products.value.splice(products.value.indexOf(newProduct), 1);
            store.dispatch('getProducts');
        })
}
</script>

<style scoped>
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>