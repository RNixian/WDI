<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile</title>
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
 <h2 class="text-2xl font-bold mb-6 text-center">Profile</h2>

        <form action="{{ route('admin.setup.borrower_profile') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
<div class="grid grid-cols-1 md:grid-cols-5 gap-1">

    <!-- First Name -->
    <div>
        <label
            class="block text-gray-700 font-bold mb-2"
            for="firstname">
            First Name
        </label>

        <input
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            type="text"
            id="firstname"
            name="firstname"
            required>
    </div>

    <!-- Last Name -->
    <div>
        <label
            class="block text-gray-700 font-bold mb-2"
            for="lastname">
            Last Name
        </label>

        <input
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            type="text"
            id="lastname"
            name="lastname"
            required>
    </div>

    <!-- Unique ID -->
    <div>
        <label
            class="block text-gray-700 font-bold mb-2"
            for="emp_id">
            Unique ID
        </label>

        <input
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            type="text"
            id="emp_id"
            name="emp_id"
            required>
    </div>

    <!-- Contact Number -->
    <div>
        <label
            class="block text-gray-700 font-bold mb-2"
            for="contact_no">
            Contact No.#
        </label>

        <input
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            type="text"
            id="contact_no"
            name="contact_no"
            maxlength="11"
            required>
    </div>

    <div class="flex justify-center space-x-4 mt-6">
    <button
        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-green-300"
        type="submit">
        Submit
    </button>
</div>

</div>


            </form>

<div class="mt-8"></div>

    <!-- Search and Filter -->
 <form method="GET" action="{{ url('/admin/setup/profile') }}" id="searchForm" class="w-full mb-6 flex flex-col md:flex-row items-center gap-2">
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
    href="{{ url('/admin/setup/profile') }}"
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
        <th class="px-4 py-2 border-b text-left">Full Name</th>
        <th class="px-4 py-2 border-b text-left">Id</th>
        <th class="px-4 py-2 border-b text-left">Contact</th>
        <th class="px-4 py-2 border-b text-left">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($BorrowersModel as $data)
        <tr class="bg-white odd:bg-gray-100 hover:bg-gray-200">
          <td class="hidden">{{ $data->id }}</td>
          <td class="px-4 py-2 border-b text-start">{{ $data->firstname }} {{ $data->lastname }}</td>
          <td class="px-4 py-2 border-b">{{ $data->emp_id }}</td>
          <td class="px-4 py-2 border-b">{{ $data->contact_no }}</td>
          <td class="px-4 py-2 border-b space-x-4">
            <a href="{{ route('deleteclass', $data->id) }}"
               class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">
              Delete
            </a>
                <button
                    type="button"
                    class="btn-edit bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded"
                    data-id="{{ $data->id }}"
                    data-firstname="{{ $data->firstname }}"
                    data-lastname="{{ $data->lastname }}"
                    data-emp_id="{{ $data->emp_id }}"
                    data-contact_no="{{ $data->contact_no }}">
                    Edit
                </button>
               <button
                    type="button"
                    onclick="openBiometricModal(
                        {{ $data->id }},
                        '{{ $data->firstname }} {{ $data->lastname }}',
                        '{{ $data->emp_id }}'
                    )"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded">
                    Biometric
                </button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
    <div class="d-flex justify-content-center mt-4">
              {{ $BorrowersModel->links('pagination::tailwind') }}
          </div>
