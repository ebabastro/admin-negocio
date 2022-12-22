<template>
  <div>
    <button
      v-if="!creating"
      @click="create"
      class="bg-emerald-600 w-full rounded border border-emerald-600 text-white py-1 hover:bg-emerald-500 hover:border-emerald-500 transition-all duration-200"
    >
      Agregar
    </button>
    <input
      @vnode-mounted="({ el }) => el.focus()"
      v-else
      @blur="cancelCreate"
      @keyup.esc="$event.target.blur()"
      @keyup.enter="$event.target.blur()"
      @keydown.enter="$emit('doneCreate')"
      type="input"
      class="w-full bg-slate-200 rounded border border-emerald-600 py-1 focus:outline-0 px-1"
      v-model="newElement.name"
    />
  </div>
</template>

<script setup>
import { ref } from "vue";

const creating = ref(false);

function create() {
  creating.value = true;
}
function cancelCreate() {
  creating.value = false;
}

const props = defineProps({
  newElement: { type: Object, required: true },
});
const emits = defineEmits(["doneCreate"]);
</script>
