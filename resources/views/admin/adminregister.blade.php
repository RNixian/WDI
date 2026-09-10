<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Registration</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
body {
    min-height: 100vh;
    margin: 0;
    background:
        linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
        url("{{ url('images/logo.png') }}") no-repeat center center;
    background-size: contain;
    background-attachment: fixed;
}

</style>


<body class="min-h-screen flex items-center justify-center px-4">

  @php
      $adminCount = \App\Models\adminmodel::count();
  @endphp

  <div class="w-full max-w-md px-4">

    {{-- Validation Errors --}}
    @if($errors->any())
      <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    <div class="shadow-lg rounded-lg overflow-hidden">
      <!-- Header -->
      <div class="bg-blue-600 text-white text-center py-4">
        <h2 class="text-2xl font-bold">Admin Register</h2>
      </div>

      <!-- Body -->
      <div class="bg-white px-8 pt-6 pb-8">

        <form action="{{ route('admin.storenewadmin') }}" method="POST">
          @csrf

          <div class="mb-4">
            <label for="firstname" class="block text-gray-700 font-bold mb-2">First Name</label>
            <input id="firstname" name="firstname" type="text" required
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>

          <div class="mb-4">
            <label for="middlename" class="block text-gray-700 font-bold mb-2">Middle Name</label>
            <input id="middlename" name="middlename" type="text"
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>

          <div class="mb-4">
            <label for="lastname" class="block text-gray-700 font-bold mb-2">Last Name</label>
            <input id="lastname" name="lastname" type="text" required
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>

          <div class="mb-4">
            <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
            <p class="text-sm text-gray-500 mb-2">
    Minimum of 8 and maximum of 20 characters and include at least a number.
</p>
            <input id="username" name="username" type="text" required
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>

          <div class="mb-6">
            <label for="masterkey" class="block text-gray-700 font-bold mb-1">
    Master Key
</label>
<p class="text-sm text-gray-500 mb-2">
    Must be at least 8 characters and include uppercase & lowercase letters,
    a number, and a special character.
</p>
            <input id="masterkey" name="masterkey" type="text" required
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>

          <div class="flex justify-center">
            <button type="submit"
                    class="bg-green-600 hover:bg-green-900 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
              Register
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>

</body>
</html>
