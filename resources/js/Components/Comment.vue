<script setup>
import { UserCircleIcon } from "@heroicons/vue/24/solid";
import { formatDistanceToNow } from "date-fns";

defineProps({
  comment: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div class="flex gap-2">
    <div class="h-10 w-10">
      <UserCircleIcon class="text-disabled-100" />
    </div>
    <div class="w-3/4 break-words">
      <h1 class="text-xs">
        <span class="text-accent-100 before:content-['@']"
          >{{ comment.user.username }}{{ " " }}</span
        >
        <span class="text-secondary-100">{{
          formatDistanceToNow(new Date(comment.created_at), {
            addSuffix: true,
          })
        }}</span>
      </h1>
      <p class="text-sm text-primary-100">{{ comment.content }}</p>
    </div>
  </div>
</template>
