<script setup>
const props = defineProps({
  tag: {
    type: Object,
    required: true,
  },
  isChecked: {
    type: Boolean,
    required: true,
  },
});

defineEmits(["toggleTag"]);
</script>

<template>
  <div
    class="rounded-md text-white px-4 py-2 cursor-pointer"
    :style="{
      backgroundColor: tag.color,
      outline: isChecked ? `2px solid ${tag.color}` : 'none',
      outlineOffset: isChecked ? '2px' : '0',
    }"
    @click="$emit('toggleTag')"
  >
    {{ tag.title }}
  </div>
</template>
