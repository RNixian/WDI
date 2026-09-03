<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Category</title>
<link rel="stylesheet" href="{{ url('css/tailwind.min.css') }}">
<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  @if($errors->any())
  <ul>
  @foreach ($errors->all() as $error)
      <li>
  {{$error}}
      </li>
  @endforeach
  </ul>
  @endif


  <div class="flex min-h-screen bg-gray-100 w-full">
    @include('admin.sidebar')

 <div id="mainContent" class="md:ml-64 flex flex-col lg:flex-row items-start justify-center gap-8 w-full p-6">

   <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6 w-full max-w-6xl mx-auto">

           <h2 class="text-2xl font-bold mb-6 text-center">Category</h2>

<form action="{{ route('admin.setup.storecategory') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div class="flex flex-col lg:flex-row gap-4">
        <!-- Category Dropdown -->
        <div class="w-full lg:w-1/2">
            <label class="block text-gray-700 font-bold mb-2" for="tool_class_id">
    Classification
</label>

<select
    name="tool_class_id"
    id="tool_class_id"
    class="w-full border border-gray-300 rounded px-3 py-2"
    required
>
    <option value="">-- Select Classification --</option>

    @foreach ($classification as $class)
        <option
            value="{{ $class->id }}"
            {{ old('tool_class_id') == $class->id ? 'selected' : '' }}
        >
            {{ $class->tool_class }}
        </option>
    @endforeach
</select>
            </select>
        </div>

        <!-- Under Output Category Input -->
        <div class="w-full lg:w-1/2">
            <label class="block text-gray-700 font-bold mb-2" for="tool_category">Category</label>
            <input type="text" id="tool_category" name="tool_category" value="{{ old('tool_category') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-center">
        <button type="submit"
            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-green-300">
            Submit
        </button>
    </div>
</form>

<div class="mt-8"></div>

  <!-- Search and Filter -->
 <form method="GET" action="{{ url('/admin/setup/tool_cat') }}" id="searchForm" class="w-full mb-6 flex flex-col md:flex-row items-center gap-2">
  <input
    type="text"
    name="search"
    value="{{ request('search') }}"
    placeholder="Enter..."
    class="w-full shadow appearance-none border rounded py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
  />

  <button
    type="submit"
    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
  >
    Search
  </button>

  <a
    href="{{ url('/admin/setup/tool_cat') }}"
    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-center"
  >
    Clear
  </a>
</form>

          <div class="overflow-x-auto">
  <table class="min-w-full table-auto border-collapse">
    <thead>
      <tr class="bg-blue-900 text-white">
        <th class="hidden">Id</th>
        <th class="px-4 py-2 border-b text-left">Classification</th>
        <th class="px-4 py-2 border-b text-left">Category</th>
        <th class="hidden">Created at</th>
        <th class="hidden">Updated at</th>
        <th class="px-4 py-2 border-b text-left">Actions</th>
      </tr>
    </thead>
    <tbody>
@foreach($ToolCategoriesModel as $data)

<tr class="bg-white odd:bg-gray-100 hover:bg-gray-200">

    <td class="hidden">
        {{ $data->id }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->toolsclassification?->tool_class ?? 'N/A' }}
    </td>

    <td class="px-4 py-2 border-b text-start">
        {{ $data->tool_category }}
    </td>

    <td class="hidden">
        {{ $data->created_at }}
    </td>

    <td class="hidden">
        {{ $data->updated_at }}
    </td>

    <td class="px-4 py-2 border-b space-x-4">

        <a
            href="{{ route('deletecategory', $data->id) }}"
            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded"
        >
            Delete
        </a>

        <button
            type="button"
            class="btn-edit bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded"
            data-id="{{ $data->id }}"
            data-tool_class_id="{{ $data->tool_class_id }}"
            data-tool_category="{{ $data->tool_category }}"
        >
            Edit
        </button>

    </td>

</tr>

@endforeach
</tbody>
  </table>
  <div class="mt-4">
    {{ $ToolCategoriesModel->links('pagination::tailwind') }}
</div>
</div>

        </div>

<div
    id="updateModal"
    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50"
>
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">

        <!-- Close Button -->
        <button
            type="button"
            id="closeModal"
            class="absolute top-2 right-2 text-gray-700 hover:text-gray-900 text-2xl"
        >
            &times;
        </button>

        <h2 class="text-2xl font-bold mb-6">
            Update Tool Category
        </h2>

        <form
            id="updateForm"
            method="POST"
        >
            @csrf
            @method('PUT')

            <input
                type="hidden"
                name="id"
                id="record_id"
            >

            <!-- Classification -->
            <div class="mb-4">

                <label
                    class="block text-gray-700 font-bold mb-2"
                    for="select_tool_class_id"
                >
                    Classification
                </label>

                <select
                    name="tool_class_id"
                    id="select_tool_class_id"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    required
                >
                    <option value="">
                        -- Select Classification --
                    </option>

                    @foreach ($classification as $class)
                        <option value="{{ $class->id }}">
                            {{ $class->tool_class }}
                        </option>
                    @endforeach

                </select>

            </div>

            <!-- Tool Category -->
            <div class="mb-4">

                <label
                    class="block text-gray-700 font-bold mb-2"
                    for="edit_tool_category"
                >
                    Tool Category
                </label>

                <input
                    type="text"
                    name="tool_category"
                    id="edit_tool_category"
                    class="w-full border rounded px-3 py-2"
                    required
                >

            </div>

            <div class="flex justify-end mt-4">

                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                >
                    Update
                </button>

            </div>

        </form>

    </div>
</div>
        </div>
      </div>
          <script>
            const updateModal = document.getElementById('updateModal');
            const closeModal = document.getElementById('closeModal');
            const updateForm = document.getElementById('updateForm');

            document.querySelectorAll('.btn-edit').forEach(button => {
              button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const tool_class_id = this.getAttribute('data-tool_class_id');
                const tool_category = this.getAttribute('data-tool_category');

                // Set the form action with the correct ID
                updateForm.action = `{{ route('updatecategory', ['id' => '__ID__']) }}`.replace('__ID__', id);

                // Fill the form fields
                document.getElementById('record_id').value = id;
                document.getElementById('select_tool_class_id').value = tool_class_id;
                document.getElementById('edit_tool_category').value = tool_category;

                updateModal.classList.remove('hidden');
              });
            });

            closeModal.addEventListener('click', function () {
              updateModal.classList.add('hidden');
              updateForm.reset();
            });
          </script>


</body>
</html>
