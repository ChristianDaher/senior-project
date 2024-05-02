<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ArrowLeftIcon } from "@heroicons/vue/24/solid";
import Post from "@/Components/Post.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";

defineProps({
  post: {
    type: Object,
    default: () => {},
  },
});
//still fixing here
</script>

<template>
  <Head :title="post.title" />
  <div class="min-h-screen bg-disabled-100/50 py-4">
    <div
      class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-base-100 shadow rounded-md"
    >
      <Link
        :href="route('dashboard')"
        class="inline-block m-4 p-1 rounded-full hover:bg-disabled-100 outline-none focus:bg-disabled-100 custom-transition"
      >
        <ArrowLeftIcon class="h-6 w-6 text-accent-200" />
      </Link>
      <Post :post="post" :key="post.id" />
      <div class="flex items-start space-x-4 my-4">
        <img
          class="inline-block h-10 w-10 rounded-full"
          src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
          alt=""
        />
        <div class="min-w-0 flex-1">
          <form @submit.prevent="comment">
            <div
              class="border-b border-gray-200 focus-within:border-accent-100"
            >
              <label for="comment" class="sr-only">Add your comment</label>
              <input
                id="comment"
                class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 text-gray-900 placeholder:text-gray-400 focus:border-accent-100 focus:ring-0 sm:text-sm sm:leading-6"
                placeholder="Add your comment..."
              />
            </div>
            <div class="flex justify-between pt-2">
              <div class="flex items-center space-x-5"></div>
              <div class="flex-shrink-0">
                <ButtonPrimary> Post </ButtonPrimary>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
