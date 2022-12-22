<template>
<div>
	<button
		@click="$emit('openModal')"
		class="bg-emerald-600 rounded py-2 px-1 w-48 text-white hover:bg-emerald-500 transition-all duration-200 shadow-md shadow-slate-900/100">
		Agregar Producto
	</button>
</div>
</template>

<script setup>
const emits = defineEmits(['openModal'])
</script>