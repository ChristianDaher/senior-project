<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Post from "@/Components/Post.vue";

defineProps({
  posts: {
    type: Array,
    default: () => [],
  },
});

//fix scroll when going back to post
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-primary-100 leading-tight">
        will put some kind of search here
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-4 text-primary-100 space-y-4">
            <template v-if="posts.length">
              <Post v-for="post in posts" :key="post.id" :post="post" />
            </template>
            <template v-else>
              <span class="text-lg font-semibold text-primary-100"
                >No posts found.{{ " " }}</span
              >
              <Link
                class="text-accent-100 hover:underline custom-transition hover:text-accent-200"
                :href="route('posts.create')"
              >
                Create a new post
              </Link>
            </template>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
