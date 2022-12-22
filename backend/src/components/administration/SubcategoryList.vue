<template>
  <div class="pl-4">
    <ul class="">
      <ListElement
        v-show="category.id == subcategory.fk_category_id"
        v-for="(subcategory, index) in subcategories"
        :key="subcategory.id"
        :element="subcategory"
        @doneEdit="doneEdit(subcategory)"
        @show="show(index)"
      >
        <template v-slot:icon>
          <div>
            <font-awesome-icon class="text-white" icon="fa-solid fa-eye" />
          </div>
        </template>
      </ListElement>
    </ul>
    <div class="my-1">
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
import { faEye } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(faEye);

onBeforeMount(() => {
  store.dispatch("getSubcategories");
});

function doneCreate() {
  newElement.value.fk_category_id = props.category.id;
  store.dispatch("storeSubcategory", newElement.value).then(() => {
    store.dispatch("getSubcategories");
  });
}

function doneEdit(subcategory) {
  if (subcategory.name) {
    store.dispatch("editSubcategory", subcategory).then(() => {
      store.dispatch("getSubcategories");
    });
  } else {
    store.dispatch("deleteSubcategory", subcategory).then(() => {
      store.dispatch("getSubcategories");
    });
  }
}

function show(index) {
  for (let i = 0; i < subcategories.value.length; i++) {
    subcategories.value[i].collapsed = true;
  }
  subcategories.value[index].collapsed = false;
}

const subcategories = computed(() => store.state.subcategories);

const newElement = ref({
  name: "",
  fk_category_id: 0,
});

const props = defineProps({
  category: { type: Object, required: true },
});
</script>
