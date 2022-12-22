<template>
<div>
	<li v-show="visibility" class="shadow shadow-slate-900/100">
		<div class="border border-slate-500 flex justify-between"
			:class="!element.collapsed ? 'bg-slate-200' : ''">
			<div

				class="w-full"
			  >
				<p
					@dblclick="$emit('toggleEditing', index)"
					v-if="!element.editing"
					class="pl-2"
				  >
					{{element.name}}
				</p>
				<input
					class="w-full pl-2"
					@vnode-mounted="({ el }) => el.focus()"
					v-else
					type="input"
					name="element_name"
					@keyup.esc="$emit('cancelEdit', index)"
					@blur="$emit('cancelEdit', index)"
					@keyup.enter="$emit('doneEdit', element)"
					v-model="element.name"
				  >
			</div>
			<button @click="$emit('toggleCollapse')" class="text-lg">
				<div v-show="!element.editing" v-if="!isSubcategory">
					<font-awesome-icon v-if="element.collapsed" icon="fa-solid fa-plus"/>
					<font-awesome-icon v-else icon="fa-solid fa-minus" />
				</div>
				<div class="text-xs" v-show="!element.editing" v-else @click="$emit('showProducts', element.id, index)">
					<font-awesome-icon v-if="element.collapsed" icon="fa-solid fa-eye" />
					<font-awesome-icon v-else icon="fa-solid fa-minus" />
				</div>
			</button>

		</div>
		<slot></slot>
	</li>
</div>
</template>

<script setup>
import { library } from "@fortawesome/fontawesome-svg-core";
import { faPlus, faMinus, faEye } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faPlus);
library.add(faMinus);
library.add(faEye);


const props = defineProps({
	element: {type: Object, required: true},
	index: Number,
	visibility: {type:Boolean, default:true},
	isSubcategory : {type: Boolean,},
	// id: Number,
	// name: String,
	// collapsed: Boolean,
	// editing: Boolean
});
</script>