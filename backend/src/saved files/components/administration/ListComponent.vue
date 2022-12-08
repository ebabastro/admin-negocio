<template>
    <div
        class="w-64 bg-slate-50 h-[80%] shadow-inner shadow-slate-500/50 p-2 overflow-y-auto"
    >
        <!-- <pre>{{ lista }}</pre> -->

        <ul>
            <li v-for="category in categories" :key="category.id">
                <div
                    class="flex justify-between bg-teal-200 border-2"
                    @keyup.esc="$emit('cancelEdit', category.id)"
                >
                    <p
                        @dblclick="$emit('editCategory', category.id)"
                        class="w-full"
                        v-if="!category.editing"
                    >
                        {{ category.name }}
                    </p>
                    <!-- @blur="$emit('doneEditCategory', category)" -->
                    <input
                        @vnode-mounted="({ el }) => el.focus()"
                        @keyup.enter="$emit('doneEditCategory', category)"
                        ref="editing_category"
                        class="w-[80%]"
                        v-else
                        type="input"
                        v-model="category.name"
                    />
                    <button
                        @click.prevent="$emit('collapse', category.id)"
                        class="text-xs"
                    >
                        <font-awesome-icon
                            v-if="category.collapsed"
                            icon="fa-solid fa-plus"
                        />
                        <font-awesome-icon v-else icon="fa-solid fa-minus" />
                    </button>
                </div>

                <!-- Render Subcategories -->
                <ul class="ml-6">
                    <li
                        v-show="
                            !category.collapsed &&
                            subcategory.fk_category_id == category.id
                        "
                        v-for="subcategory in subcategories"
                        :key="subcategory.id"
                    >
                        <div
                            :class="
                                !subcategory.collapsed
                                    ? 'bg-slate-700 text-slate-50'
                                    : ''
                            "
                            class="flex justify-between"
                        >
                            <p
                                v-if="subcategory.editing"
                                @dblclick.prevent="
                                    $emit('editSubcategory', subcategory.id)
                                "
                            >
                                {{ subcategory.name }}
                            </p>
                            <input
                                @keyup.enter="
                                    $emit('doneEditSubcategory', category)
                                "
                                ref="editing_subcategory"
                                class="w-[80%]"
                                type="input"
                                @vnode-mounted="({ el }) => el.focus()"
                                v-model="subcategory.name"
                            />
                            <button
                                v-show="subcategory.collapsed"
                                @click="$emit('show', subcategory.id)"
                                class="text-xs"
                            >
                                <font-awesome-icon icon="fa-solid fa-eye" />
                            </button>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faPlus, faMinus, faEye } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { onBeforeMount } from "@vue/runtime-core";

library.add(faPlus);
library.add(faMinus);
library.add(faEye);

onBeforeMount(() => {});

const props = defineProps({
    categories: { type: Array, required: true },
    subcategories: { type: Array, required: true },
});

// Mostrar input para edicion de categorias
const editingCategoryController = ref(false);
function editingCategory() {
    editingCategoryController.value = !editingCategoryController.value;
}
</script>
