<template>
    
  <PageComponent>
        <template v-slot:header>
            Administración
        </template>
        <template v-slot:body>
            <div class="bg-slate-200 shadow shadow-slate-500/50 p-2 h-96">
                <LeftPanelComponent>
                    
                </LeftPanelComponent>
            </div>
        </template>


    </PageComponent>
    
</template>

<script setup>
import LeftPanelComponent from '../components/Helpers/LeftPanelComponent.vue';
import PageComponent from '../components/PageComponent.vue';
</script>