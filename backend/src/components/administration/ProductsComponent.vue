<template>
    <div
        class="w-full bg-slate-50 h-[100%] shadow-inner shadow-slate-500/50 p-2 overflow-auto flex flex-col items-center justify-between"
    >
        <table
            class="w-full border-collapse border-2 border-slate-500 table text-sm"
        >
            <thead class="shadow bg-slate-200">
                <tr>
                    <th class="border border-slate-600 w-10">ID</th>
                    <th class="border border-slate-600 w-56">Nombre</th>
                    <th class="border border-slate-600 w-20">Costo</th>
                    <th class="border border-slate-600 w-4"></th>
                    <th class="border border-slate-600 w-4"></th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="product in products"
                    :key="product.id"
                    v-show="product.fk_subcategory_id == subcategory_id"
                >
                    <td class="border border-collapse border-slate-600">
                        {{ product.id }}
                    </td>
                    <td class="border border-collapse border-slate-600">
                        <p class="w-full">
                            {{ product.name }}
                        </p>
                    </td>
                    <td class="border border-collapse border-slate-600">
                        <p class="w-full">
                            {{ product.cost }}
                        </p>
                    </td>
                    <td
                        class="border border-collapse border-slate-600 text-orange-300 text-center text-sm"
                    >
                        <button @click="$emit('editModalForm', product)">
                            <font-awesome-icon
                                icon="fa-solid fa-pen-to-square"
                            />
                        </button>
                    </td>
                    <td
                        class="border border-collapse border-slate-600 text-red-700 text-center text-sm"
                    >
                        <button @click="$emit('deleteProduct', product)">
                            <font-awesome-icon icon="fa-solid fa-trash" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <slot></slot>
        <button
            v-show="subcategory_id != 0"
            @click="$emit('showModalForm')"
            class="bg-cyan-600 p-1 px-3 text-slate-50 font-semibold rounded shadow shadow-emerald-900/100 hover:bg-teal-500 transition-all duration-200"
        >
            <p>Agregar Producto</p>
        </button>
    </div>
</template>

<script setup>
// import AgregarProductComponent from "./AgregarProductComponent.vue"
import { ref } from "vue";
import { onBeforeMount } from "@vue/runtime-core";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
    faPenToSquare,
    faSquarePlus,
    faTrash,
} from "@fortawesome/free-solid-svg-icons";

library.add(faSquarePlus);
library.add(faTrash);
library.add(faPenToSquare);

const creatingProduct = ref(false);

const newProduct = ref({
    name: "",
    fk_subcategory_id: "",
    cost: 0,
});
defineEmits(["showModalForm", "editModalForm", "deleteProduct"]);
defineProps({
    products: { type: Array, required: true },
    subcategory_id: { type: Number, required: true, default: 0 },
});
</script>
