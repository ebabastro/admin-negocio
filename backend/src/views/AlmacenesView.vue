<script setup>
import ProductComponent from '../components/ContentComponents/ProductComponent.vue';
import PageComponent from '../components/PageComponent.vue';


</script>

<template>

    <PageComponent>
        <template v-slot:header>
            <div>
                Almacenes
            </div>
        </template>

        <template v-slot:body>
            <ProductComponent></ProductComponent>
        </template>

    </PageComponent>
</template>

<style scoped>

</style>
