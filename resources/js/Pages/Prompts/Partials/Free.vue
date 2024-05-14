<script setup>
import { ref, computed } from "vue";
import Spinner from "@/Components/Spinner.vue";
import Input from "@/Components/Input.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import MarkdownRenderer from "vue-markdown-render";

const prompt = ref("");
const response = ref("");
const errorMessage = ref("");
const isLoading = ref(false);

const isSubmitDisabled = computed(() => {
  return !prompt.value || isLoading.value;
});

function submit() {
  isLoading.value = true;
  response.value = null;
  axios
    .post(route("prompts.store.free"), { prompt: prompt.value })
    .then((res) => {
      response.value = res.data.response.text;
      isNewlySubmitted.value = true;
    })
    .catch((error) => {
      errorMessage.value = error.response.data.message;
    })
    .finally(() => {
      isLoading.value = false;
    });
}
</script>

<template>
  <div class="sm:w-3/4">
    <form @submit.prevent="submit">
      <h1 class="mb-1 pl-1">
        Use this <span class="text-accent-100">free</span> to test our services.
      </h1>
      <Input
        v-model="prompt"
        id="prompt"
        type="textarea"
        label="Eg: Give me a step-by-step guide to farm tomatoes in my small backyard garden."
        position="alone"
      />
      <div
        class="flex items-center mt-4"
        :class="[errorMessage ? 'justify-between' : 'justify-end']"
      >
        <p class="text-sm text-error-100">{{ errorMessage }}</p>
        <div class="flex items-center gap-4">
          <Spinner v-if="isLoading" />
          <ButtonPrimary
            :class="{
              'bg-disabled-100': isSubmitDisabled,
            }"
            :disabled="isSubmitDisabled"
          >
            Submit
          </ButtonPrimary>
        </div>
      </div>
    </form>
    <MarkdownRenderer
      id="markdown"
      :source="response"
      v-if="response"
      class="sm:w-3/4 my-4"
    />
  </div>
</template>

<style>
#markdown strong {
  @apply text-accent-100 mb-2;
}

#markdown ul {
  list-style-type: disc;
  padding-left: 1.5rem;
  margin-bottom: 1rem;
}

#markdown ol {
  list-style-type: decimal;
  padding-left: 1.5rem;
  margin-bottom: 1rem;
}
</style>
