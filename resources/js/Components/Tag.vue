<script setup>
const props = defineProps({
  tag: {
    type: Object,
    required: true,
  },
  isChecked: {
    type: Boolean,
    default: false,
  },
});
</script>

<template>
  <div
    class="rounded-md text-white px-4 py-2"
    :style="{
      backgroundColor: tag.color,
      outline: isChecked ? `2px solid ${tag.color}` : 'none',
      outlineOffset: isChecked ? '2px' : '0',
    }"
  >
    {{ tag.title }}
  </div>
</template>
