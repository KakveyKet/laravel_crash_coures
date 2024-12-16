<template>
    <Head>
        <title>My App</title>
    </Head>
    <div>
        <header>
            <nav>
                <div class="w-full flex items-center justify-between">
                    <Link
                        :class="{ 'bg-slate-700': $page.component === 'Home' }"
                        class="nav-link"
                        :href="route('home')"
                        >Home</Link
                    >
                    <div v-if="$page.props.auth.user">
                        <!-- logout -->
                        <Link
                            :href="route('dashboard')"
                            :class="{
                                'bg-slate-700': $page.component === 'Dashboard',
                            }"
                            class="nav-link"
                        >
                            Dashboard
                        </Link>
                        <Link
                            class="nav-link"
                            :href="route('logout')"
                            as="button"
                            type="button"
                            method="post"
                            >Logout</Link
                        >
                    </div>
                    <div v-else class="flex gap-2">
                        <Link
                            :class="{
                                'bg-slate-700': $page.component === 'Register',
                            }"
                            class="nav-link"
                            :href="route('register')"
                        >
                            Register
                        </Link>
                        <Link
                            :class="{
                                'bg-slate-700': $page.component === 'Login',
                            }"
                            class="nav-link"
                            :href="route('login')"
                        >
                            Login
                        </Link>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <slot />
        </main>
    </div>
</template>

<script setup>
import { Link, Head } from "@inertiajs/vue3";
import { route } from "../../../vendor/tightenco/ziggy/src/js";
</script>

<style lang="scss" scoped></style>
