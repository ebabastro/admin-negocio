<template>
   <div class="bg-slate-300 shadow shadow-slate-500/50 h-full flex space-x-6 relative p-2">
   	<div class="h-full bg-white p-2 w-[30%]">
   		<CategoryList :categories="categories"></CategoryList>
   	</div>
   </div>
</template>

<script setup>
import {ref, computed} from "vue";
import {onBeforeMount} from "@vue/runtime-core";
import store from "../../store";
import CategoryList from "../new/CategoryList.vue";

onBeforeMount(()=>{
	store.dispatch('getCategories');
});

const categories = computed(()=>store.state.categories);

</script>