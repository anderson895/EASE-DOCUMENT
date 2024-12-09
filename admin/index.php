<?php include "components/header.php"; ?>

<div class="min-h-screen bg-gray-100 flex flex-col">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

        <!-- Card Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
            <!-- Barangay ID Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Total Request Of Barangay ID</h2>
                <p class="text-4xl font-extrabold text-blue-500 mt-4">120</p>
            </div>

            <!-- Barangay Clearance Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Total Request Of Barangay Clearance</h2>
                <p class="text-4xl font-extrabold text-green-500 mt-4">85</p>
            </div>

            <!-- Residency Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Total Request Of Residency</h2>
                <p class="text-4xl font-extrabold text-red-500 mt-4">60</p>
            </div>

            <!-- Indigency Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Total Request Of Indigency</h2>
                <p class="text-4xl font-extrabold text-yellow-500 mt-4">45</p>
            </div>
        </div>

        <!-- Graphs Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Graphs</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
<script>
    // Bar Chart
    var barChartOptions = {
        chart: {
            type: 'bar',
            height: '100%'
        },
        series: [{
            name: 'Requests',
            data: [120, 85, 60, 45]
        }],
        xaxis: {
            categories: ['Barangay ID', 'Clearance', 'Residency', 'Indigency']
        },
        title: {
            text: 'Requests Breakdown',
            align: 'center'
        }
    };

    var barChart = new ApexCharts(document.querySelector("#barChart"), barChartOptions);
    barChart.render();

    // Pie Chart
    var pieChartOptions = {
        chart: {
            type: 'pie',
            height: '100%'
        },
        series: [120, 85, 60, 45],
        labels: ['Barangay ID', 'Clearance', 'Residency', 'Indigency'],
        title: {
            text: 'Request Distribution',
            align: 'center'
        }
    };

    var pieChart = new ApexCharts(document.querySelector("#pieChart"), pieChartOptions);
    pieChart.render();
</script>


<?php include "components/footer.php"; ?>
