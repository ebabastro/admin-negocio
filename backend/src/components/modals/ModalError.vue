<template>
    <transition name="modal">
        <div
            v-if="openModal"
            class="bg-red-600 text-white rounded flex justify-between px-4 py-1 absolute bottom-0 w-[90%] transform -translate-y-20"
        >
            <slot></slot>
            <button
                @click="$emit('close-modal')"
                class="text-white rounded p-1 text-sm"
            >
                <font-awesome-icon icon="fa-solid fa-xmark" />
            </button>
        </div>
    </transition>
</template>

<script setup>
import { library } from "@fortawesome/fontawesome-svg-core";
import { faClose, faXmark } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faXmark);

defineEmits(["close-modal"]);
defineProps({
    openModal: { type: Boolean, default: false, required: true },
});
</script>

<style scoped>
.modal-enter-active {
    @apply transition-all;
    @apply duration-500;
}

.modal-leave-active {
    @apply transition-all;
    @apply duration-300;
}

.modal-enter-from {
    transform: translateY(-20px);
}
.modal-leave-to {
    opacity: 0;
}
</style>
