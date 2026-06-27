<template>
    <AuthenticatedLayout>
        <template #header>Command Shortcuts</template>

        <div class="p-6">

            <!-- Add Button -->
            <div class="flex justify-end mb-4">
                <button
                    @click="showModal = true"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    + Add Shortcut
                </button>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Command</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-if="store.shortcuts.length === 0">
                            <td colspan="4" class="px-6 py-4 text-center text-gray-400">
                                No shortcuts yet.
                            </td>
                        </tr>
                        <tr v-for="shortcut in store.shortcuts" :key="shortcut.id">
                            <td class="px-6 py-4">{{ shortcut.title }}</td>
                            <td class="px-6 py-4">{{ shortcut.category }}</td>
                            <td class="px-6 py-4">{{ shortcut.command }}</td>
                            <td class="px-6 py-4">
                                <button class="text-indigo-600 hover:text-indigo-800 mr-3">Edit</button>
                                <button class="text-red-500 hover:text-red-700">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Add Shortcut</h2>
                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">✕</button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" v-model="form.title" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g. Laravel Serve" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select v-model="form.category" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Select category</option>
                                <option>Laravel</option>
                                <option>Git</option>
                                <option>SQL</option>
                                <option>Linux</option>
                                <option>Docker</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Command</label>
                            <textarea v-model="form.command" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="3" placeholder="e.g. php artisan serve"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button @click="showModal = false" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</button>
                        <button @click="saveShortcut()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Save</button>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { useShortcutState } from '@/stores/useShortcutState'

const store = useShortcutState()
const showModal = ref(false)

const form = ref({
    title: '',
    category: '',
    command: ''
})

async function saveShortcut() {
    await store.addShortcut(form.value)
    showModal.value = false
    form.value = { title: '', category: '', command: '' }
}

onMounted(() => {
    store.fetchShortcuts()
})
</script>

<style scoped>
</style>