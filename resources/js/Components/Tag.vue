<script setup>
const props = defineProps({
  tag: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div class="rounded-md text-white px-4 py-2" :style="{ backgroundColor: tag.color }">
    {{ tag.title }}
  </div>
</template>
