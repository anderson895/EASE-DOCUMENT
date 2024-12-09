

// Search functionality
$('#searchInput').on('input', function() {
    var value = $(this).val().toLowerCase();
    $('#userTable tbody tr').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});

// Initialize functions when document is ready
$(document).ready(function() {

    console.log('updated');

    fetchOrders();
    AutoRefresh();
    bindTableFilter();
});

function AutoRefresh() {
    setInterval(function() {
        // Only call fetchOrders if the search input is empty
        if ($('#searchInput').val().trim() === '') {
            fetchOrders();
        }
    }, 3000);
}


// Table filtering functionality
function bindTableFilter() {
    $('#searchInput').on('input', function() {
        const input = $(this).val().toLowerCase();
        const rows = $("#recordTable tbody tr");
        
        rows.each(function() {
            let rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.includes(input));
        });
    });
}

function fetchOrders() {
    $.ajax({
        type: "GET",
        url: 'backend/end-points/controller.php',
        data: { requestType: 'GetAllOrders' },
        dataType: 'json',
        success: function(response) {
            // console.log(response);
            if (response.status === 'success') {
                displayOrders(response.data);
            } else {
                console.log(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX error: ' + error);
        }
    });
}

function displayOrders(orders) {
    // Get the step from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const currentStep = urlParams.get('step') || 'Pending';

    let tableBody = $('#recordTable tbody');
    tableBody.empty();

    // Filter orders based on the current step
    const filteredOrders = orders.filter(function(orderItem) {
        return orderItem.cr_status === currentStep;
    });

    // Display the filtered orders
    if (filteredOrders.length > 0) {
        filteredOrders.forEach(function(orderItem) { 
            var orderDate = new Date(orderItem.cr_request_date);
            var formattedDate = orderDate.toLocaleString('en-US', { 
                month: 'long', 
                day: 'numeric', 
                year: 'numeric', 
                hour: 'numeric', 
                minute: 'numeric', 
                hour12: true 
            });

            let fullName = `${orderItem.r_fname} ${orderItem.r_mname} ${orderItem.r_lname}`;

            let orderRow = `
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm text-gray-600">${orderItem.cr_id}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">${orderItem.cr_formtype}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">${fullName}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">${orderItem.cr_payment}</td>
                    
                    <td class="px-4 py-2 text-sm text-gray-600">${formattedDate}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">${orderItem.cr_price}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">${orderItem.cr_address}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">${orderItem.cr_status}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">
                            <select 
                                class="UpdateOrderStatus text-center w-full p-2 text-white bg-blue-500 border border-blue-500 rounded-md shadow-sm appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300" 
                                data-orderId="${orderItem.cr_id}" 
                                data-initial-status="${orderItem.cr_status}"
                                ${orderItem.cr_status == 'Canceled' ? 'style="display: none;"' : ''}>
                                ${generateStatusOptions(orderItem.cr_status)}
                                
                            </select>

                            <button 
                                class="mt-2 w-full px-4 py-2 text-white bg-green-500 rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-offset-1"
                                onclick="location.href='view_orders.php?cr_id=${orderItem.cr_id}';">
                                View
                            </button>
                        </td>
                    </tr>
                `;

            tableBody.append(orderRow);
        });
    } else {
        // If no records are found
        tableBody.append(`
            <tr>
                <td colspan="9" class="px-4 py-2 text-center text-sm text-gray-600">
                    No records found
                </td>
            </tr>
        `);
    }
}

// Helper function to generate status options dynamically
function generateStatusOptions(currentStatus) {
    let options = '';

    // List of possible statuses
    const statusOptions = [
        { value: 'Pending', label: 'Pending' },
        { value: 'Approved', label: 'Approved' },
        { value: 'Shipped', label: 'Shipped' },
        { value: 'Delivered', label: 'Delivered' },
        { value: 'Rejected', label: 'Rejected' },
    ];

    statusOptions.forEach(option => {
        options += `<option value="${option.value}" ${option.value === currentStatus ? 'selected' : ''}>${option.label}</option>`;
    });

    return options;
}











$(document).on("change", ".UpdateOrderStatus", function () {
    const $select = $(this); 
    const orderId = $select.data("orderid");
    const initialStatus = $select.data("initial-status"); 
    const newStatus = $select.val(); 
  
  
    if(newStatus==""){
      console.log("select new status"); 
      return;
    }
    if (newStatus === initialStatus) {
        console.log("No changes made to the order status."); 
        return; 
    }
  
    $select.prop("disabled", true);
  
    $.ajax({
        url: "backend/end-points/controller.php",
        method: "POST",
        data: {
            orderId: orderId,
            orderStatus: newStatus,
            requestType: 'UpdateOrderStatus'
        },
        success: function (response) {
          console.log(response);
          if (response == "200") {
              alertify.success("Order Status Updated Successfully");
      
              // Delay the reload by 1 second (1000 milliseconds)
              setTimeout(function() {
                  location.reload();
              }, 1000);
          } else {
              alertify.error(response);
          }
      },
        complete: function () {
            $select.prop("disabled", false);
        }
    });
  });