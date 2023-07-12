<script setup lang="ts">
defineProps({
    show: Boolean
})

const emit = defineEmits(['close'])
</script>

<template>
    <Teleport to="#modals">
        <Transition>
            <div class="fixed inset-0 bg-gray-900 opacity-40 items-center" v-show="show" @click="$emit('close')"></div>
        </Transition>
        <Transition name="slide-up">
            <div class="bg-white text-black absolute top-36 mx-auto w-full max-w-lg rounded" v-show="show">
                <div class="p-4 justify-between flex items-center">
                    <div>
                        <slot name="title"/>
                    </div>
                    <button @click="$emit('close')" class="text-xl">
                        <svg class="w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex p-4 pt-0">
                    <slot name="default"/>
                </div>
                <div class="flex items-center p-4 justify-end">
                    <button @click="$emit('close')" class="bg-secondary text-white rounded-md px-6 py-2 text-sm">
                        Close
                    </button>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.25s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}

.slide-up-enter-active {
    transition: all 0.25s ease-out;
}

.slide-up-leave-active {
    transition: all 0.25s ease;
}

.slide-up-enter-from,
.slide-up-leave-to {
    transform: translateY(20%);
    opacity: 0;
}
</style>
