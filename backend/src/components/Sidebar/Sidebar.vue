<template>
    <div
        class="bg-cyan-600 text-cyan-50 transition-all duration-700 relative flex flex-col items-center"
        :class="collapsed ? 'w-16' : 'w-64'"
    >
        <!-- Se muestra cuando esta colapsada -->
        <div
            class="h-20 pt-5 bg-cyan-700 w-full shadow text-center font-semibold"
        >
            <span class="flex items-center justify-center space-x-5">
                <font-awesome-icon
                    icon="fa-solid fa-mug-saucer"
                    class="w-10 h-10"
                />
                <h1 class="text-2xl" :class="[!collapsed ? '' : 'hidden']">
                    SIDEBAR
                </h1>
            </span>
        </div>
        <div class="mt-10 flex flex-col items-start min-w-full">
            <router-link
                class="flex justify-start space-x-10 items-center w-full text-lg h-12 pl-5 shadow-inner shadow-cyan-800/40 border-teal-900"
                v-for="item in navigation"
                :key="item.name"
                :to="item.to"
                active-class="text-slate-50 bg-teal-500"
                :class="[
                    this.$route.name === item.to.name
                        ? ''
                        : 'hover:bg-teal-400 transition delay-75 hover:scale-110 text-slate-900 bg-cyan-500',
                    'font-medium',
                ]"
            >
                <font-awesome-icon :icon="item.icon" :alt="item.name" />
                <span v-show="!collapsed">{{ item.name }}</span>
            </router-link>
        </div>

        <!-- Icono para colapsar/expandir -->
        <span
            class="absolute bottom-0 left-0 transition duration-700 hover:animate-pulse hover:scale-125 hover:cursor-pointer"
            :class="collapsed ? 'm-4 mx-6' : 'mx-6 my-4 rotate-180'"
            @click="toggleCollapse"
        >
            <font-awesome-icon icon="fa-solid fa-angles-right" />
        </span>
    </div>
</template>

<script setup>
import { ref } from "vue";
import router from "../../router";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
    faAngleDoubleRight,
    faBox,
    faBoxes,
    faBoxesPacking,
    faBoxesStacked,
    faBoxOpen,
    faHome,
    faMugSaucer,
    faStore,
    faStoreAlt,
} from "@fortawesome/free-solid-svg-icons";

const navigation = [
    { name: "Inicio", to: { name: "dashboard" }, icon: "fa-solid fa-home" },
    {
        name: "Almacen",
        to: { name: "almacenes" },
        icon: "fa-solid fa-box-open",
    },
];
library.add(faAngleDoubleRight);
library.add(faMugSaucer);
library.add(faHome);
library.add(faBoxOpen);

// control del collapse de la sidebar
const collapsed = ref(true);
function toggleCollapse() {
    collapsed.value = !collapsed.value;
}
</script>

<style scoped></style>
