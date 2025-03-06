<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const isAuthenticated = computed(() => page.props.auth?.user);
const sidebarNavItems = computed<NavItem[]>(() => {
    if (isAuthenticated.value) {
        return [
            {
                title: 'Profile',
                href: '/settings/profile',
            },
            {
                title: 'Password',
                href: '/settings/password',
            },
            {
                title: 'Appearance',
                href: '/settings/appearance',
            },
        ];
    }

    return [
        {
            title: 'Appearance',
            href: '/settings/appearance',
        },
    ];
});

const currentPath = window.location.pathname;
</script>

<template>
    <div class="px-4 py-6">
        <Heading
            title="Settings"
            :description="isAuthenticated ? 'Manage your profile and account settings' : 'Customize your experience'"
        />

        <div class="flex lg:flex-row flex-col lg:space-x-12 space-y-8 md:space-y-0 lg:space-y-0">
            <aside class="w-full lg:w-48 max-w-xl">
                <nav class="flex flex-col space-x-0 space-y-1">
                    <Button
                        v-for="item in sidebarNavItems"
                        :key="item.href"
                        variant="ghost"
                        :class="['w-full justify-start', { 'bg-muted': currentPath === item.href }]"
                        as-child
                    >
                        <Link :href="item.href">
                            {{ item.title }}
                        </Link>
                    </Button>
                </nav>
            </aside>

            <Separator class="md:hidden my-6" />

            <div class="flex-1 md:max-w-2xl">
                <section class="space-y-12 max-w-xl">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>
