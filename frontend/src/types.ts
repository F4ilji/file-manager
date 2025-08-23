export interface FileItem {
    id: string;
    name: string;
    type: 'file';
    mime_type?: string;
    size?: number;
}

export interface FolderItem {
    id: string;
    name: string;
    type: 'folder';
    children: TreeItem[]; // Папка может содержать другие элементы
}

// Union Type для удобства
export type TreeItem = FileItem | FolderItem;