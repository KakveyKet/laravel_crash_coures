<template>
    <div>
        <div>
            <h1 class="title">Login to your account</h1>
        </div>
        <div class="w-2/4 mx-auto">
            <form @submit.prevent="handleSubmit">
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
                <div
                    class="text-slate-600 mb-2 xl:flex lg:flex flex-col gap-3 space-x-2 justify-between"
                >
                    <div class="flex text-nowrap">
                        <label for="remember"> Remember Me</label>
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            v-model="form.remember"
                        />
                    </div>
                    <div class="flex gap-2 text-nowrap">
                        <p>Need An Account ?</p>
                        <a :href="route('register')" class="text-blue-400"
                            >Register
                        </a>
                    </div>
                </div>
                <div class="mb-6">
                    <button type="submit" class="primary-btn">Log In</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import InputText from "../components/InputText.vue";
import { route } from "../../../../vendor/tightenco/ziggy/src/js";
// Create form state and bind it with useForm
const form = useForm({
    email: "",
    password: "",
    remember: null,
});

// Handle form submission
const handleSubmit = () => {
    form.post(route("login"), {
        onError: () => form.reset("password", "password_confirmation"),
    });
};
</script>
