<?php include "components/header.php"; ?>

<div class="container mx-auto px-4 py-8">
    <!-- Home Section -->
    <section class="text-center py-16">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-4 transition duration-300 ease-in-out hover:text-blue-500">Welcome to EASE DOCUMENT</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
            This section is designed to assist you with document requests, processing, and status updates.
        </p>
    </section>

    <!-- Features Section: Highlighting the Document Ordering Process -->
    <section class="features py-12 bg-gray-100">
        <h2 class="text-4xl font-semibold text-gray-800 text-center mb-8">Why Choose Our Document Ordering System?</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <!-- Clear Documentation -->
            <div class="feature-card p-6 bg-white shadow-lg rounded-lg transform hover:scale-105 transition duration-300 ease-in-out">
                <div class="flex items-center justify-center mb-4">
                    <img src="../assets/clear-format.png" alt="Clear Documentation" class="w-16 h-16 text-blue-500" />
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Clear Documentation</h3>
                <p class="text-gray-600">Our system provides clear, concise, and easy-to-understand documentation for residents.</p>
            </div>
            <!-- Efficient Order Process -->
            <div class="feature-card p-6 bg-white shadow-lg rounded-lg transform hover:scale-105 transition duration-300 ease-in-out">
                <div class="flex items-center justify-center mb-4">
                    <img src="../assets/document.png" alt="Efficient Order Process" class="w-16 h-16 text-blue-500" />
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Efficient Order Process</h3>
                <p class="text-gray-600">Our streamlined process ensures fast document requests and approvals.</p>
            </div>
            <!-- Easy Status Tracking -->
            <div class="feature-card p-6 bg-white shadow-lg rounded-lg transform hover:scale-105 transition duration-300 ease-in-out">
                <div class="flex items-center justify-center mb-4">
                    <img src="../assets/handover.png" alt="Fast Delivery" class="w-16 h-16 text-blue-500" />
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Fast Delivery</h3>
                <p class="text-gray-600">Easily track the status of your document request and receive notifications when it’s ready for collection.</p>
            </div>
        </div>
    </section>

</div>

<?php include "components/footer.php"; ?>
