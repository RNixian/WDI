<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tools</title>
<link rel="stylesheet" href="{{ url('css/tailwind.min.css') }}">
<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
 @if($errors->any())
  <ul>
  @foreach ($errors->all() as $error)
      <li>
  {{$error}}
      </li>
  @endforeach
  </ul>
  @endif
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        /* Main content */
        .main-content {
            margin-left: 16rem;
            min-height: 100vh;
            padding: 30px;
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 10px;
            border-bottom: 3px solid #ddd;
            margin-bottom: 25px;
        }

        .tab-button {
            padding: 14px 35px;
            font-size: 1.1rem;
            font-weight: bold;
            background: #f1f1f1;
            border: none;
            border-radius: 10px 10px 0 0;
            cursor: pointer;
            transition: 0.2s ease;
        }

        /* Tools tab */
        .tools-tab.active {
            background: #0d6efd;
            color: white;
        }

        .tools-tab:hover {
            background: #0d6efd;
            color: white;
        }

        /* Stock Card tab */
        .stock-tab.active {
            background: #dc3545;
            color: white;
        }

        .stock-tab:hover {
            background: #dc3545;
            color: white;
        }

        /* Work area */
        .work-area {
            min-height: calc(100vh - 150px);
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        /* Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .content-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .tools-title {
            color: #0d6efd;
        }

        .stock-title {
            color: #dc3545;
        }

.borrows-title {
    color: #198754;
}

.borrow-tab.active {
    background: #198754;
    color: white;
}

.borrow-tab:hover {
    background: #198754;
    color: white;
}

        /* Mobile */
        @media (max-width: 768px) {

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .tabs {
                width: 100%;
            }

            .tab-button {
                flex: 1;
                padding: 12px 10px;
            }

            .work-area {
                min-height: calc(100vh - 170px);
                padding: 20px;
            }
        }
    </style>
</head>

<body class="bg-light">

    @include('admin.sidebar')


    <!-- MAIN CONTENT -->
    <div class="main-content">

       <div class="tabs">

    <button
        id="toolsTab"
        class="tab-button active"
        onclick="showTab('tools')">
        Tools
    </button>

    <button
        id="stockTab"
        class="tab-button"
        onclick="showTab('stock')">
        Stock
    </button>

    <button
        id="borrowTab"
        class="tab-button"
        onclick="showTab('borrows')">
        Borrows
    </button>

</div>


        <!-- WORK AREA -->
        <div class="work-area">
<!-- TOOLS CONTENT -->
<div id="toolsContent" class="tab-content active">
    <!-- Header -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <!-- ACTION BUTTONS -->
        <div class="flex flex-wrap gap-3">
            <!-- ADD TOOL -->
            <button
    type="button"
    onclick="openAddToolModal()"
    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"
>
    Add Tool
</button>

            <!-- BORROW TOOL -->
            <button
                onclick="openModal('borrowToolModal')"
                class="px-5 py-3 rounded-lg bg-yellow-500 text-white font-semibold
                       hover:bg-yellow-600 transition shadow">
                ↗ Borrow
            </button>
            <!-- RETURN TOOL -->
            <button
                onclick="openModal('returnToolModal')"
                class="px-5 py-3 rounded-lg bg-green-600 text-white font-semibold
                       hover:bg-green-700 transition shadow">
                ↙ Return
            </button>
        </div>
    </div>

    <!-- TOOL TABLE / WORKSPACE -->
  <div class="overflow-x-auto">
  <table class="min-w-full table-auto border-collapse">
    <thead>
        <tr class="bg-blue-900 text-white">
            <th class="hidden">ID</th>

            <th class="px-2 py-1 border-b text-left">
                Tool Description
            </th>

            <th class="px-4 py-2 border-b text-left">
                Classification
            </th>

            <th class="px-4 py-2 border-b text-left">
                Category
            </th>

            <th class="px-4 py-2 border-b text-left">
                Size
            </th>

            <th class="px-4 py-2 border-b text-left">
                Quantity
            </th>

            <th class="px-4 py-2 border-b text-left">
                Status
            </th>

            <th class="px-4 py-2 border-b text-left">
                Serial Tag
            </th>

            <th class="px-4 py-2 border-b text-left">
                Actions
            </th>
        </tr>
    </thead>

    <tbody>
        @foreach($tools as $data)
            <tr class="bg-white odd:bg-gray-100 hover:bg-gray-200">

                {{-- ID --}}
                <td class="hidden">
                    {{ $data->id }}
                </td>

                {{-- Tool Description --}}
                <td class="px-4 py-2 border-b text-start">
                    {{ $data->tools_description }}
                </td>

                {{-- Classification --}}
                <td class="px-4 py-2 border-b text-start">
                    {{ $data->tool_class?->tool_class ?? 'N/A' }}
                </td>

                {{-- Category --}}
                <td class="px-4 py-2 border-b text-start">
                    {{ $data->tool_category?->tool_category ?? 'N/A' }}
                </td>

                {{-- Size --}}
                <td class="px-4 py-2 border-b text-start">
                    {{ $data->size ?? 'N/A' }}
                </td>

                {{-- Quantity --}}
                <td class="px-4 py-2 border-b text-start">
                    {{ $data->qty }}
                </td>

                {{-- Status --}}
                <td class="px-4 py-2 border-b text-start">
                    {{ $data->status }}
                </td>

                {{-- Serial Tag --}}
                <td class="px-4 py-2 border-b text-start">
                    {{ $data->serial_tag ?? 'N/A' }}
                </td>

                {{-- Actions --}}
                <td class="px-4 py-2 border-b space-x-4">

                    {{-- Delete --}}
                    <a
                        href="{{ route('deletetools', $data->id) }}"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded"
                    >
                        Delete
                    </a>

                    {{-- Edit --}}
                    <button
                        type="button"
                        class="btn-edit bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded"

                        data-id="{{ $data->id }}"
                        data-tools_description="{{ $data->tools_description }}"
                        data-tool_class_id="{{ $data->tool_class_id }}"
                        data-tool_cat_id="{{ $data->tool_cat_id }}"
                        data-supplier_id="{{ $data->supplier_id }}"
                        data-size="{{ $data->size }}"
                        data-qty="{{ $data->qty }}"
                        data-purchased_at="{{ $data->purchased_at }}"
                        data-brand="{{ $data->brand }}"
                        data-status="{{ $data->status }}"
                        data-invoice_reference="{{ $data->invoice_reference }}"
                        data-unit_price="{{ $data->unit_price }}"
                        data-serial_tag="{{ $data->serial_tag }}"
                    >
                        Edit
                    </button>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
   <div class="d-flex justify-content-center mt-4">
              {{ $tools->links('pagination::tailwind') }}
          </div>
</div>
</div>


<!-- ========================================================= -->
<!-- ADD TOOL MODAL -->
<!-- ========================================================= -->

<div id="addToolModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 z-50
        items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">

        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold text-blue-600">
                Add Tool
            </h2>

            <button
                type="button"
                onclick="closeModal('addToolModal')"
                class="text-gray-500 hover:text-gray-800 text-2xl">
                &times;
            </button>
        </div>

        <!-- Form -->
       <form action="{{ route('admin.storetools') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block font-semibold mb-1">
                    Tool Description
                </label>
                <input
                    type="text"
                    name="tools_description"
                    value="{{ old('tools_description') }}"
                    placeholder="Enter tool description"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-blue-500 outline-none"
                    required>
            </div>

<!-- Tool Classification -->
<div>
    <label class="block text-gray-700 font-bold mb-2" for="tool_class_id">
        Classification
    </label>

    <select
        name="tool_class_id"
        id="tool_class_id"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        required
    >
        <option value="">-- Select Classification --</option>

        @foreach ($tool_classification as $tool_class)
            <option
                value="{{ $tool_class->id }}"
                {{ old('tool_class_id') == $tool_class->id ? 'selected' : '' }}
            >
                {{ $tool_class->tool_class }}
            </option>
        @endforeach
    </select>

    @error('tool_class_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

    <!-- Tool Category -->
<div>
    <label class="block text-gray-700 font-bold mb-2" for="tool_cat_id">
        Category
    </label>

    <select
        name="tool_cat_id"
        id="tool_cat_id"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        required
    >
        <option value="">-- Select Category --</option>
    </select>

    @error('tool_cat_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    $('#tool_class_id').change(function () {

        let tool_class_id = $(this).val();

        $('#tool_cat_id').html(
            '<option value="">-- Loading... --</option>'
        );

        if (tool_class_id) {

            $.ajax({
                url: '/get-category/' + tool_class_id,
                type: 'GET',

                success: function (data) {

                    $('#tool_cat_id')
                        .empty()
                        .append(
                            '<option value="">-- Select Category --</option>'
                        );

                    $.each(data, function (key, value) {

                        $('#tool_cat_id').append(
                            '<option value="' +
                            value.id +
                            '">' +
                            value.tool_category +
                            '</option>'
                        );

                    });

                },

                error: function (xhr) {

                    console.log(xhr.responseText);

                    $('#tool_cat_id')
                        .empty()
                        .append(
                            '<option value="">-- Error loading categories --</option>'
                        );
                }
            });

        } else {

            $('#tool_cat_id').html(
                '<option value="">-- Select Category --</option>'
            );
        }
    });

});
</script>
            <!-- Size & Quantity -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Size -->
                <div>
                    <label class="block font-semibold mb-1">
                        Size
                    </label>
                    <input
                        type="text"
                        name="size"
                        value="{{ old('size') }}"
                        placeholder="e.g. 10mm"
                        class="w-full border rounded-lg px-4 py-2
                               focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- Quantity -->
                <div>
                    <label class="block font-semibold mb-1">
                        Quantity
                    </label>
                    <input
                        type="number"
                        name="qty"
                        value="{{ old('qty', 1) }}"
                        min="0"
                        placeholder="Enter quantity"
                        class="w-full border rounded-lg px-4 py-2
                               focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                </div>
            </div>
            <!-- Purchase Date & Brand -->
            <div class="grid grid-cols-2 gap-4">

                <!-- Purchased At -->
                <div>
                    <label class="block font-semibold mb-1">
                        Purchased Date
                    </label>

                    <input
                        type="date"
                        name="purchased_at"
                        value="{{ old('purchased_at') }}"
                        class="w-full border rounded-lg px-4 py-2
                               focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                </div>

                <!-- Brand -->
                <div>
                    <label class="block font-semibold mb-1">
                        Brand
                    </label>

                    <input
                        type="text"
                        name="brand"
                        value="{{ old('brand') }}"
                        placeholder="Enter brand"
                        class="w-full border rounded-lg px-4 py-2
                               focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

            </div>

            <!-- Status -->
            <div>
                <label class="block font-semibold mb-1">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-blue-500 outline-none"
                    required>

                    <option value="Available"
                        {{ old('status', 'Available') == 'Available' ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="Unavailable"
                        {{ old('status') == 'Unavailable' ? 'selected' : '' }}>
                        Unavailable
                    </option>

                    <option value="Under Maintenance"
                        {{ old('status') == 'Under Maintenance' ? 'selected' : '' }}>
                        Under Maintenance
                    </option>

                </select>
            </div>

            <div>
    <label class="block text-gray-700 font-bold mb-2" for="supplier_id">
        Supplier
    </label>

    <select
        name="supplier_id"
        id="supplier_id"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        required
    >
        <option value="">-- Select Supplier --</option>

        @foreach ($supply as $supplier)
            <option
                value="{{ $supplier->id }}"
                {{ old('tool_class_id') == $supplier->id ? 'selected' : '' }}
            >
                {{ $supplier->supplier }}
            </option>
        @endforeach
    </select>

    @error('supplier_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

            <!-- Invoice / Reference -->
            <div>
                <label class="block font-semibold mb-1">
                    Invoice / Reference
                </label>

                <input
                    type="text"
                    name="invoice_reference"
                    value="{{ old('invoice_reference') }}"
                    placeholder="Enter invoice or reference number"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <!-- Unit Price -->
            <div>
                <label class="block font-semibold mb-1">
                    Unit Price
                </label>

                <input
                    type="number"
                    name="unit_price"
                    value="{{ old('unit_price') }}"
                    min="0"
                    step="0.01"
                    placeholder="0.00"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-blue-500 outline-none"
                    required>
            </div>

            <!-- Serial Tag -->
            <div>
                <label class="block font-semibold mb-1">
                    Serial Tag
                </label>

                <input
                    type="text"
                    name="serial_tag"
                    value="{{ old('serial_tag') }}"
                    placeholder="Enter serial number/tag"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-3 border-t">

                <button
                    type="button"
                    onclick="closeModal('addToolModal')"
                    class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-600 text-white
                           hover:bg-blue-700">
                    Add Tool
                </button>

            </div>

        </form>
    </div>
</div>


<!-- ========================================================= -->
<!-- UPDATE TOOL MODAL -->
<!-- ========================================================= -->

<div id="updateToolModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 z-50
        items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">

        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold text-blue-600">
                Add Tool
            </h2>

            <button
                type="button"
                onclick="closeModal('updateToolModal')"
                class="text-gray-500 hover:text-gray-800 text-2xl">
                &times;
            </button>
        </div>

        <!-- Form -->
      <form id="updateToolForm"
      action=""
      method="POST"
      enctype="multipart/form-data"
      class="p-6 space-y-4">

    @csrf
    @method('PUT')

    <input type="hidden" name="id" id="edit_id">

    <!-- Tool Description -->
    <div>
        <label class="block font-semibold mb-1">
            Tool Description
        </label>

        <input
            type="text"
            name="tools_description"
            id="edit_tools_description"
            class="w-full border rounded-lg px-4 py-2"
            required>
    </div>

    <!-- Classification -->
    <div>
        <label class="block font-semibold mb-1">
            Classification
        </label>

       <select
    name="tool_class_id"
    id="edit_tool_class_id"
    class="w-full border rounded-lg px-4 py-2"
    required>

    <option value="">-- Select Classification --</option>

    @foreach ($tool_classification as $tool_class)
        <option value="{{ $tool_class->id }}">
            {{ $tool_class->tool_class }}
        </option>
    @endforeach

</select>
    </div>

    <!-- Category -->
    <div>
        <label class="block font-semibold mb-1">
            Category
        </label>

       <select
    name="tool_cat_id"
    id="edit_tool_cat_id"
    class="w-full border rounded-lg px-4 py-2"
    required>

    <option value="">-- Select Category --</option>

</select>
    </div>

    <!-- Size & Quantity -->
    <div class="grid grid-cols-2 gap-4">

        <div>
            <label class="block font-semibold mb-1">Size</label>

            <input
                type="text"
                name="size"
                id="edit_size"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Quantity</label>

            <input
                type="number"
                name="qty"
                id="edit_qty"
                min="0"
                class="w-full border rounded-lg px-4 py-2"
                required>
        </div>

    </div>

    <!-- Purchased Date & Brand -->
    <div class="grid grid-cols-2 gap-4">

        <div>
            <label class="block font-semibold mb-1">
                Purchased Date
            </label>

            <input
                type="date"
                name="purchased_at"
                id="edit_purchased_at"
                class="w-full border rounded-lg px-4 py-2"
                required>
        </div>

        <div>
            <label class="block font-semibold mb-1">
                Brand
            </label>

            <input
                type="text"
                name="brand"
                id="edit_brand"
                class="w-full border rounded-lg px-4 py-2">
        </div>

    </div>

    <!-- Status -->
    <div>
        <label class="block font-semibold mb-1">
            Status
        </label>

        <select
            name="status"
            id="edit_status"
            class="w-full border rounded-lg px-4 py-2"
            required>

            <option value="Available">Available</option>
            <option value="Unavailable">Unavailable</option>
            <option value="Under Maintenance">
                Under Maintenance
            </option>

        </select>
    </div>

 <div>
    <label class="block text-gray-700 font-bold mb-2" for="supplier_id">
        Supplier
    </label>

    <select
        name="supplier_id"
        id="edit_supplier_id"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        required
    >
        <option value="">-- Select Supplier --</option>

        @foreach ($supply as $supplier)
            <option
                value="{{ $supplier->id }}"
                {{ old('tool_class_id') == $supplier->id ? 'selected' : '' }}
            >
                {{ $supplier->supplier }}
            </option>
        @endforeach
    </select>

    @error('supplier_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

    <!-- Invoice -->
    <div>
        <label class="block font-semibold mb-1">
            Invoice / Reference
        </label>

        <input
            type="text"
            name="invoice_reference"
            id="edit_invoice_reference"
            class="w-full border rounded-lg px-4 py-2">
    </div>

    <!-- Unit Price -->
    <div>
        <label class="block font-semibold mb-1">
            Unit Price
        </label>

        <input
            type="number"
            name="unit_price"
            id="edit_unit_price"
            min="0"
            step="0.01"
            class="w-full border rounded-lg px-4 py-2"
            required>
    </div>

    <!-- Serial Tag -->
    <div>
        <label class="block font-semibold mb-1">
            Serial Tag
        </label>

        <input
            type="text"
            name="serial_tag"
            id="edit_serial_tag"
            class="w-full border rounded-lg px-4 py-2">
    </div>

    <!-- Buttons -->
    <div class="flex justify-end gap-3 pt-3 border-t">

        <button
            type="button"
            onclick="closeModal('updateToolModal')"
            class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
            Cancel
        </button>

        <button
            type="submit"
            class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
            Update Tool
        </button>

    </div>

</form>
    </div>
</div>

<script>
  document.querySelectorAll('.btn-edit').forEach(button => {

    button.addEventListener('click', function () {

        const id = this.dataset.id;
        const description = this.dataset.tools_description;
        const classId = this.dataset.tool_class_id;
        const categoryId = this.dataset.tool_cat_id;
        const size = this.dataset.size;
        const qty = this.dataset.qty;
        const purchasedAt = this.dataset.purchased_at;
        const brand = this.dataset.brand;
        const status = this.dataset.status;
        const supplierId = this.dataset.supplier_id;
        const invoiceReference = this.dataset.invoice_reference;
        const unitPrice = this.dataset.unit_price;
        const serialTag = this.dataset.serial_tag;

        // Set update URL
        document.getElementById('updateToolForm').action =
            `/update-tool/${id}`;

        // Fill fields
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_tools_description').value = description;
        document.getElementById('edit_tool_class_id').value = classId;
        document.getElementById('edit_size').value = size;
        document.getElementById('edit_qty').value = qty;
        document.getElementById('edit_purchased_at').value = purchasedAt;
        document.getElementById('edit_brand').value = brand;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_supplier_id').value = supplierId;
        document.getElementById('edit_invoice_reference').value =
            invoiceReference;
        document.getElementById('edit_unit_price').value = unitPrice;
        document.getElementById('edit_serial_tag').value = serialTag;

        // Load categories based on current classification
        loadCategories(classId, categoryId);

        // Open modal
        openModal('updateToolModal');
    });

});


// ==========================================
// LOAD CATEGORIES
// ==========================================

function loadCategories(classId, selectedCategoryId = null) {

    const categorySelect = $('#edit_tool_cat_id');

    categorySelect.html(
        '<option value="">-- Loading... --</option>'
    );

    if (!classId) {
        categorySelect.html(
            '<option value="">-- Select Category --</option>'
        );
        return;
    }

    $.ajax({

        url: '/get-category/' + classId,
        type: 'GET',

        success: function (data) {

            categorySelect.empty();

            categorySelect.append(
                '<option value="">-- Select Category --</option>'
            );

            $.each(data, function (key, value) {

                categorySelect.append(
                    '<option value="' + value.id + '">' +
                    value.tool_category +
                    '</option>'
                );

            });

            // Select existing category when editing
            if (selectedCategoryId) {
                categorySelect.val(selectedCategoryId);
            }

        },

        error: function (xhr) {

            console.log(xhr.responseText);

            categorySelect.html(
                '<option value="">-- Error loading categories --</option>'
            );
        }

    });
}


// ==========================================
// WHEN CLASSIFICATION CHANGES
// ==========================================

$('#edit_tool_class_id').on('change', function () {

    const classId = $(this).val();

    // Reset category because classification changed
    loadCategories(classId);

});
</script>





<!-- ========================================================= -->
<!-- BORROW TOOL MODAL -->
<!-- ========================================================= -->

<div id="borrowToolModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 z-50
           flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg">

        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b">

            <h2 class="text-xl font-bold text-yellow-600">
                Borrow Tool
            </h2>

            <button
                onclick="closeModal('borrowToolModal')"
                class="text-gray-500 hover:text-gray-800 text-2xl">
                &times;
            </button>

        </div>


        <form action="#" method="POST" class="p-6 space-y-4">

            @csrf

            <!-- Tool -->
            <div>
                <label class="block font-semibold mb-1">
                    Tool
                </label>

                <select
                    name="tool_id"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-yellow-500 outline-none"
                    required>

                    <option value="">Select tool</option>
                    <option value="1">Pipe Wrench — 8 available</option>
                    <option value="2">Angle Grinder — 2 available</option>

                </select>
            </div>


            <!-- Quantity -->
            <div>
                <label class="block font-semibold mb-1">
                    Quantity
                </label>

                <input
                    type="number"
                    name="quantity"
                    min="1"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-yellow-500 outline-none"
                    required>
            </div>


            <!-- Borrower -->
            <div>
                <label class="block font-semibold mb-1">
                    Borrowed By
                </label>

                <input
                    type="text"
                    name="borrowed_by"
                    placeholder="Name of borrower"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-yellow-500 outline-none"
                    required>
            </div>


            <!-- Purpose -->
            <div>
                <label class="block font-semibold mb-1">
                    Purpose
                </label>

                <textarea
                    name="purpose"
                    rows="3"
                    placeholder="Purpose of borrowing"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-yellow-500 outline-none"
                    required></textarea>
            </div>


            <!-- Location -->
            <div>
                <label class="block font-semibold mb-1">
                    Location
                </label>

                <input
                    type="text"
                    name="location"
                    placeholder="Where will the tool be used?"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-yellow-500 outline-none">
            </div>


            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-3">

                <button
                    type="button"
                    onclick="closeModal('borrowToolModal')"
                    class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-yellow-500 text-white
                           hover:bg-yellow-600">
                    Confirm Borrow
                </button>

            </div>

        </form>

    </div>

</div>

<!-- ========================================================= -->
<!-- RETURN TOOL MODAL -->
<!-- ========================================================= -->

<div id="returnToolModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 z-50
           flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg">

        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b">

            <h2 class="text-xl font-bold text-green-600">
                Return Tool
            </h2>

            <button
                onclick="closeModal('returnToolModal')"
                class="text-gray-500 hover:text-gray-800 text-2xl">
                &times;
            </button>

        </div>


        <form action="#" method="POST" class="p-6 space-y-4">

            @csrf


            <!-- Tool -->
            <div>
                <label class="block font-semibold mb-1">
                    Tool
                </label>

                <select
                    name="tool_id"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-green-500 outline-none"
                    required>

                    <option value="">Select borrowed tool</option>
                    <option value="1">Pipe Wrench</option>
                    <option value="2">Angle Grinder</option>

                </select>
            </div>


            <!-- Quantity -->
            <div>
                <label class="block font-semibold mb-1">
                    Quantity Returned
                </label>

                <input
                    type="number"
                    name="quantity"
                    min="1"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-green-500 outline-none"
                    required>
            </div>


            <!-- Returned By -->
            <div>
                <label class="block font-semibold mb-1">
                    Returned By
                </label>

                <input
                    type="text"
                    name="returned_by"
                    placeholder="Name of person returning"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-green-500 outline-none"
                    required>
            </div>


            <!-- Condition -->
            <div>
                <label class="block font-semibold mb-1">
                    Tool Condition
                </label>

                <select
                    name="condition"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-green-500 outline-none"
                    required>

                    <option value="Good">Good</option>
                    <option value="Needs Repair">Needs Repair</option>
                    <option value="Damaged">Damaged</option>
                    <option value="Lost">Lost</option>

                </select>
            </div>


            <!-- Remarks -->
            <div>
                <label class="block font-semibold mb-1">
                    Remarks
                </label>

                <textarea
                    name="remarks"
                    rows="3"
                    placeholder="Optional remarks"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-green-500 outline-none"></textarea>
            </div>


            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-3">

                <button
                    type="button"
                    onclick="closeModal('returnToolModal')"
                    class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-green-600 text-white
                           hover:bg-green-700">
                    Confirm Return
                </button>

            </div>

        </form>

    </div>

</div>


<!-- ========================================================= -->
<!-- MODAL JAVASCRIPT -->
<!-- ========================================================= -->

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Close modal when clicking outside
    document.querySelectorAll('[id$="Modal"]').forEach(modal => {
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });

    // Close modal with ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('[id$="Modal"]').forEach(modal => {
                modal.classList.add('hidden');
            });
        }
    });
