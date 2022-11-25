<script setup>
import DashboardComponent from '../components/ContentComponents/DashboardComponent.vue';
import PageComponent from '../components/PageComponent.vue';

</script>
<template>
    <PageComponent>
        <template v-slot:header>
            <div>
                Bienvenido
            </div>
        </template>

        <template v-slot:body>
            <DashboardComponent></DashboardComponent>
        </template>
        
    </PageComponent>
    
</template>



<style scoped>

</style>
