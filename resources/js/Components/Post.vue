<script setup>
defineProps({
  post: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div>
    <h2 class="font-semibold text-xl text-primary-100 leading-tight">Post</h2>
    <div class="p-6 text-primary-100">
      <p>{{ post.title }}</p>
      <p>{{ post.description }}</p>
      <img
        v-if="post.image_url"
        :src="post.image_url"
        alt="Post Image"
        class="w-1/2"
      />
    </div>
  </div>
</template>
