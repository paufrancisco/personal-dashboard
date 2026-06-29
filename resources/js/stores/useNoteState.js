import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

export const useNoteState = defineStore('notes', () => {

    const notes = ref([])

    async function fetchNotes() {
        const response = await axios.get('/api/v1/notes')
        notes.value = response.data
    }

    async function addNote(form) {
        await axios.post('/api/v1/notes', form)
        await fetchNotes()
    }

    async function editNote(id, form) {
        await axios.put(`/api/v1/notes/${id}`, form)
        await fetchNotes()
    }

    async function removeNote(id) {
        await axios.delete(`/api/v1/notes/${id}`)
        await fetchNotes()
    }

    return {
        notes,
        fetchNotes,
        addNote,
        editNote,
        removeNote
    }
})