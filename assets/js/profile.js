
// Open and close modal for adding products
document.getElementById('add-product-btn').addEventListener('click', function() {
document.getElementById('add-product-modal').style.display = 'block';
});

function closeModal() {
    document.getElementById('add-product-modal').style.display = 'none';
}


document.addEventListener("DOMContentLoaded", () => {
    const productTable = document.getElementById("productTable").querySelector("tbody");
    const viewModal = document.getElementById("viewModal");
    const closeViewModal = document.getElementById("closeViewModal");

    const fetchProducts = async () => {
        const response = await fetch("../actions/getproducts.php");
        const products = await response.json();

        if (products.error) {
            console.error(products.error);
            return;
        }

        productTable.innerHTML = ""; // Clear existing rows
        products.forEach((product) => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${product.name}</td>
                <td>${product.category}</td>
                <td>GH₵${product.price}</td>
                <td>
                    <button class="view-btn" data-product='${JSON.stringify(product)}'>View</button>
                    <button class="delete-btn" data-product-id="${product.product_id}">Delete</button>
                </td>
            `;

            productTable.appendChild(row);
        });

        addEventListeners();
    };

    const addEventListeners = () => {
        // View Button Logic
        document.querySelectorAll(".view-btn").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const product = JSON.parse(e.target.dataset.product);
                document.getElementById("viewProductName").textContent = product.name;
                document.getElementById("viewProductImage").src = product.$image_url;
                document.getElementById("viewProductDescription").textContent = product.description || "No description available.";
                document.getElementById("viewProductCategory").textContent = product.category;
                document.getElementById("viewProductPrice").textContent = product.price;
                viewModal.style.display = "block";
            });
        });

        // Delete Button Logic
        document.querySelectorAll(".delete-btn").forEach((btn) => {
            btn.addEventListener("click", async (e) => {
                const productId = e.target.dataset.productId;
                if (confirm("Are you sure you want to delete this product?")) {
                    const response = await fetch("../actions/delete_product.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded"},
                        body: JSON.stringify({ product_id: productId }),
                    });

                    const result = await response.json();
                    if (result.success) {
                        alert("Product deleted successfully!");
                        fetchProducts(); // Refresh table
                    } else {
                        alert("Failed to delete product: " + result.error);
                    }
                }
            });
        });
    };

    // Close View Modal
    closeViewModal.addEventListener("click", () => {
        viewModal.style.display = "none";
    });

    // Fetch and display products on page load
    fetchProducts();
});

