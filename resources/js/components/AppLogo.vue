<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
</script>

<template>
    <div class="flex items-center">
        <div class="flex justify-center items-center bg-sidebar-primary rounded-md size-8 aspect-square text-sidebar-primary-foreground">
            <AppLogoIcon class="size-6 text-white dark:text-black" />
        </div>
        <div class="flex flex-1 items-center ml-1">
            <span class="font-semibold text-lg truncate leading-none">CodeSnip</span>
        </div>
    </div>
</template>
