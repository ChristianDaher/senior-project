<script setup>
import { Link } from "@inertiajs/vue3";
import { ArrowLeftIcon } from "@heroicons/vue/24/solid";

defineProps({
  post: {
    type: Object,
    default: () => {},
  },
});

//was fixing more here THIS IS JUST A PLACEHOLDER
</script>

<template>
  <Link
    :href="route('dashboard')"
    class="inline-block m-4 p-1 rounded-full hover:bg-disabled-100 outline-none focus:bg-disabled-100 custom-transition"
  >
    <ArrowLeftIcon class="h-6 w-6 text-accent-200" />
  </Link>

  <div
    class="flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 custom-transition"
  >
    <img
      v-if="post.image_url"
      class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-96 md:rounded-none md:rounded-s-lg"
      :src="post.image_url"
      alt="Post Image"
    />
    <div class="flex flex-col p-4 leading-normal">
      <h5 class="mb-2 text-2xl font-bold tracking-tight text-primary-100">
        {{ post.title }}
      </h5>
      <p class="mb-3 font-normal text-secondary-100">
        {{ post.description }}
      </p>
    </div>
  </div>
</template>
