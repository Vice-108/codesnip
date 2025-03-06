<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import { DropdownMenuGroup, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator } from '@/components/ui/dropdown-menu';
import type { User } from '@/types';
import { Link } from '@inertiajs/vue3';
import { LogOut, Settings, LogIn } from 'lucide-vue-next';

interface Props {
    user: User;
}

defineProps<Props>();
</script>

<template>
    <DropdownMenuLabel class="p-0 font-normal">
        <div class="flex items-center gap-2 px-1 py-1.5 text-sm text-left">
            <UserInfo :user="user" :show-email="true" />
        </div>
    </DropdownMenuLabel>
    <DropdownMenuSeparator />
    <DropdownMenuGroup>
        <DropdownMenuItem :as-child="true">
            <Link
                class="block w-full"
                :href="user ? route('profile.edit') : route('appearance')"
                as="button"
            >
                <Settings class="mr-2 w-4 h-4" />
                Settings
            </Link>
        </DropdownMenuItem>
        <DropdownMenuItem :as-child="true">
            <Link
                class="block w-full"
                method="post"
                :href="user? route('logout') : route('login')"
                as="button"
            >
                <LogOut class="mr-2 w-4 h-4" v-if="user" />
                <LogIn class="mr-2 w-4 h-4" v-else />
                {{ user ? 'Log out' : 'Log in' }}
            </Link>
        </DropdownMenuItem>
    </DropdownMenuGroup>
</template>
