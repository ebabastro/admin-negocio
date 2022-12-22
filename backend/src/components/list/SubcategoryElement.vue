<template>
		<div class="">
			<li
				class="bg-green-300 border p-1 "
				:class="subcategory.collapsed ? '' : 'bg-green-700 text-white'"

			>
				<div
					v-if="!subcategory.editing"
					class="flex justify-between"
					@dblclick="subcategory.editing=!subcategory.editing"
				>
					{{subcategory.name}}
					<button @click="$emit('show', subcategory)" class="text-white">
						<font-awesome-icon icon="fa-solid fa-eye"
							v-if="subcategory.collapsed"
							class="transition-all duration-200"
						/>
						<font-awesome-icon icon="fa-solid fa-minus"
							v-else
						/>
					</button>
				</div>
				<input
					@vnode-mounted="({el})=>el.focus()"
					v-else
					type="input"
					v-model="subcategory.name"
					@blur="subcategory.editing = false"
					@keyup.esc="$event.target.blur()"
					@keyup.enter="$event.target.blur()"
					@keydown.enter="edit"
					class="w-full"
				/>
			</li>

		</div>


</template>

<script setup>
import store from "../../store";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faEye, faMinus } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(faEye);
library.add(faMinus);

function edit(){
	if(props.subcategory.name){
		store.dispatch('editSubcategory', props.subcategory).then(()=>{
			store.dispatch('getSubcategories');
		})
	}
	else{
		store.dispatch('deleteSubcategory', props.subcategory).then(()=>{
			store.dispatch('getSubcategories');
		})
	}
}

const props = defineProps({
	subcategory:{type:Object, required:true},
})
const emits = defineEmits(['show'])
</script>