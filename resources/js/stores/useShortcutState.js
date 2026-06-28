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

    async function removeShortcut(id) {
        await axios.delete(`/api/v1/shortcuts/${id}`)
        await fetchShortcuts()
    }

    async function editShortcut(id, form) {
        await axios.put(`/api/v1/shortcuts/${id}`, form)
        await fetchShortcuts()
    }
 
    return {
        shortcuts,
        fetchShortcuts,
        removeShortcut,
        editShortcut,
        addShortcut
    }
})