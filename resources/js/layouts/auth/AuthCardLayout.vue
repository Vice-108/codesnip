<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="flex flex-col justify-center items-center gap-6 bg-muted p-6 md:p-10 min-h-svh">
        <div class="flex flex-col gap-6 w-full max-w-md">
            <Link :href="route('home')" class="flex items-center self-center gap-2 font-medium">
                <div class="flex justify-center items-center w-9 h-9">
                    <AppLogoIcon class="rounded-md size-9 text-black dark:text-white" />
                </div>
            </Link>

            <div class="flex flex-col gap-6">
                <Card class="rounded-xl">
                    <CardHeader class="px-10 pt-8 pb-0 text-center">
                        <CardTitle class="text-xl">{{ title }}</CardTitle>
                        <CardDescription>
                            {{ description }}
                        </CardDescription>
                    </CardHeader>
                    <CardContent class="px-10 py-8">
                        <slot />
                    </CardContent>
                </Card>
            </div>
        </div>
    </div>
</template>
