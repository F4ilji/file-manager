<template>
  <div
      class="hs-accordion hs-dragged:bg-blue-100 hs-dragged:rounded active"
      role="treeitem"
      ref="activeChecked"
      :id="`tree-node-accordion-${item.id}`"
      :data-hs-tree-view-item="JSON.stringify({ value: item.name, isDir: true })"
      :data-type="item.type"
  >
    <!-- Заголовок папки (элемент, по которому кликают) -->
    <div
        class="hs-accordion-heading select-none focus:outline-none focus:bg-gray-100 py-0.5 rounded-md flex items-center gap-x-0.5 w-full hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700"
        tabindex="-1"
        @keydown.left.prevent="handleArrowLeftKey"
        @keydown.right.prevent="handleArrowRightKey"
    >
      <!-- Кнопка для сворачивания/разворачивания -->
      <button
          ref="accordionToggleButton"
          class="hs-accordion-toggle size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
          :aria-controls="`tree-node-content-${item.id}`"
      >
        <svg class="size-4 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 12h14"></path>
          <path class="hs-accordion-active:hidden block" d="M12 5v14"></path>
        </svg>
      </button>

      <!-- Название и иконка папки -->
      <div class="grow hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 px-1.5 rounded-md cursor-pointer">
        <div class="flex items-center gap-x-3">
          <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"></path>
          </svg>
          <div class="grow">
            <span class="text-sm text-gray-800 dark:text-neutral-200">
              {{ item.name }}
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Содержимое папки (вложенные элементы) -->
    <div
        :id="`tree-node-content-${item.id}`"
        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
        role="group"
        :aria-labelledby="`tree-node-accordion-${item.id}`"
    >
      <div
          :data-folder-id="item.id"
          class="hs-accordion-group ps-7 relative before:absolute before:top-0 before:start-3 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700"
          data-hs-accordion-always-open
          data-hs-nested-draggable
      >
        <!-- Рекурсивный вызов для дочерних элементов -->
        <TreeNode
            v-for="child in item.children"
            :key="child.id"
            :item="child"
        />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import type { FolderItem } from '../types';
import TreeNode from "@/components/TreeNode.vue";

const { item } = defineProps<{
  item: FolderItem,
}>();

// Создаем ref, который будет ссылаться на кнопку в шаблоне
const accordionToggleButton = ref<HTMLButtonElement | null>(null);
const activeChecked = ref<HTMLButtonElement | null>(null);


const handleArrowLeftKey = (event: KeyboardEvent) => {
  if (activeChecked.value?.classList.contains('active') && event.key === "ArrowLeft") {
    accordionToggleButton.value?.click();
  }
};

const handleArrowRightKey = (event: KeyboardEvent) => {
  if (!activeChecked.value?.classList.contains('active') && event.key === "ArrowRight") {
    accordionToggleButton.value?.click();
  }
};
</script>

<style scoped>
/* Ваши стили, если они есть */
</style>