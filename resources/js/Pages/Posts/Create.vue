<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Input from "@/Components/Input.vue";
import { PhotoIcon } from "@heroicons/vue/24/solid";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import { computed, ref, watch } from "vue";
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
  form.post(route("posts.store"));
}

const isCreateButtonDisabled = computed(() => {
  return !form.title || !form.description || form.processing;
});

function toggleTag(id) {
  const index = form.tags.indexOf(id);
  if (index === -1) {
    form.tags.push(id);
  } else {
    form.tags.splice(index, 1);
  }
}

const image = ref(null);
function handleImageChange(event) {
  if (event.target.files.length === 0) {
    return;
  }
  image.value = event.target.files[0];
  form.image = image.value;
}

const imageUrl = ref("");
watch(image, () => {
  const fileReader = new FileReader();
  fileReader.readAsDataURL(form.image);
  fileReader.addEventListener("load", () => {
    imageUrl.value = fileReader.result;
  });
});

function removeImage() {
  imageUrl.value = null;
  form.image = null;
}

const firstErrorMessage = computed(() => {
  if (form.hasErrors) {
    const firstErrorKey = Object.keys(form.errors)[0];
    if (firstErrorKey) {
      return form.errors[firstErrorKey];
    }
  }
  return null;
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
            <form @submit.prevent="submit" class="sm:w-3/4">
              <div class="mb-4">
                <p class="mb-2 text-primary-100 text-lg">
                  Choose at least 1 tag
                </p>
                <div class="flex item-center flex-wrap gap-4">
                  <Tag
                    v-for="tag in tags"
                    :tag="tag"
                    :key="tag.id"
                    :isChecked="form.tags.includes(tag.id)"
                    @toggleTag="toggleTag(tag.id)"
                  />
                </div>
              </div>
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
              <div
                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
              >
                <div class="text-center">
                  <img :src="imageUrl" v-if="imageUrl" class="object-cover" />
                  <PhotoIcon
                    v-else
                    class="mx-auto h-16 w-16 text-disabled-100"
                    aria-hidden="true"
                  />
                  <div
                    class="mt-4 flex text-sm leading-6 text-primary-100 justify-center"
                  >
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
                        accept="image/"
                        @change="handleImageChange"
                      />
                    </label>
                    <!-- <p>or drag and drop</p> -->
                  </div>
                  <p class="text-xs leading-5 text-secondary-100">
                    PNG, JPG and JPEG up to 10MB
                  </p>
                  <p
                    class="text-sm text-error-100 custom-transition hover:text-error-200 underline cursor-pointer"
                    @click="removeImage"
                    v-if="imageUrl"
                  >
                    remove image
                  </p>
                </div>
              </div>
              <div
                class="flex items-center mt-4"
                :class="[firstErrorMessage ? 'justify-between' : 'justify-end']"
              >
                <p class="text-sm text-error-100">{{ firstErrorMessage }}</p>
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
