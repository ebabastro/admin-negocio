<template>
  <div class="flex flex-col h-auto">
    <div class="relative shadow-sm w-max-auto">
      <input
        name="overlapp"
        id="overlapp"
        type="text"
        class="border border-slate-900 py-2 px-1 rounded text-slate-900 focus:outline-0 focus:border focus:border-cyan-600 focus:ring-0"
      />
      <label
        for="overlapp"
        class="absolute -top-3 left-2 z-10 bg-white px-1 text-lg p-0 leading-4"
      >
        <slot name="label"></slot>
      </label>
    </div>
  </div>
</template>

<script setup>
defineProps({});
</script>

<style scoped></style>
