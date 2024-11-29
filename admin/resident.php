<?php 
include "components/header.php";
?>

<div class="flex justify-between items-center bg-white p-4 mb-6 rounded-md shadow-md">
    <h2 class="text-lg font-semibold text-gray-700">Customer</h2>
    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-lg font-bold text-white">
        <?php
        echo substr(ucfirst($_SESSION['user_type']), 0, 1);
        ?>
    </div>
</div>

<!-- Card for Table -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <h3 class="text-xl font-semibold text-gray-700 mb-4">Resident List</h3>
   
    <!-- Search Input -->
    <div class="mb-4 flex items-center space-x-4">
        <button id="adduserButton" class="bg-blue-500 text-white py-1 px-3 text-xs rounded-sm flex items-center hover:bg-blue-600 transition duration-300">
            <span class="material-icons mr-1 text-sm">person_add</span>
            Add Resident
        </button>

        <input type="text" id="searchInput" class="p-2 border rounded-sm text-xs" placeholder="Search resident...">
    </div>



    <!-- Table Wrapper for Responsiveness -->
    <div class="overflow-x-auto">
        <table id="userTable" class="display table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-2">ID</th>
                    <th class="p-2">Profile</th>
                    <th class="p-2">Fullname</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Address</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php include "backend/end-points/resident_list.php"; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "components/footer.php";?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Search functionality
        $('#searchInput').on('input', function() {
            var value = $(this).val().toLowerCase();
            $('#userTable tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>