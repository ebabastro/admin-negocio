<template>
    
</template>

<script setup>
import {ref, computed} from "vue";
import { onBeforeMount } from "@vue/runtime-core"
import store from "../../store";

const props = defineProps({
    subcategoryId: Number
})

const products = computed(()=>store.state.products);
onBeforeMount(()=>{
    store.dispatch('getProducts');
})




</script>