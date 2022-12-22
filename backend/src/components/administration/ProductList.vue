<template>
  <div class="bg-slate-50 w-full p-1">
    <table class="border border-collapse w-full">
      <thead>
        <th class="font-normal border bg-slate-300">ID</th>
        <th class="font-normal border bg-slate-300">Nombre</th>
        <th class="font-normal border bg-slate-300">Costo</th>
      </thead>
      <tr v-for="product in products" :key="product.id">
        <td class="border px-1">{{ product.id }}</td>
        <td class="border px-1">{{ product.name }}</td>
        <td class="border px-1">{{ product.cost }}</td>
      </tr>
    </table>
  </div>
</template>

<script setup>
import { ref } from "vue";

const toShow = ref(false);

function visibility() {}

const props = defineProps({
  subcategories: { type: Array, required: true },
  products: { type: Array, required: true },
});
</script>
