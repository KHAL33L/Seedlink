document.addEventListener("DOMContentLoaded", () => {
    // Event listener for Add to Cart button in the modal
    const addToCartButton = document.getElementById("modalAddToCart");
    addToCartButton.addEventListener("click", () => {
        // Get product details from the modal
        const productId = addToCartButton.dataset.productId;
        const quantity = parseInt(document.getElementById("productQuantity").value);

        if (quantity <= 0) {
            alert("Invalid product or quantity.");
            return;
        }

        // Create the payload
        const payload = {
            product_id: productId,
            quantity: quantity
        };

        // Send the data to add_to_cart.php via a POST request
        fetch("../../actions/add_to_cart.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(payload)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Product added to cart!");
                // Optionally update cart icon or count here
            } else {
                alert(data.message || "Failed to add product to cart.");
            }
        })
        .catch(error => {
            console.error("Error adding product to cart:", error);
            alert("An error occurred. Please try again.");
        });
    });

    // Example for dynamically setting product details in modal
    document.querySelectorAll(".product-card button").forEach(button => {
        button.addEventListener("click", event => {
            const productCard = event.target.closest(".product-card");
            const productId = productCard.dataset.productId;
            const productName = productCard.dataset.productName;
            const productPrice = productCard.dataset.productPrice;

            // Set modal details
            document.getElementById("modalProductName").textContent = productName;
            document.getElementById("modalProductPrice").textContent = productPrice;
            addToCartButton.dataset.productId = productId;

            // Show modal
            document.getElementById("productModal").style.display = "block";
        });
    });

    // Close modal functionality
    document.getElementById("closeModal").addEventListener("click", () => {
        document.getElementById("productModal").style.display = "none";
    });
});
