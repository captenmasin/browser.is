<script setup>
import {ref} from 'vue'
import {usePage, Link, router} from '@inertiajs/vue3'

import AppLogo from '@/Components/Global/AppLogo.vue'
import AppLogoWhite from '@/Components/Global/AppLogoWhite.vue'

const navOpen = ref(false)

function linkIsActive(url) {
    let cleanUrl = url.split("?")[0];
    return usePage().props.currentUrl === cleanUrl
}

router.on('finish', () => {
    navOpen.value = false
})
</script>

<template>
    <nav class="bg-transparent border-gray-200 px-4 py-2.5 rounded font-body-settings z-10">
        <div class="container relative flex items-center justify-between mx-auto">
            <Link :href="route('home')" class="flex items-center">
                <app-logo class="w-36 lg:w-48 mr-3 flex dark:hidden"/>
                <app-logo-white class="w-36 lg:w-48 mr-3 hidden dark:flex"/>
                <span class="sr-only">Go home</span>
            </Link>
            <button @click="navOpen = !navOpen" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:white focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white dark:focus:bg-gray-900 focus:shadow-md dark:text-gray-400 dark:hover:bg-secondary dark:focus:ring-gray-600"
                    :class="navOpen ? 'bg-white dark:bg-gray-900' : ''"
                    aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg v-if="!navOpen" class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
                <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div :class="!navOpen ? 'opacity-0 pointer-events-none scale-0' : 'opacity-100 scale-100 pointer-events-auto'" class="md:opacity-100 md:scale-100 md:pointer-events-auto w-full md:block transition-all origin-top-right md:w-auto absolute top-full right-0 md:static z-20" id="navbar-default">
                <ul class="flex flex-col px-4 md:px-0 shadow-sm md:shadow-none py-4 mt-4 border border-gray-100 space-y-4 md:space-y-0 rounded-lg bg-white md:flex-row md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-transparent dark:bg-gray-900 md:dark:bg-transparent dark:border-secondary">
                    <li v-for="link in usePage().props.tools">
                        <Link :href="link.url"
                              class="py-2 flex px-4 md:px-2 lg:px-6 text-secondary md:ml-2 transition-all rounded md:bg-transparent dark:text-white dark:md:text-white"
                              :class="[
                                  linkIsActive(link.url) ? 'md:text-primary md:dark:bg-secondary bg-secondary text-white' : 'md:text-secondary dark:hover:bg-primary/20 md:hover:text-primary',
                              ]">
                            {{ link.name }}
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