</script>

<!--=========================================================================================================================
    STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK
    STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK
    STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK
    STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK - STOCK
========================================================================================================================== -->



           <div id="stockContent" class="tab-content">

    <div class="content-title sotck-title">
        STOCK CARD
    </div>

    <p class="text-gray-500">
        This is your Stock Card workspace.
    </p>

    <!-- STOCK CARD CONTENT -->
</div>
<!--=========================================================================================================================
  BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW
  BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW
  BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW
  BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW - BORROW
========================================================================================================================== -->

<div id="borrowContent" class="tab-content">

    <div class="content-title borrows-title">
    </div>

    <p class="text-gray-500">
    </p>

   <div class="min-h-screen bg-gray-100 p-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Tool Borrowing
            </h1>

            <p class="text-sm text-gray-500">
                Manage active and pending tool transactions
            </p>
        </div>

        <button
            type="button"
            onclick="openBorrowingTransaction()"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg shadow">
            + New Borrowing
        </button>
    </div>


    <!-- Transaction Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

        <!-- Example Transaction -->
        <div class="bg-white rounded-xl shadow-sm border p-5">

            <div class="flex justify-between items-start mb-4">

                <div>
                    <p class="text-xs text-gray-500">
                        TRANSACTION
                    </p>

                    <h3 class="font-bold text-gray-800">
                        TRX-0001
                    </h3>
                </div>

                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                    Pending
                </span>

            </div>


            <div class="mb-4">

                <p class="text-xs text-gray-500">
                    Borrower
                </p>

                <p class="font-semibold text-gray-800">
                    Juan Dela Cruz
                </p>

                <p class="text-sm text-gray-500">
                    EMP-001
                </p>

            </div>


            <div class="mb-4">

                <p class="text-xs text-gray-500">
                    Tools
                </p>

                <p class="text-sm text-gray-700">
                    3 tools
                </p>

            </div>


            <div class="flex gap-2">

                <button
                    onclick="openBorrowingTransaction()"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-sm">
                    Open
                </button>

                <button
                    class="px-3 bg-gray-100 hover:bg-gray-200 rounded-lg">
                    ⋮
                </button>

            </div>

        </div>


        <!-- Another Transaction -->
        <div class="bg-white rounded-xl shadow-sm border p-5">

            <div class="flex justify-between items-start mb-4">

                <div>
                    <p class="text-xs text-gray-500">
                        TRANSACTION
                    </p>

                    <h3 class="font-bold text-gray-800">
                        TRX-0002
                    </h3>
                </div>

                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                    In Progress
                </span>

            </div>


            <div class="mb-4">

                <p class="text-xs text-gray-500">
                    Borrower
                </p>

                <p class="font-semibold text-gray-800">
                    Pedro Santos
                </p>

                <p class="text-sm text-gray-500">
                    EMP-002
                </p>

            </div>


            <div class="mb-4">

                <p class="text-xs text-gray-500">
                    Tools
                </p>

                <p class="text-sm text-gray-700">
                    2 tools
                </p>

            </div>


            <div class="flex gap-2">

                <button
                    onclick="openBorrowingTransaction()"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-sm">
                    Open
                </button>

                <button
                    class="px-3 bg-gray-100 hover:bg-gray-200 rounded-lg">
                    ⋮
                </button>

            </div>

        </div>

    </div>

