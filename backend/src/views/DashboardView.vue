<script setup>
import { onBeforeMount } from "@vue/runtime-core";
import store from "../store";
import DashboardComponent from "../components/ContentComponents/DashboardComponent.vue";
import PageComponent from "../components/PageComponent.vue";

onBeforeMount(() => {
  store.dispatch("getCategories");
  store.dispatch("getSubcategories");
  store.dispatch("getProducts");
});
</script>
<template>
  <PageComponent>
    <template v-slot:header>
      <div>Bienvenido</div>
    </template>

    <template v-slot:body>
      <DashboardComponent></DashboardComponent>
    </template>
  </PageComponent>
</template>

<style scoped></style>
