import { defineStore } from 'pinia'
export const useBasketStore = defineStore('basket', {
    state: () => ({ items: [] }),
    getters: {
        getItems: (state) => state.items,
    },
    actions: {
        addItem(item) {
            this.items.push(item)
        },
    },
})