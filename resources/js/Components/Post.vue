<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import Tag from "./Tag.vue";
import {
  StarIcon,
  HeartIcon,
  ChatBubbleBottomCenterIcon,
} from "@heroicons/vue/24/outline";
import { TrashIcon } from "@heroicons/vue/24/solid";
import { ref } from "vue";

const emit = defineEmits(["delete"]);

const props = defineProps({
  post: {
    type: Object,
    required: true,
  },
});

const auth = usePage().props.auth;

const isPostLiked = ref(auth.likedPostIds.includes(props.post.id));
const isPostStarred = ref(auth.starredPostIds.includes(props.post.id));
const isPostCommented = ref(auth.commentedPostIds.includes(props.post.id));

async function like() {
  if (isPostLiked.value) {
    axios.delete(route("posts.unlike", props.post.id)).then(() => {
      isPostLiked.value = false;
      props.post.total_likes--;
    });
  } else {
    axios.post(route("posts.like", props.post.id)).then(() => {
      isPostLiked.value = true;
      props.post.total_likes++;
    });
  }
}

async function star() {
  if (isPostStarred.value) {
    axios.delete(route("posts.unstar", props.post.id)).then(() => {
      isPostStarred.value = false;
      props.post.total_stars--;
    });
  } else {
    axios.post(route("posts.star", props.post.id)).then(() => {
      isPostStarred.value = true;
      props.post.total_stars++;
    });
  }
}
</script>

<template>
  <div
    class="flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 custom-transition"
  >
    <img
      v-if="post.image_url"
      class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-96 md:rounded-none md:rounded-s-lg"
      :src="post.image_url"
      alt="Post Image"
    />
    <div class="flex flex-col p-4 leading-normal grow">
      <div class="flex items-center flex-wrap gap-4 mb-2">
        <Tag
          v-for="tag in post.tags"
          :key="tag.id"
          :tag="tag"
          class="cursor-default"
        />
      </div>
      <h5 class="mb-2 text-2xl font-bold tracking-tight text-primary-100">
        {{ post.title }}
      </h5>
      <p class="mb-8 font-normal text-secondary-100 grow">
        {{ post.description }}
      </p>
      <div class="flex items-center justify-between">
        <div class="flex gap-4 flex-wrap">
          <div
            @click="like"
            class="flex gap-1 items-center cursor-pointer group px-2 py-1 text-primary-100 group"
          >
            <HeartIcon
              class="w-6 h-6 group-hover:text-red-500 custom-transition"
              :class="
                isPostLiked ? 'text-red-500 fill-red-500' : 'text-primary-100'
              "
            />
            <span class="text-sm">
              {{ post.total_likes }}
            </span>
          </div>
          <div
            @click="star"
            class="flex gap-1 items-center cursor-pointer px-2 py-1 text-primary-100 group"
          >
            <StarIcon
              class="w-6 h-6 group-hover:text-yellow-300 custom-transition"
              :class="
                isPostStarred
                  ? 'text-yellow-300 fill-yellow-300'
                  : 'text-primary-100'
              "
            />
            <span class="text-sm">
              {{ post.total_stars }}
            </span>
          </div>
          <Link
            :href="route('posts.show', post.id)"
            class="flex gap-1 items-center cursor-pointer group px-2 py-1 text-primary-100 group"
          >
            <ChatBubbleBottomCenterIcon
              class="w-6 h-6 group-hover:text-accent-100 custom-transition"
              :class="
                isPostCommented
                  ? 'text-accent-100 fill-accent-100'
                  : 'text-primary-100'
              "
            />
            <span class="text-sm">
              {{ post.total_comments }}
            </span>
          </Link>
        </div>
        <TrashIcon
          v-if="auth.user.id === post.user_id || auth.user.is_admin"
          class="w-6 h-6 text-error-100 cursor-pointer hover:text-error-200 custom-transition"
          @click="$emit('delete', post)"
        />
      </div>
    </div>
  </div>
</template>
