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
        .fittings-tab.active {
            background: #dc3545;
            color: white;
        }

        .fittings-tab:hover {
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

        .fittings-title {
            color: #dc3545;
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

        <!-- TABS -->
        <div class="tabs">

            <button
                id="toolsTab"
                class="tab-button tools-tab active"
                onclick="showTab('tools')">
                🔧 Tools
            </button>

            <button
                id="fittingsTab"
                class="tab-button fittings-tab"
                onclick="showTab('fittings')">
                🔩 STOCK CARD
            </button>

        </div>


        <!-- WORK AREA -->
        <div class="work-area">

            <!-- TOOLS CONTENT -->
            <div id="toolsContent" class="tab-content active">

<!-- TOOLS CONTENT -->
<div id="toolsContent" class="tab-content active">

    <!-- Header -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">

        <div>
            <div class="content-title tools-title">
                Tools
            </div>

            <p class="text-gray-500">
                Manage, borrow, and return tools.
            </p>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="flex flex-wrap gap-3">

            <!-- ADD TOOL -->
            <button
                onclick="openModal('addToolModal')"
                class="px-5 py-3 rounded-lg bg-blue-600 text-white font-semibold
                       hover:bg-blue-700 transition shadow">
                + Add Tool
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
        <th class="hidden">Id</th>
        <th class="px-2 py-1 border-b text-left">Tool Description</th>
        <th class="px-4 py-2 border-b text-left">Classification</th>
        <th class="px-4 py-2 border-b text-left">Category</th>
        <th class="px-4 py-2 border-b text-left">Size</th>
        <th class="px-4 py-2 border-b text-left">Quantity</th>
        <th class="px-4 py-2 border-b text-left">Date Aquired</th>
        <th class="px-4 py-2 border-b text-left">Brand</th>
        <th class="px-4 py-2 border-b text-left">Status</th>
        <th class="px-4 py-2 border-b text-left">Reference#</th>
        <th class="px-4 py-2 border-b text-left">Unit price</th>
        <th class="px-4 py-2 border-b text-left">Serial Tag</th>
        <th class="hidden">Created at</th>
        <th class="hidden">Updated at</th>
        <th class="px-4 py-2 border-b text-left">Actions</th>
      </tr>
    </thead>
    <tbody>
@foreach($tools as $data)
<tr class="bg-white odd:bg-gray-100 hover:bg-gray-200">

    <td class="hidden">
        {{ $data->id }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->tools_description }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->tool_class?->tool_class ?? 'N/A' }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->tool_category?->tool_category ?? 'N/A' }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->size ?? 'N/A' }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->qty }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->purchased_at }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->brand ?? 'N/A' }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->status }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->invoice_reference ?? 'N/A' }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->unit_price }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->serial_tag ?? 'N/A' }}
    </td>

    <td class="hidden">
        {{ $data->created_at }}
    </td>

    <td class="hidden">
        {{ $data->updated_at }}
    </td>

    <td class="px-4 py-2 border-b space-x-4">

        <a
            href="{{ route('deletetools', $data->id) }}"
            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded"
        >
            Delete
        </a>

        <button
            type="button"
            class="btn-edit bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded"
            data-id="{{ $data->id }}"
            data-tools_description="{{ $data->tools_description }}"
            data-tool_class_id="{{ $data->tool_class_id }}"
            data-tool_cat_id="{{ $data->tool_cat_id }}"
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


    // Close modal when clicking outside the modal
    document.querySelectorAll('[id$="Modal"]').forEach(modal => {

        modal.addEventListener('click', function(event) {

            if (event.target === modal) {
                modal.classList.add('hidden');
            }

        });

    });


    // Close modal with ESC key
    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            document.querySelectorAll('[id$="Modal"]').forEach(modal => {
                modal.classList.add('hidden');
            });

        }

    });

</script>

            </div>


            <!-- FITTINGS CONTENT -->
            <div id="fittingsContent" class="tab-content">

                <div class="content-title fittings-title">
                    STOCK CARD
                </div>

                <p class="text-gray-500">
                    This is your Stock Card workspace.
                </p>

                <!-- PUT YOUR FITTINGS CONTENT HERE -->

            </div>

        </div>

    </div>


    <!-- TAB SCRIPT -->
    <script>

        function showTab(tab) {

            const toolsTab = document.getElementById('toolsTab');
            const fittingsTab = document.getElementById('fittingsTab');

            const toolsContent = document.getElementById('toolsContent');
            const fittingsContent = document.getElementById('fittingsContent');


            if (tab === 'tools') {

                // Activate Tools
                toolsTab.classList.add('active');
                fittingsTab.classList.remove('active');

                toolsContent.classList.add('active');
                fittingsContent.classList.remove('active');

            }

            else if (tab === 'fittings') {

                // Activate Stock Card
                fittingsTab.classList.add('active');
                toolsTab.classList.remove('active');

                fittingsContent.classList.add('active');
                toolsContent.classList.remove('active');

            }

        }

    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

