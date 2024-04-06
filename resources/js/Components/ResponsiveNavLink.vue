<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
  active: {
    type: Boolean,
  },
});

const classes = computed(() =>
  props.active
    ? "block w-full ps-3 pe-4 py-2 border-l-4 border-accent-100 text-start text-base text-white font-medium bg-accent-200 focus:outline-none focus:bg-accent-200 focus:border-accent-200 custom-transition"
    : "block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-secondary-100 hover:text-primary-100/60 hover:border-primary-100/60 hover:bg-disabled-100/50 focus:outline-none focus:text-primary-100/75 focus:border-primary-100/75 focus:bg-disabled-100/75 custom-transition"
);
</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
