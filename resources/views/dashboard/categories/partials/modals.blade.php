<x-ui.simple-modal id="addCategoryModal" title="Add Category">
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
            <x-ui.button type="submit" class="flex-1">Add Category</x-ui.button>
            <x-ui.button type="button" variant="secondary" onclick="document.getElementById('addCategoryModal').classList.add('hidden')">
                Cancel
            </x-ui.button>
        </div>
    </form>
</x-ui.simple-modal>

<x-ui.simple-modal id="editCategoryModal" title="Edit Category">
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
            <x-ui.button type="submit" class="flex-1">Update Category</x-ui.button>
            <x-ui.button type="button" variant="secondary" onclick="document.getElementById('editCategoryModal').classList.add('hidden')">
                Cancel
            </x-ui.button>
        </div>
    </form>
</x-ui.simple-modal>

<script>
    (function() {
        var addColor = document.getElementById('category_color');
        var addText = document.getElementById('category_color_text');
        if (addColor && addText) {
            addColor.addEventListener('input', function(e) { addText.value = e.target.value; });
            addText.addEventListener('input', function(e) {
                if (/^#[0-9A-Fa-f]{6}$/.test(e.target.value)) addColor.value = e.target.value;
            });
        }
        var editColor = document.getElementById('edit_category_color');
        var editText = document.getElementById('edit_category_color_text');
        if (editColor && editText) {
            editColor.addEventListener('input', function(e) { editText.value = e.target.value; });
            editText.addEventListener('input', function(e) {
                if (/^#[0-9A-Fa-f]{6}$/.test(e.target.value)) editColor.value = e.target.value;
            });
        }
    })();

    function editCategory(id, name, type, color) {
        var form = document.getElementById('editCategoryForm');
        if (form) form.action = '/categories/' + id;
        document.getElementById('edit_category_id').value = id;
        document.getElementById('edit_category_name').value = name;
        document.getElementById('edit_category_type').value = type;
        document.getElementById('edit_category_type_hidden').value = type;
        document.getElementById('edit_category_color').value = color;
        document.getElementById('edit_category_color_text').value = color;
        document.getElementById('editCategoryModal').classList.remove('hidden');
    }
</script>
