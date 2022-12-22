<template>
	<div>
		<transition name="modal-outer">
			<div v-show="modalActive" class="absolute bg-black opacity-30 inset-0"></div>
		</transition>
		<transition name="modal-inner">
			<div v-if="modalActive" class="absolute inset-0 flex flex-col mx-auto justify-center items-center">
				<div class="bg-white flex flex-col rounded">
					<header class="bg-slate-200 rounded-t border border-b-black p-3">
						<h1 class="text-2xl">Agregar Producto</h1>
					</header>
					<div name="body" class="p-3 border border-b-black flex flex-col space-y-2">
						<h1 class="text-xl">Subcategoria a la que pertenece</h1>
						<div class="">
							<!-- <label for="product_name">Nombre</label> -->
							<input class="rounded border" type="input" name="product_name" placeholder="Nombre">
						</div>
						<div>
							<!-- <label for="product_cost">Costo</label> -->
							<input class="rounded border" type="input" name="product_cost" placeholder="Costo">
						</div>
					</div>
					<footer class="p-3">
						<button  @click="$emit('closeModal')"
								class="bg-red-600 rounded px-2 text-white">
							Cancel
						</button>
					</footer>
				</div>
			</div>
		</transition>
	</div>
</template>

<script setup>
defineProps({
	modalActive: {type: Boolean, required: true, default: false}
});
</script>

<style scoped>

</style>