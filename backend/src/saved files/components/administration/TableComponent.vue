<template>
    <div
        class="w-full bg-slate-50 h-[80%] shadow-inner shadow-slate-500/50 p-2 overflow-auto"
    >
        <table
            class="w-full border-collapse border-2 border-slate-500 table text-sm"
        >
            <thead class="">
                <tr>
                    <th class="border border-slate-600 w-10">ID</th>
                    <th class="border border-slate-600 w-56">Nombre</th>
                    <th class="border border-slate-600 w-20">Costo</th>
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
                        {{ product.name }}
                    </td>
                    <td class="border border-collapse border-slate-600">
                        {{ product.cost }}
                    </td>
                    <td
                        class="border border-collapse border-slate-600 text-red-700 text-center text-sm"
                    >
                        <button>
                            <font-awesome-icon icon="fa-solid fa-trash" />
                        </button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td
                        class="border border-collapse border-slate-600 text-2xl text-center text-emerald-700"
                    >
                        <button>
                            <font-awesome-icon icon="fa-solid fa-square-plus" />
                        </button>
                    </td>
                    <td class="border border-collapse border-slate-600"></td>
                    <td class="border border-collapse border-slate-600"></td>
                    <td class="border border-collapse border-slate-600"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { onBeforeMount } from "@vue/runtime-core";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faSquarePlus, faTrash } from "@fortawesome/free-solid-svg-icons";

library.add(faSquarePlus);
library.add(faTrash);

const props = defineProps({
    products: { type: Array, required: true },
    subcategory_id: { type: Number, required: true, default: 0 },
});
</script>
