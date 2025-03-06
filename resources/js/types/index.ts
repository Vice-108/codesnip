import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Snippet {
    id: number;
    title: string;
    description: string | null;
    code: string;
    language: string | null;
    is_public: boolean;
    user: {
        id: number;
        name: string;
        email: string;
    };
    views_count: number;
    is_favorite: boolean;
    favorites_count: number;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
