<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ArrowLeftIcon, UserCircleIcon } from "@heroicons/vue/24/solid";
import {
  StarIcon,
  HeartIcon,
  ChatBubbleBottomCenterIcon,
} from "@heroicons/vue/24/outline";
import { TrashIcon } from "@heroicons/vue/24/solid";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import Comment from "@/Components/Comment.vue";
import { ref } from "vue";

const props = defineProps({
  post: {
    type: Object,
    default: () => {},
  },
  backRoute: {
    type: String,
    default: () => route("dashboard"),
  },
});

const form = useForm({
  content: "",
});

const commentInput = ref();

function submit() {
  form.post(route("posts.comment", props.post.id), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      isPostCommented.value = true;
    },
  });
}

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

function openDeleteModal() {}
</script>

<template>
  <Head :title="post.title" />
  <div
    class="min-h-screen bg-disabled-100/50 py-4 before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-full before:h-1/2 before:bg-gradient-to-t from-accent-200 to-accent-300"
  >
    <div
      class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-base-100 shadow rounded-md mb-4 relative"
    >
      <Link
        :href="backRoute"
        class="inline-block mb-4 p-1 rounded-full hover:bg-disabled-100 outline-none focus:bg-disabled-100 custom-transition"
      >
        <ArrowLeftIcon class="h-6 w-6 text-accent-200" />
      </Link>
      <div class="md:flex gap-4">
        <div class="basis-1/2 mb-4 md:mb-0" v-if="post.image_url">
          <img
            class="object-cover rounded-md shadow"
            :src="post.image_url"
            alt="Post Image"
          />
        </div>
        <div>
          <h1 class="text-3xl font-bold text-primary-100 mb-2">
            {{ post.title }}
          </h1>
          <p class="text-secondary-100">{{ post.description }}</p>
        </div>
      </div>
      <div class="flex items-center justify-between mt-4">
        <div class="flex gap-4">
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
          <div
            @click="() => commentInput.focus()"
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
          </div>
        </div>
        <TrashIcon
          v-if="auth.user.id === post.user_id || auth.user.is_admin"
          class="w-6 h-6 text-error-100 cursor-pointer hover:text-error-200 custom-transition"
          @click="openDeleteModal"
        />
      </div>
    </div>
    <div
      class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-base-100 shadow rounded-md relative"
    >
      <div class="flex items-start space-x-4 my-4">
        <!-- <img
          class="inline-block h-10 w-10 rounded-full"
          src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
          alt=""
          /> -->
        <UserCircleIcon class="h-10 w-10 text-secondary-100" />
        <div class="min-w-0 flex-1">
          <form @submit.prevent="submit">
            <div
              class="border-b border-disabled-100 focus-within:border-accent-100"
            >
              <label for="comment" class="sr-only">Add your comment</label>
              <input
                id="comment"
                class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 text-primary-100 placeholder:text-secondary-100 focus:border-accent-100 focus:ring-0 sm:text-sm sm:leading-6 custom-transition"
                placeholder="Add your comment..."
                v-model="form.content"
                ref="commentInput"
              />
            </div>
            <div class="flex justify-between pt-2">
              <div class="flex items-center space-x-5 text-sm text-error-100">
                {{ form.errors["content"] }}
              </div>
              <div class="flex-shrink-0">
                <ButtonPrimary
                  :disabled="!form.content"
                  :class="{
                    'bg-disabled-100': !form.content,
                  }"
                >
                  Submit
                </ButtonPrimary>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="space-y-8">
        <Comment
          v-for="comment in post.comments"
          :key="comment.id"
          :comment="comment"
        />
      </div>
    </div>
  </div>
</template>
