<script setup>
import PageComponent from "../components/PageComponent.vue";
</script>

<template>
  <PageComponent>
    <template v-slot:header>
      <div>Almacenes</div>
    </template>

    <template v-slot:body>
    	<div class="w-full h-full bg-slate-300 p-1">
    		<div class="bg-white w-[30%] h-full"></div>
    	</div>
    </template>
  </PageComponent>
</template>

<style scoped></style>
