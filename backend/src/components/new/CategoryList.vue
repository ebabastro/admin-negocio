<template>
	<div>
		<ul>
			<ListElement
				v-for="category in categories"
				:key="category.id"
				:element="category"
				@done-edit = "editCategory(category)">

			</ListElement>
		</ul>
	</div>
</template>

<script setup>
import {ref} from "vue";
import store from "../../store";
import ListElement from "./ListElement.vue";

function editCategory(category){
	store.dispatch('editCategory', category)
	.then(()=>{
		store.dispatch('getCategories');
	})
}

const props = defineProps({
	categories: {type:Array, required: true},
});
</script>