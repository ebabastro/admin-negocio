<template>
    <div class="w-64 bg-slate-50 h-[80%] shadow-inner shadow-slate-500/50 p-2 overflow-y-auto">
    	<ul>
    		<li v-for="category in categories" :key="category.name" 
			class="border-2 border-slate-400 px-1"
			>
				<div class="border-2 flex items-center justify-between">
					<p @click="(categoryId = category.id)" class="cursor-pointer" >{{category.name}}
						<font-awesome-icon v-if="!(categoryId == category.id)" icon="fa-solid fa-plus" />
						<font-awesome-icon v-else icon="fa-solid fa-minus" />
					</p>
					<form @submit.prevent="deleteCategory(category.id)" action="#">
						<input type="hidden" v-model="toDeleteCategory.id">
						<button><font-awesome-icon class="text-xs mr-2 text-red-700" icon="fa-solid fa-trash-can"/></button>
					</form>
				</div>
				<ul class="ml-6">
					<li v-for="subcategory in subcategories" :key="subcategory.id"
					v-show="(subcategory.fk_category_id == category.id && categoryId == category.id)"
					class="border-2 px-1 text-xs"
					:class="(subcategoryId == subcategory.id) ? 'bg-slate-900 text-white' : ''">
						<div class="flex items-center justify-between">
							<p @click="subcategoryId = subcategory.id" class="cursor-pointer w-10">{{subcategory.name}}</p>
							<form @submit.prevent="deleteSubcategory(subcategory.id)" action="#">
								<input type="hidden" v-model="toDeleteSubcategory.id">
								<button><font-awesome-icon class="text-xs mr-2 text-red-700" icon="fa-solid fa-trash-can"/></button>
							</form>
						</div> 
					</li>
					<button
					@click="creatingElement(category.id)"
					v-show="(categoryId == category.id)"
					v-if="!(creatingController == category.id)"
					class="shadow text-xs w-full"
					:id="category.id">
						Nuevo
					</button>
					<form 
						action="#"
						v-else
						@submit.prevent="storeSubcategory(category.id)">
							<div class="flex items-center space-x-1">
								<input type="hidden" :value="category.id" :name="category.id"/>
								<input type="input"
									autofocus
									v-model="newSubcategory.name"
									class="w-full shadow-inner shadow-slate-500/50"
									name="subcategoryName"
									id="subcategoryId"/>
									<span @click="creatingElement(0)" class="cursor-pointer">
										<font-awesome-icon icon="fa-solid fa-xmark" />
									</span>
							</div>
							
					</form>
				</ul>
			</li>
    		<li>
    			<button
    			@click="createCategory"
    			v-if="!creatingCategory"
    			class="shadow text-sm w-full">
    				Nuevo
    			</button>
    			<form
    			v-else
    			@submit="storeCategory"
    			action="#">
    				<div class="flex items-center space-x-1">
	    				<input
	    				v-model="newCategory.name"
	    				class="w-full shadow-inner shadow-slate-500/50"
	    				type="input"
	    				name="categoryName">
						<span @click="createCategory" class="cursor-pointer">
							<font-awesome-icon icon="fa-solid fa-xmark" />
						</span>
    				</div>
    			</form>
				<span class="bg-red-600 text-slate-50" v-show="error.error">{{error.message}}</span>
    		</li>
    	</ul>
    </div>
</template>

<script setup>
import {ref, computed} from "vue"
import store from "../../store"
import { onBeforeMount, onBeforeUpdate } from "@vue/runtime-core"
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faMinus, faPlus, faTrashCan, faXmark } from "@fortawesome/free-solid-svg-icons"

library.add(faXmark)
library.add(faTrashCan)
library.add(faPlus)
library.add(faMinus)

onBeforeMount(()=>{
	// store.dispatch('getProducts');
	store.dispatch('getCategories');
	store.dispatch('getSubcategories');
	 	
})

const subcategoryId = ref();
const categoryId = ref();
const emit = defineEmits(['sendSubcategory_id']);
emit('sendSubcategory_id', subcategoryId)

const categories = computed(() => store.state.categories);
const subcategories = computed(() => store.state.subcategories);
const products = computed(() => store.state.products);
const creatingCategory = ref(false);

function createCategory(){
	creatingCategory.value = !creatingCategory.value;
	error.value.error = false;
}


const creatingController = ref("");
function creatingElement(param){
	creatingController.value = param;
}

let newCategory = {
	name: "",
};

let newSubcategory = {
	fk_category_id: "",
	name: "",
}

let error = ref({
	error: false,
	message: "",
});

function storeCategory(ev){
	ev.preventDefault();
	store.dispatch('storeCategory', newCategory)
		.then(() => {
			categories.value.push(newCategory);
			store.dispatch('getCategories');
		}).catch((err)=>{
			error.value.error = true;
			error.value.message = err.response.data.message;
		});
	creatingCategory.value = false;
	newCategory = {
		name: "",
	};
}

function storeSubcategory(fk_category_id, ev){
	// ev.preventDefault();
	newSubcategory.fk_category_id = fk_category_id;
	store.dispatch('storeSubcategory', newSubcategory)
		.then(() => {
			subcategories.value.push(newSubcategory);
			store.dispatch('getSubcategories');
		}).catch((err)=>{
			error.value.error = true;
			error.value.message = err.response.data.message;
		})
	creatingElement(0);
	newSubcategory = {
		fk_category_id: "",
		name: "",
	}
}

const toDeleteCategory = ref({
	id: "",
})

function deleteCategory(categoryId){
	toDeleteCategory.value.id = categoryId;
	store.dispatch('deleteCategory', toDeleteCategory.value)
		.then(()=>{
			store.dispatch('getCategories');
		});
}

const toDeleteSubcategory = ref({
	id: "",
});
function deleteSubcategory(subcategoryId){
	toDeleteSubcategory.value.id = subcategoryId;
	store.dispatch('deleteSubcategory', toDeleteSubcategory.value)
	.then(()=>{
		store.dispatch('getSubcategories');
	})
}

</script>