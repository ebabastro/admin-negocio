<template>
	<div>
		<ul>
			<ListElement v-for="(element, index) in list" :key="element.id" :element="element">

			</ListElement>
			<InputAnimated class="mt-5">
				<template v-slot:label>
				{{list_type}}
				</template>
			</InputAnimated>
		</ul>
	</div>
</template>

<script setup>
import {ref} from "vue";
import {onBeforeMount} from "@vue/runtime-core";
import ListElement from "./ListElement.vue";
import InputAnimated from "../Inputs/InputAnimated.vue";

defineProps({
	list:{type: Array, required: true,},
	list_type: String,
})

</script>