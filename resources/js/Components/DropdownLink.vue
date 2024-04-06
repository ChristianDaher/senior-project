<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  href: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <Link
    :href="href"
    class="block w-full px-4 py-2 text-start text-sm leading-5 text-primary-100/75 hover:bg-disabled-100/25 focus:outline-none focus:bg-disabled-100/25 custom-transition"
  >
    <slot />
  </Link>
</template>
