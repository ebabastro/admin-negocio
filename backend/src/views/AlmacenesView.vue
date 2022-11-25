<script setup>
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
            <div>
                Menu
            </div>
        </template>

    </PageComponent>
</template>

<style scoped>

</style>
