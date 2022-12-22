<template>
    <div>
        <transition name="outer">
            <div
                v-show="openModal"
                class="absolute inset-0 bg-black opacity-30 z-10 flex justify-center"
            ></div>
        </transition>
        <transition name="inner">
            <div
                v-if="openModal"
                class="z-20 absolute inset-0 flex flex-col justify-center items-center"
            >
                <div
                    class="bg-white flex w-[30%] flex-col mx-auto justify-center items-center rounded shadow-md shadow-slate-900"
                >
                    <header
                        class="flex text-center items-center justify-center text-2xl p-2 rounded-t bg-cyan-500 text-white shadow w-full"
                    >
                        <h1>Producto</h1>
                    </header>
                    <div name="body" class="py-4 px-6 w-full">
                        <div class="flex flex-col space-y-3">
                            <div>
                                <label
                                    for="subcategoria"
                                    class="block text-sm font-medium text-gray-700"
                                    >Subcategoría</label
                                >
                                <input
                                    type="input"
                                    name="subcategoria"
                                    id="subcategoria"
                                    class="h-8 block w-full text-lg rounded-md border border-gray-300 sm:text-sm px-1 shadow-md"
                                    placeholder=""
                                    disabled
                                    v-model="subcategory.name"
                                    required
                                />
                            </div>
                            <div>
                                <label
                                    for="product_name"
                                    class="block text-sm font-medium text-gray-700"
                                    >Nombre</label
                                >

                                <input
                                    v-model="newProduct.name"
                                    type="text"
                                    name="product_name"
                                    id="product_name"
                                    class="h-8 block w-full text-lg rounded-md border border-gray-300 sm:text-sm px-1 shadow-md focus:border focus:border-transparent active:border-transparent active:border focus:ring-0 active:ring-0"
                                    placeholder="Nombre"
                                    required
                                />
                            </div>
                            <div>
                                <label
                                    for="product_cost"
                                    class="block text-sm font-medium text-gray-700"
                                    >Costo</label
                                >
                                <input
                                    v-model="newProduct.cost"
                                    type="number"
                                    min="0"
                                    name="product_cost"
                                    id="product_cost"
                                    class="h-8 block w-full text-lg rounded-md border border-gray-300 sm:text-sm px-1 shadow-md focus:border focus:border-transparent active:border-transparent active:border focus:ring-0 active:ring-0"
                                    placeholder="0"
                                    required
                                />
                            </div>
                        </div>
                    </div>
                    <footer class="w-full py-2 px-4">
                        <div class="flex justify-between">
                            <button
                                @click="$emit('close-modal')"
                                class="bg-red-600 py-1 px-3 text-white rounded shadow shadow-red-900/40 hover:shadow-red-500/80 hover:bg-red-500 transition-all duration-200"
                            >
                                Cancelar
                            </button>
                            <button
                                @click="
                                    $emit(
                                        'store-product',
                                        newProduct,
                                        subcategory.id
                                    )
                                "
                                class="bg-teal-500 py-1 px-3 rounded text-white hover:bg-teal-400 shadow shadow-teal-900/40 hover:shadow-teal-500/80 transition-all duration-200"
                            >
                                Guardar
                            </button>
                        </div>
                    </footer>
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { library } from "@fortawesome/fontawesome-svg-core";
import { faCircleXmark, faXmark } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faXmark);

defineProps({
    openModal: { type: Boolean, default: false, required: true },
    newProduct: { type: Object, required: true },
    subcategory: { type: Object, required: true },
});

defineEmits(["close-modal", "store-product"]);
</script>

<style></style>
