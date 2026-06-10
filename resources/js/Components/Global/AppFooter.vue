<script setup lang="ts">
import {computed} from "vue";

const year = computed(() => new Date().getFullYear())
</script>

<template>
    <footer class="mt-auto pb-4 pt-8 text-primary dark:text-white">
        <div class="container mx-auto text-sm px-4">
            &copy;{{ year }} SpacemanCodes LTD. All rights reserved.
        </div>
    </footer>
</template>
