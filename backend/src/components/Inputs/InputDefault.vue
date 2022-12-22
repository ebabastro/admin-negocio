<template>
  <div class="flex">
    <div class="shadow-sm flex flex-col">
      <label for="default" class="text-lg"><slot name="label"></slot></label>
      <input
        name="default"
        id="default"
        type="text"
        class="default-input"
      />
    </div>
  </div>
</template>

<script setup>
defineProps({});
</script>

<style scoped>
	.default-input{
		@apply border;
		@apply border-slate-600;
		@apply py-2;
		@apply px-1;
		@apply rounded;
		@apply text-slate-600;
		@apply focus:outline-0;
		@apply focus:border;
		@apply focus:border-cyan-600;
	}
</style>
