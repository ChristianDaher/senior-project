<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Post from "@/Components/Post.vue";
import Modal from "@/Components/Modal.vue";
import ButtonSecondary from "@/Components/Buttons/ButtonSecondary.vue";
import ButtonDanger from "@/Components/Buttons/ButtonDanger.vue";
import { ref } from "vue";

defineProps({
  posts: {
    type: Array,
    default: () => [],
  },
});

const isModalOpen = ref(false);
const postToDelete = ref(null);

const form = useForm({});

function openModal(post) {
  postToDelete.value = post;
  isModalOpen.value = true;
}

function closeModal() {
  isModalOpen.value = false;
  postToDelete.value = null;
}

function confirmDelete() {
  form.delete(route("posts.destroy", postToDelete.value.id), {
    preserveScroll: true,
    onSuccess: () => {
      closeModal();
    },
  });
}

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
              <Post
                v-for="post in posts"
                :key="post.id"
                :post="post"
                @delete="openModal"
              />
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
    <Modal :show="isModalOpen" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-primary-100">
          Are you sure you want to delete this post?
        </h2>
        <p class="mt-1 text-sm text-secondary-100 mb-4">
          Once it is deleted, all of its comments, likes and stars will be
          permanently deleted.
        </p>
        <form class="flex justify-end gap-4" @submit.prevent="confirmDelete">
          <ButtonSecondary @click="closeModal"> Cancel </ButtonSecondary>
          <ButtonDanger
            :disabled="form.processing"
            :class="{ 'bg-disabled-100': form.processing }"
          >
            Delete
          </ButtonDanger>
        </form>
      </div>
    </Modal>
  </AuthenticatedLayout>
</template>
