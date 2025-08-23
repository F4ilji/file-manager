<!-- FileTree.vue -->
<template>
  <div class="hs-accordion-treeview-root" role="tree" ref="treeRootEl">
    <div class="hs-accordion-group" data-hs-accordion-always-open data-hs-nested-draggable>
      <TreeNode
          v-for="item in fileTree"
          :key="item.id"
          :item="item"
      />
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, reactive } from 'vue';
import Sortable from 'sortablejs';
import TreeNode from './TreeNode.vue';
import type { TreeItem } from '../types';

const treeRootEl = ref<HTMLElement | null>(null);

const fileTree = reactive<TreeItem[]>([
  {
    id: 'a71e1645-f04b-48d0-8f9d-16a75971a8e9',
    name: 'assets',
    type: 'folder',
    children: [
      {
        id: 'd9b7364b-a1e8-4a94-b22c-a0e4c6b8764b',
        name: 'styles.css',
        type: 'file'
      },
      {
        id: '2f3a8b23-1d4e-4e89-8b01-3b4a2e5c6d7e',
        name: 'img',
        type: 'folder',
        children: [
          {
            id: '5e7f1c9d-8a6e-4b21-9c3f-4e5a6f7b8d9c',
            name: 'hero.jpg',
            type: 'file'
          },
        ],
      },
    ],
  },
  {
    id: '6c1a823e-9f4d-4c5a-b6e7-1e8c9f2d0a3b',
    name: 'scripts',
    type: 'folder',
    children: [
      {
        id: 'f8d3c1a9-b7e6-4a5f-9c2d-7a4e6b1c8d3e',
        name: 'preline.js',
        type: 'file'
      },
      {
        id: '8a9c7b2e-1f0a-4d3c-9e6b-5a7c9f1e3d2b',
        name: 'package.json',
        type: 'file',
      },
    ],
  }
]);

onMounted(() => {
  if (!treeRootEl.value) return;

  const draggableContainers = treeRootEl.value.querySelectorAll<HTMLElement>('[data-hs-nested-draggable]');

  draggableContainers.forEach((container) => {
    new Sortable(container, {
      group: 'nested',
      animation: 150,
      fallbackOnBody: true,
      swapThreshold: 0.65,
      ghostClass: 'dragged',
      sort: false,

      onEnd: (evt) => {
        console.log(evt);
        // Здесь ваша логика для обновления структуры данных после перетаскивания
      },
    });
  });
});
</script>