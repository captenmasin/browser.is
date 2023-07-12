<script setup>
import NavBar from "@/Components/Global/NavBar.vue";
import MetaHead from "@/Components/Global/MetaHead.vue";
import AppFooter from "@/Components/Global/AppFooter.vue";
</script>

<template>
    <main class="flex min-h-screen flex-col">
        <meta-head/>
        <article class="flex flex-col flex-1">
            <nav-bar/>
            <div class="h-full flex flex-1 mt-4">
                <div class="container mx-auto">
                    <div class="max-w-4xl mx-auto px-4">
                        <slot/>
                    </div>
                </div>
            </div>
            <app-footer/>
        </article>
    </main>
</template>
