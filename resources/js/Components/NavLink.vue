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
    ? "inline-flex items-center px-1 pt-1 border-b-2 border-accent-200 text-sm font-medium leading-5 text-primary-100 focus:outline-none focus:border-accent-100 custom-transition"
    : "inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-secondary-100 hover:text-primary-100/60 hover:border-primary-100/60 focus:outline-none focus:text-primary-100/75 focus:border-primary-100/75 custom-transition"
);
</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