</div>

        </div>

 <div id="updateBorrowerModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">

        <!-- Close Button -->
        <button
            id="closeBorrowerModal"
            type="button"
            class="absolute top-2 right-2 text-gray-700 hover:text-gray-900 text-2xl">
            &times;
        </button>

        <h2 class="text-2xl font-bold mb-6">Update Borrower</h2>

        <form
            id="updateBorrowerForm"
            action="{{ route('admin.setup.updateborrower', ['id' => '__ID__']) }}"
            method="POST">

            @csrf
            @method('PUT')

            <input type="hidden" name="id" id="borrower_id">

            <!-- First Name -->
            <div class="mb-4">
                <label
                    class="block text-gray-700 font-bold mb-2"
                    for="edit_firstname">
                    First Name
                </label>

                <input
                    type="text"
                    name="firstname"
                    id="edit_firstname"
                    class="w-full border rounded px-3 py-2"
                    required>
            </div>

            <!-- Last Name -->
            <div class="mb-4">
                <label
                    class="block text-gray-700 font-bold mb-2"
                    for="edit_lastname">
                    Last Name
                </label>

                <input
                    type="text"
                    name="lastname"
                    id="edit_lastname"
                    class="w-full border rounded px-3 py-2"
                    required>
            </div>

            <!-- Employee ID -->
            <div class="mb-4">
                <label
                    class="block text-gray-700 font-bold mb-2"
                    for="edit_emp_id">
                    Employee ID
                </label>

                <input
                    type="text"
                    name="emp_id"
                    id="edit_emp_id"
                    class="w-full border rounded px-3 py-2"
                    required>
            </div>

            <!-- Contact Number -->
            <div class="mb-4">
                <label
                    class="block text-gray-700 font-bold mb-2"
                    for="edit_contact_no">
                    Contact Number
                </label>

                <input
                    type="text"
                    name="contact_no"
                    id="edit_contact_no"
                    class="w-full border rounded px-3 py-2"
                    maxlength="11"
                    required>
            </div>

            <div class="flex justify-end mt-4">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Update
                </button>
            </div>

        </form>

    </div>
</div>

<!-- Biometric Modal -->
<div id="biometricModal"
     class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">

    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    Fingerprint Registration
                </h2>

                <p class="text-sm text-gray-500">
                    Register and manage borrower fingerprints
                </p>
            </div>

            <button
                type="button"
                onclick="closeBiometricModal()"
                class="text-gray-500 hover:text-gray-800 text-2xl">
                &times;
            </button>
        </div>


        <!-- Body -->
        <div class="p-6">

            <!-- Borrower Information -->
            <div class="bg-gray-50 border rounded-lg p-4 mb-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-500">
                            Borrower
                        </label>

                        <p id="bioBorrowerName"
                           class="text-lg font-semibold text-gray-800">
                            -
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">
                            Employee ID
                        </label>

                        <p id="bioEmployeeId"
                           class="text-lg font-semibold text-gray-800">
                            -
                        </p>
                    </div>

                </div>

            </div>


            <!-- Registered Fingerprints -->
            <div class="mb-6">

                <div class="flex justify-between items-center mb-3">

                    <h3 class="text-lg font-semibold text-gray-800">
                        Registered Fingerprints
                    </h3>

                    <span id="biometricCount"
                          class="text-sm bg-gray-100 px-3 py-1 rounded-full text-gray-600">
                        0 registered
                    </span>

                </div>


                <!-- Fingerprint List -->
                <div id="biometricList"
                     class="space-y-3">

                    <!-- Example empty state -->
                    <div id="noBiometricMessage"
                         class="text-center py-8 border-2 border-dashed rounded-lg text-gray-500">

                        <p class="font-medium">
                            No fingerprints registered
                        </p>

                        <p class="text-sm mt-1">
                            Register a fingerprint to enable biometric verification.
                        </p>

                    </div>

                </div>

            </div>


            <!-- Register New Fingerprint -->
            <div class="border-t pt-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    Register New Fingerprint
                </h3>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Finger -->
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Finger
                        </label>

                        <select
                            id="fingerName"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500">

                            <option value="">Select finger</option>

                            <option value="Left Thumb">
                                Left Thumb
                            </option>

                            <option value="Left Index">
                                Left Index
                            </option>

                            <option value="Left Middle">
                                Left Middle
                            </option>

                            <option value="Left Ring">
                                Left Ring
                            </option>

                            <option value="Left Little">
                                Left Little
                            </option>

                            <option value="Right Thumb">
                                Right Thumb
                            </option>

                            <option value="Right Index">
                                Right Index
                            </option>

                            <option value="Right Middle">
                                Right Middle
                            </option>

                            <option value="Right Ring">
                                Right Ring
                            </option>

                            <option value="Right Little">
                                Right Little
                            </option>

                        </select>

                    </div>


                    <!-- Sensor -->
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Sensor
                        </label>

                        <select
                            id="sensorId"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500">

                            <option value="AS608-01">
                                AS608-01
                            </option>

                        </select>

                    </div>

                </div>


                <!-- Slot -->
                <div class="mt-4">

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Fingerprint Slot
                    </label>

                    <input
                        type="number"
                        id="fingerprintSlot"
                        min="0"
                        placeholder="Example: 1"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500">

                    <p class="text-xs text-gray-500 mt-1">
                        This will be the fingerprint slot used by the AS608.
                    </p>

                </div>


                <!-- Simulation Notice -->
                <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4">

                    <div class="flex gap-3">

                        <div class="text-yellow-600 text-xl">
                            ⚠
                        </div>

                        <div>

                            <p class="font-semibold text-yellow-800">
                                Simulation Mode
                            </p>

                            <p class="text-sm text-yellow-700 mt-1">
                                The AS608 sensor is not connected yet.
                                You can simulate fingerprint enrollment while developing the system.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Footer -->
        <div class="flex justify-end gap-3 px-6 py-4 border-t bg-gray-50">

            <button
                type="button"
                onclick="closeBiometricModal()"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg">
                Close
            </button>

            <button
                type="button"
                onclick="simulateFingerprintEnrollment()"
                class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg">
                Register Fingerprint
            </button>

        </div>

    </div>
