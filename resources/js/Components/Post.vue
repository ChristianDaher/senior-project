<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import Tag from "./Tag.vue";
import {
  StarIcon,
  HeartIcon,
  ChatBubbleBottomCenterIcon,
} from "@heroicons/vue/24/outline";

defineProps({
  post: {
    type: Object,
    required: true,
  },
});

const user = usePage().props.auth.user;

function starPost() {
  
}

function likePost() {}
</script>

<template>
  <div class="relative">
    <Link
      :href="route('posts.show', post.id)"
      class="flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 custom-transition cursor-default"
    >
      <img
        v-if="post.image_url"
        class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-96 md:rounded-none md:rounded-s-lg"
        :src="post.image_url"
        alt="Post Image"
      />
      <div class="flex flex-col p-4 leading-normal">
        <div class="flex items-center flex-wrap gap-4 mb-2">
          <Tag v-for="tag in post.tags" :key="tag.id" :tag="tag" />
        </div>
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-primary-100">
          {{ post.title }}
        </h5>
        <p class="mb-8 font-normal text-secondary-100">
          {{ post.description }}
        </p>
      </div>
    </Link>
    <div class="absolute bottom-4 right-4 z-50 flex gap-4">
      <div
        @click="starPost"
        class="flex gap-1 items-center cursor-pointer px-2 py-1 text-primary-100 group"
      >
        <StarIcon
          class="w-6 h-6 group-hover:text-yellow-300 custom-transition"
          :class="
            user.starred_post_ids.includes(post.id)
              ? 'text-yellow-300 fill-yellow-300'
              : 'text-primary-100'
          "
        />
        <span class="text-sm">
          {{ post.total_stars }}
        </span>
      </div>
      <div
        @click="likePost"
        class="flex gap-1 items-center cursor-pointer group px-2 py-1 text-primary-100 group"
      >
        <HeartIcon
          class="w-6 h-6 group-hover:text-red-500 custom-transition"
          :class="
            user.liked_post_ids.includes(post.id)
              ? 'text-red-500 fill-red-500'
              : 'text-primary-100'
          "
        />
        <span class="text-sm">
          {{ post.total_likes }}
        </span>
      </div>
      <Link
        :href="route('posts.show', post.id)"
        class="flex gap-1 items-center cursor-pointer group px-2 py-1 text-primary-100 group"
      >
        <ChatBubbleBottomCenterIcon
          class="w-6 h-6 group-hover:text-accent-100 custom-transition"
          :class="
            user.commented_post_ids.includes(post.id)
              ? 'text-accent-100 fill-accent-100'
              : 'text-primary-100'
          "
        />
        <span class="text-sm">
          {{ post.total_comments }}
        </span>
      </Link>
    </div>
  </div>
</template>
