<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const name = page.props.name;
const quote = page.props.quote as Quote;

interface Quote {
    message: string;
    author: string;
}

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="relative flex-col justify-center items-center grid lg:grid-cols-2 px-8 sm:px-0 lg:px-0 lg:max-w-none h-dvh">
        <div class="hidden relative lg:flex flex-col bg-muted p-10 dark:border-r h-full text-white">
            <div class="absolute inset-0 pattern" />
            <Link :href="route('home')" class="z-20 relative flex items-center font-medium text-lg">
                <AppLogoIcon class="mr-2 rounded-md size-9 text-black dark:text-white" />
                {{ name }}
            </Link>
            <div v-if="quote" class="z-20 relative mt-auto">
                <blockquote class="space-y-2">
                    <p class="text-lg">&ldquo;{{ quote.message }}&rdquo;</p>
                    <footer class="text-neutral-300 text-sm">{{ quote.author }}</footer>
                </blockquote>
            </div>
        </div>
        <div class="lg:p-8">
            <div class="flex flex-col justify-center space-y-6 mx-auto w-full sm:w-[350px]">
                <div class="flex flex-col space-y-2 text-center">
                    <div class="flex items-center mx-auto font-bold text-lg">
                        <AppLogoIcon class="mr-2 rounded-md size-9 text-black dark:text-white" />
                        {{ name }}
                    </div>
                    <h1 class="font-medium text-xl tracking-tight" v-if="title">{{ title }}</h1>
                    <p class="text-muted-foreground text-sm" v-if="description">{{ description }}</p>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>

<style scoped>
.pattern{
    background-color: rgb(0, 0, 0);
    opacity: 0.9;
    background-image: radial-gradient(#f8f8fa 0.8px, #020202 0.8px);
    background-size: 15px 15px;
}
</style>
