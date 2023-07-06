<script setup>
import { computed } from 'vue'

const props = defineProps({
    modelValue: { type: [Array, Boolean, String] },
    value: { type: [Boolean, Object] },
    label: { type: String }
})

const emit = defineEmits(['update:modelValue'])
const model = computed({
    get () {
        return props.modelValue
    },
    set (value) {
        emit('update:modelValue', value)
    }
})
</script>

<template>
    <div>
        <label class="md:items-center text-left flex px-2 mt-2">
            <input type="checkbox" class="checkbox mt-[2px] md:mt-0" v-model="model" :value="value"/>
            <span class="ml-2 text-sm dark:text-white text-secondary/75">{{ label }}</span>
        </label>
    </div>
</template>
