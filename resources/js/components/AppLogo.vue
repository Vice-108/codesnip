<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
</script>

<template>
    <div class="flex justify-center items-center bg-sidebar-primary rounded-md size-8 aspect-square text-sidebar-primary-foreground">
        <AppLogoIcon class="size-5 text-white dark:text-black" />
    </div>
    <div class="flex-1 grid ml-1 text-sm text-left">
        <span class="mb-0.5 font-semibold truncate leading-none">CodeSnip</span>
    </div>
</template>
