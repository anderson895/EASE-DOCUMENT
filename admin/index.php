<?php include "components/header.php"; ?>

<div class="min-h-screen bg-gray-100 flex flex-col">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

        <!-- Card Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 mb-8">
            <!-- Barangay ID Card -->
            <div id="barangayIDCard" class="bg-white shadow-lg rounded-lg p-4 sm:p-6 flex flex-col justify-between">
                <h2 class="text-lg sm:text-xl font-bold text-gray-700">Total Requests: Barangay ID</h2>
                <p id="barangayIDCount" class="text-3xl sm:text-4xl font-extrabold text-blue-500 mt-4">0</p>
            </div>

            <!-- Barangay Clearance Card -->
            <div id="barangayClearanceCard" class="bg-white shadow-lg rounded-lg p-4 sm:p-6 flex flex-col justify-between">
                <h2 class="text-lg sm:text-xl font-bold text-gray-700">Total Requests: Barangay Clearance</h2>
                <p id="barangayClearanceCount" class="text-3xl sm:text-4xl font-extrabold text-green-500 mt-4">0</p>
            </div>

            <!-- Residency Card -->
            <div id="residencyCard" class="bg-white shadow-lg rounded-lg p-4 sm:p-6 flex flex-col justify-between">
                <h2 class="text-lg sm:text-xl font-bold text-gray-700">Total Requests: Residency</h2>
                <p id="residencyCount" class="text-3xl sm:text-4xl font-extrabold text-red-500 mt-4">0</p>
            </div>

            <!-- Indigency Card -->
            <div id="indigencyCard" class="bg-white shadow-lg rounded-lg p-4 sm:p-6 flex flex-col justify-between">
                <h2 class="text-lg sm:text-xl font-bold text-gray-700">Total Requests: Indigency</h2>
                <p id="indigencyCount" class="text-3xl sm:text-4xl font-extrabold text-yellow-500 mt-4">0</p>
            </div>
        </div>

        <!-- Graphs Section -->
        <div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 mb-8">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4">Graphs</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <!-- Bar Chart -->
                <div id="barChart" class="w-full h-64"></div>

                <!-- Pie Chart -->
                <div id="pieChart" class="w-full h-64"></div>
            </div>
        </div>
    </div>
</div>

<?php include "components/footer.php"; ?>

<!-- Include ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    // Fetch data from the server
    $.ajax({
        url: 'backend/end-points/barangay_Statistics.php', // API endpoint
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            // Update the counts in the dashboard
            $('#barangayIDCount').text(response['Barangay ID'] || 0);
            $('#barangayClearanceCount').text(response['Barangay Clearance'] || 0);
            $('#residencyCount').text(response['Barangay Residency'] || 0);
            $('#indigencyCount').text(response['Barangay Indigency'] || 0);

            // Update the charts
            const chartData = [
                response['Barangay ID'] || 0,
                response['Barangay Clearance'] || 0,
                response['Barangay Residency'] || 0,
                response['Barangay Indigency'] || 0
            ];

            barChart.updateSeries([{ name: 'Requests', data: chartData }]);
            pieChart.updateSeries(chartData);
        },
        error: function (xhr, status, error) {
            console.error('Error fetching data:', xhr.responseText || error);
        }
    });

    // Initialize Bar Chart
    const barChartOptions = {
        chart: { type: 'bar', height: '100%' },
        series: [{ name: 'Requests', data: [0, 0, 0, 0] }],
        xaxis: { categories: ['Barangay ID', 'Clearance', 'Residency', 'Indigency'] },
        title: { text: 'Requests Breakdown', align: 'center' }
    };
    const barChart = new ApexCharts(document.querySelector("#barChart"), barChartOptions);
    barChart.render();

    // Initialize Pie Chart
    const pieChartOptions = {
        chart: { type: 'pie', height: '100%' },
        series: [0, 0, 0, 0],
        labels: ['Barangay ID', 'Clearance', 'Residency', 'Indigency'],
        title: { text: 'Request Distribution', align: 'center' }
    };
    const pieChart = new ApexCharts(document.querySelector("#pieChart"), pieChartOptions);
    pieChart.render();
});
</script>
