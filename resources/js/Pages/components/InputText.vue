<template>
    <div class="mb-6">
        <label for="name">{{ name }}</label>
        <input
            :type="type"
            v-model="model"
            :class="{ 'border-red-500': message }"
        />
        <!-- Display error message if exists -->
        <p v-if="message" class="text-red-500">
            {{ message }}
        </p>
    </div>
</template>

<script setup>
defineProps({
    name: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: "text",
    },
    message: String,
});

// Use v-model binding for form data
const model = defineModel({
    type: null,
    required: true,
});
</script>
