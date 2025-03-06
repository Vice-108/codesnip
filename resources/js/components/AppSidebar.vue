<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Folder, LayoutGrid, Code, PlusCircle } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';


const page = usePage();
const isAuthenticated = computed(() => page.props.auth?.user);

const mainNavItems = computed(() => [
    // Public items
    {
        title: 'Snippets',
        href: '/snippets',
        icon: Code,
    },
    // Auth-only items
    ...(isAuthenticated.value ? [
        {
            title: 'Dashboard',
            href: '/dashboard',
            icon: LayoutGrid,
        },
        {
            title: 'Create Snippet',
            href: '/snippets/create',
            icon: PlusCircle,
        },
    ] : []),
]);

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/vice-108/codesnip',
        icon: Folder,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="sidebar">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
