<template>
    <div class="w-full">
        <button
            class="shadow shadow-emerald-900/100 my-2 h-6 w-full border-0 rounded bg-emerald-700 text-sm hover:bg-emerald-500 transition-all duration-200 text-white"
            v-if="crear"
            @click="crear = false"
        >
            <slot></slot>
        </button>
        <input
            @vnode-mounted="({ el }) => el.focus()"
            class="w-full border border-black my-2"
            v-else
            type="input"
            name="agregar"
            v-model="name"
            @keyup.esc="crear = true"
            @blur="crear = true"
            @keydown.enter="$emit('agregar', name, category_id)"
            @keyup.enter="stopCreation"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
    category_id: { type: Number, default: 0 },
});

const crear = ref(true);
const name = ref("");

function stopCreation() {
    crear.value = true;
    name.value = "";
}
</script>
