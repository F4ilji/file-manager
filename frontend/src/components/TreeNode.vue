<!-- TreeNode.vue -->
<template>
  <FolderNode v-if="item.type === 'folder'" :item="item" />
  <FileNode v-else :item="item" />
</template>

<script setup lang="ts">
import type { TreeItem } from '../types';
import FolderNode from "@/components/FolderNode.vue";
import FileNode from "@/components/FileNode.vue";
import type {PropType} from "vue"; // Self-referencing for recursion

defineProps({
  item: {
    type: Object as PropType<TreeItem>,
    required: true,
  }
});
</script>