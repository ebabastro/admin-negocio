<template>
	<div >
		<li class="bg-indigo-300  border p-1">
			<div
				v-if="!category.editing"
				class="flex justify-between"
				@dblclick="category.editing=!category.editing"
			>
				{{category.name}}
				<button  @click="category.collapsed = !category.collapsed">
					<font-awesome-icon icon="fa-solid fa-angle-right"
						:class="category.collapsed ? '' : 'rotate-90'"
						class="transition-all duration-200"
					/>
				</button>
			</div>
			<input
				@vnode-mounted="({el})=>el.focus()"
				v-else
				type="input"
				v-model="category.name"
				@blur="category.editing = false"
				@keyup.esc="$event.target.blur()"
				@keyup.enter="$event.target.blur()"
				@keydown.enter="edit"
				class="w-full"
			/>
		</li>
		<slot name="subcategories"></slot>
	</div>
</template>

<script setup>
import store from "../../store";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faAngleRight } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(faAngleRight);

function edit(){
	if (props.category.name) {
		store.dispatch('editCategory', props.category).then(()=>{
			store.dispatch('getCategories');
		})
	}
	else{
		store.dispatch('deleteCategory', props.category).then(()=>{
			store.dispatch('getCategories');
		})
	}
}


const props = defineProps({
	category: {type: Object, required: true},
})
</script>