</div>

<script>

let selectedBorrowerId = null;


// Open modal
function openBiometricModal(borrowerId, borrowerName, employeeId)
{
    selectedBorrowerId = borrowerId;

    document.getElementById('bioBorrowerName').textContent = borrowerName;
    document.getElementById('bioEmployeeId').textContent = employeeId;

    document.getElementById('biometricModal').classList.remove('hidden');

    // Later:
    // loadBiometrics(borrowerId);
}


// Close modal
function closeBiometricModal()
{
    document.getElementById('biometricModal').classList.add('hidden');

    selectedBorrowerId = null;

    document.getElementById('fingerName').value = '';
    document.getElementById('fingerprintSlot').value = '';
}


// Simulation
function simulateFingerprintEnrollment()
{
    if (!selectedBorrowerId) {
        alert('No borrower selected.');
        return;
    }

    const fingerName =
        document.getElementById('fingerName').value;

    const sensorId =
        document.getElementById('sensorId').value;

    const slot =
        document.getElementById('fingerprintSlot').value;


    if (!fingerName) {
        alert('Please select a finger.');
        return;
    }

    if (!slot) {
        alert('Please enter a fingerprint slot.');
        return;
    }


    // Temporary simulation
    alert(
        'Fingerprint enrollment simulated successfully!\n\n' +
        'Borrower ID: ' + selectedBorrowerId + '\n' +
        'Finger: ' + fingerName + '\n' +
        'Sensor: ' + sensorId + '\n' +
        'Slot: ' + slot
    );


    // Later this will send the data to Laravel.
}


// Close when clicking outside
document.getElementById('biometricModal').addEventListener('click', function(event)
{
    if (event.target === this) {
        closeBiometricModal();
    }
});

</script>



<script>

    const updateBorrowerModal = document.getElementById('updateBorrowerModal');
    const closeBorrowerModal = document.getElementById('closeBorrowerModal');
    const updateBorrowerForm = document.getElementById('updateBorrowerForm');
    // Save original form action
    const originalAction = updateBorrowerForm.action;
    // Edit button
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const firstname = this.getAttribute('data-firstname');
            const lastname = this.getAttribute('data-lastname');
            const emp_id = this.getAttribute('data-emp_id');
            const contact_no = this.getAttribute('data-contact_no');
            // Update form action
            updateBorrowerForm.action =
                originalAction.replace('__ID__', id);
            // Set hidden ID
            document.getElementById('borrower_id').value = id;
            // Populate fields
            document.getElementById('edit_firstname').value = firstname;
            document.getElementById('edit_lastname').value = lastname;
            document.getElementById('edit_emp_id').value = emp_id;
            document.getElementById('edit_contact_no').value = contact_no;
            // Show modal
            updateBorrowerModal.classList.remove('hidden');
        });
    });
    // Close button
    closeBorrowerModal.addEventListener('click', function () {
        updateBorrowerModal.classList.add('hidden');
        updateBorrowerForm.action = originalAction;
    });
    // Click outside modal
    window.addEventListener('click', function (e) {
        if (e.target === updateBorrowerModal) {
            updateBorrowerModal.classList.add('hidden');
            updateBorrowerForm.action = originalAction;
        }

    });

</script>

</body>
</html>
