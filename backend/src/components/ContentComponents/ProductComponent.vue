<template>
   <div>
      <pre>{{categories}}</pre>
   </div>
</template>

<script setup>
import { ref } from "vue";
import store from "../../store"
import { onBeforeMount } from "@vue/runtime-core"

onBeforeMount(()=>{
   store.dispatch('getCategories');
})

const categories = store.state.categories;
</script>