<template>
    <div class="flex space-x-6 justify-center">
        <ActionComponent class="w-28 h-28 bg-slate-50 relative border-8 border-slate-500 shadow shadow-slate-500/100 hover:scale-110 transition-all duration-100"
            v-for="item in items"
            :key="item.name"
            :to="item.to">
                <font-awesome-icon :icon="item.icon" class="w-full h-full text-teal-700"/>
        </ActionComponent>
    </div>
</template>

<script setup>
import ActionComponent from '../Helpers/ActionComponent.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faBox, faSackDollar, faHome, faHammer } from '@fortawesome/free-solid-svg-icons';

library.add(faBox)
library.add(faSackDollar)
library.add(faHome)
library.add(faHammer)

const items = [
    {name: 'Almacenes', icon: "fa-solid fa-box", to: { name: 'almacenes'} ,},
    // {name: 'Test', icon: "fa-solid fa-sack-dollar", to: { name: 'economia'},},
    {name: 'Administracion', icon: "fa-solid fa-hammer", to: { name: 'administration'},},
]
</script>