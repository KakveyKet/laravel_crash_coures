<template>
    <div class="flex justify-between items-start">
        <div class="flex items-center rounded-md overflow-hidden shadow-lg">
            <div v-for="link in paginator.links" :key="link.url">
                <component
                    :is="link.url ? Link : 'span'"
                    :href="link.url"
                    class="border-x border-slate-50 w-12 h-12 grid place-items-center bg-white cursor-pointer"
                    v-html="makeLabel(link.label)"
                    :class="{
                        'text-slate-400': !link.url,
                        'text-blue-400 font-medium': link.active,
                    }"
                />
            </div>
        </div>
        <p>
            Showing {{ paginator.from }} to {{ paginator.to }} of
            {{ paginator.total }} results
        </p>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    paginator: {
        type: Object,
        required: true,
    },
});

const makeLabel = (label) => {
    if (label.includes("Previous")) {
        return "<<";
    } else if (label.includes("Next")) {
        return ">>";
    } else {
        return label;
    }
};
</script>
