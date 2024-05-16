<script setup>
import Input from "@/Components/Input.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import { computed } from "vue";

const emit = defineEmits(["submit", "clearStatus"]);

const props = defineProps({
  submitText: {
    type: String,
    required: true,
  },
  buttonStyle: {
    type: String,
    default: "default",
  },
  form: {
    type: Object,
    required: true,
  },
  inputs: {
    type: Array,
    required: true,
  },
  status: {
    type: String,
    default: null,
  },
  autofocus: {
    type: Boolean,
    default: true,
  },
});

const formKeys = Object.keys(props.form.data());

const isButtonDisabled = computed(() => {
  return (
    formKeys.some(
      (key) =>
        props.form[key] === null ||
        props.form[key] === undefined ||
        props.form[key] === ""
    ) || props.form.processing
  );
});

const firstErrorMessage = computed(() => {
  if (props.form.hasErrors) {
    const firstErrorKey = Object.keys(props.form.errors)[0];
    if (firstErrorKey) {
      return props.form.errors[firstErrorKey];
    }
  }
  return null;
});

function triggeredInput(event, id) {
  props.form.clearErrors();
  if (props.status) emit("clearStatus");
}
</script>

<template>
  <form @submit.prevent="$emit('submit')">
    <div
      class="my-4 rounded-md relative"
      :class="{
        'ring-2 ring-error-100': firstErrorMessage,
        'ring-2 ring-accent-100': status,
      }"
    >
      <div
        v-show="firstErrorMessage || status"
        class="absolute bottom-[calc(100%-2px)] w-full text-center text-base-100 py-2 rounded-t-md"
        :class="{
          'ring-2 ring-error-100 bg-error-100 border-error-100':
            firstErrorMessage,
          'ring-2 ring-accent-100 bg-accent-100 border-accent-100': status,
        }"
      >
        {{ firstErrorMessage || status }}
      </div>
      <Input
        v-for="input in inputs"
        :refObject="input.ref"
        :key="input.id"
        :id="input.id"
        :type="input.type"
        v-model="form[input.id]"
        :label="input.label"
        :position="input.position"
        :autocomplete="input.autocomplete"
        @input="triggeredInput($event, input.id)"
        :autofocus="autofocus"
      />
    </div>
    <slot name="before" />
    <slot name="main">
      <div
        v-if="buttonStyle !== 'none'"
        :class="{
          'flex items-center mt-4':
            buttonStyle === 'end' || buttonStyle === 'start',
          'justify-end': buttonStyle === 'end',
          'justify-start': buttonStyle === 'start',
        }"
      >
        <ButtonPrimary
          :class="{
            'bg-disabled-100': isButtonDisabled,
            'w-full text-center py-4 my-4': buttonStyle === 'default',
          }"
          :disabled="isButtonDisabled"
        >
          {{ submitText }}
        </ButtonPrimary>
      </div>
    </slot>
    <slot name="after" />
  </form>
</template>