</div>

<!-- Borrowing Transaction Modal -->
<div id="borrowingTransactionModal"
     class="fixed inset-0 z-50 hidden bg-black/40">

    <div class="absolute right-6 bottom-6 w-full max-w-xl">

        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

            <!-- Header -->
            <div class="bg-blue-600 text-white px-5 py-4">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs text-blue-100">
                            NEW BORROWING
                        </p>

                        <h2 class="text-lg font-bold">
                            TRX-20260908-0001
                        </h2>
                    </div>

                    <div class="flex gap-2">

                        <button
                            onclick="minimizeBorrowingTransaction()"
                            class="w-9 h-9 rounded-lg hover:bg-blue-500">
                            −
                        </button>

                        <button
                            onclick="closeBorrowingTransaction()"
                            class="w-9 h-9 rounded-lg hover:bg-blue-500">
                            ×
                        </button>

                    </div>

                </div>

            </div>


            <!-- Body -->
            <div class="p-5 max-h-[75vh] overflow-y-auto">

                <!-- Step indicator -->
                <div class="flex items-center mb-6">

                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm">
                            1
                        </div>

                        <span class="ml-2 text-sm font-medium">
                            Borrower
                        </span>
                    </div>

                    <div class="flex-1 h-px bg-gray-300 mx-3"></div>

                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-sm">
                            2
                        </div>

                        <span class="ml-2 text-sm text-gray-500">
                            Tools
                        </span>
                    </div>

                    <div class="flex-1 h-px bg-gray-300 mx-3"></div>

                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-sm">
                            3
                        </div>

                        <span class="ml-2 text-sm text-gray-500">
                            Verify
                        </span>
                    </div>

                </div>


                <!-- Borrower -->
                <div class="mb-6">

                    <div class="flex justify-between items-center mb-3">

                        <div>
                            <h3 class="font-bold text-gray-800">
                                Borrower
                            </h3>

                            <p class="text-xs text-gray-500">
                                Person accountable for the tools
                            </p>
                        </div>

                        <button
                            type="button"
                            class="text-sm bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-lg">
                            + Add Borrower
                        </button>

                    </div>


                    <!-- Selected borrower -->
                    <div class="border rounded-xl p-3 flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                👤
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">
                                    Juan Dela Cruz
                                </p>

                                <p class="text-xs text-gray-500">
                                    EMP-001
                                </p>
                            </div>

                        </div>

                        <button class="text-gray-400 hover:text-red-500">
                            ×
                        </button>

                    </div>

                </div>


                <!-- Tools -->
                <div class="mb-6">

                    <div class="flex justify-between items-center mb-3">

                        <div>
                            <h3 class="font-bold text-gray-800">
                                Tools
                            </h3>

                            <p class="text-xs text-gray-500">
                                Select the tools being borrowed
                            </p>
                        </div>

                        <button
                            type="button"
                            class="text-sm bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-lg">
                            + Add Tool
                        </button>

                    </div>


                    <!-- Tool -->
                    <div class="border rounded-xl divide-y">

                        <div class="p-3">

                            <div class="flex items-center justify-between">

                                <div>
                                    <p class="font-semibold text-gray-800">
                                        Hammer
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Available: 5
                                    </p>
                                </div>

                                <button class="text-gray-400 hover:text-red-500">
                                    ×
                                </button>

                            </div>


                            <div class="flex items-center justify-between mt-3">

                                <div class="flex items-center gap-2">

                                    <label class="text-xs text-gray-500">
                                        Quantity
                                    </label>

                                    <input
                                        type="number"
                                        value="1"
                                        min="1"
                                        class="w-20 border rounded-lg px-2 py-1 text-sm">

                                </div>


                                <select
                                    class="border rounded-lg px-3 py-2 text-sm">

                                    <option>
                                        Juan Dela Cruz
                                    </option>

                                </select>

                            </div>

                        </div>


                        <div class="p-3">

                            <div class="flex items-center justify-between">

                                <div>
                                    <p class="font-semibold text-gray-800">
                                        Wrench
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Available: 8
                                    </p>
                                </div>

                                <button class="text-gray-400 hover:text-red-500">
                                    ×
                                </button>

                            </div>


                            <div class="flex items-center justify-between mt-3">

                                <div class="flex items-center gap-2">

                                    <label class="text-xs text-gray-500">
                                        Quantity
                                    </label>

                                    <input
                                        type="number"
                                        value="1"
                                        min="1"
                                        class="w-20 border rounded-lg px-2 py-1 text-sm">

                                </div>


                                <select
                                    class="border rounded-lg px-3 py-2 text-sm">

                                    <option>
                                        Juan Dela Cruz
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Handling Method -->
                <div class="mb-6">

                    <h3 class="font-bold text-gray-800 mb-1">
                        How will the tools be received?
                    </h3>

                    <p class="text-xs text-gray-500 mb-3">
                        Select who will physically handle the transaction.
                    </p>


                    <div class="space-y-2">

                        <label class="flex items-center gap-3 border rounded-xl p-3 cursor-pointer hover:bg-gray-50">

                            <input
                                type="radio"
                                name="handling_method"
                                value="borrower"
                                checked
                                class="text-blue-600">

                            <div>
                                <p class="font-medium text-gray-800">
                                    Borrower
                                </p>

                                <p class="text-xs text-gray-500">
                                    Borrower receives the tools personally.
                                </p>
                            </div>

                        </label>


                        <label class="flex items-center gap-3 border rounded-xl p-3 cursor-pointer hover:bg-gray-50">

                            <input
                                type="radio"
                                name="handling_method"
                                value="receiver"
                                class="text-blue-600">

                            <div>
                                <p class="font-medium text-gray-800">
                                    Authorized Receiver
                                </p>

                                <p class="text-xs text-gray-500">
                                    Another registered person receives the tools.
                                </p>
                            </div>

                        </label>


                        <label class="flex items-center gap-3 border rounded-xl p-3 cursor-pointer hover:bg-gray-50">

                            <input
                                type="radio"
                                name="handling_method"
                                value="staff_delivery"
                                class="text-blue-600">

                            <div>
                                <p class="font-medium text-gray-800">
                                    Staff Delivery
                                </p>

                                <p class="text-xs text-gray-500">
                                    Staff delivers the tools to the borrower.
                                </p>
                            </div>

                        </label>

                    </div>

                </div>

            </div>


            <!-- Footer -->
            <div class="border-t bg-gray-50 px-5 py-4">

                <div class="flex justify-between items-center">

                    <div>
                        <p class="text-xs text-gray-500">
                            Transaction Status
                        </p>

                        <p class="font-semibold text-yellow-600">
                            Draft
                        </p>
                    </div>

                    <button
                        type="button"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg">
                        Continue to Verification →
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>
</div>
<script>

