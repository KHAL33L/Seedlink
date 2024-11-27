document.addEventListener("DOMContentLoaded", () => {
    const productGrid = document.getElementById("productGridSaplings");
    const productModal = document.getElementById("productModal");
    const closeModal = document.getElementById("closeModal");

    const modalProductImage = document.getElementById("modalProductImage");
    const modalProductName = document.getElementById("modalProductName");
    const modalProductDescription = document.getElementById("modalProductDescription");
    const modalProductPrice = document.getElementById("modalProductPrice");
    const modalProductQuantity = document.getElementById("productQuantity");
    const modalAddToCart = document.getElementById("modalAddToCart");

    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let currentProduct = null; // Store the current product for the modal

    // Show product modal with quantity selector
    const showModal = (product) => {
        currentProduct = product;
        modalProductImage.src = product.image_url;
        modalProductName.textContent = product.name;
        modalProductDescription.textContent = product.description || "No description available.";
        modalProductPrice.textContent = product.price;
        modalProductQuantity.value = 1; // Reset quantity to 1
        document.getElementById("productModal").style.display = "block";
    };

    // Add product to the cart with quantity
    // modalAddToCart.addEventListener("click", () => {
    //     const quantity = parseInt(modalProductQuantity.value);

    //     // Check if product already exists in the cart
    //     const existingProductIndex = cart.findIndex((item) => item.product_id === currentProduct.product_id);
    //     if (existingProductIndex > -1) {
    //         // Update quantity if product exists
    //         cart[existingProductIndex].quantity += quantity;
    //     } else {
    //         // Add new product to the cart
    //         cart.push({
    //             product_id: currentProduct.product_id,
    //             name: currentProduct.name,
    //             price: currentProduct.price,
    //             quantity: quantity,
    //             image_url: currentProduct.image_url,
    //         });
    //     }

    //     localStorage.setItem("cart", JSON.stringify(cart)); // Save cart to localStorage
    //     alert(`${currentProduct.name} added to cart!`);
    //     document.getElementById("productModal").style.display = "none"; // Close modal
    // });

    // Fetch products by category (saplings)
    const fetchSaplings = async () => {
        try {
            const response = await fetch("../actions/getproducts_saplings.php?category=sapling");
            const products = await response.json();

            if (products.error) {
                console.error(products.error);
                return;
            }

            displaySaplings(products);
        } catch (error) {
            console.error("Error fetching products:", error);
        }
    };

    // Display saplings in cards
    const displaySaplings = (products) => {
        productGrid.innerHTML = ""; // Clear the grid

        products.forEach((product) => {
            const productCard = document.createElement("div");
            productCard.className = "product-card";
            productCard.innerHTML = `
                <img src="${product.image_url}" alt="${product.name}" class="product-image">
                <h3>${product.name}</h3>
                <p>GH₵${product.price}</p>
                <button class="add-to-cart-btn" data-product-id="${product.product_id}">Add to Cart</button>
            `;

            // Add click event to the card for showing modal
            productCard.addEventListener("click", () => {
                currentProductId = product.product_id;
                showModal(product);
            });

            productGrid.appendChild(productCard);
        });
    };


    // Close modal
    closeModal.addEventListener("click", () => {
        productModal.style.display = "none";
    });

    // // Add to cart functionality in modal
    // modalAddToCart.addEventListener("click", () => {
    //     alert(`Product ${currentProductId} added to cart!`);
    //     // Logic to add product to cart can go here
    // });

    // Fetch and display saplings on page load
    fetchSaplings();
});
