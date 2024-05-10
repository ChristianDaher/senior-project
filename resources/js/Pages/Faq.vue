<script setup>
defineProps({
  faqs: {
    type: Array,
    default: () => [],
  },
});
</script>

<template>
  <div v-for="faq in faqs" class="mb-4">{{ faq }}</div>
</template>
