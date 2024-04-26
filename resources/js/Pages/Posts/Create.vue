<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Input from "@/Components/Input.vue";
import { PhotoIcon } from "@heroicons/vue/24/solid";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import { computed } from "vue";
import Tag from "@/Components/Tag.vue";

defineProps({
  tags: {
    type: Array,
    default: () => [],
  },
});

const form = useForm({
  title: "",
  description: "",
  tags: [],
  image: null,
});

function submit() {
  form.post(route("posts.store"), {
    onFinish: () => {
      form.reset();
    },
  });
}

const isCreateButtonDisabled = computed(() => {
  return !form.title || !form.description || form.processing;
});

//add drag and drop
</script>

<template>
  <Head title="Create Post" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-primary-100 leading-tight">
        Create Post
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-primary-100">
            <form @submit.prevent="submit" class="w-3/4">
              <Input
                v-model="form.title"
                id="tilte"
                type="text"
                label="Title of your post"
                position="first"
                autocomplete="title"
              />
              <Input
                v-model="form.description"
                id="description"
                type="textarea"
                label="Describe the purpose / content of your post"
                position="last"
                autocomplete="description"
              />
              <div class="my-4">
                <p class="mb-2 text-primary-100 text-lg">
                  Choose at least 1 tag
                </p>
                <div class="flex item-center flex-wrap gap-4">
                  <Tag v-for="tag in tags" :tag="tag" :key="tag.id" />
                </div>
              </div>
              <div
                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
              >
                <div class="text-center">
                  <PhotoIcon
                    class="mx-auto h-16 w-16 text-disabled-100"
                    aria-hidden="true"
                  />
                  <div class="mt-4 flex text-sm leading-6 text-primary-100">
                    <p>You may also</p>
                    <label
                      for="file-upload"
                      class="relative cursor-pointer rounded-md bg-base-100 font-semibold text-accent-200 custom-transition focus-within:outline-none focus-within:ring-2 focus-within:ring-accent-200 focus-within:ring-offset-2 hover:text-accent-100"
                    >
                      <span>&nbsp;upload an image</span>
                      <input
                        id="file-upload"
                        name="file-upload"
                        type="file"
                        class="sr-only"
                        accept="image/png, image/jpeg, image/jpg"
                        @input="form.image = $event.target.files[0]"
                      />
                    </label>
                    <!-- <p>or drag and drop</p> -->
                  </div>
                  <p class="text-xs leading-5 text-secondary-100">
                    PNG, JPG and JPEG up to 10MB
                  </p>
                </div>
              </div>
              <div class="flex items-center mt-4 justify-end">
                <ButtonPrimary
                  :class="{
                    'bg-disabled-100': isCreateButtonDisabled,
                  }"
                  :disabled="isCreateButtonDisabled"
                >
                  Create
                </ButtonPrimary>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
