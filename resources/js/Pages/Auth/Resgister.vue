<template>
    <div>
        <div>
            <h1 class="title">Register a new account</h1>
        </div>
        <div class="w-2/4 mx-auto">
            <form @submit.prevent="handleSubmit">
                <!-- Name Input -->

                <label for="avatar"> Avatar </label>
                <input
                    type="file"
                    id="avatar"
                    name="avatar"
                    accept="image/*"
                    @input="change"
                />
                <p v-if="form.errors.avatar" class="text-red-500">
                    {{ form.errors.avatar }}
                </p>
                <div
                    v-if="image_preview"
                    class="size-24 rounded-full overflow-hidden"
                >
                    <img :src="image_preview" alt="" />
                </div>
                <InputText
                    name="Name"
                    v-model="form.name"
                    :message="form.errors.name"
                    type="text"
                />
                <!-- Email Input -->
                <InputText
                    name="Email"
                    v-model="form.email"
                    :message="form.errors.email"
                    type="email"
                />
                <!-- Password Input -->
                <InputText
                    name="Password"
                    v-model="form.password"
                    :message="form.errors.password"
                    type="password"
                />
                <!-- Confirm Password Input -->
                <InputText
                    name="Confirm Password"
                    v-model="form.password_confirmation"
                    :message="form.errors.password_confirmation"
                    type="password"
                />

                <div class="text-slate-600 mb-2 flex space-x-2">
                    <p>Already registered?</p>
                    <a href="/login" class="text-blue-400">Login</a>
                </div>
                <div class="mb-6">
                    <button type="submit" class="primary-btn">Register</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import InputText from "../components/InputText.vue";
import { ref } from "vue";

// Create form state and bind it with useForm
const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    avatar: null,
});

const image_preview = ref(null);

const change = (e) => {
    const file = e.target.files[0];
    if (file) {
        if (!["image/jpeg", "image/png", "image/gif"].includes(file.type)) {
            form.errors.avatar = "Only JPEG, PNG, or GIF files are allowed.";
            return;
        }
        if (file.size > 1024 * 1024) {
            form.errors.avatar = "File size must not exceed 1MB.";
            return;
        }

        form.errors.avatar = null; // Clear previous errors
        form.avatar = file;
        image_preview.value = URL.createObjectURL(file);
    }
};

const handleSubmit = () => {
    form.post(route("register"), {
        onError: () => form.reset("password", "password_confirmation"),
        onSuccess: () => {
            form.reset();
            image_preview.value = null; // Clear preview on success
        },
    });
};
</script>
