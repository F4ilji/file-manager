<template>
  <div
      class="hs-dropdown-toggle select-none focus:bg-gray-100 rounded-md px-1.5 py-0.5 hs-dragged:rounded hs-dragged:bg-blue-100"
      role="treeitem"
      tabindex="-1"
      :data-hs-tree-view-item="JSON.stringify({ value: item.name, isDir: false })"
      :data-type="item.type"
  >
    <div class="flex items-center gap-x-3 cursor-pointer">
      <!-- Иконка файла -->
      <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
        <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
      </svg>
      <div class="grow">
        <span class="text-sm text-gray-800 dark:text-neutral-200">
          {{ item.name }}
        </span>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import type {FileItem} from '../types';

const { item } = defineProps<{
  item: FileItem,
}>();
</script>


<style scoped>

</style>