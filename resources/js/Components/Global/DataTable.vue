<script setup>
import {isBoolean, isObject, isString} from "@vueuse/core";

const props = defineProps({
    data: Object,
    showHeader: {
        type: Boolean,
        default: true
    },
})
</script>

<template>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400" v-if="showHeader">
            <tr>
                <th scope="col" class="px-6 w-1/3 py-3 bg-gray-50 dark:bg-gray-800">
                    Name
                </th>
                <th scope="col" class="px-6 w-2/3 py-3 bg-gray-50 dark:bg-gray-800">
                    Data
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-t border-gray-200 dark:border-gray-800 first:border-0" v-for="item in data">
                <th scope="row" class="px-6 w-1/3 py-4 font-medium whitespace-nowrap bg-white text-secondary dark:text-white dark:bg-gray-700">
                    {{ item.label }}
                </th>
                <td class="px-6 py-4 w-2/3 bg-white dark:bg-gray-700 dark:text-white font-mono text-primary">
                    <div v-if="isString(item.value)">
                        {{ item.value }}
                    </div>
                    <div class="space-x-2" v-else-if="isObject(item.value)">
                            <span v-for="(singleValue, singleLabel, index) in item.value">
                                {{ singleValue }}<span class="ml-2" v-if="(index + 1) !== Object.keys(item.value).length">/</span>
                            </span>
                    </div>
                    <div class="space-x-2" v-else-if="isBoolean(item.value)">
                        {{ item.value ? 'Yes' : 'No' }}
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
