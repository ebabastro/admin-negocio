<script setup>
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
            <div>
                Body
            </div>
        </template>
        
    </PageComponent>
    
</template>



<style scoped>

</style>
