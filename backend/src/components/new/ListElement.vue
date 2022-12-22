<template>
	<div>
		<li>
			<div
				v-if="!editing"
				@dblclick="edit"
				class="bg-indigo-200 border">
					{{element.name}}
				</div>
			<input
				@vnode-mounted="({el})=>el.focus()"
				@blur="cancelEdit"
				@keyup.esc="$event.target.blur()"
				@keyup.enter="$event.target.blur()"
				@keydown.enter="$emit('doneEdit')"
				v-else
				type="input"
				name="edition"
				class="w-full border"
				v-model="element.name" />
		</li>
	</div>
</template>

<script setup>
import {ref} from "vue";
import store from "../../store";


const editing = ref(false);
// const toggleEditing = () => {editing.value = !editing.value};

function edit(){
	cache.value = props.element.name;
	editing.value = true;
}
const cache = ref("");
function cancelEdit(){
	editing.value = false;
	props.element.name = cache.value;
}

const emits = defineEmits(['doneEdit']);

const props = defineProps({
	element: {type:Object, required:true},
});
</script>