<template>
    <div class="w-full">
        <div class="w-full mx-auto">
            <div class="flex items-center justify-between w-full py-3 gap-2">
                <button class="px-3 py-1.5 bg-blue-500 rounded-md text-nowrap">
                    Add New
                </button>
                <input
                    v-model="search"
                    type="text"
                    class="!w-1/2"
                    placeholder="Search"
                />
            </div>
            <table>
                <thead>
                    <tr class="bg-slate-300">
                        <th class="">Avatar</th>
                        <th class="">Name</th>
                        <th class="">Email</th>
                        <th class="">Register Date</th>
                        <th class="" v-if="can.delete_user">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                        <th>
                            <img
                                class="w-12 h-12 rounded-full"
                                alt=""
                                :src="
                                    user.avatar
                                        ? 'storage/' + user.avatar
                                        : 'storage/avatar/default.png'
                                "
                            />
                        </th>
                        <th>
                            <p>{{ user.name }}</p>
                        </th>
                        <th>
                            <p>{{ user.email }}</p>
                        </th>
                        <th>
                            <p>{{ getDate(user.created_at) }}</p>
                        </th>
                        <th>
                            <button
                                class="px-3 py-1.5 bg-red-500 rounded-md text-nowrap"
                                v-if="can.delete_user"
                            >
                                Delete
                            </button>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- pagination -->
        <div>
            <Pagination :paginator="users" />
        </div>
    </div>
</template>

<script setup>
import Pagination from "./components/Pagination.vue";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { debounce } from "lodash";
defineProps({
    users: Object,
    can: Object,
});
const getDate = (date) => {
    return new Date(date).toLocaleDateString("en-us", {
        year: "numeric",
        month: "short",
        day: "numeric",
    });
};
const search = ref("");
watch(
    search,
    debounce(
        (value) => router.get("/", { search: value }, { preserveState: true }),
        1000
    )
);
</script>
