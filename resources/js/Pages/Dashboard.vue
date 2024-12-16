<template>
    <div class="w-full">
        <div class="p-4 bg-green-200" v-if="$page.props.flash.success">
            {{ $page.props.flash.success }}
        </div>
        <div
            class="container flex items-center justify-center h-[50vh] mx-auto"
        >
            <h2 class="title">Welcome {{ $page.props.auth.user.name }}</h2>
        </div>
    </div>
</template>

<script setup></script>

<style lang="scss" scoped></style>
