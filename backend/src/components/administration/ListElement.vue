<template>
  <div class="rounded">
    <div
      v-if="!editing"
      class="flex justify-between border border-slate-50 px-1 items-center bg-blue-400 py-1"
    >
      <li @dblclick="edit" class="flex justify-between w-full">
        {{ element.name }}
      </li>
      <button @click="$emit('show')">
        <slot name="icon"></slot>
      </button>
    </div>
    <input
      @blur="cancelEdit"
      @keyup.esc="$event.target.blur()"
      @keyup.enter="$event.target.blur()"
      @keydown.enter="$emit('doneEdit')"
      @vnode-mounted="({ el }) => el.focus()"
      v-else
      type="input"
      class="rounded w-full bg-slate-200 px-1 focus:outline-0 focus:border focus:border-slate-600 py-1"
      v-model="element.name"
    /><slot name="subcategory"></slot>
  </div>
</template>

<script setup>
import { ref } from "vue";

const editing = ref(false);
const cache = ref("");
// Edicion de elemento
function edit() {
  cache.value = props.element.name;
  editing.value = true;
}
function cancelEdit() {
  editing.value = false;
  props.element.name = cache.value;
}

const props = defineProps({
  element: { type: Object, required: true },
});

const emits = defineEmits(["doneEdit", "show"]);
</script>
