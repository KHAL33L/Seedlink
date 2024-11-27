document.addEventListener("DOMContentLoaded", () => {
    const productGrid = document.getElementById("productGridSaplings");
    const productModal = document.getElementById("productModal");
    const closeModal = document.getElementById("closeModal");

    const modalProductImage = document.getElementById("modalProductImage");
    const modalProductName = document.getElementById("modalProductName");
    const modalProductDescription = document.getElementById("modalProductDescription");
    const modalProductPrice = document.getElementById("modalProductPrice");
    const modalAddToCart = document.getElementById("modalAddToCart");

    let currentProductId = null;

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
                <p>$${product.price}</p>
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

    // Show modal with product details
    const showModal = (product) => {
        modalProductImage.src = product.image_url;
        modalProductName.textContent = product.name;
        modalProductDescription.textContent = product.description || "No description available.";
        modalProductPrice.textContent = product.price;
        productModal.style.display = "block";
    };

    // Close modal
    closeModal.addEventListener("click", () => {
        productModal.style.display = "none";
    });

    // Add to cart functionality in modal
    modalAddToCart.addEventListener("click", () => {
        alert(`Product ${currentProductId} added to cart!`);
        // Logic to add product to cart can go here
    });

    // Fetch and display saplings on page load
    fetchSaplings();
});
