<script setup>
import {ref} from "vue";

const open = ref(false)

function toggle() {
    open.value = !open.value
}
</script>

<template>
    <div>
        <div @click="toggle">
            <slot name="title"/>
        </div>
        <transition name="slide">
            <div v-if="open">
                <slot name="content"/>
            </div>
        </transition>
    </div>
</template>

<style>
.slide-enter-active {
    transition-duration: 0.3s;
    transition-timing-function: ease-in;
}

.slide-leave-active {
    transition-duration: 0.3s;
    transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
}

.slide-enter-to, .slide-leave {
    max-height: 50px;
    overflow: hidden;
}

.slide-enter, .slide-leave-to {
    overflow: hidden;
    max-height: 0;
}
</style>
