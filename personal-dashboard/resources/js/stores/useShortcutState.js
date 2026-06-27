import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

export const useShortcutState = defineStore('shortcuts', () => {

    const shortcuts = ref([])

    async function fetchShortcuts() {
        const response = await axios.get('/api/v1/shortcuts')
        shortcuts.value = response.data
    }

    async function addShortcut(form) {
        await axios.post('/api/v1/shortcuts', form)
        await fetchShortcuts()
    }

    return {
        shortcuts,
        fetchShortcuts,
        addShortcut
    }
})