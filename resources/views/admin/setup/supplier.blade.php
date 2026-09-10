<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Supplier</title>
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
 <h2 class="text-2xl font-bold mb-6 text-center">Supplier</h2>

        <form action="{{ route('admin.setup.supplier') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="supplier">Supplier</label>
                <input class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" id="supplier" name="supplier" required>
              </div>
              <div class="flex justify-center space-x-4">
                <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-green-300" type="submit">
                  Submit
                </button>
              </div>
            </form>

<div class="mt-8"></div>

    <!-- Search and Filter -->
 <form method="GET" action="{{ url('/admin/setup/supplier') }}" id="searchForm" class="w-full mb-6 flex flex-col md:flex-row items-center gap-2">
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
    href="{{ url('/admin/setup/supplier') }}"
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
        <th class="px-4 py-2 border-b text-left">Supplier</th>
        <th class="px-4 py-2 border-b text-left">Created at</th>
        <th class="px-4 py-2 border-b text-left">Updated at</th>
        <th class="px-4 py-2 border-b text-left">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($SupplierModel as $data)
        <tr class="bg-white odd:bg-gray-100 hover:bg-gray-200">
          <td class="hidden">{{ $data->id }}</td>
          <td class="px-4 py-2 border-b text-start">{{ $data->supplier }}</td>
          <td class="px-4 py-2 border-b">{{ $data->created_at }}</td>
          <td class="px-4 py-2 border-b">{{ $data->updated_at }}</td>
          <td class="px-4 py-2 border-b space-x-4">
            <a href="{{ route('deletesupplier', $data->id) }}"
               class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">
              Delete
            </a>
            <button
              class="btn-edit bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded"
              data-id="{{ $data->id }}"
              data-supplier="{{ $data->supplier }}">
              Edit
            </button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
    <div class="d-flex justify-content-center mt-4">
              {{ $SupplierModel->links('pagination::tailwind') }}
          </div>
</div>

        </div>

        <div id="updateSupModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
          <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Close Button -->
            <button id="closeSupModal" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900 text-2xl">&times;</button>
            <h2 class="text-2xl font-bold mb-6">Update Supplier</h2>
            <form id="updateForm" action="{{ route('updatesupplier', ['id' => '__ID__']) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <input type="hidden" name="id" id="supplier_id" value="">

                <div>
                  <label class="block text-gray-700 font-bold mb-2" for="edit_supplier">Supplier</label>
                  <input type="text" name="supplier" id="edit_supplier" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

              <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                  Update
                </button>
              </div>
            </form>
        </div>
      </div>

<script>
    // Get modal elements
    const updateSupModal = document.getElementById('updateSupModal');
    const closeSupModal = document.getElementById('closeSupModal');
    const updateForm = document.getElementById('updateForm');

    // Save the original form action
    const originalAction = updateForm.action;

    // When user clicks any "Edit" button
    document.querySelectorAll('.btn-edit').forEach(button => {

        button.addEventListener('click', function () {

            // Retrieve data attributes
            const id = this.getAttribute('data-id');
            const supplier = this.getAttribute('data-supplier');

            // Update form action with the record ID
            updateForm.action = originalAction.replace('__ID__', id);

            // Set hidden ID field
            document.getElementById('supplier_id').value = id;

            // Populate form field
            document.getElementById('edit_supplier').value = supplier;

            // Show modal
            updateSupModal.classList.remove('hidden');
        });
    });

    // Close modal when close button is clicked
    closeSupModal.addEventListener('click', function () {

        updateSupModal.classList.add('hidden');

        // Reset form action
        updateForm.action = originalAction;
    });

    // Close modal when clicking outside the modal
    window.addEventListener('click', function (e) {

        if (e.target === updateSupModal) {
            updateSupModal.classList.add('hidden');

            // Reset form action
            updateForm.action = originalAction;
        }
    });
</script>


</body>
</html>
