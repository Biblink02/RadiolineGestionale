<script setup lang="ts">
import logo from '@/../media/logo.png';
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline';
import {Link} from '@inertiajs/vue3';
const page = usePage();
const pages = ref([
    { name: 'Home', href: '/' },
    { name: 'Services', href: '/services' },
    { name: 'Contact Us', href: '/contact-us' },
]);

const mobileMenuOpen = ref(false);
const toggleMobileMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value;
};

</script>

<template>
    <header class="sticky sm:fixed w-full top-0 z-50 bg-white/80 backdrop-blur-lg shadow-sm" role="banner">
        <div class="container mx-auto flex items-center justify-between px-6 py-2">
            <!-- Logo (left) -->
            <Link href="/">
                <figure class="flex items-center" role="img" aria-label="Company Logo">
                    <img
                        :src="logo"
                        alt="MyCompany Logo"
                        class="h-auto w-20 sm:w-28 object-contain"
                        loading="eager"
                    />
                </figure>
            </Link>


            <!-- Desktop Navigation (center/right on large screens) -->
            <nav class="hidden text-right sm:flex items-center gap-8" aria-label="Main navigation">
                <Link
                    v-for="link in pages"
                    :key="link.href"
                    :href="link.href"
                    :class="['hover:text-blue-600 transition-colors duration-200 font-medium', link.href === page.url ? 'text-blue-800 underline' : 'text-gray-800'] "
                >
                    {{ link.name }}
                </Link>
            </nav>

            <!-- Mobile Menu Button (right) -->
            <button
                @click="toggleMobileMenu"
                class="sm:hidden text-gray-700 focus:outline-none mr-4"
                aria-label="Toggle navigation menu"
            >
                <XMarkIcon v-if="mobileMenuOpen" class="w-7 h-7" />
                <Bars3Icon v-else class="w-7 h-7" />
            </button>
        </div>

        <!-- Mobile Navigation Panel -->
        <nav
            v-show="mobileMenuOpen"
            class="sm:hidden px-6 pt-2 pb-4 shadow-md"
            aria-label="Mobile navigation"
        >
            <hr class="text-gray-400 mx-auto" />
            <Link
                v-for="link in pages"
                :key="link.href"
                :href="link.href"
                :class="['block py-2 hover:text-blue-600 font-medium transition-colors duration-200 text-center', link.href === page.url ? 'text-blue-800 underline' : 'text-gray-800']"
                @click="mobileMenuOpen = false"
            >
                {{ link.name }}
            </Link>
        </nav>
    </header>

</template>

<style scoped>
</style>