function openBorrowingTransaction()
{
    document
        .getElementById('borrowingTransactionModal')
        .classList.remove('hidden');
}

function closeBorrowingTransaction()
{
    document
        .getElementById('borrowingTransactionModal')
        .classList.add('hidden');
}

function minimizeBorrowingTransaction()
{
    document
        .getElementById('borrowingTransactionModal')
        .classList.add('hidden');

    // Later:
    // Create a chat-head / minimized transaction button here.
}

</script>

</div>




        </div>

    </div>


   <!-- TAB SCRIPT -->
<script>
    function showTab(tab) {

        const tabs = {
            tools: {
                tab: 'toolsTab',
                content: 'toolsContent'
            },
            stock: {
                tab: 'stockTab',
                content: 'stockContent'
            },
            borrows: {
                tab: 'borrowTab',
                content: 'borrowContent'
            }
        };

        // Remove active from all tab buttons
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active');
        });

        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });

        // Check if the selected tab exists
        if (!tabs[tab]) {
            console.error('Tab not found:', tab);
            return;
        }

        // Get selected tab and content
        const selectedTab = document.getElementById(tabs[tab].tab);
        const selectedContent = document.getElementById(tabs[tab].content);

        // Check elements exist
        if (!selectedTab) {
            console.error('Tab button not found:', tabs[tab].tab);
            return;
        }

        if (!selectedContent) {
            console.error('Tab content not found:', tabs[tab].content);
            return;
        }

        // Activate selected tab
        selectedTab.classList.add('active');
        selectedContent.classList.add('active');
    }

    // Show Tools tab by default
    document.addEventListener('DOMContentLoaded', function () {
        showTab('tools');
    });
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

