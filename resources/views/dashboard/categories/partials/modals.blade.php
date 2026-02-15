<!-- Add Category Modal -->
<div id="addCategoryModal"
    class="hidden fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-75 overflow-y-auto h-full w-full z-50">
    <div
        class="relative top-20 mx-auto p-5 border border-gray-200 dark:border-gray-700 w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Add Category</h3>
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <x-form.input id="category_name" name="name" label="Name" type="text"
                    placeholder="e.g., Groceries, Rent" required />
                <x-form.select id="category_type" name="type" label="Type" required>
                    <option value="expense">Expense</option>
                    <option value="income">Income</option>
                </x-form.select>
                <div>
                    <x-form.input-label for="category_color" value="Color" />
                    <div class="flex gap-2 items-center mt-1">
                        <input type="color" id="category_color" name="color" value="#6B7280"
                            class="h-10 w-20 rounded border border-gray-300 dark:border-gray-600 cursor-pointer"
                            required />
                        <input type="text" id="category_color_text" value="#6B7280" pattern="^#[0-9A-Fa-f]{6}$"
                            class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                            placeholder="#6B7280" />
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Select a color to identify this category
                    </p>
                </div>
                <div class="flex gap-2">
                    <x-primary-button class="flex-1">Add Category</x-primary-button>
                    <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategoryModal"
    class="hidden fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-75 overflow-y-auto h-full w-full z-50">
    <div
        class="relative top-20 mx-auto p-5 border border-gray-200 dark:border-gray-700 w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Edit Category</h3>
            <form id="editCategoryForm" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <input type="hidden" id="edit_category_id" name="category_id" />
                <x-form.input id="edit_category_name" name="name" label="Name" type="text" required />
                <div>
                    <x-form.select id="edit_category_type" name="type" label="Type" disabled>
                        <option value="expense">Expense</option>
                        <option value="income">Income</option>
                    </x-form.select>
                    <input type="hidden" id="edit_category_type_hidden" name="type" />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Type cannot be changed after creation</p>
                </div>
                <div>
                    <x-form.input-label for="edit_category_color" value="Color" />
                    <div class="flex gap-2 items-center mt-1">
                        <input type="color" id="edit_category_color" name="color" value="#6B7280"
                            class="h-10 w-20 rounded border border-gray-300 dark:border-gray-600 cursor-pointer"
                            required />
                        <input type="text" id="edit_category_color_text" value="#6B7280" pattern="^#[0-9A-Fa-f]{6}$"
                            class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                            placeholder="#6B7280" />
                    </div>
                </div>
                <div class="flex gap-2">
                    <x-primary-button class="flex-1">Update Category</x-primary-button>
                    <button type="button"
                        onclick="document.getElementById('editCategoryModal').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Sync color picker with text input for add modal
    document.getElementById('category_color').addEventListener('input', function(e) {
        document.getElementById('category_color_text').value = e.target.value;
    });

    document.getElementById('category_color_text').addEventListener('input', function(e) {
        if (/^#[0-9A-Fa-f]{6}$/.test(e.target.value)) {
            document.getElementById('category_color').value = e.target.value;
        }
    });

    // Sync color picker with text input for edit modal
    document.getElementById('edit_category_color').addEventListener('input', function(e) {
        document.getElementById('edit_category_color_text').value = e.target.value;
    });

    document.getElementById('edit_category_color_text').addEventListener('input', function(e) {
        if (/^#[0-9A-Fa-f]{6}$/.test(e.target.value)) {
            document.getElementById('edit_category_color').value = e.target.value;
        }
    });

    // Update edit form action URL
    function editCategory(id, name, type, color) {
        const form = document.getElementById('editCategoryForm');
        form.action = `/categories/${id}`;

        document.getElementById('edit_category_id').value = id;
        document.getElementById('edit_category_name').value = name;
        document.getElementById('edit_category_type').value = type;
        document.getElementById('edit_category_type_hidden').value = type;
        document.getElementById('edit_category_color').value = color;
        document.getElementById('edit_category_color_text').value = color;

        document.getElementById('editCategoryModal').classList.remove('hidden');
    }
</script>
