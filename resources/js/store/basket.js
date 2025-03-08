import { defineStore } from 'pinia'
export const useBasketStore = defineStore('basket', {
    state: () => ({ items: [] }),
    getters: {
        getItems: (state) => state.items,
    },
    actions: {
        addItem(item) {
            console.log(item);
            const existingItem = this.items.find(i => i.product.id == item.product.id)
            if (existingItem) {
                existingItem.count++
            } else {
                this.items.push({ ...item, count: 1 })
            }
        },
        setItems(items) {
            this.items = items
        }
    },
})