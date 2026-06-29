<template>
    <AuthenticatedLayout>
        <template #header>Notes</template>

        <div class="p-6">

            <!-- Add Button -->
            <div class="flex justify-end mb-4">
                <button
                    @click="showModal = true"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    + Add Note
                </button>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-4 gap-4">
                <div
                    v-for="note in store.notes"
                    :key="note.id"
                    class="bg-white rounded-lg shadow p-4 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-semibold text-gray-800">{{ note.title }}</h3>
                            <span class="text-xs text-gray-400 italic ml-2 whitespace-nowrap">
                                {{ new Date(note.created_at).toLocaleDateString() }}
                            </span>
                        </div>
                        <p class="text-gray-500 text-sm line-clamp-3">{{ note.content }}</p>
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button @click="openEdit(note)" class="text-indigo-600 hover:text-indigo-800">
                            <PencilSquareIcon class="w-5 h-5" />
                        </button>
                        <button @click="store.removeNote(note.id)" class="text-red-500 hover:text-red-700">
                            <TrashIcon class="w-5 h-5" />
                        </button>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-if="store.notes.length === 0" class="text-center text-gray-400 mt-10">
                No notes yet.
            </div>

            <!-- Modal -->
            <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">
                            {{ editMode ? 'Edit Note' : 'Add Note' }}
                        </h2>
                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">✕</button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" v-model="form.title" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g. Shopping List" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                            <textarea v-model="form.content" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="5" placeholder="Write your note here..."></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button @click="showModal = false" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</button>
                        <button @click="saveNote()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Save</button>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { useNoteState } from '@/stores/useNoteState'
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline'

const store = useNoteState()
const showModal = ref(false)
const editMode = ref(false)
const selectedId = ref(null)

const form = ref({
    title: '',
    content: ''
})

function openEdit(note) {
    editMode.value = true
    selectedId.value = note.id
    form.value = {
        title: note.title,
        content: note.content
    }
    showModal.value = true
}

async function saveNote() {
    if (editMode.value) {
        await store.editNote(selectedId.value, form.value)
    } else {
        await store.addNote(form.value)
    }
    showModal.value = false
    editMode.value = false
    selectedId.value = null
    form.value = { title: '', content: '' }
}

onMounted(() => {
    store.fetchNotes()
})
</script>

<style scoped>
</style>