<template>
  <div class="bg-slate-50 w-[30%] h-full flex flex-col justify-between p-1 overflow-y-auto">
    <ul class="">
      <ListElement
        v-for="(category, index) in categories"
        :key="category.id"
        :element="category"
        @done-edit="doneEdit(category)"
        @show="toggleCollapse(index)"
      >
        <template v-slot:icon>
          <font-awesome-icon
            class="transition-all duration-200"
            :class="category.collapsed ? '' : 'rotate-90'"
            icon="fa-solid fa-angle-right"
          />
        </template>
        <slot name="subcategory"></slot>
      </ListElement>
    </ul>
    <div class="">
      <AddButton :newElement="newElement" @done-create="doneCreate"></AddButton>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { onBeforeMount } from "@vue/runtime-core";
import store from "../../store";
import ListElement from "./ListElement.vue";
import AddButton from "./AddButton.vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faAngleRight } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(faAngleRight);



function toggleCollapse(index) {
  props.categories[index].collapsed = !props.categories[index].collapsed;
}

function doneEdit(category) {
  if (category.name) {
    store.dispatch("editCategory", category).then(() => {
      store.dispatch("getCategories");
    });
  } else {
    store.dispatch("deleteCategory", category).then(() => {
      store.dispatch("getCategories");
    });
  }
}

const newElement = ref({
  name: "",
});
function doneCreate() {
  store.dispatch("storeCategory", newElement.value).then(() => {
    store.dispatch("getCategories");
    newElement.value.name = "";
  });
}

const props = defineProps({
  categories:{type:Array, required:true},
})
</script>
