<template>
		<tr>
			<td class="border border-black">{{product.id}}</td>
			<td class="border border-black">{{product.name}}</td>
			<td class="border border-black">{{product.cost}}</td>
			<td class="border border-black text-center text-yellow-600">
				<button @click="$emit('editProduct', product)">
					<font-awesome-icon icon="fa-solid fa-pen-to-square" />
				</button>
			</td>
			<td class="border border-black text-center text-red-800">
				<button @click="$emit('deleteProduct', product)"><font-awesome-icon icon="fa-solid fa-trash" />
				</button>
			</td>
		</tr>
</template>

<script setup>
import { library } from "@fortawesome/fontawesome-svg-core";
import { faTrash, faPenToSquare } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(faTrash);
library.add(faPenToSquare);
const props = defineProps({
	product: {type:Object, required:true},
})
const emits = defineEmits(['editProduct','deleteProduct'])
</script>