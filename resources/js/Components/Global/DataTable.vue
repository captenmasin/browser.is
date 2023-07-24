<script setup>
import {toast} from 'vue3-toastify';
import {isBoolean, isObject, isString, useClipboard} from "@vueuse/core";

const props = defineProps({
    data: Object,
    showHeader: {
        type: Boolean,
        default: true
    },
})

const {text, copy, copied, isSupported} = useClipboard()

function copyValue(value) {
    copy(value)

    toast.error('Copied value', {
        autoClose: 1000,
        position: "bottom-center",
        hideProgressBar: true,
        theme: "colored",
        transition: "slide"
    });
}

function convertObject(object, sep = ' / ') {
    let string = ''
    for (const property in object) {
        string += (object[property] + sep)
    }
    string = string.slice(0, -sep.length);

    return string
}
</script>

<template>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400" v-if="showHeader">
            <tr>
                <th scope="col" class="px-4 sm:px-6 w-1/3 py-3 bg-gray-50 dark:bg-gray-800">
                    Name
                </th>
                <th scope="col" class="px-4 sm:px-6 w-2/3 py-3 bg-gray-50 dark:bg-gray-800">
                    Data
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-t border-gray-200 group dark:border-gray-800 first:border-0" v-for="item in data">
                <template v-if="item.value">
                    <th scope="row" class="px-4 sm:px-6 w-1/3 py-4 align-top font-medium whitespace-nowrap bg-white group-hover:bg-primary/5 dark:group-hover:bg-secondary/10 text-secondary dark:text-white dark:bg-gray-700">
                        {{ item.label }}
                    </th>
                    <td class="px-4 sm:px-6 py-4 w-2/3 bg-white dark:bg-gray-700 dark:text-white font-mono group-hover:bg-primary/5 dark:group-hover:bg-secondary/10 text-primary">
                        <!--                        <Popper :hover="true" placement="top" content="Click to copy" :arrow="true">-->
                        <span v-if="isString(item.value)" @click="copyValue(item.label + ': ' + item.value)" class="cursor-pointer hover:border-b border-primary border-dotted">
                            {{ item.value }}
                        </span>
                        <span v-else-if="isObject(item.value)" @click="copyValue(item.label + ': ' + convertObject(item.value))" class="cursor-pointer hover:border-b border-primary border-dotted">
                            {{ convertObject(item.value) }}
                        </span>
                        <span v-else-if="isBoolean(item.value)" @click="item.value ? copyValue(item.label + ': ' + 'Yes') : copyValue(item.label + ': ' + 'No')" class="cursor-pointer hover:border-b border-primary border-dotted">
                            {{ item.value ? 'Yes' : 'No' }}
                        </span>

                        <div v-if="item.image" class="overflow-hidden mt-4 rounded border border-secondary/20">
                            <a :href="item.image_url" target="_blank">
                            <img :src="item.image" class="w-full" alt="Map image for coordinates" />
                            </a>
                        </div>
                        <!--                        </Popper>-->
                    </td>
                </template>
            </tr>
            </tbody>
        </table>
    </div>
</template>
