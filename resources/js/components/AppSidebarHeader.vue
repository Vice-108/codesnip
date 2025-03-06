<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItemType } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();

defineProps<{
    breadcrumbs?: BreadcrumbItemType[];
}>();
</script>

<template>
    <header
        class="group-has-[[data-collapsible=icon]]/sidebar-wrapper:h-12 flex justify-between items-center gap-2 px-6 md:px-4 border-sidebar-border/70 border-b h-16 transition-[width,height] ease-linear shrink-0"
    >
        <div class="flex items-center gap-2">
            <SidebarTrigger class="-ml-1" />
            <template v-if="breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>
        <div class="space-x-5" v-if="!page.props.auth.user">
            <Link
                :href="route('login')"
                class="inline-block px-5 py-1.5 border hover:border-[#19140035] dark:hover:border-[#3E3E3A] border-transparent rounded-sm text-[#1b1b18] dark:text-[#EDEDEC] text-sm leading-normal"
            >
                Log in
            </Link>
            <Link
                :href="route('register')"
                class="inline-block px-5 py-1.5 border border-[#19140035] hover:border-[#1915014a] dark:hover:border-[#62605b] dark:border-[#3E3E3A] rounded-sm text-[#1b1b18] dark:text-[#EDEDEC] text-sm leading-normal"
            >
                Register
            </Link>
        </div>
    </header>
</template>
