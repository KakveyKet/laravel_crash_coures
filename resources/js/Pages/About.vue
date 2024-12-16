<template>
    <div>this is about page {{ user }}</div>
</template>

<script setup>
defineProps({
    user: String,
});
</script>
