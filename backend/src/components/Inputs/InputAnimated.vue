<template>
  <div class="">
    <div class="relative">
      <input
        type="text"
        name="animated"
        id="animated"
        class="peer border-b-2 border-slate-600 focus:outline-none h-10 focus:border-indigo-600 transition-colors duration-300"
        placeholder=" "
      />
      <label
        for="animated"
        class="absolute text-indigo-600 transition-all duration-300 cursor-text left-0 -top-3.5 text-sm peer-focus:text-sm peer-focus:text-indigo-600 peer-focus:-top-3.5 peer-placeholder-shown:top-0 peer-placeholder-shown:text-base peer-placeholder-shown:leading-10 peer-placeholder-shown:text-slate-600"
        >
        <slot name="label"></slot>
      </label
      >
    </div>
  </div>
</template>

<script setup>
defineProps({label: String});
</script>

<style scoped></style>
