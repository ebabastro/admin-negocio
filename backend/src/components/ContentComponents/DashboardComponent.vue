<template>
    <div class="flex space-x-6">
        <ActionComponent class="w-28 h-28 bg-slate-50 relative border-8 border-slate-500"
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
import { faBox, faSackDollar, faHome } from '@fortawesome/free-solid-svg-icons';

library.add(faBox)
library.add(faSackDollar)
library.add(faHome)

const items = [
    {name: 'Admin Products', icon: "fa-solid fa-box", to: { name: 'products'} },
    {name: 'Economia Tests', icon: "fa-solid fa-sack-dollar", to: { name: 'almacenes'},}
]
</script>