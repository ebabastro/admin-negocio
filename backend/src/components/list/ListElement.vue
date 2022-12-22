<template>
<li class="testing px-1 border border-slate-800 text-lg w-full">
	<p>{{element.name}}</p>
</li>
</template>

<script setup>
defineProps({
	element: {type: Object, required:true,},
});
</script>

<style scoped>
	.testing{
		@apply bg-red-300;
	}
</style>