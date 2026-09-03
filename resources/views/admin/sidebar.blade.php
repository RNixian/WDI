  <script src="https://cdn.jsdelivr.net/npm/lucide@0.264.0/dist/lucide.min.js"></script>

<!-- Toggle Button (Mobile) -->
<button id="toggleSidebar"
    class="fixed top-4 left-4 bg-yellow-300 text-black rounded-lg p-2 w-10 h-10 flex items-center justify-center z-50 shadow-lg md:hidden">
    ☰
</button>

<!-- Sidebar -->
<div id="sidebar"
    class="fixed top-0 left-0 h-screen w-64 bg-blue-900 text-white p-6 shadow-xl overflow-auto z-40 transform md:translate-x-0 -translate-x-full md:block transition-transform duration-300">

    <!-- Logo -->
    <div class="text-center mb-6">
        <img src="{{ url('images/sidebarlogo.png') }}" alt="Logo" class="mx-auto rounded-full shadow-lg" style="height: 150px; width: 150px;">
    </div>

    <!-- Admin Info -->
    @if(Auth::guard('admin')->check())
        <div class="text-white font-semibold mb-6 text-center">
            <h2 class="text-xl font-bold flex items-center justify-center gap-2">
                <i data-lucide="settings"></i> Admin: {{ Auth::guard('admin')->user()->firstname }}
            </h2>
        </div>
    @endif

    <!-- Navigation Links -->
    <ul class="space-y-2">
        <li>
            <a href="{{ url('/admin/admindashboard') }}"
               class="flex items-center gap-3 py-2 px-4 rounded hover:bg-yellow-200 hover:text-black transition">
               <i data-lucide="layout-dashboard"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="{{ url('/admin/inventory') }}"
               class="flex items-center gap-3 py-2 px-4 rounded hover:bg-yellow-200 hover:text-black transition">
               <i data-lucide="graduation-cap"></i> Inventory
            </a>
        </li>


        <li>
            <a href="{{ url('/admin/distribution') }}"
               class="flex items-center gap-3 py-2 px-4 rounded hover:bg-yellow-200 hover:text-black transition">
               <i data-lucide="users"></i> Distribution
            </a>
        </li>

        <li>
            <a href="{{ url('/admin/allocation') }}"
               class="flex items-center gap-3 py-2 px-4 rounded hover:bg-yellow-200 hover:text-black transition">
               <i data-lucide="users"></i> Allocation
            </a>
        </li>

        <!-- SetUp Dropdown -->
        <li class="relative">
            <button id="setupDropdownBtn"
                class="flex items-center gap-3 w-full text-left py-2 px-4 rounded hover:bg-yellow-200 hover:text-black transition focus:outline-none">
                <i data-lucide="sliders-horizontal"></i> SetUp
            </button>
            <ul id="setupDropdown"
                class="absolute left-0 mt-1 w-full bg-white shadow-md rounded hidden z-10 text-black">
                <li><a href="{{ url('/admin/setup/tool_class') }}" class="block py-2 px-4 hover:bg-blue-200">Classification</a></li>
                <li><a href="{{ url('/admin/setup/tool_cat') }}" class="block py-2 px-4 hover:bg-blue-200">Category</a></li>
                <li><a href="{{ url('/admin/setup/supplier') }}" class="block py-2 px-4 hover:bg-blue-200">Supplier</a></li>
            </ul>
        </li>

        <!-- Accounts Dropdown -->
        <li class="relative">
            <button id="accountsDropdownBtn"
                class="flex items-center gap-3 w-full text-left py-2 px-4 rounded hover:bg-yellow-200 hover:text-black transition focus:outline-none">
                <i data-lucide="user-cog"></i> Accounts
            </button>
            <ul id="accountsDropdown"
                class="absolute left-0 mt-1 w-full bg-white shadow-md rounded hidden z-10 text-black">
                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'superadmin')
                    <li>
                        <a href="{{ url('/admin/account/adminaccount') }}" class="block py-2 px-4 hover:bg-blue-200">
                            Account List
                        </a>
                    </li>
                    <li>
            <a href="{{ url('/admin/register') }}"
               class="flex items-center gap-3 py-2 px-4 rounded hover:bg-yellow-200 hover:text-black transition">
            Register
            </a>
        </li>
                @endif
            </ul>
        </li>
    </ul>

    <!-- Footer: Logout -->
    <div class="mt-20 pt-4 border-t border-gray-300 text-center">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                    class="flex items-center gap-2 justify-center hover:bg-red-600 text-white font-bold py-2 px-6 rounded transition">
                <i data-lucide="log-out"></i> Log Out
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile Sidebar Toggle
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        toggleBtn?.addEventListener('click', () => sidebar.classList.toggle('-translate-x-full'));

        // Dropdown Toggle
        const dropdownBtn = document.getElementById('setupDropdownBtn');
        const dropdown = document.getElementById('setupDropdown');
        const accdropdownBtn = document.getElementById('accountsDropdownBtn');
        const accdropdown = document.getElementById('accountsDropdown');

        dropdownBtn?.addEventListener('click', e => {
            e.stopPropagation();
            dropdown?.classList.toggle('hidden');
            accdropdown?.classList.add('hidden');
        });

        accdropdownBtn?.addEventListener('click', e => {
            e.stopPropagation();
            accdropdown?.classList.toggle('hidden');
            dropdown?.classList.add('hidden');
        });

        // Close sidebar on outside click (mobile)
        document.addEventListener('click', e => {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Lucide icons
      lucide.createIcons();
    });
</script>
