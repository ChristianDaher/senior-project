<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="px-4 py-2 rounded-lg font-semibold text-primary-100 bg-base-100 border border-secondary-100 enabled:hover:bg-secondary-100 focus:bg-secondary-100 enabled:active:bg-secondary-100 focus:outline-none focus:ring-2 focus:ring-secondary-100 focus:ring-offset-2 custom-transition"
    >
        <slot />
    </button>
</template>
